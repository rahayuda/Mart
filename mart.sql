-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 13, 2024 at 07:45 AM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mart`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `best_product`
-- (See below for the actual view)
--
CREATE TABLE `best_product` (
`product_id` int(11)
,`product_name` varchar(255)
,`total_quantity` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` enum('purchased','pending') NOT NULL DEFAULT 'pending',
  `id_customer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `cart`
--
DELIMITER $$
CREATE TRIGGER `calculate_total` BEFORE INSERT ON `cart` FOR EACH ROW BEGIN
    DECLARE product_price DECIMAL(10, 2);
    SELECT price INTO product_price FROM product WHERE id = NEW.product_id;
    SET NEW.total = NEW.quantity * product_price;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `category`, `stock`, `price`, `image`) VALUES
(1, 'Laptop', 'Electronics', 100, 5000000.00, 'image/product.png'),
(2, 'Pencil', 'Stationery', 100, 5000.00, 'image/product.png'),
(3, 'Mouse', 'Electronics', 100, 200000.00, 'image/product.png'),
(4, 'Book', 'Stationery', 100, 25000.00, 'image/product.png'),
(5, 'Soda', 'Beverage', 100, 15000.00, 'image/product.png'),
(6, 'Printer', 'Electronics', 100, 1000000.00, 'image/product.png'),
(7, 'Camera', 'Electronics', 100, 3000000.00, 'image/product.png'),
(8, 'Pen', 'Stationery', 100, 2000.00, 'image/product.png'),
(9, 'Speaker', 'Electronics', 100, 150000.00, 'image/product.png'),
(10, 'Notebook', 'Stationery', 100, 10000.00, 'image/product.png'),
(11, 'Water', 'Beverage', 100, 5000.00, 'image/product.png'),
(12, 'Phone', 'Electronics', 100, 2000000.00, 'image/product.png');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `id_cart` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure for view `best_product`
--
DROP TABLE IF EXISTS `best_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `best_product`  AS SELECT `c`.`product_id` AS `product_id`, `p`.`name` AS `product_name`, sum(`c`.`quantity`) AS `total_quantity` FROM (`cart` `c` join `product` `p` on(`c`.`product_id` = `p`.`id`)) WHERE `c`.`status` = 'purchased' GROUP BY `c`.`product_id`, `p`.`name` ORDER BY sum(`c`.`quantity`) DESC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `FK_id_customer` (`id_customer`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cart` (`id_cart`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_id_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`id_cart`) REFERENCES `cart` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
