<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\ExportTeacherAttendance;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
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
