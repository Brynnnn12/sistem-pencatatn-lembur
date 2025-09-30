<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $nik
 * @property string $email
 * @property string $password
 * @property string $nama
 * @property string|null $phone
 * @property int $departemen_id
 * @property int $jabatan_id
 */
class StoreKaryawanRequest extends FormRequest
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
            'nik' => 'required|integer|unique:users,nik',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'nama' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'departemen_id' => 'required|exists:departemens,id',
            'jabatan_id' => 'required|exists:jabatans,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nik.required' => 'NIK harus diisi.',
            'nik.integer' => 'NIK harus berupa angka.',
            'nik.unique' => 'NIK sudah digunakan.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nama.required' => 'Nama karyawan harus diisi.',
            'nama.string' => 'Nama karyawan harus berupa teks.',
            'nama.max' => 'Nama karyawan tidak boleh lebih dari 255 karakter.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'departemen_id.required' => 'Departemen harus dipilih.',
            'departemen_id.exists' => 'Departemen yang dipilih tidak valid.',
            'jabatan_id.required' => 'Jabatan harus dipilih.',
            'jabatan_id.exists' => 'Jabatan yang dipilih tidak valid.',
        ];
    }
}
