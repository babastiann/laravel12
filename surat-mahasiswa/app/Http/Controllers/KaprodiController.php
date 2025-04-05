<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;

class KaprodiController extends Controller
{
    // Menampilkan dashboard dengan daftar surat
    public function dashboard()
    {
        $kaprodi = auth()->user()->kaprodi;
        $prodi = $kaprodi->prodi;

    // Ambil surat dari mahasiswa yang se-prodi
    $surat = Surat::with('mahasiswa')
        ->whereHas('mahasiswa', function ($query) use ($prodi) {
            $query->where('prodi', $prodi);
        })
        ->get();

    return view('kaprodi.dashboard', compact('surat'));
    }


    // Menyetujui surat
        public function approve($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->status_surat = 'diterima'; // ✅ Pakai nilai yang ada di ENUM
        $surat->save();

        return redirect()->route('kaprodi.dashboard')->with('success', 'Surat berhasil disetujui.');
    }

    // Menolak surat
    public function reject(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->status_surat = 'ditolak'; // ✅ ENUM sesuai database
        $surat->save();

        return redirect()->route('kaprodi.dashboard')->with('success', 'Surat berhasil ditolak.');
    }

}