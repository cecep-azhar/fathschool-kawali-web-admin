<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassRoutine\ClassRoutineCreateRequest;
use App\Http\Requests\Admin\ClassRoutine\ClassRoutineUpdateRequest;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\WorkingDays;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ClassRoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!userCan('academic.management'), 403);

        $routines = ClassRoutine::latest()->with(['course', 'teacher', 'subject'])->paginate(15)->onEachSide(-1);

        $query = ClassRoutine::query()->where(function ($q) {
            $now = Carbon::now()->format('Y-m-d');
            $q->where('start_date', '<=', $now)
                ->orWhere('start_date', null);
        });

        if ($request->has('course_id') && $request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }
        if ($request->has('subject_id') && $request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
        if ($request->has('teacher_id') && $request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        // Menyaring berdasarkan nilai activation yang sesuai dengan status di tabel activation
        $activationStatus = Setting::pluck('status')->toArray();
        $query->whereIn('activation', $activationStatus);

        $schedules = $query->with(['course:id,name', 'teacher:id,name', 'subject:id,name,color', 'setting'])->get()
            ->transform(function ($data) {
                $data->daysOfWeek = (string) $data->weekday;
                $data->startTime = $data->start_time;
                $data->endTime = $data->end_time;
                $data->color = $data->subject->color;
                $data->title = 'Course: ' . $data->course->name . '<br>' . 'Teacher: ' . $data->teacher->name . '<br>' . 'Subject: ' . $data->subject->name . '<br>Time: ' . Carbon::parse($data->start_time)->format('h:i') . ' - ' . Carbon::parse($data->end_time)->format('h:i A');
                $data->hiddenDays = [1, 2, 3];

                return $data;
            });

        return inertia('Admin/Routine/Index', [
            'routines' => $routines,
            'schedules' => $schedules,
            'classes' => Course::get(['id', 'name']),
            'teachers' => User::teacher()->get(['id', 'name']),
            'query' => $request,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!userCan('academic.management'), 403);

        $days = WorkingDays::first();
        $workdays = [];
        if ($days->sunday) {
            $workdays[0] = 'Sunday';
        }
        if ($days->monday) {
            $workdays[1] = 'Monday';
        }
        if ($days->tuesday) {
            $workdays[2] = 'Tuesday';
        }
        if ($days->wednesday) {
            $workdays[3] = 'Wednesday';
        }
        if ($days->thursday) {
            $workdays[4] = 'Thursday';
        }
        if ($days->friday) {
            $workdays[5] = 'Friday';
        }
        if ($days->saturday) {
            $workdays[6] = 'Saturday';
        }


        $teachers = User::active()->teacher()->latest()->get()->map(function ($teacher) {
            $teacher->courses = $this->teacherCourses($teacher);
            return $teacher;
        });

        $teacherSubjects = TeacherSubject::with(['subject:id,name,course_id'])->latest()->get();

        $transformedSubjects = $teacherSubjects->map(function ($subject) {
            return [
                'id' => $subject->id,
                'teacher_id' => $subject->teacher_id,
                'subject_id' => $subject->subject_id,
                'created_at' => $subject->created_at,
                'updated_at' => $subject->updated_at,
                'name' => $subject->subject->name,
                'course_id' => $subject->subject->course_id,
            ];
        });

        return inertia('Admin/Routine/Form', [
            'teachers' => $teachers,
            'courses' => Course::latest()->get(),
            'subjects' => $transformedSubjects,
            'workdays' => $workdays,
        ]);
    }

    /**
     * Get all courses for a teacher from there subjects.
     *
     * @return array
     */
    public function teacherCourses(User $teacher)
    {
        $courses = $teacher->subjects()->with(['subject'])->get()->pluck('subject.course_id');
        return $courses;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ClassRoutineCreateRequest $request)
    {
        isWeekend($request->weekday);
        abort_if(!userCan('academic.management'), 403);

        ClassRoutine::create([
            'teacher_id' => $request->teacher,
            'course_id' => $request->class,
            'subject_id' => $request->subject,
            'weekday' => $request->weekday,
            'activation' => $request->activation,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        $this->flashSuccess('Class routine successfully created');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoutine $routine)
    {
        abort_if(!userCan('academic.management'), 403);

        $routine->load('Course');
        $routines = ClassRoutine::where('course_id', $routine->course_id)->latest()->with('course', 'teacher', 'subject')->get();

        $weekDays = ClassRoutine::WEEK_DAYS;
        $calendarData = $this->generateCalendarData($weekDays, $routines);

        return inertia('Admin/Routine/Show', [
            'weekDays' => $weekDays,
            'calendarData' => $calendarData,
            'routine' => $routine,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoutine $routine)
    {
        abort_if(!userCan('academic.management'), 403);

        $days = WorkingDays::first();
        $workdays = [];
        if ($days->sunday) {
            $workdays[0] = 'Sunday';
        }
        if ($days->monday) {
            $workdays[1] = 'Monday';
        }
        if ($days->tuesday) {
            $workdays[2] = 'Tuesday';
        }
        if ($days->wednesday) {
            $workdays[3] = 'Wednesday';
        }
        if ($days->thursday) {
            $workdays[4] = 'Thursday';
        }
        if ($days->friday) {
            $workdays[5] = 'Friday';
        }
        if ($days->saturday) {
            $workdays[6] = 'Saturday';
        }

        $teachers = User::active()->teacher()->latest()->get()->map(function ($teacher) {
            $teacher->courses = $this->teacherCourses($teacher);
            return $teacher;
        });

        $teacherSubjects = TeacherSubject::with(['subject:id,name,course_id'])->latest()->get();

        $transformedSubjects = $teacherSubjects->map(function ($subject) {
            return [
                'id' => $subject->id,
                'teacher_id' => $subject->teacher_id,
                'subject_id' => $subject->subject_id,
                'created_at' => $subject->created_at,
                'updated_at' => $subject->updated_at,
                'name' => $subject->subject->name,
                'course_id' => $subject->subject->course_id,
            ];
        });

        return inertia('Admin/Routine/Form', [
            'teachers' => $teachers,
            'courses' => Course::latest()->get(),
            'subjects' => $transformedSubjects,
            'workdays' => $workdays,
            'routine' => $routine,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ClassRoutineUpdateRequest $request, ClassRoutine $routine)
    {
        abort_if(!userCan('academic.management'), 403);

        if ($request->event == 'only_me') {

            ClassRoutine::create([
                'teacher_id' => $request->teacher ?? $routine->teacher_id,
                'course_id' => $request->class ?? $routine->course_id,
                'subject_id' => $request->subject ?? $routine->subject_id,
                'weekday' => $request->weekday ?? $routine->weekday,
                'activation' => $request->activation ?? $routine->activation,
                'start_time' => $request->start_time ?? $routine->start_time,
                'end_time' => $request->end_time ?? $routine->end_time,
                'is_recurring' => false,
            ]);

            $next_week_start_date = Carbon::now()->nextWeekendDay()->addDays(2);
            $routine->update([
                'start_date' => $next_week_start_date,
            ]);
        } else {
            $routine->update([
                'teacher_id' => $request->teacher ?? $routine->teacher_id,
                'course_id' => $request->class ?? $routine->course_id,
                'subject_id' => $request->subject ?? $routine->subject_id,
                'weekday' => $request->weekday ?? $routine->weekday,
                'activation' => $request->activation ?? $routine->activation,
                'start_time' => $request->start_time ?? $routine->start_time,
                'end_time' => $request->end_time ?? $routine->end_time,
            ]);
        }

        if ($request->type == 'api') {
            return $request;
        } else {
            $this->flashSuccess('Class routine successfully updated');

            return redirect()->route('routine.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        abort_if(!userCan('academic.management'), 403);

        try {
            $event = ClassRoutine::where('id', $request->id)->first();
            if ($event) {
                if ($request->event == 'all_events') {
                    $event->delete();
                } else {
                    $next_week_start_date = Carbon::now()->nextWeekendDay()->addDays(2);
                    $event->update([
                        'start_date' => $next_week_start_date,
                    ]);
                }
            }
            $this->flashSuccess('Schedule successfully deleted');

            return back();
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ClassRoutine $routine)
    {
        abort_if(!userCan('academic.management'), 403);

        $routine->delete();

        $this->flashSuccess('Class routine successfully deleted');

        return back();
    }

    /**
     * Generate calendar data
     *
     * @param  object  $weekdays
     * @return \Illuminate\Http\Response
     */
    public function generateCalendarData($weekDays, $lessons)
    {
        $calendarData = [];
        $timeRange = $this->generateTimeRange(config('templatecookie.calendar.start_time'), config('templatecookie.calendar.end_time'));

        foreach ($timeRange as $time) {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekDays as $index => $day) {
                $lesson = $lessons->where('weekday', $index)->where('start_time', $time['start'])->first();

                if ($lesson) {
                    array_push($calendarData[$timeText], [
                        'class_name' => $lesson->course->name,
                        'teacher_name' => $lesson->teacher->name,
                        'subject_name' => $lesson->subject->name,
                        'rowspan' => $lesson->difference / 30 ?? '',
                        'time' => $lesson->start_time . ' - ' . $lesson->end_time,
                    ]);
                } elseif (!$lessons->where('weekday', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count()) {
                    array_push($calendarData[$timeText], 1);
                } else {
                    array_push($calendarData[$timeText], 0);
                }
            }
        }

        return $calendarData;
    }

    /**
     * Generate time range
     *
     * @param  FromTo  $from $to
     * @return \Illuminate\Http\Response
     */
    public function generateTimeRange($from, $to)
    {
        $time = Carbon::parse($from);
        $timeRange = [];

        do {
            array_push($timeRange, [
                'start' => $time->format('H:i'),
                'end' => $time->addMinutes(30)->format('H:i'),
            ]);
        } while ($time->format('H:i') !== $to);

        return $timeRange;
    }

    /**
     * Refresh class routines
     *
     * @return \Illuminate\Http\Response
     */
    public function refreshRoutines()
    {
        return ClassRoutine::with(['course:id,name', 'teacher:id,name', 'subject:id,name,color'])->get()
            ->transform(function ($data) {
                $data->daysOfWeek = (string) $data->weekday;
                $data->startTime = $data->start_time;
                $data->endTime = $data->end_time;
                $data->color = $data->subject->color;
                $data->title = 'Course: ' . $data->course->name . '<br>' . 'Teacher: ' . $data->teacher->name . '<br>' . 'Subject: ' . $data->subject->name;

                return $data;
            });
    }

    /**
     * Fetch routine wise teacher, class and subject
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchRoutineDetails(ClassRoutine $routine)
    {
        return $routine;
    }
}
