<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class BasicSettingUpdateRequest extends FormRequest
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
            'app_name' => 'required|string',
            'dark_logo' => 'sometimes|nullable|mimes:svg,jpeg,png,gif',
            'light_logo' => 'sometimes|nullable|mimes:svg,jpeg,png,gif',
            'favicon' => 'sometimes|nullable|mimes:ico,jpeg,png',
            'app_email' => 'required|email',
        ];
    }
}
