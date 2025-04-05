<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
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

// Edit profile dan account setting
Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [ProfileController::class, 'myProfile'])->name('profile.myprofile');
    Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::get('/account-setting', [ProfileController::class, 'accountSetting'])->name('profile.accountsetting');
    Route::put('/update-account', [ProfileController::class, 'updateAccount'])->name('profile.updateAccount');
});




// Route untuk menambah Kaprodi dan mahasiswa (Karyawan)
Route::prefix('karyawan')->middleware('auth')->group(function () {
    Route::get('kaprodi', [KaryawanController::class, 'showKaprodi'])->name('karyawan.kaprodi.index');
    Route::get('kaprodi/create', [KaryawanController::class, 'createKaprodi'])->name('karyawan.kaprodi.create');
    Route::post('kaprodi', [KaryawanController::class, 'storeKaprodi'])->name('karyawan.kaprodi.store');
    Route::get('/kaprodi/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawan.kaprodi.edit');
    Route::put('/kaprodi/update/{id}', [KaryawanController::class, 'update'])->name('karyawan.kaprodi.update');
    Route::delete('/kaprodi/delete/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.kaprodi.destroy');
    
    Route::get('mahasiswa', [KaryawanController::class, 'showMahasiswa'])->name('karyawan.mahasiswa.index');
    Route::get('mahasiswa/create', [KaryawanController::class, 'createMahasiswa'])->name('karyawan.mahasiswa.create');
    Route::post('mahasiswa', [KaryawanController::class, 'storeMahasiswa'])->name('karyawan.mahasiswa.store');
    Route::get('/mahasiswa/edit/{id}', [KaryawanController::class, 'editMahasiswa'])->name('karyawan.mahasiswa.edit');
    Route::put('/mahasiswa/update/{id}', [KaryawanController::class, 'updateMahasiswa'])->name('karyawan.mahasiswa.update');
    Route::delete('/mahasiswa/delete/{id}', [KaryawanController::class, 'destroyMahasiswa'])->name('karyawan.mahasiswa.destroy');

});



