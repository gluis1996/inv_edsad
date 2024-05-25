-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2024 a las 02:59:55
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `equipos_informaticos`
--
CREATE DATABASE IF NOT EXISTS `equipos_informaticos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `equipos_informaticos`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `GetOficinasBySede`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetOficinasBySede` (IN `p_idsede` INT)   BEGIN
    SELECT * FROM oficina WHERE idsedes = p_idsede;
END$$

DROP PROCEDURE IF EXISTS `insertar_equipo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_equipo` (IN `p_modelo` TEXT, IN `p_descripcion` TEXT, IN `p_fecha_registro` DATE, IN `p_idmarca` INT)   BEGIN
    -- Verificar si alguno de los campos está vacío
    IF p_modelo IS NULL OR p_modelo = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo modelo está vacío';
    ELSEIF p_descripcion IS NULL OR p_descripcion = '' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo descripcion está vacío';
    ELSEIF p_fecha_registro IS NULL OR p_fecha_registro = '0000-00-00' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error: La fecha de registro no es válida';
    ELSEIF p_idmarca IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El campo idmarca está vacío';
    ELSE
        -- Si todos los campos están llenos y la fecha es válida, realizar la inserción
        INSERT INTO `equipos_informaticos`.`equipos` (
            `modelo`,
            `descripcion`,
            `fecha_registro`,
            `idmarca`
        ) VALUES (
            p_modelo, p_descripcion, p_fecha_registro, p_idmarca
        );
    END IF;
END$$

DROP PROCEDURE IF EXISTS `sp_actualizar_detalle_asignacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_detalle_asignacion` (IN `p_id_detalle_asignacion` INT, IN `p_idsedes` INT, IN `p_idoficinas` INT, IN `p_idusuario` INT, IN `p_idempleado` INT, IN `p_vida_util` TEXT, IN `p_estado` TEXT, IN `p_fecha_asignacion` DATE)   BEGIN
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
END$$

DROP PROCEDURE IF EXISTS `sp_buscar_detalle_asginacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_buscar_detalle_asginacion` (IN `p_id_detalle_asignacion` INT)   BEGIN
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
END$$

DROP PROCEDURE IF EXISTS `sp_insert_detalle_asignacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_detalle_asignacion` (IN `p_idsedes` INT, IN `p_idoficinas` INT, IN `p_idequipos` INT, IN `p_idusuario` INT, IN `p_idempleado` INT, IN `p_cod_patrimonial` TEXT, IN `p_vida_util` TEXT, IN `p_estado` TEXT, IN `p_fecha_asignacion` DATE)   BEGIN
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
END$$

DROP PROCEDURE IF EXISTS `sp_listar_detalle_adquisicion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_detalle_adquisicion` ()   BEGIN
    select 
da.id_detalle_aquisicion as id,
a.id_area_usuaria as area_id,
a.nombres as area_nombre,
b.idbeneficiario as idbeneficiario,
b.nombre as beneficiario_nombre,
eq.idequipos as equipo_id,
concat(m.nombre,' ',eq.modelo,' ',eq.descripcion) as equipo,
me.idmeta as meta_id,
me.nombre as meta_nombre,
da.anio_aquisicion as año,
da.cantidad as cantidad
from detalle_adquisicion da
inner join a_usuaria a on da.id_area_usuaria= a.id_area_usuaria
inner join beneficiario b on b.idbeneficiario=da.idbeneficiario
inner join equipos eq on eq.idequipos=da.idequipos
inner join marca m on m.idmarca=eq.idmarca
inner join meta me on me.idmeta=da.idmeta;
END$$

DROP PROCEDURE IF EXISTS `sp_listar_equipo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_equipo` ()   BEGIN
SELECT
eq.idequipos,
eq.modelo,
eq.descripcion,
eq.fecha_registro,
m.nombre
FROM equipos_informaticos.equipos eq
inner join marca m on m.idmarca=eq.idmarca;
END$$

DROP PROCEDURE IF EXISTS `sp_listar_equipos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_equipos` ()   BEGIN
    SELECT ei.idequipos, ei.modelo, ei.descripcion, ei.fecha_registro, m.nombre 
    FROM equipos_informaticos.equipos ei
    INNER JOIN marca m ON m.idmarca = ei.idmarca;
END$$

DROP PROCEDURE IF EXISTS `sp_listar_historial_asignacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_historial_asignacion` (IN `p_patrimonial` TEXT)   BEGIN
    SELECT 
ha.id_historial,
ha.id_detalle_asignacion,
s.nombres as nombre_sede,
ofi.nombres as nombre_oficina,
concat(eq.modelo, "  ", eq.descripcion, "  ", ma.nombre) as equipo,
usu.nombre as nombre_usuario,
em.nombres as nombre_empleado,
ha.cod_patrimonial,
ha.vida_util,
ha.estado,
ha.fecha_asignacion,
ha.accion,
ha.fecha
FROM equipos_informaticos.historial_asignacion  ha
inner join sede s on s.idsedes = ha.idsedes
inner join oficina ofi on ofi.idoficinas=ha.idsedes
inner join equipos eq on eq.idequipos=ha.idequipos
inner join usuario usu on usu.idusuario = ha.idusuario
inner join empleados em on em.idempleado = ha.idempleado
inner join marca ma on ma. idmarca = eq.idmarca
where ha.cod_patrimonial = p_patrimonial
order by ha.fecha desc;
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_detalle_asignacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_detalle_asignacion` ()   BEGIN
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
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `a_usuaria`
--

DROP TABLE IF EXISTS `a_usuaria`;
CREATE TABLE `a_usuaria` (
  `id_area_usuaria` int(11) NOT NULL,
  `nombres` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `a_usuaria`
--

INSERT INTO `a_usuaria` (`id_area_usuaria`, `nombres`) VALUES
(1, 'AREA DE INFORMÁTICA'),
(2, 'DIRECCIÓN ACADEMICA'),
(3, 'DIRECCIÓN ACADÉMICA'),
(4, 'DIRECCIÓN GENERAL'),
(5, 'IMAGEN'),
(6, 'JEFATURA DE CARRERAS'),
(7, 'SIN AREA USUARIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario`
--

