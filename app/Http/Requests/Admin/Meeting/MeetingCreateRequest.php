<?php

namespace App\Http\Requests\Admin\Meeting;

use Illuminate\Foundation\Http\FormRequest;

class MeetingCreateRequest extends FormRequest
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
            'topic' => 'required|string|min:2|max:160',
            'start_date' => 'required|date',
            'password' => 'required|max:9', //zoom password max length is 10
            'participants' => $this->all_user ? '' : 'required',
        ];
    }
}
