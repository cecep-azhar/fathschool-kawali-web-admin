<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class StudentLeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('manage.leave-type'), 403);

        $leave_types = LeaveType::latest()->whereNotIn('role_type', ['teacher', 'staff'])->paginate(15)->onEachSide(-1);

        return inertia('Admin/StudentLeaveType/Index', [
            'leave_types' => $leave_types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(! userCan('manage.leave-type'), 403);

        $request->validate([
            'name' => 'required',
            'role_type' => 'required',
        ]);

        LeaveType::create([
            'role_type' => $request->role_type,
            'name' => $request->name,
        ]);

        $this->flashSuccess('Leave Type Saved !');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveType $leave_type)
    {
        abort_if(! userCan('manage.leave-type'), 403);

        $request->validate([
            'name' => 'required',
            'role_type' => 'required',
        ]);

        $leave_type->update([
            'role_type' => $request->role_type,
            'name' => $request->name,
        ]);

        $this->flashSuccess('Leave Type Updated !');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveType $leave_type)
    {
        abort_if(! userCan('manage.leave-type'), 403);

        $leave_type->delete();

        $this->flashSuccess('Leave Type Deleted !');

        return back();
    }
}
