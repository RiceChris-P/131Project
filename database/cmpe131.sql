-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 09:29 PM
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
('Jane', 'Doe', 'JaneDoe@gmail.com', 'JaneDoe123', 9999999999, '10 7th St.', 2, 'CA', 'San Jose', 99999, 'Jane Doe', 9999999999999999, '99/99', 9999, '[]'),
('Test', 'Test', 'Test@Test.com', 'Test', 4151230987, 'Test', 0, 'CA', 'Test', 12345, 'Test', 123456789012345, '01/23', 123, '[{\"prod\":{\"Name\":\"Zucchini\",\"Price\":\"1\",\"Weight\":\"0.5\",\"Image\":\"zucchini.png\",\"Type\":\"vegetable\"},\"count\":1}]'),
('Test2', 'Test2', 'Test2@Test2.com', 'Test2', 4151230987, 'Test2', NULL, 'CA', 'Test2', 12345, NULL, NULL, NULL, NULL, '[]'),
('Test3', 'Test3', 'Test3@Test3.com', 'Test3', 4151230987, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Name` text DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `Weight` double DEFAULT NULL,
  `Image` varchar(255) NOT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Name`, `Price`, `Weight`, `Image`, `Type`, `Stock`) VALUES
('Raspberry', 9.28, 1, 'raspberry.png', 'fruit', 20),
('Blueberry', 6.24, 1, 'blueberry.png', 'fruit', 20),
('Avocado', 2, 1, 'avocado.png', 'fruit', 20),
('Corn', 0.89, 0.375, 'corn.png', 'vegetable', 20),
('Zucchini', 1, 0.5, 'zucchini.png', 'vegetable', 20),
('Banana', 0.89, 1, 'banana.png', 'fruit', 20),
('Watermelon', 5.79, 20, 'watermelon.png', 'fruit', 20),
('Apple', 1.5, 1, 'apple.png', 'fruit', 20),
('Strawberries', 4.99, 1, 'strawberry.png', 'fruit', 20),
('Grapes', 3.99, 1, 'grapes.png', 'fruit', 20),
('Pineapple', 2.99, 1, 'pineapple.png', 'fruit', 20),
('Broccoli', 2.99, 1, 'broccoli.png', 'vegetable', 20),
('Asparagus', 2.99, 1, 'asparagus.png', 'vegetable', 20),
('Cucumber', 1, 1, 'cucumber.png', 'vegetable', 20),
('Potatoes', 1.2, 1, 'potato.png', 'vegetable', 20),
('Onions', 1.33, 1, 'onion.png', 'vegetable', 20),
('Lettuce', 2.69, 1, 'lettuce.png', 'vegetable', 20),
('Tomato', 3.49, 1, 'tomato.png', 'vegetable', 20),
('Bell Pepper', 2, 0.5, 'bellpepper.png', 'vegetable', 20),
('Carrots', 1.29, 1, 'carrots.png', 'vegetable', 20),
('Whole Turkey', 39.38, 23, 'turkey.png', 'Meat', 20),
('Hot Dog', 0.34, 0.0625, 'hotdog.png', 'Meat', 20),
('New York Steak', 45.47, 3.5, 'steak.png', 'Meat', 20),
('Ground Beef', 20.97, 3.5, 'groundbeef.png', 'Meat', 20),
('Chicken Breast', 17.97, 3, 'chicken.png', 'Meat', 20),
('Milk', 5.99, 8.34, 'milk.png', 'Dairy', 20),
('Cheese', 13.99, 2, 'cheese.png', 'Dairy', 20),
('Eggs', 15.99, 1.5, 'eggs.png', 'Dairy', 20),
('Butter', 5.99, 1, 'butter.png', 'Dairy', 20);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ordernum` varchar(20) DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`items`)),
  `subtotal` double DEFAULT NULL,
  `totalweight` double DEFAULT NULL,
  `weightfee` double DEFAULT NULL,
  `totalcost` double DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactinfo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`contactinfo`)),
  `deliveryinfo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`deliveryinfo`)),
  `paymentinfo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`paymentinfo`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ordernum`, `items`, `subtotal`, `totalweight`, `weightfee`, `totalcost`, `email`, `contactinfo`, `deliveryinfo`, `paymentinfo`) VALUES
('90230224795437092165', '[{\"prod\":{\"Name\":\"Corn\",\"Price\":\"0.89\",\"Weight\":\"0.375\",\"Image\":\"corn.png\",\"Type\":\"vegetable\"},\"count\":1}]', 0.89, 0.375, 0, 0.89, 'Test@Test.com', '{\"firstName\":\"Test\",\"lastName\":\"Test\",\"email\":\"Test@Test@gmail.com\",\"phone\":\"4151230987\"}', '{\"address\":\"Test\",\"aptsuiteetc\":\"\",\"state\":\"CA\",\"city\":\"Test\",\"zip\":\"12345\"}', '{\"cardname\":\"Test\",\"cardnumber\":\"123456789012345\",\"cardexpdate\":\"01/23\",\"cardcvv\":\"123\"}');

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
