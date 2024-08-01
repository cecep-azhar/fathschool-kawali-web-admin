<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\PasswordRequest;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Actions\Auth\ResetPasswordWeb;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Log an activity
        activity()
            ->causedBy(auth()->user())
            ->log('Visited the example page');

        return response()->json(['message' => 'Activity logged']);
    }
public function passwordadmin(PasswordRequest $request, ResetPasswordWeb $resetPassword)
{
    $resetPassword->request($request);

    return Inertia::render('ForgotPassword', [
        'status' => __('auth.password.sent'),
        'phone_number' => $request->input('phone_number')
    ]);
}
}