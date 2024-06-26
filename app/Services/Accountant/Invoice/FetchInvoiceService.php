<?php

namespace App\Services\Accountant\Invoice;

use App\Models\Invoice;

class FetchInvoiceService
{
    public function fetch(object $request): object
    {
        $query = Invoice::query()->recurring()
            ->with('user', 'transactions:invoice_id,status')
            ->orderBy('recurring_status', 'desc')->latest();

        // Filter --> Keyword
        if ($request->has('keyword') && $request->keyword != null) {

            $query->where(function ($q) use ($request) {
                $q->where('invoice_no', 'Like', '%'.$request->keyword.'%')
                    ->orWhere('title', 'Like', '%'.$request->keyword.'%')
                    ->orWhereHas('user', function ($q) use ($request) {
                        $q->where('email', 'Like', '%'.$request->keyword.'%');
                    });
            });
        }

        // Filter --> Due date
        if ($request->has('start_date') && $request->has('end_date') && $request->start_date != null && $request->end_date != null) {

            $query->where('date', '>=', $request->start_date)->where('date', '<=', $request->end_date);
        }

        // Filter --> Recurring
        if ($request->has('recurring') && $request->recurring != 'all' && $request->recurring != null) {

            if ($request->recurring == 'recurring_status_true') {
                $query->where('recurring_status', true);
            } else {
                $query->where('recurring_status', false);
            }
        }

        $invoices = $query->withSum('items', 'amount')->paginate(15)->onEachSide(-1);
        $invoices->append(['due_date_format', 'invoice_date']);

        return $invoices;
    }
}
