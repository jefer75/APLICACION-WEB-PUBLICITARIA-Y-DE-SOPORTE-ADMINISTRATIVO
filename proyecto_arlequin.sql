-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2024 a las 13:14:20
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
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id_actividad` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividad`, `nombre`, `descripcion`, `imagen`) VALUES
(21, 'Pintucaritas', 'Dibujos en la piel para todos los niños que deseen', '../../../imagenes/registradas/actividades/21.jpeg'),
(22, 'Show de payasito', 'Gran show de payasito', '../../../imagenes/registradas/actividades/22.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(11) NOT NULL,
  `nombre_A` varchar(40) NOT NULL,
  `id_tipo_art` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` bigint(20) NOT NULL,
  `barcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `nombre_A`, `id_tipo_art`, `id_estado`, `descripcion`, `cantidad`, `valor`, `barcode`) VALUES
(5, 'Cabina de sonido', 1, 2, 'Cabina de sonido grande', 3, 14354, '../../../imagenes/registradas/barcode/6673a5865b9361286.png'),
(7, 'Luz laser', 2, 1, 'Laser', 4, 20000, '../../../imagenes/registradas/barcode/6673abbb788f43916.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `decoracion`
--

CREATE TABLE `decoracion` (
  `id_imagen` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `decoracion`
--

INSERT INTO `decoracion` (`id_imagen`, `imagen`) VALUES
(22, '../../../imagenes/registradas/decoracion/22.jpg'),
(23, '../../../imagenes/registradas/decoracion/23.jpg'),
(24, '../../../imagenes/registradas/decoracion/24.jpg'),
(25, '../../../imagenes/registradas/decoracion/25.jpg'),
(26, '../../../imagenes/registradas/decoracion/26.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detalle_eve` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor_neto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detalle_eve`, `id_evento`, `id_articulo`, `cantidad`, `valor_neto`) VALUES
(5, 13, 2, 2, 100000),
(10, 13, 7, 2, 40000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_paquete`
--

CREATE TABLE `detalle_paquete` (
  `id_detalles` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_paquetes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_paquete`
--

INSERT INTO `detalle_paquete` (`id_detalles`, `id_actividad`, `id_paquetes`) VALUES
(4, 8, 1),
(5, 9, 1),
(6, 0, 1),
(7, 12, 1),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0),
(11, 0, 0),
(12, 0, 13),
(13, 0, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_tipo_e`
--

CREATE TABLE `detalle_tipo_e` (
  `id_detalle` int(11) NOT NULL,
  `id_tipo_e` int(11) NOT NULL,
  `id_paquetes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_tipo_e`
--

INSERT INTO `detalle_tipo_e` (`id_detalle`, `id_tipo_e`, `id_paquetes`) VALUES
(24, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `nit` int(11) NOT NULL,
  `nombre_emp` varchar(50) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `direccion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`nit`, `nombre_emp`, `telefono`, `direccion`) VALUES
(123456789, 'Arlequin Eventos', 3157418168, 'Urbanizacion Anda Lucia Real');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Disponible'),
(4, 'Reservado'),
(5, 'En mantenimiento'),
(6, 'Pendiente'),
(7, 'En Ejecucion'),
(8, 'completado'),
(9, 'cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_eventos` bigint(20) NOT NULL,
  `fecha_evento` date NOT NULL,
  `id_paquetes` int(11) NOT NULL,
  `id_tipo_e` int(11) NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `cant_ninos` int(11) NOT NULL,
  `f_inicio` date NOT NULL,
  `f_fin` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `edad_home` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `cedula` bigint(20) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_eventos`, `fecha_evento`, `id_paquetes`, `id_tipo_e`, `lugar`, `cant_ninos`, `f_inicio`, `f_fin`, `hora_inicio`, `hora_fin`, `edad_home`, `descripcion`, `cedula`, `id_estado`) VALUES
(13, '2024-06-18', 3, 7, 'cra 123 #56 barrio condorito', 120, '2024-06-26', '2024-06-26', '15:00:00', '19:00:00', 15, 'celebración del día del niño ', 1031540636, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_eventos` int(11) NOT NULL,
  `valor_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `fecha`, `id_eventos`, `valor_total`) VALUES
(1, '2024-06-13', 1, 150000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `id_licencia` int(11) NOT NULL,
  `licencia` varchar(20) NOT NULL,
  `nit` bigint(11) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `licencia`
--

INSERT INTO `licencia` (`id_licencia`, `licencia`, `nit`, `fecha_ini`, `fecha_fin`, `id_estado`) VALUES
(2, '42063412351056484364', 123456789, '2024-02-21', '2024-02-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `id_paquetes` int(11) NOT NULL,
  `nombre_paquete` varchar(40) NOT NULL,
  `edad_min` int(11) NOT NULL,
  `edad_max` int(11) NOT NULL,
  `valor` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id_paquetes`, `nombre_paquete`, `edad_min`, `edad_max`, `valor`) VALUES
(1, 'payasin', 2, 10, 100000),
(2, 'Mini', 2, 10, 80000),
(3, 'Titiriloco', 5, 12, 120000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_articulo`
--

CREATE TABLE `tipo_articulo` (
  `id_tipo_art` int(11) NOT NULL,
  `tipo_articulo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_articulo`
--

INSERT INTO `tipo_articulo` (`id_tipo_art`, `tipo_articulo`) VALUES
(1, 'Sonido'),
(2, 'Luces'),
(3, 'Complementos'),
(4, 'Inmobiliarios decoracion');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_user`
--

CREATE TABLE `tipo_user` (
  `id_tipo_user` int(11) NOT NULL,
  `tipo_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_user`
--

INSERT INTO `tipo_user` (`id_tipo_user`, `tipo_user`) VALUES
(1, 'administrador'),
(2, 'cliente'),
(3, 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trig`
--

CREATE TABLE `trig` (
  `n_contrasena` varchar(50) DEFAULT NULL,
  `v_contrasena` varchar(50) DEFAULT NULL,
  `tipo` varchar(20) NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trig`
--

INSERT INTO `trig` (`n_contrasena`, `v_contrasena`, `tipo`, `fecha_creacion`) VALUES
('234567', '$2y$10$avjeaR/Ao98kJVcsz0f/Uu6f0JFwIaRaW0JwDV249wf', '', '2024-02-27 23:25:35'),
('$2y$10$NFw1XkYlB0oaJhm3Y3OAMOi6mVKuWEZVRDfK0Qx7k9u', '$2y$10$NFw1XkYlB0oaJhm3Y3OAMOi6mVKuWEZVRDfK0Qx7k9u', '', '2024-02-28 16:24:48'),
('12345', '$2y$10$NFw1XkYlB0oaJhm3Y3OAMOi6mVKuWEZVRDfK0Qx7k9u', '', '2024-02-28 16:25:00'),
('12345', '12345', '', '2024-02-28 16:26:31'),
('12345', '12345', '', '2024-02-28 16:27:21'),
('$2y$10$jXjJf0V1eM5ngkSkJtZMO.aB0EXV0.we9nPpYApcdaF', '12345', '', '2024-02-28 16:43:25'),
('$2y$10$Eh9iJBRxqHSJrx62IqaYdOgOU6Yq5uzAp7VfcwXuF5j', '$2y$10$jXjJf0V1eM5ngkSkJtZMO.aB0EXV0.we9nPpYApcdaF', 'update', '2024-02-29 07:35:33'),
('$2y$10$KJmndsXpEPkP3EctryCG.Oknlzhy8J13exxp.CCWwtp', '$2y$10$Eh9iJBRxqHSJrx62IqaYdOgOU6Yq5uzAp7VfcwXuF5j', 'update', '2024-02-29 07:36:36'),
('$2y$10$KSSUcI1mJ7Yo4mW.t9uwLe8i/v31MZ.tfPetQ4NDD8g', '$2y$10$KJmndsXpEPkP3EctryCG.Oknlzhy8J13exxp.CCWwtp', 'update', '2024-02-29 07:36:57'),
('$2y$10$QnvkrLBHJEf8GGXzd.JRveV1/YU3EaGUJzZ6u2x.BAn', '$2y$10$KSSUcI1mJ7Yo4mW.t9uwLe8i/v31MZ.tfPetQ4NDD8g', 'update', '2024-02-29 07:43:02'),
('$2y$10$DZIBDtK5s82bpeVDSpUnU.HU4AZaF8JNP6RCM8h7OUm', '$2y$10$QnvkrLBHJEf8GGXzd.JRveV1/YU3EaGUJzZ6u2x.BAn', 'update', '2024-02-29 09:51:01'),
('$2y$10$0JmOMoVRBk42VavSoJaXk.gtzxtDuef5Ccy6ZIwFb/i', '$2y$10$DZIBDtK5s82bpeVDSpUnU.HU4AZaF8JNP6RCM8h7OUm', 'update', '2024-02-29 09:51:02'),
('$2y$10$QkPxmfbil.EWcleY1Qshwugkvj9yOVAMuy0n4WR9XDz', '$2y$10$0JmOMoVRBk42VavSoJaXk.gtzxtDuef5Ccy6ZIwFb/i', 'update', '2024-02-29 09:52:55'),
('$2y$10$LEL0VinsdBEuxQyJa5cCO.E8Yp5yeFSVFWvbymp04R0', '$2y$10$QkPxmfbil.EWcleY1Qshwugkvj9yOVAMuy0n4WR9XDz', 'update', '2024-02-29 10:10:23'),
('$2y$10$LEL0VinsdBEuxQyJa5cCO.E8Yp5yeFSVFWvbymp04R0', '$2y$10$LEL0VinsdBEuxQyJa5cCO.E8Yp5yeFSVFWvbymp04R0', 'update', '2024-03-04 06:37:14'),
('$2y$10$rltL2wRywbiham1d8/oVSOOB2zZ7.WJmsmKHbKtmp0q', '$2y$10$LEL0VinsdBEuxQyJa5cCO.E8Yp5yeFSVFWvbymp04R0', 'update', '2024-03-04 06:38:07'),
('$2y$10$7Qn95SuDvzP5o39jYnaE2u1Pjlknnlm6ZRuheq2BC0V', '$2y$10$7Qn95SuDvzP5o39jYnaE2u1Pjlknnlm6ZRuheq2BC0V', 'update', '2024-03-04 06:39:11'),
('$2y$10$7Qn95SuDvzP5o39jYnaE2u1Pjlknnlm6ZRuheq2BC0V', '$2y$10$7Qn95SuDvzP5o39jYnaE2u1Pjlknnlm6ZRuheq2BC0V', 'update', '2024-03-04 06:39:20'),
('$2y$10$TcRFiBEGNBDdmjrEavGhue8hLf2rrxIs9C2371laGPE', '$2y$10$TcRFiBEGNBDdmjrEavGhue8hLf2rrxIs9C2371laGPE', 'update', '2024-03-04 06:51:32'),
('$2y$10$KL8G8EAcE9aoC3K5HwtOZ./1bohem/Uz1jIEah.msrd', '$2y$10$TcRFiBEGNBDdmjrEavGhue8hLf2rrxIs9C2371laGPE', 'update', '2024-03-04 06:53:40'),
('234567', '$2y$10$avjeaR/Ao98kJVcsz0f/Uu6f0JFwIaRaW0JwDV249wf', '', '2024-02-27 23:25:35'),
('$2y$10$NFw1XkYlB0oaJhm3Y3OAMOi6mVKuWEZVRDfK0Qx7k9u', '$2y$10$NFw1XkYlB0oaJhm3Y3OAMOi6mVKuWEZVRDfK0Qx7k9u', '', '2024-02-28 16:24:48'),
('12345', '$2y$10$NFw1XkYlB0oaJhm3Y3OAMOi6mVKuWEZVRDfK0Qx7k9u', '', '2024-02-28 16:25:00'),
('12345', '12345', '', '2024-02-28 16:26:31'),
('12345', '12345', '', '2024-02-28 16:27:21'),
('$2y$10$jXjJf0V1eM5ngkSkJtZMO.aB0EXV0.we9nPpYApcdaF', '12345', '', '2024-02-28 16:43:25'),
('$2y$10$Eh9iJBRxqHSJrx62IqaYdOgOU6Yq5uzAp7VfcwXuF5j', '$2y$10$jXjJf0V1eM5ngkSkJtZMO.aB0EXV0.we9nPpYApcdaF', 'update', '2024-02-29 07:35:33'),
('$2y$10$KJmndsXpEPkP3EctryCG.Oknlzhy8J13exxp.CCWwtp', '$2y$10$Eh9iJBRxqHSJrx62IqaYdOgOU6Yq5uzAp7VfcwXuF5j', 'update', '2024-02-29 07:36:36'),
('$2y$10$KSSUcI1mJ7Yo4mW.t9uwLe8i/v31MZ.tfPetQ4NDD8g', '$2y$10$KJmndsXpEPkP3EctryCG.Oknlzhy8J13exxp.CCWwtp', 'update', '2024-02-29 07:36:57'),
('$2y$10$QnvkrLBHJEf8GGXzd.JRveV1/YU3EaGUJzZ6u2x.BAn', '$2y$10$KSSUcI1mJ7Yo4mW.t9uwLe8i/v31MZ.tfPetQ4NDD8g', 'update', '2024-02-29 07:43:02'),
('$2y$10$DZIBDtK5s82bpeVDSpUnU.HU4AZaF8JNP6RCM8h7OUm', '$2y$10$QnvkrLBHJEf8GGXzd.JRveV1/YU3EaGUJzZ6u2x.BAn', 'update', '2024-02-29 09:51:01'),
('$2y$10$0JmOMoVRBk42VavSoJaXk.gtzxtDuef5Ccy6ZIwFb/i', '$2y$10$DZIBDtK5s82bpeVDSpUnU.HU4AZaF8JNP6RCM8h7OUm', 'update', '2024-02-29 09:51:02'),
('$2y$10$QkPxmfbil.EWcleY1Qshwugkvj9yOVAMuy0n4WR9XDz', '$2y$10$0JmOMoVRBk42VavSoJaXk.gtzxtDuef5Ccy6ZIwFb/i', 'update', '2024-02-29 09:52:55'),
('$2y$10$LEL0VinsdBEuxQyJa5cCO.E8Yp5yeFSVFWvbymp04R0', '$2y$10$QkPxmfbil.EWcleY1Qshwugkvj9yOVAMuy0n4WR9XDz', 'update', '2024-02-29 10:10:23'),
('$2y$10$LEL0VinsdBEuxQyJa5cCO.E8Yp5yeFSVFWvbymp04R0', '$2y$10$LEL0VinsdBEuxQyJa5cCO.E8Yp5yeFSVFWvbymp04R0', 'update', '2024-03-04 06:37:14'),
('$2y$10$rltL2wRywbiham1d8/oVSOOB2zZ7.WJmsmKHbKtmp0q', '$2y$10$LEL0VinsdBEuxQyJa5cCO.E8Yp5yeFSVFWvbymp04R0', 'update', '2024-03-04 06:38:07'),
('$2y$10$7Qn95SuDvzP5o39jYnaE2u1Pjlknnlm6ZRuheq2BC0V', '$2y$10$7Qn95SuDvzP5o39jYnaE2u1Pjlknnlm6ZRuheq2BC0V', 'update', '2024-03-04 06:39:11'),
('$2y$10$7Qn95SuDvzP5o39jYnaE2u1Pjlknnlm6ZRuheq2BC0V', '$2y$10$7Qn95SuDvzP5o39jYnaE2u1Pjlknnlm6ZRuheq2BC0V', 'update', '2024-03-04 06:39:20'),
('$2y$10$TcRFiBEGNBDdmjrEavGhue8hLf2rrxIs9C2371laGPE', '$2y$10$TcRFiBEGNBDdmjrEavGhue8hLf2rrxIs9C2371laGPE', 'update', '2024-03-04 06:51:32'),
('$2y$10$KL8G8EAcE9aoC3K5HwtOZ./1bohem/Uz1jIEah.msrd', '$2y$10$TcRFiBEGNBDdmjrEavGhue8hLf2rrxIs9C2371laGPE', 'update', '2024-03-04 06:53:40'),
('$2y$10$7Qn95SuDvzP5o39jYnaE2u1Pjlknnlm6ZRuheq2BC0V', '$2y$10$7Qn95SuDvzP5o39jYnaE2u1Pjlknnlm6ZRuheq2BC0V', 'update', '2024-06-11 15:56:19');

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
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`);

--
-- Indices de la tabla `decoracion`
--
ALTER TABLE `decoracion`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle_eve`);

--
-- Indices de la tabla `detalle_paquete`
--
ALTER TABLE `detalle_paquete`
  ADD PRIMARY KEY (`id_detalles`);

--
-- Indices de la tabla `detalle_tipo_e`
--
ALTER TABLE `detalle_tipo_e`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_eventos`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`id_licencia`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id_paquetes`);

--
-- Indices de la tabla `tipo_articulo`
--
ALTER TABLE `tipo_articulo`
  ADD PRIMARY KEY (`id_tipo_art`);

--
-- Indices de la tabla `tipo_e`
--
ALTER TABLE `tipo_e`
  ADD PRIMARY KEY (`id_tipo_e`);

--
-- Indices de la tabla `tipo_user`
--
ALTER TABLE `tipo_user`
  ADD PRIMARY KEY (`id_tipo_user`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `decoracion`
--
ALTER TABLE `decoracion`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle_eve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalle_paquete`
--
ALTER TABLE `detalle_paquete`
  MODIFY `id_detalles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detalle_tipo_e`
--
ALTER TABLE `detalle_tipo_e`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_eventos` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `id_licencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id_paquetes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_articulo`
--
ALTER TABLE `tipo_articulo`
  MODIFY `id_tipo_art` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_e`
--
ALTER TABLE `tipo_e`
  MODIFY `id_tipo_e` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipo_user`
--
ALTER TABLE `tipo_user`
  MODIFY `id_tipo_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;