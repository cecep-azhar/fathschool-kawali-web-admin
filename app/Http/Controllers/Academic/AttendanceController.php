<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller
{
    /**
     * Show the form for creating a new attendance record.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Fetch all users to display in the dropdown
        $users = User::all(['id', 'name']);

        return inertia('Admin/AttendanceAdd/Form', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created attendance record in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'user' => 'required|exists:users,id',
            'date' => 'required|date',
            'time_in' => 'required|date_format:H:i',
            'latlon_in' => 'required|string',
            'time_out' => 'nullable|date_format:H:i',
            'latlon_out' => 'nullable|string',
        ]);

        // Create a new attendance record
        Attendance::create([
            'user_id' => $request->user,
            'date' => $request->date,
            'time_in' => $request->time_in,
            'latlon_in' => $request->latlon_in,
            'time_out' => $request->time_out,
            'latlon_out' => $request->latlon_out,
        ]);

        return redirect()->route('attendance.create')->with('success', 'Attendance record created successfully.');
    }
}
