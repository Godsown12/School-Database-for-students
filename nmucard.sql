-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2022 at 02:16 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nmucard`
--

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `firstName` varchar(225) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `level` varchar(225) NOT NULL,
  `matNo` varchar(225) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `bloodGroup` varchar(255) NOT NULL,
  `EmergencyNo` varchar(255) NOT NULL,
  `phoneNo` varchar(225) NOT NULL,
  `dateEnter` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `folderPath` text NOT NULL,
  `qrCodeName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `firstName`, `lastName`, `middleName`, `faculty`, `department`, `level`, `matNo`, `gender`, `bloodGroup`, `EmergencyNo`, `phoneNo`, `dateEnter`, `folderPath`, `qrCodeName`) VALUES
(1, 'BOLOU', 'BOLOU', 'DICKSON', 'FACULTY OF TRANSPORT', 'CIVIL ENGINEERING', 'Level 1', 'U2019/MTL/001', 'MALE', 'O+', '08037898200', '08136779046', '2021-07-28 10:23:08', 'departments/CIVIL ENGINEERING/BOLOU BOLOU DICKSON/', 'BOLOU BOLOU DICKSON'),
(2, 'ERIC', 'DR', 'KHALIFA', 'FACULTY OF ENGINEERING', 'MARINE ENGINEERING', 'Level 3', 'FMEM/MEP/18/19/007', 'MALE', 'A+', '09037596979', '09037596979', '2021-07-28 20:39:27', 'departments/MARINE ENGINEERING/DR ERIC KHALIFA/', 'DR ERIC KHALIFA');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `users_id` int(11) NOT NULL,
  `userName` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`users_id`, `userName`, `password`) VALUES
(1, 'ictnmu', '$2y$10$dsLUKSuubEv7kFSQhQMMWebKcTuK7E0RHkSNLOLSVr4RAwLzEDNne');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
