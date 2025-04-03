-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 04:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kaprodi`
--

CREATE TABLE `kaprodi` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kaprodi`
--

INSERT INTO `kaprodi` (`id`, `nik`, `nama`, `prodi`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, '1234567890', 'RobbyTan', 'Teknik Informatika', 'Bandung', '081234567891', '2025-03-23 18:04:59', '2025-04-03 02:24:29'),
(15, '8100085', 'saep', 'SISKOM', NULL, NULL, '2025-04-03 06:31:58', '2025-04-03 06:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `nama`, `prodi`, `address`, `phone`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, '1234567', 'Staff Management', NULL, 'Jl. Staff 123, Jakarta', '08123456789', 'default.jpg', '2025-03-23 18:04:18', '2025-03-23 18:04:18'),
(2, '9876543210', 'Ahmad Subari', NULL, 'Jakarta', '081234567892', 'default.jpg', '2025-03-23 18:04:59', '2025-03-23 18:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nrp` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nrp`, `nama`, `prodi`, `address`, `phone`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, '2372066', 'Budi Santoso', 'Teknik Informatika', 'Surabaya', '081234567890', 'default.jpg', '2025-03-23 18:04:59', '2025-03-23 18:04:59'),
(7, '2372051', 'Syehan', 'teknik informatika', NULL, NULL, NULL, '2025-04-03 06:32:49', '2025-04-03 06:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_03_19_183829_create_sessions_table', 1),
(2, '2025_03_19_234157_modify_userable_id_in_users_table', 1),
(3, '2025_03_24_031824_create_cache_table', 2),
(4, '2025_04_03_064621_add_role_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('WZtnMLkN0UC7I297plQmQvUn7mndr4NUq1oMS3Cl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidktFQWQ4dnY4TXlUQW53NTBpWGVvMEFDd0FsdVJrVE11NzBsVHR5WSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1743690480);

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id_surat` int(11) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `status_surat` enum('diajukan','diproses','diterima','ditolak') NOT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `file_surat` varchar(255) DEFAULT NULL,
  `nrp_mahasiswa` varchar(20) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `detail_surat` text NOT NULL,
  `jenis_surat` enum('Pengantar Tugas','Keterangan Lulus','Laporan Hasil Studi','Keterangan Mahasiswa Aktif') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `semester` varchar(10) DEFAULT NULL,
  `kode_mk` varchar(100) DEFAULT NULL,
  `nama_mk` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id_surat`, `tanggal_surat`, `status_surat`, `nomor_surat`, `file_surat`, `nrp_mahasiswa`, `nama`, `detail_surat`, `jenis_surat`, `created_at`, `updated_at`, `semester`, `kode_mk`, `nama_mk`) VALUES
(1, '2025-04-02', 'diterima', NULL, '1743612836_TUGAS_BFKelasC_2372051_2372066_MuhammadSyehanAlwafa_SebastianGamalielMoses.pdf', '2372066', 'syehan', 'anter tugas', 'Pengantar Tugas', '2025-04-02 09:51:38', '2025-04-02 09:53:56', NULL, 'In240', 'Jarkom'),
(2, '2025-04-03', 'ditolak', NULL, NULL, '2372066', 'Muhammad Syehan Alwafa', 'test123', 'Laporan Hasil Studi', '2025-04-02 20:22:59', '2025-04-02 20:23:16', NULL, NULL, NULL),
(3, '2025-04-03', 'diterima', NULL, NULL, '2372066', 'syehan', 'jarkom1', 'Pengantar Tugas', '2025-04-02 20:26:37', '2025-04-03 00:51:33', NULL, 'In240', 'Jarkom'),
(4, '2025-04-03', 'diajukan', NULL, NULL, '2372051', 'Muhammad Syehan Alwafa', 'lulus', 'Keterangan Lulus', '2025-04-03 06:56:22', '2025-04-03 06:56:22', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `userable_id` varchar(255) NOT NULL,
  `userable_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `photo` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `userable_id`, `userable_type`, `created_at`, `updated_at`, `photo`, `role`) VALUES
(1, 'staff@example.com', '$2y$12$bF5fvBTTJxL99KxYCzZPs.BtOvtWkf828Jfrh7mJIphEtPIALMdKe', '1', 'App\\Models\\Karyawan', '2025-03-23 18:04:19', '2025-03-24 21:22:29', NULL, NULL),
(2, 'budisantoso@example.com', '$2y$12$JqzOBVYg24kAXz/YTnzQH.lusLEtlahBTrJnpCkUycB..O1BADj86', '2372066', 'App\\Models\\Mahasiswa', '2025-03-23 18:04:59', '2025-04-03 07:21:09', 'Ic56iLoyk6hEh5H51ag90S0fkr5lj8cdsBqyrXXE.jpg', NULL),
(3, 'siti@example.com', '$2y$12$Q6lcA.DA2eyiTzkk/F8s9uRcogTJNycMnd0Tgh9Zzs/rulAA5T8gy', '1234567890', 'App\\Models\\Kaprodi', '2025-03-23 18:04:59', '2025-04-03 07:27:42', 'YfcUIrGi0rWZEEV46BUVWe9hiSgWjNSBL74jvwmI.jpg', NULL),
(4, 'ahmad@example.com', '$2y$12$5rv0tahhIs/7rbbLqwj14.rfGehMxH3S3mR7Zc9Gy9VBD0tO/MKBK', '9876543210', 'App\\Models\\Karyawan', '2025-03-23 18:05:00', '2025-04-03 07:26:50', 'ERMRof2FNhp4KJhv86qBHzgN06LYjW6wX9gA4M23.jpg', NULL),
(13, 'saep@gmail.com', '$2y$12$UOQHHxHnxTF1XZMzHBXFgu2kPbX.vh5YF7MzR5mevNEwb5dlt1qt6', '8100085', 'App\\Models\\Kaprodi', '2025-04-03 06:31:58', '2025-04-03 06:31:58', NULL, NULL),
(15, '2372051@maranatha.ac.id', '$2y$12$tf6PtOayLr6gtF5R2gY/R.f.UKcEBWe.giYi2KKLzflo1SN6fHk7q', '2372051', 'App\\Models\\Mahasiswa', '2025-04-03 06:32:49', '2025-04-03 07:01:29', 'xtT5ZtN948sYugdbzkJNFAgZueuY9U0h99EHComO.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `kaprodi`
--
ALTER TABLE `kaprodi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `prodi` (`prodi`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nrp` (`nrp`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kaprodi`
--
ALTER TABLE `kaprodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
