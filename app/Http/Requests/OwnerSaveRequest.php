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
        $pass='required|confirmed';
        if($request->owner_id)
        {
            $pass='';
        }
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' .$request->owner_id,
            'address' => 'required',
            'phone' => 'required|numeric',
            'password' => $pass,
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
