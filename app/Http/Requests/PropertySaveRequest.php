<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertySaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'owner_name' => 'required',
            'short_code' => 'required|numeric',
            'category_name' => 'required',
            'feature_name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'post_code' => 'required|numeric',
            'special_category' => 'required',
            'is_visible' => 'required',
            'standard_guests' => 'required|numeric',
            'minimum_guest' => 'required|numeric',
            'room_layouts' => 'required',
            'check_in_time' => 'required',
            'check_out_time' => 'required',
            'minimum_nights' => 'required|numeric',
            'childs' => 'required|numeric',
            'infants' => 'required|numeric',
            'pets' => 'required|numeric',
            'season_id' => 'required',
            'special_start_days' => 'required',
            'price_category_id' => 'required',
            'bank_account_number' => 'required|numeric',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'This field is reuired',
            'nearby_property.required' => 'This field is reuired',
            'owner_name.required' => 'This field is reuired',
            'short_code.required' => 'This field is reuired',
            'category_name.required' => 'This field is reuired',
            'feature_name.required' => 'This field is reuired',
            'phone.required' => 'This field is reuired',
            'address.required' => 'This field is reuired',
            'post_code.required' => 'This field is reuired',
            'special_category.required' => 'This field is reuired',
            'is_visible.required' => 'This field is reuired',
        ];
    }
}
