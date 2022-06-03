<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyCategorySaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'category_name' => 'required|string|max:255',
            'standard_guests' => 'required|numeric',
            'minimum_guest' => 'required|numeric',
            'room_layouts' => 'required',
            'childs' => 'required|numeric',
            'infants' => 'required|numeric',
            'pets' => 'required|numeric',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'category_name.required' => 'This field is reuired',
            'standard_guests.required' => 'This field is reuired',
            'minimum_guest.required' => 'This field is reuired',
            'room_layouts.required' => 'This field is reuired',
            'childs.required' => 'This field is reuired',
            'infants.required' => 'This field is reuired',
            'pets.required' => 'This field is reuired',
        ];
    }
}
