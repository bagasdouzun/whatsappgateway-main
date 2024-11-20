-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Nov 2024 pada 05.06
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
-- Database: `form_reg`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu_masuk` time DEFAULT NULL,
  `waktu_pulang` time DEFAULT NULL,
  `status_masuk` enum('Hadir','Terlambat','Alpa') DEFAULT 'Alpa',
  `status_pulang` enum('Pulang','Tidak Pulang') DEFAULT 'Tidak Pulang'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_siswa`, `tanggal`, `waktu_masuk`, `waktu_pulang`, `status_masuk`, `status_pulang`) VALUES
(11, 72, '2024-11-06', '08:57:24', NULL, 'Hadir', 'Tidak Pulang'),
(12, 73, '2024-11-06', '12:40:22', '12:56:41', 'Hadir', 'Pulang'),
(13, 72, '2024-11-07', '08:00:20', '08:30:33', 'Hadir', 'Pulang'),
(14, 74, '2024-11-07', '08:43:42', NULL, 'Hadir', 'Tidak Pulang'),
(15, 75, '2024-11-07', '09:17:17', NULL, 'Hadir', 'Tidak Pulang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','operator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `user`, `password`, `level`) VALUES
(1, 'bagas', '$2y$10$njTbLRlnv4atFXdrfUcc4.an8qzm5d7vVnoMwHrcPszA.aQp571HC', 'operator'),
(2, 'adi', '$2y$10$vKqNgVsAstyRBZaAqqwwqOZxgVToC6PVxTv9klPAgB33jGaJW1geS', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_tabel`
--

CREATE TABLE `siswa_tabel` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `absen` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rfid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa_tabel`
--

INSERT INTO `siswa_tabel` (`id`, `nama`, `nisn`, `absen`, `kelas`, `email`, `telepon`, `alamat`, `tanggal_daftar`, `rfid`) VALUES
(72, 'ADI BAGAS SETIYAWAN', '0063145085', 1, 'XII RPL 1', 'adibagassetiyawan16@gmail.com', '083833098296', 'Semanding, Jenangan, Ponorogo', '2024-11-06 01:54:24', '0063145085'),
(73, 'ADI BAGAS SETIYAWAN', '0063145085', 1, 'XII RPL 1', 'adibagassetiyawan16@gmail.com', '083833098296', 'Semanding, Jenangan, Ponorogo', '2024-11-06 05:37:50', '123'),
(74, 'ADI BAGAS SETIYAWAN', '876', 1, 'XII RPL 1', 'adibagassetiyawan16@gmail.com', '083833098296', 'Semanding, Jenangan, Ponorogo', '2024-11-07 01:42:40', '876'),
(75, 'umioo', '1314', 1, 'XII RPL 2', 'adibagassetiyawan16@gmail.com', '083833098296', 'Semanding, Jenangan, Ponorogo', '2024-11-07 02:17:00', '1922');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `siswa_tabel`
--
ALTER TABLE `siswa_tabel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `siswa_tabel`
--
ALTER TABLE `siswa_tabel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa_tabel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
