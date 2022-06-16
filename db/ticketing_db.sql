-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2021 at 03:53 AM
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
(11, 2, 208, 'MIS', '1122050', 'HERMANTO SITUMORANG', '1193748', 'Seftian Alfredo', '2021-04-28 09:17:32'),
(13, 2, 250, 'IT INFRASTRUCTURE', '1193726', 'NURUL NOVIANA RAFIKA', '1193748', 'Seftian Alfredo', '2021-04-30 09:03:55');

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
  `ticket_description` text NOT NULL,
  `ticket_att` varchar(75) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `create_name` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tab_admin`
--
ALTER TABLE `tab_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tab_message`
--
ALTER TABLE `tab_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `tab_status`
--
ALTER TABLE `tab_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tab_ticket`
--
ALTER TABLE `tab_ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_ticketing`
--
ALTER TABLE `tr_ticketing`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
