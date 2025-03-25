<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SuratController;
use App\Models\Mahasiswa;
use App\Models\Kaprodi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ==================== ROUTE AUTH ====================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== ROUTE MAHASISWA ====================
Route::prefix('mahasiswa')->middleware(['auth', 'role:Mahasiswa'])->group(function () {
    Route::get('/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    // Pengajuan Surat
    Route::get('/surat', [SuratController::class, 'indexMahasiswa'])->name('mahasiswa.surat.index');
    Route::get('/surat/create', [SuratController::class, 'create'])->name('mahasiswa.surat.create');
    Route::post('/surat/store', [SuratController::class, 'store'])->name('mahasiswa.surat.store');

    // CRUD Mahasiswa (hanya admin atau mahasiswa bisa akses data pribadi)
    Route::get('/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/{id}/update', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});

// ==================== ROUTE KAPRODI ====================
Route::prefix('kaprodi')->middleware(['auth', 'role:Kaprodi'])->group(function () {
    Route::get('/dashboard', function () {
        return view('kaprodi.dashboard');
    })->name('kaprodi.dashboard');

    // Keputusan Surat
    Route::get('/surat', [SuratController::class, 'indexKaprodi'])->name('kaprodi.surat.index');
    Route::post('/surat/{surat}/approve', [SuratController::class, 'approve'])->name('kaprodi.surat.approve');
    Route::post('/surat/{surat}/reject', [SuratController::class, 'reject'])->name('kaprodi.surat.reject');
});

// ==================== ROUTE KARYAWAN ====================
Route::prefix('karyawan')->middleware(['auth', 'role:Karyawan'])->group(function () {
    Route::get('/dashboard', function () {
        $mahasiswa = Mahasiswa::all();
        $kaprodi = Kaprodi::all();
        return view('karyawan.dashboard', compact('mahasiswa', 'kaprodi'));
    })->name('karyawan.dashboard');

    // Pengelolaan Surat
    Route::get('/surat', [SuratController::class, 'indexKaryawan'])->name('karyawan.surat.index');
    Route::post('/surat/{surat}/issue', [SuratController::class, 'issueLetter'])->name('karyawan.surat.issue');
});

// ==================== ROUTE ADMIN (KARYAWAN) ====================
Route::prefix('admin')->middleware(['auth', 'role:Karyawan'])->group(function () {
    Route::get('/management', [ManagementController::class, 'index'])->name('admin.management.index');
});

// ==================== ROUTE GLOBAL SURAT ====================
Route::middleware(['auth'])->group(function () {
    // Daftar semua surat (hanya bisa dilihat sesuai peran)
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');

    // Form pengajuan surat (hanya Mahasiswa)
    Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat/store', [SuratController::class, 'store'])->name('surat.store');

    // Detail surat berdasarkan ID
    Route::get('/surat/{id}', [SuratController::class, 'show'])->name('surat.show');

    // Update status surat (Kaprodi & Karyawan)
    Route::post('/surat/{id}/approve', [SuratController::class, 'approve'])->name('surat.approve')->middleware('role:Kaprodi');
    Route::post('/surat/{id}/reject', [SuratController::class, 'reject'])->name('surat.reject')->middleware('role:Kaprodi');
    Route::post('/surat/{id}/issue', [SuratController::class, 'issueLetter'])->name('surat.issue')->middleware('role:Karyawan');
});
