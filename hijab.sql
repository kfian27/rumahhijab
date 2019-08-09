-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2019 at 10:33 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hijab`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(11) NOT NULL,
  `nm_cabang` varchar(255) DEFAULT NULL,
  `loc_cabang` varchar(255) DEFAULT NULL,
  `st_cabang` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `nm_cabang`, `loc_cabang`, `st_cabang`) VALUES
(1, 'utama', 'Jakarta', 1),
(2, 'Jatim', 'Surabaya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_invoice`
--

CREATE TABLE `detail_invoice` (
  `id_di` int(11) NOT NULL,
  `id_invoice` int(11) DEFAULT NULL,
  `id_produk` int(255) DEFAULT NULL,
  `qty_di` int(11) DEFAULT NULL,
  `total_di` varchar(255) DEFAULT NULL,
  `st_di` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_invoice`
--

INSERT INTO `detail_invoice` (`id_di`, `id_invoice`, `id_produk`, `qty_di`, `total_di`, `st_di`) VALUES
(1, 212, 8, 4, '40000', 'kirim');

-- --------------------------------------------------------

--
-- Table structure for table `detail_invoice_tmp`
--

CREATE TABLE `detail_invoice_tmp` (
  `id_di` int(11) NOT NULL,
  `id_invoice` int(11) DEFAULT NULL,
  `id_produk` int(255) DEFAULT NULL,
  `qty_di` int(11) DEFAULT NULL,
  `total_di` varchar(255) DEFAULT NULL,
  `st_di` smallint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `no_invoice` varchar(255) DEFAULT NULL,
  `jumlah_stok` int(11) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `up_gudang` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `id_user`, `id_produk`, `no_invoice`, `jumlah_stok`, `keterangan`, `up_gudang`) VALUES
(1, 1, 8, NULL, 10, 'Barang masuk', '2019-08-09 08:13:29'),
(2, 1, 8, '19/08/09/001', 4, 'Barang keluar', '2019-08-09 08:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `no_invoice` varchar(255) DEFAULT NULL,
  `nm_invoice` varchar(255) DEFAULT NULL,
  `alm_invoice` varchar(255) DEFAULT NULL,
  `kota_invoice` varchar(255) DEFAULT NULL,
  `byr_invoice` varchar(255) DEFAULT NULL,
  `harga_invoice` varchar(255) DEFAULT NULL,
  `diskon_invoice` varchar(255) DEFAULT NULL,
  `tgl_invoice` timestamp NULL DEFAULT NULL,
  `status_bayar` varchar(255) DEFAULT NULL,
  `st_invoice` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `id_user`, `no_invoice`, `nm_invoice`, `alm_invoice`, `kota_invoice`, `byr_invoice`, `harga_invoice`, `diskon_invoice`, `tgl_invoice`, `status_bayar`, `st_invoice`) VALUES
(212, 1, '19/08/09/001', 'guest', '-', '-', '40000', '39600', '1', '2019-08-09 08:19:51', 'Lunas', 'Proses kirim');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_cat` int(11) NOT NULL,
  `nm_cat` varchar(100) DEFAULT NULL,
  `st_cat` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_cat`, `nm_cat`, `st_cat`) VALUES
(7, 'Hijab', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_plg` int(11) NOT NULL,
  `nm_plg` varchar(255) DEFAULT NULL,
  `alm_plg` varchar(255) DEFAULT NULL,
  `kota_plg` varchar(255) DEFAULT NULL,
  `st_plg` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_plg`, `nm_plg`, `alm_plg`, `kota_plg`, `st_plg`) VALUES
(1, 'guest', '-', '-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_cat` int(11) DEFAULT NULL,
  `nm_produk` varchar(255) DEFAULT NULL,
  `stok_produk` int(11) DEFAULT NULL,
  `beli_produk` varchar(255) DEFAULT NULL,
  `harga_produk` varchar(255) DEFAULT NULL,
  `ft_produk` varchar(255) DEFAULT NULL,
  `up_produk` timestamp NULL DEFAULT NULL,
  `st_produk` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_user`, `id_cat`, `nm_produk`, `stok_produk`, `beli_produk`, `harga_produk`, `ft_produk`, `up_produk`, `st_produk`) VALUES
(8, 1, 7, 'coba', 6, '5000', '10000', 'user.png', '2019-08-09 08:21:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_lvl` int(11) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ft_user` varchar(255) DEFAULT NULL,
  `last_user` timestamp NULL DEFAULT NULL,
  `st_user` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_lvl`, `id_cabang`, `username`, `password`, `email`, `ft_user`, `last_user`, `st_user`) VALUES
(1, 1, 1, 'pimpinan', '202cb962ac59075b964b07152d234b70', NULL, 'user.png', '2019-08-09 08:32:25', 1),
(2, 3, 2, 'gudang_jatim', '202446dd1d6028084426867365b0c7a1', NULL, 'user.png', '2019-07-27 04:15:42', 1),
(3, 4, 2, 'kasir_jatim', 'c7911af3adbd12a035b289556d96470a', 'kasir@motto.co.id', 'user.png', '2019-07-27 04:15:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id_lvl` int(11) NOT NULL,
  `nm_lvl` varchar(50) DEFAULT NULL,
  `st_lvl` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_lvl`, `nm_lvl`, `st_lvl`) VALUES
(1, 'admin', 1),
(2, 'pimpinan', 1),
(3, 'gudang', 1),
(4, 'kasir', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `detail_invoice`
--
ALTER TABLE `detail_invoice`
  ADD PRIMARY KEY (`id_di`),
  ADD KEY `fk_di_produk` (`id_produk`),
  ADD KEY `fk_di_invo` (`id_invoice`);

--
-- Indexes for table `detail_invoice_tmp`
--
ALTER TABLE `detail_invoice_tmp`
  ADD PRIMARY KEY (`id_di`),
  ADD KEY `fk_di_produk` (`id_produk`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`),
  ADD KEY `FK_RELATIONSHIP_7` (`id_user`),
  ADD KEY `FK_RELATIONSHIP_8` (`id_produk`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`),
  ADD KEY `fk_relationship_3` (`id_user`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_plg`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `fk_relationship_1` (`id_cat`),
  ADD KEY `fk_relationship_6` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_relationship_4` (`id_cabang`),
  ADD KEY `fk_relationship_5` (`id_lvl`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_lvl`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_invoice`
--
ALTER TABLE `detail_invoice`
  MODIFY `id_di` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_invoice_tmp`
--
ALTER TABLE `detail_invoice_tmp`
  MODIFY `id_di` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_plg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_lvl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_invoice`
--
ALTER TABLE `detail_invoice`
  ADD CONSTRAINT `fk_di_invo` FOREIGN KEY (`id_invoice`) REFERENCES `invoice` (`id_invoice`),
  ADD CONSTRAINT `fk_di_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `gudang`
--
ALTER TABLE `gudang`
  ADD CONSTRAINT `FK_RELATIONSHIP_7` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `FK_RELATIONSHIP_8` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_relationship_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_relationship_1` FOREIGN KEY (`id_cat`) REFERENCES `kategori_produk` (`id_cat`),
  ADD CONSTRAINT `fk_relationship_6` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_relationship_4` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`),
  ADD CONSTRAINT `fk_relationship_5` FOREIGN KEY (`id_lvl`) REFERENCES `user_level` (`id_lvl`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
