<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    // Fungsi untuk mendapatkan view berdasarkan peran user
    private function getRoleView($viewName)
    {
        $user = Auth::user();

        if ($user->userable_type === 'App\Models\Mahasiswa') {
            return "mahasiswa.$viewName";
        } elseif ($user->userable_type === 'App\Models\Kaprodi') {
            return "kaprodi.$viewName";
        } elseif ($user->userable_type === 'App\Models\Karyawan') {
            return "karyawan.$viewName";
        }

        return abort(404, 'Role tidak dikenali.');
    }

    // ✅ Halaman My Profile
    public function myProfile()
    {
        return view($this->getRoleView('profile'), ['user' => Auth::user()]);
    }

    // ✅ Update Foto Profil (AJAX-friendly response)
    public function updatePhoto(Request $request)
    {
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user = Auth::user();

    // Hapus foto lama jika ada
    if ($user->photo && Storage::exists('public/' . $user->photo)) {
        Storage::delete('public/' . $user->photo);
    }

    // Simpan foto baru
    $path = $request->file('photo')->store('profile_photos', 'public');

    // Update di database
    $user->update(['photo' => basename($path)]);

    // Mengirimkan URL foto baru sebagai respons JSON
    return response()->json([
        'success' => true,
        'photo_url' => asset('storage/profile_photos/' . basename($path))
    ]);
    }

    // ✅ Halaman Account Setting
    public function accountSetting()
    {
        return view($this->getRoleView('account'), ['user' => Auth::user()]);
    }

    // ✅ Update Nama & Password
    public function updateAccount(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'password' => 'nullable|string|min:6|confirmed',
        'current_password' => 'required_with:password',
        'address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
    ]);

    // Ambil user yang sedang login
    $user = Auth::user();

    // 🔐 Update password jika diminta
    if ($request->filled('password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();
    }

    // ✅ Update ke tabel relasi (mahasiswa/kaprodi/karyawan)
    if ($user->userable_type === 'App\Models\Mahasiswa') {
        // Jika user adalah mahasiswa
        $user->mahasiswa->update([
            'nama' => $request->nama,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
    } elseif ($user->userable_type === 'App\Models\Karyawan') {
        // Jika user adalah karyawan (kaprodi/staff)
        $user->karyawan->update([
            'nama' => $request->nama,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
    } elseif ($user->userable_type === 'App\Models\Kaprodi') {
        // Jika user adalah karyawan (kaprodi/staff)
        $user->kaprodi->update([
            'nama' => $request->nama,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
    }

    // Redirect kembali ke halaman setting akun dengan pesan sukses
    return redirect()->route('profile.accountsetting')->with('success', 'Akun berhasil diperbarui!');
}

    
}
