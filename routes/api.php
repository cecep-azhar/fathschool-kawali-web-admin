<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//API permission
Route::apiResource('/api-permissions', App\Http\Controllers\Api\PermissionController::class)->middleware('auth:sanctum');

//Qrin
Route::post('/qrin', [App\Http\Controllers\Api\ClassAttendanceController::class, 'qrin'])->middleware('auth:sanctum');

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

Route::post('/update-face', [App\Http\Controllers\Api\AuthController::class, 'updateFace'])->middleware('auth:sanctum');
//update profile
Route::post('/update-profile', [App\Http\Controllers\Api\AuthController::class, 'updateProfile'])->middleware('auth:sanctum');
