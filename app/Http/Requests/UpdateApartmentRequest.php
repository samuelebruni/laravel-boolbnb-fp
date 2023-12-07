<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class UpdateApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->apartment?->user_id === Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'name' => ['required', 'min:3', 'max:50', Rule::unique('apartments')->ignore($this->apartment)],
            'description' => 'nullable|min:2|max:500',
            'services' => 'nullable|exists:services,id',
            'cover_image' => 'nullable',
            'latitude' => 'required',
            'longitude' => 'required',
            'rooms' => 'nullable',
            'bedrooms' => 'nullable',
            'bathrooms' => 'nullable',
            'beds' => 'nullable',
            'mq' => 'nullable',
            'max_guests' => 'nullable',
            'smokers' => 'nullable',
            'visible' => 'required',
        ];
    }
}