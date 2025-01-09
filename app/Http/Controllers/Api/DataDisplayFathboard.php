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

    public function getDataGuru()
    {
        $now = Carbon::now()->format('H:i:s');
        $dayOfWeek = Carbon::now()->dayOfWeekIso;
        $weekRoutines = Carbon::now()->dayOfWeek;
        $today = now()->format('Y-m-d');
        $today2 = now();

        $counts = $this->getBasicCounts();

        $attendanceData = $this->getAttendanceData($today);

        $total_teacher = number_format($counts['teacher']);
        $total_present = number_format($attendanceData['teacher_attendance']);
        $total_absent = number_format($attendanceData['teacher_absent']);
        $total_leave = number_format($attendanceData['teacher_leave']);


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
                    'leave' => $total_leave,
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

    public function getDataAdmin()
    {
        $now = Carbon::now()->format('H:i:s');
        $dayOfWeek = Carbon::now()->dayOfWeekIso;
        $weekRoutines = Carbon::now()->dayOfWeek;
        $today = now()->format('Y-m-d');
        $today2 = now();

        $counts = $this->getBasicCounts();

        $attendanceData = $this->getAttendanceData($today);

        $total_admin = number_format($counts['administration']);
        $total_present = number_format($attendanceData['admin_attendance']);
        $total_absent = number_format($attendanceData['admin_absent']);
        $total_leave = number_format($attendanceData['admin_leave']);


        $classData = $this->getClassData($weekRoutines, $now);
        $attendanceData['class_leave'] = $classData['absent'];

        $percentages = $this->calculatePercentages($counts, $attendanceData, 'present');
        $percentages_absent = $this->calculatePercentages($counts, $attendanceData, 'absent');
        $percentags_leave = $this->calculatePercentages($counts, $attendanceData, 'leave');

        $presentAdmins = $this->getDetailedPresent('Administration', $today);
        $absentAdmins = $this->getDetailedAbsent('Administration', $today);
        $leaveAdmins = $this->getDetailedLeave('Administration', $today);
        $response = [
            'status' => true,
            'messages' => 'Successfully retrieved data',
            'data' => [
                'admins' => [
                    'total' => $total_admin,
                    'present' => $total_present,
                    'absent' => $total_absent,
                    'leave' => $total_leave,
                    'presentPercentage' => $percentages['administration'],
                    'absentPercentage' => $percentages_absent['administration'],
                    'leavePercentage' => $percentags_leave['administration'],
                    'dataPresent' => $presentAdmins,
                    'dataAbsent' => $absentAdmins,
                    'dataLeave' => $leaveAdmins
                ]
            ]
        ];

        return response($response);
    }

    public function getDataClass()
    {
        $now = Carbon::now()->format('H:i:s');
        $weekRoutines = Carbon::now()->dayOfWeek;
        $today = Carbon::now()->toDateString();

        // Get data kelas dari fungsi yang sudah ada
        $classData = $this->getClassData($weekRoutines, $now);

        // Prepare data untuk setiap tingkat kelas
        $classes = [];
        $gradeData = [
            ['id' => 1, 'name' => 'X', 'classes' => $classData['class_x']],
            ['id' => 2, 'name' => 'XI', 'classes' => $classData['class_xi']],
            ['id' => 3, 'name' => 'XII', 'classes' => $classData['class_xii']]
        ];

        foreach ($gradeData as $grade) {
            $classDetails = [];
            $totalStudentsInGrade = 0;
            $totalActiveClasses = 0;
            $totalAbsentClasses = 0;
            $totalAbsent = 0;
            $totalLeave = 0;
            $totalPresent = 0; // Menambahkan variabel untuk total hadir

            foreach ($grade['classes'] as $index => $className) {
                // Get jumlah siswa per kelas
                $studentsInClass = User::active()->student()
                    ->whereHas('course', function ($query) use ($className) {
                        $query->where('courses.name', $className);
                    })->count();

                // Update total siswa per grade
                $totalStudentsInGrade += $studentsInClass;

                // Get jumlah kehadiran
                $attendance = AttendanceStudent::whereHas('user', function ($query) use ($className) {
                    $query->whereHas('course', function ($subQuery) use ($className) {
                        $subQuery->where('courses.name', $className);
                    });
                })
                    ->whereDate('date', $today)
                    ->count();

                // Update total siswa yang hadir
                $totalPresent += $attendance;

                // Get jumlah izin dan sakit
                $leaves = Leave::whereHas('user', function ($query) use ($className) {
                    $query->whereHas('course', function ($subQuery) use ($className) {
                        $subQuery->where('courses.name', $className);
                    });
                })
                    ->whereDate('start', '<=', $today)
                    ->whereDate('end', '>=', $today)
                    ->count();

                // Hitung jumlah yang tidak hadir
                $absent = $studentsInClass - ($attendance + $leaves);

                // Menambahkan total absent dan leave
                $totalAbsent += $absent;
                $totalLeave += $leaves;

                // Determine if class is active or empty
                $classRoutine = ClassRoutine::whereHas('course', function ($query) use ($className) {
                    $query->where('name', $className); // Assumed 'courses.name' is used
                })
                    ->where('weekday', $weekRoutines)
                    ->first();

                // Cek jika ada guru dan pelajaran
                $isActive = $classRoutine && $classRoutine->teacher_id && $classRoutine->subject_id ? true : false;

                // Menghitung jumlah kelas aktif dan kosong
                if ($isActive) {
                    $totalActiveClasses++;
                } else {
                    $totalAbsentClasses++;
                }

                // Menambahkan detail kelas
                $classDetails[] = [
                    'id' => $index + 1,
                    'name' => $className,
                    'total_student_present' => $attendance,
                    'total_student_absent' => $absent,
                    'total_student_leave' => $leaves,
                    'status' => $isActive ? 'Active' : 'Empty',  // Active or Empty
                    'teacher' => $isActive ? $classRoutine->teacher->name : '-',
                    'lesson' => $isActive ? $classRoutine->subject->name : '-'
                ];
            }

            // Menambahkan data tingkat kelas dengan total present, absent, dan leave
            $classes[] = [
                'id' => $grade['id'],
                'name' => $grade['name'],
                'active_class' => $totalActiveClasses, // Kelas aktif
                'empty_class' => $totalAbsentClasses, // Kelas kosong
                'total_class' => $totalActiveClasses + $totalAbsentClasses,
                'total_students' => $totalStudentsInGrade, // Total siswa
                'total_present' => $totalPresent, // Total siswa yang hadir
                'percentage_present' => $totalPresent > 0 ? round(($totalPresent / $totalStudentsInGrade) * 100, 2) . '%' : 0 . '%',
                'total_absent' => $totalAbsent, // Total siswa yang tidak hadir
                'percentage_absent' => $totalAbsent > 0 ? round(($totalAbsent / $totalStudentsInGrade) * 100, 2) . '%' : 0 . '%',
                'total_leave' => $totalLeave, // Total izin dan sakit
                'percentage_leave' => $totalLeave > 0 ? round(($totalLeave / $totalStudentsInGrade) * 100, 2) . '%' : 0 . '%',
                'data' => $classDetails
            ];
        }

        return response([
            'status' => true,
            'messages' => 'Successfully retrieved data',
            'data' => [
                'classes' => $classes
            ]
        ]);
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
            'teacher_names' => $currentRoutines->pluck('teacher.name')->toArray(),
            'lesson_names' => $currentRoutines->pluck('subject.name')->toArray(),
            'attendance_data' => collect($attendanceData)->sortBy('course_name')->values()->all()
        ];
    }


    private function prepareClassData($classNames)
    {
        $classDetails = [];

        foreach ($classNames as $courseName) {
            // Ambil data kursus berdasarkan nama kelas (course_name)
            $course = Course::where('name', $courseName)->first();

            if ($course) {
                // Ambil data siswa yang terhubung dengan kursus ini
                $students = $course->user;

                // Hitung kehadiran, absen, dan izin untuk masing-masing siswa
                $totalAttendance = $students->where('attendance_status', 'present')->count();
                $totalAbsent = $students->where('attendance_status', 'absent')->count();
                $totalLeave = $students->where('attendance_status', 'leave')->count();

                // Format data per subkelas
                $classDetails[] = [
                    'id' => $course->id,  // ID dari kursus
                    'name' => $course->name,
                    'total_student_attendance' => $totalAttendance,
                    'total_student_absent' => $totalAbsent,
                    'total_student_leave' => $totalLeave
                ];
            }
        }

        return $classDetails;
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
        // Tentukan waktu hadir standar (misalnya pukul 07:00:00)
        $standardTime = Carbon::createFromFormat('H:i:s', '07:00:00');

        if ($role === 'student') {
            return AttendanceStudent::with(['user', 'user.course'])
                ->where('date', $today)
                ->whereHas('user', function ($query) use ($role) {
                    $query->where('role', $role);
                })
                ->orderBy('time_in', 'desc')
                ->limit(20)
                ->get(['id', 'user_id', 'date', 'time_in', 'time_out', 'latlon_in', 'latlon_out'])
                ->map(function ($attendance) use ($standardTime) {
                    $attendance->user_name = $attendance->user->name;

                    // Get single course name instead of array
                    $attendance->course = $attendance->user->course->first() ? $attendance->user->course->first()->name : null;

                    $timeIn = Carbon::parse($attendance->time_in);
                    $lateness = $standardTime->diffInMinutes($timeIn, false);
                    $attendance->lateness = $lateness > 0 ? "{$lateness} menit" : 'Tepat Waktu';

                    return $attendance;
                });
        } elseif ($role === 'teacher') {
            // Untuk guru, ambil data dari attendance_teachers
            return Attendance::with(['user'])
                ->where('date', $today) // Memastikan data berdasarkan tanggal yang sama
                ->whereHas('user', function ($query) use ($role) {
                    $query->where('role', $role); // Memastikan hanya data dengan role guru
                })
                ->orderBy('time_in', 'desc') // Mengurutkan berdasarkan waktu masuk (terbaru)
                ->limit(20) // Membatasi hanya 20 guru terakhir
                ->get(['id', 'user_id', 'date', 'time_in', 'time_out', 'latlon_in', 'latlon_out']) // Mengambil field yang relevan
                ->map(function ($attendance) use ($standardTime) {
                    $attendance->user_name = $attendance->user->name; // Menambahkan nama pengguna

                    // Menghitung keterlambatan (lateness)
                    $timeIn = Carbon::parse($attendance->time_in);
                    $lateness = $standardTime->diffInMinutes($timeIn, false); // Menghitung selisih dalam menit
                    $lateness = $lateness > 0 ? "{$lateness} menit" : 'Tepat Waktu'; // Menampilkan 'Tepat Waktu' jika tidak terlambat

                    $attendance->lateness = $lateness; // Menambahkan lateness
                    return $attendance;
                });
        } elseif ($role === 'Administration') {
            // Untuk admin, ambil data dari attendance_admins
            return Attendance::with(['user'])
                ->where('date', $today) // Memastikan data berdasarkan tanggal yang sama
                ->whereHas('user', function ($query) use ($role) {
                    $query->where('role', $role); // Memastikan hanya data dengan role admin
                })
                ->orderBy('time_in', 'desc') // Mengurutkan berdasarkan waktu masuk (terbaru)
                ->limit(20) // Membatasi hanya 20 admin terakhir
                ->get(['id', 'user_id', 'date', 'time_in', 'time_out', 'latlon_in', 'latlon_out']) // Mengambil field yang relevan
                ->map(function ($attendance) use ($standardTime) {
                    $attendance->user_name = $attendance->user->name; // Menambahkan nama pengguna

                    // Menghitung keterlambatan (lateness)
                    $timeIn = Carbon::parse($attendance->time_in);
                    $lateness = $standardTime->diffInMinutes($timeIn, false); // Menghitung selisih dalam menit
                    $lateness = $lateness > 0 ? "{$lateness} menit" : 'Tepat Waktu'; // Menampilkan 'Tepat Waktu' jika tidak terlambat

                    $attendance->lateness = $lateness; // Menambahkan lateness
                    return $attendance;
                });
        }

        // Jika role bukan student atau teacher, bisa mengembalikan response kosong atau error
        return response()->json([
            'status' => false,
            'message' => 'Invalid role or data not found.'
        ]);
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
        $studentDetails = $this->getDetailedAttendance('student', $today, $settingTimeIn);

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
            'teacher_absent' => User::where('role', 'teacher')->count() - ($teacherAttendance + $teacherLeave->count()),
            'student_absent' => User::where('role', 'student')->count() - ($studentAttendance + $studentLeave->count()),
            'admin_absent' => User::where('role', 'Administration')->count() - ($adminAttendance + $adminLeave->count()),
            'teacher_details' => $teacherDetails,
            'admin_details' => $adminDetails,
            'student_details' => $studentDetails, // Menambahkan detail siswa
            'teacher_leave' => $teacherLeave->count(),
            'student_leave' => $studentLeave->count(),
            'admin_leave' => $adminLeave->count(),
            'teacher_leave_details' => $this->getDetailedLeave('Teacher', $today),
            'student_leave_details' => $this->getDetailedLeave('Student', $today),
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

        $attendanceDetails = [];

        foreach ($attendances as $attendance) {
            $lateness = null;
            $isLate = false;

            // Jika waktu masuk ditentukan dan waktu hadir ada
            if ($settingTimeIn && $settingTimeIn->time_in && $attendance->time_in) {
                $settingTime = Carbon::createFromFormat('H:i:s', $settingTimeIn->time_in);
                $timeIn = Carbon::createFromFormat('H:i:s', $attendance->time_in);

                // Jika waktu masuk lebih lambat dari waktu yang ditentukan
                if ($timeIn->gt($settingTime)) {
                    $isLate = true;
                    $lateness = $settingTime->diffInMinutes($timeIn); // Hitung keterlambatan dalam menit
                }
            }

            // Simpan data ke dalam array
            $attendanceDetails[] = [
                'id' => $attendance->id,
                'user_id' => $attendance->user_id,
                'date' => $attendance->date,
                'time_in' => $attendance->time_in,
                'lateness' => $lateness, // Lateness yang dihitung
                'is_late' => $isLate // Status apakah terlambat atau tidak
            ];
        }

        return $attendanceDetails;
    }




    private function getDetailedLeave($role, $today)
    {
        return Leave::with(['user', 'type:id,name']) // Mengambil relasi user dan type dengan kolom id, name dari type
            ->where('start', $today)
            ->whereHas('user', function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->select('id', 'user_id', 'title as description', 'leave_type_id', 'start', 'end', 'status')
            ->get() // Mengambil data
            ->map(function ($leave) {
                // Menghitung jumlah hari antara start dan end
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

        // Ambil semua nama course
        $courseNames = Course::orderBy('id')->pluck('name');

        // Pisahkan berdasarkan kelas (X, XI, XII)
        $classX = [];
        $classXI = [];
        $classXII = [];

        foreach ($courseNames as $courseName) {
            // Tentukan kelas berdasarkan nama
            if (strpos($courseName, 'X ') === 0) {
                $classX[] = $courseName;
            } elseif (strpos($courseName, 'XI ') === 0) {
                $classXI[] = $courseName;
            } elseif (strpos($courseName, 'XII ') === 0) {
                $classXII[] = $courseName;
            }
        }

        return [
            'total' => Course::count(),
            'absent' => Course::count() - $classRoutines->count(),
            'class_x' => $classX,
            'class_xi' => $classXI,
            'class_xii' => $classXII
        ];
    }
}
