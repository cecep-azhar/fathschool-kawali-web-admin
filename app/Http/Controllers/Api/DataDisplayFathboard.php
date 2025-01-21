<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceStudent;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Quote;
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

        // Get class data and decode the JSON response
        $classResponse = $this->getDataClass();
        $responseContent = json_decode($classResponse->getContent());
        $classData = $responseContent->data->classes;

        // Calculate total students from all grades (X, XI, XII)
        $raw_total_students = 0;
        $raw_total_present = 0;
        $raw_total_absent = 0;
        $raw_total_leave = 0;

        // Aggregate data from all classes
        foreach ($classData as $grade) {
            $raw_total_students += $grade->total_students;
            $raw_total_present += $grade->total_present;
            $raw_total_absent += $grade->total_absent;
            $raw_total_leave += $grade->total_leave;
        }

        // Calculate percentages using raw numbers
        $presentPercentage = $raw_total_students > 0 ?
            round(($raw_total_present / $raw_total_students) * 100, 2) . '%' : '0%';
        $absentPercentage = $raw_total_students > 0 ?
            round(($raw_total_absent / $raw_total_students) * 100, 2) . '%' : '0%';
        $leavePercentage = $raw_total_students > 0 ?
            round(($raw_total_leave / $raw_total_students) * 100, 2) . '%' : '0%';

        // Get attendance details
        $presentStudents = $this->getDetailedPresent('student', $today);
        $absentStudents = $this->getDetailedAbsent('student', $today);
        $leaveStudents = $this->getDetailedLeave('Student', $today);

        // Format the numbers after calculations are done
        $total_students = number_format($raw_total_students);
        $total_present = number_format($raw_total_present);
        $total_absent = number_format($raw_total_absent);
        $total_leave = number_format($raw_total_leave);

        $response = [
            'status' => true,
            'messages' => 'Successfully retrieved data',
            'data' => [
                'students' => [
                    'total' => $total_students,
                    'present' => $total_present,
                    'absent' => $total_absent,
                    'leave' => $total_leave,
                    'presentPercentage' => $presentPercentage,
                    'absentPercentage' => $absentPercentage,
                    'leavePercentage' => $leavePercentage,
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
                    })->get()->unique('id');

                // Update total siswa per grade
                $totalStudentsInGrade += $studentsInClass->count();

                // Get jumlah kehadiran
                $attendance = AttendanceStudent::whereHas('user', function ($query) use ($className) {
                    $query->whereHas('course', function ($subQuery) use ($className) {
                        $subQuery->where('courses.name', $className);
                    });
                })
                    ->whereDate('date', $today)
                    ->get()
                    ->unique('user_id');

                $standardTime = Carbon::createFromFormat('H:i:s', '07:00:00');

                // List siswa yang hadir
                $studentsPresent = $attendance->map(function ($att) use ($standardTime) {
                    // Mendapatkan nama pengguna dan nama mata kuliah
                    $att->user_name = $att->user->name;
                    $att->course = $att->user->course->first() ? $att->user->course->first()->name : null;

                    // Menghitung keterlambatan
                    $timeIn = Carbon::parse($att->time_in);
                    $lateness = $standardTime->diffInMinutes($timeIn, false);

                    // Menentukan status berdasarkan keterlambatan
                    $att->status = $lateness > 0 ? "Terlambat {$lateness} Menit" : 'Tepat Waktu';

                    // Mengembalikan data dalam format yang diinginkan
                    return [
                        'id' => $att->user_id,
                        'name' => $att->user->name,
                        'course' => $att->user->course->first() ? $att->user->course->first()->name : null,
                        'status' => $att->status
                    ];
                })->unique('id')->values();

                // List siswa yang tidak hadir
                $studentsAbsent = $studentsInClass->reject(function ($student) use ($attendance) {
                    return $attendance->contains('user_id', $student->id); // Mencari siswa yang hadir
                })->map(function ($student) {
                    return [
                        'id' => $student->id,   // Menambahkan id siswa
                        'name' => $student->name // Nama siswa
                    ];
                })->unique('id')->values();

                // Update total siswa yang hadir
                $totalPresent += $attendance->count();

                // Get jumlah izin dan sakit
                $leaves = Leave::with(['user', 'type:id,name']) // Mengambil relasi user dan type
                    ->whereHas('user', function ($query) use ($className) {
                        $query->whereHas('course', function ($subQuery) use ($className) {
                            $subQuery->where('courses.name', $className);
                        });
                    })
                    ->whereDate('start', '<=', $today)
                    ->whereDate('end', '>=', $today)
                    ->get()
                    ->unique('user_id')
                    ->map(function ($leave) use ($today) {
                        // Ambil deskripsi leave spesifik berdasarkan ID
                        $leaveDetails = $this->getDetailedLeave2($leave->id);

                        // Pastikan deskripsi dari leaveDetails diambil dan dimasukkan
                        if ($leaveDetails) {
                            $leave->description = $leaveDetails->description;  // Menambahkan deskripsi yang sesuai
                            $leave->status = $leaveDetails->status ?? 'Approved';  // Status, jika tidak ada status maka 'Approved'
                        } else {
                            $leave->description = 'No Description Available';  // Deskripsi default
                            $leave->status = 'Pending';  // Status default
                        }

                        // Nama user yang mengajukan leave
                        $leave->user_name = $leave->user->name;

                        // Menghitung jumlah hari antara start dan end
                        $start = Carbon::parse($leave->start);
                        $end = Carbon::parse($leave->end);
                        $leave->days = $start->diffInDays($end) + 1;

                        return [
                            'id' => $leave->id,
                            'user_id' => $leave->user_id,
                            'name' => $leave->user_name, // Nama user
                            'description' => $leave->description, // Deskripsi leave
                            'status' => $leave->status, // Status leave
                            'days' => $leave->days, // Total hari
                        ];
                    })->values();

                // Hitung jumlah yang tidak hadir
                $absent = $studentsInClass->count() - ($attendance->count() + $leaves->count());

                // Menambahkan total absent dan leave
                $totalAbsent += $absent;
                $totalLeave += $leaves->count();

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
                    'course_photo' => Course::where('name', $className)->value('photo'),
                    'status' => $isActive ? 'Active' : 'Empty',  // Active or Empty
                    'teacher' => $isActive ? $classRoutine->teacher->name : '-',
                    'lesson' => $isActive ? $classRoutine->subject->name : '-',
                    'students_present' => [
                        'total_student_present' => $studentsPresent->count(),
                        'data' => $studentsPresent->map(function ($student) {
                            return [
                                'id' => $student['id'],
                                'name' => $student['name'],
                                'status' => $student['status'], // Semua siswa dalam present dianggap hadir
                            ];
                        })
                    ],
                    'students_absent' => [
                        'total_student_absent' => $studentsAbsent->count(),
                        'data' => $studentsAbsent->map(function ($student) {
                            return [
                                'id' => $student['id'],
                                'name' => $student['name'],
                                'status' => 'Absent', // Semua siswa dalam absent dianggap tidak hadir
                            ];
                        })
                    ],
                    'students_leave' => [
                        'total_student_leave' => $leaves->count(),
                        'data' => $leaves->map(function ($leave) {
                            return [
                                'id' => $leave['user_id'], // Asumsikan leave memiliki relasi ke student
                                'name' => $leave['name'],
                                'status' => $leave['description'], // Status untuk siswa yang cuti
                            ];
                        })
                    ]
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
                'percentage_present' => $totalStudentsInGrade > 0 ? round(($totalPresent / $totalStudentsInGrade) * 100, 2) . '%' : '0%',
                'total_absent' => $totalAbsent, // Total siswa yang tidak hadir
                'percentage_absent' => $totalStudentsInGrade > 0 ? round(($totalAbsent / $totalStudentsInGrade) * 100, 2) . '%' : '0%',
                'total_leave' => $totalLeave, // Total izin dan sakit
                'percentage_leave' => $totalStudentsInGrade > 0 ? round(($totalLeave / $totalStudentsInGrade) * 100, 2) . '%' : '0%',
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



    public function getDataOther()
    {
        return response([
            'status' => true,
            'messages' => 'Successfully retrieved data',
            'data' => [
                'quote_of_the_day' => Quote::pluck('quote'),
            ]
        ]);
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
                ->limit(50)
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
        if ($role == 'student' || $role == 'Student') {
            $users = User::with('course')
                ->where('role', $role)
                ->whereNotIn('id', function ($query) use ($today) {
                    $query->select('user_id')
                        ->from('attendance_students')
                        ->where('date', $today);
                })
                ->orderBy('name', 'asc')
                ->limit(50)
                ->get();

            return $users->map(function ($user) {
                $initials = collect(explode(' ', $user->name))
                    ->map(function ($word) {
                        return substr($word, 0, 1);
                    })->join('+');

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'role' => $user->role,
                    'course' => optional($user->course->first())->name,
                    'profile_photo_url' => $user->profile_photo_path ??
                        "https://ui-avatars.com/api/?name={$initials}&color=7F9CF5&background=EBF4FF",
                ];
            });
        } else {
            return User::where('role', $role)
                ->whereNotIn('id', function ($query) use ($today) {
                    $query->select('user_id')
                        ->from('attendances')
                        ->where('date', $today);
                })
                ->orderBy('name', 'asc')
                ->get(['id', 'name', 'role', 'profile_photo_path'])
                ->map(function ($user) {
                    $defaultImage = 'https://ui-avatars.com/api/?name=' . urlencode(implode('+', array_map(function ($name) {
                        return substr($name, 0, 1);
                    }, explode(' ', $user->name)))) . '&color=7F9CF5&background=EBF4FF';

                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'role' => $user->role,
                        'profile_photo_url' => $user->profile_photo_path ?? $defaultImage,
                    ];
                });
        }
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
        return Leave::with(['user.course', 'type:id,name'])
            ->where('start', $today)
            ->whereHas('user', function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->select('id', 'user_id', 'title as description', 'leave_type_id', 'start', 'end', 'status')
            ->get()
            ->map(function ($leave) use ($role) {
                $start = Carbon::parse($leave->start);
                $end = Carbon::parse($leave->end);
                $leave->days = $start->diffInDays($end) + 1;

                if ($role === 'Student') {
                    $leave->course = $leave->user->course->first() ? $leave->user->course->first()->name : null;
                }

                $leave->user_name = $leave->user->name;
                $leave->leave_type = $leave->type->name;

                return $leave;
            });
    }

    private function getDetailedLeave2($leaveId)
    {
        return Leave::with(['user', 'type:id,name']) // Mengambil relasi user dan type
            ->where('id', $leaveId) // Filter berdasarkan ID leave yang spesifik
            ->select('id', 'user_id', 'title as description', 'leave_type_id', 'start', 'end', 'status')
            ->first(); // Ambil hanya satu leave yang sesuai
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
