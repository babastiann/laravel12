<?php
namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Kaprodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Mahasiswa;


class SuratController extends Controller {

    // Mahasiswa mengajukan surat
    public function create() {
        return view('mahasiswa.surat.create');
    }

    // Mahasiswa mengajukan surat
public function store(Request $request)
{
    dd(auth()->user()->userable); // Debug untuk melihat tipe user yang login
    
    $request->validate([
        'jenis_surat' => 'required',
        'detail_surat' => 'required',
    ]);

    // Ambil Mahasiswa yang sedang login
    $mahasiswa = auth()->user()->userable;

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Akun ini bukan mahasiswa.');
    }

    // Cari Kaprodi berdasarkan prodi mahasiswa
    $kaprodi = Kaprodi::where('prodi', $mahasiswa->prodi)->first();

    if (!$kaprodi) {
        return redirect()->back()->with('error', 'Tidak ada Kaprodi untuk prodi ini.');
    }

    // Simpan surat ke database
    $surat = Surat::create([
        'jenis_surat'   => $request->jenis_surat,
        'detail_surat'  => $request->detail_surat,
        'status_surat'  => 'pending', // Status default saat diajukan
        'nrp_mahasiswa' => $mahasiswa->nrp, // Ambil NRP dari mahasiswa yang login
        'nik_kaprodi'   => $kaprodi->nik,  // Ambil NIK Kaprodi dari prodi mahasiswa
        'tanggal_surat' => now(),
    ]);

    return redirect()->route('mahasiswa.dashboard')->with('success', 'Pengajuan surat berhasil dikirim.');
}

    // Kaprodi melihat dan memproses surat
    public function indexKaprodi() {
        $user = auth()->user();

        if (!$user->userable instanceof Kaprodi) {
            return redirect()->back()->with('error', 'Anda bukan Kaprodi.');
        }

        $surat = Surat::where('status_surat', 'pending')
                     ->where('nik_kaprodi', $user->userable->nik)
                     ->get();

        return view('kaprodi.surat.index', compact('surat'));
    }


    public function approve($id) {
        $user = auth()->user();

        if (!$user->userable instanceof Kaprodi) {
            return redirect()->back()->with('error', 'Anda bukan Kaprodi.');
        }

        $surat = Surat::findOrFail($id);
        $surat->update([
            'status_surat' => 'diproses',
            'nik_kaprodi' => $user->userable->nik,
        ]);

        return redirect()->back()->with('success', 'Surat telah disetujui untuk diproses.');
    }


    public function reject($id) {
        $surat = Surat::findOrFail($id);

        // Pastikan yang login adalah Kaprodi
        if (auth()->user()->userable_type !== 'App\Models\Kaprodi') {
            return redirect()->back()->with('error', 'Anda bukan Kaprodi.');
        }

        $surat->update([
            'status_surat' => 'ditolak',
            'nik_kaprodi' => auth()->user()->userable->nik, // Ambil NIK Kaprodi dari user
        ]);

        return redirect()->back()->with('error', 'Surat telah ditolak.');
    }

    // Karyawan mengeluarkan surat
    public function indexKaryawan() {
        $surat = Surat::where('status_surat', 'diproses')->get();
        return view('karyawan.surat.index', compact('surat'));
    }

    public function issueLetter(Request $request, $id) {
        $request->validate(['file_surat' => 'required|mimes:pdf,doc,docx']);

        $surat = Surat::findOrFail($id);
        $path = $request->file('file_surat')->store('surat');

        $surat->update([
            'file_surat' => $path,
            'status_surat' => 'diterima'
        ]);

        return redirect()->back()->with('success', 'Surat berhasil dikeluarkan.');
    }

    // Mahasiswa melihat status surat
    public function indexMahasiswa() {
        $user = auth()->user();

        if ($user->userable_type !== Mahasiswa::class) {
            return redirect()->back()->with('error', 'Akun ini bukan mahasiswa.');
        }

        $mahasiswa = $user->userable;
        $surat = Surat::where('nrp_mahasiswa', $mahasiswa->nrp)->get();
        return view('mahasiswa.surat.index', compact('surat'));
    }
}
