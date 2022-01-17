<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required|string|max:150'],
            'image' => ['nullable'],
            'point' => ['required|numeric'],
            'price' => ['required|numeric'],
            'category' => ['required|string'],
            'used_duration' => ['required|numeric'],
            'shipping_address' => ['required'],
            'description' => ['required'],
        ];
    }
}
