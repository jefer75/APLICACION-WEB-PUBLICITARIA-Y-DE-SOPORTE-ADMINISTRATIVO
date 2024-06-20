-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2024 a las 18:33:51
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
-- Base de datos: `proyecto_arlequin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cedula` bigint(20) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `celular` bigint(20) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `id_tipo_user` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `nit` bigint(20) NOT NULL,
  `token` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `nombre`, `celular`, `contrasena`, `correo`, `id_tipo_user`, `id_estado`, `nit`, `token`) VALUES
(4554564, 'yurica', 454564564, '$2y$10$KL8G8EAcE9aoC3K5HwtOZ./1bohem/Uz1jIEah.msrddoCHsLiu/K', 'yuriducu04@gmail.com', 2, 1, 123456789, 'u589'),
(123456789, 'Gloria', 3157418168, '$2y$10$7Qn95SuDvzP5o39jYnaE2u1Pjlknnlm6ZRuheq2BC0VUXfUp.NIWy', 'Gloria@gmail.com', 1, 1, 123456789, ''),
(1005911563, 'Jennifer', 3114409273, '234567', 'ortiztatiana1416@gmail.com', 2, 1, 123456789, ''),
(1031540636, 'jeferson', 3213879832, '$2y$10$rltL2wRywbiham1d8/oVSOOB2zZ7.WJmsmKHbKtmp0q0.KmZdcO6S', 'yiyecardenal@gmail.com', 3, 1, 123456789, 'y9hr'),
(1104254269, 'Daniel', 34114212, '$2y$10$Aim2aWnMG6LOV5YyW1ZKceqmQSPEZjA.5T6KE6USIJYvn2CDZ5Grm', 'Daniel@gmail.com', 2, 1, 123456789, '');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `after_update_usuarios` AFTER UPDATE ON `usuarios` FOR EACH ROW begin
    insert into trig(n_contrasena, v_contrasena, tipo) values(new.contrasena, old.contrasena, 'update'
);
end
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
