<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // Pastikan tabelnya sesuai dengan database
    protected $primaryKey = 'nrp'; // Jika NRP adalah primary key
    public $incrementing = false;  // Jika NRP bukan auto-increment
    protected $keyType = 'string'; // Jika NRP menggunakan string

    protected $fillable = ['nrp', 'nama', 'prodi', 'address', 'phone', 'profile_picture'];

    // Relasi ke model User (untuk autentikasi mahasiswa)
    public function user()
    {
        return $this->morphOne(\App\Models\User::class, 'userable');
    }

    // Relasi ke Kaprodi berdasarkan program studi
    public function kaprodi()
    {
        return $this->belongsTo(Kaprodi::class, 'prodi', 'prodi');
    }

    // Relasi ke Surat berdasarkan NRP
    public function surat()
    {
        return $this->hasMany(Surat::class, 'nrp_mahasiswa', 'nrp');
    }
}
