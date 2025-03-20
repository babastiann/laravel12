<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\Mahasiswa;
use App\Models\Kaprodi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

// Route login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Middleware auth + role untuk membatasi akses berdasarkan userable_type
Route::middleware(['auth', 'role:Mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');
});

Route::middleware(['auth', 'role:Kaprodi'])->group(function () {
    Route::get('/kaprodi/dashboard', function () {
        return view('kaprodi.dashboard');
    })->name('kaprodi.dashboard');
});

Route::middleware(['auth', 'role:Karyawan'])->group(function () {
    Route::get('/karyawan/dashboard', function () {
        $mahasiswa = Mahasiswa::all();
        $kaprodi = Kaprodi::all();
        return view('karyawan.dashboard', compact('mahasiswa', 'kaprodi'));
    })->name('karyawan.dashboard');
});

// Route logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk manajemen data oleh staff (karyawan)
Route::prefix('admin')->middleware(['auth', 'role:Karyawan'])->group(function () {
    Route::get('/management', [ManagementController::class, 'index'])->name('admin.management.index');
});

 // Route CRUD Mahasiswa (Pindahkan ke luar)
 Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
 Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
 Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
 Route::put('/mahasiswa/{id}/update', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
 Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
