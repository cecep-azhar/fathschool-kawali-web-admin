<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta charset="UTF-8"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Student Attendance Report')}}</title>
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
            line-height: 116%;
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
            line-height: 125%;
            letter-spacing: -0.64px;
            margin: 0px;
            margin-bottom: 20px;
        }

        .in-table {
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            line-height: 150%;
            letter-spacing: 0.16px;
            margin-bottom: 8px;
        }

        .in-table tr td {
            margin-right: 2px;
        }

        .report-summery,
        .report-summery-2 {
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
            line-height: 133%;
            margin-bottom: 12px;
        }

        .report-summery-2 h3 {
            color: #101011;
            text-align: center;
            font-size: 24px;
            font-family: Inter;
            font-style: normal;
            font-weight: 600;
            line-height: 125%;
            letter-spacing: 0.32px;
            margin-bottom: 8px;
        }

        .report-summery-2 div {
            color: #111;
            text-align: center;
            font-size: 14px;
            font-family: Inter;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            letter-spacing: 0.18px;
        }

        .report-summery table td {
            text-align: left;
        }

        .report-summery img {
            width: 74px;
            height: 74px;
            object-fit: contain;
        }

        .report-summery table h3 {
            color: #074EE8;
            font-size: 14px;
            font-family: Inter;
            font-style: normal;
            font-weight: 600;
            line-height: 125%;
            letter-spacing: 0.18px;
            text-transform: uppercase;
        }

        .report-summery table div {
            color: #000;
            font-size: 12px;
            font-family: Inter;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            letter-spacing: 0.16px;
            opacity: 0.8;
        }

        .report-summery table a,
        .report-summery table span {
            text-decoration: none;
            color: #000;
            font-weight: 600;
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

        .report-table tfoot {
            background: #E0EAFF;
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
            line-height: 115%;
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
            font-size: 10px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 500;
            line-height: 120%;
            letter-spacing: 0.14px;
        }

        .report-table .pay-status {
            color: #101011;
            font-family: Inter;
            font-size: 10px;
            font-style: normal;
            font-weight: 600;
            line-height: 120%;
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
            bottom: 25px;
        }

        .sign-table .left-side {
            padding-left: 40px;
        }

        .sign-table .right-side {
            padding-right: 40px;
        }

        .sign-table .left-side img {
            width: 62px;
            height: auto;
            object-fit: contain;
        }

        .sign-table .left-side h3 {
            color: #111;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 600;
            line-height: 125%;
            letter-spacing: 0.18px;
            margin-top: 8px;
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

        .sign-table td {
            vertical-align: bottom;
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
            opacity: 0.10;
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
                            <img class="logo" src="{{ public_path() . '/' . $settings->dark_logo }}" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="main-title">{{ $settings->app_name ?? '' }}</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3 class="main-subtitle">{{$student->name ? $student->name."'s" : ""}} {{__('Attendance ')}} {{__('Report')}} -
                                {{ date('F', strtotime("2023-$monthName-01")) }}, {{ $year }}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="in-table" style="width:auto;">
                                <tr>
                                    {{-- <td>Course:</td>
                                    <td style="font-weight: 600;">Science</td>
                                    <td> •</td>
                                    <td>Subject:</td>
                                    <td style="font-weight: 600;">{{$subject ?? ''}}</td> --}}
                                </tr>
                            </table>
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
                                        <td style="padding-left: 12px;">
                                            <div>
                                                <h3>{{__('Student Detail')}}</h3>
                                                <div>{{__('Name')}}: <span>{{ $student->name ?? '' }}</span></div>
                                                <div>Student ID: <span>{{ $user->student_id ?? '' }}</span></div>
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
                                                <h3>{{ $present ?? '' }}</h3>
                                                <div>Days Present</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h3>{{ $late ?? '' }}</h3>
                                                <div>Days Late</div>
                                            </div>
                                        </td>
                                        {{-- <td>
                                        <div>
                                            <h3>24</h3>
                                            <div>Days Skip</div>
                                        </div>
                                    </td> --}}
                                        <td>
                                            <div>
                                                <h3>{{ $absent ?? '' }}</h3>
                                                <div>Days Absent</div>
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
                                        <td>Date</td>
                                        <td>Status</td>
                                        <td style="width: 50%;">Teacher's Note</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $item)
                                        <tr>
                                            <td>{{ date(str_replace(['__', '_'], ['/', '-'], config('app.date_format')), strtotime($item->date)) ?? '' }}</td>
                                            <td
                                                style="text-transform: capitalize; color: @if ($item->status == 'present') #22c55e @elseif($item->status == 'absent') #ef4444 @else #fbbf24 @endif ;">
                                                {{ $item->status ?? '' }}</td>
                                            <td>{{ $item->late_amount ? $item->late_amount . ' min late.' : '' }}</td>
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
                                            {{-- <img src="{{ public_path().'/images/report-sign.png' }}" alt=""> --}}
                                            <h3>{{ $setting->principal_name ?? '' }}</h3>
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
                <img src="{{ public_path() . '/' . $setting->light_logo ?? '' }}" alt="" class="shadow-logo" />
            </td>
        </tr>
    </table>
</body>

</html>
