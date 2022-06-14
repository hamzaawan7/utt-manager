<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class PropertyCategorySaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return string[]
     */
    public function rules(Request $request): array
    {
        return [
            'category_name' => 'required|string|unique:categories,category_name,'.$request->category_id,
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'category_name.required' => 'This field is reuired',
        ];
    }
}
