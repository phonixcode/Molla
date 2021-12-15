<?php

namespace App\Http\Requests;

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
     * @return array
     */
    public function rules()
    {
        return [
            'full_name'     => 'required|string',
            'username'      => 'nullable|string',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:4',
            'phone'         => 'nullable|string',
            'photo'         => 'required',
            'address'       => 'nullable|string',
            'role'          => 'required|in:admin,customer,seller',
            'status'        => 'required|in:active,inactive',
        ];
    }
}
