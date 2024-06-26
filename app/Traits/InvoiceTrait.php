<?php

namespace App\Traits;

use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserProfile;
use App\Notifications\Accountant\NewInvoiceAvailableNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

trait InvoiceTrait
{
    public function invoiceCreate($request)
    {
        // <!-- invoice create -->
        $date_data_type = gettype($request->date);
        if ($date_data_type == 'array') {
            $invoice_date = Carbon::parse($request->date['$d']);
        } else {
            $invoice_date = Carbon::parse($request->date);
        }

        if ($request->due_date_in == 'date') {
            $due_date = Carbon::parse($request->due_date);
        } else {
            $due_date = Carbon::now()->addDays($request->due_date_in);
        }

        $student_user_id = $request->user;
        $parent_user = UserProfile::where('user_id', $student_user_id)->first();

        // recurring days amount
        $recurring_days = $request->recurring_days;
        // if type is day then add day to recurring amount
        $next_generate_date = Carbon::now()->addDays($recurring_days);

        $invoice = Invoice::create([
            'user_id' => $student_user_id,
            'invoice_no' => $request->invoice_number,
            'title' => $request->title,
            'date' => $invoice_date,
            'due_date_in' => $request->due_date_in,
            'due_date' => $request->due_date_in != 0 ? $due_date : null,
            'message' => $request->message,
            'currency' => $request->currency,
            'amount' => $request->total_amount,
            'status' => $request->status ? 'paid' : 'unpaid',
            // about recurring
            'recurring' => $request->recurring,
            'recurring_status' => $request->recurring ? true : false,
            'recurring_date' => $request->recurring ? $next_generate_date : null,
            'recurring_days' => $request->recurring_days,
        ]);
        // <!-- invoice create end -->

        // <!-- items create under an invoice -->
        foreach ($request->amount as $key => $value) {

            $invoice->items()->create([
                'amount' => $request->amount[$key] ?? '',
                'description' => $request->description[$key] ?? '',
            ]);
        }
        // <!-- items create under an invoice end -->

        // <!-- image create under an invoice -->
        if ($request->attachments) {
            foreach ($request->attachments as $key => $value) {

                $url = FileUpload::uploadImage($value, 'invoice');
                $invoice->attachments()->create([
                    'attachment_url' => $url,
                ]);
            }
        }
        // <!-- image create under an invoice end -->
        $transaction = $this->createTransaction($invoice->id, $invoice->due_date ?? ''); // create transaction as income

        if (checkMailConfig() && ! $invoice->recurring) {
            $user = User::where('id', $invoice->user_id)->first();
            Notification::send($user, new NewInvoiceAvailableNotification($user, $transaction));
            $parents = $user->parents;
            if ($parents) {
                foreach ($parents as $key => $parent) {
                    Notification::send($parent, new NewInvoiceAvailableNotification($parent, $transaction));
                }
            }
        }

        return $invoice;
    }

    public function invoiceUpdate($request, $invoice)
    {
        // <!-- invoice create -->
        $invoice_date = Carbon::parse($request->date);

        if ($request->due_date_in == 'date') {

            $request->validate([
                'due_date' => 'required',
            ]);

            $due_date = Carbon::parse($request->due_date);
        } else {
            $due_date = Carbon::now()->addDays($request->due_date_in);
        }

        $student_user_id = $request->user;
        $parent_user = UserProfile::where('user_id', $student_user_id)->first();

        // recurring days amount
        $recurring_days = $request->recurring_days;
        // if type is day then add day to recurring amount
        $next_generate_date = Carbon::now()->addDays($recurring_days);

        $invoice->update([
            'user_id' => $request->user,
            'invoice_no' => $request->invoice_number,
            'title' => $request->title,
            'date' => $invoice_date,
            'due_date_in' => $request->due_date_in,
            'due_date' => $request->due_date_in != 0 ? $due_date : null,
            'message' => $request->message,
            'currency' => $request->currency,
            'amount' => $request->total_amount,
            'status' => $request->status ? 'paid' : 'unpaid',
            // about recurring
            'recurring' => $request->recurring,
            'recurring_status' => $request->recurring ? true : false,
            'recurring_date' => $request->recurring ? $next_generate_date : null,
            'recurring_days' => $request->recurring_days,
        ]);
        // <!-- invoice create end -->

        // <!-- items create under an invoice -->
        $invoice->items()->delete();
        foreach ($request->amount as $key => $value) {

            $invoice->items()->create([
                'amount' => $request->amount[$key] ?? null,
                'description' => $request->description[$key] ?? null,
            ]);
        }
        // <!-- items create under an invoice end -->

        // <!-- image create under an invoice -->
        if ($request->attachments) {

            $attachments = $invoice->attachments;

            foreach ($attachments as $key => $value) {
                FileDelete::deleteImage($value->attachment_url);
            }

            foreach ($request->attachments as $key => $value) {

                $url = FileUpload::uploadImage($value, 'invoice');
                $invoice->attachments()->create([
                    'attachment_url' => $url,
                ]);
            }
        }
        // <!-- image create under an invoice end -->
        $this->updateTransaction($invoice->id);

        return $invoice;
    }

