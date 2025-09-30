<?php

namespace App\Models;

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
        'jam_masuk' => 'datetime',
        'jam_keluar' => 'datetime',
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
     * Menghitung durasi lembur dalam jam
     * ini adalah accessor untuk atribut durasi_lembur
     */
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

    /**
     * Accessor untuk jam_masuk dengan format WIB
     */
    public function getJamMasukFormattedAttribute()
    {
        return $this->jam_masuk ? $this->jam_masuk->format('H:i') . ' WIB' : null;
    }

    /**
     * Accessor untuk jam_keluar dengan format WIB
     */
    public function getJamKeluarFormattedAttribute()
    {
        return $this->jam_keluar ? $this->jam_keluar->format('H:i') . ' WIB' : null;
    }
}
