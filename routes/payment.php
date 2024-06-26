<?php

use App\Http\Controllers\Payment\FlutterwaveController;
use App\Http\Controllers\Payment\MidtransController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\PaypalController;
use App\Http\Controllers\Payment\RazorpayController;
use App\Http\Controllers\Payment\StripeController;
use Illuminate\Support\Facades\Route;

Route::get('/payment/{transaction:transaction_no}/fee', [PaymentController::class, 'paymentFee'])->name('payment.fee');
Route::get('/payment/successful', [PaymentController::class, 'paymentSuccess'])->name('payment.successful')->middleware('auth:sanctum');

//Paypal
Route::controller(PaypalController::class)->group(function () {
    Route::post('paypal/payment', 'processTransaction')->name('paypal.pay');
    Route::get('success-transaction', 'successTransaction')->name('paypal.successTransaction');
    Route::get('cancel-transaction', 'cancelTransaction')->name('paypal.cancelTransaction');
});

// Stripe
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.pay');

// Flutterwave
Route::controller(FlutterwaveController::class)->group(function () {
    Route::post('/flutterwave/pay', 'initialize')->name('flutterwave.pay');
    Route::get('/rave/callback', 'callback')->name('flutterwave.callback');
});

// Razorpay
Route::post('payment', [RazorpayController::class, 'payment'])->name('razorpay.post');

// Midtrans
Route::post('/midtrans/success', [MidtransController::class, 'success'])->name('midtrans.success');
