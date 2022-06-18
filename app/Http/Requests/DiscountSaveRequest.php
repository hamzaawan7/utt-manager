<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountSaveRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => 'required',
            'code_type' => 'required',
            'value' => 'required',
            'expiry_date' => 'required',
            'email' => 'required',
            'holiday_start_after' => 'required',
            'holiday_must_start_by' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'code.required' => 'This field is reuired',
            'code_type.required' => 'This field is reuired',
            'value.required' => 'This field is reuired',
            'expiry_date.required' => 'This field is reuired',
            'property.required' => 'This field is reuired',
            'holiday_start_after.required' => 'This field is reuired',
            'holiday_must_start_by.required' => 'This field is reuired',
        ];
    }
}
