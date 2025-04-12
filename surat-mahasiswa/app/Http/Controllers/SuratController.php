<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;



// berfungsi untuk melihat dan mengunduh surat
class SuratController extends Controller
{
        public function index()
    {
        $surat = Surat::with('mahasiswa')->get(); // Eager loading mahasiswa
        dd($surat);
        return view('surat.index', compact('surat'));
    }


public function download($id)
{
    $surat = Surat::findOrFail($id);

    if (!$surat->file_surat) {
        return back()->with('error', 'File belum tersedia.');
    }

    $filePath = storage_path('app/public/surat/' . $surat->file_surat);

    if (!file_exists($filePath)) {
        return back()->with('error', 'File tidak ditemukan.');
    }

    return response()->download($filePath);
}
}
