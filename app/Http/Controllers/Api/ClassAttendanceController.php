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

        $activeStatus = Setting::pluck('status')->toArray();

        // Get the class routine for the user
        $classRoutine = ClassRoutine::where('teacher_id', $user->id)
            ->where('course_id', $course->id)
            ->where('activation', $activeStatus)
            ->first();

        // Check if class routine not found
        if (!$classRoutine) {
            return response(['message' => 'Anda tidak memiliki jadwal'], 400);
        }

        // Check if course_id does not match
        if ($classRoutine->course_id !== $course->id) {
            return response(['message' => 'Anda tidak memiliki jadwal pada kelas ini'], 400);
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
            ->withProperties(['ip' => $request->ip(),
                              'user' => $user->username,
                              'time' => date('H:i')])
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
            return response(['message' => 'You cannot rate no teacher has entered today'], 400);
        }

        // Periksa apakah waktu sudah lebih dari 30 menit setelah time_out
        $timeOut = Carbon::parse($attendance->time_out);
        $now = Carbon::now();
        $minutesSinceQrout = $now->diffInMinutes($timeOut);

        if ($minutesSinceQrout > 30) {
            return response(['message' => 'You cannot rate the teacher after 30 minutes of Qrout'], 400);
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
            return response(['message' => 'You have already rated this teacher today'], 400);
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
}
