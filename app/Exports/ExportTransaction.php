<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportTransaction implements FromCollection, WithHeadings, WithMapping
{
    public $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->month == 'this_month') {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();

            return Transaction::whereDate('date', '>=', $start)->whereDate('date', '<=', $end)->latest()->with('type', 'user')->get();
        } elseif ($this->month == 'last_month') {
            $start = Carbon::now()->startOfMonth()->subMonth();
            $end = Carbon::now()->endOfMonth()->subMonth();

            return Transaction::whereDate('date', '>=', $start)->whereDate('date', '<=', $end)->latest()->with('type', 'user')->get();
        } else {
            $start = Carbon::now()->startOfMonth()->subMonths(6);
            $end = Carbon::now()->endOfMonth()->subMonths(6);

            return Transaction::whereDate('date', '>=', $start)->whereDate('date', '<=', $end)->latest()->with('type', 'user')->get();
        }
    }

    /**
     * Xls Mapping for relationship data get
     *
     * @return \Illuminate\Support\Collection
     */
    public function map($transaction): array
    {
        return [
            $transaction->title,
            $transaction->type->type,
            $transaction->user ? $transaction->user->name : '',
            $transaction->amount,
            $transaction->paid_amount,
            $transaction->method,
            $transaction->date,
            $transaction->document,
        ];
    }

    /**
     * Xls Heading return
     *
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Title',
            'Type',
            'Recipient',
            'Amount',
            'Paid Amount',
            'Method',
            'Date',
            'Document',
        ];
    }
}
