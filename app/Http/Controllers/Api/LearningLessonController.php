<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassRoutine;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LearningLessonController extends Controller
{
    public function getLessonsByTeacher(Request $request)
    {
        $user = $request->user();
        $today = Carbon::now()->dayOfWeek;
        $start_time = date('H:i:s');
        $end_time = date('H:i:s');

        // Pastikan user memiliki role teacher
        if ($user->role !== 'Teacher') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $activeStatus = Setting::pluck('status')->toArray();

        // Ambil data learning_lessons berdasarkan user yang sedang login
        $lesson = ClassRoutine::with(['teacher', 'subject', 'course'])
                            ->where('teacher_id', $user->id)
                            ->where('weekday', $today)
                            ->where('start_time', '<=', $end_time)
                            ->where('end_time', '>=', $start_time)
                            ->where('activation', $activeStatus)
                            ->first();


            // dd($lesson);

        if (!$lesson) {
            return response()->json(['message' => 'Anda tidak memiliki jadwal'], 400);
        }

        // Check if current time is within the lesson time range
        $currentTime = Carbon::now();
        if ($currentTime < Carbon::parse($lesson->start_time)) {
            return response()->json(['message' => 'Ini belum jam pelajaran anda'], 400);
        }

        if ($currentTime > Carbon::parse($lesson->end_time)) {
            return response()->json(['message' => 'Sudah bukan jam pembelajaran anda'], 400);
        }

        // Format data
        $formattedLesson = [
            'lessons' => [
                [
                    'teacher_id' => $lesson->teacher->id,
                    'teacher_name' => $lesson->teacher->name,
                    'subject_id' => $lesson->subject->id,
                    'subject_name' => $lesson->subject->name,
                    'class_id' => $lesson->course->id,
                    'class_name' => $lesson->course->name,
                    'qr_code_id' => $lesson->course->qr_code_id,
                    'time_in' => Carbon::parse($lesson->start_time)->format('H:i'),
                    'time_out' => Carbon::parse($lesson->end_time)->format('H:i'),
                ]
            ]
        ];

        return response()->json($formattedLesson, 200);
    }
}
