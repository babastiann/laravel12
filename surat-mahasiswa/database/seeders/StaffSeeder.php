<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff = Karyawan::create([
            'nik'             => '1234567',
            'nama'            => 'Staff Management',
            'prodi'           => null, // Staff tidak terkait dengan prodi
            'address'         => 'Jl. Staff 123, Jakarta',
            'phone'           => '08123456789',
            'profile_picture' => 'default.jpg',
        ]);

        User::create([
            'email'         => 'staff@example.com',
            'password'      => Hash::make('password123'),
            'userable_id'   => $staff->id,
            'userable_type' => 'Karyawan',
        ]);
    }
}
