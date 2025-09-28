<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upah extends Model
{
    /** @use HasFactory<\Database\Factories\UpahFactory> */
    use HasFactory;

    protected $fillable = [
        'catatan_lembur_id',
        'jumlah',
    ];

    /**
     * ini di gunakan untuk memformat jumlah upah
     */
    protected $casts = [
        'jumlah' => 'decimal:2',
    ];

    /**
     * Relasi ke model CatatanLembur
     * ini adalah relasi belongsTo 
     */
    public function catatanLembur()
    {
        return $this->belongsTo(CatatanLembur::class);
    }

    /**
     * Hitung jumlah upah berdasarkan durasi lembur
     * Asumsi tarif per jam adalah 20000 (bisa disesuaikan)
     */
    public static function hitungJumlahUpah(CatatanLembur $catatanLembur, $tarifPerJam = 20000)
    {
        $durasi = $catatanLembur->durasi_lembur;
        return $durasi * $tarifPerJam;
    }

    /**
     * Boot method untuk auto calculate jumlah saat create/update
     * ini akan dipanggil saat model di-inisialisasi
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($upah) {
            if ($upah->catatan_lembur_id && !$upah->jumlah) {
                $catatanLembur = CatatanLembur::find($upah->catatan_lembur_id);
                if ($catatanLembur) {
                    $upah->jumlah = self::hitungJumlahUpah($catatanLembur);
                }
            }
        });

        static::updating(function ($upah) {
            if ($upah->isDirty('catatan_lembur_id') && !$upah->isDirty('jumlah')) {
                $catatanLembur = CatatanLembur::find($upah->catatan_lembur_id);
                if ($catatanLembur) {
                    $upah->jumlah = self::hitungJumlahUpah($catatanLembur);
                }
            }
        });
    }

    /**
     * Format jumlah upah
     */
    public function getFormattedJumlahAttribute()
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }
}
