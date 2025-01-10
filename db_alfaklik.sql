-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2025 pada 08.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_alfaklik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `banners`
--

INSERT INTO `banners` (`id`, `image_path`, `link`) VALUES
(1, '/img/banner1.png', '<?= base_url(); ?>'),
(2, '/img/banner2.png', '<?= base_url(); ?>'),
(3, '/img/banner3.png', '<?= base_url(); ?>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `deskripsi_barang` text DEFAULT NULL,
  `harga_barang` decimal(10,2) DEFAULT NULL,
  `jumlah_stock` int(11) DEFAULT NULL,
  `keterangan` enum('tersedia','tidak-tersedia') DEFAULT 'tersedia',
  `gambar_barang` varchar(255) DEFAULT 'img/item_image.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id_carts` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `jadwal_pengiriman` datetime NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `ongkir` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `metode_pembayaran` enum('cod','lainnya') DEFAULT 'cod',
  `status` enum('baru','diproses','selesai','dibatalkan') DEFAULT 'baru',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_details`
--

CREATE TABLE `order_details` (
  `id_order_details` int(11) NOT NULL,
  `id_orders` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `role` enum('pelanggan','krew','admin') DEFAULT 'pelanggan',
  `status` enum('aktif','non-aktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT 'img/profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `email`, `no_telp`, `password`, `alamat`, `role`, `status`, `created_at`, `updated_at`, `nama_lengkap`, `foto_profil`) VALUES
(7, 'zamie27', 'zamie693@gmail.com', '083817783617', '$2y$10$Pdu/tOG2e.FVTcP1VUz8V.2zWL6.Ko43PyGLE8p5NK72phooPkrC6', 'Sukamandijaya', 'pelanggan', 'aktif', '2024-12-31 02:34:58', '2025-01-09 18:38:54', 'Zamie Pelanggan', 'img/users/pelanggan/profile/1736473134_2ec787743dc7895b28a2.jpg'),
(9, 'zamieadmin', 'zamie694@gmail.com', '085171739232', '$2y$10$FWsRLH2416hsxaKR1SFSBOZ4UfYp3AmEUqDR15TgLcEB1D4gvXJIW', NULL, 'admin', 'aktif', '2024-12-31 02:41:41', '2025-01-01 08:39:43', 'Zamie Admin', 'img/profile.png'),
(10, 'zamiekrew', 'zamie27@kuukok.site', '08123456789', '$2y$10$NU8DgI25r0X2dB34SyJTI.S1Y.fuE5lAvADdAJw6b07w.vCKPyUme', NULL, 'krew', 'aktif', '2024-12-31 09:19:15', '2025-01-01 08:39:43', 'Zamie Krew', 'img/profile.png'),
(11, 'jajalpw', 'jajal@gmail.com', '0909090', '$2y$10$dw7sahTMXAg1yzqTUXwwOO0cYzqIvI519u8SZvMU2fusRB.fEL.iy', NULL, 'pelanggan', 'aktif', '2025-01-01 02:33:52', '2025-01-01 02:33:52', 'Muhammad Ridho', 'img/profile.png'),
(12, 'erika20', 'erika@gmail.com', '092030', '$2y$10$435iVulGDLHxgIkbwKoi..pWG1AbZsJpj2uW2DK6f.mcjRtFBL5sW', NULL, 'pelanggan', 'aktif', '2025-01-01 03:34:27', '2025-01-01 03:34:27', 'erika', 'img/profile.png'),
(13, 'kpusubang', 'kpusbg.teknis@gmail.com', '23425', '$2y$10$0RrUxSIKL/J3PlPVXnXhx./HZEtQllE9QEpLg6QvmTVKB8U.xXsta', NULL, 'admin', 'aktif', '2025-01-01 12:06:30', '2025-01-01 12:15:21', 'KPU', 'img/profile.png'),
(15, 'amir', 'amir@gmail.com', '3495', '$2y$10$dSpZzV9Q8OU7bsUAuys.6eugUofx6Mm4bHUXOWYDOUuHyBl9b.I8C', NULL, 'admin', 'aktif', '2025-01-01 12:16:25', '2025-01-01 12:16:25', 'amir', 'img/profile.png'),
(17, 'qwe', 'qewqe@gmail.com', '24343', '$2y$10$912h2gNGFkv6PK8v.1RwZO1EXpMs.O4TAsSRC42qg5cuUdD3HYmw2', NULL, 'admin', 'aktif', '2025-01-01 12:19:20', '2025-01-01 12:19:20', 'qwe', 'img/profile.png'),
(19, 'dod', 'dodi@gmail.com', '12313', '$2y$10$aw.1A6DzmMVd3nFaWy5npOkpxiZ3h4DA3UdmK.4gOR8wSFuI7wuz2', NULL, 'pelanggan', 'aktif', '2025-01-01 12:19:50', '2025-01-01 12:24:35', 'dodi', 'img/profile.png'),
(20, 'Yudha20', 'yudha@gmail.com', '09123456678', '$2y$10$yRfbCR6.Aoc1MY3Nz9bJp.7wyniNdghDR9lN5.ZZx/DqdbE9mumpK', NULL, 'pelanggan', 'aktif', '2025-01-01 20:17:28', '2025-01-01 20:17:28', 'Yudha', 'img/profile.png'),
(22, 'zamiepelanggan', 'zamie697@gmail.com', '09090900', '$2y$10$5wm6pj2lenmN4BaOnDDrTeKb/oSCjupuJnDJ6p6U8V2hDZLz4zac.', NULL, 'pelanggan', 'aktif', '2025-01-09 03:04:14', '2025-01-09 03:04:14', 'zamiepelanggan', 'img/profile.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id_carts`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id_order_details`),
  ADD KEY `id_orders` (`id_orders`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_telp` (`no_telp`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id_carts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id_order_details` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`id_orders`) REFERENCES `orders` (`id_orders`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
