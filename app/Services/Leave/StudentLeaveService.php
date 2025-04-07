<?php

namespace App\Services\Leave;

use App\Models\Course;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentLeaveService
{
    public function index(object $request): array
    {
        $query = Leave::query();

        // keyword filter
        if ($request->has('keyword') && $request->keyword != null) {
            $query->whereHas('user', function ($user) use ($request) {
                $user->where('name', 'Like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'Like', '%' . $request->keyword . '%')
                    ->orWhere('role', 'Like', '%' . $request->keyword . '%');
            });
        }

        // Default date filter: hari ini
        $today = Carbon::today();
        $startDate = $request->start_date
            ? Carbon::createFromFormat('Y-m-d', $request->start_date)->startOfDay()
            : $today->copy()->startOfDay();

        $endDate = $request->end_date
            ? Carbon::createFromFormat('Y-m-d', $request->end_date)->endOfDay()
            : $today->copy()->endOfDay();

        // Ambil data yang berada di antara start-end date
        $query->whereDate('start', '<=', $endDate)
            ->whereDate('end', '>=', $startDate);

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

        // leave_type filter
        if ($request->has('leave_type') && $request->leave_type != 'all' && $request->leave_type != null) {
            $query->whereHas('type', function ($leaveType) use ($request) {
                $leaveType->where('slug', $request->leave_type);
            });
        }

        // class filter (filter berdasarkan kelas)
        if ($request->has('class') && $request->class != 'all' && $request->class != null) {
            $query->whereHas('user.courses.course', function ($course) use ($request) {
                $course->where('slug', $request->class);
            });
        }

        $leaves = $query->whereHas('user', function ($user) {
            $user->whereNotIn('role', ['parent', 'teacher', 'administration', 'accountant', 'admin']);
        })
            ->latest()->with(['user.department', 'user.courses.course', 'type'])
            ->paginate(10)
            ->withQueryString();

        // dd($leaves);
        $users = User::active()->latest()->get(['id', 'name', 'email']);

        $leave_types = LeaveType::whereNotIn('role_type', ['teacher', 'staff'])
            ->select('name', 'slug')
            ->distinct()
            ->get();


        $classes = Course::get(['id', 'name', 'slug']);

        $data['leaves'] = $leaves;
        $data['filter_data'] = $request;
        $data['users'] = $users;
        $data['leave_types'] = $leave_types;
        $data['classes'] = $classes;

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
