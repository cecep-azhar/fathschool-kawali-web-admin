<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\PaymentTrait;
use Illuminate\Http\Request;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterwaveController extends Controller
{
    use PaymentTrait;

    /**
     * Initialize Rave payment process
     *
     * @return void
     */
    public function initialize(Request $request)
    {
        $amount = $request->amount;
        $amount = currencyConversion($amount, $request->from_currency ?? null, 'NGN', 1);
        $converted_amount = currencyConversion($amount);

        session(['order_payment' => [
            'paid_amount' => $amount,
            'currency_symbol' => '₦',
            'usd_amount' => $converted_amount,
        ]]);

        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $amount,
            'email' => auth()->user()->email,
            'tx_ref' => $reference,
            'currency' => 'NGN',
            'redirect_url' => route('flutterwave.callback'),
            'customer' => [
                'email' => auth()->user()->email,
                'phone_number' => '123456789',
                'name' => auth()->user()->name,
            ],

            'customizations' => [
                'title' => 'payment for the job services',
                'description' => date('Y-m-d H:i:s'),
            ],
        ];

        $payment = Flutterwave::initializePayment($data);

        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return redirect($payment['data']['link']);
    }

    /**
     * Obtain Rave callback information
     *
     * @return void
     */
    public function callback()
    {
        $status = request()->status;

        //if payment is successful
        if ($status == 'successful') {

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            Flutterwave::verifyTransaction($transactionID);

            session(['transaction_id' => $transactionID ?? null]);
            $this->createIncomeTransaction('flutterwave');

            return redirect()->route('payment.successful');
        } elseif ($status == 'cancelled') {
            return back()->with('error', 'Payment was cancelled');
        //Put desired action/code after transaction has been cancelled here
        } else {
            return back()->with('error', 'Payment was cancelled');
            //Put desired action/code after transaction has failed here
        }
    }
}
