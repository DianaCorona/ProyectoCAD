-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-03-2017 a las 09:15:32
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `testdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_areas` int(11) NOT NULL,
  `nombre_area` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `fecha_alta` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_areas`, `nombre_area`, `descripcion`, `fecha_alta`) VALUES
(3, 'Recursos Humanos 12', ' 1Recursos Humanos', '2017-2-3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `unidad_medida` varchar(50) NOT NULL,
  `calibre` varchar(50) NOT NULL,
  `voltaje` varchar(50) NOT NULL,
  `tipo_tarjeta` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `codigo`, `descripcion`, `color`, `unidad_medida`, `calibre`, `voltaje`, `tipo_tarjeta`) VALUES
(0, '2S', 'PERROS', 'CAFES', 'CMS', '21S', '9S', 'ANIMALS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id_status` int(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id_status`, `descripcion`) VALUES
(2, 'activos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos`
--

CREATE TABLE `tipo_productos` (
  `id_tipo_productos` int(11) NOT NULL,
  `nombre_tipo_producto` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_productos`
--

INSERT INTO `tipo_productos` (`id_tipo_productos`, `nombre_tipo_producto`) VALUES
(1, 'espejos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `appaterno` varchar(100) DEFAULT NULL,
  `apmaterno` varchar(100) DEFAULT NULL,
  `privilegios` int(11) NOT NULL,
  `fecha_alta` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `usuario`, `password`, `nombre`, `appaterno`, `apmaterno`, `privilegios`, `fecha_alta`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', '', '', 1, '0000-00-00'),
(2, 'edgar', '202cb962ac59075b964b07152d234b70', 'Edgar', 'Bautista', 'Cuadrilla', 2, '0000-00-00'),
(3, 'Diana', 'fd6438b18f84875b61d905b64d1742ab', 'Diana', 'Corona', 'Garcia', 1, '0000-00-00'),
(4, 'fecha', '94ed416723ce619a79d9bf5ecb292718', 'fecha', 'fecha', 'fecha', 2, '2017-01-02'),
(5, 'fecha2', 'a704190d2981ad3caf8c64b118b474a9', 'fecha2', 'fecha2', 'fecha2', 2, '2017-01-02'),
(6, 'fecha3', '5a8eeae56b3335f2944e88792e417f91', 'fecha3', 'fecha3', 'fecha3', 2, '2017-01-02'),
(7, 'Luis', 'c44688b5061756b3cca2b86c016a1535', 'Luis', 'Luis', 'Luis', 1, '2017-02-04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_areas`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indices de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  ADD PRIMARY KEY (`id_tipo_productos`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_areas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `id_tipo_productos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
