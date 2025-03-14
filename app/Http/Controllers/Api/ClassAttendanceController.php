<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\ClassAttendance;
use App\Models\Course;
use App\Models\ClassRoutine;
use App\Models\Rating;
use App\Models\Setting;
use Illuminate\Support\Carbon;

class ClassAttendanceController extends Controller
{

    // Qrin
    public function qrin(Request $request)
    {
        try {
            // Validasi input termasuk latitude & longitude
            $request->validate([
                'qr_code_id' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);

            // Ambil data lokasi dari request
            $userLatitude = $request->latitude;
            $userLongitude = $request->longitude;

            // Ambil pengaturan lokasi target
            $settings = Setting::first();
            $targetLatitude = $settings->latitude;
            $targetLongitude = $settings->longtitude;
            $radius = $settings->radius / 1000; // Konversi meter ke kilometer

            // Hitung jarak pengguna dari lokasi yang diizinkan
            $distance = round($this->calculateDistance($targetLatitude, $targetLongitude, $userLatitude, $userLongitude), 3);

            // Jika di luar radius, tolak check-in
            if ($distance > $radius) {
                return response()->json([
                    'status' => 403,
                    'message' => 'You are outside the allowed radius',
                    'data' => [
                        'distance_in_km' => $distance,
                        'location' => [
                            'latitude' => $userLatitude,
                            'longitude' => $userLongitude,
                        ],
                        'target_location' => [
                            'latitude' => $targetLatitude,
                            'longitude' => $targetLongitude,
                            'radius' => $radius,
                        ]
                    ]
                ], 403);
            }

            // Ambil data user yang sedang login
            $user = $request->user();

            // Ambil course berdasarkan QR Code
            $course = Course::where('qr_code_id', $request->qr_code_id)->first();
            if (!$course) {
                return response(['message' => 'Course not found'], 404);
            }

            // Periksa status aktif dari Setting
            $activeStatus = Setting::pluck('status')->toArray();

            // Periksa jadwal kelas pengguna
            $classRoutine = ClassRoutine::where('teacher_id', $user->id)
                ->where('course_id', $course->id)
                ->where('activation', $activeStatus)
                ->first();

            if (!$classRoutine) {
                return response(['message' => 'Anda tidak memiliki jadwal'], 400);
            }

            // Pastikan waktu saat ini dalam rentang jam pelajaran
            $currentTime = date('H:i:s');
            if ($currentTime < $classRoutine->start_time) {
                return response(['message' => 'Ini belum jam pelajaran anda'], 400);
            }
            if ($currentTime > $classRoutine->end_time) {
                return response(['message' => 'Sudah bukan jam pembelajaran anda'], 400);
            }

            // Simpan data kehadiran
            $attendance = new ClassAttendance;
            $attendance->user_id = $user->id;
            $attendance->course_id = $course->id;
            $attendance->date = date('Y-m-d');
            $attendance->time_in = $currentTime;
            $attendance->latlon_in = "$userLatitude,$userLongitude"; // Simpan lokasi saat check-in
            $attendance->save();

            // Catat aktivitas
            activity()
                ->useLog('default')
                ->causedBy(auth()->user())
                ->event('Qrin')
                ->withProperties([
                    'ip' => $request->ip(),
                    'user' => $user->username,
                    'time' => date('H:i'),
                    'latitude' => $userLatitude,
                    'longitude' => $userLongitude,
                ])
                ->log('User Qrin');

            return response([
                'message' => 'Qrin success',
                'attendance' => $attendance,
                'attendance_id' => $attendance->id,
                'distance_in_km' => $distance
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $th->getMessage()
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


    // Qrout
    public function qrout(Request $request)
    {
        try {
            // Ambil pengaturan umum
            $settings = Setting::first();
            $targetLatitude = $settings->latitude;
            $targetLongitude = $settings->longtitude;
            $radius = $settings->radius / 1000; // Konversi ke km
            $timeOutSetting = $settings->time_out; // Waktu minimal checkout

            // Validasi input
            $data_att = $request->validate([
                'qr_code_id' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);

            // Ambil course berdasarkan qr_code_id
            $course = Course::where('qr_code_id', $data_att['qr_code_id'])->first();
            if (!$course) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Course not found'
                ], 404);
            }

            // Ambil user yang sedang login
            $user = $request->user();

            // Cek apakah user memiliki attendance aktif untuk course ini
            $attendance = ClassAttendance::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->whereNotNull('time_in') // Sudah check-in
                ->whereNull('time_out')   // Belum check-out
                ->latest()
                ->first();

            if (!$attendance) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Check-in first'
                ], 401);
            }

            // Hitung jarak antara lokasi user dengan lokasi target
            $distance = round($this->calculateDistance($targetLatitude, $targetLongitude, $data_att['latitude'], $data_att['longitude']), 3);

            if ($distance > $radius) {
                return response()->json([
                    'status' => 403,
                    'message' => 'You are outside the allowed radius',
                    'data' => [
                        'user' => [
                            'user_id' => $user->id,
                            'distance_in_km' => $distance,
                            'location' => [
                                'latitude' => $data_att['latitude'],
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

            // Waktu saat ini
            $currentTime = date('H:i:s');

            // Cek apakah user memiliki izin (leave) untuk checkout lebih awal
            $hasLeave = Leave::where('user_id', $user->id)
                ->where('status', 'accepted')
                ->where('start', '<=', date('Y-m-d H:i:s'))
                ->where('end', '>=', date('Y-m-d H:i:s'))
                ->exists();

            // Cek batas waktu checkout
            if (strtotime($currentTime) < strtotime($timeOutSetting) && !$hasLeave) {
                return response()->json([
                    'status' => 402,
                    'message' => 'You cannot checkout before the allowed time unless you have an accepted leave.',
                    'data' => [
                        'user' => [
                            'user_id' => $user->id,
                            'time' => $currentTime,
                            'time_out' => $timeOutSetting,
                            'distance_in_km' => $distance,
                            'location' => [
                                'latitude' => $data_att['latitude'],
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

            // Cek apakah sudah pernah checkout
            if ($attendance->time_out !== null) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Already checked out'
                ], 400);
            }

            // Simpan waktu checkout dan lokasi
            $attendance->time_out = $currentTime;
            $attendance->latlon_out = $data_att['latitude'] . ',' . $data_att['longitude'];
            $attendance->save();

            // Logging aktivitas checkout
            activity()
                ->useLog('default')
                ->causedBy(auth()->user())
                ->event('Qrout')
                ->withProperties([
                    'ip' => $request->ip(),
                    'user' => $user->username,
                    'time' => $currentTime,
                    'latlon_out' => $attendance->latlon_out
                ])
                ->log('User Qrout');

            return response()->json([
                'status' => 200,
                'message' => 'Check-out successfully',
                'data' => [
                    'user' => [
                        'user_id' => $user->id,
                        'time' => $currentTime,
                        'distance_in_km' => $distance,
                        'location' => [
                            'latitude' => $data_att['latitude'],
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
                'error' => $th->getMessage()
            ], 500);
        }
    }

    // Check is isQrin
    public function isQrin(Request $request)
    {
        $start_time = date('H:i:s');
        $end_time = date('H:i:s');
        $today = Carbon::now()->dayOfWeek;

        $activeStatus = Setting::pluck('status')->toArray();

        $lesson = ClassRoutine::with(['teacher', 'subject', 'course'])
            ->where('teacher_id', $request->user()->id)
            ->where('weekday', $today)
            ->where('start_time', '<=', $end_time)
            ->where('end_time', '>=', $start_time)
            ->where('activation', $activeStatus)
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

    public function rating(Request $request)
    {
        // Validasi input
        $request->validate([
            'rating' => 'required|integer|min:0|max:5',
            'comment' => 'nullable|string',
        ]);

        // Dapatkan pengguna saat ini
        $user = $request->user();

        // Dapatkan daftar course_id yang diikuti oleh student
        $courseIds = $user->courses()->pluck('course_id');

        // Dapatkan attendance terbaru yang telah dilakukan qrout oleh teacher dengan course_id yang sama
        $attendance = ClassAttendance::whereIn('course_id', $courseIds)
            ->whereNotNull('time_out')
            ->latest()
            ->first();

        // Periksa apakah attendance tidak ditemukan
        if (!$attendance) {
            return response(['message' => 'Anda tidak dapat menilai, tidak ada guru yang masuk hari ini'], 400);
        }

        // Periksa apakah waktu sudah lebih dari 30 menit setelah time_out
        $timeOut = Carbon::parse($attendance->time_out);
        $now = Carbon::now();
        $minutesSinceQrout = $now->diffInMinutes($timeOut);

        if ($minutesSinceQrout > 30) {
            return response(['message' => 'Anda tidak dapat menilai guru setelah 30 menit Qrout'], 400);
        }

        // Dapatkan teacher_id dari attendance
        $teacherId = $attendance->user_id;

        // Periksa apakah rating sudah diberikan untuk teacher_id dan course_id yang sama pada hari yang sama
        $existingRating = Rating::where('student_id', $user->id)
            ->where('teacher_id', $teacherId)
            ->where('course_id', $attendance->course_id)
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($existingRating) {
            return response(['message' => 'Anda telah memberi nilai pada guru ini hari ini'], 400);
        }

        // Simpan rating baru
        $rating = new Rating();
        $rating->student_id = $user->id;
        $rating->teacher_id = $teacherId;
        $rating->course_id = $attendance->course_id;
        $rating->attendance_id = $attendance->id;
        $rating->rating = $request->rating;
        $rating->comment = $request->comment;
        $rating->save();

        return response([
            'message' => 'Rating submitted successfully',
            'rating' => [
                'id' => $rating->id,
                'teacher_id' => $rating->teacher_id,
                'course_id' => $rating->course_id,
                'attendance_id' => $rating->attendance_id,
                'rating' => $rating->rating,
                'comment' => $rating->comment,
                'created_at' => $rating->created_at->format('Y-m-d H:i:s'),
            ]
        ], 200);
    }

    public function isRating(Request $request)
    {

        // Dapatkan pengguna saat ini
        $user = $request->user();

        // Dapatkan daftar course_id yang diikuti oleh student
        $courseIds = $user->courses()->pluck('course_id');

        $now = Carbon::now();

        // Memformat tanggal menjadi YYYY-MM-DD
        $formattedDate = $now->format('Y-m-d');

        // Dapatkan attendance terbaru yang telah dilakukan qrout oleh teacher dengan course_id yang sama
        $attendance = ClassAttendance::whereIn('course_id', $courseIds)
            ->whereNotNull('time_out')
            ->where('date', $formattedDate)
            ->first();

        // Periksa apakah attendance tidak ditemukan
        if (!$attendance) {
            return response(['message' => 'Anda tidak dapat menilai, tidak ada guru yang masuk hari ini',  'status' => 'true'], 400);
        }

        // Periksa apakah waktu sudah lebih dari 30 menit setelah time_out
        $timeOut = Carbon::parse($attendance->time_out);
        $now = Carbon::now();
        $minutesSinceQrout = $now->diffInMinutes($timeOut);

        if ($minutesSinceQrout > 30) {
            return response(['message' => 'Anda tidak dapat menilai guru setelah 30 menit Qrout',  'status' => 'true'], 400);
        }

        // Dapatkan teacher_id dari attendance
        $teacherId = $attendance->user_id;

        // Periksa apakah rating sudah diberikan untuk teacher_id dan course_id yang sama pada hari yang sama
        $existingRating = Rating::where('student_id', $user->id)
            ->where('teacher_id', $teacherId)
            ->where('course_id', $attendance->course_id)
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($existingRating) {
            return response(['message' => 'Anda telah memberi nilai pada guru ini hari ini',  'status' => 'true'], 400);
        }

        return response([
            'message' => 'Anda bisa menilai guru sekarang',
            'status' => 'false'
        ], 200);
    }
}
