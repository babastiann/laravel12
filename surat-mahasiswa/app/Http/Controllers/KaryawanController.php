<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
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
}
