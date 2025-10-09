<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
    /** @use HasFactory<\Database\Factories\PersetujuanFactory> */
    use HasFactory;

    protected $fillable = [
        'catatan_lembur_id',
        'user_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function catatanLembur()
    {
        return $this->belongsTo(CatatanLembur::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
