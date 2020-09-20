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
CREATE DATABASE IF NOT EXISTS `db_tessar` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_tessar`;

-- Dumping structure for table db_tessar.agen
CREATE TABLE IF NOT EXISTS `agen` (
  `id_agen` int(5) NOT NULL AUTO_INCREMENT,
  `nama_agen` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `kuota` int(11) NOT NULL,
  PRIMARY KEY (`id_agen`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_tessar.agen: ~2 rows (approximately)
/*!40000 ALTER TABLE `agen` DISABLE KEYS */;
INSERT INTO `agen` (`id_agen`, `nama_agen`, `alamat`, `no_telp`, `kuota`) VALUES
	(1, 'Agen A', 'Jl. Solo Jogja KM 5', '085675847567', 1000),
	(2, 'Agen B', 'Jl. Solo Jogja', '085675847578', 1000),
	(5, 'Agen C', 'Makassar', '087712323123', 1000);
/*!40000 ALTER TABLE `agen` ENABLE KEYS */;

-- Dumping structure for table db_tessar.detail_pembelian
CREATE TABLE IF NOT EXISTS `detail_pembelian` (
  `id_detail` int(5) NOT NULL AUTO_INCREMENT,
  `kode_pembelian` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_gas` int(5) NOT NULL,
  `jumlah` int(15) NOT NULL,
  `harga_beli` double NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table db_tessar.detail_pembelian: 7 rows
/*!40000 ALTER TABLE `detail_pembelian` DISABLE KEYS */;
INSERT INTO `detail_pembelian` (`id_detail`, `kode_pembelian`, `id_gas`, `jumlah`, `harga_beli`) VALUES
	(2, 'PBL001', 1, 8, 16000),
	(3, 'PBL001', 2, 4, 20000),
	(4, 'PBL002', 1, 3, 10000),
	(5, 'PBL003', 1, 3, 60000),
	(6, 'PBL001', 2, 5, 60000),
	(10, 'PBL004', 2, 7, 30000),
	(11, 'PBL007', 1, 20, 5000);
/*!40000 ALTER TABLE `detail_pembelian` ENABLE KEYS */;

-- Dumping structure for table db_tessar.detail_penjualan
CREATE TABLE IF NOT EXISTS `detail_penjualan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kode_penjualan` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_gas` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `harga_jual` double NOT NULL,
  `jumlah` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table db_tessar.detail_penjualan: 12 rows
/*!40000 ALTER TABLE `detail_penjualan` DISABLE KEYS */;
INSERT INTO `detail_penjualan` (`id`, `kode_penjualan`, `id_gas`, `harga_jual`, `jumlah`) VALUES
	(1, 'PNJ001', '1', 20000, 1),
	(2, 'PNJ002', '2', 40000, 1),
	(3, 'PNJ002', '1', 75000, 2),
	(4, 'PNJ003', '1', 20000, 2),
	(5, 'PNJ004', '1', 20000, 1),
	(6, 'PNJ005', '2', 12500, 2),
	(10, 'PNJ002', '1', 18000, 3),
	(8, 'PNJ006', '1', 18000, 3),
	(11, 'PNJ002', '1', 18000, 2),
	(12, 'PNJ002', '1', 18000, 2),
	(13, 'PNJ007', '1', 18000, 500),
	(14, 'PNJ009', '2', 25000, 5);
/*!40000 ALTER TABLE `detail_penjualan` ENABLE KEYS */;

-- Dumping structure for table db_tessar.detail_surat
CREATE TABLE IF NOT EXISTS `detail_surat` (
  `id_detail` int(5) NOT NULL AUTO_INCREMENT,
  `id_surat` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_agen` int(5) NOT NULL,
  `id_gas` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table db_tessar.detail_surat: ~4 rows (approximately)
/*!40000 ALTER TABLE `detail_surat` DISABLE KEYS */;
INSERT INTO `detail_surat` (`id_detail`, `id_surat`, `id_agen`, `id_gas`, `jumlah`) VALUES
	(2, 'SRT001', 1, 1, 50),
	(3, 'SRT001', 1, 2, 70),
	(4, 'SRT002', 1, 1, 60),
	(5, 'SRT003', 1, 2, 99999),
	(6, 'SRT005', 1, 1, 60),
	(7, 'SRT005', 2, 1, 60),
	(8, 'SRT006', 1, 1, 100);
