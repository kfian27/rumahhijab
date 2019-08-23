/*
 Navicat Premium Data Transfer

 Source Server         : pbsb_db
 Source Server Type    : MySQL
 Source Server Version : 100122
 Source Host           : localhost:3306
 Source Schema         : hijab

 Target Server Type    : MySQL
 Target Server Version : 100122
 File Encoding         : 65001

 Date: 23/08/2019 16:43:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for detail_invoice
-- ----------------------------
DROP TABLE IF EXISTS `detail_invoice`;
CREATE TABLE `detail_invoice`  (
  `id_di` int(11) NOT NULL AUTO_INCREMENT,
  `id_invoice` int(11) NULL DEFAULT NULL,
  `id_produk` int(255) NULL DEFAULT NULL,
  `harga_di` int(11) NULL DEFAULT NULL,
  `qty_di` int(11) NULL DEFAULT NULL,
  `total_di` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `st_di` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_di`) USING BTREE,
  INDEX `fk_di_produk`(`id_produk`) USING BTREE,
  INDEX `fk_di_invo`(`id_invoice`) USING BTREE,
  CONSTRAINT `fk_di_invo` FOREIGN KEY (`id_invoice`) REFERENCES `invoice` (`id_invoice`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_di_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of detail_invoice
-- ----------------------------
INSERT INTO `detail_invoice` VALUES (1, 1, 1, NULL, 3, '60000', 'kirim');
INSERT INTO `detail_invoice` VALUES (2, 1, 2, NULL, 1, '30000', 'kirim');
INSERT INTO `detail_invoice` VALUES (3, 2, 1, NULL, 2, '40000', 'kirim');
INSERT INTO `detail_invoice` VALUES (4, 3, 1, NULL, 2, '40000', 'kirim');
INSERT INTO `detail_invoice` VALUES (5, 4, 2, NULL, 1, '30000', 'kirim');
INSERT INTO `detail_invoice` VALUES (6, 5, 2, NULL, 1, '30000', 'kirim');
INSERT INTO `detail_invoice` VALUES (7, 6, 2, NULL, 2, '60000', 'kirim');
INSERT INTO `detail_invoice` VALUES (8, 7, 2, NULL, 2, '60000', 'kirim');
INSERT INTO `detail_invoice` VALUES (9, 8, 1, NULL, 4, '80000', 'kirim');
INSERT INTO `detail_invoice` VALUES (10, 9, 1, NULL, 2, '40000', 'kirim');
INSERT INTO `detail_invoice` VALUES (11, 10, 2, NULL, 3, '90000', 'kirim');
INSERT INTO `detail_invoice` VALUES (12, 11, 1, NULL, 1, '20000', 'kirim');
INSERT INTO `detail_invoice` VALUES (13, 11, 2, NULL, 1, '30000', 'kirim');
INSERT INTO `detail_invoice` VALUES (14, 12, 1, NULL, 2, '40000', 'kirim');
INSERT INTO `detail_invoice` VALUES (15, 13, 1, NULL, 4, '80000', 'kirim');
INSERT INTO `detail_invoice` VALUES (16, 13, 2, NULL, 2, '60000', 'kirim');
INSERT INTO `detail_invoice` VALUES (17, 14, 3, NULL, 2, '50000', 'kirim');
INSERT INTO `detail_invoice` VALUES (18, 15, 3, NULL, 2, '50000', 'kirim');
INSERT INTO `detail_invoice` VALUES (19, 15, 2, NULL, 1, '30000', 'kirim');
INSERT INTO `detail_invoice` VALUES (20, 16, 2, NULL, 2, '60000', 'kirim');
INSERT INTO `detail_invoice` VALUES (21, 17, 2, NULL, 2, '60000', 'kirim');
INSERT INTO `detail_invoice` VALUES (22, 17, 1, NULL, 1, '20000', 'kirim');
INSERT INTO `detail_invoice` VALUES (23, 18, 2, NULL, 2, '60000', 'kirim');
INSERT INTO `detail_invoice` VALUES (24, 19, 2, NULL, 1, '30000', 'kirim');
INSERT INTO `detail_invoice` VALUES (25, 20, 2, NULL, 1, '30000', 'kirim');
INSERT INTO `detail_invoice` VALUES (26, 21, 1, NULL, 2, '40000', 'kirim');
INSERT INTO `detail_invoice` VALUES (27, 22, 1, NULL, 6, '102000', 'kirim');
INSERT INTO `detail_invoice` VALUES (28, 22, 1, NULL, 4, '72000', 'kirim');
INSERT INTO `detail_invoice` VALUES (29, 22, 1, NULL, 20, '300000', 'kirim');
INSERT INTO `detail_invoice` VALUES (30, 22, 1, NULL, 11, '176000', 'kirim');
INSERT INTO `detail_invoice` VALUES (31, 22, 1, NULL, 2, '40000', 'kirim');
INSERT INTO `detail_invoice` VALUES (32, 23, 1, NULL, 3, '54000', 'kirim');
INSERT INTO `detail_invoice` VALUES (33, 23, 2, NULL, 3, '60000', 'kirim');
INSERT INTO `detail_invoice` VALUES (34, 24, 1, NULL, 2, '40000', 'kirim');
INSERT INTO `detail_invoice` VALUES (35, 25, 1, 18000, 3, '54000', 'kirim');
INSERT INTO `detail_invoice` VALUES (36, 25, 1, 16000, 10, '160000', 'kirim');
INSERT INTO `detail_invoice` VALUES (37, 26, 1, 18000, 4, '72000', 'kirim');

-- ----------------------------
-- Table structure for detail_invoice_tmp
-- ----------------------------
DROP TABLE IF EXISTS `detail_invoice_tmp`;
CREATE TABLE `detail_invoice_tmp`  (
  `id_di` int(11) NOT NULL AUTO_INCREMENT,
  `id_invoice` int(11) NULL DEFAULT NULL,
  `id_produk` int(255) NULL DEFAULT NULL,
  `harga_di` int(11) NULL DEFAULT NULL,
  `qty_di` int(11) NULL DEFAULT NULL,
  `total_di` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `st_di` smallint(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_di`) USING BTREE,
  INDEX `fk_di_produk`(`id_produk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for gudang
-- ----------------------------
DROP TABLE IF EXISTS `gudang`;
CREATE TABLE `gudang`  (
  `id_gudang` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `id_produk` int(11) NULL DEFAULT NULL,
  `no_invoice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlah_stok` int(11) NULL DEFAULT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `up_gudang` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_gudang`) USING BTREE,
  INDEX `FK_RELATIONSHIP_7`(`id_user`) USING BTREE,
  INDEX `FK_RELATIONSHIP_8`(`id_produk`) USING BTREE,
  CONSTRAINT `fk_gu_pro` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_gu_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of gudang
-- ----------------------------
INSERT INTO `gudang` VALUES (1, 1, 1, NULL, 20, 'Barang masuk', '2019-08-09 17:47:05');
INSERT INTO `gudang` VALUES (2, 1, 2, NULL, 20, 'Barang masuk', '2019-08-09 17:47:14');
INSERT INTO `gudang` VALUES (3, 1, 1, '19/08/09/001', 3, 'Barang keluar', '2019-08-10 10:06:09');
INSERT INTO `gudang` VALUES (4, 1, 2, '19/08/09/001', 1, 'Barang keluar', '2019-08-10 10:06:25');
INSERT INTO `gudang` VALUES (5, 1, 1, '19/08/10/002', 2, 'Barang keluar', '2019-08-10 10:43:05');
INSERT INTO `gudang` VALUES (6, 1, 1, '19/08/10/001', 2, 'Barang keluar', '2019-08-10 10:43:39');
INSERT INTO `gudang` VALUES (7, 1, 2, '19/08/10/003', 1, 'Barang keluar', '2019-08-10 13:42:20');
INSERT INTO `gudang` VALUES (8, 1, 2, '19/08/10/004', 1, 'Barang keluar', '2019-08-10 13:42:22');
INSERT INTO `gudang` VALUES (9, 4, 2, '19/08/10/005', 2, 'Barang keluar', '2019-08-10 18:46:26');
INSERT INTO `gudang` VALUES (10, 4, 2, '19/08/11/001', 2, 'Barang keluar', '2019-08-11 22:05:10');
INSERT INTO `gudang` VALUES (11, 4, 1, '19/08/11/002', 4, 'Barang keluar', '2019-08-11 22:05:12');
INSERT INTO `gudang` VALUES (12, 4, 1, NULL, 6, 'Barang masuk', '2019-08-11 22:11:56');
INSERT INTO `gudang` VALUES (13, 4, 1, '19/08/11/003', 2, 'Barang keluar', '2019-08-12 13:08:36');
INSERT INTO `gudang` VALUES (14, 4, 1, '19/08/12/002', 1, 'Barang keluar', '2019-08-12 13:08:38');
INSERT INTO `gudang` VALUES (15, 4, 2, '19/08/12/001', 3, 'Barang keluar', '2019-08-12 13:08:39');
INSERT INTO `gudang` VALUES (16, 4, 2, '19/08/12/002', 1, 'Barang keluar', '2019-08-12 13:08:41');
INSERT INTO `gudang` VALUES (17, 4, 2, NULL, 10, 'Barang masuk', '2019-08-12 13:49:01');
INSERT INTO `gudang` VALUES (18, 4, 1, '19/08/12/003', 2, 'Barang keluar', '2019-08-12 20:39:45');
INSERT INTO `gudang` VALUES (19, 4, 1, '19/08/14/001', 4, 'Barang keluar', '2019-08-14 15:08:48');
INSERT INTO `gudang` VALUES (20, 4, 2, '19/08/14/001', 2, 'Barang keluar', '2019-08-14 15:08:51');
INSERT INTO `gudang` VALUES (21, 4, 3, NULL, 20, 'Barang masuk', '2019-08-14 15:14:58');
INSERT INTO `gudang` VALUES (22, 4, 3, '19/08/14/002', 2, 'Barang keluar', '2019-08-14 15:16:09');
INSERT INTO `gudang` VALUES (23, 4, 1, '19/08/14/005', 1, 'Barang keluar', '2019-08-14 22:46:41');
INSERT INTO `gudang` VALUES (24, 4, 1, '19/08/14/009', 2, 'Barang keluar', '2019-08-14 22:46:43');
INSERT INTO `gudang` VALUES (25, 4, 2, '19/08/14/003', 1, 'Barang keluar', '2019-08-14 22:46:45');
INSERT INTO `gudang` VALUES (26, 4, 2, '19/08/14/004', 2, 'Barang keluar', '2019-08-14 22:46:47');
INSERT INTO `gudang` VALUES (27, 4, 2, '19/08/14/005', 2, 'Barang keluar', '2019-08-14 22:46:48');
INSERT INTO `gudang` VALUES (28, 4, 2, '19/08/14/006', 2, 'Barang keluar', '2019-08-14 22:46:51');
INSERT INTO `gudang` VALUES (29, 4, 2, '19/08/14/007', 1, 'Barang keluar', '2019-08-14 22:46:52');
INSERT INTO `gudang` VALUES (30, 4, 2, '19/08/14/008', 1, 'Barang keluar', '2019-08-14 22:46:54');
INSERT INTO `gudang` VALUES (31, 4, 3, '19/08/14/003', 2, 'Barang keluar', '2019-08-14 22:46:55');
INSERT INTO `gudang` VALUES (32, 4, 1, NULL, 100, 'Barang masuk', '2019-08-21 12:19:59');
INSERT INTO `gudang` VALUES (33, 4, 1, '19/08/21/001', 6, 'Barang keluar', '2019-08-21 13:10:32');
INSERT INTO `gudang` VALUES (34, 4, 1, '19/08/21/001', 4, 'Barang keluar', '2019-08-21 13:10:34');
INSERT INTO `gudang` VALUES (35, 4, 1, '19/08/21/001', 20, 'Barang keluar', '2019-08-21 13:10:36');
INSERT INTO `gudang` VALUES (36, 4, 1, '19/08/21/001', 11, 'Barang keluar', '2019-08-21 13:10:38');
INSERT INTO `gudang` VALUES (37, 4, 1, '19/08/21/001', 2, 'Barang keluar', '2019-08-21 13:10:44');
INSERT INTO `gudang` VALUES (38, 4, 1, '19/08/22/001', 3, 'Barang keluar', '2019-08-22 17:35:13');
INSERT INTO `gudang` VALUES (39, 4, 1, '19/08/22/002', 2, 'Barang keluar', '2019-08-22 17:35:16');
INSERT INTO `gudang` VALUES (40, 4, 2, '19/08/22/001', 3, 'Barang keluar', '2019-08-22 17:35:17');
INSERT INTO `gudang` VALUES (41, 4, 1, '19/08/22/003', 3, 'Barang keluar', '2019-08-22 19:09:03');
INSERT INTO `gudang` VALUES (42, 4, 1, '19/08/22/003', 10, 'Barang keluar', '2019-08-22 19:09:08');
INSERT INTO `gudang` VALUES (43, 4, 1, '19/08/22/004', 4, 'Barang keluar', '2019-08-22 19:18:10');

-- ----------------------------
-- Table structure for invoice
-- ----------------------------
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice`  (
  `id_invoice` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `no_invoice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nm_invoice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alm_invoice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kota_invoice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `byr_invoice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga_invoice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `diskon_invoice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tagihan_invoice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_invoice` timestamp(0) NULL DEFAULT NULL,
  `status_bayar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `st_invoice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_invoice`) USING BTREE,
  INDEX `fk_relationship_3`(`id_user`) USING BTREE,
  CONSTRAINT `fk_in_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of invoice
-- ----------------------------
INSERT INTO `invoice` VALUES (1, 1, '19/08/09/001', 'Reni', 'Cangkring Sidokare', 'Sidoarjo', '100000', '85500', '5', NULL, '2019-08-09 17:49:00', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (2, 1, '19/08/10/001', 'Pelanggan', '-', '-', '50000', '40000', '0', NULL, '2019-08-10 10:39:53', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (3, 1, '19/08/10/002', 'Pelanggan', '-', '-', '50000', '40000', '0', NULL, '2019-08-10 10:42:41', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (4, 1, '19/08/10/003', 'Pelanggan', '-', '-', '30000', '30000', '0', NULL, '2019-08-10 11:13:47', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (5, 1, '19/08/10/004', 'Pelanggan', '-', '-', '40000', '30000', '0', NULL, '2019-08-10 11:17:09', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (6, 4, '19/08/10/005', 'Pelanggan', '-', '-', '60000', '60000', '0', NULL, '2019-08-10 18:45:55', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (7, 4, '19/08/11/001', 'Pelanggan', '-', '-', '60000', '60000', '0', NULL, '2019-08-11 12:47:32', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (8, 4, '19/08/11/002', 'Pelanggan', '-', '-', '100000', '80000', '0', NULL, '2019-08-11 22:05:03', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (9, 4, '19/08/11/003', 'Pelanggan', '-', '-', '50000', '40000', '0', NULL, '2019-08-11 22:57:16', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (10, 4, '19/08/12/001', 'Pelanggan', '-', '-', '100000', '90000', '0', NULL, '2019-08-12 12:57:16', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (11, 4, '19/08/12/002', 'Pelanggan', '-', '-', '50000', '50000', '0', NULL, '2019-08-12 13:08:21', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (12, 4, '19/08/12/003', 'Pelanggan', '-', '-', '50000', '40000', '0', NULL, '2019-08-12 17:09:03', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (13, 4, '19/08/14/001', 'Pelanggan', '-', '-', '150000', '133000', '5', NULL, '2019-08-14 14:05:58', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (14, 4, '19/08/14/002', 'Pelanggan', '-', '-', '50000', '50000', '0', NULL, '2019-08-14 15:16:03', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (15, 3, '19/08/14/003', 'Pelanggan', '-', '-', '100000', '80000', '0', NULL, '2019-08-14 21:23:55', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (16, 3, '19/08/14/004', 'Pelanggan', '-', '-', '50000', '50000', '10000', NULL, '2019-08-14 21:24:41', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (17, 3, '19/08/14/005', 'Pelanggan', '-', '-', '100000', '80000', '0', NULL, '2019-08-14 22:15:56', '80000', 'Proses kirim');
INSERT INTO `invoice` VALUES (18, 3, '19/08/14/006', 'Pelanggan', '-', '-', '60000', '55000', '5000', NULL, '2019-08-14 22:23:23', '60000', 'Proses kirim');
INSERT INTO `invoice` VALUES (19, 3, '19/08/14/007', 'Pelanggan', '-', '-', '25000', '25000', '5000', '25000', '2019-08-14 22:28:40', '30000', 'Proses kirim');
INSERT INTO `invoice` VALUES (20, 3, '19/08/14/008', 'Pelanggan', '-', '-', '30000', '27000', '3000', '30000', '2019-08-14 22:32:09', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (21, 3, '19/08/14/009', 'Pelanggan', '-', '-', '50000', '30000', '10000', '40000', '2019-08-14 22:33:33', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (22, 4, '19/08/21/001', 'Pelanggan', '-', '-', '700000', '690000', '0', '690000', '2019-08-21 13:10:00', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (23, 4, '19/08/22/001', 'Pelanggan', '-', '-', '120000', '114000', '0', '114000', '2019-08-22 12:39:56', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (24, 4, '19/08/22/002', 'Pelanggan', '-', '-', '50000', '40000', '0', '40000', '2019-08-22 13:01:33', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (25, 4, '19/08/22/003', 'Pelanggan', '-', '-', '220000', '214000', '0', '214000', '2019-08-22 18:59:55', 'Lunas', 'Proses kirim');
INSERT INTO `invoice` VALUES (26, 4, '19/08/22/004', 'Pelanggan', '-', '-', '75000', '72000', '0', '72000', '2019-08-22 19:18:01', 'Lunas', 'Proses kirim');

-- ----------------------------
-- Table structure for kategori_produk
-- ----------------------------
DROP TABLE IF EXISTS `kategori_produk`;
CREATE TABLE `kategori_produk`  (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `nm_cat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `st_cat` smallint(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_cat`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kategori_produk
-- ----------------------------
INSERT INTO `kategori_produk` VALUES (1, 'Segi 4', 1);
INSERT INTO `kategori_produk` VALUES (2, 'Pasmina', 1);

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan`  (
  `id_plg` int(11) NOT NULL AUTO_INCREMENT,
  `nm_plg` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alm_plg` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kota_plg` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `st_plg` smallint(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_plg`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES (1, 'Pelanggan', '-', '-', 1);
INSERT INTO `pelanggan` VALUES (2, 'Reni', 'Cangkring Sidokare', 'Sidoarjo', 1);
INSERT INTO `pelanggan` VALUES (3, 'Rara', 'Cangkring Sidokare', 'Gresik', 1);
INSERT INTO `pelanggan` VALUES (4, 'Ririn', 'mmm', 'mmmm', 1);

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `id_cat` int(11) NULL DEFAULT NULL,
  `nm_produk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stok_produk` int(11) NULL DEFAULT NULL,
  `harga_produk` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga3_produk` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga6_produk` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga10_produk` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga20_produk` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ft_produk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `up_produk` timestamp(0) NULL DEFAULT NULL,
  `st_produk` smallint(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_produk`) USING BTREE,
  INDEX `fk_relationship_1`(`id_cat`) USING BTREE,
  INDEX `fk_relationship_6`(`id_user`) USING BTREE,
  CONSTRAINT `fk_pr_kp` FOREIGN KEY (`id_cat`) REFERENCES `kategori_produk` (`id_cat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_pr_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (1, 4, 1, 'Saudi', 38, '20000', '18000', '17000', '16000', '15000', 'user.png', '2019-08-22 19:18:10', 1);
INSERT INTO `produk` VALUES (2, 4, 1, 'Diamond', 5, '30000', '20000', NULL, NULL, NULL, 'user.png', '2019-08-22 17:35:17', 1);
INSERT INTO `produk` VALUES (3, 4, 2, 'Krudung Pasmina', 16, '25000', '18000', NULL, NULL, NULL, 'user.png', '2019-08-14 22:46:55', 1);
INSERT INTO `produk` VALUES (4, 4, 2, 'Pasmina Biasa', 0, '22000', '20000', '19000', '18000', '17000', 'user.png', '2019-08-18 19:10:06', 1);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_lvl` int(11) NULL DEFAULT NULL,
  `name_user` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ft_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_user` timestamp(0) NULL DEFAULT NULL,
  `st_user` smallint(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  INDEX `fk_relationship_5`(`id_lvl`) USING BTREE,
  CONSTRAINT `fk_relationship_5` FOREIGN KEY (`id_lvl`) REFERENCES `user_level` (`id_lvl`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 1, 'Ririn', 'Admin', '202cb962ac59075b964b07152d234b70', NULL, 'user.png', '2019-08-10 22:54:26', 1);
INSERT INTO `user` VALUES (2, 3, 'Lilo', 'Kasir1', '202446dd1d6028084426867365b0c7a1', NULL, 'user.png', '2019-07-27 11:15:42', 1);
INSERT INTO `user` VALUES (3, 3, 'Jono', 'Kasir2', '202cb962ac59075b964b07152d234b70', 'kasir@motto.co.id', 'user.png', '2019-08-18 19:08:08', 1);
INSERT INTO `user` VALUES (4, 2, 'Uzi', 'Sukses', '202cb962ac59075b964b07152d234b70', NULL, 'user.png', '2019-08-22 20:18:15', 1);

-- ----------------------------
-- Table structure for user_level
-- ----------------------------
DROP TABLE IF EXISTS `user_level`;
CREATE TABLE `user_level`  (
  `id_lvl` int(11) NOT NULL AUTO_INCREMENT,
  `nm_lvl` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `st_lvl` smallint(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_lvl`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_level
-- ----------------------------
INSERT INTO `user_level` VALUES (1, 'admin', 1);
INSERT INTO `user_level` VALUES (2, 'kepalatoko', 1);
INSERT INTO `user_level` VALUES (3, 'kasir', 1);

-- ----------------------------
-- View structure for harian
-- ----------------------------
DROP VIEW IF EXISTS `harian`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `harian` AS SELECT
	i.no_invoice AS no_invoice,
	i.nm_invoice AS nm_invoice,
	i.kota_invoice AS kota_invoice,
	p.nm_produk AS nm_produk,
	di.qty_di AS qty_di,
	di.total_di AS total_di,
	i.harga_invoice AS harga_invoice,
	i.diskon_invoice AS diskon_invoice,
	i.tgl_invoice AS tgl_invoice
FROM
	detail_invoice di
	JOIN invoice i ON i.id_invoice = di.id_invoice
	JOIN produk p ON p.id_produk = di.id_produk ;

-- ----------------------------
-- View structure for semua_pro_ke
-- ----------------------------
DROP VIEW IF EXISTS `semua_pro_ke`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `semua_pro_ke` AS SELECT SUM(jumlah_stok) AS totalkeluar from gudang WHERE keterangan LIKE '%keluar' ;

-- ----------------------------
-- View structure for semua_pro_ma
-- ----------------------------
DROP VIEW IF EXISTS `semua_pro_ma`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `semua_pro_ma` AS SELECT SUM(jumlah_stok) AS totalmasuk from gudang WHERE keterangan LIKE '%masuk' ;

SET FOREIGN_KEY_CHECKS = 1;
