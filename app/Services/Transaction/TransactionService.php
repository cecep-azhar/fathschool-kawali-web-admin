<?php

namespace App\Services\Transaction;

use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use App\Models\Setting;

class TransactionService
{

    public function index(object $request): array
    {
        $query = Transaction::query()->with('type', 'user')->latest('id');

        // filter by keyword
        if ($request->has('keyword') && $request->keyword != null) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'Like', '%' . $request->keyword . '%')

                    ->orWhereHas('type', function ($q) use ($request) {
                        $q->where('name', 'Like', '%' . $request->keyword . '%');
                    })

                    ->orWhereHas('type', function ($q) use ($request) {
                        $q->where('type', 'Like', '%' . $request->keyword . '%');
                    });
            });
        }
        // filter by date
        if ($request->has('start_date') && $request->start_date != null) {
            $query->whereDate('date', '>=', $request->start_date)->whereDate('date', '<=', $request->end_date);
        }

        // filter by over due
        $over_due_days = setting('over_due_days');
        $due_last_date = Carbon::now()->startOfDay()->subDays($over_due_days);

        if ($request->has('over_due') && $request->over_due != 'all' && $request->over_due != null) {
            $query->unpaid()->where(function ($q) use ($due_last_date) {
                $q->where('due_date', '<', $due_last_date);
            });
        }

        // filter by status
        if ($request->has('status') && $request->status != null && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // filter by type
        if ($request->has('type') && $request->type != null && $request->type != 'all') {
            $query->whereHas('type', function ($q) use ($request) {
                $q->where('type', $request->type);
            });
        }
        $result = $query->paginate(15)->onEachSide(-1)->withQueryString();

        if (session('myCurrency')) {
            $code = session('myCurrency')->code;
        } else {
            $code = Setting::first()->app_currency;
        }

        foreach ($result->items() as $transaction) {


            if ($code != $transaction->currency) {

                if ($transaction->date > $transaction->created_at) {
                    $transaction->date = date('d-m-Y', strtotime($transaction->created_at));
                }

                // dd($transaction->currency);
                $fromRate = Currency::whereCode($transaction->currency)?->first()?->rate ?? 1;
                $toRate = Currency::whereCode($code)?->first()?->rate ?? 1;
                $rate = $fromRate / $toRate;


                $transaction->amount = number_format($transaction->amount / $rate, 2);
                $transaction->paid_amount = number_format($transaction->paid_amount / $rate, 2);
            }
        }

        $data['transactions'] = $result;
        $data['filter_data'] = $request;

        return $data;
    }

    public function studentFees(object $request, object $user): array
    {
        $query = $user->transactions()->with('type')->with('type', 'user')->latest();

        // filter by keyword
        if ($request->has('keyword') && $request->keyword != null) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'Like', '%' . $request->keyword . '%')

                    ->orWhereHas('type', function ($q) use ($request) {
                        $q->where('name', 'Like', '%' . $request->keyword . '%');
                    })

                    ->orWhereHas('type', function ($q) use ($request) {
                        $q->where('type', 'Like', '%' . $request->keyword . '%');
                    });
            });
        }
        // filter by date
        if ($request->has('start_date') && $request->start_date != null) {
            $query->whereDate('date', '>=', $request->start_date)->whereDate('date', '<=', $request->end_date);
        }

        // filter by over due
        $over_due_days = setting('over_due_days');
        $due_last_date = Carbon::now()->startOfDay()->subDays($over_due_days);

        if ($request->has('over_due') && $request->over_due != 'all' && $request->over_due != null) {
            $query->unpaid()->where(function ($q) use ($due_last_date) {
                $q->where('due_date', '<', $due_last_date);
            });
        }

        // filter by status
        if ($request->has('status') && $request->status != null && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // filter by type
        if ($request->has('type') && $request->type != null && $request->type != 'all') {
            $query->whereHas('type', function ($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        $transactions = $query->paginate(20)->withQueryString();

        if (session('myCurrency')) {
            $code = session('myCurrency')->code;
        } else {
            $code = Setting::first()->app_currency;
        }

        foreach ($transactions->items() as $transaction) {


            if ($code != $transaction->currency) {

                if ($transaction->date > $transaction->created_at) {
                    $transaction->date = date('d-m-Y', strtotime($transaction->created_at));
                }

                $fromRate = Currency::whereCode($transaction->currency)->first()->rate;
                $toRate = Currency::whereCode($code)->first()->rate;
                $rate = $fromRate / $toRate;

                $transaction->amount = number_format($transaction->amount / $rate, 2);
                $transaction->paid_amount = number_format($transaction->paid_amount / $rate, 2);
            }
        }


        $amount = $user->transactions()->latest()->sum('amount');
        $paid_amount = $user->transactions()->latest()->sum('paid_amount');
        $total_amount = $amount;
        $due_amount = $amount - $paid_amount;
        $total_due_amount = $due_amount > 0 ? $due_amount : 0;

        // this year transaction
        $this_year_start = Carbon::now()->startOfYear();
        $this_year_end = Carbon::now()->endOfYear();
        $this_month_transactions = $user->transactions()->latest()
            ->whereBetween('date', [$this_year_start, $this_year_end])
            ->get()->groupBy(function ($q) {
                return Carbon::parse($q->date)->format('m');
            })->map(function ($row) {
                return $row->sum('amount');
            });

        $this_year_labels = [];
        $this_year_values = [];

        foreach ($this_month_transactions as $key => $value) {
            array_push($this_year_labels, strval($key));
            array_push($this_year_values, $value);
        }

        $data['transactions'] = $transactions;
        $data['filter_data'] = $request;
        $data['total_amount'] = $total_amount;
        $data['total_due_amount'] = $total_due_amount;
        $data['this_year_labels'] = $this_year_labels;
        $data['this_year_values'] = $this_year_values;

        return $data;
    }
}
