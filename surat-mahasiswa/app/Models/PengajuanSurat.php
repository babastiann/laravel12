<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model {
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id', 'kaprodi_id', 'karyawan_id', 'jenis_surat',
        'keterangan', 'status', 'file_surat'
    ];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kaprodi() {
        return $this->belongsTo(User::class, 'kaprodi_id');
    }

    public function karyawan() {
        return $this->belongsTo(User::class, 'karyawan_id');
    }
}
