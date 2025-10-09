<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanLembur extends Model
{
    /** @use HasFactory<\Database\Factories\CatatanLemburFactory> */
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function upah()
    {
        return $this->hasOne(Upah::class);
    }

    public function persetujuan()
    {
        return $this->hasOne(Persetujuan::class);
    }

    /**
     * ✅ Menghitung durasi lembur dalam jam (diperbaiki)
     * Menggunakan Carbon untuk akurasi yang lebih baik
     */
    public function getDurasiLemburAttribute()
    {
        if (!$this->jam_masuk || !$this->jam_keluar || !$this->tanggal) {
            return 0;
        }

        // jam_masuk dan jam_keluar sekarang TIME column, jadi berupa string "H:i:s"
        $tanggalStr = $this->tanggal->format('Y-m-d');
        $jamMasukStr = $this->jam_masuk;
        $jamKeluarStr = $this->jam_keluar;

        $start = Carbon::createFromFormat('Y-m-d H:i:s', $tanggalStr . ' ' . $jamMasukStr);
        $end = Carbon::createFromFormat('Y-m-d H:i:s', $tanggalStr . ' ' . $jamKeluarStr);

        // Jika jam keluar lebih kecil, berarti melewati tengah malam
        if ($end->lt($start)) {
            $end->addDay();
        }

        // Hitung selisih dalam jam
        return round($start->diffInMinutes($end) / 60, 2);
    }
}