DROP TABLE IF EXISTS `beneficiario`;
CREATE TABLE `beneficiario` (
  `idbeneficiario` int(11) NOT NULL,
  `nombre` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `beneficiario`
--

INSERT INTO `beneficiario` (`idbeneficiario`, `nombre`) VALUES
(1, 'USUARIOS ENSAD'),
(2, 'SALA DE PROFESORES'),
(3, 'OFICINAS DE ENSAD'),
(4, 'IMAGEN'),
(5, 'ESTUDIANTES ENSAD'),
(6, 'CONSEJO DIRECTIVO'),
(7, 'AREAS ACADEMICAS'),
(8, 'AREA DE INFORMÁTICA'),
(9, 'SIN BENEFICIADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_adquisicion`
--

DROP TABLE IF EXISTS `detalle_adquisicion`;
CREATE TABLE `detalle_adquisicion` (
  `id_detalle_aquisicion` int(11) NOT NULL,
  `id_area_usuaria` int(11) DEFAULT NULL,
  `idbeneficiario` int(11) DEFAULT NULL,
  `idequipos` int(11) DEFAULT NULL,
  `idmeta` int(11) DEFAULT NULL,
  `anio_aquisicion` year(4) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_adquisicion`
--

INSERT INTO `detalle_adquisicion` (`id_detalle_aquisicion`, `id_area_usuaria`, `idbeneficiario`, `idequipos`, `idmeta`, `anio_aquisicion`, `cantidad`) VALUES
(1, 1, 7, 15, 1, '2020', 6),
(2, 1, 6, 12, 1, '2022', 1),
(3, 1, 6, 12, 1, '2022', 5),
(4, 1, 6, 12, 1, '2022', 2),
(5, 1, 3, 43, 1, '2023', 7),
(6, 1, 3, 43, 1, '2023', 2),
(7, 7, 8, 50, 1, '2022', 3),
(8, 7, 8, 50, 1, '2022', 4),
(9, 7, 9, 31, 5, '2020', 14),
(10, 1, 9, 27, 4, '2023', 3),
(11, 1, 9, 27, 4, '2023', 5),
(12, 2, 5, 32, 4, '2023', 6),
(13, 2, 5, 32, 4, '2023', 1),
(14, 2, 5, 32, 4, '2023', 3),
(15, 1, 8, 58, 2, '2022', 1),
(16, 1, 6, 33, 2, '2022', 10),
(17, 1, 4, 3, 2, '2022', 1),
(18, 1, 3, 57, 2, '2022', 3),
(19, 1, 3, 57, 2, '2022', 1),
(20, 1, 3, 20, 2, '2022', 25),
(21, 1, 3, 20, 2, '2022', 1),
(22, 1, 3, 46, 2, '2022', 2),
(23, 1, 3, 43, 2, '2022', 1),
(24, 1, 3, 43, 2, '2022', 6),
(25, 1, 2, 39, 2, '2022', 5),
(26, 2, 3, 31, 2, '2022', 6),
(27, 2, 3, 31, 2, '2022', 7),
(28, 2, 1, 31, 2, '2022', 14),
(29, 4, 4, 25, 2, '2022', 1),
(30, 4, 3, 28, 2, '2022', 5),
(31, 5, 4, 60, 2, '2022', 1),
(32, 3, 9, 25, 6, '2022', 10),
(33, 1, 4, 3, 3, '2022', 2),
(34, 6, 9, 44, 3, '2021', 8),
(35, 7, 9, 23, 3, '0000', 9),
(36, 7, 9, 31, 3, '0000', 6),
(37, 7, 9, 31, 3, '0000', 1),
(38, 7, 9, 43, 3, '0000', 3),
(39, 7, 9, 52, 3, '0000', 2),
(40, 7, 9, 24, 3, '0000', 6),
(41, 7, 9, 24, 3, '0000', 4),
(42, 7, 9, 24, 3, '0000', 20),
(43, 7, 9, 24, 3, '0000', 10),
(44, 7, 9, 24, 3, '0000', 4),
(45, 7, 9, 24, 3, '0000', 8),
(46, 7, 9, 24, 3, '0000', 2),
(47, 7, 9, 24, 3, '0000', 4),
(48, 7, 9, 24, 3, '0000', 5),
(49, 7, 9, 24, 3, '0000', 7),
(50, 7, 9, 24, 3, '0000', 6),
(51, 7, 9, 52, 3, '0000', 1),
(52, 7, 9, 24, 3, '0000', 1),
(53, 7, 9, 9, 3, '0000', 1),
(54, 7, 9, 44, 3, '2020', 11),
(55, 7, 9, 44, 3, '0000', 8),
(56, 7, 9, 26, 3, '0000', 1),
(57, 7, 9, 48, 3, '0000', 1),
(58, 7, 9, 48, 3, '0000', 1),
(59, 7, 9, 48, 3, '0000', 2),
(60, 7, 9, 48, 3, '0000', 1),
(61, 7, 9, 48, 3, '0000', 9),
(62, 7, 9, 48, 3, '0000', 4),
(63, 7, 9, 48, 3, '0000', 1),
(64, 7, 9, 61, 3, '0000', 1),
(65, 7, 9, 47, 3, '0000', 1),
(66, 7, 9, 13, 3, '0000', 1),
(67, 7, 9, 13, 3, '0000', 6),
(68, 7, 9, 55, 3, '0000', 1),
(69, 7, 9, 35, 3, '0000', 1),
(70, 7, 9, 55, 3, '0000', 1),
(71, 7, 9, 3, 3, '0000', 1),
(72, 7, 9, 25, 3, '0000', 5),
(73, 7, 9, 25, 3, '0000', 1),
(74, 7, 9, 25, 3, '0000', 1),
(75, 7, 9, 25, 3, '0000', 3),
(76, 7, 9, 31, 3, '0000', 2),
(77, 7, 9, 25, 3, '0000', 7),
(78, 7, 9, 31, 3, '0000', 2),
(79, 7, 9, 31, 3, '0000', 4),
(80, 7, 9, 1, 3, '0000', 1),
(81, 7, 9, 25, 3, '0000', 10),
(82, 7, 9, 25, 3, '0000', 3),
(83, 7, 9, 25, 3, '0000', 31),
(84, 7, 9, 25, 3, '0000', 1),
(85, 7, 9, 31, 3, '0000', 1),
(86, 7, 9, 31, 3, '0000', 7),
(87, 7, 9, 31, 3, '0000', 1),
(88, 7, 9, 31, 3, '0000', 2),
(89, 7, 9, 31, 3, '0000', 2),
(90, 7, 9, 25, 3, '0000', 1),
(91, 7, 9, 1, 3, '0000', 3),
(92, 7, 9, 31, 3, '0000', 2),
(93, 7, 9, 50, 3, '0000', 1),
(94, 7, 9, 50, 3, '0000', 1),
(95, 7, 9, 50, 3, '0000', 1),
(96, 7, 9, 56, 3, '0000', 2),
(97, 7, 9, 56, 3, '0000', 3),
(98, 7, 9, 56, 3, '0000', 2),
(99, 7, 9, 54, 3, '0000', 1),
(100, 7, 9, 47, 3, '0000', 12),
(101, 7, 9, 50, 3, '0000', 1),
(102, 7, 9, 50, 3, '0000', 2),
(103, 7, 9, 50, 3, '0000', 1),
(104, 7, 9, 50, 3, '0000', 3),
(105, 7, 9, 24, 3, '0000', 1),
(106, 7, 9, 24, 3, '0000', 2),
(107, 7, 9, 52, 3, '0000', 1),
(108, 7, 9, 18, 3, '0000', 4),
(109, 7, 9, 49, 3, '0000', 1),
(110, 7, 9, 10, 3, '0000', 1),
(111, 7, 9, 10, 3, '0000', 2),
(112, 7, 9, 19, 3, '0000', 1),
(113, 7, 9, 10, 3, '0000', 2),
(114, 7, 9, 10, 3, '0000', 1),
(115, 7, 9, 10, 3, '0000', 7),
(116, 7, 9, 43, 3, '0000', 1),
(117, 7, 9, 61, 3, '0000', 1),
(118, 7, 9, 2, 3, '0000', 3),
(119, 7, 9, 24, 3, '0000', 3),
(120, 7, 9, 53, 3, '0000', 1),
(121, 7, 9, 5, 3, '0000', 1),
(122, 7, 9, 29, 3, '0000', 1),
(123, 7, 9, 29, 3, '0000', 1),
(124, 7, 9, 22, 3, '0000', 1),
(125, 7, 9, 40, 3, '0000', 1),
(126, 7, 9, 30, 3, '0000', 1),
(127, 7, 9, 7, 3, '0000', 1),
(128, 7, 9, 25, 3, '0000', 1),
(129, 7, 9, 25, 3, '0000', 1),
(130, 7, 9, 25, 3, '0000', 3),
(131, 7, 9, 25, 3, '0000', 1),
(132, 7, 9, 25, 3, '0000', 1),
(133, 7, 9, 51, 3, '0000', 1),
(134, 7, 9, 51, 3, '0000', 2),
(135, 7, 9, 51, 3, '0000', 1),
(136, 7, 9, 30, 3, '0000', 1),
(137, 7, 9, 30, 3, '0000', 1),
(138, 7, 9, 30, 3, '0000', 1),
(139, 7, 9, 30, 3, '0000', 1),
(140, 7, 9, 31, 3, '0000', 1),
(141, 7, 9, 25, 3, '0000', 4),
(142, 7, 9, 31, 3, '0000', 1),
(143, 7, 9, 25, 3, '0000', 1),
(144, 7, 9, 31, 3, '0000', 7),
(145, 7, 9, 25, 3, '0000', 5),
(146, 7, 9, 34, 3, '0000', 1),
(147, 7, 9, 32, 3, '0000', 1),
(148, 7, 9, 32, 3, '0000', 1),
(149, 7, 9, 5, 3, '2023', 1),
(150, 7, 9, 5, 3, '0000', 2),
(151, 7, 9, 52, 3, '0000', 1),
(152, 7, 9, 52, 3, '0000', 2),
(153, 7, 9, 25, 3, '0000', 1),
(154, 7, 9, 63, 3, '0000', 9),
(155, 7, 9, 61, 3, '0000', 1),
(156, 7, 9, 44, 3, '0000', 12),
(157, 7, 9, 44, 3, '0000', 1),
(158, 7, 9, 31, 3, '0000', 1),
(159, 7, 9, 32, 3, '0000', 1),
(160, 7, 9, 31, 3, '0000', 2),
(161, 7, 9, 25, 3, '0000', 15),
(162, 7, 9, 31, 3, '0000', 4),
(163, 7, 9, 31, 3, '0000', 4),
(164, 7, 9, 31, 3, '0000', 1),
(165, 7, 9, 31, 3, '0000', 1),
(166, 7, 9, 15, 3, '2020', 6),
(167, 7, 9, 25, 3, '0000', 6),
(168, 7, 9, 25, 3, '0000', 1),
(169, 7, 9, 31, 3, '0000', 1),
(170, 7, 9, 31, 3, '0000', 1),
(171, 7, 9, 31, 3, '0000', 15),
(172, 7, 9, 59, 3, '0000', 1),
(173, 7, 9, 25, 3, '0000', 26),
(174, 7, 9, 37, 3, '0000', 2),
(175, 7, 9, 1, 3, '0000', 3),
(176, 7, 9, 20, 3, '0000', 1),
(177, 7, 9, 20, 3, '0000', 1),
(178, 7, 9, 33, 3, '0000', 1),
(179, 7, 9, 31, 3, '0000', 1),
(180, 7, 9, 33, 3, '0000', 4),
(181, 7, 9, 33, 3, '0000', 14),
(182, 7, 9, 31, 3, '0000', 1),
(183, 7, 9, 31, 3, '0000', 3),
(184, 7, 9, 25, 3, '0000', 1),
(185, 7, 9, 25, 3, '0000', 21),
(186, 7, 9, 31, 3, '0000', 8),
(187, 7, 9, 37, 3, '0000', 1),
(188, 7, 9, 37, 3, '0000', 2),
(189, 7, 9, 5, 3, '0000', 37),
(190, 7, 9, 31, 3, '0000', 12),
(191, 7, 9, 31, 3, '0000', 1),
(192, 7, 9, 31, 3, '0000', 1),
(193, 7, 9, 8, 3, '0000', 1),
(194, 7, 9, 20, 3, '0000', 2),
(195, 7, 9, 18, 3, '0000', 4),
(196, 7, 9, 18, 3, '0000', 4),
(197, 7, 9, 18, 3, '0000', 1),
(198, 7, 9, 6, 3, '0000', 2),
(199, 7, 9, 59, 3, '0000', 2),
(200, 7, 9, 59, 3, '0000', 1),
(201, 7, 9, 18, 3, '0000', 1),
(202, 7, 9, 18, 3, '0000', 1),
(203, 7, 9, 18, 3, '0000', 1),
(204, 7, 9, 47, 3, '0000', 4),
(205, 7, 9, 18, 3, '0000', 9),
(206, 7, 9, 59, 3, '0000', 2),
(207, 7, 9, 18, 3, '0000', 1),
(208, 7, 9, 23, 3, '0000', 4),
(209, 7, 9, 23, 3, '0000', 2),
(210, 7, 9, 62, 3, '0000', 3),
(211, 7, 9, 7, 3, '0000', 1),
(212, 7, 9, 11, 3, '0000', 2),
(213, 7, 9, 11, 3, '0000', 1),
(214, 7, 9, 57, 3, '0000', 3),
(215, 7, 9, 25, 3, '0000', 2),
(216, 7, 9, 15, 3, '0000', 1),
(217, 7, 9, 25, 3, '0000', 1),
(218, 7, 9, 25, 3, '0000', 1),
(219, 7, 9, 25, 3, '0000', 1),
(220, 7, 9, 25, 3, '0000', 1),
(221, 7, 9, 11, 3, '0000', 1),
(222, 7, 9, 11, 3, '0000', 1),
(223, 7, 9, 11, 3, '0000', 1),
(224, 7, 9, 16, 3, '0000', 2),
(225, 7, 9, 48, 3, '2022', 5),
(226, 7, 9, 31, 3, '2022', 2),
(227, 7, 9, 37, 3, '0000', 8),
(228, 7, 9, 1, 3, '0000', 5),
(229, 7, 9, 31, 3, '0000', 15),
(230, 7, 9, 1, 3, '0000', 1),
(231, 7, 9, 1, 3, '0000', 1),
(232, 7, 9, 25, 3, '0000', 5),
(233, 7, 9, 33, 3, '0000', 18),
(234, 7, 9, 31, 3, '0000', 1),
(235, 7, 9, 37, 3, '0000', 1),
(236, 7, 9, 37, 3, '0000', 10),
(237, 7, 9, 31, 3, '0000', 5),
(238, 7, 9, 25, 3, '0000', 26),
(239, 7, 9, 31, 3, '0000', 11),
(240, 7, 9, 25, 3, '0000', 1),
(241, 7, 9, 25, 3, '0000', 1),
(242, 7, 9, 5, 3, '0000', 3),
(243, 7, 9, 25, 3, '0000', 2),
(244, 7, 9, 37, 3, '0000', 1),
(245, 7, 9, 33, 3, '0000', 2),
(246, 7, 9, 21, 3, '0000', 1),
(247, 7, 9, 43, 3, '0000', 1),
(248, 7, 9, 43, 3, '0000', 1),
(249, 7, 9, 43, 3, '0000', 27),
(250, 7, 9, 43, 3, '0000', 1),
(251, 7, 9, 45, 3, '0000', 1),
(252, 7, 9, 45, 3, '0000', 2),
(253, 7, 9, 4, 3, '0000', 1),
(254, 7, 9, 19, 3, '0000', 6),
(255, 7, 9, 19, 3, '0000', 1),
(256, 7, 9, 4, 3, '0000', 42),
(257, 7, 9, 10, 3, '0000', 1),
(258, 7, 9, 4, 3, '0000', 1),
(259, 7, 9, 19, 3, '0000', 13),
(260, 7, 9, 4, 3, '0000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_asignacion`
--

DROP TABLE IF EXISTS `detalle_asignacion`;
CREATE TABLE `detalle_asignacion` (
  `id_detalle_asignacion` int(11) NOT NULL,
  `idsedes` int(11) DEFAULT NULL,
  `idoficinas` int(11) DEFAULT NULL,
  `idequipos` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idempleado` int(11) DEFAULT NULL,
  `cod_patrimonial` text NOT NULL,
  `vida_util` text DEFAULT NULL,
  `estado` text DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_asignacion`
--

INSERT INTO `detalle_asignacion` (`id_detalle_asignacion`, `idsedes`, `idoficinas`, `idequipos`, `idusuario`, `idempleado`, `cod_patrimonial`, `vida_util`, `estado`, `fecha_asignacion`) VALUES
(7280, 2, 32, 193, 1, 33, '000491', '1 AÑO', 'INOPERATIVA', '0000-00-00'),
(7281, 2, 35, 115, 1, 33, 'S/C57', '1 AÑO', 'INOPERATIVA', '0000-00-00'),
(7282, 2, 22, 187, 1, 33, 'S/C60', '1 AÑO', 'INOPERATIVA', '0000-00-00'),
(7283, 2, 44, 93, 1, 33, '000141', '2 AÑOS', 'INOPERATIVA', '0000-00-00'),
(7284, 2, 35, 195, 1, 33, '02620(2019)', '0', 'INOPERATIVO', '0000-00-00'),
(7285, 2, 34, 224, 1, 45, 'S/C112', '0', 'INOPERATIVO', '0000-00-00'),
(7286, 2, 58, 187, 1, 51, 'S/C123', '1 AÑO', 'INOPERATIVO', '0000-00-00'),
(7287, 2, 35, 93, 1, 33, '000142', '2 AÑOS', 'INOPERATIVO', '0000-00-00'),
(7288, 2, 35, 93, 1, 33, '000153', '2 AÑOS', 'INOPERATIVO', '0000-00-00'),
(7289, 2, 35, 144, 1, 33, '002551', '3 AÑOS', 'INOPERATIVO', '0000-00-00'),
(7290, 1, 1, 104, 1, 11, '255', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7291, 1, 1, 154, 1, 11, '1379', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7292, 1, 1, 154, 1, 11, '1380', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7293, 1, 1, 154, 1, 11, '1387', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7294, 1, 1, 154, 1, 11, '1388', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7295, 1, 1, 104, 1, 11, '1916', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7296, 1, 1, 104, 1, 11, '1917', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7297, 1, 1, 151, 1, 11, '1924', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7298, 1, 1, 193, 1, 11, '000488', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7299, 1, 1, 193, 1, 11, '000502', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7300, 1, 9, 277, 1, 18, '000535', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7301, 1, 1, 86, 1, 11, '001407', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7302, 1, 1, 164, 1, 11, '001499', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7303, 1, 1, 158, 1, 11, '002172', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7304, 1, 1, 177, 1, 11, '002509', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7305, 1, 1, 177, 1, 11, '002512', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7306, 2, 58, 10, 1, 49, '003300', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7307, 2, 25, 10, 1, 29, '003301', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7308, 1, 1, 175, 1, 11, '003536', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7309, 1, 1, 104, 1, 11, '01673-2021', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7310, 1, 1, 175, 1, 11, '01882-2021', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7311, 1, 1, 121, 1, 11, '2256-2019', 'sin vida', 'INOPERATIVO', '0000-00-00'),
(7312, 1, 13, 93, 1, 6, '000157', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7313, 1, 2, 109, 1, 16, '000186', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7314, 2, 31, 109, 1, 28, '000199', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7315, 1, 14, 109, 1, 10, '000200', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7316, 2, 32, 193, 1, 33, '000487', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7317, 2, 70, 194, 1, 59, '000490', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7318, 1, 8, 193, 1, 15, '000492', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7319, 2, 59, 194, 1, 54, '000499', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7320, 2, 32, 181, 1, 33, '000529', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7321, 2, 31, 109, 1, 25, '000875', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7322, 2, 34, 109, 1, 45, '000878', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7323, 2, 30, 226, 1, 39, '001393', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7324, 2, 32, 263, 1, 33, '001423', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7325, 1, 4, 263, 1, 2, '001424', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7326, 2, 35, 263, 1, 33, '001428', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7327, 2, 60, 202, 1, 59, '001447', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7328, 2, 31, 206, 1, 28, '001448', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7329, 1, 2, 202, 1, 16, '001450', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7330, 2, 57, 202, 1, 36, '001452', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7331, 2, 58, 202, 1, 51, '001453', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7332, 3, 72, 202, 1, 64, '001456', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7333, 2, 34, 202, 1, 46, '001457', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7334, 2, 31, 207, 1, 19, '001458', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7335, 2, 58, 202, 1, 50, '001460', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7336, 2, 30, 165, 1, 36, '001484', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7337, 2, 30, 179, 1, 37, '001527', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7338, 2, 30, 179, 1, 36, '001528', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7339, 2, 31, 179, 1, 25, '001530', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7340, 2, 30, 179, 1, 37, '001532', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7341, 2, 30, 179, 1, 37, '001533', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7342, 2, 30, 179, 1, 37, '001534', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7343, 2, 30, 179, 1, 37, '001535', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7344, 2, 62, 179, 1, 36, '001536', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7345, 2, 42, 179, 1, 36, '001537', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7346, 2, 34, 179, 1, 43, '001538', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7347, 2, 34, 157, 1, 46, '002174', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7348, 3, 72, 157, 1, 64, '002177', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7349, 3, 72, 157, 1, 66, '002178', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7350, 2, 60, 177, 1, 59, '002518', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7351, 2, 32, 177, 1, 33, '002519', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7352, 2, 24, 177, 1, 59, '002520', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7353, 2, 34, 193, 1, 45, '002521', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7354, 2, 57, 122, 1, 36, '003262', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7355, 2, 23, 122, 1, 33, '003268', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7356, 2, 32, 124, 1, 33, '003269', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7357, 2, 30, 122, 1, 40, '003270', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7358, 2, 34, 122, 1, 42, '003271', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7359, 2, 62, 122, 1, 36, '003272', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7360, 2, 32, 122, 1, 33, '003273', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7361, 2, 30, 122, 1, 36, '003274', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7362, 2, 30, 122, 1, 36, '003275', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7363, 3, 73, 122, 1, 66, '003276', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7364, 2, 30, 122, 1, 36, '003277', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7365, 2, 32, 126, 1, 33, '003279', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7366, 2, 62, 122, 1, 36, '003280', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7367, 2, 32, 126, 1, 33, '003282', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7368, 2, 31, 122, 1, 25, '003283', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7369, 1, 13, 122, 1, 6, '003284', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7370, 2, 28, 122, 1, 59, '003285', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7371, 2, 30, 123, 1, 36, '003286', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7372, 2, 30, 178, 1, 39, '003287', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7373, 2, 62, 122, 1, 36, '003288', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7374, 1, 13, 122, 1, 7, '003289', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7375, 2, 31, 122, 1, 26, '003291', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7376, 1, 4, 122, 1, 2, '003292', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7377, 2, 23, 122, 1, 34, '003293', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7378, 2, 59, 122, 1, 53, '003296', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7379, 1, 11, 122, 1, 5, '003297', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7380, 1, 7, 161, 1, 10, '003510', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7381, 1, 7, 175, 1, 10, '003532', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7382, 2, 23, 175, 1, 35, '003537', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7383, 2, 31, 175, 1, 22, '003539', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7384, 2, 56, 175, 1, 47, '003540', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7385, 1, 2, 175, 1, 16, '003541', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7386, 2, 56, 4, 1, 48, '003849', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7387, 1, 5, 4, 1, 15, '003852', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7388, 2, 30, 14, 1, 41, '003900', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7389, 2, 32, 122, 1, 33, '01562(2021)', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7390, 2, 34, 175, 1, 41, '01845(INV 2021)', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7391, 1, 11, 6, 1, 4, '02240 (INV.2021)', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7392, 1, 10, 122, 1, 3, '02355(INV 2021)', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7393, 2, 34, 5, 1, 44, '03400(INV.2021)', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7394, 2, 35, 281, 1, 33, '3321(2020)', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7395, 1, 4, 112, 1, 2, 'S/C1', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7396, 1, 10, 189, 1, 3, 'S/C2', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7397, 1, 11, 170, 1, 4, 'S/C3', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7398, 1, 11, 112, 1, 5, 'S/C4', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7399, 1, 13, 199, 1, 6, 'S/C5', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7400, 1, 13, 112, 1, 7, 'S/C6', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7401, 1, 15, 190, 1, 8, 'S/C7', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7402, 1, 14, 112, 1, 10, 'S/C10', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7403, 1, 7, 167, 1, 10, 'S/C11', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7404, 1, 14, 171, 1, 10, 'S/C12', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7405, 1, 5, 3, 1, 15, 'S/C14', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7406, 1, 8, 166, 1, 15, 'S/C15', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7407, 1, 8, 189, 1, 15, 'S/C16', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7408, 1, 2, 167, 1, 16, 'S/C20', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7409, 2, 31, 200, 1, 19, 'S/C31', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7410, 2, 31, 167, 1, 22, 'S/C34', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7411, 2, 31, 61, 1, 25, 'S/C37', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7412, 2, 31, 112, 1, 25, 'S/C38', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7413, 2, 31, 190, 1, 26, 'S/C39', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7414, 2, 31, 208, 1, 28, 'S/C42', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7415, 2, 22, 175, 1, 31, 'S/C45', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7416, 2, 22, 167, 1, 31, 'S/C46', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7417, 2, 32, 38, 1, 33, 'S/C47', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7418, 2, 32, 38, 1, 33, 'S/C48', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7419, 2, 32, 38, 1, 33, 'S/C49', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7420, 2, 32, 38, 1, 33, 'S/C50', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7421, 2, 32, 38, 1, 33, 'S/C51', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7422, 2, 32, 38, 1, 33, 'S/C52', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7423, 2, 32, 112, 1, 33, 'S/C55', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7424, 2, 23, 112, 1, 33, 'S/C56', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7425, 2, 32, 175, 1, 33, 'S/C58', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7426, 2, 32, 167, 1, 33, 'S/C59', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7427, 2, 35, 189, 1, 33, 'S/C61', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7428, 2, 35, 189, 1, 33, 'S/C62', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7429, 2, 35, 189, 1, 33, 'S/C63', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7430, 2, 35, 189, 1, 33, 'S/C64', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7431, 2, 35, 189, 1, 33, 'S/C65', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7432, 2, 35, 189, 1, 33, 'S/C66', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7433, 2, 35, 189, 1, 33, 'S/C67', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7434, 2, 35, 189, 1, 33, 'S/C68', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7435, 2, 35, 189, 1, 33, 'S/C69', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7436, 2, 35, 189, 1, 33, 'S/C70', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7437, 2, 32, 190, 1, 33, 'S/C71', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7438, 2, 32, 198, 1, 33, 'S/C72', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7439, 2, 32, 266, 1, 33, 'S/C73', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7440, 2, 23, 112, 1, 34, 'S/C76', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7441, 2, 23, 187, 1, 34, 'S/C77', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7442, 2, 23, 167, 1, 35, 'S/C79', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7443, 2, 30, 113, 1, 36, 'S/C80', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7444, 2, 57, 112, 1, 36, 'S/C81', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7445, 2, 62, 112, 1, 36, 'S/C82', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7446, 2, 62, 112, 1, 36, 'S/C83', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7447, 2, 68, 112, 1, 36, 'S/C84', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7448, 2, 30, 112, 1, 36, 'S/C85', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7449, 2, 30, 112, 1, 36, 'S/C86', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7450, 2, 57, 170, 1, 36, 'S/C87', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7451, 2, 57, 170, 1, 36, 'S/C88', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7452, 2, 62, 170, 1, 36, 'S/C89', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7453, 2, 30, 173, 1, 36, 'S/C90', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7454, 2, 30, 213, 1, 36, 'S/C91', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7455, 2, 30, 170, 1, 37, 'S/C92', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7456, 2, 30, 170, 1, 37, 'S/C93', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7457, 2, 30, 170, 1, 37, 'S/C94', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7458, 2, 30, 170, 1, 37, 'S/C95', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7459, 2, 30, 170, 1, 37, 'S/C96', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7460, 2, 30, 234, 1, 39, 'S/C98', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7461, 2, 30, 234, 1, 40, 'S/C100', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7462, 2, 30, 16, 1, 41, 'S/C101', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7463, 2, 30, 187, 1, 41, 'S/C104', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7464, 2, 26, 190, 1, 41, 'S/C105', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7465, 2, 34, 112, 1, 42, 'S/C106', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7466, 2, 34, 170, 1, 43, 'S/C107', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7467, 2, 34, 189, 1, 44, 'S/C109', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7468, 2, 34, 168, 1, 45, 'S/C111', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7469, 2, 34, 166, 1, 46, 'S/C113', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7470, 2, 56, 167, 1, 47, 'S/C117', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7471, 2, 56, 3, 1, 48, 'S/C119', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7472, 2, 58, 200, 1, 50, 'S/C120', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7473, 2, 58, 170, 1, 51, 'S/C122', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7474, 2, 59, 62, 1, 53, 'S/C124', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7475, 2, 59, 112, 1, 54, 'S/C127', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7476, 2, 60, 112, 1, 59, 'S/C128', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7477, 2, 28, 112, 1, 59, 'S/C129', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7478, 2, 60, 166, 1, 59, 'S/C130', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7479, 2, 27, 169, 1, 59, 'S/C131', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7480, 2, 24, 192, 1, 59, 'S/C132', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7481, 3, 72, 112, 1, 64, 'S/C133', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7482, 3, 72, 198, 1, 64, 'S/C134', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7483, 3, 73, 112, 1, 66, 'S/C137', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7484, 3, 74, 175, 1, 67, 'S/C140', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7485, 3, 74, 167, 1, 67, 'S/C141', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7486, 3, 73, 187, 1, 67, 'S/C142', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7487, 3, 74, 3, 1, 68, 'S/C144', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7488, 1, 2, 187, 1, 18, 'S/C183', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7489, 2, 31, 187, 1, 24, 'S/C194', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7490, 2, 31, 187, 1, 27, 'S/C204', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7491, 2, 25, 187, 1, 30, 'S/C217', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7492, 2, 29, 187, 1, 60, 'S/C233', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7493, 2, 30, 15, 1, 41, 'S/C262', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7494, 2, 30, 17, 1, 41, 'S/C263', '1 AÑO', 'OPERATIVO', '0000-00-00'),
(7495, 2, 32, 9, 1, 33, '000181', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7496, 2, 30, 109, 1, 40, '000209', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7497, 3, 72, 10, 1, 64, '000543', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7498, 2, 35, 10, 1, 33, '000578', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7499, 2, 31, 10, 1, 22, '000580', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7500, 2, 56, 10, 1, 47, '000582', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7501, 1, 2, 10, 1, 16, '000583', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7502, 2, 30, 10, 1, 36, '000849', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7503, 2, 30, 10, 1, 36, '000850', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7504, 2, 57, 10, 1, 36, '000853', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7505, 2, 30, 10, 1, 36, '000854', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7506, 2, 57, 10, 1, 36, '000855', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7507, 2, 60, 10, 1, 59, '000856', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7508, 1, 12, 10, 1, 10, '000857', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7509, 2, 62, 10, 1, 36, '000858', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7510, 3, 74, 10, 1, 68, '000859', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7511, 3, 73, 10, 1, 66, '000862', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7512, 2, 37, 10, 1, 33, '000863', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7513, 2, 65, 10, 1, 28, '000865', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7514, 2, 29, 10, 1, 59, '000866', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7515, 2, 57, 10, 1, 36, '000867', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7516, 2, 68, 10, 1, 36, '001734', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7517, 2, 30, 10, 1, 40, '001739', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7518, 3, 72, 66, 1, 64, '003778', '18 MESES', 'OPERATIVO', '0000-00-00'),
(7519, 2, 31, 129, 1, 22, '000001', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7520, 3, 73, 129, 1, 67, '000002', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7521, 1, 5, 257, 1, 15, '000084', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7522, 1, 14, 93, 1, 10, '000143', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7523, 1, 13, 93, 1, 7, '000145', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7524, 1, 11, 93, 1, 5, '000146', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7525, 2, 34, 93, 1, 45, '000147', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7526, 1, 10, 93, 1, 3, '000150', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7527, 1, 4, 93, 1, 2, '000151', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7528, 2, 23, 93, 1, 34, '000154', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7529, 2, 30, 93, 1, 36, '000154', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7530, 2, 34, 93, 1, 44, '000156', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7531, 2, 45, 93, 1, 33, '000158', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7532, 2, 30, 93, 1, 36, '000159', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7533, 2, 59, 93, 1, 53, '000161', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7534, 2, 62, 93, 1, 36, '000163', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7535, 2, 71, 93, 1, 36, '000166', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7536, 2, 35, 93, 1, 33, '000167-152', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7537, 2, 24, 93, 1, 59, '000168', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7538, 2, 60, 93, 1, 59, '000169', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7539, 2, 30, 93, 1, 40, '000170', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7540, 2, 62, 93, 1, 36, '000172', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7541, 2, 30, 93, 1, 36, '000173', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7542, 1, 2, 93, 1, 16, '000176', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7543, 2, 57, 93, 1, 36, '000177', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7544, 1, 11, 109, 1, 5, '000184', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7545, 2, 38, 107, 1, 33, '000187', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7546, 2, 57, 107, 1, 36, '000188', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7547, 2, 34, 109, 1, 44, '000190', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7548, 1, 10, 109, 1, 3, '000193', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7549, 2, 33, 107, 1, 33, '000194', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7550, 2, 28, 109, 1, 59, '000195', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7551, 2, 59, 106, 1, 53, '000196', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7552, 2, 30, 107, 1, 36, '000197', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7553, 2, 23, 109, 1, 34, '000198', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7554, 1, 13, 109, 1, 7, '000201', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7555, 2, 62, 107, 1, 36, '000202', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7556, 2, 33, 107, 1, 33, '000203', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7557, 2, 31, 109, 1, 26, '000204', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7558, 2, 30, 107, 1, 36, '000207', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7559, 2, 57, 107, 1, 36, '000208', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7560, 2, 31, 109, 1, 25, '000210', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7561, 2, 30, 107, 1, 36, '000211', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7562, 1, 13, 107, 1, 6, '000213', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7563, 2, 30, 107, 1, 36, '000214', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7564, 1, 10, 109, 1, 4, '000215', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7565, 1, 4, 111, 1, 2, '000219', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7566, 2, 62, 107, 1, 36, '000220', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7567, 2, 62, 107, 1, 36, '000221', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7568, 2, 31, 35, 1, 22, '0004', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7569, 2, 33, 78, 1, 33, '000440', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7570, 2, 23, 78, 1, 33, '000441', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7571, 2, 23, 78, 1, 33, '000443', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7572, 2, 33, 78, 1, 33, '000444', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7573, 2, 23, 80, 1, 33, '000448', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7574, 2, 33, 80, 1, 33, '000449', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7575, 2, 23, 84, 1, 33, '00047(2018)', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7576, 2, 30, 35, 1, 41, '0005', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7577, 2, 32, 30, 1, 33, '000575', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7578, 3, 73, 35, 1, 67, '0006', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7579, 2, 32, 281, 1, 33, '000627', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7580, 2, 35, 103, 1, 33, '000868', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7581, 2, 33, 107, 1, 33, '000874', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7582, 2, 31, 95, 1, 28, '000880', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7583, 2, 31, 94, 1, 25, '000884', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7584, 1, 4, 49, 1, 2, '001168', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7585, 2, 30, 220, 1, 41, '001262', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7586, 3, 74, 220, 1, 68, '001264', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7587, 2, 30, 220, 1, 40, '001266', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7588, 1, 14, 220, 1, 10, '001267', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7589, 1, 2, 220, 1, 16, '001268', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7590, 2, 59, 220, 1, 54, '001270', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7591, 2, 35, 220, 1, 33, '001273', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7592, 3, 73, 218, 1, 66, '001274', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7593, 2, 56, 220, 1, 48, '001277', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7594, 2, 33, 80, 1, 33, '001303', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7595, 2, 23, 80, 1, 33, '001306', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7596, 2, 33, 80, 1, 33, '001309', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7597, 2, 23, 80, 1, 33, '001310', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7598, 2, 23, 80, 1, 33, '001311', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7599, 2, 23, 77, 1, 33, '001318', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7600, 2, 23, 77, 1, 33, '001320', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7601, 2, 32, 29, 1, 33, '001388(2020)', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7602, 2, 32, 29, 1, 33, '001390(2020)', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7603, 2, 35, 227, 1, 33, '001402', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7604, 2, 58, 86, 1, 51, '001406', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7605, 2, 30, 86, 1, 39, '001411', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7606, 1, 4, 50, 1, 2, '001430', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7607, 1, 10, 93, 1, 4, '00149', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7608, 2, 22, 84, 1, 33, '001539', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7609, 2, 33, 81, 1, 33, '001543', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7610, 2, 33, 81, 1, 33, '001545', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7611, 2, 33, 81, 1, 33, '001546', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7612, 2, 33, 81, 1, 33, '001548', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7613, 2, 33, 81, 1, 33, '001550', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7614, 2, 23, 81, 1, 33, '001551', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7615, 2, 31, 164, 1, 25, '001558', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7616, 1, 4, 279, 1, 2, '001565', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7617, 1, 4, 279, 1, 2, '001567', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7618, 2, 23, 260, 1, 33, '001624', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7619, 2, 34, 99, 1, 46, '002071', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7620, 2, 32, 138, 1, 33, '002159', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7621, 1, 8, 138, 1, 15, '002160', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7622, 2, 60, 138, 1, 59, '002161', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7623, 2, 27, 138, 1, 59, '002162', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7624, 2, 60, 138, 1, 59, '002162', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7625, 2, 60, 138, 1, 59, '002164', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7626, 2, 33, 158, 1, 33, '002171', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7627, 2, 34, 157, 1, 42, '002176', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7628, 2, 31, 46, 1, 25, '002482', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7629, 2, 31, 46, 1, 25, '002484', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7630, 1, 4, 46, 1, 2, '002486', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7631, 2, 34, 147, 1, 46, '002544', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7632, 2, 34, 92, 1, 42, '002553', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7633, 3, 72, 92, 1, 64, '002556', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7634, 2, 36, 93, 1, 33, '002557', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7635, 3, 72, 92, 1, 66, '002558', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7636, 2, 23, 270, 1, 35, '002576', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7637, 1, 8, 269, 1, 15, '002582', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7638, 2, 56, 269, 1, 47, '002584', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7639, 2, 34, 45, 1, 46, '0026007', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7640, 2, 31, 45, 1, 26, '002608', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7641, 1, 4, 46, 1, 2, '002736', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7642, 1, 4, 51, 1, 2, '002737', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7643, 2, 30, 53, 1, 41, '002738', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7644, 2, 33, 79, 1, 33, '002741', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7645, 2, 33, 79, 1, 33, '002742', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7646, 2, 23, 79, 1, 33, '002743', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7647, 2, 33, 79, 1, 33, '002744', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7648, 2, 33, 79, 1, 33, '002745', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7649, 2, 23, 76, 1, 33, '002746', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7650, 2, 23, 76, 1, 33, '002747', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7651, 2, 33, 76, 1, 33, '002748', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7652, 2, 23, 76, 1, 33, '002749', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7653, 2, 33, 76, 1, 33, '002750', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7654, 2, 33, 76, 1, 33, '002751', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7655, 2, 33, 76, 1, 33, '002752', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7656, 2, 23, 76, 1, 33, '002753', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7657, 2, 32, 83, 1, 33, '002754', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7658, 2, 23, 220, 1, 34, '003024', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7659, 1, 12, 18, 1, 10, '003106', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7660, 1, 12, 18, 1, 10, '003107', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7661, 1, 15, 268, 1, 8, '003112', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7662, 2, 31, 268, 1, 19, '003114', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7663, 1, 12, 264, 1, 10, '003682', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7664, 2, 31, 136, 1, 22, '003697', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7665, 3, 72, 244, 1, 64, '003738', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7666, 1, 5, 24, 1, 13, '003802', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7667, 2, 31, 23, 1, 19, '003807', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7668, 2, 31, 280, 1, 19, '003825', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7669, 1, 5, 226, 1, 15, '003847', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7670, 2, 57, 93, 1, 36, 'MXL6452DVQ', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7671, 2, 31, 93, 1, 25, 'MXL6452F2Q', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7672, 1, 15, 267, 1, 8, 'S/C8', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7673, 1, 5, 224, 1, 15, 'S/C17', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7674, 1, 8, 286, 1, 15, 'S/C18', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7675, 1, 2, 224, 1, 16, 'S/C21', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7676, 1, 2, 225, 1, 16, 'S/C22', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7677, 1, 2, 225, 1, 16, 'S/C23', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7678, 1, 2, 225, 1, 16, 'S/C24', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7679, 1, 2, 225, 1, 16, 'S/C25', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7680, 1, 2, 225, 1, 16, 'S/C26', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7681, 1, 2, 225, 1, 16, 'S/C27', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7682, 1, 2, 225, 1, 16, 'S/C28', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7683, 1, 2, 225, 1, 16, 'S/C29', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7684, 2, 31, 224, 1, 26, 'S/C40', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7685, 2, 31, 224, 1, 28, 'S/C43', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7686, 2, 30, 224, 1, 39, 'S/C97', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7687, 2, 30, 224, 1, 40, 'S/C99', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7688, 2, 34, 224, 1, 43, 'S/C108', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7689, 2, 34, 224, 1, 46, 'S/C114', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7690, 2, 56, 37, 1, 47, 'S/C115', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7691, 2, 59, 224, 1, 53, 'S/C125', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7692, 3, 72, 224, 1, 64, 'S/C136', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7693, 1, 1, 35, 1, 11, 'S/C154', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7694, 1, 1, 128, 1, 11, 'S/C160', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7695, 1, 2, 35, 1, 18, 'S/C177', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7696, 1, 17, 128, 1, 18, 'S/C180', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7697, 2, 31, 34, 1, 27, 'S/C200', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7698, 2, 31, 128, 1, 27, 'S/C202', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7699, 2, 25, 36, 1, 30, 'S/C213', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7700, 2, 52, 128, 1, 30, 'S/C215', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7701, 2, 29, 36, 1, 60, 'S/C228', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7702, 2, 46, 128, 1, 60, 'S/C230', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7703, 2, 30, 13, 1, 41, 'S/C260', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7704, 2, 30, 129, 1, 41, 'S/C264', '2 AÑOS', 'OPERATIVO', '0000-00-00'),
(7705, 1, 1, 33, 1, 11, '469', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7706, 2, 22, 120, 1, 33, '1299', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7707, 2, 31, 252, 1, 19, '000058', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7708, 2, 23, 68, 1, 33, '000132', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7709, 2, 23, 68, 1, 33, '000134', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7710, 2, 23, 68, 1, 33, '000136', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7711, 2, 33, 68, 1, 33, '000137', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7712, 2, 23, 68, 1, 33, '000138', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7713, 1, 1, 32, 1, 11, '000139', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7714, 2, 32, 119, 1, 33, '000140', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7715, 2, 31, 93, 1, 26, '000174', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7716, 1, 1, 116, 1, 11, '000182', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7717, 1, 1, 116, 1, 11, '000183', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7718, 2, 34, 109, 1, 41, '000189', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7719, 3, 74, 109, 1, 67, '000218', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7720, 3, 74, 256, 1, 67, '000418', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7721, 2, 31, 285, 1, 21, '000460', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7722, 2, 33, 68, 1, 33, '000461', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7723, 2, 23, 68, 1, 33, '000462', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7724, 2, 23, 68, 1, 33, '000463', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7725, 2, 34, 68, 1, 41, '000464', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7726, 2, 23, 31, 1, 33, '000469', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7727, 2, 34, 219, 1, 46, '001253', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7728, 2, 58, 220, 1, 49, '001259', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7729, 2, 31, 220, 1, 26, '001260', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7730, 2, 34, 220, 1, 41, '001271', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7731, 2, 31, 220, 1, 22, '001278', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7732, 1, 1, 42, 1, 11, '001284', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7733, 2, 58, 226, 1, 51, '001391', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7734, 2, 35, 55, 1, 33, '001462', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7735, 2, 30, 55, 1, 39, '001468', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7736, 2, 34, 57, 1, 41, '001470', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7737, 2, 39, 149, 1, 36, '001478', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7738, 2, 30, 145, 1, 37, '001480', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7739, 2, 30, 145, 1, 37, '001481', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7740, 2, 30, 145, 1, 37, '001482', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7741, 2, 35, 145, 1, 33, '001483', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7742, 2, 26, 145, 1, 41, '001485', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7743, 2, 30, 145, 1, 37, '001486', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7744, 2, 62, 149, 1, 36, '001487', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7745, 2, 30, 145, 1, 37, '001488', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7746, 2, 30, 164, 1, 37, '001490', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7747, 2, 30, 164, 1, 36, '001491', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7748, 2, 30, 164, 1, 37, '001492', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7749, 2, 62, 156, 1, 36, '001495', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7750, 2, 30, 164, 1, 37, '001496', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7751, 2, 30, 164, 1, 37, '001557', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7752, 2, 42, 156, 1, 36, '001560', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7753, 2, 30, 164, 1, 37, '001561', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7754, 2, 43, 146, 1, 31, '001562', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7755, 1, 5, 137, 1, 13, '001564', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7756, 2, 33, 160, 1, 33, '002175', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7757, 1, 9, 43, 1, 18, '002501', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7758, 1, 9, 43, 1, 18, '002503', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7759, 2, 30, 147, 1, 36, '002547', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7760, 1, 14, 269, 1, 10, '002579', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7761, 1, 8, 253, 1, 15, '002585', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7762, 2, 31, 246, 1, 19, '002586', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7763, 3, 74, 253, 1, 67, '002587', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7764, 1, 5, 152, 1, 15, '002589', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7765, 1, 6, 152, 1, 12, '002590', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7766, 1, 1, 152, 1, 11, '002591', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7767, 1, 2, 152, 1, 17, '002592', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7768, 2, 30, 152, 1, 38, '002593', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7769, 2, 59, 152, 1, 54, '002594', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7770, 1, 17, 152, 1, 18, '002595', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7771, 2, 31, 152, 1, 24, '002596', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7772, 1, 1, 152, 1, 11, '002597', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7773, 2, 31, 152, 1, 20, '002599', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7774, 1, 15, 152, 1, 8, '002601', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7775, 2, 41, 152, 1, 60, '002602', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7776, 2, 22, 152, 1, 33, '002603', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7777, 2, 55, 57, 1, 33, '002612', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7778, 2, 34, 57, 1, 43, '002613', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7779, 2, 30, 57, 1, 37, '002614', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7780, 1, 5, 57, 1, 15, '002615', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7781, 2, 31, 57, 1, 26, '002616', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7782, 2, 30, 57, 1, 37, '002617', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7783, 2, 30, 57, 1, 41, '002618', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7784, 2, 30, 57, 1, 37, '002620', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7785, 2, 62, 57, 1, 36, '002621', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7786, 2, 49, 57, 1, 48, '002623', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7787, 2, 31, 40, 1, 26, '002683', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7788, 1, 2, 40, 1, 18, '002684', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7789, 1, 5, 40, 1, 15, '002685', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7790, 2, 22, 40, 1, 33, '002686', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7791, 1, 1, 40, 1, 11, '002687', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7792, 3, 72, 40, 1, 64, '002688', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7793, 1, 4, 41, 1, 1, '002699', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7794, 2, 65, 41, 1, 29, '002700', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7795, 2, 31, 41, 1, 27, '002701', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7796, 2, 59, 41, 1, 56, '002702', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7797, 2, 22, 41, 1, 33, '002703', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7798, 2, 34, 41, 1, 43, '002704', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7799, 2, 59, 150, 1, 54, '002707', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7800, 2, 34, 150, 1, 43, '002708', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7801, 2, 34, 132, 1, 41, '002718', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7802, 1, 6, 118, 1, 11, '003004', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7803, 2, 32, 117, 1, 33, '003005', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7804, 1, 1, 273, 1, 11, '003434', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7805, 1, 1, 273, 1, 11, '003436', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7806, 2, 22, 272, 1, 33, '003437', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7807, 2, 22, 230, 1, 33, '003467', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7808, 2, 31, 105, 1, 19, '003499', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7809, 2, 48, 162, 1, 31, '003501', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7810, 1, 8, 162, 1, 16, '003502', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7811, 2, 31, 162, 1, 19, '003503', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7812, 2, 51, 162, 1, 30, '003504', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7813, 1, 17, 162, 1, 18, '003505', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7814, 2, 50, 162, 1, 60, '003506', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7815, 2, 59, 162, 1, 54, '003507', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7816, 2, 23, 162, 1, 35, '003508', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7817, 2, 58, 162, 1, 50, '003509', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7818, 3, 73, 162, 1, 67, '003511', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7819, 2, 31, 162, 1, 27, '003512', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7820, 3, 73, 162, 1, 67, '003513', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7821, 2, 34, 162, 1, 47, '003514', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7822, 2, 31, 162, 1, 22, '003515', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7823, 2, 54, 245, 1, 31, '003516', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7824, 3, 74, 251, 1, 67, '003517', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7825, 3, 73, 148, 1, 67, '003519', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7826, 1, 7, 148, 1, 10, '003520', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7827, 1, 20, 141, 1, 18, '003521', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7828, 2, 51, 141, 1, 30, '003523', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7829, 2, 66, 141, 1, 60, '003524', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7830, 2, 22, 148, 1, 33, '003525', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7831, 1, 1, 141, 1, 11, '003526', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7832, 2, 31, 141, 1, 27, '003527', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7833, 1, 1, 141, 1, 11, '003528', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7834, 2, 31, 148, 1, 22, '003530', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7835, 2, 34, 148, 1, 47, '003530', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7836, 1, 8, 148, 1, 16, '003531', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7837, 2, 22, 210, 1, 33, '003546', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7838, 1, 1, 209, 1, 11, '003547', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7839, 1, 1, 209, 1, 11, '003548', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7840, 1, 1, 209, 1, 11, '003549', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7841, 1, 1, 209, 1, 11, '003550', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7842, 2, 31, 8, 1, 25, '003572', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7843, 2, 31, 8, 1, 19, '003573', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7844, 2, 58, 8, 1, 50, '003574', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7845, 1, 12, 275, 1, 11, '003599', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7846, 2, 52, 174, 1, 30, '003600', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7847, 2, 31, 174, 1, 27, '003601', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7848, 2, 31, 243, 1, 22, '003649', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7849, 1, 17, 243, 1, 18, '003650', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7850, 1, 1, 243, 1, 11, '003651', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7851, 1, 12, 249, 1, 11, '003686', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7852, 2, 34, 271, 1, 43, '003687', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7853, 1, 1, 249, 1, 11, '003688', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7854, 2, 56, 254, 1, 47, '003689', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7855, 2, 56, 254, 1, 47, '003690', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7856, 2, 56, 254, 1, 47, '003691', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7857, 1, 12, 249, 1, 11, '003692', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7858, 1, 1, 249, 1, 11, '003694', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7859, 2, 23, 19, 1, 35, '003709', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7860, 1, 7, 259, 1, 10, '003727', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7861, 2, 23, 148, 1, 35, '003729', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7862, 2, 34, 28, 1, 41, '003803', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7863, 2, 58, 23, 1, 50, '003805', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7864, 1, 1, 248, 1, 11, '003810', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7865, 1, 12, 248, 1, 11, '003814', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7866, 1, 4, 248, 1, 1, '003815', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7867, 2, 30, 130, 1, 41, '003818', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7868, 2, 30, 130, 1, 41, '003819', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7869, 2, 30, 130, 1, 41, '003820', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7870, 2, 66, 130, 1, 60, '003821', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7871, 2, 30, 130, 1, 41, '003822', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7872, 3, 74, 108, 1, 68, '003837', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7873, 2, 56, 108, 1, 48, '003838', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7874, 2, 56, 108, 1, 47, '003839', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7875, 1, 5, 108, 1, 15, '003840', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7876, 3, 74, 2, 1, 68, '003844', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7877, 2, 56, 2, 1, 48, '003845', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7878, 1, 5, 2, 1, 15, '003847', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7879, 3, 74, 4, 1, 68, '003850', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7880, 2, 22, 152, 1, 33, '2600', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7881, 3, 73, 243, 1, 67, 'R52TA04760M', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7882, 1, 7, 60, 1, 10, 'S/C9', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7883, 1, 8, 59, 1, 16, 'S/C19', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7884, 2, 31, 59, 1, 22, 'S/C33', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7885, 2, 31, 196, 1, 22, 'S/C35', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7886, 2, 31, 286, 1, 26, 'S/C41', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7887, 2, 48, 59, 1, 31, 'S/C44', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7888, 2, 22, 59, 1, 33, 'S/C53', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7889, 2, 22, 59, 1, 33, 'S/C54', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7890, 2, 33, 286, 1, 33, 'S/C74', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7891, 2, 23, 59, 1, 34, 'S/C75', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7892, 2, 23, 59, 1, 35, 'S/C78', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7893, 2, 30, 59, 1, 41, 'S/C102', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7894, 2, 34, 57, 1, 45, 'S/C110', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7895, 2, 34, 59, 1, 47, 'S/C116', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7896, 2, 58, 59, 1, 51, 'S/C121', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7897, 2, 59, 59, 1, 54, 'S/C126', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7898, 3, 72, 211, 1, 64, 'S/C135', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7899, 3, 73, 59, 1, 67, 'S/C138', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7900, 3, 73, 59, 1, 67, 'S/C139', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7901, 1, 4, 58, 1, 1, 'S/C145', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7902, 1, 15, 58, 1, 9, 'S/C150', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7903, 1, 1, 273, 1, 11, 'S/C170', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7904, 1, 5, 58, 1, 14, 'S/C175', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7905, 1, 2, 58, 1, 18, 'S/C178', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7906, 2, 31, 58, 1, 24, 'S/C193', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7907, 2, 51, 58, 1, 30, 'S/C214', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7908, 2, 58, 58, 1, 52, 'S/C220', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7909, 2, 59, 58, 1, 55, 'S/C222', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7910, 2, 59, 58, 1, 56, 'S/C224', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7911, 2, 66, 58, 1, 60, 'S/C229', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7912, 3, 76, 58, 1, 61, 'S/C236', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7913, 3, 76, 58, 1, 63, 'S/C240', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7914, 3, 74, 270, 1, 67, 'Y93DT09ETSCG', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7915, 2, 30, 15, 1, 41, 'S/C261', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7916, 2, 30, 243, 1, 41, 'S/C265', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7917, 2, 30, 271, 1, 41, 'S/C266', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7918, 2, 56, 205, 1, 47, 'S/C267', '3 AÑOS', 'OPERATIVO', '0000-00-00'),
(7919, 1, 1, 21, 1, 11, '000533', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7920, 1, 7, 102, 1, 10, '003408', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7921, 2, 34, 102, 1, 43, '003409', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7922, 2, 31, 102, 1, 22, '003410', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7923, 1, 6, 102, 1, 12, '003411', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7924, 2, 31, 102, 1, 27, '003412', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7925, 3, 73, 102, 1, 67, '003413', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7926, 1, 2, 102, 1, 16, '003414', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7927, 2, 56, 102, 1, 47, '003415', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7928, 2, 41, 102, 1, 60, '003416', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7929, 2, 52, 102, 1, 30, '003417', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7930, 2, 23, 217, 1, 35, '003438', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7931, 1, 6, 217, 1, 12, '003439', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7932, 2, 34, 217, 1, 43, '003440', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7933, 1, 5, 216, 1, 15, '003441', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7934, 1, 20, 217, 1, 18, '003442', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7935, 1, 1, 230, 1, 11, '003466', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7936, 1, 2, 217, 1, 18, '003816', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7937, 3, 72, 217, 1, 65, '003817', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7938, 2, 63, 220, 1, 57, '003865', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7939, 2, 31, 220, 1, 24, '003866', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7940, 2, 31, 220, 1, 20, '003867', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7941, 2, 49, 220, 1, 49, '003868', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7942, 2, 63, 220, 1, 58, '003869', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7943, 1, 4, 185, 1, 2, '003881', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7944, 1, 4, 185, 1, 2, '003882', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7945, 1, 4, 185, 1, 2, '003883', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7946, 1, 4, 185, 1, 2, '003884', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7947, 1, 4, 185, 1, 2, '003885', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7948, 1, 4, 185, 1, 2, '003886', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7949, 2, 31, 184, 1, 25, '003898', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7950, 1, 4, 220, 1, 1, 'BCC342E3D9A6', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7951, 1, 4, 186, 1, 2, 'S/C148', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7952, 1, 4, 186, 1, 2, 'S/C149', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7953, 1, 1, 220, 1, 11, 'S/C166', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7954, 1, 1, 222, 1, 11, 'S/C167', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7955, 1, 1, 222, 1, 11, 'S/C168', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7956, 1, 2, 186, 1, 18, 'S/C182', '4 AÑOS', 'OPERATIVO', '0000-00-00'),
(7957, 1, 6, 70, 1, 11, '133', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7958, 1, 6, 70, 1, 11, '135', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7959, 1, 21, 72, 1, 11, '442', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7960, 1, 1, 72, 1, 11, '445', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7961, 1, 1, 72, 1, 11, '446', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7962, 1, 18, 73, 1, 11, '447', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7963, 1, 1, 73, 1, 11, '450', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7964, 1, 1, 73, 1, 11, '451', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7965, 1, 1, 73, 1, 11, '452', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7966, 1, 1, 73, 1, 11, '453', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7967, 1, 1, 73, 1, 11, '454', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7968, 1, 1, 73, 1, 11, '455', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7969, 1, 1, 73, 1, 11, '456', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7970, 1, 1, 73, 1, 11, '457', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7971, 1, 1, 82, 1, 11, '458', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7972, 1, 6, 69, 1, 11, '465', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7973, 1, 6, 69, 1, 11, '466', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7974, 1, 6, 69, 1, 11, '467', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7975, 1, 6, 69, 1, 11, '468', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7976, 1, 1, 73, 1, 11, '1301', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7977, 1, 18, 73, 1, 11, '1302', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7978, 1, 6, 73, 1, 11, '1304', 'sin vida', 'OPERATIVO', '0000-00-00');
INSERT INTO `detalle_asignacion` (`id_detalle_asignacion`, `idsedes`, `idoficinas`, `idequipos`, `idusuario`, `idempleado`, `cod_patrimonial`, `vida_util`, `estado`, `fecha_asignacion`) VALUES
(7979, 1, 6, 73, 1, 11, '1305', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7980, 1, 6, 73, 1, 11, '1307', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7981, 1, 6, 73, 1, 11, '1308', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7982, 1, 6, 73, 1, 11, '1312', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7983, 1, 1, 73, 1, 11, '1313', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7984, 1, 1, 73, 1, 11, '1314', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7985, 1, 6, 73, 1, 11, '1315', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7986, 1, 1, 73, 1, 11, '1316', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7987, 1, 6, 72, 1, 11, '1317', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7988, 1, 1, 71, 1, 11, '1319', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7989, 1, 6, 71, 1, 11, '1321', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7990, 1, 6, 71, 1, 11, '1322', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7991, 1, 1, 71, 1, 11, '1323', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7992, 1, 1, 71, 1, 11, '1324', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7993, 1, 6, 71, 1, 11, '1325', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7994, 1, 1, 74, 1, 11, '1541', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7995, 1, 1, 74, 1, 11, '1542', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7996, 1, 1, 74, 1, 11, '1544', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7997, 1, 1, 74, 1, 11, '1547', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7998, 1, 1, 74, 1, 11, '1549', 'sin vida', 'OPERATIVO', '0000-00-00'),
(7999, 1, 1, 74, 1, 11, '1552', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8000, 1, 1, 74, 1, 11, '1553', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8001, 1, 1, 74, 1, 11, '1554', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8002, 1, 1, 74, 1, 11, '1555', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8003, 1, 1, 74, 1, 11, '1556', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8004, 1, 6, 274, 1, 11, '2210', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8005, 1, 1, 85, 1, 11, '000046', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8006, 1, 6, 281, 1, 12, '000056', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8007, 1, 6, 281, 1, 12, '000057', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8008, 3, 72, 133, 1, 63, '000077', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8009, 3, 72, 255, 1, 65, '000083', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8010, 2, 23, 233, 1, 33, '000130', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8011, 1, 7, 87, 1, 9, '000144', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8012, 3, 76, 87, 1, 62, '000148', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8013, 2, 31, 87, 1, 18, '000160', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8014, 1, 9, 89, 1, 18, '000165', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8015, 1, 6, 90, 1, 12, '000175', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8016, 3, 74, 87, 1, 69, '000178', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8017, 2, 31, 87, 1, 24, '000179', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8018, 1, 1, 11, 1, 11, '000180', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8019, 3, 76, 110, 1, 62, '000185', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8020, 1, 1, 109, 1, 11, '000192', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8021, 2, 31, 109, 1, 18, '000206', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8022, 2, 63, 109, 1, 58, '000212', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8023, 2, 31, 109, 1, 18, '000216', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8024, 3, 74, 109, 1, 69, '000217', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8025, 3, 82, 109, 1, 69, '000222', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8026, 1, 5, 109, 1, 14, '000376', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8027, 1, 1, 256, 1, 11, '000419', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8028, 1, 1, 182, 1, 11, '000430', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8029, 1, 3, 285, 1, 12, '000459', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8030, 2, 58, 193, 1, 49, '000485', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8031, 3, 72, 193, 1, 65, '000486', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8032, 2, 22, 193, 1, 32, '000489', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8033, 2, 31, 193, 1, 24, '000493', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8034, 1, 5, 193, 1, 14, '000494', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8035, 2, 31, 193, 1, 24, '000495', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8036, 2, 69, 193, 1, 56, '000496', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8037, 1, 9, 193, 1, 18, '000498', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8038, 1, 1, 193, 1, 11, '000500', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8039, 1, 6, 193, 1, 12, '000501', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8040, 1, 5, 193, 1, 12, '000503', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8041, 1, 4, 193, 1, 1, '000504', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8042, 1, 1, 281, 1, 11, '000532', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8043, 3, 75, 277, 1, 69, '000534', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8044, 3, 72, 10, 1, 65, '000536', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8045, 1, 1, 10, 1, 11, '000537', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8046, 1, 4, 10, 1, 1, '000539', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8047, 1, 1, 10, 1, 11, '000540', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8048, 1, 5, 10, 1, 14, '000544', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8049, 1, 1, 10, 1, 11, '000545', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8050, 1, 1, 10, 1, 11, '000549', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8051, 1, 1, 231, 1, 11, '000586', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8052, 1, 1, 281, 1, 11, '000626', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8053, 1, 6, 281, 1, 12, '000628', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8054, 1, 1, 39, 1, 11, '000630', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8055, 1, 6, 39, 1, 12, '000631', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8056, 1, 1, 10, 1, 11, '000852', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8057, 2, 31, 10, 1, 24, '000860', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8058, 1, 1, 10, 1, 11, '000861', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8059, 2, 63, 10, 1, 58, '000864', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8060, 3, 75, 101, 1, 69, '000870', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8061, 1, 9, 101, 1, 18, '000871', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8062, 1, 7, 101, 1, 9, '000872', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8063, 3, 75, 101, 1, 69, '000873', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8064, 2, 31, 109, 1, 18, '000877', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8065, 1, 9, 109, 1, 18, '000879', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8066, 2, 63, 91, 1, 58, '000881', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8067, 3, 72, 90, 1, 65, '000882', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8068, 1, 1, 90, 1, 11, '000883', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8069, 1, 5, 91, 1, 14, '000885', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8070, 1, 1, 258, 1, 11, '000909', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8071, 1, 1, 258, 1, 11, '000910', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8072, 1, 1, 48, 1, 11, '001169', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8073, 1, 1, 215, 1, 11, '001251', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8074, 1, 1, 221, 1, 11, '001253', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8075, 3, 76, 220, 1, 61, '001254', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8076, 2, 64, 220, 1, 60, '001255', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8077, 2, 22, 220, 1, 32, '001256', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8078, 3, 75, 220, 1, 69, '001257', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8079, 2, 25, 220, 1, 29, '001261', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8080, 3, 76, 220, 1, 62, '001265', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8081, 2, 31, 220, 1, 27, '001269', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8082, 3, 77, 220, 1, 69, '001272', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8083, 1, 9, 214, 1, 18, '001275', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8084, 1, 7, 220, 1, 9, '001276', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8085, 2, 53, 220, 1, 30, '001279', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8086, 2, 59, 220, 1, 55, '001280', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8087, 1, 6, 214, 1, 12, '001281', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8088, 2, 31, 220, 1, 24, '001282', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8089, 2, 63, 220, 1, 56, '001283', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8090, 1, 4, 98, 1, 1, '001285', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8091, 1, 6, 85, 1, 11, '001300', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8092, 1, 9, 65, 1, 18, '001326', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8093, 1, 5, 154, 1, 12, '001381', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8094, 1, 1, 154, 1, 11, '001384', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8095, 1, 1, 154, 1, 11, '001386', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8096, 1, 6, 226, 1, 12, '001390', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8097, 1, 1, 226, 1, 11, '001395', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8098, 2, 31, 226, 1, 20, '001395', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8099, 2, 58, 226, 1, 49, '001396', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8100, 3, 76, 226, 1, 63, '001397', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8101, 2, 58, 226, 1, 52, '001399', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8102, 2, 31, 226, 1, 24, '001400', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8103, 3, 80, 226, 1, 69, '001401', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8104, 1, 5, 226, 1, 14, '001403', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8105, 3, 77, 86, 1, 69, '001404', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8106, 1, 5, 86, 1, 12, '001405', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8107, 3, 80, 86, 1, 69, '001408', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8108, 1, 9, 86, 1, 18, '001409', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8109, 2, 31, 86, 1, 20, '001410', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8110, 1, 1, 86, 1, 11, '001412', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8111, 1, 1, 86, 1, 11, '001413', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8112, 1, 9, 263, 1, 18, '001417', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8113, 1, 1, 263, 1, 11, '001418', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8114, 1, 9, 52, 1, 18, '001419', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8115, 1, 1, 263, 1, 11, '001422', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8116, 1, 1, 263, 1, 11, '001426', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8117, 1, 1, 263, 1, 11, '001429', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8118, 1, 1, 229, 1, 11, '001443', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8119, 1, 1, 229, 1, 11, '001444', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8120, 1, 3, 228, 1, 12, '001445', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8121, 2, 31, 204, 1, 27, '001446', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8122, 3, 74, 204, 1, 69, '001449', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8123, 3, 80, 204, 1, 69, '001451', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8124, 2, 31, 204, 1, 20, '001454', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8125, 3, 76, 204, 1, 62, '001455', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8126, 2, 59, 204, 1, 52, '001459', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8127, 1, 1, 55, 1, 11, '001461', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8128, 2, 31, 54, 1, 27, '001463', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8129, 3, 77, 55, 1, 69, '001464', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8130, 3, 74, 55, 1, 69, '001467', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8131, 1, 6, 55, 1, 12, '001469', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8132, 2, 59, 91, 1, 55, '001473', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8133, 2, 49, 91, 1, 49, '001474', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8134, 1, 1, 91, 1, 11, '001475', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8135, 3, 76, 91, 1, 63, '001476', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8136, 2, 31, 91, 1, 24, '001477', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8137, 3, 76, 140, 1, 61, '001479', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8138, 1, 1, 164, 1, 11, '001493', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8139, 3, 79, 164, 1, 69, '001494', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8140, 1, 15, 164, 1, 9, '001498', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8141, 3, 76, 164, 1, 61, '001500', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8142, 2, 59, 164, 1, 55, '001501', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8143, 2, 59, 121, 1, 55, '001522', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8144, 3, 77, 125, 1, 69, '001526', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8145, 3, 76, 179, 1, 61, '001529', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8146, 1, 1, 85, 1, 11, '001540', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8147, 2, 25, 175, 1, 29, '001557', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8148, 2, 31, 164, 1, 24, '001559', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8149, 1, 1, 176, 1, 11, '001563', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8150, 3, 72, 278, 1, 69, '001566', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8151, 1, 1, 22, 1, 11, '001568', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8152, 1, 4, 212, 1, 1, '001569', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8153, 2, 31, 212, 1, 27, '001570', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8154, 1, 1, 164, 1, 11, '001669', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8155, 1, 7, 10, 1, 9, '001729', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8156, 2, 64, 10, 1, 60, '001730', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8157, 3, 76, 10, 1, 61, '001732', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8158, 1, 9, 10, 1, 18, '001735', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8159, 2, 31, 12, 1, 18, '001738', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8160, 3, 79, 104, 1, 69, '001919', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8161, 2, 31, 134, 1, 27, '001941', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8162, 1, 1, 96, 1, 11, '002069', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8163, 3, 61, 99, 1, 60, '002070', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8164, 1, 7, 97, 1, 9, '002072', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8165, 2, 31, 99, 1, 27, '002073', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8166, 3, 83, 261, 1, 69, '002145', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8167, 3, 85, 262, 1, 69, '002146', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8168, 3, 77, 262, 1, 69, '002149', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8169, 2, 22, 139, 1, 32, '002163', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8170, 2, 31, 155, 1, 24, '002169', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8171, 3, 72, 158, 1, 65, '002170', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8172, 1, 5, 158, 1, 12, '002173', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8173, 3, 74, 159, 1, 69, '002179', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8174, 2, 31, 274, 1, 18, '002209', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8175, 1, 5, 274, 1, 12, '002211', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8176, 1, 9, 47, 1, 18, '002480', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8177, 2, 31, 47, 1, 18, '002483', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8178, 1, 9, 47, 1, 18, '002485', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8179, 3, 74, 142, 1, 69, '002546', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8180, 2, 58, 142, 1, 52, '002548', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8181, 1, 1, 140, 1, 11, '002552', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8182, 1, 1, 88, 1, 11, '002554', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8183, 1, 3, 281, 1, 12, '002578', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8184, 2, 31, 247, 1, 27, '002588', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8185, 1, 1, 153, 1, 11, '002604', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8186, 1, 4, 45, 1, 1, '002605', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8187, 2, 31, 45, 1, 27, '002606', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8188, 2, 47, 57, 1, 30, '002622', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8189, 1, 4, 143, 1, 1, '002705', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8190, 2, 59, 143, 1, 56, '002706', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8191, 2, 67, 143, 1, 29, '002709', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8192, 2, 31, 143, 1, 27, '002710', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8193, 2, 22, 7, 1, 33, '002756', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8194, 2, 23, 7, 1, 33, '002757', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8195, 2, 47, 131, 1, 30, '002888', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8196, 1, 1, 183, 1, 11, '002889', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8197, 2, 31, 220, 1, 24, '003025', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8198, 1, 1, 121, 1, 11, '003263', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8199, 2, 63, 121, 1, 58, '003264', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8200, 3, 74, 121, 1, 69, '003266', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8201, 1, 7, 125, 1, 9, '003290', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8202, 1, 1, 10, 1, 11, '003299', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8203, 2, 31, 10, 1, 24, '003302', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8204, 2, 63, 10, 1, 56, '003303', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8205, 2, 47, 44, 1, 30, '003320', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8206, 3, 81, 47, 1, 69, '003393', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8207, 3, 77, 282, 1, 69, '003398', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8208, 2, 31, 175, 1, 27, '003533', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8209, 1, 1, 265, 1, 11, '003535', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8210, 1, 9, 175, 1, 18, '003538', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8211, 2, 31, 135, 1, 24, '003551', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8212, 2, 56, 8, 1, 47, '003575', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8213, 2, 31, 26, 1, 24, '003800', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8214, 1, 1, 26, 1, 11, '003801', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8215, 2, 31, 27, 1, 24, '003806', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8216, 1, 1, 25, 1, 11, '003808', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8217, 2, 31, 108, 1, 24, '003839', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8218, 1, 1, 108, 1, 11, '003841', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8219, 3, 76, 100, 1, 61, '003843', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8220, 2, 31, 1, 1, 24, '003846', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8221, 2, 53, 4, 1, 30, '003851', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8222, 2, 31, 4, 1, 24, '003853', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8223, 1, 1, 20, 1, 11, '003871', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8224, 1, 7, 283, 1, 9, '003918', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8225, 1, 6, 56, 1, 11, '01168-2021', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8226, 1, 9, 10, 1, 18, '2538-2020', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8227, 1, 9, 163, 1, 18, '2862-2021', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8228, 2, 31, 214, 1, 18, 'BCC342E3D98A', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8229, 1, 12, 242, 1, 10, 'S/C13', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8230, 1, 2, 240, 1, 16, 'S/C30', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8231, 2, 31, 238, 1, 19, 'S/C32', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8232, 2, 31, 242, 1, 22, 'S/C36', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8233, 2, 30, 127, 1, 41, 'S/C103', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8234, 2, 56, 242, 1, 47, 'S/C118', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8235, 3, 74, 242, 1, 67, 'S/C143', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8236, 1, 4, 191, 1, 1, 'S/C146', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8237, 1, 4, 241, 1, 1, 'S/C147', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8238, 1, 7, 191, 1, 9, 'S/C151', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8239, 1, 7, 241, 1, 9, 'S/C152', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8240, 1, 1, 27, 1, 11, 'S/C153', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8241, 1, 1, 63, 1, 11, 'S/C155', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8242, 1, 1, 75, 1, 11, 'S/C156', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8243, 1, 1, 75, 1, 11, 'S/C157', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8244, 1, 1, 75, 1, 11, 'S/C158', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8245, 1, 1, 75, 1, 11, 'S/C159', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8246, 1, 1, 172, 1, 11, 'S/C161', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8247, 1, 1, 204, 1, 11, 'S/C162', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8248, 1, 1, 204, 1, 11, 'S/C163', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8249, 1, 1, 204, 1, 11, 'S/C164', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8250, 1, 1, 204, 1, 11, 'S/C165', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8251, 1, 1, 223, 1, 11, 'S/C169', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8252, 1, 6, 188, 1, 12, 'S/C171', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8253, 1, 5, 191, 1, 12, 'S/C172', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8254, 1, 5, 201, 1, 12, 'S/C173', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8255, 1, 6, 223, 1, 12, 'S/C174', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8256, 1, 5, 201, 1, 14, 'S/C176', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8257, 2, 31, 114, 1, 18, 'S/C179', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8258, 1, 9, 172, 1, 18, 'S/C181', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8259, 2, 31, 197, 1, 18, 'S/C184', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8260, 1, 9, 235, 1, 18, 'S/C185', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8261, 1, 9, 235, 1, 18, 'S/C186', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8262, 1, 9, 235, 1, 18, 'S/C187', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8263, 1, 9, 235, 1, 18, 'S/C188', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8264, 1, 9, 241, 1, 18, 'S/C189', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8265, 1, 9, 276, 1, 18, 'S/C190', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8266, 1, 19, 286, 1, 18, 'S/C191', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8267, 2, 31, 172, 1, 20, 'S/C192', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8268, 2, 31, 191, 1, 24, 'S/C195', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8269, 2, 31, 191, 1, 24, 'S/C196', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8270, 2, 31, 201, 1, 24, 'S/C197', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8271, 2, 31, 241, 1, 24, 'S/C198', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8272, 2, 31, 286, 1, 24, 'S/C199', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8273, 2, 31, 64, 1, 27, 'S/C201', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8274, 2, 31, 172, 1, 27, 'S/C203', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8275, 2, 31, 201, 1, 27, 'S/C205', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8276, 2, 31, 223, 1, 27, 'S/C206', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8277, 2, 31, 239, 1, 27, 'S/C207', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8278, 2, 31, 286, 1, 27, 'S/C208', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8279, 2, 31, 286, 1, 27, 'S/C209', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8280, 2, 25, 114, 1, 29, 'S/C210', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8281, 2, 25, 223, 1, 29, 'S/C211', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8282, 2, 25, 241, 1, 29, 'S/C212', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8283, 2, 53, 180, 1, 30, 'S/C216', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8284, 2, 58, 191, 1, 49, 'S/C218', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8285, 2, 58, 223, 1, 49, 'S/C219', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8286, 2, 59, 191, 1, 52, 'S/C221', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8287, 2, 59, 114, 1, 55, 'S/C223', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8288, 2, 40, 201, 1, 56, 'S/C225', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8289, 2, 63, 191, 1, 58, 'S/C226', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8290, 2, 27, 223, 1, 58, 'S/C227', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8291, 2, 64, 175, 1, 60, 'S/C231', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8292, 2, 64, 172, 1, 60, 'S/C232', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8293, 2, 61, 241, 1, 60, 'S/C234', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8294, 3, 76, 250, 1, 60, 'S/C235', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8295, 3, 76, 172, 1, 61, 'S/C237', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8296, 3, 76, 172, 1, 62, 'S/C238', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8297, 3, 76, 223, 1, 62, 'S/C239', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8298, 3, 72, 114, 1, 63, 'S/C241', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8299, 3, 72, 203, 1, 63, 'S/C242', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8300, 3, 72, 201, 1, 65, 'S/C243', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8301, 3, 74, 63, 1, 69, 'S/C244', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8302, 3, 74, 114, 1, 69, 'S/C245', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8303, 3, 77, 172, 1, 69, 'S/C246', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8304, 3, 84, 191, 1, 69, 'S/C247', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8305, 3, 75, 191, 1, 69, 'S/C248', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8306, 3, 77, 201, 1, 69, 'S/C249', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8307, 3, 74, 223, 1, 69, 'S/C250', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8308, 3, 79, 285, 1, 69, 'S/C251', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8309, 1, 1, 241, 1, 11, 'S/C252', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8310, 1, 1, 286, 1, 11, 'S/C253', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8311, 1, 1, 286, 1, 11, 'S/C254', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8312, 1, 8, 241, 1, 15, 'S/C255', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8313, 2, 31, 232, 1, 23, 'S/C257', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8314, 2, 31, 238, 1, 23, 'S/C258', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8315, 2, 48, 241, 1, 30, 'S/C259', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8316, 3, 76, 284, 1, 60, 'S/C269', 'sin vida', 'OPERATIVO', '0000-00-00'),
(8317, 1, 2, 237, 1, 17, 'S/C256', 'sin vida', 'sin estado', '0000-00-00'),
(8318, 2, 58, 236, 1, 49, 'S/C268', 'sin vida', 'sin estado', '0000-00-00'),
(8319, 3, 79, 3, 1, 11, '2012012', '2', 'INOPERATIVO', '2024-05-24'),
(8321, 2, 27, 3, 1, 2, '8548548548ca', '2años', 'OPERATIVO', '2024-05-23');

--
-- Disparadores `detalle_asignacion`
--
DROP TRIGGER IF EXISTS `after_detalle_asignacion_delete`;
DELIMITER $$
CREATE TRIGGER `after_detalle_asignacion_delete` AFTER DELETE ON `detalle_asignacion` FOR EACH ROW BEGIN
    INSERT INTO historial_asignacion (id_detalle_asignacion, idsedes, idoficinas, idequipos, idusuario, idempleado, cod_patrimonial, vida_util, estado, fecha_asignacion, accion)
    VALUES (OLD.id_detalle_asignacion, OLD.idsedes, OLD.idoficinas, OLD.idequipos, OLD.idusuario, OLD.idempleado, OLD.cod_patrimonial, OLD.vida_util, 'eliminado', OLD.fecha_asignacion, 'DELETE');
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_detalle_asignacion_insert`;
DELIMITER $$
CREATE TRIGGER `after_detalle_asignacion_insert` AFTER INSERT ON `detalle_asignacion` FOR EACH ROW BEGIN
    INSERT INTO historial_asignacion (id_detalle_asignacion, idsedes, idoficinas, idequipos, idusuario, idempleado, cod_patrimonial, vida_util, estado, fecha_asignacion, accion)
    VALUES (NEW.id_detalle_asignacion, NEW.idsedes, NEW.idoficinas, NEW.idequipos, NEW.idusuario, NEW.idempleado, NEW.cod_patrimonial, NEW.vida_util, NEW.estado, NEW.fecha_asignacion, 'INSERT');
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_detalle_asignacion_update`;
DELIMITER $$
CREATE TRIGGER `after_detalle_asignacion_update` AFTER UPDATE ON `detalle_asignacion` FOR EACH ROW BEGIN
    INSERT INTO historial_asignacion (id_detalle_asignacion, idsedes, idoficinas, idequipos, idusuario, idempleado, cod_patrimonial, vida_util, estado, fecha_asignacion, accion)
    VALUES (OLD.id_detalle_asignacion, OLD.idsedes, OLD.idoficinas, OLD.idequipos, OLD.idusuario, OLD.idempleado, OLD.cod_patrimonial, OLD.vida_util, 'actualizado', OLD.fecha_asignacion, 'UPDATE');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `idempleado` int(11) NOT NULL,
  `nombres` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idempleado`, `nombres`) VALUES
(1, 'ABEL HUARANGA'),
(2, 'ACADÉMICA'),
(3, 'AULA 02'),
(4, 'AULA 03'),
(5, 'AULA 04'),
(6, 'AULA 05'),
(7, 'AULA 06'),
(8, 'BETTY SIALER'),
(9, 'BILLY FATAMA'),
(10, 'CESAR SALAS'),
(11, 'DAVID VIZCARRA'),
(12, 'DAVID YANCE'),
(13, 'DIRECCIÓN ACADÉMICA'),
(14, 'EDITH CABANILLAS'),
(15, 'EDUARDO RODRIGUEZ'),
(16, 'ESTEFANY FARIAS'),
(17, 'EX GIUSEPPE'),
(18, 'FANTASIA GUEVARA'),
(19, 'FERNANDO MORALES'),
(20, 'GERALYTH'),
(21, 'GESTIÓN DE PERSONAL'),
(22, 'GILBERTO ROMERO '),
(23, 'HILDA MAQUIAVELO'),
(24, 'IDA RODRIGUEZ'),
(25, 'INVESTIGACIÓN'),
(26, 'ISABEL PALACIO'),
(27, 'ISRAEL PONGO'),
(28, 'IVONE ACEVEDO'),
(29, 'JAHNO MONTOYA'),
(30, 'JANET CHINCHAY'),
(31, 'JOEL ANICAMA'),
(32, 'JULIO GUZMAN'),
(33, 'JULIO NEYRA'),
(34, 'KARINA MESIA'),
(35, 'KARLA DA CRUZ'),
(36, 'LABORATORIO DE COMPUTO 1'),
(37, 'LABORATORIO DE COMPUTO 2'),
(38, 'LIBRO DE RECLAMACIONES'),
(39, 'LILIANA CHAPARRO'),
(40, 'LORENA URETA'),
(41, 'LUCIA LORA'),
(42, 'LUIS ARBULU'),
(43, 'MAGALY YNOCENCIO'),
(44, 'MAQUILLAJE'),
(45, 'MARIA INÉS VARGAS'),
(46, 'MESA DE PARTES'),
(47, 'MIGUEL AGURTO'),
(48, 'NOEMI RAMOS'),
(49, 'OLIVER CAPUÑAY'),
(50, 'OSCAR'),
(51, 'OSCAR OLARTE'),
(52, 'PIERINA'),
(53, 'PSICOLOGA'),
(54, 'RENZO OVIEDO'),
(55, 'RICHARD ESCOBEDO'),
(56, 'ROCIO'),
(57, 'ROSARIO CATPO'),
(58, 'ROSY'),
(59, 'SALA DE PROFESORES'),
(60, 'SANTOS CADILLO'),
(61, 'SARA YUPANQUI'),
(62, 'SHEYLA SAVEDRA'),
(63, 'VANESSA'),
(64, 'VICTOR FLORES'),
(65, 'VIOLETA ARCILA'),
(66, 'VIRGINIA BARRETO'),
(67, 'YASMIN LOAYZA'),
(68, 'YURI CARDENAS'),
(69, 'SIN EMPLEADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

DROP TABLE IF EXISTS `equipos`;
CREATE TABLE `equipos` (
  `idequipos` int(11) NOT NULL,
  `modelo` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`idequipos`, `modelo`, `descripcion`, `fecha_registro`, `idmarca`) VALUES
(1, 'VO3760', 'CPU ', '0000-00-00', 1),
(2, 'V03760', 'DESKTOP', '0000-00-00', 1),
(3, 'ADV 5025N', 'MOUSE', '0000-00-00', 1),
(4, 'ADV 4025N', 'TECLADO', '0000-00-00', 1),
(5, 'GT-KB06CM', 'TECLADO', '0000-00-00', 1),
(6, 'GT-KB08CM', 'TECLADO', '0000-00-00', 1),
(7, 'S/M', 'GABINETE DE RED', '0000-00-00', 2),
(8, 'COMPATIBLE', 'CPU', '0000-00-00', 3),
(9, 'AS1631161432', 'UPS', '0000-00-00', 4),
(10, 'PRO 1500', 'UPS', '0000-00-00', 4),
(11, 'S/M', 'UPS', '0000-00-00', 4),
(12, 'PRO 1500', 'USP', '0000-00-00', 4),
(13, 'S/M', 'IMAC ', '0000-00-00', 5),
(14, 'A2438', 'MAC ', '0000-00-00', 5),
(15, 'S/M', 'MAC ', '0000-00-00', 5),
(16, 'S/M', 'MOUSE', '0000-00-00', 5),
(17, 'S/M', 'TECLADO', '0000-00-00', 5),
(18, 'MX 532', 'PROYECTOR', '0000-00-00', 6),
(19, 'HL-L3270CDW', 'IMPRESORA', '0000-00-00', 7),
(20, 'E550W', 'ROTULADOR', '0000-00-00', 7),
(21, 'TS3400R0804', 'NAS SERVIDOR', '0000-00-00', 8),
(22, 'DS126631', 'CAMARA FOTOGRAFICA', '0000-00-00', 9),
(23, 'R-AVR-1808I', 'ESTABILIZADOR', '0000-00-00', 10),
(24, 'R-AVR-3008I', 'ESTABILIZADOR', '0000-00-00', 10),
(25, 'AVR 1808I', 'ESTABILIZADOR ', '0000-00-00', 10),
(26, 'AVR 3008I', 'ESTABILIZADOR ', '0000-00-00', 10),
(27, 'S/M', 'ESTABILIZADOR ', '0000-00-00', 10),
(28, 'R-AVR-3008I', 'UPS', '0000-00-00', 10),
(29, '2881 ROUTER', 'ROUTER', '0000-00-00', 11),
(30, '2900 SERIES ', 'ROUTER', '0000-00-00', 11),
(31, 'CATALIST 2960', 'SWICHT DE RED', '0000-00-00', 11),
(32, 'CATALYST 1960', 'SWICHT DE RED', '0000-00-00', 11),
(33, 'CATALYST 2960', 'SWICHT DE RED', '0000-00-00', 11),
(34, 'MF8365', 'PARLANTE', '0000-00-00', 12),
(35, 'MF8365', 'PARLANTE PORTATIL', '0000-00-00', 12),
(36, 'MF8365', 'PARLENTE PORTATIL', '0000-00-00', 12),
(37, 'CYBERCOL', 'COOLER', '0000-00-00', 13),
(38, 'HA-71', 'COOLER', '0000-00-00', 13),
(39, 'S/M', 'ESTABILIZADOR ', '0000-00-00', 14),
(40, 'LATITUDE 3400', 'LAPTOP', '0000-00-00', 15),
(41, 'P2419H', 'MONITOR', '0000-00-00', 15),
(42, 'POWER EDGE T30', 'SERVIDOR', '0000-00-00', 15),
(43, 'S/M', 'SWICHT DE RED', '0000-00-00', 16),
(44, 'S/M', 'ESTABILIZADOR ', '0000-00-00', 17),
(45, 'DS-780N', 'ESCANER', '0000-00-00', 18),
(46, '3LCD', 'PROYECTOR', '0000-00-00', 18),
(47, 'H577A', 'PROYECTOR', '0000-00-00', 18),
(48, 'H871A', 'PROYECTOR', '0000-00-00', 18),
(49, 'POWER LITE 2250U', 'PROYECTOR', '0000-00-00', 18),
(50, 'POWERLITE 98', 'PROYECTOR', '0000-00-00', 18),
(51, 'POWERLITE U42', 'PROYECTOR', '0000-00-00', 18),
(52, 'VPL-EX235', 'PROYECTOR', '0000-00-00', 18),
(53, 'WUXGA', 'PROYECTOR', '0000-00-00', 18),
(54, 'FX-1500', 'ESTABILIZADOR ', '0000-00-00', 19),
(55, 'FX-1500', 'UPS', '0000-00-00', 19),
(56, 'NT1012U', 'UPS', '0000-00-00', 19),
(57, 'SL-1512UL', 'UPS', '0000-00-00', 19),
(58, 'ECAM 8000', 'CAMARA WEB', '0000-00-00', 20),
(59, 'ECAM 8000', 'CAMARA WEB ', '0000-00-00', 20),
(60, 'ECAM G800', 'CAMARA WEB ', '0000-00-00', 20),
(61, 'DX-110', 'MOUSE', '0000-00-00', 20),
(62, 'DX-11U', 'MOUSE', '0000-00-00', 20),
(63, 'S/M', 'MOUSE', '0000-00-00', 20),
(64, 'S/M', 'PARLANTE', '0000-00-00', 20),
(65, 'Y-U0029', 'TECLADO', '0000-00-00', 21),
(66, 'G500', 'IMPRESORA COD. BARRAS', '0000-00-00', 22),
(67, 'GWN7600', 'ACCESS POINT', '0000-00-00', 23),
(68, 'GWN7610', 'ACCESS POINT', '0000-00-00', 23),
(69, 'GWN7600', 'PUNTO DE ACCESO INALAMBRICO - ACCESS POINT WIRELESS', '0000-00-00', 23),
(70, 'GWN7610', 'PUNTO DE ACCESO INALAMBRICO - ACCESS POINT WIRELESS', '0000-00-00', 23),
(71, 'DS-2CE16D0T-VFIR3F', 'CAMARA CCTV DE TUBO SELLADO EXTERIOR ', '0000-00-00', 24),
(72, 'DS-2CE16D1T-VFIR3', 'CAMARA CCTV DE TUBO SELLADO EXTERIOR ', '0000-00-00', 24),
(73, 'DS-2CE56D0T-VFIR3F', 'CAMARA CCTV DOMO A COLOR INTERIOR ', '0000-00-00', 24),
(74, 'DS-2CE5AH0T-VPIT3ZF', 'CAMARA CCTV DOMO A COLOR INTERIOR ', '0000-00-00', 24),
(75, 'DS-2CE76H0T-ITPFS', 'CAMARA CCTV DOMO A COLOR INTERIOR ', '0000-00-00', 24),
(76, 'DS-2CE16D0T-IRPF', 'CAMARA DE SEGURIDAD', '0000-00-00', 24),
(77, 'DS-2CE16D0T-VFIR3F', 'CAMARA DE SEGURIDAD', '0000-00-00', 24),
(78, 'DS-2CE16D1T-VFIR3', 'CAMARA DE SEGURIDAD', '0000-00-00', 24),
(79, 'DS-2CE56D0T-IRPF', 'CAMARA DE SEGURIDAD', '0000-00-00', 24),
(80, 'DS-2CE56D0T-VFIR3F', 'CAMARA DE SEGURIDAD', '0000-00-00', 24),
(81, 'DS-2CE5AH0T-VPIT3ZF', 'CAMARA DE SEGURIDAD', '0000-00-00', 24),
(82, 'S/M', 'CAMARA DOMO A COLOR VARIFOCAL', '0000-00-00', 24),
(83, 'DS-7216HQHI-K2', 'DVR', '0000-00-00', 24),
(84, 'DS-7216HUHI-K2', 'DVR', '0000-00-00', 24),
(85, 'S/M', 'GRABADOR CCTV', '0000-00-00', 24),
(86, 'Z440', 'CPU ', '0000-00-00', 25),
(87, 'ELITE DESK G800 2', 'CPU ', '0000-00-00', 25),
(88, 'ELITEDESK 800 G1', 'CPU ', '0000-00-00', 25),
(89, 'ELITEDESK 800 G2', 'CPU ', '0000-00-00', 25),
(90, 'ELITEDESK 800 G3', 'CPU ', '0000-00-00', 25),
(91, 'PRODESK 600 G3', 'CPU ', '0000-00-00', 25),
(92, 'ELITEDESK 800 G1', 'DESKTOP', '0000-00-00', 25),
(93, 'ELITEDESK 800 G2', 'DESKTOP', '0000-00-00', 25),
(94, 'ELITEDESK 800 G3', 'DESKTOP', '0000-00-00', 25),
(95, 'TPC-F100 SF', 'DESKTOP', '0000-00-00', 25),
(96, 'HP COLOR LASERT JET CP 4525', 'IMPRESORA', '0000-00-00', 25),
(97, 'HP LASERJET P3015', 'IMPRESORA', '0000-00-00', 25),
(98, 'LASER  JET ENTERPRISE MFP M725', 'IMPRESORA', '0000-00-00', 25),
(99, 'LASER JET P3015', 'IMPRESORA', '0000-00-00', 25),
(100, 'LASERJET PRO M454 DW', 'IMPRESORA', '0000-00-00', 25),
(101, 'HP 250 G6', 'LAPTOP', '0000-00-00', 25),
(102, 'PROBOOK 450G8', 'LAPTOP', '0000-00-00', 25),
(103, 'RTL8723DE', 'LAPTOP', '0000-00-00', 25),
(104, 'ZBOOK 15', 'LAPTOP', '0000-00-00', 25),
(105, 'ZBOOK POWER', 'LAPTOP', '0000-00-00', 25),
(106, 'V244H', 'MNIOR', '0000-00-00', 25),
(107, 'HSTND-9311', 'MONITOR', '0000-00-00', 25),
(108, 'P24V G5', 'MONITOR', '0000-00-00', 25),
(109, 'V244H', 'MONITOR', '0000-00-00', 25),
(110, 'S/M', 'MONITOR', '0000-00-00', 25),
(111, 'HSTND-9311', 'MONITOR ', '0000-00-00', 25),
(112, 'MOFYUO', 'MOUSE', '0000-00-00', 25),
(113, 'MOFKUO', 'MOUSE', '0000-00-00', 25),
(114, 'S/M', 'MOUSE', '0000-00-00', 25),
(115, 'MOFYUO', 'MOUSE ', '0000-00-00', 25),
(116, 'DL160 9GEN', 'SERVIDOR', '0000-00-00', 25),
(117, 'PROLIANT DL 20', 'SERVIDOR', '0000-00-00', 25),
(118, '2530-48G', 'SWICHT DE RED', '0000-00-00', 25),
(119, '2920-48G', 'SWICHT DE RED', '0000-00-00', 25),
(120, 'A5120-48G-POE+', 'SWICHT DE RED', '0000-00-00', 25),
(121, 'HQ-TRE 71025', 'TECLADO', '0000-00-00', 25),
(122, 'KU-1469', 'TECLADO', '0000-00-00', 25),
(123, 'KV-1156', 'TECLADO', '0000-00-00', 25),
(124, 'KV-AR211', 'TECLADO', '0000-00-00', 25),
(125, 'TQ-TRE 71025', 'TECLADO', '0000-00-00', 25),
(126, 'KU-1469', 'TECLADO ', '0000-00-00', 25),
(127, '12 PRO', 'CELULAR', '0000-00-00', 26),
(128, 'QUANTUM 600', 'AURICULAR', '0000-00-00', 27),
(129, 'QUANTUM 600', 'AURICULAR INALAMBRICO', '0000-00-00', 27),
(130, 'JPB12', 'TABLET', '0000-00-00', 28),
(131, 'BIZHUB 368', 'IMPRESORA', '0000-00-00', 29),
(132, 'BIZHUB C458', 'IMPRESORA', '0000-00-00', 29),
(133, 'FS-4200DN', 'IMPRESORA', '0000-00-00', 30),
(134, 'TASKALFA 5551ci', 'IMPRESORA', '0000-00-00', 30),
(135, 'TASKALFA 6003I', 'IMPRESORA', '0000-00-00', 30),
(136, 'TASKALFA 3553CI', 'IMPRESORA', '0000-00-00', 30),
(137, 'TASKALFA 5052CI', 'IMPRESORA', '0000-00-00', 30),
(138, 'MT-M-10AF', 'ALL IN ONE', '0000-00-00', 31),
(139, 'S/M', 'ALL IN ONE', '0000-00-00', 31),
(140, 'M910S', 'CPU ', '0000-00-00', 31),
(141, 'NEO 5', 'CPU ', '0000-00-00', 31),
(142, 'THINKCENTRE M92P', 'CPU ', '0000-00-00', 31),
(143, 'V530S-07ICB', 'CPU ', '0000-00-00', 31),
(144, 'M7PRO UA', 'DESKTOP', '0000-00-00', 31),
(145, 'M910S', 'DESKTOP', '0000-00-00', 31),
(146, 'M920 S', 'DESKTOP', '0000-00-00', 31),
(147, 'MT-M-2988-A3S', 'DESKTOP', '0000-00-00', 31),
(148, 'NEO 5', 'DESKTOP', '0000-00-00', 31),
(149, 'S00200', 'DESKTOP', '0000-00-00', 31),
(150, 'V530S', 'DESKTOP', '0000-00-00', 31),
(151, 'B590', 'LAPTOP', '0000-00-00', 31),
(152, 'E590', 'LAPTOP', '0000-00-00', 31),
(153, 'P53S', 'LAPTOP', '0000-00-00', 31),
(154, 'T540P', 'LAPTOP', '0000-00-00', 31),
(155, '3024-HC1', 'MONITOR', '0000-00-00', 31),
(156, 'C18238FT0', 'MONITOR', '0000-00-00', 31),
(157, 'LT 2452 P WIDE', 'MONITOR', '0000-00-00', 31),
(158, 'LT2323PWA', 'MONITOR', '0000-00-00', 31),
(159, 'LT2452PWC', 'MONITOR', '0000-00-00', 31),
(160, 'LT2452TWC', 'MONITOR', '0000-00-00', 31),
(161, 'S24E-10', 'MONITOR', '0000-00-00', 31),
(162, 'S24E-20', 'MONITOR', '0000-00-00', 31),
(163, 'T2364TA', 'MONITOR', '0000-00-00', 31),
(164, 'T24I-10', 'MONITOR', '0000-00-00', 31),
(165, 'M910S', 'MOUSE', '0000-00-00', 31),
(166, 'MOEUUO', 'MOUSE', '0000-00-00', 31),
(167, 'MOJUUO', 'MOUSE', '0000-00-00', 31),
(168, 'M-U0025', 'MOUSE', '0000-00-00', 31),
(169, 'SM50', 'MOUSE', '0000-00-00', 31),
(170, 'SM-8823', 'MOUSE', '0000-00-00', 31),
(171, 'U0025', 'MOUSE', '0000-00-00', 31),
(172, 'S/M', 'MOUSE', '0000-00-00', 31),
(173, 'SM-8823', 'MOUSE ', '0000-00-00', 31),
(174, 'S/M', 'TABLET', '0000-00-00', 31),
(175, 'EKB-536A', 'TECLADO', '0000-00-00', 31),
(176, 'KBBH21', 'TECLADO', '0000-00-00', 31),
(177, 'KU-0225', 'TECLADO', '0000-00-00', 31),
(178, 'KU-1469', 'TECLADO', '0000-00-00', 31),
(179, 'KU-1619', 'TECLADO', '0000-00-00', 31),
(180, 'S/M', 'TECLADO', '0000-00-00', 31),
(181, 'GP65NB60', 'LECTORA EXTERNA', '0000-00-00', 32),
(182, 'S/M', 'LG', '0000-00-00', 32),
(183, '32MN600P-B', 'MONITOR', '0000-00-00', 32),
(184, '86TR3 DK B', 'PIZARRAS INTERACTIVAS', '0000-00-00', 32),
(185, '86TR-3DJ-8', 'PIZARRAS INTERACTIVAS', '0000-00-00', 32),
(186, '86TR3DK-B', 'PIZARRAS INTERACTIVAS', '0000-00-00', 32),
(187, 'H111', 'AURICULAR', '0000-00-00', 33),
(188, 'K120', 'MOUSE', '0000-00-00', 33),
(189, 'M90', 'MOUSE', '0000-00-00', 33),
(190, 'M-U0026', 'MOUSE', '0000-00-00', 33),
(191, 'S/M', 'MOUSE', '0000-00-00', 33),
(192, 'M90', 'MOUSE ', '0000-00-00', 33),
(193, 'K120', 'TECLADO', '0000-00-00', 33),
(194, 'Y-U0009', 'TECLADO', '0000-00-00', 33),
(195, 'S/M', 'LECTOR DNI', '0000-00-00', 34),
(196, 'THERMALTAKE', 'COOLER', '0000-00-00', 35),
(197, 'S/M', 'PARLANTE', '0000-00-00', 36),
(198, '1113', 'MOUSE', '0000-00-00', 37),
(199, 'MSK-1113', 'MOUSE', '0000-00-00', 37),
(200, 'MSK-113', 'MOUSE', '0000-00-00', 37),
(201, 'S/M', 'MOUSE', '0000-00-00', 37),
(202, '1576', 'TECLADO', '0000-00-00', 37),
(203, 'KEYBOARD 400', 'TECLADO', '0000-00-00', 37),
(204, 'KEYBOARD 600', 'TECLADO', '0000-00-00', 37),
(205, 'S/M', 'TECLADO', '0000-00-00', 37),
(206, 'WIRED KEYBOARD 600', 'TECLADO', '0000-00-00', 37),
(207, '1576', 'TECLADO ', '0000-00-00', 37),
(208, 'S/M', 'MOUSE', '0000-00-00', 38),
(209, 'OWB-2004-CE', 'CAMARA WEB', '0000-00-00', 39),
(210, 'OWB-2004-CE', 'CAMARA WEB ', '0000-00-00', 39),
(211, 'ES4172LP', 'IMPRESORA', '0000-00-00', 40),
(212, 'S/M', 'ESTABILIZADOR ', '0000-00-00', 41),
(213, 'S/M', 'MOUSE', '0000-00-00', 42),
(214, 'KX-NT551', 'ANEXO', '0000-00-00', 43),
(215, 'KX-NS500', 'ESTACION TELEFONICA', '0000-00-00', 43),
(216, 'KX-HDV 130', 'TELEFONO IP', '0000-00-00', 43),
(217, 'KX-HDV130', 'TELEFONO IP', '0000-00-00', 43),
(218, 'KX-NT 551', 'TELEFONO IP', '0000-00-00', 43),
(219, 'KX-NT 553', 'TELEFONO IP', '0000-00-00', 43),
(220, 'KX-NT551', 'TELEFONO IP', '0000-00-00', 43),
(221, 'KX-NT553', 'TELEFONO IP', '0000-00-00', 43),
(222, 'KX-NT556', 'TELEFONO IP', '0000-00-00', 43),
(223, 'S/M', 'CAMARA WEB', '0000-00-00', 44),
(224, 'PHILIPS', 'CAMARA WEB ', '0000-00-00', 44),
(225, 'SPL650 6BM', 'CAMARA WEB ', '0000-00-00', 44),
(226, '242 G5D', 'MONITOR', '0000-00-00', 44),
(227, '242G5DJEB44', 'MONITOR', '0000-00-00', 44),
(228, 'S/M', 'TICKETERA', '0000-00-00', 45),
(229, 'TP-300', 'TICKETERA', '0000-00-00', 45),
(230, 'PR2100', 'NAS SERVIDOR', '0000-00-00', 46),
(231, 'S/M', 'CONSOLABMULTIPLEXOR', '0000-00-00', 47),
(232, 'S/M', 'DISCO DURO EXTERNO', '0000-00-00', 47),
(233, 'S/M', 'GABINETE DE RED', '0000-00-00', 47),
(234, 'S/M', 'MOUSE', '0000-00-00', 47),
(235, 'S/M', 'PROYECTOR', '0000-00-00', 47),
(236, 'A 23', 'CELULAR', '0000-00-00', 48),
(237, 'A23', 'CELULAR', '0000-00-00', 48),
(238, 'GALAXY A 13', 'CELULAR', '0000-00-00', 48),
(239, 'GALAXY S23 FE', 'CELULAR', '0000-00-00', 48),
(240, 'SM235M', 'CELULAR', '0000-00-00', 48),
(241, 'SM-A235M', 'CELULAR', '0000-00-00', 48),
(242, 'SM-S235M', 'CELULAR', '0000-00-00', 48),
(243, 'GALAXY TAB S7 FE', 'TABLET', '0000-00-00', 48),
(244, 'SV 600', 'ESCANER', '0000-00-00', 49),
(245, '2R1APM 500', 'DISCO DURO EXTERNO', '0000-00-00', 50),
(246, 'BACKUP PLUS HOME', 'DISCO DURO EXTERNO', '0000-00-00', 50),
(247, 'BACKUP PLUS HUB 8TB', 'DISCO DURO EXTERNO', '0000-00-00', 50),
(248, 'EXPANSION 4TB', 'DISCO DURO EXTERNO', '0000-00-00', 50),
(249, 'ONETOUCH 4TB', 'DISCO DURO EXTERNO', '0000-00-00', 50),
(250, 'S/M', 'DISCO DURO EXTERNO', '0000-00-00', 50),
(251, 'SRD0VN2', 'DISCO DURO EXTERNO', '0000-00-00', 50),
(252, 'SRD0NF2', 'DISCO DURO EXTERNO', '0000-00-00', 50),
(253, 'SRD0PV1', 'DISCO DURO EXTERNO', '0000-00-00', 50),
(254, 'SRD0VN3', 'DISCO DURO EXTERNO', '0000-00-00', 50),
(255, 'MX-5141', 'IMPRESORA', '0000-00-00', 51),
(256, 'MX-M465', 'IMPRESORA', '0000-00-00', 51),
(257, 'MX-M565', 'IMPRESORA', '0000-00-00', 51),
(258, 'BDP-S3500', 'BLUERAY', '0000-00-00', 52),
(259, 'FDR AX53', 'CAMARA DE VIDEO DIGITAL', '0000-00-00', 52),
(260, 'MHCV02', 'EQUIPO DE SONIDO', '0000-00-00', 52),
(261, 'FST-GTK37IP', 'MINICOMPONENTE', '0000-00-00', 52),
(262, 'GTK-X1BT', 'MINICOMPONENTE', '0000-00-00', 52),
(263, 'VPL-EX235', 'PROYECTOR', '0000-00-00', 52),
(264, 'DR40', 'GRABADORA DIGITAL', '0000-00-00', 53),
(265, 'EKB-536A', 'DISCO DURO EXTERNO', '0000-00-00', 54),
(266, 'MASIVE 14', 'COOLER', '0000-00-00', 55),
(267, 'THERMOTALKE', 'COOLER', '0000-00-00', 55),
(268, 'DTB-420', 'DISCO DURO EXTERNO', '0000-00-00', 56),
(269, 'DTC 940', 'DISCO DURO EXTERNO', '0000-00-00', 56),
(270, 'DTC940', 'DISCO DURO EXTERNO', '0000-00-00', 56),
(271, 'S/M', 'DISCO DURO EXTERNO', '0000-00-00', 56),
(272, 'EAP115(US)', 'ACCESS POINT', '0000-00-00', 57),
(273, 'EAP115', 'ACCESS POINT', '0000-00-00', 57),
(274, 'TD-W8980', 'ROUTER', '0000-00-00', 57),
(275, 'USW-ENTERPRISE-48-POE', 'SWICHT DE RED', '0000-00-00', 58),
(276, 'TD-22220', 'MONITOR', '0000-00-00', 59),
(277, 'PJD5555W', 'PROYECTOR', '0000-00-00', 59),
(278, 'PJD7828HDL', 'PROYECTOR', '0000-00-00', 59),
(279, 'WS-16230', 'PROYECTOR', '0000-00-00', 59),
(280, 'MY BOOK DUO', 'DISCO DURO EXTERNO', '0000-00-00', 60),
(281, 'S/M', 'DISCO DURO EXTERNO', '0000-00-00', 60),
(282, 'ZT411', 'CODIGO DE BARRA IMPRESORA', '0000-00-00', 61),
(283, 'ZC300', 'FOTOCHECK IMPRESORA', '0000-00-00', 61),
(284, 'S/M', 'MODEN INTERNET', '0000-00-00', 61),
(285, 'UFACE800', 'RELOJ MARCADOR', '0000-00-00', 62),
(286, 'MF920V', 'MODEN INTERNET', '0000-00-00', 63);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_asignacion`
--

DROP TABLE IF EXISTS `historial_asignacion`;
CREATE TABLE `historial_asignacion` (
  `id_historial` int(11) NOT NULL,
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
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_asignacion`
--

INSERT INTO `historial_asignacion` (`id_historial`, `id_detalle_asignacion`, `idsedes`, `idoficinas`, `idequipos`, `idusuario`, `idempleado`, `cod_patrimonial`, `vida_util`, `estado`, `fecha_asignacion`, `accion`, `fecha`) VALUES
(1, 8319, 2, 28, 3, 1, 3, '2012012', '2', 'actualizado', '2024-05-24', 'UPDATE', '2024-05-23 20:51:09'),
(2, 8320, 2, 24, 2, 1, 4, '1234567896', '2 años', 'INOPERATIVO', '2024-05-23', 'INSERT', '2024-05-23 20:53:09'),
(3, 8320, 2, 24, 2, 1, 4, '1234567896', '2 años', 'eliminado', '2024-05-23', 'DELETE', '2024-05-23 20:54:53'),
(4, 8321, 2, 27, 3, 1, 2, '8548548548ca', '2años', 'OPERATIVO', '2024-05-23', 'INSERT', '2024-05-23 20:56:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL,
  `nombre` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idmarca`, `nombre`) VALUES
(1, 'ADVANCE'),
(2, 'AMS'),
(3, 'ANTRYX'),
(4, 'APC'),
(5, 'APPLE'),
(6, 'BENQ'),
(7, 'BROTHER'),
(8, 'BUFFALO'),
(9, 'CANON'),
(10, 'CDP'),
(11, 'CISCO'),
(12, 'CREATIVE'),
(13, 'CYBERCOL'),
(14, 'DALUX'),
(15, 'DELL'),
(16, 'D-LINK'),
(17, 'ELECTRONICA E& F'),
(18, 'EPSON'),
(19, 'FORZA'),
(20, 'GENIUS'),
(21, 'GIGABYTE'),
(22, 'GODEX'),
(23, 'GRANDSTREAM'),
(24, 'HIKVISION'),
(25, 'HP'),
(26, 'IPHONE '),
(27, 'JBL'),
(28, 'JUMPER TECH'),
(29, 'KONICA MINOLTA'),
(30, 'KYOCERA'),
(31, 'LENOVO'),
(32, 'LG'),
(33, 'LOGITECH'),
(34, 'LUXURY'),
(35, 'MASSIVE'),
(36, 'MICRONICS'),
(37, 'MICROSOFT'),
(38, 'MSK-1113'),
(39, 'OBSBOT'),
(40, 'OKI'),
(41, 'ON LINE DATA'),
(42, 'OPTICAL'),
(43, 'PANASONIC'),
(44, 'PHILIPS'),
(45, 'POS-D'),
(46, 'QNAP'),
(47, 'S/M'),
(48, 'SAMSUNG'),
(49, 'SCAN SNAP'),
(50, 'SEAGATE'),
(51, 'SHARP'),
(52, 'SONY'),
(53, 'TASCAN'),
(54, 'TECLADO'),
(55, 'THERMOTALKE'),
(56, 'TOSHIBA'),
(57, 'TP-LINK'),
(58, 'UBIQUITI'),
(59, 'VIEW SONIC'),
(60, 'WESTER DIGITAL'),
(61, 'ZEBRA'),
(62, 'ZKTECO'),
(63, 'ZTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meta`
--

DROP TABLE IF EXISTS `meta`;
CREATE TABLE `meta` (
  `idmeta` int(11) NOT NULL,
  `nombre` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `meta`
--

INSERT INTO `meta` (`idmeta`, `nombre`) VALUES
(1, '001'),
(2, '008 PUR'),
(3, 'sin meta'),
(4, '007 PUR'),
(5, '002'),
(6, '08 PUR'),
(7, ' 008 PUR'),
(8, 'sin meta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficina`
--

DROP TABLE IF EXISTS `oficina`;
CREATE TABLE `oficina` (
  `idoficinas` int(11) NOT NULL,
  `nombres` text DEFAULT NULL,
  `idsedes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oficina`
--

INSERT INTO `oficina` (`idoficinas`, `nombres`, `idsedes`) VALUES
(1, 'INFORMATICA', 1),
(2, 'SECRETARIA GENERAL', 1),
(3, 'MANTENIMIENTO', 1),
(4, 'ADMINISTRACION', 1),
(5, 'PLANEAMIENTO Y PRESUPUESTO', 1),
(6, 'LOGISTICA', 1),
(7, 'CONTABILIDAD', 1),
(8, 'RECURSOS HUMANOS', 1),
(9, 'TESORERIA', 1),
(10, 'ASESORIA JURIDICA', 1),
(11, 'AULA 5 ', 1),
(12, 'CONTROL PATRIMONIAL', 1),
(13, 'AULA 7', 1),
(14, 'CONTROL INTERNO', 1),
(15, 'AULA 9', 1),
(16, 'AULA 5', 1),
(17, 'TEATRIN', 1),
(18, 'INGRESO- LIBRO DE RECLMACIONES', 1),
(19, 'TOPICO', 1),
(20, 'SEGURIDAD', 1),
(21, 'INGRESO', 1),
(22, 'BIBLIOTECA', 2),
(23, 'DIRECCIÓN GENERAL', 2),
(24, 'PASADIZO PISO 1 - MIRAFLORES', 2),
(25, 'AULA 01', 2),
(26, 'INFORMÁTICA MIRAFLORES', 2),
(27, 'LOBBY MIRAFLORES', 2),
(28, 'PASADIZO PISO 2 - MIRAFLORES', 2),
(29, 'PASADIZO PISO 3 - MIRAFLORES', 2),
(30, 'INFORMÁTICA', 2),
(31, 'ACADÉMICA', 2),
(32, 'COORDINACIÓN ACADÉMICA', 2),
(33, 'BIENESTAR ESTUDIANTIL', 2),
(34, 'INVESTIGACIÓN', 2),
(35, 'DIRECCIÓN ACADÉMICA', 2),
(36, 'CE - ENSAD', 2),
(37, 'COORD. ACADÉMICA', 2),
(38, 'COORD. INVESTIGACIÓN', 2),
(39, 'ESCALERA LOBBY - MIRAFLORES', 2),
(40, 'LABORATORIO DE INVESTIGACIÓN', 2),
(41, 'SALIDA DE EMERGENCIA - BONILLA', 2),
(42, 'EXTERIOR ESPERANZA', 2),
(43, 'AULA VILLACORTA', 2),
(44, 'COMPUTO I', 2),
(45, 'COMPUTO II', 2),
(46, 'SALA DE REUNIONES', 2),
(47, 'AULA 05', 2),
(48, 'AULA 06', 2),
(49, 'JEFATURA DE CARRERAS', 2),
(50, 'SALA DE PROFESORES - MIRAFLORES', 2),
(51, 'AULA 02', 2),
(52, 'AULA 03', 2),
(53, 'AULA 04', 2),
(54, 'AULA 07', 2),
(55, 'COMEDOR - MIRAFLORES', 2),
(56, 'JEFATURA DE ACTUACIÓN', 2),
(57, 'FONDO EDITORIAL', 2),
(58, 'JEFATURA DE DISEÑO', 2),
(59, 'JEFATURA DE EDUCACIÓN', 2),
(60, 'MESA DE PARTES', 2),
(61, 'GESTION CULTURAL', 2),
(62, 'IMAGEN', 2),
(63, 'LABORATORIO INVESTIGACIÓN', 2),
(64, 'SERVICIOS GENERALES', 2),
(65, 'ARCHIVO PRIMER PISO', 2),
(66, 'PASADIZO SEGUNDO PISO', 2),
(67, 'ARCHIVO PRIMERO PISO', 2),
(68, 'INFORMATICA', 2),
(69, 'LAB DE COMPUTO 1', 2),
(70, 'MAQUILLAJE', 2),
(71, 'GESTIÓN DE PERSONAL', 2),
(72, 'COORDINACION DE PRODUCCION', 3),
(73, 'DIRECCION DE PRODUCCION', 3),
(74, 'INFORMATICA', 3),
(75, 'VESTUARIO', 3),
(76, 'CABINA', 3),
(77, 'OFICINA DE PRODUCCION', 3),
(78, 'GESTION CULTURAL', 3),
(79, 'SALA DE TELECOMUNICACIONES', 3),
(80, 'MEZANINE', 3),
(81, 'INGRESO- LIBRO DE RECLMACIONES', 3),
(82, 'SEGURIDAD', 3),
(83, 'INGRESO ', 3),
(84, 'SEGURIDAD ROMA', 3),
(85, 'VESTUARIO ROMA', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

DROP TABLE IF EXISTS `sede`;
CREATE TABLE `sede` (
  `idsedes` int(11) NOT NULL,
  `nombres` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`idsedes`, `nombres`) VALUES
(1, 'CABAÑA'),
(2, 'MIRAFLORES'),
(3, 'ROMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` text DEFAULT NULL,
  `user` text DEFAULT NULL,
  `contraseña` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `user`, `contraseña`) VALUES
(1, 'administrado', 'admin', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `a_usuaria`
--
ALTER TABLE `a_usuaria`
  ADD PRIMARY KEY (`id_area_usuaria`);

--
-- Indices de la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  ADD PRIMARY KEY (`idbeneficiario`);

--
-- Indices de la tabla `detalle_adquisicion`
--
ALTER TABLE `detalle_adquisicion`
  ADD PRIMARY KEY (`id_detalle_aquisicion`),
  ADD KEY `id_area_usuaria` (`id_area_usuaria`),
  ADD KEY `idequipos` (`idequipos`),
  ADD KEY `idbeneficiario` (`idbeneficiario`),
  ADD KEY `idmeta` (`idmeta`);

--
-- Indices de la tabla `detalle_asignacion`
--
ALTER TABLE `detalle_asignacion`
  ADD PRIMARY KEY (`id_detalle_asignacion`),
  ADD UNIQUE KEY `idsedes` (`idsedes`,`idoficinas`,`idequipos`,`idusuario`,`idempleado`,`cod_patrimonial`(50)) USING BTREE,
  ADD KEY `idoficinas` (`idoficinas`),
  ADD KEY `idequipos` (`idequipos`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idempleado` (`idempleado`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idempleado`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`idequipos`),
  ADD KEY `idmarca` (`idmarca`);

--
-- Indices de la tabla `historial_asignacion`
--
ALTER TABLE `historial_asignacion`
  ADD PRIMARY KEY (`id_historial`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idmarca`);

--
-- Indices de la tabla `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`idmeta`);

--
-- Indices de la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD PRIMARY KEY (`idoficinas`),
  ADD KEY `idsedes` (`idsedes`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`idsedes`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `a_usuaria`
--
ALTER TABLE `a_usuaria`
  MODIFY `id_area_usuaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  MODIFY `idbeneficiario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_adquisicion`
--
ALTER TABLE `detalle_adquisicion`
  MODIFY `id_detalle_aquisicion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT de la tabla `detalle_asignacion`
--
ALTER TABLE `detalle_asignacion`
  MODIFY `id_detalle_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8322;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idempleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `idequipos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT de la tabla `historial_asignacion`
--
ALTER TABLE `historial_asignacion`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idmarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `meta`
--
ALTER TABLE `meta`
  MODIFY `idmeta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `oficina`
--
ALTER TABLE `oficina`
  MODIFY `idoficinas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `idsedes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_adquisicion`
--
ALTER TABLE `detalle_adquisicion`
  ADD CONSTRAINT `detalle_adquisicion_ibfk_1` FOREIGN KEY (`id_area_usuaria`) REFERENCES `a_usuaria` (`id_area_usuaria`),
  ADD CONSTRAINT `detalle_adquisicion_ibfk_2` FOREIGN KEY (`idequipos`) REFERENCES `equipos` (`idequipos`),
  ADD CONSTRAINT `detalle_adquisicion_ibfk_3` FOREIGN KEY (`idbeneficiario`) REFERENCES `beneficiario` (`idbeneficiario`),
  ADD CONSTRAINT `detalle_adquisicion_ibfk_4` FOREIGN KEY (`idmeta`) REFERENCES `meta` (`idmeta`);

--
-- Filtros para la tabla `detalle_asignacion`
--
ALTER TABLE `detalle_asignacion`
  ADD CONSTRAINT `detalle_asignacion_ibfk_1` FOREIGN KEY (`idsedes`) REFERENCES `sede` (`idsedes`),
  ADD CONSTRAINT `detalle_asignacion_ibfk_2` FOREIGN KEY (`idoficinas`) REFERENCES `oficina` (`idoficinas`),
  ADD CONSTRAINT `detalle_asignacion_ibfk_3` FOREIGN KEY (`idequipos`) REFERENCES `equipos` (`idequipos`),
  ADD CONSTRAINT `detalle_asignacion_ibfk_4` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `detalle_asignacion_ibfk_5` FOREIGN KEY (`idempleado`) REFERENCES `empleados` (`idempleado`);

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`);

--
-- Filtros para la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD CONSTRAINT `oficina_ibfk_1` FOREIGN KEY (`idsedes`) REFERENCES `sede` (`idsedes`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
