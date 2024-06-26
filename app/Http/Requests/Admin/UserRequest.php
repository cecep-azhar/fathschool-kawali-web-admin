<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        if ($this->method() == 'POST') {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'nullable|min:6',
                'user_type' => 'required',
                'parents' => $this->user_type == 'Student' ? 'required|array|min:1' : '',
                'courses' => $this->user_type == 'Student' ? 'required|array|min:1' : '',
                'plan' => $this->user_type == 'Student' ? 'required|' : '',
                'subjects' => $this->user_type == 'Teacher' ? 'required' : '',
            ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$this->user->id,
                'user_type' => 'required',
                'avatar' => 'nullable|image',
                // student
                'parents' => $this->user_type == 'Student' ? 'required|array|min:1' : '',
                'courses' => $this->user_type == 'Student' ? 'required|array|min:1' : '',
            ];
        }
    }
}
