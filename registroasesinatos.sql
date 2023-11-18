-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2023 a las 03:11:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registroasesinatos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesinos`
--

CREATE TABLE `asesinos` (
  `ID` int(11) NOT NULL,
  `Nombre` char(20) NOT NULL,
  `Apellido` char(20) NOT NULL,
  `Edad` tinyint(3) NOT NULL,
  `Genero` char(30) NOT NULL,
  `Peso` float NOT NULL,
  `Altura` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asesinos`
--

INSERT INTO `asesinos` (`ID`, `Nombre`, `Apellido`, `Edad`, `Genero`, `Peso`, `Altura`) VALUES
(7, 'Martin', 'Mercury', 19, 'masculino', 50, 170),
(8, 'Santino', 'gutierrez', 30, 'Masculino', 82, 180),
(9, 'Tomas', 'Martinez', 55, 'Masculino', 78, 178),
(12, 'Martina', 'Lopez', 22, 'femenino', 50, 153);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Contraseña` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Email`, `Contraseña`) VALUES
(1, 'webadmin', '$2y$10$7c0EzLeWlOdLC5DaRFnjl.oHZhIGdu/P7ckWYLCPIWDxA/neUY43K');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `victimas`
--

CREATE TABLE `victimas` (
  `ID` int(11) NOT NULL,
  `Nombre` char(30) NOT NULL,
  `Apellido` char(30) NOT NULL,
  `Edad` tinyint(4) NOT NULL,
  `Genero` char(30) NOT NULL,
  `ID_asesino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `victimas`
--

INSERT INTO `victimas` (`ID`, `Nombre`, `Apellido`, `Edad`, `Genero`, `ID_asesino`) VALUES
(47, 'Santino', 'gutierrez', 30, 'Masculino', 7),
(48, 'Julieta', 'Salazar', 32, 'Femenino', 9),
(49, 'Mariana', 'Fernandes', 33, 'Femenino', 7),
(50, 'Javier', 'Milanesi', 72, 'Masculino', 9);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asesinos`
--
ALTER TABLE `asesinos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `victimas`
--
ALTER TABLE `victimas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_asesino` (`ID_asesino`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asesinos`
--
ALTER TABLE `asesinos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `victimas`
--
ALTER TABLE `victimas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `victimas`
--
ALTER TABLE `victimas`
  ADD CONSTRAINT `victimas_ibfk_1` FOREIGN KEY (`ID_asesino`) REFERENCES `asesinos` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
