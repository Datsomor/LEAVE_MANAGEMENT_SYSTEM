-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2021 at 08:36 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblacc`
--

CREATE TABLE `tblacc` (
    'id' int(11)NOT NULL,
    'full_name' VARCHAR(255) NOT NULL,
    'contact' VARCHAR(20),
    'email' VARCHAR(100) NOT NULL,
    'username' VARCHAR(50) UNIQUE NOT NULL,
    'password' VARCHAR(255) NOT NULL,
    `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblacc`
--

INSERT INTO `tblacc` (`id`, `empId`, `email`, `password`, `usertype`, `creation_date`) VALUES
(1, '123', 'admin', 'admin', 'admin', '2019-11-27 09:32:22'),
(2, 'SML-0004', '', '', '', '2019-11-27 10:00:18'),
(3, '3214', 'boss', 'boss', 'boss', '2019-11-28 03:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `id` int(11) NOT NULL,
  `CompanyName` varchar(100) NOT NULL,
  `CompanyShortName` varchar(50) NOT NULL,
  `CompanyCode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`id`, `CompanyName`, `CompanyShortName`, `CompanyCode`) VALUES
(1, 'SML-COMPANY', 'SML', 'SML1000');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`,  `CreationDate`) VALUES
(1, 'Clothing', 'SML-C-0001', 15, 'C0001', '2017-11-01 07:16:25'),
(2, 'Beauty Product', 'SML-BP-0002', '2017-11-01 07:19:37'),
(3, 'HardWare', 'SML-HW-0003', '2017-12-02 21:28:56'),
(5, 'Gadget', 'SML-G-0004', '2019-11-14 09:46:34'),
(6, 'School Supply', 'SML-HW-0003', '2019-12-06 05:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `id` int(11) NOT NULL,
  `Idnumber` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Company` varchar(100) NOT NULL,
    'profile_image' VARCHAR(255),
    'username' VARCHAR(50) UNIQUE NOT NULL,
    'password' VARCHAR(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployees`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblleaves`
--

CREATE TABLE `tblleaves` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(110) NOT NULL,
  `Days_of_Leave` varchar(11) NOT NULL,
  `ToDate` varchar(120) NOT NULL,
  `FromDate` varchar(120) NOT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` varchar(120) NOT NULL,
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` varchar(50) NOT NULL,
  `EmployeeName` varchar(100) NOT NULL,
  `EmployeeId` varchar(50) NOT NULL,
  `ShiftTime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleaves`
--

INSERT INTO `tblleaves` (`id`, `LeaveType`, `Days_of_Leave`, `ToDate`, `FromDate`, `Description`, `PostingDate`, `AdminRemark`, `AdminRemarkDate`, `Status`, `EmployeeName`, `EmployeeId`, `ShiftTime`) VALUES
(16, 'Medical Leave test', '1', 'Monday, 2 December 2019', 'Saturday, 30 November 2019', '', 'Saturday, 30 November 2019', '', 'Sunday, 1 December 2019', 'APPROVE', 'Jordan', 'SML-0004', 'PM'),
(17, 'Casual Leave', '1.5', 'Tuesday, 3 December 2019', 'Saturday, 30 November 2019', '', 'Sunday, 1 December 2019', '', 'Sunday, 1 December 2019', 'REJECT', 'Jordan', 'SML-0004', 'PM'),
(19, 'Medical Leave test', '4', 'Tuesday, 10 December 2019', 'Friday, 6 December 2019', 'findings maninoy', 'Friday, 6 December 2019', '', 'Friday, 6 December 2019', 'REJECT', 'Jordan', 'SML-0004', ''),
(20, 'Medical Leave test', '4', 'Tuesday, 10 December 2019', 'Friday, 6 December 2019', 'findings maninoy', 'Friday, 6 December 2019', NULL, NULL, 'PENDING', 'Jordan', 'SML-0004', 'ALL DAY');

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

CREATE TABLE `tblleavetype` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `CreationDate`) VALUES
(1, 'Casual Leave', 'Casual Leave ',  '2017-11-01 12:07:56'),
(2, 'Medical Leave test', 'Medical Leave  test', '2017-11-06 13:16:09'),
(3, 'Restricted Holiday(RH)', 'Restricted Holiday(RH)', '2017-11-06 13:16:38'),
(4, 'Casual Leave1', 'Casual Leave', '2019-11-28 02:16:14'),
(5, 'Paternity Leave', 'Paternity Leave', '2019-12-06 05:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocation`
--

CREATE TABLE  `admin_actions` (
    'action_id' int(11) NOT NULL,
    'leave_id' INTEGER NOT NULL,
    'admin_id' INTEGER NOT NULL,
    'action_type' TEXT CHECK (action_type IN ('Approve', 'Not Approve')) NOT NULL,
    'action_date' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE  'admins' (
    'admin_id' int(11) NOT NULL,
    'username' VARCHAR(50) NOT NULL
    -- Add more fields as needed
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE  'leave_statistics' (
    'statistic_id' int(11) NOT NULL,,
    'total_leaves' INTEGER NOT NULL,
    'approved_leaves' INTEGER NOT NULL,
    'pending_leaves' INTEGER NOT NULL,
    'canceled_leaves' INTEGER NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tbllocation` (
  `id` int(11) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllocation`
--

INSERT INTO `tbllocation` (`id`, `Country`, `City`) VALUES
(1, 'PH', 'SIPALAY'),
(2, 'PH', 'CAUAYAN'),
(3, 'PH', 'CANDONI'),
(4, 'PH', 'DANCALAN'),
(5, 'PH', 'KABANKALAN'),
(6, 'PH', 'HIMAMAYLAN'),
(7, 'PH', 'BINALBAGAN'),
(8, 'PH', 'ISABELLA'),
(9, 'PH ', 'HINIGARAN'),
(10, 'PH', 'PONTEVEDRA'),
(11, 'PH', 'VALLADOLID'),
(12, 'PH', 'PULOPANDAN'),
(13, 'PH', 'BAGO'),
(14, 'PH', 'SUM-AG'),
(15, 'PH', 'BACOLOD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblacc`
--
ALTER TABLE `tblacc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admin_actions`
  ADD PRIMARY KEY (`action_id`);
--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

ALTER TABLE `leave_statistics`
  ADD PRIMARY KEY (`statistic_id`);
--
-- Indexes for table `tbllocation`
--
ALTER TABLE `tbllocation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblacc`
--
ALTER TABLE `tblacc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE 'leave_statistics'
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `admin_actions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6

ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6
--
-- AUTO_INCREMENT for table `tbllocation`
--
ALTER TABLE `tbllocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
