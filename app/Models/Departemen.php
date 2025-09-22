<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    /** @use HasFactory<\Database\Factories\DepartemenFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }
}
