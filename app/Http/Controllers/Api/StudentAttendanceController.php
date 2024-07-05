<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Models\User;
use App\Models\Subject;
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
        $user = $request->user();

        if ($user->role != 'Teacher') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $attendances = StudentAttendance::where('teacher_id', $user->id)
                        ->with(['student', 'subject'])
                        ->get();

        return response()->json($attendances);
    }
}
