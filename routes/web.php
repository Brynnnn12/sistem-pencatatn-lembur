<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CatatanLemburController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\UpahController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
});


Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    Route::resource('jabatan', JabatanController::class);
    Route::resource('departemen', DepartemenController::class)->parameters([
        'departemen' => 'departemen'
    ]);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('catatan-lembur', CatatanLemburController::class);
    Route::resource('persetujuan', PersetujuanController::class)->except(['create', 'store']);
    Route::patch('persetujuan/{persetujuan}/update-status', [PersetujuanController::class, 'updateStatus'])->name('persetujuan.updateStatus');
    Route::resource('upah', UpahController::class)->except(['create', 'store', 'edit', 'update']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
