-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 11:26 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bundamayashop`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Kue Kering', '2025-04-24 08:27:47', '2025-04-24 08:27:47'),
(2, 'Kue Basah', '2025-04-24 08:28:57', '2025-04-24 08:28:57'),
(3, 'Roti', '2025-04-24 08:29:04', '2025-04-24 08:29:04'),
(4, 'Kue Ulang Tahun', '2025-04-24 08:29:13', '2025-04-24 08:29:13'),
(12, 'Kue Bolu Blackforest', '2025-05-02 02:38:29', '2025-05-02 02:38:29'),
(14, 'Pudding Telur', '2025-05-05 01:44:09', '2025-05-05 01:44:09'),
(15, 'Kue Bolu', '2025-05-10 03:38:22', '2025-05-10 03:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(10) UNSIGNED NOT NULL,
  `file_laporan` varchar(255) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `total_penjualan` varchar(255) NOT NULL,
  `kategori` enum('perhari','perbulan') NOT NULL DEFAULT 'perbulan',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `file_laporan`, `bulan`, `tahun`, `total_penjualan`, `kategori`, `created_at`, `updated_at`) VALUES
(6, 'laporan_harian_20250424_134042.pdf', '', 0000, '40000', 'perhari', '2025-04-24 13:39:13', '2025-04-24 13:39:04'),
(9, 'laporan_harian_20250425_080848.pdf', '', 0000, '20000', 'perhari', '2025-04-25 00:39:58', '2025-04-25 08:07:38'),
(10, 'laporan_harian_20250426_142257.pdf', '', 0000, '70000', 'perhari', '2025-04-26 14:22:46', '2025-04-26 14:22:46'),
(11, 'laporan_harian_20250428_072810.pdf', '', 0000, '110000', 'perhari', '2025-04-28 05:16:29', '2025-04-28 07:25:15'),
(12, 'laporan_harian_20250429_141216.pdf', '', 0000, '25000', 'perhari', '2025-04-29 03:27:23', '2025-04-29 14:11:35'),
(19, 'laporan_bulanan_April_2025.pdf', '04', 2025, '190000', 'perbulan', '2025-05-04 08:20:12', '2025-05-09 16:19:36'),
(20, 'laporan_bulanan_Mei_2025.pdf', '05', 2025, '590000', 'perbulan', '2025-05-04 08:23:52', '2025-05-10 08:52:37'),
(21, 'laporan_harian_20250504_091653.pdf', '', 0000, '30000', 'perhari', '2025-05-02 14:54:26', '2025-05-02 14:54:26'),
(22, 'laporan_harian_20250504_094833.pdf', '', 0000, '275000', 'perhari', '2025-05-04 08:50:20', '2025-05-04 08:50:20'),
(23, 'laporan_harian_20250505_024729.pdf', '', 0000, '30000', 'perhari', '2025-05-05 02:23:51', '2025-05-05 02:23:51'),
(24, 'laporan_harian_20250506_031142.pdf', '', 0000, '100000', 'perhari', '2025-05-06 00:01:58', '2025-05-06 03:11:28'),
(25, 'laporan_harian_20250509_164656.pdf', '', 0000, '35000', 'perhari', '2025-05-09 04:04:14', '2025-04-28 07:25:15'),
(26, 'laporan_harian_20250510_084955.pdf', '', 0000, '20000', 'perhari', '2025-05-10 03:37:44', '2025-05-10 03:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-04-07-055259', 'App\\Database\\Migrations\\User', 'default', 'App', 1745483145, 1),
(2, '2025-04-07-055828', 'App\\Database\\Migrations\\Kategori', 'default', 'App', 1745483145, 1),
(3, '2025-04-07-060231', 'App\\Database\\Migrations\\Produk', 'default', 'App', 1745483145, 1),
(4, '2025-04-08-071432', 'App\\Database\\Migrations\\Order', 'default', 'App', 1745483146, 1),
(5, '2025-04-08-071506', 'App\\Database\\Migrations\\CreateOrderItem', 'default', 'App', 1745483146, 1),
(6, '2025-04-15-020936', 'App\\Database\\Migrations\\Laporan', 'default', 'App', 1745483146, 1),
(10, '2025-04-25-074230', 'App\\Database\\Migrations\\Setting', 'default', 'App', 1746191987, 2),
(11, '2025-05-02-131806', 'App\\Database\\Migrations\\Perhitungan', 'default', 'App', 1746191987, 2),
(12, '2025-04-07-055259', 'App\\Database\\Migrations\\Pengguna', 'default', 'App', 1746725933, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('admin','petugas','owner') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `email`, `password`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Novyta Maharani', 'novytamaharani@gmail.com', '$2y$10$Z5z7h8DuEZCJC', 'admin', '2025-05-08 17:42:53', '2025-05-08 17:42:53'),
(2, 'Norrahmah', 'norrahmah@gmail.com', '$2y$10$TG7IaPugmgyVN', 'petugas', '2025-05-09 16:43:42', '2025-05-09 16:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `perhitungan`
--

CREATE TABLE `perhitungan` (
  `id_perhitungan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `pendapatan` varchar(20) NOT NULL,
  `modal` varchar(20) NOT NULL,
  `type` enum('perhari','perbulan') NOT NULL,
  `keuntungan` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perhitungan`
--

INSERT INTO `perhitungan` (`id_perhitungan`, `tanggal`, `pendapatan`, `modal`, `type`, `keuntungan`, `created_at`, `updated_at`) VALUES
(32, '2025-05-06', '100000', '30000', 'perhari', '70000', '2025-05-08 15:49:07', '2025-05-08 15:50:18'),
(40, '2025-05-09', '60000', '10000', 'perhari', '50000', '2025-05-09 16:32:16', '2025-05-09 16:32:16'),
(50, '2025-04-01', '185000', '50000', 'perbulan', '135000', '2025-05-10 09:18:14', '2025-05-10 09:18:14'),
(51, '2025-05-01', '590000', '150000', 'perbulan', '440000', '2025-05-10 09:18:42', '2025-05-10 09:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) UNSIGNED NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `harga` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `deskripsi`, `id_kategori`, `gambar`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Donat Coklat', 'Donat empuk dengan taburan coklat', 3, '1745483393_235d4b05d2180d2d83f0.jpg', '5000', '2025-04-24 08:29:53', '2025-04-24 08:29:53'),
(2, 'Donat Strawberry', 'Donat empuk dengan taburan strawberry', 3, '1745483430_0556e32a8542977f1ed4.jpg', '5000', '2025-04-23 08:30:30', '2025-04-23 08:30:30'),
(3, 'Donat Cappucino', 'Donat empuk dengan taburan cappucino', 3, '1745483474_75763f8cd2105d573272.jpg', '5000', '2025-04-24 08:31:14', '2025-04-24 08:31:14'),
(4, 'Roti Sosis', 'Roti isi sosis dengan keju leleh', 3, '1745483508_31b9aaa6ba674d81aec9.jpg', '5000', '2025-04-24 08:31:48', '2025-04-24 08:46:01'),
(5, 'Sari India', 'Tekstur lembut', 2, '1745483574_10e1d8c8e47260f5f6be.jpg', '20000', '2025-04-24 08:32:54', '2025-04-28 04:07:50'),
(6, 'Nastar Keju', 'Kue kering isi nanas dengan keju', 1, '1745483601_ba6e8fdeb432cf49df31.jpg', '30000', '2025-04-24 08:33:21', '2025-04-28 02:50:42'),
(8, 'Kue Ulang Tahun', 'Kue Ulang Tahun Wajah Doraemon', 4, '1745816263_42dababd584d349ac1dd.jpg', '200000', '2025-04-28 04:57:43', '2025-05-05 07:04:07'),
(18, 'Putri Salju', 'Kue kering dengan taburan salju gula halus yang melimpah', 1, '1746582338_09af26a6a9daf61ab3eb.jpg', '30000', '2025-05-07 01:45:38', '2025-05-07 01:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `produk_terjual`
--

CREATE TABLE `produk_terjual` (
  `id_produk_terjual` int(10) UNSIGNED NOT NULL,
  `total_harga` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_terjual`
