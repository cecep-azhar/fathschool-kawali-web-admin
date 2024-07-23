<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Models\AttendanceStudent;
use App\Models\Leave;
use App\Models\LeaveType; // Tambahkan model LeaveType
use Carbon\Carbon;
use App\Models\User;

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

        // Validasi format tanggal
        if (!$date || !strtotime($date)) {
            return response()->json(['error' => 'Invalid date format'], 400);
        }

        // Tentukan hari dalam seminggu (0 = Minggu, 1 = Senin, ..., 6 = Sabtu)
        $today = Carbon::parse($date)->dayOfWeek;

        // Ambil semua kursus yang diikuti oleh guru pada hari tersebut
        $classRoutines = ClassRoutine::where('teacher_id', $currentUser->id)
            ->where('weekday', $today)
            ->get();

        if ($classRoutines->isEmpty()) {
            return response()->json(['message' => 'No courses found for the teacher on this weekday'], 404);
        }

        // Ambil ID leave type untuk 'Sakit' dan 'Izin' berdasarkan role 'Student'
        $leaveTypes = LeaveType::where('role_type', 'student')
            ->whereIn('name', ['Sakit', 'Izin'])
            ->pluck('id', 'name');

        if ($leaveTypes->isEmpty()) {
            return response()->json(['message' => 'No leave types found for role Student'], 404);
        }

        $coursesData = [];

        foreach ($classRoutines as $classRoutine) {
            $course = Course::find($classRoutine->course_id);
            if (!$course) {
                continue;
            }

            // Ambil semua siswa yang terdaftar di kursus yang ditemukan
            $students = User::active()->student()->whereHas('courses', function($query) use ($course) {
                $query->where('course_id', $course->id);
            })->orderBy('name')->get();

            // Inisialisasi nomor absen
            $absenNumber = 1;

            // Map hasil untuk menyesuaikan format
            $studentsWithAbsenNumber = $students->map(function($user) use (&$absenNumber) {
                // Increment nomor absen
                $absen = $absenNumber;
                $absenNumber++;

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'absen_number' => $absen,
                ];
            });

            // Ambil kehadiran siswa untuk tanggal yang dipilih
            $attendances = AttendanceStudent::whereIn('user_id', $students->pluck('id'))
                ->whereDate('date', $date)
                ->get();

            // Ambil ID siswa yang hadir pada hari tersebut
            $presentStudentIds = $attendances->pluck('user_id');

            // Ambil ID siswa yang sakit dan izin
            $leaves = Leave::whereIn('user_id', $students->pluck('id'))
                ->where(function($query) use ($date) {
                    $query->whereDate('start', '<=', $date)
                          ->whereDate('end', '>=', $date);
                })
                ->whereIn('leave_type_id', $leaveTypes->values())
                ->get();

            $sickStudentIds = $leaves->where('leave_type_id', $leaveTypes['Sakit'])->pluck('user_id');
            $permissionStudentIds = $leaves->where('leave_type_id', $leaveTypes['Izin'])->pluck('user_id');

            // Ambil hanya siswa yang hadir
            $presentStudents = $studentsWithAbsenNumber->filter(function($student) use ($presentStudentIds) {
                return $presentStudentIds->contains($student['id']);
            });

            // Ambil hanya siswa yang sakit
            $sickStudents = $studentsWithAbsenNumber->filter(function($student) use ($sickStudentIds) {
                return $sickStudentIds->contains($student['id']);
            });

            // Ambil hanya siswa yang izin
            $permissionStudents = $studentsWithAbsenNumber->filter(function($student) use ($permissionStudentIds) {
                return $permissionStudentIds->contains($student['id']);
            });

            // Hitung jumlah siswa yang hadir, sakit, izin
            $presentCount = $presentStudents->count();
            $sickCount = $sickStudents->count();
            $permissionCount = $permissionStudents->count();

            // Hitung jumlah siswa yang tidak memiliki keterangan
            $absentStudents = $studentsWithAbsenNumber->filter(function($student) use ($presentStudentIds, $sickStudentIds, $permissionStudentIds) {
                return !($presentStudentIds->contains($student['id']) || $sickStudentIds->contains($student['id']) || $permissionStudentIds->contains($student['id']));
            });

            $coursesData[] = [
                'course_name' => $course->name,
                'students' => [
                    'present' => $presentStudents,
                    'sick' => $sickStudents,
                    'permission' => $permissionStudents,
                    'absent' => $absentStudents,
                ],
                'total' => [
                    'present' => $presentCount,
                    'sick' => $sickCount,
                    'permission' => $permissionCount,
                    'absent' => $absentStudents->count(),
                ],
            ];
        }

        return response()->json([
            'message' => 'Success',
            'data' => $coursesData,
        ], 200);
    }
}
