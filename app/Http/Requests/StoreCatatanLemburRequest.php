<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCatatanLemburRequest extends FormRequest
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
            'tanggal' => 'required|date|before_or_equal:today',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();
            $tanggal = $data['tanggal'] ?? null;
            $jamMasuk = $data['jam_masuk'] ?? null;
            $jamKeluar = $data['jam_keluar'] ?? null;

            if ($tanggal && $jamMasuk && $jamKeluar) {
                $masuk = new \DateTime($tanggal . ' ' . $jamMasuk);
                $keluar = new \DateTime($tanggal . ' ' . $jamKeluar);

                // If jam_keluar is before or equal to jam_masuk, assume it might be next day
                if ($keluar <= $masuk) {
                    $keluar->add(new \DateInterval('P1D'));
                }

                // Now check if keluar is after masuk
                if ($keluar <= $masuk) {
                    $validator->errors()->add('jam_keluar', 'Jam keluar harus setelah jam masuk.');
                }
            }
        });
    }
    public function messages(): array
    {
        return [

            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'tanggal.before_or_equal' => 'Tanggal tidak boleh lebih dari hari ini.',
            'jam_masuk.required' => 'Jam masuk harus diisi.',
            'jam_masuk.date_format' => 'Format jam masuk tidak valid.',
            'jam_keluar.required' => 'Jam keluar harus diisi.',
            'jam_keluar.date_format' => 'Format jam keluar tidak valid.',
            'jam_keluar.after' => 'Jam keluar harus setelah jam masuk.',
        ];
    }
}
