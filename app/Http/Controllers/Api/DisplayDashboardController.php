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
use Illuminatuse\App\Models\Setting;
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
        // $classWithAttendance = ClassAttendance::where('time_in', '<=', $now)
        //     ->where('date', $today)
        //     ->where('user_id', $lesson->user_id)
        //     ->where('course_id', $lesson->course_id)
        //     ->distinct('course_id')
        //     ->count('course_id');

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

            // dd($lessons);

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

        $classWithLeastSessions = DB::table('class_attendances')
        ->select('course_id', DB::raw('COUNT(*) as session_count'))
        ->whereBetween('date', [$startOfWeek, $endOfWeek])
        ->groupBy('course_id')
        ->orderBy('session_count', 'asc') // Urutkan berdasarkan jumlah sesi dari yang paling sedikit
        ->first();

        // Quotes
        $quote = Quote::pluck('quote');

        // Guru favorit bulan ini
        $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = now()->endOfMonth()->format('Y-m-d');

        // Guru favorit bulan ini (dengan rating tertinggi)
        $teacherWithHighestRatingMonthly = User::where('role', 'teacher')
        ->join('ratings', 'users.id', '=', 'ratings.teacher_id')
        ->select('users.id', 'users.name', DB::raw('SUM(ratings.rating) as avg_rating, SUM(ratings.rating) as total_rating'))
        ->whereBetween('ratings.created_at', [$startOfMonth, $endOfMonth])
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('avg_rating')
        ->first();

        // Guru non-favorit bulan ini (dengan rating terendah)
        $teacherWithLowestRatingMonthly = User::where('role', 'teacher')
        ->join('ratings', 'users.id', '=', 'ratings.teacher_id')
        ->select('users.id', 'users.name', DB::raw('SUM(ratings.rating) as avg_rating, SUM(ratings.rating) as total_rating'))
        ->whereBetween('ratings.created_at', [$startOfMonth, $endOfMonth])
        ->groupBy('users.id', 'users.name')
        ->orderBy('avg_rating')
        ->first();

        // Guru teladan
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

        //Kelas dengan murid kosong terbanyak
        $coursesWithAttendanceCount = Course::withCount(['courseAttendance' => function($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
        }])->get();

        // Temukan jumlah kehadiran terendah
        $minAttendanceCount = $coursesWithAttendanceCount->min('course_attendance_count');

        // Ambil semua kursus dengan jumlah kehadiran terendah
        $coursesWithLeastAttendanceThisWeek = $coursesWithAttendanceCount->filter(function ($course) use ($minAttendanceCount) {
            return $course->course_attendance_count === $minAttendanceCount;
        });

        // $coursesNamesWithLeastAttendanceThisWeek = $coursesWithLeastAttendanceThisWeek->pluck('name')->implode(', ');
        // Ambil maksimal 3 kursus dengan jumlah kehadiran terendah
        $coursesNamesWithLeastAttendanceThisWeek = $coursesWithLeastAttendanceThisWeek->pluck('name')->take(3)->implode(', ');

        // Tambahkan pesan "dan beberapa lainnya" jika ada lebih dari 3 kursus
        if ($coursesWithLeastAttendanceThisWeek->count() > 3) {
            $coursesNamesWithLeastAttendanceThisWeek .= ' dan beberapa lainnya';
        }


        // Kelas dengan murid kosong terbanyak hari ini
        $totalStudents = User::where('role', 'student')->count();
        $studentsAbsentPerClass = Course::withCount(['courseAttendance' => function($query) use ($today) {
            $query->where('date', $today);
        }])->get();

        $studentsAbsentPerClass = $studentsAbsentPerClass->map(function ($course) use ($totalStudents) {
            $studentsPresent = $course->course_attendance_count;
            $studentsAbsent = $totalStudents - $studentsPresent;
            return [
                'course_name' => $course->name,
                'students_absent' => $studentsAbsent
            ];
        });

        $maxAbsentClass = $studentsAbsentPerClass->sortByDesc('students_absent')->first();

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
            // Kelas dengan jamkos terbanyak minggu ini
            'most_empty_session_class' => $coursesNamesWithLeastAttendanceThisWeek,

            // Kelas dengan murid kosong terbanyak hari ini
            'class_with_most_absent_students_today' => $maxAbsentClass ? $maxAbsentClass['course_name'] : 'Tidak ada data',
        ];

        return response()->json($response);
    }
}

