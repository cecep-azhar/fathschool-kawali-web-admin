<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Models\AttendanceStudent;
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

            // Ambil hanya siswa yang hadir
            $presentStudents = $studentsWithAbsenNumber->filter(function($student) use ($presentStudentIds) {
                return $presentStudentIds->contains($student['id']);
            });

            // Hitung jumlah status kehadiran
            $presentCount = $attendances->where('date', $date)->count();
            $absentCount = $attendances->where('status', 'absent')->count();
            $lateCount = $attendances->where('status', 'late')->count();

            $coursesData[] = [
                'course_name' => $course->name,
                'students' => $presentStudents,
                'total' => [
                    'present' => $presentCount,
                    'absent' => $absentCount,
                    'late' => $lateCount,
                ],
            ];
        }

        return response()->json([
            'message' => 'Success',
            'data' => $coursesData,
        ], 200);
    }
}
