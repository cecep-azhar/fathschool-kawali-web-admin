<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta charset="UTF-8"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data['transaction']->title ?? ''}}</title>
    <link rel=“preconnect” href=“https://fonts.googleapis.com“>
    <link rel=“preconnect” href=“https://fonts.gstatic.com” crossorigin>
    <link href=“https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap” rel=“stylesheet”>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0px;
        }

        .main-table {
            width: 100%;
            height: 1035px;
            margin: auto;
            border-collapse: collapse;
            font-family: 'Inter', sans-serif;
            position: relative;
        }

        .main-td {
            padding: 20px 40px;
            vertical-align: top;
        }

        .main-table table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        .logo {
            width: 54px;
            height: 44px;
            object-fit: contain;
            margin: 0px auto 6px;
        }

        .main-title {
            color: #000;
            text-align: center;
            font-size: 32px;
            font-style: normal;
            font-family: 'Inter', sans-serif !important;
            font-weight: 600;
            line-height: 120%;
            letter-spacing: -0.96px;
            margin: 0px;
            margin-bottom: 6px;
        }

        .main-subtitle {
            color: #000;
            text-align: center;
            font-size: 24px;
            font-style: normal;
            font-family: 'Inter', sans-serif !important;
            font-weight: 600;
            line-height: 120%;
            letter-spacing: -0.64px;
            margin: 0px;
            margin-bottom: 20px;
        }

        .in-table {
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            letter-spacing: 0.16px;
            margin-bottom: 8px;
        }

        .in-table tr td {
            margin-right: 1px;
        }

        .box-table {
            margin-bottom: 24px;
        }

        .box-table td {
            vertical-align: top;
        }

        .box-table .title {
            color: #111;
            font-family: Inter;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: 150%;
            letter-spacing: 0.16px;
            text-transform: uppercase;
            padding: 4px 12px;
            background: #EEE;
            opacity: 0.67;
        }

        .in-box-table {
            border: 1px solid #CCC;
            padding: 12px;
        }

        .in-box-table {
            text-align: center;
        }

        .in-box-table table td {
            text-align: left;
        }

        .in-box-table img {
            width: 74px;
            height: 74px;
            object-fit: contain;
        }

        .in-box-table table h3 {
            color: #074EE8;
            font-size: 14px;
            font-family: Inter;
            font-style: normal;
            font-weight: 600;
            line-height: 125%;
            letter-spacing: 0.18px;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .in-box-table table div {
            color: #000;
            font-size: 12px;
            font-family: Inter;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            letter-spacing: 0.16px;
            margin-bottom: 3px;
            opacity: 0.8;
        }

        .in-box-table table a,
        .in-box-table table span {
            text-decoration: none;
            color: #000;
            font-weight: 600;
        }

        .report-table td {
            padding: 4px 12px;
            text-align: left;
        }

        .report-table thead {
            background: #EEE;
            border-radius: 2px;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 600;
            line-height: 125%;
            letter-spacing: 0.16px;
            text-transform: uppercase;
            color: #074EE8;
        }

        .report-table tbody td {
            border-bottom: 1px solid #AAAAAA;
            font-size: 12px;
        }

        .report-table h4 {
            color: #101011;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 500;
            line-height: 120%;
            letter-spacing: 0.16px;
            margin-bottom: 4px;
        }

        .report-table div {
            color: #101011;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            letter-spacing: 0.16px;
        }

        .report-table div div {
            color: #666;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 500;
            line-height: 120%;
            letter-spacing: 0.14px;
        }

        .single-td {
            color: #111;
            font-family: Inter;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 150%;
            letter-spacing: 0.16px;
            text-align: left;
            opacity: 0.8;
            width: 50%;
        }

        .sign-table {
            position: absolute;
            left: 0;
            bottom: 25px;
        }

        .sign-table td {
            vertical-align: bottom;
        }

        .sign-table .left-side {
            padding-left: 40px;
        }

        .sign-table .left-side img {
            width: 62px;
            height: auto;
            object-fit: contain;
        }

        .sign-table .right-side {
            padding-right: 40px;
        }

        .sign-table .left-side h3 {
            color: #111;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 600;
            line-height: 125%;
            letter-spacing: 0.18px;
            margin-top: 4px;
        }

        .sign-table .left-side div {
            color: rgba(17, 17, 17, 0.80);
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            letter-spacing: 0.16px;
        }

        .sign-table .right-side {
            color: rgba(17, 17, 17, 0.80);
            text-align: right;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            letter-spacing: 0.16px;
        }

        .sign-table .right-side a {
            font-weight: 600;
            color: rgba(17, 17, 17, 0.80);
            text-decoration: none;
        }

        .shadow-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            width: 90%;
            height: auto;
            object-fit: contain;
            opacity: .1;
        }

        @page {
            size: A4;
            margin: 0px;
        }
    </style>
