-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2021 at 11:36 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `try`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail_penjualan` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_menu` int(4) NOT NULL,
  `nama_detail` varchar(100) NOT NULL,
  `harga_detail` int(11) NOT NULL,
  `total_detail` int(11) NOT NULL,
  `jumlah_detail` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail_penjualan`, `id_penjualan`, `id_menu`, `nama_detail`, `harga_detail`, `total_detail`, `jumlah_detail`) VALUES
(65, 35, 4, 'Terong Krispi', 4000, 4000, 1),
(66, 35, 11, 'Ge-Ju Pedas', 10000, 10000, 1),
(69, 37, 10, 'Jus Mangga', 6000, 6000, 1),
(70, 38, 1, 'Ge-Ju Original', 10000, 10000, 1),
(71, 38, 6, 'Ge-Ju + Jus', 15000, 15000, 1),
(72, 38, 10, 'Jus Mangga', 6000, 6000, 1),
(73, 39, 1, 'Ge-Ju Original', 10000, 10000, 1),
(76, 42, 8, 'Tempe Krispi', 4000, 8000, 2),
(78, 44, 1, 'Ge-Ju Original', 10000, 10000, 1),
(79, 45, 1, 'Ge-Ju Original', 10000, 10000, 1),
(80, 46, 1, 'Ge-Ju Original', 10000, 10000, 1),
(81, 46, 5, 'Jus Melon', 6000, 6000, 1),
(82, 47, 4, 'Terong Krispi', 4000, 8000, 2),
(83, 47, 1, 'Ge-Ju Original', 10000, 10000, 1),
(84, 47, 7, 'Jus Jambu', 6000, 12000, 2),
(85, 48, 11, 'Ge-Ju Pedas', 10000, 40000, 4),
(86, 48, 5, 'Jus Melon', 6000, 24000, 4),
(87, 48, 4, 'Terong Krispi', 4000, 8000, 2),
(88, 49, 11, 'Ge-Ju Pedas', 10000, 40000, 4),
(89, 49, 5, 'Jus Melon', 6000, 24000, 4),
(90, 49, 4, 'Terong Krispi', 4000, 8000, 2),
(91, 50, 6, 'Ge-Ju + Jus', 15000, 30000, 2),
(92, 51, 6, 'Ge-Ju + Jus', 15000, 15000, 1),
(93, 52, 1, 'Ge-Ju Original', 10000, 10000, 1),
(94, 52, 10, 'Jus Mangga', 6000, 6000, 1),
(95, 53, 4, 'Terong Krispi', 4000, 4000, 1),
(96, 53, 11, 'Ge-Ju Pedas', 10000, 10000, 1),
(97, 53, 5, 'Jus Melon', 6000, 6000, 1),
(98, 54, 10, 'Jus Mangga', 6000, 6000, 1),
(99, 54, 11, 'Ge-Ju Pedas', 10000, 10000, 1),
(100, 55, 12, 'Ge-Ju Super Pedas', 11000, 33000, 3),
(101, 55, 7, 'Jus Jambu', 6000, 6000, 1),
(102, 55, 10, 'Jus Mangga', 6000, 6000, 1),
(103, 55, 5, 'Jus Melon', 6000, 6000, 1),
(104, 56, 2, 'Ge-Ju', 10000, 10000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(3) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Makanan Ringan'),
(2, 'Makanan Berat'),
(3, 'Minuman');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(4) NOT NULL,
  `id_kategori` int(3) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga_menu` int(11) NOT NULL,
  `foto_menu` varchar(100) NOT NULL,
  `deskripsi_menu` text NOT NULL,
  `stok_menu` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_kategori`, `nama_menu`, `harga_menu`, `foto_menu`, `deskripsi_menu`, `stok_menu`) VALUES
(1, 2, 'Ge-Ju Original', 10000, 'gejufriedchicken_20201105_125340_0.jpg', 'Ayam Fried Chicken Original Ge-Ju.', 10),
(2, 2, 'Ge-Ju', 10000, 'gejufriedchicken_20201105_125428_0.jpg', 'Ayam Geprek dan Nasi.', 12),
(4, 1, 'Terong Krispi', 4000, 'gejufriedchicken_20201105_125006_0.jpg', 'Terong Krispi Renyah dan Gurih.', 7),
(5, 3, 'Jus Melon', 6000, 'gejufriedchicken_20201105_125221_0.jpg', 'Jus Buah Melon Segar.', 9),
(6, 2, 'Ge-Ju + Jus', 15000, 'gejufriedchicken_20201105_125257_0.jpg', 'Ayam Geprek Salju dan Jus Buah.', 22),
(7, 3, 'Jus Jambu', 6000, '20201226_102155.jpg', 'Jus Buah Jambu Segar.', 12),
(8, 1, 'Tempe Krispi', 4000, '20201226_102734.jpg', 'Tempe Kripsi Renyah dan Gurih.', 15),
(9, 1, 'Jamur Krispi', 4000, '20201226_102818.jpg', 'Jamur Krispi Renyah dan Gurih.', 15),
(10, 3, 'Jus Mangga', 6000, '20201226_102252.jpg', 'Jus Buah Mangga Segar.', 8),
(11, 2, 'Ge-Ju Pedas', 10000, 'gejufriedchicken_20201105_075316_0.jpg', 'Ayam Geprek Pedas Salju (Arai) dan Nasi.', 5),
(12, 2, 'Ge-Ju Super Pedas', 11000, 'gejufriedchicken_20201220_160529_0.jpg', 'Ayam Geprek Super Pedas dan Nasi.', 15);

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(4) NOT NULL,
  `jarak_ongkir` varchar(100) NOT NULL,
  `tarif_ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `jarak_ongkir`, `tarif_ongkir`) VALUES
