-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 19, 2021 at 08:43 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestate`
--
CREATE DATABASE IF NOT EXISTS `realestate` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `realestate`;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `Id` int(18) NOT NULL AUTO_INCREMENT,
  `Name` char(18) CHARACTER SET latin2 COLLATE latin2_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`Id`, `Name`) VALUES
(1, 'DodavanjeOglasa'),
(2, 'Komentarisanje');

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`Id`, `Username`, `Password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

DROP TABLE IF EXISTS `advertisement`;
CREATE TABLE IF NOT EXISTS `advertisement` (
  `IdOwner` int(11) DEFAULT NULL,
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Time` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  `Price` int(11) DEFAULT NULL,
  `Topic` varchar(20) CHARACTER SET latin2 COLLATE latin2_croatian_ci DEFAULT NULL,
  `Size` int(18) DEFAULT NULL,
  `Address` char(30) CHARACTER SET latin2 COLLATE latin2_croatian_ci DEFAULT NULL,
  `IdPlace` int(11) NOT NULL,
  `Description` char(200) CHARACTER SET latin2 COLLATE latin2_croatian_ci DEFAULT NULL,
  `Purpose` varchar(20) NOT NULL,
  `RealEstateType` varchar(30) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `R_8` (`IdOwner`),
  KEY `R_12` (`IdPlace`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`IdOwner`, `Id`, `Time`, `Price`, `Topic`, `Size`, `Address`, `IdPlace`, `Description`, `Purpose`, `RealEstateType`) VALUES
(119, 63, '2021-06-19 20:37:35.844191', 76000, 'Stan u Pozeskoj', 50, 'Pozeska 120', 1, 'Stan je u dobro ocuvanom stanju.', 'izdavanje', 'stan'),
(119, 64, '2021-06-19 20:39:54.018139', 30000, 'Stan u Kotezu', 25, 'Uzdinska 12', 3, 'Stan je u dobrom delu naselja.', 'prodaja', 'stan'),
(118, 62, '2021-06-19 20:30:26.783848', 400, 'Stan Banjica', 100, 'Paunova 20', 7, 'Stan je na 7. spratu.', 'izdavanje', 'stan'),
(117, 60, '2021-06-19 20:26:06.923287', 300, 'Stan Vojvode Stepe', 80, 'Vojvode Stepe 120', 7, 'Stan je dobro pozicioniran ima velike spavace sobe.', 'izdavanje', 'stan'),
(115, 57, '2021-06-19 20:15:16.357816', 120000, 'Stan Banovo Brdo', 80, 'Izvorska 12', 1, 'Stan je okrenut prema zapadu u zgradi na 5 spratova. Odlicna lokacija', 'prodaja', 'stan'),
(115, 58, '2021-06-19 20:19:31.100011', 80000, 'Kuca u Lipovici', 200, 'Lipovacke sume 6', 11, 'Kuca je lepa ima veliko dvoriste, u zdravoj sredini.', 'prodaja', 'kuca'),
(117, 61, '2021-06-19 20:27:19.540387', 60000, 'Stan na Ceraku', 45, 'Cerski Venac 2', 1, 'Stan ima veliku terasu', 'izdavanje', 'stan');

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

DROP TABLE IF EXISTS `agency`;
CREATE TABLE IF NOT EXISTS `agency` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) CHARACTER SET latin2 COLLATE latin2_croatian_ci DEFAULT NULL,
  `AverageMark` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`Id`, `Name`, `AverageMark`) VALUES
(118, 'Success', '3.50');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `Description` varchar(200) CHARACTER SET latin2 COLLATE latin2_croatian_ci DEFAULT NULL,
  `IdK` int(11) NOT NULL,
  `IdAd` int(11) NOT NULL,
  `Time` timestamp NULL DEFAULT NULL,
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`),
  KEY `R_20` (`IdAd`),
  KEY `IdK` (`IdK`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`Description`, `IdK`, `IdAd`, `Time`, `Id`) VALUES
('Mozda tebi, meni nije', 115, 62, '2021-06-19 20:41:58', 36),
('Stan je sjajan, odlicna ponuda!', 119, 62, '2021-06-19 20:41:06', 35),
('Hitna prodaja', 115, 57, '2021-06-19 20:17:07', 34);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `IdU` int(11) NOT NULL,
  `IdAd` int(11) NOT NULL,
  PRIMARY KEY (`IdU`,`IdAd`),
  KEY `R_24` (`IdAd`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`IdU`, `IdAd`) VALUES
(116, 57),
(116, 58);

-- --------------------------------------------------------

--
-- Table structure for table `hastag`
--

