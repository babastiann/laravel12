<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;

    protected $morphClass = 'App\Models\Kaprodi'; // Menyimpan nama kelas lengkap
    protected $table = 'kaprodi'; // Pastikan nama tabel sesuai dengan yang ada di database

    protected $fillable = ['nik', 'nama', 'prodi', 'address', 'phone'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
