-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-02-2024 a las 23:11:42
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
-- Base de datos: `integracionesolt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalacioneoc`
--

CREATE TABLE `instalacioneoc` (
  `id` int(11) NOT NULL,
  `filial` int(11) NOT NULL,
  `operador` varchar(45) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `nodo` text NOT NULL,
  `mac` varchar(45) NOT NULL,
  `vlan` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `coordenada` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `instalacioneoc`
--

INSERT INTO `instalacioneoc` (`id`, `filial`, `operador`, `codigo`, `nodo`, `mac`, `vlan`, `speed`, `coordenada`) VALUES
(1, 1, 'lgonzalo', '2020', '220@2020', '20', 22, 2, '20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `instalacioneoc`
--
ALTER TABLE `instalacioneoc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `instalacioneoc`
--
ALTER TABLE `instalacioneoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
