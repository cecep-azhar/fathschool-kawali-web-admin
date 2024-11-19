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
use App\Services\Admin\Subject\SubjectChatGroupService;
use Barryvdh\DomPDF\Facade\Pdf;
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

        // Ambil data kehadiran beserta nama pengguna
        // Query awal untuk Attendance
        $attendance_query = Attendance::with([
            'user:id,name,department_id',
            'user.department:id,name,study_program_id',
            'user.department.study_program:id,name',
        ]);

        // Filter berdasarkan keyword
        if ($request->has('keyword') && $request->keyword !== null) {
            $attendance_query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->keyword . '%'); // Filter nama user
            });
        }

        // Filter berdasarkan study_program
        if ($request->has('study_program') && $request->study_program !== null) {
            $attendance_query->whereHas('user.department.study_program', function ($q) use ($request) {
                $q->where('slug', 'LIKE', '%' . $request->study_program . '%'); // Filter nama study_program
            });
        }

        // Eksekusi query
        $attendanceteacher = $attendance_query->get(['id', 'user_id', 'date', 'time_in', 'time_out', 'latlon_in', 'latlon_out']);
        $study_programs = StudyProgram::get(['id', 'name', 'slug']);

        return inertia('Admin/TeacherAttendance/Index', [
            'attendanceteacher' => $attendanceteacher,
            'filter_data' => $request,
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
