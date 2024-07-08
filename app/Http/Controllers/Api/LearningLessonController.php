<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LearningLesson;
use App\Models\ClassRoutine;
use Illuminate\Http\Request;

class LearningLessonController extends Controller
{
    public function getLessonsByTeacher(Request $request)
    {
        $user = $request->user();

        // Pastikan user memiliki role teacher
        if ($user->role !== 'Teacher') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Ambil data learning_lessons berdasarkan user yang sedang login
        $lessons = ClassRoutine::with(['teacher', 'subject', 'course'])
            ->where('teacher_id', $user->id)
            ->get();

        // Format data
        $formattedLessons = $lessons->map(function ($lesson) {
            return [
                'teacher_id' => $lesson->teacher->id,
                'teacher_name' => $lesson->teacher->name,
                'subject_id' => $lesson->subject->id,
                'subject_name' => $lesson->subject->name,
                'class_id' => $lesson->course->id,
                'class_name' => $lesson->course->name,
                'time_in' => $lesson->start_time,
                'time_out' => $lesson->end_time,
            ];
        });

        return response()->json(['lessons' => $formattedLessons], 200);
    }
}
