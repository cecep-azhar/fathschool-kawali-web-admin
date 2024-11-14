<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\User;
use App\Services\Leave\StudentLeaveService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StudentLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(! userCan('request-leave.index'), 403);

        $user = authUser();
        $array = ['Student'];

        if (in_array($user->role, $array)) {

            $data = (new StudentLeaveService)->defaultRoleLeavePage($user);

            return inertia('StudentLeave/Index', $data);
        } else {
            // For Admin & Others role
            $data = (new StudentLeaveService)->index($request);

            return inertia('Admin/StudentLeave/Index', $data);
        }
    }

    public function statusChange(Request $request, Leave $leave)
    {
        abort_if(! userCan('request-leave.edit'), 403);

        if ($request->status == 'rejected') {
            $request->validate([
                'cause' => 'required',
            ]);
        }

        $leave->update([
            'status' => $request->status,
            'rejected_cause' => $request->cause,
        ]);

        $this->flashSuccess('Leave '.$request->status.' !');

        return back();
    }

    public function requests()
    {
        abort_if(! userCan('request-leave.index'), 403);

        $leaves = Leave::latest()->with('user')->pending()->paginate(15)->onEachSide(-1);

        return inertia('Admin/Leave/Requests', [
            'leaves' => $leaves,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        abort_if(! userCan('request-leave.edit'), 403);

        $request->validate([
            'user' => 'required',
            'date' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $user = User::FindOrFail($request->user);

        $leave->update([
            'user_id' => $request->user,
            'title' => $user->name,
            'start' => Carbon::parse($request->date[0]),
            'end' => Carbon::parse($request->date[1]),
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $this->flashSuccess('Leave updated');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        abort_if(! userCan('request-leave.destroy'), 403);

        $leave->delete();

        $this->flashSuccess('Leave deleted !');

        return back();
    }
}
