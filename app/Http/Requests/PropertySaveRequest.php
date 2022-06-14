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
            'utt_star_rating' => 'required|numeric',
            'is_visible' => 'required',
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
            'utt_star_rating.required' => 'This field is reuired',
            'is_visible.required' => 'This field is reuired',
            //'main_image.required' => 'This field is reuired',
            //'images.required' => 'This field is reuired',
        ];
    }
}