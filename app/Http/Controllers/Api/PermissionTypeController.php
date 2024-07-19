<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\PermissionAttendance;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\LeaveType;

class PermissionTypeController extends Controller
{
    public function index(Request $request)
    {
        $role = strtolower($request->user()->role);

        $School = LeaveType::where('role_type', $role)
                            ->orderBy('id', 'desc')
                            ->get();

        if ($School->isNotEmpty()) {
            return response()->json($School, 200);
        } else {
            return response()->json(['message' => 'School not found'], 404);
        }
    }
}
