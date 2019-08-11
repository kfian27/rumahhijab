/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.1.22-MariaDB : Database - hijab
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hijab` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `hijab`;

/*Table structure for table `detail_invoice` */

DROP TABLE IF EXISTS `detail_invoice`;

CREATE TABLE `detail_invoice` (
  `id_di` int(11) NOT NULL AUTO_INCREMENT,
  `id_invoice` int(11) DEFAULT NULL,
  `id_produk` int(255) DEFAULT NULL,
  `qty_di` int(11) DEFAULT NULL,
  `total_di` varchar(255) DEFAULT NULL,
  `st_di` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_di`),
  KEY `fk_di_produk` (`id_produk`),
  KEY `fk_di_invo` (`id_invoice`),
  CONSTRAINT `fk_di_invo` FOREIGN KEY (`id_invoice`) REFERENCES `invoice` (`id_invoice`),
  CONSTRAINT `fk_di_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `detail_invoice` */

insert  into `detail_invoice`(`id_di`,`id_invoice`,`id_produk`,`qty_di`,`total_di`,`st_di`) values 
(1,1,1,3,'60000','kirim'),
(2,1,2,1,'30000','kirim'),
(3,2,1,2,'40000','kirim'),
(4,3,1,2,'40000','kirim'),
(5,4,2,1,'30000','kirim'),
(6,5,2,1,'30000','kirim'),
(7,6,2,2,'60000','kirim'),
(8,7,2,2,'60000','gudang');

/*Table structure for table `detail_invoice_tmp` */

DROP TABLE IF EXISTS `detail_invoice_tmp`;

CREATE TABLE `detail_invoice_tmp` (
  `id_di` int(11) NOT NULL AUTO_INCREMENT,
  `id_invoice` int(11) DEFAULT NULL,
  `id_produk` int(255) DEFAULT NULL,
  `qty_di` int(11) DEFAULT NULL,
  `total_di` varchar(255) DEFAULT NULL,
  `st_di` smallint(255) DEFAULT NULL,
  PRIMARY KEY (`id_di`),
  KEY `fk_di_produk` (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `detail_invoice_tmp` */

/*Table structure for table `gudang` */

DROP TABLE IF EXISTS `gudang`;

CREATE TABLE `gudang` (
  `id_gudang` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `no_invoice` varchar(255) DEFAULT NULL,
  `jumlah_stok` int(11) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `up_gudang` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_gudang`),
  KEY `FK_RELATIONSHIP_7` (`id_user`),
  KEY `FK_RELATIONSHIP_8` (`id_produk`),
  CONSTRAINT `fk_gu_pro` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  CONSTRAINT `fk_gu_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `gudang` */

insert  into `gudang`(`id_gudang`,`id_user`,`id_produk`,`no_invoice`,`jumlah_stok`,`keterangan`,`up_gudang`) values 
(1,1,1,NULL,20,'Barang masuk','2019-08-09 17:47:05'),
(2,1,2,NULL,20,'Barang masuk','2019-08-09 17:47:14'),
(3,1,1,'19/08/09/001',3,'Barang keluar','2019-08-10 10:06:09'),
(4,1,2,'19/08/09/001',1,'Barang keluar','2019-08-10 10:06:25'),
(5,1,1,'19/08/10/002',2,'Barang keluar','2019-08-10 10:43:05'),
(6,1,1,'19/08/10/001',2,'Barang keluar','2019-08-10 10:43:39'),
(7,1,2,'19/08/10/003',1,'Barang keluar','2019-08-10 13:42:20'),
(8,1,2,'19/08/10/004',1,'Barang keluar','2019-08-10 13:42:22'),
(9,4,2,'19/08/10/005',2,'Barang keluar','2019-08-10 18:46:26');

/*Table structure for table `invoice` */

DROP TABLE IF EXISTS `invoice`;

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL AUTO_INCREMENT,
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
  `st_invoice` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_invoice`),
  KEY `fk_relationship_3` (`id_user`),
  CONSTRAINT `fk_in_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `invoice` */

insert  into `invoice`(`id_invoice`,`id_user`,`no_invoice`,`nm_invoice`,`alm_invoice`,`kota_invoice`,`byr_invoice`,`harga_invoice`,`diskon_invoice`,`tgl_invoice`,`status_bayar`,`st_invoice`) values 
(1,1,'19/08/09/001','Reni','Cangkring Sidokare','Sidoarjo','100000','85500','5','2019-08-09 17:49:00','Lunas','Proses kirim'),
(2,1,'19/08/10/001','Pelanggan','-','-','50000','40000','0','2019-08-10 10:39:53','Lunas','Proses kirim'),
(3,1,'19/08/10/002','Pelanggan','-','-','50000','40000','0','2019-08-10 10:42:41','Lunas','Proses kirim'),
(4,1,'19/08/10/003','Pelanggan','-','-','30000','30000','0','2019-08-10 11:13:47','Lunas','Proses kirim'),
(5,1,'19/08/10/004','Pelanggan','-','-','40000','30000','0','2019-08-10 11:17:09','Lunas','Proses kirim'),
(6,4,'19/08/10/005','Pelanggan','-','-','60000','60000','0','2019-08-10 18:45:55','Lunas','Proses kirim'),
(7,4,'19/08/11/001','Pelanggan','-','-','60000','60000','0','2019-08-11 12:47:32','Lunas','Proses Gudang');

/*Table structure for table `kategori_produk` */

DROP TABLE IF EXISTS `kategori_produk`;

CREATE TABLE `kategori_produk` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `nm_cat` varchar(100) DEFAULT NULL,
  `st_cat` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `kategori_produk` */

insert  into `kategori_produk`(`id_cat`,`nm_cat`,`st_cat`) values 
(1,'segi 4',1);

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_plg` int(11) NOT NULL AUTO_INCREMENT,
  `nm_plg` varchar(255) DEFAULT NULL,
  `alm_plg` varchar(255) DEFAULT NULL,
  `kota_plg` varchar(255) DEFAULT NULL,
  `st_plg` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id_plg`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_plg`,`nm_plg`,`alm_plg`,`kota_plg`,`st_plg`) values 
