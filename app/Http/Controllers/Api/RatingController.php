<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:users,id,role,teacher',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);        

        $rating = Rating::create([
            'user_id' => auth()->id(),
            'teacher_id' => $request->teacher_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Rating created successfully', 'rating' => $rating], 201);
    }

    // Tambahkan metode lain jika diperlukan
}
