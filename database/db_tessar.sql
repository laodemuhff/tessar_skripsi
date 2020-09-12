-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2020 at 03:35 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tessar`
--

-- --------------------------------------------------------

--
-- Table structure for table `agen`
--

CREATE TABLE `agen` (
  `id_agen` int(5) NOT NULL,
  `nama_agen` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `kuota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agen`
--

INSERT INTO `agen` (`id_agen`, `nama_agen`, `alamat`, `no_telp`, `kuota`) VALUES
(1, 'Agen A', 'Jl. Solo Jogja KM 5', '085675847567', 1000),
(2, 'Agen B', 'Jl. Solo Jogja', '085675847578', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_detail` int(5) NOT NULL,
  `kode_pembelian` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_gas` int(5) NOT NULL,
  `jumlah` int(15) NOT NULL,
  `harga_beli` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_detail`, `kode_pembelian`, `id_gas`, `jumlah`, `harga_beli`) VALUES
(2, 'PBL001', 1, 8, 16000),
(3, 'PBL001', 2, 4, 20000),
(4, 'PBL002', 1, 3, 10000),
(5, 'PBL003', 1, 3, 60000),
(6, 'PBL001', 2, 5, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(5) NOT NULL,
  `kode_penjualan` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_gas` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `harga_jual` double NOT NULL,
  `jumlah` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

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
(12, 'PNJ002', '1', 18000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_surat`
--

CREATE TABLE `detail_surat` (
  `id_detail` int(5) NOT NULL,
  `id_surat` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_agen` int(5) NOT NULL,
  `id_gas` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_surat`
--

INSERT INTO `detail_surat` (`id_detail`, `id_surat`, `id_agen`, `id_gas`, `jumlah`) VALUES
(2, 'SRT001', 1, 1, 50),
(3, 'SRT001', 1, 2, 70),
(4, 'SRT002', 1, 1, 60);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(5) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'Divisi Operasional'),
(2, 'Divisi Keuangan');

-- --------------------------------------------------------

--
-- Table structure for table `gas`
--

CREATE TABLE `gas` (
  `id_gas` int(5) NOT NULL,
  `ukuran` varchar(15) NOT NULL,
  `stok` int(5) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gas`
--

INSERT INTO `gas` (`id_gas`, `ukuran`, `stok`, `harga`) VALUES
(1, '1 Kg', 50, 18000),
(2, '2 Kg', 34, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `log_pembelian`
--

CREATE TABLE `log_pembelian` (
  `kode_pembelian` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_pembelian`
--

INSERT INTO `log_pembelian` (`kode_pembelian`, `tanggal`, `jam`, `id_user`) VALUES
('', '2020-08-22', '11:25:50', 1),
('PBL001', '2020-08-22', '12:39:05', 1),
('PBL001', '2020-08-22', '14:01:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_penjualan`
--

CREATE TABLE `log_penjualan` (
  `kode_penjualan` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_penjualan`
--

INSERT INTO `log_penjualan` (`kode_penjualan`, `tanggal`, `jam`, `id_user`) VALUES
('PNJ002', '2020-08-22', '14:22:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `kode_pembelian` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_user` int(5) NOT NULL,
  `kode_supplier` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `tgl_pembelian` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`kode_pembelian`, `id_user`, `kode_supplier`, `tgl_pembelian`) VALUES
('PBL001', 1, 'SPL001', '2020-07-15'),
('PBL002', 1, 'SPL001', '2020-07-20'),
('PBL003', 1, 'SPL001', '2020-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `kode_penjualan` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_user` int(5) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `jam` time NOT NULL,
  `id_agen` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`kode_penjualan`, `id_user`, `tgl_penjualan`, `jam`, `id_agen`) VALUES
('PNJ001', 5, '2020-07-19', '09:15:08', 1),
('PNJ002', 1, '2020-07-19', '09:25:44', 1),
('PNJ003', 1, '2020-07-19', '12:29:52', 1),
('PNJ004', 1, '2020-07-19', '14:48:24', 1),
('PNJ005', 1, '2021-07-19', '16:58:58', 1),
('PNJ006', 10, '2021-08-05', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supir`
--

CREATE TABLE `supir` (
  `id_supir` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supir`
--

INSERT INTO `supir` (`id_supir`, `nama`, `alamat`, `no_telp`, `tgl_lahir`) VALUES
('DRV001', 'Supir A', 'Jl. Solo Jogja KM 5', '08564231111', '2020-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kode_supplier` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `nama_supplier` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(15) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `no_telp`) VALUES
('SPL002', 'Supplier 2', 'Jl. Solo Jogja KM 6', '085675847599'),
('SPL001', 'Supplier 1', 'Jl. Solo Jogja', '085675847525');

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan`
--

CREATE TABLE `surat_jalan` (
  `id_surat` varchar(15) NOT NULL,
  `id_supir` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `biaya` double NOT NULL,
  `id_user` int(5) NOT NULL,
  `file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_jalan`
--

INSERT INTO `surat_jalan` (`id_surat`, `id_supir`, `tanggal`, `biaya`, `id_user`, `file`) VALUES
('SRT001', 'DRV001', '2020-09-01', 80000, 1, 'Mimi.PNG'),
('SRT002', 'DRV001', '2020-09-02', 50000, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `id_divisi` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `id_divisi`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@tskomputer.com', '08564537589', 'admin', 0),
(8, 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Petugas', 'petugas@gmail.com', '08567584759', 'petugas', 2),
(9, 'manajer', '69b731ea8f289cf16a192ce78a37b4f0', 'Manajer', 'manajer@gmail.com', '08567584753', 'manajer', 2),
(10, 'petugas2', 'ac5604a8b8504d4ff5b842480df02e91', 'Advin', 'advin@gmail.com', '08564231000', 'petugas', 1),
(11, 'manajer2', '7e6f1f107c3cd5cfd291a9b5b538fc3e', 'Anto', 'anto@gmail.com', '085675847567', 'manajer', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agen`
--
ALTER TABLE `agen`
  ADD PRIMARY KEY (`id_agen`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_surat`
--
ALTER TABLE `detail_surat`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `gas`
--
ALTER TABLE `gas`
  ADD PRIMARY KEY (`id_gas`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`kode_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kode_penjualan`);

--
-- Indexes for table `supir`
--
ALTER TABLE `supir`
  ADD PRIMARY KEY (`id_supir`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agen`
--
ALTER TABLE `agen`
  MODIFY `id_agen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_surat`
--
ALTER TABLE `detail_surat`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gas`
--
ALTER TABLE `gas`
  MODIFY `id_gas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
