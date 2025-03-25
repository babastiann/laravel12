<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('surat', function (Blueprint $table) {
            $table->id('id_surat');
            $table->date('tanggal_surat');
            $table->enum('status_surat', ['diajukan', 'diproses', 'diterima', 'ditolak'])->default('diajukan');
            $table->string('nomor_surat', 50)->unique()->nullable();
            $table->string('file_surat', 255)->nullable();
            $table->string('nrp_mahasiswa', 20);
            $table->string('nik_kaprodi', 20)->nullable();
            $table->text('detail_surat');
            $table->enum('jenis_surat', ['Pengantar Tugas', 'Keterangan Lulus', 'Laporan Hasil Studi', 'Keterangan Mahasiswa Aktif']);
            $table->timestamps();

            $table->foreign('nrp_mahasiswa')->references('nrp')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('nik_kaprodi')->references('nik')->on('kaprodi')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('surat');
    }
};
