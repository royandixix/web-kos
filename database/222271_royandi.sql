-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 01:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `222271_royandi`
--

-- --------------------------------------------------------

--
-- Table structure for table `kamar_222271`
--

CREATE TABLE `kamar_222271` (
  `id_222271` int(11) NOT NULL,
  `pemilik_kost_id_222271` int(11) NOT NULL,
  `nomor_kamar_222271` varchar(10) NOT NULL,
  `harga_222271` decimal(10,2) NOT NULL,
  `status_222271` enum('tersedia','disewa') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar_222271`
--

INSERT INTO `kamar_222271` (`id_222271`, `pemilik_kost_id_222271`, `nomor_kamar_222271`, `harga_222271`, `status_222271`) VALUES
(1, 2, 'A101', 1500000.00, 'tersedia'),
(2, 2, 'A102', 1600000.00, 'tersedia'),
(3, 2, 'A103', 1700000.00, 'disewa');

-- --------------------------------------------------------

--
-- Table structure for table `login_222271`
--

CREATE TABLE `login_222271` (
  `id_222271` int(11) NOT NULL,
  `pengguna_id_222271` int(11) NOT NULL,
  `username_222271` varchar(50) NOT NULL,
  `password_222271` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_222271`
--

INSERT INTO `login_222271` (`id_222271`, `pengguna_id_222271`, `username_222271`, `password_222271`) VALUES
(1, 1, 'royan', 'password123'),
(2, 2, 'andi', 'password456'),
(3, 3, 'admin', 'adminpass');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_222271`
--

CREATE TABLE `pembayaran_222271` (
  `id_222271` int(11) NOT NULL,
  `penghuni_kost_id_222271` int(11) NOT NULL,
  `kamar_id_222271` int(11) NOT NULL,
  `tanggal_pembayaran_222271` date NOT NULL,
  `jumlah_222271` decimal(10,2) NOT NULL,
  `status_222271` enum('lunas','belum lunas') DEFAULT 'belum lunas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran_222271`
--

INSERT INTO `pembayaran_222271` (`id_222271`, `penghuni_kost_id_222271`, `kamar_id_222271`, `tanggal_pembayaran_222271`, `jumlah_222271`, `status_222271`) VALUES
(1, 1, 3, '2024-10-07', 1700000.00, 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_222271`
--

CREATE TABLE `pengguna_222271` (
  `id_222271` int(11) NOT NULL,
  `nama_222271` varchar(100) NOT NULL,
  `email_222271` varchar(100) NOT NULL,
  `no_hp_222271` varchar(15) NOT NULL,
  `role_222271` enum('penghuni','pemilik','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna_222271`
--

INSERT INTO `pengguna_222271` (`id_222271`, `nama_222271`, `email_222271`, `no_hp_222271`, `role_222271`) VALUES
(1, 'Royan', 'royan@gmail.com', '08123456789', 'penghuni'),
(2, 'Andi', 'andi@gmail.com', '08129876543', 'pemilik'),
(3, 'Admin', 'admin@example.com', '08127778888', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar_222271`
--
ALTER TABLE `kamar_222271`
  ADD PRIMARY KEY (`id_222271`),
  ADD UNIQUE KEY `nomor_kamar` (`nomor_kamar_222271`),
  ADD UNIQUE KEY `nomor_kamar_222271` (`nomor_kamar_222271`),
  ADD KEY `fk_pemilik_kost_kamar` (`pemilik_kost_id_222271`);

--
-- Indexes for table `login_222271`
--
ALTER TABLE `login_222271`
  ADD PRIMARY KEY (`id_222271`),
  ADD UNIQUE KEY `username` (`username_222271`),
  ADD UNIQUE KEY `username_222271` (`username_222271`),
  ADD KEY `fk_pengguna_login` (`pengguna_id_222271`);

--
-- Indexes for table `pembayaran_222271`
--
ALTER TABLE `pembayaran_222271`
  ADD PRIMARY KEY (`id_222271`),
  ADD KEY `fk_penghuni_pembayaran` (`penghuni_kost_id_222271`),
  ADD KEY `fk_kamar_pembayaran` (`kamar_id_222271`);

--
-- Indexes for table `pengguna_222271`
--
ALTER TABLE `pengguna_222271`
  ADD PRIMARY KEY (`id_222271`),
  ADD UNIQUE KEY `email` (`email_222271`),
  ADD UNIQUE KEY `email_222271` (`email_222271`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kamar_222271`
--
ALTER TABLE `kamar_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_222271`
--
ALTER TABLE `login_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran_222271`
--
ALTER TABLE `pembayaran_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna_222271`
--
ALTER TABLE `pengguna_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kamar_222271`
--
ALTER TABLE `kamar_222271`
  ADD CONSTRAINT `fk_pemilik_kost_kamar` FOREIGN KEY (`pemilik_kost_id_222271`) REFERENCES `pengguna_222271` (`id_222271`) ON DELETE CASCADE,
  ADD CONSTRAINT `kamar_222271_ibfk_1` FOREIGN KEY (`pemilik_kost_id_222271`) REFERENCES `pengguna_222271` (`id_222271`) ON DELETE CASCADE;

--
-- Constraints for table `login_222271`
--
ALTER TABLE `login_222271`
  ADD CONSTRAINT `fk_pengguna_login` FOREIGN KEY (`pengguna_id_222271`) REFERENCES `pengguna_222271` (`id_222271`) ON DELETE CASCADE,
  ADD CONSTRAINT `login_222271_ibfk_1` FOREIGN KEY (`pengguna_id_222271`) REFERENCES `pengguna_222271` (`id_222271`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran_222271`
--
ALTER TABLE `pembayaran_222271`
  ADD CONSTRAINT `fk_kamar_pembayaran` FOREIGN KEY (`kamar_id_222271`) REFERENCES `kamar_222271` (`id_222271`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_penghuni_pembayaran` FOREIGN KEY (`penghuni_kost_id_222271`) REFERENCES `pengguna_222271` (`id_222271`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayaran_222271_ibfk_1` FOREIGN KEY (`penghuni_kost_id_222271`) REFERENCES `pengguna_222271` (`id_222271`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayaran_222271_ibfk_2` FOREIGN KEY (`kamar_id_222271`) REFERENCES `kamar_222271` (`id_222271`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
