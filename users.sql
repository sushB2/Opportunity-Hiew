-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2023 at 06:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(128) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'sushmita', 'sushmita021200@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `all_jobs`
--

CREATE TABLE `all_jobs` (
  `id` int(128) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `categories_id` int(128) NOT NULL,
  `Description` text NOT NULL,
  `salary` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_jobs`
--

INSERT INTO `all_jobs` (`id`, `title`, `company`, `categories_id`, `Description`, `salary`) VALUES
(1, 'Software Developer Need', 'It', 1, 'One of the uprising software firms is Dream71 Bangladesh Ltd. Their main goal is to develop mobile application,Software development and game development. In a very short time they’ve been able to draw the attention of local market as well as international market too. Their innovative work with A2I, text book based scientific game development, is supposed to be a milestone in the education sector of Bangladesh. ', '1,00,000 BDT');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(128) NOT NULL,
  `type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `type`) VALUES
(1, 'Software'),
(2, 'Data science');

-- --------------------------------------------------------

--
-- Table structure for table `portal_users`
--

CREATE TABLE `portal_users` (
  `id` int(128) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` int(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portal_users`
--

INSERT INTO `portal_users` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'Sushmita Bhowmik', 0, '$2y$10$A7/EGRRvFJ8vY5xQekX4Y.h6nyBXqR5paPnMZc.hnX.olV7ioKs.6'),
(3, 'Mirra Alfassa', 0, '$2y$10$44ce4SPeoTHr7EiBQqArB.8G1gioJJYzuDPoJsV/UpJQs4mEnVha.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_jobs`
--
ALTER TABLE `all_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portal_users`
--
ALTER TABLE `portal_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `all_jobs`
--
ALTER TABLE `all_jobs`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `portal_users`
--
ALTER TABLE `portal_users`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
