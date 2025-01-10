<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDrawersRequest extends FormRequest
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
            "firstName" => 'required|string|min:3|alpha',
            "secondName" => 'nullable|string|alpha|min:4',
            "lastName" => 'required|string|min:3|alpha',
            "serialNumber" => 'required|string|unique:drawers,serialNumber',
            "expiryDate" => 'nullable|date|after:date',
            "documentType" => 'required|integer',
            "institution" => 'required|integer',
            "g-recaptcha-response" => 'required'
        ];
    }
}