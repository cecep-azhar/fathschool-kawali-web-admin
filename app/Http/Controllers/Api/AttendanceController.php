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


    // * CHECK IN MANUAL
    public function checkinManual(Request $request)
    {
        try {
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

            $user_id = $data_att['user_id'];
            $userLatitude = $data_att['lattitude'];
            $userLongitude = $data_att['longitude'];

            $setting = Setting::first();
            $timeInSetting = $setting->time_in;

            $currentTime = date('H:i:s');
            $isLate = strtotime($currentTime) > strtotime($timeInSetting);

            $distance = round($this->calculateDistance($targetLatitude, $targetLongitude, $userLatitude, $userLongitude), 3); // Presisi hingga 3 desimal
            $radius = $settings->radius / 1000; // Radius disimpan dalam meter
            if ($distance > $radius) {
                return response()->json([
                    'status' => 403,
                    'message' => 'You are outside the allowed radius',
                    'data' => [
                        'user' => [
                            'user_id' => $user_id,
                            'distance_in_km' => $distance,
                            'location' => [
                                'latitude' => $data_att['lattitude'],
                                'longitude' => $data_att['longitude'],
                            ]
                        ],
                        'target_location' => [
                            'latitude' => $targetLatitude,
                            'longitude' => $targetLongitude,
                            'radius' => $radius,
                        ]
                    ]
                ], 403);
            }

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
                'message' => 'Check-in succesfully',
                'data' => [
                    'user' => [
                        'user_id' => $user_id,
                        'time_in' => $currentTime,
                        'distance_in_km' => $distance,
                        'location' => [
                            'latitude' => $data_att['lattitude'],
                            'longitude' => $data_att['longitude'],
                        ]
                    ],
                    'target_location' => [
                        'latitude' => $targetLatitude,
                        'longitude' => $targetLongitude,
                        'radius' => $radius,
                    ]
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'erros' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * * Hitung jarak antara dua koordinat dengan Haversine Formula.
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

    // * IsCheckedIn MANUAL
    public function isCheckedinManual($user_id)
    {
        try {
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

            // Check leave status
            $leaveToday = Leave::where('user_id', $user_id)
                ->whereDate('start', '<=', date('Y-m-d'))
                ->whereDate('end', '>=', date('Y-m-d'))
                ->exists();

            return response([
                'checkedin' => $isCheckedIn ? true : false,
                'checkedout' => $isCheckedOut ? true : false,
                'leave' => $leaveToday,
                'user' => [
                    'id' => $check_user->id,
                    'name' => $check_user->name,
                    'role' => $check_user->role
                ],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $th->getMessage()
            ], 500);
        }
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


    // * CHECK OUT MANUAL
    public function checkoutManual(Request $request)
    {
        try {
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

            // Check if attendance not found
            if (!$attendance) {
                return response()->json([
                    'status' => 401,
                    'messages' => 'Check-in first',
                ], 401);
            }


            // $distance = $this->calculateDistance($targetLatitude, $targetLongitude, $data_att['lattitude'], $data_att['longitude']);
            $distance = round($this->calculateDistance($targetLatitude, $targetLongitude, $data_att['lattitude'], $data_att['longitude']), 3); // Presisi hingga 3 desimal
            $radius = $settings->radius / 1000; // Jika radius disimpan dalam meter
            if ($distance > $radius) {
                return response()->json([
                    'status' => 403,
                    'message' => 'You are outside the allowed radius',
                    'data' => [
                        'user' => [
                            'user_id' => $user_id,
                            'distance_in_km' => $distance,
                            'location' => [
                                'latitude' => $data_att['lattitude'],
                                'longitude' => $data_att['longitude'],
                            ]
                        ],
                        'target_location' => [
                            'latitude' => $targetLatitude,
                            'longitude' => $targetLongitude,
                            'radius' => $radius,
                        ]
                    ]
                ], 403);
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
                    'messages' => 'You cannot checkout before the allowed time unless you have an accepted leave.',
                    'data' => [
                        'user' => [
                            'user_id' => $user_id,
                            'time' => $currentTime,
                            'time_out' => $timeOutSetting,
                            'distance_in_km' => $distance,
                            'location' => [
                                'latitude' => $data_att['lattitude'],
                                'longitude' => $data_att['longitude'],
                            ]
                        ],
                        'target_location' => [
                            'latitude' => $targetLatitude,
                            'longitude' => $targetLongitude,
                            'radius' => $radius,
                        ]
                    ]
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
                'data' => [
                    'user' => [
                        'user_id' => $user_id,
                        'time' => $currentTime,
                        'distance_in_km' => $distance,
                        'location' => [
                            'latitude' => $data_att['lattitude'],
                            'longitude' => $data_att['longitude'],
                        ]
                    ],
                    'target_location' => [
                        'latitude' => $targetLatitude,
                        'longitude' => $targetLongitude,
                        'radius' => $radius,
                    ]
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'messages' => 'Internal Server Error',
                'error' => $th->getMessage()
            ], 500);
        }
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
