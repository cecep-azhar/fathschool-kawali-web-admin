<?php

namespace App\Services\Admin\Setting\Sms;

use msztorc\LaravelEnv\Env;

class SmsUpdateService
{
    public $env;

    public function __construct()
    {
        $this->env = new Env;
    }

    public function update(object $request)
    {
        $message = match ($request->type) {
            'twilio' => $this->twilioUpdate($request),

            default => throw new \Exception('Unsupported'),
        };

        return $message;
    }

    public function twilioUpdate($request)
    {
        $this->env->setValue('TWILIO_SID', $request->twilio_sid ?? '');
        $this->env->setValue('TWILIO_TOKEN', $request->twilio_token ?? '');
        $this->env->setValue('TWILIO_FROM', urlencode($request->twilio_from) ?? '');
        $this->env->setValue('TWILIO_ACTIVE', $request->twilio_status ? 'true' : 'false');

        return 'Twilio configuration updated';
    }
}