DROP TABLE IF EXISTS `hastag`;
CREATE TABLE IF NOT EXISTS `hastag` (
  `IdAd` int(11) NOT NULL,
  `IdTag` int(11) NOT NULL,
  PRIMARY KEY (`IdAd`,`IdTag`),
  KEY `R_15` (`IdTag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hastag`
--

INSERT INTO `hastag` (`IdAd`, `IdTag`) VALUES
(57, 1),
(57, 2),
(57, 6),
(57, 7),
(57, 11),
(57, 13),
(58, 2),
(58, 5),
(58, 6),
(58, 7),
(58, 14),
(60, 1),
(60, 2),
(60, 4),
(60, 5),
(60, 6),
(60, 7),
(60, 10),
(60, 11),
(60, 13),
(61, 1),
(61, 2),
(61, 5),
(61, 6),
(61, 7),
(61, 11),
(61, 13),
(62, 2),
(62, 5),
(62, 6),
(62, 7),
(62, 8),
(62, 10),
(62, 11),
(62, 13),
(63, 1),
(63, 2),
(63, 5),
(63, 7),
(63, 8),
(63, 11),
(63, 12),
(63, 13),
(64, 2),
(64, 5),
(64, 6),
(64, 7),
(64, 11),
(64, 13);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) DEFAULT NULL,
  `IdAd` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `R_17` (`IdAd`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`Id`, `filename`, `IdAd`) VALUES
(123, '291405953.jpg', 63),
(122, '207598224.jpg', 63),
(120, '17.jpg', 62),
(121, 'belvil.jpg', 63),
(119, 'images.jpg', 62),
(117, '291405953.jpg', 62),
(116, '291405953.jpg', 61),
(115, '17.jpg', 61),
(114, '291405953.jpg', 61),
(113, '51500984.jpg', 60),
(112, '291405953.jpg', 60),
(111, '207598224.jpg', 60),
(107, '207598224.jpg', 58),
(106, '291405953.jpg', 58),
(105, '195243123_646101153012500_4216547366353667123_n.jpg', 58),
(104, 'msa58dz5ak-belville-03.jpg', 57),
(101, '51500984.jpg', 57),
(102, '17.jpg', 57),
(103, '207598224.jpg', 57),
(118, '51500984.jpg', 62);

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

DROP TABLE IF EXISTS `mark`;
CREATE TABLE IF NOT EXISTS `mark` (
  `IdK` int(11) NOT NULL,
  `IdA` int(11) NOT NULL,
  `Number` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdK`,`IdA`),
  KEY `R_22` (`IdA`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`IdK`, `IdA`, `Number`) VALUES
(117, 62, 2),
(115, 62, 5);

-- --------------------------------------------------------

--
-- Table structure for table `municipality`
--

DROP TABLE IF EXISTS `municipality`;
CREATE TABLE IF NOT EXISTS `municipality` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) CHARACTER SET latin2 COLLATE latin2_croatian_ci DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `municipality`
--

INSERT INTO `municipality` (`Id`, `Name`, `City`) VALUES
(1, 'Čukarica', 'Beograd'),
(2, 'Novi Beograd', 'Beograd'),
(3, 'Palilula', 'Beograd'),
(4, 'Rakovica', 'Beograd'),
(5, 'Savski venac', 'Beograd'),
(6, 'Stari grad', 'Beograd'),
(7, 'Voždovac', 'Beograd'),
(8, 'Vračar', 'Beograd'),
(9, 'Zemun', 'Beograd'),
(10, 'Zvezdara', 'Beograd'),
(11, 'Barajevo', 'Beograd'),
(12, 'Grocka', 'Beograd'),
(13, 'Lazarevac', 'Beograd'),
(14, 'Mladenovac', 'Beograd'),
(15, 'Obrenovac', 'Beograd'),
(16, 'Sopot', 'Beograd'),
(17, 'Surčin', 'Beograd');

-- --------------------------------------------------------

--
-- Table structure for table `privilegeduser`
--

DROP TABLE IF EXISTS `privilegeduser`;
CREATE TABLE IF NOT EXISTS `privilegeduser` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `Surname` varchar(30) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privilegeduser`
--

INSERT INTO `privilegeduser` (`Id`, `Name`, `Surname`) VALUES
(119, 'Emilija', 'Petrovic'),
(117, 'Danilo', 'Vucinic'),
(115, 'Aleksandar', 'Radosevic');

-- --------------------------------------------------------

--
-- Table structure for table `prohibition`
--

DROP TABLE IF EXISTS `prohibition`;
CREATE TABLE IF NOT EXISTS `prohibition` (
  `IdA` int(18) NOT NULL,
  `IdU` int(11) NOT NULL,
  PRIMARY KEY (`IdA`,`IdU`),
  KEY `R_29` (`IdU`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `realestatetype`
--

DROP TABLE IF EXISTS `realestatetype`;
CREATE TABLE IF NOT EXISTS `realestatetype` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(20) CHARACTER SET latin2 COLLATE latin2_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realestatetype`
--

INSERT INTO `realestatetype` (`Id`, `Name`) VALUES
(1, 'stan'),
(2, 'kuca');

-- --------------------------------------------------------

--
-- Table structure for table `registereduser`
--

DROP TABLE IF EXISTS `registereduser`;
CREATE TABLE IF NOT EXISTS `registereduser` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `Surname` varchar(30) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registereduser`
--

INSERT INTO `registereduser` (`Id`, `Name`, `Surname`) VALUES
(116, 'Luka', 'Juskovic  ');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `IdTag` int(11) NOT NULL,
  `Name` varchar(20) CHARACTER SET latin2 COLLATE latin2_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`IdTag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`IdTag`, `Name`) VALUES
(1, 'Potkrovlje'),
(2, 'Uknjizen'),
(3, 'Hitna prodaja'),
(4, 'Garaza'),
(5, 'Lift'),
(6, 'Terasa'),
(7, 'Podrum'),
(8, 'Penthouse'),
(9, 'Nova gradnja'),
(10, 'Stara gradnja'),
(11, 'Izvorno Stanje'),
(12, 'Renovirano'),
(13, 'Lux'),
(14, 'Za renoviranje');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Username`, `Password`, `Email`, `Phone`) VALUES
(119, 'Emilija', 'emilija', 'emiljaP@gmail.com', '064987098'),
(118, 'Agencija1', 'agencija1', 'agencija1@gmail.com', '0641748098'),
(115, 'Aleksandar', 'aleksandar', 'aradosevic40@gmail.com', '063212345'),
(116, 'Luka', 'luka123', 'lukaJuskovic@gmail.com', '0641234567'),
(117, 'Danilo', 'danilo', 'daniloV@yahoo.com', '0651233215');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
