-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2016 at 07:02 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aarh`
--
CREATE DATABASE IF NOT EXISTS `aarh` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `aarh`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_ID` int(11) NOT NULL AUTO_INCREMENT,
  `admin_Name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `CNIC` varchar(30) NOT NULL,
  PRIMARY KEY (`admin_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_ID` int(11) NOT NULL AUTO_INCREMENT,
  `city_Name` varchar(30) NOT NULL,
  PRIMARY KEY (`city_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_ID`, `city_Name`) VALUES
(1, 'Karachi'),
(2, 'Islamabad');

-- --------------------------------------------------------

--
-- Table structure for table `constituency`
--

CREATE TABLE IF NOT EXISTS `constituency` (
  `const_ID` int(11) NOT NULL AUTO_INCREMENT,
  `city_ID` int(11) NOT NULL,
  `const_Name` varchar(10) NOT NULL,
  PRIMARY KEY (`const_ID`),
  UNIQUE KEY `const_Name` (`const_Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `constituency`
--

INSERT INTO `constituency` (`const_ID`, `city_ID`, `const_Name`) VALUES
(1, 1, 'NA-1'),
(2, 2, 'NA-22'),
(3, 1, 'NA-2');

-- --------------------------------------------------------

--
-- Table structure for table `nominee`
--

CREATE TABLE IF NOT EXISTS `nominee` (
  `nominee_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CNIC` varchar(30) NOT NULL,
  `party_ID` int(11) NOT NULL,
  `const_ID` int(11) NOT NULL,
  PRIMARY KEY (`nominee_ID`),
  UNIQUE KEY `CNIC` (`CNIC`),
  UNIQUE KEY `party_ID` (`party_ID`,`const_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `nominee`
--

INSERT INTO `nominee` (`nominee_ID`, `CNIC`, `party_ID`, `const_ID`) VALUES
(13, '42101-3978849-9', 2, 1),
(14, '42101-9959672-9', 2, 3),
(15, '42101-1234567-8', 3, 2),
(16, '49843-9483948-3', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE IF NOT EXISTS `party` (
  `party_ID` int(11) NOT NULL AUTO_INCREMENT,
  `party_Name` varchar(255) NOT NULL,
  `party_Flag` varchar(255) NOT NULL,
  PRIMARY KEY (`party_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`party_ID`, `party_Name`, `party_Flag`) VALUES
(2, 'PTI', 'upload/pti.jpg'),
(3, 'PMLN', 'upload/pmln.jpg'),
(4, 'PPP', 'upload/ppp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pollingstation`
--

CREATE TABLE IF NOT EXISTS `pollingstation` (
  `poll_ID` int(11) NOT NULL AUTO_INCREMENT,
  `poll_Name` varchar(255) NOT NULL,
  `town_ID` int(11) NOT NULL,
  PRIMARY KEY (`poll_ID`),
  UNIQUE KEY `town_ID` (`town_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pollingstation`
--

INSERT INTO `pollingstation` (`poll_ID`, `poll_Name`, `town_ID`) VALUES
(1, 'tesd', 13),
(2, 'Test', 16),
(3, 'Poll', 14);

-- --------------------------------------------------------

--
-- Table structure for table `ro`
--

CREATE TABLE IF NOT EXISTS `ro` (
  `ro_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CNIC` varchar(30) NOT NULL,
  `poll_ID` int(11) NOT NULL,
  `proctoringKey` varchar(30) NOT NULL,
  PRIMARY KEY (`ro_ID`),
  UNIQUE KEY `CNIC` (`CNIC`,`poll_ID`),
  UNIQUE KEY `proctoringKey` (`proctoringKey`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ro`
--

INSERT INTO `ro` (`ro_ID`, `CNIC`, `poll_ID`, `proctoringKey`) VALUES
(2, '42101-3978849-9', 3, 'hassan');

-- --------------------------------------------------------

--
-- Table structure for table `town`
--

CREATE TABLE IF NOT EXISTS `town` (
  `town_ID` int(11) NOT NULL AUTO_INCREMENT,
  `town_Name` varchar(100) NOT NULL,
  `city_ID` int(11) NOT NULL,
  `const_ID` int(11) NOT NULL,
  PRIMARY KEY (`town_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `town`
--

INSERT INTO `town` (`town_ID`, `town_Name`, `city_ID`, `const_ID`) VALUES
(13, 'New Karachi', 1, 1),
(14, 'North Karachi', 1, 1),
(15, 'D-8', 2, 2),
(16, 'Mehmoodabad', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `vote_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CNIC` varchar(30) NOT NULL,
  `poll_ID` int(11) NOT NULL,
  `nominee_ID` int(11) NOT NULL,
  PRIMARY KEY (`vote_ID`),
  UNIQUE KEY `CNIC` (`CNIC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE IF NOT EXISTS `voter` (
  `CNIC` varchar(255) NOT NULL,
  `voter_Name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobileNumber` varchar(30) NOT NULL,
  `town_ID` int(11) NOT NULL,
  `city_ID` int(11) NOT NULL,
  PRIMARY KEY (`CNIC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`CNIC`, `voter_Name`, `gender`, `address`, `mobileNumber`, `town_ID`, `city_ID`) VALUES
('42101-1234567-8', 'Nawaz', 'm', 'Islamabad', '6544-5455354', 15, 2),
('42101-3978849-9', 'Muhammad Hassan Azam', 'm', 'R123, Sector D-9', '0334-3387918', 14, 1),
('42101-9959672-9', 'Abdul Basit', 'm', 'Sector 5-L', '0347-2452335', 14, 1),
('49843-9483948-3', 'Syed Rafay', 'm', 'NED', '2545-4545454', 16, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
