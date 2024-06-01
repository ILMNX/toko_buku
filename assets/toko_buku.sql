-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 22 Apr 2020 pada 15.12
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_buku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(30) NOT NULL,
  `nama` varchar(300) NOT NULL,
  `kontak` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `kontak`, `username`, `password`) VALUES
('002', 'admin', 'admin', 'admin', 'admin'),
('123', 'qwr', 'qwr', 'qrw', 'qrw');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `kode_buku` varchar(200) NOT NULL,
  `judul` varchar(400) NOT NULL,
  `penulis` varchar(400) NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `harga` double NOT NULL,
  `stok` double NOT NULL,
  `image` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`kode_buku`, `judul`, `penulis`, `tahun`, `harga`, `stok`, `image`) VALUES
('001', 'Membuat Aplikasi Penggajian Dengan Laravel Dan Postgree SQL', 'Nuris Akbar M.KOM', '2019', 145000, 15, '001-464.jpg'),
('002', 'Buku Data Mining Untuk Klasifikasi dan Klasterisasi Data', 'Dr. Suyanto', '2018', 100000, 9, '002-533.png'),
('003', 'Mastering VMware vSphere 6.5', 'Andrea Mauro', '2015', 120000, 3, '003-93.jpeg'),
('005', 'Data Mining dan Big Data Analytics', 'Budi Santosa & Ardian Umam', '2017', 120000, 1, '005-729.jpg'),
('006', 'Buku Pemrograman Semua Bisa Menjadi Programmer Laravel Basic Original', 'Andre Pratama', '2017', 94750, 1, '006-56.png'),
('007', 'Buku Belajar Otodidak Framework Codeigniter - Budi Raharjo', 'Budi Raharjo', '2019', 80000, 3, '007-757.jpg'),
('008', 'Buku Analisis Dan Perancangan Sistem Basis Data', 'Wahyuni Reksoatmojo', '2018', 80450, 6, '008-510.png'),
('009', 'Buku MySQL Uncover - Panduan Belajar MySQL/MariaDB untuk Pemula - Buku Cetak', 'Andre Pratama / Duniailkom', '2017', 225000, 16, '009-24.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `counterdb`
--

CREATE TABLE `counterdb` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `ip_address` varchar(20) CHARACTER SET latin1 NOT NULL,
  `counter` varchar(20) CHARACTER SET latin1 NOT NULL,
  `browser` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `counterdb`
--

INSERT INTO `counterdb` (`id`, `tanggal`, `ip_address`, `counter`, `browser`) VALUES
(1, '2020-03-30', '192.168.64.1', '1', 'chrome'),
(2, '2020-03-30', '192.168.64.1', '1', ''),
(3, '2020-03-30', '192.168.64.1', '1', ''),
(4, '2020-03-30', '192.168.64.1', '1', '0'),
(5, '2020-03-30', '192.168.64.1', '1', '0'),
(6, '2020-03-30', '192.168.64.1', '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(30) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` varchar(400) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `alamat`, `kontak`, `username`, `password`) VALUES
('1234', 'admin', 'admin', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_transaksi` varchar(40) NOT NULL,
  `kode_buku` varchar(200) NOT NULL,
  `jumlah` double NOT NULL,
  `harga_beli` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `kode_buku`, `jumlah`, `harga_beli`) VALUES
('ID2124', '002', 1, 100000),
('ID2680', '001', 1, 145000),
('ID2680', '002', 1, 100000),
('ID2680', '003', 1, 120000),
('ID2871', '001', 3, 145000),
('ID2759', '001', 1, 145000),
('ID2759', '002', 1, 100000),
('ID2759', '003', 1, 120000),
('ID2759', '005', 1, 120000),
('ID2759', '006', 1, 94750),
('ID2759', '007', 1, 80000),
('ID2759', '008', 1, 80450),
('ID2759', '009', 1, 225000),
('ID7022', '002', 1, 100000),
('ID7022', '002', 1, 100000),
('ID8747', '001', 4, 145000),
('ID3080', '002', 1, 100000),
('ID61', '001', 1, 145000),
('ID61', '003', 1, 120000),
('ID61', '005', 1, 120000),
('ID61', '008', 1, 80450),
('ID8923', '003', 5, 120000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(40) NOT NULL,
  `tgl` datetime NOT NULL,
  `id_customer` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl`, `id_customer`) VALUES
('ID2124', '2020-04-08 05:04:38', '1234'),
('ID2172', '2020-04-08 05:29:34', '1234'),
('ID2680', '2020-04-08 05:07:57', '1234'),
('ID2759', '2020-04-08 05:30:08', '1234'),
('ID2871', '2020-04-08 05:13:27', '1234'),
('ID3080', '2020-04-09 03:55:42', '1234'),
('ID5033', '2020-04-09 03:25:26', '1234'),
('ID61', '2020-04-09 03:56:11', '1234'),
('ID7022', '2020-04-09 03:16:12', '1234'),
('ID7523', '2020-04-09 03:23:58', '1234'),
('ID8747', '2020-04-09 03:18:19', '1234'),
('ID8923', '2020-04-14 04:11:55', '1234');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kode_buku`);

--
-- Indeks untuk tabel `counterdb`
--
ALTER TABLE `counterdb`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `counterdb`
--
ALTER TABLE `counterdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
