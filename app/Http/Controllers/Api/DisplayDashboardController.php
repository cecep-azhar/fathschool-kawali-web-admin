<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Api\ClassAttendance;
use App\Models\Quote;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DisplayDashboardController extends Controller
{
    public function index(Request $request)
    {
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

        $courseName = Course::orderBy('id')->pluck('name');
        
        // Kelas dengan kehadiran kosong terbanyak minggu ini
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');
        
        $classWithMostEmptySessions = DB::table('class_attendances')
            ->select('course_id', DB::raw('COUNT(*) as empty_sessions'))
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->groupBy('course_id')
            ->orderBy('empty_sessions', 'desc')
            ->first();
            
        $classNameWithMostEmptySessions = $classWithMostEmptySessions 
            ? Course::find($classWithMostEmptySessions->course_id)->name 
            : 'Tidak ada kelas dengan sesi kosong minggu ini';

        // Quotes
        $totalQuotes = Quote::count();
        $quoteIndex = Carbon::now()->dayOfYear % $totalQuotes;
        $quote = Quote::skip($quoteIndex)->first();

        // Guru dengan rating tertinggi
        $teacherWithHighestRating = User::where('role', 'teacher')
            ->withCount('ratingsReceived')
            ->orderByDesc('ratings_received_count')
            ->first(['id', 'name']);

        // Guru dengan rating terendah
        $teacherWithLowestRating = User::where('role', 'teacher')
            ->withCount('ratingsReceived')
            ->orderBy('ratings_received_count')
            ->first(['id', 'name']);

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
            'course_name' => $courseName,
            // Kelas dengan kehadiran kosong terbanyak minggu ini
            'class_with_most_empty_sessions' => $classNameWithMostEmptySessions,
            // Quote
            'quote_of_the_day' => $quote ? $quote->quote : '',
            // Guru dengan rating tertinggi
            'teacher_with_highest_rating' => $teacherWithHighestRating ? $teacherWithHighestRating->name : 'Belum ada data guru dengan rating tertinggi',
            // Guru dengan rating terendah
            'teacher_with_lowest_rating' => $teacherWithLowestRating ? $teacherWithLowestRating->name : 'Belum ada data guru dengan rating terendah',
        ];

        return response()->json($response);
    }
}
