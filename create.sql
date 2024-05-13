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

-- Table creation for 'customer'
CREATE TABLE IF NOT EXISTS `customer` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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

-- Trigger creation for 'calculate_total'
DELIMITER $$
CREATE TRIGGER `calculate_total` BEFORE INSERT ON `cart` FOR EACH ROW BEGIN
    DECLARE product_price DECIMAL(10, 2);
    SELECT price INTO product_price FROM product WHERE id = NEW.product_id;
    SET NEW.total = NEW.quantity * product_price;
END$$
DELIMITER ;

-- View creation for 'best_product'
CREATE VIEW `best_product` AS 
SELECT `c`.`product_id` AS `product_id`, 
       `p`.`name` AS `product_name`, 
       SUM(`c`.`quantity`) AS `total_quantity` 
FROM (`cart` `c` 
      JOIN `product` `p` 
      ON (`c`.`product_id` = `p`.`id`)) 
WHERE `c`.`status` = 'purchased' 
GROUP BY `c`.`product_id`, `p`.`name` 
ORDER BY SUM(`c`.`quantity`) DESC;
