-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2022 at 12:49 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmpe131`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `fname` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phonenumber` bigint(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `aptOrSuite` int(11) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zipCode` int(5) DEFAULT NULL,
  `nameOnCard` varchar(255) DEFAULT NULL,
  `cardNum` bigint(16) DEFAULT NULL,
  `cardExp` varchar(5) DEFAULT NULL,
  `cardCVV` smallint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`fname`, `lastName`, `email`, `password`, `phonenumber`, `address`, `aptOrSuite`, `state`, `city`, `zipCode`, `nameOnCard`, `cardNum`, `cardExp`, `cardCVV`) VALUES
('John', 'Doe', 'JohnDoe@gmail.com', 'Doe123', 1111111111, '200 California St.', 0, 'CA', 'San Francisco', 94134, 'John Doe', 1234567891234567, '11/22', 1111),
('Jane', 'Doe', 'JaneDoe@gmail.com', 'JaneDoe123', 9999999999, '10 7th St.', 2, 'CA', 'San Jose', 99999, 'Jane Doe', 9999999999999999, '99/99', 9999);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Name` text DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `Weight` double DEFAULT NULL,
  `Image` varchar(255) NOT NULL,
  `Type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Name`, `Price`, `Weight`, `Image`, `Type`) VALUES
('Raspberry', 4.99, 0.375, 'raspberry.png', 'fruit'),
('Blueberry', 4.99, 0.375, 'blueberry.png', 'fruit'),
('Avocado', 2.5, 0.375, 'avocado.png', 'fruit'),
('Corn', 0.89, 0.375, 'corn.png', 'fruit'),
('Zucchini', 1, 0.5, 'zucchini.png', 'fruit'),
('Banana', 0.49, 0.5, 'banana.png', 'fruit'),
('Watermelon', 5.79, 20, 'watermelon.png', 'fruit');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ordernum` varchar(20) DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`items`)),
  `costofitems` int(11) DEFAULT NULL,
  `totalweight` int(11) DEFAULT NULL,
  `weightfee` int(11) DEFAULT NULL,
  `totalcost` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactinfo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`contactinfo`)),
  `deliveryinfo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`deliveryinfo`)),
  `paymentinfo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`paymentinfo`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD UNIQUE KEY `phonenumber` (`phonenumber`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD UNIQUE KEY `ordernum` (`ordernum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
