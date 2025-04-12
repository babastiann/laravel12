<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Mahasiswa;
use App\Models\Kaprodi;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeder untuk Mahasiswa
        $mahasiswa = Mahasiswa::firstOrCreate([
            'nrp' => '2372051',
        ], [
            'nama' => 'Muhammad Syehan Alwafa',
            'prodi' => 'Teknik Informatika',
            'address' => 'Surabaya',
            'phone' => '081234567890',
            'profile_picture' => 'default.jpg',
        ]);

        // Debugging untuk memastikan ID tidak null
        if (!$mahasiswa->id) {
            dd('Error: Mahasiswa ID is NULL', $mahasiswa);
        }

        // Pastikan tidak ada duplikasi pengguna untuk mahasiswa ini
        $existingUser = User::where('userable_id', $mahasiswa->nrp)
                        ->where('userable_type', \App\Models\Mahasiswa::class)
                        ->where('email', 'syehanalwafa2@gmail.com')
                        ->first();

        if (!$existingUser) {
            User::firstOrCreate([
                'userable_id' => $mahasiswa->nrp,
                'userable_type' => \App\Models\Mahasiswa::class,
            ], [
                'email' => 'syehanalwafa2@gmail.com',
                'password' => Hash::make('password123'),
            ]);
        }

        echo "Seeder User berhasil dijalankan!\n";


        // Seeder untuk Kaprodi
        $kaprodi = Kaprodi::firstOrCreate([
            'nik' => '1234567890',
        ], [
            'nama' => 'Dr. Siti Aminah',
            'prodi' => 'Teknik Informatika',
            'address' => 'Bandung',
            'phone' => '081234567891',
        ]);

        User::firstOrCreate([
            'userable_id' => $kaprodi->nik,
            'userable_type' => \App\Models\Kaprodi::class,
        ], [
            'email' => 'siti@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Seeder untuk Karyawan
        $karyawan = Karyawan::firstOrCreate([
            'nik' => '9876543210',
        ], [
            'nama' => 'Ahmad Subari',
            'prodi' => null,
            'address' => 'Jakarta',
            'phone' => '081234567892',
            'profile_picture' => 'default.jpg',
        ]);

        User::firstOrCreate([
            'userable_id' => $karyawan->nik,
            'userable_type' => \App\Models\Karyawan::class,
        ], [
            'email' => 'ahmad@example.com',
            'password' => Hash::make('password123'),
        ]);

        echo "Seeder User berhasil dijalankan!\n";
    }
}
