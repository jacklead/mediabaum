/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.1.56-log : Database - crestadistica
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`crestadistica` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `crestadistica`;

/*Table structure for table `membership` */

DROP TABLE IF EXISTS `membership`;

CREATE TABLE `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `dni` varchar(32) DEFAULT NULL,
  `email_address` varchar(64) DEFAULT NULL,
  `birthday` varchar(32) DEFAULT NULL,
  `borncity` varchar(100) DEFAULT NULL,
  `age` varchar(6) DEFAULT NULL,
  `gender` varchar(32) DEFAULT NULL,
  `career` varchar(100) DEFAULT NULL,
  `repeater` smallint(1) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
