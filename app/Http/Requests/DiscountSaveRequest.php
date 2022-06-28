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
            'reason' => 'required',
            'property_id' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'code.required' => 'This field is required',
            'code_type.required' => 'This field is required',
            'value.required' => 'This field is required',
            'expiry_date.required' => 'This field is required',
            'property.required' => 'This field is required',
            'holiday_start_after.required' => 'This field is required',
            'holiday_must_start_by.required' => 'This field is required',
            'reason.required' => 'This field is required',
            'property_id.required' => 'This field is required',
        ];
    }
}
