<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\OnlineClassCreateRequest;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\OnlineClass;
use App\Models\Subject;
use App\Services\Teacher\Class\CreateOnlineClassService;
use App\Services\Teacher\Class\UpdateOnlineClassService;
use App\Traits\ZoomMeetingTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SingleTeacherController extends Controller
{
    use ZoomMeetingTrait;

    public function class()
    {
        $user = authUser();
        if (! $user->hasRole('Teacher')) {
            abort(403);
        }

        $subjects = $user->subjects()->with(['subject.course'])->latest()->get()->transform(function ($data) {
            $data->total_students = $data->subject->course->students->count();

            return $data;
        });
        $subjects = $subjects->groupBy('subject.course_id');

        $subjects->each(function ($subject) {
            $subject->load(['subject.course.students' => function ($q) {
                return $q->limit(7);
            }]);
        });

        return inertia('Teacher/Subjects', [
            'subjects' => $subjects,
        ]);
    }

    public function syllabus()
    {
        abort_if(! userCan('syllabus.index'), 403);

        $syllabuses = authUser()->syllabuses()->with('teacher', 'subject')->paginate(15)->onEachSide(-1);

        return inertia('Teacher/Syllabus', [
            'syllabuses' => $syllabuses,
        ]);
    }

    // Teacher class schedule
    public function mySchedule(Request $request)
    {
        $user = authUser();
        if (! $user->hasRole('Teacher')) {
            abort(403);
        }

        $subjects = $user->subjects;
        $courses = $subjects->map(function ($q) {
            return $q->subject->course_id;
        });

        $query = ClassRoutine::query();

        if ($request->has('course_id') && $request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }
        if ($request->has('subject_id') && $request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $schedules = $query->whereIn('course_id', $courses)->with(['course:id,name', 'teacher:id,name', 'subject:id,name,color'])->get()
            ->transform(function ($data) {
                $data->daysOfWeek = (string) $data->weekday;
                $data->startTime = $data->start_time;
                $data->endTime = $data->end_time;
                $data->color = $data->subject->color;
                $data->title = 'Course: '.$data->course->name.'<br>'.'Teacher: '.$data->teacher->name.'<br>'.'Subject: '.$data->subject->name.'<br>Time: '.Carbon::parse($data->start_time)->format('h:i').' - '.Carbon::parse($data->end_time)->format('h:i A');

                return $data;
            });

        return inertia('Teacher/MySchedule', [
            'schedules' => $schedules,
            'classes' => Course::whereIn('id', $courses)->get(['id', 'name']),
            'query' => $request,
        ]);
    }

    public function subjectDetails(Request $request, Subject $subject)
    {
        abort_if(! userCan('subjects.show'), 403);

        $user = authUser();

        $subjects = $user->subjects->pluck('subject_id');
        abort_if(! $subjects->contains($subject->id), 403);
        $subject->load('course');

        $get_class = Course::FindOrFail($subject->course_id);
        $students = $get_class->students()->with(['user:id,name,username,profile_photo_path,date_of_birth,email,role,gender,phone', 'user.profile'])->paginate(15)->onEachSide(-1);

        $assignments = $get_class->assignments()
            ->where('subject_id', $subject->id)
            ->where('user_id', auth()->id())
            ->paginate(15)->onEachSide(-1)->withQueryString();

        $syllabuses = $subject->syllabuses()
            ->with(['class', 'subject'])
            ->paginate(15)->onEachSide(-1);

        $query_online_classes = authUser()->online_classes();

        // filter
        if ($request->has('status') && $request->status != null && $request->status != 'all') {

            if ($request->status == 'upcoming') {
                $query_online_classes->where('start_time', '>=', Carbon::now()->endOfDay());
            } else {
                $query_online_classes->where('start_time', '<=', Carbon::now()->endOfDay());
            }
        }

        $online_classes = $query_online_classes->latest()->with(['subject', 'course', 'teacher'])->paginate(15)->onEachSide(-1)->withQueryString();
        $subjects = Subject::latest()->get(['id', 'name']);

        $upcoming_classes = OnlineClass::where('subject_id', $subject->id)
            ->with(['teacher', 'course'])
            ->where('start_time', '>=', Carbon::today())
            ->take(4)->get();

        $subject_teachers = $subject->teachers()->take(2)->get()->map(function ($t) {
            $t->name = $t->teacher->name;

            return $t->teacher->name ?? '';
        });

        $upcoming_assignments = $get_class->assignments()
            ->where('subject_id', $subject->id)
            ->where('start_date', '>=', Carbon::today())
            ->take(4)->get();

        $upcoming_assignments->each(function ($assignment) {
            $assignment->load(['class.students' => function ($q) {
                return $q->limit(7);
            }, 'teacher', 'subject']);
        });
        $upcoming_assignments->append(['submissions']);

        $assignments->each(function ($assignment) {
            $assignment->load(['class.students' => function ($q) {
                return $q->limit(7);
            }, 'teacher', 'subject']);
        });
        $assignments->append(['submissions']);

        $query = ClassRoutine::query();

        $schedules = $query->where('course_id', $subject->course_id)->with(['course:id,name', 'teacher:id,name', 'subject:id,name,color'])->get()
            ->transform(function ($data) {
                $data->daysOfWeek = (string) $data->weekday;
                $data->startTime = $data->start_time;
                $data->endTime = $data->end_time;
                $data->color = $data->subject->color;
                $data->title = 'Course: '.$data->course->name.'<br>'.'Teacher: '.$data->teacher->name.'<br>'.'Subject: '.$data->subject->name;

                return $data;
            });

        return inertia('Teacher/SubjectDetails', [
            'course' => $subject,
            'assignments' => $assignments,
            'students' => $students,
            'online_classes' => $online_classes,
            'request_data' => $request,
            'upcoming_classes' => $upcoming_classes,
            'subjects' => $subjects,
            'schedules' => $schedules,
            'syllabuses' => $syllabuses,
            'subject_teachers' => $subject_teachers,
            'upcoming_assignments' => $upcoming_assignments,
        ]);
    }

    public function onlineClassList(Request $request)
    {
        $user = authUser();
        if (! $user->hasRole('Teacher')) {
            abort(403);
        }

        $query = authUser()->online_classes()->with(['course:id,name', 'subject:id,name', 'teacher:id,name']);
        $authSubjects = authUser()->subjects()->get();
        $subject_id = $authSubjects->pluck('subject_id')->toArray();
        $course_ids = Subject::whereIn('id', $subject_id)->pluck('course_id')->toArray();

        // filter --> keyword
        if ($request->has('keyword') && $request->keyword != null) {
            $query->whereHas('subject', function ($q) use ($request) {
                $q->where('name', 'Like', '%'.$request->keyword.'%');
            });
        }

        // filter --> course
        if ($request->has('course') && $request->course != null) {
            $query->where('course_id', $request->course);
        }

        // filter --> subject
        if ($request->has('subject') && $request->subject != null) {
            $query->where('subject_id', $request->subject);
        }

        // filter --> status
        if ($request->has('status') && $request->status != null) {

            if ($request->status == 'upcoming') {
                $query->whereDate('start_time', '>', Carbon::now());
            } else {
                $query->whereDate('start_time', '<', Carbon::now());
            }
        }

        $data['courses'] = Course::whereIn('id', $course_ids)->get();
        $data['subjects'] = authUser()->subjects()->get()->map(function ($s) {
            return $s->subject;
        });

        $data['filter_data'] = $request;
        $data['online_classes'] = $query->latest('start_time')->paginate(15)->onEachSide(-1)->withQueryString();
        // This will replace data property of the pagination
        $data['online_classes']->setCollection($data['online_classes']->groupBy('online_class_status'));
        $data['online_classes']->append(['online_class_status']);

        return inertia('Teacher/OnlineClassList', $data);
    }

    public function onlineClass(OnlineClassCreateRequest $request)
    {
        abort_if(! userCan('online-class.create'), 403);

        if (zMeetConfig()) {
            try {
                (new CreateOnlineClassService)->create($request);

                $this->flashSuccess('Class Successfully Created');

                return back();
            } catch (Exception $e) {
                $this->flashWarning($e->getMessage());

                return back();
            }
        }

        return back();
    }

    public function onlineClassUpdate(OnlineClassCreateRequest $request, OnlineClass $class)
    {
        abort_if(! userCan('online-class.edit'), 403);

        if (zMeetConfig()) {
            try {
                (new UpdateOnlineClassService)->update($request, $class);

                $this->flashSuccess('Class Successfully update');

                return back();
            } catch (Exception $e) {
                $this->flashWarning($e->getMessage());

                return back();
            }
        }

        return back();
    }

    public function onlineClassDestroy(OnlineClass $class)
    {
        abort_if(! userCan('online-class.destroy'), 403);

        try {
            $class->delete();
            $this->delete_zoom($class->course_id);

            $this->flashSuccess('Online class deleted');

            return back();
        } catch (Exception $e) {
            $this->flashWarning($e->getMessage());

            return redirect()->back();
        }
    }
}
