<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ $exam->name }} Report Sheets
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

        .result-box {
            width: 100%;
            max-width: 1200px;
            margin: 48px auto;
            background: white;
            padding: 40px;
            position: relative;
        }

        .result-box .title {
            font-size: 36px;
            line-height: 56px;
            color: #000;
            text-align: center;
            margin-top: 24px;
            margin-bottom: 16px;
        }
    </style>
</head>

<body>
    <table class="result-box" size="A4">
        <tr>
            <td>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="text-align: center;">
                            <table style="margin: auto; border-collapse: collapse;">
                                <tr>
                                    <td>
                                        <img style="width: auto; height: 88px; object-fit: cover:"
                                            src="{{ $logo }}"
                                            alt="{{ $setting->app_name }}">
                                    </td>
                                    <td>
                                        <h2 style="font-size: 48px; line-height: 56px; padding-left: 12px;">
                                            {{ $setting->app_name }}
                                        </h2>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3 class="title">
                                {{ $exam->name }} REPORT SHEET
                            </h3>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border: 2px solid #CCCCCC; border-top: none;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 24px;">
                            <div>
                                <h4 style="font-size: 16px; line-height: 24px; margin-bottom: 6px;">
                                    NAME: {{ $user->name }}
                                </h4>
                                <h4 style="font-size: 16px; line-height: 24px; margin-bottom: 6px;">
                                    EMAIL: {{ $user->email }}
                                </h4>
                                <h4 style="font-size: 16px; line-height: 24px; margin-bottom: 6px;">
                                    GENDER: {{ $user->gender ?? '' }}
                                </h4>
                                <h4 style="font-size: 16px; line-height: 24px; margin-bottom: 6px;">
                                    PHONE: {{ $user->phone ?? '' }}
                                </h4>
                            </div>
                        </td>
                        <td style="padding: 24px; border-left: 2px solid #CCCCCC; border-right: 2px solid #CCCCCC;">
                            <div>
                                <h4 style="font-size: 16px; line-height: 24px; margin-bottom: 6px;">
                                    COURSE: {{ $exam->course->name }}
                                </h4>
                                <h4 style="font-size: 16px; line-height: 24px; margin-bottom: 6px;">
                                    NO. IN COURSES: {{ $no_of_students }} Students
                                </h4>
                                <h4 style="font-size: 16px; line-height: 24px; margin-bottom: 6px;">
                                    NEXT TERM BEGINS:
                                    {{ $next_exam && $next_exam->start_date ? formatTime($next_exam->start_date) : '' }}
                                    <br>
                                    NEXT TERM ENDS:
                                    {{ $next_exam && $next_exam->end_date ? formatTime($next_exam->end_date) : '' }}
                                </h4>
                            </div>
                        </td>
                        <td style="padding: 24px; text-align: center">
                            <img src="{{ $user_avatar }}"
                                style="width: 148px; height: 148px; object-fit: cover;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="border-collapse: collapse; width: 100%; margin-top: 32px;">
                    <thead>
                        <tr style="background-color: rgb(134 239 172);">
                            <th style="padding: 8px 24px; text-align: left;">S/N</th>
                            <th style="padding: 8px 24px; text-align: left;">SUBJECT
                            </th>
                            <th style="padding: 8px 24px; text-align: left;">TOTAL
                                MARK
                            </th>
                            <th style="padding: 8px 24px; text-align: left;">GRADE
                            </th>
                            <th style="padding: 8px 24px; text-align: left;">AVG MARK
                            </th>
                            <th style="padding: 8px 24px; text-align: left;">GRADE
                                REMARK
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exam_marks as $key => $exam_mark)
                            <tr style="{{ $exam_marks_count == $key + 1 ? 'border-bottom:1px solid #e5e7eb' : '' }}">
                                <td
                                    style="padding: 8px 24px; text-align: left; {{ $key % 2 === 0 ? 'background: white' : 'background: rgb(96 165 250);' }}">
                                    {{ $key + 1 }}

                                </td>
                                <td
                                    style="padding: 8px 24px; text-align: left; {{ $key % 2 === 0 ? 'background: white' : 'background: rgb(96 165 250);' }}">
                                    {{ $exam_mark->subject }}
                                </td>
                                <td
                                    style="padding: 8px 24px; text-align: left; {{ $key % 2 === 0 ? 'background: white' : 'background: rgb(96 165 250);' }}">
                                    {{ $exam_mark->marks }}
                                </td>
                                <td
                                    style="padding: 8px 24px; text-align: left; {{ $key % 2 === 0 ? 'background: white' : 'background: rgb(96 165 250);' }}">
                                    {{ $exam_mark->grade }}
                                </td>
                                <td
                                    style="padding: 8px 24px; text-align: left; {{ $key % 2 === 0 ? 'background: white' : 'background: rgb(96 165 250);' }}">
                                    {{ round($exam_mark->mark_avg, 0) }}
                                </td>
                                <td
                                    style="padding: 8px 24px; text-align: left; {{ $key % 2 === 0 ? 'background: white' : 'background: rgb(96 165 250);' }}">
                                    {{ $exam_mark->grade_remarks }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="border-collapse: collapse; margin-top: 80px;">
                    <tr>
                        <td>
                            <div class="mt-12">
                                <p>KEY TO GRADES: {{ $setting->key_to_grades }}</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class='w-1/2'>GRADES SUMMARY: {{ $setting->grade_summary }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class='w-1/2'>AVERAGE SCORE: {{ round($avg_score, 0) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top: 24px;">
                                <h3 style="margin-bottom: 8px;">{{ $setting->principal_name }}</h3>
                                <h4>Director/Principal</h4>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
