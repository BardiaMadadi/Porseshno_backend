-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2021 at 09:59 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `porsno`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers_history_54`
--

CREATE TABLE `answers_history_54` (
  `questionId` varchar(30) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `answers_history_54`
--

INSERT INTO `answers_history_54` (`questionId`) VALUES
('68'),
('68'),
('68'),
('68');

-- --------------------------------------------------------

--
-- Table structure for table `answer_68`
--

CREATE TABLE `answer_68` (
  `userId` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `username` varchar(30) COLLATE utf8_persian_ci DEFAULT NULL,
  `date` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `Answer` longtext COLLATE utf8_persian_ci DEFAULT NULL,
  `Comment` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answer_69`
--

CREATE TABLE `answer_69` (
  `userId` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `username` varchar(30) COLLATE utf8_persian_ci DEFAULT NULL,
  `date` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `Answer` longtext COLLATE utf8_persian_ci DEFAULT NULL,
  `Comment` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answer_70`
--

CREATE TABLE `answer_70` (
  `userId` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `username` varchar(30) COLLATE utf8_persian_ci DEFAULT NULL,
  `date` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `Answer` longtext COLLATE utf8_persian_ci DEFAULT NULL,
  `Comment` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applog`
--

CREATE TABLE `applog` (
  `phoneNumber` varchar(12) COLLATE utf8_persian_ci DEFAULT NULL,
  `Log` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `location` varchar(30) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `status` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `userId` int(11) NOT NULL,
  `order_id` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `porsnoTrackId` char(8) COLLATE utf8_persian_ci NOT NULL,
  `amount` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `name` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8_persian_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `card_no` char(18) COLLATE utf8_persian_ci NOT NULL,
  `paymentTrackId` int(11) NOT NULL,
  `normalTrackId` int(11) NOT NULL,
  `id` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `buyedAccount` varchar(20) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `accountLevel` varchar(15) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `cost` varchar(20) COLLATE utf8mb4_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`accountLevel`, `cost`) VALUES
('bronze', '60000'),
('steel', '90000'),
('gold', '100000'),
('diamond', '120000');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `questionId` int(11) NOT NULL,
  `icon` longtext COLLATE utf8mb4_persian_ci NOT NULL,
  `questionName` varchar(20) COLLATE utf8mb4_persian_ci NOT NULL,
  `start` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `end` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `userId` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_persian_ci NOT NULL,
  `cat` varchar(1) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `views` varchar(10) COLLATE utf8mb4_persian_ci NOT NULL,
  `answers` varchar(20) COLLATE utf8mb4_persian_ci NOT NULL,
  `question` mediumtext COLLATE utf8mb4_persian_ci NOT NULL,
  `like` varchar(255) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `dislike` varchar(11) COLLATE utf8mb4_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionId`, `icon`, `questionName`, `start`, `end`, `userId`, `description`, `cat`, `views`, `answers`, `question`, `like`, `dislike`) VALUES
(68, '-', 'ÙÙ„Ø¨Ø¨Ù„Ø§Ø§', '1630390447', '1630649648', '54', 'bardia', '-', '11', '0', '[{\"answers\":[{\"answer\":\"ØªØª\"},{\"answer\":\"ØªØª\"}],\"question\":\"Ø°Ø§Øª\",\"test\":true},{\"answers\":[{\"answer\":\"ØªØª\"},{\"answer\":\"Øª\"},{\"answer\":\"Ø¯Ø¯Ø¯\"}],\"question\":\"Ø°Ø§\",\"test\":true},{\"answers\":[{\"answer\":\"Ø§Ø¹Ø§Ø¹Ø§\"},{\"answer\":\"Ø§Ù‡Ø°Ø¹Ø±ÙØ²\"}],\"question\":\"Ø±Ø±Ø¹Ù„Ø¹\",\"test\":true},{\"answers\":[{\"answer\":\"ØºØ±Ø§Ø±Ù†Ø¯\"},{\"answer\":\"Ø°Ø§Ø²Ù‚Ø²ÙØ°Ø¹\"},{\"answer\":\"ØºØ±ÙØ¹ØªÙ‡\"}],\"question\":\"Ù‡Ø§Ø²Ø®Ø§Ø²Ù‡\",\"test\":true},{\"answers\":[{\"answer\":\"Ø§Ø¹Ø±ÙØ²ØºØ°Ù†\"},{\"answer\":\"Ø°ØºØ²Ù‚Ø²Ø¯Ù…\"}],\"question\":\"Ø°Ø¹Ø±ÙØ²ØºØ±Ù†Ø°\",\"test\":true}]', '0', '0'),
(69, '-', 'ØªØ¨Ù†Ø¨Ø¯', '1630649709', '1631168112', '54', 'ØªØ²ØªØªÙ‚ØªØ¨', '-', '4', '0', '[{\"answers\":[{\"answer\":\"ØªØ¨ØªØ¨ØªØªØ²Øª\"},{\"answer\":\"Ù¾Ø¨ØªØ¨ØªØ±\"},{\"answer\":\"Ø¯Ø¨ØªØ¨ØªØ¨Øª\"}],\"question\":\"ØªØºÛŒÛŒØ± ÛŒØ§ÙØªÙ‡ Û±\",\"test\":true},{\"answers\":[{\"answer\":\"Ù†Ø¨ØªØ¨ØªØªØ²Øª\"},{\"answer\":\"ØªØ¨ØªØ¨ØªØªØªØ²\"},{\"answer\":\"Ù†Ø¨Ù†Ù†Ø¨ØªØªØ¨\"}],\"question\":\"Ø¯Ú˜ØªØ¨ØªØªØ²ØªØ¨\",\"test\":true},{\"answers\":[{\"answer\":\"Ù†ÛŒÙ†Ø¨ØªØ¨ØªØªØ¨\"},{\"answer\":\"Ù†Ø¨Ù†Ø±Ù†Ù†Ø±Ø±\"},{\"answer\":\"Ù¾Ø²ØªØ²ØªØ¨ØªÙ†Ú˜ØªÚ˜\"}],\"question\":\"Ù‚Ù†Ø¨Ù†Ù†Ø²ØªØ²\",\"test\":true},{\"answers\":[{\"answer\":\"Ù†Ø¨Ù†Ø¨Ù†Ø¨\"},{\"answer\":\"Ù†Ø²ØªØ¨ØªØªÚ˜ØªØªØ¨\"}],\"question\":\"Ù‡ÛŒØªØ²ØªØ±ØªØªØ±\",\"test\":true}]', '0', '0'),
(70, '-', 'Ø§ØºØ§', '1630391415', '1630477816', '54', 'Ø°\nØ§Ø¨', '-', '2', '0', '[{\"answers\":[{\"answer\":\"ØºÙ„\"},{\"answer\":\"ÙÙ\"}],\"question\":\"Ø§Ø§\",\"test\":true}]', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `phoneNumber` varchar(12) COLLATE utf8mb4_persian_ci NOT NULL,
  `pwd` varchar(80) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `birthday` varchar(50) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `accountLevel` varchar(10) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `questionRemaining` int(11) NOT NULL,
  `created` varchar(50) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `end` varchar(50) COLLATE utf8mb4_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `phoneNumber`, `pwd`, `birthday`, `accountLevel`, `questionRemaining`, `created`, `end`) VALUES
(54, 'Ù…Ø­Ù…Ø¯', '09388209270', '98c6066648278b85f4f9c6dbcdb568b9', '1630395168000', 'bronze', 95, '1630389946', '1632981946');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
