<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // TU Teknik Informatika
        $staff = Karyawan::create([
            'nik'             => '810080',
            'nama'            => 'Azis',
            'prodi'           => 'Teknik Informatika', // Staff tidak terkait dengan prodi
            'address'         => 'Jl. Kopo No.1',
            'phone'           => '08123456789',
            'profile_picture' => 'default.jpg',
        ]);

        User::create([
            'email'         => 'azis@gmail.com',
            'password'      => Hash::make('password123'),
            'userable_id'   => $staff->nik,
            'userable_type' => \App\Models\Karyawan::class,
        ]);

        // TU Sistem Informasi
        $staff = Karyawan::create([
            'nik'             => '810081',
            'nama'            => 'AndreTaulany',
            'prodi'           => 'Sistem Informasi', // Staff tidak terkait dengan prodi
            'address'         => 'Jl. Cijerah No.1',
            'phone'           => '08123456789',
            'profile_picture' => 'default.jpg',
        ]);

        User::create([
            'email'         => 'andre@gmail.com',
            'password'      => Hash::make('password123'),
            'userable_id'   => $staff->nik,
            'userable_type' => \App\Models\Karyawan::class,
        ]);

        // TU Sistem Komputer
        $staff = Karyawan::create([
            'nik'             => '810082',
            'nama'            => 'Parto',
            'prodi'           => 'Sistem Komputer', // Staff tidak terkait dengan prodi
            'address'         => 'Jl. Soreang No.80',
            'phone'           => '08123456789',
            'profile_picture' => 'default.jpg',
        ]);

        User::create([
            'email'         => 'Parto@gmail.com',
            'password'      => Hash::make('password123'),
            'userable_id'   => $staff->nik,
            'userable_type' => \App\Models\Karyawan::class,
        ]);
    }
}
