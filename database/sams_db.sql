-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2016 at 05:02 AM
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
  `contacts_firstname` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_middlename` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_level` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_type` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_blockno` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_street` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_brgy` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_city` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_zip` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_telephone` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_mobile` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_email` text COLLATE utf8_unicode_ci NOT NULL,
  `contacts_group` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sams_contacts`
--

INSERT INTO `sams_contacts` (`contacts_id`, `contacts_firstname`, `contacts_middlename`, `contacts_lastname`, `contacts_level`, `contacts_type`, `contacts_blockno`, `contacts_street`, `contacts_brgy`, `contacts_city`, `contacts_zip`, `contacts_telephone`, `contacts_mobile`, `contacts_email`, `contacts_group`, `created_at`, `updated_at`) VALUES
(1, 'John Lioneil', 'Palanas', 'Dionisio', 'Level 3', 'Type 3', 'Block 15 Lot 27', 'Cattleya Street', 'Roseville Heights Subdivision', 'San Jose City', '3112', '092-350 0343', '0(923) 500-3433', 'john.dionisio1@gmail.com', '1', '2016-01-30 06:41:09', '2016-02-03 07:01:37'),
(25, 'Aliudin', 'Macalawi', 'Macalawi', 'Level 2', 'Type 2', '', 'Block 15 Lot 27, Cattleya Street', 'Roseville Heights Subdivision', 'San Jose City', '3112', '092-350 0343', '0(923) 500-3433', 'aliudin@ssagroup.com', '1', '2016-01-30 06:41:09', '2016-02-03 07:01:37'),
(27, 'Paola', '', 'Atienza', 'Level 1', 'Type 1', '', 'xz', 'z', 'zz', 'zz', '', '4(545) 454-5454', 'paola@ssagroup.com', '1', '2016-01-30 06:41:09', '2016-02-03 07:01:38'),
(29, 'Anna Kristina', '', 'Castillo', 'Level 1', 'Type 2', '', 'z', 'z', 'z', 'z', '', '7(788) 989-9898', 'ak@ssagroup.com', '2', '2016-01-30 06:41:09', '2016-02-05 07:09:06'),
(31, 'Mai', '', 'Dones', '', '', '', '', '', '', '', '', '', 'mai@ssagroup.com', '2', '2016-01-30 06:41:09', '2016-02-05 07:09:06'),
(34, 'Janine', 'Lazarus', 'Jimenez', 'Level 1', 'Type 2', '1234', '7854 St.', 'Subdivision Homes', 'Towney CIty', '7772', '0132645987', '0132654789', 'janine@ssagroup.com', '7', '2016-01-30 06:41:09', '2016-01-30 06:41:09'),
(36, 'Annalyn', '', 'Diones', 'Level 3', 'Type 3', 'Block 15 Lot 27', 'Cattleya Street', 'Roseville Heights Subdivision', 'San Jose City', '3112', '09235003433', '0(923) 500-3433', 'annalyn@ssagroup.com', '1', '2016-01-30 06:41:09', '2016-01-30 06:41:09'),
(38, 'XXJohn Lioneil', 'P.', 'Dionisio', '', '', '', 'Block 15 Lot 27, Cattleya Street, Roseville Heights Subdivision', 'zzz', 'San Jose City', '3112', '09235003433', '09235003433', 'XXjohn.dionisio1@gmail.com', '1,2', '2016-02-10 03:09:10', '2016-02-10 03:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `sams_groups`
--

CREATE TABLE IF NOT EXISTS `sams_groups` (
  `groups_id` int(10) unsigned NOT NULL,
  `groups_name` text COLLATE utf8_unicode_ci NOT NULL,
  `groups_description` text COLLATE utf8_unicode_ci NOT NULL,
  `groups_code` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sams_groups`
--

INSERT INTO `sams_groups` (`groups_id`, `groups_name`, `groups_description`, `groups_code`, `created_at`, `updated_at`) VALUES
(1, 'Group 1', 'lorem ipsu.', 'group-1', '2016-02-03 07:01:36', '0000-00-00 00:00:00'),
(2, 'Group 2', 'Group 2', 'group-2', '2016-02-05 07:09:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sams_levels`
--

CREATE TABLE IF NOT EXISTS `sams_levels` (
  `levels_id` int(10) unsigned NOT NULL,
  `levels_name` text COLLATE utf8_unicode_ci NOT NULL,
  `levels_description` text COLLATE utf8_unicode_ci NOT NULL,
  `levels_code` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sams_levels`
--

INSERT INTO `sams_levels` (`levels_id`, `levels_name`, `levels_description`, `levels_code`, `created_at`, `updated_at`) VALUES
(1, 'Level 1', 'level 1 description', 'level-1', '2016-01-30 09:22:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sams_migrations`
--

CREATE TABLE IF NOT EXISTS `sams_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sams_migrations`
--

INSERT INTO `sams_migrations` (`version`) VALUES
(20160130035001);

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
-- Indexes for table `sams_levels`
--
ALTER TABLE `sams_levels`
  ADD PRIMARY KEY (`levels_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sams_contacts`
--
ALTER TABLE `sams_contacts`
  MODIFY `contacts_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `sams_groups`
--
ALTER TABLE `sams_groups`
  MODIFY `groups_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sams_levels`
--
ALTER TABLE `sams_levels`
  MODIFY `levels_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
