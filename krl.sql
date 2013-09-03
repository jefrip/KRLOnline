/*
SQLyog Ultimate v9.63 
MySQL - 5.5.30-log : Database - krl
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`krl` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `krl`;

/*Table structure for table `stasiun` */

DROP TABLE IF EXISTS `stasiun`;

CREATE TABLE `stasiun` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(5) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `stasiun` */

insert  into `stasiun`(`id`,`kode`,`nama`) values (1,'jak','jakartakota'),(2,'boo','bogor'),(3,'bks','bekasi'),(4,'kpb','kampungbandan'),(5,'dp','depok'),(6,'mri','manggarai'),(7,'srp','serpong'),(8,'thb','tanahabang'),(9,'prp','parungpanjang'),(10,'jng','jatinegara'),(11,NULL,'manggabesar'),(12,NULL,'lentengahung'),(13,NULL,'durenkalibata'),(14,NULL,'cawang'),(15,NULL,'jayakarta'),(16,NULL,'cikini'),(17,NULL,'pasarminggu'),(18,'ui','universitasindonesia'),(19,'up','universitaspancasila'),(20,NULL,'cilebut'),(21,NULL,'tebet'),(22,NULL,'tanjungbarat'),(23,NULL,'pasarminggubaru'),(24,NULL,'juanda'),(25,NULL,'bojonggede'),(26,NULL,'sawahbesar'),(27,NULL,'depokbaru'),(28,NULL,'cakung'),(29,NULL,'pondokcina'),(30,NULL,'klenderbaru');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
