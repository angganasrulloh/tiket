-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for tiket
CREATE DATABASE IF NOT EXISTS `tiket` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tiket`;


-- Dumping structure for table tiket.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `idKelas` int(3) NOT NULL AUTO_INCREMENT,
  `namaKelas` varchar(30) NOT NULL,
  `harga` int(12) NOT NULL,
  PRIMARY KEY (`idKelas`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table tiket.kelas: ~4 rows (approximately)
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` (`idKelas`, `namaKelas`, `harga`) VALUES
	(2, 'Bisnis', 90000),
	(3, 'Eksekutif', 100000),
	(4, 'Ekonomi', 70000),
	(5, 'Bisnis', 100000),
	(6, 'Eksekutif', 150000);
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;


-- Dumping structure for table tiket.kereta
CREATE TABLE IF NOT EXISTS `kereta` (
  `idKA` int(3) NOT NULL AUTO_INCREMENT,
  `namaKA` varchar(30) NOT NULL,
  `tanggalBerangkat` varchar(50) NOT NULL,
  `tanggalTiba` varchar(50) NOT NULL,
  `jamBerangkat` varchar(10) NOT NULL,
  `jamTiba` varchar(10) NOT NULL,
  `dari` varchar(30) NOT NULL,
  `ke` varchar(30) NOT NULL,
  `idKelas` int(3) NOT NULL,
  PRIMARY KEY (`idKA`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table tiket.kereta: ~4 rows (approximately)
/*!40000 ALTER TABLE `kereta` DISABLE KEYS */;
INSERT INTO `kereta` (`idKA`, `namaKA`, `tanggalBerangkat`, `tanggalTiba`, `jamBerangkat`, `jamTiba`, `dari`, `ke`, `idKelas`) VALUES
	(1, 'Argo Parahyangan', '01-09-2016', '02-09-2016', '06:00', '08:45', 'Gambir, Jakarta Pusat', 'Bandung, Bandung', 2),
	(2, 'Argo Parahyangan', '03-09-2016', '04-09-2016', '13:01', '15:00', 'Gambir, Jakarta Pusat', 'Surabaya', 3),
	(3, 'Argo Parahyangan', '05-09-2016', '06-09-2016', '03:00', '04:00', 'Surabaya', 'Jember', 2);
/*!40000 ALTER TABLE `kereta` ENABLE KEYS */;


-- Dumping structure for table tiket.pesan
CREATE TABLE IF NOT EXISTS `pesan` (
  `idPesan` int(5) NOT NULL AUTO_INCREMENT,
  `namaPemesan` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `noTelp` varchar(15) NOT NULL,
  `dewasa` int(11) NOT NULL,
  `anak` int(11) NOT NULL,
  `idKA` int(3) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`idPesan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table tiket.pesan: ~2 rows (approximately)
/*!40000 ALTER TABLE `pesan` DISABLE KEYS */;
INSERT INTO `pesan` (`idPesan`, `namaPemesan`, `alamat`, `noTelp`, `dewasa`, `anak`, `idKA`, `status`) VALUES
	(1, 'anton', 'bekasi', '123456789', 1, 1, 2, 'Y'),
	(2, 'Siska', 'Jakarta Selatan', '9876543210', 1, 0, 2, 'Y');
/*!40000 ALTER TABLE `pesan` ENABLE KEYS */;


-- Dumping structure for table tiket.user
CREATE TABLE IF NOT EXISTS `user` (
  `iduser` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table tiket.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`iduser`, `username`, `pass`, `level`) VALUES
	(1, 'admin', 'admin', 'admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
