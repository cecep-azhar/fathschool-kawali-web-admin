<?php

namespace App\Http\Requests\Admin\Language;

use Illuminate\Foundation\Http\FormRequest;

class LanguageCreateRequest extends FormRequest
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
            'name' => 'required|unique:languages,name',
            'code' => 'required|unique:languages,code',
            'direction' => 'required',
        ];
    }

    /**
     * Get the validation messages for a language
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => 'You must select a language',
            'code.required' => 'You must select a language code',
            'direction.required' => 'You must select a direction',
            'name.unique' => 'This language already exists',
            'code.unique' => 'This code already exists',
        ];
    }
}
