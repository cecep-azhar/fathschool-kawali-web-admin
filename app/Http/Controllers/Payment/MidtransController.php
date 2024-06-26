<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\PaymentTrait;

// => put it at the top of the class

class MidtransController extends Controller
{
    use PaymentTrait;

    public function success()
    {
        // $payment_details = session('midtrans_details');

        // session data store
        // session(['plan_id' => $payment_details['plan_id']]);
        // session(['payment_provider' => 'midtrans']);

        // plan data store
        $this->createIncomeTransaction('midtrans');

        return redirect()->route('payment.successful');

        // $this->orderPlacing(false);

        // forget midtrans session
        session()->forget('payment_details');
        session()->flash('success', 'Payment Successfully');

        // redirect url pass
        return response()->json([
            'redirect_url' => route('company.plan'),
        ]);
    }
}
