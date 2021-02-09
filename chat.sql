-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2021 a las 08:16:48
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(5) UNSIGNED NOT NULL,
  `comentario` varchar(300) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usr` int(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `comentario`, `fecha`, `id_usr`) VALUES
(1, 'primer comentario', '0000-00-00 00:00:00', 26),
(2, 'segundo comentario', '0000-00-00 00:00:00', 26),
(3, 'tercer comentario', '0000-00-00 00:00:00', 26),
(4, 'cuarto comentario', '0000-00-00 00:00:00', 26),
(5, 'quinto comentario', '2021-02-04 15:14:18', 26),
(6, 'quinto comentario', '2021-02-04 15:14:48', 26),
(7, 'Otro comentario más', '2021-02-04 15:14:57', 26),
(8, 'Otro comentario más', '2021-02-04 15:15:41', 26),
(9, 'asdfasdfa sdfas fasd f', '2021-02-04 15:15:46', 26),
(10, 'asdfasdfa sdfas fasd f', '2021-02-04 15:16:00', 26),
(11, 'asdf asdf asdf asd f', '2021-02-04 16:52:47', 26),
(14, 'afsdfa sdf\r\n\r\n\r\nasdf\r\nasd\r\nfasd\r\nf\r\nasdf\r\n\r\n\r\n\r\nasdf', '2021-02-04 17:11:16', 26),
(15, 'asdfasdf\r\nasdf\r\nasd\r\nfasdf\r\nf\r\n\r\n\r\n\r\nasdfasdf', '2021-02-04 17:11:29', 26),
(16, 'asdfasdf<br />\r\nasdf<br />\r\nasd<br />\r\nfasdf<br />\r\nf<br />\r\n<br />\r\n<br />\r\n<br />\r\nasdfasdf', '2021-02-04 17:11:53', 26),
(19, 'jejejeje', '2021-02-04 18:51:01', 27),
(20, 'asdf', '2021-02-05 12:56:52', 26),
(21, 'asdfasdfadsf', '2021-02-05 12:57:00', 26),
(22, 'asdf', '2021-02-05 12:58:27', 26),
(23, 'asdfsadfsdf', '2021-02-05 13:01:56', 26),
(24, 'Primer mensaje de antonio', '2021-02-05 13:03:55', 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usr` int(5) UNSIGNED NOT NULL,
  `nombre` text NOT NULL,
  `email` text NOT NULL,
  `pass` text NOT NULL,
  `tipo` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usr`, `nombre`, `email`, `pass`, `tipo`) VALUES
(26, 'Peter', 'pedrodb74@gmail.com', 'fdsa', '0'),
(27, 'Lucia', 'lucia', 'asdf', '0'),
(28, 'Antonio', 'a@.com', 'a', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usr` (`id_usr`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usr`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usr` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_usr`) REFERENCES `usuarios` (`id_usr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
