CREATE DATABASE  IF NOT EXISTS `equipos_informaticos` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `equipos_informaticos`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: equipos_informaticos
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `historial_asignacion`
--

DROP TABLE IF EXISTS `historial_asignacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_asignacion` (
  `id_historial` int(11) NOT NULL AUTO_INCREMENT,
  `id_detalle_asignacion` int(11) DEFAULT NULL,
  `idsedes` int(11) DEFAULT NULL,
  `idoficinas` int(11) DEFAULT NULL,
  `idequipos` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idempleado` int(11) DEFAULT NULL,
  `cod_patrimonial` text DEFAULT NULL,
  `vida_util` text DEFAULT NULL,
  `estado` text DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  `accion` varchar(20) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_historial`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_asignacion`
--

LOCK TABLES `historial_asignacion` WRITE;
/*!40000 ALTER TABLE `historial_asignacion` DISABLE KEYS */;
INSERT INTO `historial_asignacion` VALUES (1,8340,1,2,1,1,10,'123434523535','asdasd','INOPERATIVO','2024-05-19','INSERT','2024-05-19 17:44:46'),(2,8319,2,31,3,1,13,'asfasdfasdf','fasdfsad','eliminado','2024-05-17','DELETE','2024-05-19 18:10:13'),(3,8326,2,27,3,1,1,'20202','2020','eliminado','0000-00-00','DELETE','2024-05-19 18:10:16'),(4,8327,2,28,3,1,10,'asd','2020','eliminado','0000-00-00','DELETE','2024-05-19 18:10:27'),(5,8328,2,29,2,1,12,'asda','sadas','eliminado','2024-05-18','DELETE','2024-05-19 18:10:33'),(6,8329,1,3,1,1,5,'123123','1231','eliminado','2024-05-18','DELETE','2024-05-19 18:10:36'),(7,8331,1,5,2,1,6,'asdas','sadsad','eliminado','2024-05-15','DELETE','2024-05-19 18:10:38'),(8,8330,1,5,3,1,5,'asdsa','asdsa','eliminado','2024-05-14','DELETE','2024-05-19 18:11:11'),(9,8332,2,27,1,1,5,'asdfsd','sdfasdf','eliminado','2024-05-18','DELETE','2024-05-19 18:11:15'),(10,8333,1,6,3,1,5,'sdfsad','asdfsad','eliminado','2024-05-17','DELETE','2024-05-19 18:11:19'),(11,8334,2,26,2,1,7,'asdasd','asdasd','eliminado','2024-05-06','DELETE','2024-05-19 18:11:23'),(12,8335,3,75,1,1,4,'asd','asdsa','eliminado','2024-05-03','DELETE','2024-05-19 18:11:26'),(13,8336,2,26,2,1,3,'asdasd','adsad','eliminado','2024-05-17','DELETE','2024-05-19 18:15:58'),(14,8337,1,3,1,1,4,'asdasd','asdsa','eliminado','2024-05-25','DELETE','2024-05-19 18:16:01'),(15,8339,2,24,4,1,4,'asdfsad','fasdf','eliminado','2024-05-18','DELETE','2024-05-19 18:16:04'),(16,8340,1,2,1,1,10,'123434523535','asdasd','eliminado','2024-05-19','DELETE','2024-05-19 18:19:41'),(17,8341,1,4,2,1,3,'asdsad','sadsa','OPERATIVO','2024-05-20','INSERT','2024-05-19 18:19:55'),(18,8342,2,23,2,1,6,'asdasd','asdsad','INOPERATIVO','2024-05-19','INSERT','2024-05-19 18:20:50'),(19,8343,3,75,2,1,4,'234243','24234','INOPERATIVO','2024-05-23','INSERT','2024-05-19 18:24:10'),(20,8343,3,75,2,1,4,'234243','24234','eliminado','2024-05-23','DELETE','2024-05-19 18:24:14'),(21,8341,1,4,2,1,3,'asdsad','sadsa','eliminado','2024-05-20','DELETE','2024-05-19 18:24:21'),(22,8342,2,23,2,1,6,'asdasd','asdsad','eliminado','2024-05-19','DELETE','2024-05-19 18:39:24'),(23,8338,1,7,2,1,3,'asfsda','asfads','eliminado','2024-05-17','DELETE','2024-05-19 18:40:54'),(24,8344,1,4,2,1,5,'asd','121','INOPERATIVO','2024-05-16','INSERT','2024-05-19 18:41:56'),(25,8345,1,3,4,1,8,'asd','asdasd','INOPERATIVO','2024-05-13','INSERT','2024-05-19 23:31:31'),(26,8346,2,30,3,1,11,'202120214xa','3 años','INOPERATIVO','2024-05-19','INSERT','2024-05-20 00:15:36'),(27,8347,2,27,5,1,6,'30201020','20 AÑOS','INOPERATIVO','2024-05-19','INSERT','2024-05-20 00:29:14'),(28,8347,2,27,5,1,6,'30201020','20 AÑOS','eliminado','2024-05-19','DELETE','2024-05-20 00:29:28'),(29,8346,2,30,3,1,11,'202120214xa','3 años','actualizado','2024-05-19','UPDATE','2024-05-20 02:05:45'),(30,8346,2,30,3,2,11,'202120214xa','3','actualizado','2024-05-18','UPDATE','2024-05-20 02:06:20'),(31,8346,3,75,3,2,18,'202120214xa','2','actualizado','2024-05-18','UPDATE','2024-05-20 02:10:01'),(32,8346,2,22,3,2,52,'202120214xa','2','actualizado','2024-05-18','UPDATE','2024-05-20 02:12:34'),(33,8346,3,77,3,2,33,'202120214xa','2','actualizado','2024-05-07','UPDATE','2024-05-20 02:17:12'),(34,8346,3,77,3,2,33,'202120214xa','2','actualizado','2024-05-07','UPDATE','2024-05-20 02:17:20'),(35,8346,3,77,3,2,33,'202120214xa','2','actualizado','2024-05-14','UPDATE','2024-05-20 02:17:51'),(36,8346,3,77,3,2,33,'202120214xa','2','actualizado','2024-05-14','UPDATE','2024-05-20 02:18:27'),(37,8346,3,77,3,2,33,'202120214xa','2','actualizado','2024-05-14','UPDATE','2024-05-20 02:18:46'),(38,8346,3,77,3,2,33,'202120214xa','2','actualizado','2024-05-14','UPDATE','2024-05-20 02:22:07'),(39,8345,1,3,4,1,8,'asd','asdasd','actualizado','2024-05-13','UPDATE','2024-05-20 02:36:19'),(40,8344,1,4,2,1,5,'asd','121','actualizado','2024-05-16','UPDATE','2024-05-20 02:40:32'),(41,8345,1,3,4,2,8,'asd','0','actualizado','2024-05-13','UPDATE','2024-05-20 03:22:51'),(42,8344,2,27,2,2,7,'asd','20','actualizado','2024-05-19','UPDATE','2024-05-20 03:23:25'),(43,8345,1,3,4,2,8,'asd','0','actualizado','2024-05-13','UPDATE','2024-05-20 03:24:36'),(44,8345,1,3,4,2,8,'asd','0','actualizado','2024-05-13','UPDATE','2024-05-20 03:25:15'),(45,8345,1,3,4,2,8,'asd','0','actualizado','2024-05-13','UPDATE','2024-05-20 03:25:19'),(46,8344,2,27,2,2,7,'asd','20','actualizado','2024-05-19','UPDATE','2024-05-20 03:27:07'),(47,8348,2,22,4,2,31,'2020202020xd','3 años','OPERATIVO','2024-05-19','INSERT','2024-05-20 03:39:14'),(48,8344,2,27,2,2,7,'asd','20','eliminado','2024-05-19','DELETE','2024-05-20 03:39:50'),(49,8345,1,3,4,2,8,'asd','0','eliminado','2024-05-13','DELETE','2024-05-20 03:39:57'),(50,8349,1,6,6,2,8,'3303030303xd','4 años','OPERATIVO','2024-05-19','INSERT','2024-05-20 03:41:56'),(51,8346,3,77,3,2,33,'202120214xa','2','actualizado','2024-05-14','UPDATE','2024-05-20 03:44:01'),(52,8349,1,6,6,2,8,'3303030303xd','4 años','eliminado','2024-05-19','DELETE','2024-05-20 03:47:13');
/*!40000 ALTER TABLE `historial_asignacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-20  1:51:23
