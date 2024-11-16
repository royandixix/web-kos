-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 08:32 AM
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
  `alamat_222271` int(200) NOT NULL,
  `harga_222271` varchar(200) NOT NULL,
  `status_222271` enum('tersedia','disewa') DEFAULT 'tersedia',
  `deskripsi_222271` text DEFAULT NULL,
  `tanggal_tersedia_222271` date DEFAULT NULL,
  `fasilitas_222271` varchar(255) DEFAULT NULL,
  `foto_222271` varchar(255) DEFAULT NULL,
  `ukuran_222271` varchar(100) NOT NULL,
  `rating_222271` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar_222271`
--

INSERT INTO `kamar_222271` (`id_222271`, `alamat_222271`, `harga_222271`, `status_222271`, `deskripsi_222271`, `tanggal_tersedia_222271`, `fasilitas_222271`, `foto_222271`, `ukuran_222271`, `rating_222271`) VALUES
(13, 0, '12345', 'disewa', NULL, '2024-11-23', 'adsadwda', 'contoh-gambar-desain-koskosan-lahan-sempit-46.jpeg', '20 m²', 1.0),
(15, 0, '1', 'disewa', NULL, '2024-11-30', 'kamar dalam , tv, wc, wifi', '20210621-003531_miliki-usaha-koskosan-sendiri-dengan-pinjaman-online-ikuti-tips-ini-agar-lancar-mewujudkannya.jpeg,contoh-gambar-desain-koskosan-lahan-sempit-46.jpeg,hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295683-m.png', '3x4', 1.0),
(16, 0, '1', 'disewa', NULL, '2024-11-30', 'kamar dalam , tv, wc, wifi', '20210621-003531_miliki-usaha-koskosan-sendiri-dengan-pinjaman-online-ikuti-tips-ini-agar-lancar-mewujudkannya.jpeg,contoh-gambar-desain-koskosan-lahan-sempit-46.jpeg,hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295683-m.png', '3x4', 1.0),
(17, 0, '1', 'disewa', NULL, '2024-11-30', 'kamar dalam , tv, wc, wifi', '20210621-003531_miliki-usaha-koskosan-sendiri-dengan-pinjaman-online-ikuti-tips-ini-agar-lancar-mewujudkannya.jpeg,contoh-gambar-desain-koskosan-lahan-sempit-46.jpeg,hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295683-m.png', '3x4', 1.0),
(18, 0, '1', 'disewa', NULL, '2024-11-30', 'kamar dalam , tv, wc, wifi', '20210621-003531_miliki-usaha-koskosan-sendiri-dengan-pinjaman-online-ikuti-tips-ini-agar-lancar-mewujudkannya.jpeg,contoh-gambar-desain-koskosan-lahan-sempit-46.jpeg,hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295683-m.png', '3x4', 1.0),
(19, 0, '1', 'disewa', NULL, '2024-11-28', 'tidak ada kosong', '859964_720.jpg,photo-stair-pabuaran-resident-desain-arsitek-oleh-dtarchitekt.jpeg', '4x5', 5.0),
(20, 0, '100000000', 'tersedia', NULL, '2024-11-30', 'ac dalam kamar mandi', 'hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295687-m.png', '3x6', 5.0),
(21, 0, '100000000', 'tersedia', NULL, '2024-11-30', 'ac', 'hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295683-m.png', '4x5', 2.0),
(22, 0, '10000000', 'tersedia', NULL, '2024-11-29', 'ac', 'contoh-gambar-desain-koskosan-lahan-sempit-46.jpeg', '3x6', 2.0),
(25, 0, '50000', 'tersedia', NULL, '2024-11-30', 'Kamar mandi dalam, ', 'Desain-Kamar-Kost-3x4-Kamar-Mandi-Dalam-1120x630.webp', '3x6', 5.0),
(26, 0, '50', 'tersedia', NULL, '2024-11-30', 'kipas angin, Tv, Wifi', 'contoh-gambar-desain-koskosan-lahan-sempit-46.jpeg', '4x5', 5.0),
(27, 0, '50', 'tersedia', NULL, '2024-12-05', 'ac', '859964_720.jpg,20210621-003531_miliki-usaha-koskosan-sendiri-dengan-pinjaman-online-ikuti-tips-ini-agar-lancar-mewujudkannya.jpeg,contoh-gambar-desain-koskosan-lahan-sempit-46.jpeg', '3x10', 5.0),
(28, 0, '50', 'tersedia', NULL, '2024-11-29', 'ac', 'hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295683-m.png', '3x6', 5.0),
(29, 0, '50.000', 'tersedia', NULL, '2024-11-23', 'kipas angin', '1Un1RJTJ1l1s.1_12.jpg', '3x4', 1.0),
(30, 0, '100.0.000', 'tersedia', NULL, '2024-11-29', 'ghjkl;', '20210621-003531_miliki-usaha-koskosan-sendiri-dengan-pinjaman-online-ikuti-tips-ini-agar-lancar-mewujudkannya.jpeg', '3x10', 1.0),
(31, 0, '50000', 'tersedia', NULL, '2024-11-16', 'ac', '859964_720.jpg', '3x4', 1.0),
(32, 0, '100.000', 'tersedia', NULL, '2024-11-23', 'ac', 'hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295683-m.png', '4x5', 1.0),
(33, 0, '10000', 'tersedia', NULL, '2024-11-16', 'kipas angin', 'Desain-Kamar-Kost-3x4-Kamar-Mandi-Dalam-1120x630.webp', '3x1', 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `login_222271`
--

CREATE TABLE `login_222271` (
  `id_222271` int(11) NOT NULL,
  `pengguna_id_222271` int(11) NOT NULL,
  `username_222271` varchar(50) NOT NULL,
  `password_222271` varchar(255) NOT NULL,
  `nama_222271` varchar(255) DEFAULT NULL,
  `email_222271` varchar(255) DEFAULT NULL,
  `nomorTelepon_222271` varchar(15) DEFAULT NULL,
  `foto_222271` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_222271`
