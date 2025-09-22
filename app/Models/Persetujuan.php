<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function catatanLembur(): BelongsTo
    {
        return $this->belongsTo(CatatanLembur::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'disetujui' => 'green',
            'ditolak' => 'red',
            default => 'gray',
        };
    }

    public function getStatusIconAttribute()
    {
        return match ($this->status) {
            'disetujui' => 'fas fa-check-circle',
            'ditolak' => 'fas fa-times-circle',
            default => 'fas fa-question-circle',
        };
    }
}
