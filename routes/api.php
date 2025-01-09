<?php

use App\Http\Controllers\Academic\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Api\ApiUserIdController;
use App\Http\Controllers\Api\ClassAttendanceController;
use App\Http\Controllers\Api\ClassListController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\StudentAttendanceController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TotalController;
use App\Http\Controllers\Api\QuotesController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\DataDisplayFathboard;
use App\Models\Api\ClassAttendance;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;
use App\Http\Controllers\Api\MobileNotificationController;
use App\Http\Controllers\Api\MobileSettingsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

//logout
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

//Forgot password
Route::post('/forget-password', [App\Http\Controllers\Api\AuthController::class, 'forgetPassword'])->middleware('auth:sanctum');

//user
Route::get('/user', [App\Http\Controllers\Api\ApiUserController::class, 'show'])->middleware('auth:sanctum');

Route::get('/user/{userId}', [App\Http\Controllers\Api\ApiUserController::class, 'getbyid'])->middleware('auth:sanctum');

//school
Route::get('/school', [App\Http\Controllers\Api\ApiSchoolController::class, 'show'])->middleware('auth:sanctum');

//school phone
Route::get('/school-phone', [App\Http\Controllers\Api\ApiSchoolController::class, 'showPhone'])->middleware('auth:sanctum');

//API permission
Route::apiResource('/api-permissions', App\Http\Controllers\Api\PermissionController::class)->middleware('auth:sanctum');

Route::get('/permissions/{id}', [App\Http\Controllers\Api\PermissionController::class, 'show'])->middleware('auth:sanctum');

Route::apiResource('/permissions-type', App\Http\Controllers\Api\PermissionTypeController::class)->middleware('auth:sanctum');

//Qrin
Route::post('/qrin', [App\Http\Controllers\Api\ClassAttendanceController::class, 'qrin'])->middleware('auth:sanctum');

//is qrin
Route::get('/is-qrin', [App\Http\Controllers\Api\ClassAttendanceController::class, 'isQrin'])->middleware('auth:sanctum');

//Qrout
Route::post('/qrout', [App\Http\Controllers\Api\ClassAttendanceController::class, 'qrout'])->middleware('auth:sanctum');

//checkin
Route::post('/checkin', [App\Http\Controllers\Api\AttendanceController::class, 'checkin'])->middleware('auth:sanctum');

//is checkin
Route::get('/is-checkin', [App\Http\Controllers\Api\AttendanceController::class, 'isCheckedin'])->middleware('auth:sanctum');

//checkout
Route::post('/checkout', [App\Http\Controllers\Api\AttendanceController::class, 'checkout'])->middleware('auth:sanctum');

//post journal
Route::post('/journal', [App\Http\Controllers\Api\JournalController::class, 'postJournal'])->middleware('auth:sanctum');

//get journal
Route::get('/journal', [App\Http\Controllers\Api\JournalController::class, 'getJournal'])->middleware('auth:sanctum');

//get journal by id
Route::get('/journal/{id}', [App\Http\Controllers\Api\JournalController::class, 'getJournalById'])->middleware('auth:sanctum');

//update profile
Route::post('/update-profile', [App\Http\Controllers\Api\AuthController::class, 'updateProfile'])->middleware('auth:sanctum');

//learning lessons
Route::get('/learning-lessons', [App\Http\Controllers\Api\LearningLessonController::class, 'getLessonsByTeacher'])->middleware('auth:sanctum');

//update face
Route::post('/update-face', [App\Http\Controllers\Api\AuthController::class, 'updateFace'])->middleware('auth:sanctum');

//notification
Route::post('/notification', [App\Http\Controllers\Api\NotificationController::class, 'notification'])->middleware('auth:sanctum');

// Route::middleware(['log.activity'])->group(function () {
//     Route::get('/example', [ExampleController::class, 'index']);
// });

//update fcm token
Route::post('/update-fcm-token', [App\Http\Controllers\Api\AuthController::class, 'updateFcmToken'])->middleware('auth:sanctum');

//activity example
Route::get('/activity-example', [ActivityLogController::class, 'index'])->middleware('auth:sanctum');

//api attendances
Route::get('/api-attendances', [App\Http\Controllers\Api\AttendanceController::class, 'index'])->middleware('auth:sanctum');

//student attendances
Route::get('/student-attendances', [StudentAttendanceController::class, 'index'])->middleware('auth:sanctum');

//course
Route::middleware('auth:sanctum')->get('/course', [ClassListController::class, 'index']);

//post course
Route::middleware('auth:sanctum')->post('/course', [ClassListController::class, 'store']);

//class lists by id
Route::middleware('auth:sanctum')->get('/course/{course_id}', [ClassListController::class, 'show']);

//
Route::get('students/{student_id}/course/{course_id}', [StudentController::class, 'show']);

//forgot password
Route::post('forgot-password', [App\Http\Controllers\Api\AuthController::class, 'password']);

//log activity
Route::get('/activity-logs/{causer_id}', function ($causer_id) {
    $threeDaysAgo = Carbon::now()->subDays(3);
    $logs = Activity::where('causer_id', $causer_id)
        ->where('created_at', '>=', $threeDaysAgo)
        ->select('id', 'causer_id', 'properties', 'description', 'created_at')
        ->orderBy('created_at', 'DESC')
        ->get();
    return response($logs);
});

Route::get('/userid', [ApiUserIdController::class, 'show'])->middleware('auth:sanctum');

Route::get('/classes/qr-codes', [CourseController::class, 'getAllClassesWithQrCodes']);

//display dasboard
Route::get('/get-display-dashboard', [App\Http\Controllers\Api\DisplayDashboardController::class, 'index']);

//Quotes
Route::get('/quote-of-the-day', [QuotesController::class, 'getQuoteOfTheDay']);
Route::post('/add-quote', [QuotesController::class, 'addQuote']);

//rating
Route::middleware('auth:sanctum')->post('/rate-teacher', [ClassAttendanceController::class, 'rating']);

Route::get('/is-rate-teacher', [ClassAttendanceController::class, 'isRating'])->middleware('auth:sanctum');

//announcement
Route::middleware('auth:sanctum')->get('/notices', [NoticeController::class, 'index']);

//checkin student
Route::post('/checkin/student', [App\Http\Controllers\ApiStudent\AttendanceController::class, 'checkin'])->middleware('auth:sanctum');

//is checkin
Route::get('/is-checkin/student', [App\Http\Controllers\ApiStudent\AttendanceController::class, 'isCheckedin'])->middleware('auth:sanctum');

//checkout
Route::post('/checkout/student', [App\Http\Controllers\ApiStudent\AttendanceController::class, 'checkout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/check-upcoming-class', [AttendanceController::class, 'checkUpcomingClass']);

//get data mobile notification
Route::get('/mobile-notifications', [MobileNotificationController::class, 'index'])->middleware('auth:sanctum');

//get mobile settings
Route::get('/mobile-settings', [MobileSettingsController::class, 'index']);


// get data display fathboard
Route::get('/get-information-students', [DataDisplayFathboard::class, 'getDataSiswa']);
Route::get('/get-information-teachers', [DataDisplayFathboard::class, 'getDataGuru']);
Route::get('/get-information-administrations', [DataDisplayFathboard::class, 'getDataAdmin']);


Route::get('/get-information-class', [DataDisplayFathboard::class, 'getDataClass']);

