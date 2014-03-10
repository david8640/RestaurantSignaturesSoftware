  SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=1;
  SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=1;
  SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
  SET TIME_ZONE = "+00:00";

  /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
  /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
  /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
  /*!40101 SET NAMES utf8 */;

  -- ---------------------------------------------------------------------------
  -- Creation database
  -- ---------------------------------------------------------------------------
  DROP DATABASE IF EXISTS `restaurantManagementSoftware`;
  CREATE DATABASE IF NOT EXISTS `restaurantManagementSoftware`;
  USE `restaurantManagementSoftware`;

  DELIMITER GO

  ALTER DATABASE  `restaurantManagementSoftware` DEFAULT CHARACTER SET latin2 COLLATE latin2_general_ci;
  GO 

  -- ---------------------------------------------------------------------------
  -- Drop tables
  -- ---------------------------------------------------------------------------
  DROP TABLE IF EXISTS `PO_item`
  GO
  DROP TABLE IF EXISTS `purchase_orders`
  GO
  DROP TABLE IF EXISTS `order_list`
  GO
  DROP TABLE IF EXISTS `supplier_product`
  GO
  DROP TABLE IF EXISTS `inventory_item`
  GO
  DROP TABLE IF EXISTS `supplier`
  GO
  -- DROP TABLE IF EXISTS `product_category`;
  GO
  DROP TABLE IF EXISTS `users_restaurants`
  GO
  DROP TABLE IF EXISTS `login_attempts`
  GO
  DROP TABLE IF EXISTS `users`
  GO
  DROP TABLE IF EXISTS `inventory`
  GO
  DROP TABLE IF EXISTS `restaurant`
  GO
  DROP TABLE IF EXISTS `product`
  GO
  
  -- ---------------------------------------------------------------------------
  -- Table supplier
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `supplier` (
    `id_supplier` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `contact_name` VARCHAR(100) NOT NULL,
    `phone_number` VARCHAR(14) NOT NULL,
    `fax_number` VARCHAR(14),
    PRIMARY KEY (`id_supplier`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=5;
  GO

  -- ---------------------------------------------------------------------------
  -- Table product_category
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `product_category` (
    `id_category` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `parent` INT(11), 
    `orderof` INT(11) NOT NULL,
    UNIQUE (`orderof`),
    PRIMARY KEY (`id_category`),
    CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `product_category` (`id_category`) ON DELETE SET NULL
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin2;
  GO

  -- ---------------------------------------------------------------------------
  -- Table restaurant
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `restaurant` (
    `id_restaurant` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `address` VARCHAR(250),
    PRIMARY KEY (`id_restaurant`)
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin2;
  GO

  -- ---------------------------------------------------------------------------
  -- Table users
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `users` (
    `id_user` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(30) NOT NULL UNIQUE,
    `name` VARCHAR(75) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `password` CHAR(128) NOT NULL,
    `salt` CHAR(128) NOT NULL,
    `session_id` CHAR(128),
    `session_expiry_time` INT(25),
    `location_selected` INT(11),
    PRIMARY KEY (`id_user`),
    CONSTRAINT `location_selected_users_ibfk_1` FOREIGN KEY (`location_selected`) REFERENCES `restaurant` (`id_restaurant`)
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin2;
  GO

  -- ---------------------------------------------------------------------------
  -- Table login_attempts
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `login_attempts` (
    `id_user` INT(11) NOT NULL,
    `time_of_attempt` VARCHAR(30) NOT NULL,
    `ip_address` VARCHAR(30) DEFAULT 'n/a',
    KEY `id_user` (`id_user`),
    CONSTRAINT `login_attempts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin2;
  GO

  -- ---------------------------------------------------------------------------
  -- Table users_restaurants
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `users_restaurants` (
    `id_restaurant` INT(11) NOT NULL,
    `id_user` INT(11) NOT NULL,
    PRIMARY KEY (`id_restaurant`, `id_user`),
    CONSTRAINT `users_restaurants_ibfk_1` FOREIGN KEY (`id_restaurant`) REFERENCES `restaurant` (`id_restaurant`),
    CONSTRAINT `users_restaurants_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin2;
  GO

  -- ---------------------------------------------------------------------------
  -- Table product
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `product` (
    `id_product` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(30) NOT NULL,
    `id_category` INT(11) NOT NULL,
    `unitOfMeasurement` VARCHAR(30) NOT NULL,
   PRIMARY KEY (`id_product`),
   CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `product_category` (`id_category`)
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin2;
  GO
  
  -- ---------------------------------------------------------------------------
  -- Table supplier_product
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `supplier_product` (
    `id_product` INT(11) NOT NULL,
    `id_supplier` INT(11) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `unitOfMeasurement` VARCHAR(30) NOT NULL,
   PRIMARY KEY (`id_product`, `id_supplier`),
   CONSTRAINT `supplier_product_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`),
   CONSTRAINT `supplier_supplier_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`)
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin2;
  GO

  -- ---------------------------------------------------------------------------
  -- Table order_list
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `order_list` (
    `id_order` INT(11) NOT NULL AUTO_INCREMENT,
    `id_restaurant` INT(11) NOT NULL,
    `dateCreated` DATETIME NOT NULL,
    `subtotal` DECIMAL(10,2), -- sum of of subtotal of each PO
    `taxes` DECIMAL(10,2), -- sum of all taxes of each PO
    `totalCost` DECIMAL(10,2), -- sum of of total of each PO
    `shippingCost` DECIMAL(10,2), -- sum of of shipping of each PO
    `state` INT(3), -- 0: in progress, 1: submitted
   PRIMARY KEY (`id_order`),
   CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_restaurant`) REFERENCES `restaurant` (`id_restaurant`)
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin2;
  GO

  -- ---------------------------------------------------------------------------
  -- Table purchase_orders
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `purchase_orders` (
    `id_po` INT(11) NOT NULL AUTO_INCREMENT,
    `po_NumberSupplier` VARCHAR(20) UNIQUE,
    `id_order` INT(11) NOT NULL,
    `id_supplier` INT(11) NOT NULL,
    `dateOrdered` DATETIME NOT NULL,
    `dateDelivered` DATETIME NOT NULL,
    `subtotal` DECIMAL(10,2),
    `taxes` DECIMAL(10,2),
    `shippingCost` DECIMAL(10,2),
    `totalCost` DECIMAL(10,2),
    `state` INT(3), -- 0: in progress, 1: ordered, 2: shipped, 3:received
    PRIMARY KEY (`id_po`),
    CONSTRAINT `purchase_orders_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `order_list` (`id_order`) ON DELETE CASCADE,
    CONSTRAINT `purchase_orders_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`)
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin2;
  GO

  -- ---------------------------------------------------------------------------
  -- Table PO_item
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `PO_item` (
    `id_product` INT(11) NOT NULL,
    `id_po` INT(11) NOT NULL,
    `qty` INT(11) NOT NULL,
    `costPerUnit` DECIMAL(10,2) NOT NULL,
    `unitOfMeasurement` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`id_product`, `id_po`),
    CONSTRAINT `PO_item_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`),
    CONSTRAINT `PO_item_ibfk_2` FOREIGN KEY (`id_po`) REFERENCES `purchase_orders` (`id_po`) ON DELETE CASCADE
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin2;
  GO
  
  -- ---------------------------------------------------------------------------
  -- Table inventory
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `inventory` (
    `id_inventory` INT(11) NOT NULL AUTO_INCREMENT,
    `id_restaurant` INT(11) NOT NULL,
    PRIMARY KEY (`id_inventory`),
    UNIQUE(`id_restaurant`),
    CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`id_restaurant`) REFERENCES `restaurant` (`id_restaurant`)
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin2;
  GO
  
  -- ---------------------------------------------------------------------------
  -- Table inventory_item
  -- ---------------------------------------------------------------------------
  CREATE TABLE IF NOT EXISTS `inventory_item` (
  	`id_inventory_item` INT(11) NOT NULL AUTO_INCREMENT,
    `id_inventory` INT(11) NOT NULL,
    `id_product` INT(11) NOT NULL,
    `id_supplier` INT(11) NOT NULL,
    `qty` INT(11) NOT NULL,
    `costPerUnit` DECIMAL(10,2) NOT NULL,
    `unitOfMeasurement` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`id_inventory_item`),
    CONSTRAINT `inventory_item_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`),
    CONSTRAINT `inventory_item_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
    CONSTRAINT `inventory_item_ibfk_3` FOREIGN KEY (`id_inventory`) REFERENCES `inventory` (`id_inventory`)
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin2;
  GO
  
  DELIMITER ;

  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;