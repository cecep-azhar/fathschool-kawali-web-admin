<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiUserIdController extends Controller
{
    /**
     * Display the ID of the currently authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Mengambil ID user yang sedang login
        $user = $request->user();

        return response()->json([
            'message' => 'Success',
            'user_id' => $user->id,
        ], 200);
    }
}
