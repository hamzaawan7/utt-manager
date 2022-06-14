<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class OwnerSaveRequest extends FormRequest
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
            'email' => 'required|unique:users,email,' .$request->owner_id,
            'address' => 'required|string|max:255',
            'main_contact_name' => 'required|string|max:255',
            'main_contact_number' => 'required|numeric',
            'secondary_contact_name' => 'required|string|max:255',
            'secondary_contact_number' => 'required|numeric',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_number' => 'required|numeric',
            /*'cleaning_rota_receipts' => 'required|email',*/
            'bank_account_number' => 'required|numeric',
            'bank_account_short_code' => 'required|numeric',
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
