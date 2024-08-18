<?php

namespace App\Http\Requests\Summary;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'id' => ['required','exists:pilihan_summaries,id'],
            'nama' => ['nullable','string','unique:pilihan_summaries,nama_bakat'],
            'keterangan' =>['nullable'],
            // belum beres jurusan belum masuk 
        ];
    }
    public function messages(): array
    {
        return [
            'id.required' => ['id tidak boleh kosong'],
            'id.exists' => ['id tidak boleh kosong'],
            'nama.string' => ['nama harus bertipe data string'],
            'nama.unique' => ['nama tidak boleh kosong'],
        ];
    }
}
