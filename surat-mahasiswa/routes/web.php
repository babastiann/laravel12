<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\Mahasiswa;
use App\Models\Kaprodi;



Route::get('/', function () {
    return view('welcome');
});

// Route login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Contoh route dashboard untuk mahasiswa
Route::middleware('auth')->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    Route::get('/kaprodi/dashboard', function () {
        return view('kaprodi.dashboard');
    })->name('kaprodi.dashboard');

    Route::get('/karyawan/dashboard', function () {
        $mahasiswa = Mahasiswa::all();
        $kaprodi = Kaprodi::all();
        return view('karyawan.dashboard', compact('mahasiswa', 'kaprodi'));
    })->name('karyawan.dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route untuk manajemen data oleh staff (karyawan)
    Route::prefix('admin')->group(function () {
        Route::get('/management', [ManagementController::class, 'index'])->name('admin.management.index');
        // Tambahkan route CRUD lainnya sesuai kebutuhan
    });
});


