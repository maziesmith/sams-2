-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2016 at 03:39 AM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

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
-- Table structure for table `sams_contacts`
--

CREATE TABLE IF NOT EXISTS `sams_contacts` (
  `contacts_id` int(10) unsigned NOT NULL,
  `contacts_firstname` text NOT NULL,
  `contacts_middlename` text NOT NULL,
  `contacts_lastname` text NOT NULL,
  `contacts_level` text NOT NULL,
  `contacts_type` text NOT NULL,
  `contacts_blockno` text NOT NULL,
  `contacts_street` text NOT NULL,
  `contacts_brgy` text NOT NULL,
  `contacts_city` text NOT NULL,
  `contacts_zip` text NOT NULL,
  `contacts_telephone` text NOT NULL,
  `contacts_mobile` text NOT NULL,
  `contacts_email` text NOT NULL,
  `contacts_group` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sams_contacts`
--

INSERT INTO `sams_contacts` (`contacts_id`, `contacts_firstname`, `contacts_middlename`, `contacts_lastname`, `contacts_level`, `contacts_type`, `contacts_blockno`, `contacts_street`, `contacts_brgy`, `contacts_city`, `contacts_zip`, `contacts_telephone`, `contacts_mobile`, `contacts_email`, `contacts_group`) VALUES
(1, 'John Lioneil', 'Palanas', 'Dionisio', 'Level 1', 'Type 1', 'Block 15 Lot 27', 'Cattleya Street', 'Roseville Heights Subdivision', 'San Jose City', '3112', '092-350 0343', '0(923) 500-3433', 'john.dionisio1@gmail.com', '1'),
(24, 'Lean ', '', 'Degaños', 'Level 1', 'Type 1', '', 'z', 'z', 'z', '', '', '1(245) 878-7787', 'lean@ssagroup.com', '1'),
(25, 'Aliudin', 'P.', 'Macalawi', 'Level 2', 'Type 2', '', 'Block 15 Lot 27, Cattleya Street', 'Roseville Heights Subdivision', 'San Jose City', '3112', '092-350 0343', '0(923) 500-3433', 'aliudin@ssagroup.com', '1'),
(26, 'Pauline', 'Q', 'Kuizon', '', '', '', 'zz', 'zz', 'zz', '', '', '0(212) 121-2121', 'pauline@ssagroup.com', '1'),
(27, 'Paola', '', 'Atienza', 'Level 1', 'Type 1', '', 'xz', 'z', 'zz', 'zz', '', '4(545) 454-5454', 'paola@ssagroup.com', '1'),
(28, 'Chad', '', 'Aranzaso', '', '', '', 'zz', 'xz', 'zxzx', 'x', '78', '8(778) 787-8787', 'chad@ssagroup.com', '2'),
(29, 'Anna Kristina', '', 'Castillo', 'Level 1', 'Type 2', '', 'z', 'z', 'z', 'z', '', '7(', 'ak@ssagroup.com', '2'),
(30, 'Jeff', '', 'Puri', '', '', '', '', '', '', '', '', '', 'jeff@ssagroup.com', ''),
(31, 'Mai', '', 'Dones', '', '', '', '', '', '', '', '', '', 'mai@ssagroup.com', ''),
(32, 'Graziela', '', 'Gracesurname', '', '', '', '', '', '', '', '', '', 'grace@ssagroup.com', ''),
(34, 'Janine', 'Lazarus', 'Jimenez', 'Level 1', 'Type 2', '1234', '7854 St.', 'Subdivision Homes', 'Towney CIty', '7772', '0132645987', '0132654789', 'janine@ssagroup.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `sams_groups`
--

CREATE TABLE IF NOT EXISTS `sams_groups` (
  `groups_id` int(10) unsigned NOT NULL,
  `groups_name` text NOT NULL,
  `groups_description` text NOT NULL,
  `groups_code` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sams_groups`
--

INSERT INTO `sams_groups` (`groups_id`, `groups_name`, `groups_description`, `groups_code`) VALUES
(1, 'Group 1', 'The first group there is.', 'group-1'),
(2, 'Group 2', 'The second group in the.. group.', 'group-2'),
(3, 'Group 3', 'The third group in the bunch.', 'group-3'),
(4, 'Group 4', 'The fourth group so far.', 'group-4'),
(7, 'Group 5', 'The fifth group.', 'group-5'),
(9, 'Group 6', 'Sixth group.', 'group-6');

-- --------------------------------------------------------

--
-- Table structure for table `sams_migrations`
--

CREATE TABLE IF NOT EXISTS `sams_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sams_migrations`
--

INSERT INTO `sams_migrations` (`version`) VALUES
(20160125035000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sams_contacts`
--
ALTER TABLE `sams_contacts`
  ADD PRIMARY KEY (`contacts_id`);

--
-- Indexes for table `sams_groups`
--
ALTER TABLE `sams_groups`
  ADD PRIMARY KEY (`groups_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sams_contacts`
--
ALTER TABLE `sams_contacts`
  MODIFY `contacts_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `sams_groups`
--
ALTER TABLE `sams_groups`
  MODIFY `groups_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
