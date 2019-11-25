-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 03. April 2019 jam 20:44
-- Versi Server: 5.5.8
-- Versi PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pakar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_lengkap`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator'),
('rafiq', '307b7e5708168525e0d1fc2ef0530fea', 'okta rafiq');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE IF NOT EXISTS `penyakit` (
  `id_penyakit` varchar(5) NOT NULL,
  `nm_penyakit` varchar(70) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `nm_penyakit`, `keterangan`) VALUES
('P001', 'Glaukoma Sudut Tertutup Akut', 'Glaukoma sudut tertutup akut adalah penyakit serius yang membuat tekanan di dalam mata Anda (disebut juga tekanan intraokular) mendadak naik, bahkan dalam hitungan jam. Ini terjadi saat air mata tidak bisa melembapkan mata seperti seharusnya.\r\nKondisi ini tidak seumum jenis glaukoma lainnya, di mana biasanya tekanan di dalam mata meningkat perlahan-lahan dalam jangka waktu panjang.\r\n\r\nSolusi : Yang pertama akan dilakukan dokter untuk mengobati glaukoma sudut tertutup akut adalah untuk menghilangkan tekanan di dalam mata. Biasanya dokter akan menggunakan:\r\nObat tetes mata yang mengecilkan pupil\r\nObat-obatan untuk mengurangi jumlah air mata yang diproduksi\r\nSetelah tekanan di dalam mata berkurang sedikit, dokter mungkin akan menggunakan laser untuk:\r\n\r\nMembuat lubang kecil di iris mata Anda. Ini disebut laser iriodotomy dan membantu cairan di mata mengalir kembali. Tindakan ini bisa dilakukan hanya dalam beberapa menit, dan Anda bisa langsung pulang.\r\nMenarik sudut-sudut iris mata Anda dari saluran air mata. Ini disebut laser iridoplasty atau gonioplasty.\r\nJika Anda memiliki katarak, dokter mungkin akan menganjurkan operasi untuk mengganti lensa mata. Namun jenis operasi ini akan lebih sulit dilakukan jika Anda sedang mendapat serangan akut.\r\n\r\nMeskipun glaukoma sudut tertutup akut hanya terjadi pada satu mata, dokter mungkin akan mengobati kedua mata Anda, untuk berjaga-jaga.\r\n\r\nPencegahan : Kontrol takanan gejala mata uang teratur (1x bulan) dan instirahat yang cukup\r\n'),
('P002', 'Glaukoma Juvenil', 'Glaukoma juvenil adalah bentuk glaukoma sudut terbuka primer yang ditandai dengan peningkatan tekanan intraokular dan ditemukan pada rentang usia 4 sampai 35 tahun. Glaukoma juvenil jarang terjadi dengan insiden sekitar 1:50.000.2. Glaukomajuvenil pada umumnya terdeteksi pada fase lanjut dengan kerusakan nervus optikus yang sudah berat dan tekanan intra okular (TIO) lebih dari 40 mmHg.3,4 Pemberian obat-obatan pada pasien glaukoma juvenil seringkali tidak mendapatkan toleransi yang maksimal sehingga membutuhkan tindakan pembedahan. Trabekulektomi direkomendasikan sebagai terapi pembedahan yang berhasil pada pasien dengan glaukoma juvenil. Mengingat rentang usia yang masih muda dan harapan hidup pasien, maka sangat penting bagi\r\npara ahli untuk mengenal lebih baik glaukoma juvenil, dimana terjadinya neuropati optik yang kronis dan bersifat bilateral sangat memungkinkan mengakibatkan kebutaan. \r\n\r\nSolusi : Terapi lini pertama pada glaukoma umumnya dengan penggunaan obat-obatan antiglaukoma yang membantu drainase agar mengalir lebih lancar atau mengurangi produksi cairan bola mata atau humor akuos. Pada beberapa kasus obat-obatan dapat mengontrol tekanan bola mata untuk jangka panjang. Penelitian menunjukkan tekanan bola mata yang terkontrol dibawah kisaran target tekanan, maka risiko progresivitas glaukoma akan menurun. Oleh karena itu, haruslah disiplin dan teratur dalam menggunakan obat sesuai yang disarankan oleh dokter mata.\r\n\r\nPencegahan : \r\n1. Melindungi Mata Dari Paparan Sinar UV. ...\r\n2. Sering Mengkonsumsi Buah Berwarna Gelap atau Abu-Abu. ...\r\n3. Mengkonsumsi Makanan Tinggi Karotenoid. ...\r\n4. Melakukan Pemeriksaan Mata Secara Teratur. ...\r\n5. Sering Mengkonsumsi Buah Berwarna Gelap atau Abu-Abu. ...\r\n6. Mengendalikan Kadar Gula Darah.'),
('P003', 'Glaukoma Kronik ', 'Glaukoma kronik ataupun biasa disebut dengan glaukoma sudut terbuka (Primary angle-closure glaucoma) merupakan jenis glaukoma yang paling sering terjadi jika dibandingkan dengan jenis glaukoma lainnya.\r\n\r\nSolusi :\r\n1. Obat tetes mata\r\nObat tetes mata untuk mengobati glaukoma tentu bukanlah obat tetes generik yang bisa Anda dapatkan dengan bebas di warung atau apotek. Obat tetes untuk glaukoma harus didapatkan dengan menebus resep, karena jenis dan dosisnya akan ditentukan oleh dokter berdasarkan tingkat keparahan kondisi Anda.\r\n2. Obat minum\r\nAda dua pilihan obat minum untuk mengatasi glaukoma, yaitu:\r\nGolongan inhibitor karbonik anhidrase. Contohnya acetazolamide. Obat ini umumnya hanya digunakan untuk terapi singkat serangan glaukoma akut. Namun pada beberapa kasus, obat ini dapat diberikan dalam jangka waktu panjang pada pasien yang tidak dapat menjalani operasi namun obat tetes mata tidak lagi manjur.\r\nGolongan hiperosmotik. Contohnya glisero. Obat ini bekerja dengan menarik cairan dari bola mata ke dalam pembuluh darah. Pemberian hanya dilakukan pada kasus-kasus akut dan dalam jangka waktu singkat (hitungan jam).\r\nAkan tetapi, risiko efek samping obat minum lebih tinggi daripada obat tetes mata, maka obat minum kurang direkomendasikan sebagai pengobatan glaukoma.\r\n3. Laser\r\nTerdapat dua jenis laser yang dapat dilakukan untuk membantu menguras kelebihan cairan dari bola mata, yaitu:\r\nTrabekuloplasti. Tindakan ini biasa dilakukan untuk orang yang memiliki glaukoma sudut terbuka. Laser membantu agar sudut yang menjadi tempat drainase dapat bekerja secara lebih maksimal.\r\nIridotomi. Tindakan ini dilakukan untuk kasus glaukoma sudut tertutup. Iris Anda akan dilubangi dengan menggunakan sinar laser agar ekstra cairan dapat mengalir lebih baik.\r\nAkan tetapi, hasilnya tidak seefektif operasi.\r\n4. Operasi glaukoma umumnya dilakukan pada kasus-kasus yang sudah tidak lagi dapat membaik dengan obat-obatan. Operasi biasanya berlangsung selama 45 sampai 75 menit.\r\nTindakan pembedahan yang umum untuk mengobati glaukoma, termasuk:\r\nTrabekulektomi, dilakukan dengan membuat sayatan kecil di bagian putih mata dan juga pembuatan kantong di daerah konjungtiva (bleb). Dengan demikian, kelebihan cairan dapat mengalir melalui sayatan tersebut menuju kantong bleb dan kemudian diserap oleh tubuh.\r\nAlat drainase glaukoma. Tindakan ini berupa pemasangan implan serupa pipa untuk membantu mengalirkan ekstra cairan dalam bola mata.\r\n\r\nPencegahan : \r\n1. Periksa kesehatan mata secara teratur.\r\n2. Segera periksakan mata jika pandangan terasa kabur, remang dan sempit.\r\n3. Waspada jika memiliki penyakit hipertensi atau diabetes.\r\n4. Waspada jika di dalam keluarga ada yang memiliki riwayat penyakit ini.\r\n5. Jika divonis menderita glaukoma, harus disiplin berobat agar tidak menjadi buta.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rule`
--

