-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-06-2018 a las 22:42:21
-- Versión del servidor: 10.2.15-MariaDB
-- Versión de PHP: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u720362080_ciaig`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_calificacionesk`
--

CREATE TABLE `tbl_calificacionesk` (
  `ID_CALIFICACIONESK` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL,
  `P1` int(11) DEFAULT NULL,
  `P2` int(11) DEFAULT NULL,
  `P3` int(11) DEFAULT NULL,
  `AÑO` date NOT NULL,
  `ID_MATERIA` int(11) NOT NULL,
  `EXISTE` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_calificacionesk`
--
ALTER TABLE `tbl_calificacionesk`
  ADD PRIMARY KEY (`ID_CALIFICACIONESK`),
  ADD KEY `ID_ALUMNO` (`ID_ALUMNO`),
  ADD KEY `ID_MATERIA` (`ID_MATERIA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_calificacionesk`
--
ALTER TABLE `tbl_calificacionesk`
  MODIFY `ID_CALIFICACIONESK` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
