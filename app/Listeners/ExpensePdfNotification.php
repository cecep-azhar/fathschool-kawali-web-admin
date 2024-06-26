<?php

namespace App\Listeners;

use App\Events\SchoolExpense;
use App\Models\Currency;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class ExpensePdfNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(SchoolExpense $event)
    {
        $settings = Setting::first();
        $transactions = $event->transactions;
        $totalAmount = 0;

        foreach ($transactions as $transaction) {
            $fromRate = Currency::whereCode($transaction->currency)->first()->rate;
            $toRate = Currency::whereCode('IDR')->first()->rate;
            $rate = $fromRate / $toRate;
            $convertedAmount = (int) round($transaction->amount / $rate, 2);

            $totalAmount += $convertedAmount;
            $transaction->convertedAmount = $convertedAmount;
        }

        $monthName = date('F', strtotime('2023-07-01'));
        $year = 2021;
        $averageExpense = $totalAmount / Carbon::createFromDate($year, 7)->daysInMonth;

        $pdf = Pdf::loadView('export.new.school_expense', [
            'settings' => $settings,
            'transactions' => $transactions,
            'totalAmount' => $totalAmount,
            'monthName' => $monthName,
            'year' => $year,
            'averageExpense' => $averageExpense,
        ]);

        $pdfData = $pdf->output();
        $fileName = 'expense_report_'.$monthName.'_'.$year.'.pdf';

        // Store the PDF in storage
        Storage::disk('public')->put($fileName, $pdfData);
    }
}
