<!DOCTYPE html>
<html>

<head>
    <title>Transactions Report</title>
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

        @page {
            size: 1500px;
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
    <h2>Transactions Report</h2>
    <table>
        <tr>
            <th class="p-2 text-center">Title</th>
            <th class="p-2 text-center">Type</th>
            <th class="p-2 text-center">Recipient</th>
            <th class="p-2 text-center">Amount</th>
            <th class="p-2 text-center">Paid Amount</th>
            <th class="p-2 text-center">Method</th>
            <th class="p-2 text-center">Date</th>
            <th class="p-2 text-center">Document</th>
        </tr>
        @foreach ($transactions as $key => $value)
            <tr class="text-center">
                <td class="p-3">
                    <div>{{ $value ? $value->title : '' }}</div>
                </td>
                <td class="p-3">
                    {{ $value && $value->type ? $value->type->type : '' }}
                </td>
                <td class="p-3">
                    {{ $value && $value->user ? $value->user->name : '' }}
                </td>
                <td class="p-3">
                    {{ $value ? currencyFormat($value->amount) : '' }}
                </td>
                <td class="p-3">
                    {{ $value ? currencyFormat($value->paid_amount) : '' }}
                </td>
                <td class="p-3">
                    {{ $value ? $value->method : '' }}
                </td>
                <td class="p-3" style="white-space: nowrap">
                    {{ $value ? $value->date : '' }}
                </td>
                <td class="p-3">
                    <a href="{{ $value ? $value->document : '' }}" target="_blank">Download</a>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
