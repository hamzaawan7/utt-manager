<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerBookingSaveRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'from_date' => 'required',
            'to_date' => 'required',
            'reason' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'from_date.required' => 'This field is required',
            'to_date.required' => 'This field is required',
            'reason.required' => 'This field is required',
        ];
    }
}