(1,'Pelanggan','-','-',1),
(2,'Reni','Cangkring Sidokare','Sidoarjo',1),
(3,'Rara','Cangkring Sidokare','Gresik',1);

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_cat` int(11) DEFAULT NULL,
  `nm_produk` varchar(255) DEFAULT NULL,
  `stok_produk` int(11) DEFAULT NULL,
  `beli_produk` varchar(255) DEFAULT NULL,
  `harga_produk` varchar(255) DEFAULT NULL,
  `ft_produk` varchar(255) DEFAULT NULL,
  `up_produk` timestamp NULL DEFAULT NULL,
  `st_produk` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `fk_relationship_1` (`id_cat`),
  KEY `fk_relationship_6` (`id_user`),
  CONSTRAINT `fk_pr_kp` FOREIGN KEY (`id_cat`) REFERENCES `kategori_produk` (`id_cat`),
  CONSTRAINT `fk_pr_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `produk` */

insert  into `produk`(`id_produk`,`id_user`,`id_cat`,`nm_produk`,`stok_produk`,`beli_produk`,`harga_produk`,`ft_produk`,`up_produk`,`st_produk`) values 
(1,1,1,'Saudi',13,'15000','20000','user.png','2019-08-10 10:43:39',1),
(2,4,1,'Diamond',15,'20000','30000','user.png','2019-08-10 18:46:26',1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_lvl` int(11) DEFAULT NULL,
  `name_user` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ft_user` varchar(255) DEFAULT NULL,
  `last_user` timestamp NULL DEFAULT NULL,
  `st_user` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_relationship_5` (`id_lvl`),
  CONSTRAINT `fk_relationship_5` FOREIGN KEY (`id_lvl`) REFERENCES `user_level` (`id_lvl`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`id_lvl`,`name_user`,`username`,`password`,`email`,`ft_user`,`last_user`,`st_user`) values 
(1,1,'Ririn','Admin','202cb962ac59075b964b07152d234b70',NULL,'user.png','2019-08-10 22:54:26',1),
(2,3,'Lilo','Kasir1','202446dd1d6028084426867365b0c7a1',NULL,'user.png','2019-07-27 11:15:42',1),
(3,3,'Jono','Kasir2','202cb962ac59075b964b07152d234b70','kasir@motto.co.id','user.png','2019-08-10 18:45:02',1),
(4,2,'Uzi','Sukses','202cb962ac59075b964b07152d234b70',NULL,'user.png','2019-08-10 18:22:07',1);

/*Table structure for table `user_level` */

DROP TABLE IF EXISTS `user_level`;

CREATE TABLE `user_level` (
  `id_lvl` int(11) NOT NULL AUTO_INCREMENT,
  `nm_lvl` varchar(50) DEFAULT NULL,
  `st_lvl` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id_lvl`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_level` */

insert  into `user_level`(`id_lvl`,`nm_lvl`,`st_lvl`) values 
(1,'admin',1),
(2,'kepalatoko',1),
(3,'kasir',1),
(4,'ahlu',1);

/*Table structure for table `harian` */

DROP TABLE IF EXISTS `harian`;

/*!50001 DROP VIEW IF EXISTS `harian` */;
/*!50001 DROP TABLE IF EXISTS `harian` */;

/*!50001 CREATE TABLE  `harian`(
 `no_invoice` varchar(255) ,
 `nm_invoice` varchar(255) ,
 `kota_invoice` varchar(255) ,
 `nm_produk` varchar(255) ,
 `qty_di` int(11) ,
 `total_di` varchar(255) ,
 `harga_invoice` varchar(255) ,
 `diskon_invoice` varchar(255) ,
 `tgl_invoice` timestamp 
)*/;

/*View structure for view harian */

/*!50001 DROP TABLE IF EXISTS `harian` */;
/*!50001 DROP VIEW IF EXISTS `harian` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harian` AS select `i`.`no_invoice` AS `no_invoice`,`i`.`nm_invoice` AS `nm_invoice`,`i`.`kota_invoice` AS `kota_invoice`,`p`.`nm_produk` AS `nm_produk`,`di`.`qty_di` AS `qty_di`,`di`.`total_di` AS `total_di`,`i`.`harga_invoice` AS `harga_invoice`,`i`.`diskon_invoice` AS `diskon_invoice`,`i`.`tgl_invoice` AS `tgl_invoice` from ((`detail_invoice` `di` join `invoice` `i` on((`i`.`id_invoice` = `di`.`id_invoice`))) join `produk` `p` on((`p`.`id_produk` = `di`.`id_produk`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
