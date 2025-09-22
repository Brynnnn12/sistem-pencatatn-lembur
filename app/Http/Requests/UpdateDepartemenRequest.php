<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartemenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Nama departemen harus diisi.',
            'name.string' => 'Nama departemen harus berupa teks.',
            'name.max' => 'Nama departemen tidak boleh lebih dari 50 karakter.',
        ];
    }
}
