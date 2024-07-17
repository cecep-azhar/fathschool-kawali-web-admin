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
        // Validasi file gambar
        $data = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
            'description' => 'required|string',
            'img' => 'required|file|mimes:jpeg,png,jpg|max:2048', // Memvalidasi tipe file dan ukuran maksimal
            'course_id' => 'required|string',
        ], [
            'img.required' => 'Foto asli harus disertakan.',
            'img.file' => 'File harus berupa gambar.',
            'img.mimes' => 'Format gambar yang didukung adalah JPEG, PNG, JPG.',
            'img.max' => 'Ukuran maksimum file adalah 2MB.',
        ]);

        // Simpan file ke storage
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $filename = $request->file('img')->store('public/journals'); // Simpan file di direktori 'storage/app/public/journals'
            $filenames = $request->file('img')->store('journals');

            // Simpan data ke database
            $journal = new Journal();
            $journal->date = $data['date'];
            $journal->time = $data['time'];
            $journal->description = $data['description'];
            $journal->img = $filenames;
            $journal->user_id = Auth::id();
            $journal->course_id = $data['course_id'];
            $journal->security_code = Str::random(10);
            $journal->security_code_expiration = Carbon::now()->addHour();

            $journal->save();
        }


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
        $user_id = Auth::user()->id;
        $journals = Journal::where('user_id', $user_id)
                            ->orderBy('created_at', 'desc')
                            ->get()
                            ->map(function ($journal) {
                                return [
                                    'id' => $journal->id,
                                    'course_id' => $journal->course_id,
                                    'course_name' => $journal->course->name,
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
        $user_id = Auth::user()->id;
        $journal = Journal::findOrFail($id);
    
        $journalData = [
            'id' => $journal->id,
            'course_id' => $journal->course_id,
            'course_name' => $journal->course->name,
            'user_id' => $journal->user_id,
            'description' => $journal->description,
            'img' => $journal->img,
            'security_code' => $journal->security_code,
            'security_code_expiration' => $journal->security_code_expiration,
            'time' => $journal->time,
            'date' => $journal->date,
        ];
    
        return response()->json($journalData, 200);
    }
    

    // public function getJournal()
    // {
    //     $journals = Journal::all();
    //     return response()->json($journals);
    // }
}
