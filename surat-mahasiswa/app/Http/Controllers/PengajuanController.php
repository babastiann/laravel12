<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kaprodi;
use App\Models\Surat;

// untuk mengajukan surat mahasiswa
class PengajuanController extends Controller
{
    public function create()
    {
        return view('mahasiswa.pengajuan'); // Sesuaikan dengan view form pengajuan surat
    }

    public function store(Request $request)
    {

        $request->validate([
            'jenis_surat' => 'required|in:Pengantar Tugas,Keterangan Lulus,Laporan Hasil Studi,Keterangan Mahasiswa Aktif',
            'detail_surat' => 'required',
        ]);

        Surat::create([
            'tanggal_surat' => now(),
            'status_surat' => 'diajukan',
            'nrp_mahasiswa' => auth()->user()->userable_id,
            'nik_kaprodi' => $request->nik_kaprodi, // Simpan nik_kaprodi
            'jenis_surat' => $request->jenis_surat,
            'detail_surat' => $request->detail_surat,
            'semester' => $request->semester,
            'kode_mk' => $request->kode_mk,
            'nama_mk'=> $request->nama_mk
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pengajuan surat berhasil dikirim.');
    }
}
