<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttendanceStudent;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\ClassRoutine;
use App\Models\Leave;
use App\Models\Setting;
use App\Models\User;
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

    public function checkinManual(Request $request)
    {
        // Koordinat lokasi tujuan
        $settings = Setting::get()->first();
        $targetLatitude = $settings->latitude;
        $targetLongitude = $settings->longtitude;

        // Validasi input user
        $data_att = $request->validate([
            'user_id' => 'required',
            'lattitude' => 'required',
            'longitude' => 'required',
        ]);


        $userLatitude = $data_att['lattitude'];
        $userLongitude = $data_att['longitude'];

        $setting = Setting::first();
        $timeInSetting = $setting->time_in;

        $currentTime = date('H:i:s');

        $isLate = strtotime($currentTime) > strtotime($timeInSetting);

        $distance = $this->calculateDistance($targetLatitude, $targetLongitude, $userLatitude, $userLongitude);
        $radius = intval($setting->radius);
        if ($distance > $radius) {
            return response()->json([
                'status' => 403,
                'message' => 'You are outside the allowed radius',
                'distance_in_km' => $distance,
            ], 403);
        }

        $user_id = $data_att['user_id'];

        $check_user = User::where('id', $user_id)->first();

        if (!$check_user->manual) {
            return response()->json([
                'status' => 403,
                'message' => 'Access denied',
            ], 403);
        }


        $role_user = $check_user->role;
        if (!$check_user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found',
            ], 404);
        }

        if ($role_user == "Student") {
            $attendance_user = AttendanceStudent::where('user_id', $data_att['user_id'])
                ->where('date', date('Y-m-d'))
                ->first();
        } else {
            $attendance_user = Attendance::where('user_id', $data_att['user_id'])
                ->where('date', date('Y-m-d'))
                ->first();
        }

        if ($attendance_user) {
            return response(['status' => 400, 'message' => 'Already Check-in'], 400);
        }



        if ($role_user == "Student") {
            $attendance = new AttendanceStudent;

            // Cari ID yang tersedia dengan loop sampai menemukan ID yang belum digunakan
            do {
                $newId = AttendanceStudent::max('id') + 1;
            } while (AttendanceStudent::find($newId));

            $attendance->id = $newId;
            $attendance->user_id = $user_id;
            $attendance->date = date('Y-m-d');
            $attendance->time_in = $currentTime;
            $attendance->latlon_in = $userLatitude . ',' . $userLongitude;

            try {
                $attendance->save();
            } catch (\Illuminate\Database\QueryException $e) {
                // Jika masih terjadi konflik, coba lagi dengan ID baru
                if ($e->errorInfo[1] == 1062) {
                    // Recursive retry dengan increment ID
                    $attendance->id = $newId + 1;
                    $attendance->save();
                } else {
                    throw $e;
                }
            }
        } else {
            $attendance = new Attendance;

            // Ambil ID terakhir dari tabel
            $lastId = Attendance::max('id');
            $attendance->id = $lastId ? $lastId + 1 : 1;
            $attendance->user_id = $user_id;
            $attendance->date = date('Y-m-d');
            $attendance->time_in = $currentTime;
            $attendance->latlon_in = $userLatitude . ',' . $userLongitude;
            $attendance->save();
        }


        $message = 'Checkin success';
        if ($isLate) {
            $message .= ' - Anda telat hari ini';
        }

        return response()->json([
            'status' => 200,
            'message' => $message,
            'distance_in_km' => round($distance, 2),
        ], 200);
    }


    /**
     * Hitung jarak antara dua koordinat dengan Haversine Formula.
     *
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @return float Distance in kilometers
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius bumi dalam kilometer

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Hasil dalam kilometer

        return $distance;
    }

    //check is checkedin
    public function isCheckedin(Request $request)
    {

        $attendance = Attendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        $isCheckout = $attendance ? $attendance->time_out : false;

        return response([
            'checkedin' => $attendance ? true : false,
            'checkedout' => $isCheckout ? true : false,
        ], 200);
    }

    public function isCheckedinManual($user_id)
    {
        $check_user = User::where('id', $user_id)->first();
        $role_user = $check_user->role;

        if ($role_user == "Student") {
            $attendanceStudent = AttendanceStudent::where('user_id', $user_id)
                ->whereDate('date', date('Y-m-d'))
                ->first();

            $isCheckedIn = $attendanceStudent;

            $isCheckedOut = ($attendanceStudent && $attendanceStudent->time_out);
        } else {
            $attendance = Attendance::where('user_id', $user_id)
                ->whereDate('date', date('Y-m-d'))
                ->first();

            $isCheckedIn = $attendance;

            $isCheckedOut = ($attendance && $attendance->time_out);
        }

        return response([
            'checkedin' => $isCheckedIn ? true : false,
            'checkedout' => $isCheckedOut ? true : false,
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
            return response(['status' => 401, 'message' => 'Checkin first'], 401);
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
            return response(['status' => 400, 'message' => 'You cannot checkout before the allowed time unless you have an accepted leave.'], 400);
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

    public function checkoutManual(Request $request)
    {
        $settings = Setting::get()->first();
        $targetLatitude = $settings->latitude;
        $targetLongitude = $settings->longtitude;

        // Validasi input user
        $data_att = $request->validate([
            'user_id' => 'required',
            'lattitude' => 'required',
            'longitude' => 'required',
        ]);

        $user_id = $data_att['user_id'];

        $check_user = User::where('id', $user_id)->first();
        $role_user = $check_user->role;


        if ($role_user  == "Student") {
            $attendance = AttendanceStudent::where('user_id', $user_id)
                ->where('date', date('Y-m-d'))
                ->first();
        } else {

            $attendance = Attendance::where('user_id', $user_id)
                ->where('date', date('Y-m-d'))
                ->first();
        }

        $distance = $this->calculateDistance($targetLatitude, $targetLongitude, $data_att['lattitude'], $data_att['longitude']);
        $radius = intval($settings->radius);
        if ($distance > $radius) {
            return response()->json([
                'status' => 403,
                'message' => 'You are outside the allowed radius',
                'distance_in_km' => $distance,
            ], 403);
        }

        // Check if attendance not found
        if (!$attendance) {
            return response()->json([
                'status' => 401,
                'messages' => 'Check-in first',
            ], 401);
        }

        // Get the time_out setting from the Settings model
        $setting = Setting::first(); // Assume there's only one settings record
        $timeOutSetting = $setting->time_out;

        // Get the current time
        $currentTime = date('H:i:s');

        // Check if the user has an accepted leave that allows early checkout
        $hasLeave = Leave::where('user_id', $data_att['user_id'])
            ->where('status', 'accepted')
            ->where('start', '<=', date('Y-m-d H:i:s'))
            ->where('end', '>=', date('Y-m-d H:i:s'))
            ->exists();

        // Check if the user is attempting to check out before the allowed time
        if (strtotime($currentTime) < strtotime($timeOutSetting) && !$hasLeave) {
            return response()->json([
                'status' => 402,
                'messages' => 'You cannot checkout before the allowed time unless you have an accepted leave.'
            ], 402);
        }

        if ($attendance->time_out !== null) {
            return response()->json([
                'status' => 400,
                'messages' => 'Already Checkout'
            ], 400);
        }

        // Save checkout
        $attendance->time_out = $currentTime;
        $attendance->latlon_out = $data_att['lattitude'] . ',' . $data_att['longitude'];
        $attendance->save();


        return response()->json([
            'status' => 200,
            'message' => 'Check-out succesfully',
            'attendance' => $attendance,
            'distance_in_km' => round($distance, 2),
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
            $query->whereHas('courses.students', function ($query) use ($currentUser) {
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
