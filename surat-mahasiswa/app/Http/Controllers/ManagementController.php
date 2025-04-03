<?php

namespace App\Http\Controllers;

use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagementController extends Controller
{
    // Menampilkan Daftar Kaprodi
    public function kaprodiIndex()
    {
        $kaprodiData = Kaprodi::all();  // Ambil data kaprodi
        return view('admin.management.kaprodi.index', compact('kaprodiData'));
    }

    // Menyimpan Kaprodi Baru
    public function kaprodiStore(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:kaprodi,nik',  // Misalnya NIK Kaprodi unik
            'password' => 'required|string|min:8|confirmed',  // Validasi password
        ]);

        // Menyimpan data Kaprodi dengan password terenkripsi
        Kaprodi::create([
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.management.kaprodi.index')->with('success', 'Kaprodi berhasil ditambahkan!');
    }

    // Menghapus Kaprodi
    public function kaprodiDestroy($id)
    {
        $kaprodi = Kaprodi::findOrFail($id);
        $kaprodi->delete();

        return redirect()->route('admin.management.kaprodi.index')->with('success', 'Kaprodi berhasil dihapus!');
    }

    // Menampilkan Daftar Mahasiswa
    public function mahasiswaIndex()
    {
        $mahasiswaData = Mahasiswa::all();  // Ambil data mahasiswa
        return view('admin.management.mahasiswa.index', compact('mahasiswaData'));
    }

    // Menyimpan Mahasiswa Baru
    public function mahasiswaStore(Request $request)
    {
        $request->validate([
            'nrp' => 'required|unique:mahasiswa,nrp',  // Misalnya NRP Mahasiswa unik
            'password' => 'required|string|min:8|confirmed',  // Validasi password
        ]);

        // Menyimpan data Mahasiswa dengan password terenkripsi
        Mahasiswa::create([
            'nrp' => $request->nrp,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.management.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    // Menghapus Mahasiswa
    public function mahasiswaDestroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('admin.management.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }
}
