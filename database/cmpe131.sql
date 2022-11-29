-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 22, 2022 at 03:18 AM
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
  `cardCVV` smallint(4) DEFAULT NULL,
  `cart` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`fname`, `lastName`, `email`, `password`, `phonenumber`, `address`, `aptOrSuite`, `state`, `city`, `zipCode`, `nameOnCard`, `cardNum`, `cardExp`, `cardCVV`, `cart`) VALUES
('John', 'Doe', 'JohnDoe@gmail.com', 'Doe123', 1111111111, '200 California St.', 0, 'CA', 'San Francisco', 94134, 'John Doe', 1234567891234567, '11/22', 1111, '[]'),
('Jane', 'Doe', 'JaneDoe@gmail.com', 'JaneDoe123', 9999999999, '10 7th St.', 2, 'CA', 'San Jose', 99999, 'Jane Doe', 9999999999999999, '99/99', 9999, '[]');

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
('Raspberry', 9.28, 1, 'raspberry.png', 'fruit'),
('Blueberry', 6.24, 1, 'blueberry.png', 'fruit'),
('Avocado', 2, 1, 'avocado.png', 'fruit'),
('Corn', 0.89, 0.375, 'corn.png', 'vegetable'),
('Zucchini', 1, 0.5, 'zucchini.png', 'vegetable'),
('Banana', 0.89, 1, 'banana.png', 'fruit'),
('Watermelon', 5.79, 20, 'watermelon.png', 'fruit'),
('Apple', 1.50, 1, 'apple.png', 'fruit'),
('Strawberries', 4.99, 1, 'strawberry.png', 'fruit'),
('Grapes', 3.99, 1, 'grapes.png', 'fruit'),
('Pineapple', 2.99, 1, 'pineapple.png', 'fruit'),
('Broccoli', 2.99, 1, 'broccoli.png', 'vegetable'),
('Asparagus', 2.99, 1, 'asparagus.png', 'vegetable'),
('Cucumber', 1, 1, 'cucumber.png', 'vegetable'),
('Potatoes', 1.20, 1, 'potato.png', 'vegetable'),
('Onions', 1.33, 1, 'onion.png', 'vegetable'),
('Lettuce', 2.69, 1, 'lettuce.png', 'vegetable'),
('Tomato', 3.49, 1, 'tomato.png', 'vegetable'),
('Bell Pepper', 2.00, .5, 'bellpepper.png', 'vegetable'),
('Carrots', 1.29, 1, 'carrots.png', 'vegetable'),
('Whole Turkey', 39.38, 23, 'turkey.png', 'Meat'),
('Hot Dog', .34, .0625, 'hotdog.png', 'Meat'),
('New York Steak', 45.47, 3.5, 'steak.png', 'Meat'),
('Ground Beef', 20.97, 3.5, 'groundbeef.png', 'Meat'),
('Chicken Breast', 17.97, 3, 'chicken.png', 'Meat'),
('Milk', 5.99, 8.34, 'milk.png', 'Dairy'),
('Cheese', 13.99, 2, 'cheese.png', 'Dairy'),
('Eggs', 15.99, 1.5, 'eggs.png', 'Dairy'),
('12 Clams', 4.99, 3, 'clam.png', 'seafood'),
('Dungeness Crab', 24.99, 2, 'dungenesscrab.png', 'seafood'),
('King Crab', 99.99, 1, 'kingcrab.png', 'seafood'),
('Lobster', 62.99, 2, 'lobster.png', 'seafood'),
('Oyster', .75, .25, 'oyster.png', 'seafood'),
('Pound of Shrimp', 9.99, 1, 'shrimp.png', 'seafood'),
('seabass', 14.99, 2, 'seabass.png', 'seafood'),
('Scallop', 1.00, .35, 'scallop.png', 'seafood'),
('Butter', 5.99, 1, 'butter.png', 'Dairy');
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
