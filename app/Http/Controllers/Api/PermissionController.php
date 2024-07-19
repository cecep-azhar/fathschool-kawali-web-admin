<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\PermissionAttendance;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\LeaveType;

class PermissionController extends Controller
{

    public function index(Request $request)
    {
        $School = Leave::where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();

        if ($School) {
            return response()->json($School, 200);
        } else {
            return response()->json(['message' => 'School not found'], 404);
        }
    }

    //create
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'leave_type_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    // Validasi leave_type_id berdasarkan role_type teacher
                    $leaveType = LeaveType::where('id', $value)
                        ->where('role_type', 'teacher')
                        ->first();

                    if (!$leaveType) {
                        $fail('The selected leave type is invalid for teachers.');
                    }
                },
            ],
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            // 'status' => 'required|in:pending,accepted,rejected',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // validasi untuk gambar, max 2MB
        ]);

        // Buat instance Leave baru
        $leave = new Leave();
        $leave->user_id = $request->user()->id;
        $leave->leave_type_id = $request->leave_type_id;
        $leave->title = $request->title;
        $leave->start = $request->start;
        $leave->end = $request->end;
        $leave->status = 'pending';
        $leave->description = $request->description;

        // Penanganan file gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/leaves', $image->hashName());
            $leave->image = $image->hashName();
        }

        // Simpan data ke database
        $leave->save();

        // Buat aktivitas log
        $user = $request->user();
        activity()
            ->useLog('default')
            ->causedBy(auth()->user())
            ->event('makePermission')
            ->withProperties([
                'ip' => $request->ip(),
                'user' => $user->username,
                'time' => date('H:i')
            ])
            ->log('User made a leave request');

        // Kembalikan respons
        return response()->json(['message' => 'Leave request created successfully'], 201);
    }

    public function show(Request $request, $id)
    {
        $School = Leave::where('user_id', $request->user()->id)->where('id', $id)->first();

        if ($School) {
            return response()->json($School, 200);
        } else {
            return response()->json(['message' => 'School not found'], 404);
        }
    }

}