--

INSERT INTO `produk_terjual` (`id_produk_terjual`, `total_harga`, `created_at`, `updated_at`) VALUES
(18, '30000', '2025-04-24 13:38:48', '2025-04-24 13:38:48'),
(19, '10000', '2025-04-24 13:39:04', '2025-04-24 13:39:04'),
(21, '10000', '2025-04-25 00:39:58', '2025-04-25 00:39:58'),
(22, '10000', '2025-04-25 08:07:38', '2025-04-25 08:07:38'),
(23, '40000', '2025-04-26 14:22:23', '2025-04-26 14:22:23'),
(24, '30000', '2025-04-26 14:22:46', '2025-04-26 14:22:46'),
(25, '5000', '2025-04-28 05:16:29', '2025-04-28 05:16:29'),
(28, '30000', '2025-04-28 07:25:15', '2025-04-28 07:25:15'),
(35, '20000', '2025-04-29 14:11:35', '2025-04-29 14:11:35'),
(71, '10000', '2025-05-02 03:10:05', '2025-05-02 03:25:01'),
(72, '20000', '2025-05-02 14:54:26', '2025-05-02 14:54:26'),
(74, '200000', '2025-05-04 08:50:20', '2025-05-04 08:51:35'),
(76, '30000', '2025-05-05 02:23:51', '2025-05-05 02:23:51'),
(79, '30000', '2025-05-06 00:01:01', '2025-05-06 00:01:01'),
(80, '30000', '2025-05-06 00:01:58', '2025-05-06 00:02:27'),
(81, '40000', '2025-05-06 03:11:28', '2025-05-06 03:11:28'),
(82, '60000', '2025-05-07 01:44:04', '2025-05-07 01:44:04'),
(83, '60000', '2025-05-07 01:45:53', '2025-05-07 01:45:53'),
(84, '20000', '2025-05-08 06:37:25', '2025-05-08 06:37:25'),
(85, '10000', '2025-05-08 07:20:20', '2025-05-08 07:20:20'),
(86, '60000', '2025-05-09 04:04:14', '2025-05-09 04:04:14'),
(89, '20000', '2025-05-10 03:37:44', '2025-05-10 03:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `rincian_produk_terjual`
--

CREATE TABLE `rincian_produk_terjual` (
  `id_rincian_produk_terjual` int(10) UNSIGNED NOT NULL,
  `id_produk_terjual` int(10) UNSIGNED DEFAULT NULL,
  `id_produk` int(10) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_harga` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rincian_produk_terjual`
--

INSERT INTO `rincian_produk_terjual` (`id_rincian_produk_terjual`, `id_produk_terjual`, `id_produk`, `jumlah`, `total_harga`, `created_at`, `updated_at`) VALUES
(33, 18, 1, 2, '10000', '2025-04-24 13:38:48', '2025-04-24 13:38:48'),
(34, 18, 2, 2, '10000', '2025-04-24 13:38:48', '2025-04-24 13:38:48'),
(35, 18, 3, 2, '10000', '2025-04-24 13:38:48', '2025-04-24 13:38:48'),
(36, 19, 4, 2, '10000', '2025-04-24 13:39:04', '2025-04-24 13:39:04'),
(38, 21, 1, 1, '5000', '2025-04-25 00:39:58', '2025-04-25 00:39:58'),
(39, 21, 2, 1, '5000', '2025-04-25 00:39:58', '2025-04-25 00:39:58'),
(40, 22, 4, 2, '10000', '2025-04-25 08:07:38', '2025-04-25 08:07:38'),
(41, 23, 5, 2, '40000', '2025-04-26 14:22:23', '2025-04-26 14:22:23'),
(42, 24, 6, 1, '30000', '2025-04-26 14:22:46', '2025-04-26 14:22:46'),
(43, 25, 1, 1, '5000', '2025-04-28 05:16:29', '2025-04-28 05:16:29'),
(47, 28, 6, 1, '30000', '2025-04-28 07:25:15', '2025-04-28 07:25:15'),
(108, 35, 1, 2, '10000', '2025-04-29 14:11:35', '2025-04-29 14:11:35'),
(109, 35, 2, 2, '10000', '2025-04-29 14:11:35', '2025-04-29 14:11:35'),
(229, 71, 1, 2, '10000', '2025-05-02 03:25:01', '2025-05-02 03:25:01'),
(230, 72, 2, 2, '10000', '2025-05-02 14:54:26', '2025-05-02 14:54:26'),
(231, 72, 3, 2, '10000', '2025-05-02 14:54:26', '2025-05-02 14:54:26'),
(236, 74, 8, 1, '200000', '2025-05-04 08:50:20', '2025-05-04 08:51:35'),
(241, 76, 1, 2, '10000', '2025-05-05 02:23:51', '2025-05-05 02:23:51'),
(242, 76, 2, 2, '10000', '2025-05-05 02:23:51', '2025-05-05 02:23:51'),
(243, 76, 3, 2, '10000', '2025-05-05 02:23:51', '2025-05-05 02:23:51'),
(246, 79, 6, 1, '30000', '2025-05-06 00:01:01', '2025-05-06 00:01:01'),
(247, 80, 1, 6, '30000', '2025-05-06 00:01:58', '2025-05-06 00:02:27'),
(248, 81, 5, 2, '40000', '2025-05-06 03:11:28', '2025-05-06 03:11:28'),
(249, 82, 6, 2, '60000', '2025-05-07 01:44:04', '2025-05-07 01:44:04'),
(250, 83, 18, 2, '60000', '2025-05-07 01:45:53', '2025-05-07 01:45:53'),
(251, 84, 1, 2, '10000', '2025-05-08 06:37:25', '2025-05-08 06:37:25'),
(252, 84, 2, 2, '10000', '2025-05-08 06:37:25', '2025-05-08 06:37:25'),
(253, 85, 3, 2, '10000', '2025-05-08 07:20:20', '2025-05-08 07:20:20'),
(254, 86, 6, 1, '30000', '2025-05-09 04:04:14', '2025-05-09 04:04:14'),
(255, 86, 18, 1, '30000', '2025-05-09 04:04:14', '2025-05-09 04:04:14'),
(259, 89, 1, 2, '10000', '2025-05-10 03:37:44', '2025-05-10 03:37:44'),
(260, 89, 4, 2, '10000', '2025-05-10 03:37:44', '2025-05-10 03:37:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `perhitungan`
--
ALTER TABLE `perhitungan`
  ADD PRIMARY KEY (`id_perhitungan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `produk_terjual`
--
ALTER TABLE `produk_terjual`
  ADD PRIMARY KEY (`id_produk_terjual`);

--
-- Indexes for table `rincian_produk_terjual`
--
ALTER TABLE `rincian_produk_terjual`
  ADD PRIMARY KEY (`id_rincian_produk_terjual`),
  ADD KEY `id_produk_terjual` (`id_produk_terjual`),
  ADD KEY `id_produk` (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `perhitungan`
--
ALTER TABLE `perhitungan`
  MODIFY `id_perhitungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `produk_terjual`
--
ALTER TABLE `produk_terjual`
  MODIFY `id_produk_terjual` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `rincian_produk_terjual`
--
ALTER TABLE `rincian_produk_terjual`
  MODIFY `id_rincian_produk_terjual` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rincian_produk_terjual`
--
ALTER TABLE `rincian_produk_terjual`
  ADD CONSTRAINT `rincian_produk_terjual_ibfk_1` FOREIGN KEY (`id_produk_terjual`) REFERENCES `produk_terjual` (`id_produk_terjual`),
  ADD CONSTRAINT `rincian_produk_terjual_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
