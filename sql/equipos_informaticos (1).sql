-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-05-2024 a las 01:53:15
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_asignacion`
--

INSERT INTO `detalle_asignacion` (`id_detalle_asignacion`, `idsedes`, `idoficinas`, `idequipos`, `idusuario`, `idempleado`, `cod_patrimonial`, `vida_util`, `estado`, `fecha_asignacion`) VALUES
(8346, 2, 22, 3, 2, 15, '202120214xa', '1', 'OPERATIVO', '2024-05-19'),
(8348, 2, 22, 4, 2, 31, '2020202020xd', '3 años', 'OPERATIVO', '2024-05-19');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial_asignacion`
--

INSERT INTO `historial_asignacion` (`id_historial`, `id_detalle_asignacion`, `idsedes`, `idoficinas`, `idequipos`, `idusuario`, `idempleado`, `cod_patrimonial`, `vida_util`, `estado`, `fecha_asignacion`, `accion`, `fecha`) VALUES
(1, 8340, 1, 2, 1, 1, 10, '123434523535', 'asdasd', 'INOPERATIVO', '2024-05-19', 'INSERT', '2024-05-19 17:44:46'),
(2, 8319, 2, 31, 3, 1, 13, 'asfasdfasdf', 'fasdfsad', 'eliminado', '2024-05-17', 'DELETE', '2024-05-19 18:10:13'),
(3, 8326, 2, 27, 3, 1, 1, '20202', '2020', 'eliminado', '0000-00-00', 'DELETE', '2024-05-19 18:10:16'),
(4, 8327, 2, 28, 3, 1, 10, 'asd', '2020', 'eliminado', '0000-00-00', 'DELETE', '2024-05-19 18:10:27'),
(5, 8328, 2, 29, 2, 1, 12, 'asda', 'sadas', 'eliminado', '2024-05-18', 'DELETE', '2024-05-19 18:10:33'),
(6, 8329, 1, 3, 1, 1, 5, '123123', '1231', 'eliminado', '2024-05-18', 'DELETE', '2024-05-19 18:10:36'),
(7, 8331, 1, 5, 2, 1, 6, 'asdas', 'sadsad', 'eliminado', '2024-05-15', 'DELETE', '2024-05-19 18:10:38'),
(8, 8330, 1, 5, 3, 1, 5, 'asdsa', 'asdsa', 'eliminado', '2024-05-14', 'DELETE', '2024-05-19 18:11:11'),
(9, 8332, 2, 27, 1, 1, 5, 'asdfsd', 'sdfasdf', 'eliminado', '2024-05-18', 'DELETE', '2024-05-19 18:11:15'),
(10, 8333, 1, 6, 3, 1, 5, 'sdfsad', 'asdfsad', 'eliminado', '2024-05-17', 'DELETE', '2024-05-19 18:11:19'),
(11, 8334, 2, 26, 2, 1, 7, 'asdasd', 'asdasd', 'eliminado', '2024-05-06', 'DELETE', '2024-05-19 18:11:23'),
(12, 8335, 3, 75, 1, 1, 4, 'asd', 'asdsa', 'eliminado', '2024-05-03', 'DELETE', '2024-05-19 18:11:26'),
(13, 8336, 2, 26, 2, 1, 3, 'asdasd', 'adsad', 'eliminado', '2024-05-17', 'DELETE', '2024-05-19 18:15:58'),
(14, 8337, 1, 3, 1, 1, 4, 'asdasd', 'asdsa', 'eliminado', '2024-05-25', 'DELETE', '2024-05-19 18:16:01'),
(15, 8339, 2, 24, 4, 1, 4, 'asdfsad', 'fasdf', 'eliminado', '2024-05-18', 'DELETE', '2024-05-19 18:16:04'),
(16, 8340, 1, 2, 1, 1, 10, '123434523535', 'asdasd', 'eliminado', '2024-05-19', 'DELETE', '2024-05-19 18:19:41'),
(17, 8341, 1, 4, 2, 1, 3, 'asdsad', 'sadsa', 'OPERATIVO', '2024-05-20', 'INSERT', '2024-05-19 18:19:55'),
(18, 8342, 2, 23, 2, 1, 6, 'asdasd', 'asdsad', 'INOPERATIVO', '2024-05-19', 'INSERT', '2024-05-19 18:20:50'),
(19, 8343, 3, 75, 2, 1, 4, '234243', '24234', 'INOPERATIVO', '2024-05-23', 'INSERT', '2024-05-19 18:24:10'),
(20, 8343, 3, 75, 2, 1, 4, '234243', '24234', 'eliminado', '2024-05-23', 'DELETE', '2024-05-19 18:24:14'),
(21, 8341, 1, 4, 2, 1, 3, 'asdsad', 'sadsa', 'eliminado', '2024-05-20', 'DELETE', '2024-05-19 18:24:21'),
(22, 8342, 2, 23, 2, 1, 6, 'asdasd', 'asdsad', 'eliminado', '2024-05-19', 'DELETE', '2024-05-19 18:39:24'),
(23, 8338, 1, 7, 2, 1, 3, 'asfsda', 'asfads', 'eliminado', '2024-05-17', 'DELETE', '2024-05-19 18:40:54'),
(24, 8344, 1, 4, 2, 1, 5, 'asd', '121', 'INOPERATIVO', '2024-05-16', 'INSERT', '2024-05-19 18:41:56'),
(25, 8345, 1, 3, 4, 1, 8, 'asd', 'asdasd', 'INOPERATIVO', '2024-05-13', 'INSERT', '2024-05-19 23:31:31'),
(26, 8346, 2, 30, 3, 1, 11, '202120214xa', '3 años', 'INOPERATIVO', '2024-05-19', 'INSERT', '2024-05-20 00:15:36'),
(27, 8347, 2, 27, 5, 1, 6, '30201020', '20 AÑOS', 'INOPERATIVO', '2024-05-19', 'INSERT', '2024-05-20 00:29:14'),
(28, 8347, 2, 27, 5, 1, 6, '30201020', '20 AÑOS', 'eliminado', '2024-05-19', 'DELETE', '2024-05-20 00:29:28'),
(29, 8346, 2, 30, 3, 1, 11, '202120214xa', '3 años', 'actualizado', '2024-05-19', 'UPDATE', '2024-05-20 02:05:45'),
(30, 8346, 2, 30, 3, 2, 11, '202120214xa', '3', 'actualizado', '2024-05-18', 'UPDATE', '2024-05-20 02:06:20'),
(31, 8346, 3, 75, 3, 2, 18, '202120214xa', '2', 'actualizado', '2024-05-18', 'UPDATE', '2024-05-20 02:10:01'),
(32, 8346, 2, 22, 3, 2, 52, '202120214xa', '2', 'actualizado', '2024-05-18', 'UPDATE', '2024-05-20 02:12:34'),
(33, 8346, 3, 77, 3, 2, 33, '202120214xa', '2', 'actualizado', '2024-05-07', 'UPDATE', '2024-05-20 02:17:12'),
(34, 8346, 3, 77, 3, 2, 33, '202120214xa', '2', 'actualizado', '2024-05-07', 'UPDATE', '2024-05-20 02:17:20'),
(35, 8346, 3, 77, 3, 2, 33, '202120214xa', '2', 'actualizado', '2024-05-14', 'UPDATE', '2024-05-20 02:17:51'),
(36, 8346, 3, 77, 3, 2, 33, '202120214xa', '2', 'actualizado', '2024-05-14', 'UPDATE', '2024-05-20 02:18:27'),
(37, 8346, 3, 77, 3, 2, 33, '202120214xa', '2', 'actualizado', '2024-05-14', 'UPDATE', '2024-05-20 02:18:46'),
(38, 8346, 3, 77, 3, 2, 33, '202120214xa', '2', 'actualizado', '2024-05-14', 'UPDATE', '2024-05-20 02:22:07'),
(39, 8345, 1, 3, 4, 1, 8, 'asd', 'asdasd', 'actualizado', '2024-05-13', 'UPDATE', '2024-05-20 02:36:19'),
(40, 8344, 1, 4, 2, 1, 5, 'asd', '121', 'actualizado', '2024-05-16', 'UPDATE', '2024-05-20 02:40:32'),
(41, 8345, 1, 3, 4, 2, 8, 'asd', '0', 'actualizado', '2024-05-13', 'UPDATE', '2024-05-20 03:22:51'),
(42, 8344, 2, 27, 2, 2, 7, 'asd', '20', 'actualizado', '2024-05-19', 'UPDATE', '2024-05-20 03:23:25'),
(43, 8345, 1, 3, 4, 2, 8, 'asd', '0', 'actualizado', '2024-05-13', 'UPDATE', '2024-05-20 03:24:36'),
(44, 8345, 1, 3, 4, 2, 8, 'asd', '0', 'actualizado', '2024-05-13', 'UPDATE', '2024-05-20 03:25:15'),
(45, 8345, 1, 3, 4, 2, 8, 'asd', '0', 'actualizado', '2024-05-13', 'UPDATE', '2024-05-20 03:25:19'),
(46, 8344, 2, 27, 2, 2, 7, 'asd', '20', 'actualizado', '2024-05-19', 'UPDATE', '2024-05-20 03:27:07'),
(47, 8348, 2, 22, 4, 2, 31, '2020202020xd', '3 años', 'OPERATIVO', '2024-05-19', 'INSERT', '2024-05-20 03:39:14'),
(48, 8344, 2, 27, 2, 2, 7, 'asd', '20', 'eliminado', '2024-05-19', 'DELETE', '2024-05-20 03:39:50'),
(49, 8345, 1, 3, 4, 2, 8, 'asd', '0', 'eliminado', '2024-05-13', 'DELETE', '2024-05-20 03:39:57'),
(50, 8349, 1, 6, 6, 2, 8, '3303030303xd', '4 años', 'OPERATIVO', '2024-05-19', 'INSERT', '2024-05-20 03:41:56'),
(51, 8346, 3, 77, 3, 2, 33, '202120214xa', '2', 'actualizado', '2024-05-14', 'UPDATE', '2024-05-20 03:44:01'),
(52, 8349, 1, 6, 6, 2, 8, '3303030303xd', '4 años', 'eliminado', '2024-05-19', 'DELETE', '2024-05-20 03:47:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL,
  `nombre` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `user`, `contraseña`) VALUES
(1, 'administrado', 'admin', 'admin'),
(2, 'gonzalo', 'lgonzalo', '1234');

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
  MODIFY `id_detalle_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8350;

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
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

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
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
