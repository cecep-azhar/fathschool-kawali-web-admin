<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\ClassAttendance;

class ClassAttendanceController extends Controller
{
    // Check-in
    public function qrin(Request $request)
    {
        // Validate class_id
        $request->validate([
            'class_lists_id' => 'required|exists:class_lists,id',
        ]);

        // Save new attendance
        $attendance = new ClassAttendance;
        $attendance->user_id = $request->user()->id;
        $attendance->class_lists_id = $request->class_lists_id;
        $attendance->date = date('Y-m-d');
        $attendance->time_in = date('H:i:s');
        $attendance->save();

        return response([
            'message' => 'Checkin success',
            'attendance' => $attendance,
            'attendance_id' => $attendance->id
        ], 200);
    }

    // Check-out
    public function qrout(Request $request)
    {
        // Validate class_id
        $request->validate([
            'class_lists_id' => 'required|exists:class_lists,id',
        ]);

        // Get last attendance for the class and user
        $attendance = ClassAttendance::where('user_id', $request->user()->id)
            ->where('class_lists_id', $request->class_lists_id)
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

        return response([
            'message' => 'Checkout success',
            'attendance' => $attendance
        ], 200);
    }
}
