<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        @if ($invoice_view)
            {{ $title }}
        @else
            {{ $transaction->title }}
        @endif
    </title>
    @vite('resources/js/app.js')
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .invoice-box {
            max-width: 1200px;
            margin: 0px auto;
            overflow: hidden;
            background: white;
        }

        @media print {
            @page {
                size: A3;
            }

            #action,
            #download_btn {
                display: none !important;
            }
        }
    </style>
</head>

<body class='bg-gray-200 py-16'>
    @php
        $paypal_mode = env('PAYPAL_MODE') == 'sandbox' ? 0 : 1;
        $paypal_active = $paypal_mode ? env('PAYPAL_LIVE_CLIENT_ID') && env('PAYPAL_LIVE_CLIENT_SECRET') : env('PAYPAL_SANDBOX_CLIENT_ID') && env('PAYPAL_SANDBOX_CLIENT_SECRET');
        $stripe_active = env('STRIPE_KEY') && env('STRIPE_SECRET');
        $razorpay_active = env('RAZORPAY_KEY') && env('RAZORPAY_SECRET');
        $flutterwave_active = env('FLW_PUBLIC_KEY') && env('FLW_SECRET_KEY') && env('FLW_SECRET_HASH') && env('FLW_ACTIVE');
        $midtrans_active = env('MIDTRANS_MERCHANT_ID') && env('MIDTRANS_CLIENT_KEY') && env('MIDTRANS_ACTIVE') && env('MIDTRANS_SERVER_KEY');
    @endphp

    <div class="relative">
        <div class="invoice-box relative py-10 px-16">
            <div class="ml-auto text-end">
                @if ($invoice_view)
                    <a href="{{ route('invoice.download', [$invoice_id, 'download' => true]) }}" target="_blank"
                        class="!inline-flex !items-end !justify-end gap-2 bg-blue-500 text-white py-2 px-4 rounded-md">
                        <svg width="20" heigth="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32">
                            </path>
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" d="M176 272l80 80 80-80M256 48v288"></path>
                        </svg>
                        <span>Download</span>
                    </a>
                @else
                    <a href="{{ route('transaction.details', [$transaction->transaction_no, 'download' => true]) }}"
                        target="_blank"
                        class="!inline-flex !items-end !justify-end gap-2 bg-blue-500 text-white py-2 px-4 rounded-md">
                        <svg width="20" heigth="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32">
                            </path>
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" d="M176 272l80 80 80-80M256 48v288"></path>
                        </svg>
                        <span>Download</span>
                    </a>
                @endif
            </div>
            <div>
                <img class="w-auto mx-auto h-[88px] object-cover mb-3" src="{{ $setting->dark_logo_url }}"
                    alt="{{ $setting->app_name }}">
                <h2 class="text-5xl leading-[56px] tracking-[-0.02em] text-center font-semibold mb-4 text-black">
                    {{ $setting->app_name }}
                </h2>
                <h3 class="text-black text-[32px] leading-10 tracking-[-0.02em] font-semibold text-center mb-8">
                    @if ($invoice_view)
                        {{ $title }}
                    @else
                        {{ $transaction->title }}
                    @endif -
                    @if ($invoice_view)
                        {{ $date }}
                    @else
                        {{ $transaction->date_time }}
                    @endif
                </h3>
            </div>
            <div class="border-2 border-[#CCCCCC] p-6 mb-8">
                <div class="flex gap-6 justify-between items-start">
                    <div class="img min-w-[148px] max-w-[148px] min-h-[148px] max-h-[148px]">
                        <img class="img min-w-[148px] max-w-[148px] min-h-[148px] max-h-[148px]"
                            src="{{ $user ? $user->profile_photo_url : '' }}" alt="{{ $user ? $user->name : '' }}"
                            class="w-full h-full object-cover">
                    </div>
                    @if ($user)
                        <div class="w-full">
                            <h4 class="text-lg text-[#074EE8] mb-1.5">
                                Student Detail
                            </h4>
                            <h4 class="text-base mb-1.5 text-[#111111] font-semibold">
                                <span class="text-opacity-70 font-normal">Name: </span> {{ Str::ucfirst($user->name) }}
                            </h4>
                            <h4 class="text-base mb-1.5 text-[#111111] font-semibold">
                                <span class="text-opacity-70 font-normal">Gender: </span>
                                {{ Str::ucfirst($user->gender) }}
                            </h4>
                            <h4 class="text-base mb-1.5 text-[#111111] font-semibold">
                                <span class="text-opacity-70 font-normal">Email: </span>
                                {{ Str::ucfirst($user->email) }}
                            </h4>
                            <h4 class="text-base mb-0 text-[#111111] font-semibold">
                                <span class="text-opacity-70 font-normal">Phone: </span>
                                {{ Str::ucfirst($user->phone) }}
                            </h4>
                        </div>
                    @endif
                    <div class="w-full">
                        @if (!$invoice_view)
                            <h4 class="text-base text-[#111111] font-semibold mb-1.5">
                                <span class='text-opacity-70 font-normal'>Transaction No: </span>
                                {{ $transaction->transaction_no }}
                            </h4>
                            <h4 class="text-base text-[#111111] font-semibold mb-0">
                                <span class="text-opacity-70 font-normal">Payment Status: </span>
                                <span
                                    class="{{ $transaction->status == 'paid' ? 'text-[#14AE5C]' : 'text-[#fa1e1e]' }}">
                                    {{ Str::ucfirst($transaction->status) }}
                                </span>
                            </h4>
                        @else
                            <h4 class="text-base font-semibold mb-0">
                                Invoice No:
                                <span>
                                    {{ $invoice_no }}
                                </span>
                            </h4>
                        @endif
                    </div>
                    <div class="min-w-[148px] max-w-[148px] min-h-[148px] max-h-[148px]">
                        @php
                            $link = $invoice_view ? route('invoice.show', $invoice_id) : route('transaction.details', $transaction->id);
                        @endphp
                        <img src="https://chart.googleapis.com/chart?cht=qr&chl={{ $link }}&chs=160x160&chld=L|0"
                            class="qr-code img-thumbnail img-responsive" />
                    </div>
                </div>
            </div>
            <table class="mb-8 w-full">
                <thead class="w-full">
                    <tr class="bg-[#EEEEEE] rounded-sm">
                        <th class="py-2 px-6 text-left text-base font-semibold text-[#074EE8]">#</th>
                        <th class="py-2 px-6 text-left text-base font-semibold text-[#074EE8]">Description
                        </th>
                        <th class="py-2 px-6 text-right text-base font-semibold text-[#074EE8]">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($invoice_view)
                        @if ($transactions->count() > 0)
                            @foreach ($transactions as $transaction)
                                <tr class="border-b">
                                    <td
                                        class="py-2 px-6 text-left text-base font-medium text-[#101011] whitespace-nowrap">
                                        {{ $transaction->id }}
                                    </td>
                                    <td class="py-2 px-6 text-left text-base font-medium text-[#101011]">
                                        {{ $transaction->description }}
                                    </td>
                                    <td
                                        class="py-2 px-6 text-right text-base font-semibold text-[#101011] whitespace-nowrap">
                                        {{ currencyFormat($transaction->amount) }} {{ $transaction->currency }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>No Transaction Found </td>
                            </tr>
                        @endif
                    @else
                        <tr class="border-b">
                            <td class="py-2 px-6 text-left text-base font-medium text-[#101011] whitespace-nowrap">
                                {{ $transaction->id }}
                            </td>
                            <td class="py-2 px-6 text-left text-base font-medium  text-[#101011]">
                                {{ $transaction->description }}
                            </td>
                            <td class="py-2 px-6 text-right text-base font-semibold text-[#101011] whitespace-nowrap">
                                {{ currencyFormat($transaction->amount) }} {{ $transaction->currency }}
                            </td>
                        </tr>
                    @endif
                    @if ($invoice_view)
                        <tr>
                            <td class="py-2 px-6 text-left text-base text-[#101011] font-bold"></td>
                            <td class="py-2 px-6 text-left text-base text-[#101011] font-bold">Total
                            </td>
                            <td class="py-2 px-6 text-right text-base text-[#101011] font-bold whitespace-nowrap">
                                {{ currencyFormat($total) }} {{ $currency }}
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td class="py-2 px-6 text-left text-base text-[#101011] font-bold"></td>
                            <td class="py-2 px-6 text-left text-base text-[#101011] font-bold">Total</td>
                            <td class="py-2 px-6 text-right text-base text-[#101011] font-bold whitespace-nowrap">
                                {{ $transaction->amount }} {{ $transaction->currency }}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="flex flex-col gap-2 mb-6">
                <h4 class="text-base text-[#111111] font-semibold mb-0"><span class="text-opacity-80 font-normal">Issue
                        date: </span>{{ $transaction?->date_time }}</h4>
                <h4 class="text-base text-[#111111] font-semibold mb-0"><span class="text-opacity-80 font-normal">Due
                        date: </span> {{ $transaction->due_date_format }}</h4>
            </div>
            <div class="flex flex-col gap-6 mb-8">
                <p class="text-base text-[#000000] mb-0">Please print a copy of this receipt as evidence of
                    payment.</p>
                <p class="text-base text-[#111111] mb-0">For enquiries, Please call
                    <strong class="">
                        {{ $setting->app_phone }}
                    </strong> OR email
                    <strong class="">
                        {{ $setting->app_email }}
                    </strong>
                </p>
            </div>
        </div>

        <div class="flex gap-6 justify-between absolute left-1/2 -translate-x-1/2 py-10"
            :class="$transaction - > status == 'unpaid' ? 'bottom-20' : ''">
            @if ($transaction->status == 'unpaid')
                @if ($paypal_active || $stripe_active || $razorpay_active || $flutterwave_active || $midtrans_active)
                    <div>
                        @if ($paypal_active)
                            <button onclick="pay('paypal')" type="button"
                                class="inline-flex gap-2 items-center bg-blue-500 text-white py-2 px-4 rounded-md">
                                <span>Pay Via Paypal</span>
                            </button>
                        @endif
                        @if ($stripe_active)
                            <button onclick="pay('stripe')" type="button"
                                class="inline-flex gap-2 items-center bg-blue-500 text-white py-2 px-4 rounded-md">
                                <span>Pay Via Stripe</span>
                            </button>
                        @endif
                        @if ($razorpay_active)
                            <button onclick="pay('razorpay')" type="button"
                                class="inline-flex gap-2 items-center bg-blue-500 text-white py-2 px-4 rounded-md">
                                <span>Pay Via Razorpay</span>
                            </button>
                        @endif
                        @if ($flutterwave_active)
                            <button onclick="pay('flutterwave')" type="button"
                                class="inline-flex gap-2 items-center bg-blue-500 text-white py-2 px-4 rounded-md">
                                <span>Pay Via Flutterwave</span>
                            </button>
                        @endif
                        @if ($midtrans_active)
                            <button id="midtrans_btn" type="button"
                                class="inline-flex gap-2 items-center bg-blue-500 text-white py-2 px-4 rounded-md">
                                <span>Pay Via Midtrans</span>
                            </button>
                        @endif
                    </div>
                @endif
            @endif
        </div>
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
                data-key="{{ env('STRIPE_KEY') }}" data-amount="{{ session('stripe_amount') }}" data-name="{{ env('APP_NAME') }}"
                data-description="Money pay with stripe" data-locale="auto" data-currency="USD"></script>
        </form>

        {{-- Razorpay Form --}}
        <form action="{{ route('razorpay.post') }}" method="POST" class="hidden">
            @csrf

            <script id="razor_script" src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ config('templatecookie.razorpay_key') }}" data-amount="{{ session('razor_amount') }}"
                data-buttontext="Pay with Razorpay" data-name="{{ config('app.name') }}" data-description="Money pay with razorpay"
                data-prefill.name="{{ $auth_user->name }}" data-prefill.email="{{ $auth_user->email }}" data-theme.color="#2980b9"
                data-currency="INR"></script>
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
            if ('{{ $midtrans_active }}') {
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

        @if (config('templatecookie.midtrans_active') &&
                config('templatecookie.midtrans_merchant_id') &&
                config('templatecookie.midtrans_client_key') &&
                config('templatecookie.midtrans_server_key'))

            @if (config('templatecookie.midtrans_live_mode'))
                <script src="https://app.midtrans.com/snap/snap.js"
                    data-client-key="{{ config('templatecookie.midtrans_client_key') }}"></script>
            @else
                <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                    data-client-key="{{ config('templatecookie.midtrans_client_key') }}"></script>
            @endif
        @endif
    @endif
</body>

</html>
