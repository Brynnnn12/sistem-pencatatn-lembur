<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * membuat role Pimpinan dan HRD
         */
        $roles = ['Pimpinan', 'HRD', 'Karyawan'];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create(['name' => $role]);
        }

        /**
         * membuat user pimpinan
         */
        $pimpinan = User::create([
            'nik' => 11111111,
            'email' => 'pimpinan@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $pimpinan->assignRole('Pimpinan');


        Karyawan::create([
            'user_id' => $pimpinan->id,
            'nama' => 'Pimpinan',
            'departemen_id' => 1, // HRD
            'jabatan_id' => 1, // Manager
        ]);

        /**
         * membuat user HRD
         */
        $hrd = \App\Models\User::create([
            'nik' => 22222222,
            'email' => 'hrd@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $hrd->assignRole('HRD');

        Karyawan::create([
            'user_id' => $hrd->id,
            'nama' => 'HRD',
            'departemen_id' => 1, // HRD
            'jabatan_id' => 1, // Manager
        ]);
    }
}
