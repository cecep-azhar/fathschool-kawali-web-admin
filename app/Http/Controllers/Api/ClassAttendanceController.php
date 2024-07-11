<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\ClassAttendance;

class ClassAttendanceController extends Controller
{
    // Qrin
    public function qrin(Request $request)
    {
        // Validate class_id
        $request->validate([
            'course_id' => 'required',
        ]);

        // Save new attendance
        $attendance = new ClassAttendance;
        $attendance->user_id = $request->user()->id;
        $attendance->course_id = $request->course_id;
        $attendance->date = date('Y-m-d');
        $attendance->time_in = date('H:i:s');
        $attendance->save();

        $user = $request->user();

        activity()
        ->useLog('default')
        ->causedBy(auth()->user())
        ->event('Qrin')
        ->withProperties(['ip' => $request->ip(),
                          'user' => $user->username ])
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
        // Validate class_id
        $request->validate([
            'course_id' => 'required',
        ]);

        // Get last attendance for the class and user
        $attendance = ClassAttendance::where('user_id', $request->user()->id)
            ->where('course_id', $request->course_id)
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
        ->withProperties(['ip' => $request->ip(),
                          'user' => $user->username ])
        ->log('User Qrout');

        return response([
            'message' => 'Qrout success',
            'attendance' => $attendance
        ], 200);
    }

    //check is isQrin
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
