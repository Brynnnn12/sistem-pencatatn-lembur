<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persetujuan;
use App\Models\CatatanLembur;
use App\Models\User;

class PersetujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catatanLemburs = CatatanLembur::all();
        $pimpinanHrdUsers = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Pimpinan', 'HRD']);
        })->get();

        if ($catatanLemburs->isEmpty() || $pimpinanHrdUsers->isEmpty()) {
            return; // Skip if no catatan lembur or pimpinan/hrd users exist
        }

        $statuses = ['pending', 'disetujui', 'ditolak'];
        $persetujuanData = [];

        foreach ($catatanLemburs as $index => $catatanLembur) {
            $status = $statuses[$index % count($statuses)];
            $userId = $status === 'pending' ? null : $pimpinanHrdUsers->first()->id;

            $persetujuanData[] = [
                'catatan_lembur_id' => $catatanLembur->id,
                'user_id' => $userId,
                'status' => $status,
            ];
        }

        foreach ($persetujuanData as $data) {
            Persetujuan::create($data);
        }
    }
}
