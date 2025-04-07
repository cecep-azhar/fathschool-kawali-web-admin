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

        // jika tidak ada paramater month, gunakan bulan ini sebagai default
        $month = $request->input('month', Carbon::now()->format('Y-m')); // Format YYYY-MM
        try {
            $start_date = Carbon::createFromFormat('Y-m', $month)->startOfMonth()->toDateString();
            $end_date = Carbon::createFromFormat('Y-m', $month)->endOfMonth()->toDateString();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Format bulan tidak valid. Gunakan YYYY-MM.'], 400);
        }

        // Ambil daftar tanggal dalam bulan yang dipilih
        $dates = collect(Carbon::parse($start_date)->daysUntil($end_date))->map(fn($date) => $date->toDateString());

        // Query awal untuk mendapatkan guru
        $teachersQuery = User::where('role', 'teacher')
            ->with(['department.study_program', 'leaves']);

        if ($request->filled('keyword')) {
            $teachersQuery->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->filled('study_program')) {
            $teachersQuery->whereHas('user.department.study_program', function ($query) use ($request) {
                $query->where('slug', 'LIKE', '%' . $request->study_program . '%');
            });
        }

        $teachers = $teachersQuery->get();

        $attendances = Attendance::whereBetween('date', [$start_date, $end_date])
            ->get()
            ->groupBy('user_id');

        // Struktur data guru dan kehadiran
        $attendanceteacher = $teachers->map(function ($teacher) use ($dates, $attendances) {
            $userAttendances = $attendances->get($teacher->id, collect());

            // Hitung total izin berdasarkan jumlah hari izin dalam bulan
            $totalIjin = $teacher->leaves->filter(function ($leave) use ($dates) {
                return $leave->start <= $dates->last() && $leave->end >= $dates->first();
            })->sum(function ($leave) {
                return Carbon::parse($leave->start)->diffInDays(Carbon::parse($leave->end)) + 1;
            });

            // Ambil daftar tanggal izin
            $leaveDates = collect();
            foreach ($teacher->leaves as $leave) {
                $leavePeriod = collect(Carbon::parse($leave->start)->daysUntil($leave->end))->map(fn($date) => $date->toDateString());
                $leaveDates = $leaveDates->merge($leavePeriod);
            }

            // Inisialisasi data kehadiran per hari
            $attendanceStatus = $dates->mapWithKeys(function ($date) use ($userAttendances, $leaveDates) {
                if ($leaveDates->contains($date)) {
                    return [$date => 'Ijin']; // Jika ada izin
                }

                $attendance = $userAttendances->firstWhere('date', $date);
                return [$date => $attendance ? 'Hadir' : 'Alfa']; // Hadir atau Alfa
            });

            // Hitung total hadir dan alfa
            $totalHadir = $attendanceStatus->filter(fn($status) => $status === 'Hadir')->count();
            $totalAlfa = $attendanceStatus->filter(fn($status) => $status === 'Alfa')->count();

            return [
                'id' => $teacher->id,
                'name' => $teacher->name,
                'study_program' => $teacher->department->study_program->name ?? '-',
                'attendance' => $attendanceStatus,
                'summary' => [
                    'hadir' => $totalHadir,
                    'sakit' => 0, // Jika ada data sakit, bisa ditambahkan
                    'ijin' => $totalIjin,
                    'alfa' => $totalAlfa,
                ],
            ];
        });

        // Hitung total semua guru
        $total = [
            'hadir' => $attendanceteacher->sum(fn($teacher) => $teacher['summary']['hadir']),
            'sakit' => 0, // Sesuaikan jika ada data sakit
            'ijin' => $attendanceteacher->sum(fn($teacher) => $teacher['summary']['ijin']),
            'alfa' => $attendanceteacher->sum(fn($teacher) => $teacher['summary']['alfa']),
        ];

        $study_programs = StudyProgram::get(['id', 'name', 'slug']);

        dd($attendanceteacher);
        return inertia('Admin/TeacherAttendance/Index', [
            'attendanceteacher' => $attendanceteacher,
            'dates' => $dates,
            'total' => $total,
            'study_programs' => $study_programs,
            'filter_data' => [
                'month' => $month,
                'keyword' => $request->input('keyword'),
                'study_program' => $request->input('study_program'),
            ]
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
