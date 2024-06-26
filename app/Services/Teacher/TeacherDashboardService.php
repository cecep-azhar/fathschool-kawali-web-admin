<?php

namespace App\Services\Teacher;

use App\Models\Assignment;
use App\Models\ClassRoutine;
use App\Models\Event;
use Carbon\Carbon;

class TeacherDashboardService
{
    public function dashboard()
    {
        // total class
        $data['total_subjects'] = authUser()->subjects->count();

        // leave
        $leave_query = authUser()->leaves()->latest();
        $data['total_leaves'] = $leave_query->count();
        $data['total_accepted_leaves'] = $leave_query->accepted()->count();
        $data['total_rejected_leaves'] = $leave_query->rejected()->count();

        // assignment
        $data['total_assignments'] = Assignment::whereDate('end_date', '<=', Carbon::now())
            ->where('user_id', auth()->id())->count();

        // today event
        $data['today_events'] = Event::whereDate('start', Carbon::now()->endOfDay())->count();

        // pending assignments
        $data['pending_assignments'] = Assignment::with('class:id,name', 'subject:id,name')
            ->whereDate('end_date', '>=', Carbon::now())
            ->where('user_id', auth()->id())->take(10)->latest()->get();

        // class schedule
        $data['schedules'] = ClassRoutine::where('teacher_id', auth()->id())->with(['course:id,name', 'subject:id,name,color'])->get()
            ->transform(function ($data) {
                $data->daysOfWeek = (string) $data->weekday;
                $data->startTime = $data->start_time;
                $data->endTime = $data->end_time;
                $data->color = $data->subject->color;
                $data->title = 'Class: '.$data->course->name.'<br>'.'Subject: '.$data->subject->name;

                return $data;
            });

        return $data;
    }
}
