<?php

namespace App\Http\Requests\Accountant;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'invoice_number' => "required|unique:invoices,invoice_no,{$this->invoice->id}",
            'date' => 'required',
            'due_date_in' => 'required',
            'amount' => 'required',
            'user' => 'required',
        ];
    }
}
