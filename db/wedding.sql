-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2022 at 08:51 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wedding`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `pnumber` int(10) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `fname`, `lname`, `pnumber`, `created_on`) VALUES
(1, 'raphtildai', 'raphaeltildai6@gmail.com', '$2y$10$USuosc4tlfrheGOR5m/TneZcIgXeWlxMKtU2IB9F2WAoNVfzQtAqK', 'Raph', 'Tildai', 725341547, '2022-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `population` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `budget` int(11) NOT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `booking_description` varchar(250) NOT NULL,
  `date_booked` date NOT NULL,
  `location_of_event` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `approval_comment` varchar(255) DEFAULT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `population`, `customer_id`, `event_id`, `budget`, `discount`, `booking_description`, `date_booked`, `location_of_event`, `status`, `approval_comment`, `payment_status`, `date_created`) VALUES
(1, 100, 2, 1, 50000, 1000, 'We intend to have the event colorful and successful', '2022-09-02', '', 0, 'comment', 0, '2022-09-23 21:08:58'),
(2, 200, 3, 2, 30000, 50000, 'I need a perfect event', '2022-09-25', 'Sinonin', 1, 'This is Great', 0, '2022-09-24 09:23:17'),
(3, 200, 3, 3, 10000, 0, 'We would like to have you as our photographers that day and possibly live stream the event.', '2022-09-27', 'Wundanyi', 0, NULL, 0, '2022-09-25 12:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `event_description` varchar(200) NOT NULL,
  `cost` double DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_description`, `cost`, `date_added`) VALUES
(1, 'Catering', 'Perfectly done module', 15000.5, '2022-09-23 13:44:57'),
(21, 'Wedding Cake', 'Perfect cakes for perfect people', NULL, '2022-09-28 20:20:49'),
(22, 'Gown Hiring', 'This is the best wedding planner to hire a wedding gown with', NULL, '2022-09-28 20:49:40'),
(18, 'Tents and decors', 'This service is generally about the decorations in your big day and the least number of people this tent can accommodate is 300 people', NULL, '2022-09-28 19:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

CREATE TABLE `event_categories` (
  `category_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_cost` double NOT NULL,
  `category_description` varchar(250) DEFAULT NULL,
  `max_number_of_people` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`category_id`, `event_id`, `category_name`, `category_cost`, `category_description`, `max_number_of_people`) VALUES
(5, 1, 'A', 35000, 'This is the price for people ranging between 300 and 500', '300 - 500'),
(6, 1, 'B', 30000, 'Amen my people', '150 - 300'),
(8, 1, 'C', 100000, 'This is the highest number of people we can accomodate', '500 - 1000'),
(10, 18, 'A', 35000, 'We offer a discount of free transportation', '300 - 500'),
(11, 21, 'A', 32500, 'Largest Cake', '300 - 500'),
(12, 21, 'C', 21500, 'Smallest cake', 'below 150'),
(13, 22, 'C', 25800, 'This is the least among what we have though', 'off shoulder');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT '0',
  `payment_comment` varchar(250) DEFAULT NULL,
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `booking_id`, `amount`, `payment_comment`, `date_paid`) VALUES
(1, 2, 1000, 'I will pay the rest soon', '2022-09-25 12:57:46'),
(2, 2, 1000, 'Additional amount', '2022-09-25 13:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `customer_id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pnumber` int(10) NOT NULL,
  `residence` text NOT NULL,
  `county` text NOT NULL,
  `password` varchar(60) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customer_id`, `fname`, `lname`, `username`, `email`, `pnumber`, `residence`, `county`, `password`, `date_registered`) VALUES
(3, 'Mary ', 'Mungali', 'mary', 'mary@gmail.com', 725341547, 'Kitui Central', 'Kitui', '$2y$10$BXXPy1lOJ99r6.kXHFv/bO6vX649BoNt6twG8ttf5vYH1m7uyfipa', '2022-09-23 11:53:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_categories`
--
ALTER TABLE `event_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
