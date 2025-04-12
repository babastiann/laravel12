-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 12:27 PM
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
(21, '1234567890', 'RobbyTan', 'Teknik Informatika', NULL, NULL, '2025-04-12 03:18:34', '2025-04-12 03:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
(2, '9876543210', 'Ahmad Alexander', NULL, 'Garut', '08312389', 'default.jpg', '2025-03-23 18:04:59', '2025-04-05 05:10:50'),
(6, '810080', 'Azis', 'Teknik Informatika', 'Jl. Kopo No.1', '08123456789', 'default.jpg', '2025-04-12 01:43:56', '2025-04-12 01:43:56'),
(7, '810081', 'AndreTaulany', 'Sistem Informasi', 'Jl. Cijerah No.1', '08123456789', 'default.jpg', '2025-04-12 01:43:56', '2025-04-12 01:43:56'),
(8, '810082', 'Parto', 'Sistem Komputer', 'Jl. Soreang No.80', '08123456789', 'default.jpg', '2025-04-12 01:43:56', '2025-04-12 01:43:56');

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
(35, '2372051', 'Muhammad Syehan Alwafa', 'Teknik Informatika', NULL, NULL, NULL, '2025-04-12 03:07:49', '2025-04-12 03:07:49');

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
(5, '2025_03_19_183829_create_sessions_table', 1),
(6, '2025_03_19_234157_modify_userable_id_in_users_table', 1),
(7, '2025_03_24_031824_create_cache_table', 1),
(8, '2025_04_03_064621_add_role_to_users_table', 1);

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
('QZ4K10vnLlMcLJdsyjMpzsViYpFCS3ldwQ2eH5IB', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQUduYTlnNXp4dE5ZUGdFMXNHOTdHRGdJdU51RFRzdzZZYTZVNHhrViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tYWhhc2lzd2EvZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1744453217);

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
(4, '2025-04-03', 'diterima', NULL, '1743775294_Tugas_Greedy_C_2372051_2372066.pdf', '2372051', 'Muhammad Syehan Alwafa', 'lulus', 'Keterangan Lulus', '2025-04-03 06:56:22', '2025-04-04 07:01:35', NULL, NULL, NULL),
(8, '2025-04-12', 'diterima', NULL, NULL, '2372066', 'budi', 'aaaa', 'Keterangan Mahasiswa Aktif', '2025-04-11 21:47:27', '2025-04-11 21:47:41', '4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `userable_id` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `userable_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `userable_id`, `role`, `userable_type`, `created_at`, `updated_at`, `photo`) VALUES
(1, 'staff@example.com', '$2y$12$bF5fvBTTJxL99KxYCzZPs.BtOvtWkf828Jfrh7mJIphEtPIALMdKe', '1', NULL, 'App\\Models\\Karyawan', '2025-03-23 18:04:19', '2025-03-24 21:22:29', NULL),
(2, 'budisantoso@example.com', '$2y$12$JqzOBVYg24kAXz/YTnzQH.lusLEtlahBTrJnpCkUycB..O1BADj86', '2372066', NULL, 'App\\Models\\Mahasiswa', '2025-03-23 18:04:59', '2025-04-03 07:21:09', 'Ic56iLoyk6hEh5H51ag90S0fkr5lj8cdsBqyrXXE.jpg'),
(3, 'siti@example.com', '$2y$12$Q6lcA.DA2eyiTzkk/F8s9uRcogTJNycMnd0Tgh9Zzs/rulAA5T8gy', '1234567890', NULL, 'App\\Models\\Kaprodi', '2025-03-23 18:04:59', '2025-04-03 07:27:42', 'YfcUIrGi0rWZEEV46BUVWe9hiSgWjNSBL74jvwmI.jpg'),
(4, 'ahmad@example.com', '$2y$12$iBClyIodWgItoFPS72fnr.QxxGRj9F.Y4GqwbDGtvCBn2qqIck1Ta', '9876543210', NULL, 'App\\Models\\Karyawan', '2025-03-23 18:05:00', '2025-04-05 05:11:38', 'ERMRof2FNhp4KJhv86qBHzgN06LYjW6wX9gA4M23.jpg'),
(41, 'bakri1@gmail.com', '$2y$12$A/eQLG4kuriHyXjeYEAqTOc/TjSNsD8BQGObDaWOvhcyCp5ZIjOGO', '8100079', NULL, 'App\\Models\\Kaprodi', '2025-04-11 22:48:42', '2025-04-12 01:18:40', NULL),
(70, 'azis@gmail.com', '$2y$12$QrQId94zlzMocaI1/y6yyO.jNRFiEGaPqLfp3nbhf7vX4UfzlZTxe', '810080', NULL, 'App\\Models\\Karyawan', '2025-04-12 01:43:56', '2025-04-12 01:43:56', NULL),
(71, 'andre@gmail.com', '$2y$12$SoGz57s3r/8d0Q.OFfQ0NOkyLgJneqofKZ6sBpB2dEbluUmBdmQ1K', '810081', NULL, 'App\\Models\\Karyawan', '2025-04-12 01:43:56', '2025-04-12 03:19:48', 'gtwnJ5Q01bCBCCKyXTMcuBZ0MrBLMUk0oqgxCkts.jpg'),
(72, 'Parto@gmail.com', '$2y$12$TQcNV0/CrwJev3NVF7H6BOrWFkOtsBl.QD.Vfv56GukJvA5UhYjcW', '810082', NULL, 'App\\Models\\Karyawan', '2025-04-12 01:43:56', '2025-04-12 01:43:56', NULL),
(73, 'syehanalwafa4@gmail.com', '$2y$12$ZpYzX18Efjr81gf6vjImD.IMw801.6zsgyY.Vl88Uw.6UxaQlAkMq', '2372051', NULL, 'App\\Models\\Mahasiswa', '2025-04-12 03:07:49', '2025-04-12 03:13:41', NULL),
(74, 'robby@gmail.com', '$2y$12$DD/yK5w/4EwQLwI/biuU3u7Po7E4WMhtl4mBtlLGI92cSKGsxESZe', '1234567890', NULL, 'App\\Models\\Kaprodi', '2025-04-12 03:18:35', '2025-04-12 03:18:35', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