</head>

<body>
    <table class="main-table">
        <tr>
            <td class='main-td'>
                <table>
                    <tr>
                        <td>
                            <img class="logo" src="{{ public_path() . '/' . $setting->dark_logo ?? '' }}" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="main-title">{{ $settings->app_name ?? '' }}</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3 class="main-subtitle">{{$data['transaction']->title ?? 'Your transaction'}}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 20px;">
                            <table>
                                <tr>
                                    <td class="single-td">
                                        <div>Transactions No: <b>{{ $data['transaction']->transaction_no ?? '' }}</b></div>
                                    </td>
                                    <td class="single-td" style="text-align: right">
                                        <div>Issue date: <b>{{ date(str_replace(['__', '_'], ['/', '-'], config('app.date_format')), strtotime($data['transaction']->date)) ?? '' }}</b></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="single-td">
                                        @if ($data['transaction']->method)
                                        <div>Payment Method: <b>{{ $data['transaction']->method }}</b></div>
                                        @else
                                        <div>Payment Status: <b>{{ $data['transaction']->status }}</b></div>
                                        @endif
                                    </td>
                                    <td class="single-td" style="text-align: right">
                                        <div>Please print a copy of this receipt as evidence of payment.</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="box-table" style="text-align:left;">
                                <tr>
                                    <td style="padding-right: 8px;">
                                        <div class="title" style="text-align: center;">From:
                                            {{substr($settings->app_name ?? '', 0, 10)}}</div>
                                        <div class="in-box-table">
                                            <img class="logo" src="{{ public_path() . '/' . $setting->dark_logo ?? '' }}"
                                                alt="">
                                        </div>
                                    </td>
                                    <td style="padding-right: 8px;">
                                        <div class="title">To: {{ $user->name ?? '' }}</div>
                                        <div class="in-box-table">
                                            <table style="width: auto;">
                                                <tr>
                                                    <td>
                                                        <img src="{{ $user->getProfilePhotoUrlAttribute() }}"
                                                            alt="">
                                                    </td>
                                                    <td style="padding-left: 12px;">
                                                        <div>
                                                            <h3>Details</h3>
                                                            <div>Name: <span>{{ $user->name ?? '' }}</span></div>
                                                            {{-- <div>Student ID:
                                                                <span>

                                                                </span>
                                                            </div> --}}
                                                            <div>Email: <a
                                                                    href="#">{{ $user->email ?? '' }}</a></div>
                                                            <div>Phone: <a
                                                                    href="#">{{ $user->phone ?? '' }}</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="title" style="text-align: center;">QR CODE</div>
                                        <div class="in-box-table">
                                            @php
                                                $link = $data['invoice_view'] ? route('invoice.show', $invoice_id) : route('transaction.details', $data['transaction']->transaction_no);
                                            @endphp
                                            <img object-fit: cover;
                                                src="https://chart.googleapis.com/chart?cht=qr&chl={{ $link }}&chs=160x160&chld=L|0"
                                                class="qr-code img-thumbnail img-responsive" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="report-table" style="margin-bottom: 20px;">
                                <thead>
                                    <tr>
                                        <td style="width: 5%;">#</td>
                                        <td>Title</td>
                                        <td style="text-align:right;">Price</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            {{$data['transaction']->title ?? ''}}
                                        </td>
                                        <td style="text-align:right;">
                                            @php
                                                $fromRate = App\Models\Currency::whereCode($data['transaction']->currency)->first()->rate;
                                                $toRate = App\Models\Currency::whereCode($setting->app_currency)->first()->rate;
                                                $rate = $fromRate / $toRate;
                                                $amount = (int) round($data['transaction']->amount / $rate, 2);
                                            @endphp
                                            {{ number_format($amount,2) ?? '' }} {{ $setting->app_currency ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: none;">
                                        </td>
                                        <td style="border-bottom: none; font-size: 16px; font-weight: 600;">
                                            Total
                                        </td>
                                        <td
                                            style="border-bottom: none; font-size: 16px; font-weight: 600; text-align:right;">
                                            {{ number_format($amount,2) ?? '' }} {{ $setting->app_currency ?? '' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="sign-table" style="text-align: left;">
                                <tr>
                                    <td>
                                        <div class="left-side">
                                            <h3>{{ $settings->principal_name ?? '' }}</h3>
                                            <div>Principal</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="right-side">
                                            For enquiries, Please call <a
                                                href="#">{{ $setting->app_phone ?? '' }}</a> <br> OR email
                                            <a href="#"
                                                style="text-transform: lowercase">{{ $setting->app_email ?? '' }}</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <img src="{{ public_path() . '/' . $settings->light_logo ?? '' }}" alt="" class="shadow-logo" />
            </td>
        </tr>
    </table>
</body>

</html>
