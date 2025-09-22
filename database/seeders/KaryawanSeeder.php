<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample karyawan
        $karyawans = [
            [
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'password' => Hash::make('password'),
                ],
                'nama' => 'John Doe',
                'departemen_id' => 1, // HRD
                'jabatan_id' => 1, // Manager
            ],
            [
                'user' => [
                    'name' => 'Jane Smith',
                    'email' => 'jane@example.com',
                    'password' => Hash::make('password'),
                ],
                'nama' => 'Jane Smith',
                'departemen_id' => 2, // IT
                'jabatan_id' => 2, // Supervisor
            ],
            [
                'user' => [
                    'name' => 'Bob Johnson',
                    'email' => 'bob@example.com',
                    'password' => Hash::make('password'),
                ],
                'nama' => 'Bob Johnson',
                'departemen_id' => 3, // Finance
                'jabatan_id' => 3, // Staff
            ],
            [
                'user' => [
                    'name' => 'Alice Brown',
                    'email' => 'alice@example.com',
                    'password' => Hash::make('password'),
                ],
                'nama' => 'Alice Brown',
                'departemen_id' => 2, // IT
                'jabatan_id' => 3, // Staff
            ],
            [
                'user' => [
                    'name' => 'Charlie Wilson',
                    'email' => 'charlie@example.com',
                    'password' => Hash::make('password'),
                ],
                'nama' => 'Charlie Wilson',
                'departemen_id' => 1, // HRD
                'jabatan_id' => 3, // Staff
            ],
            [
                'user' => [
                    'name' => 'Diana Prince',
                    'email' => 'diana@example.com',
                    'password' => Hash::make('password'),
                ],
                'nama' => 'Diana Prince',
                'departemen_id' => 3, // Finance
                'jabatan_id' => 2, // Supervisor
            ],
            [
                'user' => [
                    'name' => 'Edward Norton',
                    'email' => 'edward@example.com',
                    'password' => Hash::make('password'),
                ],
                'nama' => 'Edward Norton',
                'departemen_id' => 2, // IT
                'jabatan_id' => 1, // Manager
            ],
            [
                'user' => [
                    'name' => 'Fiona Green',
                    'email' => 'fiona@example.com',
                    'password' => Hash::make('password'),
                ],
                'nama' => 'Fiona Green',
                'departemen_id' => 1, // HRD
                'jabatan_id' => 2, // Supervisor
            ],
        ];

        foreach ($karyawans as $karyawanData) {
            // Create user
            $user = User::create($karyawanData['user']);

            // Assign role karyawan
            $user->assignRole('Karyawan');

            // Create karyawan
            Karyawan::create([
                'user_id' => $user->id,
                'nama' => $karyawanData['nama'],
                'departemen_id' => $karyawanData['departemen_id'],
                'jabatan_id' => $karyawanData['jabatan_id'],
            ]);
        }
    }
}
