-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 09:40 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentfinancialsystem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year_tb`
--

CREATE TABLE `academic_year_tb` (
  `academic_year_id` int(11) NOT NULL,
  `academic_year_name` varchar(50) NOT NULL,
  `academic_year_fees` double NOT NULL DEFAULT 0,
  `academic_year_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_year_tb`
--

INSERT INTO `academic_year_tb` (`academic_year_id`, `academic_year_name`, `academic_year_fees`, `academic_year_status`) VALUES
(1, '2022-2023', 500000, ''),
(2, '2023-2024', 450000, '');

-- --------------------------------------------------------

--
-- Table structure for table `employee_roles_tb`
--

CREATE TABLE `employee_roles_tb` (
  `employee_roles_id` int(11) NOT NULL,
  `employee_roles_role` int(11) NOT NULL,
  `employee_roles_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_roles_tb`
--

INSERT INTO `employee_roles_tb` (`employee_roles_id`, `employee_roles_role`, `employee_roles_employee`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_tb`
--

CREATE TABLE `employee_tb` (
  `EMPLOYEE_id` int(11) NOT NULL,
  `EMPLOYEE_fname` varchar(50) NOT NULL,
  `EMPLOYEE_lname` varchar(50) NOT NULL,
  `EMPLOYEE_idno` varchar(50) NOT NULL,
  `EMPLOYEE_phone` varchar(50) NOT NULL,
  `EMPLOYEE_photo` varchar(50) NOT NULL,
  `EMPLOYEE_position` int(11) NOT NULL,
  `EMPLOYEE_faculte` int(11) NOT NULL,
  `EMPLOYEE_username` varchar(50) NOT NULL,
  `EMPLOYEE_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_tb`
--

INSERT INTO `employee_tb` (`EMPLOYEE_id`, `EMPLOYEE_fname`, `EMPLOYEE_lname`, `EMPLOYEE_idno`, `EMPLOYEE_phone`, `EMPLOYEE_photo`, `EMPLOYEE_position`, `EMPLOYEE_faculte`, `EMPLOYEE_username`, `EMPLOYEE_password`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin', 1, 0, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `faculte_tb`
--

CREATE TABLE `faculte_tb` (
  `faculte_id` int(11) NOT NULL,
  `faculte_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `option_tb`
--

CREATE TABLE `option_tb` (
  `option_id` int(11) NOT NULL,
  `option_name` varchar(50) NOT NULL,
  `option_faculte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmodel_tb`
--

CREATE TABLE `paymentmodel_tb` (
  `PAYMENTMODEL_id` int(11) NOT NULL,
  `PAYMENTMODEL_name` varchar(50) NOT NULL,
  `PAYMENTMODEL_amount` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `position_tb`
--

CREATE TABLE `position_tb` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position_tb`
--

INSERT INTO `position_tb` (`position_id`, `position_name`) VALUES
(1, 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `role_tb`
--

CREATE TABLE `role_tb` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_tb`
--

INSERT INTO `role_tb` (`role_id`, `role_name`) VALUES
(1, 'DASHBOARD'),
(2, 'EMPLOYEES'),
(3, 'FACLUTES'),
(4, 'OPTIONS'),
(5, 'STUDENTS'),
(6, 'PAYMENTS');

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails_tb`
--

CREATE TABLE `studentdetails_tb` (
  `STUDENTDETAILS_id` int(11) NOT NULL,
  `STUDENTDETAILS_std` int(11) NOT NULL,
  `STUDENTDETAILS_option` int(11) NOT NULL,
  `STUDENTDETAILS_year` varchar(50) NOT NULL,
  `STUDENTDETAILS_yearbal` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studentpayment_tb`
--

CREATE TABLE `studentpayment_tb` (
  `STUDENTPAYMENT_id` int(11) NOT NULL,
  `STUDENTPAYMENT_std` int(11) NOT NULL,
  `STUDENTPAYMENT_amount` double NOT NULL DEFAULT 0,
  `STUDENTPAYMENT_pydate` varchar(50) NOT NULL,
  `STUDENTPAYMENT_receiptno` varchar(50) NOT NULL,
  `STUDENTPAYMENT_receiptdoc` varchar(100) NOT NULL,
  `STUDENTPAYMENT_pymtmodel` int(11) NOT NULL,
  `STUDENTPAYMENT_status` varchar(50) NOT NULL,
  `STUDENTPAYMENT_comment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_tb`
--

CREATE TABLE `student_tb` (
  `student_id` int(11) NOT NULL,
  `student_reg` varchar(50) NOT NULL,
  `student_fname` varchar(50) NOT NULL,
  `student_lname` varchar(50) NOT NULL,
  `student_phone` varchar(50) NOT NULL,
  `student_idno` varchar(50) NOT NULL,
  `student_photo` varchar(250) NOT NULL,
  `student_fees` double NOT NULL DEFAULT 0,
  `student_lastpymt` double NOT NULL DEFAULT 0,
  `student_totpaid` double NOT NULL DEFAULT 0,
  `student_lastpydate` varchar(50) NOT NULL,
  `student_username` varchar(50) NOT NULL,
  `student_pass` varchar(50) NOT NULL,
  `student_academicyear` int(11) NOT NULL,
  `student_option` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year_tb`
--
ALTER TABLE `academic_year_tb`
  ADD PRIMARY KEY (`academic_year_id`);

--
-- Indexes for table `employee_roles_tb`
--
ALTER TABLE `employee_roles_tb`
  ADD PRIMARY KEY (`employee_roles_id`);

--
-- Indexes for table `employee_tb`
--
ALTER TABLE `employee_tb`
  ADD PRIMARY KEY (`EMPLOYEE_id`);

--
-- Indexes for table `faculte_tb`
--
ALTER TABLE `faculte_tb`
  ADD PRIMARY KEY (`faculte_id`);

--
-- Indexes for table `option_tb`
--
ALTER TABLE `option_tb`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `paymentmodel_tb`
--
ALTER TABLE `paymentmodel_tb`
  ADD PRIMARY KEY (`PAYMENTMODEL_id`);

--
-- Indexes for table `position_tb`
--
ALTER TABLE `position_tb`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `role_tb`
--
ALTER TABLE `role_tb`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `studentdetails_tb`
--
ALTER TABLE `studentdetails_tb`
  ADD PRIMARY KEY (`STUDENTDETAILS_id`);

--
-- Indexes for table `studentpayment_tb`
--
ALTER TABLE `studentpayment_tb`
  ADD PRIMARY KEY (`STUDENTPAYMENT_id`);

--
-- Indexes for table `student_tb`
--
ALTER TABLE `student_tb`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year_tb`
--
ALTER TABLE `academic_year_tb`
  MODIFY `academic_year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_roles_tb`
--
ALTER TABLE `employee_roles_tb`
  MODIFY `employee_roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_tb`
--
ALTER TABLE `employee_tb`
  MODIFY `EMPLOYEE_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faculte_tb`
--
ALTER TABLE `faculte_tb`
  MODIFY `faculte_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `option_tb`
--
ALTER TABLE `option_tb`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentmodel_tb`
--
ALTER TABLE `paymentmodel_tb`
  MODIFY `PAYMENTMODEL_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `position_tb`
--
ALTER TABLE `position_tb`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_tb`
--
ALTER TABLE `role_tb`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `studentdetails_tb`
--
ALTER TABLE `studentdetails_tb`
  MODIFY `STUDENTDETAILS_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentpayment_tb`
--
ALTER TABLE `studentpayment_tb`
  MODIFY `STUDENTPAYMENT_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_tb`
--
ALTER TABLE `student_tb`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
