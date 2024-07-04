<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function notification()
    {
        $journals = Journal::all()->map(function ($journal) {
            return [
                'id' => $journal->id,
                'class_lists' => $journal->class_lists,
                'time' => $journal->time, 
                'date' => $journal->date,
            ];
        });

        return response()->json($journals);
    }
}
