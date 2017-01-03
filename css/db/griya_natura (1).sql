-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2016 at 07:34 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `griya_natura`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang_masuk`
--

CREATE TABLE IF NOT EXISTS `tbl_barang_masuk` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_item` varchar(8) NOT NULL,
  `stok` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `expired_date` date NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_jual` double NOT NULL,
  `id_supplier` varchar(10) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_barang_masuk`
--

INSERT INTO `tbl_barang_masuk` (`id_barang`, `kode_item`, `stok`, `tgl_masuk`, `expired_date`, `harga_beli`, `harga_jual`, `id_supplier`) VALUES
(1, 'MD0001  ', 3, '2015-12-23', '2016-02-12', 25000, 30000, 'SUP001 '),
(2, 'MD0001  ', 5, '2015-12-22', '2016-04-09', 20000, 0, 'SUP001 '),
(3, 'MD0001  ', 4, '2015-12-22', '2016-02-06', 23000, 0, 'SUP001 '),
(4, 'MD0001  ', 9, '2015-12-23', '2016-02-13', 30000, 0, 'SUP001 '),
(5, 'MD0001  ', 3, '2015-12-23', '2016-02-13', 3000, 0, 'SUP001 '),
(6, 'MD0001  ', 3, '2015-12-23', '2016-02-12', 2300, 0, 'SUP001 '),
(7, 'MD0001  ', 3, '2015-12-23', '2016-02-12', 3000, 0, 'SUP001 '),
(8, 'MD0001  ', 9, '2015-12-23', '2016-02-06', 2000, 0, 'SUP001 '),
(9, 'MD0001  ', 9, '2015-12-23', '2016-02-12', 26000, 31200, 'SUP001 '),
(10, 'MD0003  ', 30, '2015-12-25', '2016-04-09', 24000, 28800, 'SUP001 '),
(11, 'MD0001  ', 0, '2015-12-27', '2016-02-13', 42000, 50400, ''),
(12, 'MD0001  ', 40, '2015-12-27', '2016-04-09', 42000, 50400, 'SUP001 '),
(13, 'MD0005  ', 50, '2015-12-27', '2016-02-19', 10000, 12000, 'SUP001 ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_transaksi`
--

CREATE TABLE IF NOT EXISTS `tbl_detail_transaksi` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_trans` int(11) NOT NULL,
  `kode_item` varchar(8) NOT NULL,
  `jml_item` int(11) NOT NULL,
  `id_jasa` varchar(10) NOT NULL,
  `id_dokter` varchar(10) NOT NULL,
  `biaya_administrasi` double NOT NULL,
  `total_biaya` double NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_detail_transaksi`
--

INSERT INTO `tbl_detail_transaksi` (`id_detail`, `id_trans`, `kode_item`, `jml_item`, `id_jasa`, `id_dokter`, `biaya_administrasi`, `total_biaya`) VALUES
(1, 1, 'MD0005 ', 1, 'JS0002 ', 'DT001', 0, 42000),
(2, 1, '', 0, 'JS_001', 'DT001', 0, 0),
(3, 2, 'MD0005 ', 1, 'JS0002 ', 'DT001', 0, 42000),
(4, 2, '', 0, 'JS_001', 'DT001', 0, 30000),
(5, 3, 'MD0005 ', 1, 'JS0002 ', 'DT001', 0, 42000),
(6, 4, '', 0, 'JS0002 ', 'DT001', 0, 30000),
(8, 6, 'MD0005 ', 1, 'JS0002 ', 'DT001', 0, 42000),
(10, 6, 'MD0001 ', 1, 'JS0002 ', 'DT001', 0, 80400),
(12, 7, 'MD0005 ', 2, 'JS0002 ', 'DT001', 0, 42000),
(13, 10, 'MD0005 ', 2, 'JS0002 ', 'DT001', 0, 42000),
(14, 11, 'MD0005 ', 1, 'JS0002 ', 'DT001', 0, 42000),
(15, 12, 'MD0005 ', 2, 'JS0002 ', 'DT001', 0, 42000),
(16, 13, 'MD0005 ', 1, 'JS0002 ', 'DT001', 20000, 42000),
(17, 14, 'MD0005 ', 1, 'JS0002 ', 'DT001', 15000, 42000),
(18, 14, 'MD0001 ', 1, 'JS0002 ', 'DT001', 0, 80400),
(19, 15, '', 0, 'JS0002 ', 'DT001', 25000, 30000),
(20, 16, 'MD0001 ', 1, 'JS0002 ', 'DT001', 10000, 80400),
(21, 17, '', 0, 'JS0002 ', 'DT001', 12000, 30000),
(22, 18, 'MD0001 ', 1, 'JS0002 ', 'DT001', 20000, 80400);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokter`
--

CREATE TABLE IF NOT EXISTS `tbl_dokter` (
  `id_dokter` varchar(10) NOT NULL,
  `nama_dokter` varchar(50) NOT NULL,
  `spesialis` varchar(20) NOT NULL,
  PRIMARY KEY (`id_dokter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dokter`
--

INSERT INTO `tbl_dokter` (`id_dokter`, `nama_dokter`, `spesialis`) VALUES
('DT001', 'dr. Donny', 'Ginjal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history_report`
--

CREATE TABLE IF NOT EXISTS `tbl_history_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_history_report`
--

INSERT INTO `tbl_history_report` (`id`, `tgl_mulai`, `tgl_akhir`) VALUES
(1, '2015-12-27', '2015-12-28'),
(2, '2015-12-30', '2016-01-02'),
(3, '2015-12-27', '2016-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jasa`
--

CREATE TABLE IF NOT EXISTS `tbl_jasa` (
  `id_jasa` varchar(10) NOT NULL,
  `deskripsi` varchar(70) NOT NULL,
  `biaya` double NOT NULL,
  PRIMARY KEY (`id_jasa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jasa`
--

INSERT INTO `tbl_jasa` (`id_jasa`, `deskripsi`, `biaya`) VALUES
('JS0002 ', 'Avasin', 30000),
('JS_001', 'Cek kolesterol', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat`
--

CREATE TABLE IF NOT EXISTS `tbl_obat` (
  `kode_item` varchar(8) NOT NULL,
  `nama_item` varchar(50) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  PRIMARY KEY (`kode_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_obat`
--

INSERT INTO `tbl_obat` (`kode_item`, `nama_item`, `kategori`, `merk`, `stok`, `satuan`) VALUES
('MD0001 ', 'Paracetamol', 'umum', '', 25, 'botol'),
('MD0003 ', 'Amocilin', 'racikan', '', 0, 'kapsul'),
('MD0005 ', 'Antibiotik', 'umum', '', 15, 'kaplet'),
('MD0007 ', 'Cuka Apel', 'herbal', '', 0, 'botol'),
('MD0011 ', 'Jelly Gamat', 'herbal', '', 0, 'pices'),
('MD0012 ', 'Betadine', 'umum', '', 0, 'botol'),
('undefine', 'undefined', 'undefined', '', 0, 'undefined');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pasien`
--

CREATE TABLE IF NOT EXISTS `tbl_pasien` (
  `id_pasien` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pasien` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  PRIMARY KEY (`id_pasien`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`id_pasien`, `nama_pasien`, `alamat`, `no_telp`, `jenis_kelamin`) VALUES
(1, 'Farida', 'Ciputat', '753253846', 'P'),
(2, 'Lidya', 'Pamulang', '5324278', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE IF NOT EXISTS `tbl_supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id_supplier`, `nama_supplier`) VALUES
('SUP001 ', 'PT. Medika Nusantara');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE IF NOT EXISTS `tbl_transaksi` (
  `id_trans` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  PRIMARY KEY (`id_trans`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_trans`, `id_user`, `id_pasien`, `tgl_transaksi`) VALUES
(1, 1, 1, '2015-12-27'),
(2, 1, 2, '2015-12-27'),
(3, 1, 1, '2015-12-27'),
(4, 1, 2, '2015-12-27'),
(5, 1, 1, '2015-12-28'),
(6, 1, 2, '2015-12-28'),
(7, 1, 1, '2015-12-28'),
(8, 1, 2, '2016-01-02'),
(9, 1, 1, '2016-01-02'),
(10, 1, 2, '2016-01-02'),
(11, 1, 2, '2016-01-02'),
(12, 1, 1, '2016-01-02'),
(13, 1, 2, '2016-01-02'),
(14, 1, 1, '2016-01-02'),
(15, 1, 2, '2016-01-02'),
(16, 1, 1, '2016-01-02'),
(17, 1, 2, '2016-01-02'),
(18, 1, 1, '2016-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `fullname`, `username`, `password`, `level`) VALUES
(1, 'Farida Nurlaila', 'admin', 'admin123', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
