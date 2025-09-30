<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    /** @use HasFactory<\Database\Factories\KaryawanFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'phone',
        'departemen_id',
        'jabatan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function catatanLemburs()
    {
        return $this->hasMany(CatatanLembur::class);
    }

    public function persetujuans()
    {
        return $this->hasManyThrough(Persetujuan::class, CatatanLembur::class);
    }
}
