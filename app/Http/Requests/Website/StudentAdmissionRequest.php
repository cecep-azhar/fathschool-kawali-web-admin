<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class StudentAdmissionRequest extends FormRequest
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
            'name' => admissionFieldIsActive('name') ? 'required|max:255' : '',
            'email' => admissionFieldIsActive('email') ? 'required|email|max:255|unique:users,email|unique:admission_requests,email' : '',
            'classes' => admissionFieldIsActive('course') ? 'required' : '',
            'parent_name' => admissionFieldIsActive('guardian_name') ? 'required' : '',
            'parent_email' => admissionFieldIsActive('guardian_email') ? 'required|email|max:255|unique:admission_requests,guardian_email' : '',
            'date_of_birth' => admissionFieldIsActive('guardian_email') ? 'required|date' : '',
            'gender' => admissionFieldIsActive('gender') ? 'required' : '',
        ];
    }
}
