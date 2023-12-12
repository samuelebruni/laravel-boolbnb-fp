<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'name' => 'required|min:3|max:50',
            'description' => 'nullable|min:2|max:500',
            'services' => 'nullable|exists:services,id',
            'images' => 'nullable|array',
            'cover_image' => 'nullable',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'municipality' => 'nullable',
            'rooms' => 'nullable|max:3',
            'bedrooms' => 'nullable|max:3',
            'bathrooms' => 'nullable|max:3',
            'beds' => 'nullable|max:3',
            'mq' => 'nullable|max:4',
            'max_guests' => 'nullable|max:2',
            'smokers' => 'nullable',
            'visible' => 'required',
        ];
    }
}