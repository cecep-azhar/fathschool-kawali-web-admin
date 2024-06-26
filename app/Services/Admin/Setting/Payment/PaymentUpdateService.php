<?php

namespace App\Services\Admin\Setting\Payment;

use msztorc\LaravelEnv\Env;

class PaymentUpdateService
{
    public $env;

    public function __construct()
    {
        $this->env = new Env;
    }

    public function update(object $request)
    {
        $message = match ($request->type) {
            'paypal' => $this->paypalUpdate($request),
            'stripe' => $this->stripeUpdate($request),
            'razorpay' => $this->razorpayUpdate($request),
            'flutterwave' => $this->flutterwaveUpdate($request),
            'midtrans' => $this->midtransUpdate($request),
            default => throw new \Exception('Unsupported'),
        };

        return $message;
    }

    public function paypalUpdate($request)
    {
        $this->env->setValue('PAYPAL_LIVE_CLIENT_ID', $request->paypal_live_client_id ?? '');
        $this->env->setValue('PAYPAL_LIVE_CLIENT_SECRET', $request->paypal_live_client_secret ?? '');
        $this->env->setValue('PAYPAL_SANDBOX_CLIENT_ID', $request->paypal_sandbox_client_id ?? '');
        $this->env->setValue('PAYPAL_SANDBOX_CLIENT_SECRET', $request->paypal_sandbox_client_secret ?? '');
        $this->env->setValue('PAYPAL_MODE', $request->paypal_mode);
        $this->env->setValue('PAYPAL_ACTIVE', $request->paypal_status ? 'true' : 'false');

        return 'Paypal configuration updated';
    }

    public function stripeUpdate($request)
    {
        $this->env->setValue('STRIPE_KEY', $request->stripe_key ?? '');
        $this->env->setValue('STRIPE_SECRET', $request->stripe_secret ?? '');
        $this->env->setValue('STRIPE_ACTIVE', $request->stripe_active ? 'true' : 'false');

        return 'Stripe configuration updated';
    }

    public function razorpayUpdate($request)
    {
        $this->env->setValue('RAZORPAY_KEY', $request->razorpay_key ?? '');
        $this->env->setValue('RAZORPAY_SECRET', $request->razorpay_secret ?? '');
        $this->env->setValue('RAZORPAY_ACTIVE', $request->razorpay_active ? 'true' : 'false');

        return 'Razorpay configuration updated';
    }

    public function flutterwaveUpdate($request)
    {
        $this->env->setValue('FLW_PUBLIC_KEY', $request->flw_public_key ?? '');
        $this->env->setValue('FLW_SECRET_KEY', $request->flw_secret ?? '');
        $this->env->setValue('FLW_SECRET_HASH', $request->flw_secret_hash ?? '');
        $this->env->setValue('FLW_ACTIVE', $request->flw_active ? 'true' : 'false');

        return 'Flutterwave configuration updated';
    }

    public function midtransUpdate($request)
    {
        $this->env->setValue('MIDTRANS_MERCHANT_ID', $request->midtrans_merchant_id ?? '');
        $this->env->setValue('MIDTRANS_CLIENT_KEY', $request->midtrans_client_key ?? '');
        $this->env->setValue('MIDTRANS_SERVER_KEY', $request->midtrans_server_key ?? '');
        $this->env->setValue('MIDTRANS_LIVE_MODE', $request->midtrans_live_mode == 'sandbox' ? 'false' : 'true');
        $this->env->setValue('MIDTRANS_ACTIVE', $request->midtrans_active ? 'true' : 'false');

        return 'Midtrans configuration updated';
    }
}
