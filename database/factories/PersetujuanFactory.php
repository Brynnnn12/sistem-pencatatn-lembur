<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Persetujuan;
use App\Models\CatatanLembur;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persetujuan>
 */
class PersetujuanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'catatan_lembur_id' => CatatanLembur::factory(),
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['disetujui', 'ditolak']),
        ];
    }
}
