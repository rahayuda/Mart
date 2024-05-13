-- Database creation
CREATE DATABASE IF NOT EXISTS `mart`;

-- Table creation for 'product'
CREATE TABLE IF NOT EXISTS `product` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) DEFAULT NULL,
  `category` VARCHAR(255) DEFAULT NULL,
  `stock` INT(10) UNSIGNED NOT NULL,
  `price` DECIMAL(10,2) DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- Table creation for 'customer'
CREATE TABLE IF NOT EXISTS `customer` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- Table creation for 'cart'
CREATE TABLE IF NOT EXISTS `cart` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `product_id` INT(11) DEFAULT NULL,
  `quantity` INT(11) DEFAULT NULL,
  `total` DECIMAL(10,2) DEFAULT NULL,
  `status` ENUM('purchased','pending') NOT NULL DEFAULT 'pending',
  `id_customer` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `FK_id_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
);

-- Table creation for 'sales'
CREATE TABLE IF NOT EXISTS `sales` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_cart` INT(11) DEFAULT NULL,
  `timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_cart` (`id_cart`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`id_cart`) REFERENCES `cart` (`id`)
);

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
