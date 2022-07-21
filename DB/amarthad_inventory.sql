-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 01:46 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amarthad_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `id_approval` int(50) NOT NULL,
  `id_tiket` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `status` enum('approve','reject','pending') NOT NULL DEFAULT 'pending',
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(100) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `harga` bigint(50) NOT NULL,
  `stock` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `kategori`, `nama_barang`, `satuan`, `harga`, `stock`) VALUES
('IT-200722-105723', 'IT', 'Laptop Asus X450JN', 'Pcs', 4000000, 1),
('IT-200722-105754', 'IT', 'RAM SODIM DDR4 V-GEN 16GB', 'Pcs', 700000, 5),
('LOG-200722-105338', 'Logistik', 'Ballpoint Pilot Biru', 'Pcs', 2000, 50),
('LOG-200722-105438', 'Logistik', 'Ballpont Pilot Hitam', 'Pcs', 2000, 40),
('LOG-200722-105558', 'Logistik', 'Ballpoint Pilot Merah', 'Pcs', 2000, 20),
('LOG-200722-105619', 'Logistik', 'Kertas SIDU', 'Rim', 80000, 50),
('LOG-200722-105649', 'Logistik', 'Kertas Foto A4', 'Pack', 15000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_bkeluar` int(50) NOT NULL,
  `kode_bkeluar` varchar(100) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `jml_keluar` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_bmasuk` int(50) NOT NULL,
  `kode_bmasuk` varchar(100) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `jml_masuk` int(20) NOT NULL,
  `harga_satuan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_bmasuk`, `kode_bmasuk`, `kode_barang`, `jml_masuk`, `harga_satuan`) VALUES
(1, 'IN-200722-111502', 'IT-200722-105754', 1, 700000),
(2, 'IN-200722-111502', 'LOG-200722-105338', 10, 2000),
(3, 'IN-200722-111502', 'LOG-200722-105438', 10, 2000),
(4, 'IN-200722-111502', 'LOG-200722-105558', 10, 2000),
(5, 'IN-210722-131503', 'IT-200722-105723', 5, 4000000),
(6, 'IN-210722-131503', 'IT-200722-105754', 5, 700000);

-- --------------------------------------------------------

--
-- Table structure for table `d_bkeluar`
--

