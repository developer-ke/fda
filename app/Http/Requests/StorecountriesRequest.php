<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorecountriesRequest extends FormRequest
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
            'code' => 'required|min:2|unique:countries,code',
            'abbreviation' => 'required|string|min:2|unique:countries,abbreviation',
            'countryName' => 'required|string|min:3|unique:countries,name',
            'nationality' => 'required|string|min:3|unique:countries,nationality',
            'city' => 'required|string|min:2|unique:countries,city',
        ];
    }
}
