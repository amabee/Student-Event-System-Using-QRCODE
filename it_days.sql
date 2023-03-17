-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2023 at 12:39 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it_days`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `unique_id` int(11) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `emailadd` varchar(250) NOT NULL,
  `Time_In` datetime NOT NULL,
  `Time_Out` datetime NOT NULL,
  `event_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`unique_id`, `student_id`, `firstname`, `lastname`, `emailadd`, `Time_In`, `Time_Out`, `event_id`) VALUES
(17, '02-2223-51222', 'Tsuchiya', 'Tao', 'tsta.tao.coc@phinmaed.com', '2023-02-21 01:24:32', '0000-00-00 00:00:00', 'ITD-2526'),
(18, '02-2223-51222', 'Tsuchiya', 'Tao', 'tsta.tao.coc@phinmaed.com', '2023-02-21 01:25:11', '0000-00-00 00:00:00', 'ITD-2526'),
(23, '02-1920-69420', 'China', 'Matsouka', 'chma.matsouka.coc@phinmaed.com', '2023-02-21 07:34:27', '2023-02-21 07:36:11', 'IT-Concert-082024');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `primary_key` int(11) NOT NULL,
  `event_id` varchar(250) NOT NULL,
  `event_name` varchar(250) NOT NULL,
  `event_venue` varchar(250) NOT NULL,
  `event_qr` blob NOT NULL,
  `TimeOF_IN` datetime NOT NULL,
  `TimeOF_OUT` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`primary_key`, `event_id`, `event_name`, `event_venue`, `event_qr`, `TimeOF_IN`, `TimeOF_OUT`, `created_at`) VALUES
(13, 'ITD-2526', 'IT Days 2023', 'Main Campus', 0x7172636f6465732f4954442d323532362e706e67, '2023-03-08 08:00:00', '2023-03-08 02:00:00', '2023-02-20 23:28:25'),
(15, 'IT-Concert-082024', 'IT Days 2026', 'Seoul, South Korea', 0x7172636f6465732f49542d436f6e636572742d3038323032342e706e67, '2023-02-21 07:32:00', '2023-02-21 07:35:00', '2023-02-21 07:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `primary_id` int(11) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `emailadd` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`primary_id`, `student_id`, `fname`, `lname`, `emailadd`) VALUES
(12, '03-2223-95211', 'Yi Hyun', 'Choi', 'yhch.choi.coc@phinmaed.com'),
(13, '02-1920-03954', 'Christine', 'Orencio', 'coma.orencio.coc@phinmaed.com'),
(19, '02-2223-51251', 'Ji Eun', 'Lee', 'jile.lee.coc@phinmaed.com'),
(20, '02-2223-51251', 'Ji Eun', 'Lee', 'jile.lee.coc@phinmaed.com'),
(30, '02-2223-51222', 'Tsuchiya', 'Tao', 'tsta.tao.coc@phinmaed.com'),
(31, '02-2223-51222', 'Tsuchiya', 'Tao', 'tsta.tao.coc@phinmaed.com'),
(32, '02-1920-69420', 'China', 'Matsouka', 'chma.matsouka.coc@phinmaed.com'),
(33, '02-1920-69420', 'China', 'Matsouka', 'chma.matsouka.coc@phinmaed.com'),
(34, '02-1920-69420', 'China', 'Matsouka', 'chma.matsouka.coc@phinmaed.com'),
(35, '02-1920-69420', 'China', 'Matsouka', 'chma.matsouka.coc@phinmaed.com'),
(36, '02-1920-69420', 'China', 'Matsouka', 'chma.matsouka.coc@phinmaed.com'),
(37, '02-1920-69420', 'China', 'Matsouka', 'chma.matsouka.coc@phinmaed.com'),
(38, '02-1920-69420', 'China', 'Matsouka', 'chma.matsouka.coc@phinmaed.com'),
(39, '02-1920-69420', 'China', 'Matsouka', 'chma.matsouka.coc@phinmaed.com'),
(40, '02-1920-69420', 'China', 'Matsouka', 'chma.matsouka.coc@phinmaed.com'),
(41, '02-1920-69420', 'China', 'Matsouka', 'chma.matsouka.coc@phinmaed.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`unique_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`primary_key`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`primary_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `unique_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `primary_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `primary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
