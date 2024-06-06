-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2024 a las 04:01:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `backend_php_1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL COMMENT 'Identificador unico del empleado',
  `nombres` varchar(255) NOT NULL COMMENT 'Nombres del empleado',
  `apellidos` varchar(255) NOT NULL COMMENT 'Apellidos del empleado',
  `edad` int(11) NOT NULL COMMENT 'Edad del empleado',
  `fecha_ingreso` date NOT NULL COMMENT 'Fecha de ingreso del empleado',
  `comentarios` varchar(255) NOT NULL COMMENT 'Comentarios adicionales',
  `created_at` datetimebackend_phpemployees NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de creación',
  `updated_at` date DEFAULT NULL COMMENT 'Fecha de actualización',
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Define si un empleado esta eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla que almacena los empleados';

--
-- Volcado de datos para la tabla `employees`
--employees

INSERT INTO `employees` (`id`, `nombres`, `apellidos`, `edad`, `fecha_ingreso`, `comentarios`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Santiago', 'Quevedo Escobar', 30, '2024-06-04', 'Sin comentarios', '2024-06-05', '2024-06-05', 0),
(2, 'Fernando', 'Quevedo Escobar', 28, '2024-06-05', 'Sin comentarios', '2024-06-05', '2024-06-05', 0),
(3, 'Leydy Paola', 'Chivata Rodriguez', 34, '2024-06-01', 'Sin comentarios', '2024-06-05', NULL, 0),
(4, 'Paolo Marcelo', 'Quevedo Escobar', 33, '2024-06-04', 'Ingresa como pasante', '2024-06-05', '2024-06-05', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del empleado', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
