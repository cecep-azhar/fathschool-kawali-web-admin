<?php

namespace App\Http\Requests\Teacher\Assignment;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentUpdateRequest extends FormRequest
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
            'title' => "required|unique:assignments,title,{$this->assignment->id}",
            'teacher' => 'required',
            'subject' => 'required',
            'class' => 'required',
            'date' => 'required',
            'mark' => 'required',
        ];
    }
}
