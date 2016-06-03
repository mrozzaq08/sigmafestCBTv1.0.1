-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2016 at 08:20 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apps_examination`
--
CREATE DATABASE IF NOT EXISTS `apps_examination` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `apps_examination`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_admin` int(3) NOT NULL,
  `username` varchar(100) NOT NULL DEFAULT 'administrator',
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'admin',
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(100) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `level`, `alamat`, `no_telp`, `email`, `website`, `foto`, `blokir`, `id_session`) VALUES
(1, 'combats', '379091ea6e3e5db042810d3428a10a38', 'Administrator', 'admin', 'Jln. Pamugaran Tarikolot - Padarek', '085290156462', '', '', 'admin_190429_ibeesnay.png', 'N', 'EE15BAE2744342DF5D929232A6E8D4ED8EADAD5D');

-- --------------------------------------------------------

--
-- Table structure for table `bank_soal`
--

DROP TABLE IF EXISTS `bank_soal`;
CREATE TABLE `bank_soal` (
  `id_soal` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `referensi` text NOT NULL,
  `id_mapel` varchar(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `type_soal` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_ujian`
--

DROP TABLE IF EXISTS `hasil_ujian`;
CREATE TABLE `hasil_ujian` (
  `id_hasil` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_soals` text NOT NULL,
  `id_pilihans` varchar(1000) DEFAULT NULL,
  `waktu_mulai` int(11) NOT NULL,
  `waktu_selesai` int(11) DEFAULT NULL,
  `respon_akhir` int(11) NOT NULL,
  `waktu_spent` int(11) NOT NULL,
  `waktu_spent_ind` text NOT NULL,
  `skor` float DEFAULT NULL,
  `persentase` varchar(20) NOT NULL DEFAULT '0',
  `hasil_tes` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `soal_essay` int(11) NOT NULL DEFAULT '0',
  `skor_ind` varchar(2000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `jawab_soal`
--

DROP TABLE IF EXISTS `jawab_soal`;
CREATE TABLE `jawab_soal` (
  `id_jawab` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_hasil` int(11) NOT NULL,
  `konten` longtext NOT NULL,
  `skor_jawab` int(11) DEFAULT NULL,
  `status_jawab` int(11) NOT NULL,
  `type_soal` varchar(10) NOT NULL DEFAULT 'bs-1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `kategori_ujian`
--

DROP TABLE IF EXISTS `kategori_ujian`;
CREATE TABLE `kategori_ujian` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_ujian`
--

INSERT INTO `kategori_ujian` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
(1134, 'Kuis Harian', '-'),
(1135, 'Ulangan Harian Sekolah', '-'),
(1136, 'Ujian Tengah Semester', '-'),
(1137, 'Ujian Akhir Semester', '-'),
(1138, 'Ujian Akhir Sekolah', '-'),
(1139, 'Try Out Ujian Nasional', '-'),
(1140, 'Latihan Ulangan', '-');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `id` int(5) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_pengajar` int(9) NOT NULL,
  `id_siswa` int(9) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `level_soal`
--

DROP TABLE IF EXISTS `level_soal`;
CREATE TABLE `level_soal` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level_soal`
--

INSERT INTO `level_soal` (`id_level`, `nama_level`, `keterangan`) VALUES
(1, 'Mudah', '-'),
(2, 'Sedang', '-'),
(3, 'Susah', '-');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

DROP TABLE IF EXISTS `mapel`;
CREATE TABLE `mapel` (
  `id` int(5) NOT NULL,
  `id_mapel` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_kelas` varchar(50) NOT NULL,
  `id_pengajar` int(9) NOT NULL,
  `deskripsi` text NOT NULL,
  `kkm` varchar(5) NOT NULL DEFAULT '75'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Triggers `mapel`
--
DROP TRIGGER IF EXISTS `hapus_ujian`;
DELIMITER $$
CREATE TRIGGER `hapus_ujian` AFTER DELETE ON `mapel` FOR EACH ROW begin
delete  from topik_ujian where topik_ujian.id_mapel = old.id_mapel;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengajar`
--

DROP TABLE IF EXISTS `pengajar`;
CREATE TABLE `pengajar` (
  `id_pengajar` int(9) NOT NULL,
  `nip` char(12) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username_login` varchar(100) NOT NULL,
  `password_login` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'pengajar',
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `pengaturan`
--

DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE `pengaturan` (
  `id_setelan` int(11) NOT NULL,
  `nama_sekolah` varchar(50) NOT NULL,
  `kepala_sekolah` varchar(50) NOT NULL,
  `npsn_sekolah` varchar(30) NOT NULL,
  `akreditas_sekolah` varchar(20) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `email_sekolah` varchar(50) NOT NULL,
  `telp_sekolah` varchar(15) NOT NULL,
  `fax_sekolah` varchar(15) NOT NULL,
  `favicon` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_setelan`, `nama_sekolah`, `kepala_sekolah`, `npsn_sekolah`, `akreditas_sekolah`, `alamat_sekolah`, `email_sekolah`, `telp_sekolah`, `fax_sekolah`, `favicon`) VALUES
(1135, 'SMPN 1 Malang', 'Ir. Sunardi, s.kom', '9867865464665411', 'A', 'Jln. Raya Padarek', 'smkn1lms@yahoo.com', '021-28282-118', '021-98298-111', 'favicon_896362_favicon.png');

-- --------------------------------------------------------

--
-- Table structure for table `pilihan_jawab`
--

DROP TABLE IF EXISTS `pilihan_jawab`;
CREATE TABLE `pilihan_jawab` (
  `id_pilihan` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `pilihan` text NOT NULL,
  `skor` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa` (
  `id_siswa` int(9) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username_login` varchar(50) NOT NULL,
  `password_login` varchar(50) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `th_masuk` varchar(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `blokir` enum('Y','N') NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `id_session_soal` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `topik_ujian`
--

DROP TABLE IF EXISTS `topik_ujian`;
CREATE TABLE `topik_ujian` (
  `id_ujian` int(9) NOT NULL,
  `id_kelas` varchar(50) NOT NULL,
  `id_mapel` varchar(10) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `waktu_mulai` int(11) NOT NULL,
  `waktu_selesai` int(11) NOT NULL,
  `durasi` int(11) NOT NULL,
  `persentase` varchar(10) NOT NULL,
  `view_answer` enum('Y','N') NOT NULL DEFAULT 'N',
  `max_akses` int(11) NOT NULL DEFAULT '1',
  `skor_benar` int(11) NOT NULL DEFAULT '1',
  `skor_salah` int(11) NOT NULL DEFAULT '0',
  `id_soals_statis` text,
  `pilih_soal` int(11) NOT NULL DEFAULT '1',
  `webcam` enum('Y','N') NOT NULL DEFAULT 'N',
  `type` enum('L','U') NOT NULL DEFAULT 'U',
  `terbit` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `jawab_soal`
--
ALTER TABLE `jawab_soal`
  ADD PRIMARY KEY (`id_jawab`);

--
-- Indexes for table `kategori_ujian`
--
ALTER TABLE `kategori_ujian`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_soal`
--
ALTER TABLE `level_soal`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `pengajar`
--
ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`id_pengajar`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_setelan`);

--
-- Indexes for table `pilihan_jawab`
--
ALTER TABLE `pilihan_jawab`
  ADD PRIMARY KEY (`id_pilihan`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `topik_ujian`
--
ALTER TABLE `topik_ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bank_soal`
--
ALTER TABLE `bank_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `jawab_soal`
--
ALTER TABLE `jawab_soal`
  MODIFY `id_jawab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `kategori_ujian`
--
ALTER TABLE `kategori_ujian`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1141;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `level_soal`
--
ALTER TABLE `level_soal`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengajar`
--
ALTER TABLE `pengajar`
  MODIFY `id_pengajar` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pilihan_jawab`
--
ALTER TABLE `pilihan_jawab`
  MODIFY `id_pilihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `topik_ujian`
--
ALTER TABLE `topik_ujian`
  MODIFY `id_ujian` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
