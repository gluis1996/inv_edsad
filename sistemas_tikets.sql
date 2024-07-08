-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-07-2024 a las 23:19:37
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
-- Base de datos: `sistemas_tikets`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `warranty_expiration` date DEFAULT NULL,
  `status` enum('disponible','en uso','mantenimiento','dado de baja') NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipment`
--

INSERT INTO `equipment` (`equipment_id`, `name`, `description`, `serial_number`, `purchase_date`, `warranty_expiration`, `status`, `location`, `created_at`) VALUES
(1, 'Laptop Dell', 'Laptop para el equipo de desarrollo', 'SN123456789', '2024-01-01', '2026-01-01', 'disponible', 'Oficina 101', '2024-07-07 04:31:00'),
(2, 'Router Cisco', 'Router principal de la oficina', 'SN987654321', '2023-07-01', '2025-07-01', 'en uso', 'Sala de servidores', '2024-07-07 04:31:00'),
(3, 'Monitor HP', 'Monitor adicional para diseño gráfico', 'SN112233445', '2023-05-15', '2025-05-15', 'disponible', 'Oficina 102', '2024-07-07 04:31:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('abierto','en proceso','resuelto','cerrado') DEFAULT 'abierto',
  `priority` enum('baja','media','alta','crítica') DEFAULT 'baja',
  `created_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `title`, `description`, `status`, `priority`, `created_by`, `assigned_to`, `equipment_id`, `created_at`, `updated_at`) VALUES
