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
-- Table structure for table `detalle_asignacion`
--

DROP TABLE IF EXISTS `detalle_asignacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_asignacion` (
  `id_detalle_asignacion` int(11) NOT NULL AUTO_INCREMENT,
  `idsedes` int(11) DEFAULT NULL,
  `idoficinas` int(11) DEFAULT NULL,
  `idequipos` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idempleado` int(11) DEFAULT NULL,
  `cod_patrimonial` text NOT NULL,
  `vida_util` text DEFAULT NULL,
  `estado` text DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  PRIMARY KEY (`id_detalle_asignacion`),
  UNIQUE KEY `idsedes` (`idsedes`,`idoficinas`,`idequipos`,`idusuario`,`idempleado`,`cod_patrimonial`(50)) USING BTREE,
  KEY `idoficinas` (`idoficinas`),
  KEY `idequipos` (`idequipos`),
  KEY `idusuario` (`idusuario`),
  KEY `idempleado` (`idempleado`),
  CONSTRAINT `detalle_asignacion_ibfk_1` FOREIGN KEY (`idsedes`) REFERENCES `sede` (`idsedes`),
  CONSTRAINT `detalle_asignacion_ibfk_2` FOREIGN KEY (`idoficinas`) REFERENCES `oficina` (`idoficinas`),
  CONSTRAINT `detalle_asignacion_ibfk_3` FOREIGN KEY (`idequipos`) REFERENCES `equipos` (`idequipos`),
  CONSTRAINT `detalle_asignacion_ibfk_4` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  CONSTRAINT `detalle_asignacion_ibfk_5` FOREIGN KEY (`idempleado`) REFERENCES `empleados` (`idempleado`)
) ENGINE=InnoDB AUTO_INCREMENT=8350 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_asignacion`
--

LOCK TABLES `detalle_asignacion` WRITE;
/*!40000 ALTER TABLE `detalle_asignacion` DISABLE KEYS */;
INSERT INTO `detalle_asignacion` VALUES (8346,2,22,3,2,15,'202120214xa','1','OPERATIVO','2024-05-19'),(8348,2,22,4,2,31,'2020202020xd','3 años','OPERATIVO','2024-05-19');
/*!40000 ALTER TABLE `detalle_asignacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_detalle_asignacion_insert
AFTER INSERT ON detalle_asignacion
FOR EACH ROW
BEGIN
    INSERT INTO historial_asignacion (id_detalle_asignacion, idsedes, idoficinas, idequipos, idusuario, idempleado, cod_patrimonial, vida_util, estado, fecha_asignacion, accion)
    VALUES (NEW.id_detalle_asignacion, NEW.idsedes, NEW.idoficinas, NEW.idequipos, NEW.idusuario, NEW.idempleado, NEW.cod_patrimonial, NEW.vida_util, NEW.estado, NEW.fecha_asignacion, 'INSERT');
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_detalle_asignacion_update
AFTER UPDATE ON detalle_asignacion
FOR EACH ROW
BEGIN
    INSERT INTO historial_asignacion (id_detalle_asignacion, idsedes, idoficinas, idequipos, idusuario, idempleado, cod_patrimonial, vida_util, estado, fecha_asignacion, accion)
    VALUES (OLD.id_detalle_asignacion, OLD.idsedes, OLD.idoficinas, OLD.idequipos, OLD.idusuario, OLD.idempleado, OLD.cod_patrimonial, OLD.vida_util, 'actualizado', OLD.fecha_asignacion, 'UPDATE');
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_detalle_asignacion_delete
AFTER DELETE ON detalle_asignacion
FOR EACH ROW
BEGIN
    INSERT INTO historial_asignacion (id_detalle_asignacion, idsedes, idoficinas, idequipos, idusuario, idempleado, cod_patrimonial, vida_util, estado, fecha_asignacion, accion)
    VALUES (OLD.id_detalle_asignacion, OLD.idsedes, OLD.idoficinas, OLD.idequipos, OLD.idusuario, OLD.idempleado, OLD.cod_patrimonial, OLD.vida_util, 'eliminado', OLD.fecha_asignacion, 'DELETE');
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-20  1:51:22
