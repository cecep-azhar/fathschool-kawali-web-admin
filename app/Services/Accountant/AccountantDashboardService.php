<?php

namespace App\Services\Accountant;

use App\Models\Event;
use App\Models\Transaction;
use Carbon\Carbon;

class AccountantDashboardService
{
    public function dashboard($request)
    {
        $transaction_query = Transaction::query()->latest();

        // over due transactions
        $over_due_days = setting('over_due_days');
        $due_last_date = Carbon::now()->startOfDay()->subDays($over_due_days);
        $transaction_query->unpaid()->where('due_date', '<', $due_last_date);
        $data['over_due_transactions'] = $transaction_query->count();
        // over due transactions End

        // this month data
        $data['this_start_month'] = date('Y-m-d', strtotime(Carbon::now()->startOfMonth()));
        $data['this_end_month'] = date('Y-m-d', strtotime(Carbon::now()->endOfMonth()));
        $data['this_month_transaction_amount'] = currencyFormat($transaction_query->whereMonth('created_at', Carbon::now()->month)->sum('amount'));

        // unpaid transactions
        $data['unpaid_total_transaction_count'] = currencyFormat($transaction_query->unpaid()->count());
        $data['unpaid_total_transaction_amount'] = currencyFormat($transaction_query->unpaid()->sum('amount'));

        // expense transactions
        $data['expense_total_transaction_count'] = $transaction_query->expense()->count();
        $data['expense_total_transaction_amount'] = currencyFormat($transaction_query->expense()->sum('amount'));

        // chart data --> week
        $chart_income_data = $this->WeeklyChartDataIncome($request);
        $chart_expense_data = $this->WeeklyChartDataExpense($request);

        $data['week_data_label_income'] = $chart_income_data['week_data_label_income'];
        $data['week_data_value_income'] = $chart_income_data['week_data_value_income'];
        $data['week_data_value_expense'] = $chart_expense_data['week_data_value_expense'];

        // pie chart data
        $data['pie_data'] = $this->pieData($request);

        // transactions
        $data['total_transaction_amount'] = currencyFormat($transaction_query->sum('amount'));
        $data['total_paid_amount'] = currencyFormat($transaction_query->sum('paid_amount'));
        $data['five_transactions'] = $transaction_query->take(5)->get();
        $data['five_chart_transactions'] = $transaction_query->take(5)->get()->map(function ($q) {
            return $q->amount;
        });
        $data['query'] = $request;
        $data['two_events'] = Event::latest()->take(2)->get();

        return $data;
    }

    public function WeeklyChartDataIncome($request)
    {
        if ($request->has('query') && $request['query'] == 'month') {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
            $format = 'W';
            $text = 'Week ';
        } elseif ($request->has('query') && $request['query'] == 'year') {
            $start = Carbon::now()->startOfYear();
            $end = Carbon::now()->endOfYear();
            $format = 'M';
            $text = 'Month ';
        } else {

            if (
                $request->has('start_date') &&
                $request->has('end_date') &&
                $request->start_date != null &&
                $request->end_date != null
            ) {
                $start = Carbon::parse($request->start_date);
                $end = Carbon::parse($request->end_date);
                $format = 'W';
                $text = 'Week ';
            } else {
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                $format = 'D';
                $text = 'Day ';
            }
        }

        $by_weeks = Transaction::income()->latest()
            ->whereBetween('date', [
                $start,
                $end,
            ])->get()->groupBy(function ($date) use ($format) {
                return Carbon::parse($date->date)->format($format);
            })->map(function ($q) {
                return currencyFormat($q->sum('amount'));
            });

        $week_data_label_income = [];
        $week_data_value_income = [];
        $i = 1;
        foreach ($by_weeks as $key => $value) {
            array_push($week_data_label_income, $text.$i);
            array_push($week_data_value_income, $value);
            $i = $i + 1;
        }

        return [
            'week_data_label_income' => $week_data_label_income,
            'week_data_value_income' => $week_data_value_income,
        ];
    }

    public function WeeklyChartDataExpense($request)
    {
        if ($request->has('query') && $request['query'] == 'month') {
            $start = Carbon::now()->startOfYear();
            $end = Carbon::now()->endOfYear();
            $format = 'M';
        } elseif ($request->has('query') && $request['query'] == 'year') {
            $start = Carbon::now()->startOfYear()->subYears(10);
            $end = Carbon::now()->endOfYear();
            $format = 'Y';
            $text = 'Year ';
        } else {
            if (
                $request->has('start_date') &&
                $request->has('end_date') &&
                $request->start_date != null &&
                $request->end_date != null
            ) {
                $start = Carbon::parse($request->start_date);
                $end = Carbon::parse($request->end_date);
                $format = 'W';
                $text = 'Week ';
            } else {
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                $format = 'W';
                $text = 'Week ';
            }
        }

        $by_weeks = Transaction::expense()->latest()
            ->whereBetween('date', [
                $start,
                $end,
            ])->get()->groupBy(function ($date) use ($format) {
                return Carbon::parse($date->date)->format($format);
            })->map(function ($q) {
                return $q->sum('amount');
            });

        $week_data_value_expense = [];
        foreach ($by_weeks as $key => $value) {
            array_push($week_data_value_expense, $value);
        }

        return [
            'week_data_value_expense' => $week_data_value_expense,
        ];
    }

    public function pieData(object $request)
    {
        $paid_pie_data = Transaction::paid()
            ->whereBetween('date', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
            ])->sum('amount');

        $unpaid_pie_data = Transaction::unpaid()
            ->whereBetween('date', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
            ])->sum('amount');

        return $data['pie_data'] = [
            currencyFormat($paid_pie_data),
            currencyFormat($unpaid_pie_data),
        ];
    }
}
