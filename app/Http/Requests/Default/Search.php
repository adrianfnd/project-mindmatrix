<?php

namespace App\Http\Requests\Default;

use Illuminate\Foundation\Http\FormRequest;

class Search extends FormRequest
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
            'search' => ['nullable','string'],
            'limit_per_page' => ['required','numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'limit_per_page.required' => "limit_per_page tidak boleh kosong",
            'limit_per_page.numeric' => "limit_per_page bertipe data angka",
        ];
    }

}
