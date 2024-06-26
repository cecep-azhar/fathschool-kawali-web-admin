<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = authUser();
        if (! $user->hasRole('Teacher')) {
            abort(403);
        }

        $query = User::query()->active()->student()->latest()->with('profile');

        // class filter
        if ($request->has('subject') && $request->subject != null) {

            $subject = Subject::where('id', $request->subject)->first();
            $subject_course_id = $subject->course_id;

            $query->whereHas('courses', function ($q) use ($subject_course_id) {
                $q->where('course_id', $subject_course_id);
            });
        }

        if ($request->keyword != null || $request->subject != null) {
            $students = $query->paginate(15)->onEachSide(-1);

            $students->each(function ($student) {
                $student->load(['attendances' => function ($q) {

                    if (request()->has('date') && request()->date != null) {
                        $now = date('Y-m-d', strtotime(request()->date));
                    } else {
                        $now = date('Y-m-d', strtotime(Carbon::now()));
                    }

                    return $q->where('date', $now);
                }]);
            });
        } else {
            $students = [];
        }
        $subjects = authUser()->subjects()->with('subject')->get()
            ->map(function ($item, $key) {
                return $item->subject;
            });

        return inertia('Teacher/Attendance', [
            'students' => $students,
            'subjects' => $subjects,
            'filter_data' => $request,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(! userCan('attendance.create'), 403);
        $request->validate([
            'student' => 'required',
        ]);
        if ($request->status == 'late') {
            $request->validate([
                'late_minutes' => 'required|integer',
            ]);
        }

        $date = $request->date ? date('Y-m-d', strtotime($request->date)) : date('Y-m-d', strtotime(Carbon::now()));

        $today_exist_data = StudentAttendance::where('date', $date)->where('student_id', $request->student)->where('subject_id', $request->subject)->first();

        if ($today_exist_data) {

            $today_exist_data->update([
                'status' => $request->status,
                'late_amount' => $request->late_minutes,
                'teacher_id' => auth()->id(),
                'subject_id' => $request->subject,
            ]);
        } else {
            StudentAttendance::create([
                'student_id' => $request->student,
                'status' => $request->status,
                'date' => Carbon::parse($date),
                'late_amount' => $request->late_minutes,
                'teacher_id' => auth()->id(),
                'subject_id' => $request->subject,
            ]);
        }

        if ($today_exist_data) {
            $this->flashSuccess('Student Attendance updated');
        } else {
            $this->flashSuccess('Student Attendance created');
        }

        return back();
    }
}
