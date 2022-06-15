<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
           /* 'price_category_id' => 'required',
            'type_id' => 'required',*/
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'price_category_id.required' => 'This field is required',
            'type_id.required' => 'This field is required',
        ];
    }
}
