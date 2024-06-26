<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('transaction-type.index'), 403);

        $types = TransactionType::latest()->paginate(15)->onEachSide(-1);

        return inertia('Accountant/Transaction/Type/Index', [
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(! userCan('transaction-type.create'), 403);

        // validate form data
        $request->validate([
            'type' => 'required',
            'name' => 'required|max:132|unique:transaction_types,name',
        ]);

        // data store after validate
        TransactionType::create([
            'type' => $request->type,
            'name' => $request->name,
        ]);

        // return response
        $this->flashSuccess('Type saved !');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionType $transaction_type)
    {
        abort_if(! userCan('transaction-type.edit'), 403);

        // validate form data
        $request->validate([
            'name' => 'required',
            'name' => 'required|max:132|unique:transaction_types,name,'.$transaction_type->id,
        ]);

        // data store after validate
        $transaction_type->update([
            'type' => $request->type,
            'name' => $request->name,
        ]);

        // return response
        $this->flashSuccess('Type updated !');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionType $transaction_type)
    {
        abort_if(! userCan('transaction-type.destroy'), 403);

        // data destroy
        $transaction_type->delete();

        // return response
        $this->flashSuccess('Type deleted !');

        return back();
    }
}
