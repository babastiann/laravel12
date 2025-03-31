<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\DashboardController;
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

// ✅ Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Dashboard Mahasiswa
Route::middleware(['auth', 'role:Mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'index'])->name('mahasiswa.dashboard');

    // 🔹 Pengajuan Surat
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/surat/download/{id}', [SuratController::class, 'download'])->name('surat.download');
});

// ✅ Dashboard Kaprodi
Route::middleware(['auth', 'role:Kaprodi'])->group(function () {
    Route::get('/kaprodi/dashboard', [KaprodiController::class, 'dashboard'])->name('kaprodi.dashboard');
    Route::post('/kaprodi/surat/{id}/approve', [KaprodiController::class, 'approve'])->name('kaprodi.surat.approve');
    Route::post('/kaprodi/surat/{id}/reject', [KaprodiController::class, 'reject'])->name('kaprodi.surat.reject');
});

// ✅ Dashboard Karyawan & Upload Surat
Route::middleware(['auth', 'role:Karyawan'])->group(function () {
    Route::get('/karyawan/dashboard', [KaryawanController::class, 'dashboard'])->name('karyawan.dashboard');
    Route::post('/karyawan/upload/{id}', [KaryawanController::class, 'uploadSurat'])->name('karyawan.upload');
});

// ✅ Manajemen Surat (Kaprodi & Karyawan)
Route::middleware(['auth', 'role:Kaprodi,Karyawan'])->group(function () {
    Route::get('/surat/{id}', [SuratController::class, 'show'])->name('surat.show');
    Route::get('/surat/download/{id}', [SuratController::class, 'download'])->name('surat.download');
});

// ✅ Route Manajemen Admin (Karyawan)
Route::prefix('admin')->middleware(['auth', 'role:Karyawan'])->group(function () {
    Route::get('/management', [ManagementController::class, 'index'])->name('admin.management.index');
});

// ✅ Route CRUD Mahasiswa (Hanya Karyawan)
Route::middleware(['auth', 'role:Karyawan'])->group(function () {
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}/update', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});

// mengunduh surat
Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::get('/surat/download/{id}', [SuratController::class, 'download'])->name('surat.download');