--

INSERT INTO `login_222271` (`id_222271`, `pengguna_id_222271`, `username_222271`, `password_222271`, `nama_222271`, `email_222271`, `nomorTelepon_222271`, `foto_222271`) VALUES
(1, 1, 'royandi', '$2y$10$w9PwOicJpzAoy4VRFRdXzuahftuC6NLKG1Cf.2gNsAqraMvVbRN1a', NULL, NULL, NULL, NULL),
(2, 2, 'randi', '$2y$10$I3Nn33zyIGQuhXMJ2K8AbeoY7ke14Z6q6ILitOSBvOqLkuldMP8ny', NULL, NULL, NULL, NULL),
(3, 3, 'admin', '$2y$10$vibAOS4FnYU/4MZmwMN5M.vTZ4WM/uABugfyMv/.LEu8SzL3Ih962', NULL, NULL, NULL, NULL),
(5, 5, 'aswan', '$2y$10$GKQV6sdtTihaUuC21OtCBuApjXtJ82VrTs81ys26sjtdpVE76mqeK', NULL, NULL, NULL, NULL),
(6, 6, 'coba', '$2y$10$BSbXFNTtU7zYHozKtGhyxuNgFpsPbpbk6jl7pTvQNmXEuN47rG6MC', NULL, NULL, NULL, NULL),
(7, 7, 'tes', '$2y$10$i3d/DflmIveTb3.DlUWISecHZnOxG/TqS4DtlrEfwhz9NT8xRRlWa', NULL, NULL, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_222271`
--

CREATE TABLE `pengguna_222271` (
  `id_222271` int(11) NOT NULL,
  `nama_222271` varchar(100) NOT NULL,
  `email_222271` varchar(100) NOT NULL,
  `username_222271` varchar(255) NOT NULL,
  `nomorTelepon_222271` varchar(15) NOT NULL,
  `foto_222271` varchar(255) DEFAULT NULL,
  `role_222271` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna_222271`
--

INSERT INTO `pengguna_222271` (`id_222271`, `nama_222271`, `email_222271`, `username_222271`, `nomorTelepon_222271`, `foto_222271`, `role_222271`) VALUES
(1, 'royandii', 'randiroyandi@gmail.com', 'royandi', '081347018612', 'uploads/WhatsApp Image 2024-10-07 at 02.51.22_e4fec7bd.jpg', 'admin'),
(2, 'randi', 'randi@gmail.com', 'randi', '081347018612', 'uploads/WIN_20241017_20_29_12_Pro.jpg', 'user'),
(3, 'admin', 'admin@gmail.com', 'admin', '081347018612', 'uploads/macos-big-sur-stock-night-lone-tree-sedimentary-rocks-6016x6016-3776.jpg', 'user'),
(5, 'aswan', 'aswan@gmail.com', 'aswan', '081222222222', 'uploads/mohammad-rahmani-gA396xahf-Q-unsplash.jpg', 'user'),
(6, 'coba', 'coba@gamil.com', 'coba', '081222222222', 'uploads/B1100742-Cover-cara-bermain-bulu-tangkis-singkat-scaled.jpg', 'user'),
(7, 'tes', 'tes@gmail.com', 'tes', '081347018612', 'uploads/Screenshot_(36).png', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan_kos_222271`
--

CREATE TABLE `penyewaan_kos_222271` (
  `id_222271` int(11) NOT NULL,
  `id_kamar_222271` int(11) DEFAULT NULL,
  `nama_222271` varchar(100) DEFAULT NULL,
  `email_222271` varchar(100) DEFAULT NULL,
  `telepon_222271` varchar(20) DEFAULT NULL,
  `alamat_222271` text DEFAULT NULL,
  `metode_pembayaran_222271` varchar(50) DEFAULT NULL,
  `harga_222271` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewaan_kos_222271`
--

INSERT INTO `penyewaan_kos_222271` (`id_222271`, `id_kamar_222271`, `nama_222271`, `email_222271`, `telepon_222271`, `alamat_222271`, `metode_pembayaran_222271`, `harga_222271`) VALUES
(1, NULL, 'coba', 'coba@gmail.com', '081347018611', 'makassar', 'cash', 10000000.00),
(2, NULL, 'coba', 'r@gmail.com', '09882828930', 'jakarta', 'cash', 12345.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_222271`
--

CREATE TABLE `transaksi_222271` (
  `id_222271` int(11) NOT NULL,
  `penghuni_id_222271` int(11) NOT NULL,
  `id_kamar_222271` int(11) DEFAULT NULL,
  `tanggal_transaksi_222271` date NOT NULL,
  `nama_222271` varchar(200) NOT NULL,
  `jenis_transaksi_222271` enum('sewa','deposit','biaya tambahan') NOT NULL,
  `jumlah_222271` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_222271`
--

INSERT INTO `transaksi_222271` (`id_222271`, `penghuni_id_222271`, `id_kamar_222271`, `tanggal_transaksi_222271`, `nama_222271`, `jenis_transaksi_222271`, `jumlah_222271`) VALUES
(1, 1, 22, '2024-11-11', '', 'sewa', 10000000.00),
(2, 2, 13, '2024-11-11', '', 'sewa', 12345.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar_222271`
--
ALTER TABLE `kamar_222271`
  ADD PRIMARY KEY (`id_222271`);

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
-- Indexes for table `penyewaan_kos_222271`
--
ALTER TABLE `penyewaan_kos_222271`
  ADD PRIMARY KEY (`id_222271`),
  ADD KEY `id_kamar_222271` (`id_kamar_222271`);

--
-- Indexes for table `transaksi_222271`
--
ALTER TABLE `transaksi_222271`
  ADD PRIMARY KEY (`id_222271`),
  ADD KEY `penghuni_id_222271` (`penghuni_id_222271`),
  ADD KEY `kamar_id_222271` (`id_kamar_222271`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kamar_222271`
--
ALTER TABLE `kamar_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `login_222271`
--
ALTER TABLE `login_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran_222271`
--
ALTER TABLE `pembayaran_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna_222271`
--
ALTER TABLE `pengguna_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penyewaan_kos_222271`
--
ALTER TABLE `penyewaan_kos_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_222271`
--
ALTER TABLE `transaksi_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

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

--
-- Constraints for table `penyewaan_kos_222271`
--
ALTER TABLE `penyewaan_kos_222271`
  ADD CONSTRAINT `penyewaan_kos_222271_ibfk_1` FOREIGN KEY (`id_kamar_222271`) REFERENCES `kamar_222271` (`id_222271`);

--
-- Constraints for table `transaksi_222271`
--
ALTER TABLE `transaksi_222271`
  ADD CONSTRAINT `transaksi_222271_ibfk_2` FOREIGN KEY (`id_kamar_222271`) REFERENCES `kamar_222271` (`id_222271`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
