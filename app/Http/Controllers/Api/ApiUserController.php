<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function show(Request $request)
    {
        $user = User::where('id', $request->user()->id)->orderBy('id', 'desc')->first();

        if ($user) {
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'User not found or not a teacher'], 404);
        }
    }

    public function getbyid(Request $request, $userId)
    {
        $users = User::where('id', $userId)->orderBy('id', 'desc')->first();
        $absenNumber = 1;
        $usersResult = $users->map(function($user) use (&$absenNumber) {
            // Increment nomor absen
            $absen = $absenNumber;
            $absenNumber++;

            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'absen_number' => $absen,
            ];
        });

        if ($usersResult) {
            return response()->json($usersResult, 200);
        } else {
            return response()->json(['message' => 'User not found or not a teacher'], 404);
        }
    }

    public function index(Request $request)
    {
        $user = User::where('id', $request->user()->id)->orderBy('id', 'desc')->get();

        if ($user) {
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'School not found'], 404);
        }
    }
}
