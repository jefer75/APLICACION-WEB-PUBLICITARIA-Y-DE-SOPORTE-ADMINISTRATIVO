-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2024 a las 18:33:45
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
