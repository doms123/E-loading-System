-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2017 at 02:43 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eloaddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loadamount`
--

CREATE TABLE `tbl_loadamount` (
  `loadAmountId` int(11) NOT NULL,
  `loadAmount` int(200) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_loadamount`
--

INSERT INTO `tbl_loadamount` (`loadAmountId`, `loadAmount`, `isActive`, `dateAdded`) VALUES
(1, 30, 1, '2017-10-08 12:41:16'),
(2, 50, 1, '2017-10-08 12:41:16'),
(3, 100, 1, '2017-10-08 12:41:16'),
(4, 300, 1, '2017-10-08 12:41:16'),
(5, 500, 1, '2017-10-08 12:41:16'),
(6, 1000, 1, '2017-10-08 12:41:16'),
(7, 2000, 1, '2017-10-08 12:41:16'),
(8, 3000, 1, '2017-10-08 12:41:16'),
(9, 5000, 1, '2017-10-08 12:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_netprefix`
--

CREATE TABLE `tbl_netprefix` (
  `netprefixId` int(11) NOT NULL,
  `netprefix` int(100) NOT NULL,
  `networkId` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `dateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_netprefix`
--

INSERT INTO `tbl_netprefix` (`netprefixId`, `netprefix`, `networkId`, `isActive`, `dateAdded`) VALUES
(1, 915, 1, 1, '2017-10-07 00:00:00'),
(2, 927, 1, 1, '2017-10-07 00:00:00'),
(3, 995, 1, 1, '2017-10-07 00:00:00'),
(4, 917, 1, 1, '2017-10-07 00:00:00'),
(5, 935, 1, 1, '2017-10-07 00:00:00'),
(6, 817, 1, 1, '2017-10-07 00:00:00'),
(7, 945, 1, 1, '2017-10-07 00:00:00'),
(8, 936, 1, 1, '2017-10-07 00:00:00'),
(9, 905, 1, 1, '2017-10-07 00:00:00'),
(10, 955, 1, 1, '2017-10-07 00:00:00'),
(11, 976, 1, 1, '2017-10-07 00:00:00'),
(12, 906, 1, 1, '2017-10-07 00:00:00'),
(13, 956, 1, 1, '2017-10-07 00:00:00'),
(14, 997, 1, 1, '2017-10-07 00:00:00'),
(15, 916, 1, 1, '2017-10-07 00:00:00'),
(16, 994, 1, 1, '2017-10-07 00:00:00'),
(17, 975, 1, 1, '2017-10-07 00:00:00'),
(18, 926, 1, 1, '2017-10-07 00:00:00'),
(19, 938, 2, 1, '2017-10-07 00:00:00'),
(20, 919, 2, 1, '2017-10-07 00:00:00'),
(21, 813, 2, 1, '2017-10-07 00:00:00'),
(22, 913, 2, 1, '2017-10-07 00:00:00'),
(23, 939, 2, 1, '2017-10-07 00:00:00'),
(24, 921, 2, 1, '2017-10-07 00:00:00'),
(25, 981, 2, 1, '2017-10-07 00:00:00'),
(26, 907, 2, 1, '2017-10-07 00:00:00'),
(27, 914, 2, 1, '2017-10-07 00:00:00'),
(28, 998, 2, 1, '2017-10-07 00:00:00'),
(29, 940, 2, 1, '2017-10-07 00:00:00'),
(30, 929, 2, 1, '2017-10-07 00:00:00'),
(31, 908, 2, 1, '2017-10-07 00:00:00'),
(32, 918, 2, 1, '2017-10-07 00:00:00'),
(33, 999, 2, 1, '2017-10-07 00:00:00'),
(34, 946, 2, 1, '2017-10-07 00:00:00'),
(35, 989, 2, 1, '2017-10-07 00:00:00'),
(36, 909, 2, 1, '2017-10-07 00:00:00'),
(37, 928, 2, 1, '2017-10-07 00:00:00'),
(38, 951, 2, 1, '2017-10-07 00:00:00'),
(39, 948, 2, 1, '2017-10-07 00:00:00'),
(40, 920, 2, 1, '2017-10-07 00:00:00'),
(41, 910, 2, 1, '2017-10-07 00:00:00'),
(42, 947, 2, 1, '2017-10-07 00:00:00'),
(43, 912, 2, 1, '2017-10-07 00:00:00'),
(44, 950, 2, 1, '2017-10-07 00:00:00'),
(45, 930, 2, 1, '2017-10-07 00:00:00'),
(46, 911, 2, 1, '2017-10-07 00:00:00'),
(47, 949, 2, 1, '2017-10-07 00:00:00'),
(48, 970, 2, 1, '2017-10-07 00:00:00'),
(49, 992, 2, 1, '2017-10-07 00:00:00'),
(50, 934, 3, 1, '2017-10-07 00:00:00'),
(51, 922, 3, 1, '2017-10-07 00:00:00'),
(52, 941, 3, 1, '2017-10-07 00:00:00'),
(53, 923, 3, 1, '2017-10-07 00:00:00'),
(54, 942, 3, 1, '2017-10-07 00:00:00'),
(55, 924, 3, 1, '2017-10-07 00:00:00'),
(56, 943, 3, 1, '2017-10-07 00:00:00'),
(57, 931, 3, 1, '2017-10-07 00:00:00'),
(58, 944, 3, 1, '2017-10-07 00:00:00'),
(59, 932, 3, 1, '2017-10-07 00:00:00'),
(60, 925, 3, 1, '2017-10-07 00:00:00'),
(61, 933, 3, 1, '2017-10-07 00:00:00'),
(62, 977, 4, 1, '2017-10-07 00:00:00'),
(63, 978, 4, 1, '2017-10-07 00:00:00'),
(64, 979, 4, 1, '2017-10-07 00:00:00'),
(65, 996, 5, 1, '2017-10-07 00:00:00'),
(66, 937, 6, 1, '2017-10-07 00:00:00'),
(67, 973, 7, 1, '2017-10-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_network`
--

CREATE TABLE `tbl_network` (
  `networkId` int(11) NOT NULL,
  `netName` varchar(200) NOT NULL,
  `netIsActive` int(11) NOT NULL,
  `netDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_network`
--

INSERT INTO `tbl_network` (`networkId`, `netName`, `netIsActive`, `netDateAdded`) VALUES
(1, 'Globe/TM', 1, '2017-10-08 05:43:42'),
(2, 'Smart/Talk \'N Text', 1, '2017-10-08 05:43:55'),
(3, 'Sun Cellular', 1, '2017-10-08 05:44:07'),
(4, 'Next Mobile', 1, '2017-10-08 05:44:17'),
(5, 'Cherry Mobile', 1, '2017-10-08 05:44:19'),
(6, 'ABS-CBN Mobile', 1, '2017-10-08 05:44:26'),
(7, 'Extelcom', 1, '2017-10-08 05:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `paymentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `loadAmount` int(200) NOT NULL,
  `networkId` int(11) NOT NULL,
  `txnId` varchar(200) NOT NULL,
  `paymentGross` float(10,2) NOT NULL,
  `currencyCode` varchar(50) NOT NULL,
  `payerEmail` varchar(200) NOT NULL,
  `paymentStatus` int(11) NOT NULL,
  `paymentDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userId` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `positionId` int(11) NOT NULL COMMENT '1 = admin | 2  = user',
  `isActive` int(11) NOT NULL DEFAULT '1',
  `dateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userId`, `email`, `password`, `firstname`, `lastname`, `mobile`, `address`, `positionId`, `isActive`, `dateAdded`) VALUES
(1, 'dominicksanchez30@gmail.com', 'pass123', 'Dominick ', 'Sanchez', '09123456789', 'Ortigas Pasig city', 1, 1, '2017-10-07 00:00:00'),
(7, 'doms21312@gmail.com', '123', 'test', 'haa', '23123213', 'eqweqwe', 2, 1, '2017-10-08 12:36:05'),
(8, 'doms213123@gmail.com', '12345', 'test', 'haa', '23123213', 'eqweqwe', 2, 1, '2017-10-08 12:36:18'),
(9, 'wewqewq@gmail.com', '232', 'ewqewq', 'eqweqw', 'eqweqw', 'ewqewq', 2, 1, '2017-10-08 12:39:03'),
(10, 'josh@gmail.com', 'pass123', 'Joshua', 'Sanchez', '09123456789', 'Ortigas Pasig City', 2, 1, '2017-10-08 15:33:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_loadamount`
--
ALTER TABLE `tbl_loadamount`
  ADD PRIMARY KEY (`loadAmountId`);

--
-- Indexes for table `tbl_netprefix`
--
ALTER TABLE `tbl_netprefix`
  ADD PRIMARY KEY (`netprefixId`);

--
-- Indexes for table `tbl_network`
--
ALTER TABLE `tbl_network`
  ADD PRIMARY KEY (`networkId`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_loadamount`
--
ALTER TABLE `tbl_loadamount`
  MODIFY `loadAmountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_netprefix`
--
ALTER TABLE `tbl_netprefix`
  MODIFY `netprefixId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `tbl_network`
--
ALTER TABLE `tbl_network`
  MODIFY `networkId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