CREATE TABLE `d_bkeluar` (
  `kode_bkeluar` varchar(100) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `d_bmasuk`
--

CREATE TABLE `d_bmasuk` (
  `kode_bmasuk` varchar(100) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `no_po` varchar(100) NOT NULL,
  `kode_vendor` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_bmasuk`
--

INSERT INTO `d_bmasuk` (`kode_bmasuk`, `tgl_masuk`, `no_po`, `kode_vendor`, `username`) VALUES
('IN-200722-111502', '2022-07-20', '12/12121/TEST/001', 'VEN-200722-111502', 'admin'),
('IN-210722-131503', '2022-07-21', '32/232323/COBA/011\r\n', 'VEN-200722-111537', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` char(5) NOT NULL,
  `role` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `role`, `level`) VALUES
('ADM', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `req_barang`
--

CREATE TABLE `req_barang` (
  `id_req` int(50) NOT NULL,
  `id_tiket` varchar(50) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `jumlah` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(50) NOT NULL,
  `duedate` date NOT NULL,
  `note` varchar(200) NOT NULL,
  `status` enum('open','inprogress','close') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_level` char(5) DEFAULT NULL,
  `blokir` enum('Y','N') NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `email`, `id_level`, `blokir`, `foto`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@amartha.com', 'ADM', 'N', 'amartha.png');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `kode_vendor` varchar(100) NOT NULL,
  `nama_vendor` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`kode_vendor`, `nama_vendor`, `alamat`, `contact`) VALUES
('VEN-200722-111502', 'HARAPAN JAYA', 'Jalan Raya Malang Kota', '08971813454'),
('VEN-200722-111537', 'SUMBER MAKMUR', 'Jln. Raya Candi 2A No.456 Sukun, Malang', '085234158105');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bmasuk`
-- (See below for the actual view)
--
CREATE TABLE `v_bmasuk` (
`id_bmasuk` int(50)
,`kode_bmasuk` varchar(100)
,`kode_barang` varchar(100)
,`kategori` varchar(20)
,`nama_barang` varchar(100)
,`satuan` varchar(100)
,`harga` bigint(50)
,`stock` int(20)
,`jml_masuk` int(20)
,`harga_new` double
,`total` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detailbmasuk`
-- (See below for the actual view)
--
CREATE TABLE `v_detailbmasuk` (
`kode_bmasuk` varchar(100)
,`tgl_masuk` date
,`no_po` varchar(100)
,`username` varchar(100)
,`nama` varchar(100)
,`email` varchar(100)
,`kode_vendor` varchar(100)
,`nama_vendor` varchar(100)
,`alamat` varchar(100)
,`contact` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_login`
-- (See below for the actual view)
--
CREATE TABLE `v_login` (
`username` varchar(100)
,`password` varchar(100)
,`nama` varchar(100)
,`email` varchar(100)
,`blokir` enum('Y','N')
,`foto` varchar(100)
,`role` varchar(20)
,`level` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `v_bmasuk`
--
DROP TABLE IF EXISTS `v_bmasuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bmasuk`  AS SELECT `barang_masuk`.`id_bmasuk` AS `id_bmasuk`, `barang_masuk`.`kode_bmasuk` AS `kode_bmasuk`, `barang`.`kode_barang` AS `kode_barang`, `barang`.`kategori` AS `kategori`, `barang`.`nama_barang` AS `nama_barang`, `barang`.`satuan` AS `satuan`, `barang`.`harga` AS `harga`, `barang`.`stock` AS `stock`, `barang_masuk`.`jml_masuk` AS `jml_masuk`, `barang_masuk`.`harga_satuan` AS `harga_new`, `barang_masuk`.`jml_masuk`* `barang_masuk`.`harga_satuan` AS `total` FROM (`barang_masuk` left join `barang` on(`barang_masuk`.`kode_barang` = `barang`.`kode_barang`))  ;

-- --------------------------------------------------------

--
-- Structure for view `v_detailbmasuk`
--
DROP TABLE IF EXISTS `v_detailbmasuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detailbmasuk`  AS SELECT `d_bmasuk`.`kode_bmasuk` AS `kode_bmasuk`, `d_bmasuk`.`tgl_masuk` AS `tgl_masuk`, `d_bmasuk`.`no_po` AS `no_po`, `d_bmasuk`.`username` AS `username`, `user`.`nama` AS `nama`, `user`.`email` AS `email`, `vendor`.`kode_vendor` AS `kode_vendor`, `vendor`.`nama_vendor` AS `nama_vendor`, `vendor`.`alamat` AS `alamat`, `vendor`.`contact` AS `contact` FROM ((`d_bmasuk` left join `vendor` on(`d_bmasuk`.`kode_vendor` = `vendor`.`kode_vendor`)) left join `user` on(`d_bmasuk`.`username` = `user`.`username`))  ;

-- --------------------------------------------------------

--
-- Structure for view `v_login`
--
DROP TABLE IF EXISTS `v_login`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_login`  AS SELECT `user`.`username` AS `username`, `user`.`password` AS `password`, `user`.`nama` AS `nama`, `user`.`email` AS `email`, `user`.`blokir` AS `blokir`, `user`.`foto` AS `foto`, `level`.`role` AS `role`, `level`.`level` AS `level` FROM (`user` left join `level` on(`user`.`id_level` = `level`.`id_level`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id_approval`),
  ADD KEY `id_tiket` (`id_tiket`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_bkeluar`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_bkeluar` (`kode_bkeluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_bmasuk`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_bmasuk` (`kode_bmasuk`);

--
-- Indexes for table `d_bkeluar`
--
ALTER TABLE `d_bkeluar`
  ADD PRIMARY KEY (`kode_bkeluar`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `d_bmasuk`
--
ALTER TABLE `d_bmasuk`
  ADD PRIMARY KEY (`kode_bmasuk`),
  ADD KEY `username` (`username`),
  ADD KEY `kode_vendor` (`kode_vendor`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `req_barang`
--
ALTER TABLE `req_barang`
  ADD PRIMARY KEY (`id_req`),
  ADD KEY `id_tiket` (`id_tiket`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`kode_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `id_approval` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_bkeluar` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_bmasuk` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `req_barang`
--
ALTER TABLE `req_barang`
  MODIFY `id_req` int(50) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approval`
--
ALTER TABLE `approval`
  ADD CONSTRAINT `approval_ibfk_1` FOREIGN KEY (`id_tiket`) REFERENCES `tiket` (`id_tiket`),
  ADD CONSTRAINT `approval_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`kode_bkeluar`) REFERENCES `d_bkeluar` (`kode_bkeluar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`kode_bmasuk`) REFERENCES `d_bmasuk` (`kode_bmasuk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `d_bkeluar`
--
ALTER TABLE `d_bkeluar`
  ADD CONSTRAINT `d_bkeluar_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `d_bmasuk`
--
ALTER TABLE `d_bmasuk`
  ADD CONSTRAINT `d_bmasuk_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `d_bmasuk_ibfk_2` FOREIGN KEY (`kode_vendor`) REFERENCES `vendor` (`kode_vendor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `req_barang`
--
ALTER TABLE `req_barang`
  ADD CONSTRAINT `req_barang_ibfk_1` FOREIGN KEY (`id_tiket`) REFERENCES `tiket` (`id_tiket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
