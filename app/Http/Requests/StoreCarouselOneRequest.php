<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarouselOneRequest extends FormRequest
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
            'header' => 'required|string|unique:carousel_ones,header',
            'header_color' => 'required|string',
            'body_text' => 'required|string',
            'body_text_color' => 'required|string',
            'btn_text' => 'required|string|unique:carousel_ones,btn_text',
            'btn_text_color' => 'required|string',
            'url' => 'required|string|unique:carousel_ones,url',
            'btn_bg' => 'required|string|unique:carousel_ones,btn_bg',
            'div_bg' => 'required|string|unique:carousel_ones,div_bg',
            'image' => 'required|image|unique:carousel_ones,image|mimes:png,jpg,webp,jpeg|max:2048',
        ];
    }
}
