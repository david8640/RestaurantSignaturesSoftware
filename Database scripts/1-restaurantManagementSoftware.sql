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
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `login_attempts`;

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

-- ---------------------------------------------------------------------------
-- Table users
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(75) NOT NULL,
  `last_name` varchar(75) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ---------------------------------------------------------------------------
-- Table login_attempts
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id_user` int(11) NOT NULL,
  `timeOfAttempt` varchar(30) NOT NULL,
  `ip_address` varchar(30) DEFAULT 'n/a',
  KEY `id_user` (`id_user`),
  CONSTRAINT `login_attempts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
