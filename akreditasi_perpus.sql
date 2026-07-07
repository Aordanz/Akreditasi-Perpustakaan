-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 07, 2026 at 07:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akreditasi_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_bukti`
--

CREATE TABLE `dokumen_bukti` (
  `id` int NOT NULL,
  `sub_komponen_id` int NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `tanggal_upload` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `id` int NOT NULL,
  `sub_komponen_id` int NOT NULL,
  `nomor_indikator` varchar(15) NOT NULL,
  `nama_indikator` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`id`, `sub_komponen_id`, `nomor_indikator`, `nama_indikator`) VALUES
(1, 3, '1.3.4', 'Presentase Program Studi Universitas yan...'),
(2, 3, '1.3.5', 'Perpustakaan secara berkala melakukan ev...'),
(3, 3, '1.3.6', 'Perpustakaan melaksanakan kegiatan sele...'),
(4, 7, '1.7.10', 'Pengelolaan Repositori'),
(5, 7, '1.7.11', 'Persentase Penambahan Repositori'),
(6, 7, '1.7.12', 'Perpustakaan melaksanakan pengorgani...'),
(7, 8, '1.8.13', 'Kegiatan Pelestarian Koleksi Perpustakaan'),
(8, 10, '2.2.3', 'Sarana Prasarana Perpustakaan yang Mem...'),
(9, 11, '2.3.4', 'Tersdianya Perabot Peralatan Perpustakaan'),
(10, 12, '2.4.5', 'Ketersediaan Perangkat Komputer'),
(11, 12, '2.4.6', 'Ketersediaan Jaringan Internet'),
(12, 12, '2.4.7', 'Ketersediaan Perangkat Multimedia'),
(13, 12, '2.4.8', 'Legalitas Perangkat Lunak'),
(14, 13, '2.5.9', 'Perpustakaan menyediakan Sarana Keama...'),
(15, 13, '2.5.10', 'Ketersediaan Fasilitas Umum'),
(16, 14, '2.6.11', 'Pengawasan Berkala Sarana Prasarana Pe...'),
(17, 16, '3.2.2', 'Perpustakaan Menyelenggarakan Berbagai...'),
(18, 16, '3.2.3', 'Perpustakaan Menyelenggarakan Layanan ...'),
(19, 16, '3.2.4', 'Perpustakaan Menyelenggarakan Sistem L...'),
(20, 17, '3.3.5', 'Perpustakaan Menyediakan Sistem Akses ...'),
(21, 17, '3.3.6', 'Perpustakaan Menyediakan Layanan Kons...'),
(22, 17, '3.3.7', 'Perpustakaan Menyelenggarakan Layanan ...'),
(23, 17, '3.3.8', 'Perpustakaan Menyelenggarakan Kegiatan...'),
(24, 17, '3.3.9', 'Layanan Ekstensi Perpustakaan dan Perlua...'),
(25, 17, '3.3.10', 'Perpustakaan Memiliki Sistem Layanan P...'),
(26, 17, '3.3.11', 'Perpustakaan Melaksanakan Kegiatan Or...'),
(27, 18, '4.1.1', 'Kualifikasi Pendidikan Kepala Perpustakaan'),
(28, 18, '4.1.2', 'Kualifikasi Pendidikan Tenaga Perpustakaan'),
(29, 19, '4.2.3', 'Perpustakaan Memiliki Pustakawan Mema...'),
(30, 19, '4.2.4', 'Tenaga Teknis Layanan dan Pengembanga...'),
(31, 20, '4.3.5', 'Ketersediaan Tenaga Perpustakaan yang Te...'),
(32, 20, '4.3.6', 'Peningkatan Kompetensi Pustakawan untu...'),
(33, 21, '5.1.1', 'Perpustakaan Memiliki Status Kelembagaa...'),
(34, 22, '5.2.2', '[Nama Indikator 5.2.2]'),
(35, 23, '5.3.3', '[Nama Indikator 5.3.3]'),
(36, 24, '5.4.4', 'Perpustakaan Memiliki Struktur Organisasi...'),
(37, 26, '5.6.6', '[Nama Indikator 5.6.6]'),
(38, 28, '6.1.1', 'Perpustakaan Memiliki Anggaran Rutin da...'),
(39, 29, '6.2.2', 'Perpustakaan Memiliki Situs Website Perp...'),
(40, 29, '6.2.3', 'Sistem Informasi Manajemen atau Pengel...'),
(41, 30, '6.3.4', 'Implementasi Kerja Sama Eksternal Nasion...'),
(42, 31, '6.4.5', 'Perpustakaan Secara Aktif Mengembangk...');

-- --------------------------------------------------------

--
-- Table structure for table `komponen`
--

CREATE TABLE `komponen` (
  `id` int NOT NULL,
  `nomor` int NOT NULL,
  `nama_komponen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `komponen`
--

