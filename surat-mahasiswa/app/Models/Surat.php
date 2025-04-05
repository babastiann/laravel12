<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat'; // Nama tabel tetap 'surat'
    protected $primaryKey = 'id_surat';

    protected $fillable = [
        'tanggal_surat',
        'status_surat',
        'nomor_surat',
        'file_surat',
        'nrp_mahasiswa',
        'nama',
        'detail_surat',
        'jenis_surat',
        'semester',
        'kode_mk',
        'nama_mk'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(\App\Models\Mahasiswa::class, 'nrp_mahasiswa', 'nrp');
    }

}
