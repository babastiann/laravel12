<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data surat milik mahasiswa yang login
        $surat = Surat::where('nrp_mahasiswa', Auth::user()->userable_id)->get();

        // Debugging (jika data masih tidak muncul, coba hapus dd())
        // dd(Auth::user()->nrp, $surat);

        // Kirim data ke tampilan
        return view('mahasiswa.dashboard', compact('surat'));
    }
}

