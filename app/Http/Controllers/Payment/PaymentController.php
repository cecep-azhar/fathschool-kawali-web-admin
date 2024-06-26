<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Transaction;
use App\Services\Midtrans\CreateSnapTokenService;

class PaymentController extends Controller
{
    public function paymentFee(Transaction $transaction)
    {
        $amount = $transaction->amount;
        $currency = $transaction->currency ?? config('templatecookie.currency');

        session(['transaction_info' => [
            'pay_amount' => $amount,
            'transaction_id' => $transaction->id,
        ]]);

        // Convert to Default Currency
        session(['stripe_amount' => currencyConversion($amount, $transaction->currency, 'USD') * 100]);
        session(['razor_amount' => currencyConversion($amount, $transaction->currency, 'INR', 1) * 100]);

        // midtrans snap token
        if (config('templatecookie.midtrans_active') && config('templatecookie.midtrans_merchant_id') && config('templatecookie.midtrans_client_key') && config('templatecookie.midtrans_server_key')) {
            // $usd = $plan->price;
            $fromRate = Currency::whereCode($currency)->first()->rate;
            $toRate = Currency::whereCode('IDR')->first()->rate;
            $rate = $fromRate / $toRate;
            $amount = (int) round($amount / $rate, 2);

            $order['order_no'] = uniqid();
            $order['total_price'] = $amount;

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();

            // session(['midtrans_details' => [
            //     'order_no' => $order['order_no'],
            //     'total_price' => $order['total_price'],
            //     'snap_token' => $snapToken,
            //     'plan_id' => $plan->id,
            // ]]);
        }

        $transaction_info = session('transaction_info');
        $transaction->load('user');

        session(['invoice_download_url' => route('transaction.details', $transaction->transaction_no)]);

        return view('payment.payment-fee', [
            'transaction' => $transaction,
            'transaction_info' => $transaction_info,
            'mid_token' => $snapToken ?? null,
        ]);
    }

    public function paymentSuccess()
    {
        return view('payment.payment-success');
    }
}
