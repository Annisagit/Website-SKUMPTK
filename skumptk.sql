-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2023 pada 03.52
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
-- Database: `skumptk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'ria', '$2y$10$61q8nJ6A6qK7PBts.xtHaOnUegeFk7DwGa6Sc9Fr1gpG0YYHfKMZK'),
(2, 'gina', '$2y$10$ipwodsGnMQlKlMJLIO3PEOBjX/F8CeL7ZCIF2V5O3ERa6Fhg33X9.'),
(3, 'cesa', '$2y$10$35Gk3LqEsIemH4ATdBGteefmKUH0/czr//JvLhufmdLfup9g4yMcu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengusul`
--

CREATE TABLE `pengusul` (
  `id` int(11) NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` int(20) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `agama` varchar(25) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `instansi` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `submit_status` varchar(35) NOT NULL,
  `hard_copy` text NOT NULL,
  `tgl_upload` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengusul`
--

INSERT INTO `pengusul` (`id`, `username`, `password`, `nama`, `nip`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `jabatan`, `pangkat`, `instansi`, `address`, `submit_status`, `hard_copy`, `tgl_upload`) VALUES
(1, 'cesa', '$2y$10$rUuKcrwGTRhOg5yUPRyWD.oaie77dBTE/1pMEpqUL5NpzxTxn7B5G', 'Chaesa Adella Rahma', 2107411003, 'Bengkulu', '2003-11-10', 'Perempuan', 'Islam', 'Cyber Security', 'XIV', 'Pemprov DKI', 'Jl. Timur Indah 1', 'Terkirim', '7386-22420-2-PB.pdf', '2023-01-17 09:47:15'),
(2, 'gina', '$2y$10$TqYpPyvx9MkVl.LpfFCDjuwWllTcs.VKUqK4.jEF.oI.bj1iipUBq', 'Raisya Ghina Inayah', 2107411004, 'Bengkulu', '2002-05-28', 'Perempuan', 'Islam', 'Cyber Security', 'XV', 'Pemprov DKI', 'Jl. Timur Indah 1', 'Diterima', '1413-5310-1-PB.pdf', '2023-01-17 09:47:59'),
(3, 'ria', '$2y$10$k32rPS5Pcx/bWfqIUCed6.RqFLGoGJfVvgxjs0ayyNdIxgbz/icxa', 'Qomariyah Rahmadani', 2107411005, 'Bengkulu', '2003-11-18', 'Perempuan', 'Islam', 'Kepala Ahli Gizi', 'XV', 'Poltekkes Bengkulu', 'Padang Jati', 'Ditolak', '8460-18703-1-SP.pdf', '2023-01-17 09:48:35'),
(4, 'lala', '$2y$10$Z.YIfWs2HJv9r50DdLKeVO3IJqmceqLproTx18UqTLVNEBu1QsBQC', 'Dieniati Nabilah', 2107411006, 'Bengkulu', '2003-04-05', 'Perempuan', 'Islam', 'Arsitek', 'XIV', 'BUMN', 'Bumi Ayu', 'Terkirim', '1325-3344-1-PB.pdf', '2023-01-17 09:49:29'),
(5, 'vivi', '$2y$10$ZX.GnXSfd0gF4OKzPVlZ.eqRMNI7gXpNcaDUXApz/4PJ6AoNKomG2', 'Syafitri Ristiana', 2107411007, 'Bengkulu', '2003-06-06', 'Perempuan', 'Islam', 'Dokter', 'XV', 'RSPAD Gatot Soebroto', 'Padang Harapan', 'Diterima', '246-Article Text-1000-1-10-20170812.pdf', '2023-01-17 09:50:26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengusul`
--
ALTER TABLE `pengusul`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengusul`
--
ALTER TABLE `pengusul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
