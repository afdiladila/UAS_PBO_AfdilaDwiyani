-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2026 at 01:05 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_trpl1a_afdiladwiyani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `semester` tinyint NOT NULL,
  `tarif_ukt_nominal` decimal(10,2) NOT NULL,
  `jenis_pembiayaan` enum('mandiri','bidikmisi','prestasi') NOT NULL,
  `golongan_ukt` varchar(10) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nomor_kip_kuliah` varchar(30) DEFAULT NULL,
  `dana_saku_subsidi` decimal(10,2) DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt_nominal`, `jenis_pembiayaan`, `golongan_ukt`, `nama_wali`, `nomor_kip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, 'Afdila Dwiyani', '202601001', 2, 5500000.00, 'mandiri', 'Golongan 4', 'Budi Santoso', NULL, NULL, NULL, NULL),
(2, 'Rian Hidayat', '202601002', 2, 7500000.00, 'mandiri', 'Golongan 5', 'Ahmad Subagja', NULL, NULL, NULL, NULL),
(3, 'Siti Aminah', '202601003', 4, 4500000.00, 'mandiri', 'Golongan 3', 'Mulyono', NULL, NULL, NULL, NULL),
(4, 'Fajar Nugraha', '202601004', 4, 5500000.00, 'mandiri', 'Golongan 4', 'Hendra Wijaya', NULL, NULL, NULL, NULL),
(5, 'Dewi Lestari', '202601005', 6, 9000000.00, 'mandiri', 'Golongan 6', 'Suryadi', NULL, NULL, NULL, NULL),
(6, 'Adi Setiawan', '202601006', 6, 4500000.00, 'mandiri', 'Golongan 3', 'Eko Prasetyo', NULL, NULL, NULL, NULL),
(7, 'Bambang Pamungkas', '202601007', 2, 7500000.00, 'mandiri', 'Golongan 5', 'Joko Widodo', NULL, NULL, NULL, NULL),
(8, 'Citra Kirana', '202601008', 4, 5500000.00, 'mandiri', 'Golongan 4', 'Rudi Hermawan', NULL, NULL, NULL, NULL),
(9, 'Gilang Dirga', '202601009', 8, 4500000.00, 'mandiri', 'Golongan 3', 'Agus Salim', NULL, NULL, NULL, NULL),
(10, 'Andi Wijaya', '202602001', 2, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2026-0011', 1200000.00, NULL, NULL),
(11, 'Budi Doremi', '202602002', 2, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2026-0012', 1200000.00, NULL, NULL),
(12, 'Cici Paramida', '202602003', 4, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2026-0013', 1200000.00, NULL, NULL),
(13, 'Dedi Corbuzier', '202602004', 4, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2026-0014', 1200000.00, NULL, NULL),
(14, 'Eka Gustiwana', '202602005', 6, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2026-0015', 1250000.00, NULL, NULL),
(15, 'Farah Quinn', '202602006', 6, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2026-0016', 1250000.00, NULL, NULL),
(16, 'Hendra Setiawan', '202602007', 8, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2026-0017', 1250000.00, NULL, NULL),
(17, 'Indah Permatasari', '202602008', 2, 0.00, 'bidikmisi', NULL, NULL, 'KIP-2026-0018', 1200000.00, NULL, NULL),
(18, 'Kevin Sanjaya', '202603001', 2, 1000000.00, 'prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50),
(19, 'Lesti Kejora', '202603002', 2, 1500000.00, 'prestasi', NULL, NULL, NULL, NULL, 'Yayasan Toyota Astra', 3.30),
(20, 'Maia Estianty', '202603003', 4, 0.00, 'prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Bank Indonesia', 3.60),
(21, 'Nadiem Makarim', '202603004', 4, 2000000.00, 'prestasi', NULL, NULL, NULL, NULL, 'Tanoto Foundation', 3.50),
(22, 'Onadio Leonardo', '202603005', 6, 0.00, 'prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan Kemendikbud', 3.75),
(23, 'Putri Ariani', '202603006', 6, 1000000.00, 'prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50),
(24, 'Raffi Ahmad', '202603007', 8, 1500000.00, 'prestasi', NULL, NULL, NULL, NULL, 'Yayasan Toyota Astra', 3.30),
(25, 'Sandiaga Uno', '202603008', 2, 0.00, 'prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Bank Indonesia', 3.60);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
