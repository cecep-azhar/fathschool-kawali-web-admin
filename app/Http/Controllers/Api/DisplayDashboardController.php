<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\AttendanceStudent;
use App\Models\Course;
use App\Models\Api\ClassAttendance;
use App\Models\Leave;
use App\Models\Quote;
use App\Models\Rating;
use App\Models\ClassRoutine;
use App\Models\Setting;
use App\Models\LeaveType;
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

        $totalStudentAttendance = AttendanceStudent::where('date', $today)
            ->whereHas('user', function($query) {
                $query->where('role', 'student');
            })->count();

        $totalTeacherAttendance = Attendance::where('date', $today)
            ->whereHas('user', function($query) {
                $query->where('role', 'teacher');
            })->count();

        $totalStudentAbsent = $totalStudent - $totalStudentAttendance;
        $totalTeacherAbsent = $totalTeacher - $totalTeacherAttendance;

        $studentAttendancePercentage = $totalStudent > 0 ? number_format(($totalStudentAttendance / $totalStudent) * 100, 2) . '%' : '0%';

        $teacherAttendancePercentage = $totalTeacher > 0 ? number_format(($totalTeacherAttendance / $totalTeacher) * 100, 2) . '%' : '0%';

        // Kelas
        $activeStatus = Setting::pluck('status')->toArray();

        $lessons = ClassRoutine::with(['subject', 'course'])
            ->where('weekday', $weekRoutines)
            ->where('start_time', '<=', $end_time)
            ->where('end_time', '>=', $start_time)
            ->where('activation', $activeStatus)
            ->get();

        $coursesCount = Course::count();

        $attendanceData = $lessons->map(function ($lesson) use ($today) {
            return [
                'lesson_id' => $lesson->id,
                'course_id' => $lesson->course_id,
                'attendance_count' => ClassAttendance::where('date', $today)
                    ->where('user_id', $lesson->teacher_id)
                    ->where('course_id', $lesson->course_id)
                    ->count(),
            ];
        });
        
        $attendanceCount = $attendanceData->pluck('attendance_count');
        
        $attendedClassesCount = $attendanceCount->filter()->count();

        $totalEmptyClass = $coursesCount - $attendedClassesCount;

        $classAttendancePercentage = $coursesCount > 0 ? number_format(($attendedClassesCount / $coursesCount) * 100, 2) . '%' : '0%';

        // dd($classAttendancePercentage);

        $courseName = Course::orderBy('id')->pluck('name');
        $coursePhotos = Course::orderBy('id')->pluck('photo');

        $teacherNames = ClassRoutine::with('teacher')
            ->where('weekday', $weekRoutines)
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->where('activation', $activeStatus)
            ->get()
            ->pluck('teacher.name');

        $courseNames = ClassRoutine::with('courses')
            ->where('weekday', $weekRoutines)
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->where('activation', $activeStatus)
            ->get()
            ->pluck('course.name');

        $subjectNames = ClassRoutine::with('subject')
            ->where('weekday', $weekRoutines)
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->where('activation', $activeStatus)
            ->get()
            ->pluck('subject.name');

        $teacherIds = ClassRoutine::with('teacher')
            ->where('weekday', $weekRoutines)
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->where('activation', $activeStatus)
            ->get()
            ->pluck('teacher.id')
            ->toArray();
        
        $statusObject = [];
        
        foreach ($teacherIds as $teacherId) {
            $courseStatus = ClassAttendance::where('user_id', $teacherId)
                                            ->where('date', $today)
                                            ->exists();
            $statusObject[] = $courseStatus ? "true" : "false";
        }
      
        // Kelas dengan jam kosong terbanyak minggu ini
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');

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

        $activeStatus = Setting::pluck('status')->toArray();

        // Ambil semua kursus yang diikuti oleh guru pada hari tersebut
        $classRoutines = ClassRoutine::where('weekday', $weekRoutines)
                                     ->where('activation', $activeStatus)
                                     ->get();

        $leaveTypes = LeaveType::where('role_type', 'student')
            ->whereIn('name', ['Sakit', 'Izin'])
            ->pluck('id', 'name');

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
                ->whereDate('date', $today)
                ->get();

            // Ambil ID siswa yang hadir pada hari tersebut
            $presentStudentIds = $attendances->pluck('user_id');

            // Ambil ID siswa yang sakit dan izin
            $leaves = Leave::whereIn('user_id', $students->pluck('id'))
                ->where(function($query) use ($today) {
                    $query->whereDate('start', '<=', $today)
                          ->whereDate('end', '>=', $today);
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

            // $presentCount = $presentStudents->count();
            // $sickCount = $sickStudents->count();
            // $permissionCount = $permissionStudents->count();
            $presentCount = AttendanceStudent::whereIn('user_id', $students->pluck('id'))
            ->whereDate('date', $today)
            ->count();

            // Ambil jumlah siswa yang sakit untuk tanggal yang dipilih
            $sickCount = Leave::whereIn('user_id', $students->pluck('id'))
            ->where(function($query) use ($today, $leaveTypes) {
                $query->where('leave_type_id', $leaveTypes['Sakit'])
                    ->whereDate('start', '<=', $today)
                    ->whereDate('end', '>=', $today);
            })
            ->count();

            // Ambil jumlah siswa yang izin untuk tanggal yang dipilih
            $permissionCount = Leave::whereIn('user_id', $students->pluck('id'))
            ->where(function($query) use ($today, $leaveTypes) {
                $query->where('leave_type_id', $leaveTypes['Izin'])
                    ->whereDate('start', '<=', $today)
                    ->whereDate('end', '>=', $today);
            })
            ->count();

            // Hitung jumlah siswa yang tidak memiliki keterangan
            $absentStudents = $studentsWithAbsenNumber->filter(function($student) use ($presentStudentIds, $sickStudentIds, $permissionStudentIds) {
                return !($presentStudentIds->contains($student['id']) || $sickStudentIds->contains($student['id']) || $permissionStudentIds->contains($student['id']));
            });

            $coursesData[] = [
                'course_name' => $course->name,
                'total' => [
                    'total_student' => $students->count(),
                    'present' => $presentCount,
                    'sick' => $sickCount,
                    'permission' => $permissionCount,
                    'absent' => $absentStudents->count(),
                ],
            ];
        }

        // Kelas dengan Jumlah Kehadiran Terendah
        // $courseWithLowestAttendance = collect($coursesData)->sortBy(function ($course) {
        //     return $course['total']['present'] + $course['total']['sick'] + $course['total']['permission'] + $course['total']['absent'];
        // })->first();

        // Kelas dengan Jumlah Siswa Sakit, Izin, dan Absen Terbanyak
        $courseWithHighestAbsences = collect($coursesData)->sortByDesc(function ($course) {
            return $course['total']['sick'] + $course['total']['permission'] + $course['total']['absent'];
        })->first();

        $courseNameWithHighestAbsences = $courseWithHighestAbsences['course_name'] ?? '';   
                
        // dd($coursesData);

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
            'total_class' => $coursesCount,
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
                'lesson_name' => $subjectNames,
                'status' =>  $statusObject,
                'data' => $coursesData
            ],
            // Kelas dengan jamkos terbanyak
            'class_with_most_free_periods' => $coursesNamesWithLeastAttendanceThisWeek,
            // Kelas dengan Jumlah Kehadiran Terendah
            // 'class_with_lowest_attendance' => $courseWithLowestAttendance['course_name'] ?? '',
            'class_with_highest_absent_percentage' => $courseNameWithHighestAbsences,
        ];

        return response()->json($response);
    }
}