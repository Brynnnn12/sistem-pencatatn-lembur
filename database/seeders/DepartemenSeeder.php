<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departemen = [
            ['name' => 'HRD'],
            ['name' => 'IT'],
            ['name' => 'Finance'],
        ];

        foreach ($departemen as $d) {
            \App\Models\Departemen::create($d);
        }
    }
}
