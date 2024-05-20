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
-- Dumping events for database 'equipos_informaticos'
--

--
-- Dumping routines for database 'equipos_informaticos'
--
/*!50003 DROP PROCEDURE IF EXISTS `GetOficinasBySede` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetOficinasBySede`(IN p_idsede INT)
BEGIN
    SELECT * FROM oficina WHERE idsedes = p_idsede;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_actualizar_detalle_asignacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_detalle_asignacion`(
    IN p_id_detalle_asignacion INT,
    IN p_idsedes INT,
    IN p_idoficinas INT,
    IN p_idusuario INT,
    IN p_idempleado INT,
    IN p_vida_util text,
    IN p_estado text,
    IN p_fecha_asignacion DATE
)
BEGIN
  -- Verificar si alguno de los campos está vacío
    IF p_idsedes IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo idsedes está vacío';
    ELSEIF p_idoficinas IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo idoficinas está vacío';
    ELSEIF p_idusuario IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo idusuario está vacío';
    ELSEIF p_idempleado IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo idempleado está vacío';
    ELSEIF p_vida_util IS NULL OR p_vida_util = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo vida_util está vacío';
    ELSEIF p_estado IS NULL OR p_estado = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo estado está vacío';
    ELSEIF p_fecha_asignacion IS NULL OR p_fecha_asignacion = '0000-00-00' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error: La fecha de asignación no es válida.';
    ELSE
        -- Si no hay errores, realizar la actualización
        UPDATE `equipos_informaticos`.`detalle_asignacion`
        SET
            `idsedes` = p_idsedes,
            `idoficinas` = p_idoficinas,
            `idusuario` = p_idusuario,
            `idempleado` = p_idempleado,
            `vida_util` = p_vida_util,
            `estado` = p_estado,
            `fecha_asignacion` = p_fecha_asignacion
        WHERE `id_detalle_asignacion` = p_id_detalle_asignacion;

    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_buscar_detalle_asginacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_buscar_detalle_asginacion`(in p_id_detalle_asignacion int)
BEGIN
SELECT 
        da.id_detalle_asignacion,
        s.nombres AS sede_nombres,
        o.nombres AS oficina_nombres,
        CONCAT(e.descripcion, ' ', e.modelo) AS equipo,
        u.nombre AS usuario_nombre,
        da.cod_patrimonial,
        da.vida_util,
        da.estado,
        em.nombres as empleado_nombre,
        da.idempleado,
        da.idsedes,
        da.idoficinas,
        da.fecha_asignacion
    FROM detalle_asignacion da
    INNER JOIN sede s ON s.idsedes = da.idsedes
    INNER JOIN oficina o ON o.idoficinas = da.idoficinas
    INNER JOIN equipos e ON e.idequipos = da.idequipos
    INNER JOIN usuario u ON u.idusuario = da.idusuario
    INNER JOIN empleados em ON em.idempleado = da.idempleado
    where da.id_detalle_asignacion = p_id_detalle_asignacion ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_insert_detalle_asignacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_detalle_asignacion`(
    IN p_idsedes INT,
    IN p_idoficinas INT,
    IN p_idequipos INT,
    IN p_idusuario INT,
    IN p_idempleado INT,
    IN p_cod_patrimonial text,
    IN p_vida_util text,
    IN p_estado text,
    IN p_fecha_asignacion date
)
BEGIN
   -- Handler para capturar violaciones de clave foránea
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    BEGIN
        GET DIAGNOSTICS CONDITION 1
        @p1 = RETURNED_SQLSTATE, @p2 = MESSAGE_TEXT;

        IF @p2 LIKE '%foreign key constraint fails (`equipos_informaticos`.`detalle_asignacion`, CONSTRAINT `detalle_asignacion_ibfk_2` FOREIGN KEY (`idoficinas`) REFERENCES `oficina` (`idoficinas`))%' THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La oficina especificada no existe.';
        ELSEIF @p2 LIKE '%foreign key constraint fails (`equipos_informaticos`.`detalle_asignacion`, CONSTRAINT `detalle_asignacion_ibfk_1` FOREIGN KEY (`idsedes`) REFERENCES `sedes` (`idsedes`))%' THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La sede especificada no existe.';
        ELSEIF @p2 LIKE '%foreign key constraint fails (`equipos_informaticos`.`detalle_asignacion`, CONSTRAINT `detalle_asignacion_ibfk_3` FOREIGN KEY (`idequipos`) REFERENCES `equipos` (`idequipos`))%' THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El equipo especificado no existe.';
        ELSEIF @p2 LIKE '%foreign key constraint fails (`equipos_informaticos`.`detalle_asignacion`, CONSTRAINT `detalle_asignacion_ibfk_4` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`))%' THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El usuario especificado no existe.';
        ELSEIF @p2 LIKE '%foreign key constraint fails (`equipos_informaticos`.`detalle_asignacion`, CONSTRAINT `detalle_asignacion_ibfk_5` FOREIGN KEY (`idempleado`) REFERENCES `empleados` (`idempleado`))%' THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El empleado especificado no existe.';
        ELSE
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @p2;
        END IF;
    END;

    -- Verificar si alguno de los campos está vacío
    IF p_idsedes IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo idsedes está vacío';
    ELSEIF p_idoficinas IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo idoficinas está vacío';
    ELSEIF p_idequipos IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo idequipos está vacío';
    ELSEIF p_idusuario IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo idusuario está vacío';
    ELSEIF p_idempleado IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo idempleado está vacío';
    ELSEIF p_cod_patrimonial IS NULL OR p_cod_patrimonial = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo cod_patrimonial está vacío';
    ELSEIF p_vida_util IS NULL OR p_vida_util = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo vida_util está vacío';
    ELSEIF p_estado IS NULL OR p_estado = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo estado está vacío';
    ELSEIF p_fecha_asignacion IS NULL OR p_fecha_asignacion = '0000-00-00' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error: La fecha de asignación no es válida.';
    ELSE
        -- Si todos los campos están llenos y la fecha es válida, realizar la inserción
        INSERT INTO `equipos_informaticos`.`detalle_asignacion` (
            `idsedes`,
            `idoficinas`,
            `idequipos`,
            `idusuario`,
            `idempleado`,
            `cod_patrimonial`,
            `vida_util`,
            `estado`,
            `fecha_asignacion`
        ) VALUES (
            p_idsedes, p_idoficinas, p_idequipos, p_idusuario, p_idempleado, p_cod_patrimonial, p_vida_util, p_estado, p_fecha_asignacion
        );
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_listar_equipo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_equipo`()
BEGIN
SELECT
eq.idequipos,
eq.modelo,
eq.descripcion,
eq.fecha_registro,
m.nombre
FROM equipos_informaticos.equipos eq
inner join marca m on m.idmarca=eq.idmarca;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_listar_equipos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_equipos`()
BEGIN
    SELECT ei.idequipos, ei.modelo, ei.descripcion, ei.fecha_registro, m.nombre 
    FROM equipos_informaticos.equipos ei
    INNER JOIN marca m ON m.idmarca = ei.idmarca;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_obtener_detalle_asignacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_detalle_asignacion`()
BEGIN
    SELECT 
        da.id_detalle_asignacion,
        s.nombres AS sede_nombres,
        o.nombres AS oficina_nombres,
        CONCAT(e.descripcion, ' ', e.modelo) AS equipo,
        u.nombre AS usuario_nombre,
        da.cod_patrimonial,
        da.vida_util,
        da.estado,
        em.nombres as empleado_nombre,
        da.fecha_asignacion
    FROM detalle_asignacion da
    INNER JOIN sede s ON s.idsedes = da.idsedes
    INNER JOIN oficina o ON o.idoficinas = da.idoficinas
    INNER JOIN equipos e ON e.idequipos = da.idequipos
    INNER JOIN usuario u ON u.idusuario = da.idusuario
    INNER JOIN empleados em ON em.idempleado = da.idempleado;
END ;;
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

-- Dump completed on 2024-05-20  1:51:23