(1, 'Pantalla azul en Laptop Dell', 'La laptop muestra una pantalla azul al encenderla.', 'en proceso', 'alta', 1, 4, 1, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(2, 'Problema de conexión en Router Cisco', 'El router pierde conexión intermitente.', 'en proceso', 'crítica', 2, 4, 2, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(3, 'Fallo en el monitor HP', 'El monitor parpadea al encenderlo.', 'en proceso', 'media', 1, 3, 3, '2024-07-07 04:40:40', '2024-07-07 04:41:03'),
(4, 'Actualización de software en Laptop Dell', 'Necesita actualización de software.', 'resuelto', 'baja', 2, 3, 1, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(5, 'Configuración de red en Router Cisco', 'Necesita configuración avanzada.', 'en proceso', 'alta', 1, 4, 2, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(6, 'Reemplazo de teclado en Laptop Dell', 'El teclado no funciona correctamente.', 'en proceso', 'media', 2, 4, 1, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(7, 'Problema de impresión', 'La impresora no imprime.', 'en proceso', 'alta', 1, 3, 1, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(8, 'Configuración de correo', 'No se puede configurar el correo en el equipo.', 'abierto', 'baja', 2, 4, 3, '2024-07-07 04:40:40', '2024-07-07 04:41:03'),
(9, 'Actualización de drivers', 'Necesita actualización de drivers.', 'resuelto', 'media', 1, 4, 2, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(10, 'Fallo de audio en Laptop Dell', 'No se escucha el audio.', 'en proceso', 'crítica', 2, 4, 1, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(11, 'Problema de pantalla', 'La pantalla se ve borrosa.', 'en proceso', 'alta', 1, 4, 3, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(12, 'Problema de red', 'No se conecta a la red.', 'en proceso', 'crítica', 2, 4, 2, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(13, 'Problema de encendido en Laptop Dell', 'No enciende.', 'en proceso', 'alta', 1, 3, 1, '2024-07-07 04:40:40', '2024-07-07 04:41:03'),
(14, 'Fallo en el mouse', 'El mouse no responde.', 'resuelto', 'baja', 2, 4, 3, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(15, 'Problema de software', 'Error en el software instalado.', 'cerrado', 'media', 1, 4, 2, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(16, 'Fallo en la batería', 'La batería no carga.', 'en proceso', 'crítica', 2, 4, 1, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(17, 'Problema de ventilación', 'El equipo se sobrecalienta.', 'cerrado', 'alta', 1, 4, 3, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(18, 'Fallo en la cámara', 'La cámara no funciona.', 'en proceso', 'media', 2, 3, 1, '2024-07-07 04:40:40', '2024-07-07 04:41:03'),
(19, 'Actualización del sistema operativo', 'Se necesita actualizar el SO.', 'en proceso', 'baja', 1, 4, 2, '2024-07-07 04:40:40', '2024-07-07 04:41:16'),
(20, 'Problema de rendimiento', 'El equipo va muy lento.', 'abierto', 'crítica', 2, 4, 3, '2024-07-07 04:40:40', '2024-07-07 04:41:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_activities`
--

CREATE TABLE `ticket_activities` (
  `activity_id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity_type` enum('creado','asignado','actualizado','resuelto','cerrado') NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ticket_activities`
--

INSERT INTO `ticket_activities` (`activity_id`, `ticket_id`, `user_id`, `activity_type`, `description`, `created_at`) VALUES
(21, 1, 3, 'actualizado', 'El ticket está en proceso de resolución.', '2024-07-07 04:41:37'),
(22, 2, 4, 'actualizado', 'El ticket está en proceso de resolución.', '2024-07-07 04:41:37'),
(23, 3, 3, 'asignado', 'El ticket ha sido asignado al agente 1.', '2024-07-07 04:41:37'),
(24, 4, 3, 'resuelto', 'El problema ha sido resuelto y el ticket está cerrado.', '2024-07-07 04:41:37'),
(25, 5, 4, 'actualizado', 'El ticket está en proceso de resolución.', '2024-07-07 04:41:37'),
(26, 6, 4, 'actualizado', 'El ticket está en proceso de resolución.', '2024-07-07 04:41:37'),
(27, 7, 3, 'asignado', 'El ticket ha sido asignado al agente 1.', '2024-07-07 04:41:37'),
(28, 8, 4, 'asignado', 'El ticket ha sido asignado al agente 2.', '2024-07-07 04:41:37'),
(29, 9, 4, 'resuelto', 'El problema ha sido resuelto y el ticket está cerrado.', '2024-07-07 04:41:37'),
(30, 10, 4, 'actualizado', 'El ticket está en proceso de resolución.', '2024-07-07 04:41:37'),
(31, 11, 4, 'actualizado', 'El ticket está en proceso de resolución.', '2024-07-07 04:41:37'),
(32, 12, 4, 'actualizado', 'El ticket está en proceso de resolución.', '2024-07-07 04:41:37'),
(33, 13, 3, 'asignado', 'El ticket ha sido asignado al agente 1.', '2024-07-07 04:41:37'),
(34, 14, 4, 'resuelto', 'El problema ha sido resuelto y el ticket está cerrado.', '2024-07-07 04:41:37'),
(35, 15, 4, 'cerrado', 'El ticket ha sido cerrado.', '2024-07-07 04:41:37'),
(36, 16, 4, 'actualizado', 'El ticket está en proceso de resolución.', '2024-07-07 04:41:37'),
(37, 17, 4, 'cerrado', 'El ticket ha sido cerrado.', '2024-07-07 04:41:37'),
(38, 18, 3, 'asignado', 'El ticket ha sido asignado al agente 1.', '2024-07-07 04:41:37'),
(39, 19, 4, 'actualizado', 'El ticket está en proceso de resolución.', '2024-07-07 04:41:37'),
(40, 20, 4, 'actualizado', 'El ticket está en proceso de resolución.', '2024-07-07 04:41:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_attachments`
--

CREATE TABLE `ticket_attachments` (
  `attachment_id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_comments`
--

CREATE TABLE `ticket_comments` (
  `comment_id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ticket_comments`
--

INSERT INTO `ticket_comments` (`comment_id`, `ticket_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 1, 3, 'He identificado que el problema es debido a un conflicto de drivers.', '2024-07-07 04:41:25'),
(2, 2, 4, 'El problema de conexión se debe a una configuración incorrecta.', '2024-07-07 04:41:25'),
(3, 3, 3, 'Estoy revisando el problema del monitor.', '2024-07-07 04:41:25'),
(4, 4, 3, 'El software ha sido actualizado correctamente.', '2024-07-07 04:41:25'),
(5, 5, 4, 'La configuración de red ha sido completada.', '2024-07-07 04:41:25'),
(6, 6, 4, 'Estoy reemplazando el teclado defectuoso.', '2024-07-07 04:41:25'),
(7, 7, 3, 'Estoy revisando el problema de impresión.', '2024-07-07 04:41:25'),
(8, 8, 4, 'No se puede configurar el correo debido a restricciones de la red.', '2024-07-07 04:41:25'),
(9, 9, 4, 'Los drivers han sido actualizados correctamente.', '2024-07-07 04:41:25'),
(10, 10, 4, 'El problema de audio se debía a un fallo en el hardware.', '2024-07-07 04:41:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('usuario','agente','administrador') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(1, 'juanperez', 'hashed_password', 'juan.perez@example.com', 'usuario', '2024-07-07 04:05:24'),
(2, 'usuario1', 'hashed_password1', 'usuario1@example.com', 'usuario', '2024-07-07 04:31:27'),
(3, 'usuario2', 'hashed_password2', 'usuario2@example.com', 'usuario', '2024-07-07 04:31:27'),
(4, 'agente1', 'hashed_password3', 'agente1@example.com', 'agente', '2024-07-07 04:31:27'),
(5, 'agente2', 'hashed_password4', 'agente2@example.com', 'agente', '2024-07-07 04:31:27'),
(6, 'admin1', 'hashed_password5', 'admin1@example.com', 'administrador', '2024-07-07 04:31:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `assigned_to` (`assigned_to`),
  ADD KEY `equipment_id` (`equipment_id`);

--
-- Indices de la tabla `ticket_activities`
--
ALTER TABLE `ticket_activities`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD PRIMARY KEY (`attachment_id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indices de la tabla `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ticket_activities`
--
ALTER TABLE `ticket_activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket_comments`
--
ALTER TABLE `ticket_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`);

--
-- Filtros para la tabla `ticket_activities`
--
ALTER TABLE `ticket_activities`
  ADD CONSTRAINT `ticket_activities_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`),
  ADD CONSTRAINT `ticket_activities_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD CONSTRAINT `ticket_attachments_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`),
  ADD CONSTRAINT `ticket_attachments_ibfk_2` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD CONSTRAINT `ticket_comments_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`),
  ADD CONSTRAINT `ticket_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
