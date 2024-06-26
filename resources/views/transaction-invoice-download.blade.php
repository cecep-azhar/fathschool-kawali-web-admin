<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @if ($invoice_view)
            {{ $title }}
        @else
            {{ $transaction->title }}
        @endif
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @page {
            size: 1200px 1800px;
        }

        h1,
        h2,
        h3,
        h4,
        p {
            margin: 0px;
        }

        .invoice {
            width: 100%;
            max-width: 1200px;
            margin: 48px auto;
            background: white;
            padding: 40px;
        }

        .invoice .logo {
            display: inline-block;
            width: auto;
            height: 88px;
            object-fit: cover;
        }

        .invoice .title {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 48px;
            line-height: 56px;
            text-align: center;
            letter-spacing: -0.02em;
            color: #000000;
            text-align: center;
            margin-bottom: 12px;
            margin-top: 0px;
        }

        .invoice .sub-title {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 32px;
            line-height: 40px;
            text-align: center;
            letter-spacing: -0.02em;
            color: #000000;
            margin-top: 0px;
            margin-bottom: 24px;
        }

        .invoice .info-td-img,
        .invoice .info-td-img img {
            min-width: 148px;
            max-width: 148px;
            min-height: 148px;
            max-height: 148px;
        }

        .std-title {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 28px;
            display: flex;
            align-items: center;
            letter-spacing: 0.01em;
            text-transform: uppercase;
            color: #074EE8;
            margin-bottom: 6px;
        }

        .std-info-list {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            display: flex;
            align-items: center;
            letter-spacing: 0.01em;
            color: #111111;
        }

        .fee-table th {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 24px;
            letter-spacing: 0.01em;
            color: #074EE8;
        }

        .fee-table td {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            letter-spacing: 0.01em;
            color: #101011;
        }

        .footer-info {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            display: flex;
            align-items: center;
            letter-spacing: 0.01em;
            color: rgba(17, 17, 17, 0.8);
        }

        .signature-title {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 24px;
            letter-spacing: 0.01em;
            color: #111111;
            margin-bottom: 8px;
        }

        .signature-text {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            letter-spacing: 0.01em;
            color: rgba(17, 17, 17, 0.8);
        }
    </style>
</head>

