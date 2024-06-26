<!DOCTYPE html>
<html>

<head>
    <title>Result Report</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            text-align: left;
        }

        .p-3 {
            padding: 12px !important;
        }

        .p-2 {
            padding: 8px !important;
        }

        .text-center {
            text-align: center !important;
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin-bottom:12px">
        <img width="120px" src="{{ $settings->dark_logo }}" alt="dark logo">
        <div style="font-size: 40px;font-weight: bold"> {{ $settings->app_name }}</div>
        <div style="font-weight: 500">
            <div> {{ $settings->app_address }}</div>
        </div>
    </div>
    <h2>Result Report</h2>
    <table>
        <tr >
            <th class="p-2 text-center">Exam</th>
            <th class="p-2 text-center">Session</th>
            <th class="p-2 text-center">Class</th>
            <th class="p-2 text-center">Result Sheet</th>
        </tr>
        @foreach ($results as $key => $value)
            <tr class="text-center">
                <td class="p-3">
                    <div>{{ $value && $value->exam ? $value->exam->name : '' }}</div>
                </td>
                <td class="p-3">
                    {{ $value ? $value->session : '' }}
                </td>
                <td class="p-3">
                    {{ $value && $value->class ? $value->class->name : '' }}
                </td>
                <td class="p-3">
                    <a href="{{ $value ? $value->file_link : '' }}" target="_blank">Download</a>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
