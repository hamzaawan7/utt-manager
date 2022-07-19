<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request): array
    {
        $pass='required|confirmed';
        if($request->user_id)
        {
            $pass='';
        }
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => $pass,
            'role' => 'required',
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
            'password.required' => 'This field is reuired',
        ];
    }
}
