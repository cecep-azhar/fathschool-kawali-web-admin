<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Api\ClassListController;
use App\Http\Controllers\Api\StudentAttendanceController;
use App\Http\Controllers\Api\StudentController;

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

//school
Route::get('/school', [App\Http\Controllers\Api\ApiSchoolController::class, 'show'])->middleware('auth:sanctum');

//school phone
Route::get('/school-phone', [App\Http\Controllers\Api\ApiSchoolController::class, 'showPhone'])->middleware('auth:sanctum');

//API permission
Route::apiResource('/api-permissions', App\Http\Controllers\Api\PermissionController::class)->middleware('auth:sanctum');

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

Route::get('/learning-lessons', [App\Http\Controllers\Api\LearningLessonController::class, 'getLessonsByTeacher'])->middleware('auth:sanctum');
//update face
Route::post('/update-face', [App\Http\Controllers\Api\AuthController::class, 'updateFace'])->middleware('auth:sanctum');

//notification
Route::post('/notification', [App\Http\Controllers\Api\NotificationController::class, 'notification'])->middleware('auth:sanctum');

Route::middleware(['log.activity'])->group(function () {
    Route::get('/example', [ExampleController::class, 'index']);
});

//update fcm token
Route::post('/update-fcm-token', [App\Http\Controllers\Api\AuthController::class, 'updateFcmToken'])->middleware('auth:sanctum');

Route::get('/activity-logs', [ActivityLogController::class, 'activityLogs'])->middleware('auth:sanctum');

Route::get('/api-attendances', [App\Http\Controllers\Api\AttendanceController::class, 'index'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/student-attendances', [StudentAttendanceController::class, 'index']);

Route::middleware('auth:sanctum')->get('/class-lists', [ClassListController::class, 'index']);

Route::middleware('auth:sanctum')->get('/class-lists/{class_list_id}', [ClassListController::class, 'show']);

Route::middleware('auth:sanctum')->get('/students/{student_id}', [StudentController::class, 'show']);
