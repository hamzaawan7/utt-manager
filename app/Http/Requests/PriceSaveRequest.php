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
            'price_category_id' => 'required',
            'type_id' => 'required',
            'price_seven_night' => 'required|numeric',
            'price_monday_to_friday' => 'required|numeric',
            'price_friday_to_monday' => 'required|numeric',
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
            'price_seven_night.required' => 'This field is required',
            'price_monday_to_friday.required' => 'This field is required',
            'price_friday_to_monday.required' => 'This field is required',
        ];
    }
}
