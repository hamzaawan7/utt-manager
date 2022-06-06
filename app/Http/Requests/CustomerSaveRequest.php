<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CustomerSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' .$request->customer_id,
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'post_code' => 'required|numeric',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'This field is reuired',
            'password.required' => 'This field is reuired',
            'phone.required' => 'This field is reuired',
            'address.required' => 'This field is reuired',
            'post_code.required' => 'This field is reuired',
            'city.required' => 'This field is reuired',
            'country.required' => 'This field is reuired',
        ];
    }
}
