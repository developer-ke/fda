<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFoundDocumentsRequest extends FormRequest
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
            "document_type_id" => 'required|integer',
            "document_serial_number" => 'required|unique:found_documents,serialNumber',
            "institution_on_doc" => 'nullable',
            "country_id" => 'integer|required',
            "latitude" => 'required|numeric',
            "longitude" => 'required|numeric',
            "coordinates" => 'required',
            "Owners_first_name" => 'required|string',
            "Owners_last_name" => 'required|string',
            "email_address" => 'email|required',
            "fcountrycode" => 'required',
            "phone_number" => 'required',
            "ffirst_name" => 'required|string',
            "flast_name" => 'required|string',
            'g-recaptcha-response' => 'required',

        ];
    }
}