<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerBookingSaveRequest extends FormRequest
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
            'from_date.required' => 'This field is reuired',
            'to_date.required' => 'This field is reuired',
            'first_name.required' => 'This field is reuired',
            'last_name.required' => 'This field is reuired',
            'email.required' => 'This field is reuired',
            'guest.required' => 'This field is reuired',
        ];
    }
}
