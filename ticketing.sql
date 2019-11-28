-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2019 at 06:38 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `tab_message`
--

CREATE TABLE `tab_message` (
  `message_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `message_sender` varchar(50) NOT NULL,
  `message_recipient` varchar(50) NOT NULL,
  `message_date` datetime NOT NULL,
  `message_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tab_report_ticketing`
--

CREATE TABLE `tab_report_ticketing` (
  `report_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `recipient` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_report_ticketing`
--

INSERT INTO `tab_report_ticketing` (`report_id`, `ticket_id`, `sender`, `recipient`) VALUES
(1, 1, 'IT Office', 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `tab_ticket`
--

CREATE TABLE `tab_ticket` (
  `ticket_id` int(11) NOT NULL,
  `ticket_description` text NOT NULL,
  `ticket_att` varchar(75) NOT NULL,
  `ticket_status` int(11) NOT NULL COMMENT '0=Inputed ; 1 = In Progress ; 2 = Solved',
  `ticket_priority` int(11) NOT NULL COMMENT '0 = unset; 1 = low; 2 = medium ; 3 = high',
  `created_date` datetime NOT NULL,
  `created_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tab_ticket`
--

INSERT INTO `tab_ticket` (`ticket_id`, `ticket_description`, `ticket_att`, `ticket_status`, `ticket_priority`, `created_date`, `created_id`) VALUES
(1, 'Komputer tiba-tiba berubah jadi mac pro', '74985ce5b5e90e0b98668915e015f1fc.png', 0, 0, '2019-11-14 23:58:46', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tab_message`
--
ALTER TABLE `tab_message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tab_report_ticketing`
--
ALTER TABLE `tab_report_ticketing`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `tab_ticket`
--
ALTER TABLE `tab_ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tab_message`
--
ALTER TABLE `tab_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tab_report_ticketing`
--
ALTER TABLE `tab_report_ticketing`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tab_ticket`
--
ALTER TABLE `tab_ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
