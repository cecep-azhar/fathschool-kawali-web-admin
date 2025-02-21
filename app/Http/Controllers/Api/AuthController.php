<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\ResetPasswordManual;
use App\Actions\Auth\ResetPasswordMobile;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        $department = Department::where('id', $user->department_id)->first();

        $user->department = $department->name ?? null;

        activity()
            ->useLog('default')
            ->causedBy($user->id)
            ->event('login')
            ->withProperties([
                'ip' => $request->ip(),
                'user' => $user->username,
                'time' => date('H:i')
            ])
            ->log('User Login');

        return response(['user' => $user, 'token' => $token], 200);
    }



    public function loginUsers(Request $request)
    {

        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $loginData['email'])->first();

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Account not found',
            ], 404);
        }

        // Cek password
        if (!Hash::check($loginData['password'], $user->password)) {
            return response()->json([
                'status' => 401,
                'message' => 'Wrong password',
            ], 401);
        }

        // Cek akses manual
        if (!$user->manual) {
            return response()->json([
                'status' => 403,
                'message' => 'Access denied',
            ], 403);
        }

        // Hindari mengembalikan semua data user
        $responseData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ];

        return response()->json([
            'status' => 200,
            'message' => 'Login success',
            'data' => $responseData,
        ], 200);
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
            ->withProperties([
                'ip' => $request->ip(),
                'user' => $user->username,
                'time' => date('H:i')
            ])
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
            ->withProperties([
                'ip' => $request->ip(),
                'user' => $user->username,
                'time' => date('H:i')
            ])
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
            ->withProperties([
                'ip' => $request->ip(),
                'user' => $user->username,
                'time' => date('H:i')
            ])
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

        // Delete the previous profile photo if it exists
        if ($user->profile_photo_path) {
            Storage::delete('public/images/' . $user->profile_photo_path);
        }

        // Save new image
        $image->storeAs('public/images', $image->hashName());
        $user->profile_photo_path = $image->hashName();
        // $user->face_embedding = $face_embedding;
        $user->save();

        // Log the activity
        activity()
            ->useLog('default')
            ->causedBy(auth()->user())
            ->event('updateProfile')
            ->withProperties([
                'ip' => $request->ip(),
                'user' => $user->username,
                'time' => date('H:i')
            ])
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

        // activity()
        // ->useLog('default')
        // ->causedBy(auth()->user())
        // ->event('updateFcmToken')
        // ->withProperties(['ip' => $request->ip(),
        //                   'user' => $user->username,
        //                   'time' => date('H:i')])
        // ->log('User Update FCM Token');

        return response([
            'message' => 'FCM token updated',
        ], 200);
    }

    public function password(PasswordRequest $request, ResetPasswordMobile $resetPassword)
    {
        $resetPassword->request($request);

        return response(['message' => __('auth.password.sent')], 200);
    }

    public function passwordManual(PasswordRequest $request, ResetPasswordManual $resetPassword)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        $resetPassword->request($request);

        return response()->json([
            'status' => 200,
            'messages' => 'Password reset successfully',
        ], 200);
    }



    // * Function for Login Parent
    public function loginParent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nisn' => 'required|string',
                'birthdate' => 'required|date_format:Y-m-d',
            ]);

            if ($validator->fails()) {
                if ($validator->errors()->has('birthdate')) {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Password Tidak Sesuai'
                    ], 400);
                }
                return response()->json([
                    'status' => 400,
                    'message' => $validator->errors()->first()
                ], 400);
            }

            $userProfile = DB::table('user_profiles')
                ->where('student_id', $request->nisn)
                ->first();

            if (!$userProfile) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User Tidak Ditemukan'
                ], 404);
            }

            $student = User::where('id', $userProfile->user_id)
                ->where('role', 'Student')
                ->first();

            if (!$student) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Siswa Tidak Ditemukan'
                ], 404);
            }

            $token = $student->createToken('authToken')->plainTextToken;
            
            return response()->json([
                'status' => 200,
                'message' => 'Login Berhasil, Mohon Tunggu Sebentar...',
                'data' => $student,
                'token' => $token
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
