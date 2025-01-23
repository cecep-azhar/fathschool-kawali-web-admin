<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\PermissionAttendance;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;

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
            'leave_type_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // validasi untuk gambar, max 2MB
        ]);

        // Cek apakah user sudah memiliki leave yang aktif pada hari ini
        $today = date('Y-m-d');
        $existingLeave = Leave::where('user_id', $request->user()->id)
            ->where('start', '<=', $today)
            ->where('end', '>=', $today)
            ->where('status', '!=', 'rejected')
            ->exists();

        if ($existingLeave) {
            return response()->json([
                'message' => 'You already have an active leave during this period.'
            ], 400);
        }

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

    public function leaveManual(Request $request)
    {
        try {
            // Validasi request
            $request->validate([
                'user_id' => 'required|integer', 
                'leave_type_id' => 'required|integer',
                'title' => 'required|string|max:255',
                'start' => 'required|date',
                'end' => 'required|date',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg',
            ]);

            $user = User::find($request->user_id);

            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found',
                    'data' => null
                ], 404);
            }

            // Cek apakah user sudah memiliki leave yang aktif pada hari ini
            $today = date('Y-m-d');
            $existingLeave = Leave::where('user_id', $user->id)
                ->where('start', '<=', $today)
                ->where('end', '>=', $today)
                ->where('status', '!=', 'rejected')
                ->exists();

            if ($existingLeave) {
                return response()->json([
                    'status' => 400,
                    'message' => 'You already have an active leave during this period.',
                    'data' => null
                ], 400);
            }

            // Buat instance Leave baru
            $leave = new Leave();
            $leave->user_id = $user->id;
            $leave->leave_type_id = $request->leave_type_id;
            // $leave->name_type_leave = $request->role_type;
            $leave->title = $request->title;
            $leave->start = $request->start;
            $leave->end = $request->end;
            $leave->status = 'pending';
            $leave->description = $request->description;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image->storeAs('public/leaves', $image->hashName());
                $leave->image = $image->hashName();
            }

            $leave->save();

            return response()->json([
                'status' => 201,
                'message' => 'Leave request created successfully',
                'data' => $leave
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'message' => 'Internal server error',
                'errors' => $th->getMessage()
            ], 400);
        }
    }
}
