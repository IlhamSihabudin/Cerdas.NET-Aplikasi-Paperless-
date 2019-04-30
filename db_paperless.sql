-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2018 at 11:38 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_paperless`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `daftar_siswa`
-- (See below for the actual view)
--
CREATE TABLE `daftar_siswa` (
`nis` int(10)
,`nama` varchar(100)
,`jk` varchar(15)
,`rombel` varchar(50)
,`rayon` varchar(50)
,`rekomendasi` varchar(20)
,`tgl_daftar` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `nilai_siswa`
-- (See below for the actual view)
--
CREATE TABLE `nilai_siswa` (
`id_hasil` int(10)
,`nis` int(10)
,`nama` varchar(100)
,`rombel` varchar(50)
,`jenis_quiz` varchar(50)
,`nama_quiz` varchar(100)
,`hasil` int(5)
,`tgl` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`username`, `password`) VALUES
('YWRtaW4=', 'YWRtaW4xMjM=');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `nik` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `tgl_lahir` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`nik`, `nama`, `jk`, `tgl_lahir`, `email`, `alamat`, `foto`, `username`, `password`, `status`, `tgl_daftar`) VALUES
('11452635', 'Siti', 'perempuan', '16-7-1974', 'siti@gmail.com', 'Cicurug', 'guru.jpg', '11452635', 'MTE0NTI2MzU=', 'aktif', '2018-04-12'),
('11524', 'Budi', 'laki-laki', '1-1-1968', 'budi@gmail.com', 'Ciapus', '1080-8-foto-guru-paling-ganteng-yang-bikin-heboh-social-media.gif', '11524', 'MTIz', 'aktif', '2018-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id_hasil` int(10) NOT NULL,
  `nis` int(10) NOT NULL,
  `jenis_quiz` varchar(50) NOT NULL,
  `pkt_soal` varchar(20) NOT NULL,
  `hasil` int(5) NOT NULL,
  `tgl` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hasil`
--

INSERT INTO `tb_hasil` (`id_hasil`, `nis`, `jenis_quiz`, `pkt_soal`, `hasil`, `tgl`) VALUES
(1, 11605614, 'Perbaikan', 'P0001', 100, '2018-03-25 21:06:01'),
(3, 11605614, 'Perbaikan', 'P0001', 80, '2018-03-25 22:17:54'),
(17, 11605614, 'Ulangan', 'P0002', 100, '2018-03-26 17:23:51'),
(18, 11605614, 'Perbaikan', 'P0001', 100, '2018-03-26 17:33:37'),
(28, 11605614, 'Latihan', 'P0003', 33, '2018-03-26 18:40:31'),
(29, 11605614, 'Perbaikan', 'P0001', 60, '2018-04-02 16:39:52'),
(30, 11605614, 'Perbaikan', 'P0001', 60, '2018-04-02 16:39:54'),
(31, 11605614, 'Ulangan', 'P0004', 100, '2018-04-05 17:56:22'),
(32, 11605614, 'Perbaikan', 'P0001', 0, '2018-04-22 12:22:35'),
(33, 11605614, 'Perbaikan', 'P0001', 0, '2018-04-22 12:22:36');

-- --------------------------------------------------------

--
-- Table structure for table `tb_materi`
--

CREATE TABLE `tb_materi` (
  `kd_materi` int(10) NOT NULL,
  `jdl_materi` varchar(100) NOT NULL,
  `materi` longtext NOT NULL,
  `upload_by` varchar(100) NOT NULL,
  `tgl_upload` datetime NOT NULL,
  `kelas` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_materi`
--

INSERT INTO `tb_materi` (`kd_materi`, `jdl_materi`, `materi`, `upload_by`, `tgl_upload`, `kelas`) VALUES
(8, 'ttt', '<p>sadf</p>\r\n', '', '2018-04-22 12:12:19', 'XI'),
(9, 'sadfxc', '<p>sadfvxc</p>\r\n', 'Budi', '2018-04-27 04:26:35', 'XI');

