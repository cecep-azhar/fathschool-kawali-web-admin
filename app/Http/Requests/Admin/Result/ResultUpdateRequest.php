<?php

namespace App\Http\Requests\Admin\Result;

use Illuminate\Foundation\Http\FormRequest;

class ResultUpdateRequest extends FormRequest
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
            'exam' => 'required',
            'class' => 'required',
            'session' => 'required',
            'document' => 'sometimes|nullable|mimes:pdf,doc,docx,zip,jpeg,png',
        ];
    }
}
