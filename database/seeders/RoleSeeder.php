<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => 'Pimpinan',
            'email' => 'pimpinan@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $pimpinan->assignRole('Pimpinan');

        /**
         * membuat user HRD
         */
        $hrd = \App\Models\User::create([
            'name' => 'HRD',
            'email' => 'hrd@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $hrd->assignRole('HRD');
    }
}
