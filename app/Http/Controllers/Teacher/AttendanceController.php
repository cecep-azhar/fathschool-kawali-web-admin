<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\ExportTeacherAttendance;
use App\Http\Controllers\Controller;
use App\Models\Api\ClassAttendance;
use App\Models\Attendance;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Setting;
use App\Models\StudyProgram;
use App\Models\Subject;
use App\Models\User;
use App\Services\Admin\Subject\SubjectChatGroupService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(! userCan('academic.management'), 403);

        // Set default dates if not provided
        if (!$request->has('start_date') && !$request->has('end_date')) {
            $start_date = Carbon::today()->toDateString();
            $end_date = Carbon::today()->toDateString();
            $request->merge([
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
        }

        // Query awal untuk Attendance
        $attendance_query = Attendance::with([
            'user:id,name,department_id',
            'user.department:id,name,study_program_id',
            'user.department.study_program:id,name',
        ])->whereHas('user', function ($query) {
            $query->whereNotIn('role', ['parent', 'student', 'admin', 'accountant']);
        });

        // Filter berdasarkan tanggal untuk attendance
        if ($request->has('start_date') && $request->has('end_date')) {
            $attendance_query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Filter berdasarkan keyword untuk attendance
        if ($request->has('keyword') && $request->keyword !== null) {
            $attendance_query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->keyword . '%');
            });
        }

        // Filter berdasarkan study_program untuk attendance
        if ($request->has('study_program') && $request->study_program !== null) {
            $attendance_query->whereHas('user.department.study_program', function ($q) use ($request) {
                $q->where('slug', 'LIKE', '%' . $request->study_program . '%');
            });
        }

        // Eksekusi query attendance
        $attendanceteacher = $attendance_query->get([
            'id', 'user_id', 'date', 'time_in', 'time_out', 'latlon_in', 'latlon_out'
        ]);

        // Query untuk total guru yang sesuai filter
        $totalTeacherQuery = User::whereNotIn('role', ['parent', 'student', 'admin', 'accountant']);

        if ($request->has('keyword') && $request->keyword !== null) {
            $totalTeacherQuery->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->has('study_program') && $request->study_program !== null) {
            $totalTeacherQuery->whereHas('department.study_program', function ($query) use ($request) {
                $query->where('slug', 'LIKE', '%' . $request->study_program . '%');
            });
        }

        // Get unique teacher IDs who have attendance in the date range
        $presentTeacherIds = $attendanceteacher->where('time_in', '!=', null)
            ->pluck('user_id')
            ->unique();

        // Query untuk guru yang tidak hadir
        $absent_query = User::with([
            'department:id,name,study_program_id',
            'department.study_program:id,name',
            'leaves.type'
        ])
        ->whereNotIn('role', ['parent', 'student', 'admin', 'accountant'])
        ->whereNotIn('id', $presentTeacherIds); // Exclude teachers who are present

        // Apply filters to absent query
        if ($request->has('keyword') && $request->keyword !== null) {
            $absent_query->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->has('study_program') && $request->study_program !== null) {
            $absent_query->whereHas('department.study_program', function ($q) use ($request) {
                $q->where('slug', 'LIKE', '%' . $request->study_program . '%');
            });
        }

        // Get absent teachers
        $absentTeachers = $absent_query->get(['id', 'name']);

        // Load leaves for absent teachers within date range
        $absentTeachers->load(['leaves' => function ($query) use ($request) {
            $query->whereBetween('start', [$request->start_date, $request->end_date])
                ->with('type');
        }]);

        // Add date property to absent teachers
        $absentTeachers = $absentTeachers->map(function ($teacher) use ($request) {
            $teacher->date = $request->start_date;
            return $teacher;
        });

        // Calculate statistics
        $totalTeacher = $totalTeacherQuery->count();
        $totalPresent = $presentTeacherIds->count();
        $totalAbsent = $totalTeacher - $totalPresent;

        $attendancePercentage = $totalTeacher > 0 ? round(($totalPresent / $totalTeacher) * 100) : 0;
        $absencePercentage = $totalTeacher > 0 ? round(($totalAbsent / $totalTeacher) * 100) : 0;

        // Get study programs for filter
        $study_programs = StudyProgram::get(['id', 'name', 'slug']);

        // Calculate lateness if setting exists
        $settingTimeIn = Setting::select(['time_in'])->first();

        if ($settingTimeIn && $settingTimeIn->time_in) {
            $settingTime = Carbon::createFromFormat('H:i:s', $settingTimeIn->time_in);

            $attendanceteacher->map(function ($attendance) use ($settingTime) {
                if ($attendance->time_in) {
                    $attendanceTime = Carbon::createFromFormat('H:i:s', $attendance->time_in);
                    if ($attendanceTime->greaterThan($settingTime)) {
                        $latenessMinutes = $attendanceTime->diffInMinutes($settingTime);
                        $attendance->lateness = $latenessMinutes . ' minute';
                    } else {
                        $attendance->lateness = '0 minute';
                    }
                }
                return $attendance;
            });
        } else {
            return response()->json(['error' => 'Setting time_in not found or invalid.'], 400);
        }

        // Return view with data
        return inertia('Admin/TeacherAttendance/Index', [
            'attendanceteacher' => $attendanceteacher,
            'absentTeachers' => $absentTeachers,
            'attendance_percentage' => $attendancePercentage,
            'absence_percentage' => $absencePercentage,
            'filter_data' => [
                'keyword' => $request->keyword,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'study_program' => $request->study_program
            ],
            'study_programs' => $study_programs
        ]);
    }

    public function getTeacherClassAttendance()
    {
        // Ambil data absensi kelas dari class_attendances
        $teacherAttendances = ClassAttendance::with('user')
            ->select('class_attendances.*')
            ->join('class_routines', function ($join) {
                $join->on('class_attendances.user_id', '=', 'class_routines.teacher_id')
                    ->on('class_attendances.course_id', '=', 'class_routines.course_id');
            })
            ->get();

        // Ambil informasi tambahan seperti nama kelas dan mata pelajaran dari class_routines
        foreach ($teacherAttendances as $attendance) {
            $classRoutine = ClassRoutine::where('teacher_id', $attendance->user_id)
                ->where('course_id', $attendance->course_id)
                ->first();

            if ($classRoutine) {
                // Ambil informasi kelas dari model Course yang terhubung dengan ClassRoutine
                $course = Course::find($classRoutine->course_id);
                $attendance->class_name = $course ? $course->name : 'Nama Kelas Tidak Ditemukan';

                // Ambil informasi mata pelajaran dari model Subject yang terhubung dengan ClassRoutine
                $subject = Subject::find($classRoutine->subject_id);
                $attendance->subject_name = $subject ? $subject->name : 'Nama Mata Pelajaran Tidak Ditemukan';
            }
        }

        return inertia('Admin/Report/TeacherClassAttendance', ['teacherAttendances' => $teacherAttendances]);
    }



    public function attendancesExport(Request $request)
    {
        $student = auth()->id();
        $subject = $request->subject['id'];
        $type = $request->type;

        if ($type == 'xlsx') { // xlsx

            return Excel::download(new ExportTeacherAttendance($student, $subject), 'attendances.xlsx');
        } else { // pdf

            $attendances = Attendance::with('student', 'teacher', 'subject')->where('student_id', $student)->where('subject_id', $subject)->get();
            $settings = Setting::first();

            $pdf = PDF::loadView('export.student_attendance', compact('attendances', 'settings'));

            return $pdf->download('attendances.pdf');
        }
    }
}
