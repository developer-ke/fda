<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreinstitutionRequest extends FormRequest
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
            'name' => 'required|string|min:4|unique:institutions,name',
            'country' => 'required|integer',
            'phoneNumber' => 'required|numeric|min:10',
            'altPhoneNumber' => 'numeric|nullable|min:10',
            'email' => 'required|email|unique:institutions,email',
            'address' => 'required',
            'location' => 'required|string',
            'correspondent' => 'required|integer',
            'latitude' => 'required|numeric|unique:institutions,latitude',
            'longitude' => 'required|numeric|unique:institutions,longitude',
            'image' => 'required|image|unique:institutions,logo|mimes:png,jpg,webp,jpeg|max:2048',
            "g-recaptcha-response" => 'required'
        ];
    }
}