<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'f_name'    => 'required|string',
            'l_name'    => 'required|string',
            'email'     => 'required|email',
            'subject'   => 'required|string|min:4',
            'message'   => 'required|string|max:500',
        ];
    }
}
