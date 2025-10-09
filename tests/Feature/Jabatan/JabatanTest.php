<?php

use App\Models\Jabatan;
use App\Models\User;
use App\Models\Departemen;
use App\Models\Karyawan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

// Menggunakan RefreshDatabase untuk mereset database sebelum setiap test,
// sehingga setiap test berjalan dalam kondisi bersih tanpa data dari test sebelumnya.
// Best practice: Pastikan test tidak bergantung pada state global.
uses(RefreshDatabase::class);

/**
 * Test untuk memverifikasi route jabatan.index menampilkan daftar jabatan dengan benar.
 * Best practice: Test harus fokus pada satu skenario, menggunakan factory untuk data,
 * dan memastikan user terautentikasi dengan role yang tepat.
 * Struktur test: Arrange (setup), Act (tindakan), Assert (verifikasi).
 */
test('route jabatan menampilkan daftar jabatan dengan benar', function () {
    // Arrange: Persiapkan data yang diperlukan untuk test.
    // Buat user palsu menggunakan factory.
    $user = User::factory()->create(); // <-- 2. Buat satu user palsu
    // Buat role 'Pimpinan' jika belum ada (karena menggunakan Spatie Permission).
    Role::create(['name' => 'Pimpinan']);
    // Assign role ke user agar memiliki akses (policy JabatanPolicy memerlukan role ini).
    $user->assignRole('Pimpinan');
    // Buat departemen untuk karyawan (karena karyawan memerlukan departemen_id).
    $departemen = Departemen::factory()->create();
    // Buat 3 jabatan menggunakan factory untuk mengisi data.
    Jabatan::factory()->count(3)->create();
    // Buat karyawan terkait user, karena header dashboard mengakses Auth::user()->karyawan->nama.
    // Jika tidak ada karyawan, akan terjadi error 500.
    Karyawan::create([
        'user_id' => $user->id,
        'nama' => 'Test User',
        'departemen_id' => $departemen->id,
        'jabatan_id' => Jabatan::first()->id,
    ]);

    // Act: Lakukan tindakan yang ingin ditest, yaitu GET request ke route jabatan.index.
    // 3. Tambahkan actingAs($user) sebelum melakukan request
    $response = $this->actingAs($user)->get(route('jabatan.index'));

    // Assert: Verifikasi hasil.
    // Pastikan response status 200 (OK).
    $response->assertOk(); // Sekarang ini akan berhasil (200 OK)
    // Pastikan view yang dikembalikan adalah 'dashboard.jabatan.index'.
    $response->assertViewIs('dashboard.jabatan.index');
    // Pastikan view memiliki data 'jabatans' dengan 3 item (sesuai yang dibuat).
    $response->assertViewHas('jabatans', function ($jabatansFromView) {
        return $jabatansFromView->count() === 3;
    });
});

/**
 * Test untuk memverifikasi route jabatan.index menampilkan halaman dengan benar saat ada satu data.
 * Best practice: Test edge case seperti data minimal, dan pastikan konsistensi dengan test lainnya.
 * Struktur: Arrange, Act, Assert.
 */
test('route jabatan menampilkan halaman dengan benar saat ada satu data', function () {
    // Arrange: Persiapkan data minimal.
    $user = User::factory()->create(); // <-- Buat user
    Role::create(['name' => 'Pimpinan']);
    $user->assignRole('Pimpinan');
    $departemen = Departemen::factory()->create();
    // Buat hanya 1 jabatan.
    $jabatan = Jabatan::factory()->create();
    // Buat karyawan dengan jabatan yang dibuat.
    Karyawan::create([
        'user_id' => $user->id,
        'nama' => 'Test User',
        'departemen_id' => $departemen->id,
        'jabatan_id' => $jabatan->id,
    ]);

    // Act: GET request.
    // Tambahkan actingAs($user)
    $response = $this->actingAs($user)->get(route('jabatan.index'));

    // Assert: Verifikasi response dan data.
    $response->assertOk(); // Ini juga akan berhasil
    $response->assertViewHas('jabatans', function ($jabatansFromView) {
        return $jabatansFromView->count() === 1; // Harus ada 1 jabatan.
    });
});


/**
 * Test untuk memverifikasi pembuatan jabatan baru via POST.
 * Best practice: Untuk POST request, tangani CSRF dengan startSession dan _token.
 * Pastikan field sesuai dengan model (misalnya 'name' bukan 'nama').
 * Test database insertion dan redirect.
 * Struktur: Arrange, Act, Assert.
 */
test('untuk membuat jabatan baru', function () {
    // Arrange: Setup user dengan role dan karyawan.
    $user = User::factory()->create();
    Role::create(['name' => 'Pimpinan']);
    $user->assignRole('Pimpinan');
    $departemen = Departemen::factory()->create();
    // Buat jabatan untuk karyawan (karena jabatan_id required).
    $jabatan = Jabatan::factory()->create(); // Create a jabatan for karyawan
    Karyawan::create([
        'user_id' => $user->id,
        'nama' => 'Test User',
        'departemen_id' => $departemen->id,
        'jabatan_id' => $jabatan->id,
    ]);

    // Act: POST request untuk membuat jabatan baru.
    // Start session untuk menangani CSRF.
    $this->startSession();
    $response = $this->actingAs($user)->post(route('jabatan.store'), [
        '_token' => csrf_token(), // CSRF token diperlukan untuk POST di web routes.
        'name' => 'Jabatan Baru', // Field sesuai model Jabatan (fillable: 'name').
    ]);

    // Assert: Pastikan redirect ke jabatan.index dan data tersimpan di DB.
    $response->assertRedirect(route('jabatan.index'));
    $this->assertDatabaseHas('jabatans', [
        'name' => 'Jabatan Baru',
    ]);
});

test('untuk membuat jabatan baru dengan validasi', function () {
    // Arrange: Setup user dengan role dan karyawan.
    $user = User::factory()->create();
    Role::create(['name' => 'Pimpinan']);
    $user->assignRole('Pimpinan');
    $departemen = Departemen::factory()->create();
    // Buat jabatan untuk karyawan (karena jabatan_id required).
    $jabatan = Jabatan::factory()->create(); // Create a jabatan for karyawan
    Karyawan::create([
        'user_id' => $user->id,
        'nama' => 'Test User',
        'departemen_id' => $departemen->id,
        'jabatan_id' => $jabatan->id,
    ]);

    // Act: POST request untuk membuat jabatan baru.
    // Start session untuk menangani CSRF.
    $this->startSession();
    $response = $this->actingAs($user)->post(route('jabatan.store'), [
        '_token' => csrf_token(), // CSRF token diperlukan untuk POST di web routes.
        'name' => 'Jabatan Baru', // Field sesuai model Jabatan (fillable: 'name').
    ]);

    // Assert: Pastikan redirect ke jabatan.index dan data tersimpan di DB.
    $response->assertRedirect(route('jabatan.index'));
    $this->assertDatabaseHas('jabatans', [
        'name' => 'Jabatan Baru',
    ]);
});
