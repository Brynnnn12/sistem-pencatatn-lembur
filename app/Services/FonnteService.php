<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    protected $token;

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    public function sendMessage($phone, $message)
    {

        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => $message,
        ]);

        $result = $response->json();

        return $result;
    }

    public function sendApprovalNotification($persetujuan, $karyawan, $approver, $status)
    {
        if (!$karyawan->phone) {
            return null;
        }

        $appUrl = config('app.url');
        $tanggal = $persetujuan->catatanLembur->tanggal->format('d/m/Y');
        $jamMasuk = $persetujuan->catatanLembur->jam_masuk_formatted;
        $jamKeluar = $persetujuan->catatanLembur->jam_keluar_formatted;

        // Tentukan salam berdasarkan waktu WIB
        $hour = now('Asia/Jakarta')->hour;
        if ($hour >= 5 && $hour < 12) {
            $salam = "Selamat pagi";
        } elseif ($hour >= 12 && $hour < 15) {
            $salam = "Selamat siang";
        } elseif ($hour >= 15 && $hour < 18) {
            $salam = "Selamat sore";
        } else {
            $salam = "Selamat malam";
        }

        $link = $appUrl . "/dashboard/catatan-lembur";

        if ($status === 'disetujui') {
            $message = "{$salam} {$karyawan->nama},\n\n" .
                "✅ *PENGAJUAN LEMBUR ANDA DISETUJUI*\n\n" .
                "📅 Tanggal: {$tanggal}\n" .
                "🕐 Jam: {$jamMasuk} - {$jamKeluar}\n" .
                "👤 Disetujui oleh: {$approver->name}\n\n" .
                "Silakan cek detail lengkap di:\n{$link}";
        } else {
            $message = "{$salam} {$karyawan->nama},\n\n" .
                "❌ *PENGAJUAN LEMBUR ANDA DITOLAK*\n\n" .
                "📅 Tanggal: {$tanggal}\n" .
                "🕐 Jam: {$jamMasuk} - {$jamKeluar}\n" .
                "👤 Ditolak oleh: {$approver->name}\n\n" .
                "Silakan cek detail lengkap di:\n{$link}";
        }

        return $this->sendMessage($karyawan->phone, $message);
    }
}