-- --------------------------------------------------------

--
-- Table structure for table `tb_quiz`
--

CREATE TABLE `tb_quiz` (
  `pkt_soal` varchar(20) NOT NULL,
  `nama_quiz` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `lama_waktu` int(10) NOT NULL,
  `jumlah_soal` int(10) NOT NULL,
  `tgl_upload` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_quiz`
--

INSERT INTO `tb_quiz` (`pkt_soal`, `nama_quiz`, `jenis`, `lama_waktu`, `jumlah_soal`, `tgl_upload`, `status`) VALUES
('P0001', 'Perbaikan UAS Ganjil', 'perbaikan', 45, 5, '2018-04-05 17:29:07', 'aktif'),
('P0002', 'UTS Genap', 'ulangan', 10, 1, '2018-04-05 17:28:40', 'aktif'),
('P0003', 'Latihan UH 5', 'latihan', 3, 3, '2018-03-26 18:07:05', 'aktif'),
('P0004', 'UH 5', 'ulangan', 30, 2, '2018-04-05 17:50:27', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rayon`
--

CREATE TABLE `tb_rayon` (
  `kd_rayon` int(10) NOT NULL,
  `rayon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rayon`
--

INSERT INTO `tb_rayon` (`kd_rayon`, `rayon`) VALUES
(1, 'WIK 1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rombel`
--

CREATE TABLE `tb_rombel` (
  `kd_rombel` int(10) NOT NULL,
  `rombel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rombel`
--

INSERT INTO `tb_rombel` (`kd_rombel`, `rombel`) VALUES
(1, 'RPL XI-1'),
(3, 'RPL XI-2'),
(4, 'RPL XI-3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `kd_rombel` int(10) NOT NULL,
  `kd_rayon` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rekomendasi` varchar(20) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `nama`, `jk`, `kd_rombel`, `kd_rayon`, `username`, `password`, `rekomendasi`, `tgl_daftar`) VALUES
(213, 'sadf', 'laki-laki', 4, 1, '213', 'MjEz', 'ya', '2018-04-22'),
(234, 'asfd', 'laki-laki', 3, 1, '234', 'MjM0', 'ya', '2018-04-12'),
(11605614, 'Muhamad Ilham Sihabudin', 'laki-laki', 3, 1, '11605614', 'aWxoYW0=', 'ya', '0000-00-00'),
(11605646, 'Abdul', 'laki-laki', 3, 1, '11605646', 'MTE2MDU2NDY=', 'ya', '0000-00-00'),
(11605656, 'Kuya', 'perempuan', 1, 1, '11605656', 'MTE2MDU2NTY=', 'ya', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal`
--

CREATE TABLE `tb_soal` (
  `kd_soal` int(10) NOT NULL,
  `soal` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `opsi_1` varchar(100) NOT NULL,
  `opsi_2` varchar(100) NOT NULL,
  `opsi_3` varchar(100) NOT NULL,
  `opsi_4` varchar(100) NOT NULL,
  `opsi_5` varchar(100) NOT NULL,
  `jawaban` varchar(100) NOT NULL,
  `pkt_soal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_soal`
--

INSERT INTO `tb_soal` (`kd_soal`, `soal`, `gambar`, `opsi_1`, `opsi_2`, `opsi_3`, `opsi_4`, `opsi_5`, `jawaban`, `pkt_soal`) VALUES
(1, 'apa itu?', 'background.jpg', 'aku', 'benda', 'cilok', 'dodol', 'enam', 'benda', 'P0001'),
(3, 'asdfasd', '', 'asdfasdf', 'asdfsadf', 'asdfasdf', 'asdfsadf', 'asdfasdf', 'asdfsadf', 'P0002'),
(4, 'fsdas', '', 'fasd', 'fasd', 'fsda', 'fas', 'fsda', 'fsda', 'P0001'),
(6, 'asdf', 'sembilan.jpg', 'afdsasf', 'adsfad', 'asdfasd', 'asdfasdf', 'fadsfa', 'adsfad', 'P0001'),
(7, 'ladfnjkasdfhu', 'ascii.jpg', 'goo', 'oog', 'ogog', 'ogogdsa', 'lld', 'lld', 'P0001'),
(9, 'ljanfksd', '', 'hlasdf65', '465818', 'asdfasdf', '461', '46sadfa', '461', 'P0001'),
(13, 'bdgfbdf', '', '1', '2', '3', 'jawab', 'fd', 'jawab', 'P0003'),
(14, 'lala', '', '4', '3', '2', '1', 'jawab', 'jawab', 'P0003'),
(16, 'vdf', 'Wudhu-Islamic-Wallpaper.jpg', 'fdbg', 'dbg', 'dbgf', 'bgfd', 'bfgd', 'dbg', 'P0003'),
(17, 'Siapa presiden pertama indonesia?', '', 'Soekarno', 'Soeharto', 'Megawati', 'Jokowi', 'Susilo Bambang Yudoyono', 'Soekarno', 'P0004'),
(18, 'Indonesia terletak di benua?', '', 'Afrika', 'Eropa', 'Amerika', 'Australia', 'Asia', 'Asia', 'P0004');

-- --------------------------------------------------------

--
-- Structure for view `daftar_siswa`
--
DROP TABLE IF EXISTS `daftar_siswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_siswa`  AS  select `tb_siswa`.`nis` AS `nis`,`tb_siswa`.`nama` AS `nama`,`tb_siswa`.`jk` AS `jk`,`tb_rombel`.`rombel` AS `rombel`,`tb_rayon`.`rayon` AS `rayon`,`tb_siswa`.`rekomendasi` AS `rekomendasi`,`tb_siswa`.`tgl_daftar` AS `tgl_daftar` from ((`tb_siswa` join `tb_rombel` on((`tb_siswa`.`kd_rombel` = `tb_rombel`.`kd_rombel`))) join `tb_rayon` on((`tb_rayon`.`kd_rayon` = `tb_siswa`.`kd_rayon`))) ;

-- --------------------------------------------------------

--
-- Structure for view `nilai_siswa`
--
DROP TABLE IF EXISTS `nilai_siswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nilai_siswa`  AS  select `tb_hasil`.`id_hasil` AS `id_hasil`,`tb_hasil`.`nis` AS `nis`,`tb_siswa`.`nama` AS `nama`,`tb_rombel`.`rombel` AS `rombel`,`tb_hasil`.`jenis_quiz` AS `jenis_quiz`,`tb_quiz`.`nama_quiz` AS `nama_quiz`,`tb_hasil`.`hasil` AS `hasil`,`tb_hasil`.`tgl` AS `tgl` from (((`tb_hasil` join `tb_quiz` on((`tb_hasil`.`pkt_soal` = `tb_quiz`.`pkt_soal`))) join `tb_siswa` on((`tb_hasil`.`nis` = `tb_siswa`.`nis`))) join `tb_rombel` on((`tb_siswa`.`kd_rombel` = `tb_rombel`.`kd_rombel`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tb_materi`
--
ALTER TABLE `tb_materi`
  ADD PRIMARY KEY (`kd_materi`);

--
-- Indexes for table `tb_quiz`
--
ALTER TABLE `tb_quiz`
  ADD PRIMARY KEY (`pkt_soal`);

--
-- Indexes for table `tb_rayon`
--
ALTER TABLE `tb_rayon`
  ADD PRIMARY KEY (`kd_rayon`);

--
-- Indexes for table `tb_rombel`
--
ALTER TABLE `tb_rombel`
  ADD PRIMARY KEY (`kd_rombel`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`kd_soal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id_hasil` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tb_materi`
--
ALTER TABLE `tb_materi`
  MODIFY `kd_materi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_rayon`
--
ALTER TABLE `tb_rayon`
  MODIFY `kd_rayon` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_rombel`
--
ALTER TABLE `tb_rombel`
  MODIFY `kd_rombel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `kd_soal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
