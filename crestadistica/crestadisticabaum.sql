-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Servidor: mysql.mediabaum.com
-- Tiempo de generación: 11-03-2016 a las 04:07:55
-- Versión del servidor: 5.6.25-log
-- Versión de PHP: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crestadistica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keys`
--

CREATE TABLE `keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `fecha_insercion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `keys`
--

INSERT INTO `keys` (`id`, `hash`, `email`, `fecha_insercion`) VALUES
(8, '4N12crO8HDcY', 'imagenialidad@gmail.com', '2015-04-12 01:15:12'),
(9, 'UP5lclWcTl5q', 'imagenialidad@gmail.com', '2015-05-20 22:23:05'),
(10, 'cay1iMvFfXC5', 'imagenialidad@gmail.com', '2015-07-22 22:10:57'),
(11, 'Q3jbqwKePJJU', 'imagenialidad@gmail.com', '2015-07-22 22:36:01'),
(12, '2FSgSsY2vLoT', 'imagsad@gmail.com', '2015-07-22 22:42:16'),
(13, '3R4I102R0Sy2', '0', '2015-07-22 22:42:43'),
(15, 'KRYkTWStlP6i', '0', '2015-07-22 22:43:31'),
(16, 'z8BH4rftemnP', 'imagenialidad@gmail.com', '2015-07-22 22:43:50'),
(17, 'MwbSDW7aivaF', 'imagsad@gmail.com', '2015-07-23 21:02:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `anio` varchar(50) DEFAULT NULL,
  `cuatrimestre` int(1) DEFAULT NULL,
  `material` int(1) DEFAULT NULL COMMENT '1: Pdf; 2:imagen; 3:link',
  `archivo` varchar(250) DEFAULT NULL,
  `tipo` int(1) DEFAULT NULL COMMENT '0:comun; 1:novedades',
  `fecha` date DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`, `titulo`, `descripcion`, `anio`, `cuatrimestre`, `material`, `archivo`, `tipo`, `fecha`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(10, 'hhh', 'kkk', 'mbb', ' 2010', 2, 2, 'Bluebird shot.jpg', 1, '2012-02-22', '2015-09-12 17:38:51', NULL),
(11, 'hjk', 'jhjk', 'hkjhjk', ' 2010', 1, 2, 'IMG-20150810-WA0013.jpg', 1, '2012-02-12', '2015-09-12 17:45:15', NULL),
(12, 'nnn', 'dddd', 'KHjkks', ' 2010', 2, 2, 'file0002092098607.jpg', 0, '2012-02-22', '2015-09-12 17:49:08', NULL),
(13, 'hhhLll', 'hhhhhjj', 'khjkhjhkj', ' 2012', 1, 2, 'IMG-20150810-WA0013.jpg', 1, '2012-02-13', '2015-09-12 17:49:45', NULL),
(16, 'queda en segundo cuatrimestre y modulo novedades', 'queda modulo generico', 'Modificado y es del 2012, y segundo cuatrimestre', ' 2012', 1, 2, 'rojo_133_40.png', 0, '2012-02-16', '2015-09-12 17:59:15', '2016-02-09 16:15:42'),
(17, 'hkjh', 'jkhkjh', 'kjhkjhk', ' 2010', 2, 1, 'Bluebird shot.jpg', 1, '0000-00-00', '2015-09-12 17:59:36', '2016-02-09 16:33:02'),
(18, 'Test diciembre 15', 'Saludo', 'Test modulo', ' 2012', 2, 1, 'certificado_medico.pdf', 1, '2012-02-23', '2015-12-23 10:19:16', NULL),
(19, 'kjljlkjk', 'kjjklj', 'lkjljlkjl', ' 2010', 1, 1, 'Guion_tp1 . corregido.pdf', 1, '2012-02-03', '2015-12-23 10:32:13', NULL),
(22, 'Pulpoficción', 'Saludo', 'sss', ' 2012', 2, 1, NULL, 0, '0000-00-00', '2016-02-09 19:37:47', '2016-02-09 19:39:23'),
(23, 'Pulpoficción', 'Saludo', 'imdb link!', ' 2010', 2, 1, 'Visa_5233.pdf', 1, '0000-00-00', '2016-02-09 19:40:21', '2016-02-09 19:43:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(0, 'estudiante'),
(1, 'admin'),
(2, 'tester');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellido` varchar(32) NOT NULL,
  `dni` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `fecha_nacimiento` varchar(32) NOT NULL,
  `ciudad_nacimiento` varchar(100) NOT NULL,
  `edad` varchar(6) NOT NULL,
  `genero` varchar(32) NOT NULL,
  `carrera` varchar(100) NOT NULL,
  `recursa` smallint(1) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` smallint(1) NOT NULL,
  `rol` int(11) NOT NULL,
  `fecha_ingreso` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `dni`, `email`, `fecha_nacimiento`, `ciudad_nacimiento`, `edad`, `genero`, `carrera`, `recursa`, `password`, `status`, `rol`, `fecha_ingreso`, `fecha_actualizacion`) VALUES
(15, 'Ahora soy el admin', 'Este es minonbre', '123456', 'admin2@crestadisticas.com', '00-00-0000', '0000', '0', '0', '0', 0, 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '0000-00-00 00:00:00', '2015-05-10 19:57:38'),
(18, 'juan', 'pedro', '94519477', 'iuum@fmil.com', '19-02-2012', 'cali', '23', 'hombre', '1', 1, '63930de56f5e959b0be6b1716ed354cb', 1, 0, '0000-00-00 00:00:00', NULL),
(20, 'Fulano', 'de tal', '99999', 'imag90ww9e@gmail.com', '12-02-2012', 'cali', '23', 'mujer', '2', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '2015-04-06 01:08:40', NULL),
(22, 'Sultanito', 'Perez', '12345678', 'ims@gmail.com', '06-02-2012', 'cali', '23', 'hombre', '1', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '2015-04-11 01:21:49', NULL),
(23, 'Sultanito', 'de tal', '1234', 'ism@fmil.com', '06-02-2012', 'cali', '23', 'hombre', '1', 1, '8f5d8792372ce505baa9086d370bfce9', 0, 0, '2015-04-14 19:30:05', NULL),
(35, 'Fulano', 'de tal', '54321', 'imagsad@gmail.com', '12-02-2012', 'Cali', '23', 'hombre', '1', 1, 'a12db6261074734ec32d426ec075275b', 0, 0, '2015-05-09 23:31:30', NULL),
(40, 'Jhonattan', 'Campo', '94519471', 'imagenialidad@gmail.com', '06-02-2012', 'Buenos Aires', '31', 'hombre', 'Arquitectura', 1, 'd18cc3d204707f2cae9cd5ba988b3ddb', 1, 0, '2016-02-10 06:30:38', '2016-02-10 07:14:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE `usuarios_roles` (
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`dni`);

--
-- Indices de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD PRIMARY KEY (`usuario_id`,`rol_id`),
  ADD KEY `FK_usuarios_roles_roles_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD CONSTRAINT `FK_usuarios_roles_roles_id` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_usuarios_roles_usuarios_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