<body>
    <table class="invoice" size="A4">
        <tr>
            <td style="text-align: center;">
                <img class="logo" src="{{ $logo }}" alt="{{ $setting->app_name }}">
            </td>
        </tr>
        <tr>
            <td>
                <h2 class="title">
                    {{ $setting->app_name }}
                </h2>
            </td>
        </tr>
        <tr>
            <td>
                <h2 class="sub-title">
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
                </h2>
            </td>
        </tr>
        <tr style="border: 1px solid #CCCCCC; padding: 24px;">
            <td style="border: 1px solid #CCCCCC; padding: 24px;">
                <table>
                    <tr style="vertical-align: top;">
                        <td class="info-td-img" style="vertical-align: top;">
                            <img style="object-fit: cover;" src="{{ $user_avatar }}"
                                alt="{{ $user ? $user->name : '' }}">
                        </td>
                        <td style="width: 43%; padding: 0px 24px; vertical-align: top;">
                            <h3 class="std-title" style="margin-top: 0px;">
                                Student Detail
                            </h3>
                            <div class="std-info-list" style="margin-bottom: 1px;">
                                Name: <span style="font-weight: 600;">
                                    {{ Str::ucfirst($user?->name) }}
                                </span>
                            </div>
                            <div class="std-info-list" style="margin-bottom: 1px;">
                                Gender: <span style="font-weight: 600;">
                                    {{ Str::ucfirst($user?->gender) }}
                                </span>
                            </div>
                            <div class="std-info-list" style="margin-bottom: 1px;">
                                Email: <span style="font-weight: 600;">
                                    {{ Str::ucfirst($user?->email) }}
                                </span>
                            </div>
                            <div class="std-info-list">
                                Phone: <span style="font-weight: 600;">
                                    {{ Str::ucfirst($user?->phone) }}
                                </span>
                            </div>
                        </td>
                        <td style="width: 43%; padding-right: 24px; vertical-align: top;">
                            @if (!$invoice_view)
                                <div class="std-info-list" style="margin-bottom: 1px;">
                                    Transaction No:
                                </div>
                                <div>
                                    <span style="font-weight: 600;">
                                        {{ $transaction?->transaction_no }}
                                    </span>
                                </div>
                                <div class="std-info-list">
                                    Payment Status: <span style="font-weight: 600; color: #14AE5C;">
                                        {{ Str::ucfirst($transaction->status) }}
                                    </span>
                                </div>
                            @else
                                <div class="std-info-list" style="margin-bottom: `px;">
                                    Invoice No:
                                </div>
                                <div>
                                    <span style="font-weight: 600;">
                                        {{ $invoice_no }}
                                    </span>
                                </div>
                            @endif
                        </td>
                        <td class="info-td-img" style="vertical-align: top;">
                            @php
                                $link = $invoice_view ? route('invoice.show', $invoice_id) : route('transaction.details', $transaction->id);
                            @endphp
                            <img object-fit: cover;
                                src="https://chart.googleapis.com/chart?cht=qr&chl={{ $link }}&chs=160x160&chld=L|0"
                                class="qr-code img-thumbnail img-responsive" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 32px;">
                <table class="fee-table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #EEEEEE;">
                            <th style="padding: 8px 24px; text-align: left; width: 5%;">
                                #
                            </th>
                            <th style="padding: 8px 24px; text-align: left;">
                                Description
                            </th>
                            <th style="padding: 8px 24px; text-align: right; width: 15%;">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($invoice_view)
                            @if ($transactions->count() > 0)
                                @foreach ($transactions as $transaction)
                                    <tr style="border-bottom: 1px solid black ">
                                        <td style="padding: 8px 24px; text-align: left; width: 5%;">
                                            {{ $transaction->id }}
                                        </td>
                                        <td style="padding: 8px 24px; text-align: left;">
                                            {{ $transaction->description }}
                                        </td>
                                        <td
                                            style="padding: 8px 24px; text-align: right; width: 15%; font-weight: 600; white-space: nowrap">
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
                            <tr style="border-bottom: 1px solid black ">
                                <td style="padding: 8px 24px; text-align: left; width: 5%;">
                                    {{ $transaction->id }}
                                </td>
                                <td style="padding: 8px 24px; text-align: left;">
                                    {{ $transaction->description }}
                                </td>
                                <td
                                    style="padding: 8px 24px; text-align: right; width: 15%; font-weight: 600; white-space: nowrap">
                                    {{ currencyFormat($transaction->amount) }} {{ $transaction->currency }}
                                </td>
                            </tr>
                        @endif
                        @if ($invoice_view)
                            <tr>
                                <td style="padding: 8px 24px; text-align: left;">

                                </td>
                                <td
                                    style="padding: 8px 24px; text-align: left; font-weight: 700; font-size: 20px; line-height: 32px;">
                                    Total
                                </td>
                                <td
                                    style="padding: 8px 24px; text-align: right; width: 15%; font-weight: 700; font-size: 20px; line-height: 32px; white-space: nowrap">
                                    {{ currencyFormat($total) }} {{ $currency }}
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td style="padding: 8px 24px; text-align: left;">

                                </td>
                                <td
                                    style="padding: 8px 24px; text-align: left; font-weight: 700; font-size: 20px; line-height: 32px;">
                                    Total</td>
                                <td
                                    style="padding: 8px 24px; text-align: right; width: 15%; font-weight: 700; font-size: 20px; line-height: 32px; white-space: nowrap">
                                    {{ $transaction->amount }} {{ $transaction->currency }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 24px;">
                <p class="footer-info">
                    Issue date: <span style="font-weight: 600;">
                        {{ $transaction?->date_time }}
                    </span>
                </p>
                <p class="footer-info" style="margin-bottom: 8px;">
                    Due date:<span style="font-weight: 600;">
                        {{ $transaction->due_date_format }}
                    </span>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="footer-info" style="margin-bottom: 24px;">
                    Please print a copy of this receipt as evidence of payment.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="footer-info" style="margin-bottom: 32px;">
                    For enquiries, Please call <span style="font-weight: 600;">{{ $setting->app_phone }}</span> OR
                    email <span style="font-weight: 600;">{{ $setting->app_email }}</span>
                </p>
            </td>
        </tr>
    </table>
</body>

</html>
