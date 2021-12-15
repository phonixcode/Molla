<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title'                 => 'string|required',
            'summary'               => 'string|required',
            'description'           => 'string|nullable',
            'additional_info'       => 'string|nullable',
            'return_cancellation'   => 'string|nullable',
            'stock'                 => 'nullable|numeric',
            'price'                 => 'nullable|numeric',
            'discount'              => 'nullable|numeric',
            'photo'                 => 'required',
            'size_guide'            => 'nullable',
            'cat_id'                => 'required|exists:categories,id',
            'child_cat_id'          => 'nullable|exists:categories,id',
            'size'                  => 'nullable',
            'condition'             => 'nullable',
            'status'                => 'nullable|in:active,inactive',
        ];
    }
}
