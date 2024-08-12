<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\ClassRoutine;
use App\Models\Leave;
use App\Models\Setting;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //index
    public function index(Request $request)
    {
        $date = $request->input('date');

        $currentUser = $request->user();

        $query = Attendance::where('user_id', $currentUser->id);

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
        // Validate latitude and longitude
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $setting = Setting::first();
        $timeInSetting = $setting->time_in;

        $currentTime = date('H:i:s');

        $isLate = strtotime($currentTime) > strtotime($timeInSetting);

        // Save new attendance
        $attendance = new Attendance;
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
            ->withProperties([
                'ip' => $request->ip(),
                'user' => $user->username,
                'time' => date('H:i')
            ])
            ->log('User Check In');

        $message = 'Checkin success';
        if ($isLate) {
            $message .= ' - Anda telat hari ini';
        }

        return response([
            'message' => $message,
            'attendance' => $attendance
        ], 200);
    }


    //check is checkedin
    public function isCheckedin(Request $request)
    {
        //get today attendance
        $attendance = Attendance::where('user_id', $request->user()->id)
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
        $attendance = Attendance::where('user_id', $request->user()->id)
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



    public function checkUpcomingClass(Request $request)
    {
        $currentUser = $request->user();

        // Pastikan user adalah Teacher atau Student
        if (!in_array($currentUser->role, ['Teacher', 'Student'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Dapatkan waktu sekarang
        $now = Carbon::now();
        $nowWeekday = $now->dayOfWeek;
        $nowTime = $now->format('H:i:s');

        // Dapatkan waktu 30 menit ke depan
        $next30Minutes = Carbon::now()->addMinutes(20)->format('H:i:s');

        // Definisikan hari dalam seminggu
        $weekdays = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu'
        ];

        $activeStatus = Setting::pluck('status')->toArray();

        // Cari jadwal pelajaran yang dimulai dalam 20 menit ke depan
        $query = ClassRoutine::where('weekday', $nowWeekday)
            ->where('start_time', '>=', $nowTime)
            ->where('start_time', '<=', $next30Minutes)
            ->where('activation', $activeStatus);

        if ($currentUser->role == 'Teacher') {
            $query->where('teacher_id', $currentUser->id);
        } else {
            $query->whereHas('courses.students', function($query) use ($currentUser) {
                $query->where('students.id', $currentUser->id);
            });
        }

        $upcomingClass = $query->first();

        if ($upcomingClass) {
            return response()->json([
                'message' => 'Upcoming class found within the next 20 minutes',
                'class' => [
                    'course_id' => $upcomingClass->course_id,
                    'start_time' => $upcomingClass->start_time,
                    'end_time' => $upcomingClass->end_time,
                    'weekday' => $weekdays[$upcomingClass->weekday],
                ],
                'current_time' => $now->toDateTimeString()
            ], 200);
        } else {
            return response()->json([
                'message' => 'No upcoming class within the next 20 minutes',
                'current_time' => $now->toDateTimeString()
            ], 200);
        }
    }

}
