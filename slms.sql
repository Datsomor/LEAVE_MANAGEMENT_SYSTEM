-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 12:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smls`
--
CREATE DATABASE IF NOT EXISTS `smls` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `smls`;

-- --------------------------------------------------------

--
-- Table structure for table `admin-actions`
--

CREATE TABLE `admin-actions` (
  `ACTION_ID` int(11) NOT NULL,
  `LEAVE_ID` int(11) NOT NULL,
  `ADMIN_ID` int(11) NOT NULL,
  `ACTION_TYPE` text NOT NULL DEFAULT 'CHECK (action_type IN (\'Approve\', \'Not Approve\'))',
  `ACTION_DATE` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ADMIN_ID` int(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `directorate_id` int(11) NOT NULL,
  `directorate_short_name` varchar(50) NOT NULL,
  `directorate_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`directorate_id`, `directorate_short_name`, `directorate_name`) VALUES
(2, 'RSIM', 'REASEARCH STATISTICS AND INFORMATION MANAGEMENT'),
(3, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `grade_id` int(11) NOT NULL,
  `grade_name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`grade_id`, `grade_name`, `description`) VALUES
(1, 'dir', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `LEAVE_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `LEAVE_TYPE` varchar(50) NOT NULL,
  `FULL_NAME` varchar(50) NOT NULL,
  `ID_NUMBER` varchar(50) NOT NULL,
  `FROM_DATE` date NOT NULL,
  `TO_DATE` date NOT NULL,
  `STAFF_ID` int(11) NOT NULL,
  `SUBMISSION_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `STATUS` text NOT NULL DEFAULT '\'CHECK (status IN (\\\'Pending\\\', \\\'Approved\\\', \\\'Rejected\\\'))\'',
  `DIRECTORATE` text NOT NULL,
  `REJECTION_REASON` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_application`
--

INSERT INTO `leave_application` (`LEAVE_ID`, `USER_ID`, `LEAVE_TYPE`, `FULL_NAME`, `ID_NUMBER`, `FROM_DATE`, `TO_DATE`, `STAFF_ID`, `SUBMISSION_DATE`, `STATUS`, `DIRECTORATE`, `REJECTION_REASON`) VALUES
(4, 0, 'Casual Leave', 'andy joe essuman', '12345', '2024-01-12', '2024-01-15', 0, '2024-01-11 12:22:49', 'Pending', '', ''),
(8, 0, 'Casual Leave', 'Ella Yayra Ocloo', '12344', '2024-01-13', '2024-01-15', 0, '2024-01-12 12:03:53', 'Approved', 'RSIM', ''),
(9, 0, 'Sick Leave', 'Ella Yayra Ocloo', '12344', '2024-01-17', '2024-01-23', 0, '2024-01-15 02:54:48', 'HR Rejected', 'RSIM', 'hr rej'),
(10, 0, 'Casual Leave', 'Ella Yayra Ocloo', '12344', '2024-01-17', '2024-01-18', 0, '2024-01-15 03:01:10', 'HR Rejected', 'RSIM', 'not yet'),
(11, 0, 'Sick Leave', 'Ella Yayra Ocloo', '12344', '2024-01-20', '2024-01-24', 0, '2024-01-15 22:04:50', 'Director Rejected', 'RSIM', 'dir rej'),
(12, 0, 'Casual Leave', 'Ella Yayra Ocloo', '12344', '2022-04-12', '2024-01-20', 0, '2024-01-18 12:04:58', 'Pending', 'RSIM', ''),
(32, 0, '', 'kwame afrane Adu', '2325', '2024-01-24', '2024-01-25', 0, '2024-01-22 15:24:10', 'Pending', 'RSIM', ''),
(33, 0, '', 'kwame afrane Adu', '2325', '2024-01-24', '2024-01-25', 0, '2024-01-22 15:24:10', 'Pending', 'RSIM', ''),
(43, 0, 'medical leave', 'kwame afrane Adu', '2325', '2024-01-23', '2024-01-24', 0, '2024-01-22 16:14:28', 'Pending', 'RSIM', '');

-- --------------------------------------------------------

--
-- Table structure for table `leave_management`
--

CREATE TABLE `leave_management` (
  `LEAVE ID` int(11) NOT NULL,
  `STAFF_ID` int(11) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL,
  `STATUS` text NOT NULL,
  `LEAVE_TYPE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_statistics`
--

CREATE TABLE `leave_statistics` (
  `ID_NUMBER` varchar(11) NOT NULL,
  `LEAVE_YEAR` int(11) NOT NULL,
  `LEAVE_DAYS_TAKEN` int(11) NOT NULL,
  `LEAVE_DAYS_REMAINING` int(11) NOT NULL,
  `LEAVE_DAYS_ENTITLEMENT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_statistics`
--

INSERT INTO `leave_statistics` (`ID_NUMBER`, `LEAVE_YEAR`, `LEAVE_DAYS_TAKEN`, `LEAVE_DAYS_REMAINING`, `LEAVE_DAYS_ENTITLEMENT`) VALUES
('0', 2024, 0, 0, 30),
('0', 2024, 0, 0, 30);

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `LEAVE_TYPE_ID` int(11) NOT NULL,
  `LEAVE_NAME` varchar(100) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DAYS_ALLOWED` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`LEAVE_TYPE_ID`, `LEAVE_NAME`, `DESCRIPTION`, `DAYS_ALLOWED`) VALUES
(1, ' sick leave ', 'checkup', 20),
(2, ' ', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `ID` int(11) NOT NULL,
  `FULL_NAME` text NOT NULL,
  `LEAVE_TYPE` text NOT NULL,
  `SUBMISSION_DATE` datetime NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `VIEWED` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`ID`, `FULL_NAME`, `LEAVE_TYPE`, `SUBMISSION_DATE`, `CREATED_AT`, `VIEWED`) VALUES
