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
use App\Models\ClassRoutine;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DisplayDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Kehadiran
        $now = Carbon::now()->format('H:i:s');
        $dayOfWeek = Carbon::now()->dayOfWeekIso;
        $weekRoutines = Carbon::now()->dayOfWeek;
        $today = now()->format('Y-m-d');
        $totalStudent = User::where('role', 'student')->count();
        $totalTeacher = User::where('role', 'teacher')->count();

        $start_time = date('H:i:s');
        $end_time = date('H:i:s');

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
        $activeStatus = Setting::pluck('status')->toArray();

        $lessons = ClassRoutine::with(['subject', 'course'])
            ->where('weekday', $weekRoutines)
            ->where('start_time', '<=', $end_time)
            ->where('end_time', '>=', $start_time)
            ->where('activation', $activeStatus)
            ->get();

        $courses = Course::count();

        $attendanceData = $lessons->map(function ($lesson) use ($now, $today) {
            return [
                'lesson_id' => $lesson->id,
                'course_id' => $lesson->course_id,
                'attendance_count' => ClassAttendance::where('date', $today)
                    ->where('user_id', $lesson->teacher_id)
                    ->where('course_id', $lesson->course_id)
                    ->count(),
            ];
        });

        $attendanceCount = $attendanceData->count();
        $totalEmptyClass = $courses - $attendanceCount;
        $classAttendancePercentage = $courses > 0 ? number_format(($attendanceCount / $courses) * 100) . '%' : '0%';

        $courseName = Course::orderBy('id')->pluck('name');
        $coursePhotos = Course::orderBy('id')->pluck('photo');

        // Jadwal guru di kelas berdasarkan jam sekarang
        $teacherNames = ClassRoutine::with('teacher')
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->where('activation', $activeStatus)
            ->get()
            ->pluck('teacher.name');

        $courseNames = ClassRoutine::with('courses')
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->where('activation', $activeStatus)
            ->get()
            ->pluck('course.name');

        $subjectNames = ClassRoutine::with('subject')
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->where('activation', $activeStatus)
            ->get()
            ->pluck('subject.name');

        // Kelas dengan jam kosong terbanyak minggu ini
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');

        // Menghitung jumlah check-in (kehadiran) per kelas dalam satu minggu
        $classWithLeastCheckins = DB::table('class_attendances')
            ->select('course_id', DB::raw('COUNT(*) as checkin_count'))
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->groupBy('course_id')
            ->orderBy('checkin_count', 'asc')
            ->first();

        $courseWithMostEmptySlots = null;
        if ($classWithLeastCheckins) {
            $courseWithMostEmptySlots = Course::find($classWithLeastCheckins->course_id);
        }

        // Quotes
        $quote = Quote::pluck('quote');

        // Guru favorit bulan ini
        $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = now()->endOfMonth()->format('Y-m-d');

        $teacherWithHighestRatingMonthly = User::where('role', 'teacher')
            ->join('ratings', 'users.id', '=', 'ratings.teacher_id')
            ->select('users.id', 'users.name', DB::raw('SUM(ratings.rating) as avg_rating, SUM(ratings.rating) as total_rating'))
            ->whereBetween('ratings.created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('avg_rating')
            ->first();

        $teacherWithLowestRatingMonthly = User::where('role', 'teacher')
            ->join('ratings', 'users.id', '=', 'ratings.teacher_id')
            ->select('users.id', 'users.name', DB::raw('SUM(ratings.rating) as avg_rating, SUM(ratings.rating) as total_rating'))
            ->whereBetween('ratings.created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('users.id', 'users.name')
            ->orderBy('avg_rating')
            ->first();

        $teachersWithBestPunctuality = User::where('role', 'teacher')
            ->join('attendances', 'users.id', '=', 'attendances.user_id')
            ->select('users.id', 'users.name', DB::raw('SUM(CASE WHEN attendances.time_in <= "08:00:00" THEN 1 ELSE 0 END) AS punctuality_score'))
            ->whereBetween('attendances.date', [$startOfMonth, $endOfMonth])
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('punctuality_score')
            ->first();

        $exemplaryTeacher = $teachersWithBestPunctuality
            ? $teachersWithBestPunctuality->name
            : 'Belum ada data guru teladan bulan ini';

        $coursesWithAttendanceCount = Course::withCount(['courseAttendance' => function($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
        }])->get();

        $minAttendanceCount = $coursesWithAttendanceCount->min('course_attendance_count');

        $coursesWithLeastAttendanceThisWeek = $coursesWithAttendanceCount->filter(function ($course) use ($minAttendanceCount) {
            return $course->course_attendance_count === $minAttendanceCount;
        });

        $coursesNamesWithLeastAttendanceThisWeek = $coursesWithLeastAttendanceThisWeek->pluck('name')->take(3)->implode(', ');

        if ($coursesWithLeastAttendanceThisWeek->count() > 3) {
            $coursesNamesWithLeastAttendanceThisWeek .= ' dan beberapa lainnya';
        }

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
            'total_class' => $courses,
            'total_class_absent' => $totalEmptyClass,
            'course_name' => $courseName,
            // Quote
            'quote_of_the_day' => $quote,
            // Guru dengan rating tertinggi bulan ini
            'highest_rating_teacher' => $teacherWithHighestRatingMonthly->name ?? '',
            'lowest_rating_teacher' => $teacherWithLowestRatingMonthly->name ?? '',
            // Guru teladan
            'teacher_of_the_month' => $exemplaryTeacher,
            'course' => [
                'course_photo' => $coursePhotos,
                'course_name' => $courseName,
                'teacher_names' => $teacherNames,
                'lesson_name' => $subjectNames
            ],
            // Kelas dengan jamkos terbanyak
            'courses_with_least_attendance_this_week' => $coursesNamesWithLeastAttendanceThisWeek,
            'class_with_most_empty_slots' => $courseWithMostEmptySlots ? $courseWithMostEmptySlots->name : '',
        ];

        return response()->json($response);
    }
}
