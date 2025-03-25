<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Models\Mahasiswa;
use App\Models\Kaprodi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ✅ Route Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// ✅ Dashboard Mahasiswa
Route::middleware(['auth','role:Mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    // 🔹 Route Pengajuan Surat (Mahasiswa)
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
});

// ✅ Route Manajemen Surat (Kaprodi & Karyawan)
Route::middleware(['auth', 'role:Kaprodi,Karyawan'])->group(function () {
    Route::get('/surat/{id}', [SuratController::class, 'show'])->name('surat.show');
    Route::get('/surat/download/{id}', [SuratController::class, 'download'])->name('surat.download');
});

// ✅ Dashboard Kaprodi
Route::middleware(['auth', 'role:Kaprodi'])->group(function () {
    Route::get('/kaprodi/dashboard', function () {
        return view('kaprodi.dashboard');
    })->name('kaprodi.dashboard');
});

// ✅ Dashboard Karyawan
Route::middleware(['auth', 'role:Karyawan'])->group(function () {
    Route::get('/karyawan/dashboard', function () {
        $mahasiswa = Mahasiswa::all();
        $kaprodi = Kaprodi::all();
        return view('karyawan.dashboard', compact('mahasiswa', 'kaprodi'));
    })->name('karyawan.dashboard');
});

// ✅ Route Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Route Manajemen oleh Staff (Karyawan)
Route::prefix('admin')->middleware(['auth', 'role:Karyawan'])->group(function () {
    Route::get('/management', [ManagementController::class, 'index'])->name('admin.management.index');
});

// ✅ Route CRUD Mahasiswa
Route::middleware(['auth', 'role:Karyawan'])->group(function () {
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}/update', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});
