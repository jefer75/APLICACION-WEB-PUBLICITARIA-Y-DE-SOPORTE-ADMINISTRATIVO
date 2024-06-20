-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2024 a las 18:33:36
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
-- Estructura de tabla para la tabla `tipo_e`
--

CREATE TABLE `tipo_e` (
  `id_tipo_e` int(11) NOT NULL,
  `tipo_evento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_e`
--

INSERT INTO `tipo_e` (`id_tipo_e`, `tipo_evento`) VALUES
(1, 'Cumpleaños'),
(2, 'Baby shower'),
(3, 'XV años'),
(4, 'Matrimonio'),
(5, 'Primera comunion'),
(7, 'Especial Halloween'),
(8, 'Despedida de soltero');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tipo_e`
--
ALTER TABLE `tipo_e`
  ADD PRIMARY KEY (`id_tipo_e`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tipo_e`
--
ALTER TABLE `tipo_e`
  MODIFY `id_tipo_e` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
