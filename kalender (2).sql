-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2023 pada 14.29
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalender`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` bigint(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tglMulai` date NOT NULL,
  `tglSelesai` date NOT NULL,
  `level` enum('kurang','sedang','penting') NOT NULL,
  `durasi` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama`, `tglMulai`, `tglSelesai`, `level`, `durasi`, `lokasi`, `gambar`, `username`) VALUES
(45, 'upacara', '2023-05-26', '2023-05-26', 'sedang', '1 jam 0 menit', 'De Britto', 'upload/1685119459id.jpg', 'Gian Pradipta'),
(46, 'Sembahyang', '2023-05-27', '2023-05-27', 'sedang', '0 jam 30 menit', 'GKJ Gondokusuman', 'upload/1685120860id.png', '71210689'),
(47, 'Sembahyang malih', '2023-05-28', '2023-05-28', 'sedang', '1 jam 0 menit', 'GKJ Gondokusuman', 'upload/1685121030id.png', '71210689'),
(50, 'Mangan All You Can Eat', '2023-08-04', '2023-08-04', 'sedang', '1 jam 30 menit', 'Madang', 'pp', 'Gian Pradipta'),
(51, 'Turu Meneh', '2024-01-02', '2024-01-02', 'kurang', '1 jam 0 menit', 'UKDW', 'upload/1685219189id.png', '71210689'),
(52, 'Natalan Halleluya', '2023-12-25', '2023-12-25', 'sedang', '1 jam 0 menit', 'GKJ Margoyudan', 'upload/1685219328id.png', '71210689'),
(55, 'Berkelahi', '2023-05-29', '2023-05-29', 'kurang', '0 jam 5 menit', 'SMA Regina Pacis', 'pp', 'Gian Pradipta'),
(57, 'sembahyang', '2023-05-28', '2023-05-28', 'sedang', '1 jam 0 menit', 'GKJ Margoyudan', 'upload/1685275016id.png', '71210683'),
(62, 'Berkelahi lagi', '2023-06-02', '2023-06-02', 'penting', '2 jam 0 menit', 'Parkiran', 'upload/1685342743id.png', '71210683'),
(64, 'sembahyang', '2023-05-31', '2023-05-31', 'kurang', '1 jam 0 menit', 'UKDW', 'upload/1685431386id.png', '71210689'),
(65, 'demo biro 2', '2023-05-31', '2023-05-31', 'kurang', '1 jam 0 menit', 'agape', 'pp', '71210689'),
(66, 'udud', '2023-05-31', '2023-05-31', 'kurang', '0 jam 1 menit', 'pop mart', 'pp', '71210689'),
(67, 'Berkelahi dengan PSHT', '2023-06-15', '2023-06-15', 'sedang', '0 jam 5 menit', 'Taman Siswa', 'upload/1686816557.jpg', '71210689'),
(70, 'Berkelahi dengan PSHT', '2023-06-08', '2023-06-08', 'kurang', '0 jam 1 menit', 'Taman Siswa', 'upload/1686113503.jpg', '71210683'),
(72, 'Turu', '2023-06-08', '2023-06-08', 'penting', '1 jam 0 menit', 'kos', 'pp', 'Gian Pradipta'),
(73, 'wisuda bismillah', '2024-12-05', '2024-12-05', 'penting', '2 jam 30 menit', 'Koninonia', 'upload/1686748974.png', '71210689'),
(74, 'Upacara', '2023-06-17', '2023-06-18', 'penting', '0 jam 45 menit', 'De Britto', 'upload/1686757580.png', '71210689'),
(75, 'sembahyang', '2023-06-17', '2023-06-17', 'penting', '1 jam 0 menit', 'GKJ Margoyudan', 'pp', '71210689');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('71210683', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
('71210689', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
('Gian Pradipta', 'c34f6dbc8ece71139b60abca85ab8dee5faee6f71d9d39535add5781797eac83');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
