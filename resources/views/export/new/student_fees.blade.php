<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Test</title>
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
            max-width: 1200px;
            margin: auto;
            border-collapse: collapse;
            font-family: 'Inter', sans-serif;
        }

        .main-td {
            padding: 40px 80px;
            position: relative;
        }

        .main-table table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            position: relative;
        }

        .logo {
            width: 88px;
            height: 88px;
            object-fit: contain;
            margin: 0px auto 12px;
        }

        .main-title {
            color: #000;
            text-align: center;
            font-size: 48px;
            font-style: normal;
            font-family: 'Inter', sans-serif !important;
            font-weight: 600;
            line-height: 56px;
            letter-spacing: -0.96px;
            margin: 0px;
            margin-bottom: 12px;
        }

        .main-subtitle {
            color: #000;
            text-align: center;
            font-size: 32px;
            font-style: normal;
            font-family: 'Inter', sans-serif !important;
            font-weight: 600;
            line-height: 40px;
            letter-spacing: -0.64px;
            margin: 0px;
            margin-bottom: 40px;
        }

        .in-table {
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            ;
            letter-spacing: 0.16px;
            margin-bottom: 16px;
        }

        .in-table tr td {
            margin-right: 2px;
        }

        .report-summery,
        .report-summery-2 {
            padding: 24px;
            border: 1px solid #CCC;
            margin-bottom: 40px;
        }

        .report-summery .summery-title {
            color: #111111;
            text-align: center;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            ;
            margin-bottom: 24px;
        }

        .report-summery-2 h3 {
            color: #101011;
            text-align: center;
            font-size: 32px;
            font-family: Inter;
            font-style: normal;
            font-weight: 600;
            line-height: 40px;
            letter-spacing: 0.32px;
            margin-bottom: 8px;
        }

        .report-summery-2 div {
            color: #111;
            text-align: center;
            font-size: 18px;
            font-family: Inter;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            ;
            letter-spacing: 0.18px;
        }

        .report-summery table td {
            text-align: left;
        }

        .report-summery img {
            width: 148px;
            height: 148px;
            object-fit: contain;
        }

        .report-summery table h3 {
            color: #074EE8;
            font-size: 18px;
            font-family: Inter;
            font-style: normal;
            font-weight: 600;
            line-height: 28px;
            letter-spacing: 0.18px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .report-summery table div {
            color: #000;
            font-size: 16px;
            font-family: Inter;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            ;
            letter-spacing: 0.16px;
            margin-bottom: 6px;
            opacity: 0.8;
        }

        .report-summery table a,
        .report-summery table span,
        {
        text-decoration: none;
        color: #000;
        font-weight: 600;
        }

        .report-table td {
            padding: 8px 24px;
            text-align: left;
        }

        .report-table thead {
            background: #EEE;
            border-radius: 2px;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 600;
            line-height: 125%;
            ;
            letter-spacing: 0.16px;
            text-transform: uppercase;
            color: #074EE8;
        }

        .report-table tfoot {
            background: #E0EAFF;
        }

        .report-table tbody td {
            border-bottom: 1px solid #AAAAAA;
        }

        .report-table h4 {
            color: #101011;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 500;
            line-height: 20px;
            letter-spacing: 0.16px;
            margin-bottom: 4px;
        }

        .report-table div {
            color: #101011;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            ;
            letter-spacing: 0.16px;
        }

        .report-table div div {
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 500;
            line-height: 18px;
            letter-spacing: 0.14px;
        }

        .report-table .pay-status {
            color: #101011;
            font-family: Inter;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: 20px;
            letter-spacing: 0.14px;
            text-transform: uppercase;
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            background: #EED6D6;
        }

        .report-table .pay-status.paid {
            background: #D7EED6;
        }

        .sign-table {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            margin-top: 44px;
        }

        .sign-table .left-side h3 {
            color: #111;
            font-size: 18px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 600;
            line-height: 125%;
            ;
            letter-spacing: 0.18px;
            margin-top: 8px;
        }

        .sign-table .left-side div {
            color: rgba(17, 17, 17, 0.80);
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            ;
            letter-spacing: 0.16px;
        }

        .sign-table td {
            vertical-align: bottom;
        }

        .sign-table .right-side {
            color: rgba(17, 17, 17, 0.80);
            text-align: right;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            ;
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
            size: A3;
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
                            <img class="logo" src="{{ public_path() . '/' . $settings->dark_logo ?? '' }}" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="main-title">{{ $settings->app_name ?? '' }}</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3 class="main-subtitle">Student Fee Payment Report</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="report-summery">
                                <table style="width: auto;">
                                    <tr>
                                        <td>
                                            <img src="{{ $student->getProfilePhotoUrlAttribute() }}" alt="">
                                        </td>
                                        <td style="padding-left: 24px;">
                                            <div>
                                                <h3>Student Detail</h3>
                                                <div>Name: <span>{{ $student->name ?? '' }}</span></div>
                                                <div>Student ID: <span>{{ $student->profile->student_id ?? '' }}</span>
                                                </div>
                                                <div>Email: <a href="#">{{ $student->email ?? '' }}</a></div>
                                                <div>Phone: <a href="#">{{ $student->phone ?? '' }}</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="report-summery-2">
                                <table style="text-align: center;">
                                    <tr>
                                        <td>
                                            <div>
                                                <h3>{{ number_format($totalAmount, 2) }} {{$settings->app_currency ??
                                                    ''}}</h3>
                                                <div>Total Amount</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h3>{{ number_format($paidAmount, 2) }} {{$settings->app_currency ??
                                                    ''}}</h3>
                                                <div>Paid Amount</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h3>{{ number_format($totalAmount - $paidAmount,2) }}
                                                    {{$settings->app_currency ?? ''}}</h3>
                                                <div>Outstanding Balance</div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="report-table">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td style="width: 15%">Amount</td>
                                        <td>Type</td>
                                        <td>Date of Issue</td>
                                        <td>Due Date</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $key => $transaction)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ number_format($transaction->convertedAmount, 2) }}
                                            {{$settings->app_currency ?? ''}}</td>
                                        <td>{{ $transaction->type->name }}</td>
                                        <td>{{ date(str_replace(['__', '_'], ['/', '-'], config('app.date_format')),
                                            strtotime($transaction->date)) }}
                                        </td>
                                        <td>{{ date(str_replace(['__', '_'], ['/', '-'], config('app.date_format')),
                                            strtotime($transaction->due_date)) }}
                                        </td>
                                        <td>
                                            <div class='pay-status {{ $transaction->status == ' paid' ? 'paid' : '' }}'>
                                                {{ $transaction->status ?? '' }}</div>
                                        </td>
                                    </tr>
                                    @endforeach
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
                                            For enquiries, Please call <a href="#">{{ $settings->app_phone ?? '' }}</a>
                                            <br> OR email
                                            <a href="#" style="text-transform: lowercase">{{ $settings->app_email ?? ''
                                                }}</a>
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
