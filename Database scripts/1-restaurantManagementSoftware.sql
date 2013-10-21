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

-- ---------------------------------------------------------------------------
-- Drop tables
-- ---------------------------------------------------------------------------
DROP TABLE IF EXISTS `supplier`;

-- ---------------------------------------------------------------------------
-- Table supplier
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` INT(11) NOT NULL AUTO_INCREMENT,
  `contact_name` VARCHAR(100) NOT NULL,
  `phone_number` INT(11) NOT NULL,
  `fax_number` INT(11),
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
