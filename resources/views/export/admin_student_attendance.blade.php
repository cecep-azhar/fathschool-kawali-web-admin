<!DOCTYPE html>
<html>

<head>
    <title>Attendance Report</title>
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
    <h2>Attendance Report - {{ date('M, Y', strtotime($year . '-' . $month)) }}</h2>
    <table>
        <tr >
            <th class="p-2 text-center">Student</th>
            <th class="p-2 text-center">Status</th>
            <th class="p-2 text-center">Late Time</th>
            <th class="p-2 text-center">Date</th>
        </tr>
        @if ($attendances->count() > 0)
            @foreach ($attendances as $key => $value)
                <tr class="text-center">
                    <td class="p-3">
                        <div>{{ $value && $value->student ? $value->student->name : '' }}</div>
                    </td>
                    <td class="p-3">
                        {{ $value ? Str::ucfirst($value->status) : '' }}
                    </td>
                    <td class="p-3">
                        {{ $value && $value->status == 'late' ? $value->late_amount . ' Minutes' : 0 }}
                    </td>
                    <td class="p-3">
                        {{ $value ? $value->date_time : '' }}
                    </td>
                </tr>
            @endforeach
        @else
            <tr class="text-center">
                <td colspan="4" class="p-3">
                    <div>No Data</div>
                </td>
            </tr>
        @endif

    </table>
</body>

</html>
