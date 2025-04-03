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

        User::firstOrCreate([
            'userable_id' => $mahasiswa->nrp,
            'userable_type' => 'Mahasiswa',
        ], [
            'email' => 'syehan@example.com',
            'password' => Hash::make('password123'),
        ]);

        // // Seeder untuk Kaprodi
        // $kaprodi = Kaprodi::firstOrCreate([
        //     'nik' => '1234567890',
        // ], [
        //     'nama' => 'Dr. Siti Aminah',
        //     'prodi' => 'Teknik Informatika',
        //     'address' => 'Bandung',
        //     'phone' => '081234567891',
        // ]);

        // User::firstOrCreate([
        //     'userable_id' => $kaprodi->nik,
        //     'userable_type' => 'Kaprodi',
        // ], [
        //     'email' => 'siti@example.com',
        //     'password' => Hash::make('password123'),
        // ]);

        // // Seeder untuk Karyawan
        // $karyawan = Karyawan::firstOrCreate([
        //     'nik' => '9876543210',
        // ], [
        //     'nama' => 'Ahmad Subari',
        //     'prodi' => null,
        //     'address' => 'Jakarta',
        //     'phone' => '081234567892',
        //     'profile_picture' => 'default.jpg',
        // ]);

        // User::firstOrCreate([
        //     'userable_id' => $karyawan->nik,
        //     'userable_type' => 'Karyawan',
        // ], [
        //     'email' => 'ahmad@example.com',
        //     'password' => Hash::make('password123'),
        // ]);

        echo "Seeder User berhasil dijalankan!\n";
    }
}