CREATE TABLE IF NOT EXISTS `rule` (
  `id_rule` int(11) NOT NULL,
  `id_penyakit` varchar(5) NOT NULL,
  `id_gejala` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rule`
--

INSERT INTO `rule` (`id_rule`, `id_penyakit`, `id_gejala`) VALUES
(31, 'P005', 'G021'),
(32, 'P005', 'G022'),
(33, 'P005', 'G023'),
(34, 'P005', 'G024'),
(0, 'P001', 'G001'),
(0, 'P001', 'G012'),
(0, 'P001', 'G013'),
(0, 'P001', 'G010'),
(0, 'P001', 'G005'),
(0, 'P001', 'G006'),
(0, 'P001', 'G007'),
(0, 'P003', 'G002'),
(0, 'P003', 'G003'),
(0, '', 'G004'),
(0, 'P003', 'G008'),
(0, 'P003', 'G009'),
(0, 'P003', 'G004'),
(0, 'P003', 'G011'),
(0, 'P003', 'G002'),
(0, 'P003', 'G003'),
(0, 'P002', 'G015'),
(0, 'P002', 'G016'),
(0, 'P002', 'G017');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbgejala`
--

CREATE TABLE IF NOT EXISTS `tbgejala` (
  `id_gejala` varchar(5) NOT NULL,
  `nm_gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbgejala`
--

INSERT INTO `tbgejala` (`id_gejala`, `nm_gejala`) VALUES
('G001', 'Apakah anda merasakan nyeri dimata?'),
('G002', 'Apakah anda merasakan sakit kepala?'),
('G003', 'Apa anda merasa mual atau muntah?'),
('G004', 'Apakah penghlihatan anda kabur atau berkabut?'),
('G005', 'Apakah bagian putih mata anda menjadi merah?'),
('G006', 'Apakah ukuran pupil kiri dan kanan menjadi berbeda?'),
('G007', 'Apakah anda mendadak kehilangan penglihatan?'),
('G008', 'Apakah anda merasa nyeri dimata dan didahi?'),
('G009', 'Apakah mata anda merah?'),
('G010', 'Apakah penurunan penglihatan atau pengelihatan kabur?'),
('G011', 'Apakah anda melihat pelangi atau lingkaran cahaya?'),
('G012', 'Apakah anda merasa sakit kepala?'),
('G013', 'Apakah anda merasa muntah dan mual?'),
('G014', 'Apakah anda merasa penglihatan anda mulai kabur?'),
('G015', 'Apakah meras ingin mengedip terus-menerus dengan menekan kedipan berlebihan?'),
('G016', 'Apakah mata terasa sakit karena posisi mata dalam keadaan membengkak?'),
('G017', 'Apakah penglihatan yang tadinya kabur lama kelamaan akan kembali normal?');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbhasil_konsultasi`
--

CREATE TABLE IF NOT EXISTS `tbhasil_konsultasi` (
  `id_hasil` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `id_penyakit` varchar(5) NOT NULL,
  `tgl_hasil` date NOT NULL,
  `gejala_dipilih` text NOT NULL,
  PRIMARY KEY (`id_hasil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data untuk tabel `tbhasil_konsultasi`
--

INSERT INTO `tbhasil_konsultasi` (`id_hasil`, `username`, `id_penyakit`, `tgl_hasil`, `gejala_dipilih`) VALUES
(40, 'deno a', 'P001', '2018-10-23', 'G001,G002,G003,G004,G005,G006,G007,G008'),
(41, 'kalun', 'P001', '2018-10-28', 'G001,G002,G003,G004,G005,G006,G007,G008'),
(42, 'kalun', 'P001', '2018-10-29', 'G001,G002,G003,G004,G005,G006,G007,G008'),
(43, 'kalun', 'P002', '2019-04-04', 'G015,G016,G017'),
(44, 'kalun', 'P002', '2019-04-04', 'G015,G016,G017'),
(45, 'kalun', 'P002', '2019-04-04', 'G015,G016,G017');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbsaran`
--

CREATE TABLE IF NOT EXISTS `tbsaran` (
  `id_saran` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `saran` text NOT NULL,
  `tgl_kirim` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_saran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `tbsaran`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `tbuser`
--

CREATE TABLE IF NOT EXISTS `tbuser` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `nm_pengguna` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(14) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tbuser`
--

INSERT INTO `tbuser` (`id_user`, `username`, `password`, `nm_pengguna`, `email`, `nohp`) VALUES
(1, 'kalun', '514358fccadc49adece54644b6cf32a4', 'kalun r', 'kalun@gmail.com', '08137825235');
