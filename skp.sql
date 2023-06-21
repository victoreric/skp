-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2023 at 02:24 PM
-- Server version: 8.0.32
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skp`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int NOT NULL,
  `nip_peg` varchar(20) NOT NULL,
  `nama_peg` varchar(60) NOT NULL,
  `pangkat_peg` varchar(50) NOT NULL,
  `jabatan_peg` varchar(50) NOT NULL,
  `unit_peg` varchar(50) NOT NULL,
  `nama_pen` varchar(50) NOT NULL,
  `nip_pen` varchar(20) NOT NULL,
  `pangkat_pen` varchar(50) NOT NULL,
  `jabatan_pen` varchar(50) NOT NULL,
  `unit_pen` varchar(50) NOT NULL,
  `nama_ats` varchar(50) NOT NULL,
  `nip_ats` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pangkat_ats` varchar(50) NOT NULL,
  `jabatan_ats` varchar(50) NOT NULL,
  `unit_ats` varchar(50) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `nip_peg`, `nama_peg`, `pangkat_peg`, `jabatan_peg`, `unit_peg`, `nama_pen`, `nip_pen`, `pangkat_pen`, `jabatan_pen`, `unit_pen`, `nama_ats`, `nip_ats`, `pangkat_ats`, `jabatan_ats`, `unit_ats`, `periode_awal`, `periode_akhir`) VALUES
