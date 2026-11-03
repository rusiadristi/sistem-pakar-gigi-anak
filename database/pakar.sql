-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 02:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pakar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(40) NOT NULL,
  `password` varchar(6) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_lengkap`) VALUES
('admin', 'admin', 'administrator'),
('rafiq', '307b7e', 'okta rafiq');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` varchar(5) NOT NULL,
  `nm_penyakit` varchar(70) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `nm_penyakit`, `keterangan`) VALUES
('P01', 'Gigi Berlubang', '<p><strong>Solusinya :</strong></p>\r\n\r\n<ul>\r\n	<li>1. Memberikan fluoride Jika lubang pada gigi masih dalam tahap awal dan tergolong ringan, perawatan dengan fluoride bisa dijadikan solusi untuk memperkuat dan memperbaiki enamel gigi yang rusak. Caranya adalah dengan mengoleskan fluoride dalam bentuk cair, busa, gel, atau pasta ke gigi selama beberapa menit.</li>\r\n	<li>2. Menambal gigi&nbsp;</li>\r\n	<li>3. Menggunakan crown gigi</li>\r\n	<li>4. Melakukan perawatan saluran akar gigi</li>\r\n	<li>5. Mencabut gigi&nbsp;</li>\r\n</ul>\r\n'),
('P02', 'Gigi Sensitif', '<p><strong>Solusi yaitu :</strong></p>\r\n\r\n<p>Gunakan sikat&nbsp;<strong>gigi</strong>&nbsp;berbulu lembut, dan jangan menyikat gigi terlalu kuat dan keras. Bersihkan sela gigi dengan benang gigi. Jika ingin menggunakan mouthwash, pilih produk dengan kandungan fluoride dan bebas alkohol. Hindari menggunakan pemutih gigi atau melakukan prosedur pemutihan gigi.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE `rule` (
  `id_rule` int(11) NOT NULL,
  `id_penyakit` varchar(5) NOT NULL,
  `id_gejala` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id_rule`, `id_penyakit`, `id_gejala`) VALUES
(0, 'P003', 'G002'),
(0, 'P003', 'G003'),
(0, 'P01', 'G01'),
(0, 'P01', 'G02'),
(0, 'P01', 'G03'),
(0, 'P01', 'G04'),
(0, 'P01', 'G05'),
(0, 'P01', 'G07'),
(0, 'P01', 'G06'),
(0, 'P01', 'G08'),
(0, 'P01', 'G09'),
(0, 'P02', 'G11'),
(0, 'P02', 'G01'),
(0, 'P02', 'G12'),
(0, 'P02', 'G12'),
(0, 'P02', 'G13');

-- --------------------------------------------------------

--
-- Table structure for table `tbgejala`
--

CREATE TABLE `tbgejala` (
  `id_gejala` varchar(5) NOT NULL,
  `nm_gejala` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbgejala`
--

INSERT INTO `tbgejala` (`id_gejala`, `nm_gejala`) VALUES
('G01', 'Kepala terasa pusing'),
('G02', 'Rasa sakitt pada gigi sangat hebat'),
('G03', 'Terasa lebih berdenyut seperti gigi yang ditekan kuat sekali'),
('G04', 'Menusuk-nusuk bagian gigi'),
('G05', 'Terbangun ditengah malam karena sakit'),
('G06', 'Selalu marah dengan tindakan apapun'),
('G07', 'Rasa sakit bertambah dengan adanya rangsangan panas'),
('G08', 'Kadang bisa berkurang sakit nya karena ransangan dingin'),
('G09', 'Rasa sakit akan timbul kembali dan bertambah hebat'),
('G10', 'Rasa sakit yang timbul tidak begitu hebat'),
('G11', 'Terkadang tidak merasa sakit sama sekali'),
('G12', 'Jika makanan masuk ke dalam ruang gigi terasa sangat sakit'),
('G13', 'Rasa sakit timbul karena adanya peninggian tekanan intrapulpa');

-- --------------------------------------------------------

--
-- Table structure for table `tbhasil_konsultasi`
--

CREATE TABLE `tbhasil_konsultasi` (
  `id_hasil` int(11) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `id_penyakit` varchar(5) NOT NULL,
  `tgl_hasil` date NOT NULL,
  `gejala_dipilih` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbhasil_konsultasi`
--

INSERT INTO `tbhasil_konsultasi` (`id_hasil`, `id_user`, `username`, `id_penyakit`, `tgl_hasil`, `gejala_dipilih`) VALUES
(1, '', 'sample', 'P02', '2019-11-27', 'G01,G10,G11,G12,G13'),
(2, '', 'sample', 'P02', '2019-11-27', 'G01,G10,G11,G12,G13'),
(3, '', 'sample', 'P02', '2019-11-27', 'G01,G10,G11,G12,G13'),
(4, '', 'sample', 'P02', '2019-11-27', 'G01,G10,G11,G12,G13'),
(5, '', 'sample', 'P02', '2019-11-27', 'G01,G10,G11,G12,G13'),
(6, '', 'sample', 'P02', '2019-11-27', 'G01,G10,G11,G12,G13'),
(7, '', 'sample', 'P02', '2019-11-27', 'G01,G10,G11,G12,G13'),
(8, '', 'sample', 'P02', '2019-11-27', 'G01,G10,G11,G12,G13'),
(9, '', 'sample', 'P02', '2019-11-27', 'G01,G10,G11,G12,G13'),
(10, '', 'sample', 'P02', '2019-11-28', 'G01,G10,G11,G12,G13'),
(11, '', 'bendahara', 'P02', '2019-11-28', 'G01,G10,G11,G12,G13'),
(12, '', 'sample', 'P02', '2019-11-28', 'G01,G10,G11,G12,G13'),
(13, '', 'sample', 'P02', '2019-11-28', 'G01,G10,G11,G12,G13'),
(14, '', 'sample', 'P02', '2019-11-28', 'G01,G10,G11,G12,G13'),
(15, '', 'sample', 'P01', '2019-11-28', 'G01,G02,G03,G04,G05,G06,G07,G08,G09'),
(16, '', 'chintia', 'P01', '2019-11-28', 'G01,G02,G03,G04,G05,G06,G07,G08,G09'),
(17, '', 'chintia', 'P02', '2019-11-29', 'G01,G10,G11,G12,G13'),
(18, '', 'user', 'P02', '2019-11-29', 'G01,G10,G11,G12,G13'),
(19, '', 'user', 'P02', '2019-11-29', 'G01,G10,G11,G12,G13'),
(20, '', 'user', 'P02', '2019-11-29', 'G01,G10,G11,G12,G13'),
(31, 'PSN005', 'rara', 'P01', '2024-07-03', 'G01,G02,G03,G04,G05,G06,G07,G08,G09,G10,G11,G12,G13'),
(32, 'PSN005', 'rara', 'P02', '2024-07-03', 'G01,G02,G03,G04,G05,G06,G07,G08,G09,G10,G11,G12,G13'),
(33, 'PSN005', 'rara', 'P01', '2024-07-03', 'G01,G02,G03,G04,G05,G06,G07,G08,G09,G10,G11,G12,G13'),
(34, 'PSN005', 'rara', 'P02', '2024-07-03', 'G01,G02,G03,G04,G05,G06,G07,G08,G09,G10,G11,G12,G13'),
(35, 'PSN005', 'rara', 'P01', '2024-07-03', 'G01,G02,G03,G04,G05,G06,G07,G08,G09,G10,G11,G12,G13'),
(36, 'PSN005', 'rara', 'P02', '2024-07-03', 'G01,G02,G03,G04,G05,G06,G07,G08,G09,G10,G11,G12,G13'),
(37, 'PSN005', 'rara', 'P01', '2024-07-17', 'G01,G02,G03,G04,G05,G06,G07,G08,G09,G10,G11,G12,G13'),
(38, 'PSN005', 'rara', 'P02', '2024-07-17', 'G01,G02,G03,G04,G05,G06,G07,G08,G09,G10,G11,G12,G13');

-- --------------------------------------------------------

--
-- Table structure for table `tbsaran`
--

CREATE TABLE `tbsaran` (
  `id_saran` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `saran` text NOT NULL,
  `tgl_kirim` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbsaran`
--

INSERT INTO `tbsaran` (`id_saran`, `nama`, `saran`, `tgl_kirim`) VALUES
(2, 'rara', 'aplikasi ini sangat membantu sekali', '2024-07-17 02:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `id_user` varchar(25) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(6) NOT NULL,
  `nm_pengguna` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`id_user`, `username`, `password`, `nm_pengguna`, `email`, `nohp`) VALUES
('PSN003', 'riza', '1234', 'riza', 'riza@gmail.com', '082178796050'),
('PSN004', 'surya', '12345', 'surya', '1@gmail.com', '0821234567'),
('PSN005', 'rara', '12345', 'rara', 'rara@gmail.com', '08152525415425');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tbhasil_konsultasi`
--
ALTER TABLE `tbhasil_konsultasi`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tbsaran`
--
ALTER TABLE `tbsaran`
  ADD PRIMARY KEY (`id_saran`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbhasil_konsultasi`
--
ALTER TABLE `tbhasil_konsultasi`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbsaran`
--
ALTER TABLE `tbsaran`
  MODIFY `id_saran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
