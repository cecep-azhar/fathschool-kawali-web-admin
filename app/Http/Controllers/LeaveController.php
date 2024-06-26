<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(! userCan('request-leave.create'), 403);

        $request->validate([
            'date' => 'required',
            'description' => 'required',
            'leave_type_id' => 'required',
        ], [
            'leave_type_id.required' => 'The leave type field is required',
        ]);

        $user = authUser();

        $start = Carbon::parse($request->date2[0]);
        $end = Carbon::parse($request->date2[1]);

        Leave::create([
            'user_id' => $user->id,
            'leave_type_id' => $request->leave_type_id,
            'title' => $user->name,
            'start' => $start,
            'end' => $end,
            'status' => 'pending',
            'description' => $request->description,
        ]);

        $this->flashSuccess('Leave request submitted');

        return back();
    }
}
