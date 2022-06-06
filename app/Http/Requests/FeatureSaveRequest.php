<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class FeatureSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request): array
    {
        return [
            'feature_name' => 'required|string|unique:features,feature_name,'.$request->feature_id,
            'minimum_nights' => 'required|numeric',
            'check_in_time' => 'required',
            'check_out_time' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'feature_name.required' => 'This field is reuired',
            'minimum_nights.required' => 'This field is reuired',
            'check_in_time.required' => 'This field is reuired',
            'check_out_time.required' => 'This field is reuired',
        ];
    }
}
