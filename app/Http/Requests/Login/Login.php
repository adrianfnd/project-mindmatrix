<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
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
            'email' => ['required','string','exists:users,email'],
            'password'=>['required','string','min:8'],
        ];
    }
    public function messages(): array
    {
        return[
            'email.required' => "email tidak boleh kosong",
            'email.exists' => "email tidak boleh kosong",
        ];
    }
}
