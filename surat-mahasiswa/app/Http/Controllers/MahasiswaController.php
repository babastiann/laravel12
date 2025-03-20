<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{

    public function create()
    {
        return view('mahasiswa.create'); // Pastikan file view ini ada di resources/views/mahasiswa/
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nrp' => 'required|unique:mahasiswa,nrp',
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'prodi' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable'
        ]);

        // Simpan data mahasiswa ke tabel mahasiswa
        $mahasiswa = Mahasiswa::create([
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        // Simpan data user ke tabel users
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'userable_id' => $mahasiswa->nrp,
            'userable_type' => 'Mahasiswa'
        ]);

        return redirect()->route('karyawan.dashboard')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }
}
