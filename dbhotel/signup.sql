-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2022 at 08:20 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `signup`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `F_id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `images` text NOT NULL,
  `options` varchar(10) NOT NULL DEFAULT 'ENABLE',
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`F_id`, `name`, `price`, `description`, `images`, `options`, `deleted`) VALUES
(58, 'Masala Paneer Kathi Roll', 100, 'Yammi Masala Paneer Kathi Roll loaded with Masala Paneer chunks, onion & Mayo.', 's', 'ENABLE', 1),
(59, 'Grilled Fish', 90, 'A whole Pomfret fish grilled with tangy marination & served with grilled onions and tomatoes.', '0', 'DISABLE', 1),
(60, 'Chocolate Hazelnut Truffle', 199, 'This very delicious chocolate hazelnut truffle.', '0', 'ENABLE', 0),
(61, 'Choco Chip Shake', 97, 'Choco Chip Shake - a perfect party sweet treat.', 'f', 'ENABLE', 1),
(62, 'Spring Rolls', 55, 'Delicious Spring Rolls', 'images/Baahubali_Thali.jpg', 'ENABLE', 1),
(63, 'Deluxe Thali', 77, 'Deluxe Thali is accompanied by Kattapa Biriyani, Devasena Paratha, Bhalladeva Patiala Lassi', 'B', 'ENABLE', 1),
(65, 'Coffee', 35, 'concentrated coffee made by forcing pressurized water through finely ground coffee beans.', 'images/coffee.jpg', 'ENABLE', 0),
(66, 'Tea', 66, 'The simple elixir of tea is of our natural world.', 't', 'ENABLE', 1),
(68, 'Paneer', 33, 'it\'s masal paneer for you.', 'images/Spring_Rolls.jpg', 'ENABLE', 0),
(69, 'Coffee', 88, 'concentrated coffee made by forcing pressurized water through finely ground coffee beans.', 'c', 'ENABLE', 1),
(70, 'Tea', 33, 'The simple elixir of tea is of our natural world.', 'images/Masala_Paneer_Kathi_Roll.jpg', 'ENABLE', 0),
(71, 'Samosa', 55, 'Masala Samosa..', 'p', 'ENABLE', 1),
(72, 'Paneer Pakora', 44, 'Tasty paneer pakora', 'images/tea.jpg', 'ENABLE', 0),
(73, 'Puff', 33, 'Vegetable Puff, a snack with crisp-n-flaky outer layer and mixed vegetables stuffing', 'p', 'ENABLE', 1),
(74, 'Pizza', 123, 'Good and Tasty Pizza', 'images/frenchfries.jpg', 'ENABLE', 1),
(75, 'French Fries', 220, 'Pure Veg and Tasty.', 'f', 'ENABLE', 1),
(76, 'Pakora', 213, 'Pure Vegetable and Tasty.', 'images/Pizza.jpg', 'ENABLE', 0),
(77, 'Pizza', 450, 'Pure Vegetable and Tasty.', 's', 'ENABLE', 1),
(78, 'French Fries', 150, 'Pure Veg and Tasty.', 'images/puff.jpg', 'ENABLE', 0),
(79, 'Pakora', 350, 'TASTY', 'P', 'ENABLE', 1),
(80, 'dsdddd', 2200000, '', '�', 'ENABLE', 1),
(81, 'cccccccccccccccc', 5555555, 'sss', 'images/Pakora.jpg', 'ENABLE', 0),
(82, 'sacxacascasscasc', 2147483647, '', '�', 'ENABLE', 1),
(83, 'aaaaaaaaaaaaaaaa', 6478888, 'ddddddddddddddddd', 'images/special-menu-1.jpg', 'ENABLE', 0),
(84, 'newitem', 250, 'descudvcvsudcuds', 'images/gallery_01.jpg', 'ENABLE', 1),
(85, 'rggrgr', 2332, 'fweff', 'images/special-menu-1.jpg', 'ENABLE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usersignup`
--

CREATE TABLE `usersignup` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usersignup`
--

INSERT INTO `usersignup` (`id`, `email`, `password`, `username`) VALUES
(1, 'ss@ss.com', 'ss', 'ss'),
(2, 'dkhankriyal100@gmail.com', 'dd', 'dd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`F_id`);

--
-- Indexes for table `usersignup`
--
ALTER TABLE `usersignup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `F_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `usersignup`
--
ALTER TABLE `usersignup`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
