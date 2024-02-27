-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 21. Oktober 2016 jam 18:00
-- Versi Server: 5.1.36
-- Versi PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbinventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_bbm`
--

CREATE TABLE IF NOT EXISTS `as_bbm` (
  `bbmID` int(11) NOT NULL AUTO_INCREMENT,
  `bbmFaktur` varchar(20) NOT NULL,
  `bbmNo` varchar(20) NOT NULL,
  `spbID` int(11) NOT NULL,
  `spbNo` varchar(20) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(100) NOT NULL,
  `supplierAddress` text NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `receiveDate` date NOT NULL,
  `orderDate` date NOT NULL,
  `needDate` date NOT NULL,
  `total` double NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`bbmID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data untuk tabel `as_bbm`
--

INSERT INTO `as_bbm` (`bbmID`, `bbmFaktur`, `bbmNo`, `spbID`, `spbNo`, `supplierID`, `supplierName`, `supplierAddress`, `staffID`, `staffName`, `receiveDate`, `orderDate`, `needDate`, `total`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(42, '20160714101755', 'BB000001', 11, 'PO000008', 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', 1, '00001 Web Administrator', '2016-07-14', '2016-01-07', '2016-01-07', 61862, '', '0000-00-00 00:00:00', 0, '2016-07-14 22:18:59', 1),
(45, '20160715051009', 'BB000002', 13, 'PO000009', 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', 1, '00001 Web Administrator', '2016-07-15', '2016-07-15', '2016-07-15', 118178, '', '0000-00-00 00:00:00', 0, '2016-07-15 17:10:43', 1),
(47, '20160715090224', 'BB000003', 15, 'PO000010', 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', 1, '00001 Web Administrator', '2016-07-15', '2016-07-15', '2016-07-15', 2145000, '', '0000-00-00 00:00:00', 0, '2016-07-15 21:03:16', 1),
(48, '20160716095652', 'BB000004', 16, 'PO000011', 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', 1, '00001 Web Administrator', '2016-07-16', '2016-07-16', '2016-07-16', 514800, '', '0000-00-00 00:00:00', 0, '2016-07-16 09:57:30', 1),
(50, '20160718045248', 'BB000005', 18, 'PO000012', 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 1, '00001 Web Administrator', '2016-05-31', '2016-05-30', '2016-05-31', 75000000, '', '0000-00-00 00:00:00', 0, '2016-07-18 04:53:55', 1),
(51, '20160718053030', 'BB000006', 19, 'PO000013', 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 1, '00001 Web Administrator', '2016-06-14', '2016-06-13', '2016-06-13', 77500000, '', '0000-00-00 00:00:00', 0, '2016-07-18 05:31:36', 1),
(52, '20160718053341', 'BB000007', 20, 'PO000014', 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 1, '00001 Web Administrator', '2016-07-18', '2016-06-27', '2016-06-28', 80000000, '', '0000-00-00 00:00:00', 0, '2016-07-18 05:34:28', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_brands`
--

CREATE TABLE IF NOT EXISTS `as_brands` (
  `brandID` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) NOT NULL,
  `status` char(1) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`brandID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `as_brands`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `as_buy_payments`
--

CREATE TABLE IF NOT EXISTS `as_buy_payments` (
  `paymentID` int(11) NOT NULL AUTO_INCREMENT,
  `paymentNo` varchar(20) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `invoiceNo` varchar(20) NOT NULL,
  `spbNo` varchar(20) NOT NULL,
  `paymentDate` date NOT NULL,
  `payType` char(1) NOT NULL,
  `bankNo` varchar(100) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `bankAC` varchar(100) NOT NULL,
  `effectiveDate` date NOT NULL,
  `total` double NOT NULL,
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(100) NOT NULL,
  `supplierAddress` text NOT NULL,
  `ref` varchar(100) NOT NULL,
  `note` text NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`paymentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data untuk tabel `as_buy_payments`
--

INSERT INTO `as_buy_payments` (`paymentID`, `paymentNo`, `invoiceID`, `invoiceNo`, `spbNo`, `paymentDate`, `payType`, `bankNo`, `bankName`, `bankAC`, `effectiveDate`, `total`, `supplierID`, `supplierName`, `supplierAddress`, `ref`, `note`, `staffID`, `staffName`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(4, 'PP000001', 14, 'TB000001', 'PO000004', '2014-12-09', '2', '1341520211', 'BCA', 'CV. ASFA Solution', '2014-12-09', 49.5, 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', 'TB000001.1', 'Telah dibayarkan sebesar USD 49,50 transfer ke BCA 1341520211 an CV. ASFA Solution', 1, '00001 Web Administrator', '2014-12-09 03:00:02', 1, '0000-00-00 00:00:00', 0),
(7, 'PP000002', 15, 'TB000002', 'PO000003', '2014-12-10', '2', '12382781710', 'Bank of China', 'Kwie Kie Ting', '2014-12-10', 20, 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', 'TB000002.1', '-', 1, '00001 Web Administrator', '2014-12-10 04:09:02', 1, '0000-00-00 00:00:00', 0),
(8, 'PP000003', 15, 'TB000002', 'PO000003', '2014-12-10', '1', '', '', '', '0000-00-00', 10.5, 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', 'TB000002.2', 'Pay to Alex Marbun, USD 10.5, cash', 1, '00001 Web Administrator', '2014-12-10 04:13:14', 1, '0000-00-00 00:00:00', 0),
(15, 'PP000004', 24, 'TB000003', 'PO000006', '2014-12-24', '4', '920121672', 'MANDIRI', 'MITRACOMM EKASARANA PT', '2014-12-31', 5000000, 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', '3010219201', 'Efektif per 31-12-2014', 1, '00001 Web Administrator', '2014-12-24 05:25:44', 1, '0000-00-00 00:00:00', 0),
(17, 'PP000006', 24, 'TB000003', 'PO000006', '2014-12-24', '1', '', '', '', '0000-00-00', 1250000, 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', '78689273892', 'TUNAI BY AGUNG PRAMONO', 1, '00001 Web Administrator', '2014-12-24 05:26:54', 1, '0000-00-00 00:00:00', 0),
(18, 'PP000007', 25, 'TB000004', 'PO000005', '2014-12-24', '2', '38727818781', 'BANK OF CHINA', '', '0000-00-00', 1000.99, 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', '787328372882', '', 1, '00001 Web Administrator', '2014-12-24 05:35:37', 1, '0000-00-00 00:00:00', 0),
(19, 'PP000008', 24, 'TB000003', 'PO000006', '2016-01-04', '2', '3740531645', 'BCA', 'Agus Saputra', '0000-00-00', 2000000, 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', '-', '-', 1, '00001 Web Administrator', '2016-01-04 18:58:10', 1, '0000-00-00 00:00:00', 0),
(20, 'PP000009', 27, 'TB000006', 'PO000008', '2016-01-07', '2', '3740531645', 'BCA', 'Agus Saputra', '0000-00-00', 50000, 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', '-', '-', 1, '00001 Web Administrator', '2016-01-07 18:11:44', 1, '0000-00-00 00:00:00', 0),
(21, 'PP000010', 28, 'TB000007', 'PO000009', '2016-07-15', '1', '', 'BRI', 'Adi', '0000-00-00', 118178, 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', '', '', 1, '00001 Web Administrator', '2016-07-15 19:58:56', 1, '0000-00-00 00:00:00', 0),
(22, 'PP000010', 28, 'TB000007', 'PO000009', '2016-07-15', '1', '', 'BRI', 'Adi', '0000-00-00', 118178, 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', '', '', 1, '00001 Web Administrator', '2016-07-15 19:58:58', 1, '0000-00-00 00:00:00', 0),
(23, 'PP000011', 29, 'TB000008', 'PO000010', '2016-07-15', '2', '12121212', 'BRI', 'Ali', '2016-07-15', 2000000, 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', '', '', 1, '00001 Web Administrator', '2016-07-15 21:06:06', 1, '0000-00-00 00:00:00', 0),
(25, 'PP000013', 29, 'TB000008', 'PO000010', '2016-07-15', '2', '', 'BRI', 'Ali', '2016-07-15', 359500, 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', '', '', 1, '00001 Web Administrator', '2016-07-15 21:08:11', 1, '0000-00-00 00:00:00', 0),
(26, 'PP000014', 30, 'TB000009', 'PO000011', '2016-07-16', '2', '12121212', 'BRI', 'Ali', '2016-07-16', 566280, 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', '', '', 1, '00001 Web Administrator', '2016-07-16 10:00:59', 1, '0000-00-00 00:00:00', 0),
(27, 'PP000015', 30, 'TB000009', 'PO000011', '2016-07-16', '', '', '', '', '0000-00-00', 0, 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', '', '', 1, '00001 Web Administrator', '2016-07-16 10:01:54', 1, '0000-00-00 00:00:00', 0),
(28, 'PP000016', 33, 'TB000012', 'PO000014', '2016-07-18', '1', '', '', '', '0000-00-00', 75000000, 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', '', 'kurang 5jt', 1, '00001 Web Administrator', '2016-07-18 05:59:43', 1, '0000-00-00 00:00:00', 0),
(29, 'PP000017', 31, 'TB000010', 'PO000012', '2016-07-18', '1', '', '', '', '0000-00-00', 80000000, 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', '', 'Lebih 5Jt', 1, '00001 Web Administrator', '2016-07-18 06:01:39', 1, '0000-00-00 00:00:00', 0),
(30, 'PP000018', 32, 'TB000011', 'PO000013', '2016-07-18', '1', '', '', '', '0000-00-00', 77000000, 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', '', '', 1, '00001 Web Administrator', '2016-07-18 06:02:48', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_buy_transactions`
--

CREATE TABLE IF NOT EXISTS `as_buy_transactions` (
  `invoiceID` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceNo` varchar(20) NOT NULL,
  `invoiceDate` date NOT NULL,
  `bbmNo` varchar(20) NOT NULL,
  `spbNo` varchar(20) NOT NULL,
  `paymentType` int(11) NOT NULL,
  `expiredPayment` date NOT NULL,
  `ppnType` int(11) NOT NULL,
  `ppn` double NOT NULL,
  `total` double NOT NULL,
  `basic` double NOT NULL,
  `discount` double NOT NULL,
  `grandtotal` double NOT NULL,
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(100) NOT NULL,
  `supplierAddress` text NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`invoiceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data untuk tabel `as_buy_transactions`
--

INSERT INTO `as_buy_transactions` (`invoiceID`, `invoiceNo`, `invoiceDate`, `bbmNo`, `spbNo`, `paymentType`, `expiredPayment`, `ppnType`, `ppn`, `total`, `basic`, `discount`, `grandtotal`, `supplierID`, `supplierName`, `supplierAddress`, `staffID`, `staffName`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(31, 'TB000010', '2016-07-18', 'BB000005', 'PO000012', 1, '0000-00-00', 2, 0, 75000000, 75000000, 0, 75000000, 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 1, '00001 Web Administrator', '2016-07-18 05:39:27', 1, '0000-00-00 00:00:00', 0),
(32, 'TB000011', '2016-07-18', 'BB000006', 'PO000013', 1, '0000-00-00', 2, 0, 77500000, 77500000, 0, 77500000, 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 1, '00001 Web Administrator', '2016-07-18 05:40:36', 1, '0000-00-00 00:00:00', 0),
(33, 'TB000012', '2016-07-18', 'BB000007', 'PO000014', 1, '0000-00-00', 2, 0, 80000000, 80000000, 0, 80000000, 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 1, '00001 Web Administrator', '2016-07-18 05:41:27', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_categories`
--

CREATE TABLE IF NOT EXISTS `as_categories` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) NOT NULL,
  `status` char(1) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `as_categories`
--

INSERT INTO `as_categories` (`categoryID`, `categoryName`, `status`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(5, 'BUKU', 'Y', '2016-07-14 21:32:39', 1, '2016-07-14 21:37:02', 1),
(6, 'TABLOID', 'Y', '2016-07-14 21:37:59', 1, '0000-00-00 00:00:00', 0),
(7, 'MAJALAH', 'Y', '2016-07-14 21:38:13', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_customers`
--

CREATE TABLE IF NOT EXISTS `as_customers` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `customerCode` varchar(10) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `contactPerson` varchar(100) NOT NULL,
  `address` varchar(160) NOT NULL,
  `address2` text NOT NULL,
  `village` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zipCode` int(5) NOT NULL,
  `province` varchar(100) NOT NULL,
  `phone1` varchar(50) NOT NULL,
  `phone2` varchar(20) NOT NULL,
  `phone3` varchar(20) NOT NULL,
  `fax1` varchar(20) NOT NULL,
  `fax2` varchar(20) NOT NULL,
  `fax3` varchar(20) NOT NULL,
  `phonecp1` varchar(20) NOT NULL,
  `phonecp2` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `limitBalance` int(11) NOT NULL,
  `balance` double NOT NULL,
  `disc1` int(11) NOT NULL,
  `disc2` int(11) NOT NULL,
  `disc3` int(11) NOT NULL,
  `note` text NOT NULL,
  `npwp` varchar(20) NOT NULL,
  `pkpName` varchar(100) NOT NULL,
  `staffCode` varchar(20) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data untuk tabel `as_customers`
--

INSERT INTO `as_customers` (`customerID`, `customerCode`, `customerName`, `contactPerson`, `address`, `address2`, `village`, `district`, `city`, `zipCode`, `province`, `phone1`, `phone2`, `phone3`, `fax1`, `fax2`, `fax3`, `phonecp1`, `phonecp2`, `email`, `limitBalance`, `balance`, `disc1`, `disc2`, `disc3`, `note`, `npwp`, `pkpName`, `staffCode`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(26, 'KA000001', 'Toko Buku Toga Mas', 'Kaswadi', 'Dago', 'Bandung', 'Bandung', 'Bandung', 'Bandung', 13000, 'Jawa Barat', '022899999', '', '', '0229999', '', '', '081282357550', '081882356777', 'kas250173@gmail.com', 500000, 0, 10, 0, 0, '', '121212131', 'Toga mas', 'SA000001', '2016-07-15 21:17:56', 1, '0000-00-00 00:00:00', 0),
(27, 'T001', 'Ihsan', 'Ihsan', 'Depok', '', 'Depok', 'Depok', 'Depok', 0, 'Jabar', '084567891234', '', '', '', '', '', '08567891234', '', 'ihsan@gmail.com', 0, 0, 0, 0, 0, '', '', '', '', '2016-07-17 18:54:25', 1, '2016-07-17 20:10:52', 1),
(28, 'T002', 'Labib', '', 'Jakarta', '', 'Jakarta', '', 'Jakarta', 0, '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '2016-07-17 20:06:59', 1, '2016-07-17 21:48:24', 1),
(29, 'T003', 'Abu Hamzah', '', 'Karawang', '', 'Karawang', '', 'Karawang', 0, 'Jabar', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '2016-07-17 20:09:19', 1, '2016-07-17 20:11:19', 1),
(30, 'T004', 'Rahmat Nur', '', 'Tangerang', '', 'Tangerang', '', 'Tangerang', 0, '', '', '', '', '', '', '', '', '', '', 0, 0, 50, 0, 0, '', '', '', '', '2016-07-17 20:10:34', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_debts`
--

CREATE TABLE IF NOT EXISTS `as_debts` (
  `debtID` int(11) NOT NULL AUTO_INCREMENT,
  `debtNo` varchar(20) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `invoiceNo` varchar(20) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(100) NOT NULL,
  `supplierAddress` text NOT NULL,
  `debtTotal` double NOT NULL,
  `incomingTotal` double NOT NULL,
  `reductionTotal` double NOT NULL,
  `status` char(1) NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`debtID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `as_debts`
--

INSERT INTO `as_debts` (`debtID`, `debtNo`, `invoiceID`, `invoiceNo`, `supplierID`, `supplierName`, `supplierAddress`, `debtTotal`, `incomingTotal`, `reductionTotal`, `status`, `staffID`, `staffName`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(13, 'DB000008', 31, 'TB000010', 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 75000000, 80000000, 0, '1', 1, '00001 Web Administrator', '2016-07-18 05:39:27', 1, '0000-00-00 00:00:00', 0),
(14, 'DB000009', 32, 'TB000011', 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 77500000, 77000000, 0, '1', 1, '00001 Web Administrator', '2016-07-18 05:40:36', 1, '0000-00-00 00:00:00', 0),
(15, 'DB000010', 33, 'TB000012', 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 80000000, 75000000, 0, '1', 1, '00001 Web Administrator', '2016-07-18 05:41:27', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_delivery_order`
--

CREATE TABLE IF NOT EXISTS `as_delivery_order` (
  `doID` int(11) NOT NULL AUTO_INCREMENT,
  `doNo` varchar(20) NOT NULL,
  `doFaktur` varchar(20) NOT NULL,
  `soID` int(11) NOT NULL,
  `soNo` varchar(20) NOT NULL,
  `customerID` int(11) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `customerAddress` text NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `deliveredDate` date NOT NULL,
  `orderDate` date NOT NULL,
  `needDate` date NOT NULL,
  `total` double NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`doID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data untuk tabel `as_delivery_order`
--

INSERT INTO `as_delivery_order` (`doID`, `doNo`, `doFaktur`, `soID`, `soNo`, `customerID`, `customerName`, `customerAddress`, `staffID`, `staffName`, `deliveredDate`, `orderDate`, `needDate`, `total`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(4, 'DO000001', '20141212041206', 2, 'SO000001', 5, '00005 BUDI KARYA, BANDUNG', 'BANCEUY NO.104 BANDUNG, 40111', 1, '00001 Web Administrator', '2014-12-12', '2014-12-12', '2014-12-17', 1922000, '000005 Tidak sesuai dengan jumlah order', '0000-00-00 00:00:00', 0, '2014-12-12 04:12:50', 1),
(7, 'DO000002', '20141213115516', 5, 'SO000002', 20, '00020 ADI JAYA TEHNIK,JATIBARANG', 'ARIODINOTO NO.10 INDRAMAYU', 1, '00001 Web Administrator', '2014-12-13', '2014-12-12', '2014-12-19', 5468000, '', '0000-00-00 00:00:00', 0, '2014-12-13 11:55:46', 1),
(9, 'DO000003', '20141225125403', 6, 'SO000003', 4, '00004 AMAN JAYA, BANDUNG', 'GURAME NO.15 BANDUNG, 40262', 1, '00001 Web Administrator', '2014-12-25', '2014-12-25', '2014-12-25', 4217000, '', '0000-00-00 00:00:00', 0, '2014-12-25 00:54:48', 1),
(11, 'DO000004', '20160105025610', 8, 'SO000004', 23, '00023 SUMBER TEHNIK,CIREBON', 'GUNUNG SARI NO.12G-12 CIREBON,45131', 1, '00001 Web Administrator', '2016-01-05', '2016-01-04', '2016-01-04', 124000, '', '0000-00-00 00:00:00', 0, '2016-01-05 14:56:43', 1),
(13, 'DO000005', '20160108044455', 9, 'SO000005', 5, '00005 BUDI KARYA, BANDUNG', 'BANCEUY NO.104 BANDUNG, 40111', 1, '00001 Web Administrator', '2016-01-08', '2016-01-08', '2016-01-08', 242000, '-', '0000-00-00 00:00:00', 0, '2016-01-08 16:45:21', 1),
(14, 'DO000006', '20160715091907', 11, 'SO000006', 26, 'KA000001 Toko Buku Toga Mas', 'Dago Bandung', 1, '00001 Web Administrator', '2016-07-15', '2016-07-15', '2016-07-15', 4290000, '', '0000-00-00 00:00:00', 0, '2016-07-15 21:19:47', 1),
(26, 'DO000007', '20160718070708', 17, 'SO000007', 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', '2016-07-18', '2016-05-30', '2016-06-03', 0, '', '0000-00-00 00:00:00', 0, '2016-07-18 19:07:41', 1),
(27, 'DO000008', '20160718084013', 18, 'SO000008', 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', '2016-07-18', '2016-06-13', '2016-06-17', 36000000, '', '0000-00-00 00:00:00', 0, '2016-07-18 20:41:10', 1),
(28, 'DO000009', '20160718084211', 19, 'SO000009', 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', '2016-07-18', '2016-06-27', '2016-07-01', 36000000, '', '0000-00-00 00:00:00', 0, '2016-07-18 20:42:55', 1),
(32, 'DO000010', '20160718090520', 24, 'SO000010', 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', '2016-07-18', '2016-05-30', '2016-05-31', 31600000, '', '0000-00-00 00:00:00', 0, '2016-07-18 21:06:07', 1),
(33, 'DO000011', '20160727095406', 0, '', 0, '', '', 1, '00001 Web Administrator', '2016-07-27', '0000-00-00', '0000-00-00', 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(34, 'DO000012', '20160727095719', 0, '', 0, '', '', 1, '00001 Web Administrator', '2016-07-27', '0000-00-00', '0000-00-00', 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(35, 'DO000013', '20160727102912', 0, '', 0, '', '', 1, '00001 Web Administrator', '2016-07-27', '0000-00-00', '0000-00-00', 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(36, 'DO000014', '20160727103721', 25, 'SO000011', 0, '', '', 1, '00001 Web Administrator', '2016-07-27', '2016-07-27', '2016-07-27', 0, '', '0000-00-00 00:00:00', 0, '2016-07-27 10:37:58', 1),
(38, 'DO000015', '20160727104204', 30, 'SO000011', 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', '2016-07-27', '2016-07-27', '2016-07-27', 75000, '', '0000-00-00 00:00:00', 0, '2016-07-27 10:42:39', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_detail_bbm`
--

CREATE TABLE IF NOT EXISTS `as_detail_bbm` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `bbmNo` varchar(20) NOT NULL,
  `bbmFaktur` varchar(20) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `receiveQty` int(11) NOT NULL,
  `receiveStatus` char(1) NOT NULL,
  `factoryID` int(11) NOT NULL,
  `factoryName` varchar(100) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`detailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data untuk tabel `as_detail_bbm`
--

INSERT INTO `as_detail_bbm` (`detailID`, `bbmNo`, `bbmFaktur`, `productID`, `productName`, `price`, `qty`, `receiveQty`, `receiveStatus`, `factoryID`, `factoryName`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(46, 'BB000001', '20160714101755', 5, '00005 CYL HEAD GASKET', 2773, 10, 1, 'Y', 1, '00001 GUDANG A', '-', '2016-07-14 22:18:59', 1, '0000-00-00 00:00:00', 0),
(47, 'BB000001', '20160714101755', 1, '00001 CAMSH.TIMING GEAR', 59089, 1, 1, 'Y', 1, '00001 GUDANG A', '', '2016-07-14 22:18:59', 1, '0000-00-00 00:00:00', 0),
(48, 'BB000002', '20160715051009', 1, '00001 CAMSH.TIMING GEAR', 59089, 2, 2, 'Y', 1, '00001 GUDANG A', '', '2016-07-15 17:10:43', 1, '0000-00-00 00:00:00', 0),
(49, 'BB000003', '20160715090224', 17, '00001 Teori Bahasa dan Otomata', 42900, 50, 50, 'Y', 1, '00001 GUDANG A', '', '2016-07-15 21:03:16', 1, '0000-00-00 00:00:00', 0),
(50, 'BB000004', '20160716095652', 17, '00001 Teori Bahasa dan Otomata', 42900, 12, 12, 'Y', 1, '00001 GUDANG A', '', '2016-07-16 09:57:30', 1, '0000-00-00 00:00:00', 0),
(51, 'BB000005', '20160718045248', 25, '00008 MU 175', 2500, 30000, 30000, 'Y', 3, '00003 GUDANG C', '', '2016-07-18 04:53:55', 1, '0000-00-00 00:00:00', 0),
(52, 'BB000006', '20160718053030', 26, '00009 MU 176', 2500, 31000, 31000, 'Y', 3, '00003 GUDANG C', '', '2016-07-18 05:31:36', 1, '0000-00-00 00:00:00', 0),
(53, 'BB000007', '20160718053341', 27, '00010 MU 177', 2500, 32000, 32000, 'Y', 3, '00003 GUDANG C', '', '2016-07-18 05:34:28', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_detail_do`
--

CREATE TABLE IF NOT EXISTS `as_detail_do` (
  `doID` int(11) NOT NULL AUTO_INCREMENT,
  `doNo` varchar(20) NOT NULL,
  `doFaktur` varchar(20) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `deliveredQty` int(11) NOT NULL,
  `deliveredStatus` char(1) NOT NULL,
  `factoryID` int(11) NOT NULL,
  `factoryName` varchar(100) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`doID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data untuk tabel `as_detail_do`
--

INSERT INTO `as_detail_do` (`doID`, `doNo`, `doFaktur`, `productID`, `productName`, `price`, `qty`, `deliveredQty`, `deliveredStatus`, `factoryID`, `factoryName`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(3, 'DO000001', '20141212041206', 5, '00005 CYL HEAD GASKET', 5100, 90, 20, 'Y', 1, '00001 GUDANG A', 'For Diesel', '2014-12-12 04:12:50', 1, '0000-00-00 00:00:00', 0),
(4, 'DO000001', '20141212041206', 6, '00006 MAIN BEARING 00', 28000, 95, 65, 'Y', 1, '00001 GUDANG A', 'Diesel', '2014-12-12 04:12:50', 1, '0000-00-00 00:00:00', 0),
(9, 'DO000002', '20141213115516', 1, '00001 CAMSH.TIMING GEAR', 95000, 50, 50, 'Y', 2, '00002 GUDANG B', '', '2014-12-13 11:55:46', 1, '0000-00-00 00:00:00', 0),
(10, 'DO000002', '20141213115516', 2, '00002 CAMSHAFT', 143000, 4, 4, 'Y', 1, '00001 GUDANG A', '', '2014-12-13 11:55:46', 1, '0000-00-00 00:00:00', 0),
(11, 'DO000002', '20141213115516', 6, '00006 MAIN BEARING 00', 36500, 4, 4, 'Y', 1, '00001 GUDANG A', '', '2014-12-13 11:55:46', 1, '0000-00-00 00:00:00', 0),
(12, 'DO000003', '20141225125403', 4, '00004 OIL FILTER CAP', 2000, 40, 40, 'Y', 1, '00001 GUDANG A', '', '2014-12-25 00:54:48', 1, '0000-00-00 00:00:00', 0),
(13, 'DO000003', '20141225125403', 6, '00006 MAIN BEARING 00', 36000, 12, 12, 'Y', 1, '00001 GUDANG A', '', '2014-12-25 00:54:48', 1, '0000-00-00 00:00:00', 0),
(14, 'DO000003', '20141225125403', 2, '00002 CAMSHAFT', 143000, 10, 10, 'Y', 1, '00001 GUDANG A', '', '2014-12-25 00:54:48', 1, '0000-00-00 00:00:00', 0),
(15, 'DO000003', '20141225125403', 7, '00007 CRANKCASE COVER', 455000, 5, 5, 'Y', 1, '00001 GUDANG A', '', '2014-12-25 00:54:48', 1, '0000-00-00 00:00:00', 0),
(16, 'DO000004', '20160105025610', 4, '00004 OIL FILTER CAP', 2000, 5, 5, 'Y', 1, '00001 GUDANG A', '-', '2016-01-05 14:56:43', 1, '0000-00-00 00:00:00', 0),
(17, 'DO000004', '20160105025610', 6, '00006 MAIN BEARING 00', 36000, 3, 3, 'Y', 1, '00001 GUDANG A', '', '2016-01-05 14:56:43', 1, '0000-00-00 00:00:00', 0),
(18, 'DO000004', '20160105025610', 5, '00005 CYL HEAD GASKET', 6000, 1, 1, 'Y', 1, '00001 GUDANG A', '-', '2016-01-05 14:56:43', 1, '0000-00-00 00:00:00', 0),
(21, 'DO000005', '20160108044455', 5, '00005 CYL HEAD GASKET', 5100, 20, 20, 'Y', 1, '00001 GUDANG A', '-', '2016-01-08 16:45:21', 1, '0000-00-00 00:00:00', 0),
(22, 'DO000005', '20160108044455', 6, '00006 MAIN BEARING 00', 28000, 5, 5, 'Y', 1, '00001 GUDANG A', '-', '2016-01-08 16:45:21', 1, '0000-00-00 00:00:00', 0),
(23, 'DO000006', '20160715091907', 17, '00001 Teori Bahasa dan Otomata', 42900, 100, 100, 'Y', 1, '00001 GUDANG A', '', '2016-07-15 21:19:47', 1, '0000-00-00 00:00:00', 0),
(24, 'DO000007', '20160718070708', 25, '00008 MU 175', 4000, 9000, 0, 'Y', 3, '00003 GUDANG C', '', '2016-07-18 19:07:41', 1, '0000-00-00 00:00:00', 0),
(25, 'DO000008', '20160718084013', 26, '00009 MU 176', 4000, 9500, 9000, 'Y', 3, '00003 GUDANG C', '', '2016-07-18 20:41:10', 1, '0000-00-00 00:00:00', 0),
(26, 'DO000009', '20160718084211', 27, '00010 MU 177', 4000, 10000, 9000, 'Y', 3, '00003 GUDANG C', '', '2016-07-18 20:42:55', 1, '0000-00-00 00:00:00', 0),
(27, 'DO000010', '20160718090520', 25, '00008 MU 175', 4000, 8000, 7900, 'Y', 3, '00003 GUDANG C', '', '2016-07-18 21:06:07', 1, '0000-00-00 00:00:00', 0),
(28, 'DO000015', '20160727104204', 19, '00002 Al Waie 201', 7500, 10, 10, 'Y', 1, '00001 GUDANG A', '', '2016-07-27 10:42:39', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_detail_retur_staffs`
--

CREATE TABLE IF NOT EXISTS `as_detail_retur_staffs` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `returID` int(11) NOT NULL,
  `returNo` varchar(20) NOT NULL,
  `factoryID` int(11) NOT NULL,
  `factoryName` varchar(100) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `unitPrice` double NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`detailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `as_detail_retur_staffs`
--

INSERT INTO `as_detail_retur_staffs` (`detailID`, `returID`, `returNo`, `factoryID`, `factoryName`, `productID`, `productName`, `qty`, `unitPrice`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(1, 1, 'RJ000001', 1, '00001 GUDANG A', 5, '00005 CYL HEAD GASKET', 2, 5100, 'Cacat produk', '2014-12-19 00:42:54', 1, '0000-00-00 00:00:00', 0),
(2, 1, 'RJ000001', 1, '00001 GUDANG A', 6, '00006 MAIN BEARING 00', 3, 28000, 'Cacat produk', '2014-12-19 00:42:54', 1, '0000-00-00 00:00:00', 0),
(5, 3, 'RJ000002', 2, '00002 GUDANG B', 1, '00001 CAMSH.TIMING GEAR', 3, 95000, 'Cacat produk', '2014-12-19 00:49:53', 1, '0000-00-00 00:00:00', 0),
(6, 3, 'RJ000002', 1, '00001 GUDANG A', 6, '00006 MAIN BEARING 00', 1, 36500, 'Rusak', '2014-12-19 00:49:53', 1, '0000-00-00 00:00:00', 0),
(7, 4, 'RJ000003', 1, '00001 GUDANG A', 4, '00004 OIL FILTER CAP', 1, 2000, 'Cacat', '2016-01-11 15:58:06', 1, '0000-00-00 00:00:00', 0),
(8, 4, 'RJ000003', 1, '00001 GUDANG A', 6, '00006 MAIN BEARING 00', 1, 36000, 'Cacat', '2016-01-11 15:58:06', 1, '0000-00-00 00:00:00', 0),
(9, 4, 'RJ000003', 1, '00001 GUDANG A', 2, '00002 CAMSHAFT', 2, 143000, 'Cacat', '2016-01-11 15:58:06', 1, '0000-00-00 00:00:00', 0),
(10, 4, 'RJ000003', 1, '00001 GUDANG A', 7, '00007 CRANKCASE COVER', 1, 455000, 'Cacat', '2016-01-11 15:58:06', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_detail_retur_suppliers`
--

CREATE TABLE IF NOT EXISTS `as_detail_retur_suppliers` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `returID` int(11) NOT NULL,
  `returNo` varchar(20) NOT NULL,
  `factoryID` int(11) NOT NULL,
  `factoryName` varchar(100) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `unitPrice` double NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`detailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data untuk tabel `as_detail_retur_suppliers`
--

INSERT INTO `as_detail_retur_suppliers` (`detailID`, `returID`, `returNo`, `factoryID`, `factoryName`, `productID`, `productName`, `qty`, `unitPrice`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(8, 9, 'RB000001', 1, '00001 GUDANG A', 11, '00011 EXHAUST VALVE', 7, 1.13, 'Cacat produk', '2014-12-18 04:16:00', 1, '0000-00-00 00:00:00', 0),
(39, 30, 'RB000002', 4, '00004 GUDANG D', 8, '00008 COTTER (1 VALVE)', 10, 2050.03, 'Cacat produk', '2014-12-18 05:36:27', 1, '0000-00-00 00:00:00', 0),
(40, 30, 'RB000002', 4, '00004 GUDANG D', 5, '00005 CYL HEAD GASKET', 4, 2773.57, 'Rusak', '2014-12-18 05:36:27', 1, '0000-00-00 00:00:00', 0),
(41, 31, 'RB000003', 1, '00001 GUDANG A', 2, '00002 CAMSHAFT', 10, 63750, 'Cacat produk', '2014-12-18 05:39:04', 1, '0000-00-00 00:00:00', 0),
(42, 31, 'RB000003', 1, '00001 GUDANG A', 6, '00006 MAIN BEARING 00', 1, 8550, 'Cacat produk', '2014-12-18 05:39:04', 1, '0000-00-00 00:00:00', 0),
(43, 31, 'RB000003', 1, '00001 GUDANG A', 3, '00003 NOZZLE', 2, 72320, 'Rusak', '2014-12-18 05:39:04', 1, '0000-00-00 00:00:00', 0),
(44, 32, 'RB000004', 1, '00001 GUDANG A', 5, '00005 CYL HEAD GASKET', 2, 2773, 'Cacat', '2016-01-11 15:43:45', 1, '0000-00-00 00:00:00', 0),
(45, 32, 'RB000004', 1, '00001 GUDANG A', 8, '00008 COTTER (1 VALVE)', 3, 2050, 'Cacat', '2016-01-11 15:43:45', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_detail_so`
--

CREATE TABLE IF NOT EXISTS `as_detail_so` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `soNo` varchar(20) NOT NULL,
  `soFaktur` varchar(20) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`detailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data untuk tabel `as_detail_so`
--

INSERT INTO `as_detail_so` (`detailID`, `soNo`, `soFaktur`, `productID`, `productName`, `price`, `qty`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(1, 'SO000001', '20141212123008', 5, '00005 CYL HEAD GASKET', 5000, 90, 'For Diesel', '2014-12-12 00:30:33', 1, '0000-00-00 00:00:00', 0),
(2, 'SO000001', '20141212123008', 6, '00006 MAIN BEARING 00', 28000, 95, 'Diesel', '2014-12-12 00:30:54', 1, '0000-00-00 00:00:00', 0),
(3, 'SO000002', '20141212124130', 1, '00001 CAMSH.TIMING GEAR', 95000, 50, '', '2014-12-12 00:44:08', 1, '0000-00-00 00:00:00', 0),
(4, 'SO000002', '20141212124130', 2, '00002 CAMSHAFT', 143000, 4, '', '2014-12-12 00:44:19', 1, '0000-00-00 00:00:00', 0),
(5, 'SO000002', '20141212124130', 6, '00006 MAIN BEARING 00', 36000, 4, '', '2014-12-12 00:44:34', 1, '0000-00-00 00:00:00', 0),
(6, 'SO000003', '20141225125016', 4, '00004 OIL FILTER CAP', 2000, 40, '', '2014-12-25 00:52:27', 1, '0000-00-00 00:00:00', 0),
(7, 'SO000003', '20141225125016', 6, '00006 MAIN BEARING 00', 36000, 12, '', '2014-12-25 00:52:40', 1, '0000-00-00 00:00:00', 0),
(8, 'SO000003', '20141225125016', 2, '00002 CAMSHAFT', 143000, 10, '', '2014-12-25 00:52:53', 1, '0000-00-00 00:00:00', 0),
(9, 'SO000003', '20141225125016', 7, '00007 CRANKCASE COVER', 455000, 5, '', '2014-12-25 00:53:06', 1, '0000-00-00 00:00:00', 0),
(10, 'SO000004', '20160104073351', 4, '00004 OIL FILTER CAP', 2000, 5, '-', '2016-01-05 13:31:14', 1, '0000-00-00 00:00:00', 0),
(11, 'SO000004', '20160104073351', 6, '00006 MAIN BEARING 00', 36000, 3, '', '2016-01-05 13:31:28', 1, '0000-00-00 00:00:00', 0),
(12, 'SO000004', '20160104073351', 5, '00005 CYL HEAD GASKET', 6000, 1, '-', '2016-01-05 13:32:17', 1, '0000-00-00 00:00:00', 0),
(13, 'SO000005', '20160108030920', 5, '00005 CYL HEAD GASKET', 5100, 20, '-', '2016-01-08 15:10:00', 1, '0000-00-00 00:00:00', 0),
(14, 'SO000005', '20160108030920', 6, '00006 MAIN BEARING 00', 28000, 5, '-', '2016-01-08 15:10:09', 1, '0000-00-00 00:00:00', 0),
(15, 'SO000006', '20160715091804', 17, '00001 Teori Bahasa dan Otomata', 42900, 100, '', '2016-07-15 21:18:47', 1, '0000-00-00 00:00:00', 0),
(20, 'SO000008', '20160718043710', 26, '00009 MU 176', 4000, 9500, '', '2016-07-18 04:38:03', 1, '0000-00-00 00:00:00', 0),
(21, 'SO000009', '20160718043825', 27, '00010 MU 177', 4000, 10000, '', '2016-07-18 04:39:29', 1, '0000-00-00 00:00:00', 0),
(22, 'SO000010', '20160718090341', 25, '00008 MU 175', 4000, 8000, '', '2016-07-18 21:05:00', 1, '0000-00-00 00:00:00', 0),
(23, 'SO000011', '20160727103614', 19, '00002 Al Waie 201', 7500, 10, '', '2016-07-27 10:36:54', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_detail_spb`
--

CREATE TABLE IF NOT EXISTS `as_detail_spb` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `spbNo` varchar(20) NOT NULL,
  `spbFaktur` varchar(20) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`detailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data untuk tabel `as_detail_spb`
--

INSERT INTO `as_detail_spb` (`detailID`, `spbNo`, `spbFaktur`, `productID`, `productName`, `price`, `qty`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(4, 'PO000002', '20141201093940', 1, '00001 CAMSH.TIMING GEAR', 53100, 100, '', '2014-12-01 21:58:18', 1, '0000-00-00 00:00:00', 0),
(5, 'PO000002', '20141201093940', 2, '00002 CAMSHAFT', 63750, 90, '30 Black, 30 White, 30 Natural', '2014-12-01 22:02:08', 1, '0000-00-00 00:00:00', 0),
(6, 'PO000003', '20141201103252', 9, '00009 V.SPRING RETAINER', 2550, 70, '', '2014-12-01 22:38:49', 1, '0000-00-00 00:00:00', 0),
(7, 'PO000003', '20141201103252', 8, '00008 COTTER (1 VALVE)', 2094, 80, '', '2014-12-01 22:38:59', 1, '0000-00-00 00:00:00', 0),
(8, 'PO000003', '20141201103252', 15, '00015 AIR INTAKE GASKET', 720, 200, '', '2014-12-01 22:39:08', 1, '0000-00-00 00:00:00', 0),
(9, 'PO000003', '20141201103252', 5, '00005 CYL HEAD GASKET', 3714, 10, '', '2014-12-01 22:39:18', 1, '0000-00-00 00:00:00', 0),
(10, 'PO000004', '20141201104839', 11, '00011 EXHAUST VALVE', 11400, 40, '40 Black', '2014-12-01 22:49:14', 1, '0000-00-00 00:00:00', 0),
(11, 'PO000005', '20141202023502', 2, '00002 CAMSHAFT', 63750, 100, '', '2014-12-02 02:36:57', 1, '0000-00-00 00:00:00', 0),
(12, 'PO000005', '20141202023502', 5, '00005 CYL HEAD GASKET', 3714, 90, '', '2014-12-02 02:37:04', 1, '0000-00-00 00:00:00', 0),
(13, 'PO000005', '20141202023502', 1, '00001 CAMSH.TIMING GEAR', 53100, 90, '', '2014-12-02 02:37:15', 1, '0000-00-00 00:00:00', 0),
(14, 'PO000005', '20141202023502', 6, '00006 MAIN BEARING 00', 8550, 100, '', '2014-12-02 02:37:33', 1, '0000-00-00 00:00:00', 0),
(15, 'PO000005', '20141202023502', 7, '00007 CRANKCASE COVER', 167200, 50, 'Test', '2014-12-02 02:37:41', 1, '0000-00-00 00:00:00', 0),
(16, 'PO000005', '20141202023502', 8, '00008 COTTER (1 VALVE)', 2094, 90, '', '2014-12-02 02:37:51', 1, '0000-00-00 00:00:00', 0),
(17, 'PO000005', '20141202023502', 10, '00010 INTAKE VALVE', 12244, 100, '', '2014-12-02 02:37:59', 1, '0000-00-00 00:00:00', 0),
(18, 'PO000005', '20141202023502', 9, '00009 V.SPRING RETAINER', 2550, 100, '', '2014-12-02 02:38:12', 1, '0000-00-00 00:00:00', 0),
(19, 'PO000005', '20141202023502', 11, '00011 EXHAUST VALVE', 11400, 70, '', '2014-12-02 02:38:20', 1, '0000-00-00 00:00:00', 0),
(20, 'PO000005', '20141202023502', 12, '00012 VALVE SPRING', 5100, 90, '', '2014-12-02 02:39:28', 1, '0000-00-00 00:00:00', 0),
(21, 'PO000006', '20141205043934', 2, '00002 CAMSHAFT', 63750, 50, '', '2014-12-05 04:40:24', 1, '0000-00-00 00:00:00', 0),
(22, 'PO000006', '20141205043934', 6, '00006 MAIN BEARING 00', 8550, 95, '', '2014-12-05 04:40:33', 1, '0000-00-00 00:00:00', 0),
(23, 'PO000006', '20141205043934', 3, '00003 NOZZLE', 72320, 80, '', '2014-12-05 04:40:46', 1, '0000-00-00 00:00:00', 0),
(24, 'PO000007', '20160104032145', 5, '00005 CYL HEAD GASKET', 2773, 2, '-', '2016-01-04 15:22:06', 1, '0000-00-00 00:00:00', 0),
(25, 'PO000007', '20160104032145', 8, '00008 COTTER (1 VALVE)', 2050, 1, '', '2016-01-04 15:22:14', 1, '0000-00-00 00:00:00', 0),
(26, 'PO000008', '20160107044619', 5, '00005 CYL HEAD GASKET', 2773, 10, '-', '2016-01-07 16:47:44', 1, '0000-00-00 00:00:00', 0),
(27, 'PO000008', '20160107044619', 1, '00001 CAMSH.TIMING GEAR', 59089, 1, '', '2016-01-07 16:47:53', 1, '0000-00-00 00:00:00', 0),
(28, 'PO000009', '20160715044841', 1, '00001 CAMSH.TIMING GEAR', 59089, 2, '', '2016-07-15 16:49:17', 1, '0000-00-00 00:00:00', 0),
(29, 'PO000010', '20160715090029', 17, '00001 Teori Bahasa dan Otomata', 42900, 50, '', '2016-07-15 21:01:03', 1, '0000-00-00 00:00:00', 0),
(30, 'PO000011', '20160716095547', 17, '00001 Teori Bahasa dan Otomata', 42900, 12, '', '2016-07-16 09:56:25', 1, '0000-00-00 00:00:00', 0),
(31, 'PO000012', '20160718044927', 25, '00008 MU 175', 2500, 30000, '', '2016-07-18 04:50:57', 1, '0000-00-00 00:00:00', 0),
(32, 'PO000013', '20160718052837', 26, '00009 MU 176', 2500, 31000, '', '2016-07-18 05:30:12', 1, '0000-00-00 00:00:00', 0),
(33, 'PO000014', '20160718053152', 27, '00010 MU 177', 2500, 32000, '', '2016-07-18 05:33:15', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_detail_transfers`
--

CREATE TABLE IF NOT EXISTS `as_detail_transfers` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `transferCode` varchar(10) NOT NULL,
  `transferFaktur` varchar(20) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`detailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `as_detail_transfers`
--

INSERT INTO `as_detail_transfers` (`detailID`, `transferCode`, `transferFaktur`, `productID`, `productName`, `qty`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(1, '000001', '20141123094311', 4, '00004 OIL FILTER CAP', 11, '', '2014-11-23 09:53:02', 1, '0000-00-00 00:00:00', 0),
(2, '000001', '20141123094311', 6, '00006 MAIN BEARING 00', 21, '', '2014-11-23 09:53:23', 1, '0000-00-00 00:00:00', 0),
(3, '000002', '20141123102902', 2, '00002 CAMSHAFT', 8, '', '2014-11-23 10:29:25', 1, '0000-00-00 00:00:00', 0),
(4, '000002', '20141123102902', 5, '00005 CYL HEAD GASKET', 5, '', '2014-11-23 10:29:35', 1, '0000-00-00 00:00:00', 0),
(5, '000003', '20160108054821', 6, '00006 MAIN BEARING 00', 20, '-', '2016-01-08 17:48:51', 1, '0000-00-00 00:00:00', 0),
(6, '000003', '20160108054821', 4, '00004 OIL FILTER CAP', 10, '-', '2016-01-08 17:49:05', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_factories`
--

CREATE TABLE IF NOT EXISTS `as_factories` (
  `factoryID` int(11) NOT NULL AUTO_INCREMENT,
  `factoryCode` varchar(10) NOT NULL,
  `factoryName` varchar(100) NOT NULL,
  `factoryType` char(1) NOT NULL,
  `status` char(1) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`factoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `as_factories`
--

INSERT INTO `as_factories` (`factoryID`, `factoryCode`, `factoryName`, `factoryType`, `status`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(1, '00001', 'GUDANG A', '1', 'Y', 'Gudang tetap, alamat Jl. Coba No. 21 Jakarta', '2014-11-18 15:12:46', 1, '2014-11-18 16:00:49', 1),
(2, '00002', 'GUDANG B', '1', 'Y', 'Gudang B\nAlamat : Jl. Merdeka Selatan No. 119 Jakarta Pusat', '2014-11-18 15:41:35', 1, '2014-11-18 16:01:11', 1),
(3, '00003', 'GUDANG C', '1', 'Y', '', '2014-11-20 19:18:24', 1, '0000-00-00 00:00:00', 0),
(4, '00004', 'GUDANG D', '1', 'Y', '', '2014-11-20 19:18:33', 1, '0000-00-00 00:00:00', 0),
(5, '00005', 'GUDANG E', '2', 'Y', '', '2014-11-20 19:18:41', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_modules`
--

CREATE TABLE IF NOT EXISTS `as_modules` (
  `modulID` int(11) NOT NULL AUTO_INCREMENT,
  `modulName` varchar(100) NOT NULL,
  `authorize` varchar(50) NOT NULL,
  `status` char(1) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`modulID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data untuk tabel `as_modules`
--

INSERT INTO `as_modules` (`modulID`, `modulName`, `authorize`, `status`, `modifiedDate`, `modifiedUserID`) VALUES
(1, 'Staff / User', '1,0,0,0,0', 'Y', '2014-11-26 23:33:20', 1),
(2, 'Customer', '1,0,0,0,0', 'Y', '2014-11-26 20:01:43', 1),
(3, 'Kurs', '1,0,0,0,0', 'Y', '2014-11-26 20:01:47', 1),
(4, 'Kategori', '1,0,0,0,0', 'Y', '2014-11-26 20:01:52', 1),
(5, 'Produk', '1,0,0,0,0', 'Y', '2014-11-26 20:01:56', 1),
(6, 'Supplier', '1,0,0,0,0', 'Y', '2014-11-26 20:02:04', 1),
(7, 'Transfer Gudang', '1,0,0,0,0', 'Y', '2014-11-26 20:02:15', 1),
(8, 'Transaksi Pembelian', '1,0,0,4,0', 'Y', '2016-07-18 22:39:43', 1),
(9, 'Transaksi Penjualan', '1,0,3,4,0', 'Y', '2016-07-18 22:39:30', 1),
(10, 'Retur Pembelian', '1,0,0,0,0', 'Y', '2014-11-26 20:02:58', 1),
(11, 'Retur Penjualan', '1,0,0,0,0', 'Y', '2014-11-26 20:03:03', 1),
(12, 'Gudang / Pabrik', '1,0,0,0,0', 'Y', '2014-11-26 20:03:14', 1),
(13, 'Barang Bukti Masuk (BBM)', '1,0,0,4,0', 'Y', '2014-11-26 20:03:25', 1),
(14, 'Purchase Order', '1,0,0,4,0', 'Y', '2016-07-18 22:39:01', 1),
(15, 'Assembly', '1,0,0,0,0', 'Y', '2014-11-26 20:04:14', 1),
(16, 'Stock Opname', '1,0,0,0,0', 'Y', '2014-11-26 20:04:21', 1),
(17, 'Laporan Stok Produk', '1,2,0,4,5', 'Y', '2016-07-18 22:14:50', 1),
(18, 'Laporan Assembly', '1,0,0,4,5', 'Y', '2014-11-26 20:04:54', 1),
(19, 'Laporan Pembelian', '1,0,0,0,5', 'Y', '2014-11-26 20:05:15', 1),
(20, 'Laporan Penjualan', '1,0,0,0,5', 'Y', '2014-11-26 20:05:09', 1),
(21, 'Laporan Hutang Dagang', '1,0,0,0,5', 'Y', '2014-11-26 20:05:23', 1),
(22, 'Laporan Piutang Dagang', '1,0,0,0,5', 'Y', '2014-11-26 20:05:28', 1),
(23, 'Hutang Dagang', '1,0,0,0,5', 'Y', '2014-11-26 20:05:43', 1),
(24, 'Piutang Dagang', '1,2,0,4,5', 'Y', '2016-07-18 22:14:39', 1),
(25, 'Level Authorize', '1,0,0,0,0', 'Y', '2014-11-26 20:05:53', 1),
(26, 'Pembayaran Transaksi Pembelian', '1,2,0,4,0', 'Y', '2016-07-18 22:40:08', 1),
(27, 'Pembayaran Transaksi Penjualan', '1,2,0,4,0', 'Y', '2016-07-18 22:37:47', 1),
(28, 'Sales Order', '1,2,0,4,0', 'Y', '2016-07-18 22:37:58', 1),
(29, 'Delivery Order', '1,2,0,4,0', 'Y', '2016-07-18 22:38:07', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_products`
--

CREATE TABLE IF NOT EXISTS `as_products` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `productCode` varchar(10) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `brandID` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `unitPrice1` double NOT NULL,
  `unitPrice2` double NOT NULL,
  `unitPrice3` double NOT NULL,
  `hpp` double NOT NULL,
  `purchasePrice` double NOT NULL,
  `note` text NOT NULL,
  `stockAmount` int(11) NOT NULL,
  `image` text NOT NULL,
  `minimumStock` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data untuk tabel `as_products`
--

INSERT INTO `as_products` (`productID`, `productCode`, `productName`, `categoryID`, `brandID`, `unit`, `unitPrice1`, `unitPrice2`, `unitPrice3`, `hpp`, `purchasePrice`, `note`, `stockAmount`, `image`, `minimumStock`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(19, '00002', '00002 Al Waie 201', 7, 0, 2, 7500, 10000, 10000, 7500, 7500, '', 0, '', 29500, '2016-07-17 19:10:56', 1, '0000-00-00 00:00:00', 0),
(20, '00003', '00003 Al Waie 202', 7, 0, 2, 7500, 10000, 10000, 7500, 7500, '', 0, '', 29000, '2016-07-17 19:12:42', 1, '0000-00-00 00:00:00', 0),
(21, '00004', '00004 Al Waie 203', 7, 0, 2, 7500, 10000, 10000, 7500, 7500, '', 0, '', 29000, '2016-07-17 19:13:35', 1, '0000-00-00 00:00:00', 0),
(22, '00005', '00005 Peraturan Hidup dalam Islam', 5, 0, 2, 25000, 30000, 30000, 25000, 25000, '', 0, '', 3000, '2016-07-17 19:14:48', 1, '0000-00-00 00:00:00', 0),
(23, '00006', '00006 Mafahim 000', 5, 0, 2, 10000, 15000, 15000, 10000, 10000, '', 0, '', 3000, '2016-07-17 19:15:51', 1, '0000-00-00 00:00:00', 0),
(24, '00007', '00007 Pembentukan Partai Politik', 5, 0, 2, 8000, 13000, 13000, 8000, 8000, '', 0, '', 3000, '2016-07-17 19:16:39', 1, '0000-00-00 00:00:00', 0),
(25, '00008', '00008 MU 175', 6, 0, 2, 10000, 12000, 12000, 2500, 2500, '', 0, '', 29000, '2016-07-17 19:42:57', 1, '0000-00-00 00:00:00', 0),
(26, '00009', '00009 MU 176', 6, 0, 2, 10000, 12000, 12000, 2500, 2500, '', 0, '', 29000, '2016-07-17 19:43:33', 1, '0000-00-00 00:00:00', 0),
(27, '00010', '00010 MU 177', 6, 0, 2, 10000, 12000, 12000, 2500, 2500, '', 0, '', 29000, '2016-07-17 19:44:09', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_receivables`
--

CREATE TABLE IF NOT EXISTS `as_receivables` (
  `receiveID` int(11) NOT NULL AUTO_INCREMENT,
  `receiveNo` varchar(20) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `invoiceNo` varchar(20) NOT NULL,
  `customerID` int(11) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `customerAddress` text NOT NULL,
  `receiveTotal` double NOT NULL,
  `incomingTotal` double NOT NULL,
  `reductionTotal` double NOT NULL,
  `status` char(1) NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`receiveID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `as_receivables`
--

INSERT INTO `as_receivables` (`receiveID`, `receiveNo`, `invoiceID`, `invoiceNo`, `customerID`, `customerName`, `customerAddress`, `receiveTotal`, `incomingTotal`, `reductionTotal`, `status`, `staffID`, `staffName`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(1, 'DB000001', 6, 'TJ000003', 4, '00004 AMAN JAYA, BANDUNG', 'GURAME NO.15 BANDUNG, 40262', 4217000, 0, 0, '1', 1, '00001 Web Administrator', '2014-12-25 00:56:32', 1, '0000-00-00 00:00:00', 0),
(2, 'DB000002', 7, 'TJ000004', 23, '00023 SUMBER TEHNIK,CIREBON', 'GUNUNG SARI NO.12G-12 CIREBON,45131', 136400, 136400, 0, '1', 1, '00001 Web Administrator', '2016-01-05 15:35:52', 1, '0000-00-00 00:00:00', 0),
(3, 'DB000003', 8, 'TJ000005', 5, '00005 BUDI KARYA, BANDUNG', 'BANCEUY NO.104 BANDUNG, 40111', 266200, 266200, 0, '1', 1, '00001 Web Administrator', '2016-01-08 16:47:54', 1, '0000-00-00 00:00:00', 0),
(4, 'DB000004', 9, 'TJ000006', 26, 'KA000001 Toko Buku Toga Mas', 'Dago Bandung', 4719000, 4500000, 0, '1', 1, '00001 Web Administrator', '2016-07-15 21:21:03', 1, '0000-00-00 00:00:00', 0),
(5, 'DB000005', 10, 'TJ000007', 27, 'T001 Ihsan', 'Depok Depok', 36000000, 36000000, 0, '1', 1, '00001 Web Administrator', '2016-07-18 20:52:11', 1, '0000-00-00 00:00:00', 0),
(6, 'DB000006', 11, 'TJ000008', 27, 'T001 Ihsan', 'Depok Depok', 36000000, 36500000, 0, '1', 1, '00001 Web Administrator', '2016-07-18 20:57:09', 1, '0000-00-00 00:00:00', 0),
(7, 'DB000007', 12, 'TJ000009', 27, 'T001 Ihsan', 'Depok Depok', 31600000, 31000000, 0, '1', 1, '00001 Web Administrator', '2016-07-18 21:07:03', 1, '0000-00-00 00:00:00', 0),
(8, 'DB000008', 13, 'TJ000010', 27, 'T001 Ihsan', 'Depok Depok', 75000, 0, 0, '1', 1, '00001 Web Administrator', '2016-07-27 10:43:24', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_retur_staffs`
--

CREATE TABLE IF NOT EXISTS `as_retur_staffs` (
  `returID` int(11) NOT NULL AUTO_INCREMENT,
  `returNo` varchar(20) NOT NULL,
  `returDate` date NOT NULL,
  `invoiceNo` varchar(20) NOT NULL,
  `customerID` int(11) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `customerAddress` text NOT NULL,
  `returType` char(1) NOT NULL,
  `subtotal` double NOT NULL,
  `ppnType` int(11) NOT NULL,
  `ppn` double NOT NULL,
  `grandtotal` double NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `ref` varchar(100) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`returID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `as_retur_staffs`
--

INSERT INTO `as_retur_staffs` (`returID`, `returNo`, `returDate`, `invoiceNo`, `customerID`, `customerName`, `customerAddress`, `returType`, `subtotal`, `ppnType`, `ppn`, `grandtotal`, `staffID`, `staffName`, `ref`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(1, 'RJ000001', '2014-12-19', 'TJ000001', 5, '00005 BUDI KARYA, BANDUNG', 'BANCEUY NO.104 BANDUNG, 40111', '2', 94200, 2, 0, 94200, 1, '00001 Web Administrator', 'TJ000001', 'Barang cacat produk', '2014-12-19 00:42:54', 1, '0000-00-00 00:00:00', 0),
(3, 'RJ000002', '2014-12-19', 'TJ000002', 20, '00020 ADI JAYA TEHNIK,JATIBARANG', 'ARIODINOTO NO.10 INDRAMAYU', '2', 321500, 1, 32150, 353650, 1, '00001 Web Administrator', 'TJ000002', 'Barang cacat produk', '2014-12-19 00:49:53', 1, '0000-00-00 00:00:00', 0),
(4, 'RJ000003', '2016-01-11', 'TJ000003', 4, '00004 AMAN JAYA, BANDUNG', 'GURAME NO.15 BANDUNG, 40262', '1', 779000, 2, 0, 779000, 1, '00001 Web Administrator', '-', '-', '2016-01-11 15:58:06', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_retur_suppliers`
--

CREATE TABLE IF NOT EXISTS `as_retur_suppliers` (
  `returID` int(11) NOT NULL AUTO_INCREMENT,
  `returNo` varchar(20) NOT NULL,
  `returDate` date NOT NULL,
  `invoiceNo` varchar(20) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(100) NOT NULL,
  `supplierAddress` text NOT NULL,
  `returType` char(1) NOT NULL,
  `subtotal` double NOT NULL,
  `ppnType` int(11) NOT NULL,
  `ppn` double NOT NULL,
  `grandtotal` double NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `ref` varchar(100) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`returID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data untuk tabel `as_retur_suppliers`
--

INSERT INTO `as_retur_suppliers` (`returID`, `returNo`, `returDate`, `invoiceNo`, `supplierID`, `supplierName`, `supplierAddress`, `returType`, `subtotal`, `ppnType`, `ppn`, `grandtotal`, `staffID`, `staffName`, `ref`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(9, 'RB000001', '2014-12-18', 'TB000001', 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', '1', 7.91, 1, 0.791, 8.701, 1, '00001 Web Administrator', '3010219201', 'Return Back', '2014-12-18 04:16:00', 1, '0000-00-00 00:00:00', 0),
(30, 'RB000002', '2014-12-18', 'TB000002', 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', '2', 31594.58, 2, 0, 31594.58, 1, '00001 Web Administrator', '78689273892', 'Return', '2014-12-18 05:36:27', 1, '0000-00-00 00:00:00', 0),
(31, 'RB000003', '2014-12-18', 'TB000003', 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', '3', 790690, 1, 79069, 869759, 1, '00001 Web Administrator', '', '', '2014-12-18 05:39:04', 1, '0000-00-00 00:00:00', 0),
(32, 'RB000004', '2016-01-11', 'TB000005', 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', '1', 11696, 1, 1169.6, 12865.6, 1, '00001 Web Administrator', '-', '-', '2016-01-11 15:43:45', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_sales_order`
--

CREATE TABLE IF NOT EXISTS `as_sales_order` (
  `soID` int(11) NOT NULL AUTO_INCREMENT,
  `soNo` varchar(10) NOT NULL,
  `soFaktur` varchar(20) NOT NULL,
  `customerID` int(11) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `customerAddress` text NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `orderDate` date NOT NULL,
  `needDate` date NOT NULL,
  `note` text NOT NULL,
  `status` char(1) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`soID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data untuk tabel `as_sales_order`
--

INSERT INTO `as_sales_order` (`soID`, `soNo`, `soFaktur`, `customerID`, `customerName`, `customerAddress`, `staffID`, `staffName`, `orderDate`, `needDate`, `note`, `status`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(2, 'SO000001', '20141212123008', 5, '00005 BUDI KARYA, BANDUNG', 'BANCEUY NO.104 BANDUNG, 40111', 1, '00001 Web Administrator', '2014-12-12', '2014-12-17', 'Segera', '', '2014-12-12 00:30:10', 1, '0000-00-00 00:00:00', 0),
(5, 'SO000002', '20141212124130', 20, '00020 ADI JAYA TEHNIK,JATIBARANG', 'ARIODINOTO NO.10 INDRAMAYU', 1, '00001 Web Administrator', '2014-12-12', '2014-12-19', '', '', '2014-12-12 00:41:33', 1, '0000-00-00 00:00:00', 0),
(6, 'SO000003', '20141225125016', 4, '00004 AMAN JAYA, BANDUNG', 'GURAME NO.15 BANDUNG, 40262', 1, '00001 Web Administrator', '2014-12-25', '2014-12-25', '', '', '2014-12-25 00:50:19', 1, '0000-00-00 00:00:00', 0),
(8, 'SO000004', '20160104073351', 23, '00023 SUMBER TEHNIK,CIREBON', 'GUNUNG SARI NO.12G-12 CIREBON,45131', 1, '00001 Web Administrator', '2016-01-04', '2016-01-04', '-', '', '2016-01-04 19:33:53', 1, '0000-00-00 00:00:00', 0),
(9, 'SO000005', '20160108030920', 5, '00005 BUDI KARYA, BANDUNG', 'BANCEUY NO.104 BANDUNG, 40111', 1, '00001 Web Administrator', '2016-01-08', '2016-01-08', '-', '', '2016-01-08 15:09:43', 1, '0000-00-00 00:00:00', 0),
(11, 'SO000006', '20160715091804', 26, 'KA000001 Toko Buku Toga Mas', 'Dago Bandung', 1, '00001 Web Administrator', '2016-07-15', '2016-07-15', '', '', '2016-07-15 21:18:10', 1, '0000-00-00 00:00:00', 0),
(18, 'SO000008', '20160718043710', 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', '2016-06-13', '2016-06-17', '', '', '2016-07-18 04:37:15', 1, '0000-00-00 00:00:00', 0),
(19, 'SO000009', '20160718043825', 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', '2016-06-27', '2016-07-01', '', '', '2016-07-18 04:38:31', 1, '0000-00-00 00:00:00', 0),
(24, 'SO000010', '20160718090341', 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', '2016-05-30', '2016-05-31', '', '', '2016-07-18 21:03:44', 1, '0000-00-00 00:00:00', 0),
(30, 'SO000011', '20160727103614', 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', '2016-07-27', '2016-07-27', '', '', '2016-07-27 10:36:18', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_sales_payments`
--

CREATE TABLE IF NOT EXISTS `as_sales_payments` (
  `paymentID` int(11) NOT NULL AUTO_INCREMENT,
  `paymentNo` varchar(20) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `invoiceNo` varchar(20) NOT NULL,
  `soNo` varchar(20) NOT NULL,
  `paymentDate` date NOT NULL,
  `payType` char(1) NOT NULL,
  `bankNo` varchar(100) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `bankAC` varchar(100) NOT NULL,
  `effectiveDate` date NOT NULL,
  `total` double NOT NULL,
  `customerID` int(11) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `customerAddress` text NOT NULL,
  `ref` varchar(100) NOT NULL,
  `note` text NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`paymentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `as_sales_payments`
--

INSERT INTO `as_sales_payments` (`paymentID`, `paymentNo`, `invoiceID`, `invoiceNo`, `soNo`, `paymentDate`, `payType`, `bankNo`, `bankName`, `bankAC`, `effectiveDate`, `total`, `customerID`, `customerName`, `customerAddress`, `ref`, `note`, `staffID`, `staffName`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(3, 'PJ000001', 4, 'TJ000001', 'SO000001', '2014-12-15', '4', '920121672', 'DANAMON', 'HANSENG SETIABUDI', '2014-12-22', 1922000, 5, '00005 BUDI KARYA, BANDUNG', 'BANCEUY NO.104 BANDUNG, 40111', 'TJ000001.1', '', 1, '00001 Web Administrator', '2014-12-15 01:00:10', 1, '0000-00-00 00:00:00', 0),
(4, 'PJ000002', 5, 'TJ000002', 'SO000002', '2014-12-15', '1', '', '', '', '0000-00-00', 2000000, 20, '00020 ADI JAYA TEHNIK,JATIBARANG', 'ARIODINOTO NO.10 INDRAMAYU', 'TJ000002.1', '', 1, '00001 Web Administrator', '2014-12-15 01:00:44', 1, '0000-00-00 00:00:00', 0),
(8, 'PJ000003', 7, 'TJ000004', 'SO000004', '2016-01-05', '2', '3740531645', 'BCA', 'Agus Saputra', '0000-00-00', 136400, 23, '00023 SUMBER TEHNIK,CIREBON', 'GUNUNG SARI NO.12G-12 CIREBON,45131', '-', '-', 1, '00001 Web Administrator', '2016-01-05 15:49:19', 1, '0000-00-00 00:00:00', 0),
(9, 'PJ000004', 8, 'TJ000005', 'SO000005', '2016-01-08', '2', '3740531645', 'BCA', 'Agus Saputra', '0000-00-00', 266200, 5, '00005 BUDI KARYA, BANDUNG', 'BANCEUY NO.104 BANDUNG, 40111', '0128127GVVS', '-', 1, '00001 Web Administrator', '2016-01-08 16:59:17', 1, '0000-00-00 00:00:00', 0),
(10, 'PJ000005', 9, 'TJ000006', 'SO000006', '2016-07-15', '2', '33434353', 'Mandiri', 'Kaswadi', '2016-07-15', 4000000, 26, 'KA000001 Toko Buku Toga Mas', 'Dago Bandung', '', '', 1, '00001 Web Administrator', '2016-07-15 21:22:41', 1, '0000-00-00 00:00:00', 0),
(11, 'PJ000006', 9, 'TJ000006', '', '2016-07-16', '1', '', '', '', '0000-00-00', 500000, 26, 'KA000001 Toko Buku Toga Mas', 'Dago Bandung', '', '', 1, '00001 Web Administrator', '2016-07-16 10:03:27', 1, '0000-00-00 00:00:00', 0),
(12, 'PJ000007', 10, 'TJ000007', 'SO000009', '2016-07-18', '1', '', '', '', '0000-00-00', 35500000, 27, 'T001 Ihsan', 'Depok Depok', '', '', 1, '00001 Web Administrator', '2016-07-18 21:15:25', 1, '0000-00-00 00:00:00', 0),
(13, 'PJ000008', 11, 'TJ000008', 'SO000008', '2016-07-18', '1', '', '', '', '0000-00-00', 36500000, 27, 'T001 Ihsan', 'Depok Depok', '', '', 1, '00001 Web Administrator', '2016-07-18 21:16:11', 1, '0000-00-00 00:00:00', 0),
(14, 'PJ000009', 12, 'TJ000009', 'SO000010', '2016-07-18', '1', '', '', '', '0000-00-00', 31000000, 27, 'T001 Ihsan', 'Depok Depok', '', '', 1, '00001 Web Administrator', '2016-07-18 21:17:14', 1, '0000-00-00 00:00:00', 0),
(15, 'PJ000010', 10, 'TJ000007', 'SO000009', '2016-07-27', '1', '', '', '', '0000-00-00', 500000, 27, 'T001 Ihsan', 'Depok Depok', '', '', 1, '00001 Web Administrator', '2016-07-27 10:45:08', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_sales_transactions`
--

CREATE TABLE IF NOT EXISTS `as_sales_transactions` (
  `invoiceID` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceNo` varchar(20) NOT NULL,
  `invoiceDate` date NOT NULL,
  `doNo` varchar(20) NOT NULL,
  `soNo` varchar(20) NOT NULL,
  `paymentType` int(11) NOT NULL,
  `expiredPayment` date NOT NULL,
  `ppnType` int(11) NOT NULL,
  `ppn` double NOT NULL,
  `total` double NOT NULL,
  `basic` double NOT NULL,
  `discount` double NOT NULL,
  `grandtotal` double NOT NULL,
  `customerID` int(11) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `customerAddress` text NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `createdDate` int(11) NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`invoiceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data untuk tabel `as_sales_transactions`
--

INSERT INTO `as_sales_transactions` (`invoiceID`, `invoiceNo`, `invoiceDate`, `doNo`, `soNo`, `paymentType`, `expiredPayment`, `ppnType`, `ppn`, `total`, `basic`, `discount`, `grandtotal`, `customerID`, `customerName`, `customerAddress`, `staffID`, `staffName`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(4, 'TJ000001', '2014-12-15', 'DO000001', 'SO000001', 2, '2014-12-22', 2, 0, 1922000, 1922000, 0, 1922000, 5, '00005 BUDI KARYA, BANDUNG', 'BANCEUY NO.104 BANDUNG, 40111', 1, '00001 Web Administrator', 2014, 1, '0000-00-00 00:00:00', 0),
(5, 'TJ000002', '2014-12-15', 'DO000002', 'SO000002', 1, '0000-00-00', 1, 540000, 5468000, 5400000, 68000, 5940000, 20, '00020 ADI JAYA TEHNIK,JATIBARANG', 'ARIODINOTO NO.10 INDRAMAYU', 1, '00001 Web Administrator', 2014, 1, '0000-00-00 00:00:00', 0),
(6, 'TJ000003', '2014-12-25', 'DO000003', 'SO000003', 2, '2014-12-31', 2, 0, 4217000, 4217000, 0, 4217000, 4, '00004 AMAN JAYA, BANDUNG', 'GURAME NO.15 BANDUNG, 40262', 1, '00001 Web Administrator', 2014, 1, '0000-00-00 00:00:00', 0),
(7, 'TJ000004', '2016-01-05', 'DO000004', 'SO000004', 1, '0000-00-00', 1, 12400, 124000, 124000, 0, 136400, 23, '00023 SUMBER TEHNIK,CIREBON', 'GUNUNG SARI NO.12G-12 CIREBON,45131', 1, '00001 Web Administrator', 2016, 1, '0000-00-00 00:00:00', 0),
(8, 'TJ000005', '2016-01-08', 'DO000005', 'SO000005', 2, '2016-01-15', 1, 24200, 242000, 242000, 0, 266200, 5, '00005 BUDI KARYA, BANDUNG', 'BANCEUY NO.104 BANDUNG, 40111', 1, '00001 Web Administrator', 2016, 1, '0000-00-00 00:00:00', 0),
(9, 'TJ000006', '2016-07-15', 'DO000006', 'SO000006', 2, '2016-07-25', 1, 429000, 4290000, 4290000, 0, 4719000, 26, 'KA000001 Toko Buku Toga Mas', 'Dago Bandung', 1, '00001 Web Administrator', 2016, 1, '0000-00-00 00:00:00', 0),
(10, 'TJ000007', '2016-07-18', 'DO000009', 'SO000009', 1, '0000-00-00', 2, 0, 36000000, 36000000, 0, 36000000, 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', 2016, 1, '0000-00-00 00:00:00', 0),
(11, 'TJ000008', '2016-07-18', 'DO000008', 'SO000008', 1, '0000-00-00', 2, 0, 36000000, 36000000, 0, 36000000, 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', 2016, 1, '0000-00-00 00:00:00', 0),
(12, 'TJ000009', '2016-07-18', 'DO000010', 'SO000010', 1, '0000-00-00', 2, 0, 31600000, 31600000, 0, 31600000, 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', 2016, 1, '0000-00-00 00:00:00', 0),
(13, 'TJ000010', '2016-07-27', 'DO000015', 'SO000011', 1, '0000-00-00', 2, 0, 75000, 75000, 0, 75000, 27, 'T001 Ihsan', 'Depok Depok', 1, '00001 Web Administrator', 2016, 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_spb`
--

CREATE TABLE IF NOT EXISTS `as_spb` (
  `spbID` int(11) NOT NULL AUTO_INCREMENT,
  `spbNo` varchar(10) NOT NULL,
  `spbFaktur` varchar(20) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(100) NOT NULL,
  `supplierAddress` text NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `orderDate` date NOT NULL,
  `needDate` date NOT NULL,
  `note` text NOT NULL,
  `status` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`spbID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data untuk tabel `as_spb`
--

INSERT INTO `as_spb` (`spbID`, `spbNo`, `spbFaktur`, `supplierID`, `supplierName`, `supplierAddress`, `staffID`, `staffName`, `orderDate`, `needDate`, `note`, `status`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(3, 'PO000002', '20141201093940', 4, '00003 PT. INDOSYSTEM GLOBAL', 'JL. PEKALIPAN NO. 9 CIREBON', 1, '00001 Web Administrator', '2014-12-01', '2014-12-01', 'Mohon dikirimkan ke alamat kami expected date 7 Desember 2014', 0, '2014-12-01 21:39:42', 1, '0000-00-00 00:00:00', 0),
(4, 'PO000003', '20141201103252', 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', 1, '00001 Web Administrator', '2014-12-01', '2014-12-07', 'Harap dikirim ke alamat kami sebelum tanggal 7 Desember 2014', 0, '2014-12-01 22:34:26', 1, '0000-00-00 00:00:00', 0),
(5, 'PO000004', '20141201104839', 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', 1, '00001 Web Administrator', '2014-12-01', '2014-12-05', '', 0, '2014-12-01 22:48:44', 1, '0000-00-00 00:00:00', 0),
(6, 'PO000005', '20141202023502', 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', 1, '00001 Web Administrator', '2014-12-02', '2014-12-04', '', 0, '2014-12-02 02:35:04', 1, '0000-00-00 00:00:00', 0),
(8, 'PO000006', '20141205043934', 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', 1, '00001 Web Administrator', '2014-12-05', '2014-12-08', '', 0, '2014-12-05 04:39:36', 1, '0000-00-00 00:00:00', 0),
(10, 'PO000007', '20160104032145', 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', 1, '00001 Web Administrator', '2016-01-04', '2016-01-04', '', 0, '2016-01-04 15:21:47', 1, '0000-00-00 00:00:00', 0),
(11, 'PO000008', '20160107044619', 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', 1, '00001 Web Administrator', '2016-01-07', '2016-01-07', '-', 0, '2016-01-07 16:47:29', 1, '0000-00-00 00:00:00', 0),
(13, 'PO000009', '20160715044841', 2, '00002 PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2 ', 1, '00001 Web Administrator', '2016-07-15', '2016-07-15', '', 0, '2016-07-15 16:48:45', 1, '0000-00-00 00:00:00', 0),
(15, 'PO000010', '20160715090029', 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', 1, '00001 Web Administrator', '2016-07-15', '2016-07-15', '', 0, '2016-07-15 21:00:34', 1, '0000-00-00 00:00:00', 0),
(16, 'PO000011', '20160716095547', 1, '00001 CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN CIREBON,45162', 1, '00001 Web Administrator', '2016-07-16', '2016-07-16', '', 0, '2016-07-16 09:55:51', 1, '0000-00-00 00:00:00', 0),
(18, 'PO000012', '20160718044927', 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 1, '00001 Web Administrator', '2016-05-30', '2016-05-31', '', 0, '2016-07-18 04:49:32', 1, '0000-00-00 00:00:00', 0),
(19, 'PO000013', '20160718052837', 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 1, '00001 Web Administrator', '2016-06-13', '2016-06-13', '', 0, '2016-07-18 05:28:44', 1, '0000-00-00 00:00:00', 0),
(20, 'PO000014', '20160718053152', 7, '00006 Penerbit Media Umat', 'Jakarta Jakarta', 1, '00001 Web Administrator', '2016-06-27', '2016-06-28', '', 0, '2016-07-18 05:31:57', 1, '0000-00-00 00:00:00', 0),
(21, 'PO000015', '20160727100206', 0, '', '', 1, '00001 Web Administrator', '2016-07-27', '2016-07-27', '', 0, '2016-07-27 10:02:16', 1, '0000-00-00 00:00:00', 0),
(22, 'PO000015', '20160727100256', 0, '', '', 1, '00001 Web Administrator', '2016-07-27', '2016-07-27', '', 0, '2016-07-27 10:03:01', 1, '0000-00-00 00:00:00', 0),
(23, 'PO000015', '20160727100330', 0, '', '', 1, '00001 Web Administrator', '2016-07-27', '2016-07-27', '', 0, '2016-07-27 10:03:34', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_staffs`
--

CREATE TABLE IF NOT EXISTS `as_staffs` (
  `staffID` int(11) NOT NULL AUTO_INCREMENT,
  `staffCode` varchar(25) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `address2` text NOT NULL,
  `village` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zipCode` varchar(5) NOT NULL,
  `province` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `part` varchar(100) NOT NULL,
  `status` char(1) NOT NULL,
  `level` char(1) NOT NULL,
  `photo` text NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(32) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`staffID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data untuk tabel `as_staffs`
--

INSERT INTO `as_staffs` (`staffID`, `staffCode`, `staffName`, `address`, `address2`, `village`, `district`, `city`, `zipCode`, `province`, `phone`, `position`, `part`, `status`, `level`, `photo`, `email`, `password`, `lastLogin`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(1, '00001', 'Web Administrator', 'Jl. Pegadaian No. 38 01/01', '', 'Jungjang', 'Arjawinangun', 'Kab. Cirebon', '45162', 'Jawa Barat', '08562121141', 'Administrator', 'General', 'Y', '1', '', 'info@asfasolution.co.id', 'e10adc3949ba59abbe56e057f20f883e', '2016-07-27 09:50:25', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(21, 'MA000001', 'Adi Sulistyo Nugroho', 'Perumahan Kostrad ', 'RT/RW.005/007 No.H1', 'Kebayoran Lama Selatan', 'Kebayoran Lama Selatan', 'Jakarta Selatan', '12240', 'DKI Jakarta', '081282357550', 'Manager', 'IT Support', 'Y', '1', 'cmp_20160715034014Superman_Doomsday.jpg', 'nugroho250173@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '2016-07-15 20:40:22', 1, '0000-00-00 00:00:00', 0),
(22, 'M001', 'Anwar', 'Bogor', '', 'Bogor', '', 'Bogor', '', 'Jabar', '08123456789', 'Manager', 'Majalah', 'Y', '2', '', 'anwar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '2016-07-17 18:43:26', 1, '0000-00-00 00:00:00', 0),
(23, 'B001', 'Tedy', 'Ciomas', '', 'Ciomas', '', 'Bogor', '', 'Jabar', '08234567891', 'Manager', 'Buku', 'Y', '4', '', 'tedy@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', '2016-07-17 18:44:52', 1, '2016-07-18 22:37:04', 1),
(24, 'T001', 'Budi', 'Ciputat', '', 'Ciputat', '', 'Serpong', '', 'Banten', '08345678912', 'Manager', 'Tabloid', 'Y', '2', '', 'pondoksoft@gmail.com', '123', '0000-00-00 00:00:00', '2016-07-17 18:46:20', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_stock_opname`
--

CREATE TABLE IF NOT EXISTS `as_stock_opname` (
  `soID` int(11) NOT NULL AUTO_INCREMENT,
  `soDate` date NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `factoryID` int(11) NOT NULL,
  `factoryName` varchar(100) NOT NULL,
  `productStock` int(11) NOT NULL,
  `realStock` int(11) NOT NULL,
  `note` text NOT NULL,
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`soID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `as_stock_opname`
--

INSERT INTO `as_stock_opname` (`soID`, `soDate`, `productID`, `productName`, `factoryID`, `factoryName`, `productStock`, `realStock`, `note`, `staffID`, `staffName`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(4, '2014-12-23', 1, '00001 CAMSH.TIMING GEAR', 4, '00004 GUDANG D', 97, 92, 'Penyesuaian stok per 23-12-2014 terhadap kode produk 00001', 1, '00001 Web Administrator', '2014-12-23 00:39:43', 1, '0000-00-00 00:00:00', 0),
(6, '2014-12-23', 4, '00004 OIL FILTER CAP', 1, '00001 GUDANG A', 98, 94, 'Penyesuaian stok per 23-12-2014 terhadap kode produk 00004', 1, '00001 Web Administrator', '2014-12-23 00:41:14', 1, '0000-00-00 00:00:00', 0),
(7, '2014-12-23', 5, '00005 CYL HEAD GASKET', 2, '00002 GUDANG B', 25, 24, 'Penyesuaian stok per 23-12-2014 terhadap kode produk 00005 di gudang B', 1, '00001 Web Administrator', '2014-12-23 00:42:10', 1, '0000-00-00 00:00:00', 0),
(8, '2016-01-11', 2, '00002 CAMSHAFT', 1, '00001 GUDANG A', 264, 261, '-', 1, '00001 Web Administrator', '2016-01-11 16:14:09', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_stock_products`
--

CREATE TABLE IF NOT EXISTS `as_stock_products` (
  `stockProductID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `factoryID` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`stockProductID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=107 ;

--
-- Dumping data untuk tabel `as_stock_products`
--

INSERT INTO `as_stock_products` (`stockProductID`, `productID`, `factoryID`, `stock`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(2, 1, 1, 4, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:05', 1),
(3, 1, 2, 141, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:05', 1),
(4, 1, 3, 5, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:05', 1),
(5, 1, 4, 2, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:05', 1),
(6, 1, 5, 99, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:05', 1),
(7, 2, 1, 211, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:26', 1),
(8, 2, 2, 25, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:26', 1),
(9, 2, 3, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:26', 1),
(10, 2, 4, 4, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:26', 1),
(11, 2, 5, 81, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:26', 1),
(12, 3, 1, 7, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:52', 1),
(13, 3, 2, 14, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:52', 1),
(14, 3, 3, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:52', 1),
(15, 3, 4, 4, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:52', 1),
(16, 3, 5, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:17:52', 1),
(17, 4, 1, 40, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:16', 1),
(18, 4, 2, 70, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:16', 1),
(19, 4, 3, 88, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:16', 1),
(20, 4, 4, 75, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:16', 1),
(21, 4, 5, 55, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:16', 1),
(22, 5, 1, 7, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:31', 1),
(23, 5, 2, 24, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:31', 1),
(24, 5, 3, 11, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:31', 1),
(25, 5, 4, -4, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:31', 1),
(26, 5, 5, 90, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:31', 1),
(27, 6, 1, 40, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:45', 1),
(28, 6, 2, 57, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:45', 1),
(29, 6, 3, 66, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:45', 1),
(30, 6, 4, -2, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:45', 1),
(31, 6, 5, 30, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:45', 1),
(32, 7, 1, 87, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:59', 1),
(33, 7, 2, 47, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:59', 1),
(34, 7, 3, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:59', 1),
(35, 7, 4, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:59', 1),
(36, 7, 5, 45, '0000-00-00 00:00:00', 0, '2014-11-20 20:18:59', 1),
(37, 8, 1, 181, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:11', 1),
(38, 8, 2, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:11', 1),
(39, 8, 3, 4, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:11', 1),
(40, 8, 4, -10, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:11', 1),
(41, 8, 5, 9, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:11', 1),
(42, 9, 1, 79, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:23', 1),
(43, 9, 2, 100, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:23', 1),
(44, 9, 3, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:23', 1),
(45, 9, 4, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:23', 1),
(46, 9, 5, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:23', 1),
(47, 10, 1, 109, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:36', 1),
(48, 10, 2, -3, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:36', 1),
(49, 10, 3, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:36', 1),
(50, 10, 4, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:36', 1),
(51, 10, 5, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:36', 1),
(52, 11, 1, 17, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:59', 1),
(53, 11, 2, 66, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:59', 1),
(54, 11, 3, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:59', 1),
(55, 11, 4, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:59', 1),
(56, 11, 5, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:19:59', 1),
(57, 12, 1, 109, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:29', 1),
(58, 12, 2, -9, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:29', 1),
(59, 12, 3, 67, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:29', 1),
(60, 12, 4, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:29', 1),
(61, 12, 5, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:29', 1),
(62, 13, 1, 74, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:46', 1),
(63, 13, 2, 62, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:46', 1),
(64, 13, 3, 14, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:46', 1),
(65, 13, 4, 54, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:46', 1),
(66, 13, 5, 34, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:46', 1),
(67, 14, 1, 18, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:59', 1),
(68, 14, 2, -9, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:59', 1),
(69, 14, 3, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:59', 1),
(70, 14, 4, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:59', 1),
(71, 14, 5, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:20:59', 1),
(72, 15, 1, 310, '0000-00-00 00:00:00', 0, '2014-11-20 20:21:10', 1),
(73, 15, 2, 58, '0000-00-00 00:00:00', 0, '2014-11-20 20:21:10', 1),
(74, 15, 3, 310, '0000-00-00 00:00:00', 0, '2014-11-20 20:21:10', 1),
(75, 15, 4, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:21:10', 1),
(76, 15, 5, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:21:10', 1),
(77, 16, 1, 62, '0000-00-00 00:00:00', 0, '2014-11-20 20:21:26', 1),
(78, 16, 2, -5, '0000-00-00 00:00:00', 0, '2014-11-20 20:21:26', 1),
(79, 16, 3, 45, '0000-00-00 00:00:00', 0, '2014-11-20 20:21:26', 1),
(80, 16, 4, 0, '0000-00-00 00:00:00', 0, '2014-11-20 20:21:26', 1),
(81, 16, 5, 19, '0000-00-00 00:00:00', 0, '2014-11-20 20:21:26', 1),
(82, 17, 1, 162, '0000-00-00 00:00:00', 0, '2016-07-15 20:58:50', 1),
(83, 17, 2, 0, '0000-00-00 00:00:00', 0, '2016-07-15 20:58:50', 1),
(84, 17, 3, 0, '0000-00-00 00:00:00', 0, '2016-07-15 20:58:50', 1),
(85, 17, 4, 0, '0000-00-00 00:00:00', 0, '2016-07-15 20:58:50', 1),
(86, 17, 5, 0, '0000-00-00 00:00:00', 0, '2016-07-15 20:58:50', 1),
(87, 25, 1, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:04:46', 1),
(88, 25, 2, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:04:46', 1),
(89, 25, 3, -7900, '0000-00-00 00:00:00', 0, '2016-07-18 19:04:46', 1),
(90, 25, 4, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:04:46', 1),
(91, 25, 5, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:04:46', 1),
(92, 26, 1, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:05:03', 1),
(93, 26, 2, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:05:03', 1),
(94, 26, 3, 21000, '0000-00-00 00:00:00', 0, '2016-07-18 19:05:03', 1),
(95, 26, 4, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:05:03', 1),
(96, 26, 5, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:05:03', 1),
(97, 27, 1, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:05:16', 1),
(98, 27, 2, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:05:16', 1),
(99, 27, 3, 22000, '0000-00-00 00:00:00', 0, '2016-07-18 19:05:16', 1),
(100, 27, 4, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:05:16', 1),
(101, 27, 5, 0, '0000-00-00 00:00:00', 0, '2016-07-18 19:05:16', 1),
(102, 19, 1, 90, '0000-00-00 00:00:00', 0, '2016-07-27 10:41:56', 1),
(103, 19, 2, 0, '0000-00-00 00:00:00', 0, '2016-07-27 10:41:56', 1),
(104, 19, 3, 0, '0000-00-00 00:00:00', 0, '2016-07-27 10:41:56', 1),
(105, 19, 4, 0, '0000-00-00 00:00:00', 0, '2016-07-27 10:41:56', 1),
(106, 19, 5, 0, '0000-00-00 00:00:00', 0, '2016-07-27 10:41:56', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_suppliers`
--

CREATE TABLE IF NOT EXISTS `as_suppliers` (
  `supplierID` int(11) NOT NULL AUTO_INCREMENT,
  `supplierCode` varchar(10) NOT NULL,
  `supplierName` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `contactPerson` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `balance` double NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`supplierID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `as_suppliers`
--

INSERT INTO `as_suppliers` (`supplierID`, `supplierCode`, `supplierName`, `address`, `city`, `phone`, `fax`, `contactPerson`, `email`, `balance`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(1, '00001', 'CV. ASFA SOLUTION', 'JL. PEGADAIAN NO. 38 ARJAWINANGUN', 'CIREBON,45162', '0231-358630', '-', 'AGUS SAPUTRA', 'agus.saputra@asfasolution.com', 0, '2014-11-11 22:26:28', 1, '2014-11-11 22:32:44', 1),
(2, '00002', 'PT. MITRACOMM EKASARANA', 'JL. IDE AGUNG ANAK AGUNG KAV. E3 NO. 2', '', '', '', 'HENDRO PURWADI', '', 31594.58, '2014-11-11 22:28:00', 1, '2014-11-11 22:32:50', 1),
(4, '00003', 'PT. INDOSYSTEM GLOBAL', 'JL. PEKALIPAN NO. 9', 'CIREBON', '', '', 'EDY SENJAYA', '', 0, '2014-11-11 22:33:19', 1, '0000-00-00 00:00:00', 0),
(5, '00004', 'Penerbit Al Waie', 'Bogor', 'Bogor', '08121100564', '', 'Anwar 1', 'anwar@gmail.com', 0, '2016-07-18 04:47:19', 1, '2016-07-18 04:48:32', 1),
(6, '00005', 'Penerbit Buku', 'Bogor', 'Bogor', '08121100564', '', 'Anwar 2', 'anwar2@gmail.com', 0, '2016-07-18 04:48:19', 1, '0000-00-00 00:00:00', 0),
(7, '00006', 'Penerbit Media Umat', 'Jakarta', 'Jakarta', '08121100564', '', 'Anwar 3', 'anwar3@gmail.com', 0, '2016-07-18 04:49:15', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_temp_detail_so`
--

CREATE TABLE IF NOT EXISTS `as_temp_detail_so` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `soNo` varchar(20) NOT NULL,
  `soFaktur` varchar(20) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`detailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `as_temp_detail_so`
--

INSERT INTO `as_temp_detail_so` (`detailID`, `soNo`, `soFaktur`, `productID`, `productName`, `price`, `qty`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(1, 'SO000007', '20160717081540', 25, '00008 MU 175', 4000, 10000, '', '2016-07-17 20:17:26', 1, '0000-00-00 00:00:00', 0),
(2, 'SO000007', '20160717081540', 26, '00009 MU 176', 4000, 9000, '', '2016-07-17 20:20:41', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_temp_detail_spb`
--

CREATE TABLE IF NOT EXISTS `as_temp_detail_spb` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `spbNo` varchar(20) NOT NULL,
  `spbFaktur` varchar(20) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`detailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `as_temp_detail_spb`
--

INSERT INTO `as_temp_detail_spb` (`detailID`, `spbNo`, `spbFaktur`, `productID`, `productName`, `price`, `qty`, `note`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(1, 'PO000007', '20160103125810', 2, '00002 CAMSHAFT', 62706, 2, '-', '2016-01-03 12:58:38', 1, '0000-00-00 00:00:00', 0),
(2, 'PO000007', '20160103125810', 7, '00007 CRANKCASE COVER', 167499, 1, '', '2016-01-03 13:56:51', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `as_temp_detail_transfers`
--

CREATE TABLE IF NOT EXISTS `as_temp_detail_transfers` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `transferCode` varchar(10) NOT NULL,
  `transferFaktur` varchar(20) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`detailID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `as_temp_detail_transfers`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `as_transfers`
--

CREATE TABLE IF NOT EXISTS `as_transfers` (
  `transferID` int(11) NOT NULL AUTO_INCREMENT,
  `transferCode` varchar(10) NOT NULL,
  `transferFaktur` varchar(20) NOT NULL,
  `ref` varchar(20) NOT NULL,
  `trxDate` date NOT NULL,
  `note` text NOT NULL,
  `transferFrom` int(11) NOT NULL,
  `transferTo` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdUserID` int(11) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `modifiedUserID` int(11) NOT NULL,
  PRIMARY KEY (`transferID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `as_transfers`
--

INSERT INTO `as_transfers` (`transferID`, `transferCode`, `transferFaktur`, `ref`, `trxDate`, `note`, `transferFrom`, `transferTo`, `createdDate`, `createdUserID`, `modifiedDate`, `modifiedUserID`) VALUES
(3, '000001', '20141123094311', '08562121141', '2014-11-23', 'Stok minimal', 1, 3, '2014-11-23 09:43:23', 1, '0000-00-00 00:00:00', 0),
(6, '000002', '20141123102902', '3740531645', '2014-11-23', 'Dibutuhkan di Gudang B dan Gudang B stok habis', 1, 2, '2014-11-23 10:29:04', 1, '0000-00-00 00:00:00', 0),
(7, '000003', '20160108054821', '-', '2016-01-08', '-', 1, 5, '2016-01-08 17:48:32', 1, '0000-00-00 00:00:00', 0);
