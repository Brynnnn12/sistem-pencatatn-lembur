<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CatatanLembur;
use App\Models\Karyawan;
use Carbon\Carbon;

class CatatanLemburSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawans = Karyawan::all();

        if ($karyawans->isEmpty()) {
            return; // Skip if no karyawan exists
        }

        $catatanLemburData = [
            [
                'karyawan_id' => $karyawans->first()->id,
                'tanggal' => Carbon::now()->subDays(2),
                'jam_masuk' => '18:00',
                'jam_keluar' => '22:00',
            ],
            [
                'karyawan_id' => $karyawans->first()->id,
                'tanggal' => Carbon::now()->subDays(5),
                'jam_masuk' => '17:30',
                'jam_keluar' => '21:30',
            ],
            [
                'karyawan_id' => $karyawans->skip(1)->first()->id ?? $karyawans->first()->id,
                'tanggal' => Carbon::now()->subDays(3),
                'jam_masuk' => '19:00',
                'jam_keluar' => '23:00',
            ],
            [
                'karyawan_id' => $karyawans->skip(2)->first()->id ?? $karyawans->first()->id,
                'tanggal' => Carbon::now()->subDays(1),
                'jam_masuk' => '16:00',
                'jam_keluar' => '20:00',
            ],
            [
                'karyawan_id' => $karyawans->skip(3)->first()->id ?? $karyawans->first()->id,
                'tanggal' => Carbon::now()->subDays(7),
                'jam_masuk' => '18:30',
                'jam_keluar' => '22:30',
            ],
            [
                'karyawan_id' => $karyawans->skip(4)->first()->id ?? $karyawans->first()->id,
                'tanggal' => Carbon::now()->subDays(4),
                'jam_masuk' => '17:00',
                'jam_keluar' => '21:00',
            ],
        ];

        foreach ($catatanLemburData as $data) {
            CatatanLembur::create($data);
        }
    }
}
