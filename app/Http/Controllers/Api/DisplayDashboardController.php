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
        
        $totalStudentAbsent = $totalStudent - $totalStudentAttendance;
        $totalTeacherAbsent = $totalTeacher - $totalTeacherAttendance;
        
        $studentAttendancePercentage = $totalStudent > 0 ? number_format(($totalStudentAttendance / $totalStudent) * 100) . '%' : '0%';
        $teacherAttendancePercentage = $totalTeacher > 0 ? number_format(($totalTeacherAttendance / $totalTeacher) * 100) . '%' : '0%';
        
        // Kelas
        $totalClass = Course::count();
        $totalClassAbsent = ClassAttendance::count();

        $classAttendancePercentage = $totalClass > 0 ? number_format(($totalClassAbsent / $totalClass) * 100) . '%' : '0%';
        
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
            'student_attendance_percentage' => $studentAttendancePercentage,
            'teacher_attendance_percentage' => $teacherAttendancePercentage,
            'class_attendance_percentage' => $classAttendancePercentage,
            // Kelas
            'total_class' => $totalClass,
            'total_class_absent' => $totalEmptyClass,
        ];

        return response()->json($response);
    }
}
