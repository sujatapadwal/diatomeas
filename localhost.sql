-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-01-2013 a las 17:13:57
-- Versión del servidor: 5.1.30
-- Versión de PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `diatomeas`
--
CREATE DATABASE `diatomeas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `diatomeas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('641d7cdc55091d890e13bde0ceb78791', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11 AlexaToolba', 1357183733, 'a:6:{s:9:"user_data";s:0:"";s:10:"id_usuario";s:1:"1";s:6:"nombre";s:5:"Admin";s:5:"email";s:15:"admin@gmail.com";s:6:"acceso";s:5:"admin";s:7:"idunico";s:24:"l50e4fb008c5ec7.87314208";}'),
('f4d47e93f74387dc411d17b383e1ec7c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11 AlexaToolba', 1357239124, 'a:6:{s:9:"user_data";s:0:"";s:10:"id_usuario";s:1:"1";s:6:"nombre";s:5:"Admin";s:5:"email";s:15:"admin@gmail.com";s:6:"acceso";s:5:"admin";s:7:"idunico";s:24:"l50e5d3608c3d78.48744304";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_lista_precio` int(10) unsigned NOT NULL,
  `nombre_fiscal` varchar(130) NOT NULL,
  `calle` varchar(60) NOT NULL,
  `no_exterior` varchar(7) NOT NULL,
  `no_interior` varchar(7) NOT NULL,
  `colonia` varchar(60) NOT NULL,
  `localidad` varchar(45) NOT NULL,
  `municipio` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `cp` int(10) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `recepcion_facturas` varchar(10) NOT NULL,
  `dias_pago` varchar(10) NOT NULL,
  `descuento` double NOT NULL DEFAULT '0',
  `telefono` varchar(15) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `pag_web` varchar(80) NOT NULL,
  `email` varchar(70) NOT NULL,
  `status` enum('ac','e') NOT NULL DEFAULT 'ac',
  PRIMARY KEY (`id_cliente`),
  KEY `id_lista_precio` (`id_lista_precio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `id_lista_precio`, `nombre_fiscal`, `calle`, `no_exterior`, `no_interior`, `colonia`, `localidad`, `municipio`, `estado`, `cp`, `rfc`, `recepcion_facturas`, `dias_pago`, `descuento`, `telefono`, `celular`, `pag_web`, `email`, `status`) VALUES
(1, 1, 'Gamaliel Mendoza solis', 'ALBAÑILES', '542', '12', 'CORREGIDORA', '', 'COLIMA', 'COLIMA', 28919, '0', 'Martes', 'Domingo', 5, '3039188', '31289382', '', '', 'ac');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_contacto`
--

CREATE TABLE IF NOT EXISTS `clientes_contacto` (
  `id_contacto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `nextel` varchar(20) NOT NULL,
  `nextel_id` varchar(25) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `extension` varchar(8) NOT NULL,
  `puesto` varchar(20) NOT NULL,
  PRIMARY KEY (`id_contacto`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `clientes_contacto`
--

INSERT INTO `clientes_contacto` (`id_contacto`, `id_cliente`, `nombre`, `fax`, `nextel`, `nextel_id`, `telefono`, `celular`, `extension`, `puesto`) VALUES
(1, 1, 'Abrahan', '', '329832', '99382*33*22', '32093203', '3923892', '39238', 'Ventas'),
(7, 1, 'das', '', '', '', 'asd', 'asd', 'asd', 'asd'),
(8, 1, 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_extra`
--

CREATE TABLE IF NOT EXISTS `clientes_extra` (
  `id_cliente` bigint(20) unsigned NOT NULL,
  `nombre` varchar(130) NOT NULL,
  `calle` varchar(60) NOT NULL,
  `no_exterior` varchar(7) NOT NULL,
  `no_interior` varchar(7) NOT NULL,
  `colonia` varchar(60) NOT NULL,
  `localidad` varchar(45) NOT NULL,
  `municipio` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `cp` varchar(10) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `clientes_extra`
--

INSERT INTO `clientes_extra` (`id_cliente`, `nombre`, `calle`, `no_exterior`, `no_interior`, `colonia`, `localidad`, `municipio`, `estado`, `cp`) VALUES
(1, 'Gamaliel Mendoza solis', 'ALBAÑILES', '542', '', 'CORREGIDORA', '', 'COLIMA', 'COLIMA', '28919');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `id_factura` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `serie` varchar(30) NOT NULL,
  `folio` bigint(20) NOT NULL,
  `no_aprobacion` bigint(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `importe_iva` double NOT NULL,
  `retencion_iva` double NOT NULL,
  `descuento` double NOT NULL DEFAULT '0',
  `subtotal` double NOT NULL,
  `total` double NOT NULL,
  `total_letra` varchar(250) NOT NULL,
  `img_cbb` varchar(60) NOT NULL,
  `forma_pago` varchar(80) NOT NULL,
  `metodo_pago` varchar(40) NOT NULL,
  `metodo_pago_digitos` varchar(20) NOT NULL,
  `condicion_pago` enum('co','cr') NOT NULL DEFAULT 'co' COMMENT 'cr:credito o co:contado',
  `plazo_credito` int(11) NOT NULL DEFAULT '0',
  `domicilio` varchar(250) NOT NULL,
  `ciudad` varchar(220) NOT NULL,
  `status` enum('p','pa','ca') NOT NULL DEFAULT 'pa' COMMENT 'p:pendiente, pa:pagada, ca:cancelada',
  PRIMARY KEY (`id_factura`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `facturas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_productos`
--

CREATE TABLE IF NOT EXISTS `facturas_productos` (
  `id_fac_prod` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_factura` bigint(20) unsigned NOT NULL,
  `id_producto` bigint(20) unsigned DEFAULT NULL,
  `descripcion` varchar(250) NOT NULL,
  `taza_iva` double NOT NULL,
  `cantidad` double NOT NULL,
  `precio_unitario` double NOT NULL,
  `importe` double NOT NULL,
  `importe_iva` double NOT NULL,
  `total` double NOT NULL,
  `descuento` float NOT NULL DEFAULT '0' COMMENT 'Es el % del descuento',
  `retencion` float NOT NULL DEFAULT '0' COMMENT 'Es el % de la retencion',
  PRIMARY KEY (`id_fac_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `facturas_productos`
--


-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listas_precio`
--
CREATE TABLE IF NOT EXISTS `listas_precio` (
`id_producto` bigint(20) unsigned
,`id_familia` int(10) unsigned
,`codigo` varchar(20)
,`nombre` varchar(70)
,`precio` double
,`id_lista` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE IF NOT EXISTS `privilegios` (
  `id_privilegio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `id_padre` int(10) unsigned NOT NULL,
  `mostrar_menu` tinyint(1) NOT NULL DEFAULT '1',
  `url_accion` varchar(100) NOT NULL,
  `url_icono` varchar(100) NOT NULL,
  `target_blank` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_privilegio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcar la base de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`id_privilegio`, `nombre`, `id_padre`, `mostrar_menu`, `url_accion`, `url_icono`, `target_blank`) VALUES
(1, 'Privilegios', 0, 1, 'privilegios/', 'lock', 0),
(2, 'Agregar', 1, 1, 'privilegios/agregar/', 'plus', 0),
(3, 'Eliminar', 1, 0, 'privilegios/eliminar/', 'remove', 0),
(4, 'Modificar', 1, 0, 'privilegios/modificar/', 'edit', 0),
(5, 'Usuarios', 0, 1, 'usuarios/', 'user', 0),
(6, 'Agregar', 5, 1, 'usuarios/agregar/', 'plus', 0),
(7, 'Modificar', 5, 0, 'usuarios/modificar/', 'edit', 0),
(8, 'Eliminar', 5, 0, 'usuarios/eliminar/', 'remove', 0),
(9, 'Productos', 0, 1, 'productos/', 'hdd', 0),
(10, 'Agregar producto', 9, 0, 'productos/agregar/', 'plus', 0),
(11, 'Agregar familia', 9, 0, 'productos/agregar_familia/', 'plus', 0),
(12, 'Eliminar producto', 9, 0, 'productos/desactivar/', 'remove', 0),
(13, 'Eliminar familia', 9, 0, 'productos/desactivar_familia/', 'remove', 0),
(14, 'Modificar producto', 9, 0, 'productos/modificar/', 'edit', 0),
(15, 'Modificar familia', 9, 0, 'productos/modificar_familia/', 'edit', 0),
(16, 'Listas precio', 9, 1, 'listas_precio/', 'list', 0),
(17, 'Agregar lista', 16, 0, 'listas_precio/agregar/', 'plus', 0),
(18, 'Cambiar precio', 16, 0, 'listas_precio/cambiar_precio/', 'edit', 0),
(19, 'Clientes', 0, 1, 'clientes/', 'user', 0),
(20, 'Agregar', 19, 1, 'clientes/agregar/', 'plus', 0),
(21, 'Agregar Contacto', 19, 0, 'clientes/agregar_contacto/', 'plus', 0),
(22, 'Eliminar', 19, 0, 'clientes/eliminar/', 'remove', 0),
(23, 'Eliminar Contacto', 19, 0, 'clientes/eliminar_contacto/', 'remove', 0),
(24, 'Modificar', 19, 0, 'clientes/modificar/', 'edit', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_familia` int(10) unsigned NOT NULL,
  `id_unidad` int(10) unsigned NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `status` enum('ac','e') NOT NULL DEFAULT 'ac' COMMENT 'ac:activo o e:eliminado',
  PRIMARY KEY (`id_producto`),
  KEY `id_familia` (`id_familia`),
  KEY `id_unidad` (`id_unidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_familia`, `id_unidad`, `codigo`, `nombre`, `status`) VALUES
(1, 1, 5, '1-1', 'Producto 1 familia 1', 'ac'),
(2, 1, 6, '1-2', 'Producto 2 familia 1', 'ac'),
(3, 1, 4, '1-3', 'Producto 11 familia 1', 'ac'),
(4, 2, 9, '2-23', 'sdfsdfsdf sdfsd fsd sld flksdj lfksjd klfjs ldkfjslkdjflskd jflksdj lk', 'e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_familias`
--

CREATE TABLE IF NOT EXISTS `productos_familias` (
  `id_familia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(8) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `status` enum('ac','e') NOT NULL DEFAULT 'ac' COMMENT 'ac:activo, e:eliminado',
  PRIMARY KEY (`id_familia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `productos_familias`
--

INSERT INTO `productos_familias` (`id_familia`, `codigo`, `nombre`, `status`) VALUES
(1, '1', 'Familia 1', 'ac'),
(2, '2', 'Familia 2', 'ac'),
(3, '23123123', 'sasd asd asd asd as dasd ad asd asd asd asd asd asd kaj sdlk', 'e'),
(4, '2ds', 'das', 'e'),
(5, 'asd', 'asd', 'e'),
(6, 'as', 'asd', 'e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_listas`
--

CREATE TABLE IF NOT EXISTS `productos_listas` (
  `id_lista` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `es_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_lista`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `productos_listas`
--

INSERT INTO `productos_listas` (`id_lista`, `nombre`, `es_default`) VALUES
(1, 'Default', 0),
(2, 'Lista 1', 0),
(3, 'Lista de precios 2', 0),
(4, 'Lista 3', 0),
(5, 'Lista 4', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_listas_precios`
--

CREATE TABLE IF NOT EXISTS `productos_listas_precios` (
  `id_lista` int(10) unsigned NOT NULL,
  `id_producto` bigint(20) unsigned NOT NULL,
  `precio` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_lista`,`id_producto`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `productos_listas_precios`
--

INSERT INTO `productos_listas_precios` (`id_lista`, `id_producto`, `precio`) VALUES
(1, 1, 43.5),
(1, 2, 40),
(1, 3, 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_unidades`
--

CREATE TABLE IF NOT EXISTS `productos_unidades` (
  `id_unidad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `abreviatura` varchar(10) NOT NULL,
  `status` enum('ac','e') NOT NULL COMMENT 'ac:activo, e:eliminado',
  PRIMARY KEY (`id_unidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `productos_unidades`
--

INSERT INTO `productos_unidades` (`id_unidad`, `nombre`, `abreviatura`, `status`) VALUES
(1, 'Kilos', 'Kg', 'ac'),
(2, 'Unidad', 'U', 'ac'),
(3, 'Gramo', 'g', 'ac'),
(4, 'Metro', 'm', 'ac'),
(5, 'Centimetro', 'cm', 'ac'),
(6, 'Litro', 'L', 'ac'),
(7, 'Mililitro', 'mL', 'ac'),
(8, 'Pieza', 'Pz', 'ac'),
(9, 'No aplica', 'N A', 'ac');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(110) NOT NULL,
  `email` varchar(70) NOT NULL,
  `pass` varchar(35) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` enum('admin','usuario') NOT NULL DEFAULT 'usuario',
  `facebook_user_id` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:activo, 0:eliminado',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `pass`, `fecha_registro`, `tipo`, `facebook_user_id`, `status`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345', '2012-11-07 21:56:37', 'admin', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_privilegios`
--

CREATE TABLE IF NOT EXISTS `usuarios_privilegios` (
  `id_usuario` bigint(20) unsigned NOT NULL,
  `id_privilegio` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_privilegio`),
  KEY `id_privilegio` (`id_privilegio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `usuarios_privilegios`
--

INSERT INTO `usuarios_privilegios` (`id_usuario`, `id_privilegio`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24);

-- --------------------------------------------------------

--
-- Estructura para la vista `listas_precio`
--
DROP TABLE IF EXISTS `listas_precio`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listas_precio` AS select `p`.`id_producto` AS `id_producto`,`p`.`id_familia` AS `id_familia`,`p`.`codigo` AS `codigo`,`p`.`nombre` AS `nombre`,ifnull(`plp`.`precio`,0) AS `precio`,`plp`.`id_lista` AS `id_lista` from (`productos` `p` join `productos_listas_precios` `plp` on((`p`.`id_producto` = `plp`.`id_producto`)));

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_lista_precio`) REFERENCES `productos_listas` (`id_lista`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientes_contacto`
--
ALTER TABLE `clientes_contacto`
  ADD CONSTRAINT `clientes_contacto_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientes_extra`
--
ALTER TABLE `clientes_extra`
  ADD CONSTRAINT `clientes_extra_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_familia`) REFERENCES `productos_familias` (`id_familia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_unidad`) REFERENCES `productos_unidades` (`id_unidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_listas_precios`
--
ALTER TABLE `productos_listas_precios`
  ADD CONSTRAINT `productos_listas_precios_ibfk_1` FOREIGN KEY (`id_lista`) REFERENCES `productos_listas` (`id_lista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_listas_precios_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_privilegios`
--
ALTER TABLE `usuarios_privilegios`
  ADD CONSTRAINT `usuarios_privilegios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_privilegios_ibfk_2` FOREIGN KEY (`id_privilegio`) REFERENCES `privilegios` (`id_privilegio`) ON DELETE CASCADE ON UPDATE CASCADE;
