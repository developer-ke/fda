<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateinstitutionRequest extends FormRequest
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
        $id = $this->route("institution_id");
        return [
            'name' => 'required|string|min:4|unique:institutions,name,' . $id,
            'country' => 'required|integer',
            'phoneNumber' => 'required|numeric|min:10|unique:institutions,phoneNumber,' . $id,
            'altPhoneNumber' => 'numeric|nullable|min:10|unique:institutions,phoneNumber,' . $id,
            'email' => 'required|email|unique:institutions,email,' . $id,
            'address' => 'required',
            'location' => 'required|string',
            'correspondent' => 'required|integer|unique:institutions,correspondet_id,' . $id,
            'latitude' => 'required|numeric|unique:institutions,latitude,' . $id,
            'longitude' => 'required|numeric|unique:institutions,longitude,' . $id,
            'image' => 'nullable|image|unique:institutions,logo,' . $id . '|mimes:png,jpg,webp,jpeg|max:2048',
        ];

    }
}
