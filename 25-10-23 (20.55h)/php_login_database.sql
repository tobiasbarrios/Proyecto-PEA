-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2023 a las 01:55:33
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `php_login_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Estudiante'),
(2, 'Voluntario'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `dni` int(15) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nombre`, `apellido`, `dni`, `direccion`, `fecha_nacimiento`, `telefono`, `role_id`) VALUES
(26, 'prueba@gmail.com', '$2y$10$rUudJTYK/BGcoIO6R9NAle2fQdv1DfSsVK3brRMJg/wBGa3tGBcE2', 'Prueba', 'test', 111111112, 'jujuy 255', '2023-09-28', '22334483', 3),
(28, 'ezequielpastor35@gmail.com', '$2y$10$SNH.ViNjWTGIK.S2KBx40.JuDt73UkIIypxFelfT7Z89WU8ZLv1bO', 'Ezequiel Manuel', 'Pastor', 46646141, 'Jujuy 255', '2005-05-03', '1125350963', 1),
(34, 'asd123@gmail.com', '$2y$10$FpF8V0qG7or2yur0lYxyu.jL7iLKHgkKdx8GGsZ5FGOkGTmxwD0Xu', 'Manuel', 'Pastor', 46666444, 'Jujuy 265', '2005-05-06', '123', 1),
(35, 'cristiano@gmail.com', '$2y$10$Ync/oj2Jyk2B4I091p8VK.qPRCAwG5vvXkcmPW4I0XMl6LYwYh.lK', 'Cristiano', 'Ronaldo', 23789987, 'Cerrito 876', '2005-05-06', '1123324664', 3),
(51, 'mariano@gmail.com', '$2y$10$XbtC1KV7TL1mcrTdt9nE9OvUL7Qwa3S.FWNMlkNW.DTSgOuIJIm2a', 'Mariano', 'Godoy Cruzzz', 46345987, 'Jujuy 255', '2004-07-03', '1156657887', 2),
(52, 'tati@gmail.com', '$2y$10$tHKWZCYmstO38Y2/b5C9n.udZuxbU30Yyqbbtjm5b95AOMru8IaQ.', 'Tatiana ', 'Rojas', 46754456, 'Directorio 123 ', '2005-06-20', '1109080706', 3),
(53, 'tobiaseze@gmail.com', '$2y$10$EoqwbwuGeRgX9xaBhkHIkOCuqLs1Y/7ugURZBPrc9lMU2Tk9Svka6', 'Tobias', 'Pastor', 47787878, 'Jujuy 265', '2000-10-09', '1178873443', 1),
(56, 'julianalvarez@gmail.com', '$2y$10$x3DIKfb3ZUMpfY6srz0QZ.z6EHPb2F0arwtHEGxC042gyuS5rk7IW', 'Julian', 'Alvarez', 38324123, 'Av. Libertador 3136', '1998-07-23', '1156784523', 3),
(58, 'Tobias@gmail.com', '$2y$10$JZkSM3cu3cHnIzjKPFyj1OGK8hEdRvq900.PnJwooM4Bi4CYtxMz2', 'Jeremias', 'Barrios', 11111123, 'Jjujuy 265', '2005-03-18', '112342342', 3),
(60, 'enzocarp@gmail.com', '$2y$10$jZqdcpAWmGYBOYwulxM.reanhDcAH/viz5XUQFjX34NxCdnbGkYfm', 'Enzo', 'Fernandez', 37874354, 'Figueroa Alcorta', '2000-06-16', '1178543542', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`) VALUES
(1, 53, 2),
(2, 53, 3),
(3, 53, 2),
(4, 28, 3),
(5, 28, 3),
(6, 28, 3),
(7, NULL, 3),
(8, 52, 3),
(9, 35, 3),
(10, 53, 1),
(12, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD KEY `role_id` (`role_id`);

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
