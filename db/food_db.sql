-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2025 at 07:10 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `person` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `person`, `date`, `time`) VALUES
(2, '5 person', '2025-05-13', '14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(60, 2, 37, 'Strawberry Crunch Ice-Cream', 5, 1, 'Strawberry-Crunch-Ice-Cream.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `age` int DEFAULT NULL,
  `sex` varchar(15) DEFAULT NULL,
  `phone` int DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `age`, `sex`, `phone`, `email`, `address`, `password`) VALUES
(12, 'Tom', 25, 'Male', 966667788, 'staff.01@gmail.com', 'Phnom Penh', '$2y$10$GlXujrfGYygTHzLEKW6ZRuyPH3m3qvzyDl/vcQoLSQF'),
(13, 'dara', 25, 'Male', 966667777, 'staff.02@gmail.com', 'Phnom Penh', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(4, 2, 'ChhengHort', 'ceo.hort@gmail.com', '0966667777', 'good coffee.'),
(5, 2, 'ChhengHort', 'ceo.hort@gmail.com', '0972568888', 'Good Coffee'),
(6, 2, 'ChhengHort', 'ceo.hort@gmail.com', '0964445555', 'Nice Coffee');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(17, 2, 'ChhengHort ', '0966667777', 'ceo.hort@gmail.com', 'cash on delivery', '#196, 41, Phum13 Villages, Sangkat Tonle Bassac, Khan Chamkar Mon, Phnom Penh city, Cambodia - 123456', 'Espresso Con Panna (4 x 1) - ', 4, '2025-05-30 17:44:26', 'completed'),
(18, 2, 'ChhengHort ', '0966667777', 'ceo.hort@gmail.com', 'cash on delivery', '#196, 41, Phum13 Villages, Sangkat Tonle Bassac, Khan Chamkar Mon, Phnom Penh city, Cambodia - 123456', 'Mocha (5 x 1) - ', 5, '2025-05-30 17:49:17', 'completed'),
(19, 2, 'ChhengHort ', '0966667777', 'ceo.hort@gmail.com', 'credit_card', '#196, 41, Phum13 Villages, Sangkat Tonle Bassac, Khan Chamkar Mon, Phnom Penh city, Cambodia - 123456', 'Cortado (3 x 1) - Latte (3 x 2) - ', 9, '2025-05-31 10:20:45', 'completed'),
(20, 2, 'ChhengHort ', '0966667777', 'ceo.hort@gmail.com', 'cash on delivery', '#196, 41, Phum13 Villages, Sangkat Tonle Bassac, Khan Chamkar Mon, Phnom Penh city, Cambodia - 123456', 'Macchiato (5 x 1) - ', 5, '2025-06-01 11:56:27', 'completed'),
(21, 2, 'ChhengHort ', '0966667777', 'ceo.hort@gmail.com', 'cash on delivery', '#196, 41, Phum13 Villages, Sangkat Tonle Bassac, Khan Chamkar Mon, Phnom Penh city, Cambodia - 123456', 'Macchiato (5 x 3) - ', 15, '2025-06-01 16:34:04', 'completed'),
(23, 2, 'ChhengHort ', '0966667777', 'ceo.hort@gmail.com', 'cash on delivery', '#196, 41, Phum13 Villages, Sangkat Tonle Bassac, Khan Chamkar Mon, Phnom Penh city, Cambodia - 123456', 'Espresso Romano (6 x 1) - ', 6, '2025-06-01 16:37:55', 'pending'),
(24, 2, 'ChhengHort ', '0966667777', 'ceo.hort@gmail.com', 'cash on delivery', '#196, 41, Phum13 Villages, Sangkat Tonle Bassac, Khan Chamkar Mon, Phnom Penh city, Cambodia - 123456', 'Rocky Road Ice-Cream (3 x 1) - ', 3, '2025-06-01 16:38:12', 'pending'),
(25, 2, 'ChhengHort ', '0966667777', 'ceo.hort@gmail.com', 'cash on delivery', '#196, 41, Phum13 Villages, Sangkat Tonle Bassac, Khan Chamkar Mon, Phnom Penh city, Cambodia - 123456', 'Strawberry Crunch Ice-Cream (5 x 1) - ', 5, '2025-06-01 16:57:10', 'pending'),
(26, 2, 'ChhengHort ', '0966667777', 'ceo.hort@gmail.com', 'cash on delivery', '#196, 41, Phum13 Villages, Sangkat Tonle Bassac, Khan Chamkar Mon, Phnom Penh city, Cambodia - 123456', 'Ice-Cream Cookie (3 x 1) - ', 3, '2025-06-03 10:58:14', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) NOT NULL,
  `popularity` int DEFAULT NULL,
  `disprice` int DEFAULT NULL,
  `desc` varchar(1500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`, `popularity`, `disprice`, `desc`) VALUES
(11, 'Cappuccino', 'coffee', 5, 'cappuccino-1659544996.png', 10, NULL, NULL),
(12, 'Cortado', 'coffee', 3, 'cortado-1659544996.webp', NULL, NULL, NULL),
(13, 'Latte', 'coffee', 3, 'latte-1659544996.webp', NULL, NULL, NULL),
(14, 'Red Eye', 'coffee', 5, 'red-eye-1659544996.webp', NULL, NULL, NULL),
(15, 'Mocha', 'coffee', 5, 'mocha-1659544996.webp', NULL, NULL, NULL),
(17, 'Macchiato', 'coffee', 5, 'macchiato-1659544996.webp', 8, NULL, NULL),
(18, 'Cold Brew', 'coffee', 7, 'cold-brew-1659544996.webp', NULL, NULL, NULL),
(19, 'Espresso Con Panna', 'coffee', 4, 'espresso-con-panna-1659544996.webp', 5, NULL, NULL),
(20, 'Café Cubano', 'coffee', 3, 'cafe-cubano-1659544996.webp', NULL, NULL, NULL),
(21, 'Espresso Romano', 'coffee', 6, 'espresso-romano-1659544996.webp', NULL, NULL, NULL),
(22, 'Long Black', 'coffee', 6, 'long-black-1659544996.webp', 6, NULL, NULL),
(23, 'Caffè Breve', 'coffee', 5, 'caffe-breve-1659544996.webp', NULL, NULL, NULL),
(24, 'Affogato', 'coffee', 4, 'affogato-1659544996.webp', NULL, NULL, NULL),
(25, 'Quad shots', 'coffee', 3, 'quad-shots-1659544996.webp', NULL, NULL, NULL),
(26, 'Mexican coffee', 'coffee', 7, 'mexican-coffee-1659544996.webp', NULL, NULL, NULL),
(27, 'Baked lemon butter chicken', 'main dish', 7, 'baked-lemon-butter-chicken.jpg', NULL, NULL, NULL),
(28, 'Classic Meatballs', 'main dish', 8, 'Classic Meatballs.webp', NULL, NULL, NULL),
(29, 'Parmesan Crusted Mayo Chicken', 'main dish', 5, 'Parmesan Crusted Mayo Chicken.jpg', NULL, NULL, NULL),
(30, 'Burger', 'fast food', 3, 'burger.jpg', NULL, NULL, NULL),
(31, 'classic Cheese Pizza', 'fast food', 10, 'classic-cheese-pizza.jpg', NULL, NULL, NULL),
(32, 'Creme Croissant', 'fast food', 2, 'Creme Croissant.jpg', NULL, NULL, NULL),
(33, 'Horchata', 'drinks', 3, 'Horchata.jpg', NULL, NULL, NULL),
(34, 'Dark ‘n’ Stormy', 'drinks', 2, 'Dark ‘n’ Stormy.jpg', NULL, NULL, NULL),
(35, 'Agua Fresca', 'drinks', 2, 'Agua Fresca.jpg', NULL, NULL, NULL),
(36, 'Strawberry Gelato', 'desserts', 2, 'Strawberry-Gelato.jpg', NULL, NULL, NULL),
(37, 'Strawberry Crunch Ice-Cream', 'desserts', 5, 'Strawberry-Crunch-Ice-Cream.jpg', NULL, NULL, NULL),
(38, 'Ice-Cream Cookie', 'desserts', 3, 'Ice-Cream-Cookie.jpg', NULL, NULL, NULL),
(39, 'Tartufo Ice-Cream', 'desserts', 5, 'Tartufo-Ice-Cream.jpg', NULL, NULL, NULL),
(40, 'Avocado Ice Cream', 'desserts', 1, 'Avocado Ice Cream.jpg', NULL, NULL, NULL),
(41, 'Rocky Road Ice-Cream', 'desserts', 3, 'Rocky-Road-Ice-Cream.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `User_name` varchar(20) NOT NULL,
  `rating` int NOT NULL,
  `review` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(2, 'ChhengHort ', 'ceo.hort@gmail.com', '0966667777', '8cb2237d0679ca88db6464eac60da96345513964', '#196, 41, Phum13 Villages, Sangkat Tonle Bassac, Khan Chamkar Mon, Phnom Penh city, Cambodia - 123456'),
(8, 'ChhengHort Eang', 'chhenghort.eang7x@gmail.com', '0966667616', '$2y$10$KadgS6sTGzWNOv.fGFgtpOVb13X49c7f1EGGyxjiDJn', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
