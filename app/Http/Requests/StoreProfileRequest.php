<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
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
            'phoneNumber' => 'required|numeric|unique:profiles,phoneNumber',
            'altPhoneNumber' => 'nullable|numeric|unique:profiles,phoneNumber',
            'country' => 'integer|required',
            'gender' => 'string|required|min:4',
            'dob' => 'date|required',
            'organization' => 'string|required|min:3',
            'address' => 'string|required',

        ];
    }
}