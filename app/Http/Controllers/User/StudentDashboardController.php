<?php

namespace App\Http\Controllers\User;

use App\Exports\ExportStudentAttendance;
use App\Http\Controllers\Controller;
use App\Mail\StudentMail;
use App\Models\Assignment;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamMark;
use App\Models\Setting;
use App\Models\StudentAttendance;
use App\Models\Subject;
use App\Models\SubmittedAssignment;
use App\Models\User;
use App\Notifications\AssignmentReviewNotification;
use App\Services\Student\DashboardService;
use App\Traits\CheckParentOrChildren;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;

class StudentDashboardController extends Controller
{
    use CheckParentOrChildren;

    /**
     * Auth student's course list page
     *
     * @return Response
     */
    public function myCourses()
    {
        $user = $this->checkUser();
        if (! $user->hasRole('Student')) {
            abort(403);
        }

        $courses = $user->courses()->with('course.subjects', 'course.students')->get()
            ->transform(function ($data) {
                $data->total_students = $data->course->students->count();

                return $data;
            });

        return inertia('Student/MyCourses', compact('courses'));
    }

    /**
     * Auth student's  class teachers list
     */
    public function teacherList(Request $request, DashboardService $dashboardService)
    {
        abort_if(! userCan('teacher.index'), 403);

        $user = $this->checkUser();
        $data = $dashboardService->teacherList($request, $user);

        return inertia('Student/TeacherList', $data);
    }

    /**
     * Auth student's  class assignment list
     */
    public function assignmentList(Request $request, DashboardService $dashboardService)
    {
        $user = $this->checkUser();
        if (! $user->hasRole('Student')) {
            abort(403);
        }

        $data = $dashboardService->assignmentList($request, $user);

        return inertia('Student/Assignment', $data);
    }

    /**
     * Send mail to teacher about assignment review
     */
    public function sendAssignmentReviewMail(Assignment $assignment)
    {
        $assignment->load('teacher');
        $submitted_assignment = SubmittedAssignment::where('assignment_id', $assignment->id)
            ->where('student_id', auth()->id())->first();

        // send mail
        Notification::route('mail', [
            $assignment->teacher->email,
        ])->notify(new AssignmentReviewNotification($assignment->teacher, $submitted_assignment, $assignment));

        $this->flashSuccess('Review request sent');

        return back();
    }

    /**
     * Student assignment submit
     */
    public function assignmentSubmit(Request $request, DashboardService $dashboardService)
    {
        $user = $this->checkUser();
        if (! $user->hasRole('Student')) {
            abort(403);
        }

        $request->validate([
            'file' => 'required|mimes:png,jpg,jped,pdf,zip,doc,docx',
        ]);

        $dashboardService->assignmentSubmit($request);

        $this->flashSuccess('Assignment submitted');

        return back();
    }

    /**
     * Student class subject list
     */
    public function subject()
    {
        abort_if(! userCan('subject.list'), 403);

        $user = $this->checkUser();

        $subjects = $user->profile->class->subjects()->with('course')->latest()->get();

        $subjects->each(function ($subject) {
            $subject->load(['online_classes' => function ($q) {
                return $q->limit(1);
            }]);
        });

        return inertia('Student/Subject', [
            'subjects' => $subjects,
        ]);
    }

    /**
     * Student class subject details
     *
     * @return response
     */
    public function subjectShow(Request $request, Subject $subject, DashboardService $dashboardService)
    {
        $courses = authUser()->courses->pluck('course_id')->toArray();

        abort_if(! in_array($subject->course_id, $courses), 403);

        $data = $dashboardService->subjectShow($request, $subject);

        return inertia('Teacher/SubjectDetails', $data);
    }

    /**
     * Student attendance list
     */
    public function attendances(Request $request, DashboardService $dashboardService)
    {
        abort_if(! userCan('attendance.index'), 403);

        $user = $this->checkUser();

        $array = ['Student', 'Parent'];
        if (! in_array($user->role, $array)) {
            abort(403);
        }

        if (authUser()->role == 'Parent') {

            $data = (new DashboardService)->parentAttendanceShow($user, $request);

            return inertia('Parent/Attendance', $data);
        } else {
            $data = $dashboardService->attendances($request, $user);

            return inertia('Student/Attendance', $data);
        }
    }

    /**
     * Student class related online class list
     */
    public function onlineClasses(Request $request, DashboardService $dashboardService)
    {
        $user = $this->checkUser();

        if (! $user->hasRole('Student')) {
            abort(403);
        }

        $data = $dashboardService->onlineClasses($request, $user);

        return inertia('Student/OnlineClass', $data);
    }

