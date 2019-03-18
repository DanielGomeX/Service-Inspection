-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 18, 2019 at 07:45 AM
-- Server version: 5.7.23
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_serviceinspection`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `carId` int(11) NOT NULL AUTO_INCREMENT,
  `carModel` varchar(100) NOT NULL,
  `plateNumber` varchar(50) NOT NULL,
  `customerId` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`carId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`carId`, `carModel`, `plateNumber`, `customerId`, `status`, `dateCreated`) VALUES
(1, 'Volvo S60 Cross Country', '6G5-24KV', 1, 1, '2019-03-18 14:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customerId` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `contactNumber` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customerId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerId`, `fullname`, `contactNumber`, `address`, `status`, `dateCreated`, `dateUpdated`) VALUES
(1, 'Jennie Kim', '0941-361-8692', 'South Korea', 1, '2019-03-18 06:49:43', '2019-03-18 06:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `inspections`
--

DROP TABLE IF EXISTS `inspections`;
CREATE TABLE IF NOT EXISTS `inspections` (
  `inspectionId` int(11) NOT NULL AUTO_INCREMENT,
  `lubrication` text NOT NULL,
  `underhood` text NOT NULL,
  `road` text NOT NULL,
  `carId` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`inspectionId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspections`
--

INSERT INTO `inspections` (`inspectionId`, `lubrication`, `underhood`, `road`, `carId`, `status`, `dateCreated`, `dateUpdated`) VALUES
(1, '1,2,6,7,9', '10,11,13,14,17,18,19,22,23,24', '25,26,28', 1, 1, '2019-03-18 14:50:20', '2019-03-18 14:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `inspection_fields`
--

DROP TABLE IF EXISTS `inspection_fields`;
CREATE TABLE IF NOT EXISTS `inspection_fields` (
  `fieldId` int(11) NOT NULL AUTO_INCREMENT,
  `fieldtxt` text NOT NULL,
  `category` enum('lubrication','underhood/chasis','road') NOT NULL DEFAULT 'lubrication',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fieldId`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspection_fields`
--

INSERT INTO `inspection_fields` (`fieldId`, `fieldtxt`, `category`, `status`, `dateCreated`, `dateUpdated`) VALUES
(1, 'Check/replace engine oil and filter', 'lubrication', 1, '2019-03-12 03:48:34', '2019-03-14 06:00:06'),
(2, 'Check/replace gearbox oil and filter', 'lubrication', 1, '2019-03-12 03:49:33', '2019-03-14 06:00:06'),
(3, 'Check/replace brakes, such as clutch master cylinder fluid', 'lubrication', 1, '2019-03-12 03:49:33', '2019-03-14 06:00:06'),
(4, 'Check power steering fluid', 'lubrication', 1, '2019-03-12 03:49:33', '2019-03-14 06:00:06'),
(5, 'Check/replace all drive axle fluid', 'lubrication', 1, '2019-03-12 03:49:33', '2019-03-14 06:00:06'),
(6, 'Check/replace case fluid (for 4X4/4WD)', 'lubrication', 1, '2019-03-12 03:49:33', '2019-03-14 06:00:06'),
(7, 'Check/replace fuel filter', 'lubrication', 1, '2019-03-12 03:49:33', '2019-03-14 06:00:06'),
(8, 'Check battery acid level', 'lubrication', 1, '2019-03-12 03:49:33', '2019-03-14 06:00:06'),
(9, 'Check/replace engine coolant glycol', 'lubrication', 1, '2019-03-12 03:49:33', '2019-03-14 06:00:06'),
(10, 'Check/replace air cleaner filter', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(11, 'Check/replace all belts and pulley', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(12, 'Check any lubrication leaking and noted', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(13, 'Check exhaust system for any damage and leaks', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(14, 'Check fuel, oil, brakes and vapour lines', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(15, 'Check all suspension components', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(16, 'Check ball joint seals and bushes', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(17, 'Check steering components', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(18, 'Check drive shaft and uni', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(19, 'Check tyres, rims for wear and damage, check air pressure', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(20, 'Check all electrical lights and function/wiper/battery test', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(21, 'Download engine if required for any faults', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(22, 'Download engine if required for any faults', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(23, 'Check for any damage and report', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(24, 'Torque all wheel nuts', 'underhood/chasis', 1, '2019-03-12 03:52:13', '2019-03-14 06:00:06'),
(25, 'Check steering, handbrakes and pedal (breaks, clutch) operation and suspension including seat belt', 'road', 1, '2019-03-12 03:55:16', '2019-03-14 06:00:06'),
(26, 'Check engine drivability', 'road', 1, '2019-03-12 03:55:16', '2019-03-14 06:00:06'),
(27, 'Check lighting operation (instrument panel, interior)', 'road', 1, '2019-03-12 03:55:16', '2019-03-14 06:00:06'),
(28, 'Check any abnormalities while driving and report', 'road', 1, '2019-03-12 03:55:16', '2019-03-14 06:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `role`, `status`, `dateCreated`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1, '2019-03-06 01:40:18'),
(2, 'jjbmarababol', 'df6d6eb09574d22a69aaa4c576d06141', 'admin', 1, '2019-03-18 03:55:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
