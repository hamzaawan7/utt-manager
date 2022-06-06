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
            'season_name' => 'required|string|max:255',
            'from_date' => 'required',
            'to_date' => 'required',
        ];
    }
}
