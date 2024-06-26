<?php

namespace App\Http\Requests\Admin\ClassRoutine;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoutineCreateRequest extends FormRequest
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
            'class' => 'required|integer',
            'teacher' => 'required|integer',
            'subject' => 'required|integer',
            'weekday' => 'required|integer|min:0|max:7',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ];
    }
}