    /**
     * Auth Student class's others students/ collegues list
     */
    public function studentList(Request $request)
    {
        abort_if(! userCan('classmate.list'), 403);

        $students_query = authUser()->profile->class->students()->with('parent:id,name,email')->latest();
        // filter => keyword
        if ($request->has('keyword') && $request->keyword != null) {
            $students_query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'Like', '%'.$request->keyword.'%')
                    ->orWhere('email', 'Like', '%'.$request->keyword.'%');
            });
        }

        $students = $students_query->paginate(15)->onEachSide(-1);

        return inertia('Student/StudentList', [
            'students' => $students,
            'filter_data' => $request,
        ]);
    }

    /**
     * Auth Student classmate send mail option
     */
    public function studentSendMail(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'description' => 'required',
            'email' => 'required',
        ]);

        $email = $request->email;
        $subject = $request->subject;

        Mail::to($email)->send(new StudentMail($subject, $request->description));

        $this->flashSuccess('Mail successfully sent');

        return back();
    }

    /**
     * Auth Student class routine
     *
     * @return \Illuminate\Http\Response
     */
    public function classRoutine(Request $request)
    {

        $user = $this->checkUser();
        if (! $user->hasRole('Student')) {
            abort(403);
        }

        $courses = $user->courses()->get()->map(function ($course) {
            return $course->course_id;
        });

        $routines = ClassRoutine::whereIn('course_id', $courses)->latest()->with(['course', 'teacher', 'subject'])->paginate(20);

        $schedules = ClassRoutine::whereIn('course_id', $courses)
            ->with(['course:id,name', 'teacher:id,name', 'subject:id,name,color'])
            ->get()
            ->transform(function ($data) {
                $data->daysOfWeek = (string) $data->weekday;
                $data->color = $data->subject->color;

                $startTime = Carbon::parse($data->start_time)->format('Y-m-d H:i:s');
                $endTime = Carbon::parse($data->end_time)->format('Y-m-d H:i:s');

                $data->startTime = $startTime;
                $data->endTime = $endTime;

                $data->title = 'Course: '.$data->course->name.'<br>'.'Teacher: '.$data->teacher->name.'<br>'.'Subject: '.$data->subject->name.'<br>Time: '.Carbon::parse($data->start_time)->format('h:i A').' - '.Carbon::parse($data->end_time)->format('h:i A');

                return $data;
            });

        return inertia('Student/ClassRoutine', [
            'routines' => $routines,
            'schedules' => $schedules,
            'teachers' => User::teacher()->get(['id', 'name']),
        ]);
    }

    /**
     * Student attendance export as pdf / xlsx
     *
     * @return \Illuminate\Http\Response
     */
    public function attendancesExport(Request $request)
    {
        $student = auth()->id();
        $subject = $request->subject['id'];
        $type = $request->type;

        if ($type == 'xlsx') { // xlsx

            return Excel::download(new ExportStudentAttendance($student, $subject), 'attendances.xlsx');
        } else { // pdf

            $attendances = StudentAttendance::with('student', 'teacher', 'subject')->where('student_id', $student)->where('subject_id', $subject)->get();
            $settings = Setting::first();

            $pdf = PDF::loadView('export.student_attendance', compact('attendances', 'settings'));

            return $pdf->download('attendances.pdf');
        }
    }

    /**
     * Student exam results sheets
     *
     * @return \Illuminate\Http\Response
     */
    public function previewResult(Request $request, Exam $exam)
    {
        $data['user'] = authUser()->load('profile');
        $data['exam'] = $exam->load('course:id,name');
        $data['exam_marks'] = ExamMark::where('exam_id', $data['exam']->id)
            ->where('user_id', $data['user']->id)
            ->get()
            ->map(function ($exam) {
                $exam->mark_avg = ExamMark::where('exam_id', $exam->exam_id)
                    ->where('subject', $exam->subject)
                    ->avg('marks');

                return $exam;
            });

        $data['setting'] = Setting::first([
            'app_name', 'dark_logo', 'light_logo', 'app_email', 'app_phone', 'key_to_grades',
            'grade_summary',
            'principal_name',
        ]);
        $data['avg_score'] = $data['exam_marks']->avg('marks');
        $data['no_of_students'] = DB::table('user_courses')->where('course_id', $data['exam']->course_id)->count();
        $data['next_exam'] = Exam::where('start_date', '>=', now())->first();
        $data['request'] = $request;

        $data['logo'] = domPdfImageUrl($data['setting']?->dark_logo);

        $data['user_avatar'] = domPdfImageUrl($data['user']?->profile_photo_path ?? $data['user']?->profile_photo_url);
        $data['logo'] = domPdfImageUrl($data['setting']?->dark_logo);
        $data['exam_marks_count'] = count($data['exam_marks']);

        if ($request->download) {

            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ])->loadView('student-report-sheets-download', $data);

            return $pdf->stream();
        } else {
            return view('student-report-sheets', $data);
        }
    }
}
