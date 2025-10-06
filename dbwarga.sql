-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Okt 2025 pada 05.52
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbwarga`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `nm_admin` text DEFAULT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`idadmin`, `nm_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'iklima', 'iklima', 'iklima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datawarga`
--

CREATE TABLE `datawarga` (
  `idwarga` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jeniskelamin` varchar(10) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `statu` varchar(20) DEFAULT NULL,
  `kerja` varchar(50) DEFAULT NULL,
  `warganegara` varchar(10) DEFAULT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `datawarga`
--

INSERT INTO `datawarga` (`idwarga`, `nama`, `tanggal`, `jeniskelamin`, `alamat`, `agama`, `statu`, `kerja`, `warganegara`, `foto`) VALUES
('1234567890', 'Iklima Azizah Jannah', '2002-04-29', 'perempuan', 'Jatijajar, Depok', 'Islam', 'Belum Kawin', 'Mahasiswa', 'Indonesia', '1234567890.jpg'),
('3276026206020001', 'Shani Indira', '2022-06-22', 'Perempuan', 'Depok', 'islam', 'Belum Kawin', 'Idol', 'WNI', '3276026206020001.jpg'),
('3276026909020005', 'Harry Potter', '2022-02-11', 'laki-laki', 'Hogwarts', 'protestan', 'kawin', 'penyihir', 'WNA', '3276026909020005.jpg'),
('3286026909020007', 'Harmione Granger', '2022-09-02', 'perempuan', 'Hogwarts', 'protestan', 'Belum Kawin', 'Penyihir Hogwarts', 'WNA', '3286026909020007.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
--

CREATE TABLE `surat` (
  `id_surat` int(11) NOT NULL,
  `idwarga` varchar(20) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `tanggal` date DEFAULT curdate(),
  `keperluan` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat`
--

INSERT INTO `surat` (`id_surat`, `idwarga`, `jenis_surat`, `tanggal`, `keperluan`, `status`) VALUES
(1, '1234567890', 'Surat Belum Menikah', '2025-10-04', 'Melamar Pekerjaan', 'Disetujui'),
(2, '3286026909020007', 'Surat Domisili', '2025-10-04', 'pindah', 'Menunggu');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indeks untuk tabel `datawarga`
--
ALTER TABLE `datawarga`
  ADD PRIMARY KEY (`idwarga`);

--
-- Indeks untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `idwarga` (`idwarga`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_ibfk_1` FOREIGN KEY (`idwarga`) REFERENCES `datawarga` (`idwarga`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
