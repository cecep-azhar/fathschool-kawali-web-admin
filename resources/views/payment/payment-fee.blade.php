<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment</title>
    @vite(['resources/css/app.css'])
</head>

<body>
<div class="container-fluid bg-gray-50 h-screen">

    <div class="mx-auto max-w-2xl px-4 pt-16 pb-24 sm:px-6 lg:max-w-7xl lg:px-8">
        @if (session()->has('error'))
            <div class="flex p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-gray-800 dark:text-yellow-300" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Info</span>
                <div>
                <span class="font-medium">{{ session()->get('error') }}</span>
                </div>
            </div>
        @endif
        @php
            $paypal_mode = env('PAYPAL_MODE') == 'sandbox' ? 0 : 1;
            $paypal_active = $paypal_mode ? env('PAYPAL_LIVE_CLIENT_ID') && env('PAYPAL_LIVE_CLIENT_SECRET') : env('PAYPAL_SANDBOX_CLIENT_ID') && env('PAYPAL_SANDBOX_CLIENT_SECRET');
            $stripe_active = env('STRIPE_KEY') && env('STRIPE_SECRET');
            $razorpay_active = env('RAZORPAY_KEY') && env('RAZORPAY_SECRET');
            $flutterwave_active = env('FLW_PUBLIC_KEY') && env('FLW_SECRET_KEY') && env('FLW_SECRET_HASH') && env('FLW_ACTIVE');
            $midtrans_active = env('MIDTRANS_MERCHANT_ID') && env('MIDTRANS_CLIENT_KEY') && env('MIDTRANS_ACTIVE') && env('MIDTRANS_SERVER_KEY');
        @endphp

        <div class="flex w-full items-center justify-between space-x-6 p-6 bg-white shadow">
            <div class="flex-1 truncate">
                <div class="flex items-center justify-between space-x-3">
                    <h3 class="truncate font-medium text-gray-900 text-3xl">{{ __('Invoice') }} {{ __('Details') }}</h3>
                    <a href="/dashboard" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
                </div>
                <h4 class="text-md">
                    <b>{{ __('Title') }}:</b> {{ $transaction->title }} <br>
                    <b>{{ __('Student') }} :</b> {{ $transaction->user->name }} <br>
                    <b>{{ __('Amount') }}:</b> {{ currencyFormat($transaction->amount) }} {{ $transaction->currency }} <br>
                    <b>{{ __('Creation Date') }}:</b> {{ formatTime($transaction->date) }} <br>
                    <b>{{ __('Due Date') }}:</b> {{ formatTime($transaction->due_date) }} <br>
                    <b>{{ __('Status') }}:</b> <span>{{ ucfirst($transaction->status) }}</span>
                    <a href="{{ session('invoice_download_url') }}" target="_blank" class="group relative text-blue-400 hover:text-blue-300 block">
                        {{ __('Download') }} {{ __('Invoice') }}
                    </a>
                </h4>
            </div>
        </div>
        @if ($transaction->status != 'paid')
            <div class="mt-3 grid gap-5 grid-cols-12">

                {{-- Paypal Payment --}}
                @if ($paypal_active)
                    <div class="col-span-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Paypal</h5>
                        <button onclick="pay('paypal')" type="button" class="w-full rounded-md border border-transparent bg-blue-600 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-50">PAY NOW</button>
                    </div>
                @endif

                {{-- Stripe Payment --}}
                @if ($stripe_active)
                    <div class="col-span-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Stripe</h5>
                        <button onclick="pay('stripe')" type="button" class="w-full rounded-md border border-transparent bg-blue-600 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-50">PAY NOW</button>
                    </div>
                @endif

                {{-- Razorpay Payment --}}
                @if ($razorpay_active)
                    <div class="col-span-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Razorpay</h5>
                        <button onclick="pay('razorpay')" type="button" class="w-full rounded-md border border-transparent bg-blue-600 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-50">PAY NOW</button>
                    </div>
                @endif

                {{-- Flutterwave Payment --}}
                @if ($flutterwave_active)
                    <div class="col-span-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Flutterwave</h5>
                        <button onclick="pay('flutterwave')" type="button" class="w-full rounded-md border border-transparent bg-blue-600 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-50">PAY NOW</button>
                    </div>
                @endif

                {{-- Midtrans Payment --}}
                @if ($midtrans_active)
                    <div class="col-span-4 w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Midtrans</h5>
                        <button id="midtrans_btn" type="button" class="w-full rounded-md border border-transparent bg-blue-600 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-50">PAY NOW</button>
                    </div>
                @endif

            </div>
        @endif
    </div>

    @if ($transaction->status != 'paid')
            @php
                $amount = $transaction_info['pay_amount'];
                $transaction_id = $transaction_info['transaction_id'];
                $auth_user = authUser();
            @endphp

            {{-- Paypal Form --}}
            <form action="{{ route('paypal.pay') }}" method="POST" class="hidden" id="paypal-form">
                @csrf
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="transaction_id" value="{{ $transaction_id }}">
            </form>

            {{-- Stripe Form --}}
            <form action="{{ route('stripe.pay') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="transaction_id" value="{{ $transaction_id }}">

                <script id="stripe_script" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="{{ env('STRIPE_KEY') }}" data-amount="{{ session('stripe_amount') }}"
                        data-name="{{ env('APP_NAME') }}" data-description="Money pay with stripe" data-locale="auto"
                        data-currency="USD">
                </script>
            </form>

            {{-- Razorpay Form --}}
            <form action="{{ route('razorpay.post') }}" method="POST" class="hidden">
                @csrf

                <script id="razor_script" src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="{{ config('templatecookie.razorpay_key') }}" data-amount="{{ session('razor_amount') }}"
                    data-buttontext="Pay with Razorpay" data-name="{{ config('app.name') }}" data-description="Money pay with razorpay"
                    data-prefill.name="{{ $auth_user->name }}" data-prefill.email="{{ $auth_user->email }}"
                    data-theme.color="#2980b9" data-currency="INR"></script>
            </form>

            {{-- flutterwave Form --}}
            <form action="{{ route('flutterwave.pay') }}" method="POST" class="hidden" id="flutter-form">
                @csrf
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="transaction_id" value="{{ $transaction_id }}">
                <input type="hidden" name="from_currency" value="{{ $transaction->currency }}">
            </form>

            <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
            <script>
                function pay(method) {
                    switch (method) {
                        case 'paypal':
                            document.getElementById("paypal-form").submit();
                        break;
                        case 'stripe':
                            document.querySelector('.stripe-button-el').click();
                        break;
                        case 'razorpay':
                            document.querySelector('.razorpay-payment-button').click();
                        break;
                        case 'midtrans':
                            document.getElementById("flutter-form").submit();
                        break;
                        case 'flutterwave':
                            document.getElementById("flutter-form").submit();
                        break;
                    }
                }

                // Midtrans
            if ('{{ $midtrans_active  }}') {
                const payButton = document.querySelector('#midtrans_btn');
                payButton.addEventListener('click', function(e) {
                    e.preventDefault();

                    snap.pay('{{ $mid_token }}', {
                        onSuccess: function(result) {
                            successMidtransPayment();
                        },
                        onPending: function(result) {
                            alert('Transaction is in pending state');
                        },
                        onError: function(result) {
                            alert('Transaction is failed. Try again.');
                        }
                    });
                });

                function successMidtransPayment() {
                    $.ajax({
                        type: "post",
                        url: "{{ route('midtrans.success') }}",
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response)
                            window.location.href = response.redirect_url;
                        }
                    });
                }
            }
            </script>

            @if (config('templatecookie.midtrans_active') && config('templatecookie.midtrans_merchant_id') && config('templatecookie.midtrans_client_key') && config('templatecookie.midtrans_server_key'))

                @if (config('templatecookie.midtrans_live_mode'))
                    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('templatecookie.midtrans_client_key') }}">
                    </script>
                @else
                    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('templatecookie.midtrans_client_key') }}">
                    </script>
                @endif
            @endif
        @endif
    </body>
</div>
</html>
