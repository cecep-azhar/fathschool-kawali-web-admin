<?php

namespace App\Services\Student;

use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;
use App\Models\Assignment;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Department;
use App\Models\OnlineClass;
use App\Models\StudentAttendance;
use App\Models\Subject;
use App\Models\SubmittedAssignment;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Notifications\NewAssignmentAvailableForReviewNotification;
use App\Traits\CheckParentOrChildren;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class DashboardService
{
    use CheckParentOrChildren;

    public function teacherList(object $request, object $user): array
    {
        $student_class = $user->profile->course_id;

        $teacher_subjects = TeacherSubject::latest()->where(function ($q) use ($student_class) {
            $q->whereHas('subject', function ($q) use ($student_class) {
                $q->where('course_id', $student_class);
            });
        })->get()->groupBy('teacher_id');
        $teacher_ids = [];
        foreach ($teacher_subjects as $key => $value) {
            array_push($teacher_ids, $key);
        }

        $teachers_query = User::whereIn('id', $teacher_ids)->latest()
            ->with(['department']);

        //filter --> keyword
        if ($request->has('keyword') && $request->keyword != null) {
            $teachers_query->where('name', 'Like', '%'.$request->keyword.'%')
                ->orWhere('email', 'Like', '%'.$request->keyword.'%');
        }

        //filter --> department
        if ($request->has('department') && $request->department != null) {
            $teachers_query->whereHas('department', function ($t) use ($request) {
                $t->where('name', 'Like', '%'.$request->department.'%')
                    ->orWhere('slug', 'Like', '%'.$request->department.'%');
            });
        }

        $data['teachers'] = $teachers_query->get();
        $data['departments'] = Department::latest()->get(['id', 'name', 'slug']);
        $data['filter_data'] = $request;

        return $data;
    }

    public function assignmentList(object $request, object $user): array
    {
        $student_classes = $user->courses()->pluck('course_id');

        $assignments_query = Assignment::whereIn('course_id', $student_classes)
            ->with('subject', 'teacher', 'class:id,name')
            ->withCount([
                'submitted as submitted_done' => function ($q) use ($user) {
                    $q->where('student_id', $user->id);
                },
            ])
            ->withCasts(['submitted_done' => 'boolean']);

        // filter => keyword
        if ($request->filled('keyword')) {
            $assignments_query->where('title', 'like', '%'.$request->keyword.'%');
        }

        // filter => status
        if ($request->filled('status')) {
            $status = $request->status;

            if ($status == 'Due') {
                $assignments_query->due();
            } elseif ($status == 'Expired') {
                $assignments_query->expired();
            } elseif ($status == 'submitted') {
                $assignments_query->whereHas('submitted', function ($q) use ($user) {
                    $q->where('student_id', $user->id);
                });
            } elseif ($status == 'unsubmitted') {
                $assignments_query->where('submitted_done', false);
            }
        }

        $assignments = $assignments_query
            ->latest('end_date')
            ->paginate(20)->withQueryString();
        $assignments->setCollection($assignments->groupBy('assignment_status'));
        $assignments->append(['submissions', 'students', 'total_mark', 'assignment_status']);

        return [
            'assignments' => $assignments,
            'subjects' => Subject::whereIn('course_id', $student_classes)->get(['id', 'name']),
            'filter_data' => $request,
        ];
    }

    public function assignmentSubmit(object $request): void
    {
        $old_submitted_assignment = SubmittedAssignment::where('assignment_id', $request->assignment)
            ->where('student_id', auth()->id())
            ->first();

        // file upload
        if ($request->hasFile('file')) {
            if ($old_submitted_assignment) {
                FileDelete::deleteImage($old_submitted_assignment->assignment);
            }
            $url = FileUpload::uploadImage($request->file, 'assignment');
        }

        // apply condition
        if ($old_submitted_assignment) {
            $old_submitted_assignment->update([
                'assignment_id' => $request->assignment,
                'description' => $request->description,
                'assignment' => $url,
            ]);
        } else {
            SubmittedAssignment::create([
                'student_id' => auth()->id(),
                'assignment_id' => $request->assignment,
                'description' => $request->description,
                'assignment' => $url,
            ]);
            $ass = Assignment::where('id', $request->assignment)->first();
            $teacher = User::where('id', $ass->user_id)->first();
            $student = User::where('id', auth()->id())->first();

            Notification::send($teacher, new NewAssignmentAvailableForReviewNotification($teacher, $student, $ass));
        }
    }

    public function subjectShow(object $request, object $subject): array
    {
        $user = $this->checkUser();

        if ($request->tab == 'students') {
            $get_class = Course::with('students.user.profile')->findOrFail($subject->course_id);
            $students = $get_class->students()->with('user.profile')->paginate(20);
        } else {
            $students = [];
        }
        if ($request->tab == 'details' || $request->tab == 'assignments' || $request->tab == 'online-class' || ! $request->tab) {

            $get_class = Course::with('students.user.profile')->findOrFail($subject->course_id);
            $assignments = $get_class->assignments()
                ->withCount([
                    'submitted',
                    'submitted as submitted_done' => function ($q) use ($user) {
                        $q->where('student_id', $user->id);
                    },
                ])
                ->where('subject_id', $subject->id)
                ->paginate(20);

            $query_online_classes = $subject->online_classes()->with('subject');

            // Filter
            if ($request->has('status') && $request->status != null && $request->status != 'all') {
                if ($request->status == 'upcoming') {
                    $query_online_classes->where('start_time', '>=', Carbon::now()->endOfDay());
                } else {
                    $query_online_classes->where('start_time', '<=', Carbon::now()->endOfDay());
                }
            }

            $online_classes = $query_online_classes->latest()->paginate(20)->withQueryString();
            $subjects = Subject::latest()->select('id', 'name')->get();

            $upcoming_classes = OnlineClass::where('subject_id', $subject->id)
                ->with(['teacher', 'course'])
                ->where('start_time', '>=', Carbon::today())
                ->take(4)
                ->get();

            $upcoming_assignments = $get_class->assignments()
                ->where('subject_id', $subject->id)
                ->where('start_date', '>=', Carbon::today())
                ->take(4)
                ->get();

            $upcoming_assignments->load([
                'class.students' => function ($q) {
                    $q->limit(7);
                },
                'teacher',
                'subject',
            ])->append(['submissions']);

            $assignments->load([
                'class.students' => function ($q) {
                    $q->limit(7);
                },
                'teacher',
                'subject',
            ])->append(['submissions']);
        } else {
            $assignments = [];
            $online_classes = [];
            $upcoming_classes = [];
            $subjects = [];
            $upcoming_assignments = [];
        }

        if ($request->tab == 'schedule') {
            $schedules = ClassRoutine::where('course_id', $subject->course_id)
                ->with(['course:id,name', 'teacher:id,name', 'subject:id,name,color'])
                ->get()
                ->map(function ($data) {
                    $data->daysOfWeek = (string) $data->weekday;
                    $data->startTime = $data->start_time;
                    $data->endTime = $data->end_time;
                    $data->color = $data->subject->color;
                    $data->title = 'Course: '.$data->course->name.'<br>'.'Teacher: '.$data->teacher->name.'<br>'.'Subject: '.$data->subject->name;

                    return $data;
                });
        } else {
            $schedules = [];
        }

        if ($request->tab == 'syllabus') {
            $syllabuses = $subject->syllabuses()
                ->with(['class', 'subject'])
                ->paginate(20);
        } else {
            $syllabuses = [];
        }
        $data = [
            'course' => $subject,
            'assignments' => $assignments,
            'students' => $students,
            'online_classes' => $online_classes,
            'request_data' => $request,
            'upcoming_classes' => $upcoming_classes,
            'subjects' => $subjects,
            'schedules' => $schedules,
            'syllabuses' => $syllabuses,
            'subject_teachers' => $subject->teachers()->take(2)->get()->pluck('teacher.name')->toArray(),
            'upcoming_assignments' => $upcoming_assignments,
        ];

        return $data;
    }

    public function attendances(object $request, object $user): array
    {
        $student_attendance = StudentAttendance::where('student_id', $user->id)->get();
        $attendance_query = StudentAttendance::query()->with('subject:id,name', 'teacher:id,name')->where('student_id', $user->id);

        // filter => teacher
        if ($request->has('teacher_id') && $request->teacher_id != null && $request->teacher_id != 'all') {
            $attendance_query->where('teacher_id', $request->teacher_id);
        }

        // filter => subject
        if ($request->has('subject_id') && $request->subject_id != null && $request->subject_id != 'all') {
            $attendance_query->where('subject_id', $request->subject_id);
        }

        $attendances = $attendance_query->latest('created_at')
            ->get()
            ->transform(function ($data) use ($student_attendance) {
                $data->total_class = $student_attendance->where('subject_id', $data->subject_id)->where('teacher_id', $data->teacher_id)->count();
                $data->present_days = $student_attendance->where('subject_id', $data->subject_id)->where('teacher_id', $data->teacher_id)->where('status', 'present')->count();
                $data->present_percentage = round(($data->present_days / $data->total_class) * 100);

                return $data;
            })
            ->groupBy('subject_id');

        $student_classes = $user->courses()->get()->map(function ($q) {
            return $q->course_id;
        });

        $data['attendances'] = $attendances;
        $data['subjects'] = Subject::whereIn('course_id', $student_classes)->get(['id', 'name']);
        $data['filter_data'] = $request;

        return $data;
    }

    public function parentAttendanceShow(object $user, object $request): array
    {
        $student_classes = $user->courses()->get()->map(function ($q) {
            return $q->course_id;
        });
        $data['subjects'] = Subject::whereIn('course_id', $student_classes)->get(['id', 'name']);
        $data['filter_data'] = $request;

        $get_all_attendances_query = $user->attendances()->with('subject');

        // month filter
        if ($request->has('month') && $request->month != null) {
            if ($request->month == 'this_month') {
                $get_all_attendances_query->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
            }
            if ($request->month == 'last_month') {
                $get_all_attendances_query->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
            }
            if ($request->month == 'last_six_month') {
                $get_all_attendances_query->whereBetween(
                    'created_at',
                    [Carbon::now()->subMonth(6), Carbon::now()]
                );
            }
        }
        // subject filter
        if ($request->has('subject') && $request->subject != null) {
            $get_all_attendances_query->where('subject_id', $request->subject);
        }

        $get_all_attendances = $get_all_attendances_query->get()->groupBy('subject_id');

        $attendance_arr = [];
        foreach ($get_all_attendances as $key => $attendance) {

            $subject = Subject::where('id', $key)->first(['id', 'name']);
            $total_classes = StudentAttendance::where('student_id', $user->id)->where('subject_id', $key)->count();
            $total_present_classes = StudentAttendance::present()->where('student_id', $user->id)->where('subject_id', $key)->count();
            $first_teacher = $subject?->teachers()->first();

            $custom_item = [
                'subject_id' => $key,
                'subject_name' => $subject ? $subject->name : '',
                'user_id' => $user ? $user->id : '',
                'total_classes' => $total_classes,
                'total_present_classes' => $total_present_classes,
                'present_score' => round(($total_present_classes / $total_classes) * 100, 2),
                'teacher' => User::where('id', $first_teacher ? $first_teacher->teacher_id : '')->first(['name']),
            ];
            array_push($attendance_arr, $custom_item);
        }
        $data['attendance_arr'] = $attendance_arr;

        return $data;
    }

    public function onlineClasses(object $request, object $user): array
    {
        $student_classes = $user->courses()->get()->map(function ($q) {
            return $q->course_id;
        });

        $class_query = OnlineClass::whereIn('course_id', $student_classes)->with('subject', 'teacher', 'course');

        // filter --> keyword
        if ($request->has('keyword') && $request->keyword != null) {
            $class_query->whereHas('subject', function ($q) use ($request) {
                $q->where('name', 'Like', '%'.$request->keyword.'%');
            });
        }

        // filter --> status
        if ($request->has('status') && $request->status != null) {

            if ($request->status == 'upcoming') {
                $class_query->whereDate('start_time', '>', Carbon::now());
            } else {
                $class_query->whereDate('start_time', '<', Carbon::now());
            }
        }

        $data['classes'] = $class_query->latest('start_time')->paginate(20);
        // This will replace data property of the pagination
        $data['classes']->setCollection($data['classes']->groupBy('online_class_status'));

        $data['classes']->append(['online_class_status']);

        $data['filter_data'] = $request;

        return $data;
    }
}
