<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Upah;
use App\Models\CatatanLembur;

class UpahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catatanLemburs = CatatanLembur::all();

        if ($catatanLemburs->isEmpty()) {
            return; // Skip if no catatan lembur exist
        }

        // Create upah for first catatan lembur
        Upah::create([
            'catatan_lembur_id' => $catatanLemburs->first()->id,
            // jumlah will be auto-calculated by model boot method
        ]);
    }
}
