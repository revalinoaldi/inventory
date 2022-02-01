-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Feb 2022 pada 04.48
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_barang`
--

CREATE TABLE `ms_barang` (
  `kd_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(150) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `ket_barang` varchar(255) DEFAULT NULL,
  `harga_barang` double DEFAULT NULL,
  `stok_awal` int(11) DEFAULT NULL,
  `pemakaian` int(11) DEFAULT NULL,
  `stok_akhir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `ms_barang`
--

INSERT INTO `ms_barang` (`kd_barang`, `nama_barang`, `satuan`, `ket_barang`, `harga_barang`, `stok_awal`, `pemakaian`, `stok_akhir`) VALUES
('KD-013', 'Peplink Mikrotik', 'PCS', 'Untuk Mikrotik', 990000, 5, 5, NULL),
('KD-XTR', 'Mikrotik', 'PCS', 'Blablalbal', 225000, 10, 205, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_customer`
--

CREATE TABLE `ms_customer` (
  `id_customer` int(20) NOT NULL,
  `kode_customer` varchar(30) DEFAULT NULL,
  `nama_customer` varchar(50) DEFAULT NULL,
  `alamat_customer` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `ms_customer`
--

INSERT INTO `ms_customer` (`id_customer`, `kode_customer`, `nama_customer`, `alamat_customer`, `no_hp`, `email`) VALUES
(1, 'CUST-0001', 'Aldi', 'Bintara', '08159878369', 'himpunan.stmik.banisaleh@gmail.com'),
(2, 'CUST-0002', 'Yuni', 'Bintaro', '0815627123', 'yuni@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_supplier`
--

CREATE TABLE `ms_supplier` (
  `id_supplier` int(11) NOT NULL,
  `kd_supplier` varchar(30) DEFAULT NULL,
  `nama_supplier` varchar(50) DEFAULT NULL,
  `alamat_supplier` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `pic_supplier` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_supplier`
--

INSERT INTO `ms_supplier` (`id_supplier`, `kd_supplier`, `nama_supplier`, `alamat_supplier`, `no_hp`, `email`, `pic_supplier`) VALUES
(1, 'SUP-0001', 'Alfamart', 'Sulawesi', '089912919123', 'agus@gmail.com', 'Agus'),
(2, 'SUP-0002', 'Alfamart', 'Bintaro', '08159878369', 'yudi@gmail.com', 'Yudi'),
(3, 'SUP-0003', 'Peplink', 'Bogor Raya', '0819227123', 'yudi@gmail.com', 'DC Sat Bogor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_login`
--

CREATE TABLE `tb_login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tb_login`
--

INSERT INTO `tb_login` (`id_login`, `username`, `password`, `level`, `nama`, `foto`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Super Admin', 'Admin', '5fd0316534625d0fb476e28fce7836c9.png'),
(2, 'gudang', '202446dd1d6028084426867365b0c7a1', 'Admin', 'Gudang', '54da95a73d41593c2b3a69cc7638034c.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_barang_keluar`
--

CREATE TABLE `tr_barang_keluar` (
  `id_tr_k` varchar(30) NOT NULL,
  `tgl_tr_k` timestamp NULL DEFAULT current_timestamp(),
  `id_login` int(11) DEFAULT NULL,
  `ket_tr_k` varchar(255) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tr_barang_keluar`
--

INSERT INTO `tr_barang_keluar` (`id_tr_k`, `tgl_tr_k`, `id_login`, `ket_tr_k`, `id_customer`) VALUES
('TRP2112210001', '2021-12-21 07:00:01', 1, 'COD', 1),
('TRP2112210002', '2021-12-21 07:18:18', 1, 'COD', 1),
('TRP2112210003', '2021-12-21 08:18:33', 1, 'COD', 1),
('TRP2212210001', '2021-12-22 12:46:26', 1, 'GO di Timur', 2),
('TRP3004210001', '2021-04-29 23:28:30', 1, 'Keluar barang Q1 - 2021', 1),
('TRP3007210001', '2021-07-29 23:29:53', 1, 'Keluar barang Q2 - 2021', 1),
('TRP3010210001', '2021-10-29 23:30:56', 1, 'Keluar barang Q3 - 2021', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_barang_keluar_beli`
--

CREATE TABLE `tr_barang_keluar_beli` (
  `id` int(11) NOT NULL,
  `id_tr_k` varchar(30) DEFAULT NULL,
  `kd_barang` varchar(20) DEFAULT NULL,
  `jumlah_beli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tr_barang_keluar_beli`
--

INSERT INTO `tr_barang_keluar_beli` (`id`, `id_tr_k`, `kd_barang`, `jumlah_beli`) VALUES
(1, 'TRP2112210001', 'KD-XTR', 4),
(2, 'TRP2112210002', 'KD-XTR', 9),
(3, 'TRP2112210003', 'KD-XTR', 2),
(4, 'TRP2212210001', 'KD-013', 5),
(5, 'TRP2212210001', 'KD-XTR', 10),
(6, 'TRP3004210001', 'KD-XTR', 30),
(7, 'TRP3007210001', 'KD-XTR', 70),
(8, 'TRP3010210001', 'KD-XTR', 80);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_barang_keluar_dtl`
--

CREATE TABLE `tr_barang_keluar_dtl` (
  `id_tr_kdetail` int(11) NOT NULL,
  `kd_barang` varchar(20) DEFAULT NULL,
  `jumlah_awal` int(11) DEFAULT NULL,
  `jumlah_keluar` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `id_tr_k` varchar(30) DEFAULT NULL,
  `id_tr_m` varchar(30) DEFAULT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `id_tr_mdetail` int(11) DEFAULT NULL,
  `jumlah_beli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tr_barang_keluar_dtl`
--

INSERT INTO `tr_barang_keluar_dtl` (`id_tr_kdetail`, `kd_barang`, `jumlah_awal`, `jumlah_keluar`, `harga`, `id_tr_k`, `id_tr_m`, `tgl_masuk`, `id_tr_mdetail`, `jumlah_beli`) VALUES
(1, 'KD-XTR', 5, 1, 0, 'TRP2112210001', 'BRM2112210005', NULL, 5, NULL),
(2, 'KD-XTR', 1, 0, 50000, 'TRP2112210002', 'BRM2112210005', NULL, 5, NULL),
(3, 'KD-XTR', 6, 0, 50000, 'TRP2112210002', 'BRM2112210004', NULL, 4, NULL),
(4, 'KD-XTR', 2, 0, 50000, 'TRP2112210002', 'BRM2112210006', NULL, 6, NULL),
(5, 'KD-XTR', 7, 5, 50000, 'TRP2112210003', 'BRM2112210007', NULL, 7, NULL),
(6, 'KD-013', 10, 5, 9900000, 'TRP2212210001', 'BRM2212210001', NULL, 9, NULL),
(7, 'KD-XTR', 5, 0, 50000, 'TRP2212210001', 'BRM2112210007', NULL, 7, NULL),
(8, 'KD-XTR', 10, 5, 50000, 'TRP2212210001', 'BRM2112210008', NULL, 8, NULL),
(9, 'KD-XTR', 50, 20, 50000, 'TRP3004210001', 'BRM3003210002', NULL, 10, NULL),
(10, 'KD-XTR', 20, 0, 50000, 'TRP3007210001', 'BRM3003210002', NULL, 10, NULL),
(11, 'KD-XTR', 50, 0, 50000, 'TRP3007210001', 'BRM3006210001', NULL, 11, NULL),
(12, 'KD-XTR', 45, 0, 50000, 'TRP3010210001', 'BRM3009210001', NULL, 12, NULL),
(13, 'KD-XTR', 5, 0, 50000, 'TRP3010210001', 'BRM2112210008', NULL, 8, NULL),
(14, 'KD-XTR', 40, 10, 50000, 'TRP3010210001', 'BRM3012210001', NULL, 13, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_barang_masuk`
--

CREATE TABLE `tr_barang_masuk` (
  `id_tr_m` varchar(30) NOT NULL,
  `tgl_tr_m` timestamp NULL DEFAULT current_timestamp(),
  `id_login` int(11) DEFAULT NULL,
  `ket_tr_m` varchar(255) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tr_barang_masuk`
--

INSERT INTO `tr_barang_masuk` (`id_tr_m`, `tgl_tr_m`, `id_login`, `ket_tr_m`, `id_supplier`) VALUES
('BRM2112210001', '2021-12-21 04:44:35', 2, 'wrqwe', 1),
('BRM2112210002', '2021-12-21 04:51:40', 2, 'werqwr', 1),
('BRM2112210003', '2021-12-21 06:12:23', 2, 'asdasdasd', 2),
('BRM2112210004', '2021-12-21 06:12:46', 2, 'asdasdasd', 1),
('BRM2112210005', '2021-12-21 06:42:32', 2, 'Keluar barang', 2),
('BRM2112210006', '2021-12-21 07:02:22', 1, 'asdasdasd', 1),
('BRM2112210007', '2021-12-21 07:21:03', 2, 'asdasdasd', 1),
('BRM2112210008', '2021-12-21 08:17:36', 1, 'Masuk barang baru bakti', 1),
('BRM2212210001', '2021-12-22 12:41:22', 2, 'Untuk GO Satlink di Timur', 3),
('BRM3003210001', '2021-03-29 23:22:13', 1, 'Penyimpanan Unit April', 1),
('BRM3003210002', '2021-03-29 23:22:59', 1, 'Penyimpanan Unit April', 1),
('BRM3006210001', '2021-06-29 23:23:37', 1, 'Penyimpanan Unit Juli', 2),
('BRM3009210001', '2021-09-29 23:24:58', 2, 'Penyimpanan Unit Oktober', 2),
('BRM3012210001', '2021-12-29 23:26:28', 1, 'Penyimpanan Unit Tahun Baru 2022', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_barang_masuk_dtl`
--

CREATE TABLE `tr_barang_masuk_dtl` (
  `id_tr_mdetail` int(11) NOT NULL,
  `kd_barang` varchar(20) DEFAULT NULL,
  `jumlah_masuk` int(11) DEFAULT NULL,
  `id_tr_m` varchar(30) DEFAULT NULL,
  `tgl_masuk` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tr_barang_masuk_dtl`
--

INSERT INTO `tr_barang_masuk_dtl` (`id_tr_mdetail`, `kd_barang`, `jumlah_masuk`, `id_tr_m`, `tgl_masuk`) VALUES
(1, '', 0, 'BRM2112210001', '2021-12-21 11:12:35'),
(2, '', 5, 'BRM2112210002', '2021-12-21 11:12:40'),
(3, '', 6, 'BRM2112210003', '2021-12-21 13:12:23'),
(4, 'KD-XTR', 6, 'BRM2112210004', '2021-12-21 13:12:46'),
(5, 'KD-XTR', 5, 'BRM2112210005', '2021-12-21 13:12:32'),
(6, 'KD-XTR', 2, 'BRM2112210006', '2021-12-21 14:12:22'),
(7, 'KD-XTR', 7, 'BRM2112210007', '2021-12-21 14:12:03'),
(8, 'KD-XTR', 10, 'BRM2112210008', '2021-12-21 15:12:36'),
(9, 'KD-013', 10, 'BRM2212210001', '2021-12-22 19:12:22'),
(10, 'KD-XTR', 50, 'BRM3003210002', '2021-03-30 06:03:59'),
(11, 'KD-XTR', 50, 'BRM3006210001', '2021-06-30 06:06:37'),
(12, 'KD-XTR', 45, 'BRM3009210001', '2021-09-30 06:09:58'),
(13, 'KD-XTR', 40, 'BRM3012210001', '2021-12-30 06:12:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_barang_masuk_dtl_pakai`
--

CREATE TABLE `tr_barang_masuk_dtl_pakai` (
  `id_tr_mdetail` int(11) NOT NULL,
  `kd_barang` varchar(20) DEFAULT NULL,
  `jumlah_masuk` int(11) DEFAULT NULL,
  `id_tr_m` varchar(30) DEFAULT NULL,
  `tgl_masuk` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tr_barang_masuk_dtl_pakai`
--

INSERT INTO `tr_barang_masuk_dtl_pakai` (`id_tr_mdetail`, `kd_barang`, `jumlah_masuk`, `id_tr_m`, `tgl_masuk`) VALUES
(1, '', 0, 'BRM2112210001', '2021-12-21 11:12:35'),
(2, '', 5, 'BRM2112210002', '2021-12-21 11:12:40'),
(3, '', 6, 'BRM2112210003', '2021-12-21 13:12:23'),
(4, 'KD-XTR', 0, 'BRM2112210004', '2021-12-21 13:12:46'),
(5, 'KD-XTR', 0, 'BRM2112210005', '2021-12-21 13:12:32'),
(6, 'KD-XTR', 0, 'BRM2112210006', '2021-12-21 14:12:22'),
(7, 'KD-XTR', 0, 'BRM2112210007', '2021-12-21 14:12:03'),
(8, 'KD-XTR', 0, 'BRM2112210008', '2021-12-21 15:12:36'),
(9, 'KD-013', 5, 'BRM2212210001', '2021-12-22 19:12:22'),
(10, 'KD-XTR', 0, 'BRM3003210002', '2021-03-30 06:03:59'),
(11, 'KD-XTR', 0, 'BRM3006210001', '2021-06-30 06:06:37'),
(12, 'KD-XTR', 0, 'BRM3009210001', '2021-09-30 06:09:58'),
(13, 'KD-XTR', 10, 'BRM3012210001', '2021-12-30 06:12:28');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_dtl_keluar`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_dtl_keluar` (
`id_tr_kdetail` int(11)
,`kd_barang` varchar(20)
,`jumlah_awal` int(11)
,`jumlah_keluar` int(11)
,`harga` double
,`id_tr_k` varchar(30)
,`tgl_tr_k` timestamp
,`ket_tr_k` varchar(255)
,`id_customer` int(11)
,`id_tr_m` varchar(30)
,`tgl_masuk` datetime
,`id_tr_mdetail` int(11)
,`jumlah_beli` int(11)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_dtl_keluar`
--
DROP TABLE IF EXISTS `v_dtl_keluar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dtl_keluar`  AS SELECT `k`.`id_tr_kdetail` AS `id_tr_kdetail`, `k`.`kd_barang` AS `kd_barang`, `k`.`jumlah_awal` AS `jumlah_awal`, `k`.`jumlah_keluar` AS `jumlah_keluar`, `k`.`harga` AS `harga`, `k`.`id_tr_k` AS `id_tr_k`, `b`.`tgl_tr_k` AS `tgl_tr_k`, `b`.`ket_tr_k` AS `ket_tr_k`, `b`.`id_customer` AS `id_customer`, `k`.`id_tr_m` AS `id_tr_m`, `k`.`tgl_masuk` AS `tgl_masuk`, `k`.`id_tr_mdetail` AS `id_tr_mdetail`, `k`.`jumlah_beli` AS `jumlah_beli` FROM (`tr_barang_keluar_dtl` `k` join `tr_barang_keluar` `b` on(`k`.`id_tr_k` = `b`.`id_tr_k`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ms_barang`
--
ALTER TABLE `ms_barang`
  ADD PRIMARY KEY (`kd_barang`) USING BTREE;

--
-- Indeks untuk tabel `ms_customer`
--
ALTER TABLE `ms_customer`
  ADD PRIMARY KEY (`id_customer`) USING BTREE;

--
-- Indeks untuk tabel `ms_supplier`
--
ALTER TABLE `ms_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_login`) USING BTREE;

--
-- Indeks untuk tabel `tr_barang_keluar`
--
ALTER TABLE `tr_barang_keluar`
  ADD PRIMARY KEY (`id_tr_k`) USING BTREE;

--
-- Indeks untuk tabel `tr_barang_keluar_beli`
--
ALTER TABLE `tr_barang_keluar_beli`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `tr_barang_keluar_dtl`
--
ALTER TABLE `tr_barang_keluar_dtl`
  ADD PRIMARY KEY (`id_tr_kdetail`) USING BTREE;

--
-- Indeks untuk tabel `tr_barang_masuk`
--
ALTER TABLE `tr_barang_masuk`
  ADD PRIMARY KEY (`id_tr_m`) USING BTREE;

--
-- Indeks untuk tabel `tr_barang_masuk_dtl`
--
ALTER TABLE `tr_barang_masuk_dtl`
  ADD PRIMARY KEY (`id_tr_mdetail`) USING BTREE;

--
-- Indeks untuk tabel `tr_barang_masuk_dtl_pakai`
--
ALTER TABLE `tr_barang_masuk_dtl_pakai`
  ADD PRIMARY KEY (`id_tr_mdetail`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ms_customer`
--
ALTER TABLE `ms_customer`
  MODIFY `id_customer` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ms_supplier`
--
ALTER TABLE `ms_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tr_barang_keluar_beli`
--
ALTER TABLE `tr_barang_keluar_beli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tr_barang_keluar_dtl`
--
ALTER TABLE `tr_barang_keluar_dtl`
  MODIFY `id_tr_kdetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tr_barang_masuk_dtl`
--
ALTER TABLE `tr_barang_masuk_dtl`
  MODIFY `id_tr_mdetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tr_barang_masuk_dtl_pakai`
--
ALTER TABLE `tr_barang_masuk_dtl_pakai`
  MODIFY `id_tr_mdetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
