<?php

namespace App\Http\Requests\Universitas;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'filename' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => ['required','string','unique:universitas,nama_kampus'],
            'akreditasi' => ['required','string'],
            'alamat' => ['required'],
            'jurusan' => ['required','array','max:1'],
            'jurusan.*' => ['required','exists:jurusan_universitas,id'],
        ];
    }
}
