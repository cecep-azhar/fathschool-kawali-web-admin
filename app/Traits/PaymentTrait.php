<?php

namespace App\Traits;

use App\Models\Invoice;
use App\Models\Transaction;

trait PaymentTrait
{
    /**
     * Create a new expense transaction.
     *
     * @param  string  $transaction_no
     * @param  string  $type
     * @return bool
     */
    public function createIncomeTransaction(
        $payment_type = 'Cash on'
    ) {
        $session_transaction_info = session('transaction_info');
        $transaction = Transaction::find($session_transaction_info['transaction_id']);

        $transaction->update([
            'method' => $payment_type,
            'status' => 'paid',
            'paid_amount' => $transaction->amount,
        ]);

        $invoice = Invoice::where('id', $transaction->invoice_id)->first();
        if ($invoice) {
            $invoice->update(['status' => 'paid']);
        }
    }
}
