<?php

namespace App\Services\Accountant\Invoice;

use App\Actions\File\FileDelete;
use App\Models\Invoice;

class DeleteInvoiceService
{
    public function delete(Invoice $invoice)
    {
        if ($invoice->transactions->count()) {
            $invoice->transactions()->delete();
        }

        if ($invoice->items->count()) {
            $invoice->items()->delete();
        }

        $attachments = $invoice->attachments;

        foreach ($attachments as $key => $value) {
            FileDelete::deleteImage($value->attachment_url);
        }

        $invoice->delete();
    }
}
