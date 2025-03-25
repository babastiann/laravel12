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
        'nik_kaprodi',
        'detail_surat',
        'jenis_surat'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nrp_mahasiswa', 'nrp');
    }

    public function kaprodi()
    {
        return $this->belongsTo(Karyawan::class, 'nik_kaprodi', 'nik');
    }
}
