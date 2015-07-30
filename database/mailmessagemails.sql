-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2015 at 06:32 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ezae1`
--

-- --------------------------------------------------------

--
-- Table structure for table `mailmessagemails`
--

CREATE TABLE IF NOT EXISTS `mailmessagemails` (
`seq` bigint(20) NOT NULL,
  `messageactionseq` bigint(20) DEFAULT NULL,
  `userseq` bigint(20) DEFAULT NULL,
  `adminseq` bigint(20) DEFAULT NULL,
  `failurecounter` int(11) DEFAULT NULL,
  `failureerror` varchar(1000) DEFAULT NULL,
  `savedon` datetime DEFAULT NULL,
  `senton` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mailmessagemails`
--
ALTER TABLE `mailmessagemails`
 ADD PRIMARY KEY (`seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mailmessagemails`
--
ALTER TABLE `mailmessagemails`
MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
