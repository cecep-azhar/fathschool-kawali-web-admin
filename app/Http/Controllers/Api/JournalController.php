<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    // post journal
    public function postJournal(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
            'description' => 'required|string',
            'img' => 'required|string',
            'course_id' => 'required|string',
        ]);

        $journal = new Journal();
        $journal->date = $data['date'];
        $journal->time = $data['time'];
        $journal->description = $data['description'];
        $journal->img = $data['img'];
        $journal->user_id = Auth::id();
        $journal->course_id = $data['course_id'];
        $journal->security_code = Str::random(10);
        $journal->security_code_expiration = Carbon::now()->addHour();

        $journal->save();

        $user = $request->user();

        activity()
        ->useLog('default')
        ->causedBy(auth()->user())
        ->event('postJournal')
        ->withProperties(['ip' => $request->ip(),
                          'user' => $user->username,
                          'time' => date('H:i')])
        ->log('User Post Journal');

        return response()->json($journal, 201);
    }

    // get journal
    public function getJournal()
    {
        $journals = Journal::all()->map(function ($journal) {
            return [
                'id' => $journal->id,
                'course_id' => $journal->course_id,
                'user_id' => $journal->user_id,
                'description' => $journal->description,
                'img' => $journal->img,
                'security_code' => $journal->security_code,
                'security_code_expiration' => $journal->security_code_expiration,
                'time' => $journal->time,
                'date' => $journal->date,
            ];
        });

        return response()->json($journals);
    }

    //get journal by id
    public function getJournalById($id)
    {
        $journals = Journal::findOrFail($id);

        return response()->json($journals, 200);
    }

    // public function getJournal()
    // {
    //     $journals = Journal::all();
    //     return response()->json($journals);
    // }
}
