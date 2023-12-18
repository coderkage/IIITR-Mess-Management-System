-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 05:46 AM
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
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE `billings` (
  `billing_id` int(11) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `joining_date` date NOT NULL,
  `leaving_date` date NOT NULL,
  `total_days` int(10) NOT NULL,
  `total_amount` float NOT NULL,
  `pdf_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`billing_id`, `student_id`, `student_name`, `joining_date`, `leaving_date`, `total_days`, `total_amount`, `pdf_path`) VALUES
(10, '25', 'prayas', '2023-11-09', '2023-12-23', 44, 6600, ''),
(12, '25', 'prayas', '2023-11-03', '2023-12-10', 37, 5550, 'billing_25_20231129065810.pdf'),
(13, '25', 'prayas', '2023-11-23', '2023-12-10', 17, 2550, 'billing_25_20231129065810.pdf'),
(14, '25', 'prayas', '2023-11-15', '2023-12-10', 25, 3750, 'billing_25_20231129065810.pdf'),
(15, '25', 'prayas', '2023-11-19', '2023-12-03', 14, 2100, ''),
(16, '25', 'prayas', '2023-11-25', '2023-12-10', 15, 2250, ''),
(17, '25', 'prayas', '2023-11-11', '2023-12-10', 29, 4350, ''),
(18, '25', 'prayas', '2023-11-25', '2023-12-10', 15, 2250, ''),
(19, '25', 'prayas', '2023-11-01', '2024-06-29', 241, 36150, ''),
(20, '112', 'CS21B1001', '2023-11-01', '2023-11-30', 29, 4350, '');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `complaint` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `activity_status` varchar(20) NOT NULL,
  `complain_date` date NOT NULL DEFAULT current_timestamp(),
  `resolution_date` date NOT NULL DEFAULT current_timestamp(),
  `remark` varchar(255) NOT NULL,
  `important` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `user_id`, `complaint`, `image_path`, `activity_status`, `complain_date`, `resolution_date`, `remark`, `important`) VALUES
(11, '25', 'helo123', 'complaint_images/FAWtQltUUAErSbl.jpeg', 'closed', '2023-11-27', '2023-11-27', 'hehe', 0),
(15, '25', 'example', 'complaint_images/1148650.jpg', 'open', '2023-11-28', '2023-11-29', 'It will be removed from the menu', 1),
(16, '25', 'boorgir', 'complaint_images/sata andagi.jpg', 'closed', '2023-11-28', '2023-11-29', '', 1),
(21, '58', 'bleh', 'complaint_images/18e1699c66caa63571175b4f242efc49.jpg', 'closed', '2023-11-29', '2023-11-29', '', 0),
(22, '25', 'helo', 'complaint_images/food.jpg', 'open', '2023-11-30', '2023-11-30', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `meal_id` int(11) NOT NULL,
  `day` varchar(10) DEFAULT NULL,
  `meal_type` varchar(255) DEFAULT NULL,
  `meal_name` varchar(255) DEFAULT NULL,
  `avg_rating` decimal(3,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`meal_id`, `day`, `meal_type`, `meal_name`, `avg_rating`) VALUES
(1, 'Monday', 'Breakfast', 'Omelette', 0.00),
(2, 'Monday', 'Lunch', 'Spaghetti Bolognese', 0.00),
(3, 'Monday', 'Snacks', 'Fruit Salad', 0.00),
(4, 'Monday', 'Dinner', 'Grilled Chicken', 0.00),
(5, 'Tuesday', 'Breakfast', 'Pancakes', 0.00),
(6, 'Tuesday', 'Lunch', 'Chicken Caesar Salad', 0.00),
(7, 'Tuesday', 'Snacks', 'Yogurt with Berries', 0.00),
(8, 'Tuesday', 'Dinner', 'Vegetarian Stir-Fry', 0.00),
(9, 'Wednesday', 'Breakfast', 'Omelette', 1.00),
(10, 'Wednesday', 'Lunch', 'Spaghetti Bolognese', 2.50),
(11, 'Wednesday', 'Snacks', 'Fruit Salad', 3.00),
(12, 'Wednesday', 'Dinner', 'Grilled Chicken', 2.00),
(13, 'Thursday', 'Breakfast', 'Pancakes', 2.00),
(14, 'Thursday', 'Lunch', 'Chicken Caesar Salad', 2.67),
(15, 'Thursday', 'Snacks', 'Yogurt with Berries', 2.33),
(16, 'Thursday', 'Dinner', 'Vegetarian Stir-Fry', 2.67),
(17, 'Friday', 'Breakfast', 'Omelette', 0.00),
(18, 'Friday', 'Lunch', 'Spaghetti Bolognese', 0.00),
(19, 'Friday', 'Snacks', 'Fruit Salad', 0.00),
(20, 'Friday', 'Dinner', 'Grilled Chicken', 0.00),
(21, 'Saturday', 'Breakfast', 'Pancakes', 0.00),
(22, 'Saturday', 'Lunch', 'Chicken Caesar Salad', 0.00),
(23, 'Saturday', 'Snacks', 'Yogurt with Berries', 0.00),
(24, 'Saturday', 'Dinner', 'Vegetarian Stir-Fry', 0.00),
(25, 'Sunday', 'Breakfast', 'Omelette', 0.00),
(26, 'Sunday', 'Lunch', 'Spaghetti Bolognese', 0.00),
(27, 'Sunday', 'Snacks', 'Fruit Salad', 0.00),
(28, 'Sunday', 'Dinner', 'Grilled Chicken', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `poll_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`poll_id`, `question`) VALUES
(9, 'Wednesday Dinner Preference'),
(10, 'Sunday Dinner Preference'),
(11, 'Thursday Lunch Preference');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `meal_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `day` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `user_id`, `meal_id`, `rating`, `day`) VALUES
(1, 25, 1, 1, 'Monday'),
(2, 25, 2, 4, 'Monday'),
(3, 25, 3, 5, 'Monday'),
(4, 25, 4, 3, 'Monday'),
(9, 25, 9, 1, 'Wednesday'),
(10, 25, 10, 1, 'Wednesday'),
(11, 25, 11, 1, 'Wednesday'),
(12, 25, 12, 1, 'Wednesday'),
(44, 112, 13, 2, 'Thursday'),
(45, 112, 14, 1, 'Thursday'),
(46, 112, 15, 5, 'Thursday'),
(47, 112, 16, 1, 'Thursday'),
(48, 25, 13, 2, 'Thursday'),
(49, 25, 14, 3, 'Thursday'),
(50, 25, 15, 1, 'Thursday'),
(51, 25, 16, 4, 'Thursday'),
(52, 113, 13, 2, 'Thursday'),
(53, 113, 14, 4, 'Thursday'),
(54, 113, 15, 1, 'Thursday'),
(55, 113, 16, 3, 'Thursday');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `password`, `role`) VALUES
(1, 'deep', 'Deep Patel', 'd', 'secretary'),
(4, 'admin', 'Admin', 'a', 'admin'),
(25, 'prayas', 'Prayas Raj', 'a', 'student'),
(53, 'alka03', 'Dr. Alka Chaddha', 'a', 'warden'),
(55, 'gopal', 'Mr. Gopal', 'a', 'caterer'),
(112, 'CS21B1001', 'aditya raj', 'a', 'student'),
(113, 'CS21B1002', 'anubhav singh', 'a', 'student'),
(114, 'CS21B1003', 'ashutosh shukla', 'a', 'student'),
(115, 'CS21B1004', 'ayush rathore', 'a', 'student'),
(116, 'CS21B1005', 'b. s. dhawal', 'a', 'student'),
(119, 'cat123', 'gopal', 'a', 'caterer'),
(120, 'ad123', 'Mr. Balachandru', 'a', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `votes_9`
--

CREATE TABLE `votes_9` (
  `vote_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `preference` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes_9`
--

INSERT INTO `votes_9` (`vote_id`, `user_id`, `preference`) VALUES
(1, NULL, 'veg');

-- --------------------------------------------------------

--
-- Table structure for table `votes_10`
--

CREATE TABLE `votes_10` (
  `vote_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `preference` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes_10`
--

INSERT INTO `votes_10` (`vote_id`, `user_id`, `preference`) VALUES
(1, NULL, 'non-veg');

-- --------------------------------------------------------

--
-- Table structure for table `votes_11`
--

CREATE TABLE `votes_11` (
  `vote_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `preference` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes_11`
--

INSERT INTO `votes_11` (`vote_id`, `user_id`, `preference`) VALUES
(1, NULL, 'veg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billings`
--
ALTER TABLE `billings`
  ADD PRIMARY KEY (`billing_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`meal_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`poll_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `ratings_ibfk_1` (`user_id`),
  ADD KEY `ratings_ibfk_2` (`meal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `votes_9`
--
ALTER TABLE `votes_9`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indexes for table `votes_10`
--
ALTER TABLE `votes_10`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indexes for table `votes_11`
--
ALTER TABLE `votes_11`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billings`
--
ALTER TABLE `billings`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `votes_9`
--
ALTER TABLE `votes_9`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `votes_10`
--
ALTER TABLE `votes_10`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `votes_11`
--
ALTER TABLE `votes_11`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`meal_id`) REFERENCES `menu` (`meal_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
