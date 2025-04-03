<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Mahasiswa extends Model
{
    protected $morphClass = 'App\Models\Mahasiswa'; // Menyimpan nama kelas lengkap
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    use HasFactory;

    protected $table = 'mahasiswa'; // Pastikan nama tabel sesuai dengan yang dibuat di database

    protected $fillable = ['nrp', 'nama', 'prodi', 'address', 'phone', 'profile_picture'];
}
