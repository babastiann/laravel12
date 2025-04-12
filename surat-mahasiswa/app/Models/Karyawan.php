<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    use HasFactory;
    protected $morphClass = 'App\Models\Karyawan'; // Menyimpan nama kelas lengkap
    protected $table = 'karyawan'; // Pastikan ini sesuai dengan nama tabel di database

    protected $fillable = [
        'nik', 'nama', 'prodi', 'address', 'phone', 'profile_picture'
    ];
}
