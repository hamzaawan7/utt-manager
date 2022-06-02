<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'main_contact_name' => 'required',
            'main_contact_number' => 'required',
            'secondary_contact_name' => 'required',
            'secondary_contact_number' => 'required',
            'emergency_contact_name' => 'required',
            'emergency_contact_number' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'This field is reuired',
            'email.required' => 'This field is reuired',
            'address.required' => 'This field is reuired',
            'main_contact_name.required' => 'This field is reuired',
            'main_contact_number.required' => 'This field is reuired',
            'secondary_contact_name.required' => 'This field is reuired',
            'secondary_contact_number.required' => 'This field is reuired',
            'emergency_contact_name.required' => 'This field is reuired',
            'emergency_contact_number.required' => 'This field is reuired',
        ];
    }
}
