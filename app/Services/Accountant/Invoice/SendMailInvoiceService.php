<?php

namespace App\Services\Accountant\Invoice;

use App\Notifications\InvoiceNotification;
use Illuminate\Support\Facades\Notification;

class SendMailInvoiceService
{
    public function send($invoice)
    {
        // send mail
        $this->sendNotification($invoice);

        return true;
    }

    protected function sendNotification($invoice)
    {
        $receiver_email = $invoice->user->email;
        Notification::route('mail', [
            $receiver_email,
        ])->notify(new InvoiceNotification($invoice->id));
    }

    protected function deleteTemporaryStoredFile($pdf_name)
    {
        $file = public_path('uploads/temp/pdf/').$pdf_name;
        if (file_exists($file)) {
            unlink($file);
        }
    }
}
