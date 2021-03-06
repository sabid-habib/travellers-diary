-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2014 at 06:40 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

﻿--
-- Database: `tourism_management`
--
﻿
-- --------------------------------------------------------

--
-- Table structure for table `accomodation`
--

DROP TABLE IF EXISTS `accomodation`;
CREATE TABLE IF NOT EXISTS `accomodation` (
  `accom_id` int(8) NOT NULL AUTO_INCREMENT,
  `accom_type` varchar(16) DEFAULT NULL,
  `accom_name` varchar(24) NOT NULL,
  `site_id` int(8) NOT NULL,
  `minimum_price` int(10) DEFAULT NULL,
  `maximum_price` int(10) DEFAULT NULL,
  `contact_no` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`accom_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

DROP TABLE IF EXISTS `agency`;
CREATE TABLE IF NOT EXISTS `agency` (
  `agency_id` int(8) NOT NULL AUTO_INCREMENT,
  `agency_name` varchar(24) NOT NULL,
  `trade_id` int(8) DEFAULT NULL,
  `license_no` int(8) DEFAULT NULL,
  `validity_from` date DEFAULT NULL,
  `validity_till` date DEFAULT NULL,
  PRIMARY KEY (`agency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `agency_accomodation_contract`
--

DROP TABLE IF EXISTS `agency_accomodation_contract`;
CREATE TABLE IF NOT EXISTS `agency_accomodation_contract` (
  `agency_id` int(8) NOT NULL,
  `accom_id` int(8) NOT NULL,
  `discount` int(2) NOT NULL,
  UNIQUE KEY `agn_accom` (`accom_id`),
  KEY `agency_id` (`agency_id`,`accom_id`,`discount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `agency_restaurent_contract`
--

DROP TABLE IF EXISTS `agency_restaurent_contract`;
CREATE TABLE IF NOT EXISTS `agency_restaurent_contract` (
  `agency_id` int(8) NOT NULL,
  `restaurent_id` int(8) NOT NULL,
  `discount` int(2) NOT NULL,
  UNIQUE KEY `agn-rest` (`restaurent_id`),
  KEY `agency_id` (`agency_id`,`restaurent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `agency_transport_contract`
--

DROP TABLE IF EXISTS `agency_transport_contract`;
CREATE TABLE IF NOT EXISTS `agency_transport_contract` (
  `agency_id` int(8) NOT NULL,
  `transport_id` int(8) NOT NULL,
  `discount` int(2) NOT NULL,
  UNIQUE KEY `agn-trans` (`transport_id`),
  KEY `agency_id` (`agency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
CREATE TABLE IF NOT EXISTS `place` (
  `place_id` int(8) NOT NULL AUTO_INCREMENT,
  `place_name` varchar(20) NOT NULL,
  `division` varchar(16) NOT NULL,
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `restaurent`
--

DROP TABLE IF EXISTS `restaurent`;
CREATE TABLE IF NOT EXISTS `restaurent` (
  `rest_id` int(8) NOT NULL AUTO_INCREMENT,
  `rest_name` varchar(36) DEFAULT NULL,
  `rest_type` varchar(16) DEFAULT NULL,
  `site_id` int(8) NOT NULL,
  `min_price` int(8) DEFAULT NULL,
  `max_price` int(8) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`rest_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
  `site_id` int(8) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(24) NOT NULL,
  `place_id` int(8) NOT NULL,
  `loacetion` varchar(60) NOT NULL,
  PRIMARY KEY (`site_id`),
  KEY `place_id` (`place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

DROP TABLE IF EXISTS `transport`;
CREATE TABLE IF NOT EXISTS `transport` (
  `transport_id` int(8) NOT NULL AUTO_INCREMENT,
  `transport_type` varchar(20) NOT NULL,
  `transport_name` varchar(24) NOT NULL,
  `min_price` int(6) DEFAULT NULL,
  `max_price` int(6) DEFAULT NULL,
  `contact_no` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`transport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `transport_from_site`
--

DROP TABLE IF EXISTS `transport_from_site`;
CREATE TABLE IF NOT EXISTS `transport_from_site` (
  `transport_id` int(8) DEFAULT NULL,
  `site_id` int(8) DEFAULT NULL,
  UNIQUE KEY `site_from` (`site_id`),
  KEY `transport_id` (`transport_id`,`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `transport_to_site`
--

DROP TABLE IF EXISTS `transport_to_site`;
CREATE TABLE IF NOT EXISTS `transport_to_site` (
  `transport_id` int(8) DEFAULT NULL,
  `site_id` int(8) DEFAULT NULL,
  UNIQUE KEY `site_to` (`site_id`),
  KEY `transport_id` (`transport_id`,`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;
﻿
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accomodation`
--
ALTER TABLE `accomodation`
  ADD CONSTRAINT `accomodation_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `site` (`site_id`);

--
-- Constraints for table `agency_accomodation_contract`
--
ALTER TABLE `agency_accomodation_contract`
  ADD CONSTRAINT `agency_accomodation_contract_ibfk_2` FOREIGN KEY (`accom_id`) REFERENCES `accomodation` (`accom_id`),
  ADD CONSTRAINT `agency_accomodation_contract_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`);

--
-- Constraints for table `agency_restaurent_contract`
--
ALTER TABLE `agency_restaurent_contract`
  ADD CONSTRAINT `agency_restaurent_contract_ibfk_2` FOREIGN KEY (`restaurent_id`) REFERENCES `restaurent` (`rest_id`),
  ADD CONSTRAINT `agency_restaurent_contract_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`);

--
-- Constraints for table `agency_transport_contract`
--
ALTER TABLE `agency_transport_contract`
  ADD CONSTRAINT `agency_transport_contract_ibfk_2` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`transport_id`),
  ADD CONSTRAINT `agency_transport_contract_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`);

--
-- Constraints for table `restaurent`
--
ALTER TABLE `restaurent`
  ADD CONSTRAINT `restaurent_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `site` (`site_id`);

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`);

--
-- Constraints for table `transport_from_site`
--
ALTER TABLE `transport_from_site`
  ADD CONSTRAINT `transport_from_site_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `site` (`site_id`),
  ADD CONSTRAINT `transport_from_site_ibfk_1` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`transport_id`);

--
-- Constraints for table `transport_to_site`
--
ALTER TABLE `transport_to_site`
  ADD CONSTRAINT `transport_to_site_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `site` (`site_id`),
  ADD CONSTRAINT `transport_to_site_ibfk_1` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`transport_id`);
