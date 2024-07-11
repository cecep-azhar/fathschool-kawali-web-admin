<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\ClassAttendance;
use App\Models\Course;

class ClassAttendanceController extends Controller
{
    // Check-in
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

        // Save new attendance
        $attendance = new ClassAttendance;
        $attendance->user_id = $request->user()->id;
        $attendance->course_id = $course->id;
        $attendance->date = date('Y-m-d');
        $attendance->time_in = date('H:i:s');
        $attendance->save();

        $user = $request->user();

        activity()
            ->useLog('default')
            ->causedBy(auth()->user())
            ->event('Qrin')
            ->withProperties(['ip' => $request->ip(), 'user' => $user->username])
            ->log('User Qrin');

        return response([
            'message' => 'Qrin success',
            'attendance' => $attendance,
            'attendance_id' => $attendance->id
        ], 200);
    }

    // Check-out
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

        // Get last attendance for the class and user
        $attendance = ClassAttendance::where('user_id', $request->user()->id)
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

        $user = $request->user();

        activity()
            ->useLog('default')
            ->causedBy(auth()->user())
            ->event('Qrout')
            ->withProperties(['ip' => $request->ip(), 'user' => $user->username])
            ->log('User Qrout');

        return response([
            'message' => 'Qrout success',
            'attendance' => $attendance
        ], 200);
    }

    //check is checkedin
    public function isQrin(Request $request)
    {
        //get today attendance
        $attendance = ClassAttendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        $isCheckout = $attendance ? $attendance->time_out : false;

        return response([
            'checkedin' => $attendance ? true : false,
            'checkedout' => $isCheckout ? true : false,
        ], 200);
    }
}
