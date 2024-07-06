<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Http\Controllers\Controller;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->input('date');

        $currentUser = $request->user();

        if ($currentUser->role != 'Teacher') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $query = StudentAttendance::where('teacher_id', $currentUser->id)
                ->with(['student', 'subject']);

        if ($date) {
            $query->where('date', $date);
        }

        $attendance = $query->get();

        if ($attendance->isEmpty()) {
            return response()->json(['message' => 'No student has input attendance'], 404);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $attendance
        ], 200);
    }
}
