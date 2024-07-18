<?php

namespace App\Http\Controllers\Report;

use App\Exports\ExportAdminStudentAttendance;
use App\Exports\ExportResult;
use App\Exports\ExportTransaction;
use App\Exports\StudentExport;
use App\Http\Controllers\Controller;
use App\Models\AttendanceStudent;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Currency;
use App\Models\Rating;
use App\Models\Result;
use App\Models\Setting;
use App\Models\StudentAttendance;
use App\Models\Subject;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserProfile;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the reports.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!userCan('report.index'), 403);

        return inertia('Admin/Report/Index');
    }

    public function attendance()
    {
        abort_if(! userCan('academic.management'), 403);

        // Ambil data kehadiran beserta nama pengguna
        // $attendancestudent =AttendanceStudent::with('user:id,name')->get(['id', 'user_id', 'date', 'time_in', 'time_out', 'latlon_in', 'latlon_out']);
        $attendancestudent = AttendanceStudent::with('user')->get(['id', 'user_id', 'date', 'time_in', 'time_out', 'latlon_in', 'latlon_out']);

        // Map untuk menyertakan nama pengguna
        $attendancestudent->each(function ($attendance) {   
            $attendance->user_name = $attendance->user->name;
            $attendance->user_id = $attendance->user->id;
        });
        
        // dd($attendancestudent);

        return inertia('Admin/Report/Attendance', ['attendancestudent' => $attendancestudent]);
}
public function studentExport(Request $request)
    {
        $name = $request->name;
        $month = $request->month;

        if ($name && $month) {
            // Filter berdasarkan nama dan bulan
            return Excel::download(new StudentExport($name, $month), 'student.xlsx');
        } elseif ($name) {
            // Filter berdasarkan nama
            return Excel::download(new StudentExport($name), 'student.xlsx');
        } elseif ($month) {
            // Filter berdasarkan bulan
            return Excel::download(new StudentExport(null, $month), 'student.xlsx');
        } else {
            // Tanpa filter (semua data)
            return Excel::download(new StudentExport(null), 'student.xlsx');
        }
    }

    /**
     * Display a listing of the reports income & expense.
     *
     * @return \Illuminate\Http\Response
     */
    public function transaction(Request $request)
    {
        abort_if(!userCan('report.transaction'), 403);

        $transactions_query = Transaction::query();

        // filter => keyword
        if ($request->has('keyword') && $request->keyword != null) {
            $transactions_query->where('title', 'Like', '%' . $request->keyword . '%');
        }

        // filter => user
        if ($request->has('parent_id') && $request->parent_id != null && $request->parent_id != 'all') {
            $transactions_query->where('user_id', $request->parent_id);
        }

        // filter => user
        if ($request->has('amountType') && $request->amountType != null && $request->amountType != 'all') {
            $transactions_query->whereHas('type', function ($q) use ($request) {
                return $q->where('type', $request->amountType);
            });
        }

        // filter => status
        if ($request->has('type') && $request->type != null && $request->type != 'all') {
            $transactions_query->where('status', $request->type);
        }

        $transactions = $transactions_query->with('type', 'user:id,name,username')->paginate(20)->withQueryString();
        $users = User::select('id', 'name')->active()->get();

        return inertia('Admin/Report/Transaction', [
            'users' => $users,
            'transactions' => $transactions,
            'filter_data' => $request,
        ]);
    }

    /**
     * Display a listing of the reports attendance.
     *
     * @return \Illuminate\Http\Response
     */

//      public function getCourses(Request $request)
// {
//     $student_id = $request->student_id;
//     $courses = Course::whereHas('userCourses', function($query) use ($student_id) {
//         $query->where('user_id', $student_id);
//     })->get();

//     return response()->json($courses);
// }

// public function getSubjects(Request $request)
// {
//     $courseId = $request->course_id;
//     $subjects = Subject::where('course_id', $courseId)->get();

