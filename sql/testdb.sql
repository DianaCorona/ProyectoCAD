-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-03-2017 a las 08:46:08
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_areas`, `nombre_area`, `descripcion`, `fecha_alta`, `id_responsable`) VALUES
(3, 'Recursos Humanos', 'Recursos Humanos', '2017-03-04', 2),
(12, 'Administrativo', 'sdfasdf', '2017-03-05', 2),
(13, 'web', '123', '2017-03-05', 2),
(14, 'Redes', 'Redes', '2017-03-05', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_almacen`
--

CREATE TABLE `area_almacen` (
  `id_area_almacen` int(11) NOT NULL,
  `id_areas` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bitacora_usuarios`
--

INSERT INTO `bitacora_usuarios` (`id_bitacora_usuarios`, `fecha_modificacion`, `id_status`, `id_usuarios`) VALUES
(1, '2017-03-04', 1, 4),
(2, '2017-03-04', 2, 3);

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
  `id_areas_entrega` int(11) NOT NULL,
  `id_areas_recepcion` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `erareas`
--

INSERT INTO `erareas` (`id_area`, `id_areas_entrega`, `id_areas_recepcion`) VALUES
(5, 13, 12),
(10, 14, 14),
(12, 13, 12),
(14, 3, 3),
(16, 3, 3),
(17, 13, 12),
(18, 3, 3),
(19, 3, 3),
(20, 13, 3);

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
  `id_areas` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id_status`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Baja');

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
  `id_privilegios` int(11) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `privilegios` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `usuario`, `appaterno`, `apmaterno`, `fecha_alta`, `id_status`, `id_areas`, `id_privilegios`, `password`, `nombre`, `privilegios`) VALUES
