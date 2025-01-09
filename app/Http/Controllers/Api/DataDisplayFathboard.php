<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceStudent;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataDisplayFathboard extends Controller
{
    public function getDataSiswa()
    {

        $now = Carbon::now()->format('H:i:s');
        $dayOfWeek = Carbon::now()->dayOfWeekIso;
        $weekRoutines = Carbon::now()->dayOfWeek;
        $today = now()->format('Y-m-d');
        $today2 = now();

        $counts = $this->getBasicCounts();

        $attendanceData = $this->getAttendanceData($today);

        $total_students = number_format($counts['student']);
        $total_present = number_format($attendanceData['student_attendance']);
        $total_absent = number_format($attendanceData['student_absent']);
        $total_leave = number_format($attendanceData['student_leave']);


        $classData = $this->getClassData($weekRoutines, $now);
        $attendanceData['class_leave'] = $classData['absent'];

        $percentages = $this->calculatePercentages($counts, $attendanceData, 'present');
        $percentages_absent = $this->calculatePercentages($counts, $attendanceData, 'absent');
        $percentags_leave = $this->calculatePercentages($counts, $attendanceData, 'leave');

        $presentStudents = $this->getDetailedPresent('student', $today);
        $absentStudents = $this->getDetailedAbsent('student', $today);
        $leaveStudents = $this->getDetailedLeave('Student', $today);
        $response = [
            'status' => true,
            'messages' => 'Successfully retrieved data',
            'data' => [
                'students' => [
                    'total' => $total_students,
                    'present' => $total_present,
                    'absent' => $total_absent,
                    'leave' => $total_leave,
                    'presentPercentage' => $percentages['student'],
                    'absentPercentage' => $percentages_absent['student'],
                    'leavePercentage' => $percentags_leave['student'],
                    'dataPresent' => $presentStudents,
                    'dataAbsent' => $absentStudents,
                    'dataLeave' => $leaveStudents
                ]
            ]
        ];

        return response($response);
    }

    public function getDataGuru(){
        $now = Carbon::now()->format('H:i:s');
        $dayOfWeek = Carbon::now()->dayOfWeekIso;
        $weekRoutines = Carbon::now()->dayOfWeek;
        $today = now()->format('Y-m-d');
        $today2 = now();

        $counts = $this->getBasicCounts();

        $attendanceData = $this->getAttendanceData($today);

        $total_teacher = $counts['teacher'];
        $total_present = $attendanceData['teacher_attendance'];
        $total_absent = $attendanceData['teacher_absent'];


        $classData = $this->getClassData($weekRoutines, $now);
        $attendanceData['class_leave'] = $classData['absent'];

        $percentages = $this->calculatePercentages($counts, $attendanceData, 'present');
        $percentages_absent = $this->calculatePercentages($counts, $attendanceData, 'absent');
        $percentags_leave = $this->calculatePercentages($counts, $attendanceData, 'leave');

        $presentTeachers = $this->getDetailedPresent('teacher', $today);
        $absentTeachers = $this->getDetailedAbsent('teacher', $today);
        $leaveTeachers = $this->getDetailedLeave('Teacher', $today);
        $response = [
            'status' => true,
            'messages' => 'Successfully retrieved data',
            'data' => [
                'teachers' => [
                    'total' => $total_teacher,
                    'present' => $total_present,
                    'absent' => $total_absent,
                    'presentPercentage' => $percentages['teacher'],
                    'absentPercentage' => $percentages_absent['teacher'],
                    'leavePercentage' => $percentags_leave['teacher'],
                    'dataPresent' => $presentTeachers,
                    'dataAbsent' => $absentTeachers,
                    'dataLeave' => $leaveTeachers
                ]
            ]
        ];
        return response($response);
    }

    private function getBasicCounts()
    {
        return [
            'student' => User::where('role', 'student')->count(),
            'teacher' => User::where('role', 'teacher')->count(),
            'administration' => User::where('role', 'Administration')->count()
        ];
    }

    private function getDetailedPresent($role, $today)
    {
        return AttendanceStudent::with(['user'])
            ->where('date', $today) // Memastikan data berdasarkan tanggal yang sama
            ->whereHas('user', function ($query) use ($role) {
                $query->where('role', $role); // Memastikan hanya data dengan role tertentu, misalnya student
            })
            ->orderBy('time_in', 'desc') // Mengurutkan berdasarkan waktu masuk (terbaru)
            ->limit(20) // Membatasi hanya 20 siswa terakhir
            ->get(['id', 'user_id', 'date', 'time_in', 'time_out', 'latlon_in', 'latlon_out']) // Mengambil field yang relevan
            ->map(function ($attendance) {
                $attendance->user_name = $attendance->user->name; // Menambahkan nama pengguna
                return $attendance;
            });
    }

    private function getDetailedAbsent($role, $today)
    {
        // Ambil semua siswa dengan role 'student'
        return User::where('role', $role) // Menyaring berdasarkan role 'student'
            ->whereNotIn('id', function ($query) use ($today) {
                // Menyaring siswa yang sudah memiliki entri attendance untuk hari tersebut
                $query->select('user_id')
                    ->from('attendance_students')
                    ->where('date', $today);
            })
            ->orderBy('name', 'asc') // Mengurutkan berdasarkan nama atau kolom lain
            ->limit(20) // Membatasi hanya 20 siswa
            ->get(['id', 'name', 'role']) // Mengambil field yang relevan
            ->map(function ($user) {
                return $user;
            });
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

        $studentLeave = Leave::where('start', $today)
            ->whereHas('user', function ($query) {
                $query->where('role', 'Student');
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
            'student_absent' => User::where('role', 'student')->count() - ($studentAttendance + $studentLeave->count()),
            'admin_absent' => User::where('role', 'Administration')->count() - $adminAttendance,
            'teacher_details' => $teacherDetails,
            'admin_details' => $adminDetails,
            'teacher_leave' => $teacherLeave->count(),
            'student_leave' => $studentLeave->count(),  // Add student leave count
            'admin_leave' => $adminLeave->count(),
            'teacher_leave_details' => $this->getDetailedLeave('Teacher', $today),
            'student_leave_details' => $this->getDetailedLeave('Student', $today),  // Add student leave details
            'admin_leave_details' => $this->getDetailedLeave('Administration', $today)
        ];
    }


    private function getAbsentCount($today)
    {
        $leaveTypes = LeaveType::where('role_type', 'student')
            ->whereIn('name', ['Sakit', 'Izin'])
            ->pluck('id', 'name');
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

    private function calculatePercentages($counts, $attendanceData, $type = 'present')
    {
        $result = [
            'student' => $counts['student'] > 0
                ? number_format(
                    $type === 'present'
                        ? ($attendanceData['student_attendance'] / $counts['student']) * 100
                        : ($type === 'leave'
                            ? ($attendanceData['student_leave'] / $counts['student']) * 100
                            : (1 - ($attendanceData['student_attendance'] / $counts['student'])) * 100),
                    2
                ) . '%'
                : '0%',
            'teacher' => $counts['teacher'] > 0
                ? number_format(
                    $type === 'present'
                        ? ($attendanceData['teacher_attendance'] / $counts['teacher']) * 100
                        : ($type === 'leave'
                            ? ($attendanceData['teacher_leave'] / $counts['teacher']) * 100
                            : (1 - ($attendanceData['teacher_attendance'] / $counts['teacher'])) * 100),
                    2
                ) . '%'
                : '0%',
            'administration' => $counts['administration'] > 0
                ? number_format(
                    $type === 'present'
                        ? ($attendanceData['admin_attendance'] / $counts['administration']) * 100
                        : ($type === 'leave'
                            ? ($attendanceData['admin_leave'] / $counts['administration']) * 100
                            : (1 - ($attendanceData['admin_attendance'] / $counts['administration'])) * 100),
                    2
                ) . '%'
                : '0%',
            'class' => $counts['teacher'] > 0
                ? number_format(
                    $type === 'present'
                        ? ($attendanceData['teacher_attendance'] / $counts['teacher']) * 100
                        : ($type === 'leave'
                            ? ($attendanceData['class_leave'] / $counts['teacher']) * 100
                            : (1 - ($attendanceData['teacher_attendance'] / $counts['teacher'])) * 100),
                    2
                ) . '%'
                : '0%',
        ];

        return $result;
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
}
