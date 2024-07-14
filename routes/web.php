<?php

use App\Http\Controllers\Academic\CourseController;
use App\Http\Controllers\AuthDashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GroupChatController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Setting\WebsiteSettingController;
use App\Http\Controllers\Teacher\AttendanceController;
use App\Models\Currency;
use App\Models\Language;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use msztorc\LaravelEnv\Env;

Route::get('/test', function () {

    $teachers = json_decode(file_get_contents(base_path('public/json/teachers.json')), true);

    DB::beginTransaction();

    try {
        foreach ($teachers as $teacher) {

            $user = User::create([
                'name' => $teacher['name'],
                'email' => $teacher['email'],
                'role' => $teacher['user_type'],
                'password' => Hash::make('password'), // Use Hash::make for password hashing
                'profile_photo_path' => '',
                'date_of_birth' => Carbon::parse($teacher['date_of_birth']),
            ]);

            foreach ($teacher['subjects'] as $key => $subject) {
                $user->subjects()->create([
                    'subject_id' => $subject,
                ]);
            }

            $user->profile()->create([
                'highest_degree_name' => $teacher['highest_degree_name'],
                'institute_name' => $teacher['institute_name'],
                'passing_year' => $teacher['passing_year'],
            ]);
        }

        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => $e->getMessage()]);
    }
});

Route::controller(GroupChatController::class)->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('group/chat', 'index')->name('group.chat');
    Route::get('group/messages/{group_id}', 'getGroupMessages')->name('group.messages');
    Route::post('group/store/message', 'storeMessage')->name('group.storeMessage');
    Route::delete('group/delete/{group}', 'deleteGroup')->name('group.delete');
    Route::post('file/upload', 'fileUpload')->name('file.upload');
    Route::delete('file/upload/remove', 'removeUploadFile')->name('remove.file.upload');
});

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/admission', 'admission');
    Route::get('success-transaction', 'successTransaction')->name('paypal.successTransaction');
    Route::post('/admission', 'admissionStore')->name('admission.store');
    Route::get('/announcement', 'announcement');
    Route::get('/aboutschool', 'aboutschool');
    Route::get('/feature', 'feature');
    Route::get('/contact', 'contact');
    Route::get('/announcement/{notice:slug}', 'announcementDetails')->name('announcement.details');
});

Route::get('/change/language/{language:code}', function (Language $language) {
    Session()->put('locale', $language->code);
    Session()->put('current_dir', $language->direction);

    return back();
})->name('change.language');

Route::get('/change/currency/{currency:code}', function (Currency $currency) {
    $env = new Env;
    $env->setValue('APP_CURRENCY', $currency->code);

    return back();
})->name('change.currency');

Route::get('/change/currency/session/{currency:code}', function (Currency $currency) {
    $currency = Currency::whereCode($currency->code)->first();

    if ($currency) {
        Session::put('myCurrency', $currency);
    }

    return back();
})->name('change.currency.session');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AuthDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AuthDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthDashboardController::class, 'profileUpdate'])->name('profile.update');

    Route::resource('leave', LeaveController::class);
    Route::resource('comment', CommentController::class);
    Route::get('notice-board-detail/{notice:slug}', [AuthDashboardController::class, 'noticeBoardDetails'])->name('notice.board.details');
    Route::get('student/assignment/details/{assignment}', [AuthDashboardController::class, 'assignmentDetails'])->name('assignment.detail');

    Route::post('/read/notification', function () {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    })->name('read.notification');

    Route::resource('languages', LanguageController::class);
    Route::get('languages/{language:code}', [LanguageController::class, 'settings'])->name('languages.setting');
    Route::post('languages/translation/update/{language:code}', [LanguageController::class, 'translationUpdate'])->name('translation.update');
    Route::post('single/translate', [WebsiteSettingController::class, 'singleTranslate'])->name('single.translate');
    Route::post('api/translate', [WebsiteSettingController::class, 'languageTranslate'])->name('api.translate');
    Route::post('tour-completed', [AuthDashboardController::class, 'tourCompleted'])->name('tour.completed');
});

Route::post('changeLang/{dir}', [LanguageController::class, 'changeLang'])->name('changeLang');
Route::get('/courses/qr-codes', [CourseController::class, 'getAllClassesWithQrCodes'])->name('courses.qr-codes');
Route::get('teacher/attendance', [AttendanceController::class, 'index'])->name('teacher.attendance');
Route::get('courses/{id}/print-qr-code', [CourseController::class, 'printQrCode'])->name('courses.printQrCode');


include base_path('routes/auth.php');
include base_path('routes/payment.php');
include base_path('routes/website.php');