//     return response()->json($subjects);
// }
// public function attendance(Request $request)
// {
//     abort_if(!userCan('report.attendance'), 403);

//     $courseId = $request->input('course_id');


//     $data['courses'] = Course::get();
//      $data['subjects'] = Subject::get();
//     // $data['subjects'] = Subject::byCourseId($courseId)->get();
//     $data['students'] = User::role('student')->get(); // Assuming users have a role 'student'

// //     $courseId = 17; // Misalkan ini id course yang Anda cari

// //     $data['subjects'] = Subject::whereHas('course', function ($query) use ($courseId) {
// //     $query->where('id', $courseId);
// // })->get();

//     if ($request->has('course_id')) {
//         $data['subjects'] = Subject::where('course_id', $request->course_id)->get();
//         $userCourse = UserCourse::where('course_id', $request->course_id)->pluck('user_id')->toArray();
//         $data['students'] = User::whereIn('id', $userCourse)->get();
//     }

//     $data['filter_data'] = $request->all();

//     // Attendance
//     $data['attendances'] = [];

//     $attendance_query = StudentAttendance::query();

//     if ($request->has('student_id') && $request->student_id != null) {
//         $attendance_query->where('student_id', $request->student_id);
//     }
//     if ($request->month && $request->year) {
//         $attendance_query->whereMonth('date', $request->month)->whereYear('date', $request->year);
//     }

//     if ($request->has('student_id') && $request->student_id != null) {
//         $data['attendances'] = $attendance_query->get();
//     }

