CREATE DATABASE surat_mahasiswa;
USE surat_mahasiswa;

-- Tabel Users (untuk autentikasi)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    userable_id INT NOT NULL,
    userable_type ENUM('Mahasiswa', 'Kaprodi', 'Karyawan') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Kaprodi (detail untuk kaprodi)
CREATE TABLE kaprodi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    prodi VARCHAR(100) NOT NULL UNIQUE,
    address TEXT,
    phone VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Mahasiswa (detail untuk mahasiswa)
CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nrp VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    prodi VARCHAR(100) NOT NULL,
    address TEXT,
    phone VARCHAR(15),
    profile_picture VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Karyawan (detail untuk karyawan/staff)
CREATE TABLE karyawan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    prodi VARCHAR(100),
    address TEXT,
    phone VARCHAR(15),
    profile_picture VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Surat (pengajuan surat) menggunakan nrp dan nik sebagai referensi
CREATE TABLE surat (
    id_surat INT AUTO_INCREMENT PRIMARY KEY,
    tanggal_surat DATE NOT NULL,
    status_surat ENUM('diajukan', 'diproses', 'diterima', 'ditolak') NOT NULL,
    nomor_surat VARCHAR(50) UNIQUE,
    file_surat VARCHAR(255),
    nrp_mahasiswa VARCHAR(20),
    nik_kaprodi VARCHAR(20),
    detail_surat TEXT NOT NULL,
    jenis_surat ENUM('Pengantar Tugas', 'Keterangan Lulus', 'Laporan Hasil Studi', 'Keterangan Mahasiswa Aktif') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (nrp_mahasiswa) REFERENCES mahasiswa(nrp) ON DELETE CASCADE,
    FOREIGN KEY (nik_kaprodi) REFERENCES kaprodi(nik) ON DELETE CASCADE
);


ALTER TABLE users MODIFY userable_id VARCHAR(20) NOT NULL;
