<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Upah;
use App\Models\CatatanLembur;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Upah>
 */
class UpahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $catatanLembur = CatatanLembur::factory()->create();

        return [
            'catatan_lembur_id' => $catatanLembur->id,
            'jumlah' => Upah::hitungJumlahUpah($catatanLembur),
        ];
    }
}
