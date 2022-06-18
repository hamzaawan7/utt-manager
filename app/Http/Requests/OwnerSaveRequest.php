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
            'email' => 'required|unique:owners,email,' .$request->owner_id,
            'address' => 'required',
            'phone' => 'required|numeric',
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
            'phone.required' => 'This field is reuired',
        ];
    }
}
