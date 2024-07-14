<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\ResetPasswordMobile;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $loginData['email'])->first();

        //check user exist
        if (!$user) {
            return response(['message' => 'account not found'], 404);
        }

        //check password
        if (!Hash::check($loginData['password'], $user->password)) {
            return response(['message' => 'login failed'], 401);
        }

        // Check if user role is teacher
        // if ($user->role !== 'Teacher') {
        // return response(['message' => 'user is not a teacher'], 403);
        // }

        $token = $user->createToken('auth_token')->plainTextToken;

        $department = Department::where('id',$user->department_id)->first();

        $user->department = $department->name ?? null;

        activity()
        ->useLog('default')
        ->causedBy($user->id )
        ->event('login')
        ->withProperties(['ip' => $request->ip(),
                          'user' => $user->username,
                          'time' => date('H:i')])
        ->log('User Login');

        return response(['user' => $user, 'token' => $token], 200);
    }

    public function updateFace(Request $request)
    {
        $request->validate([
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'face_embedding' => 'required',
        ]);

        $user = $request->user();
        // $image = $request->file('image');
        $face_embedding = $request->face_embedding;

        // //save image
        // $image->storeAs('public/images', $image->hashName());
        // $user->image_url = $image->hashName();
        $user->face_embedding = $face_embedding;
        $user->save();

        $user = $request->user();

        activity()
        ->useLog('default')
        ->causedBy(auth()->user())
        ->event('updateFace')
        ->withProperties(['ip' => $request->ip(),
                          'user' => $user->username,
                          'time' => date('H:i')])
        ->log('User Update Face Data');

        return response([
            'message' => 'Face updated',
            'user' => $user,
        ], 200);
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = $request->user();

        if (!$user) {
            return response(['message' => 'User not found'], 404);
        }

        // Reset password
        $user->password = Hash::make($request->password);
        $user->save();

        $user = $request->user();

        activity()
        ->useLog('default')
        ->causedBy(auth()->user())
        ->event('updatePassword')
        ->withProperties(['ip' => $request->ip(),
                          'user' => $user->username,
                          'time' => date('H:i')])
        ->log('User Update New Password');

        return response(['message' => 'Password reset successfully'], 200);
    }

    //logout
    public function logout(Request $request)
    {
        $user = $request->user();

        activity()
        ->useLog('default')
        ->causedBy(auth()->user())
        ->event('logout')
        ->withProperties(['ip' => $request->ip(),
                          'user' => $user->username,
                          'time' => date('H:i')])
        ->log('User Logout');

        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Logged out'], 200);
    }

    //update image profile & face_embedding
    public function updateProfile(Request $request)
    {
        $request->validate([
            'profile_photo_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'face_embedding' => 'required',
        ]);

        $user = $request->user();
        $image = $request->file('profile_photo_path');
        // $face_embedding = $request->face_embedding;

        // //save image
        $image->storeAs('public/images', $image->hashName());
        $user->profile_photo_path = $image->hashName();
        // $user->face_embedding = $face_embedding;
        $user->save();

        $user = $request->user();

        activity()
        ->useLog('default')
        ->causedBy(auth()->user())
        ->event('updateProfile')
        ->withProperties(['ip' => $request->ip(),
                          'user' => $user->username,
                          'time' => date('H:i')])
        ->log('User Update Profile');

        return response([
            'message' => 'Profile updated',
            'user' => $user,
        ], 200);
    }

    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required',
        ]);

        $user = $request->user();
        $user->fcm_token = $request->fcm_token;
        $user->save();

        $user = $request->user();

        activity()
        ->useLog('default')
        ->causedBy(auth()->user())
        ->event('updateFcmToken')
        ->withProperties(['ip' => $request->ip(),
                          'user' => $user->username,
                          'time' => date('H:i')])
        ->log('User Update FCM Token');

        return response([
            'message' => 'FCM token updated',
        ], 200);
    }

    public function password(PasswordRequest $request, ResetPasswordMobile $resetPassword)
    {
        $resetPassword->request($request);

        return response(['message' => __('auth.password.sent')], 200);
    }
}
