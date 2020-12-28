-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-12-2020 a las 21:07:11
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
  `direccion` varchar(150) DEFAULT NULL,
 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idclientes`, `nombreyap`, `dni`, `telefono`, `email`, `direccion`) VALUES
(1, 'Carlos Duen', 24567432, '3764899865', 'carlosduen@gmail.com', 'La Plata 4567'),
(2, 'Laura Villalva', 23658432, '3764593212', 'lauravill@gmail.com', 'Panamá 5434');

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

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idpagos`, `importe`, `fechapago`, `formapago`, `descripcion`, `estado`, `reservas_idreservas`) VALUES
(1, 12000, '28-12-2020', 'Transferencia', 'Pago de hospedaje en cabaña en enero, 3 dias. ', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idreservas` int(11) NOT NULL,
  `fecha` varchar(30) DEFAULT NULL,
  `fechadesde` varchar(30) DEFAULT NULL,
  `fechahasta` varchar(30) DEFAULT NULL,
  `comentario` varchar(300) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `clientes_idclientes` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idreservas`, `fecha`, `fechadesde`, `fechahasta`, `comentario`, `estado`, `clientes_idclientes`, `usuario_idusuario`) VALUES
(1, '26-12-2020', '12-01-2021', '15-01-2021', 'hola, quisiera saber si tienen disponibilidad para esas fechas. Quisieramos reservar para 4 personas adultas y un niño de 8 años.', 1, 1, 1);

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
(4, 'Bañera'),
(5, 'TV Pantalla plana'),
(6, 'Artículos de aseo'),
(7, 'Teléfono'),
(8, 'Armario'),
(9, 'Ducha');

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
-- Indices de la tabla `detallereservas`
--
ALTER TABLE `detallereservas`
  ADD PRIMARY KEY (`iddetallereservas`),
  ADD KEY `fk_detallereservas_reservas1` (`reservas_idreservas`),
  ADD KEY `fk_detallereservas_hospedaje1` (`hospedaje_idhospedaje`);

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
  ADD PRIMARY KEY (`idreservas`),
  ADD KEY `fk_reservas_clientes1` (`clientes_idclientes`),
  ADD KEY `fk_reservas_usuario1` (`usuario_idusuario`);

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
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallereservas`
--
ALTER TABLE `detallereservas`
  ADD CONSTRAINT `fk_detallereservas_hospedaje1` FOREIGN KEY (`hospedaje_idhospedaje`) REFERENCES `hospedaje` (`idhospedaje`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detallereservas_reservas1` FOREIGN KEY (`reservas_idreservas`) REFERENCES `reservas` (`idreservas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pagos_reservas1` FOREIGN KEY (`reservas_idreservas`) REFERENCES `reservas` (`idreservas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reservas_clientes1` FOREIGN KEY (`clientes_idclientes`) REFERENCES `clientes` (`idclientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservas_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
