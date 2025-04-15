<?php

namespace App\Services\Admin;

use App\Models\ClassRoutine;
use App\Models\Event;
use App\Models\Exam;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminDashboardService
{
    public function dashboard($request)
    {
        $users = User::query()->active();

        // total users overview
        $data['total_admins'] = $users->admin()->count();
        $data['total_teachers'] = $users->teacher()->count();
        $data['total_parents'] = $users->parent()->count();
        $data['total_students'] = $users->student()->count();
        $data['total_accountants'] = $users->accountant()->count();
        $data['total_others'] = $users->whereNotIn('role', ['Admin', 'Teacher', 'Parent', 'Student', 'Accountant'])->count();

        // total leave request
        $startDate = Carbon::today()->startOfDay();
        $endDate = Carbon::today()->endOfDay();

        $data['total_leave_requests'] = Leave::pending()
            ->whereBetween('start', [$startDate, $endDate])
            ->count();

        // today total exams
        $data['this_month_total_exams'] = Exam::whereBetween('start_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();

        // today event
        $data['this_week_events'] = Event::whereBetween('start', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        // Get the active status from settings
        $activeStatus = Setting::pluck('status')->toArray();

        // Modify the query to filter class routines based on activation status
        $holidays = Holiday::all(['id', 'title', 'start', 'end']);
        $schedules = ClassRoutine::with(['course:id,name', 'teacher:id,name', 'subject:id,name,color'])
            ->where('activation', $activeStatus) // Filter based on the active status
            ->get()
            ->transform(function ($data) {
                $data->title = 'Course: ' . $data->course->name . '<br>' . 'Teacher: ' . $data->teacher->name . '<br>' . 'Subject: ' . $data->subject->name . '<br>Time: ' . Carbon::parse($data->start_time)->format('h:i') . ' - ' . Carbon::parse($data->end_time)->format('h:i A');
                $data->color = $data->subject->color;
                $data->startTime = $data->start_time;
                $data->endTime = $data->end_time;
                $data->daysOfWeek = [intval($data->weekday)];

                return $data;
            });

        $events = Event::all(['id', 'title', 'start', 'end']);
        $data['events'] = Arr::collapse([$holidays, $events, $schedules]);

        // chart data --> week
        $chart_income_data = $this->barChartIncomeTransaction($request);
        $chart_student_admission_data = $this->barChartStudentAdmission($request);
        $data['paid_data_label_income'] = $chart_income_data['paid_data_label_income'];
        $data['paid_data_value_income'] = $chart_income_data['paid_data_value_income'];
        $data['admission_data_label_income'] = $chart_student_admission_data['admission_data_label_income'];
        $data['admission_data_value_income'] = $chart_student_admission_data['admission_data_value_income'];
        $data['query'] = $request;

        // upcoming birthdays
        $users = User::all()->append(['next_birth_date', 'next_birth_remaining_days'])->where('role', '!=', 'Parent')->where('next_birth_remaining_days', '!=', null);
        $sorted_birthdays = $users->sortBy('next_birth_remaining_days');
        $data['upcoming_birthdays'] = $sorted_birthdays->values()->take(5)->all();

        $today = Carbon::now()->endOfDay();
        $data['upcoming_events'] = Event::where('start', '>', $today)->latest('start')->limit(5)->get();

        return $data;
    }


    public function barChartIncomeTransaction($request)
    {
        if ($request->has('query') && $request['query'] == 'month') {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
        } elseif ($request->has('query') && $request['query'] == 'week') {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
        } elseif ($request->has('query') && $request['query'] == 'today') {
            $today = Carbon::today()->toDateString();

            return [
                'paid_data_label_income' => [$today],
                'paid_data_value_income' => [Transaction::income()->latest()
                    ->whereDate('date', $today)->sum('amount')],
            ];
        } else {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
        }

        $days = CarbonPeriod::create($start, $end)->map(fn($date) => $date->toDateString());

        $data_label = [];
        $data_value = [];

        foreach ($days as $day) {
            array_push($data_label, $day);
            array_push($data_value, Transaction::income()->whereDate('date', $day)->sum('amount'));
        }

        return [
            'paid_data_label_income' => $data_label,
            'paid_data_value_income' => $data_value,
        ];
    }

    public function barChartStudentAdmission($request)
    {
        if ($request->has('admissionQuery') && $request['admissionQuery'] == 'month') {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
        } elseif ($request->has('admissionQuery') && $request['admissionQuery'] == 'today') {
            $today = Carbon::today()->toDateString();

            return [
                'admission_data_label_income' => [$today],
                'admission_data_value_income' => [User::student()->latest()
                    ->whereDate('created_at', '=', $today)->count()],
            ];
        } else {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
        }

        $days = CarbonPeriod::create($start, $end)->map(fn($date) => $date->toDateString());

        $data_label = [];
        $data_value = [];

        foreach ($days as $day) {
            array_push($data_label, $day);
            array_push($data_value, User::student()->whereDate('created_at', $day)->count());
        }

        return [
            'admission_data_label_income' => $data_label,
            'admission_data_value_income' => $data_value,
        ];
    }
}
