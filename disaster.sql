-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2014 at 07:30 AM
-- Server version: 5.1.73-community
-- PHP Version: 5.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `disaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `contributors`
--

CREATE TABLE IF NOT EXISTS `contributors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `street_village` varchar(255) NOT NULL,
  `postcode` varchar(50) NOT NULL,
  `salt` varchar(500) DEFAULT NULL,
  `national_id` varchar(50) DEFAULT NULL,
  `passport` varchar(50) DEFAULT NULL,
  `birth_date` varchar(255) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `email_activated` enum('0','1') NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `victims`
--

CREATE TABLE IF NOT EXISTS `victims` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postcode` varchar(50) NOT NULL,
  `street_village` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `passport` varchar(50) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `description` text,
  `affected_by` text,
  `pay_detail` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `national_id` (`national_id`,`passport`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
