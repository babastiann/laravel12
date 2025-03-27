<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\Storage;

// berfungsi untuk melihat dan mengunduh surat
class SuratController extends Controller
{
        public function index()
    {
        $surat = Surat::all(); // Ambil semua surat
        return view('surat.index', compact('surat'));
    }

    public function download($id)
    {
        $surat = Surat::findOrFail($id);
        if ($surat->file_surat) {
            return Storage::download($surat->file_surat);
        }
        return back()->with('error', 'File surat belum tersedia.');
    }
}
