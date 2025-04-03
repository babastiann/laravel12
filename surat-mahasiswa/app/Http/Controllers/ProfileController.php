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
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'current_password' => 'required_with:password',
        ]);

        $user = Auth::user();

        // Jika mengubah password, cek apakah password lama benar
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->save();

        return redirect()->route('profile.myprofile')->with('success', 'Akun berhasil diperbarui!');
    }
}
