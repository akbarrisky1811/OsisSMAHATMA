-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 02:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osis_smahatma`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `id_sekbid` int(11) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `tampil` varchar(50) NOT NULL,
  `urutan` int(11) NOT NULL,
  `insert_by` int(11) NOT NULL,
  `insert_at` date NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `jabatan`, `id_sekbid`, `foto`, `tampil`, `urutan`, `insert_by`, `insert_at`, `update_by`, `update_at`) VALUES
(1, 'Achmad Aldi A', 'Ketua OSIS', 1, '1.JPG', 'show', 1, 2, '2023-05-23', 2, '2023-05-28'),
(2, 'Zahra Naurah Khansa', 'Wakil Ketua OSIS', 1, '2.JPG', 'show', 2, 2, '2023-05-28', 2, '2023-05-28'),
(4, 'Lutfiah Nuryani ', 'Sekretaris 2', 1, '4.JPG', 'show', 4, 2, '2023-05-28', 2, '2023-05-28'),
(5, 'Yolanda Najwa Aulia', 'Sekretaris 1', 1, '5.jpg', 'show', 3, 2, '2023-05-28', 2, '2023-05-28'),
(6, 'Dafa Alghifari Putra ', 'Bendahara 1', 1, '6.JPG', 'show', 5, 2, '2023-05-28', 2, '2023-05-28'),
(7, 'Meylin Cahya S', 'Bendahara 2', 1, '7.JPG', 'show', 6, 2, '2023-05-28', 2, '2023-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `calon`
--

CREATE TABLE `calon` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `terakhir_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `calon`
--

INSERT INTO `calon` (`id`, `username`, `password`, `nama`, `terakhir_login`) VALUES
(1, 'admin', '11111', 'amintest', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `format` varchar(100) NOT NULL,
  `upload_by` int(11) NOT NULL,
  `upload_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id_file`, `nama`, `format`, `upload_by`, `upload_at`) VALUES
(3, 'Snapinsta.app_332142471_1349154625907316_8496374369740892305_n_1024.jpg', 'jpg', 2, '2023-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `views` int(11) NOT NULL,
  `insert_by` int(11) NOT NULL,
  `insert_at` date NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `judul`, `isi`, `status`, `link`, `views`, `insert_by`, `insert_at`, `update_by`, `update_at`) VALUES
(14, 'SMAHATMA YOUTH FEST', '            <p>      <p style=\"text-align: center; \"><img src=\"assets/uploads/Snapinsta.app_332142471_1349154625907316_8496374369740892305_n_1024.jpg\"></p><p style=\"text-align: justify; \">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p style=\"text-align: justify; \">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p>    <br></p><p>    </p>        ', 'publish', 'smahatma-youth-fest', 3, 2, '2023-05-28', 2, '2023-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `sekbid`
--

CREATE TABLE `sekbid` (
  `id_sekbid` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sekbid`
--

INSERT INTO `sekbid` (`id_sekbid`, `nama`, `deskripsi`, `jumlah`) VALUES
(1, 'Keimanan dan Ketaqwaan Terhadap Tuhan Yang Maha Esa', '', 4),
(2, 'Budi Perketi Luhur dan Ahlaq Mulia', '', 5),
(3, 'Kepribadian unggu, Wawasan Kebangsaan, dan bela negara negara', '', 5),
(4, 'Prestasi Akademik, seni, dan Olahraga sesuai bakat minat    \r\n', '', 5),
(5, 'Demokrasi HAM, Pendidikan Politik, Lingkungan hidup Kepekaan dan toleransi sosial\r\n', '', 5),
(6, 'Kreativitas, keterampilan dan Kewirausahaan\r\n', '', 6),
(7, 'Kualitas jasmani Kesehatan dan Gizi    \r\n', '', 4),
(8, 'Sastra dan Budaya', '', 5),
(9, 'Teknologi Informasi dan Komunikasi', '', 6),
(10, 'Komunikasi dalam Bahasa Internasional\r\n', '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id_tag` int(11) NOT NULL,
  `tag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id_tag`, `tag`) VALUES
(1, 'Pendidikan'),
(2, 'Teknologi'),
(3, 'info sekolah'),
(4, 'event');

-- --------------------------------------------------------

--
-- Table structure for table `tag_post`
--

CREATE TABLE `tag_post` (
  `id_tp` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  `insert_by` int(11) NOT NULL,
  `insert_at` date NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tag_post`
--

INSERT INTO `tag_post` (`id_tp`, `id_post`, `id_tag`, `insert_by`, `insert_at`, `update_by`, `update_at`) VALUES
(57, 14, 4, 2, '2023-05-28', 2, '2023-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`, `jabatan`, `foto`) VALUES
(2, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'superadmin', 'Admin Website', '2.png'),
(9, 'Achmad Aldi Ardiyanto', 'Aldi ', 'daf036f7f77e11a342e9520ff8fc256d', 'superadmin', 'Ketua OSIS', ''),
(10, 'Akbar Risky Putra Ramadhan', 'akbar.risky', 'e10adc3949ba59abbe56e057f20f883e', 'superadmin', 'Admin Website', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_sekbid` (`id_sekbid`);

--
-- Indexes for table `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `upload_by` (`upload_by`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `insert_by` (`insert_by`,`update_by`);

--
-- Indexes for table `sekbid`
--
ALTER TABLE `sekbid`
  ADD PRIMARY KEY (`id_sekbid`),
  ADD KEY `nama` (`nama`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`);

--
-- Indexes for table `tag_post`
--
ALTER TABLE `tag_post`
  ADD PRIMARY KEY (`id_tp`),
  ADD KEY `id_post` (`id_post`,`id_tag`,`insert_by`,`update_by`),
  ADD KEY `id_tag` (`id_tag`),
  ADD KEY `insert_by` (`insert_by`),
  ADD KEY `update_by` (`update_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `calon`
--
ALTER TABLE `calon`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sekbid`
--
ALTER TABLE `sekbid`
  MODIFY `id_sekbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tag_post`
--
ALTER TABLE `tag_post`
  MODIFY `id_tp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`id_sekbid`) REFERENCES `sekbid` (`id_sekbid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`upload_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tag_post`
--
ALTER TABLE `tag_post`
  ADD CONSTRAINT `tag_post_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_post_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_post_ibfk_3` FOREIGN KEY (`insert_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_post_ibfk_4` FOREIGN KEY (`update_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
