<?php

namespace App\Http\Requests\Role;

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
            'nama_role' => ['required', 'string', 'unique:roles,name,' . $this->route('id')],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_role.required' => "Role name cannot be empty",
            'nama_role.unique' => "Role name already exists",
        ];
    }
}