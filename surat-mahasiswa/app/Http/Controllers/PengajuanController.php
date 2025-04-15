<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kaprodi;
use App\Models\Surat;
use App\Models\Mahasiswa;


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

        // Check if the mahasiswa exists
        if (!Mahasiswa::where('nrp', auth()->user()->userable_id)->exists()) {
            return redirect()->back()->withErrors(['nrp' => 'Mahasiswa tidak ditemukan.']);
        }

        Surat::create([
            'tanggal_surat' => now(),
            'status_surat' => 'diajukan',
            'nrp_mahasiswa' => auth()->user()->userable_id,
            'nama' => auth()->user()->mahasiswa->nama,
            'jenis_surat' => $request->jenis_surat,
            'detail_surat' => $request->detail_surat,
            'semester' => $request->semester,
            'kode_mk' => $request->kode_mk,
            'nama_mk'=> $request->nama_mk
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pengajuan surat berhasil dikirim.');
    }

        public function index()
    {
        $surat = Surat::where('nrp_mahasiswa', auth()->user()->nrp)->get();
        return view('mahasiswa.pengajuan.index', compact('surat'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $surat = Surat::where('id_surat', $id)
            ->where('nrp_mahasiswa', auth()->user()->userable_id)
            ->firstOrFail();

        // Tambahan: hanya bisa edit jika status  diajukan
        if (!in_array($surat->status_surat, ['diajukan'])) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Surat tidak dapat diedit karena statusnya tidak valid.');
        }

        return view('mahasiswa.edit', compact('surat'));
    }

    // Menyimpan perubahan surat
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_surat' => 'required|in:Pengantar Tugas,Keterangan Lulus,Laporan Hasil Studi,Keterangan Mahasiswa Aktif',
            'detail_surat' => 'required',
        ]);

        $surat = Surat::where('id_surat', $id)
            ->where('nrp_mahasiswa', auth()->user()->userable_id)
            ->firstOrFail();

        // Tambahan: hanya bisa update jika status diajukan
        if (!in_array($surat->status_surat, ['diajukan'])) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Surat tidak dapat diperbarui karena statusnya tidak valid.');
        }

        // Update data
        $surat->update([
            'jenis_surat' => $request->jenis_surat,
            'detail_surat' => $request->detail_surat,
            'semester' => $request->semester,
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Data surat berhasil diperbarui.');
    }

    // Menghapus surat
    public function destroy($id)
    {
        $surat = Surat::where('id_surat', $id)
            ->where('nrp_mahasiswa', auth()->user()->userable_id)
            ->firstOrFail();

        $surat->delete();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Surat berhasil dihapus.');
    }
}
