-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2025 at 05:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Security_Code` int(55) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Security_Code`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Administrator', 'admin', 7854445410, 1100, 'admin@gmail.com', 'd00f5d5217896fb7fd601412cb890830', '2021-01-05 05:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `contract_info`
--

CREATE TABLE `contract_info` (
  `contract_id` int(11) NOT NULL,
  `contractor_name` varchar(100) NOT NULL,
  `contract_quantity` int(11) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contract_info`
--

INSERT INTO `contract_info` (`contract_id`, `contractor_name`, `contract_quantity`, `CreationDate`) VALUES
(12345, 'Anousith Company', 100000, '2025-07-24 15:00:21'),
(34567, 'ລາວ', 100000099, '2025-07-20 16:04:59'),
(98989, 'phonexay', 10000088, '2025-07-20 16:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `entry_trucks_info`
--

CREATE TABLE `entry_trucks_info` (
  `entry_trucks_id` int(11) NOT NULL,
  `entry_front_truck_plate` varchar(100) NOT NULL,
  `entry_back_truck_plate` varchar(100) NOT NULL,
  `entry_truck_driver_name` varchar(100) NOT NULL,
  `truck_owner` varchar(100) NOT NULL,
  `in_weight` int(11) NOT NULL,
  `in_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `out_weight` int(11) NOT NULL,
  `out_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `loading_weight` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `entry_trucks_info`
--

INSERT INTO `entry_trucks_info` (`entry_trucks_id`, `entry_front_truck_plate`, `entry_back_truck_plate`, `entry_truck_driver_name`, `truck_owner`, `in_weight`, `in_time`, `out_weight`, `out_time`, `loading_weight`, `status`) VALUES
(94, 'ດຣ2590', 'ດຣ2595', 'ພອນໄຊ ນາມສະຫວັນ', 'phonexay', 450, '2025-08-07 16:28:35', 500, '2025-08-07 16:29:49', 50, 1),
(95, 'ດຣ2590', 'ດຣ2595', 'ພອນໄຊ ນາມສະຫວັນ', 'phonexay', 400, '2025-08-07 16:32:45', 500, '2025-08-07 16:33:30', 100, 1),
(96, 'ກກ2025', 'ກກ2025', 'ໂຢນາ', 'ລາວ', 10, '2025-08-08 06:55:57', 100, '2025-08-08 07:11:40', 90, 1),
(98, 'ກກ2025', 'ກກ2025', 'ໂຢນາ', 'ລາວ', 50, '2025-08-12 05:42:23', 100, '2025-08-12 05:42:40', 50, 1),
(99, 'ດຣ2578', 'ດຣ2579', '123456', 'phonexay', 500, '2025-08-29 03:33:52', 600, '2025-08-29 03:34:37', 100, 1);

--
-- Triggers `entry_trucks_info`
--
DELIMITER $$
CREATE TRIGGER `before_loading_weight_update` BEFORE UPDATE ON `entry_trucks_info` FOR EACH ROW SET NEW.loading_weight = (NEW.out_weight - NEW.in_weight)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_email` varchar(55) NOT NULL,
  `c_website` varchar(55) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `last_update` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `c_name`, `c_email`, `c_website`, `c_address`, `last_update`) VALUES
(1, 'Demo Company', 'vparksystem@company.com', 'codeastro.com', '8169 Geigeer St NW', '2021-06-08 20:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `truck_info`
--

CREATE TABLE `truck_info` (
  `front_truck_plate` varchar(6) NOT NULL,
  `back_truck_plate` varchar(6) NOT NULL,
  `diver_name` varchar(100) NOT NULL,
  `truck_owner` varchar(100) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `truck_info`
--

INSERT INTO `truck_info` (`front_truck_plate`, `back_truck_plate`, `diver_name`, `truck_owner`, `CreationDate`) VALUES
('ກກ2025', 'ກກ2025', 'ໂຢນາ', 'ລາວ', '2025-07-23 18:07:03'),
('ດຣ2558', 'ດຣ2559', 'Tiger Head', 'phonexay', '2025-07-22 09:15:30'),
('ດຣ2578', 'ດຣ2579', '123456', 'phonexay', '2025-07-22 06:20:14'),
('ດຣ2590', 'ດຣ2595', 'ພອນໄຊ ນາມສະຫວັນ', 'phonexay', '2025-07-20 16:16:13'),
('ດຣ2599', 'ດຣ2599', 'ອ້າຍ', 'ລາວ', '2025-07-24 13:45:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contract_info`
--
ALTER TABLE `contract_info`
  ADD UNIQUE KEY `contract_id` (`contract_id`);

--
-- Indexes for table `entry_trucks_info`
--
ALTER TABLE `entry_trucks_info`
  ADD PRIMARY KEY (`entry_trucks_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `truck_info`
--
ALTER TABLE `truck_info`
  ADD PRIMARY KEY (`front_truck_plate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `entry_trucks_info`
--
ALTER TABLE `entry_trucks_info`
  MODIFY `entry_trucks_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
