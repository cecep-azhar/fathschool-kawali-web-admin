<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
            'user_id' => 'required|exists:users,id',
            'class_lists' => 'required|string',
        ]);

        $journal = new Journal();
        $journal->date = $data['date'];
        $journal->time = $data['time'];
        $journal->description = $data['description'];
        $journal->img = $data['img'];
        $journal->user_id = $data['user_id'];
        $journal->class_lists = $data['class_lists'];
        $journal->security_code = Str::random(10);
        $journal->security_code_expiration = Carbon::now()->addHour();

        $journal->save();

        $user = $request->user();

        activity()
        ->useLog('default')
        ->causedBy(auth()->user())
        ->event('postJournal')
        ->withProperties(['ip' => $request->ip(),
                          'user' => $user->username ])
        ->log('User Post Journal');

        return response()->json($journal, 201);
    }

    // get journal
    public function getJournal()
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