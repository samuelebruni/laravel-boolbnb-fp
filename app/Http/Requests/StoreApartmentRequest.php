<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'description' => 'nullable',
            'services' => 'nullable|exists:services,id',
            'cover_image' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'rooms' => 'nullable',
            'bedrooms' => 'nullable',
            'bathrooms' => 'nullable',
            'beds' => 'nullable',
            'mq' => 'nullable',
            'max_guests' => 'nullable',
            'smokers' => 'nullable',
            'visible' => 'nullable',
        ];
    }
}