<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'jam_masuk' => 'datetime:H:i',
        'jam_keluar' => 'datetime:H:i',
    ];

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function upah(): HasOne
    {
        return $this->hasOne(Upah::class);
    }

    public function persetujuan(): HasOne
    {
        return $this->hasOne(Persetujuan::class);
    }

    public function getDurasiLemburAttribute()
    {
        if ($this->jam_masuk && $this->jam_keluar) {
            $masuk = strtotime($this->jam_masuk);
            $keluar = strtotime($this->jam_keluar);
            $durasi = ($keluar - $masuk) / 3600; // dalam jam
            return round($durasi, 2);
        }
        return 0;
    }
}
