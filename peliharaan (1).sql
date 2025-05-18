-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 13 Des 2024 pada 07.56
-- Versi server: 11.4.2-MariaDB-log
-- Versi PHP: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peliharaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `health_records`
--

CREATE TABLE `health_records` (
  `id` int(11) NOT NULL,
  `id_pet` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal_periksa` varchar(100) NOT NULL,
  `catatan` text NOT NULL,
  `vaksinasi` char(11) DEFAULT '0',
  `nama_vaksin` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `health_records`
--

INSERT INTO `health_records` (`id`, `id_pet`, `id_dokter`, `tanggal_periksa`, `catatan`, `vaksinasi`, `nama_vaksin`) VALUES
(10, 8, 9, '2024-12-10', 'Vaksin Rabis Diberikan', '1', 'Vaksin Rabiesss');

-- --------------------------------------------------------

--
-- Struktur dari tabel `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `kontak` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `owners`
--

INSERT INTO `owners` (`id`, `nama`, `alamat`, `kontak`, `email`, `id_user`) VALUES
(5, 'Tasyaaaa', 'Di rumah', '081293849322', 'tasyaaaPA@gmail.com', 25),
(6, 'Kelvin', 'DI rumahnya', '08129384932', 'lenkafarhana885@gmail.com', 34),
(7, 'Maulida Safa', 'DI rumahnyaa', '0812938493', 'esaminoe@gmail.com', 35),
(8, 'DIka Praditya', 'Di rumah lah', '08129384932', 'ktimothy776@gmail.com', 58);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `nama_hewan` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `ras` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pets`
--

INSERT INTO `pets` (`id`, `id_owner`, `nama_hewan`, `jenis`, `ras`, `jenis_kelamin`, `tanggal_lahir`) VALUES
(8, 7, 'Maulida', 'Anjing', 'Anjing', 'Betina', '2019-12-19'),
(9, 5, 'CutyPie', 'Kelinci', 'Imut', 'Betina', '2018-12-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `role`, `status`) VALUES
(19, 'Kevin T', '$2y$10$fQS3Eg694Rn5DpPZNSJrZ.3sPgMq3UTcN984s4xlW1zI/bVMDM66y', 'Dr. Kevin Timothy A', 'dokter', 1),
(20, 'Dr. Tasya', '$2y$10$I0W6P4fLtKgZOQGDntT/be2J8lUMUjIODegmZvC1PGCPQJF/Cb5le', 'Dr. Tasya Putri A', 'dokter', 1),
(22, 'Dr. Maulida Safa', '$2y$10$cKk0otjulJjyiLR6Y29ixe4is32ilKnzCs.fmddCcDVgRgkRvsiAy', 'Maulida Safa Azzahra', 'dokter', 2),
(25, 'Tasya Putrii Zahra', '$2y$10$aQtC2Pc0sE/VuM5uiUmOc.XcGuXuToLa49KmDuSp2nxlbZeCxa13K', 'Tasyaaaa', 'owner', 1),
(26, 'Tasya Putri', '$2y$10$0.Ty3CF34iKZbHq2Xx./oOFDc7wV2otOfEu42hQsRIZZlgSeSitci', 'Tasya Putri Azzahra', 'admin', 2),
(27, 'Kevin', '$2y$10$kMwGMLABnwtlCEyI0yw/KuMIS0d.KSJ0K/403am6fi9.xCOBA/NvK', 'Tasya', 'admin', 1),
(28, 'kevinn', '$2y$10$8.3BGwZdHbyVxLrY9p/pk.5pKjC/MbRQ8UcJNmWFjazd9YDXOCQB6', 'Kevin Timothy', 'dokter', 1),
(34, 'taysya', '$2y$10$61ndzIAG2I1i.yhWSp1Kn.QzhsROz8zPYLaKOeywkmE3cFoqH.8D2', 'Kelvin', 'owner', 1),
(35, 'Maulida', '$2y$10$O6oQAAabAvb0Tbww6QnaluO5fpgr.nCyhPDogwTH4mudXOcNmQFrO', 'Maulida Safa', 'owner', 1),
(53, 'Dr. Maulida maulida', '$2y$10$flEARwmNzHVip./C5UJoLuAIUs3ONnPLId/rHBfd3cfyGATlUPr8m', 'maulida Malu', 'dokter', 1),
(54, 'Dr. Tasya Cantik', '$2y$10$/bDeg2.kIG02FtkrN2gjqO8ABiGygxgPtn4Euj9PKuU/hEus0aILS', 'Tasya Cantik Azzahra', 'admin', 1),
(55, 'admin', '$2y$10$jlyHKYU6SM8fpPhLkTsaBexe2hfKKN.6uaw4nokcICce/QoufFY1u', 'Admin1', 'admin', 1),
(56, 'owner', '$2y$10$hdbc05qH4Ro9iiTA5jJoaOukSP9xV3G8Lc80YktkFRCljmZt0MNX.', 'Owner1', 'owner', 1),
(57, 'dokter', '$2y$10$kmfpzLks7j8HoTwBKqVcBOXoRrhdXNHZQSTtruoPRtVQ2fBD/wwjm', 'Dokter1', 'dokter', 1),
(58, 'Andika', '$2y$10$/YsbYiiu/76gpRzMHU4SCuZKth7ymM6zcuV5KQFkN0YIxke6VqU6e', 'DIka Praditya', 'owner', 1),
(59, 'Dr. Annisah', '$2y$10$QJdjN6d91HaEklxFgxdTAOERepcAV6BlPNQlQYa22BiScM/J5Hz7i', 'Annisah', 'dokter', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vets`
--

CREATE TABLE `vets` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `spesialisasi` varchar(100) DEFAULT NULL,
  `kontek` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `vets`
--

INSERT INTO `vets` (`id`, `nama`, `spesialisasi`, `kontek`, `alamat`, `id_user`) VALUES
(7, 'Dr. Tasya Putri A', 'Spesialis Kelinci', '081234567889', 'JL Wonorejo', 20),
(9, 'Maulida Safa Azzahra', 'Spesialis Hewan Buas', '0812934938', 'DI rumahnya', 22),
(11, 'Tasya Cantik Azzahra', 'Spesialis Hewan Imut', '081234567889', 'DI rumah Tasya', 54),
(12, 'Annisah', 'Spesialis Hewan Buas', '0812938394', 'Waduk', 59);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `health_records`
--
ALTER TABLE `health_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pet` (`id_pet`),
  ADD KEY `nama_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_owner` (`id_owner`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`nama`),
  ADD KEY `Nama` (`nama`);

--
-- Indeks untuk tabel `vets`
--
ALTER TABLE `vets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD KEY `nama` (`nama`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `health_records`
--
ALTER TABLE `health_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `vets`
--
ALTER TABLE `vets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `health_records`
--
ALTER TABLE `health_records`
  ADD CONSTRAINT `health_records_ibfk_1` FOREIGN KEY (`id_pet`) REFERENCES `pets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `health_records_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `vets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `owners`
--
ALTER TABLE `owners`
  ADD CONSTRAINT `owners_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`id_owner`) REFERENCES `owners` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `vets`
--
ALTER TABLE `vets`
  ADD CONSTRAINT `vets_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