/*!40000 ALTER TABLE `detail_surat` ENABLE KEYS */;

-- Dumping structure for table db_tessar.divisi
CREATE TABLE IF NOT EXISTS `divisi` (
  `id_divisi` int(5) NOT NULL AUTO_INCREMENT,
  `nama_divisi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_tessar.divisi: ~2 rows (approximately)
/*!40000 ALTER TABLE `divisi` DISABLE KEYS */;
INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
	(1, 'Divisi Operasional'),
	(2, 'Divisi Keuangan');
/*!40000 ALTER TABLE `divisi` ENABLE KEYS */;

-- Dumping structure for table db_tessar.gas
CREATE TABLE IF NOT EXISTS `gas` (
  `id_gas` int(5) NOT NULL AUTO_INCREMENT,
  `ukuran` varchar(15) NOT NULL,
  `stok` int(5) NOT NULL,
  `harga` double NOT NULL,
  PRIMARY KEY (`id_gas`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_tessar.gas: ~2 rows (approximately)
/*!40000 ALTER TABLE `gas` DISABLE KEYS */;
INSERT INTO `gas` (`id_gas`, `ukuran`, `stok`, `harga`) VALUES
	(1, '1 Kg', -430, 18000),
	(2, '2 Kg', 29, 25000);
/*!40000 ALTER TABLE `gas` ENABLE KEYS */;

-- Dumping structure for table db_tessar.log_pembelian
CREATE TABLE IF NOT EXISTS `log_pembelian` (
  `kode_pembelian` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_tessar.log_pembelian: ~3 rows (approximately)
/*!40000 ALTER TABLE `log_pembelian` DISABLE KEYS */;
INSERT INTO `log_pembelian` (`kode_pembelian`, `tanggal`, `jam`, `id_user`) VALUES
	('', '2020-08-22', '11:25:50', 1),
	('PBL001', '2020-08-22', '12:39:05', 1),
	('PBL001', '2020-08-22', '14:01:20', 1);
/*!40000 ALTER TABLE `log_pembelian` ENABLE KEYS */;

-- Dumping structure for table db_tessar.log_penjualan
CREATE TABLE IF NOT EXISTS `log_penjualan` (
  `kode_penjualan` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_tessar.log_penjualan: ~0 rows (approximately)
/*!40000 ALTER TABLE `log_penjualan` DISABLE KEYS */;
INSERT INTO `log_penjualan` (`kode_penjualan`, `tanggal`, `jam`, `id_user`) VALUES
	('PNJ002', '2020-08-22', '14:22:44', 1);
/*!40000 ALTER TABLE `log_penjualan` ENABLE KEYS */;

-- Dumping structure for table db_tessar.pembelian
CREATE TABLE IF NOT EXISTS `pembelian` (
  `kode_pembelian` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_user` int(5) NOT NULL,
  `kode_supplier` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `tgl_pembelian` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_pembelian`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table db_tessar.pembelian: 7 rows
/*!40000 ALTER TABLE `pembelian` DISABLE KEYS */;
INSERT INTO `pembelian` (`kode_pembelian`, `id_user`, `kode_supplier`, `tgl_pembelian`) VALUES
	('PBL001', 1, 'SPL001', '2018-07-15 01:14:50'),
	('PBL002', 1, 'SPL001', '2020-07-20 08:00:00'),
	('PBL003', 1, 'SPL001', '2020-08-17 08:00:00'),
	('PBL004', 1, 'SPL002', '2020-09-13 08:00:00'),
	('PBL005', 8, 'SPL001', '2020-09-16 08:00:00'),
	('PBL006', 8, 'SPL001', '2020-09-16 08:00:00'),
	('PBL007', 8, 'SPL002', '2020-09-10 00:00:00'),
	('PBL008', 8, 'SPL003', '2020-09-04 00:00:00'),
	('PBL009', 8, 'SPL001', '2020-09-03 00:00:00');
/*!40000 ALTER TABLE `pembelian` ENABLE KEYS */;

-- Dumping structure for table db_tessar.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `kode_penjualan` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_user` int(5) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `jam` time NOT NULL,
  `id_agen` int(5) NOT NULL,
  PRIMARY KEY (`kode_penjualan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table db_tessar.penjualan: 9 rows
/*!40000 ALTER TABLE `penjualan` DISABLE KEYS */;
INSERT INTO `penjualan` (`kode_penjualan`, `id_user`, `tgl_penjualan`, `jam`, `id_agen`) VALUES
	('PNJ001', 5, '2020-07-19', '09:15:08', 1),
	('PNJ002', 1, '2020-07-19', '09:25:44', 1),
	('PNJ003', 1, '2020-07-19', '12:29:52', 1),
	('PNJ004', 1, '2020-07-19', '14:48:24', 1),
	('PNJ005', 1, '2020-07-19', '16:58:58', 2),
	('PNJ006', 10, '2020-08-05', '00:00:00', 2),
	('PNJ007', 10, '2020-09-16', '00:00:00', 1),
	('PNJ008', 10, '2020-09-09', '00:00:00', 1),
	('PNJ009', 10, '2020-09-15', '00:00:00', 1),
	('PNJ010', 1, '2020-09-20', '22:42:38', 1),
	('PNJ011', 10, '2020-09-03', '00:00:00', 1);
/*!40000 ALTER TABLE `penjualan` ENABLE KEYS */;

-- Dumping structure for table db_tessar.supir
CREATE TABLE IF NOT EXISTS `supir` (
  `id_supir` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  PRIMARY KEY (`id_supir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_tessar.supir: ~1 rows (approximately)
/*!40000 ALTER TABLE `supir` DISABLE KEYS */;
INSERT INTO `supir` (`id_supir`, `nama`, `alamat`, `no_telp`, `tgl_lahir`) VALUES
	('DRV001', 'Supir A', 'Jl. Solo Jogja KM 5', '08564231111', '2020-03-05');
/*!40000 ALTER TABLE `supir` ENABLE KEYS */;

-- Dumping structure for table db_tessar.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `kode_supplier` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `nama_supplier` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(15) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`kode_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table db_tessar.supplier: 2 rows
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `no_telp`) VALUES
	('SPL002', 'Supplier 2', 'Jl. Solo Jogja KM 6', '085675847599'),
	('SPL001', 'Supplier 1', 'Jl. Solo Jogja', '085675847525'),
	('SPL003', 'Supplier 3', 'Kaliurang', '08771233333');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;

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

-- Dumping data for table db_tessar.surat_jalan: ~4 rows (approximately)
/*!40000 ALTER TABLE `surat_jalan` DISABLE KEYS */;
INSERT INTO `surat_jalan` (`id_surat`, `id_supir`, `tanggal`, `biaya`, `id_user`, `file`, `status`) VALUES
	('SRT001', 'DRV001', '2020-09-01', 80000, 1, 'Mimi.PNG', 'pending'),
	('SRT002', 'DRV001', '2020-09-02', 50000, 1, '', 'pending'),
	('SRT003', 'DRV001', '2020-09-16', 20000, 8, '11775.pdf', 'confirmed'),
	('SRT004', 'DRV001', '2020-09-16', 999, 8, 'Goals Ratio Footaball Player (Only Forward).txt', 'confirmed'),
	('SRT005', 'DRV001', '2020-09-16', 12000, 10, 'Sistem Penilaian Ujian Essay Online Otomatis.pdf', 'confirmed'),
	('SRT006', 'DRV001', '2020-09-30', 70000, 10, '', 'pending');
/*!40000 ALTER TABLE `surat_jalan` ENABLE KEYS */;

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

-- Dumping data for table db_tessar.user: 7 rows
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `id_divisi`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@tskomputer.com', '08564537589', 'admin', 0),
	(8, 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Petugas', 'petugas@gmail.com', '08567584759', 'petugas', 2),
	(9, 'manajer', '69b731ea8f289cf16a192ce78a37b4f0', 'Manajer', 'manajer@gmail.com', '08567584753', 'manajer', 2),
	(10, 'petugas2', 'ac5604a8b8504d4ff5b842480df02e91', 'Advin', 'advin@gmail.com', '08564231000', 'petugas', 1),
	(11, 'manajer2', '7e6f1f107c3cd5cfd291a9b5b538fc3e', 'Anto', 'anto@gmail.com', '085675847567', 'manajer', 1),
	(12, 'admin2', '5f4dcc3b5aa765d61d8327deb882cf99', 'Administrator', 'admin2@tskomputer.com', '08777111222', 'admin', 0),
	(13, 'manager2', '5f4dcc3b5aa765d61d8327deb882cf99', 'agil', 'agil@gmail.com', '087172312333', 'manajer', 2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
