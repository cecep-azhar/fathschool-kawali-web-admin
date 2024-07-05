<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

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
}