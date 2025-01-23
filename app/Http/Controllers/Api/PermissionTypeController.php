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
        try {
            $role = strtolower($request->user()->role);

            $School = LeaveType::where('role_type', $role)
                ->orderBy('id', 'desc')
                ->get();

            if ($School->isNotEmpty()) {
                return response()->json($School, 200);
            } else {
                return response()->json(['message' => 'School not found'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'erros' => $th->getMessage()
            ]);
        }
    }

    public function getAllPermissionType() 
    {
        try {
            $role = LeaveType::orderBy('id', 'desc')->get();

            if ($role->isNotEmpty()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Success get all role',
                    'data' => $role
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Role not found',
                    'data' => null
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'erros' => $th->getMessage()
            ]);
        }
    }

    public function getLeaveTypesByRoleType($roleType)
    {
        try {
            // Ambil semua LeaveType yang sesuai dengan role_type
            $leaveTypes = LeaveType::where('role_type', $roleType)->orderBy('id', 'desc')->get();

            if ($leaveTypes->isNotEmpty()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Success get all leave types for role',
                    'data' => $leaveTypes
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Leave types not found for this role',
                    'data' => null
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }


    public function typePermissionManual(Request $request)
    {
        try {
            // Validasi bahwa 'role' dikirimkan dalam request
            $request->validate([
                'role' => 'required|string', // Pastikan 'role' dikirimkan
            ]);

            // Ambil role dari request
            $role = strtolower($request->role); // Ubah ke lowercase untuk konsistensi

            // Cari LeaveType berdasarkan role
            $School = LeaveType::where('role_type', $role)
                ->orderBy('id', 'desc')
                ->get();

            // Periksa apakah hasilnya kosong atau tidak
            if ($School->isNotEmpty()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Success',
                    'data' => $School
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Role not found',
                    'data' => null
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }
}
