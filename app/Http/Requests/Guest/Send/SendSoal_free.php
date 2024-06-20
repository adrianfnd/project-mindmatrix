<?php

namespace App\Http\Requests\Guest\Send;

use Illuminate\Foundation\Http\FormRequest;

class SendSoal_free extends FormRequest
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
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','string','min:8'],
            'nama_lengkap' => ['required','string'],
            'tanggal_lahir' => ['required','date_format:Y-m-d'],
            'pertanyaan' => ['required','array','max:2'],
            'pertanyaan.pertanyaan.*' => ['required','exists:pilihan_jawabans,id'],
            'pertanyaan.jawaban.*'=>['required','in:true,false'],
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => ["email tidak boleh kosong"],
            'email.email' => ["inputan harus berupa email"],
            'email.unique' => ["email tidak boleh kosong"],
            'password.required' => ["password tidak boleh kosong"],
            'password.min' => ["password harus lebih dari 8 angka"],
            'nama_lengkap.required' => ["nama_lengkap tidak boleh kosong"],
            'tanggal_lahir.required' => ['tanggal_lahir tidak boleh kosong'],
            'tanggal_lahir.date' => ["tanggal_lahir harus berupa date yang berformat Y-m-d"],
        ];
    }
}
