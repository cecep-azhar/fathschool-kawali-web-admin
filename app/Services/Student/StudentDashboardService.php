<?php

namespace App\Services\Student;

use App\Models\Assignment;
use App\Models\Event;
use App\Models\Exam;
use App\Models\OnlineClass;
use Carbon\Carbon;

class StudentDashboardService
{
    public function dashboard(object $request)
    {
        $user = authUser();

        $userCourses = $user->courses()->with('course.students')->get();

        $userCourseIds = $userCourses->pluck('course_id')->toArray();
        $data['user_courses_name'] = $userCourses->pluck('course.name');

        $courseStudents = $userCourses->pluck('course.students_count')->toArray();

        $data['total_students'] = array_sum($courseStudents);

        // upcoming events
        $data['upcoming_events'] = Event::whereDate('start', '>=', Carbon::now()->endOfDay())
            ->count();

        // upcoming classes
        $data['upcoming_classes'] = OnlineClass::whereDate('start_time', '>=', Carbon::now()->endOfDay())->count();

        // pending assignments

        $data['pending_assignments'] = $user->submitted_assignments()->pending()->count();

        // pending fees
        $data['pending_fees'] = $user->transactions()->unpaid()->count();

        // today Classes
        $currentDay = now()->day;

        $data['today_classes'] = OnlineClass::select('id', 'topic')
            ->where(function ($query) use ($userCourseIds, $currentDay) {
                $query->whereIn('course_id', $userCourseIds)
                    ->whereDay('start_time', $currentDay);
            })
            ->limit(5)
            ->get();

        // next assignment
        $data['next_assignments'] = Assignment::whereIn('course_id', $userCourseIds)
            ->whereDate('start_date', '>=', Carbon::now()->endOfDay())
            ->orWhereDate('start_date', '>=', Carbon::now()->endOfDay())
            ->with(['class', 'subject', 'teacher'])
            ->limit(5)
            ->get();

        // upcoming exams
        $data['upcoming_exams'] = Exam::whereIn('course_id', $userCourseIds)
            ->whereDate('start_date', '>=', Carbon::now()->endOfDay())
            ->with('course:id,name')
            ->limit(5)->get();

        // upcoming event
        $data['upcoming_events'] = Event::whereDate('start', '>=', Carbon::now()->endOfDay())
            ->limit(5)->get();

        // transaction statistic
        $amount = $user->transactions()->latest()->sum('amount');
        $paid_amount = $user->transactions()->latest()->sum('paid_amount');
        $data['total_amount'] = $amount;
        $due_amount = $amount - $paid_amount;
        $data['total_due_amount'] = $due_amount > 0 ? $due_amount : 0;

        // assignment statistic
        $data['total_assignments'] = $user->assignments()->count();
        $data['total_submitted_assignments'] = $user->submitted_assignments()->count();
        $total_remaining_amount = $data['total_assignments'] - $data['total_submitted_assignments'];
        $data['total_remaining_assignments'] = $total_remaining_amount > 1 ? $total_remaining_amount : 0;

        // attendance statistic
        $data['present_classes'] = $user->attendances()->present()->count();
        $data['late_classes'] = $user->attendances()->late()->count();
        $data['absent_classes'] = $user->attendances()->absent()->count();

        $get_all_attendances = $user->attendances()
            ->with('subject.teachers')
            ->latest()
            ->get()
            ->groupBy('subject_id');

        $attendance_arr = $get_all_attendances->map(function ($attendance, $key) use ($user) {
            $subject = $attendance->first()->subject;
            $subjectName = $subject ? $subject->name : '';
            $userId = $user ? $user->id : '';

            $total_classes = $attendance->count();
            $total_present_classes = $attendance->filter(function ($item) {
                return $item->present;
            })->count();

            $first_teacher = $subject?->teachers->first();
            $teacherName = $first_teacher ? $first_teacher->name : '';

            return [
                'subject_id' => $key,
                'subject_name' => $subjectName,
                'user_id' => $userId,
                'total_classes' => $total_classes,
                'total_present_classes' => $total_present_classes,
                'present_score' => round(($total_present_classes / $total_classes) * 100, 2),
                'teacher' => $teacherName,
            ];
        })->values();

        $data['attendance_arr'] = $attendance_arr;

        // this year transaction
        $this_year_start = Carbon::now()->startOfYear();
        $this_year_end = Carbon::now()->endOfYear();
        $this_month_transactions = $user->transactions()
            ->latest()
            ->whereBetween('date', [$this_year_start, $this_year_end])
            ->get()
            ->groupBy(function ($q) {
                return Carbon::parse($q->date)->format('m');
            })
            ->map(function ($row) {
                return $row->sum('amount');
            });

        $data['this_year_labels'] = $this_month_transactions->keys()->toArray();
        $data['this_year_values'] = $this_month_transactions->values()->toArray();

        return $data;
    }
}
