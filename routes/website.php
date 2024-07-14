<?php

use App\Http\Controllers\Academic\AssignmentController;
use App\Http\Controllers\Academic\ClassRoutineController;
use App\Http\Controllers\Academic\CourseController;
use App\Http\Controllers\Academic\DepartmentController;
use App\Http\Controllers\Academic\ExamController;
use App\Http\Controllers\Academic\ExamResultController;
use App\Http\Controllers\Academic\GradeController;
use App\Http\Controllers\Academic\ResultRuleController;
use App\Http\Controllers\Academic\SyllabusController;
use App\Http\Controllers\AuthDashboardController;
use App\Http\Controllers\Cms\CmsController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\Holiday\HolidayController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Leave\LeaveController as AdminLeaveController;
use App\Http\Controllers\Leave\LeaveTypeController;
use App\Http\Controllers\Meeting\MeetingController;
use App\Http\Controllers\Notice\NoticeBoardController;
use App\Http\Controllers\Plan\PlanController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\Setting\WebsiteSettingController;
use App\Http\Controllers\Sms\SmsController;
use App\Http\Controllers\Sms\TemplateController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Transaction\TransactionTypeController;
use App\Http\Controllers\User\AdmissionFormController;
use App\Http\Controllers\User\SingleTeacherController;
use App\Http\Controllers\User\StudentAttendanceController;
use App\Http\Controllers\User\StudentController;
use App\Http\Controllers\User\StudentDashboardController;
use App\Http\Controllers\User\TeacherController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        // Users Routes
        Route::resource('users', UserController::class);
        Route::controller(UserController::class)->group(function () {
            Route::get('student/show/{student:username}', 'studentShow')->name('student.show');
            Route::get('student/promotion', 'studentPromotion')->name('student.promotion');
            Route::post('student/promotion', 'studentPromotionUpdate')->name('student.promotion.update');
            Route::post('user/status/{user}', 'apiStatusUpdate')->name('user.status.update');
            Route::post('user/account-hold/{user}', 'apiAccountHold')->name('user.account.hold');
            // parent create by axios
            Route::post('parent/store', 'parentStore')->name('parent.store');
            Route::get('parent/show/{user}', 'parentShow')->name('parent.show');
            Route::post('parent/index', 'parentGet')->name('parent.index');
            Route::post('student/export', 'studentExport')->name('student.export');
            Route::post('teacher/export', 'teacherExport')->name('teacherattendance.export');
            Route::post('user-doc/destroy/{doc}', 'docDestroy')->name('doc.destroy');
        });

        // Subjects Roles
        Route::resource('subjects', SubjectController::class);
        // Roles Routes
        Route::resource('roles', RoleController::class);
        // Departments Routes
        Route::resource('departments', DepartmentController::class);
        // Course Routes
        Route::resource('course', CourseController::class);
        Route::controller(CourseController::class)->group(function () {
            Route::post('api/class/store', 'apiClassStore')->name('api.class.store');
            Route::post('api/class/index', 'apiClassIndex')->name('api.class.index');
        });
        // Event Routes
        Route::resource('event', EventController::class);
        // Teacher Routes
        Route::controller(TeacherController::class)->group(function () {
            Route::get('teachers', 'index')->name('teachers.index');
            Route::get('teachers/create', 'create')->name('teachers.create');
            Route::get('teachers/edit/{teacher}', 'edit')->name('teachers.edit');
            Route::post('teacher/send/mail', 'sendMail')->name('teacher.send.mail');
            Route::get('teacher/classes/{teacher}', 'classes')->name('teacher.classes');
            Route::get('teacher/details/{teacher}', 'show')->name('teacher.show');
            Route::post('teacher/class/assign', 'classAssign')->name('teacher.class.assign');
        });
        // Leave Routes
        Route::resource('manage-leave', AdminLeaveController::class);
        Route::post('leave/status/change/{leave}', [AdminLeaveController::class, 'statusChange'])->name('leave.status.change');
        // Leave Type Routes
        Route::resource('leave-type', LeaveTypeController::class);
        Route::get('leave/requests/list', [AdminLeaveController::class, 'requests'])->name('leave.requests');
        // Holiday Routes
        Route::resource('holiday', HolidayController::class);
        Route::put('holiday/sized/{holiday}', [HolidayController::class, 'resized'])->name('holiday.resized');
        // Exam & Grades Routes
        Route::resource('result/rule', ResultRuleController::class, ['names' => 'result.rule']);
        Route::resource('grades', GradeController::class);
        // Exam Routes
        Route::resource('exam', ExamController::class);
        // Meeting Routes
        Route::resource('meeting', MeetingController::class);
        // Notice Routes
        Route::resource('notice-board', NoticeBoardController::class);
        Route::post('/notice-board/pin/{notice_board}', [NoticeBoardController::class, 'pin'])->name('notice-board.pin');
        // Routine
        Route::resource('routine', ClassRoutineController::class);
        Route::post('routine/delete', [ClassRoutineController::class, 'delete'])->name('routine.delete');
        Route::controller(ClassRoutineController::class)->group(function () {
            Route::get('/fetch/routines/refresh', 'refreshRoutines')->name('routine.refresh');
            Route::get('/fetch/details/{routine}', 'fetchRoutineDetails')->name('routine.details');
        });
        // Students Routes
        Route::resource('student/admission', StudentController::class, ['names' => 'student.admission']);
        Route::controller(StudentController::class)->group(function () {
            Route::get('/all/students', 'admissionAll')->name('student.admission.all');
            Route::get('student/admission/request/accept/{admission_request}', 'admissionAccept')->name('student.admission.request.accept');
            Route::delete('student/admission/request/reject/{admission_request}', 'admissionReject')->name('student.admission.request.reject');
            Route::get('student/bulk/admission', 'bulkAdmission')->name('student.bulk.admission');
            Route::post('student/admission/mail', 'sendMail')->name('student.send.mail');
            Route::post('student/manual/bulk/register', 'manualBulk')->name('student.manual.bulk');
            Route::post('student/file/bulk/register', 'fromFileBulk')->name('student.file.bulk');
            Route::get('student/file/download', 'fileDownload')->name('student.file.download');
        });
        Route::controller(CourseController::class)->group(function () {
            Route::get('/qr/class', 'getAllClassesWithQrCodes')->name('class.qr.all');
        });
        Route::resource('admission/form', AdmissionFormController::class);
        Route::post('admission/form/status/{field}', [AdmissionFormController::class, 'statusChange'])->name('form.status.change');
        // Sms Routes
        Route::controller(SmsController::class)->name('sms.')->prefix('sms')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/send', 'send')->name('send');
        });
        Route::resource('/sms/template', TemplateController::class, ['names' => 'sms.template']);

        // Settings Routes
        Route::controller(WebsiteSettingController::class)->name('settings.')->prefix('settings')->group(function () {
            // General Settings
            Route::get('/', 'index')->name('general');
            Route::put('/', 'update')->name('update');
            Route::put('/system', 'systemUpdate')->name('system.update');
            Route::put('/schedule', 'scheduleUpdate')->name('schedule.update');
            // SMTp Settings
            Route::get('/smtp', 'smtp')->name('smtp');
            Route::put('/smtp', 'smtpUpdate')->name('smtp.update');
            Route::post('test-email', 'testEmailSent')->name('email.test');

            // SMTS Settings
            Route::get('/sms', 'sms')->name('sms');
            Route::put('/sms', 'smsUpdate')->name('sms.update');

            // Payment Settings
            Route::get('/payment', 'payment')->name('payment');
            Route::put('/payment', 'paymentUpdate')->name('payment.update');

            // Other Settings
            Route::get('/other', 'other')->name('other');
            Route::post('/run/command/{type}', 'runCommand')->name('run.command');
            Route::put('/exam/grade/rules/update', 'examGradesUpdate')->name('exam.grade.update');

            // Recaptcha Settings
            Route::get('/recaptcha', 'recaptcha')->name('recaptcha.index');
            Route::put('/recaptcha', 'recaptchaUpdate')->name('recaptcha.update');

            // Currency Settings
            Route::prefix('currency')->group(function () {
                Route::get('/', 'currency')->name('currency');
                Route::post('/', 'currencyStore')->name('currency.store');
                Route::put('/{currency}/update', 'currencyUpdate')->name('currency.update');
                Route::delete('/{currency}/delete', 'currencyDelete')->name('currency.destroy');
                Route::post('/{currency}/status/update', 'currencyStatusUpdate')->name('currency.status.update');
            });

            // Upgrade Settings
            Route::get('/upgrade', 'upgrade')->name('upgrade');
            Route::post('/upgrade', 'upgradeApply')->name('upgradeApply');

            // Website Settings
            Route::get('/website', 'website')->name('website');
            Route::post('/website/slider', 'sliderStore')->name('website.slider.store');
            Route::delete('/website/slider/{slider}', 'sliderDelete')->name('website.slider.delete');
            // Social Media Settings
            Route::post('/social', 'socialMediaStore')->name('social.store');
            Route::put('/{socialLink}/update', 'socialMediaUpdate')->name('social.update');
            Route::delete('/{socialLink}/delete', 'socialMediaDelete')->name('social.destroy');
            Route::post('/{socialLink}/status/update', 'socialMediaStatusUpdate')->name('social.status.update');
        });
        // Report Controller
        Route::controller(ReportController::class)->prefix('report')->group(function () {
            Route::get('/', 'index')->name('reports.index');
            Route::get('/transactions', 'transaction')->name('report.transaction');
            Route::get('/class-routine', 'classRoutine')->name('report.class-routine');
            Route::get('/attendance', 'attendance')->name('report.attendance');
            Route::get('/others', 'others')->name('report.others');
            Route::get('/students', 'students')->name('report.student');
            Route::get('/students/enroll', 'studentsEnroll')->name('report.student.enroll');
            Route::get('/student/fee', 'studentFees')->name('report.student.fees');
            Route::get('/subject/attendance', 'subjectAttendance')->name('report.subject.attendance');
            Route::get('/expense', 'expense')->name('report.expense');
            Route::get('/all/student/fees', 'allStudentFees')->name('report.all.student.fees');
            Route::get('/get-courses', [ReportController::class, 'getCourses'])->name('get.courses');
            Route::get('/get-subjects', [ReportController::class, 'getSubjects'])->name('get.subjects');

            // Report Export as pdf or excel
            Route::post('/transaction/export', 'transactionExport')->name('report.transaction.export');
            Route::post('/exam-results/export', 'examResultsExport')->name('report.exam-results.export');
            Route::post('/attendance/export', 'attendanceExport')->name('report.attendance.export');

            Route::post('/expense/export', 'expenseReportExport')->name('report.expense.export');
            Route::post('/student/enroll/export', 'exportStudentEnroll')->name('report.studentEnroll.export');
            Route::post('/subject/attendance/export', 'exportSubjectAttendanceReport')->name('report.subject.attendance.export');
            Route::post('/all/student/fees/export', 'allStudentFeesExport')->name('report.allStudent.fees.export');
            Route::post('report/student/fee/export', 'studentFeesExport')->name('report.studentFee.export');
        });

        // Cms management controller
        Route::controller(CmsController::class)->name('cms.')->group(function () {
            Route::get('/cms', 'index')->name('index');
            Route::get('cms/onboarding', 'onboardingIndex')->name('onboarding.index');
            Route::put('cms/onboarding/update', 'onboardingUpdate')->name('onboarding.update');
        });

        // Transaction Type Routes
        Route::resource('transaction-type', TransactionTypeController::class);
        Route::resource('transaction', TransactionController::class);
        Route::controller(TransactionController::class)->group(function () {
            Route::get('/transaction/details/{transaction:transaction_no}', 'show')->name('transaction.details');
            Route::get('all/transaction', 'index')->name('all.transaction');
            Route::post('transaction/mask/as/paid/{transaction}', 'markAsPaid')->name('transaction.mark.as.paid');
        });
        // Invoice Routes
        Route::resource('invoice', InvoiceController::class);
        Route::controller(InvoiceController::class)->group(function () {
            Route::get('invoice/send-via-email/{invoice}', 'sendViaEmail')->name('invoice.send.email');
            Route::get('invoice/download/{invoice}', 'invoiceDownload')->name('invoice.download');
            Route::post('invoice/recurring/status/{invoice}', 'invoiceRecurringStatus')->name('invoice.recurring.status');
        });
        // Plan Routes
        Route::resource('plan', PlanController::class);

        // Kid Dashboard
        Route::get('kid/dashboard/{roll_no}', [AuthDashboardController::class, 'kidDashboard'])->name('kid.dashboard');

        // My Subject
        Route::get('/manage/subjects', [SingleTeacherController::class, 'class'])->name('my-subject');
        Route::get('/my/schedule', [SingleTeacherController::class, 'mySchedule'])->name('my.schedule');
        Route::get('/subject/details/{subject:slug}', [SingleTeacherController::class, 'subjectDetails'])->name('subject.details');
        // Teacher Assignment
        Route::resource('assignment', AssignmentController::class);
        Route::controller(AssignmentController::class)->group(function () {
            Route::get('assignment/details/{assignment:slug}', 'show')->name('assignment.details');
            Route::post('remind/assignment/submit', 'remindThem')->name('remind.them');
            Route::post('give/assignment/mark', 'giveAssignmentMark')->name('teacher.give.assignment.mark');
        });
        // Attendance
        Route::resource('/student/attendance', StudentAttendanceController::class, ['names' => 'student.attendance']);
        // Syllabus
        Route::resource('syllabus', SyllabusController::class);
        // Result
        Route::controller(ExamResultController::class)->group(function () {
            Route::get('exam-result', 'index')->name('result.index');
            Route::post('exam/result', 'store')->name('result.store');
            Route::post('exam/result/{exam}/update', 'update')->name('result.update');
        });
        // Online Class
        Route::controller(SingleTeacherController::class)->prefix('online/class')->name('online.class.')->group(function () {
            Route::get('/index', 'onlineClassList')->name('index');
            Route::post('/', 'onlineClass')->name('store');
            Route::put('/{class}', 'onlineClassUpdate')->name('update');
            Route::delete('/{class}', 'onlineClassDestroy')->name('destroy');
        });
        Route::controller(StudentDashboardController::class)->group(function () {
            // Student My Course Page
            Route::get('my/courses', 'myCourses')->name('my.courses');
            // Student Teacher list
            Route::get('teacher/list', 'teacherList')->name('teacher.list');
            // Student Assignment
            Route::get('my-assignment', 'assignmentList')->name('assignment.list');
            Route::post('assignment/review/mail/{assignment}', 'sendAssigmentReviewMail')->name('assignment.review.mail');
            Route::post('assignment/submit', 'assignmentSubmit')->name('assignment.submit');
            // Student Class routine & subjects
            Route::get('class/routine', 'classRoutine')->name('class.routine');
            Route::get('my-subjects', 'subject')->name('subject.index');
            Route::get('subject/show/{subject:slug}', 'subjectShow')->name('subject.show');
            // results
            Route::get('exam/result/{exam:slug}', 'previewResult')->name('preview.result');
            // Attendance
            Route::get('my-attendances', 'attendances')->name('my.attendance');
            Route::post('attendances/export', 'attendancesExport')->name('attendance.export');
            //online class and student results
            Route::get('online/classes', 'onlineClasses')->name('online.classes');
            Route::get('student/list', 'studentList')->name('student.list');
            Route::post('student/send/mail', 'studentSendMail')->name('student.send.mail2');
        });
        // Schedule
        Route::resource('schedules', ScheduleController::class);
    });

Route::get('/fetch/subjects/{course}', [CourseController::class, 'fetchSubjects'])->name('fetch.subjects');
Route::get('/fetch/teachers/{subject}', [SubjectController::class, 'fetchTeachers'])->name('fetch.teachers');
Route::get('/fetch/students/{course}', [CourseController::class, 'fetchStudent'])->name('fetch.students');

Route::controller(GlobalController::class)->group(function () {
    Route::post('/checkweekend/{weekday}', 'checkWeekend')->name('checkweekend');
    Route::get('/fetch/pinned/announcement', 'pinnedAnnouncement')->name('pinnedAnnouncement');
    Route::get('/fetch/group/attachments/{group_id}', 'fetchAttachments')->name('fetch.groupAttachments');
});
