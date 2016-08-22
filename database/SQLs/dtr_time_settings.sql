-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 04, 2016 at 08:12 AM
-- Server version: 10.0.25-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sams_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dtr_time_settings`
--

CREATE TABLE IF NOT EXISTS `dtr_time_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `presetmsg_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time_from` (`time_from`,`time_to`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `dtr_time_settings`
--

TRUNCATE TABLE `dtr_time_settings`;
--
-- Dumping data for table `dtr_time_settings`
--

INSERT INTO `dtr_time_settings` (`id`, `name`, `time_from`, `time_to`, `presetmsg_id`) VALUES
(1, 'LATE_IN', '07:01:00', '12:00:00', 1),
(2, 'LATE_OUT', '17:01:00', '21:00:00', 2),
(3, 'EARLY_OUT', '10:00:00', '15:19:59', 3),
(4, 'NORMAL_IN', '01:00:00', '07:00:59', 4),
(5, 'NORMAL_OUT', '16:00:00', '17:00:59', 5),
(6, 'GENERIC', '00:00:00', '00:00:00', 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
