<?php

namespace App\Services\Leave;

use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LeaveService
{
    public function index(object $request): array
    {
        $query = Leave::query();

        // keyword filter
        if ($request->has('keyword') && $request->keyword != null) {

            $query->whereHas('user', function ($user) use ($request) {
                $user->where('name', 'Like', '%'.$request->keyword.'%')
                    ->orWhere('email', 'Like', '%'.$request->keyword.'%')
                    ->orWhere('role', 'Like', '%'.$request->keyword.'%');
            });
        }

        // status filter
        if ($request->has('status') && $request->status != 'all' && $request->status != null) {
            $query->where('status', $request->status);
        } else {
            if ($request->status != 'all') {
                $query->orderby(DB::raw('case when status= "pending" then 1 when status= "rejected" then 2 when status= "accepted" then 3 end'));
            }
        }

        // role filter
        if ($request->has('role') && $request->role != 'all' && $request->role != null) {
            $query->whereHas('user', function ($user) use ($request) {
                $user->where('role', $request->role);
            });
        }

        $leaves = $query->whereHas('user', function ($user) {
            $user->where('role', '!=', 'parent');
        })->latest()->with('user.department')->paginate(10);
        $users = User::active()->latest()->get(['id', 'name', 'email']);

        $data['leaves'] = $leaves;
        $data['filter_data'] = $request;
        $data['users'] = $users;

        return $data;
    }

    public function defaultRoleLeavePage(object $auth_user): array
    {
        $leavesQuery = $auth_user->leaves()->with('user', 'type:id,name')->latest();

        $leaves = $leavesQuery->paginate(20);
        $totalSubmit = $leaves->total();
        $totalApproved = $leavesQuery->accepted()->count();
        $totalRejected = $leavesQuery->rejected()->count();
        $totalPending = $leavesQuery->pending()->count();


        if ($auth_user->role == 'Student') {
            $leave_types = LeaveType::where('role_type', 'student')->get(['id', 'name', 'role_type']);
        } else {
            $leave_types = LeaveType::where('role_type', 'staff')->get(['id', 'name', 'role_type']);
        }

        $data = [
            'leaves' => $leaves,
            'leave_types' => LeaveType::where('role_type', $auth_user->role)->get(['id', 'name', 'role_type']),
            'total_submit' => $totalSubmit,
            'leave_types' => $leave_types,
            'total_approved' => $totalApproved,
            'total_rejected' => $totalRejected,
            'total_pending' => $totalPending,
        ];

        return $data;
    }
}
