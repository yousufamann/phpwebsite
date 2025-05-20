-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 10:43 AM
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
-- Database: `blogwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `leftdescription` varchar(100) NOT NULL,
  `rightdescription` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `leftimage` varchar(100) NOT NULL,
  `rightimage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `description`, `leftdescription`, `rightdescription`, `image`, `leftimage`, `rightimage`) VALUES
(4, 'BlueSky is the best wesbite', 'BlueSky description in the world', 'best the world', 'd25f73e1-b9cd-4579-95a6-73b630bc6174_cd440cc6-64fc-4576-b6f7-6ea166062af2_brithday.jpg.PNG', '521fabaf-489d-4d10-978c-cff4b37d36a8_bf1dc6a5-28ae-47c5-aae4-effdd4d4d605_download.jpg', 'd25f73e1-b9cd-4579-95a6-73b630bc6174_cd440cc6-64fc-4576-b6f7-6ea166062af2_brithday.jpg.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `carousel-data`
--

CREATE TABLE `carousel-data` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel-data`
--

INSERT INTO `carousel-data` (`id`, `name`, `description`, `image`) VALUES
(10, 'BlueSky is the blog website in the world', 'BlueSky Website', 'bnner1.jpg'),
(11, 'BlueSky Is The Best Website', 'BlueSky Website', 'bnner3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `catname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `catname`) VALUES
(7, 'Vedios'),
(8, 'Gaming'),
(9, 'news'),
(10, 'live stream'),
(11, 'Food');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `postid` int(11) DEFAULT NULL,
  `comment_content` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `userid`, `postid`, `comment_content`) VALUES
(1, 0, 0, 'gddgd'),
(2, 0, 0, 'dedfd'),
(3, 0, 0, 'dvggg'),
(4, 6, 15, 'dgdg'),
(5, 6, 15, 'nicee website'),
(6, 6, 15, 'hy'),
(7, 6, 15, 'hy'),
(8, 6, 15, 'hy'),
(9, 6, 15, 'gggggggg'),
(10, 6, 15, '6f6f'),
(11, 6, 15, 'ygghy'),
(12, 6, 15, 'hy'),
(13, 6, 13, 'hy'),
(14, 6, 13, 'hy'),
(15, 4, 13, 'nicee'),
(16, 48, 10, 'he kiya hai '),
(17, 52, 17, 'taste '),
(18, 52, 63, 'heloo');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`) VALUES
(11, 'Fareed', 'Fareed@gmail.com', 'today is the best website'),
(12, 'Arif', 'Arif@gmail.com', 'hii'),
(13, 'yousufaman', 'Fareed@gmail.com', 'hhh'),
(14, 'Fareed', 'Fareed@gmail.com', 'hii');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`) VALUES
(11, 'Home'),
(12, 'About'),
(13, 'Categories'),
(14, 'Feedback');

-- --------------------------------------------------------

--
-- Table structure for table `post1`
--

CREATE TABLE `post1` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post1`
--

INSERT INTO `post1` (`id`, `name`, `description`, `category`, `image`) VALUES
(63, 'today latest news', 'india vs pakistan', 'live stream', 'war.jpg'),
(64, 'burger', 'burger', 'food', 'food.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(21) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `role`, `status`) VALUES
(51, 'Yousuf', 'Yousuf@gmail.com', '111', '521fabaf-489d-4d10-978c-cff4b37d36a8_bf1dc6a5-28ae-47c5-aae4-effdd4d4d605_download.jpg', 'User', 'Active'),
(52, 'Fareed', 'Fareed@gmail.com', '111', 'download.jpg', 'Admin', 'InActive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel-data`
--
ALTER TABLE `carousel-data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post1`
--
ALTER TABLE `post1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carousel-data`
--
ALTER TABLE `carousel-data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `post1`
--
ALTER TABLE `post1`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
