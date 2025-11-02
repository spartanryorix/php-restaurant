-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2025 at 04:57 PM
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
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_info`
--

CREATE TABLE `account_info` (
  `id` int(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(65) NOT NULL,
  `role` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_info`
--

INSERT INTO `account_info` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(5, 'ryrawwrix', 'abcd123@gmail.com', '$2y$10$VxNcRYQMLs.lLtBHW/UoceQLyBbAgRWvVlVol2dV72y6HbeVrqBIe', 'admin', '2025-02-19 18:21:06'),
(7, 'Abdul Rakeeb', 'abcdef123@gmail.com', '$2y$10$PD5OQ.BmEC6DulRTght2duMhWqefU6TeY063xp58CVs7RoaMNTdK2', 'admin', '2025-03-02 18:10:21'),
(8, 'rakyraky', 'shallowwater321@gmail.com', '$2y$10$/PFn9tUpMwSu.o9lNnU4uOGt.jhlqanmPfA.esUi1ll0n/Z5fQBOS', 'customer', '2025-03-02 18:33:48'),
(11, 'Azmeer', 'som12@gmail.com', '$2y$10$zEuJVt5RTIXRwR6ItQXhROCR6D9vSW1ZMheKemVhPKZCdBIMWTA7i', 'customer', '2025-03-18 19:15:48'),
(12, 'kingrake', 'kingrake123@gmail.com', '$2y$10$LkwqL8VMTvF0SbmOoqzxEu75BV.Q.6GhaZMYaRafugsdFavjuYlue', 'customer', '2025-03-24 19:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `table_no` int(25) NOT NULL,
  `no_of_seats` int(25) NOT NULL,
  `booking_date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `dining_date` datetime(6) DEFAULT NULL,
  `booking_free_date` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `table_no`, `no_of_seats`, `booking_date`, `dining_date`, `booking_free_date`) VALUES
(43, 5, 2, 3, '2025-03-29 00:41:14.915956', '2025-04-03 12:00:00.000000', '2025-03-29 00:41:40.000000'),
(44, 5, 1, 3, '2025-03-29 00:41:59.164767', '2025-03-29 12:00:00.000000', '2025-03-29 00:42:07.000000'),
(45, 5, 1, 3, '2025-03-29 00:46:34.404415', '2025-03-30 12:00:00.000000', '2025-03-29 01:14:30.000000'),
(46, 5, 1, 3, '2025-03-29 01:35:20.538579', '2025-04-04 12:00:00.000000', '2025-04-07 17:59:02.000000'),
(47, 5, 1, 2, '2025-04-14 22:54:57.680956', '2025-04-15 16:00:00.000000', '2025-11-02 18:52:08.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_info`
--
ALTER TABLE `account_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_info`
--
ALTER TABLE `account_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
