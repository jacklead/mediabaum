/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.41-0ubuntu0.14.10.1 : Database - crestadistica
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

/*Table structure for table `keys` */

DROP TABLE IF EXISTS `keys`;

CREATE TABLE `keys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `fecha_insercion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `keys` */

insert  into `keys`(`id`,`hash`,`email`,`fecha_insercion`) values (8,'4N12crO8HDcY','imagenialidad@gmail.com','2015-04-12 01:15:12');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `roles` */

insert  into `roles`(`id`,`nombre`) values (0,'estudiante'),(1,'admin'),(2,'tester');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  `apellido` varchar(32) NOT NULL,
  `dni` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `fecha_nacimiento` varchar(32) NOT NULL,
  `ciudad_nacimiento` varchar(100) NOT NULL,
  `edad` varchar(6) NOT NULL,
  `genero` varchar(32) NOT NULL,
  `carrera` varchar(100) NOT NULL,
  `recursa` smallint(1) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` smallint(1) NOT NULL,
  `rol` int(11) NOT NULL,
  `fecha_ingreso` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`nombre`,`apellido`,`dni`,`email`,`fecha_nacimiento`,`ciudad_nacimiento`,`edad`,`genero`,`carrera`,`recursa`,`password`,`status`,`rol`,`fecha_ingreso`,`fecha_actualizacion`) values (12,'Jhonattan','campo','94519471','imagenialidad@gmail.com','23-02-2012','Cali','23','mujer','2',1,'2e76c16384e5c5ebc811f6b674ea17ee',1,0,NULL,NULL),(15,'Ahora soy el admin','Soy el Admin','123456','admin2@crestadisticas.com','00-00-0000','0000','0','0','0',0,'e10adc3949ba59abbe56e057f20f883e',1,1,'0000-00-00 00:00:00','2015-04-11 17:28:29'),(18,'juan','pedro','94519477','iuum@fmil.com','19-02-2012','cali','23','hombre','1',1,'63930de56f5e959b0be6b1716ed354cb',0,0,'0000-00-00 00:00:00',NULL),(20,'Fulano','de tal','99999','imag90ww9e@gmail.com','12-02-2012','cali','23','mujer','2',1,'053b59593e0545f7ff2b34ddcbffdd06',1,0,'2015-04-06 01:08:40',NULL),(22,'Sultanito','Perez','12345678','ims@gmail.com','06-02-2012','cali','23','hombre','1',1,'e10adc3949ba59abbe56e057f20f883e',0,0,'2015-04-11 01:21:49',NULL);

/*Table structure for table `usuarios_roles` */

DROP TABLE IF EXISTS `usuarios_roles`;

CREATE TABLE `usuarios_roles` (
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`,`rol_id`),
  KEY `FK_usuarios_roles_roles_id` (`rol_id`),
  CONSTRAINT `FK_usuarios_roles_roles_id` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_usuarios_roles_usuarios_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `usuarios_roles` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
