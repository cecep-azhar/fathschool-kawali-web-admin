<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        @if (isset($invoice))
            {{ $invoice->user ? $invoice->user->name . "'s Invoice" : 'Invoice' }}
        @else
            Invoice
        @endif
    </title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 0px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            padding: 22px;
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                {{ config('app.name') }}
                            </td>
                            <td style="text-align: right;">
                                <span style="font-weight: bold">Date</span>:
                                {{ $invoice->date ? date('M d , Y', strtotime($invoice->date)) : '' }}<br />
                                <span style="font-weight: bold">Due Date</span>:
                                {{ $invoice->due_date ? date('M d , Y', strtotime($invoice->due_date)) : '' }}<br />
                                <span style="font-weight: bold">Invoice</span>:
                                #{{ $invoice ? $invoice->invoice_no : 'Invoice_No' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <span style="font-weight: bold">From</span> <br>
                                <span style="font-weight: bold">Name</span>:
                                {{ $sender_name ? $sender_name : 'Test' }}
                                <br />
                                <span style="font-weight: bold">Email</span>:
                                {{ $sender_email ? $sender_email : 'Test' }}
                                <br />
                                <span style="font-weight: bold">
                                    Address :
                                </span>
                                <span style="">
                                    {{ $sender_address ? $sender_address : 'Test' }}
                                </span>
                            </td>
                            <td style="text-align: left; padding-left:120px">
                                <span style="font-weight: bold">To</span> <br>
                                <span style="font-weight: bold">Name</span>:
                                {{ $invoice->user ? $invoice->user->name : 'Test' }}
                                <br />
                                <span style="font-weight: bold">Email</span>:
                                {{ $invoice->user ? $invoice->user->email : 'Test' }}
                                <br />
                                <span style="font-weight: bold">
                                    Address :
                                </span>
                                <span style="">
                                    {{ $invoice->user ? $invoice->user->address : 'Test' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading" style="text-align: center">
                <td>Item Name</td>
                <td>Description</td>
                <td>Quantity</td>
                <td>Amount</td>
            </tr>
            @foreach ($invoice->items as $item)
                <tr class="item" style="text-align: center">
                    <td>
                        {{ $item ? $item->name : 'Test' }}
                    </td>
                    <td>
                        {{ $item ? $item->description : 'Test' }}
                    </td>
                    <td>
                        {{ $item ? $item->quantity : 'Test' }}
                    </td>
                    <td>
                        ${{ $item ? $item->amount : 'Test' }}
                    </td>
                </tr>
            @endforeach
            <tr class="total">
                <td colspan="4" style="font-weight:bold; text-align: right; padding-right: 15px">
                    Total:
                    ${{ $invoice->items_sum_amount ? $invoice->items_sum_amount : 'Test' }}
                </td>
            </tr>
            <tr class="informatiotgn">
                <td colspan="4" style="padding-top:40px">
                    <table>
                        <tr>
                            <td>
                                <span style="font-weight: bold">Payment Details</span> <br>
                                <span style="font-weight: bold">Name</span>:
                                @if (isset($request))
                                    {{ $request ? $request->sender_name : 'Test' }}
                                @else
                                    Test
                                @endif
                                <br />
                                <span style="font-weight: bold">Email</span>:
                                @if (isset($request))
                                    {{ $request ? $request->sender_email : 'Test' }}
                                @else
                                    Test
                                @endif
                                <br />
                                <span style="font-weight: bold">
                                    Address :
                                </span>
                                <span style="">
                                    @if (isset($request))
                                        {{ $request ? $request->sender_address : 'Test' }}
                                    @else
                                        Test
                                    @endif
                                </span>
                            </td>
                            <td
                                style="text-align: right;
                            justify-content: end;
                            align-items: end;
                            text-align: left;
                            width: 214px;">
                                <span style="font-weight: bold">Note</span> <br>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse repudiandae doloribus
                                impedit aliquid suscipit consequatur deleniti neque in expedita atque aliquam, enim
                                excepturi, maxime ea eaque porro fugiat ipsam incidunt?
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
