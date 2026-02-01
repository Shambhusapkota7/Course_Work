-- phpMyAdmin SQL Dump
-- version 5.2.3-1.el10_2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 01, 2026 at 01:45 PM
-- Server version: 10.11.15-MariaDB
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `np02cs4a240060`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `registered_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`id`, `event_id`, `full_name`, `email`, `registered_at`) VALUES
(1, 1, 'Roman', 'np02cs4a240060@bicnepal.edu.np', '2026-02-01 09:31:25'),
(2, 1, 'Roman Poudel', 'shambhusapkota77@gmail.com', '2026-02-01 13:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(150) NOT NULL,
  `location` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `organizer` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `location`, `event_date`, `organizer`, `description`, `created_at`) VALUES
(1, 'Dance', 'China', '2026-02-02', 'Company', 'hello world', '2026-02-01 09:18:01'),
(3, 'Singing', 'Lalitpur', '2026-02-18', 'XYZ company', 'hgjfjygiuh', '2026-02-01 12:09:28'),
(4, 'Startup Meetup', 'Nepal', '2026-02-19', 'XYZ company', 'hey good', '2026-02-01 13:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(1, 'Hari', 'sapkotasambhu65@gmail.com', '$2y$10$yyJz33XcL3ZHUDYwC0ApW.hwWPhKYn59hewqT.Fe7xojHte56Fyam', '2026-02-01 09:10:08'),
(2, 'Roman Poudel', 'sapkotashambhu65@gmail.com', '$2y$10$ULRf2r2PkYxbc4dUWATp.OrPYNB4o.n6G6v/y9rGxqILe5Jkic4B6', '2026-02-01 09:16:40'),
(3, 'Shambhu Sapkota', 'sapkotashambhu326@gmail.com', '$2y$10$x/8ysqUyXyrXkBtGVT.7jOSLRuTiMW1c8O9n8h3W/svaT9Rb.VTE2', '2026-02-01 10:14:16'),
(4, 'Shambhu Sapkota', 'fclip0331@gmail.com', '$2y$10$j6ETjaonzo1IdAE4BkC2m.GCX8LrQgv.UOzspGXR1gDrV6oKXVOrG', '2026-02-01 11:10:13'),
(5, 'Roman Poudel', 'Roman@gmail.com', '$2y$10$xQta2oI8QzCb8DPfIDwzp.LSbWdi7cqL75R2KYs/KTtSgaCjI3iEW', '2026-02-01 11:10:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
