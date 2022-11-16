-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2022 a las 00:13:40
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `revels`
--
CREATE DATABASE IF NOT EXISTS `revels` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `revels`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `revelid` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `texto` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `revelid`, `userid`, `texto`, `fecha`) VALUES
(1, 2, 6, 'Qué bien te lo montas', '2022-10-20 22:12:41'),
(2, 3, 6, 'Seguro que te gusta', '2022-10-20 22:12:41'),
(3, 3, 1, 'Vamossss', '2022-10-20 22:12:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `follows`
--

DROP TABLE IF EXISTS `follows`;
CREATE TABLE `follows` (
  `userid` int(10) NOT NULL,
  `userfollowed` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `follows`
--

INSERT INTO `follows` (`userid`, `userfollowed`) VALUES
(6, 1),
(6, 4),
(1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revels`
--

DROP TABLE IF EXISTS `revels`;
CREATE TABLE `revels` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `texto` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revels`
--

INSERT INTO `revels` (`id`, `userid`, `texto`, `fecha`) VALUES
(1, 1, 'De vacaciones', '2022-08-06 13:16:17'),
(2, 1, 'En la playa (Tenerife)', '2022-08-20 09:45:05'),
(3, 4, 'Probando esto', '2022-09-13 07:06:24'),
(4, 5, 'Me han contratado en una empresa nueva', '2022-09-19 20:55:36'),
(5, 3, 'Disfrutando de la vida', '2022-10-02 15:15:31'),
(6, 1, 'Submarinismo en Fuerteventura', '2022-10-10 07:16:42'),
(7, 4, 'A tope con la vida', '2022-10-10 08:11:41'),
(8, 2, 'Hola hola', '2022-10-11 11:21:08'),
(9, 2, 'Aquí estoy', '2022-10-12 15:21:08'),
(10, 1, 'Ya de vuelta en casa', '2022-10-13 12:01:12'),
(11, 5, 'Me encanta esta empresa', '2022-10-15 10:28:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `contrasenya`, `email`) VALUES
(1, 'Antonio', '$2y$11$Jcr5/i4aw5YtjtlgO6oBJ.93RJSlVOM7iDJ0GgW7ezFU4L7Wr7qVK', 'antonio@mail.com'),
(2, 'Lucas', '$2y$11$vJbfqvwWcUJDW9ldPAEQq.coYscsR6kR7hceN9PRzbTE8LqKZL/ou', 'lucas@mail.com'),
(3, 'Ana', '$2y$11$lI7mvbOQqNRUucLxqCcqA.5yIS40b1rPC5EDfu5gEJjdvr3zyTIPO', 'ana@mail.com'),
(4, 'Patricia', '$2y$11$NCZGoKARuJJKgc0QIlntbu1BFazUHqOyMoxbVmDqxgW9yx91Hrupu', 'patricia@mail.com'),
(5, 'oscar', '$2y$11$/eMmhFdDCKg5.xNu6Ox32.idXyHugeiUjOHS4XOJuMo5Y7yYrGU0O', 'oscar@mail.com'),
(6, 'Eva', '$2y$11$H2CAEXusZCBOHQjdO54Y..GLP5u1WhEJNRbuHAD5tTaTPIGmKef8e', 'eva@mail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `revelid` (`revelid`),
  ADD KEY `userid` (`userid`);

--
-- Indices de la tabla `follows`
--
ALTER TABLE `follows`
  ADD KEY `userfollowed` (`userfollowed`),
  ADD KEY `userid` (`userid`);

--
-- Indices de la tabla `revels`
--
ALTER TABLE `revels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `revels`
--
ALTER TABLE `revels`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`revelid`) REFERENCES `revels` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`userfollowed`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `revels`
--
ALTER TABLE `revels`
  ADD CONSTRAINT `revels_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

-- user: revel
-- pass: lever
GRANT USAGE ON *.* TO `revel`@`%` IDENTIFIED BY PASSWORD '*8BDBA940B4BAC5754E684CA8E554DAE097597163';
GRANT ALL PRIVILEGES ON `revels`.* TO `revel`@`%` WITH GRANT OPTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
