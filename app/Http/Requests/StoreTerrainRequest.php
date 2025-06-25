<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTerrainRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'area_size' => 'required|numeric|min:0',
            'price_per_day' => 'required|numeric|min:0',
            'available_from' => 'nullable|date',
            'available_to' => 'nullable|date|after_or_equal:available_from',
            'main_image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048'
        ];
    }
}
