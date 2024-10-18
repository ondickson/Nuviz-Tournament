-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2024 at 09:56 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `football_league_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'owusudickson18@gmail.com', 'nuvizfootball'),
(3, 'admin1', 'admin@example.com', '1230');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image_path`, `description`, `uploaded_at`) VALUES
(3, 'uploads/gallery/2024_08_24_17_30_IMG_5815.JPG', '', '2024-08-24 17:08:33'),
(4, 'uploads/gallery/2024_08_24_17_30_IMG_5816.JPG', '', '2024-08-24 17:08:40'),
(5, 'uploads/gallery/2024_08_24_17_30_IMG_5817.JPG', '', '2024-08-24 17:08:40'),
(6, 'uploads/gallery/2024_08_24_17_30_IMG_5818.JPG', '', '2024-08-24 17:08:40'),
(7, 'uploads/gallery/2024_08_24_17_30_IMG_5819.JPG', '', '2024-08-24 17:08:40'),
(8, 'uploads/gallery/2024_08_24_17_30_IMG_5820.JPG', '', '2024-08-24 17:08:40'),
(9, 'uploads/gallery/2024_08_24_17_30_IMG_5821.JPG', '', '2024-08-24 17:08:40'),
(10, 'uploads/gallery/2024_08_24_17_30_IMG_5822.JPG', '', '2024-08-24 17:08:40'),
(11, 'uploads/gallery/2024_08_24_17_31_IMG_5823.JPG', '', '2024-08-24 17:09:25'),
(12, 'uploads/gallery/2024_08_24_17_31_IMG_5825.JPG', '', '2024-08-24 17:09:25'),
(13, 'uploads/gallery/2024_08_24_17_31_IMG_5826.JPG', '', '2024-08-24 17:09:25'),
(14, 'uploads/gallery/2024_08_24_17_31_IMG_5827.JPG', '', '2024-08-24 17:09:25'),
(15, 'uploads/gallery/2024_08_24_17_31_IMG_5828.JPG', '', '2024-08-24 17:09:25'),
(16, 'uploads/gallery/2024_08_24_17_31_IMG_5829.JPG', '', '2024-08-24 17:09:25'),
(17, 'uploads/gallery/2024_08_24_17_31_IMG_5830.JPG', '', '2024-08-24 17:09:25'),
(18, 'uploads/gallery/2024_08_24_17_33_IMG_5831.JPG', '', '2024-08-24 17:09:25'),
(19, 'uploads/gallery/2024_08_24_17_33_IMG_5832.JPG', '', '2024-08-24 17:09:25'),
(20, 'uploads/gallery/2024_08_24_17_34_IMG_5835.JPG', '', '2024-08-24 17:09:25'),
(21, 'uploads/gallery/2024_08_24_17_34_IMG_5836.JPG', '', '2024-08-24 17:09:25'),
(22, 'uploads/gallery/2024_08_24_17_34_IMG_5837.JPG', '', '2024-08-24 17:09:25'),
(23, 'uploads/gallery/2024_08_24_17_34_IMG_5838.JPG', '', '2024-08-24 17:09:25'),
(24, 'uploads/gallery/2024_08_24_17_34_IMG_5839.JPG', '', '2024-08-24 17:09:25'),
(25, 'uploads/gallery/2024_08_24_17_33_IMG_5831.JPG', '', '2024-08-24 17:09:36'),
(26, 'uploads/gallery/2024_08_24_17_33_IMG_5832.JPG', '', '2024-08-24 17:09:36'),
(27, 'uploads/gallery/2024_08_24_17_34_IMG_5835.JPG', '', '2024-08-24 17:09:36'),
(28, 'uploads/gallery/2024_08_24_17_34_IMG_5836.JPG', '', '2024-08-24 17:09:36'),
(29, 'uploads/gallery/2024_08_24_17_34_IMG_5837.JPG', '', '2024-08-24 17:09:36'),
(30, 'uploads/gallery/2024_08_24_17_34_IMG_5838.JPG', '', '2024-08-24 17:09:36'),
(31, 'uploads/gallery/2024_08_24_17_34_IMG_5839.JPG', '', '2024-08-24 17:09:36'),
(32, 'uploads/gallery/2024_08_24_17_34_IMG_5840.JPG', '', '2024-08-24 17:09:36'),
(33, 'uploads/gallery/2024_08_24_17_34_IMG_5841.JPG', '', '2024-08-24 17:09:36'),
(34, 'uploads/gallery/2024_08_24_17_34_IMG_5842.JPG', '', '2024-08-24 17:09:36'),
(35, 'uploads/gallery/2024_08_24_17_34_IMG_5843.JPG', '', '2024-08-24 17:09:36'),
(36, 'uploads/gallery/2024_08_24_17_34_IMG_5844.JPG', '', '2024-08-24 17:09:36'),
(37, 'uploads/gallery/2024_08_24_17_34_IMG_5845.JPG', '', '2024-08-24 17:09:36'),
(38, 'uploads/gallery/2024_08_24_17_34_IMG_5846.JPG', '', '2024-08-24 17:09:36'),
(49, 'uploads/gallery/2024_08_24_17_44_IMG_5874.JPG', '', '2024-08-24 17:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  `team1_goals` int(11) NOT NULL,
  `team2_goals` int(11) NOT NULL,
  `match_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `team1_id`, `team2_id`, `team1_goals`, `team2_goals`, `match_date`) VALUES
(1, 4, 3, 0, 2, '2024-08-17'),
(2, 5, 1, 0, 0, '2024-08-17'),
(3, 5, 6, 1, 2, '2024-08-24'),
(4, 1, 2, 0, 1, '2024-08-24'),
(5, 7, 5, 2, 0, '2024-08-24'),
(6, 6, 8, 2, 1, '2024-08-24'),
(7, 2, 8, 4, 0, '2024-08-24'),
(8, 1, 3, 1, 1, '2024-08-24'),
(9, 4, 7, 0, 0, '2024-08-24');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `wins` int(11) DEFAULT 0,
  `draws` int(11) DEFAULT 0,
  `losses` int(11) DEFAULT 0,
  `goals_for` int(11) DEFAULT 0,
  `goals_against` int(11) DEFAULT 0,
  `points` int(11) DEFAULT 0,
  `logo_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `logo`, `wins`, `draws`, `losses`, `goals_for`, `goals_against`, `points`, `logo_path`, `description`) VALUES
(1, 'Franks A ', 'images/Franks A.jpeg', 0, 2, 1, 1, 2, 2, NULL, NULL),
(2, 'Franks B', 'images/Franks B.jpeg', 2, 0, 0, 5, 0, 4, NULL, NULL),
(3, 'Nuviz Otits', 'images/NUVIZ OTITS.jpeg', 1, 1, 0, 3, 1, 3, NULL, NULL),
(4, 'Mix & Match', 'images/mix and match.jpeg', 0, 1, 1, 0, 2, 1, NULL, NULL),
(5, 'NVG', 'images/NVG.jpeg', 0, 1, 2, 1, 4, 1, NULL, NULL),
(6, 'Bagabag A', 'images/BAGABAG A.jpeg', 2, 0, 0, 4, 2, 4, NULL, NULL),
(7, 'Bagabag B', 'images/BAGABAG B.jpeg', 1, 1, 0, 2, 0, 3, NULL, NULL),
(8, 'Bagabag C', 'images/BAGABAG C.jpeg', 0, 0, 2, 1, 6, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team1_id` (`team1_id`),
  ADD KEY `team2_id` (`team2_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`team1_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`team2_id`) REFERENCES `teams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
