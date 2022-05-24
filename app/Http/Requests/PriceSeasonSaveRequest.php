<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceSeasonSaveRequest extends FormRequest
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
            'type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ];
    }
}
