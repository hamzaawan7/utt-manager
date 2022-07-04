<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CustomerBookingSaveRequest extends FormRequest
{
    /**
     * @param Request $request
     * @return string[]
     */
    public function rules(Request $request): array
    {
        return [
            'from_date' => 'required',
            'to_date' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'guest' => 'required|numeric',
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
            'first_name.required' => 'This field is required',
            'last_name.required' => 'This field is required',
            'email.required' => 'This field is required',
            'guest.required' => 'This field is required',
        ];
    }
}
