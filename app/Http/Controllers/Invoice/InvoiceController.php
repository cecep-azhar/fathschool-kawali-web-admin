<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accountant\InvoiceCreateRequest;
use App\Http\Requests\Accountant\InvoiceUpdateRequest;
use App\Http\Resources\InvoiceUserResource;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Accountant\Invoice\CreateInvoiceService;
use App\Services\Accountant\Invoice\DeleteInvoiceService;
use App\Services\Accountant\Invoice\FetchInvoiceService;
use App\Services\Accountant\Invoice\SendMailInvoiceService;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Traits\InvoiceTrait;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    use InvoiceTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FetchInvoiceService $fetchInvoiceService)
    {
        abort_if(! userCan('invoice.index'), 403);

        $invoices = $fetchInvoiceService->fetch($request);

        return inertia('Accountant/Invoice/Index', [
            'invoices' => $invoices,
            'filter_data' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateInvoiceService $createInvoiceService)
    {
        abort_if(! userCan('invoice.create'), 403);
        $data = $createInvoiceService->create();

        return inertia('Accountant/Invoice/Create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceCreateRequest $request)
    {
        abort_if(! userCan('invoice.create'), 403);

        // if invoice have recurring option
        if ($request->recurring) {
            $request->validate([
                'recurring_days' => 'required|integer',
            ]);
        }

        $invoice = $this->invoiceCreate($request);

        $this->flashSuccess('Invoice created');

        $route = $invoice->recurring ? 'invoice.index' : 'all.transaction';

        return redirect()->route($route, ['keyword' => $invoice->title]);
    }

    /**
     * Show the form for showing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        abort_if(! userCan('invoice.show'), 403);

        $transactions = Transaction::where('invoice_id', $invoice->id)->with('type', 'user')->latest()->paginate(15)->onEachSide(-1);

        return inertia('Accountant/Invoice/Show', [
            'invoice' => $invoice,
            'transactions' => $transactions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        abort_if(! userCan('invoice.edit'), 403);

        $users = InvoiceUserResource::collection(User::active()->latest()->get());
        $currencies = Currency::latest()->active()->get();
        $invoice->load(['items', 'attachments', 'user']);

        // array data
        $invoice_items = $invoice->items;
        $amounts = $invoice_items->map(function ($q) {
            return $q->amount;
        });
        $quantity = $invoice_items->map(function ($q) {
            return $q->quantity;
        });
        $descriptions = $invoice_items->map(function ($q) {
            return $q->description;
        });

        return inertia('Accountant/Invoice/Edit', [
            'invoice' => $invoice,
            'users' => $users,
            'currencies' => $currencies,
            'amounts' => $amounts,
            'quantity' => $quantity,
            'descriptions' => $descriptions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        abort_if(! userCan('invoice.edit'), 403);

        if ($request->recurring) {
            $request->validate([
                'recurring_days' => 'required|integer',
            ]);
        }

        $invoice = $this->invoiceUpdate($request, $invoice);

        $this->flashSuccess('Invoice updated');

        $route = $invoice->recurring ? 'invoice.index' : 'all.transaction';

        return redirect()->route($route, ['keyword' => $invoice->title]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice, DeleteInvoiceService $deleteInvoiceService)
    {
        abort_if(! userCan('invoice.destroy'), 403);

        $deleteInvoiceService->delete($invoice);

        $this->flashSuccess('Invoice deleted');

        return back();
    }

    /**
     * Print invoice .
     *
     * @param  object  $invoice
     * @return \Illuminate\Http\Response
     */
    public function print(Invoice $invoice)
    {
        abort_if(! userCan('invoice.print'), 403);

        $invoice->load('user');

        $data['user'] = $invoice->user;
        $data['setting'] = Setting::first(['app_name', 'dark_logo', 'light_logo', 'app_email', 'app_phone']);
        $data['transactions'] = $invoice->transactions;
        $data['invoice_view'] = true;
        $total_value = $data['transactions']->map(function ($q) {
            return $q->amount;
        });
        $data['currency'] = $invoice->currency;
        $data['title'] = $invoice->title;
        $data['date'] = $invoice->invoice_date;
        $data['id'] = $invoice->invoice_no;
        $data['invoice_id'] = $invoice->id;
        $data['invoice_no'] = $invoice->invoice_no;

        $arr = [];
        foreach ($total_value as $key => $value) {
            array_push($arr, $value);
        }
        $data['total'] = array_sum($arr);

        $amount = $invoice->amount;
        $currency = $invoice->currency ?? config('templatecookie.currency');

        session(['transaction_info' => [
            'pay_amount' => $amount,
            'transaction_id' => $invoice->id,
        ]]);

        // Convert to Default Currency
        session(['stripe_amount' => currencyConversion($amount, $invoice->currency, 'USD') * 100]);
        session(['razor_amount' => currencyConversion($amount, $invoice->currency, 'INR', 1) * 100]);

        // midtrans snap token
        if (config('templatecookie.midtrans_active') && config('templatecookie.midtrans_merchant_id') && config('templatecookie.midtrans_client_key') && config('templatecookie.midtrans_server_key')) {
            // $usd = $plan->price;
            $amount = (int) Currency::convert()
                ->from($currency)
                ->to('IDR')
                ->amount($amount)
                ->round(2)
                ->get();

            $order['order_no'] = uniqid();
            $order['total_price'] = $amount;

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
        }

        session(['invoice_download_url' => route('transaction.details', $invoice->invoice_no)]);

        $data['mid_token'] = $snapToken ?? null;
        $data['transaction_info'] = session('transaction_info');

        return view('transaction-invoice', $data);
    }

    /**
     * Invoice Download As PDF.
     *
     * @param  object  $invoice
     * @return \Illuminate\Http\Response
     */
    public function invoiceDownload(Request $request, Invoice $invoice)
    {
        abort_if(! userCan('invoice.print'), 403);

        $invoice->load('user');

        $data['user'] = $invoice->user;
        $data['setting'] = Setting::first(['app_name', 'dark_logo', 'light_logo', 'app_email', 'app_phone']);
        $data['transactions'] = $invoice->transactions;
        $data['invoice_view'] = true;
        $total_value = $data['transactions']->map(function ($q) {
            return $q->amount;
        });
        $data['currency'] = $invoice->currency;
        $data['title'] = $invoice->title;
        $data['date'] = $invoice->invoice_date;
        $data['id'] = $invoice->invoice_no;
        $data['invoice_id'] = $invoice->id;
        $data['invoice_no'] = $invoice->invoice_no;
        $arr = [];
        foreach ($total_value as $key => $value) {
            array_push($arr, $value);
        }
        $data['total'] = array_sum($arr);

        $amount = $invoice->amount;
        $currency = $invoice->currency ?? config('templatecookie.currency');

        session(['transaction_info' => [
            'pay_amount' => $amount,
            'transaction_id' => $invoice->id,
        ]]);

        // Convert to Default Currency
        session(['stripe_amount' => currencyConversion($amount, $invoice->currency, 'USD') * 100]);
        session(['razor_amount' => currencyConversion($amount, $invoice->currency, 'INR', 1) * 100]);

        // midtrans snap token
        if (config('templatecookie.midtrans_active') && config('templatecookie.midtrans_merchant_id') && config('templatecookie.midtrans_client_key') && config('templatecookie.midtrans_server_key')) {
            // $usd = $plan->price;
            $amount = (int) Currency::convert()
                ->from($currency)
                ->to('IDR')
                ->amount($amount)
                ->round(2)
                ->get();

            $order['order_no'] = uniqid();
            $order['total_price'] = $amount;

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
        }

        session(['invoice_download_url' => route('transaction.details', $invoice->invoice_no)]);

        $data['mid_token'] = $snapToken ?? null;
        $data['transaction_info'] = session('transaction_info');

        $data['user_avatar'] = domPdfImageUrl($data['user']?->profile_photo_path ?? $data['user']?->profile_photo_url);
        $data['logo'] = domPdfImageUrl($data['setting']?->dark_logo);

        if ($request->download) {

            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ])->loadView('transaction-invoice-download', $data);

            return $pdf->stream();
        }

        return view('transaction-invoice', $data);
    }

    /**
     * Invoice Send Via Email.
     *
     * @param  object  $invoice
     * @return \Illuminate\Http\Response
     */
    public function sendViaEmail(Invoice $invoice, SendMailInvoiceService $sendMailInvoiceService)
    {
        abort_if(! userCan('invoice.print'), 403);

        $sendMailInvoiceService->send($invoice);

        $this->flashSuccess('Invoice sent via email ');

        return back();
    }

    /**
     * Recurring Invoice Recurring Status On Off.
     *
     * @param  object  $invoice
     * @return \Illuminate\Http\Response
     */
    public function invoiceRecurringStatus(Request $request, Invoice $invoice)
    {
        abort_if(! userCan('invoice.edit'), 403);

        $status = $request->status;

        $invoice->update([
            'recurring_status' => $status,
        ]);

        $this->flashSuccess('Recurring Status Updated');

        return back();
    }
}
