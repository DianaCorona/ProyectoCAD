-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-03-2017 a las 13:50:27
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `testdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `id_almacenes` int(11) NOT NULL,
  `nombre_almacen` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `id_responsable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_areas` int(11) NOT NULL,
  `nombre_area` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `id_responsable` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_areas`, `nombre_area`, `descripcion`, `fecha_alta`, `id_responsable`) VALUES
(1, 'administrativa', NULL, NULL, 0),
(2, 'finanzas', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_almacen`
--

CREATE TABLE `area_almacen` (
  `id_area_almacen` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_almacen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_usuarios`
--

CREATE TABLE `bitacora_usuarios` (
  `id_bitacora_usuarios` int(11) NOT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campos_tipo_producto`
--

CREATE TABLE `campos_tipo_producto` (
  `id_campos_tipo_producto` int(11) NOT NULL,
  `indice_campo_producto` varchar(45) DEFAULT NULL,
  `id_tipo_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `erareas`
--

CREATE TABLE `erareas` (
  `id_area` int(11) NOT NULL,
  `id_area_entrega` int(11) NOT NULL,
  `id_area_recepcion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios_area`
--

CREATE TABLE `privilegios_area` (
  `id_privilegios_area` int(11) NOT NULL,
  `privilegio` varchar(45) DEFAULT NULL,
  `control` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios_sistema`
--

CREATE TABLE `privilegios_sistema` (
  `id_privilegios_sistema` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_privilegio_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `unidad_medida` varchar(45) DEFAULT NULL,
  `calibre` varchar(45) DEFAULT NULL,
  `voltaje` varchar(45) DEFAULT NULL,
  `tipo_tarjeta` varchar(45) DEFAULT NULL,
  `id_tipo_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos`
--

CREATE TABLE `tipo_productos` (
  `id_tipo_productos` int(11) NOT NULL,
  `nombre_tipo_producto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_productos`
--

INSERT INTO `tipo_productos` (`id_tipo_productos`, `nombre_tipo_producto`) VALUES
(1, 'Periodicos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (

  `id_usuarios` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `appaterno` varchar(45) DEFAULT NULL,
  `apmaterno` varchar(45) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  `id_areas` int(11) DEFAULT NULL,
  `privilegios` int(11) DEFAULT NULL,
  `id_privilegios` int(11) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `usuario`, `appaterno`, `apmaterno`, `fecha_alta`, `id_status`, `id_areas`, `privilegios`, `id_privilegios`, `password`, `nombre`) VALUES
(1, 'admin', 'admin', 'asdfghj', '2017-02-04', 1, 1, 1, 1, 'fd6438b18f84875b61d905b64d1742ab', 'admin'),
(2, 'Diana', 'Corona', 'García', '2017-02-04', 2, 2, 1, NULL, 'fd6438b18f84875b61d905b64d1742ab', 'Diana'),
(10, 'Pats', '', '', '2017-03-02', 3, 2, 1, NULL, 'fd6438b18f84875b61d905b64d1742ab', 'Pats'),
(11, 'Corona', 'Corona', 'Corona', '2017-03-02', 1, 2, 1, NULL, '5102b6478a52b43ec33b46e031e63c8f', 'Corona'),
(13, 'status', 'status', 'status', '2017-03-02', 1, 1, 2, NULL, '9acb44549b41563697bb490144ec6258', 'status');
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id_almacenes`),
  ADD KEY `fk_ALMACENES_USUARIOS1_idx` (`id_responsable`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_areas`),
  ADD KEY `fk_AREAS_USUARIOS1_idx` (`id_responsable`);

--
-- Indices de la tabla `area_almacen`
--
ALTER TABLE `area_almacen`
  ADD PRIMARY KEY (`id_area_almacen`),
  ADD KEY `fk_AREA_ALMACEN_ALMACENES1_idx` (`id_almacen`),
  ADD KEY `fk_AREA_ALMACEN_AREAS1_idx` (`id_area`);

--
-- Indices de la tabla `bitacora_usuarios`
--
ALTER TABLE `bitacora_usuarios`
  ADD PRIMARY KEY (`id_bitacora_usuarios`),
  ADD KEY `fk_BITACORA_USUARIOS_USUARIOS1_idx` (`id_usuarios`),
  ADD KEY `fk_BITACORA_USUARIOS_STATUS1_idx` (`id_status`);

--
-- Indices de la tabla `campos_tipo_producto`
--
ALTER TABLE `campos_tipo_producto`
  ADD PRIMARY KEY (`id_campos_tipo_producto`),
  ADD KEY `fk_CAMPOS_TIPO_PRODUCTO_TIPO_PRODUCTOS1_idx` (`id_tipo_producto`);

--
-- Indices de la tabla `erareas`
--
ALTER TABLE `erareas`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `fk_ERAREAS_AREAS1_idx` (`id_area_entrega`),
  ADD KEY `fk_ERAREAS_AREAS2_idx` (`id_area_recepcion`);

--
-- Indices de la tabla `privilegios_area`
--
ALTER TABLE `privilegios_area`
  ADD PRIMARY KEY (`id_privilegios_area`);

--
-- Indices de la tabla `privilegios_sistema`
--
ALTER TABLE `privilegios_sistema`
  ADD PRIMARY KEY (`id_privilegios_sistema`),
  ADD KEY `fk_PRIVILEGIOS_SISTEMA_AREAS1_idx` (`id_area`),
  ADD KEY `fk_PRIVILEGIOS_SISTEMA_PRIVILEGIOS_AREA1_idx` (`id_privilegio_area`),
  ADD KEY `fk_PRIVILEGIOS_SISTEMA_USUARIOS1_idx` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`);

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
  ADD PRIMARY KEY (`id_usuarios`),
  ADD KEY `fk_USUARIOS_AREAS1_idx` (`id_areas`),
  ADD KEY `fk_USUARIOS_STATUS_idx` (`id_status`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id_almacenes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_areas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `area_almacen`
--
ALTER TABLE `area_almacen`
  MODIFY `id_area_almacen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `bitacora_usuarios`
--
ALTER TABLE `bitacora_usuarios`
  MODIFY `id_bitacora_usuarios` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `campos_tipo_producto`
--
ALTER TABLE `campos_tipo_producto`
  MODIFY `id_campos_tipo_producto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `erareas`
--
ALTER TABLE `erareas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `privilegios_area`
--
ALTER TABLE `privilegios_area`
  MODIFY `id_privilegios_area` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `privilegios_sistema`
--
ALTER TABLE `privilegios_sistema`
  MODIFY `id_privilegios_sistema` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `id_tipo_productos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `area_almacen`
--
ALTER TABLE `area_almacen`
  ADD CONSTRAINT `fk_AREA_ALMACEN_ALMACENES1` FOREIGN KEY (`id_almacen`) REFERENCES `almacenes` (`id_almacenes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `bitacora_usuarios`
--
ALTER TABLE `bitacora_usuarios`
  ADD CONSTRAINT `fk_BITACORA_USUARIOS_USUARIOS1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `erareas`
--
ALTER TABLE `erareas`
  ADD CONSTRAINT `fk_ERAREAS_AREAS1` FOREIGN KEY (`id_area_entrega`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ERAREAS_AREAS2` FOREIGN KEY (`id_area_recepcion`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `privilegios_sistema`
--
ALTER TABLE `privilegios_sistema`
  ADD CONSTRAINT `fk_PRIVILEGIOS_SISTEMA_AREAS1` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PRIVILEGIOS_SISTEMA_PRIVILEGIOS_AREA1` FOREIGN KEY (`id_privilegio_area`) REFERENCES `privilegios_area` (`id_privilegios_area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_USUARIOS_AREAS1` FOREIGN KEY (`id_areas`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