    /**
     * Recurring invoice generate processing\
     *
     * @return response
     */
    public function recurringInvoice()
    {
        // first get recurring enable items
        $recurring_invoices = Invoice::with('items')->where('recurring', true)->where('recurring_status', true)->get();

        //  loop items
        foreach ($recurring_invoices as $key => $invoice) {

            $next_generate_date = $invoice->recurring_date;

            $generate_date = customDateFormat($next_generate_date, 'd-m-Y');
            $today_date = customDateFormat(Carbon::now(), 'd-m-Y');

            if ($generate_date == $today_date) {

                $this->storeRecurringItem($invoice, $generate_date);
            }

            $invoice->update([
                'recurring_date' => Carbon::now()->addDays($invoice->recurring_days),
            ]);
        }

        return true;
    }

    /**
     * create recurring new item
     */
    public function storeRecurringItem($invoice, $generate_date)
    {
        $this->createTransaction($invoice->id, $generate_date);

        return true;
    }

    /**
     * create transaction under an invoice
     */
    public function createTransaction(string $invoice_id, string $generate_date)
    {
        // check income type is exist
        $exit_type = TransactionType::where('name', 'From Invoice')->first();

        if (! $exit_type) {
            $type = TransactionType::create([
                'type' => 'income',
                'name' => 'From Invoice',
            ]);
        } else {
            $type = $exit_type;
        }

        // get invoice item
        $invoice = Invoice::withSum('items', 'amount')->FindOrFail($invoice_id);

        // for description
        $single_item = $invoice->items()->first();

        // due date generate process
        $due_date = Carbon::parse($generate_date)->addDays($invoice->due_date_in);

        $title = $invoice->title;
        $user = $invoice->user_id;
        $amount = $invoice->items_sum_amount;
        $date = $invoice->date;
        $due_date = $invoice->due_date;
        $description = $single_item ? $single_item->description : '';

        // data store after validate
        $transaction = $invoice->transactions()->create([
            'transaction_no' => 'TRN_'.time(),
            'transaction_type_id' => $type->id,
            'title' => $title,
            'user_id' => $user,
            'amount' => $amount,
            'paid_amount' => 0,
            'date' => Carbon::parse($date),
            'due_date' => $due_date ? Carbon::parse($due_date) : null,
            'status' => 'unpaid',
            'currency' => $invoice->currency,
            'description' => $description,
        ]);

        if (checkMailConfig()) {
            $user = User::where('id', $transaction->user_id)->first();
            Notification::send($user, new NewInvoiceAvailableNotification($user, $transaction));
            $parents = $user->parents;
            if ($parents) {
                foreach ($parents as $key => $parent) {
                    Notification::send($parent, new NewInvoiceAvailableNotification($parent, $transaction));
                }
            }
        }

        return $transaction;
    }

    /**
     * update transaction under an invoice
     */
    public function updateTransaction($invoice_id)
    {
        // get invoice item
        $invoice = Invoice::withSum('items', 'amount')->FindOrFail($invoice_id);
        // for description
        $single_item = $invoice->items()->first();

        $title = $invoice->title;
        $user = $invoice->user_id;
        $amount = $invoice->items_sum_amount;
        $date = $invoice->date;
        $due_date = $invoice->due_date;
        $description = $single_item ? $single_item->description : '';

        // data store after validate
        $invoice->transactions()->update([
            'title' => $title,
            'user_id' => $user,
            'amount' => $amount,
            'date' => Carbon::parse($date),
            'due_date' => $due_date ? Carbon::parse($due_date) : null,
            'currency' => $invoice->currency,
            'description' => $description,
        ]);

        return true;
    }
}
