-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jan 2024 pada 09.40
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudangweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_data_cabang`
--

CREATE TABLE `tbl_data_cabang` (
  `id_cabang` int(11) NOT NULL,
  `nama_cabang` varchar(100) NOT NULL,
  `notelpon_cabang` varchar(100) NOT NULL,
  `alamat_cabang` varchar(100) NOT NULL,
  `foto_cabang` varchar(255) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_data_cabang`
--

INSERT INTO `tbl_data_cabang` (`id_cabang`, `nama_cabang`, `notelpon_cabang`, `alamat_cabang`, `foto_cabang`, `update_at`) VALUES
(1, 'Batik Faaro Buaran', '085453453556', 'Buaran Pekalongan', '1703674233_4760e3895f71602a9aca.jpg', '2023-12-27 13:07:22'),
(2, 'Batik Faaro IBC Wiradesa', '08545345354', 'Kompleks Pertokoan IBC Wiradesa', '1703680410_772c5ab318185607ed62.jpg', '2023-12-27 13:07:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_data_produk`
--

CREATE TABLE `tbl_data_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `deskripsi_produk` varchar(100) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_motif` int(11) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_data_produk`
--

INSERT INTO `tbl_data_produk` (`id_produk`, `nama_produk`, `deskripsi_produk`, `foto_produk`, `update_at`, `id_motif`, `id_jenis`) VALUES
(1, 'Dress wanita warna pelangi', 'Dress panjang wanita motif melati ungu. Ukuran: XL, dan M', '1702971279_a9d5c662c4b73b322265.jpg', '2023-12-27 13:05:07', 1, 1),
(2, 'Kemeja lengan panjang pria', 'Kemeja panjang pria', 'default_produk.jpeg', '2023-12-27 13:05:14', 1, 2),
(3, 'Kemeja anak laki-laki', 'Kemeja lengan panjang anak laki-laki', '1703680625_544cd10b0a8a90ebc585.jpeg', '2023-12-27 13:05:24', 2, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_data_user`
--

CREATE TABLE `tbl_data_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `notelpon_user` varchar(100) NOT NULL,
  `jobdesk_user` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `foto_user` varchar(255) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_data_user`
--

INSERT INTO `tbl_data_user` (`id_user`, `username`, `password`, `nama_lengkap`, `notelpon_user`, `jobdesk_user`, `level`, `foto_user`, `update_at`) VALUES
(19, 'admin', '1234', 'Administrator', '08523320390', 'Mengelola Akun Pengguna Sistem', 1, '1703648661_49a03e037299da324c44.png', '2024-01-01 14:04:03'),
(20, 'pemilik', '1234', 'Pemilik', '08523300000', 'Pemilik', 2, '1704545442_54e541f4e470eb527a66.png', '2024-01-08 04:36:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_produk`
--

CREATE TABLE `tbl_jenis_produk` (
  `id_jenis` int(11) NOT NULL,
  `jenis_produk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jenis_produk`
--

INSERT INTO `tbl_jenis_produk` (`id_jenis`, `jenis_produk`) VALUES
(1, 'Dress Panjang Wanita'),
(2, 'Kemeja Pria Lengan Panjang'),
(3, 'Kemeja Anak Cowok'),
(4, 'Kemeja Wanita');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_laporan_produk`
--

CREATE TABLE `tbl_laporan_produk` (
  `id_laporan` int(11) NOT NULL,
  `id_mutation` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_laporan_produk`
--

INSERT INTO `tbl_laporan_produk` (`id_laporan`, `id_mutation`, `id_produk`, `id_cabang`) VALUES
(2, 17, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_motif_produk`
--

CREATE TABLE `tbl_motif_produk` (
  `id_motif` int(11) NOT NULL,
  `nama_motif` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_motif_produk`
--

INSERT INTO `tbl_motif_produk` (`id_motif`, `nama_motif`) VALUES
(1, 'Motif kembang-kembang'),
(2, 'Motif kawung'),
(3, 'Motif Megamendung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mutation`
--

CREATE TABLE `tbl_mutation` (
  `id_mutation` int(11) NOT NULL,
  `jumlah_mutation` varchar(500) NOT NULL,
  `tanggal_mutation` date NOT NULL,
  `cabang_asal` int(11) NOT NULL,
  `cabang_tujuan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_mutation`
--

INSERT INTO `tbl_mutation` (`id_mutation`, `jumlah_mutation`, `tanggal_mutation`, `cabang_asal`, `cabang_tujuan`, `id_produk`, `update_at`) VALUES
(17, '5', '2024-01-09', 1, 2, 1, '2024-01-07 10:25:11'),
(18, '5', '2024-01-09', 2, 1, 2, '2024-01-08 02:49:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_stok_produk`
--

CREATE TABLE `tbl_stok_produk` (
  `id_stok` int(11) NOT NULL,
  `jumlah_stok_produk` varchar(100) NOT NULL,
  `tanggal_masuk_produk` date NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_produk` int(11) DEFAULT NULL,
  `id_motif` int(11) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_stok_produk`
--

INSERT INTO `tbl_stok_produk` (`id_stok`, `jumlah_stok_produk`, `tanggal_masuk_produk`, `update_at`, `id_produk`, `id_motif`, `id_cabang`) VALUES
(11, '5', '2024-01-08', '2024-01-07 13:46:30', 1, 1, 1),
(12, '5', '2024-01-08', '2024-01-08 02:49:40', 2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_data_cabang`
--
ALTER TABLE `tbl_data_cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indeks untuk tabel `tbl_data_produk`
--
ALTER TABLE `tbl_data_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tbl_data_user`
--
ALTER TABLE `tbl_data_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tbl_jenis_produk`
--
ALTER TABLE `tbl_jenis_produk`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `tbl_laporan_produk`
--
ALTER TABLE `tbl_laporan_produk`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `tbl_motif_produk`
--
ALTER TABLE `tbl_motif_produk`
  ADD PRIMARY KEY (`id_motif`);

--
-- Indeks untuk tabel `tbl_mutation`
--
ALTER TABLE `tbl_mutation`
  ADD PRIMARY KEY (`id_mutation`);

--
-- Indeks untuk tabel `tbl_stok_produk`
--
ALTER TABLE `tbl_stok_produk`
  ADD PRIMARY KEY (`id_stok`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_data_cabang`
--
ALTER TABLE `tbl_data_cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_data_produk`
--
ALTER TABLE `tbl_data_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_data_user`
--
ALTER TABLE `tbl_data_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_produk`
--
ALTER TABLE `tbl_jenis_produk`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_laporan_produk`
--
ALTER TABLE `tbl_laporan_produk`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_motif_produk`
--
ALTER TABLE `tbl_motif_produk`
  MODIFY `id_motif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_mutation`
--
ALTER TABLE `tbl_mutation`
  MODIFY `id_mutation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_stok_produk`
--
ALTER TABLE `tbl_stok_produk`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
