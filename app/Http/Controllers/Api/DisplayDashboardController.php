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
        // $totalQuotes = Quote::count();
        // $quoteIndex = Carbon::now()->dayOfYear % $totalQuotes;
        // $quote = Quote::skip($quoteIndex)->first();

         // Guru dengan rating tertinggi bulan ini
         $startOfMonth = now()->startOfMonth()->format('Y-m-d');
         $endOfMonth = now()->endOfMonth()->format('Y-m-d');
 
         $teacherWithHighestRatingMonthly = User::where('role', 'teacher')
             ->join('ratings', 'users.id', '=', 'ratings.teacher_id')
             ->select('users.id', 'users.name', DB::raw('AVG(ratings.rating) as avg_rating, SUM(ratings.rating) as total_rating'))
             ->whereBetween('ratings.created_at', [$startOfMonth, $endOfMonth])
             ->groupBy('users.id', 'users.name')
             ->orderByDesc('avg_rating')
             ->first();
 
         // Guru dengan rating terendah bulan ini
         $teacherWithLowestRatingMonthly = User::where('role', 'teacher')
             ->join('ratings', 'users.id', '=', 'ratings.teacher_id')
             ->select('users.id', 'users.name', DB::raw('AVG(ratings.rating) as avg_rating, SUM(ratings.rating) as total_rating'))
             ->whereBetween('ratings.created_at', [$startOfMonth, $endOfMonth])
             ->groupBy('users.id', 'users.name')
             ->orderBy('avg_rating')
             ->first();

        $quote = Quote::pluck('quote');


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
            'quote_of_the_day' => $quote,

            // Guru dengan rating tertinggi bulan ini
            'teacher_with_highest_rating_monthly'
            => $teacherWithHighestRatingMonthly ? $teacherWithHighestRatingMonthly->name : 'Belum ada data guru dengan rating tertinggi bulan ini',
            'total_highest_rating' => $teacherWithHighestRatingMonthly ? $teacherWithHighestRatingMonthly->total_rating : null,

            // Guru dengan rating terendah bulan ini
            'teacher_with_lowest_rating_monthly'
             => $teacherWithLowestRatingMonthly ? $teacherWithLowestRatingMonthly->name : 'Belum ada data guru dengan rating terendah bulan ini',
             'total_lowest_rating' => $teacherWithLowestRatingMonthly ? $teacherWithLowestRatingMonthly->total_rating : null,       
        ];

        return response()->json($response);
    }
}
