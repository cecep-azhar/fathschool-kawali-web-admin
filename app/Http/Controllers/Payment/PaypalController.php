<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Traits\PaymentTrait;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    use PaymentTrait;

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        $transaction = Transaction::find($request->transaction_id);
        try {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->setCurrency('USD');
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                'intent' => 'CAPTURE',
                'application_context' => [
                    'return_url' => route('paypal.successTransaction'),
                    'cancel_url' => route('paypal.cancelTransaction'),
                ],
                'purchase_units' => [
                    0 => [
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => currencyConversion($request->amount),
                        ],
                    ],
                ],
            ]);
           
            if (isset($response['id']) && $response['id'] != null) {

                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }

                $this->flashError('Something went wrong.');

                return back()->with('error', 'Something went wrong.');
            } else {
                $this->flashError('Something went wrong.');
               
                return back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $ex) {
            session()->flash('error', $ex->getMessage());

            return back();
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $this->createIncomeTransaction(payment_type: 'Paypal');

            return redirect()->route('payment.successful');
        } else {
            $this->flashError('Transaction is Invalid');

            return back();
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        $this->flashError('Payment Failed');

        return back();
    }
}
