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
