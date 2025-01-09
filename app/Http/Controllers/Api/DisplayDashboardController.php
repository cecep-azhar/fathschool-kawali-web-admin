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
        $now = Carbon::now()->format('H:i:s');
        $dayOfWeek = Carbon::now()->dayOfWeekIso;
        $weekRoutines = Carbon::now()->dayOfWeek;
        $today = now()->format('Y-m-d');
        $today2 = now();

        // Basic counts
        $counts = $this->getBasicCounts();

        // Attendance data
        $attendanceData = $this->getAttendanceData($today);

        // Attendance percentages
        $percentages = $this->calculatePercentages($counts, $attendanceData);
        $absencePercentages = $this->calculateAbsencePercentages($counts, $attendanceData);

        // Class data
        $classData = $this->getClassData($weekRoutines, $now);

        // Course attendance data
        $courseAttendanceData = $this->getCourseAttendanceData($weekRoutines, $today);

        // Monthly statistics
        $monthlyStats = $this->getMonthlyStatistics();

        // Combine all data for response
        $response = [
            // Basic counts
            'total_student' => $counts['student'],
            'total_teacher' => $counts['teacher'],
            'total_administartion' => $counts['administration'],

            // Attendance counts
            'total_teacher_attendance' => $attendanceData['teacher_attendance'],
            'total_student_attendance' => $attendanceData['student_attendance'],
            'total_administration_attendance' => $attendanceData['admin_attendance'],
            'total_teacher_absent' => $attendanceData['teacher_absent'],
            'total_student_absent' => $attendanceData['student_absent'],
            'total_administration_absent' => $attendanceData['admin_absent'],
            'attendance_teachers' => $attendanceData['teacher_details'],
            'attendance_administrations' => $attendanceData['admin_details'],
            'total_teacher_leave' => $attendanceData['teacher_leave'],
            'total_administration_leave' => $attendanceData['admin_leave'],
            'leave_administrations' => $attendanceData['admin_leave_details'],
            'leave_teachers' => $attendanceData['teacher_leave_details'],

            // Percentages
            'student_attendance_percentage' => $percentages['student'],
            'teacher_attendance_percentage' => $percentages['teacher'],
            'administration_attendance_percentage' => $percentages['administration'],
            'class_attendance_percentage' => $percentages['class'],

            'absence_student_attendance_percentage' => $absencePercentages ['student'],
            'absence_teacher_attendance_percentage' => $absencePercentages ['teacher'],
            'absence_administration_attendance_percentage' => $absencePercentages ['administration'],
            'absence_class_attendance_percentage' => $absencePercentages ['class'],

            // Class information
            'total_class' => $classData['total'],
            'total_class_absent' => $classData['absent'],
            'course_name' => $classData['names'],

            // Quote
            'quote_of_the_day' => Quote::pluck('quote'),

            // Monthly statistics
            'highest_rating_teacher' => $monthlyStats['highest_rated'] ?? '',
            'lowest_rating_teacher' => $monthlyStats['lowest_rated'] ?? '',
            'teacher_of_the_month' => $monthlyStats['exemplary'],

            // Course details
            'course' => [
                'course_photo' => Course::orderBy('id')->pluck('photo'),
                'course_name' => Course::orderBy('id')->pluck('name'),
                'teacher_names' => $courseAttendanceData['teacher_names'],
                'lesson_name' => $courseAttendanceData['lesson_names'],
                'status' => $courseAttendanceData['status'],
                'data' => $courseAttendanceData['attendance_data']
            ],

            // Problem classes
            'class_with_most_free_periods' => $monthlyStats['most_free_periods'],
            'class_with_highest_absent_percentage' => $monthlyStats['highest_absences']
        ];

        return response()->json($response);
    }

    private function getBasicCounts()
    {
        return [
            'student' => User::where('role', 'student')->count(),
            'teacher' => User::where('role', 'teacher')->count(),
            'administration' => User::where('role', 'Administration')->count()
        ];
    }

    private function getAttendanceData($today)
    {
        $settingTimeIn = Setting::select(['time_in'])->first();

        // Get attendance counts
        $teacherAttendance = Attendance::where('date', $today)
            ->whereHas('user', function ($query) {
                $query->where('role', 'teacher');
            })->count();

        $studentAttendance = AttendanceStudent::where('date', $today)
            ->whereHas('user', function ($query) {
                $query->where('role', 'student');
            })->count();

        $adminAttendance = Attendance::where('date', $today)
            ->whereHas('user', function ($query) {
                $query->where('role', 'Administration');
            })->count();

        // Get detailed attendance records with lateness calculation
        $teacherDetails = $this->getDetailedAttendance('teacher', $today, $settingTimeIn);
        $adminDetails = $this->getDetailedAttendance('Administration', $today, $settingTimeIn);

        // Get leave records
        $teacherLeave = Leave::where('start', $today)
            ->whereHas('user', function ($query) {
                $query->where('role', 'Teacher');
            });

        $adminLeave = Leave::where('start', $today)
            ->whereHas('user', function ($query) {
                $query->where('role', 'Administration');
            });

        return [
            'teacher_attendance' => $teacherAttendance,
            'student_attendance' => $studentAttendance,
            'admin_attendance' => $adminAttendance,
            'teacher_absent' => User::where('role', 'teacher')->count() - $teacherAttendance,
            'student_absent' => User::where('role', 'student')->count() - $studentAttendance,
            'admin_absent' => User::where('role', 'Administration')->count() - $adminAttendance,
            'teacher_details' => $teacherDetails,
            'admin_details' => $adminDetails,
            'teacher_leave' => $teacherLeave->count(),
            'admin_leave' => $adminLeave->count(),
            'teacher_leave_details' => $this->getDetailedLeave('Teacher', $today),
            'admin_leave_details' => $this->getDetailedLeave('Administration', $today)
        ];
    }

    private function getDetailedAttendance($role, $today, $settingTimeIn)
    {
        $attendances = Attendance::with('user:id,name')
            ->where('date', $today)
            ->whereHas('user', function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->get(['id', 'user_id', 'date', 'time_in']);

        if ($settingTimeIn && $settingTimeIn->time_in) {
            $settingTime = Carbon::createFromFormat('H:i:s', $settingTimeIn->time_in);

            return $attendances->map(function ($attendance) use ($settingTime) {
                $attendanceTime = Carbon::createFromFormat('H:i:s', $attendance->time_in);
                $latenessMinutes = $attendanceTime->greaterThan($settingTime)
                    ? $attendanceTime->diffInMinutes($settingTime)
                    : 0;

                $attendance->lateness = $latenessMinutes . ' menit';
                return $attendance;
            });
        }

        return $attendances;
    }

    private function getDetailedLeave($role, $today)
    {
        return Leave::with(['user', 'type:id,name'])
            ->where('start', $today)
            ->whereHas('user', function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->get(['id', 'user_id', 'title', 'leave_type_id', 'start', 'end', 'status'])
            ->map(function ($leave) {
                $start = Carbon::parse($leave->start);
                $end = Carbon::parse($leave->end);
                $leave->days = $start->diffInDays($end) + 1;
                return $leave;
            });
    }

    private function calculatePercentages($counts, $attendanceData)
    {
        return [
            'student' => $counts['student'] > 0
                ? number_format(($attendanceData['student_attendance'] / $counts['student']) * 100, 2) . '%'
                : '0%',
            'teacher' => $counts['teacher'] > 0
                ? number_format(($attendanceData['teacher_attendance'] / $counts['teacher']) * 100, 2) . '%'
                : '0%',
            'administration' => $counts['administration'] > 0
                ? number_format(($attendanceData['admin_attendance'] / $counts['administration']) * 100, 2) . '%'
                : '0%',
            'class' => $counts['teacher'] > 0
                ? number_format(($attendanceData['teacher_attendance'] / $counts['teacher']) * 100, 2) . '%'
                : '0%'
        ];
    }


    private function calculateAbsencePercentages($counts, $attendanceData)
    {
        return [
            'student' => $counts['student'] > 0
                ? number_format((1 - ($attendanceData['student_attendance'] / $counts['student'])) * 100, 2) . '%'
                : '0%',
            'teacher' => $counts['teacher'] > 0
                ? number_format((1 - ($attendanceData['teacher_attendance'] / $counts['teacher'])) * 100, 2) . '%'
                : '0%',
            'administration' => $counts['administration'] > 0
                ? number_format((1 - ($attendanceData['admin_attendance'] / $counts['administration'])) * 100, 2) . '%'
                : '0%',
            'class' => $counts['teacher'] > 0
                ? number_format((1 - ($attendanceData['teacher_attendance'] / $counts['teacher'])) * 100, 2) . '%'
                : '0%'
        ];
    }


    private function getClassData($weekRoutines, $now)
    {
        $activeStatus = Setting::pluck('status')->toArray();

        $classRoutines = ClassRoutine::where('weekday', $weekRoutines)
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->where('activation', $activeStatus)
            ->get();

        return [
            'total' => Course::count(),
            'absent' => Course::count() - $classRoutines->count(),
            'names' => Course::orderBy('id')->pluck('name')
        ];
    }

    private function getCourseAttendanceData($weekRoutines, $today)
    {
        $activeStatus = Setting::pluck('status')->toArray();

        // Get ALL courses instead of only those with routines
        $allCourses = Course::orderBy('name')->get();
        $attendanceData = [];

        foreach ($allCourses as $course) {
            $students = User::active()->student()
                ->whereHas('courses', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })
                ->orderBy('name')
                ->get();

            $leaveTypes = LeaveType::where('role_type', 'student')
                ->whereIn('name', ['Sakit', 'Izin'])
                ->pluck('id', 'name');

            // Calculate attendance stats
            $presentCount = AttendanceStudent::whereIn('user_id', $students->pluck('id'))
                ->whereDate('date', $today)
                ->count();

            $sickCount = Leave::whereIn('user_id', $students->pluck('id'))
                ->where('leave_type_id', $leaveTypes['Sakit'])
                ->whereDate('start', '<=', $today)
                ->whereDate('end', '>=', $today)
                ->count();

            $permissionCount = Leave::whereIn('user_id', $students->pluck('id'))
                ->where('leave_type_id', $leaveTypes['Izin'])
                ->whereDate('start', '<=', $today)
                ->whereDate('end', '>=', $today)
                ->count();

            $totalStudents = $students->count();
            $absentCount = $totalStudents - ($presentCount + $sickCount + $permissionCount);

            $attendanceData[] = [
                'course_name' => $course->name,
                'total' => [
                    'total_student' => $totalStudents,
                    'present' => $presentCount,
                    'sick' => $sickCount,
                    'permission' => $permissionCount,
                    'absent' => $absentCount
                ]
            ];
        }

        // Get teacher names and lesson names for current schedule
        $currentRoutines = ClassRoutine::where('weekday', $weekRoutines)
            ->where('activation', $activeStatus)
            ->get();

        return [
            'teacher_names' => $currentRoutines->pluck('teacher.name'),
            'lesson_names' => $currentRoutines->pluck('subject.name'),
            'status' => $currentRoutines->pluck('teacher.id')
                ->map(function ($teacherId) use ($today) {
                    return ClassAttendance::where('user_id', $teacherId)
                        ->where('date', $today)
                        ->exists() ? "true" : "false";
                }),
            'attendance_data' => collect($attendanceData)->sortBy('course_name')->values()->all()
        ];
    }

    private function getMonthlyStatistics()
    {
        $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = now()->endOfMonth()->format('Y-m-d');
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');

        // Get highest rated teacher
        $highestRated = User::where('role', 'teacher')
            ->join('ratings', 'users.id', '=', 'ratings.teacher_id')
            ->select('users.id', 'users.name', DB::raw('SUM(ratings.rating) as total_rating'))
            ->whereBetween('ratings.created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_rating')
            ->first();

        // Get lowest rated teacher
        $lowestRated = User::where('role', 'teacher')
            ->join('ratings', 'users.id', '=', 'ratings.teacher_id')
            ->select('users.id', 'users.name', DB::raw('SUM(ratings.rating) as total_rating'))
            ->whereBetween('ratings.created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('users.id', 'users.name')
            ->orderBy('total_rating')
            ->first();

        // Get most punctual teacher
        $exemplaryTeacher = User::where('role', 'teacher')->join('attendances', 'users.id', '=', 'attendances.user_id')
            ->select(
                'users.id',
                'users.name',
                DB::raw('SUM(CASE WHEN attendances.time_in <= "08:00:00" THEN 1 ELSE 0 END) AS punctuality_score')
            )
            ->whereBetween('attendances.date', [$startOfMonth, $endOfMonth])
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('punctuality_score')
            ->first();

        // Get classes with least attendance this week
        $coursesWithAttendanceCount = Course::withCount(['courseAttendance' => function ($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
        }])->get();

        $minAttendanceCount = $coursesWithAttendanceCount->min('course_attendance_count');

        $coursesWithLeastAttendance = $coursesWithAttendanceCount
            ->filter(function ($course) use ($minAttendanceCount) {
                return $course->course_attendance_count === $minAttendanceCount;
            });

        $coursesWithMostFreePeriods = $coursesWithLeastAttendance
            ->pluck('name')
            ->take(3)
            ->implode(', ');

        if ($coursesWithLeastAttendance->count() > 3) {
            $coursesWithMostFreePeriods .= ' dan beberapa lainnya';
        }

        // Class with highest absences
        $activeStatus = Setting::pluck('status')->toArray();
        $classRoutines = ClassRoutine::where('weekday', Carbon::now()->dayOfWeek)
            ->where('activation', $activeStatus)
            ->get();

        $coursesData = collect();
        $leaveTypes = LeaveType::where('role_type', 'student')
            ->whereIn('name', ['Sakit', 'Izin'])
            ->pluck('id', 'name');

        foreach ($classRoutines as $routine) {
            $course = Course::find($routine->course_id);
            if (!$course || $coursesData->where('course_name', $course->name)->isNotEmpty()) {
                continue;
            }

            $students = User::active()->student()
                ->whereHas('courses', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })->get();

            $presentCount = AttendanceStudent::whereIn('user_id', $students->pluck('id'))
                ->whereDate('date', now()->format('Y-m-d'))
                ->count();

            $sickCount = Leave::whereIn('user_id', $students->pluck('id'))
                ->where('leave_type_id', $leaveTypes['Sakit'])
                ->whereDate('start', '<=', now())
                ->whereDate('end', '>=', now())
                ->count();

            $permissionCount = Leave::whereIn('user_id', $students->pluck('id'))
                ->where('leave_type_id', $leaveTypes['Izin'])
                ->whereDate('start', '<=', now())
                ->whereDate('end', '>=', now())
                ->count();

            $absentCount = $students->count() - ($presentCount + $sickCount + $permissionCount);

            $coursesData->push([
                'course_name' => $course->name,
                'total' => [
                    'total_student' => $students->count(),
                    'present' => $presentCount,
                    'sick' => $sickCount,
                    'permission' => $permissionCount,
                    'absent' => $absentCount
                ]
            ]);
        }

        $courseWithHighestAbsences = $coursesData->sortByDesc(function ($course) {
            return $course['total']['sick'] + $course['total']['permission'] + $course['total']['absent'];
        })->first();

        return [
            'highest_rated' => $highestRated ? $highestRated->name : null,
            'lowest_rated' => $lowestRated ? $lowestRated->name : null,
            'exemplary' => $exemplaryTeacher ? $exemplaryTeacher->name : 'Belum ada data guru teladan bulan ini',
            'most_free_periods' => $coursesWithMostFreePeriods,
            'highest_absences' => $courseWithHighestAbsences ? $courseWithHighestAbsences['course_name'] : ''
        ];
    }
}
