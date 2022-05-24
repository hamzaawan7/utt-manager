<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyCategorySaveRequest extends FormRequest
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
            'standard_guests' => 'required',
            'minimum_guest' => 'required',
            'room_layouts' => 'required',
            'childs' => 'required',
            'infants' => 'required',
            'pets' => 'required',
        ];
    }
}
