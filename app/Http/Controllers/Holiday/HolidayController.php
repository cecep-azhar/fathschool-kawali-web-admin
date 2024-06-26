<?php

namespace App\Http\Controllers\Holiday;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('holiday.index'), 403);

        $holidays = Holiday::oldest('start')->get(['id', 'title', 'start', 'end'])->transform(function ($date) {
            $date->format_start_date = formatTime($date->start, 'D d M');
            $date->format_end_date = formatTime($date->end, 'D d M');

            return $date;
        });

        return inertia('Admin/Holiday/Index', [
            'holidays' => $holidays,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(! userCan('holiday.create'), 403);

        $request->validate(['name' => 'required', 'date' => 'required']);

        Holiday::create([
            'title' => $request->name,
            'start' => Carbon::parse($request->date[0]),
            'end' => Carbon::parse($request->date[1]),
        ]);

        $this->flashSuccess('Holiday created successfullyy');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        abort_if(! userCan('holiday.edit'), 403);

        $request->validate(['name' => 'required', 'date' => 'required']);

        $holiday->update([
            'title' => $request->name,
            'start' => Carbon::parse($request->date[0]),
            'end' => Carbon::parse($request->date[1]),
        ]);

        $this->flashSuccess('Holiday updated successfully !');

        return back();
    }

    /**
     * Resize the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resized(Request $request, Holiday $holiday)
    {
        $holiday->update([
            'title' => $request->title ?? $holiday->title,
            'start' => $request->start ?? $holiday->start,
            'end' => $request->end ?? $holiday->end,
        ]);

        return 'done';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        abort_if(! userCan('holiday.destroy'), 403);

        $holiday->delete();

        $this->flashSuccess('Holiday updated successfully !');

        return back();
    }
}
