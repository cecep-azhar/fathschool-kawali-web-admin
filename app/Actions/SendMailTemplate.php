<?php

namespace App\Actions;

use App\Mail\CustomMail;
use App\Models\Config\MailTemplate;
use App\Support\MailTemplateParser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SendMailTemplate
{
    use MailTemplateParser;

    public function execute(string $email, string $code, array $variables = [], array $attachments = []): void
    {
        $mailTemplate = MailTemplate::whereCode($code)->first();

        $variables['company_name'] = config('config.billing.company_name');
        $variables['company_email'] = config('config.billing.company_email');
        $variables['company_phone'] = config('config.billing.company_phone');
        $variables['company_address'] = config('config.billing.company_address');

        foreach ($variables as $key => $variable) {
            $mailTemplate->subject = Str::replace('##'.strtoupper($key).'##', $variable, $mailTemplate->subject);
            $mailTemplate->content = Str::replace('##'.strtoupper($key).'##', $variable, $mailTemplate->content);
        }

        $mailTemplate->content = $this->parse($mailTemplate->content);

        try {
            Mail::to($email)->send(new CustomMail($mailTemplate, $attachments));
        } catch (\Exception $e) {
            throw ValidationException::withMessages(['message' => trans('general.errors.mail_send_error')]);
        }
    }
}
