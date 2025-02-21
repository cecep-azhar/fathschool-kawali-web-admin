<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!userCan('event.index'), 403);

        return inertia('Admin/Event/Index', [
            'all_events' => Event::latest()->paginate(15)->onEachSide(-1),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!userCan('event.create'), 403);

        $request->validate([
            'name' => 'required',
            'date' => 'required',
        ]);

        Event::create([
            'title' => $request->name,
            'start' => Carbon::parse($request->date[0]),
            'end' => Carbon::parse($request->date[1]),
            'color' => $request->color,
        ]);

        $this->flashSuccess('Event created successful !');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        abort_if(!userCan('event.edit'), 403);

        $request->validate([
            'name' => 'required',
            'date' => 'required',
        ]);

        $event->update([
            'title' => $request->name,
            'start' => Carbon::parse($request->date[0]),
            'end' => Carbon::parse($request->date[1]),
            'color' => $request->color,
        ]);

        $this->flashSuccess('Event updated successful !');

        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        abort_if(!userCan('event.destroy'), 403);

        $event->delete();

        $this->flashSuccess('Event delete successful !');

        return redirect()->route('event.index');
    }


    //ANCHOR - API EVENT
    public function getEvents(Request $request)
    {
        try {
            $query = Event::query();

            // Filter berdasarkan rentang tanggal jika ada parameter di request
            if ($request->has('start_date') && $request->has('end_date')) {
                $query->whereBetween('start', [$request->start_date, $request->end_date]);
            }

            $events = $query->latest()->get();

            if ($events->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data Event Tidak Ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Menemukan Data Event',
                'data' => EventResource::collection($events)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'errors' => $th->getMessage()
            ], 500);
        }
    }
}
