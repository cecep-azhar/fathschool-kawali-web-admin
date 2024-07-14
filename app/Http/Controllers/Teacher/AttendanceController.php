<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\ExportTeacherAttendance;
use App\Http\Controllers\Controller;
use App\Models\Api\ClassAttendance;
use App\Models\Attendance;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Setting;
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
    public function index()
    {
        abort_if(! userCan('academic.management'), 403);

        // Ambil data kehadiran beserta nama pengguna
        $attendanceteacher = Attendance::with('user:id,name')->get(['id', 'user_id', 'date', 'time_in', 'time_out', 'latlon_in', 'latlon_out']);

        // Map untuk menyertakan nama pengguna
        $attendanceteacher->each(function ($attendance) {
            $attendance->user_name = $attendance->user->name;
        });

        return inertia('Admin/TeacherAttendance/Index', ['attendanceteacher' => $attendanceteacher]);
    }

    public function getTeacherClassAttendance()
    {
        // Ambil data absensi kelas dari class_attendance
        $teacherAttendances = ClassAttendance::with('user')
            ->select('class_attendances.*')
            ->join('class_routines', function ($join) {
                $join->on('class_attendances.date', '>=', 'class_routines.start_date')
                     ->whereRaw("class_attendances.time_in BETWEEN class_routines.start_time AND class_routines.end_time");
            })
            ->get();
    
        // Ambil informasi tambahan seperti nama kelas dan mata pelajaran dari class_routines
        foreach ($teacherAttendances as $attendance) {
            $classRoutine = ClassRoutine::where('start_date', '<=', $attendance->date)
                ->where('end_date', '>=', $attendance->date)
                ->whereTime('start_time', '<=', $attendance->time_in)
                ->whereTime('end_time', '>=', $attendance->time_in)
                ->first();
    
            if ($classRoutine) {
                // Ambil nama kelas dari relasi course pada class_routines
                $attendance->class_name = $classRoutine->course->name; // Pastikan 'name' sesuai dengan atribut nama kelas
    
                // Ambil nama mata pelajaran dari relasi subject pada class_routines
                $attendance->subject_name = $classRoutine->subject->name; // Pastikan 'name' sesuai dengan atribut nama mata pelajaran
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
