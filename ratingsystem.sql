-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 12:09 AM
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
-- Database: `ratingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `dish_id` int(11) NOT NULL,
  `resto_id` int(11) NOT NULL,
  `dish_name` varchar(45) NOT NULL,
  `dish_price` int(11) NOT NULL,
  `dish_category` enum('side','main','dish','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dish_review`
--

CREATE TABLE `dish_review` (
  `dish_review_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dish_overall_rating` int(11) NOT NULL,
  `dish_quality_raiting` int(11) NOT NULL,
  `dish_price_rating` int(11) NOT NULL,
  `dish_review_text` int(11) NOT NULL,
  `dish_time_of_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resto`
--

CREATE TABLE `resto` (
  `resto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resto_name` varchar(45) NOT NULL,
  `resto_description` varchar(45) NOT NULL,
  `resto_email` varchar(45) NOT NULL,
  `resto_websitelink` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resto_review`
--

CREATE TABLE `resto_review` (
  `resto_review_id` int(11) NOT NULL,
  `review_overall_rating` enum('excellent','good','average','fair','poor') NOT NULL,
  `resto_review_text` varchar(45) NOT NULL,
  `resto_review_date` int(11) NOT NULL,
  `resto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `middle_initial` varchar(1) NOT NULL,
  `gender` enum('male','female','non-binary','unknown') NOT NULL,
  `birthday` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `registration_date` date NOT NULL,
  `last_login` date NOT NULL,
  `profile_name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `account_type` enum('business','regular','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`dish_id`),
  ADD KEY `resto_id` (`resto_id`);

--
-- Indexes for table `dish_review`
--
ALTER TABLE `dish_review`
  ADD PRIMARY KEY (`dish_review_id`),
  ADD KEY `user_id_dish` (`user_id`),
  ADD KEY `dish_id_review` (`dish_id`);

--
-- Indexes for table `resto`
--
ALTER TABLE `resto`
  ADD PRIMARY KEY (`resto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resto_review`
--
ALTER TABLE `resto_review`
  ADD PRIMARY KEY (`resto_review_id`),
  ADD KEY `user_id_rr` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `dish_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dish_review`
--
ALTER TABLE `dish_review`
  MODIFY `dish_review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resto`
--
ALTER TABLE `resto`
  MODIFY `resto_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resto_review`
--
ALTER TABLE `resto_review`
  MODIFY `resto_review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dish`
--
ALTER TABLE `dish`
  ADD CONSTRAINT `resto_id` FOREIGN KEY (`resto_id`) REFERENCES `resto` (`resto_id`);

--
-- Constraints for table `dish_review`
--
ALTER TABLE `dish_review`
  ADD CONSTRAINT `dish_id_review` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`dish_id`),
  ADD CONSTRAINT `user_id_dish` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `resto`
--
ALTER TABLE `resto`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `resto_review`
--
ALTER TABLE `resto_review`
  ADD CONSTRAINT `user_id_rr` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
