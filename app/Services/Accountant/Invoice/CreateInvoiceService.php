<?php

namespace App\Services\Accountant\Invoice;

use App\Http\Resources\InvoiceUserResource;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\User;

class CreateInvoiceService
{
    public function create()
    {
        $data['invoice_no'] = $this->generateUniqueCode();
        $data['users'] = InvoiceUserResource::collection(User::active()->student()->latest()->get());
        $data['currencies'] = Currency::latest()->active()->get();

        return $data;
    }

    /**
     * generate unique number for invoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (Invoice::where('invoice_no', '=', $code)->first());

        return $code;
    }
}