(1, 'admin', '', '', '2017-02-04', 1, 12, 1, '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 1),
(2, 'Luis', 'Perez', 'Lopez', '2017-02-04', 1, 12, 1, '502ff82f7f1f8218dd41201fe4353687', 'Luis', 1),
(3, 'Luis', 'Sabanero', 'Esquivel', '2017-02-04', 2, 14, 1, '3f128e570b3a9009d7b52a0523af43dd', 'Alfonso', 2),
(4, 'ok', 'ok', 'ok', '2017-03-04', 1, 3, NULL, '444bcb3a3fcf8389296c49467f27e1d6', 'ok', 1);

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
  ADD KEY `fk_AREA_ALMACEN_AREAS1_idx` (`id_areas`);

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
  ADD KEY `fk_ERAREAS_AREAS1_idx` (`id_areas_entrega`),
  ADD KEY `fk_ERAREAS_AREAS2_idx` (`id_areas_recepcion`);

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
  ADD KEY `fk_PRIVILEGIOS_SISTEMA_AREAS1_idx` (`id_areas`),
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
  MODIFY `id_areas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `area_almacen`
--
ALTER TABLE `area_almacen`
  MODIFY `id_area_almacen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `bitacora_usuarios`
--
ALTER TABLE `bitacora_usuarios`
  MODIFY `id_bitacora_usuarios` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `campos_tipo_producto`
--
ALTER TABLE `campos_tipo_producto`
  MODIFY `id_campos_tipo_producto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `erareas`
--
ALTER TABLE `erareas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
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
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `id_tipo_productos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
  ADD CONSTRAINT `fk_ERAREAS_AREAS1` FOREIGN KEY (`id_areas_entrega`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ERAREAS_AREAS2` FOREIGN KEY (`id_areas_recepcion`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `privilegios_sistema`
--
ALTER TABLE `privilegios_sistema`
  ADD CONSTRAINT `fk_PRIVILEGIOS_SISTEMA_AREAS1` FOREIGN KEY (`id_areas`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PRIVILEGIOS_SISTEMA_PRIVILEGIOS_AREA1` FOREIGN KEY (`id_privilegio_area`) REFERENCES `privilegios_area` (`id_privilegios_area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_USUARIOS_AREAS1` FOREIGN KEY (`id_areas`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-03-2017 a las 08:46:08
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_areas`, `nombre_area`, `descripcion`, `fecha_alta`, `id_responsable`) VALUES
(3, 'Recursos Humanos', 'Recursos Humanos', '2017-03-04', 2),
(12, 'fdff', 'sdfasdf', '2017-03-05', 2),
(13, 'web', '123', '2017-03-05', 2),
(14, 'Redes', 'Redes', '2017-03-05', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_almacen`
--

CREATE TABLE `area_almacen` (
  `id_area_almacen` int(11) NOT NULL,
  `id_areas` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bitacora_usuarios`
--

INSERT INTO `bitacora_usuarios` (`id_bitacora_usuarios`, `fecha_modificacion`, `id_status`, `id_usuarios`) VALUES
(1, '2017-03-04', 1, 4),
(2, '2017-03-04', 2, 3);

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
  `id_areas_entrega` int(11) NOT NULL,
  `id_areas_recepcion` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `erareas`
--

INSERT INTO `erareas` (`id_area`, `id_areas_entrega`, `id_areas_recepcion`) VALUES
(5, 13, 12),
(10, 14, 14),
(12, 13, 12),
(14, 3, 3),
(16, 3, 3),
(17, 13, 12),
(18, 3, 3),
(19, 3, 3),
(20, 13, 3);

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
  `id_areas` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id_status`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Baja');

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
  `id_privilegios` int(11) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `privilegios` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `usuario`, `appaterno`, `apmaterno`, `fecha_alta`, `id_status`, `id_areas`, `id_privilegios`, `password`, `nombre`, `privilegios`) VALUES
(1, 'admin', '', '', '2017-02-04', 1, 12, 1, '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 1),
(2, 'Luis', 'Perez', 'Lopez', '2017-02-04', 1, 12, 1, '502ff82f7f1f8218dd41201fe4353687', 'Luis', 1),
(3, 'Luis', 'Sabanero', 'Esquivel', '2017-02-04', 2, 14, 1, '3f128e570b3a9009d7b52a0523af43dd', 'Alfonso', 2),
(4, 'ok', 'ok', 'ok', '2017-03-04', 1, 3, NULL, '444bcb3a3fcf8389296c49467f27e1d6', 'ok', 1);

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
  ADD KEY `fk_AREA_ALMACEN_AREAS1_idx` (`id_areas`);

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
  ADD KEY `fk_ERAREAS_AREAS1_idx` (`id_areas_entrega`),
  ADD KEY `fk_ERAREAS_AREAS2_idx` (`id_areas_recepcion`);

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
  ADD KEY `fk_PRIVILEGIOS_SISTEMA_AREAS1_idx` (`id_areas`),
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
  MODIFY `id_areas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `area_almacen`
--
ALTER TABLE `area_almacen`
  MODIFY `id_area_almacen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `bitacora_usuarios`
--
ALTER TABLE `bitacora_usuarios`
  MODIFY `id_bitacora_usuarios` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `campos_tipo_producto`
--
ALTER TABLE `campos_tipo_producto`
  MODIFY `id_campos_tipo_producto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `erareas`
--
ALTER TABLE `erareas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
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
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `id_tipo_productos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
  ADD CONSTRAINT `fk_ERAREAS_AREAS1` FOREIGN KEY (`id_areas_entrega`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ERAREAS_AREAS2` FOREIGN KEY (`id_areas_recepcion`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `privilegios_sistema`
--
ALTER TABLE `privilegios_sistema`
  ADD CONSTRAINT `fk_PRIVILEGIOS_SISTEMA_AREAS1` FOREIGN KEY (`id_areas`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PRIVILEGIOS_SISTEMA_PRIVILEGIOS_AREA1` FOREIGN KEY (`id_privilegio_area`) REFERENCES `privilegios_area` (`id_privilegios_area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_USUARIOS_AREAS1` FOREIGN KEY (`id_areas`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
