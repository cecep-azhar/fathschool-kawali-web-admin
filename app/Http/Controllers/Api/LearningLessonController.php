<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LearningLesson;
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
        $lessons = LearningLesson::with(['user', 'subject', 'classList'])
            ->where('user_id', $user->id)
            ->get();

        // Format data
        $formattedLessons = $lessons->map(function ($lesson) {
            return [
                'teacher_id' => $lesson->user->id,
                'teacher_name' => $lesson->user->name,
                'subject_id' => $lesson->subject->id,
                'subject_name' => $lesson->subject->name,
                'class_id' => $lesson->classList->id,
                'class_name' => $lesson->classList->name,
                'time_in' => $lesson->time_in,
                'time_out' => $lesson->time_out,
            ];
        });

        return response()->json(['lessons' => $formattedLessons], 200);
    }
}