(1, '1 km', 2000),
(2, '2 km', 4000),
(3, '3 km', 6000),
(4, '4 km', 8000),
(5, '5 km', 10000),
(6, '6 km', 12000),
(7, '7 km', 14000),
(8, '8 km', 16000),
(9, '9 km', 18000),
(10, '10 km', 20000),
(11, '11 km', 22000),
(12, '12 km', 24000),
(13, '13 km', 26000),
(14, '14 km', 28000),
(15, '15 km', 30000),
(16, '16 km', 32000),
(17, '17 km', 34000),
(18, '18 km', 36000),
(19, '19 km', 38000),
(20, '20 km', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `nama_rekening` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_penjualan`, `nama_rekening`, `bank`, `total_pembayaran`, `tanggal_pembayaran`, `bukti`) VALUES
(39, 35, 'Muhammad Solehudin', 'BNI', 40000, '2021-02-09', '20210209065702vscode.png'),
(41, 39, 'Syahridal Syahril', 'BRI', 22000, '2021-02-18', '20210218052925DAD-v1.png'),
(44, 44, 'Muhammad Solehudin', 'BNI', 32000, '2021-02-25', '20210225104824Dia_logo.png'),
(45, 48, 'Muhammad Solehudin', 'BNI', 98000, '2021-03-01', '20210301095019WhatsApp Image 2021-01-14 at 08.53.29.jpeg'),
(46, 49, 'Muhammad Solehudin', 'BNI', 98000, '2021-03-01', '20210301121527WhatsApp Image 2021-01-14 at 08.53.54.jpeg'),
(47, 50, 'Muhammad Solehudin', 'BNI', 56000, '2021-03-01', '20210301140110WhatsApp Image 2021-01-14 at 08.53.29.jpeg'),
(48, 51, 'Rohmawati', 'BNI', 45000, '2021-03-02', '20210302055843WhatsApp Image 2021-02-26 at 05.59.35.jpeg'),
(49, 52, 'Muhammad Solehudin', 'BNI', 42000, '2021-03-02', '20210302095038WhatsApp Image 2021-01-14 at 08.53.54.jpeg'),
(50, 53, 'Maria', 'BNI', 40000, '2021-03-03', '20210303050023WhatsApp Image 2021-02-26 at 05.59.35 (1).jpeg'),
(51, 54, 'Gerson Leto', 'BRI', 40000, '2021-03-04', '20210304052343WhatsApp Image 2021-03-04 at 05.10.53.jpeg'),
(52, 55, 'Fachri', 'BNI', 71000, '2021-03-05', '20210305060436WhatsApp Image 2021-03-04 at 05.10.53.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ongkir` int(4) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `total_penjualan` int(11) NOT NULL,
  `jarak` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_penjualan` enum('Pending','Confirmed','Lunas','Batal') NOT NULL DEFAULT 'Pending',
  `resi_pengiriman` varchar(10) NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_user`, `id_ongkir`, `tanggal_penjualan`, `total_penjualan`, `jarak`, `tarif`, `alamat_pengiriman`, `status_penjualan`, `resi_pengiriman`) VALUES
