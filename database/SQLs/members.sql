-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 04, 2016 at 06:57 AM
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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `nick` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `stud_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` text COLLATE utf8_unicode_ci NOT NULL,
  `middlename` text COLLATE utf8_unicode_ci,
  `lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `level` text COLLATE utf8_unicode_ci,
  `type` text COLLATE utf8_unicode_ci,
  `address_blockno` text COLLATE utf8_unicode_ci,
  `address_street` text COLLATE utf8_unicode_ci,
  `address_brgy` text COLLATE utf8_unicode_ci,
  `address_city` text COLLATE utf8_unicode_ci,
  `address_zip` text COLLATE utf8_unicode_ci,
  `telephone` text COLLATE utf8_unicode_ci,
  `msisdn` text COLLATE utf8_unicode_ci,
  `email` text COLLATE utf8_unicode_ci,
  `groups` text COLLATE utf8_unicode_ci,
  `avatar` text COLLATE utf8_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `removed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `nick`, `stud_no`, `firstname`, `middlename`, `lastname`, `level`, `type`, `address_blockno`, `address_street`, `address_brgy`, `address_city`, `address_zip`, `telephone`, `msisdn`, `email`, `groups`, `avatar`, `created_by`, `updated_by`, `removed_by`, `created_at`, `updated_at`, `removed_at`) VALUES
(1, '', '122', 'RYNAJA R. ', 'R', 'ABUYO', '1', '1', '2127 C. Zamora St. Pandacan, Manila', '', '', '', '', '092-350 0343', '09228980981', 'john.dionisio1@gmail.com', '1,4,5', '', 1, 1, 0, '2016-08-01 11:31:37', '2016-08-01 11:31:37', NULL),
(2, '', '123', 'ALANO PRINCESS ', '', 'IFEANYI', '1', '1', '2937 Road 3 Obrero Pandacan Manila', '', '', '', '', '775-437 5', '09493278139', 'ferdiesan060116@gmail.com', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(3, '', '124', 'PAUL EZEKIEL D. ', 'D', 'AUTENCIO', '1', '1', '2768-A Jesus Ext. Pandacan, Manila', '', '', '', '', '', '09302967715', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(4, '', '125', 'JERRYZZA MARGAUX O.', 'O', ' BARBA', '1', '1', '2619 San Jose Street, Beata, Pandacan, Manila', '', '', '', '', '', '09394753805', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(5, '', '126', 'ADRIANNE MAE A. ', 'A', 'BAUTISTA', '1', '1', '2421-E Beata St. Pandacan Manila', '', '', '', '', '', '09209084450', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(6, '', '127', 'RYNAJA R. ', 'R', 'ABUYO', '1', '1', '2127 C. Zamora St. Pandacan, Manila', '', '', '', '', '092-350 0343', '09228980981', 'john.dionisio1@gmail.com', '1,4,5', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(7, '', '128', 'ALANO PRINCESS ', '', 'IFEANYI', '1', '1', '2937 Road 3 Obrero Pandacan Manila', '', '', '', '', '775-437 5', '09493278139', 'ferdiesan060116@gmail.com', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(8, '', '129', 'PAUL EZEKIEL D. ', 'D', 'AUTENCIO', '1', '1', '2768-A Jesus Ext. Pandacan, Manila', '', '', '', '', '', '09302967715', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(9, '', '130', 'JERRYZZA MARGAUX O.', 'O', ' BARBA', '1', '1', '2619 San Jose Street, Beata, Pandacan, Manila', '', '', '', '', '', '09394753805', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(10, '', '131', 'ADRIANNE MAE A. ', 'A', 'BAUTISTA', '1', '1', '2421-E Beata St. Pandacan Manila', '', '', '', '', '', '09209084450', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(11, '', '132', 'RYNAJA R. ', 'R', 'ABUYO', '1', '1', '2127 C. Zamora St. Pandacan, Manila', '', '', '', '', '092-350 0343', '09228980981', 'john.dionisio1@gmail.com', '1,4,5', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(12, '', '133', 'ALANO PRINCESS ', '', 'IFEANYI', '1', '1', '2937 Road 3 Obrero Pandacan Manila', '', '', '', '', '775-437 5', '09493278139', 'ferdiesan060116@gmail.com', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(13, '', '134', 'PAUL EZEKIEL D. ', 'D', 'AUTENCIO', '1', '1', '2768-A Jesus Ext. Pandacan, Manila', '', '', '', '', '', '09302967715', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(14, '', '135', 'JERRYZZA MARGAUX O.', 'O', ' BARBA', '1', '1', '2619 San Jose Street, Beata, Pandacan, Manila', '', '', '', '', '', '09394753805', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(15, '', '136', 'ADRIANNE MAE A. ', 'A', 'BAUTISTA', '1', '1', '2421-E Beata St. Pandacan Manila', '', '', '', '', '', '09209084450', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(16, '', '137', 'RYNAJA R. ', 'R', 'ABUYO', '1', '1', '2127 C. Zamora St. Pandacan, Manila', '', '', '', '', '092-350 0343', '09228980981', 'john.dionisio1@gmail.com', '1,4,5', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(17, '', '138', 'ALANO PRINCESS ', '', 'IFEANYI', '1', '1', '2937 Road 3 Obrero Pandacan Manila', '', '', '', '', '775-437 5', '09493278139', 'ferdiesan060116@gmail.com', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(18, '', '139', 'PAUL EZEKIEL D. ', 'D', 'AUTENCIO', '1', '1', '2768-A Jesus Ext. Pandacan, Manila', '', '', '', '', '', '09302967715', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(19, '', '140', 'JERRYZZA MARGAUX O.', 'O', ' BARBA', '1', '1', '2619 San Jose Street, Beata, Pandacan, Manila', '', '', '', '', '', '09394753805', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(20, '', '141', 'ADRIANNE MAE A. ', 'A', 'BAUTISTA', '1', '1', '2421-E Beata St. Pandacan Manila', '', '', '', '', '', '09209084450', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(21, '', '142', 'RYNAJA R. ', 'R', 'ABUYO', '1', '1', '2127 C. Zamora St. Pandacan, Manila', '', '', '', '', '092-350 0343', '09228980981', 'john.dionisio1@gmail.com', '1,4,5', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(22, '', '143', 'ALANO PRINCESS ', '', 'IFEANYI', '1', '1', '2937 Road 3 Obrero Pandacan Manila', '', '', '', '', '775-437 5', '09493278139', 'ferdiesan060116@gmail.com', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(23, '', '144', 'PAUL EZEKIEL D. ', 'D', 'AUTENCIO', '1', '1', '2768-A Jesus Ext. Pandacan, Manila', '', '', '', '', '', '09302967715', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(24, '', '145', 'JERRYZZA MARGAUX O.', 'O', ' BARBA', '1', '1', '2619 San Jose Street, Beata, Pandacan, Manila', '', '', '', '', '', '09394753805', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48'),
(25, '', '146', 'ADRIANNE MAE A. ', 'A', 'BAUTISTA', '1', '1', '2421-E Beata St. Pandacan Manila', '', '', '', '', '', '09209084450', '', '1', '', 1, 1, 1, '2016-08-01 11:31:37', '2016-08-02 15:11:48', '2016-08-02 15:11:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=497;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
