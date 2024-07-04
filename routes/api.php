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

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::get('/user', [App\Http\Controllers\Api\ApiUserController::class, 'show'])->middleware('auth:sanctum');

Route::get('/school', [App\Http\Controllers\Api\ApiSchoolController::class, 'show'])->middleware('auth:sanctum');

Route::apiResource('/api-permissions', App\Http\Controllers\Api\PermissionController::class)->middleware('auth:sanctum');

Route::post('/qrin', [App\Http\Controllers\Api\ClassAttendanceController::class, 'qrin'])->middleware('auth:sanctum');

Route::post('/qrout', [App\Http\Controllers\Api\ClassAttendanceController::class, 'qrout'])->middleware('auth:sanctum');

Route::post('/forget-password', [App\Http\Controllers\Api\AuthController::class, 'forgetPassword']);
