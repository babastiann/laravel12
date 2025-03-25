<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan daftar mahasiswa untuk karyawan
    public function index()
    {
        $mahasiswa = Mahasiswa::with('user')->get();
        return view('karyawan.dashboard', compact('mahasiswa'));
    }

    // Tampilkan form tambah mahasiswa
    public function create()
    {
        return view('mahasiswa.create');
    }

    // Simpan mahasiswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nrp' => 'required|unique:mahasiswa,nrp',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'prodi' => 'required|string|max:100',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:15'
        ]);

        // Simpan data mahasiswa
        $mahasiswa = Mahasiswa::create([
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        // Simpan akun user
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'userable_id' => $mahasiswa->id,
            'userable_type' => Mahasiswa::class
        ]);

        return redirect()->route('karyawan.dashboard')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Simpan perubahan ke database
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = $mahasiswa->user;

        $request->validate([
            'nrp' => 'required|string|unique:mahasiswa,nrp,' . $id . ',id',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'prodi' => 'required|string|max:100',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
        ]);

        $mahasiswa->update([
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        // Update email di tabel users
        if ($request->email !== $user->email) {
            $user->update([
                'email' => $request->email
            ]);
        }

        return redirect()->route('karyawan.dashboard')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    // Hapus mahasiswa dan akun terkait
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Hapus akun user
        if ($mahasiswa->user) {
            $mahasiswa->user->delete();
        }

        // Hapus mahasiswa
        $mahasiswa->delete();

        return redirect()->route('karyawan.dashboard')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
