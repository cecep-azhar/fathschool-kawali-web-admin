<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\ClassAttendance;
use App\Models\Course;
use App\Models\ClassRoutine;
use Illuminate\Support\Carbon;

class ClassAttendanceController extends Controller
{
    // Qrin
    public function qrin(Request $request)
    {
        // Validate qr_code_id
        $request->validate([
            'qr_code_id' => 'required',
        ]);

        // Get the course by qr_code_id
        $course = Course::where('qr_code_id', $request->qr_code_id)->first();

        // Check if course not found
        if (!$course) {
            return response(['message' => 'Course not found'], 404);
        }

        // Get the current user
        $user = $request->user();

        // Get today's weekday (0 = Sunday, 6 = Saturday)
        $today = date('w');  // This will give you today's day of the week

        // Get the class routine for the user
        $classRoutine = ClassRoutine::where('teacher_id', $user->id)
            ->where('course_id', $course->id)
            ->where('weekday', $today)
            ->first();

        // Check if class routine not found
        if (!$classRoutine) {
            return response(['message' => 'Anda tidak memiliki jadwal'], 400);
        }

        // Check if time_in is before start_time
        if (date('H:i:s') < $classRoutine->start_time) {
            return response(['message' => 'Ini belum jam pelajaran anda'], 400);
        }

        // Check if time_in is after end_time
        if (date('H:i:s') > $classRoutine->end_time) {
            return response(['message' => 'Sudah bukan jam pembelajaran anda'], 400);
        }

        // Save new attendance
        $attendance = new ClassAttendance;
        $attendance->user_id = $user->id;
        $attendance->course_id = $course->id;
        $attendance->date = date('Y-m-d');
        $attendance->time_in = date('H:i:s');
        $attendance->save();

        activity()
            ->useLog('default')
            ->causedBy(auth()->user())
            ->event('Qrin')
            ->withProperties([
                'ip' => $request->ip(),
                'user' => $user->username,
                'time' => date('H:i')
            ])
            ->log('User Qrin');

        return response([
            'message' => 'Qrin success',
            'attendance' => $attendance,
            'attendance_id' => $attendance->id
        ], 200);
    }


    // Qrout
    public function qrout(Request $request)
    {
        // Validate qr_code_id
        $request->validate([
            'qr_code_id' => 'required',
        ]);

        // Get the course by qr_code_id
        $course = Course::where('qr_code_id', $request->qr_code_id)->first();

        // Check if course not found
        if (!$course) {
            return response(['message' => 'Course not found'], 404);
        }

        // Get the current user
        $user = $request->user();

        // Get last attendance for the class and user
        $attendance = ClassAttendance::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->whereNotNull('time_in')
            ->whereNull('time_out')
            ->latest()
            ->first();

        // Check if attendance not found
        if (!$attendance) {
            return response(['message' => 'No active attendance found for this class'], 400);
        }

        // Save checkout
        $attendance->time_out = date('H:i:s');
        $attendance->save();

        activity()
            ->useLog('default')
            ->causedBy(auth()->user())
            ->event('Qrout')
            ->withProperties(['ip' => $request->ip(),
                              'user' => $user->username,
                              'time' => date('H:i')])
            ->log('User Qrout');

        return response([
            'message' => 'Qrout success',
            'attendance' => $attendance
        ], 200);
    }

    // Check is isQrin
    public function isQrin(Request $request)
    {
        $start_time = date('H:i:s');
        $end_time = date('H:i:s');
        $today = Carbon::now()->dayOfWeek;

        $lesson = ClassRoutine::with(['teacher', 'subject', 'course'])
            ->where('teacher_id', $request->user()->id)
            ->where('weekday', $today)
            ->where('start_time', '<=', $end_time)
            ->where('end_time', '>=', $start_time)
            ->first();

            // dd($lesson);

        // Get today's attendance
        $attendance = ClassAttendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->where('course_id', $lesson->course_id)
            ->first();

        

        $isCheckout = $attendance ? $attendance->time_out : false;

        return response([
            'checkedin' => $attendance ? true : false,
            'checkedout' => $isCheckout ? true : false,
        ], 200);
    }
}