(9, '198209292010121003', 'Victor Eric Pattiradjawane, S.Kom., M.Sc.', 'Penata / III.c', 'Pengadministrasi Kemahasiswaan', 'Fakultas Teknik Universitas Pattimura', 'Dr. Ir. E. R. de Fretes, MT.', '196612201994031001', 'Pembina IV/a', 'Wakil Dekan Bid. Umum dan Keuangan', 'Fakultas Teknik Universitas Pattimura', 'Dr. Pieter. Th. Berhitu, ST., MT.', '196908161998031001', 'Pembina IV/a', 'Dekan', 'Fakultas Teknik Universitas Pattimura', '2022-01-01', '2022-06-30'),
(11, '198209292010121003', 'Victor Eric Pattiradjawane, S.Kom., M.Sc.', 'Penata Tk. I / III.d', 'Kepala Sub Koordinator Tata Usaha', 'UPT TIK', 'John Latuny', '19098882233399', 'Pembina / IV.a', 'Koordinator', 'UPT TIK', 'F. Leiwakabessy', '196908161998031001', 'Pembina / IV.a', 'Wakil Dekan Bidang Akademik', 'Universitas Pattimura', '2022-06-01', '2022-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `kinerja`
--

CREATE TABLE `kinerja` (
  `id` int NOT NULL,
  `id_data` int NOT NULL,
  `nip_peg` varchar(20) NOT NULL,
  `nilai_skp` int NOT NULL,
  `orientasi` int NOT NULL,
  `inisiatif` int NOT NULL,
  `komitmen` int NOT NULL,
  `kepemimpinan` int NOT NULL,
  `nilai_kinerja` int NOT NULL,
  `ide` int NOT NULL,
  `nilai_akhir` int NOT NULL,
  `predikat` varchar(20) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `active` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'N',
  `level` int DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`nip`, `nama`, `password`, `email`, `hp`, `active`, `level`) VALUES
('123456', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'victor@g.om', '098', 'Y', 1),
('198209292010121003', 'Victor Eric Pattiradjawane', 'ffc150a160d37e92012c196b6af4160d', 'victor@gmail.com', '081343199719', 'Y', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `pangkat` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skp`
--

CREATE TABLE `skp` (
  `id` int NOT NULL,
  `id_data` int NOT NULL,
  `nip_peg` varchar(20) NOT NULL,
  `kinerja` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kinerja_ats` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kuantitas` varchar(500) NOT NULL,
  `target_kuan` int NOT NULL,
  `satuan_kuan_target` varchar(20) NOT NULL,
  `target_kuan_min` int NOT NULL,
  `target_kuan_max` int NOT NULL,
  `kondisi_kuan` varchar(20) NOT NULL,
  `metode_kuan` varchar(20) NOT NULL,
  `realisasi_kuan` int NOT NULL,
  `capaian_kuan_iki` int DEFAULT NULL,
  `kategori_kuan_iki` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kualitas` varchar(500) NOT NULL,
  `target_kual` int NOT NULL,
  `satuan_kual_target` varchar(20) NOT NULL,
  `target_kual_min` int NOT NULL,
  `target_kual_max` int NOT NULL,
  `kondisi_kual` varchar(20) NOT NULL,
  `metode_kual` varchar(20) NOT NULL,
  `realisasi_kual` int NOT NULL,
  `capaian_kual_iki` int DEFAULT NULL,
  `kategori_kual_iki` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `waktu` varchar(500) NOT NULL,
  `target_waktu` int NOT NULL,
  `satuan_target_waktu` varchar(20) NOT NULL,
  `target_waktu_min` int NOT NULL,
  `target_waktu_max` int NOT NULL,
  `kondisi_waktu` varchar(20) NOT NULL,
  `metode_waktu` varchar(20) NOT NULL,
  `realisasi_waktu` int NOT NULL,
  `capaian_waktu_iki` int DEFAULT NULL,
  `kategori_waktu_iki` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kategori` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nilai` int DEFAULT NULL,
  `nilai_ter` int DEFAULT NULL,
  `nilai_ku` int DEFAULT NULL,
  `nilai_kt` int DEFAULT NULL,
  `nilai_skp` int DEFAULT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `skp`
--

INSERT INTO `skp` (`id`, `id_data`, `nip_peg`, `kinerja`, `kinerja_ats`, `kuantitas`, `target_kuan`, `satuan_kuan_target`, `target_kuan_min`, `target_kuan_max`, `kondisi_kuan`, `metode_kuan`, `realisasi_kuan`, `capaian_kuan_iki`, `kategori_kuan_iki`, `kualitas`, `target_kual`, `satuan_kual_target`, `target_kual_min`, `target_kual_max`, `kondisi_kual`, `metode_kual`, `realisasi_kual`, `capaian_kual_iki`, `kategori_kual_iki`, `waktu`, `target_waktu`, `satuan_target_waktu`, `target_waktu_min`, `target_waktu_max`, `kondisi_waktu`, `metode_waktu`, `realisasi_waktu`, `capaian_waktu_iki`, `kategori_waktu_iki`, `kategori`, `nilai`, `nilai_ter`, `nilai_ku`, `nilai_kt`, `nilai_skp`, `periode_awal`, `periode_akhir`, `tanggal`) VALUES
(23, 9, '198209292010121003', 'Pengelolaan Website\r\nKemahasiswaan dan Alumni\r\n', 'Meningkatkan kualitas tata kelola dan manajemen kelembagaan fakultas \r\n', 'Jumlah Informasi yang diposting pada website kemahasiswaan dan alumni Fatek', 15, 'data', 10, 15, 'Normal', 'Direct', 17, 113, 'Sangat Baik', 'Persentasi jumlah informasi yang diakses oleh pengunjung website.', 100, '%', 90, 100, 'Normal', 'Direct', 100, 100, 'Baik', 'Ketepatan waktu informasi dan berita yang diposting pada website dengan masa kadaluarsa informasi', 6, 'bulan', 5, 6, 'Khusus', 'Direct', 5, 100, 'Baik', 'Sangat Baik', 120, 120, NULL, NULL, NULL, '2022-01-01', '2022-06-30', '2022-06-22'),
(25, 9, '198209292010121003', 'Tracer Study Alumni dan Pengguna\r\nLulusan', 'Meningkatkan kualitas layanan kemahasiswaan dan mutu pendidikan', 'Jumlah mahasiswa yang terdata dalam sistem penelusuran lulusan', 40, 'data', 30, 40, 'Normal', 'Direct', 35, 100, 'Baik', 'Persentase lulusan yang terdata dalam sistem penelusuran lulusan', 100, '%', 90, 100, 'Normal', 'Direct', 100, 100, 'Baik', 'Ketepatan waktu pelaksanaan kegiatan penelusuran data alumni', 1, 'bulan', 1, 1, 'Khusus', 'Direct', 2, 50, 'Sangat Kurang', 'Baik', 100, 100, NULL, NULL, NULL, '2022-01-01', '2022-06-30', '2022-06-22'),
(26, 9, '198209292010121003', 'Pembentukan Engineering Carrier\r\nDevelopment Center', 'Meningkatkan kualitas layanan kemahasiswaan dan mutu pendidikan', 'Jumlah tenaga pendidik dan kependidikan dalam panitia ECDC', 10, 'orang', 7, 10, 'Normal', 'Direct', 10, 100, 'Baik', 'Persentase keterlibatan tenaga pendidik dan kependidikan dalam menyusun SOP ECDC', 100, '%', 90, 100, 'Normal', 'Direct', 100, 100, 'Baik', 'Ketepatan waktu kerja panitia ECDC', 2, 'bulan', 1, 2, 'Khusus', 'Direct', 2, 100, 'Baik', 'Baik', 100, 100, NULL, NULL, NULL, '2022-01-01', '2022-06-30', '2022-06-22'),
(27, 9, '198209292010121003', 'Pemilihan Mahasiswa Berprestasi', 'Meningkatkan kualitas layanan kemahasiswaan dan mutu pendidikan', 'Jumlah mahasiswa yang berpartisipasi pada seleksi  mahasiswa berprestasi', 4, 'orang', 4, 4, 'Normal', 'Direct', 4, 100, 'Baik', 'Persentase keikutsertaan mahasiswa berprestasi', 100, '%', 90, 100, 'Normal', 'Direct', 100, 100, 'Baik', 'Ketepatan waktu dalam pelaksanaan seleksi mahasiswa berprestasi', 1, 'bulan', 1, 1, 'Khusus', 'Direct', 1, 100, 'Baik', 'Baik', 100, 100, NULL, NULL, NULL, '2022-01-01', '2022-06-30', '2022-06-22'),
(28, 9, '198209292010121003', 'Revitalisasi Kegiatan Organisasi Unit\r\nKemahasiswaan (UKM) Fakultas', 'Meningkatkan   kualitas   program   minat   dan   bakat,   penalaran   dan   kesejahteraan mahasiswa, dan pembinaan karakter', 'Jumlah mahasiswa yang terlibat dalam UKM olahraga dan seni', 10, 'orang', 9, 10, 'Normal', 'Direct', 10, 100, 'Baik', 'Persentase mahasiswa yang terlibat dalam UKM olahraga dan seni', 100, '%', 90, 100, 'Normal', 'Direct', 100, 100, 'Baik', 'Ketepatan waktu pelaksaaan Rapat Umum, Reorganisasi dan pertemuan UKM olahraga dan seni', 2, 'bulan', 1, 2, 'Khusus', 'Non Direct', 2, 100, 'Baik', 'Baik', 100, 100, NULL, NULL, NULL, '2022-01-01', '2022-06-30', '2022-06-22'),
(33, 9, '198209292010121003', 'Pengangkatan atau Pembentukan Tim Pengelola Klinik Program Kreativitas Mahasiswa (PKM) Fakultas Teknik Universitas Pattimura Tahun 2022.', '- (IKU 1.2.) Persentase lulusan S1 yang menghabiskan paling sedikit 20 (dua puluh) SKS di luar kampus; atau meraih prestasi paling rendah tingkat Nasional.\r\n- (Sub IKU 1.2.2) Jumlah Mahasiswa Berprestasi dalam Kegiatan Kompetisi Minimal Tingkat Nasional\r\n- (IKT 1.2.2.1) Jumlah prestasi mahasiswa tingkat internasional, nasional atau regional per prodi per tahun.\r\n- (Sub IKU 1.2.3) Jumlah Dasen Pembimbing Kegiatan Mahasiswa Tinqkat Nasional.', 'Jumlah Tenaga Pendidik (Dosen) dan Tenaga Kependidikan yang terlibat dalam Tim Pengelola Klinik Program  Kreativitas Mahasiswa (PKM) Fakultas Teknik Tahun 2022', 13, 'orang', 10, 13, 'Normal', 'Direct', 13, 100, 'Baik', '- Mempersiapkan semua Administrasi terkait permintaan data Dosen sebagai Tim Pengelola Klinik PKM sekaligus mempersiapkan konsideran Surat Keputusan (SK) Dekan. \r\n- Mempersiapkan Instrumen PKM Fakultas Teknik dengan mempedomani PKM baku yang dikeluarkan oleh Kementrian Pendidikan, Kebudayaan, Riset dan Teknologi.\r\n- Menyusun laporan pelaksanaan Pembentukan TimPengelola Klinik PKM pada Fakultas Teknik dan melaporkan kegiatan tersebut kepada Dekan Fakultas Teknik melalui WD III.', 100, '%', 90, 100, 'Normal', 'Direct', 100, 100, 'Baik', 'Ketepatan waktu Persiapan sampai dengan Pelaksanaan Pembentukan Tim Pengelola Klinik Program Kreativitas Mahasiswa (PKM) Fakultas Teknik 2022', 2, 'bulan', 1, 2, 'Normal', 'Direct', 2, 100, 'Baik', 'Baik', 100, 100, NULL, NULL, NULL, '2022-01-01', '2022-06-30', '2022-06-25'),
(34, 9, '198209292010121003', 'Pengelolaan Website Bidang Kemahasiswaan dan Alumni', '- (Sub IKU 4.1.2) Tersedianva PK Wakil Dekan Bidang Kemahasiswaan dan Alumni dengan Dekan Fakultas Teknik. <br>\r\n- (Sub IKU 4.1.3) Tersedianya Rencana Kerja Tahunan Fakultas Bidang Kemahasiswaan dan Alumni <br>\r\n- tes tes tes', 'Jumlah informasi yang diposting pada website kemahasiswaan dan alumni Fakultas Teknik.', 15, 'data', 10, 15, 'Normal', 'Direct', 15, 100, 'Baik', 'Presentasi Jumlah Informasi yang diakses oleh pengunjung website (Mahasiswa)', 100, '%', 90, 100, 'Normal', 'Direct', 100, 100, 'Baik', 'Ketepatan waktu postingan pada website dengan masa kadaluarsa informasi', 6, 'bulan', 5, 6, 'Normal', 'Direct', 6, 100, 'Baik', 'Baik', 100, 100, NULL, NULL, NULL, '2022-01-01', '2022-06-30', '2022-06-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kinerja`
--
ALTER TABLE `kinerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `skp`
--
ALTER TABLE `skp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kinerja`
--
ALTER TABLE `kinerja`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skp`
--
ALTER TABLE `skp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
