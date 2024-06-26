<?php

namespace App\Http\Controllers\Transaction;

use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionsUserResource;
use App\Models\Currency;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Transaction\TransactionService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!userCan('transaction.index'), 403);

        $user = authUser();

        if ($user->role == 'Student' || $user->role == 'Parent') {

            if ($user->role == 'Parent' || session()->get('children_view') != null) {
                $user = User::find(session()->get('children_view'));
            }

            $data = (new TransactionService)->studentFees($request, $user);

            return inertia('Accountant/Transaction/List/AllTransaction', $data);
        } else {

            $data = (new TransactionService)->index($request);

            return inertia('Accountant/Transaction/List/AllTransaction', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!userCan('transaction.create'), 403);

        $types = TransactionType::latest()->get(['id', 'name', 'type']);
        $currencies = Currency::latest()->get();
        $users = TransactionsUserResource::collection(User::active()->student()->latest()->get(['id', 'name', 'email']));

        return inertia('Accountant/Transaction/List/Form', [
            'types' => $types,
            'users' => $users,
            'currencies' => $currencies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!userCan('transaction.create'), 403);

        // validate form data
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'date' => 'required',
            'status' => 'required',
            'currency'=> 'required',
            'document' => 'sometimes|nullable|mimes:pdf,doc,docx,zip,jpeg,png',
        ]);

        $type = $this->transactionCategoryStore($request->category_type, $request->type);

        if ($request->status == "paid") {
            $paid_amount = $request->amount;
        } else {
            $paid_amount = 0;
        }

        // data store after validate
        $transaction = Transaction::create([
            'transaction_no' => 'TRN_' . time(),
            'transaction_type_id' => $type,
            'title' => $request->title,
            'user_id' => $request->particular,
            'amount' => $request->amount,
            'paid_amount' => $paid_amount,
            'currency' => $request->currency,
            'date' => Carbon::parse($request->date),
            'due_date' => Carbon::parse($request->due_date) ?? null,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        // for document upload
        if ($request->hasFile('document')) {

            $url = FileUpload::uploadImage($request->document, 'document');
            $transaction->update([
                'document' => $url,
            ]);
        }

        $transaction->load('type');
        $type = $transaction->type->type;
        $this->flashSuccess(ucfirst($type) . ' item saved !');

        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Transaction $transaction)
    {
        abort_if(!userCan('transaction.show'), 403);

        $data['user'] = $transaction->user;
        $data['setting'] = Setting::first(['app_name', 'dark_logo', 'light_logo', 'app_email', 'app_phone']);
        $data['transaction'] = $transaction;
        $data['invoice_view'] = false;

        $amount = $transaction->amount;
        $currency = $transaction->currency ?? config('templatecookie.currency');

        session(['transaction_info' => [
            'pay_amount' => $amount,
            'transaction_id' => $transaction->id,
        ]]);

        // Convert to Default Currency
        session(['stripe_amount' => currencyConversion($amount, $transaction->currency, 'USD') * 100]);
        session(['razor_amount' => currencyConversion($amount, $transaction->currency, 'INR', 1) * 100]);

        // midtrans snap token
        if (config('templatecookie.midtrans_active') && config('templatecookie.midtrans_merchant_id') && config('templatecookie.midtrans_client_key') && config('templatecookie.midtrans_server_key')) {
            // $usd = $plan->price;
            $fromRate = Currency::whereCode($currency)->first()->rate;
            $toRate = Currency::whereCode('IDR')->first()->rate;
            $rate = $fromRate / $toRate;
            $convertedPaidAmount = (int) round($amount / $rate, 2);


            $order['order_no'] = uniqid();
            $order['total_price'] = $amount;

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
        }

        session(['invoice_download_url' => route('transaction.details', $transaction->transaction_no)]);

        $data['mid_token'] = $snapToken ?? null;
        $data['transaction_info'] = session('transaction_info');

        $data['user_avatar'] = null ;
        $data['logo'] = null;

        if ($request->download) {

            // $pdf = PDF::setOptions([
            //     'isHtml5ParserEnabled' => true,
            //     'isRemoteEnabled' => true
            // ])->loadView('transaction-invoice-download', $data);

            // return $pdf->stream();

            $user = $transaction->user;
            $data['setting'] = Setting::first(['app_name', 'dark_logo', 'light_logo', 'app_email', 'app_phone']);
            $data['transaction'] = $transaction;
            $data['invoice_view'] = false;
            $data['transaction_info'] = session('transaction_info');
            $settings = Setting::first();
            $pdf = Pdf::loadView('export.new.transaction_report', compact('data', 'user', 'settings'));

            return $pdf->download($data['user']->name . "'s_" . $transaction->date . '_transaction_report.pdf');
        }

        return view('transaction-invoice', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        abort_if(!userCan('transaction.edit'), 403);

        $transaction->load('type:id,type');

        $types = TransactionType::latest()->get(['id', 'name', 'type']);
        $users = TransactionsUserResource::collection(User::student()->latest()->active()->get(['id', 'name', 'email']));
        $currencies = Currency::latest()->get();

        return inertia('Accountant/Transaction/List/Form', [
            'types' => $types,
            'transaction' => $transaction,
            'users' => $users,
            'currencies' => $currencies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAsPaid(Request $request, Transaction $transaction)
    {
        abort_if(!userCan('transaction.edit'), 403);

        $transaction->update([
            'status' => 'paid',
            'paid_amount' => $transaction->amount,
        ]);

        $this->flashSuccess('Item mask as paid success !');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        abort_if(!userCan('transaction.edit'), 403);

        $transaction->load('type');

        // validate form data
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'particular' => $request->category_type == 'income' ? 'required' : '',
            'status' => 'required',
            'document' => 'sometimes|nullable|mimes:pdf,doc,docx,zip,jpeg,png,',
        ], [
            'particular.required' => 'The user field is required.',
        ]);

        $type = $this->transactionCategoryStore($request->category_type, $request->type);

        // data store after validate
        $transaction->update([
            'transaction_type_id' => $type,
            'title' => $request->title,
            'user_id' => $request->particular,
            'amount' => $request->amount,
            'paid_amount' => $request->paid_amount,
            'date' => Carbon::parse($request->date),
            'due_date' => Carbon::parse($request->due_date) ?? null,
            'status' => $request->status ? 'paid' : 'unpaid',
            'description' => $request->description,
            'currency' => $request->currency,
        ]);

        // for document upload
        if ($request->hasFile('document')) {
            // delete old one
            FileDelete::deleteImage($transaction->document);

            $url = FileUpload::uploadImage($request->document, 'document');
            $transaction->update([
                'document' => $url,
            ]);
        }

        $type = $transaction->type->type;
        $this->flashSuccess(ucfirst($type) . ' item updated !');

        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        abort_if(!userCan('transaction.destroy'), 403);

        $transaction->load('type');

        // data destroy
        FileDelete::deleteImage($transaction->document);
        $transaction->delete();

        $type = $transaction->type->type;

        // $this->flashSuccess(ucfirst($type) . ' item deleted from list !');

        $this->flashSuccess('Transaction deleted');

        return back();
    }

    /**
     * Create Transaction Category If Item Not Exist.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function transactionCategoryStore($type, $item)
    {
        $item_exist = TransactionType::where('id', $item)->orWhere('name', $item)->first();

        if (!$item_exist) {
            $category = TransactionType::create([
                'type' => $type,
                'name' => $item,
            ]);

            return $category->id;
        } else {
            return $item_exist->id;
        }
    }
}
