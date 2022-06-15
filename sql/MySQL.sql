-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 15-06-2022 a las 04:27:42
-- Versión del servidor: 5.6.51
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `total_solution`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` char(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(2, 'PQRSD'),
(3, 'Administracion Bases de Datos'),
(4, 'Administracion de Backup'),
(5, 'Administracion de Servidores'),
(6, 'Aplicaciones'),
(7, 'Carpetas Compartidas'),
(8, 'Configuracion Firewall'),
(9, 'Configuracion de Red'),
(10, 'Control de Acceso'),
(11, 'Equipos Computo'),
(12, 'FileServer'),
(13, 'Impresoras'),
(14, 'Internet'),
(15, 'Otros TI'),
(16, 'Seguridad'),
(17, 'Telefonia'),
(18, 'UE - Insumos'),
(19, 'UE - Rerpote de Operarios'),
(20, 'Usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_spanish_ci NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_user`
--

CREATE TABLE `group_user` (
  `id` int(11) NOT NULL,
  `group_name` char(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `group_user`
--

INSERT INTO `group_user` (`id`, `group_name`) VALUES
(1, 'Sin asignar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `handbook`
--

CREATE TABLE `handbook` (
  `id` int(11) NOT NULL,
  `title` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `role` char(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `role`) VALUES
(1, 'Administrador'),
(2, 'Soporte'),
(3, 'Usuario Interno'),
(4, 'Usuario Externo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `subcategory` char(150) COLLATE utf8_spanish_ci NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subcategory`
--

INSERT INTO `subcategory` (`id`, `subcategory`, `category_id`) VALUES
(1, 'Petición', 2),
(2, 'Queja', 2),
(3, 'Reclamo', 2),
(4, 'Solicitud', 2),
(5, 'Denuncia', 2),
(6, 'Creacion de Backup', 3),
(7, 'Restaurar Backup', 3),
(8, 'Cancelar Respaldo', 3),
(9, 'Eliminar Backup', 3),
(10, 'Falla/Indiosponibilidad', 4),
(11, 'Gestion de Vulnerabilidades', 4),
(12, 'Instalacion', 4),
(13, 'Prueba de Continuidad', 4),
(14, 'Falla/Indiosponibilidad', 5),
(15, 'Actualizacion', 5),
(16, 'Reinicio de servicios', 5),
(17, 'Lentitud en el servicio', 5),
(18, 'Evaluacion de rendimiento', 5),
(19, 'Configuracion', 6),
(20, 'Falla/Indiosponibilidad', 6),
(21, 'Actualizacion de Credenciales', 6),
(22, 'Revision de Router', 7),
(23, 'Configuracion de IP Reservada', 7),
(24, 'Mantenimiento', 7),
(25, 'Reinicio de servicio', 7),
(26, 'Solicitud de Enrutamiento', 7),
(27, 'Configuracion de equipos', 8),
(28, 'Falla/Indisponiobilidad', 8),
(29, 'Gestion de Vulnerabilidades', 8),
(30, 'Asigacion de equipos', 8),
(31, 'Actualizacion aprchers de seguridad', 8),
(32, 'Traslado', 8),
(33, 'Navegacion de Usuario', 9),
(34, 'Falla/Indisponiobilidad', 9),
(35, 'Gestion de Vulnerabilidades', 9),
(36, 'Configuracion', 9),
(37, 'Asignacion o Cambio Telefono IP', 10),
(38, 'Configuracion', 10),
(39, 'Desmonte de equipos', 10),
(40, 'Mantenimiento', 10),
(41, 'Inclusion de linea', 10),
(42, 'Actualizacion de base de datos', 11),
(43, 'Consulta Base de Datos', 11),
(44, 'Ejecucion de JOB', 11),
(45, 'Ejecutar Script', 11),
(46, 'Falla/Indiosponibilidad', 11),
(47, 'Creacion Carpeta Compartida', 12),
(48, 'Falla/Indiosponibilidad', 12),
(49, 'Modificacion Carpeta Compartida', 12),
(50, 'Creacion/Mopdificacion de permisos', 13),
(51, 'Falla/Indiosponibilidad', 13),
(52, 'Aumento de capacidad', 13),
(53, 'Lentitud en el servicio', 13),
(54, 'Evaluacion de rendimiento', 13),
(55, 'Falla/Indiosponibilidad', 14),
(56, 'Restablecer contraseña', 14),
(57, 'Modificacion de permisos', 14),
(58, 'Reinicio de aplicaciones', 15),
(59, 'Falla o lentitud en las aplicaciones', 15),
(60, 'Evaluacion de rendimiento', 15),
(61, 'Actualizacion/Configuracion de aplicaciones', 15),
(62, 'Actualizacion/Configuracion de licencias', 15),
(63, 'Configuracion', 16),
(64, 'Falla/Indiosponibilidad', 16),
(65, 'Instalacion', 16),
(66, 'Cambion de toner', 16),
(67, 'Asignacion/Modificacion Pantalla', 17),
(68, 'Asignacion/Modificacion Teclado', 17),
(69, 'Asignacion/Modificacion Mouse', 17),
(70, 'Asignacion/Modificacion Proyector', 17),
(71, 'Otros requerimientos TI', 17),
(72, 'Copia de informacion a medios extraibles', 18),
(73, 'Configuracion de antivirus', 18),
(74, 'Habilitar/Modificar puertos', 18),
(75, 'Autirzacion de envio de correos con informacion sensible', 18),
(76, 'Insumos Vencidos', 19),
(77, 'Insumos Escacos', 19),
(78, 'Insumos Otros', 19),
(79, 'Reporte de Incidentes', 20),
(80, 'Reporte de Inasistencia', 20),
(81, 'Reporte de Comportamiento', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `subject` text COLLATE utf8_spanish_ci NOT NULL,
  `priority` char(30) COLLATE utf8_spanish_ci NOT NULL,
  `email` char(150) COLLATE utf8_spanish_ci NOT NULL,
  `phone` bigint(20) NOT NULL,
  `description` longtext COLLATE utf8_spanish_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `files` text COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_status_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_status`
--

CREATE TABLE `ticket_status` (
  `id` int(11) NOT NULL,
  `ticket_status` char(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ticket_status`
--

INSERT INTO `ticket_status` (`id`, `ticket_status`) VALUES
(1, 'Abierto'),
(2, 'En Progreso'),
(3, 'Reasignado'),
(4, 'Cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `employee_id` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `name` char(150) COLLATE utf8_spanish_ci NOT NULL,
  `email` char(150) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `group_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Users Table';

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `employee_id`, `name`, `email`, `password`, `status`, `group_id`, `role_id`, `created_at`, `modified_at`) VALUES
(1, '1012', 'JOAN NIETO', 'administrador@totalsolution.com', '$2y$10$5hnbGHmBQj9e0wDAN5Y7Xe98kuTGtQi7eTr0B18jEPEB81lVwehM6', 1, 1, 1, '2022-04-13 16:03:13', '2022-04-13 16:03:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uesr_id` (`user_id`),
  ADD KEY `comments_ibfk_1` (`ticket_id`);

--
-- Indices de la tabla `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `handbook`
--
ALTER TABLE `handbook`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `ticket_status_id` (`ticket_status_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `ticket_status`
--
ALTER TABLE `ticket_status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `handbook`
--
ALTER TABLE `handbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket_status`
--
ALTER TABLE `ticket_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`ticket_status_id`) REFERENCES `ticket_status` (`id`),
  ADD CONSTRAINT `ticket_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
