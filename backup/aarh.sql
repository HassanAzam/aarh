-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2016 at 03:49 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `nominee`
--

INSERT INTO `nominee` (`nominee_ID`, `CNIC`, `party_ID`, `const_ID`) VALUES
(1, '4210139788499', 2, 3),
(2, '42101', 5, 3),
(4, '4210155', 2, 4),
(6, '42101554', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE IF NOT EXISTS `party` (
  `party_ID` int(11) NOT NULL AUTO_INCREMENT,
  `party_Name` varchar(255) NOT NULL,
  `party_Flag` varchar(255) NOT NULL,
  PRIMARY KEY (`party_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ro`
--

CREATE TABLE IF NOT EXISTS `ro` (
  `ro_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CNIC` varchar(30) NOT NULL,
  `poll_ID` int(11) NOT NULL,
  PRIMARY KEY (`ro_ID`),
  UNIQUE KEY `CNIC` (`CNIC`,`poll_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
('42101-0012547-8', 'Abdul Moiz Khan', 'm', 'PECHS, Mehmoodabad', '0315-9845326', 16, 0),
('42101-3978849-9', 'Hassan Azam', 'm', '55/9, NEw Karachi', '0334-3387918', 0, 0),
('49843-9483948-3', 'Syed Rafay', 'm', 'NED', '2545-4545454', 16, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
