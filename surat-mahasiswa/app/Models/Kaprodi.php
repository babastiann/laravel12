<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;

    protected $table = 'kaprodi'; // Pastikan nama tabel sesuai dengan yang ada di database

    protected $fillable = ['nik', 'nama', 'prodi', 'address', 'phone'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function mahasiswa()
{
    return $this->hasMany(Mahasiswa::class, 'prodi', 'prodi');
}

}
