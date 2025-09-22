<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersetujuanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization will be handled by policy in controller
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'catatan_lembur_id' => 'required|exists:catatan_lemburs,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:disetujui,ditolak',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'catatan_lembur_id.required' => 'Catatan lembur harus dipilih.',
            'catatan_lembur_id.exists' => 'Catatan lembur yang dipilih tidak valid.',
            'user_id.required' => 'User harus dipilih.',
            'user_id.exists' => 'User yang dipilih tidak valid.',
            'status.required' => 'Status persetujuan harus dipilih.',
            'status.in' => 'Status persetujuan tidak valid.',
        ];
    }
}
