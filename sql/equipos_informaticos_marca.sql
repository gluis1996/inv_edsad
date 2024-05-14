CREATE DATABASE  IF NOT EXISTS `equipos_informaticos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `equipos_informaticos`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: equipos_informaticos
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text DEFAULT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'HP'),(2,'LENOVO'),(3,'PANASONIC'),(4,'GENIUS'),(5,'KYOCERA'),(6,'EPSON'),(7,'ON LINE DATA'),(8,'DELL'),(9,'MICROSOFT'),(10,'FORZA'),(11,'CREATIVE'),(12,'JBL'),(13,'SEAGATE'),(14,'LOGITECH'),(15,'PHILIPS'),(16,'SAMSUNG'),(17,'ZTE'),(18,'SONY'),(19,'LG'),(20,'HP '),(21,'VIEW SONIC'),(22,'APC'),(23,'ZEBRA'),(24,'POS-D'),(25,'OBSBOT'),(26,'WESTER DIGITAL'),(27,'TECLADO'),(28,'BUFFALO'),(29,'CPD'),(30,'BROTHER'),(31,'TP-LINK'),(32,'SHARP'),(33,'DALUX'),(34,'HIK-VISION'),(35,'CANON'),(36,'CISCO'),(37,'UBIQUITI'),(38,'SIN MARCA'),(39,'QNAP'),(40,'HIKVISION'),(41,'ZKT-ECO'),(42,'ADVANCE'),(43,'ELECTRONICA E& F'),(44,'KONICA MINOLTA'),(45,'JUMPER TECH'),(46,'OPTICAL'),(47,'AMS'),(48,'GRANDSTREAM'),(49,'VIEW SONY'),(50,'OKI'),(51,'GODEX'),(52,'SCAN SNAP'),(53,'TOSHIBA'),(54,'MASSIVE'),(55,'KYOSERA'),(56,'APLE'),(57,'APPLE'),(58,'IPHONE '),(59,'THERMOTALKE'),(60,'CDP'),(61,'ZKTECO'),(62,'ANTRYX'),(63,'SAMSUNG '),(64,'DELL '),(65,'TP LINK'),(66,'CYBERCOL'),(67,'LUXURY'),(68,'S/M'),(69,'MSK-1113'),(70,'TASCAN'),(71,'BENQ'),(72,'GIGABYTE'),(73,'D-LINK'),(74,'MICRONICS');
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-14 17:22:04
