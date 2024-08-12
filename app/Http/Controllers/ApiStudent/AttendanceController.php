<?php

namespace App\Http\Controllers\ApiStudent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttendanceStudent;
use App\Models\Leave;
use App\Models\Setting;

class AttendanceController extends Controller
{
    //index
    public function index(Request $request)
    {
        $date = $request->input('date');

        $currentUser = $request->user();

        $query = AttendanceStudent::where('user_id', $currentUser->id);

        if ($date) {
            $query->where('date', $date);
        }

        $attendance = $query->get();

        return response([
            'message' => 'Success',
            'data' => $attendance
        ], 200);
    }

    //checkin
    public function checkin(Request $request)
    {
        //validate lat and long
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $setting = Setting::first();
        $timeInSetting = $setting->time_in;

        $currentTime = date('H:i:s');

        $isLate = strtotime($currentTime) > strtotime($timeInSetting);

        //save new attendance
        $attendance = new AttendanceStudent;
        $attendance->user_id = $request->user()->id;
        $attendance->date = date('Y-m-d');
        $attendance->time_in = $currentTime;
        $attendance->latlon_in = $request->latitude . ',' . $request->longitude;
        $attendance->save();

        $user = $request->user();

        activity()
        ->useLog('default')
        ->causedBy(auth()->user())
        ->event('checkin')
        ->withProperties(['ip' => $request->ip(),
                          'user' => $user->username,
                          'time' => date('H:i')])

        ->log('User Check In');

        $message = 'Checkin success';
        if ($isLate) {
            $message .= ' - Anda telat hari ini';
        }

        return response([
            'message' => 'Checkin success',
            'attendance' => $attendance
        ], 200);
    }

    //check is checkedin
    public function isCheckedin(Request $request)
    {
        //get today attendance
        $attendance = AttendanceStudent::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        $isCheckout = $attendance ? $attendance->time_out : false;

        return response([
            'checkedin' => $attendance ? true : false,
            'checkedout' => $isCheckout ? true : false,
        ], 200);
    }

    //checkout
    public function checkout(Request $request)
    {
        // Validate latitude and longitude
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Get today's attendance
        $attendance = AttendanceStudent::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        // Check if attendance not found
        if (!$attendance) {
            return response(['message' => 'Checkin first'], 400);
        }

        // Get the time_out setting from the Settings model
        $setting = Setting::first(); // Assume there's only one settings record
        $timeOutSetting = $setting->time_out;

        // Get the current time
        $currentTime = date('H:i:s');

        // Check if the user has an accepted leave that allows early checkout
        $hasLeave = Leave::where('user_id', $request->user()->id)
            ->where('status', 'accepted')
            ->where('start', '<=', date('Y-m-d H:i:s'))
            ->where('end', '>=', date('Y-m-d H:i:s'))
            ->exists();

        // Check if the user is attempting to check out before the allowed time
        if (strtotime($currentTime) < strtotime($timeOutSetting) && !$hasLeave) {
            return response(['message' => 'You cannot checkout before the allowed time unless you have an accepted leave.'], 400);
        }

        // Save checkout
        $attendance->time_out = $currentTime;
        $attendance->latlon_out = $request->latitude . ',' . $request->longitude;
        $attendance->save();

        $user = $request->user();

        activity()
            ->useLog('default')
            ->causedBy(auth()->user())
            ->event('checkout')
            ->withProperties([
                'ip' => $request->ip(),
                'user' => $user->username,
                'time' => date('H:i')
            ])
            ->log('User Check Out');

        return response([
            'message' => 'Checkout success',
            'attendance' => $attendance
        ], 200);
    }

}
