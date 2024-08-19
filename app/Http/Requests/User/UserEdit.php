<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEdit extends FormRequest
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
            'id_user' => ['required', 'exists:biodatas,id'],
            'email' => ['required', 'email'],
            'nama_lengkap' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date_format:Y-m-d'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_user.required' => ['ID pengguna tidak boleh kosong'],
            'id_user.exists' => ['ID pengguna tidak valid'],
            'email.required' => ['Email tidak boleh kosong'],
            'email.email' => ['Inputan harus berupa email'],
            'email.unique' => ['Email sudah digunakan'],
            'nama_lengkap.required' => ['Nama lengkap tidak boleh kosong'],
            'tanggal_lahir.required' => ['Tanggal lahir tidak boleh kosong'],
            'tanggal_lahir.date_format' => ['Tanggal lahir harus berformat Y-m-d'],
        ];
    }
}