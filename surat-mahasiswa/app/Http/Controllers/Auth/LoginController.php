<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $identifier = $request->input('identifier');
    $password = $request->input('password');

    // Cari user berdasarkan email atau userable_id
    $user = User::where('email', $identifier)
                ->orWhere('userable_id', (string) $identifier)
                ->first();

    if ($user && Hash::check($password, $user->password)) {
        Auth::login($user);


        // Pastikan nilai userable_type terbaca
        if (!$user->userable_type) {
            Auth::logout();
            return redirect()->route('login')->withErrors('Gagal login, role tidak ditemukan.');
        }
        
        // Redirect sesuai role
        if ($user->userable_type === 'App\Models\Mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        } elseif ($user->userable_type === 'App\Models\Kaprodi') {
            return redirect()->route('kaprodi.dashboard');
        } elseif ($user->userable_type === 'App\Models\Karyawan') {
            return redirect()->route('karyawan.dashboard');
        } else {
            return redirect('/'); // Fallback jika user tidak memiliki tipe yang cocok
        }
    }

    return back()->withErrors(['identifier' => 'User tidak ditemukan di database']);
    }
}