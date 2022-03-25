-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 10:14 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anjo-tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_signup_verification`
--

CREATE TABLE `account_signup_verification` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `verification_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_signup_verification`
--

INSERT INTO `account_signup_verification` (`id`, `user_email`, `verification_code`) VALUES
(1, 'jericovic65@gmail.com', 610858),
(2, 'jericovic72@gmail.com', 240743),
(3, 'jericovic625@gmail.com', 977351),
(4, 'jericovic65@gmail.comad', 278406),
(5, 'jericovic624@gmail.com', 635185),
(6, 'sadasdasd@gmail.com', 950729),
(7, 'jericovic65@gmail.comads', 257322),
(8, 'jericovic65@gmail.comasdasd', 227311),
(9, 'jericovic60@gmail.comasdas', 783274);

-- --------------------------------------------------------

--
-- Table structure for table `account_user`
--

CREATE TABLE `account_user` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` int(50) DEFAULT NULL,
  `email` varchar(65) DEFAULT NULL,
  `password` varchar(65) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_user`
--

INSERT INTO `account_user` (`id`, `unique_id`, `name`, `username`, `phone`, `email`, `password`, `avatar`, `date_of_birth`) VALUES
(1, 'u62370aed23d82', 'Jerico', NULL, NULL, 'jericovic64@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/AATXAJwQXb4BfNbg3tK7v1xeLfA1wAdsbhD_WQoMSnCt=s96-c', '0000-00-00'),
(2, 'u623c53866acfe', '', 'dormammu', NULL, 'jericovic65@gmail.com', NULL, '../assets/images/default-avatar.jpg', '0000-00-00'),
(3, 'u623c54a66d420', '', 'dormammu', NULL, 'jericovic72@gmail.com', NULL, '../assets/images/default-avatar.jpg', '0000-00-00'),
(4, 'u623c8c9f4e9e2', '', 'dormammu', NULL, 'jericovic65@gmail.comad', NULL, '../assets/images/default-avatar.jpg', '0000-00-00'),
(5, 'u623c914318ffa', '', 'dormammu', NULL, 'jericovic60@gmail.comasdas', NULL, '../assets/images/default-avatar.jpg', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` int(11) NOT NULL,
  `uniq_user_id` varchar(255) NOT NULL,
  `uniq_following_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `unique_message_id` varchar(255) NOT NULL,
  `incoming_message_id` varchar(255) NOT NULL,
  `outgoing_message_id` varchar(255) NOT NULL,
  `message_description` longtext DEFAULT NULL,
  `file` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `react`
--

CREATE TABLE `react` (
  `id` int(11) NOT NULL,
  `uniq_tweet_id` int(11) NOT NULL,
  `uniq_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retweet`
--

CREATE TABLE `retweet` (
  `id` int(11) NOT NULL,
  `uniq_tweet_id` int(11) NOT NULL,
  `uniq_retweet_id` int(11) NOT NULL,
  `retweet_Description` longtext DEFAULT NULL,
  `uniq_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tweet`
--

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL,
  `uniq_user_id` varchar(255) NOT NULL,
  `uniq_tweet_id` varchar(255) NOT NULL,
  `tweet_Description` longtext DEFAULT NULL,
  `media` varchar(255) DEFAULT NULL,
  `poll` varchar(255) DEFAULT NULL,
  `privacy` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tweet_reply`
--

CREATE TABLE `tweet_reply` (
  `id` int(11) NOT NULL,
  `uniq_tweet_id` int(11) NOT NULL,
  `comment_tweet_description` longtext NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `poll` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_signup_verification`
--
ALTER TABLE `account_signup_verification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `verification_code` (`verification_code`);

--
-- Indexes for table `account_user`
--
ALTER TABLE `account_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `react`
--
ALTER TABLE `react`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retweet`
--
ALTER TABLE `retweet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweet_reply`
--
ALTER TABLE `tweet_reply`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_signup_verification`
--
ALTER TABLE `account_signup_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `account_user`
--
ALTER TABLE `account_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `react`
--
ALTER TABLE `react`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retweet`
--
ALTER TABLE `retweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tweet_reply`
--
ALTER TABLE `tweet_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