//     return inertia('Admin/Report/Attendance', $data);
// }




    public function studentsEnroll()
    {
        return inertia('Admin/Report/StudentsEnroll');
    }

    public function exportStudentEnroll(Request $request)
    {
        $year = $request->input('year');
        $currentYear = date('Y');
        $currentMonth = date('n');
        $userCounts = [];

        for ($month = 1; $month <= 12; $month++) {
            if ($year == $currentYear && $month > $currentMonth) {
                break;
            }

            $startOfMonth = Carbon::createFromDate($year, $month, 1);
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            $userCount = User::whereRole('Student')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            $monthName = $startOfMonth->format('F');
            $userCounts[$monthName] = $userCount;
        }

        $courses = Course::withCount('students')->whereYear('created_at', '=', $year)->get();
        $totalStudents = User::whereRole('Student')->count();
        $currentYearStudentCount = User::whereRole('Student')
            ->whereYear('created_at', '=', $year)
            ->count();

        $prevYearStudentCount = User::whereRole('Student')
            ->whereYear('created_at', '=', $year - 1)
            ->count();

        $percentageChange = 100;

        if ($prevYearStudentCount == 0 && $currentYearStudentCount == 0) {
            $percentageChange = 0;
        }

        if ($prevYearStudentCount > 0) {
            $percentageChange = ($currentYearStudentCount - $prevYearStudentCount) * 100 / $prevYearStudentCount;
        }

        $settings = Setting::first();

        $pdf = Pdf::loadView('export.new.student_enroll_report', compact('userCounts', 'settings', 'courses', 'year', 'currentYearStudentCount', 'totalStudents', 'percentageChange'));

        return $pdf->download('student_enrollment_report.pdf');
    }

    /**
     * Display a listing of the reports others.
     *
     * @return \Illuminate\Http\Response
     */
    public function others()
    {
        return inertia('Admin/Report/Others');
    }

    /**
     * Display a listing of the reports others.
     *
     * @return \Illuminate\Http\Response
     */
    public function classRoutine(Request $request)
    {
        $routine_query = ClassRoutine::query();

        //filter ==> class
        if ($request->has('course_id') && $request->course_id != null && $request->course_id != 'all') {
            $routine_query->Where('course_id', $request->course_id);
        }

        //filter ==> teacher
        if ($request->has('teacher_id') && $request->teacher_id != null && $request->teacher_id != 'all') {
            $routine_query->Where('teacher_id', $request->teacher_id);
        }

        $routines = $routine_query->with(['course', 'teacher', 'subject'])->latest()->paginate(20);

        return inertia('Admin/Report/ClassRoutine', [
            'filter_data' => $request,
            'routines' => $routines,
            'classes' => Course::all(['id', 'name']),
            'teachers' => User::active()->teacher()->get(['id', 'name']),
        ]);
    }

    /**
     * Display a listing of the student report.
     *
     * @return \Illuminate\Http\Response
     */
    public function students(Request $request)
    {
        $classes = Course::all(['id', 'name']);
        $student_query = User::query()->active()->student();

        //filter ==> class
        if ($request->has('course_id') && $request->course_id != null && $request->course_id != 'all') {
            $student_query->whereHas('profile', function ($q) use ($request) {
                $q->Where('course_id', $request->course_id);
            });
        }

        //filter ==> keyword
        if ($request->has('keyword') && $request->keyword != null) {
            $student_query->where('name', 'Like', '%' . $request->keyword . '%')
                ->orWhere('email', 'Like', '%' . $request->keyword . '%');
        }

        $students = $student_query->latest()
            ->with('profile')
            ->paginate(15)->onEachSide(-1);

        return inertia('Admin/Report/Student', [
            'filter_data' => $request,
            'students' => $students,
            'classes' => $classes,
        ]);
    }

    /**
     * Export report as pdf or excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionExport(Request $request)
    {
        $type = $request->type;

        if ($type == 'xlsx') { // xlsx

            return Excel::download(new ExportTransaction($request->month), 'transaction.xlsx');
        } else { // pdf

            if ($request->month == 'this_month') {
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                $transactions = Transaction::whereDate('date', '>=', $start)->whereDate('date', '<=', $end)->latest()->with('type', 'user')->get();
            } elseif ($request->month == 'last_month') {
                $start = Carbon::now()->startOfMonth()->subMonth();
                $end = Carbon::now()->endOfMonth()->subMonth();
                $transactions = Transaction::whereDate('date', '>=', $start)->whereDate('date', '<=', $end)->latest()->with('type', 'user')->get();
            } else {
                $start = Carbon::now()->startOfMonth()->subMonths(6);
                $end = Carbon::now()->endOfMonth()->subMonths(6);
                $transactions = Transaction::whereDate('date', '>=', $start)->whereDate('date', '<=', $end)->latest()->with('type', 'user')->get();
            }

            $settings = Setting::first();

            $pdf = PDF::loadView('export.transaction', compact('transactions', 'settings'));

            return $pdf->download('transactions.pdf');
        }
    }

    /**
     * Export exam result data as pdf or excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function examResultsExport(Request $request)
    {
        $type = $request->type;

        if ($type == 'xlsx') { // xlsx

            return Excel::download(new ExportResult, 'result.xlsx');
        } else { // pdf

            $results = Result::latest()->with('exam', 'class')->get();
            $settings = Setting::first();

            $pdf = PDF::loadView('export.result', compact('results', 'settings'));

            return $pdf->download('results.pdf');
        }
    }

    /**
     * Export student attendance data as pdf or excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function attendanceExport(Request $request)
    {
        // Get the selected student, type (XLSX or PDF), subject, month, and year from the user input
        $student = $request->student;
        $type = $request->type;
        $year = $request->year;
        $month = $request->month;
        $subject = $request->subject;

        // Calculate the start and end dates for the selected month and year
        $start_date = '01-' . $month . '-' . $year;
        $end_date = '30-' . $month . '-' . $year;

        if ($type == 'xlsx') { // Export as XLSX

            // Generate an XLSX file using the 'ExportAdminStudentAttendance' class and return it for download
            return Excel::download(new ExportAdminStudentAttendance($student, $start_date, $end_date), 'attendances.xlsx');
        } else { // Export as PDF

            // Retrieve attendance data for the selected student, subject, and time period
            $attendances = StudentAttendance::with('student')
                ->where('student_id', $student)
                ->where('date', '>=', Carbon::parse($start_date))
                ->where('date', '<=', Carbon::parse($end_date))
                ->orderBy('date')
                ->get();

            // Get user profile and settings data for the PDF report
            $user = UserProfile::where('user_id', $student)->first();
            $settings = Setting::first();
            $student = User::find($student);

            // Calculate the number of days the student was marked present, late, and absent
            $present = $attendances->where('status', 'present')->count();
            $late = $attendances->where('status', 'late')->count();
            $absent = $attendances->where('status', 'absent')->count();

            // Get the name of the selected month
            $monthName = date('F', strtotime("2023-$month-01"));

            // Generate the PDF using the 'student_attendance' view with the retrieved data
            $pdf = Pdf::loadView('export.new.student_attendance', compact('attendances', 'user', 'settings', 'year', 'monthName', 'student', 'present', 'late', 'absent', 'subject'));

            // Stream the PDF to the user's browser for download with a descriptive filename
            return $pdf->stream($student->name . "'s_attendance_report " . $monthName . '-' . $year . '.pdf');
        }
    }

    public function studentFees(Request $request)
    {
        abort_if(!userCan('report.attendance'), 403);
        $data['courses'] = Course::get();
        $data['students'] = [];
        if ($request->has('course_id')) {
            $userCourse = UserCourse::where('course_id', $request->course_id)->pluck('user_id')->toArray();
            $data['students'] = User::whereIn('id', $userCourse)->get();
        }
        $data['filter_data'] = $request;

        return inertia('Admin/Report/StudentFees', $data);
    }

    public function studentFeesExport(Request $request)
    {
        $settings = Setting::first();
        $student = User::find($request->student);
        $transactions = Transaction::where('user_id', $request->student)->whereMonth('date', $request->month)->whereYear('date', $request->year)->get();

        $totalAmount = 0;
        foreach ($transactions as $transaction) {
            $fromRate = Currency::whereCode($transaction->currency)->first()->rate;
            $toRate = Currency::whereCode($settings->app_currency)->first()->rate;
            $rate = $fromRate / $toRate;
            $convertedAmount = (int) round($transaction->amount / $rate, 2);
            $transaction->convertedAmount = $convertedAmount;
            $totalAmount += $convertedAmount;
        }

        $paidAmount = 0;
        foreach ($transactions as $transaction) {
            if ($transaction->paid_amount > 0) {
                $fromRate = Currency::whereCode($transaction->currency)->first()->rate;
                $toRate = Currency::whereCode($settings->app_currency)->first()->rate;
                $rate = $fromRate / $toRate;
                $convertedPaidAmount = (int) round($transaction->paid_amount / $rate, 2);
                $paidAmount += $convertedPaidAmount;
            }
        }

        $currencySymbol = Currency::whereCode($settings->app_currency)->first()->symbol;
        $pdf = Pdf::loadView('export.new.student_fees', compact('settings', 'student', 'transactions', 'currencySymbol', 'totalAmount', 'paidAmount'));

        return $pdf->stream($student->name . "'s_fees_transaction_report_" . $request->month . '_' . $request->year . '.pdf');
    }

    public function subjectAttendance(Request $request)
    {
        // Check if the authenticated user has permission to access the attendance report
        abort_if(!userCan('report.attendance'), 403);

        // Initialize an empty array to store the data to be passed to the view
        $data = [];

        // Get all available courses
        $data['courses'] = Course::get();

        // Initialize empty arrays for subjects and students
        $data['subjects'] = [];
        $data['students'] = [];

        // Check if a course is selected in the user's request
        if ($request->has('course_id')) {
            // Fetch the subjects related to the selected course
            $data['subjects'] = Subject::where('course_id', $request->course_id)->get();
        }

        // Store the received filter data to be used in the Vue.js watch function for page updates
        $data['filter_data'] = $request;

        // Return the 'Admin/Report/SubjectAttendance' view with the necessary data for rendering the page
        return inertia('Admin/Report/SubjectAttendance', $data);
    }

    public function exportSubjectAttendanceReport(Request $request)
    {
        // Check if the authenticated user has permission to access the attendance report
        abort_if(!userCan('report.attendance'), 403);

        // Get the application settings
        $settings = Setting::first();

        // Get the selected year from the user input
        $year = $request->year;
        $month = $request->month;
        $subject_id = $request->subject;
        $course = $request->course;

        // Retrieve subject attendance data for the specified subject, month, and year
        $attendances = StudentAttendance::where('subject_id', $subject_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->with('student')
            ->select('student_id')
            ->groupBy('student_id')
            ->get();

        // Find the name of the selected subject
        $subject = Subject::find($subject_id)->name;

        // Calculate the total expected attendance based on the number of students in the course
        $totalAttendance = UserCourse::where('course_id', $course)->count() * Carbon::createFromDate($year, $month)->daysInMonth;

        // Calculate the total number of students marked as present, absent, and late for the subject
        $totalPresent = StudentAttendance::where('subject_id', $subject_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->where('status', 'present')
            ->count();
        $totalAbsent = StudentAttendance::where('subject_id', $subject_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->where('status', 'absent')
            ->count();
        $totalLate = StudentAttendance::where('subject_id', $subject_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->where('status', 'late')
            ->count();

        // Get the name of the selected month
        $monthName = date('F', strtotime("2023-$month-01"));

        // Generate the PDF using the 'subject_attendance' view with the retrieved data
        $pdf = Pdf::loadView('export.new.subject_attendance', compact(
            'attendances',
            'subject',
            'totalAttendance',
            'totalPresent',
            'totalAbsent',
            'subject_id',
            'totalLate',
            'settings',
            'year',
            'month',
            'monthName'
        ));

        // Stream the PDF to the user's browser for download with a descriptive filename
        return $pdf->stream($subject . '_attendance_for' . $monthName . '_' . $year . '.pdf');
    }

    public function allStudentFees(Request $request)
    {
        // Get all available courses
        $courses = Course::get();

        // Store the received filter data to be used in the Vue.js watch function for page updates
        $filter_data = $request;

        // Return the 'Admin/Report/AllFees' view with the necessary data for rendering the page
        return inertia('Admin/Report/AllFees', compact('courses', 'filter_data'));
    }

    public function allStudentFeesExport(Request $request)
    {
        // Get the application settings
        $settings = Setting::first();

        // Get the selected month and year from the user input
        $month = $request->month;
        $year = $request->year;

        // Find the course based on the selected course ID
        $course = Course::find($request->course);

        // Count the number of users enrolled in the selected course
        $userCount = UserCourse::where('course_id', $course->id)->count();

        // Get the user IDs of users enrolled in the selected course
        $userId = UserCourse::where('course_id', $course->id)->pluck('user_id')->toArray();

        // Retrieve all transactions for the selected month and year and for the enrolled users
        $transactions = Transaction::whereMonth('date', $request->month)
            ->whereYear('date', $request->year)
            ->whereIn('user_id', $userId)
            ->get();

        // Get the currency symbol for displaying amounts
        $currencySymbol = Currency::where('code', $settings->app_currency)->first()->symbol;

        $totalAmount = 0;
        // Calculate the total amount of all transactions in the application's currency
        foreach ($transactions as $transaction) {
            $fromRate = Currency::whereCode($transaction->currency)->first()->rate;
            $toRate = Currency::whereCode($settings->app_currency)->first()->rate;
            $rate = $fromRate / $toRate;
            $convertedAmount = (int) round($transaction->amount / $rate, 2);

            $totalAmount += $convertedAmount;

            // Store the converted amount in the transaction for display in the view
            $transaction->convertedAmount = $convertedAmount;
        }

        $paidAmount = 0;
        $paidtransaction = Transaction::whereMonth('date', $request->month)
            ->whereYear('date', $request->year)
            ->whereIn('user_id', $userId)
            ->whereStatus('paid')
            ->get();

        // Calculate the total paid amount of all transactions in the application's currency
        foreach ($paidtransaction as $value) {
            if ($value->paid_amount > 0) {
                $fromRate = Currency::whereCode($value->currency)->first()->rate;
                $toRate = Currency::whereCode($settings->app_currency)->first()->rate;
                $rate = $fromRate / $toRate;
                $convertedAmount = (int) round($value->paid_amount / $rate, 2);
                $paidAmount += $convertedAmount;
            }
        }
        $monthName = date('F', strtotime("2023-$request->month-01"));

        // Generate the PDF using the 'allFees' view with the retrieved data
        $pdf = Pdf::loadView('export.new.allFees', compact('settings', 'course', 'userCount', 'userId', 'transactions', 'totalAmount', 'paidAmount', 'monthName', 'year'));

        // Stream the PDF to the user's browser for download with a descriptive filename
        return $pdf->stream('Student_fees_report_for_course' . $course->name . '_at_' . $monthName . '_' . $year . '.pdf');
    }

    public function expense(Request $request)
    {
        $filter_data = $request;

        return inertia('Admin/Report/ExpenseReport', compact('filter_data'));
    }

    public function expenseReportExport(Request $request)
    {
        $settings = Setting::first();
        $month = $request->month;
        $year = $request->year;
        $monthName = date('F', strtotime("2023-$month-01"));
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $type_id = TransactionType::whereType('expense')->pluck('id')->toArray();

        $transactions = Transaction::whereMonth('date', $month)->whereYear('date', $year)->whereIn('transaction_type_id', $type_id)->select(['id', 'title', 'amount', 'currency', 'date', 'paid_amount'])->get();

        $totalAmount = 0;
        foreach ($transactions as $transaction) {
            $fromRate = Currency::whereCode($transaction->currency)->first()->rate;
            $toRate = Currency::whereCode($settings->app_currency)->first()->rate;
            $rate = $fromRate / $toRate;
            $convertedAmount = (int) round($transaction->amount / $rate, 2);

            $totalAmount += $convertedAmount;

            // Store the converted amount in the transaction for display in the view
            $transaction->convertedAmount = $convertedAmount;
        }

        if ($totalAmount > 0) {
            $averageExpense = $totalAmount / $daysInMonth;
        } else {
            $averageExpense = 0;
        }

        $pdf = Pdf::loadView('export.new.school_expense', compact('settings', 'monthName', 'year', 'transactions', 'transactions', 'totalAmount', 'averageExpense'));

        // Stream the PDF to the user's browser for download with a descriptive filename
        return $pdf->stream('School_expense_report_for' . $monthName . '_' . $year . '.pdf');
    }

    public function rating()
    {
        abort_if(! userCan('academic.management'), 403);

        // Ambil semua data rating dengan relasi user, teacher, dan course
        $teacherRatings = Rating::with(['user:id,name', 'teacher:id,name', 'course:id,name'])
            ->select('id', 'teacher_id', 'course_id', 'rating', 'comment', 'created_at')
            ->get();

        // Mengubah struktur data untuk menambahkan informasi nama pengguna, nama teacher, dan nama course
        $teacherRatings->each(function ($rating) {
            $rating->teacher_name = $rating->teacher->name;
            $rating->course_name = $rating->course->name;
            $rating->created_date = $rating->created_at->format('Y-m-d'); // Format tanggal
            unset($rating->teacher); // Hapus relasi teacher setelah digunakan
            unset($rating->course); // Hapus relasi course setelah digunakan
            unset($rating->created_at); // Hapus original created_at setelah digunakan
        });

        // Kembalikan respons menggunakan Inertia.js dengan data teacherRatings
        return inertia('Admin/Report/RatingTeacher', compact('teacherRatings'));
    }

}
