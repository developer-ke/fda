<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorelostDocumentsRequest extends FormRequest
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
            "document_serial_number" => 'required|string|min:6|unique:lost_documents,serialNumber',
            "institution_on_doc" => 'nullable|string',
            "country_id" => 'required|integer',
            "locationLost" => 'string|required',
            "police_refNo" => 'nullable|min:3',
            "fname" => 'required|string|min:4',
            "lname" => 'required|string|min:4',
            "email_address" => 'required|email',
            "lcountrycode" => 'required',
            "lphone_number" => 'required',
            "return_address" => 'required',
        ];
    }
}
