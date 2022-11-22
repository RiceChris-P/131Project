-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 05:44 AM
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
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `loginStatus` tinyint(1) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`email`, `password`, `fname`, `loginStatus`,`admin`) VALUES
('test@', 'password', 'test', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Name` text DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `Weight` double DEFAULT NULL,
  `Image` varchar(255) NOT NULL,
  `stock` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Name`, `Price`, `Weight`, `Image`,`stock`) VALUES
('Raspberry', 4.99, 0.375, 'raspberry.png', 25),
('Blueberry', 4.99, 0.375, 'blueberry.png',30),
('Avocado', 2.5, 0.375, 'avocado.png',40),
('Corn', 0.89, 0.375, 'corn.png', 5),
('Zucchini', 1, 0.5, 'zucchini.png', 30),
('Banana', 0.49, 0.5, 'banana.png', 2),
('Watermelon', 5.79, 20, 'watermelon.png',10);



CREATE TABLE `cart` (
     `Name` text DEFAULT NULL,
     `Price` double DEFAULT NULL,
     `Weight` double DEFAULT NULL,
     `Image` varchar(255) NOT NULL,
     `quantity` int DEFAULT NULL,
     `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cart` (`Name`,`Price`, `Weight`, `Image`, `quantity`, `email`) VALUES

('Banana', 0.49, 0.5, 'banana.png', 2, 'test@'),
('Watermelon', 5.79, 20, 'watermelon.png',10, 'test@');
('Blueberry', 4.99, 0.375, 'blueberry.png',3,'test@'),
('Avocado', 2.5, 0.375, 'avocado.png',4, 'test@'),
('Corn', 0.89, 0.375, 'corn.png', 5, 'jmo@');



CREATE TABLE `orders` (
         `item` text DEFAULT NULL,
         `quantity` int DEFAULT NULL,
          `email` varchar(255) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
