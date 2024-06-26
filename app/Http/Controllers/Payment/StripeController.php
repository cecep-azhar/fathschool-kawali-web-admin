<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Traits\PaymentTrait;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class StripeController extends Controller
{
    use PaymentTrait;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $transaction = Transaction::find($request->transaction_id);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            Charge::create([
                'amount' => round($request->amount, 0) * 100,
                'currency' => $transaction->currency,
                'source' => $request->stripeToken,
                'description' => 'Any description',
            ]);

            $this->createIncomeTransaction(payment_type: 'stripe');

            return redirect()->route('payment.successful');
        } catch (\Exception $ex) {
            session()->flash('error', $ex->getMessage());

            return back();
        }
    }
}
