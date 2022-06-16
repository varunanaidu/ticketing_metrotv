-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2021 at 01:25 PM
-- Server version: 5.5.56-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `loglogin`
--

CREATE TABLE `loglogin` (
  `id` int(11) NOT NULL,
  `cempnip` varchar(20) CHARACTER SET latin1 NOT NULL,
  `ip_address` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `browser` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `log_login` datetime DEFAULT NULL,
  `latitude` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `longitude` varchar(20) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `loglogin`
--

INSERT INTO `loglogin` (`id`, `cempnip`, `ip_address`, `browser`, `log_login`, `latitude`, `longitude`) VALUES
(1, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', '2021-05-12 14:58:59', NULL, NULL),
(2, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-18 08:59:20', NULL, NULL),
(3, '1193751', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-18 09:02:06', NULL, NULL),
(4, '1122050', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-18 09:05:42', NULL, NULL),
(5, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-18 09:06:36', NULL, NULL),
(6, '1122050', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-18 09:14:37', NULL, NULL),
(7, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-18 09:19:11', NULL, NULL),
(8, '1122050', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-18 09:21:49', NULL, NULL),
(9, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-18 10:56:29', NULL, NULL),
(10, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-21 09:04:51', NULL, NULL),
(11, '1193748', '192.168.112.235', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-21 14:52:47', NULL, NULL),
(12, '1142724', '192.168.112.235', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-21 14:56:22', NULL, NULL),
(13, '1193748', '192.168.112.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-21 14:58:39', NULL, NULL),
(14, '1142724', '192.168.112.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-21 14:59:56', NULL, NULL),
(15, '1153216', '192.168.112.235', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-21 15:01:50', NULL, NULL),
(16, '1142724', '192.168.112.235', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-21 15:02:41', NULL, NULL),
(17, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-21 15:22:42', NULL, NULL),
(18, '1193748', '192.168.112.208', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-21 15:43:29', NULL, NULL),
(19, '1193755', '192.168.112.48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-24 08:20:52', NULL, NULL),
(20, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-24 09:22:39', NULL, NULL),
(21, '1193726', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-24 10:38:10', NULL, NULL),
(22, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-24 10:39:00', NULL, NULL),
(23, '1193726', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-24 10:39:51', NULL, NULL),
(24, '1193755', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-24 10:39:58', NULL, NULL),
(25, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-24 10:40:33', NULL, NULL),
(26, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-24 11:00:19', NULL, NULL),
(27, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', '2021-05-24 13:46:45', NULL, NULL),
(28, '1193748', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36', '2021-05-31 12:02:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tab_admin`
--

CREATE TABLE `tab_admin` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_by` varchar(20) NOT NULL,
  `create_name` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_admin`
--

INSERT INTO `tab_admin` (`id`, `role_id`, `dept_id`, `dept_name`, `nip`, `name`, `create_by`, `create_name`, `create_date`) VALUES
(1, 1, 208, 'MIS', '1193748', 'SEFTIAN ALFREDO', '1193748', 'SEFTIAN ALFREDO', '2019-11-19 11:13:53'),
(2, 1, 208, 'MIS', '1193755', 'VARUNA DEWI', '1193748', 'SEFTIAN ALFREDO', '2019-11-19 11:14:08'),
(17, 2, 208, 'MIS', '1122050', 'HERMANTO SITUMORANG', '1193748', 'SEFTIAN ALFREDO', '2021-05-21 15:49:54'),
(18, 2, 218, 'IT INFRASTRUCTURE', '1193726', 'NURUL NOVIANA RAFIKA', '1193748', 'SEFTIAN ALFREDO', '2021-05-21 15:50:02'),
(19, 2, 208, 'MIS', '1153216', 'ANDRIANI SUASTIYU', '1193748', 'SEFTIAN ALFREDO', '2021-05-21 15:50:16'),
(20, 2, 262, 'GENERAL AFFAIRS & ASSET MANAGEMENT', '1142724', 'MIKNAF', '1193748', 'SEFTIAN ALFREDO', '2021-05-21 15:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `tab_category`
--

CREATE TABLE `tab_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_category`
--

INSERT INTO `tab_category` (`category_id`, `category_name`) VALUES
(1, 'Category A'),
(2, 'Category B'),
(3, 'Category C'),
(4, 'Category D'),
(5, 'Category E');

-- --------------------------------------------------------

--
-- Table structure for table `tab_message`
--

CREATE TABLE `tab_message` (
  `message_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `message_sender` varchar(50) NOT NULL,
  `message_date` datetime NOT NULL,
  `message_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_message`
--

INSERT INTO `tab_message` (`message_id`, `ticket_id`, `message_sender`, `message_date`, `message_content`) VALUES
(1, 2, 'MIKNAF', '2021-05-21 15:05:34', 'ac rusak remote d ganti'),
(2, 4, 'SEFTIAN ALFREDO', '2021-05-24 10:39:26', 'Segera di kerjakan'),
(3, 4, 'NURUL NOVIANA RAFIKA', '2021-05-24 10:39:38', 'Terima Kasih Mba'),
(4, 4, 'VARUNA DEWI', '2021-05-24 10:40:08', 'Sudah ya tolong di cek'),
(5, 4, 'NURUL NOVIANA RAFIKA', '2021-05-24 10:40:20', 'Okeh Terima Kasih');

-- --------------------------------------------------------

--
-- Table structure for table `tab_priority`
--

CREATE TABLE `tab_priority` (
  `priority_id` int(11) NOT NULL,
  `priority_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_priority`
--

INSERT INTO `tab_priority` (`priority_id`, `priority_name`) VALUES
(1, 'Unset'),
(2, 'Low'),
(3, 'Medium'),
(4, 'High');

-- --------------------------------------------------------

--
-- Table structure for table `tab_role`
--

CREATE TABLE `tab_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_role`
--

INSERT INTO `tab_role` (`role_id`, `role_name`) VALUES
(1, 'Developer'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tab_solution`
--

CREATE TABLE `tab_solution` (
  `solution_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `solution_desc` text NOT NULL,
  `create_by` varchar(10) NOT NULL,
  `create_name` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_solution`
--

INSERT INTO `tab_solution` (`solution_id`, `ticket_id`, `solution_desc`, `create_by`, `create_name`, `create_date`) VALUES
(1, 4, 'esrgergearga', '1193748', 'SEFTIAN ALFREDO', '2021-05-24 10:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `tab_status`
--

CREATE TABLE `tab_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_status`
--

INSERT INTO `tab_status` (`status_id`, `status_name`) VALUES
(1, 'Input'),
(2, 'On Going'),
(3, 'On Going - Request Solved'),
(4, 'On Going - Send Close'),
(5, 'Finsihed'),
(6, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `tab_ticket`
--

CREATE TABLE `tab_ticket` (
  `ticket_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `ticket_description` text NOT NULL,
  `ticket_att` varchar(75) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `create_name` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_ticket`
--

INSERT INTO `tab_ticket` (`ticket_id`, `category_id`, `ticket_description`, `ticket_att`, `create_by`, `create_name`, `create_date`) VALUES
(2, 0, 'ac rusak tolong dibenerin', '', '1153216', 'ANDRIANI SUASTIYU', '2021-05-21 15:02:09'),
(4, 1, 'Permasalahan 1', '3eea4c8b0d7c1574632230c56a26138c.jpg', '1193726', 'NURUL NOVIANA RAFIKA', '2021-05-24 10:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `tr_ticketing`
--

CREATE TABLE `tr_ticketing` (
  `tr_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `sender_dept` varchar(10) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `recipient_dept` varchar(10) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `request` varchar(50) NOT NULL,
  `request_by` varchar(100) NOT NULL,
  `request_solved_date` datetime DEFAULT NULL,
  `solved` varchar(50) NOT NULL,
  `solved_by` varchar(100) DEFAULT NULL,
  `solved_date` datetime DEFAULT NULL,
  `reason_rejected` text,
  `create_by` varchar(100) NOT NULL,
  `create_name` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_ticketing`
--

INSERT INTO `tr_ticketing` (`tr_id`, `ticket_id`, `status_id`, `priority_id`, `sender_dept`, `sender_name`, `recipient_dept`, `recipient_name`, `request`, `request_by`, `request_solved_date`, `solved`, `solved_by`, `solved_date`, `reason_rejected`, `create_by`, `create_name`, `create_date`) VALUES
(2, 2, 1, 1, '208', 'MIS', '262', 'GENERAL AFFAIRS & ASSET MANAGEMENT', '', '', NULL, '', NULL, NULL, NULL, '1153216', 'ANDRIANI SUASTIYU', '2021-05-21 15:02:09'),
(3, 2, 2, 4, '208', 'MIS', '262', 'GENERAL AFFAIRS & ASSET MANAGEMENT', '', '', NULL, '', NULL, NULL, NULL, '1142724', 'MIKNAF', '2021-05-21 15:03:44'),
(5, 4, 1, 1, '218', 'IT INFRASTRUCTURE', '208', 'MIS', '', '', NULL, '', NULL, NULL, NULL, '1193726', 'NURUL NOVIANA RAFIKA', '2021-05-24 10:38:46'),
(6, 4, 2, 3, '218', 'IT INFRASTRUCTURE', '208', 'MIS', '', '', NULL, '', NULL, NULL, NULL, '1193748', 'SEFTIAN ALFREDO', '2021-05-24 10:39:09'),
(7, 4, 3, 3, '218', 'IT INFRASTRUCTURE', '208', 'MIS', '1193755', 'VARUNA DEWI', '2021-05-24 10:40:23', '', NULL, NULL, NULL, '1193755', 'VARUNA DEWI', '2021-05-24 10:40:23'),
(13, 4, 4, 3, '218', 'IT INFRASTRUCTURE', '208', 'MIS', '1193755', 'VARUNA DEWI', '2021-05-24 10:40:23', '', NULL, NULL, NULL, '1193748', 'SEFTIAN ALFREDO', '2021-05-24 10:54:50'),
(14, 4, 5, 3, '218', 'IT INFRASTRUCTURE', '208', 'MIS', '1193755', 'VARUNA DEWI', '2021-05-24 10:40:23', '1193755', 'VARUNA DEWI', '2021-05-24 10:40:23', NULL, '1193726', 'NURUL NOVIANA RAFIKA', '2021-05-24 10:55:18');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_admin`
-- (See below for the actual view)
--
CREATE TABLE `vw_admin` (
`id` int(11)
,`role_id` int(11)
,`dept_id` int(11)
,`dept_name` varchar(100)
,`nip` varchar(100)
,`name` varchar(100)
,`create_by` varchar(20)
,`create_name` varchar(255)
,`create_date` datetime
,`role_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_last_ticket`
-- (See below for the actual view)
--
CREATE TABLE `vw_last_ticket` (
`tr_id` int(11)
,`ticket_id` int(11)
,`ticket_description` text
,`ticket_att` varchar(75)
,`issued_by` varchar(50)
,`issued_name` varchar(255)
,`issued_date` datetime
,`status_id` int(11)
,`status_name` varchar(50)
,`priority_id` int(11)
,`priority_name` varchar(50)
,`sender_dept` varchar(10)
,`sender_name` varchar(255)
,`recipient_dept` varchar(10)
,`recipient_name` varchar(255)
,`request` varchar(50)
,`request_by` varchar(100)
,`request_solved_date` datetime
,`solved_date` datetime
,`solved_by` varchar(100)
,`solved` varchar(50)
,`reason_rejected` text
,`create_by` varchar(100)
,`create_name` varchar(100)
,`create_date` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_priority`
-- (See below for the actual view)
--
CREATE TABLE `vw_priority` (
`priority_id` int(11)
,`priority_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_solution`
-- (See below for the actual view)
--
CREATE TABLE `vw_solution` (
`solution_id` int(11)
,`ticket_id` int(11)
,`category_id` int(11)
,`category_name` varchar(100)
,`ticket_description` text
,`solution_desc` text
,`create_by` varchar(10)
,`create_name` varchar(255)
,`create_date` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_status`
-- (See below for the actual view)
--
CREATE TABLE `vw_status` (
`status_id` int(11)
,`status_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_temp`
-- (See below for the actual view)
--
CREATE TABLE `vw_temp` (
`tr_id` int(11)
,`ticket_id` int(11)
,`Max_status_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_ticket`
-- (See below for the actual view)
--
CREATE TABLE `vw_ticket` (
`tr_id` int(11)
,`ticket_id` int(11)
,`ticket_description` text
,`ticket_att` varchar(75)
,`issued_by` varchar(50)
,`issued_name` varchar(255)
,`issued_date` datetime
,`status_id` int(11)
,`status_name` varchar(50)
,`priority_id` int(11)
,`priority_name` varchar(50)
,`sender_dept` varchar(10)
,`sender_name` varchar(255)
,`recipient_dept` varchar(10)
,`recipient_name` varchar(255)
,`request` varchar(50)
,`request_by` varchar(100)
,`request_solved_date` datetime
,`solved_date` datetime
,`solved_by` varchar(100)
,`solved` varchar(50)
,`reason_rejected` text
,`create_by` varchar(100)
,`create_name` varchar(100)
,`create_date` datetime
);

-- --------------------------------------------------------

--
-- Structure for view `vw_admin`
--
DROP TABLE IF EXISTS `vw_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dev`@`%` SQL SECURITY DEFINER VIEW `vw_admin`  AS  select `tbl1`.`id` AS `id`,`tbl1`.`role_id` AS `role_id`,`tbl1`.`dept_id` AS `dept_id`,`tbl1`.`dept_name` AS `dept_name`,`tbl1`.`nip` AS `nip`,`tbl1`.`name` AS `name`,`tbl1`.`create_by` AS `create_by`,`tbl1`.`create_name` AS `create_name`,`tbl1`.`create_date` AS `create_date`,`tbl2`.`role_name` AS `role_name` from (`tab_admin` `tbl1` left join `tab_role` `tbl2` on((`tbl1`.`role_id` = `tbl2`.`role_id`))) where (`tbl1`.`role_id` = 2) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_last_ticket`
--
DROP TABLE IF EXISTS `vw_last_ticket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dev`@`%` SQL SECURITY DEFINER VIEW `vw_last_ticket`  AS  select `tbl1`.`tr_id` AS `tr_id`,`tbl1`.`ticket_id` AS `ticket_id`,`tbl1`.`ticket_description` AS `ticket_description`,`tbl1`.`ticket_att` AS `ticket_att`,`tbl1`.`issued_by` AS `issued_by`,`tbl1`.`issued_name` AS `issued_name`,`tbl1`.`issued_date` AS `issued_date`,`tbl1`.`status_id` AS `status_id`,`tbl1`.`status_name` AS `status_name`,`tbl1`.`priority_id` AS `priority_id`,`tbl1`.`priority_name` AS `priority_name`,`tbl1`.`sender_dept` AS `sender_dept`,`tbl1`.`sender_name` AS `sender_name`,`tbl1`.`recipient_dept` AS `recipient_dept`,`tbl1`.`recipient_name` AS `recipient_name`,`tbl1`.`request` AS `request`,`tbl1`.`request_by` AS `request_by`,`tbl1`.`request_solved_date` AS `request_solved_date`,`tbl1`.`solved_date` AS `solved_date`,`tbl1`.`solved_by` AS `solved_by`,`tbl1`.`solved` AS `solved`,`tbl1`.`reason_rejected` AS `reason_rejected`,`tbl1`.`create_by` AS `create_by`,`tbl1`.`create_name` AS `create_name`,`tbl1`.`create_date` AS `create_date` from (`vw_ticket` `tbl1` join `vw_temp` `tbl2` on(((`tbl1`.`ticket_id` = `tbl2`.`ticket_id`) and (`tbl1`.`status_id` = `tbl2`.`Max_status_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_priority`
--
DROP TABLE IF EXISTS `vw_priority`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dev`@`%` SQL SECURITY DEFINER VIEW `vw_priority`  AS  select `tab_priority`.`priority_id` AS `priority_id`,`tab_priority`.`priority_name` AS `priority_name` from `tab_priority` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_solution`
--
DROP TABLE IF EXISTS `vw_solution`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dev`@`%` SQL SECURITY DEFINER VIEW `vw_solution`  AS  select `t1`.`solution_id` AS `solution_id`,`t1`.`ticket_id` AS `ticket_id`,`t2`.`category_id` AS `category_id`,`t3`.`category_name` AS `category_name`,`t2`.`ticket_description` AS `ticket_description`,`t1`.`solution_desc` AS `solution_desc`,`t1`.`create_by` AS `create_by`,`t1`.`create_name` AS `create_name`,`t1`.`create_date` AS `create_date` from ((`tab_solution` `t1` left join `tab_ticket` `t2` on((`t1`.`ticket_id` = `t2`.`ticket_id`))) left join `tab_category` `t3` on((`t2`.`category_id` = `t3`.`category_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_status`
--
DROP TABLE IF EXISTS `vw_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dev`@`%` SQL SECURITY DEFINER VIEW `vw_status`  AS  select `tab_status`.`status_id` AS `status_id`,`tab_status`.`status_name` AS `status_name` from `tab_status` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_temp`
--
DROP TABLE IF EXISTS `vw_temp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dev`@`%` SQL SECURITY DEFINER VIEW `vw_temp`  AS  select `vw_ticket`.`tr_id` AS `tr_id`,`vw_ticket`.`ticket_id` AS `ticket_id`,max(`vw_ticket`.`status_id`) AS `Max_status_id` from `vw_ticket` group by `vw_ticket`.`ticket_id` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_ticket`
--
DROP TABLE IF EXISTS `vw_ticket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`dev`@`%` SQL SECURITY DEFINER VIEW `vw_ticket`  AS  select `tbl1`.`tr_id` AS `tr_id`,`tbl1`.`ticket_id` AS `ticket_id`,`tbl2`.`ticket_description` AS `ticket_description`,`tbl2`.`ticket_att` AS `ticket_att`,`tbl2`.`create_by` AS `issued_by`,`tbl2`.`create_name` AS `issued_name`,`tbl2`.`create_date` AS `issued_date`,`tbl1`.`status_id` AS `status_id`,`tbl3`.`status_name` AS `status_name`,`tbl1`.`priority_id` AS `priority_id`,`tbl4`.`priority_name` AS `priority_name`,`tbl1`.`sender_dept` AS `sender_dept`,`tbl1`.`sender_name` AS `sender_name`,`tbl1`.`recipient_dept` AS `recipient_dept`,`tbl1`.`recipient_name` AS `recipient_name`,`tbl1`.`request` AS `request`,`tbl1`.`request_by` AS `request_by`,`tbl1`.`request_solved_date` AS `request_solved_date`,`tbl1`.`solved_date` AS `solved_date`,`tbl1`.`solved_by` AS `solved_by`,`tbl1`.`solved` AS `solved`,`tbl1`.`reason_rejected` AS `reason_rejected`,`tbl1`.`create_by` AS `create_by`,`tbl1`.`create_name` AS `create_name`,`tbl1`.`create_date` AS `create_date` from (((`tr_ticketing` `tbl1` left join `tab_ticket` `tbl2` on((`tbl1`.`ticket_id` = `tbl2`.`ticket_id`))) left join `tab_status` `tbl3` on((`tbl1`.`status_id` = `tbl3`.`status_id`))) left join `tab_priority` `tbl4` on((`tbl1`.`priority_id` = `tbl4`.`priority_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loglogin`
--
ALTER TABLE `loglogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tab_admin`
--
ALTER TABLE `tab_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tab_category`
--
ALTER TABLE `tab_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tab_message`
--
ALTER TABLE `tab_message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tab_priority`
--
ALTER TABLE `tab_priority`
  ADD PRIMARY KEY (`priority_id`);

--
-- Indexes for table `tab_role`
--
ALTER TABLE `tab_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tab_solution`
--
ALTER TABLE `tab_solution`
  ADD PRIMARY KEY (`solution_id`);

--
-- Indexes for table `tab_status`
--
ALTER TABLE `tab_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tab_ticket`
--
ALTER TABLE `tab_ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `tr_ticketing`
--
ALTER TABLE `tr_ticketing`
  ADD PRIMARY KEY (`tr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loglogin`
--
ALTER TABLE `loglogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tab_admin`
--
ALTER TABLE `tab_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tab_category`
--
ALTER TABLE `tab_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tab_message`
--
ALTER TABLE `tab_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tab_priority`
--
ALTER TABLE `tab_priority`
  MODIFY `priority_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tab_role`
--
ALTER TABLE `tab_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tab_solution`
--
ALTER TABLE `tab_solution`
  MODIFY `solution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tab_status`
--
ALTER TABLE `tab_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tab_ticket`
--
ALTER TABLE `tab_ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tr_ticketing`
--
ALTER TABLE `tr_ticketing`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
