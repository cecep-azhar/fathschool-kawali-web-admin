<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('schedule.index'), 403);

        $schedules = authUser()->schedules()->latest()->get();

        return inertia('Student/Schedule/Index', [
            'schedules' => $schedules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        abort_if(! userCan('schedule.create'), 403);

        $request->validate([
            'title' => 'required',
            'date' => 'required',
        ]);

        $start = Carbon::parse($request->date2[0])->startOfDay();
        $end = Carbon::parse($request->date2[1])->endOfDay();

        Schedule::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'start' => $start,
            'end' => $end,
        ]);

        $this->flashSuccess('A new Schedule has been created');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        abort_if(! userCan('schedule.edit'), 403);

        $request->validate([
            'title' => 'required',
            'date' => 'required',
        ]);

        $start = Carbon::parse($request->date2[0])->startOfDay();
        $end = Carbon::parse($request->date2[1])->endOfDay();

        $schedule->update([
            'title' => $request->title,
            'start' => $start,
            'end' => $end,
        ]);

        $this->flashSuccess('Your Schedule updated successfully');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        abort_if(! userCan('schedule.destroy'), 403);

        $schedule->delete();

        $this->flashSuccess('Your Schedule has been deleted');

        return back();
    }
}
