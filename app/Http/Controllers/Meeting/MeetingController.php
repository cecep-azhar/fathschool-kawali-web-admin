<?php

namespace App\Http\Controllers\Meeting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Meeting\MeetingCreateRequest;
use App\Models\Meeting;
use App\Models\User;
use App\Services\Admin\Meeting\CreateMeetingService;
use App\Services\Admin\Meeting\UpdateMeetingService;
use App\Traits\NotifyAble;
use App\Traits\ZoomMeetingTrait;
use Exception;
use Spatie\Permission\Models\Role;

class MeetingController extends Controller
{
    use NotifyAble;
    use ZoomMeetingTrait;

    const MEETING_TYPE_INSTANT = 1;

    const MEETING_TYPE_SCHEDULE = 2;

    const MEETING_TYPE_RECURRING = 3;

    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('meeting.index'), 403);

        return inertia('Admin/Meeting/Index', [
            'meetings' => Meeting::latest()->with(['user', 'participants.user:id,role'])->paginate(15)->onEachSide(-1),
            'users' => User::latest()->active()->get(['id', 'name', 'email', 'role']),
            'roles' => Role::latest()->get(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MeetingCreateRequest $request)
    {
        abort_if(! userCan('meeting.create'), 403);

        if (zMeetConfig()) {
            try {
                $meeting = $this->create_zoom($request);

                (new CreateMeetingService)->create($meeting, $request);

                $this->flashSuccess('Meeting Successfully Created');

                return back();
            } catch (Exception $e) {
                $this->flashWarning($e->getMessage());

                return redirect()->back();
            }
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MeetingCreateRequest $request, Meeting $meeting)
    {
        abort_if(! userCan('meeting.edit'), 403);

        if (zMeetConfig()) {
            try {
                $this->update_zoom($request, $meeting->meeting_id);
                $updated_meeting = $this->get_zoom($meeting->meeting_id);

                (new UpdateMeetingService)->update($updated_meeting, $meeting, $request);

                $this->flashSuccess('Meeting Successfully Updated');

                return back();
            } catch (Exception $e) {
                $this->flashWarning($e->getMessage());

                return redirect()->back();
            }
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        abort_if(! userCan('meeting.destroy'), 403);

        try {
            $this->delete_zoom($meeting->meeting_id);

            $meeting->delete();
            $this->flashSuccess('Meeting Successfully Deleted');

            return back();
        } catch (Exception $e) {
            $this->flashWarning($e->getMessage());

            return redirect()->back();
        }
    }
}
