-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2017 at 07:05 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scoreduino`
--
CREATE DATABASE IF NOT EXISTS `scoreduino` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `scoreduino`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_league`
--

DROP TABLE IF EXISTS `tbl_league`;
CREATE TABLE `tbl_league` (
  `leagueId` int(11) NOT NULL,
  `leagueName` varchar(100) NOT NULL,
  `venue` text NOT NULL,
  `dayRange` int(11) NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_league`
--

INSERT INTO `tbl_league` (`leagueId`, `leagueName`, `venue`, `dayRange`, `description`, `status`, `dateCreated`) VALUES
(1, 'Intramural 2017', 'ACLC College of Mandaue, Mandaue City', 2, 'A series of contests between a number of competitors, who compete for an overall prize.', '1', '2017-06-21 07:54:45'),
(2, 'La Liga Filipinas', 'Univeristy of Cebu - Lapu-Lapu and Mandaue, Mandaue City', 1, 'It is the event of commemorating the sportsmanship in the philippines', '1', '2017-07-13 04:51:01'),
(3, 'Acquaintance Party 2017', 'University of San Jose Recoletos, Cebu City', 3, 'The battle of gowns and formal attires.', '1', '2017-07-10 05:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_match`
--

DROP TABLE IF EXISTS `tbl_match`;
CREATE TABLE `tbl_match` (
  `matchId` int(11) NOT NULL,
  `teamOne` varchar(50) NOT NULL,
  `teamTwo` varchar(50) NOT NULL,
  `scoreOne` int(11) NOT NULL DEFAULT '0',
  `scoreTwo` int(11) NOT NULL DEFAULT '0',
  `sportId` int(11) NOT NULL,
  `leagueId` int(11) NOT NULL,
  `scorePerSet` int(11) NOT NULL DEFAULT '0',
  `numSet` int(11) NOT NULL DEFAULT '0',
  `category` enum('Ongoing','On-hold','Finished','Upcoming') NOT NULL DEFAULT 'Upcoming',
  `division` enum('Men','Women','All') NOT NULL DEFAULT 'All',
  `matchType` enum('Singles','Doubles','Triples','Teams') NOT NULL DEFAULT 'Teams',
  `roundType` enum('Elimination','Championship') NOT NULL DEFAULT 'Elimination',
  `tournamentType` enum('Single Elimination','Double Elimination','Multilevel','Round Robin','Extended') NOT NULL DEFAULT 'Single Elimination',
  `forfeit` enum('0','1') NOT NULL DEFAULT '0',
  `datetimeStart` datetime NOT NULL,
  `scorerId` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_match`
--

INSERT INTO `tbl_match` (`matchId`, `teamOne`, `teamTwo`, `scoreOne`, `scoreTwo`, `sportId`, `leagueId`, `scorePerSet`, `numSet`, `category`, `division`, `matchType`, `roundType`, `tournamentType`, `forfeit`, `datetimeStart`, `scorerId`, `status`, `dateCreated`) VALUES
(1, 'Giallo', 'Vierrdy', 3, 1, 2, 1, 25, 4, 'Ongoing', 'Men', 'Teams', 'Elimination', 'Single Elimination', '0', '2017-09-15 08:00:00', 1, '1', '2017-06-19 03:12:52'),
(3, 'Roxxo', 'Vierrdy', 2, 0, 2, 1, 5, 2, 'Finished', 'Men', 'Teams', 'Championship', 'Multilevel', '1', '2017-09-21 14:00:00', 3, '1', '2017-08-26 07:28:38'),
(4, 'Roxxo', 'Vierrdy', 22, 8, 1, 1, 11, 4, 'Finished', 'Women', 'Teams', 'Championship', 'Multilevel', '0', '2017-10-07 03:30:00', 2, '1', '2017-09-18 10:16:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_matchlog`
--

DROP TABLE IF EXISTS `tbl_matchlog`;
CREATE TABLE `tbl_matchlog` (
  `matchlogId` int(11) NOT NULL,
  `matchId` int(11) NOT NULL,
  `teamScore` int(11) NOT NULL DEFAULT '0',
  `teamName` varchar(50) NOT NULL,
  `setNo` int(11) NOT NULL DEFAULT '1',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_matchlog`
--

INSERT INTO `tbl_matchlog` (`matchlogId`, `matchId`, `teamScore`, `teamName`, `setNo`, `status`, `dateCreated`) VALUES
(3, 1, 2, 'Giallo', 1, '1', '2017-06-19 03:13:41'),
(4, 1, 6, 'Giallo', 2, '1', '2017-06-19 03:13:41'),
(11, 1, 2, 'Vierrdy', 3, '1', '2017-08-26 07:22:05'),
(13, 1, 2, 'Giallo', 4, '1', '2017-08-26 07:26:19'),
(15, 1, 2, 'Vierrdy', 1, '1', '2017-08-26 07:38:26'),
(18, 1, 2, 'Vierrdy', 2, '1', '2017-08-26 07:39:20'),
(19, 1, 4, 'Giallo', 3, '1', '2017-08-26 07:40:53'),
(20, 1, 3, 'Giallo', 4, '1', '2017-08-26 07:41:50'),
(22, 1, 2, 'Giallo', 1, '1', '2017-08-26 07:43:53'),
(23, 1, 3, 'Vierrdy', 2, '1', '2017-09-09 05:25:24'),
(42, 1, 1, 'Vierrdy', 3, '1', '2017-09-09 12:29:09'),
(43, 1, 18, 'Vierrdy', 4, '1', '2017-09-25 10:20:26'),
(44, 1, 3, 'Giallo', 1, '1', '2017-09-25 10:24:59'),
(45, 4, 2, 'Roxxo', 1, '1', '2017-06-19 03:13:41'),
(46, 4, 10, 'Roxxo', 2, '1', '2017-06-19 03:13:41'),
(47, 4, 2, 'Vierrdy', 3, '1', '2017-08-26 07:22:05'),
(48, 4, 2, 'Roxxo', 4, '1', '2017-08-26 07:26:19'),
(49, 3, 1, 'Vierrdy', 1, '1', '2017-08-26 07:38:26'),
(50, 3, 5, 'Roxxo', 2, '1', '2017-08-26 07:39:20'),
(51, 4, 2, 'Roxxo', 3, '1', '2017-08-26 07:40:53'),
(52, 4, 3, 'Roxxo', 4, '1', '2017-08-26 07:41:50'),
(53, 3, 2, 'Roxxo', 1, '1', '2017-08-26 07:43:53'),
(54, 3, 3, 'Vierrdy', 2, '1', '2017-09-09 05:25:24'),
(55, 4, 1, 'Vierrdy', 3, '1', '2017-09-09 12:29:09'),
(56, 4, 1, 'Vierrdy', 4, '1', '2017-09-25 10:20:26'),
(57, 4, 3, 'Roxxo', 1, '1', '2017-09-25 10:24:59'),
(58, 3, 1, 'Roxxo', 1, '1', '2017-10-27 14:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sports`
--

DROP TABLE IF EXISTS `tbl_sports`;
CREATE TABLE `tbl_sports` (
  `sportId` int(11) NOT NULL,
  `sportName` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `scorePerSet` int(11) NOT NULL DEFAULT '0',
  `numSet` int(11) NOT NULL DEFAULT '0',
  `scoreType` enum('Point','Rally') NOT NULL DEFAULT 'Rally',
  `createdBy` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sports`
--

INSERT INTO `tbl_sports` (`sportId`, `sportName`, `description`, `scorePerSet`, `numSet`, `scoreType`, `createdBy`, `status`, `dateCreated`) VALUES
(1, 'Basketball', 'Basketball is a non-contact sport played on a rectangular court.', 60, 4, 'Point', 1, '1', '2017-06-19 01:39:03'),
(2, 'Volleyball', 'Volleyball is a team sport in which two teams of six players are separated by a net.', 25, 2, 'Rally', 1, '1', '2017-06-19 01:39:03'),
(3, 'Badminton', 'Badminton is a racquet sport played using racquets to hit a shuttlecock across a net.', 22, 4, 'Rally', 1, '1', '2017-06-19 01:39:03'),
(5, 'Table Tennis', 'Table tennis, also known as ping pong, is a sport in which two or four players hit a lightweight ball back and forth across a table using a small bat. ', 11, 3, 'Rally', 1, '1', '2017-06-19 01:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team`
--

DROP TABLE IF EXISTS `tbl_team`;
CREATE TABLE `tbl_team` (
  `teamId` int(11) NOT NULL,
  `teamName` varchar(50) NOT NULL,
  `shortCode` varchar(2) NOT NULL,
  `description` text NOT NULL,
  `createdBy` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_team`
--

INSERT INTO `tbl_team` (`teamId`, `teamName`, `shortCode`, `description`, `createdBy`, `status`, `dateCreated`) VALUES
(1, 'Giallo', 'GL', 'A group of people linked in a common purpose.', 1, '1', '2017-06-19 01:41:24'),
(2, 'Vierrdy', 'VR', 'Operates with a high degree of interdependence', 1, '1', '2017-06-19 01:41:24'),
(3, 'Azul', 'AZ', 'Shares authority and responsibility for self-management', 1, '1', '2017-06-19 01:41:24'),
(4, 'Cahel', 'CA', 'Accountable for the collective performance.', 1, '1', '2017-06-19 01:41:24'),
(5, 'Roxxo', 'RO', 'Appropriate for conducting tasks that are high in complexity', 1, '1', '2017-06-19 01:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `userId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `image` varchar(150) NOT NULL,
  `role` enum('Admin','User') NOT NULL DEFAULT 'User',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userId`, `username`, `password`, `firstName`, `middleName`, `lastName`, `email`, `address`, `gender`, `image`, `role`, `status`, `dateCreated`) VALUES
(2, 'logicgates', '21232f297a57a5a743894a0e4a801fc3', 'Jig James', 'Baguio', 'Marababol', 'jigjames@ymail.com', '38 Casa Nuestra, Bankal, Lapu-Lapu City', 'Male', '', 'User', '1', '2017-06-17 03:45:58'),
(3, 'fumionoguchi', '21232f297a57a5a743894a0e4a801fc3', 'Fumio', 'Sanchez', 'Noguchi', 'fumionoguchi@yahoo.com', 'Wonderland, Creamland city', 'Male', '', 'User', '1', '2017-06-17 03:45:58'),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Core', 'Mister', 'adminislyp@gmail.com', '38 Casa Nuestra, Bankal, Lapu-Lapu City', 'Female', '', 'Admin', '1', '2017-10-09 05:00:01'),
(6, 'luigi', '291ada6600d29fc6e48fe1d44a55f3d4', 'Luigi', 'Mario', 'Castillo', 'luigicastillo@gmail.com', 'Danao City', 'Male', '', 'Admin', '1', '2017-10-09 05:38:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_league`
--
ALTER TABLE `tbl_league`
  ADD PRIMARY KEY (`leagueId`);

--
-- Indexes for table `tbl_match`
--
ALTER TABLE `tbl_match`
  ADD PRIMARY KEY (`matchId`);

--
-- Indexes for table `tbl_matchlog`
--
ALTER TABLE `tbl_matchlog`
  ADD PRIMARY KEY (`matchlogId`);

--
-- Indexes for table `tbl_sports`
--
ALTER TABLE `tbl_sports`
  ADD PRIMARY KEY (`sportId`);

--
-- Indexes for table `tbl_team`
--
ALTER TABLE `tbl_team`
  ADD PRIMARY KEY (`teamId`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_league`
--
ALTER TABLE `tbl_league`
  MODIFY `leagueId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_match`
--
ALTER TABLE `tbl_match`
  MODIFY `matchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_matchlog`
--
ALTER TABLE `tbl_matchlog`
  MODIFY `matchlogId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `tbl_sports`
--
ALTER TABLE `tbl_sports`
  MODIFY `sportId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_team`
--
ALTER TABLE `tbl_team`
  MODIFY `teamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