INSERT INTO `komponen` (`id`, `nomor`, `nama_komponen`) VALUES
(1, 1, 'Komponen Koleksi Perpustakaan'),
(2, 2, 'Komponen Sarana dan Prasarana Perpus'),
(3, 3, 'Komponen Layanan Perpustakaan'),
(4, 4, 'Komponen Tenaga Perpustakaan'),
(5, 5, 'Komponen Penyelenggaraan Perpustakaan'),
(6, 6, 'Komponen Pengelolaan Perpustakaan');

-- --------------------------------------------------------

--
-- Table structure for table `sub_indikator`
--

CREATE TABLE `sub_indikator` (
  `id` int NOT NULL,
  `indikator_id` int NOT NULL,
  `nomor_sub_indikator` varchar(20) NOT NULL,
  `nama_sub_indikator` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sub_indikator`
--

INSERT INTO `sub_indikator` (`id`, `indikator_id`, `nomor_sub_indikator`, `nama_sub_indikator`) VALUES
(1, 9, '2.3.4-1', 'Perabot dan Peralatan Layanan Dasar Pe...'),
(2, 9, '2.3.4-2', 'Perabot dan Peralatan Layanan Penduku...'),
(3, 24, '3.3.9-1', 'Proposal dan atau Surat Tugas dan Lap...'),
(4, 24, '3.3.9-2', 'Dokumentasi Kegiatan Layanan Ekstensi...'),
(5, 24, '3.3.9-3', 'Surat atau Naskah Kerja Sama Atau Mo...'),
(6, 27, '4.1.1-1', 'SK Pengangkatan Kepala Perpustakaan'),
(7, 27, '4.1.1-2', 'Ijazah Kepala Perpustakaan.docx'),
(8, 27, '4.1.1-3', 'DRH Pengalaman Kerja Kepala .docx'),
(9, 27, '4.1.1-4', 'Sertifikat Pelatihan Kepala (Bidang Perpu...'),
(10, 29, '4.2.3-1', 'Daftar Tenaga Perpustakaan kategori pu...'),
(11, 29, '4.2.3-2', 'SK Pengangkatan Tendik Perpus'),
(12, 29, '4.2.3-3', 'Penghitungan persentase pustakawan.d...'),
(13, 30, '4.2.4-1', 'Daftar Tenaga Perpustakaan kategori te...'),
(14, 30, '4.2.4-2', 'SK Pengangkatan Tendik Perpus'),
(15, 30, '4.2.4-3', 'Penghitungan Persentase Tenaga Teknis...'),
(16, 32, '4.3.6-1', 'Data Jumlah Tenaga Perpustakaan Berda...'),
(17, 32, '4.3.6-2', 'Jumlah Kegiatan PKB Tendik'),
(18, 32, '4.3.6-2', 'Jumlah kegiatan PKB yang diikuti oleh T...'),
(19, 34, '5.2.2-1', 'Pedoman Umum Penyelenggaraan Perp...'),
(20, 34, '5.2.2-2', 'Renstra Perpustakaan USU 2020-2024.p...'),
(21, 34, '5.2.2-3', 'Prosedur Operasional Standar'),
(22, 34, '5.2.2-4', 'Kode Etik Pustakawan.pdf'),
(23, 34, '5.2.2-5', 'Manual Mutu'),
(24, 34, '5.2.2-6', 'Petunjuk Teknis (Instruksi Kerja)'),
(25, 35, '5.3.3-1', 'Dokumen perencanaan kerja disahkan o...'),
(26, 35, '5.3.3-2', 'Laporan kegiatan dan kinerja tahunan p...'),
(27, 35, '5.3.3-4', 'Persentase Pencapaian Kinerja Dihitung ...'),
(28, 36, '5.4.4-1', 'Struktur Organisasi Perpustakaan.docx'),
(29, 36, '5.4.4-2', 'SK Kepala Perpustakaan dan Staf Pendu...'),
(30, 36, '5.4.4-3', 'Uraian Tugas Setiap Posisi Unit Dalam St...'),
(31, 37, '5.6.6-1', 'SK Penguatan-Pengembangan Status Ke...'),
(32, 37, '5.6.6-3', 'RENSTRA PERPUSTAKAAN USU 2020-2...'),
(33, 37, '5.6.6-4', 'Kenaikan Anggaran Perpustakaan Setiap...'),
(34, 37, '5.6.6-5', 'Notulen Rapat Pimpinan Yang Membah...'),
(35, 37, '5.6.6-6', 'Surat Tugas Atau Keikutsertaan Pimpina...'),
(36, 37, '5.6.6-7', 'Dokumentasi Dukungan Kehadiran Pim...'),
(37, 41, '6.3.4-1', 'Dokumen Kerja Sama (MoU, PKS, dan S...'),
(38, 41, '6.3.4-2', 'Dokumentasi Kegiatan Kerjasama.docx'),
(39, 41, '6.3.4-3', 'Surat Tugas, Undangan, atau Notulensi ...'),
(40, 41, '6.3.4-4', 'Bukti Partisipasi Konsorsium, Forum, da...'),
(41, 42, '6.4.5-1', 'Daftar Program Proyek Inovatif.docx'),
(42, 42, '6.4.5-2', 'Laporan Pemanfaatan Inovasi'),
(43, 42, '6.4.5-3', 'Dokumentasi Kegiatan.docx'),
(44, 42, '6.4.5-4', 'Sertifikat Penghargaan.docx'),
(45, 42, '6.4.5-5', 'SK Tim Inovasi.docx');

-- --------------------------------------------------------

--
-- Table structure for table `sub_komponen`
--

CREATE TABLE `sub_komponen` (
  `id` int NOT NULL,
  `komponen_id` int NOT NULL,
  `nomor_sub` varchar(10) NOT NULL,
  `nama_sub_komponen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sub_komponen`
--

INSERT INTO `sub_komponen` (`id`, `komponen_id`, `nomor_sub`, `nama_sub_komponen`) VALUES
(1, 1, '1.1', 'Tata Kelola Koleksi'),
(2, 1, '1.2', 'Keragaman Koleksi'),
(3, 1, '1.3', 'Ketercukupan Koleksi'),
(4, 1, '1.4', 'Jumlah Koleksi'),
(5, 1, '1.5', 'Sarana Akses Koleksi'),
(6, 1, '1.6', 'Akses Koleksi Elektronik atau Digital'),
(7, 1, '1.7', 'Repositori Institusi'),
(8, 1, '1.8', 'Pelestarian Koleksi Perpustakaan'),
(9, 2, '2.1', 'Gedung atau Ruang Perpustakaan'),
(10, 2, '2.2', 'Sarana dan Prasarana Perpustakaan'),
(11, 2, '2.3', 'Perabotan dan Peralatan'),
(12, 2, '2.4', 'Perangkat IT dan Multimedia'),
(13, 2, '2.5', 'Sarana Keamanan dan Fasilitas Umum'),
(14, 2, '2.6', 'Pengawasan dan Pemeliharaan'),
(15, 3, '3.1', 'Waktu Layanan'),
(16, 3, '3.2', 'Keragaman Layanan'),
(17, 3, '3.3', 'Sarana Akses'),
(18, 4, '4.1', 'Kualifikasi Tenaga'),
(19, 4, '4.2', 'Jumlah Tenaga Perpustakaan'),
(20, 4, '4.3', 'Pembinaan dan Pengembangan Kompetensi'),
(21, 5, '5.1', 'Status Organisasi'),
(22, 5, '5.2', 'Kelengkapan Perangkat Aturan Organisasi'),
(23, 5, '5.3', 'Kelengkapan Perangkat Manajemen'),
(24, 5, '5.4', 'Kelengkapan Struktur Organisasi'),
(25, 5, '5.5', 'Pelibatan Sivitas Akademika dalam Penyelenggaraan Perpustakaan'),
(26, 5, '5.6', 'Komitmen Pimpinan Universitas'),
(27, 5, '5.7', 'Pengakuan-Rekognisi Kinerja'),
(28, 6, '6.1', 'Anggaran Perpustakaan'),
(29, 6, '6.2', 'Kelengkapan Perangkat Teknologi dalam Pengelolaan'),
(30, 6, '6.3', 'Kerja Sama Perpustakaan'),
(31, 6, '6.4', 'Inovasi dalam Pengelolaan Perpustakaan'),
(32, 6, '6.5', 'Dukungan Perpustakaan dalam Akreditasi Lembaga');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen_bukti`
--
ALTER TABLE `dokumen_bukti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_komponen_id` (`sub_komponen_id`);

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_komponen_id` (`sub_komponen_id`);

--
-- Indexes for table `komponen`
--
ALTER TABLE `komponen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_indikator`
--
ALTER TABLE `sub_indikator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indikator_id` (`indikator_id`);

--
-- Indexes for table `sub_komponen`
--
ALTER TABLE `sub_komponen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komponen_id` (`komponen_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen_bukti`
--
ALTER TABLE `dokumen_bukti`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `komponen`
--
ALTER TABLE `komponen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_indikator`
--
ALTER TABLE `sub_indikator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `sub_komponen`
--
ALTER TABLE `sub_komponen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen_bukti`
--
ALTER TABLE `dokumen_bukti`
  ADD CONSTRAINT `dokumen_bukti_ibfk_1` FOREIGN KEY (`sub_komponen_id`) REFERENCES `sub_komponen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `indikator`
--
ALTER TABLE `indikator`
  ADD CONSTRAINT `indikator_ibfk_1` FOREIGN KEY (`sub_komponen_id`) REFERENCES `sub_komponen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_indikator`
--
ALTER TABLE `sub_indikator`
  ADD CONSTRAINT `sub_indikator_ibfk_1` FOREIGN KEY (`indikator_id`) REFERENCES `indikator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_komponen`
--
ALTER TABLE `sub_komponen`
  ADD CONSTRAINT `sub_komponen_ibfk_1` FOREIGN KEY (`komponen_id`) REFERENCES `komponen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
