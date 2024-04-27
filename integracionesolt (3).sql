-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-01-2024 a las 00:00:57
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
-- Base de datos: `integracionesolt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `vlan` int(11) DEFAULT NULL,
  `datos` varchar(64) DEFAULT NULL,
  `grupo` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`vlan`, `datos`, `grupo`) VALUES
(3053, '100M', 'CARABAYLLO-DESLIST-100M'),
(3053, '10M', 'CARABAYLLO-DESLIST-10M'),
(3053, '150M', 'CARABAYLLO-DESLIST-150M'),
(3053, '16M', 'CARABAYLLO-DESLIST-16M'),
(3053, '200M', 'CARABAYLLO-DESLIST-200M'),
(3053, '25M', 'CARABAYLLO-DESLIST-25M'),
(3053, '30M', 'CARABAYLLO-DESLIST-30M'),
(3053, '400M', 'CARABAYLLO-DESLIST-400M'),
(3053, '50M', 'CARABAYLLO-DESLIST-50M'),
(3502, '10M', 'CARABAYLLO-EOC-10M'),
(3502, '16M', 'CARABAYLLO-EOC-16M'),
(3502, '25M', 'CARABAYLLO-EOC-25M'),
(4004, '100M', 'CARABAYLLO-FTTH-100M'),
(4004, '10M', 'CARABAYLLO-FTTH-10M'),
(4004, '150M', 'CARABAYLLO-FTTH-150M'),
(4004, '16M', 'CARABAYLLO-FTTH-16M'),
(4004, '200M', 'CARABAYLLO-FTTH-200M'),
(4004, '25M', 'CARABAYLLO-FTTH-25M'),
(4004, '400M', 'CARABAYLLO-FTTH-400M'),
(4004, '50M', 'CARABAYLLO-FTTH-50M'),
(4004, 'CATV', 'CARABAYLLO-FTTH-CATV'),
(3002, '100M', 'CHOSICA 1-FTTH-100M'),
(3002, '10M', 'CHOSICA 1-FTTH-10M'),
(3002, '150M', 'CHOSICA 1-FTTH-150M'),
(3002, '16M', 'CHOSICA 1-FTTH-16M'),
(3002, '200M', 'CHOSICA 1-FTTH-200M'),
(3002, '25M', 'CHOSICA 1-FTTH-25M'),
(3002, '30M', 'CHOSICA 1-FTTH-30M'),
(3002, '400M', 'CHOSICA 1-FTTH-400M'),
(3002, '50M', 'CHOSICA 1-FTTH-50M'),
(3002, 'CATV', 'CHOSICA 1-FTTH-CATV'),
(3006, '100M', 'CHOSICA 2-FTTH-100M'),
(3006, '10M', 'CHOSICA 2-FTTH-10M'),
(3006, '150M', 'CHOSICA 2-FTTH-150M'),
(3006, '16M', 'CHOSICA 2-FTTH-16M'),
(3006, '200M', 'CHOSICA 2-FTTH-200M'),
(3006, '25M', 'CHOSICA 2-FTTH-25M'),
(3006, '30M', 'CHOSICA 2-FTTH-30M'),
(3006, '400M', 'CHOSICA 2-FTTH-400M'),
(3006, '50M', 'CHOSICA 2-FTTH-50M'),
(3006, 'CATV', 'CHOSICA 2-FTTH-CATV'),
(3055, '100M', 'CHOSICA-DESLIST-100M'),
(3055, '10M', 'CHOSICA-DESLIST-10M'),
(3055, '150M', 'CHOSICA-DESLIST-150M'),
(3055, '16M', 'CHOSICA-DESLIST-16M'),
(3055, '200M', 'CHOSICA-DESLIST-200M'),
(3055, '25M', 'CHOSICA-DESLIST-25M'),
(3055, '400M', 'CHOSICA-DESLIST-400M'),
(3055, '50M', 'CHOSICA-DESLIST-50M'),
(3613, '10M', 'CHOSICA-EOC-10M'),
(3613, '16M', 'CHOSICA-EOC-16M'),
(3613, '25M', 'CHOSICA-EOC-25M'),
(3056, '100M', 'HUAYCAN-DESLIST-100M'),
(3056, '10M', 'HUAYCAN-DESLIST-10M'),
(3056, '150M', 'HUAYCAN-DESLIST-150M'),
(3056, '16M', 'HUAYCAN-DESLIST-16M'),
(3056, '200M', 'HUAYCAN-DESLIST-200M'),
(3056, '25M', 'HUAYCAN-DESLIST-25M'),
(3056, '50M', 'HUAYCAN-DESLIST-50M'),
(3001, '100M', 'HUAYCAN-FTTH-100M'),
(3001, '10M', 'HUAYCAN-FTTH-10M'),
(3001, '150M', 'HUAYCAN-FTTH-150M'),
(3001, '16M', 'HUAYCAN-FTTH-16M'),
(3001, '200M', 'HUAYCAN-FTTH-200M'),
(3001, '25M', 'HUAYCAN-FTTH-25M'),
(3001, '30M', 'HUAYCAN-FTTH-30M'),
(3001, '400M', 'HUAYCAN-FTTH-400M'),
(3001, '50M', 'HUAYCAN-FTTH-50M'),
(3001, 'CATV', 'HUAYCAN-FTTH-CATV'),
(4011, '100M', 'LOS OLIVOS 1-FTTH-100M'),
(4011, '10M', 'LOS OLIVOS 1-FTTH-10M'),
(4011, '150M', 'LOS OLIVOS 1-FTTH-150M'),
(4011, '16M', 'LOS OLIVOS 1-FTTH-16M'),
(4011, '200M', 'LOS OLIVOS 1-FTTH-200M'),
(4011, '25M', 'LOS OLIVOS 1-FTTH-25M'),
(4011, '30M', 'LOS OLIVOS 1-FTTH-30M'),
(4011, '50M', 'LOS OLIVOS 1-FTTH-50M'),
(4011, 'CATV', 'LOS OLIVOS 1-FTTH-CATV'),
(4012, '100M', 'LOS OLIVOS 2-FTTH-100M'),
(4012, '10M', 'LOS OLIVOS 2-FTTH-10M'),
(4012, '150M', 'LOS OLIVOS 2-FTTH-150M'),
(4012, '16M', 'LOS OLIVOS 2-FTTH-16M'),
(4012, '200M', 'LOS OLIVOS 2-FTTH-200M'),
(4012, '25M', 'LOS OLIVOS 2-FTTH-25M'),
(4012, '30M', 'LOS OLIVOS 2-FTTH-30M'),
(4012, '400M', 'LOS OLIVOS 2-FTTH-400M'),
(4012, '50M', 'LOS OLIVOS 2-FTTH-50M'),
(4012, 'CATV', 'LOS OLIVOS 2-FTTH-CATV'),
(4014, '100M', 'LOS OLIVOS 3-FTTH-100M'),
(4014, '10M', 'LOS OLIVOS 3-FTTH-10M'),
(4014, '150M', 'LOS OLIVOS 3-FTTH-150M'),
(4014, '16M', 'LOS OLIVOS 3-FTTH-16M'),
(4014, '200M', 'LOS OLIVOS 3-FTTH-200M'),
(4014, '25M', 'LOS OLIVOS 3-FTTH-25M'),
(4014, '30M', 'LOS OLIVOS 3-FTTH-30M'),
(4014, '30M', 'LOS OLIVOS 3-FTTH-30M'),
(4014, '400M', 'LOS OLIVOS 3-FTTH-400M'),
(4014, '50M', 'LOS OLIVOS 3-FTTH-50M'),
(4014, 'CATV', 'LOS OLIVOS 3-FTTH-CATV'),
(3051, '100M', 'LOS OLIVOS-DESLIST-100M'),
(3051, '10M', 'LOS OLIVOS-DESLIST-10M'),
(3051, '16M', 'LOS OLIVOS-DESLIST-16M'),
(3051, '200M', 'LOS OLIVOS-DESLIST-200M'),
(3051, '25M', 'LOS OLIVOS-DESLIST-25M'),
(3051, '400M', 'LOS OLIVOS-DESLIST-400M'),
(3051, '50M', 'LOS OLIVOS-DESLIST-50M'),
(3054, '100M', 'ÑAÑA-DESLIST-100M'),
(3054, '10M', 'ÑAÑA-DESLIST-10M'),
(3054, '150M', 'ÑAÑA-DESLIST-150M'),
(3054, '16M', 'ÑAÑA-DESLIST-16M'),
(3054, '200M', 'ÑAÑA-DESLIST-200M'),
(3054, '25M', 'ÑAÑA-DESLIST-25M'),
(3054, '30M', 'ÑAÑA-DESLIST-30M'),
(3054, '400M', 'ÑAÑA-DESLIST-400M'),
(3054, '50M', 'ÑAÑA-DESLIST-50M'),
(3713, '10M', 'ÑAÑA-EOC-10M'),
(3713, '16M', 'ÑAÑA-EOC-16M'),
(3713, '25M', 'ÑAÑA-EOC-25M'),
(3000, '100M', 'ÑAÑA-FTTH-100M'),
(3000, '10M', 'ÑAÑA-FTTH-10M'),
(3000, '150M', 'ÑAÑA-FTTH-150M'),
(3000, '16M', 'ÑAÑA-FTTH-16M'),
(3000, '200M', 'ÑAÑA-FTTH-200M'),
(3000, '25M', 'ÑAÑA-FTTH-25M'),
(3000, '30M', 'ÑAÑA-FTTH-30M'),
(3000, '400M', 'ÑAÑA-FTTH-400M'),
(3000, '50M', 'ÑAÑA-FTTH-50M'),
(3000, 'CATV', 'ÑAÑA-FTTH-CATV'),
(3497, '10M', 'OLIVOS 3-EOC-10M'),
(3497, '16M', 'OLIVOS 3-EOC-16M'),
(3497, '25M', 'OLIVOS 3-EOC-25M'),
(3501, '10M', 'OLIVOS1-EOC-10M'),
(3501, '16M', 'OLIVOS1-EOC-16M'),
(3501, '25M', 'OLIVOS1-EOC-25M'),
(3499, '10M', 'OLIVOS2-EOC-10M'),
(3499, '16M', 'OLIVOS2-EOC-16M'),
(3499, '25M', 'OLIVOS2-EOC-25M'),
(3052, '100M', 'PUENTE PIEDRA-DESLIST-100M'),
(3052, '10M', 'PUENTE PIEDRA-DESLIST-10M'),
(3052, '150M', 'PUENTE PIEDRA-DESLIST-150M'),
(3052, '16M', 'PUENTE PIEDRA-DESLIST-16M'),
(3052, '200M', 'PUENTE PIEDRA-DESLIST-200M'),
(3052, '25M', 'PUENTE PIEDRA-DESLIST-25M'),
(3052, '400M', 'PUENTE PIEDRA-DESLIST-400M'),
(3052, '50M', 'PUENTE PIEDRA-DESLIST-50M'),
(3913, '10M', 'PUENTE PIEDRA-EOC-10M'),
(3913, '16M', 'PUENTE PIEDRA-EOC-16M'),
(3913, '25M', 'PUENTE PIEDRA-EOC-25M'),
(4005, '100M', 'PUENTE PIEDRA-FTTH-100M'),
(4005, '10M', 'PUENTE PIEDRA-FTTH-10M'),
(4005, '150M', 'PUENTE PIEDRA-FTTH-150M'),
(4005, '16M', 'PUENTE PIEDRA-FTTH-16M'),
(4005, '200M', 'PUENTE PIEDRA-FTTH-200M'),
(4005, '25M', 'PUENTE PIEDRA-FTTH-25M'),
(4005, '30M', 'PUENTE PIEDRA-FTTH-30M'),
(4005, '400M', 'PUENTE PIEDRA-FTTH-400M'),
(4005, '50M', 'PUENTE PIEDRA-FTTH-50M'),
(4005, 'CATV', 'PUENTE PIEDRA-FTTH-CATV');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre`) VALUES
(1, 'instalado'),
(2, 'Derivado a planta Externa'),
(3, 'Solucionado'),
(4, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `id_evaluacion` int(11) NOT NULL,
  `detalle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`id_evaluacion`, `detalle`) VALUES
(1, 'Bueno'),
(2, 'Regular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filial`
--

CREATE TABLE `filial` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `site` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `filial`
--

INSERT INTO `filial` (`id`, `nombre`, `site`) VALUES
(1, 'LOS OLIVOS', '0101'),
(2, 'CHOSICA', '0501'),
(3, 'COMAS', '0301'),
(4, 'HUAYCÁN', '0601'),
(5, 'ÑAÑA', '0401'),
(6, 'PUENTE PIEDRA', '0201');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalacionftth`
--

CREATE TABLE `instalacionftth` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `operador` text NOT NULL,
  `filial` text NOT NULL,
  `os` text NOT NULL,
  `abonado` text NOT NULL,
  `codabonado` text NOT NULL,
  `caja` int(11) NOT NULL,
  `borne` int(11) NOT NULL,
  `precinto` int(11) NOT NULL,
  `mac` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instalacionftth`
--

INSERT INTO `instalacionftth` (`id`, `fecha`, `operador`, `filial`, `os`, `abonado`, `codabonado`, `caja`, `borne`, `precinto`, `mac`) VALUES
(6, '2024-01-08', 'operador', '1', '50', '50', '50@01010113', 50, 50, 0, 'FDCD'),
(7, '2024-01-08', 'operador', '1', 'FDCD', 'FDCD', 'FDCD@01010113', 0, 0, 0, 'FDCD'),
(8, '2024-01-08', 'operador', '2', 'FDCD', 'FDCD', 'FDCD@05010113', 0, 0, 0, 'FDCD'),
(9, '2024-01-10', 'operador', '1', '00080235', '90430', '90430@01010804', 3697, 5, 0, 'EB9D'),
(10, '2024-01-10', 'operador', '1', '00080248', '90440', '90440@01011608', 1605, 4, 0, '4045'),
(11, '2024-01-10', 'operador', '1', '5995', '5995', '5995@01010206', 5995, 5995, 0, '5995'),
(12, '2024-01-10', 'operador', '2', '13359', '13359', '13359@05010208', 13359, 13359, 0, '356D'),
(13, '2024-01-10', 'operador', '1', '06537', '06537', '06537@01011709', 6537, 6537, 0, '67C5'),
(14, '2024-01-11', 'operador', '1', '20', '20', '20@01010113', 20, 202, 0, 'FDCD'),
(15, '2024-01-11', 'operador', '1', '2', '0', '0@01010113', 2, 2, 0, 'FDCD'),
(16, '2024-01-11', 'operador', '1', '20212', '20212', '20212@0101', 20212, 20212, 0, 'FDCD'),
(17, '2024-01-11', 'operador', '1', '4545', '4545', '4545@01010113', 45, 45, 0, 'FDCD'),
(18, '2024-01-12', 'operador', '1', 'SADF', 'ASDFASF', 'ASDFASF@01012020', 0, 0, 0, 'SDASDAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operador`
--

CREATE TABLE `operador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `accesso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `operador`
--

INSERT INTO `operador` (`id`, `nombre`, `accesso`) VALUES
(1, 'Eswin Mora', '123'),
(2, 'Abraham Paredes', '123'),
(3, 'Carlos Sánchez', '123'),
(4, 'Luis Miguel', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnologia`
--

CREATE TABLE `tecnologia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tecnologia`
--

INSERT INTO `tecnologia` (`id`, `nombre`) VALUES
(1, 'FTTH'),
(2, 'EOC'),
(3, 'IPTV con Triplexor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_orden`
--

CREATE TABLE `tipos_orden` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_orden`
--

INSERT INTO `tipos_orden` (`id`, `nombre`) VALUES
(1, 'INSTALACIÓN'),
(2, 'AVERÍA'),
(3, 'MUDANZA'),
(4, 'MIGRACIÓN'),
(5, 'RECONEXIÓN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_averia`
--

CREATE TABLE `t_averia` (
  `id_averia` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `t_averia`
--

INSERT INTO `t_averia` (`id_averia`, `nombre`) VALUES
(1, 'Internet Lento'),
(2, 'Cambio de Equipo'),
(3, 'NA'),
(4, 'Desconfiguracion de Equipo'),
(5, 'Intermitencia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `instalacionftth`
--
ALTER TABLE `instalacionftth`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `operador`
--
ALTER TABLE `operador`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `instalacionftth`
--
ALTER TABLE `instalacionftth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `operador`
--
ALTER TABLE `operador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
