<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Fee Collection Report</title>
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
            width: 44px;
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
            margin-right: 2px;
        }

        .report-summery {
            padding: 12px;
            border: 1px solid #CCC;
            margin-bottom: 20px;
        }

        .report-summery .summery-title {
            color: #111111;
            text-align: center;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            margin-bottom: 12px;
        }

        .report-summery table td {
            text-align: center;
        }

        .report-summery table h3 {
            color: #111;
            text-align: center;
            font-size: 21px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 600;
            line-height: 120%;
        }

        .report-summery table div {
            color: #111;
            text-align: center;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            opacity: 0.8;
        }

        .report-table td {
            padding: 8px 12px;
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
            font-size: 10px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 500;
            line-height: 120%;
            letter-spacing: 0.14px;
        }

        .report-table tfoot {
            background: #E0EAFF;
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
    <div class="main-table">
        <div>
            <div class='main-td'>
                <div>
                    <div style="text-align: center;">
                        <img class="logo" src="{{ public_path() . '/' . $settings->dark_logo ?? '' }}" alt="">
                    </div>
                    <div>
                        <h2 class="main-title">{{ $settings->app_name ?? '' }}</h2>
                    </div>
                    <div>
                        <h3 class="main-subtitle">Student Fee Collection Report - {{ $monthName ?? '' }},
                            {{ $year ?? '' }}</h3>
                    </div>
                    <div>
                        <table class="in-table" style="width:auto;">
                            <tr>
                                <td>Course:</td>
                                <td style="font-weight: 600;">{{ $course->name ?? '' }}</td>
                                <td style="padding: 0px 4px;">•</td>
                                <td>Total Student:</td>
                                <td style="font-weight: 600;">{{ $userCount ?? '' }} Students</td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <div class="report-summery">
                            <table>
                                <tr>
                                    <td>
                                        <div>
                                            <h3>{{ number_format($totalAmount, 2) }} {{ $settings->app_currency ?? '' }}
                                            </h3>
                                            <div>Amount Collected</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <h3>{{ number_format($paidAmount, 2) }} {{ $settings->app_currency ?? '' }}
                                            </h3>
                                            <div>Paid Fees</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <h3>{{ number_format($totalAmount - $paidAmount, 2) }}
                                                {{ $settings->app_currency ?? '' }}</h3>
                                            <div>Pending Fees</div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div>
                        <table class="report-table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Student</td>
                                    <td>Date</td>
                                    <td>Type</td>
                                    <td>Amount</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $key => $transaction)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <h4>{{ $transaction->user->name }}</h4>
                                            <div style="color: #666; font-size: 10px; line-height: 120%;">
                                                {{ $transaction->user->profile->student_id }}</div>
                                        </td>
                                        <td>{{ date(str_replace(['__', '_'], ['/', '-'], config('app.date_format')), strtotime($transaction->date)) ?? '' }}
                                        </td>
                                        <td>{{ $transaction->type->name }}</td>
                                        <td style="text-align: right">
                                            {{ number_format($transaction->convertedAmount, 2) }}
                                            {{ $settings->app_currency ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>TOTAL</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right">{{ number_format($totalAmount, 2) }}
                                        {{ $settings->app_currency ?? '' }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div>
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
                                            href="#">{{ $settings->app_phone ?? '' }}</a> <br> OR email
                                        <a href="#">{{ $settings->app_email ?? '' }}</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        </tr>
                    </div>
                    <img src="{{ public_path() . '/' . $settings->light_logo ?? '' }}" alt=""
                        class="shadow-logo" />

                </div>
            </div>
        </div>
</body>

</html>
