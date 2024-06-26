<?php

namespace App\Services\Parent;

use App\Models\Assignment;
use App\Models\OnlineClass;
use App\Models\SubmittedAssignment;
use App\Traits\CheckParentOrChildren;
use Carbon\Carbon;

class DashboardService
{
    use CheckParentOrChildren;

    public function kidDashboard(object $request, string $roll_no, object $child, object $child_profile): array
    {
        $user = $this->checkUser();

        // Eager load relationships
        $user->load(['courses', 'transactions', 'attendances.subject.teachers', 'submitted_assignments']);

        // Get student courses ids
        $assigned_courses = $user->courses->pluck('course_id');

        // Count pending fees
        $data['pending_fees'] = $user->transactions()->unpaid()->count();

        // Count today assignment submission
        $data['today_assignment_submit'] = SubmittedAssignment::whereDay('created_at', now()->day)
            ->where('student_id', $user->id)->count();

        // Count today classes
        $data['today_classes'] = OnlineClass::whereIn('course_id', $assigned_courses)
            ->whereDay('start_time', now()->day)
            ->count();

        // Count attendance status
        $data['present_classes'] = $user->attendances()->present()->count();
        $data['late_classes'] = $user->attendances()->late()->count();
        $data['absent_classes'] = $user->attendances()->absent()->count();

        // Count total assignments and remaining assignments
        $data['total_assignments'] = Assignment::whereIn('course_id', $assigned_courses)->count();
        $data['total_submitted_assignments'] = $user->submitted_assignments->count();
        $total_remaining_amount = $data['total_assignments'] - $data['total_submitted_assignments'];
        $data['total_remaining_assignments'] = $total_remaining_amount > 1 ? $total_remaining_amount : 0;

        // Calculate total and due amounts
        $data['total_tr_amount'] = $user->transactions->sum('amount');
        $paid_amount = $user->transactions->sum('paid_amount');
        $due_amount = $data['total_tr_amount'] - $paid_amount;
        $data['total_due_amount'] = $due_amount > 0 ? $due_amount : 0;

        // Group attendance data by subject and calculate relevant values
        $get_all_attendances = $user->attendances->groupBy('subject_id');

        $attendance_arr = [];
        foreach ($get_all_attendances as $key => $attendance) {
            $subject = $attendance->first()->subject;

            $total_classes = $attendance->count();
            $total_present_classes = $attendance->where('status', 'present')->count();
            $first_teacher = $subject->teachers->first();

            $custom_item = [
                'subject_id' => $key,
                'subject_name' => $subject ? $subject->name : '',
                'user_id' => $user ? $user->id : '',
                'total_classes' => $total_classes,
                'total_present_classes' => $total_present_classes,
                'present_score' => round(($total_present_classes / $total_classes) * 100, 2),
                'teacher' => $first_teacher ? $first_teacher->name : '',
            ];
            array_push($attendance_arr, $custom_item);
        }
        $data['attendance_arr'] = $attendance_arr;

        // transaction
        $amount = $user->transactions()->latest()->sum('amount');
        $paid_amount = $user->transactions()->latest()->sum('paid_amount');
        $data['total_amount'] = $amount;
        $due_amount = $amount - $paid_amount;
        $data['total_due_amount'] = $due_amount > 0 ? $due_amount : 0;

        // $data['this_month_transactions'] = $user->transactions()->latest()
        //     ->whereBetween('date', [$this_year_start, $this_year_end])
        //     ->get()->groupBy(function ($q) {
        //         return Carbon::parse($q->date)->format('d-m-Y');
        //     });

        // $data['this_month_transactions'] = $user->transactions()->latest()
        //     ->whereBetween('date', [$this_year_start, $this_year_end])
        //     ->get()->groupBy(function ($q) {
        //         return Carbon::parse($q->date)->format('m');
        //     });

        // this year transaction
        // Calculate this year's transaction data
        $this_year_start = Carbon::now()->startOfYear();
        $this_year_end = Carbon::now()->endOfYear();
        $this_month_transactions = $user->transactions->whereBetween('date', [$this_year_start, $this_year_end])
            ->groupBy(function ($q) {
                return Carbon::parse($q->date)->format('m');
            })->map(function ($row) {
                return $row->sum('amount');
            });

        $data['this_year_labels'] = $this_month_transactions->keys()->map(function ($month) {
            return strval($month);
        })->all();
        $data['this_year_values'] = $this_month_transactions->values()->all();

        return $data;
    }
}
