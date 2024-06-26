<?php

namespace App\Services\Admin\User;

use App\Models\Invoice;
use App\Models\Plan;
use App\Services\Accountant\Invoice\CreateInvoiceService;
use App\Traits\InvoiceTrait;
use Illuminate\Support\Carbon;

class StudentRecurringInvoiceService
{
    use InvoiceTrait;

    public function storeInvoice(object $user, string $plan_id)
    {
        $plan = Plan::FindOrFail($plan_id);

        // <!-- invoice create -->
        $invoice_date = Carbon::now();
        $invoice_number = (new CreateInvoiceService)->generateUniqueCode();
        $title = $user->name.' Recurring '.date('d-m-Y', strtotime($invoice_date));
        $due_date_in = 10;
        $due_date = Carbon::parse($invoice_date)->addDays($due_date_in);
        $message = $title;
        $currency = setting('app_currency') ?? 'USD';
        $total_amount = $plan->price;
        $recurring = true;
        $status = 'unpaid';
        $recurring_days = 30; // every month

        $student_user_id = $user->id;

        $invoice = Invoice::create([
            'user_id' => $student_user_id,
            'invoice_no' => $invoice_number,
            'title' => $title,
            'date' => $invoice_date,
            'due_date_in' => $due_date_in,
            'due_date' => $due_date,
            'message' => $message,
            'currency' => $currency,
            'amount' => $total_amount,
            'status' => $status,
            // about recurring
            'recurring' => $recurring,
            'recurring_status' => $recurring ? true : false,
            'recurring_date' => Carbon::now()->addDays($recurring_days),
            'recurring_days' => $recurring_days,
        ]);
        // <!-- invoice create end -->

        // <!-- items create under an invoice -->
        $invoice->items()->create([
            'amount' => $total_amount,
            'description' => $message,
        ]);
        // <!-- items create under an invoice end -->

        // <!-- image create under an invoice end -->
        $due_date = $invoice->due_date;

        $this->createTransaction($invoice->id, $due_date); // create transaction as income

        return true;
    }

    public function updateInvoice(object $user, string $plan_id): void
    {
        $plan = Plan::FindOrFail($plan_id);
        $invoice = Invoice::where('user_id', $user->id)->where('recurring', true)->first();
        if ($invoice) {
            // <!-- invoice create -->
            $total_amount = $plan->price;

            $invoice->update([
                'amount' => $total_amount,
            ]);
            // <!-- invoice create end -->

            // <!-- items create under an invoice -->
            $invoice->items()->delete();
            $invoice->items()->create([
                'amount' => $total_amount,
                'description' => $invoice->message,
            ]);
            // <!-- items create under an invoice end -->
        }
    }
}