(1, '', 'medical leave', '2024-01-20 00:00:00', '2024-01-20 13:25:05', 0),
(2, '', 'medical leave', '2024-01-20 00:00:00', '2024-01-20 13:28:58', 0),
(3, 'kwame afrane Adu', 'sick leave', '2024-01-20 00:00:00', '2024-01-20 14:14:07', 0),
(4, 'kwame afrane Adu', 'sick leave', '2024-01-20 00:00:00', '2024-01-20 14:24:23', 0),
(5, 'kwame afrane Adu', '', '2024-01-22 00:00:00', '2024-01-22 15:54:26', 0),
(6, 'kwame afrane Adu', 'sick leave', '2024-01-22 00:00:00', '2024-01-22 16:01:52', 0),
(7, 'kwame afrane Adu', 'medical leave', '2024-01-22 00:00:00', '2024-01-22 16:14:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `STAFF_NAME` varchar(255) NOT NULL,
  `ID_NUMBER` varchar(20) NOT NULL,
  `GENDER` varchar(10) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `MIDDLE_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `IN_CHARGE` text NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `CONTACT` int(11) NOT NULL,
  `PROFILE_IMAGE` varchar(255) NOT NULL,
  `DEPARTMENT` varchar(50) NOT NULL,
  `UNIT` text NOT NULL,
  `GRADE` varchar(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `LEAVE_DAYS_ENTITLEMENT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`STAFF_NAME`, `ID_NUMBER`, `GENDER`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `IN_CHARGE`, `EMAIL`, `CONTACT`, `PROFILE_IMAGE`, `DEPARTMENT`, `UNIT`, `GRADE`, `USERNAME`, `PASSWORD`, `LEAVE_DAYS_ENTITLEMENT`) VALUES
('', '1234', 'Female', 'f', 'gf', 'g', '20', 'datswilson1@gmail.com', 2147483647, 'afrobeats.PNG', 'IT', '', 'IT', 'ffd', '$2y$10$MqV0CPAgkMPEGQ3LJznJAOT8HQ1Z00qJgBZ6tWH7PjHMtamPVMLpe', 0),
('', '12344', 'Female', 'Ella', 'Yayra', 'Ocloo', '20', 'edemwilson123@gmail.com', 1234567890, '', 'RSIM', '', 'SUPERVISOR', 'ella', '12345', 0),
('', '12345', 'Male', 'andy', 'joe', 'essuman', '22', 'danielboadu290999@gmail.com', 1234567890, '', 'IT', '', 'IT', 'andy', '1234', 0),
('', '2323', 'Male', 'kwame', 'afrane', 'Adu', 'baah', 'edemwilson123@gmail.com', 1234567890, '', 'PPME', 'pr', 'dir', 'kwame', '12345', 30),
('', '2325', 'Male', 'kwame', 'afrane', 'Adu', 'baah', 'edemwilson123@gmail.com', 1234567890, '', 'RSIM', 'pr', 'dir', 'kk', '12345', 30),
('', '2424', 'Male', 'mike', 'd', 'vcg', 'drew', 'datswilson1@gmail.com', 2020202020, '', 'PPME', 'pr', 'junior', 'mike', '12345', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `FULL_NAME` varchar(255) NOT NULL,
  `CONTACT` int(11) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `USER_CATEGORY` text NOT NULL DEFAULT 'CHECK (user_category IN (\'Admin\', \'Staff\'))',
  `DIRECTORATE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `FULL_NAME`, `CONTACT`, `EMAIL`, `USERNAME`, `PASSWORD`, `USER_CATEGORY`, `DIRECTORATE`) VALUES
(1, 'admin', 1234567890, 'datswilson1@gmail.com', 'admin', 'admin', 'Admin', ''),
(4, 'edem', 2020202020, 'AKAW117@UGSPEECHDATA.COM', 'edem', '12345', 'Admin', ''),
(8, 'adjei Browne', 2020202020, 'datswilson1@gmail.com', 'dir', '12345', 'Director', ''),
(9, 'ike ', 1234567, 'datswilson1@gmail.com', 'ike', '12345', 'Director', 'RSIM'),
(10, 'Fred', 1234567890, 'datswilson1@gmail.com', 'fred', '12345', 'HR', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin-actions`
--
ALTER TABLE `admin-actions`
  ADD KEY `ADMIN_ID` (`ADMIN_ID`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`directorate_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`LEAVE_ID`),
  ADD KEY `Uid` (`USER_ID`),
  ADD KEY `ID_NUMBER` (`ID_NUMBER`);

--
-- Indexes for table `leave_management`
--
ALTER TABLE `leave_management`
  ADD PRIMARY KEY (`LEAVE ID`),
  ADD KEY `LEAVE_TYPES` (`LEAVE_TYPE_ID`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`LEAVE_TYPE_ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID_NUMBER`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `directorate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leave_application`
--
ALTER TABLE `leave_application`
  MODIFY `LEAVE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `LEAVE_TYPE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin-actions`
--
ALTER TABLE `admin-actions`
  ADD CONSTRAINT `ADMIN_ID` FOREIGN KEY (`ADMIN_ID`) REFERENCES `admins` (`ADMIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD CONSTRAINT `leave_application_ibfk_1` FOREIGN KEY (`ID_NUMBER`) REFERENCES `staff` (`ID_NUMBER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_management`
--
ALTER TABLE `leave_management`
  ADD CONSTRAINT `LEAVE_TYPES` FOREIGN KEY (`LEAVE_TYPE_ID`) REFERENCES `leave_management` (`LEAVE ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
