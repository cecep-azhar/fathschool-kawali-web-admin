<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        if ($user->role !== 'Teacher') {
        return response(['message' => 'user is not a teacher'], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response(['user' => $user, 'token' => $token], 200);
    }


    public function forgetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $user = $request->user();

        if (!$user) {
            return response(['message' => 'User not found'], 404);
        }

        // Reset password
        $user->password = Hash::make($request->password);
        $user->save();

        return response(['message' => 'Password reset successfully'], 200);
    }



    //logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Logged out'], 200);
    }
}
