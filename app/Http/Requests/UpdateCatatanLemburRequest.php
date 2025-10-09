<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCatatanLemburRequest extends FormRequest
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
            'tanggal' => 'sometimes|date|after_or_equal:today',
            'jam_masuk' => 'sometimes|date_format:H:i',
            'jam_keluar' => 'sometimes|date_format:H:i|after:jam_masuk',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'tanggal.date' => 'Format tanggal tidak valid.',
            'tanggal.after_or_equal' => 'Tanggal tidak boleh sebelum hari ini.',
            'jam_masuk.date_format' => 'Format jam masuk tidak valid.',
            'jam_keluar.date_format' => 'Format jam keluar tidak valid.',
            'jam_keluar.after' => 'Jam keluar harus setelah jam masuk.',
        ];
    }
}
