-- Create tables for the shoe shop

-- Customers Table
CREATE TABLE `customers` (
  `customer_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `address` TEXT,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Categories Table
CREATE TABLE `categories` (
  `category_id` INT(11) NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(255) NOT NULL UNIQUE,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Products Table (Shoes)
CREATE TABLE `products` (
  `product_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `price` DECIMAL(10, 2) NOT NULL,
  `stock_quantity` INT(11) NOT NULL DEFAULT 0 CHECK (stock_quantity >= 0),
  `category_id` INT(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Orders Table
CREATE TABLE `orders` (
  `order_id` INT(11) NOT NULL AUTO_INCREMENT,
  `customer_id` INT(11) NOT NULL,
  `order_date` DATE NOT NULL,
  `total_amount` DECIMAL(10, 2) NOT NULL,
  `status` ENUM('Pending', 'Shipped', 'Delivered', 'Cancelled') DEFAULT 'Pending',
  PRIMARY KEY (`order_id`),
  FOREIGN KEY (`customer_id`) REFERENCES `customers`(`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Order Items Table
CREATE TABLE `order_items` (
  `order_item_id` INT(11) NOT NULL AUTO_INCREMENT,
  `order_id` INT(11) NOT NULL,
  `product_id` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (`order_item_id`),
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`),
  FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

