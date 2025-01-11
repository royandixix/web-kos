-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jan 2025 pada 23.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

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
-- Struktur dari tabel `kamar_222271`
--

CREATE TABLE `kamar_222271` (
  `id_222271` int(11) NOT NULL,
  `alamat_222271` varchar(200) NOT NULL,
  `harga_222271` int(1) NOT NULL,
  `status_222271` enum('tersedia','disewa') DEFAULT 'tersedia',
  `deskripsi_222271` text DEFAULT NULL,
  `tanggal_tersedia_222271` date DEFAULT NULL,
  `fasilitas_222271` varchar(255) DEFAULT NULL,
  `foto_222271` varchar(255) DEFAULT NULL,
  `foto_fasilitas_222271` varchar(255) DEFAULT NULL,
  `ukuran_222271` varchar(100) NOT NULL,
  `rating_222271` decimal(2,1) DEFAULT NULL,
  `id_kamar_222271` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kamar_222271`
--

INSERT INTO `kamar_222271` (`id_222271`, `alamat_222271`, `harga_222271`, `status_222271`, `deskripsi_222271`, `tanggal_tersedia_222271`, `fasilitas_222271`, `foto_222271`, `foto_fasilitas_222271`, `ukuran_222271`, `rating_222271`, `id_kamar_222271`) VALUES
(1, 'makssar', 1500000, 'tersedia', 'baru selesai di bagun dan masi baru ', '2025-01-17', 'kipas  agin, ac', '6779f855e0ebe_Kamar Warna Gelap (1).jpg', 'uploads/6779f855e0ca9_kos-sejahtera-karyawati-mahasiswi-kamar-mandi-1223925618.jpg', '3x4', 1.0, 0),
(5, 'mamuju', 8000000, 'tersedia', 'Kamar Tidur Utama\r\nKamar tidur utama ini dirancang dengan suasana yang nyaman dan menenangkan, dilengkapi dengan tempat tidur king-size, lemari pakaian besar, dan jendela yang menghadap pemandangan taman hijau. Cahaya alami yang masuk memberikan kesan luas dan sejuk, sementara pencahayaan lembut menambah kenyamanan.', '2025-01-08', 'empat tidur king-size dengan kasur nyaman dan bantal lembut', NULL, '6782d7edda060_kos-sejahtera-karyawati-mahasiswi-kamar-mandi-1223925618.jpg', '3x4', 1.0, 0),
(6, 'k', 100000, 'tersedia', 'a', '2025-01-22', 'ac', NULL, '6782e603f33dd_Kamar Warna Gelap (1).jpg', '3x4', 1.0, 0),
(7, 'www', 1, 'tersedia', 'q222', '2025-01-03', 'ac', '6782e67cee856_download.png', NULL, '3x4', 1.0, 0),
(8, 'kos', 1000000, 'tersedia', 'sangat bags', '2025-01-23', 'ac', NULL, '6782e7d2d69e4_photo-stair-pabuaran-resident-desain-arsitek-oleh-dtarchitekt.jpeg', '3x4', 1.0, 0),
(9, 'jakarta', 1, 'tersedia', 'sangat bagus', '2025-01-22', 'Array', '', '6782ea02c15e9_hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295687-m.png', '3x4', 5.0, 0),
(10, 'jakarta', 1, 'tersedia', 'sangat bagus', '2025-01-22', 'ac', '6782eb6787d64_Desain-Kamar-Kost-3x4-Kamar-Mandi-Dalam-1120x630.webp', '6782eb678805e_hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295687-m.png', '3x4', 5.0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_222271`
--

CREATE TABLE `login_222271` (
  `id_222271` int(11) NOT NULL,
  `pengguna_id_222271` int(11) DEFAULT NULL,
  `username_222271` varchar(50) NOT NULL,
  `password_222271` varchar(255) NOT NULL,
  `nama_222271` varchar(255) DEFAULT NULL,
  `email_222271` varchar(255) DEFAULT NULL,
  `nomorTelepon_222271` varchar(15) DEFAULT NULL,
  `foto_222271` varchar(255) DEFAULT NULL,
  `role_222271` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login_222271`
--

INSERT INTO `login_222271` (`id_222271`, `pengguna_id_222271`, `username_222271`, `password_222271`, `nama_222271`, `email_222271`, `nomorTelepon_222271`, `foto_222271`, `role_222271`) VALUES
(2, 2, 'randi', '$2y$10$I3Nn33zyIGQuhXMJ2K8AbeoY7ke14Z6q6ILitOSBvOqLkuldMP8ny', NULL, NULL, NULL, NULL, 'user'),
(3, 3, 'admin', '$2y$10$vibAOS4FnYU/4MZmwMN5M.vTZ4WM/uABugfyMv/.LEu8SzL3Ih962', NULL, NULL, NULL, NULL, 'user'),
(5, 5, 'aswan', '$2y$10$GKQV6sdtTihaUuC21OtCBuApjXtJ82VrTs81ys26sjtdpVE76mqeK', NULL, NULL, NULL, NULL, 'user'),
(6, 6, 'coba', '$2y$10$BSbXFNTtU7zYHozKtGhyxuNgFpsPbpbk6jl7pTvQNmXEuN47rG6MC', NULL, NULL, NULL, NULL, 'user'),
(7, 7, 'tes', '$2y$10$i3d/DflmIveTb3.DlUWISecHZnOxG/TqS4DtlrEfwhz9NT8xRRlWa', NULL, NULL, NULL, NULL, 'user'),
(8, NULL, 'roy', '$2y$10$jCn/kgx9VOBlq5yRmwt1QuJvUHtAJxoGzNZpCsq5Y34osAOFKtNX.', 'roy', 'randiroyandi@gmail.com', '089123445698', 'roy.jpg.jpg', 'admin'),
(9, 8, 'bisa', '$2y$10$GaMqjQqgCFZQQCzy2vXtyOPrZ/hGc7/zEZGObJ1nVIgXd1uP1/2qG', 'bisa', 'bisa@gmail.com', '081347181099', 'testimonial-2.jpg', 'user'),
(10, 9, 'kos', '$2y$10$ZIGf8DzArmqlmVeTXuoTh.Sy8uTklwAt9Zxxs83mMxVqnU08I99Ii', 'webkos', 'webkos@gmail.com', '081348912300', 'testimonial-1.jpg', 'user'),
(11, 11, 'bagus', '$2y$10$fGr7/QgY6UPUf9EZFNWFgeqW4WI3dGUS2xFxAkvQ23lBGdmlwSkiq', 'bagus', 'bagus@gmail.com', '081348912302', 'uploads/profile/testimonial-1.jpg', 'user'),
(12, 12, 'halo', '$2y$10$VfJyBl966PzYNqgZFLUjx.JXIZjZNZbI4WiDR2IST5AouwSI6Wh0m', 'halo', 'halo@gmail.com', '081356789090', 'testimonial-1.jpg', 'user'),
(14, 14, 'royan', '$2y$10$ADaa7YWHWAnE3noD4rOIbuzkrA9wbWpMqvbxFvEAhAOIqMVUFToLy', 'royan', 'royan@gmail.com', '081345901800', 'testimonial-2.jpg', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_222271`
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
-- Struktur dari tabel `pengguna_222271`
--

CREATE TABLE `pengguna_222271` (
  `id_222271` int(11) NOT NULL,
  `nama_222271` varchar(100) NOT NULL,
  `email_222271` varchar(100) NOT NULL,
  `username_222271` varchar(255) NOT NULL,
  `nomorTelepon_222271` varchar(15) NOT NULL,
  `foto_222271` varchar(255) DEFAULT NULL,
  `role_222271` enum('user','admin') DEFAULT 'user',
  `password_222271` varchar(255) DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna_222271`
--

INSERT INTO `pengguna_222271` (`id_222271`, `nama_222271`, `email_222271`, `username_222271`, `nomorTelepon_222271`, `foto_222271`, `role_222271`, `password_222271`, `last_updated`) VALUES
(2, 'randii', 'randi@gmail.com', 'randi', '081347018612', 'uploads/WIN_20241017_20_29_12_Pro.jpg', 'user', NULL, NULL),
(3, 'admin', 'admin@gmail.com', 'admin', '081347018612', 'uploads/macos-big-sur-stock-night-lone-tree-sedimentary-rocks-6016x6016-3776.jpg', 'user', NULL, NULL),
(5, 'aswan', 'aswan@gmail.com', 'aswan', '081222222222', 'uploads/mohammad-rahmani-gA396xahf-Q-unsplash.jpg', 'user', NULL, NULL),
(6, 'coba', 'coba@gamil.com', 'coba', '081222222222', 'uploads/B1100742-Cover-cara-bermain-bulu-tangkis-singkat-scaled.jpg', 'user', NULL, NULL),
(7, 'tes', 'tes@gmail.com', 'tes', '081347018612', 'uploads/Screenshot_(36).png', 'user', NULL, NULL),
(8, 'bisa', 'bisa@gmail.com', 'bisa', '081347181099', 'uploads/profile/testimonial-2.jpg', 'user', NULL, NULL),
(9, 'webkos', 'webkos@gmail.com', 'kos', '081348912300', 'uploads/profile/testimonial-1.jpg', 'user', NULL, NULL),
(11, 'bagus', 'bagus@gmail.com', 'bagus', '081348912304', 'uploads/profile/testimonial-1.jpg', 'user', NULL, NULL),
(12, 'halo1', 'halo1@gmail.com', 'halo1', '081356789091', 'uploads/testimonial-2.jpg', 'user', NULL, NULL),
(14, 'royandi', 'royandi@gmail.com', 'royandi', '081345901801', 'uploads/testimonial-1.jpg', 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaan_kos_222271`
--

CREATE TABLE `penyewaan_kos_222271` (
  `id_222271` int(11) NOT NULL,
  `id_kamar_222271` int(11) DEFAULT NULL,
  `nama_222271` varchar(100) DEFAULT NULL,
  `email_222271` varchar(100) DEFAULT NULL,
  `telepon_222271` varchar(20) DEFAULT NULL,
  `alamat_222271` text DEFAULT NULL,
  `metode_pembayaran_222271` varchar(50) DEFAULT NULL,
  `harga_222271` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penyewaan_kos_222271`
--

INSERT INTO `penyewaan_kos_222271` (`id_222271`, `id_kamar_222271`, `nama_222271`, `email_222271`, `telepon_222271`, `alamat_222271`, `metode_pembayaran_222271`, `harga_222271`) VALUES
(1, NULL, 'greiss', 'greis@gmail.com', '081346789876', 'makasssar', 'Cash', 6000000),
(2, NULL, 'royandi', 'randiroyandi@gmail.com', '081346789876', 'gowa', 'Cash', 5000000),
(3, NULL, 'main 1 kali', 'ok@gmail.com', '082332345787', 'mamuju', 'Cash', 2000000),
(4, NULL, 'ulang', 'b@gmail.com', '083557909', 'majene', 'Cash', 2000000),
(5, NULL, 'aurel', 'rel@gmail.com', '085245556909', 'papalang', 'Cash', 0),
(6, NULL, 'aurel', 'rel@gmail.com', '085245556909', 'lekbeng', 'Cash', 4500000),
(7, NULL, 'halo', 'halo@gmai.com', '081345678909', 'makassar', 'Cash', 18000000),
(8, NULL, 'royan', 'royan@gmail.com', '081347018612', 'makassar', 'Cash', 0),
(9, NULL, 'hamdan', 'hamdan@gmail.com', '081347018612', 'makassar', 'Cash', 1500000),
(10, NULL, 'new', 'new@gmail.com', '081347018612', 'makassar', 'Cash', 1500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_222271`
--

CREATE TABLE `transaksi_222271` (
  `id_222271` int(11) NOT NULL,
  `penghuni_id_222271` int(11) NOT NULL,
  `id_kamar_222271` int(11) DEFAULT NULL,
  `tanggal_transaksi_222271` date NOT NULL,
  `nama_222271` varchar(200) NOT NULL,
  `jenis_transaksi_222271` enum('sewa','deposit','biaya tambahan') NOT NULL,
  `jumlah_222271` decimal(10,2) NOT NULL,
  `status_222271` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_222271`
--

INSERT INTO `transaksi_222271` (`id_222271`, `penghuni_id_222271`, `id_kamar_222271`, `tanggal_transaksi_222271`, `nama_222271`, `jenis_transaksi_222271`, `jumlah_222271`, `status_222271`) VALUES
(4, 1, 18, '2024-11-25', '', '', 6000000.00, 'belum lunas'),
(5, 2, 17, '2024-11-25', '', '', 5000000.00, 'belum lunas'),
(6, 3, 1, '2025-01-05', '', '', 2000000.00, 'belum lunas'),
(7, 4, 1, '2025-01-05', '', '', 2000000.00, 'belum lunas'),
(8, 6, 1, '2025-01-05', '', '', 4500000.00, 'belum lunas'),
(9, 7, 1, '2025-01-06', '', '', 18000000.00, 'belum lunas'),
(10, 8, 1, '2025-01-11', '', '', 0.00, 'belum lunas'),
(11, 9, 1, '2025-01-12', '', '', 1500000.00, 'belum lunas'),
(12, 10, 1, '2025-01-12', '', '', 1500000.00, 'belum lunas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kamar_222271`
--
ALTER TABLE `kamar_222271`
  ADD PRIMARY KEY (`id_222271`);

--
-- Indeks untuk tabel `login_222271`
--
ALTER TABLE `login_222271`
  ADD PRIMARY KEY (`id_222271`),
  ADD UNIQUE KEY `username` (`username_222271`),
  ADD UNIQUE KEY `username_222271` (`username_222271`),
  ADD KEY `fk_pengguna_login` (`pengguna_id_222271`);

--
-- Indeks untuk tabel `pembayaran_222271`
--
ALTER TABLE `pembayaran_222271`
  ADD PRIMARY KEY (`id_222271`),
  ADD KEY `fk_penghuni_pembayaran` (`penghuni_kost_id_222271`),
  ADD KEY `fk_kamar_pembayaran` (`kamar_id_222271`);

--
-- Indeks untuk tabel `pengguna_222271`
--
ALTER TABLE `pengguna_222271`
  ADD PRIMARY KEY (`id_222271`),
  ADD UNIQUE KEY `email` (`email_222271`),
  ADD UNIQUE KEY `email_222271` (`email_222271`);

--
-- Indeks untuk tabel `penyewaan_kos_222271`
--
ALTER TABLE `penyewaan_kos_222271`
  ADD PRIMARY KEY (`id_222271`),
  ADD KEY `id_kamar_222271` (`id_kamar_222271`);

--
-- Indeks untuk tabel `transaksi_222271`
--
ALTER TABLE `transaksi_222271`
  ADD PRIMARY KEY (`id_222271`),
  ADD KEY `penghuni_id_222271` (`penghuni_id_222271`),
  ADD KEY `kamar_id_222271` (`id_kamar_222271`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kamar_222271`
--
ALTER TABLE `kamar_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `login_222271`
--
ALTER TABLE `login_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pembayaran_222271`
--
ALTER TABLE `pembayaran_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengguna_222271`
--
ALTER TABLE `pengguna_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `penyewaan_kos_222271`
--
ALTER TABLE `penyewaan_kos_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi_222271`
--
ALTER TABLE `transaksi_222271`
  MODIFY `id_222271` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `login_222271`
--
ALTER TABLE `login_222271`
  ADD CONSTRAINT `fk_pengguna_id` FOREIGN KEY (`pengguna_id_222271`) REFERENCES `pengguna_222271` (`id_222271`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pengguna_login` FOREIGN KEY (`pengguna_id_222271`) REFERENCES `pengguna_222271` (`id_222271`) ON DELETE CASCADE,
  ADD CONSTRAINT `login_222271_ibfk_1` FOREIGN KEY (`pengguna_id_222271`) REFERENCES `pengguna_222271` (`id_222271`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran_222271`
--
ALTER TABLE `pembayaran_222271`
  ADD CONSTRAINT `fk_penghuni_pembayaran` FOREIGN KEY (`penghuni_kost_id_222271`) REFERENCES `pengguna_222271` (`id_222271`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayaran_222271_ibfk_1` FOREIGN KEY (`penghuni_kost_id_222271`) REFERENCES `pengguna_222271` (`id_222271`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayaran_222271_ibfk_2` FOREIGN KEY (`kamar_id_222271`) REFERENCES `kamar_222271` (`id_222271`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penyewaan_kos_222271`
--
ALTER TABLE `penyewaan_kos_222271`
  ADD CONSTRAINT `penyewaan_kos_222271_ibfk_1` FOREIGN KEY (`id_kamar_222271`) REFERENCES `kamar_222271` (`id_222271`);

--
-- Ketidakleluasaan untuk tabel `transaksi_222271`
--
ALTER TABLE `transaksi_222271`
  ADD CONSTRAINT `transaksi_222271_ibfk_2` FOREIGN KEY (`id_kamar_222271`) REFERENCES `kamar_222271` (`id_222271`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
