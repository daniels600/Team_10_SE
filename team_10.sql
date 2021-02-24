-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2021 at 09:45 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team_10`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `meal_name` varchar(30) NOT NULL,
  `meal_price` int(11) NOT NULL,
  `meal_image` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `restaurant_id`, `meal_name`, `meal_price`, `meal_image`) VALUES
(1, 1, 'Chicken Fingers', 28, NULL),
(2, 2, 'Chicken Satay', 40, NULL),
(3, 3, 'Beef Caramelized', 50, NULL),
(4, 4, 'Spring Rolls Fried', 30, NULL),
(5, 5, 'Sugarcane Juice', 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurant_id` int(11) NOT NULL,
  `restaurant_location` varchar(120) NOT NULL,
  `restaurant_name` varchar(60) NOT NULL,
  `restaurant_telephone` varchar(13) NOT NULL,
  `restaurant_opening_time` time DEFAULT NULL,
  `restauarant_closing_time` time DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`restaurant_id`, `restaurant_location`, `restaurant_name`, `restaurant_telephone`, `restaurant_opening_time`, `restauarant_closing_time`, `Email`, `Password`) VALUES
(1, '8th Junction, Adabraka', 'ChillsnBites', '0340543230', '08:00:00', '21:00:00', 'chillsnbites@gmail.co ', '12345678'),
(2, 'Accra Kasoa ', 'StarBites', '0340543230', '08:00:00', '21:00:00', 'starbites@gmail.com', '12345678'),
(3, '10 lane, Osu', 'Papaye', '0340543230', '08:00:00', '21:00:00', 'papaye@gmail.com', '12345678'),
(4, 'Kaneshie, Sanguine krave', 'Sanguine Krave', '0340543230', '08:00:00', '21:00:00', 'sangkrave@gmail.com', '12345678'),
(5, 'Alliance Francaise, Airport', 'Papa Cuisine', '0340543230', '08:00:00', '21:00:00', 'papacuisine@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_admin`
--

CREATE TABLE `restaurant_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant_admin`
--

INSERT INTO `restaurant_admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`) VALUES
(1, 'user@gmail.com', 'user123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Indexes for table `restaurant_admin`
--
ALTER TABLE `restaurant_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restaurant_admin`
--
ALTER TABLE `restaurant_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
