-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.31-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             10.2.0.5766
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_tessar
CREATE DATABASE IF NOT EXISTS `db_tessar2` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_tessar2`;

-- Dumping structure for table db_tessar.agen
CREATE TABLE IF NOT EXISTS `agen` (
  `id_agen` int(5) NOT NULL AUTO_INCREMENT,
  `nama_agen` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `kuota` int(11) NOT NULL,
  PRIMARY KEY (`id_agen`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.detail_pembelian
CREATE TABLE IF NOT EXISTS `detail_pembelian` (
  `id_detail` int(5) NOT NULL AUTO_INCREMENT,
  `kode_pembelian` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_gas` int(5) NOT NULL,
  `jumlah` int(15) NOT NULL,
  `harga_beli` double NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.detail_penjualan
CREATE TABLE IF NOT EXISTS `detail_penjualan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kode_penjualan` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_gas` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `harga_jual` double NOT NULL,
  `jumlah` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.detail_surat
CREATE TABLE IF NOT EXISTS `detail_surat` (
  `id_detail` int(5) NOT NULL AUTO_INCREMENT,
  `id_surat` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_agen` int(5) NOT NULL,
  `id_gas` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.divisi
CREATE TABLE IF NOT EXISTS `divisi` (
  `id_divisi` int(5) NOT NULL AUTO_INCREMENT,
  `nama_divisi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.gas
CREATE TABLE IF NOT EXISTS `gas` (
  `id_gas` int(5) NOT NULL AUTO_INCREMENT,
  `ukuran` varchar(15) NOT NULL,
  `stok` int(5) NOT NULL,
  `harga` double NOT NULL,
  PRIMARY KEY (`id_gas`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.log_pembelian
CREATE TABLE IF NOT EXISTS `log_pembelian` (
  `kode_pembelian` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.log_penjualan
CREATE TABLE IF NOT EXISTS `log_penjualan` (
  `kode_penjualan` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.pembelian
CREATE TABLE IF NOT EXISTS `pembelian` (
  `kode_pembelian` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_user` int(5) NOT NULL,
  `kode_supplier` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `tgl_pembelian` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_pembelian`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `kode_penjualan` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_user` int(5) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `jam` time NOT NULL,
  `id_agen` int(5) NOT NULL,
  PRIMARY KEY (`kode_penjualan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.supir
CREATE TABLE IF NOT EXISTS `supir` (
  `id_supir` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  PRIMARY KEY (`id_supir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `kode_supplier` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `nama_supplier` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(15) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`kode_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.surat_jalan
CREATE TABLE IF NOT EXISTS `surat_jalan` (
  `id_surat` varchar(15) NOT NULL,
  `id_supir` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `biaya` double NOT NULL,
  `id_user` int(5) NOT NULL,
  `file` varchar(50) NOT NULL,
  `status` enum('pending','confirmed') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_tessar.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `id_divisi` int(5) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
