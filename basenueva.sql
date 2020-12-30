-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-12-2020 a las 11:18:41
-- Versión del servidor: 5.6.49
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uv028960_reservas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idclientes` int(11) NOT NULL,
  `nombreyap` varchar(60) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idclientes`, `nombreyap`, `dni`, `telefono`, `email`, `direccion`) VALUES
(1, 'Carlos Leonel Tapia', 33223323, '3764899862', 'carlosduen@gmail.com', 'La Plata 4562'),
(2, 'Tamara Cassiof', 40123456, '34566789', 'ta@gmail.com', 'San Juan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallereservas`
--

CREATE TABLE `detallereservas` (
  `iddetallereservas` int(11) NOT NULL,
  `cantidadpersonas` int(11) DEFAULT NULL,
  `adultos` int(11) DEFAULT NULL,
  `niños` int(11) DEFAULT NULL,
  `reservas_idreservas` int(11) DEFAULT NULL,
  `hospedaje_idhospedaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallereservas`
--

INSERT INTO `detallereservas` (`iddetallereservas`, `cantidadpersonas`, `adultos`, `niños`, `reservas_idreservas`, `hospedaje_idhospedaje`) VALUES
(1, 5, 4, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedaje`
--

CREATE TABLE `hospedaje` (
  `idhospedaje` int(11) NOT NULL,
  `descripcion` varchar(400) DEFAULT NULL,
  `preciopordia` float DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `tamaño` varchar(30) DEFAULT NULL,
  `cama_doble` int(11) DEFAULT NULL,
  `camaindi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `hospedaje`
--

INSERT INTO `hospedaje` (`idhospedaje`, `descripcion`, `preciopordia`, `estado`, `capacidad`, `tamaño`, `cama_doble`, `camaindi`) VALUES
(1, 'Cabaña Las palmeras.\r\nExcelente vista al río Iguazú.\r\nAmplio jardín con flores, hermosa decoración de interiores.', 4000, 1, 7, '9m2', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idpagos` int(11) NOT NULL,
  `importe` float DEFAULT NULL,
  `fechapago` varchar(30) DEFAULT NULL,
  `formapago` varchar(45) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `reservas_idreservas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idreservas` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `fechadesde` date DEFAULT NULL,
  `fechahasta` date DEFAULT NULL,
  `comentario` varchar(300) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `clientes_idclientes` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idreservas`, `fecha`, `fechadesde`, `fechahasta`, `comentario`, `estado`, `clientes_idclientes`, `usuario_idusuario`) VALUES
(2, '2020-12-30 02:17:08', '2021-01-04', '2020-12-14', 'Quisiera saber si tienen disponible casa para 7 adultos y 2 niños, o dos casas.', 1, 1, 2),
(3, '2020-12-31 02:17:08', '2021-01-07', '2020-12-10', 'Quisiera un alojamiento en su hostel', 2, 1, 4),
(6, '2020-01-02 02:17:08', '2021-01-06', '2020-12-14', 'Quisiera saber si tienen disponible uns casa.', 2, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idservicios` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`idservicios`, `descripcion`) VALUES
(1, 'Aire acondicionado'),
(2, 'Wifi gratis'),
(3, 'Secador de pelo'),
(4, 'BaÃ±era'),
(5, 'TV Pantalla plana'),
(6, 'ArtÃ­culos de aseo'),
(7, 'TelÃ©fono'),
(8, 'Armarios'),
(9, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_has_hospedaje`
--

CREATE TABLE `servicios_has_hospedaje` (
  `servicios_idservicios` int(11) NOT NULL,
  `hospedaje_idhospedaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios_has_hospedaje`
--

INSERT INTO `servicios_has_hospedaje` (`servicios_idservicios`, `hospedaje_idhospedaje`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `nick` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `nick`) VALUES
(1, 'pagina', 'web'),
(2, 'Carmen', 'Car'),
(3, 'Federico', 'Fede'),
(4, 'Luisa', 'Lui'),
(5, 'Eliseo', 'Eli'),
(6, 'Daiana', 'Dai');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idclientes`);

--
-- Indices de la tabla `hospedaje`
--
ALTER TABLE `hospedaje`
  ADD PRIMARY KEY (`idhospedaje`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idpagos`),
  ADD KEY `fk_pagos_reservas1` (`reservas_idreservas`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idreservas`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idservicios`);

--
-- Indices de la tabla `servicios_has_hospedaje`
--
ALTER TABLE `servicios_has_hospedaje`
  ADD PRIMARY KEY (`servicios_idservicios`,`hospedaje_idhospedaje`),
  ADD KEY `fk_servicios_has_hospedaje_hospedaje1` (`hospedaje_idhospedaje`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idclientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idreservas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pagos_reservas1` FOREIGN KEY (`reservas_idreservas`) REFERENCES `reservas` (`idreservas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicios_has_hospedaje`
--
ALTER TABLE `servicios_has_hospedaje`
  ADD CONSTRAINT `fk_servicios_has_hospedaje_hospedaje1` FOREIGN KEY (`hospedaje_idhospedaje`) REFERENCES `hospedaje` (`idhospedaje`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servicios_has_hospedaje_servicios1` FOREIGN KEY (`servicios_idservicios`) REFERENCES `servicios` (`idservicios`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
