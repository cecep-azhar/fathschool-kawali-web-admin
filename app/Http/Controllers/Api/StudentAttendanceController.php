<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Models\Api\StudentList;
use App\Models\Api\ClassList;
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

        // Ambil data kehadiran siswa berdasarkan guru (teacher_id)
        $attendances = StudentAttendance::where('teacher_id', $currentUser->id)
            ->with(['student:id,name', 'subject:id,name'])
            ->get();

        // Jika tanggal (date) spesifik diberikan, filter berdasarkan tanggal
        if ($date) {
            $attendances->where('date', $date);
        }

        // Cek jika tidak ada data kehadiran
        if ($attendances->isEmpty()) {
            return response()->json(['message' => 'No student has input attendance'], 404);
        }

        // Inisialisasi variabel untuk menghitung jumlah status kehadiran
        $presentCount = 0;
        $absentCount = 0;
        $lateCount = 0;

        // Loop untuk menghitung jumlah status kehadiran
        foreach ($attendances as $attendance) {
            switch ($attendance->status) {
                case 'present':
                    $presentCount++;
                    break;
                case 'absent':
                    $absentCount++;
                    break;
                case 'late':
                    $lateCount++;
                    break;
                // Default case jika status tidak sesuai dengan present, absent, atau late
                default:
                    break;
            }
        }

        // Ambil nama kelas dari student_lists dan class_lists
        $attendanceData = $attendances->map(function ($attendance) use ($currentUser) {
            // Ambil class_list_id dari student_list
            $classListId = StudentList::where('student_id', $attendance->student_id)->value('class_list_id');

            // Ambil nama kelas dari class_lists
            $className = ClassList::where('id', $classListId)->get();

            return [
                'attendance' => $attendance,
                'class' => $className,
                'date' => $attendance->date,
            ];
        });

        return response()->json([
            'message' => 'Success',
            'data' => $attendanceData,
            'total' => [
                'present' => $presentCount,
                'absent' => $absentCount,
                'late' => $lateCount,
            ],
        ], 200);
    }
}
