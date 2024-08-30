<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarouselOneRequest extends FormRequest
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
        $id = $this->route('advert_id'); // Assuming this retrieves the ID of the record being updated
        return [
            'header' => 'required|string|unique:carousel_ones,header,' . $id,
            'header_color' => 'required|string',
            'body_text' => 'required|string',
            'body_text_color' => 'required|string',
            'btn_text' => 'required|string|unique:carousel_ones,btn_text,' . $id,
            'btn_text_color' => 'required|string',
            'url' => 'required|string|unique:carousel_ones,url,' . $id,
            'btn_bg' => 'required|string|unique:carousel_ones,btn_bg,' . $id,
            'div_bg' => 'required|string|unique:carousel_ones,div_bg,' . $id,
            'image' => 'image|nullable|unique:carousel_ones,image,' . $id . '|mimes:png,jpg,webp,jpeg|max:2048',
        ];
    }
}
