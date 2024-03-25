-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 03:25 AM
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
CREATE DATABASE IF NOT EXISTS ratingsystem;
USE ratingsystem;
CREATE TABLE `dish` (
  `dish_id` int(11) NOT NULL,
  `resto_id` int(11) NOT NULL,
  `dish_name` varchar(45) NOT NULL,
  `dish_price` int(11) NOT NULL,
  `dish_category` enum('side','main','dish','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`dish_id`, `resto_id`, `dish_name`, `dish_price`, `dish_category`) VALUES
(5, 5, 'Adobo', 200000, ''),
(6, 5, 'Sinigang', 100, 'main'),
(7, 5, 'Adobo', 100, 'side'),
(8, 5, 'Sinigang', 100, 'main'),
(9, 5, 'Adobo', 100, 'side');

-- --------------------------------------------------------

--
-- Table structure for table `dish_review`
--

CREATE TABLE `dish_review` (
  `dish_review_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dish_overall_rating` int(11) NOT NULL,
  `dish_quality_rating` int(11) NOT NULL,
  `dish_price_rating` int(11) NOT NULL,
  `dish_review_text` varchar(100) NOT NULL,
  `dish_time_of_upload` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dish_review`
--

INSERT INTO `dish_review` (`dish_review_id`, `dish_id`, `user_id`, `dish_overall_rating`, `dish_quality_rating`, `dish_price_rating`, `dish_review_text`, `dish_time_of_upload`) VALUES
(4, 6, 1, 1, 1, 1, 'This is a poor dish', '2024-02-23 10:07:25'),
(5, 6, 1, 5, 5, 5, 'This is a good NO dish', '2024-02-23 10:12:26'),
(6, 6, 1, 5, 5, 5, 'ThisDSA is a good  123dish', '2024-02-23 10:12:26'),
(7, 6, 1, 5, 5, 5, 'ThisDSA is a good 12333 dish', '2024-02-23 10:12:26');

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

--
-- Dumping data for table `resto`
--

INSERT INTO `resto` (`resto_id`, `user_id`, `resto_name`, `resto_description`, `resto_email`, `resto_websitelink`) VALUES
(5, 1, 'jimbaptist2', 'FREEgoodtaste2', 'jim@.com2', 'www.freegoodtaste.com2'),
(6, 1, 'Ajimbaptist', 'FREEgoodtaste', 'jim@.com', 'www.freegoodtaste.com'),
(7, 1, 'Bjimbaptist', 'FREEgoodtaste', 'jim@.com', 'www.freegoodtaste.com'),
(8, 1, 'Cjimbaptist', 'FREEgoodtaste', 'jim@.com', 'www.freegoodtaste.com');

-- --------------------------------------------------------

--
-- Table structure for table `resto_review`
--

CREATE TABLE `resto_review` (
  `resto_review_id` int(11) NOT NULL,
  `resto_review_overall_rating` enum('excellent','good','average','fair','poor') NOT NULL,
  `resto_review_text` varchar(45) NOT NULL,
  `resto_review_date` datetime NOT NULL,
  `resto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resto_review`
--

INSERT INTO `resto_review` (`resto_review_id`, `resto_review_overall_rating`, `resto_review_text`, `resto_review_date`, `resto_id`, `user_id`) VALUES
(5, 'good', 'This is a good restaurant', '2024-02-23 09:02:57', 5, 1),
(6, 'good', 'This is a good restaurant', '2024-02-23 09:05:50', 5, 1),
(7, 'poor', 'This is a poor restaurant', '2024-02-23 09:07:36', 5, 1);

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
  `profile_name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `account_type` enum('business','regular','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`first_name`, `last_name`, `middle_initial`, `gender`, `birthday`, `user_id`, `email`, `username`, `password`, `registration_date`, `profile_name`, `description`, `account_type`) VALUES
('John', 'Bap', 'M', 'male', '2024-02-06', 1, 'john@email.com', 'johnusername', 'johnpassword', '2024-02-23', 'johnprofile', 'iamjohn', 'business');

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
  MODIFY `dish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dish_review`
--
ALTER TABLE `dish_review`
  MODIFY `dish_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resto`
--
ALTER TABLE `resto`
  MODIFY `resto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resto_review`
--
ALTER TABLE `resto_review`
  MODIFY `resto_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234567891;

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
