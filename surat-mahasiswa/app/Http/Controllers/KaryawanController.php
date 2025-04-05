<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function dashboard()
    {
        // Menampilkan surat yang sudah disetujui tetapi belum diunggah file-nya
        $surat = Surat::where('status_surat', 'diterima')->whereNull('file_surat')->get();
        return view('karyawan.dashboard', compact('surat'));
    }

    public function uploadSurat(Request $request, $id)
    {
        // Validasi file harus PDF dan maksimal 2MB
        $request->validate([
            'file_surat' => 'required|mimes:pdf|max:2048',
        ]);

        $surat = Surat::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            // Simpan file di storage/app/public/surat
            $file = $request->file('file_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('surat', $filename, 'public');

            // Simpan nama file di database
            $surat->file_surat = $filename;
            $surat->save();
        }

        return redirect()->route('karyawan.dashboard')->with('success', 'Surat berhasil diunggah.');
    }

    // Menampilkan daftar Kaprodi
    public function showKaprodi()
    {
        $kaprodis = Kaprodi::all(); // Ambil data Kaprodi
        return view('karyawan.kaprodi.index', compact('kaprodis'));
    }

    // Form untuk menambah Kaprodi
    public function createKaprodi()
    {
        return view('karyawan.kaprodi.create'); // Tampilkan form tambah Kaprodi
    }

    // Menyimpan Kaprodi
    public function storeKaprodi(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:kaprodi,nik',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'prodi' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Validasi email agar tidak null dan unik
        ]);

        $kaprodi = Kaprodi::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
        ]);

        // Menyimpan data user yang berhubungan dengan kaprodi
        $user = new User();
        $user->password = bcrypt($request->password);
        $user->userable_type = Kaprodi::class; // Menyimpan nama model lengkap dengan namespace
        $user->userable_id = $kaprodi->nik; // Menyimpan ID kaprodi
        $user->email = $request->email; // Menyimpan email yang diberikan dalam request
        $user->save();

        return redirect()->route('karyawan.kaprodi.index')->with('success', 'Kaprodi berhasil ditambahkan');
    }

    // Menampilkan halaman edit untuk Kaprodi
    public function edit($id)
    {
        $kaprodi = Kaprodi::findOrFail($id);
        return view('karyawan.kaprodi.edit', compact('kaprodi'));
    }

    // Mengupdate data Kaprodi
    public function update(Request $request, $id)
    {
        $kaprodi = Kaprodi::with('user')->findOrFail($id);
        $userId = optional($kaprodi->user)->id;

        // Validasi data jika diperlukan
    $request->validate([
        'nik' => 'required|unique:kaprodi,nik,' . $kaprodi->id,
        'nama' => 'required|string|max:255',
        'prodi' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $userId, // Validasi email dengan pengecekan unik, kecuali milik user ini
    ]);

    // Update data Kaprodi
    $kaprodi->update([
        'nik' => $request->nik,
        'nama' => $request->nama,
        'prodi' => $request->prodi,
    ]);

    // Update email user terkait
    if ($kaprodi->user) {
        $kaprodi->user->update([
            'email' => $request->email,
            'userable_id' => $request->nik, // Update NIK di tabel users
        ]);
    }

    return redirect()->route('karyawan.kaprodi.index')->with('success', 'Data Kaprodi berhasil diperbarui');
    }

    // Menghapus data Kaprodi
    public function destroy($id)
    {
        $kaprodi = Kaprodi::findOrFail($id);
        $kaprodi->delete();

        return redirect()->route('karyawan.kaprodi.index')->with('success', 'Data Kaprodi berhasil dihapus');
    }

    // Menampilkan daftar Mahasiswa
    public function showMahasiswa()
    {
        $mahasiswas = Mahasiswa::all(); // Ambil data Mahasiswa
        return view('karyawan.mahasiswa.index', compact('mahasiswas'));
    }

    // Form untuk menambah Mahasiswa
    public function createMahasiswa()
    {
        return view('karyawan.mahasiswa.create'); // Tampilkan form tambah Mahasiswa
    }

    // Menyimpan Mahasiswa
    public function storeMahasiswa(Request $request)
    {
        $request->validate([
            'nrp' => 'required|unique:mahasiswa,nrp',
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|email|unique:users,email', // Validasi email agar tidak null dan unik
        ]);

        // Simpan data mahasiswa yang terhubung dengan userable
        $mahasiswa = Mahasiswa::create([
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
        ]);

        // Menyimpan data user yang berhubungan dengan mahasiswa
        $user = new User();
        $user->password = bcrypt($request->password);
        $user->userable_type = Mahasiswa::class; // Menyimpan nama model lengkap dengan namespace
        $user->userable_id = $mahasiswa->nrp; // Menyimpan ID mahasiswa
        $user->email = $request->email; // Menyimpan email yang diberikan dalam request
        $user->save();

        return redirect()->route('karyawan.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    // Menampilkan halaman edit untuk Mahasiswa
    public function editMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('karyawan.mahasiswa.edit', compact('mahasiswa'));
    }

    // Mengupdate data Mahasiswa
    public function updateMahasiswa(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);

    // Validasi data jika diperlukan
    $request->validate([
        'nrp' => 'required|unique:mahasiswa,nrp,' . $mahasiswa->id,
        'nama' => 'required|string|max:255',
        'prodi' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . optional($mahasiswa->user)->id, // Validasi email
    ]);

    // Update data mahasiswa
    $mahasiswa->update([
        'nrp' => $request->nrp,
        'nama' => $request->nama,
        'prodi' => $request->prodi,
    ]);

    // Jika ada relasi user, update email
    if ($mahasiswa->user) {
        $mahasiswa->user->update([
            'email' => $request->email,
            'userable_id' => $request->nrp, // Update NRP di tabel users
            'userable_type' => Mahasiswa::class, // Pastikan userable_type tetap Mahasiswa
        ]);
    }

    return redirect()->route('karyawan.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui');
    }

    // Menghapus data Mahasiswa
    public function destroyMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('karyawan.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus');
    }
}
