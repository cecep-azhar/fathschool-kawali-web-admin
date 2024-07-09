<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Api\ClassAttendance;

class DisplayDashboardController extends Controller
{
    public function index(){
        // Kehadiran
        $today = now()->format('Y-m-d');
        $totalStudent = User::where('role', 'student')->count();
        $totalTeacher = User::where('role', 'teacher')->count();

        $totalStudentAttendance = Attendance::where('date', $today)
        ->whereHas('user', function($query) {
            $query->where('role', 'student');
        })->count();

        $totalTeacherAttendance = Attendance::where('date', $today)
        ->whereHas('user', function($query) {
            $query->where('role', 'teacher');
        })->count();

        $percentageStudentAttendance = $totalStudent > 0 ? number_format(($totalStudentAttendance / $totalStudent) * 100) . '%' : '0%';
        $percentageTeacherAttendance = $totalTeacher > 0 ? number_format(($totalTeacherAttendance / $totalTeacher) * 100) . '%' : '0%';

        
        $totalTeacherAbsent = $totalTeacher - $totalTeacherAttendance;
        $totalStudentAbsent = $totalStudent - $totalStudentAttendance;

        // Kelas
        $totalClass = Course::count();
        $totalClassAbsent = ClassAttendance::count();

        $totalEmptyClass = $totalClass - $totalClassAbsent;

        $response = [
            // Kehadiran
            'total_student' => $totalStudent,
            'total_teacher' => $totalTeacher,
            'total_teacher_attendance' => $totalTeacherAttendance,
            'total_student_attendance' => $totalStudentAttendance,
            'total_teacher_absent' => $totalTeacherAbsent,
            'total_student_absent' => $totalStudentAbsent,
            // Persentase
            'percentage_student_attendance' => $percentageStudentAttendance,
            'percentage_teacher_attendance' => $percentageTeacherAttendance,
            // Kelas
            'total_class' => $totalClass,
            'total_class_absent' => $totalEmptyClass,
        ];

        return response()->json($response);
    }
}
