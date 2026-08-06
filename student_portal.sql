-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2026 at 10:38 AM
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
-- Database: `student_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `status`) VALUES
(1, 'Arsh', '12345', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Arsh', 'arsh@gmail.com', 'feedback', 'Nice website', '2026-07-15 12:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `rollno` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `student_name` varchar(100) DEFAULT NULL,
  `class` varchar(100) NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reply` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `rollno`, `photo`, `student_name`, `class`, `subject`, `message`, `created_at`, `reply`) VALUES
(11, '1', '1785308030_ME.jpeg', 'Arshdeep Singh', 'cse', 'Feedback', 'Nice Website', '2026-07-29 06:54:22', 'Thanks');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `course` varchar(100) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `downloads` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `course`, `title`, `file_name`, `uploaded_on`, `downloads`) VALUES
(6, 'CSE', 'C', 'c.pdf', '2026-07-20 12:16:55', 1),
(7, 'CSE', 'DE', 'DE.pdf', '2026-07-20 12:18:11', 0),
(8, 'CSE', 'Applied Physics', 'applied-physics.pdf', '2026-07-20 12:18:32', 1),
(9, 'BA', 'Applied Chemistry', 'applied-chemistry.pdf', '2026-07-20 12:18:48', 0),
(10, '10', 'DE', 'DE.pdf', '2026-07-21 11:33:20', 1),
(11, '10', 'Math', 'math.pdf', '2026-07-21 11:33:33', 1),
(12, '10', 'Science', 'science.pdf', '2026-07-21 11:33:44', 4),
(13, 'BA', 'Math', 'math.pdf', '2026-07-21 11:34:20', 0),
(14, '8', 'English', 'english.pdf', '2026-07-21 11:34:31', 1),
(15, 'it', 'Mechanics', 'engineering-mechanics.pdf', '2026-07-29 07:34:29', 1),
(16, 'it', 'Mechanics', '1785312774_engineering-mechanics.pdf', '2026-07-29 08:12:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quick_message`
--

CREATE TABLE `quick_message` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `rollno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `rollno` varchar(100) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fullname`, `rollno`, `mobile`, `course`, `password`, `created_at`, `photo`) VALUES
(1, 'Arshdeep singh', '10', '9501291923', 'cse', '12345', '2026-07-14 12:05:19', '126441053-karan-aujla.jpg'),
(2, 'Sahil', '11', '1234567890', '10', '100', '2026-07-17 11:48:31', '1784633568_555.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `rollno` int(11) NOT NULL,
  `student_f_name` varchar(200) DEFAULT NULL,
  `student_l_name` varchar(200) DEFAULT NULL,
  `student_class` varchar(200) DEFAULT NULL,
  `adhar` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `student_photo` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Approve'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`rollno`, `student_f_name`, `student_l_name`, `student_class`, `adhar`, `father_name`, `mother_name`, `phone`, `address`, `pincode`, `student_photo`, `status`) VALUES
(1, 'Arshdeep', 'Singh', 'cse', '123456789001', 'Sandeep singh', 'Jaspal kaur', '9501291923', 'Amritsar', 143001, '1785308030_ME.jpeg', 'Approve'),
(2, 'Modi', 'Ji', '10', '987654321000', 'ABC', 'XYZ', '9876543211', 'Amritsar', 143002, '1784893865_pm modi.png', 'Cancel'),
(3, 'Sahil', 'singh', 'ba', '654258554159', 'fgd', 'dfg', '3692581478', 'Amritsar', 143006, '000.jpg', 'Cancel'),
(4, 'Roshandeep', 'Kaur', 'ba', '123456789090', 'cba', 'abc', '2584567539', 'Amritsar', 143000, 'pexels-peg1997-16892463.jpg', 'Approve');

-- --------------------------------------------------------

--
-- Table structure for table `student_result`
--

CREATE TABLE `student_result` (
  `id` int(11) NOT NULL,
  `rollno` varchar(50) NOT NULL,
  `percentage` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_result`
--

INSERT INTO `student_result` (`id`, `rollno`, `percentage`, `status`, `created_at`) VALUES
(1, '1', '98.99', 'Pass', '2026-07-24 12:14:43'),
(2, '2', '28.6', 'Fail', '2026-07-27 12:09:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quick_message`
--
ALTER TABLE `quick_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`rollno`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`rollno`);

--
-- Indexes for table `student_result`
--
ALTER TABLE `student_result`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `quick_message`
--
ALTER TABLE `quick_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `rollno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_result`
--
ALTER TABLE `student_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
