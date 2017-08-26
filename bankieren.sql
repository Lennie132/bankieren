-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 29, 2017 at 11:14 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankieren`
--
CREATE DATABASE IF NOT EXISTS `bankieren` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bankieren`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `amount` int(10) NOT NULL,
  `colour` varchar(30) NOT NULL,
  `goal_description` varchar(255) NOT NULL,
  `goal_amount` double NOT NULL,
  `goal_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `amount`, `colour`, `goal_description`, `goal_amount`, `goal_date`) VALUES
(1, 'Sport', 244, '#005bbb', 'Een nieuwe hockeystick kopen aan het begin van het nieuwe seizoen', 120.47, '2017-06-30'),
(2, 'Gadgets', 1600, '#ee7600', 'De nieuwe Macbook met TouchBar kopen', 1300.99, '2017-06-30'),
(3, 'Boodschappen', 100, '#fffc05', 'BBQ geven', 120, '2017-06-29'),
(4, 'Fiets', 124, '#0080ff', 'nieuwe auto', 1300.6, '2017-07-28'),
(5, 'Kleding', 61, '#800080', 'Een nieuwe broek', 120, '2017-06-30'),
(6, 'Vakantie', 500, '#ff6e7d', 'Naar Oslo', 159.49, '2017-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `combinations`
--

CREATE TABLE `combinations` (
  `id` int(10) NOT NULL,
  `store` varchar(40) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `combinations`
--

INSERT INTO `combinations` (`id`, `store`, `category_id`) VALUES
(1, 'Albert Heijn', 3),
(2, 'Albert Heijn', 3),
(3, 'Sting', 2),
(4, 'Albert Heijn', 3),
(5, 'Albert Heijn', 3),
(6, 'Albert Heijn', 1),
(7, 'Sting', 1),
(8, 'Albert Heijn', 1),
(9, 'Sting', 4),
(10, 'Vomar', 3),
(11, 'Kiosk', 3),
(12, 'Slager Klein', 3),
(13, 'Bakker Bart', 3),
(14, 'Lidl', 3),
(15, 'Albert Heijn', 3);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL DEFAULT '0',
  `amount` double NOT NULL,
  `store` varchar(40) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `category_id`, `amount`, `store`, `datetime`) VALUES
(1, 3, 13.4, 'Albert Heijn', '2017-06-14 08:26:00'),
(2, 3, 8.9, 'Sting', '2017-06-14 14:07:24'),
(3, 3, 7.2, 'Albert Heijn', '2017-06-13 09:35:10'),
(4, 4, 40, 'Sting', '2017-06-20 00:00:00'),
(5, 3, 22.9, 'Vomar', '2017-06-20 13:25:31'),
(6, 3, 3.5, 'Kiosk', '2017-06-20 15:15:29'),
(7, 3, 6.72, 'Slager Klein', '2017-06-20 15:15:56'),
(8, 3, 4.79, 'Bakker Bart', '2017-06-20 15:16:58'),
(9, 3, 12.49, 'Lidl', '2017-06-20 15:17:21'),
(10, 3, 3.8, 'Groenteboer Jan', '2017-06-20 15:17:55'),
(11, 3, 22, 'Albert Heijn', '2017-06-20 15:23:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `combinations`
--
ALTER TABLE `combinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `combinations`
--
ALTER TABLE `combinations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