(35, 14, 13, '2021-02-09', 40000, '13 km', 26000, 'Jl. Rajawali, Pelem Mulong, Banguntapan, Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198', 'Lunas', 'RSI023'),
(37, 14, 11, '2021-02-15', 28000, '11 km', 22000, 'Jl. Rajawali, Pelem Mulong, Banguntapan, Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198', 'Batal', 'Batal'),
(38, 16, 20, '2021-02-17', 71000, '20 km', 40000, 'SB-87 \"Sumber Berkah\", Jalan Kyai Ageng Terum, Teruman, Teruman, Bantul, Kec. Bantul, Bantul, Daerah Istimewa Yogyakarta 55711', 'Batal', 'Batal'),
(39, 19, 6, '2021-02-18', 22000, '6 km', 12000, 'Jl. Madukoro, Dabag, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281', 'Lunas', 'RSI024'),
(42, 14, 9, '2021-02-19', 26000, '9 km', 18000, 'STMIK Akakom Yogyakarta, Jl. Raya Janti No.143, Jaranan, Banguntapan, Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198', 'Batal', 'Batal'),
(44, 14, 11, '2021-02-25', 32000, '11 km', 22000, 'STMIK Akakom Yogyakarta, Jl. Raya Janti No.143, Jaranan, Banguntapan, Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198', 'Lunas', 'RSI025'),
(45, 14, 13, '2021-02-25', 36000, '13 km', 26000, 'Babadan Baru Banguntapan Bantul', 'Batal', 'Batal'),
(46, 14, 13, '2021-02-25', 42000, '13 km', 26000, 'Babadan Baru Banguntapan Bantul', 'Batal', 'Batal'),
(47, 14, 13, '2021-02-25', 56000, '13 km', 26000, 'Babadan Baru Banguntapan Bantul', 'Batal', 'Batal'),
(48, 14, 13, '2021-03-01', 98000, '13 km', 26000, 'Jl. Rajawali, Pelem Mulong, Banguntapan, Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198', 'Lunas', 'RSI026'),
(49, 14, 13, '2021-03-01', 98000, '13 km', 26000, 'Jl. Rajawali, Pelem Mulong, Banguntapan, Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198', 'Confirmed', 'Menunggu'),
(50, 14, 13, '2021-03-01', 56000, '13 km', 26000, 'Jl. Rajawali, Pelem Mulong, Banguntapan, Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198', 'Confirmed', 'Menunggu'),
(51, 26, 15, '2021-03-02', 45000, '15 km', 30000, 'Berbah, Tegaltirto, Kec. Berbah, Kabupaten Sleman, Daerah Istimewa Yogyakarta', 'Lunas', 'RSI027'),
(52, 14, 13, '2021-03-02', 42000, '13 km', 26000, 'Jl. Rajawali, Pelem Mulong, Banguntapan, Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198', 'Lunas', 'RSI028'),
(53, 27, 10, '2021-03-03', 40000, '10 km', 20000, 'STMIK Akakom Yogyakarta, Jl. Raya Janti No.143, Jaranan, Banguntapan, Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198', 'Lunas', 'RSI029'),
(54, 23, 12, '2021-03-04', 40000, '12 km', 24000, 'Jl. Karangbendo Kulon No.298, RT.09/RW.04, Jaranan, Banguntapan, Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198', 'Lunas', 'RSI030'),
(55, 18, 10, '2021-03-05', 71000, '10 km', 20000, 'angkringan etan JEC, Modalan, Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198', 'Lunas', 'RSI031'),
(56, 14, 13, '2021-03-12', 36000, '13 km', 26000, 'babadan', 'Pending', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(3) NOT NULL,
  `foto_slider` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id_slider`, `foto_slider`, `id_user`) VALUES
(1, '2020122611411720201226_103147.jpg', 1),
(2, '2021021121040320201226_102354.jpg', 9),
(3, '2020122611414420201226_102547.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(75) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('pelanggan','admin','pemilik') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `telephone`, `alamat`, `password`, `status`) VALUES
(1, 'Muhammad Solehudin', 'riasakno@gmail.com', '081227917430', 'Babadan Baru Banguntapan Bantul', 'b16b565bb04c84da72843efcefd6245f2bab7966', 'admin'),
(4, 'Pemilik', 'isokuniki98@gmail.com', '081227917433', 'babadan', 'e3f48f5ff66a93031124342bbd4cc5640515ac02', 'pemilik'),
(9, 'Soholeh', 'soholeh@gmail.com', '081227917430', 'Babadan Baru', 'b16b565bb04c84da72843efcefd6245f2bab7966', 'admin'),
(14, 'Muhammad Solehudin', 'msolehudin130998@gmail.com', '081227917430', 'Babadan Baru Banguntapan Bantul', '4c09b3811426e79d29cf2d4ea9f5f8198197de99', 'pelanggan'),
(16, 'Bagas Setiawan', 'mostergila11@gmail.com', '081227917222', 'Pandak Bantul', '597a445e77ecd913c415f2010823b7dc8095ec5c', 'pelanggan'),
(17, 'Kusiyansah', 'kusiyansah@gmail.com', '081227917333', 'Banguntapan Bntul', '597a445e77ecd913c415f2010823b7dc8095ec5c', 'pelanggan'),
(18, 'Syahnanda Fachri', 'fachri460@gmail.com', '081227917444', 'Janti', '597a445e77ecd913c415f2010823b7dc8095ec5c', 'pelanggan'),
(19, 'Syahridal Syahril', 'idalganda01@gmail.com', '081227917555', 'Depok Sleman', '597a445e77ecd913c415f2010823b7dc8095ec5c', 'pelanggan'),
(20, 'Leo Reynaldo Karunia Alfanov', 'lrkAlfanov@gmail.com', '081227917666', 'Sorowajan', '597a445e77ecd913c415f2010823b7dc8095ec5c', 'pelanggan'),
(21, 'Haryadi', 'fatihharyadi20@gmail.com', '08122692454', 'Kutu Patran, Sinduadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta', '1f86485ac9c8b00fb355bd1eb1c86d937f6d457c', 'pelanggan'),
(23, 'Gerson Leto', 'ghersonleto@gmail.com', '089688502444', 'Bantul', '597a445e77ecd913c415f2010823b7dc8095ec5c', 'pelanggan'),
(26, 'Rohmawati', 'rohmaningrum17@gmail.com', '085713459527', 'Berbah Sleman', '597a445e77ecd913c415f2010823b7dc8095ec5c', 'pelanggan'),
(27, 'Maria', 'mariatrias084@gmail.com', '0895359004025', 'Karang Jambe', '597a445e77ecd913c415f2010823b7dc8095ec5c', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail_penjualan`,`id_penjualan`,`id_menu`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`,`id_kategori`),
  ADD KEY `kategori_produk_id` (`id_kategori`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`,`id_penjualan`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`,`id_user`,`id_ongkir`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_ongkir` (`id_ongkir`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_ongkir`) REFERENCES `ongkir` (`id_ongkir`);

--
-- Constraints for table `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `slider_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
