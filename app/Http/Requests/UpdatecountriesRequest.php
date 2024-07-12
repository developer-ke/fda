<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatecountriesRequest extends FormRequest
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
        $countryId = $this->route('countryId');
        return [
            'code' => 'required|min:2|unique:countries,code,' . $countryId,
            'abbreviation' => 'required|string|min:2|unique:countries,abbreviation,' . $countryId,
            'countryName' => 'required|string|min:3|unique:countries,name,' . $countryId,
            'nationality' => 'required|string|min:3|unique:countries,nationality,' . $countryId,
            'city' => 'required|string|min:2|unique:countries,city,' . $countryId,
        ];
    }
}
