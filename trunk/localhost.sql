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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `clientes`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `clientes_contacto`
--

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id_empresa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
  `telefono` varchar(15) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `status` enum('ac','e') NOT NULL DEFAULT 'ac',
  `email` varchar(80) NOT NULL,
  `pag_web` varchar(70) NOT NULL,
  `logo` varchar(130) NOT NULL,
  `regimen_fiscal` varchar(200) NOT NULL DEFAULT '''''',
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `empresas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `id_factura` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `id_empresa` bigint(20) unsigned NOT NULL,
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
  KEY `id_cliente` (`id_cliente`),
  KEY `id_empresa` (`id_empresa`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `unidad` varchar(20) NOT NULL,
  PRIMARY KEY (`id_fac_prod`),
  KEY `id_factura` (`id_factura`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `facturas_productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_series_folios`
--

CREATE TABLE IF NOT EXISTS `facturas_series_folios` (
  `id_serie_folio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` bigint(20) unsigned NOT NULL,
  `serie` varchar(30) NOT NULL,
  `no_aprobacion` bigint(20) unsigned NOT NULL,
  `folio_inicio` bigint(20) unsigned NOT NULL,
  `folio_fin` bigint(20) unsigned NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `leyenda` varchar(70) NOT NULL,
  `leyenda1` text NOT NULL,
  `leyenda2` text NOT NULL,
  `ano_aprobacion` date NOT NULL,
  PRIMARY KEY (`id_serie_folio`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `facturas_series_folios`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

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
(24, 'Modificar', 19, 0, 'clientes/modificar/', 'edit', 0),
(25, 'Empresas', 0, 1, 'empresas/', 'book', 0),
(26, 'Agregar', 25, 1, 'empresas/agregar/', 'plus', 0),
(27, 'Modificar', 25, 0, 'empresas/modificar/', 'edit', 0),
(28, 'Eliminar', 25, 0, 'empresas/eliminar/', 'remove', 0),
(29, 'Facturación', 0, 1, 'facturacion/', 'file', 0),
(30, 'Series y Folios', 29, 1, 'facturacion/series_folios/', 'th', 0),
(31, 'Agregar', 30, 1, 'facturacion/agregar_serie_folio/', 'plus', 0),
(32, 'Agregar', 29, 1, 'facturacion/agregar/', 'plus', 0),
(33, 'Modificar', 30, 0, 'facturacion/modificar_serie_folio/', 'edit', 0),
(34, 'Pagar', 29, 0, 'facturacion/pagar/', 'inbox', 0),
(35, 'Cancelar', 29, 0, 'facturacion/cancelar/', 'ban-circle', 0),
(36, 'Imprimir', 29, 0, 'facturacion/imprimir/', 'print', 0),
(37, 'Reporte Ventas Cliente', 29, 1, 'facturacion/rvc/', 'book', 0),
(38, 'Reporte Ventas Producto', 29, 1, 'facturacion/rvp/', 'book', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `productos`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `productos_familias`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_listas`
--

CREATE TABLE IF NOT EXISTS `productos_listas` (
  `id_lista` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `es_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_lista`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `productos_listas`
--

INSERT INTO `productos_listas` (`id_lista`, `nombre`, `es_default`) VALUES
(1, 'Default', 1);

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
(1, 'Admin', 'admin', '12345', '2012-11-07 21:56:37', 'admin', NULL, 1);

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
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38);

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
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_3` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas_productos`
--
ALTER TABLE `facturas_productos`
  ADD CONSTRAINT `facturas_productos_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_productos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas_series_folios`
--
ALTER TABLE `facturas_series_folios`
  ADD CONSTRAINT `facturas_series_folios_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

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

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `get_precio_producto`(vid_cliente BIGINT, vid_producto BIGINT) RETURNS varchar(100) CHARSET utf8
BEGIN
 DECLARE price DOUBLE;
 SELECT precio INTO price
  FROM productos_listas_precios
  WHERE id_producto = vid_producto AND id_lista = (SELECT id_lista_precio FROM clientes WHERE id_cliente = vid_cliente);
 return price;
END$$

DELIMITER ;
