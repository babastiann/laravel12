<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


abstract class Controller
{
    public function login(Request $request)
{
    $identifier = $request->input('identifier');
    $password   = $request->input('password');

    // Cek apakah identifier sesuai dengan Mahasiswa (nrp)
    $mahasiswa = \App\Models\Mahasiswa::where('nrp', $identifier)->first();
    if ($mahasiswa && $mahasiswa->user && \Illuminate\Support\Facades\Hash::check($password, $mahasiswa->user->password)) {
        \Illuminate\Support\Facades\Auth::login($mahasiswa->user);
        return redirect()->route('mahasiswa.dashboard');
    }

    // Cek apakah identifier sesuai dengan Kaprodi (nik)
    $kaprodi = \App\Models\Kaprodi::where('nik', $identifier)->first();
    if ($kaprodi && $kaprodi->user && \Illuminate\Support\Facades\Hash::check($password, $kaprodi->user->password)) {
        \Illuminate\Support\Facades\Auth::login($kaprodi->user);
        return redirect()->route('kaprodi.dashboard');
    }

    // Cek apakah identifier sesuai dengan Karyawan (nik)
    $karyawan = \App\Models\Karyawan::where('nik', $identifier)->first();
    if ($karyawan && $karyawan->user && \Illuminate\Support\Facades\Hash::check($password, $karyawan->user->password)) {
        \Illuminate\Support\Facades\Auth::login($karyawan->user);
        return redirect()->route('karyawan.dashboard');
    }

    // Jika tidak ditemukan
    return back()->withErrors(['identifier' => 'Identifier atau password salah']);
}
}
