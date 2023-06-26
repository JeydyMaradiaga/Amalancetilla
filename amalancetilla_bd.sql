-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-03-2023 a las 23:35:54
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `amalancetilla_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `productoid` bigint NOT NULL,
  `img` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productoid` (`productoid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria_productos`
--

DROP TABLE IF EXISTS `tbl_categoria_productos`;
CREATE TABLE IF NOT EXISTS `tbl_categoria_productos` (
  `Id_Categoria_Producto` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_Categoria` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Foto_Categoria` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Categoria_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_categoria_productos`
--

INSERT INTO `tbl_categoria_productos` (`Id_Categoria_Producto`, `Nombre_Categoria`, `Descripcion`, `Estado`, `Foto_Categoria`) VALUES
(1, 'LIMPIEZA', 'categoria prueba', '1', 'img_7008141108be3de851b2ca587f924db9.jpg'),
(2, 'SUMPLEMENTOS', 'CATEGORIA DE SUPLEMENTOS', '1', 'img_2b2d1b1c4ef2ffee589d3f0ae872c277.jpg'),
(3, 'SNAKCS', 'CATEGORIA DE SNAKS', '1', 'img_7931f534a1bf0c4c0ada45b4b0dc6486.jpg'),
(12, 'BEBIDAS', 'CATEGORIA DE BEBIDAS', '1', 'img_45db0effc700dc42c5ebdc76b88960ba.jpg'),
(13, 'CARNES Y EMBUTIDOS', 'CARNES', '1', 'img_832b16794dace478db9f835d89fd7c6d.jpg'),
(14, 'PLASTICOS', 'CAT', '1', 'img_d4b2d91e6073273ded2a1aa9e37be605.jpg'),
(15, 'PORCELANA', 'PORCELANA', '1', 'img_4e78bdd0cdbb9c4c0371b21211517049.jpg'),
(16, 'ARTESANIAS', 'ARTE', '2', 'img_2a655b01d092b2f883d82ef9e7ed6430.jpg'),
(17, 'Maseca', 'a', '0', 'img_9b6692a70314e580fce03f0cfabd599d.jpg'),
(18, 'ABARROTERIA', 'CAT ABARROTERIA', '1', 'img_0b315a18738c13ecb9693ec70207d420.jpg'),
(19, 'JUGUETERIAS DE NIÑOS', 'NIÑOS', '0', 'img_42fdee9e0b8d43348447b5917166ff77.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes`
--

DROP TABLE IF EXISTS `tbl_clientes`;
CREATE TABLE IF NOT EXISTS `tbl_clientes` (
  `Id_Cliente` bigint NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Apellidos` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Correo_Cliente` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Telefono` int NOT NULL,
  `Direccion` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Contrasena` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Categoria` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Numero_ID` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Registro` date NOT NULL,
  PRIMARY KEY (`Id_Cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_clientes`
--

INSERT INTO `tbl_clientes` (`Id_Cliente`, `Nombre`, `Apellidos`, `Correo_Cliente`, `Telefono`, `Direccion`, `Contrasena`, `Categoria`, `Numero_ID`, `Fecha_Registro`) VALUES
(1, 'Luis', 'Diaz', 'josemanuelduronllanes@gmail.com', 94659981, 'Aldea de suyapa', '123456789', '1', '0109-1996-94533', '2022-10-13'),
(2, 'Jose', 'Llanes', 'jmllanes@gmai.com', 949981, '', '0705cc480029acd4f41fd72fa', '2', '0501-1999-15322', '2022-10-12'),
(3, 'LUIS', '', 'luis2022@gmail.com', 9494, 'SUYAPA', 'e528c2128d9c09d05633fc7cc', '1', '0801-2000-15324', '0000-00-00'),
(4, 'LUIS', 'DIAZ', 'luis202332@gmail.com', 9494, 'SUYAPA', 'e528c2128d9c09d05633fc7cc', '2', '703', '0000-00-00'),
(5, 'ANA', '', 'ana@gmail.com', 959981, 'ALDEA DE SUYAPA', '2c2112a5c75522b977e3d8911', '1', '0801-1999-47896', '0000-00-00'),
(6, 'CARLOS', '', 'carlosgg2022@gmail.com', 94659981, 'SUYAPA', 'Josellanes2023.', '1', '0801-2000-32544', '0000-00-00'),
(7, 'Jose ', '', 'cliente2022@gmail.com', 9465981, 'Aldea De Suyapa', '2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69', '1', '0801-2000-15322', '0000-00-00'),
(8, 'JORGE', 'DIAZ', 'josemanuelduronllanes@gmail.com', 94659981, 'SUYAPA', 'e528c2128d9c09d05633fc7cccc2302961ff9307b0d7c170d2c9d0a01ecfa546', '0', '31345345', '0000-00-00'),
(9, 'CLIENTE B', 'WFAFSADSSADSA', 'jonafsafsafures@gmail.com', 23232, 'FGASFASFSAAAAAA', 'e74b7ad5a996d7b83a77beff2d34d29a1d195190e295d5ddea600069492a8fa7', '0', '2323232', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_config_cai`
--

DROP TABLE IF EXISTS `tbl_config_cai`;
CREATE TABLE IF NOT EXISTS `tbl_config_cai` (
  `Id_CAI` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Descripcion` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Rango_Inicial` int NOT NULL,
  `Rango_Final` int NOT NULL,
  `Rango_Actual` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Vencimiento` date NOT NULL,
  `Numero_CAI` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_CAI`),
  KEY `Id_Usuario` (`Id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_config_cai`
--

INSERT INTO `tbl_config_cai` (`Id_CAI`, `Id_Usuario`, `Descripcion`, `Rango_Inicial`, `Rango_Final`, `Rango_Actual`, `Fecha_Vencimiento`, `Numero_CAI`) VALUES
(1, 2, '', 1, 999, '130', '2022-12-27', '2A2B6C-49C9A-69D4GD-09F319-1F4D5C-2G');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_descuentos`
--

DROP TABLE IF EXISTS `tbl_descuentos`;
CREATE TABLE IF NOT EXISTS `tbl_descuentos` (
  `Id_Descuento` bigint NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Porcentaje_Deduccion` decimal(10,0) NOT NULL,
  `Descripcion` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Descuento`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_descuentos`
--

INSERT INTO `tbl_descuentos` (`Id_Descuento`, `Nombre`, `Porcentaje_Deduccion`, `Descripcion`, `Estado`) VALUES
(1, 'RA', '45', 'descuentos para terc', '0'),
(2, 'CARNET ESTUDIANTIL', '56', 'D', '1'),
(3, 'CARNET', '233', 'descuento', '0'),
(4, 'DESCUENTO NAVIDAD', '45', 'F', '0'),
(5, 'EMPLEADO', '30', 'DESCUENTO', '1'),
(6, '3era edad', '54', 'PARA TERERA EDAD', '1'),
(7, 'Compra mayor a 500 lps', '10', 'COMPRA MAYOR A', '1'),
(8, 'NAVIDAD', '90', 'DESCUENTO', '0'),
(9, 'Descuento prueba', '5', 'PRUEBA', '0'),
(10, 'navidad', '90', 'DESCUENTO NAVIDAD', '0'),
(11, 'Navidad', '90', 'DESCUENTO', '0'),
(12, 'NAVIDAD', '90', 'NAVIDAD', '1'),
(13, 'familiares', '91', 'DESCUENTAAA', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_descuentos_pedidos`
--

DROP TABLE IF EXISTS `tbl_descuentos_pedidos`;
CREATE TABLE IF NOT EXISTS `tbl_descuentos_pedidos` (
  `Id_Desc_Pedidos` bigint NOT NULL AUTO_INCREMENT,
  `Id_Pedido` bigint NOT NULL,
  `Id_Descuento` bigint NOT NULL,
  `Descripcion` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Total_Descontado` decimal(10,0) NOT NULL,
  `Id_Detalle_Pedido` bigint NOT NULL,
  PRIMARY KEY (`Id_Desc_Pedidos`),
  KEY `Id_Pedido` (`Id_Pedido`),
  KEY `Id_Descuento` (`Id_Descuento`),
  KEY `Id_Detalle_Pedido` (`Id_Detalle_Pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_pedido`
--

DROP TABLE IF EXISTS `tbl_detalle_pedido`;
CREATE TABLE IF NOT EXISTS `tbl_detalle_pedido` (
  `Id_Detalle_Pedido` bigint NOT NULL AUTO_INCREMENT,
  `Id_Pedido` bigint NOT NULL,
  `Id_Producto` bigint NOT NULL,
  `Id_ISV` bigint NOT NULL,
  `Porcentaje_ISV` decimal(10,2) NOT NULL,
  `Cantidad` int NOT NULL,
  `Precio_Venta` decimal(10,0) NOT NULL,
  PRIMARY KEY (`Id_Detalle_Pedido`),
  KEY `Id_Pedido` (`Id_Pedido`),
  KEY `Id_Producto` (`Id_Producto`),
  KEY `Id_ISV` (`Id_ISV`)
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_detalle_pedido`
--

INSERT INTO `tbl_detalle_pedido` (`Id_Detalle_Pedido`, `Id_Pedido`, `Id_Producto`, `Id_ISV`, `Porcentaje_ISV`, `Cantidad`, `Precio_Venta`) VALUES
(27, 1, 22, 1, '0.15', 1, '32'),
(28, 1, 23, 1, '0.15', 1, '30'),
(29, 1, 26, 1, '0.15', 1, '13'),
(30, 1, 27, 1, '0.15', 1, '14'),
(31, 2, 22, 1, '0.15', 3, '32'),
(32, 2, 27, 1, '0.15', 3, '14'),
(33, 2, 30, 1, '0.15', 3, '23'),
(34, 3, 23, 1, '0.15', 3, '30'),
(35, 3, 26, 1, '0.15', 5, '13'),
(36, 3, 28, 1, '0.15', 5, '54'),
(37, 4, 27, 1, '0.15', 2, '14'),
(38, 4, 31, 1, '0.15', 2, '23'),
(39, 4, 32, 1, '0.15', 2, '56'),
(40, 4, 22, 1, '0.15', 2, '32'),
(41, 5, 23, 1, '0.15', 2, '30'),
(42, 5, 25, 3, '0.00', 2, '35'),
(43, 5, 28, 1, '0.15', 2, '54'),
(44, 5, 31, 1, '0.15', 2, '23'),
(45, 6, 23, 1, '0.15', 12, '30'),
(46, 6, 27, 1, '0.15', 8, '14'),
(47, 6, 31, 1, '0.15', 6, '23'),
(48, 6, 32, 1, '0.15', 4, '56'),
(49, 7, 23, 1, '0.15', 3, '30'),
(50, 7, 22, 1, '0.15', 3, '32'),
(51, 7, 30, 1, '0.15', 3, '23'),
(52, 8, 21, 1, '0.15', 3, '24'),
(53, 8, 25, 3, '0.00', 3, '35'),
(54, 9, 27, 1, '0.15', 3, '14'),
(55, 9, 29, 1, '0.15', 3, '23'),
(56, 9, 32, 1, '0.15', 3, '56'),
(57, 10, 26, 1, '0.15', 1, '13'),
(58, 10, 28, 1, '0.15', 1, '54'),
(59, 10, 32, 1, '0.15', 1, '56'),
(60, 11, 26, 1, '0.15', 1, '13'),
(61, 11, 27, 1, '0.15', 1, '14'),
(62, 11, 30, 1, '0.15', 1, '23'),
(63, 12, 27, 1, '0.15', 3, '14'),
(64, 13, 28, 1, '0.15', 2, '54'),
(65, 14, 26, 1, '0.15', 1, '13'),
(66, 15, 22, 1, '0.15', 3, '32'),
(67, 15, 25, 3, '0.00', 3, '35'),
(68, 16, 23, 1, '0.15', 6, '30'),
(69, 17, 23, 1, '0.15', 2, '30'),
(70, 17, 22, 1, '0.15', 2, '32'),
(71, 17, 31, 1, '0.15', 2, '23'),
(72, 18, 26, 1, '0.15', 3, '13'),
(73, 18, 22, 1, '0.15', 3, '32'),
(74, 18, 29, 1, '0.15', 3, '23'),
(75, 19, 25, 3, '0.00', 3, '35'),
(76, 19, 22, 1, '0.15', 3, '32'),
(77, 20, 28, 1, '0.15', 2, '54'),
(78, 20, 30, 1, '0.15', 2, '23'),
(79, 21, 23, 1, '0.15', 1, '30'),
(80, 21, 25, 3, '0.00', 2, '35'),
(81, 21, 29, 1, '0.15', 1, '23'),
(82, 21, 27, 1, '0.15', 1, '14'),
(83, 22, 21, 1, '0.15', 2, '24'),
(84, 22, 23, 1, '0.15', 2, '30'),
(85, 22, 30, 1, '0.15', 2, '23'),
(86, 22, 25, 3, '0.00', 2, '35'),
(87, 23, 23, 1, '0.15', 3, '30'),
(88, 23, 28, 1, '0.15', 3, '54'),
(89, 23, 30, 1, '0.15', 3, '23'),
(98, 27, 23, 1, '0.15', 2, '30'),
(99, 27, 28, 1, '0.15', 1, '54'),
(100, 27, 31, 1, '0.15', 1, '23'),
(101, 27, 32, 1, '0.15', 1, '56'),
(102, 27, 25, 2, '0.18', 1, '35'),
(103, 28, 22, 1, '0.15', 3, '32'),
(104, 29, 23, 1, '0.15', 1, '30'),
(105, 30, 25, 2, '0.18', 2, '35'),
(106, 30, 27, 1, '0.15', 1, '14'),
(107, 30, 31, 1, '0.15', 1, '23'),
(108, 30, 32, 1, '0.15', 1, '56'),
(110, 32, 25, 2, '0.18', 1, '35'),
(111, 33, 22, 1, '0.15', 2, '32'),
(112, 33, 27, 1, '0.15', 2, '14'),
(113, 33, 29, 1, '0.15', 2, '23'),
(116, 35, 26, 1, '0.15', 1, '13'),
(117, 35, 29, 1, '0.15', 1, '23'),
(118, 35, 31, 1, '0.15', 1, '23'),
(119, 36, 26, 1, '0.15', 3, '13'),
(120, 36, 29, 1, '0.15', 3, '23'),
(121, 36, 30, 1, '0.15', 3, '23'),
(122, 36, 32, 1, '0.15', 5, '56'),
(131, 44, 21, 1, '0.15', 1, '24'),
(132, 44, 23, 1, '0.15', 1, '30'),
(133, 45, 25, 2, '0.18', 1, '35'),
(134, 46, 25, 2, '0.18', 1, '35'),
(135, 47, 25, 2, '0.18', 1, '35'),
(136, 48, 21, 1, '0.15', 2, '24'),
(137, 49, 25, 2, '0.18', 1, '35'),
(138, 50, 21, 1, '0.15', 1, '24'),
(139, 51, 21, 1, '0.15', 1, '24'),
(140, 51, 22, 1, '0.15', 1, '32'),
(141, 52, 21, 1, '0.15', 1, '24'),
(142, 53, 23, 1, '0.15', 1, '30'),
(143, 54, 21, 1, '0.15', 1, '24'),
(144, 55, 23, 1, '0.15', 3, '30'),
(145, 55, 27, 1, '0.15', 3, '14'),
(146, 55, 32, 1, '0.15', 3, '56'),
(147, 55, 30, 1, '0.15', 3, '23'),
(148, 56, 27, 1, '0.15', 4, '14'),
(149, 56, 30, 1, '0.15', 4, '23'),
(150, 57, 21, 1, '0.15', 3, '24'),
(151, 57, 27, 1, '0.15', 1, '14'),
(152, 58, 21, 1, '0.15', 2, '24'),
(153, 58, 30, 1, '0.15', 2, '23'),
(156, 60, 32, 1, '0.15', 2, '56'),
(157, 60, 34, 1, '0.15', 2, '56'),
(159, 62, 32, 1, '0.15', 3, '56'),
(160, 63, 32, 1, '0.15', 21, '56'),
(161, 64, 32, 1, '0.15', 8, '56'),
(162, 65, 31, 1, '0.15', 1, '23'),
(163, 66, 31, 1, '0.15', 1, '23'),
(164, 67, 26, 1, '0.15', 3, '13'),
(165, 67, 33, 1, '0.15', 3, '45'),
(166, 67, 32, 1, '0.15', 3, '56'),
(167, 67, 35, 1, '0.15', 3, '26'),
(168, 68, 30, 1, '0.15', 2, '23'),
(176, 76, 23, 1, '0.15', 1, '41'),
(177, 76, 31, 1, '0.15', 1, '23'),
(178, 77, 31, 1, '0.15', 2, '23'),
(179, 77, 23, 1, '0.15', 3, '41'),
(180, 78, 34, 1, '0.15', 1, '24'),
(181, 78, 23, 1, '0.15', 2, '30'),
(182, 79, 35, 1, '0.15', 2, '70'),
(183, 79, 30, 1, '0.15', 2, '23'),
(184, 80, 30, 1, '0.15', 3, '23'),
(185, 80, 23, 1, '0.15', 1, '41'),
(186, 81, 22, 1, '0.15', 5, '32'),
(187, 81, 29, 1, '0.15', 3, '23'),
(188, 82, 22, 1, '0.15', 1, '32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_temp`
--

DROP TABLE IF EXISTS `tbl_detalle_temp`;
CREATE TABLE IF NOT EXISTS `tbl_detalle_temp` (
  `id_detalle_temp` bigint NOT NULL AUTO_INCREMENT,
  `Id_Cliente` bigint NOT NULL,
  `Id_Producto` bigint NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id_detalle_temp`),
  KEY `Id_Cliente` (`Id_Cliente`),
  KEY `Id_Producto` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_detalle_temp`
--

INSERT INTO `tbl_detalle_temp` (`id_detalle_temp`, `Id_Cliente`, `Id_Producto`, `cantidad`) VALUES
(1, 1, 3, 7),
(2, 1, 2, 3),
(3, 1, 2, 3),
(4, 0, 2, 2),
(5, 2, 2, 2),
(6, 2, 3, 2),
(7, 2, 4, 4),
(8, 2, 4, 4),
(9, 4, 3, 2),
(10, 0, 2, 4),
(11, 2, 2, 4),
(12, 0, 3, 8),
(13, 4, 3, 8),
(14, 2, 3, 4),
(15, 0, 2, 2),
(16, 3, 2, 2),
(17, 3, 2, 3),
(18, 3, 2, 3),
(19, 3, 3, 3),
(20, 3, 3, 3),
(21, 3, 4, 3),
(22, 3, 2, 4),
(23, 3, 5, 4),
(24, 3, 5, 3),
(25, 3, 2, 3),
(26, 1, 2, 3),
(27, 3, 3, 5),
(28, 3, 2, 18),
(29, 0, 4, 14),
(30, 3, 4, 14),
(31, 3, 5, 15),
(32, 3, 3, 1),
(33, 3, 4, 5),
(34, 3, 5, 25),
(35, 1, 3, 1),
(36, 1, 3, 5),
(37, 3, 3, 4),
(38, 3, 3, 9),
(39, 3, 3, 1),
(40, 3, 3, 1),
(41, 3, 2, 3),
(42, 3, 2, 11),
(43, 3, 2, 11),
(44, 3, 3, 1),
(45, 3, 2, 12),
(46, 3, 2, 13),
(47, 3, 3, 4),
(48, 3, 3, 12),
(49, 3, 2, 1),
(50, 3, 3, 3),
(51, 3, 3, 7),
(52, 3, 2, 5),
(53, 3, 3, 4),
(54, 2, 2, 3),
(55, 2, 2, 25),
(56, 2, 2, 4),
(57, 0, 0, 3),
(58, 0, 0, 3),
(59, 0, 0, 3),
(60, 0, 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estados_pedidos`
--

DROP TABLE IF EXISTS `tbl_estados_pedidos`;
CREATE TABLE IF NOT EXISTS `tbl_estados_pedidos` (
  `Id_Estado_Pedido` bigint NOT NULL AUTO_INCREMENT,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Estado_Pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_estados_pedidos`
--

INSERT INTO `tbl_estados_pedidos` (`Id_Estado_Pedido`, `Estado`, `Descripcion`) VALUES
(1, 'Completado', ''),
(2, 'Pendiente', ''),
(3, 'Cancelado', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estados_promociones`
--

DROP TABLE IF EXISTS `tbl_estados_promociones`;
CREATE TABLE IF NOT EXISTS `tbl_estados_promociones` (
  `Id_Estado|_Promocion` bigint NOT NULL AUTO_INCREMENT,
  `Id_Promociones` bigint NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Estado|_Promocion`),
  KEY `Id_Promociones` (`Id_Promociones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estados_usuarios`
--

DROP TABLE IF EXISTS `tbl_estados_usuarios`;
CREATE TABLE IF NOT EXISTS `tbl_estados_usuarios` (
  `id_estado_usuario` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_estado` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  PRIMARY KEY (`id_estado_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_estados_usuarios`
--

INSERT INTO `tbl_estados_usuarios` (`id_estado_usuario`, `Nombre_estado`, `Fecha_Creacion`) VALUES
(1, 'ACTIVO', '2022-10-06'),
(2, 'INACTIVO', '2022-10-13'),
(3, 'NUEVO', '0000-00-00'),
(4, 'BLOQUEADO', '2022-10-23'),
(5, 'ELIMINADO', '2022-10-24'),
(6, 'Default', '2022-11-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_forma_pago`
--

DROP TABLE IF EXISTS `tbl_forma_pago`;
CREATE TABLE IF NOT EXISTS `tbl_forma_pago` (
  `Id_Forma_Pago` bigint NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Forma_Pago`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_forma_pago`
--

INSERT INTO `tbl_forma_pago` (`Id_Forma_Pago`, `Nombre`, `Descripcion`) VALUES
(1, 'Tarjeta de credito', 'Pago con tarjeta al recibir productos'),
(2, 'Efectivo', 'Pago en efectivo al momento de recibir productos'),
(3, 'Transferencia bancaria', 'Pago a cuenta bancaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_impuestos`
--

DROP TABLE IF EXISTS `tbl_impuestos`;
CREATE TABLE IF NOT EXISTS `tbl_impuestos` (
  `Id_ISV` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_ISV` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Porcentaje_ISV` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_ISV`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_impuestos`
--

INSERT INTO `tbl_impuestos` (`Id_ISV`, `Nombre_ISV`, `Porcentaje_ISV`) VALUES
(1, 'ISV normal', '0.15'),
(2, 'ISV Bebidas', '0.18'),
(3, 'ISV Exento', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_bitacora`
--

DROP TABLE IF EXISTS `tbl_ms_bitacora`;
CREATE TABLE IF NOT EXISTS `tbl_ms_bitacora` (
  `Id_Bitacora` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Id_Objeto` bigint NOT NULL,
  `Accion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`Id_Bitacora`),
  KEY `Id_Usuario` (`Id_Usuario`),
  KEY `Id_Objeto` (`Id_Objeto`)
) ENGINE=InnoDB AUTO_INCREMENT=500 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_bitacora`
--

INSERT INTO `tbl_ms_bitacora` (`Id_Bitacora`, `Id_Usuario`, `Id_Objeto`, `Accion`, `Descripcion`, `Fecha`) VALUES
(36, 3, 1, 'Cambio de contraseña', 'Se cambio la contraseña de primer acceso al sistema', '2022-11-02'),
(37, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(38, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(39, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(40, 1, 1, 'Cambio de contraseña', 'Se cambio la contraseña de primer acceso al sistema', '2022-11-02'),
(41, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(42, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(43, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(44, 3, 1, 'Se envio correo', 'Se envío correo a josemanuelduronllanes@gmail.com', '2022-11-02'),
(45, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(46, 3, 1, 'Cambio de contraseña', 'Se cambio la contraseña josemanuelduronllanes@gmail.com', '2022-11-02'),
(47, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(48, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-02'),
(49, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-02'),
(50, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-02'),
(51, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(52, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(53, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(54, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(55, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-02'),
(56, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-02'),
(57, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(58, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-02'),
(59, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(60, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(61, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(62, 3, 1, 'Se envio correo', 'Se envío correo a josemanuelduronllanes@gmail.com', '2022-11-02'),
(63, 3, 1, 'Cambio de contraseña', 'Se cambio la contraseña josemanuelduronllanes@gmail.com', '2022-11-02'),
(64, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(65, 3, 1, 'Cambio de contraseña', 'Se cambio la contraseña ', '2022-11-02'),
(66, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(67, 5, 1, 'Cambio de contraseña', 'Se cambio la contraseña de primer acceso al sistema', '2022-11-02'),
(68, 5, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(69, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(70, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(71, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(72, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-02'),
(73, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-03'),
(74, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(75, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-03'),
(76, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(77, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-03'),
(78, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-03'),
(79, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(80, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-03'),
(81, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(82, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-03'),
(83, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(84, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-03'),
(85, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(86, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(87, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(88, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(89, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-03'),
(90, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(91, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(92, 3, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-03'),
(93, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(94, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(98, 9, 2, 'Agregar usuario', 'Se agrego el nuevo usuario marlon4@gmail.com al sistema', '2022-11-03'),
(99, 9, 2, 'Actualizar usuario', 'Se actualizo el  usuario marlon4@gmail.com', '2022-11-03'),
(100, 9, 2, 'Eliminar usuario', 'Se elimino el  usuario con id 49', '2022-11-03'),
(101, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(102, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(103, 10, 2, 'Auto registro usuario', 'Se auto registro el  usuario lopez12@gmail.com al sistema', '2022-11-03'),
(104, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(105, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(106, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(107, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(108, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(109, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(110, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(111, 11, 2, 'Agregar usuario', 'Se agrego el nuevo usuario cheyla444@gmail.com al sistema', '2022-11-03'),
(112, 12, 2, 'Agregar usuario', 'Se agrego el nuevo usuario jose2023.@gmail.com al sistema', '2022-11-03'),
(113, 13, 2, 'Agregar usuario', 'Se agrego el nuevo usuario luisa2022.@gmail.com al sistema', '2022-11-03'),
(114, 7, 2, 'Actualizar usuario', 'Se actualizo el  usuario luis12342@gmail.com', '2022-11-03'),
(115, 6, 2, 'Actualizar usuario', 'Se actualizo el  usuario luis1234@gmail.com', '2022-11-03'),
(116, 11, 2, 'Actualizar usuario', 'Se actualizo el  usuario cheyla444@gmail.com', '2022-11-03'),
(117, 14, 2, 'Agregar usuario', 'Se agrego el nuevo usuario prueba2@gmail.com al sistema', '2022-11-03'),
(118, 14, 1, 'Cambio de contraseña', 'Se cambio la contraseña de primer acceso al sistema', '2022-11-03'),
(119, 14, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(120, 14, 2, 'Actualizar usuario', 'Se actualizo el  usuario prueba2@gmail.com', '2022-11-03'),
(121, 15, 2, 'Agregar usuario', 'Se agrego el nuevo usuario elena@gmail.com al sistema', '2022-11-03'),
(122, 3, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(123, 14, 2, 'Actualizar usuario', 'Se actualizo el  usuario prueba2@gmail.com', '2022-11-03'),
(124, 3, 1, 'Se envio correo', 'Se envío correo a josemanuelduronllanes@gmail.com', '2022-11-03'),
(125, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(126, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(127, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(128, 16, 2, 'Agregar usuario', 'Se agrego el nuevo usuario heybel1lemus@gmail.com al sistema', '2022-11-03'),
(129, 3, 2, 'Actualizar usuario', 'Se actualizo el  usuario josemanuelduronllanes2@gmail.com', '2022-11-03'),
(130, 17, 2, 'Agregar usuario', 'Se agrego el nuevo usuario josemanuelduronllanes@gmail.com al sistema', '2022-11-03'),
(131, 3, 2, 'Actualizar usuario', 'Se actualizo el  usuario josemanuelduronllanes25@gmail.com', '2022-11-03'),
(132, 3, 2, 'Actualizar usuario', 'Se actualizo el  usuario josemanuelduronllanes25@gmail.com', '2022-11-03'),
(133, 16, 2, 'Eliminar usuario', 'Se elimino el  usuario con id 16', '2022-11-03'),
(134, 17, 1, 'Cambio de contraseña', 'Se cambio la contraseña de primer acceso al sistema', '2022-11-03'),
(135, 17, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(136, 17, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(137, 17, 1, 'Bloqueo usuario', 'Se bloqueo al usuario josemanuelduronllanes@gmail.com Por intentos erroneos', '2022-11-03'),
(138, 17, 1, 'Cambio de contraseña', 'Se cambio la contraseña ', '2022-11-03'),
(139, 17, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(140, 17, 1, 'Se envio correo', 'Se envío correo a josemanuelduronllanes@gmail.com', '2022-11-03'),
(141, 17, 1, 'Cambio de contraseña', 'Se cambio la contraseña josemanuelduronllanes@gmail.com', '2022-11-03'),
(142, 17, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-03'),
(146, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-04'),
(147, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-05'),
(148, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-08'),
(150, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-08'),
(151, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-08'),
(153, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-08'),
(155, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-08'),
(156, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-08'),
(159, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-09'),
(161, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-09'),
(162, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-09'),
(163, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-09'),
(164, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-09'),
(167, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-09'),
(168, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2022-11-09'),
(169, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2022-11-09'),
(170, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2022-11-09'),
(171, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2022-11-09'),
(172, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2022-11-09'),
(176, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-09'),
(177, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-11'),
(178, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-13'),
(179, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-13'),
(181, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-14'),
(182, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-14'),
(183, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-14'),
(184, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-14'),
(190, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-18'),
(191, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-18'),
(192, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-19'),
(193, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-19'),
(197, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-19'),
(198, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-20'),
(199, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-20'),
(200, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-21'),
(201, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-21'),
(202, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-21'),
(203, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-21'),
(204, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(205, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(206, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(207, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(209, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(211, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(214, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(215, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(223, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(226, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(227, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(228, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(229, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(234, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(237, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(238, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-22'),
(241, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-23'),
(243, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-23'),
(244, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(246, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(248, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(249, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(250, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(251, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(256, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(259, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(261, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(262, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(263, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(264, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-24'),
(266, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-25'),
(267, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-25'),
(275, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-26'),
(276, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-26'),
(277, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-26'),
(281, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-26'),
(282, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-26'),
(283, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-26'),
(285, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-27'),
(286, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-27'),
(288, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-27'),
(289, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-28'),
(291, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-28'),
(293, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-28'),
(294, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-28'),
(296, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-28'),
(297, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-29'),
(300, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-29'),
(301, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-29'),
(304, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-29'),
(306, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-29'),
(308, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-29'),
(310, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-29'),
(312, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-29'),
(315, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-29'),
(316, 3, 2, 'Actualizar usuario', 'Se actualizo el  usuario josemanuelduronllanes25@gmail.com', '2022-11-30'),
(317, 12, 2, 'Actualizar usuario', 'Se actualizo el  usuario jose20a23.@gmail.com', '2022-11-30'),
(318, 17, 2, 'Eliminar usuario', 'Se elimino el  usuario con id 17', '2022-11-30'),
(320, 3, 2, 'Actualizar usuario', 'Se actualizo el  usuario josemanuelduronllanes25@gmail.com', '2022-11-30'),
(321, 3, 2, 'Actualizar usuario', 'Se actualizo el  usuario josemanuelduronllanes25@gmail.com', '2022-11-30'),
(322, 3, 2, 'Actualizar usuario', 'Se actualizo el  usuario josemanuel2duronllanes25@gmail.com', '2022-11-30'),
(323, 1, 2, 'Actualizar usuario', 'Se actualizo el  usuario root@gmail.com', '2022-11-30'),
(324, 6, 2, 'Actualizar usuario', 'Se actualizo el  usuario luis1234@gmail.com', '2022-11-30'),
(325, 6, 2, 'Actualizar usuario', 'Se actualizo el  usuario luis1234@gmail.com', '2022-11-30'),
(326, 7, 2, 'Actualizar usuario', 'Se actualizo el  usuario luis12342@gmail.com', '2022-11-30'),
(327, 10, 2, 'Actualizar usuario', 'Se actualizo el  usuario lopez12@gmail.com', '2022-11-30'),
(329, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-30'),
(331, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-30'),
(333, 4, 2, 'Actualizar usuario', 'Se actualizo el  usuario camilavillalta25@gmail.com', '2022-11-30'),
(334, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2022-11-30'),
(335, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-30'),
(336, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-30'),
(337, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-30'),
(340, 1, 2, 'Actualizar usuario', 'Se actualizo el  usuario root@gmail.com', '2022-11-30'),
(341, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-30'),
(342, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-30'),
(343, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-11-30'),
(345, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-01'),
(346, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-01'),
(347, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-01'),
(349, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-01'),
(350, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-02'),
(356, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-03'),
(357, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-03'),
(359, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-03'),
(360, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-03'),
(361, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-03'),
(362, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-04'),
(363, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-04'),
(364, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-04'),
(365, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-04'),
(366, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-04'),
(367, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-04'),
(368, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-04'),
(369, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-05'),
(372, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-05'),
(374, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-05'),
(376, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-05'),
(378, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-05'),
(380, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-05'),
(382, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-05'),
(384, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-05'),
(385, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-05'),
(387, 20, 2, 'Autoregistro usuario', 'Se autoregistro el  usuario prueba1234@gmail.com al sistema', '2022-12-07'),
(388, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-07'),
(389, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-07'),
(390, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-08'),
(391, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-08'),
(392, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-09'),
(394, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-09'),
(395, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-09'),
(399, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-09'),
(402, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-09'),
(403, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-09'),
(404, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-10'),
(405, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2022-12-10'),
(406, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-01-16'),
(407, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-01-16'),
(408, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-01-17'),
(411, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-01-27'),
(412, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-01-27'),
(414, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-01-27'),
(418, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-01'),
(419, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-01'),
(420, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-01'),
(421, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-01'),
(422, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-01'),
(423, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-01'),
(424, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-01'),
(425, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(426, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(427, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(428, 22, 2, 'Autoregistro usuario', 'Se autoregistro el  usuario delidulcespr@gmail.com al sistema', '2023-02-19'),
(429, 22, 1, 'Cambio de contraseña', 'Se cambio la contraseña de primer acceso al sistema', '2023-02-19'),
(430, 22, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(431, 22, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(432, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(433, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(434, 1, 2, 'Actualizar usuario', 'Se actualizo el  usuario root@gmail.com', '2023-02-19'),
(435, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(436, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(437, 6, 2, 'Actualizar usuario', 'Se actualizo el  usuario luis1234@gmail.com', '2023-02-19'),
(438, 11, 2, 'Actualizar usuario', 'Se actualizo el  usuario cheyla444@gmail.com', '2023-02-19'),
(439, 11, 2, 'Actualizar usuario', 'Se actualizo el  usuario cheyla444@gmail.com', '2023-02-19'),
(440, 11, 2, 'Actualizar usuario', 'Se actualizo el  usuario cheyla444@gmail.com', '2023-02-19'),
(441, 11, 2, 'Actualizar usuario', 'Se actualizo el  usuario cheyla444@gmail.com', '2023-02-19'),
(442, 1, 2, 'Actualizar usuario', 'Se actualizo el  usuario root@gmail.com', '2023-02-19'),
(443, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(444, 7, 2, 'Actualizar usuario', 'Se actualizo el  usuario luis12342@gmail.com', '2023-02-19'),
(445, 8, 2, 'Actualizar usuario', 'Se actualizo el  usuario gorge14@gmail.com', '2023-02-19'),
(446, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(447, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(448, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(449, 22, 2, 'Actualizar usuario', 'Se actualizo el  usuario delidulcespr@gmail.com', '2023-02-19'),
(450, 22, 2, 'Actualizar usuario', 'Se actualizo el  usuario delidulcespr@gmail.com', '2023-02-19'),
(451, 1, 2, 'Actualizar usuario', 'Se actualizo el  usuario root@gmail.com', '2023-02-19'),
(452, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(453, 1, 2, 'Actualizar usuario', 'Se actualizo el  usuario root@gmail.com', '2023-02-19'),
(454, 23, 2, 'Autoregistro usuario', 'Se autoregistro el  usuario josemanuelduronllanes233@gmail.com al sistema', '2023-02-19'),
(455, 23, 1, 'Cambio de contraseña', 'Se cambio la contraseña de primer acceso al sistema', '2023-02-19'),
(456, 23, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(457, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(458, 1, 2, 'Actualizar usuario', 'Se actualizo el  usuario root@gmail.com', '2023-02-19'),
(459, 23, 1, 'Cambio de contraseña', 'Se cambio la contraseña ', '2023-02-19'),
(460, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(461, 1, 2, 'Actualizar usuario', 'Se actualizo el  usuario root@gmail.com', '2023-02-19'),
(462, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(463, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(464, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(465, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(466, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(467, 3, 2, 'Actualizar usuario', 'Se actualizo el  usuario josemanuel2duronllanes25@gmail.com', '2023-02-19'),
(468, 3, 2, 'Actualizar usuario', 'Se actualizo el  usuario josemanuel2duronllanes25@gmail.com', '2023-02-19'),
(469, 4, 2, 'Actualizar usuario', 'Se actualizo el  usuario camilavillalta25@gmail.com', '2023-02-19'),
(470, 6, 2, 'Actualizar usuario', 'Se actualizo el  usuario luis1234@gmail.com', '2023-02-19'),
(471, 22, 2, 'Actualizar usuario', 'Se actualizo el  usuario delidulcespr@gmail.com', '2023-02-19'),
(472, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(473, 4, 2, 'Actualizar usuario', 'Se actualizo el  usuario camilavillalta25@gmail.com', '2023-02-19'),
(474, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(475, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(476, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-02-19'),
(477, 22, 1, 'Cambio de contraseña', 'Se cambio la contraseña ', '2023-02-19'),
(478, 23, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(479, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-19'),
(480, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-21'),
(481, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-02-23'),
(482, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-03-13'),
(483, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-03-13'),
(484, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-03-13'),
(485, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-03-13'),
(486, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-03-13'),
(487, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-03-13'),
(488, 2, 2, 'Actualizar usuario', 'Se actualizo el  usuario ana2024@gmail.com', '2023-03-13'),
(489, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-03-13'),
(490, 1, 1, 'Se envio correo', 'Se envío correo a mauriciovargastm@gmail.com', '2023-03-13'),
(491, 1, 1, 'Se envio correo', 'Se envío correo a mauriciovargastm@gmail.com', '2023-03-13'),
(492, 1, 1, 'Se envio correo', 'Se envío correo a mauriciovargastm@gmail.com', '2023-03-13'),
(493, 1, 1, 'Se envio correo', 'Se envío correo a mauriciovargastm@gmail.com', '2023-03-13'),
(494, 1, 1, 'Se envio correo', 'Se envío correo a mauriciovargastm@gmail.com', '2023-03-13'),
(495, 1, 1, 'Se envio correo', 'Se envío correo a mauriciovargastm@gmail.com', '2023-03-13'),
(496, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-03-13'),
(497, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-03-13'),
(498, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-03-13'),
(499, 1, 1, 'Acceso al sistema', 'Accedio correctamente al sistema', '2023-03-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_historico_contrasena`
--

DROP TABLE IF EXISTS `tbl_ms_historico_contrasena`;
CREATE TABLE IF NOT EXISTS `tbl_ms_historico_contrasena` (
  `Id_Historico` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Contrasena` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Historico`),
  KEY `Id_Usuario` (`Id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_historico_contrasena`
--

INSERT INTO `tbl_ms_historico_contrasena` (`Id_Historico`, `Id_Usuario`, `Contrasena`, `Creado_Por`, `Fecha_creacion`, `Modificado_Por`, `Fecha_Modificado`) VALUES
(14, 3, '2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69', '', '0000-00-00', '', '0000-00-00'),
(15, 1, 'e74b7ad5a996d7b83a77beff2d34d29a1d195190e295d5ddea600069492a8fa7', '', '0000-00-00', '', '0000-00-00'),
(16, 3, '405271d3c779fff92b20873b39d49a96da9577954dd56da78253c99c58e65c1d', '', '0000-00-00', '', '0000-00-00'),
(17, 3, 'e528c2128d9c09d05633fc7cccc2302961ff9307b0d7c170d2c9d0a01ecfa546', '', '0000-00-00', '', '0000-00-00'),
(18, 3, '2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69', '', '0000-00-00', '', '0000-00-00'),
(19, 5, 'bde2727537bd634d5a41259a21d5c6b045880b83183246cfec7a26a7b13e081c', '', '0000-00-00', '', '0000-00-00'),
(20, 14, '2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69', '', '0000-00-00', '', '0000-00-00'),
(21, 17, '46c7eb77663ed290e3bd24fddbfc3f437865e3b4528e216a8577954cbe50acab', '', '0000-00-00', '', '0000-00-00'),
(22, 17, '6317b7b0c781721e3ed9245d385879bf2e525539c136c458633b633ae4453390', '', '0000-00-00', '', '0000-00-00'),
(23, 17, '782f5cfe1cc7109d7b9b0280a364deff8ac734d275768444e91d16c0f19a6f5c', '', '0000-00-00', '', '0000-00-00'),
(26, 22, '46c7eb77663ed290e3bd24fddbfc3f437865e3b4528e216a8577954cbe50acab', '', '0000-00-00', '', '0000-00-00'),
(27, 23, 'e74b7ad5a996d7b83a77beff2d34d29a1d195190e295d5ddea600069492a8fa7', '', '0000-00-00', '', '0000-00-00'),
(28, 23, '770d6ecc395cae0da1024fe5e0ab57584fb54335ba23835ef078b84659befb2c', '', '0000-00-00', '', '0000-00-00'),
(29, 22, 'c3f953e9b8e7e2ed8aa613103d162223e75fcfe69459899490f6368d90b55b1e', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_objetos`
--

DROP TABLE IF EXISTS `tbl_ms_objetos`;
CREATE TABLE IF NOT EXISTS `tbl_ms_objetos` (
  `Id_Objeto` bigint NOT NULL AUTO_INCREMENT,
  `Id_Rol` bigint NOT NULL,
  `Nombre_Objeto` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Tipo_Objeto` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Objeto`),
  KEY `Id_Rol` (`Id_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_objetos`
--

INSERT INTO `tbl_ms_objetos` (`Id_Objeto`, `Id_Rol`, `Nombre_Objeto`, `Descripcion`, `Tipo_Objeto`, `Creado_Por`, `Fecha_Creacion`, `Modificado_Por`, `Fecha_Modificado`) VALUES
(1, 2, 'PARAMETROS', 'Modulo de parametros', 'Modulo', 'Jose Llanes', '2022-10-20', '', '0000-00-00'),
(2, 2, 'USUARIOS', 'Modulo de mantenimiento usuarios', 'Modulo', '', '0000-00-00', '', '0000-00-00'),
(3, 2, 'CLIENTES', 'Modulo de mantenimiento clientes', 'modulo', 'Administrador', '2022-11-17', '', '0000-00-00'),
(4, 2, 'PRODUCTOS', 'Modulo de mantenimiento productos', 'modulo', '', '0000-00-00', '', '0000-00-00'),
(5, 2, 'CATEGORIA PRODUCTOS', 'Modulo de mantenimiento productos', 'Modulo', '', '0000-00-00', '', '0000-00-00'),
(20, 1, 'BACKUP', 'Modulo backup', '', '', '0000-00-00', '', '0000-00-00'),
(21, 1, 'RESTORE', 'restaurar bd', '', '', '0000-00-00', '', '0000-00-00'),
(22, 1, 'BITACORA', 'bitacora M', '', '', '0000-00-00', '', '0000-00-00'),
(23, 1, 'PREGUNTAS SEGURIDAD', 'Modulo de preguntas', '', '', '0000-00-00', '', '0000-00-00'),
(24, 1, 'ROLES', 'modulo de roles', '', '', '0000-00-00', '', '0000-00-00'),
(25, 1, 'PEDIDOS', 'Modulo pedidos', '', '', '0000-00-00', '', '0000-00-00'),
(26, 1, 'PROMOCIONES', 'Mpromociones', '', '', '0000-00-00', '', '0000-00-00'),
(29, 1, 'DESCUENTOS', 'Modulo de mantenimiento descuentos', '', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_parametros`
--

DROP TABLE IF EXISTS `tbl_ms_parametros`;
CREATE TABLE IF NOT EXISTS `tbl_ms_parametros` (
  `Id_Parametro` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_Parametro` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Valor_Parametro` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Parametro`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_parametros`
--

INSERT INTO `tbl_ms_parametros` (`Id_Parametro`, `Nombre_Parametro`, `Valor_Parametro`, `Descripcion`, `Creado_Por`, `Fecha_Creacion`, `Modificado_Por`, `Fecha_Modificado`) VALUES
(1, 'PRUEBA', '10', 'Numero de intentos de acceso al sistema', 'Administrador', '2022-10-15', '', '0000-00-00'),
(2, 'NUM_PREGUNTAS_SECRETAS', '1', 'Cantidad de preguntas secretas', 'Jose Llanes', '2022-10-16', '', '0000-00-00'),
(3, 'NUM_DIAS_VENCIMIENTO', '365', 'Cantidad de dias de vencimiento de usuarios', 'Ana', '2022-10-20', '', '0000-00-00'),
(4, 'DIAS_VENCIMIENTO_TOKEN', '5', 'Numero de dias vencimiento de token de correo electronico', '', '2022-10-20', '', '0000-00-00'),
(14, 'PARAMETROS', '23', 'aaa', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_permisos`
--

DROP TABLE IF EXISTS `tbl_ms_permisos`;
CREATE TABLE IF NOT EXISTS `tbl_ms_permisos` (
  `Id_Permiso` bigint NOT NULL AUTO_INCREMENT,
  `Id_Rol` bigint NOT NULL,
  `Id_Objeto` bigint NOT NULL,
  `Permiso_Get` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Permiso_Insert` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Permiso_Update` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Permiso_Delete` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creado` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`Id_Permiso`),
  KEY `Id_Rol` (`Id_Rol`),
  KEY `Id_Objeto` (`Id_Objeto`)
) ENGINE=InnoDB AUTO_INCREMENT=991 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_permisos`
--

INSERT INTO `tbl_ms_permisos` (`Id_Permiso`, `Id_Rol`, `Id_Objeto`, `Permiso_Get`, `Permiso_Insert`, `Permiso_Update`, `Permiso_Delete`, `Creado_por`, `Fecha_Creado`, `Modificado_Por`, `Fecha_Modificacion`) VALUES
(179, 3, 1, '0', '0', '0', '1', '', '0000-00-00', '', '0000-00-00'),
(180, 3, 2, '1', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(181, 3, 3, '1', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(182, 3, 4, '1', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(183, 3, 5, '1', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(191, 5, 1, '1', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(192, 5, 2, '1', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(193, 5, 3, '1', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(194, 5, 4, '1', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(195, 5, 5, '1', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(275, 2, 1, '1', '0', '1', '0', '', '0000-00-00', '', '0000-00-00'),
(276, 2, 2, '1', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(277, 2, 3, '1', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(278, 2, 4, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(279, 2, 5, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(345, 2, 20, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(346, 3, 20, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(348, 5, 20, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(350, 2, 21, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(351, 3, 21, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(353, 5, 21, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(356, 2, 22, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(357, 3, 22, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(359, 5, 22, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(362, 2, 23, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(363, 3, 23, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(365, 5, 23, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(404, 2, 24, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(405, 3, 24, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(407, 5, 24, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(603, 2, 25, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(604, 3, 25, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(606, 5, 25, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(629, 2, 26, '0', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(630, 3, 26, '0', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(632, 5, 26, '0', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(750, 4, 1, '0', '1', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(751, 4, 2, '0', '1', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(752, 4, 3, '0', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(753, 4, 4, '0', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(754, 4, 5, '0', '0', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(755, 4, 20, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(756, 4, 21, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(757, 4, 22, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(758, 4, 23, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(759, 4, 24, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(760, 4, 25, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(761, 4, 26, '0', '1', '0', '0', '', '0000-00-00', '', '0000-00-00'),
(978, 1, 1, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(979, 1, 2, '1', '1', '1', '0', '', '0000-00-00', '', '0000-00-00'),
(980, 1, 3, '1', '1', '1', '0', '', '0000-00-00', '', '0000-00-00'),
(981, 1, 4, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(982, 1, 5, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(983, 1, 20, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(984, 1, 21, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(985, 1, 22, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(986, 1, 23, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(987, 1, 24, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(988, 1, 25, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(989, 1, 26, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00'),
(990, 1, 29, '1', '1', '1', '1', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_preguntas`
--

DROP TABLE IF EXISTS `tbl_ms_preguntas`;
CREATE TABLE IF NOT EXISTS `tbl_ms_preguntas` (
  `Id_Pregunta` bigint NOT NULL AUTO_INCREMENT,
  `Pregunta` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`Id_Pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_preguntas`
--

INSERT INTO `tbl_ms_preguntas` (`Id_Pregunta`, `Pregunta`, `Creado_por`, `Fecha_Creacion`, `Modificado_Por`, `Fecha_Modificacion`) VALUES
(1, '¿Jugador de Futbol favorito?', 'Jose Llanes', '2022-10-13', '', '0000-00-00'),
(2, '¿Canción Favorita?', 'Jose Llanes', '2022-10-08', '', '0000-00-00'),
(4, '¿Nombre de la pelicula favorita?', '', '0000-00-00', '', '0000-00-00'),
(5, '¿Libro favorito?', 'Jose Llanes', '2022-10-31', '', '0000-00-00'),
(6, '¿Amigo favorito?', 'Jose Llanes', '2022-10-01', '', '0000-00-00'),
(7, '¿Cumpleaños de mi mama?', 'Jose Llanes', '2022-10-31', '', '0000-00-00'),
(8, '¿Primer trabajo?', '', '0000-00-00', '', '0000-00-00'),
(10, '¿Cumpleaños de mi mascota?', 'Jose Llanes', '2022-10-31', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_preguntas_usuario`
--

DROP TABLE IF EXISTS `tbl_ms_preguntas_usuario`;
CREATE TABLE IF NOT EXISTS `tbl_ms_preguntas_usuario` (
  `Id_Pregunta_Usuario` bigint NOT NULL AUTO_INCREMENT,
  `id_pregunta` bigint NOT NULL,
  `Id_Usuario` bigint NOT NULL,
  `Respuesta` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Pregunta_Usuario`),
  KEY `Id_Usuario` (`Id_Usuario`),
  KEY `id_pregunta` (`id_pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_preguntas_usuario`
--

INSERT INTO `tbl_ms_preguntas_usuario` (`Id_Pregunta_Usuario`, `id_pregunta`, `Id_Usuario`, `Respuesta`, `Creado_Por`, `Fecha_Creacion`, `Modificado_Por`, `Fecha_Modificado`) VALUES
(1, 1, 3, 'CR7', '', '0000-00-00', '', '0000-00-00'),
(2, 2, 3, 'La cancion', '', '0000-00-00', '', '0000-00-00'),
(3, 6, 3, 'mi perro', '', '0000-00-00', '', '0000-00-00'),
(4, 5, 1, 'startlink', '', '0000-00-00', '', '0000-00-00'),
(5, 5, 1, 'startlink', '', '0000-00-00', '', '0000-00-00'),
(6, 5, 1, 'startlink', '', '0000-00-00', '', '0000-00-00'),
(8, 6, 5, 'dog', '', '0000-00-00', '', '0000-00-00'),
(9, 10, 5, '26 de junio', '', '0000-00-00', '', '0000-00-00'),
(10, 5, 14, 'Harry potter', '', '0000-00-00', '', '0000-00-00'),
(11, 6, 14, 'scot', '', '0000-00-00', '', '0000-00-00'),
(13, 7, 17, '27 de junio', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_rol`
--

DROP TABLE IF EXISTS `tbl_ms_rol`;
CREATE TABLE IF NOT EXISTS `tbl_ms_rol` (
  `Id_Rol` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_Rol` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion_Rol` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `estado_rol` int NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_rol`
--

INSERT INTO `tbl_ms_rol` (`Id_Rol`, `Nombre_Rol`, `Descripcion_Rol`, `estado_rol`, `Creado_Por`, `Fecha_creacion`, `Modificado_Por`, `Fecha_Modificado`) VALUES
(1, 'Programadores', 'Programadores', 1, '', '2022-10-06', '', '0000-00-00'),
(2, 'Administradores', 'Rol para los administradores', 1, '', '0000-00-00', '', '0000-00-00'),
(3, 'Vendedor', 'Rol para los vendedores', 1, '', '0000-00-00', '', '0000-00-00'),
(4, 'Default', 'Rol para usuarios default', 1, '', '2022-11-01', '', '0000-00-00'),
(5, 'Supervisores', 'Rol para los supervisores', 2, '', '0000-00-00', '', '0000-00-00'),
(6, 'RRHH', 'Rol de recursos humanos', 1, '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_sesiones`
--

DROP TABLE IF EXISTS `tbl_ms_sesiones`;
CREATE TABLE IF NOT EXISTS `tbl_ms_sesiones` (
  `Id_Sesion` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Ip_address` decimal(10,0) NOT NULL,
  `Ultima_Sesion` date NOT NULL,
  PRIMARY KEY (`Id_Sesion`),
  KEY `Id_Usuario` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_usuarios`
--

DROP TABLE IF EXISTS `tbl_ms_usuarios`;
CREATE TABLE IF NOT EXISTS `tbl_ms_usuarios` (
  `id_usuario` bigint NOT NULL AUTO_INCREMENT,
  `Id_Rol` bigint NOT NULL,
  `id_estado_usuario` bigint NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Contrasena` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Primer_Ingreso` int NOT NULL,
  `Telefono` int NOT NULL,
  `Direccion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Num_Identidad` int NOT NULL,
  `Correo_Electronico` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Ult_Conexion` date NOT NULL,
  `Fecha_Vencimiento` date NOT NULL,
  `Preguntas_Contestadas` int NOT NULL,
  `intentos_acceso` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `Id_Rol` (`Id_Rol`),
  KEY `id_estado_usuario` (`id_estado_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_usuarios`
--

INSERT INTO `tbl_ms_usuarios` (`id_usuario`, `Id_Rol`, `id_estado_usuario`, `Nombre`, `Contrasena`, `Primer_Ingreso`, `Telefono`, `Direccion`, `Num_Identidad`, `Correo_Electronico`, `Fecha_Ult_Conexion`, `Fecha_Vencimiento`, `Preguntas_Contestadas`, `intentos_acceso`) VALUES
(1, 1, 1, 'ROOT', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 0, 995481, 'AVENIDA 74', 0, 'mauriciovargastm@gmail.com', '0000-00-00', '2025-01-31', 0, 0),
(2, 1, 6, 'ANA', '75c54a72945e00a69b13367df132e86f950df2cbe152807fcedf63c0a4a01730', 0, 9465981, 'ALDEA DE SUYAPA', 0, 'ana2024@gmail.com', '0000-00-00', '2025-01-31', 0, 8),
(3, 1, 2, 'INFORMAFGSAGASG', '2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69', 0, 94999, 'UNAHAAAAAA', 0, 'josemanuel2duronllanes25@gmail.com', '0000-00-00', '2023-01-31', 0, 0),
(4, 2, 3, 'CAMILA', '9d168b61f0d8191eea0182482316e430a85f50782d959c440af6334a6c59d9d1', 0, 94591, 'ALDEA DE SUYAPA', 0, 'camilavillalta25@gmail.com', '0000-00-00', '2023-01-31', 0, 0),
(5, 1, 5, 'ANGIE', 'bde2727537bd634d5a41259a21d5c6b045880b83183246cfec7a26a7b13e081c', 0, 94659841, 'LA TRAVESIA', 0, 'estherva2000@gmail.com', '0000-00-00', '2023-01-31', 0, 0),
(6, 1, 4, 'LUIS GARCIA', '44da6d3819c4d2cfbdac32fa3586bcb2fd5407719e09eca1af199a071ec21213', 0, 94659981, 'LA TRAVESIA', 0, 'luis1234@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(7, 1, 1, 'LUIS GARCIA', '44da6d3819c4d2cfbdac32fa3586bcb2fd5407719e09eca1af199a071ec21213', 0, 94659981, 'LA TRAVESIA', 0, 'luis12342@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(8, 1, 1, 'GORGE', '44da6d3819c4d2cfbdac32fa3586bcb2fd5407719e09eca1af199a071ec21213', 0, 94659981, 'LA TRAVESIA', 0, 'gorge14@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(9, 1, 5, 'MARLON', '44da6d3819c4d2cfbdac32fa3586bcb2fd5407719e09eca1af199a071ec21213', 0, 94659981, 'LA TRAVESIA', 0, 'marlon4@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(10, 4, 1, 'LOPEZ', '2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69', 0, 94659981, 'CERRO GRANDE', 0, 'lopez12@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(11, 2, 1, 'CHEYLA', '1807251845b54d1475ecf1ad9490c399b763c94df333ba834d4056cbfe57da89', 0, 94659, 'LA TRAVESIA', 0, 'cheyla444@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(12, 1, 1, 'PRUEBA', '87fa08bd9bbdca759fd7f9ad19031beae00443e24fe3bfc2c25c7736b138f21c', 0, 232314, 'SUYAPA', 0, 'jose20a23.@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(13, 1, 3, 'LUISA', '3554058b9216052dc1597c2e00e448d35592a0a3a8c6f60ba37aa8de44a39510', 0, 23232, 'UNAH', 0, 'luisa2022.@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(14, 1, 1, 'PRUEBA', '2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69', 0, 94659, 'CERRO GRANDE', 0, 'prueba2@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(15, 1, 3, 'ELENA', '2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69', 0, 9459, 'LA ESPERANZA', 0, 'elena@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(16, 1, 5, 'INFORMATICA', '770d6ecc395cae0da1024fe5e0ab57584fb54335ba23835ef078b84659befb2c', 0, 9469581, 'SUYAPA', 0, 'heybel1lemus@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(17, 1, 5, 'INFORMATICA', '782f5cfe1cc7109d7b9b0280a364deff8ac734d275768444e91d16c0f19a6f5c', 0, 9465981, 'SUYAPA', 0, 'jose1manuelduronllanes@gmail.com', '0000-00-00', '2023-02-01', 0, 0),
(20, 4, 3, 'SAFASF', '770d6ecc395cae0da1024fe5e0ab57584fb54335ba23835ef078b84659befb2c', 0, 94659981, 'SUYAPA', 0, 'prueba1234@gmail.com', '0000-00-00', '2023-12-07', 0, 0),
(22, 4, 1, 'DELIDULCES', 'c3f953e9b8e7e2ed8aa613103d162223e75fcfe69459899490f6368d90b55b1e', 1, 888888, 'PRADOS UNIVERSITARIOS', 0, 'delidulcespr@gmail.com', '0000-00-00', '2024-02-19', 0, 0),
(23, 4, 3, 'PRUEBA', '770d6ecc395cae0da1024fe5e0ab57584fb54335ba23835ef078b84659befb2c', 1, 9999999, 'PRADOS UNIVERSITARIOS', 0, 'josemanuelduronllanes233@gmail.com', '0000-00-00', '2024-02-19', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedidos`
--

DROP TABLE IF EXISTS `tbl_pedidos`;
CREATE TABLE IF NOT EXISTS `tbl_pedidos` (
  `Id_Pedido` bigint NOT NULL AUTO_INCREMENT,
  `Id_Cliente` bigint NOT NULL,
  `Id_Usuario` bigint NOT NULL,
  `Id_Estado_Pedido` bigint NOT NULL,
  `Nombre_Empleado` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Hora` date NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Direccion_envio` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Costo_envio` decimal(50,0) NOT NULL,
  `Numero_Factura` int NOT NULL,
  `Id_CAI` bigint NOT NULL,
  `TipoPago` bigint NOT NULL,
  `tipoFactura` int NOT NULL,
  PRIMARY KEY (`Id_Pedido`),
  KEY `Id_Cliente` (`Id_Cliente`),
  KEY `Id_Usuario` (`Id_Usuario`),
  KEY `Id_Estado_Pedido` (`Id_Estado_Pedido`),
  KEY `Id_CAI` (`Id_CAI`),
  KEY `TipoPago` (`TipoPago`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_pedidos`
--

INSERT INTO `tbl_pedidos` (`Id_Pedido`, `Id_Cliente`, `Id_Usuario`, `Id_Estado_Pedido`, `Nombre_Empleado`, `Fecha_Hora`, `Total`, `Direccion_envio`, `Costo_envio`, `Numero_Factura`, `Id_CAI`, `TipoPago`, `tipoFactura`) VALUES
(1, 1, 1, 1, 'ROOT', '2022-11-28', '102.35', '', '70', 89, 1, 3, 1),
(2, 3, 1, 1, 'ROOT', '2022-11-28', '238.05', '', '70', 90, 1, 1, 1),
(3, 3, 1, 1, 'ROOT', '2022-11-28', '488.75', '', '70', 91, 1, 1, 0),
(4, 2, 1, 1, 'ROOT', '2022-11-28', '287.50', '', '70', 92, 1, 1, 0),
(5, 2, 1, 1, 'ROOT', '2022-11-28', '316.10', '', '70', 93, 1, 1, 0),
(6, 5, 1, 1, 'ROOT', '2022-11-28', '959.10', '', '70', 94, 1, 1, 0),
(7, 4, 1, 1, 'ROOT', '2022-11-28', '293.25', '', '70', 95, 1, 1, 0),
(8, 3, 1, 1, 'ROOT', '2022-11-28', '187.80', '', '70', 96, 1, 1, 1),
(9, 5, 1, 1, 'ROOT', '2022-11-28', '320.85', '', '70', 97, 1, 1, 0),
(10, 5, 1, 1, 'ROOT', '2022-11-28', '141.45', '', '70', 98, 1, 1, 0),
(11, 6, 1, 1, 'ROOT', '2022-11-28', '57.50', '', '70', 99, 1, 1, 1),
(12, 1, 1, 1, 'ROOT', '2022-11-28', '48.30', '', '70', 100, 1, 1, 0),
(13, 3, 1, 1, 'ROOT', '2022-11-28', '124.20', '', '70', 1, 1, 1, 0),
(14, 7, 1, 1, 'ROOT', '2022-11-28', '14.95', '', '70', 101, 1, 1, 0),
(15, 3, 1, 1, 'ROOT', '2022-11-28', '215.40', '', '70', 102, 1, 1, 1),
(16, 4, 1, 1, 'ROOT', '2022-11-28', '207.00', '', '70', 0, 1, 1, 1),
(17, 5, 1, 1, 'ROOT', '2022-11-28', '195.50', '', '70', 0, 1, 1, 0),
(18, 3, 1, 1, 'ROOT', '2022-11-28', '234.60', '', '70', 103, 1, 1, 1),
(19, 3, 1, 1, 'ROOT', '2022-11-28', '215.40', '', '70', 0, 1, 1, 0),
(20, 7, 1, 1, 'ROOT', '2022-11-28', '177.10', '', '70', 104, 1, 1, 1),
(21, 3, 1, 1, 'ROOT', '2022-11-28', '147.05', '', '70', 105, 1, 3, 1),
(22, 3, 1, 1, 'ROOT', '2022-11-28', '247.10', '', '70', 106, 1, 1, 1),
(23, 3, 1, 1, 'ROOT', '2022-11-28', '369.15', '', '70', 0, 1, 3, 0),
(27, 3, 1, 1, 'ROOT', '2022-11-28', '263.25', '', '70', 0, 1, 1, 0),
(28, 6, 1, 1, 'ROOT', '2022-11-29', '110.40', '', '70', 0, 1, 1, 0),
(29, 6, 1, 1, 'ROOT', '2022-11-29', '34.50', '', '70', 0, 1, 1, 0),
(30, 6, 1, 1, 'ROOT', '2022-11-29', '189.55', '', '70', 0, 1, 1, 0),
(32, 5, 1, 1, 'ROOT', '2022-11-29', '41.30', '', '70', 0, 1, 1, 0),
(33, 4, 1, 3, 'ROOT', '2022-11-29', '158.70', '', '70', 0, 1, 1, 0),
(35, 3, 1, 1, 'ROOT', '2022-11-30', '203.55', '', '70', 0, 1, 1, 0),
(36, 6, 1, 3, 'ROOT', '2022-11-30', '525.55', '', '70', 108, 1, 3, 1),
(38, 5, 2, 3, 'jose', '2022-12-01', '148.00', '', '70', 0, 1, 1, 0),
(39, 5, 2, 3, 'jose', '2022-12-01', '148.00', '', '70', 0, 1, 2, 0),
(41, 5, 2, 3, 'jose', '2022-12-01', '124.00', '', '70', 0, 1, 2, 0),
(43, 5, 2, 2, 'jose', '2022-12-01', '124.00', '', '70', 0, 1, 2, 0),
(44, 5, 2, 2, 'jose', '2022-12-01', '124.00', '', '70', 0, 1, 2, 0),
(45, 5, 2, 2, 'jose', '2022-12-01', '105.00', '', '70', 0, 1, 2, 0),
(46, 5, 2, 3, 'jose', '2022-12-01', '105.00', '', '70', 0, 1, 2, 0),
(47, 5, 2, 2, 'jose', '2022-12-01', '105.00', '', '70', 0, 1, 2, 0),
(48, 5, 2, 3, 'jose', '2022-12-01', '118.00', '', '70', 0, 1, 2, 0),
(49, 5, 2, 2, 'jose', '2022-12-01', '105.00', '', '70', 0, 1, 2, 0),
(50, 5, 2, 2, 'jose', '2022-12-01', '94.00', '', '70', 0, 1, 2, 0),
(51, 5, 2, 2, 'jose', '2022-12-01', '126.00', '', '70', 0, 1, 3, 0),
(52, 5, 2, 2, 'jose', '2022-12-01', '94.00', '', '70', 0, 1, 2, 0),
(53, 5, 2, 3, 'jose', '2022-12-01', '104.50', '', '70', 0, 1, 1, 0),
(54, 5, 2, 3, 'jose', '2022-12-01', '97.60', '', '70', 0, 1, 2, 0),
(55, 6, 1, 1, 'ROOT', '2022-12-01', '424.35', '', '70', 111, 1, 1, 1),
(56, 4, 1, 1, 'ROOT', '2022-12-01', '170.20', '', '70', 112, 1, 1, 1),
(57, 5, 2, 3, 'jose', '2022-12-01', '168.90', '', '70', 0, 1, 3, 0),
(58, 5, 2, 3, 'jose', '2022-12-01', '178.10', '', '70', 0, 1, 2, 0),
(60, 2, 1, 3, 'ROOT', '2022-12-01', '257.60', '', '70', 0, 1, 1, 0),
(62, 2, 1, 1, 'ROOT', '2022-12-03', '193.20', '', '70', 115, 1, 1, 1),
(63, 4, 1, 1, 'ROOT', '2022-12-03', '1352.40', '', '70', 116, 1, 1, 1),
(64, 4, 1, 1, 'ROOT', '2022-12-03', '273.28', '', '70', 0, 1, 1, 0),
(65, 2, 1, 1, 'ROOT', '2022-12-03', '13.57', '', '70', 117, 1, 1, 1),
(66, 1, 1, 1, 'ROOT', '2022-12-03', '13.57', '', '70', 118, 1, 1, 1),
(67, 4, 1, 1, 'ROOT', '2022-12-03', '256.20', '', '70', 119, 1, 1, 1),
(68, 2, 1, 1, 'ROOT', '2022-12-04', '28.06', '', '70', 120, 1, 1, 1),
(69, 7, 1, 1, 'ROOT', '2022-12-04', '580.30', '', '70', 121, 1, 1, 1),
(70, 7, 1, 1, 'ROOT', '2022-12-04', '580.30', '', '70', 122, 1, 1, 1),
(71, 7, 1, 1, 'ROOT', '2022-12-04', '580.30', '', '70', 123, 1, 1, 1),
(72, 7, 1, 1, 'ROOT', '2022-12-04', '580.30', '', '70', 124, 1, 1, 1),
(73, 5, 1, 1, 'ROOT', '2022-12-04', '555.45', '', '70', 125, 1, 1, 1),
(74, 5, 1, 1, 'ROOT', '2022-12-04', '555.45', '', '70', 126, 1, 1, 1),
(75, 5, 1, 1, 'ROOT', '2022-12-04', '555.45', '', '70', 127, 1, 1, 1),
(76, 2, 1, 1, 'ROOT', '2022-12-04', '73.60', '', '70', 128, 1, 1, 1),
(77, 3, 1, 1, 'ROOT', '2022-12-04', '143.65', '', '70', 129, 1, 1, 1),
(78, 2, 1, 1, 'ROOT', '2022-12-04', '96.60', '', '70', 0, 1, 1, 0),
(79, 3, 1, 1, 'ROOT', '2022-12-04', '213.90', '', '70', 0, 1, 1, 0),
(80, 3, 1, 1, 'ROOT', '2022-12-05', '27.50', '', '70', 130, 1, 2, 1),
(81, 5, 2, 3, 'jose', '2022-12-09', '333.35', '', '70', 0, 1, 1, 0),
(82, 5, 2, 2, 'jose', '2023-01-27', '106.80', '', '70', 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

DROP TABLE IF EXISTS `tbl_productos`;
CREATE TABLE IF NOT EXISTS `tbl_productos` (
  `Id_Producto` bigint NOT NULL AUTO_INCREMENT,
  `Id_Categoria` bigint NOT NULL,
  `Nombre` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codigo` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Id_ISV` bigint NOT NULL,
  `Descripcion` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Precio_Venta` double NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Tamano` double NOT NULL,
  `ruta` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `status` int NOT NULL,
  `Promo` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id_Producto`),
  KEY `Id_Categoria` (`Id_Categoria`),
  KEY `Id_ISV` (`Id_ISV`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`Id_Producto`, `Id_Categoria`, `Nombre`, `codigo`, `Id_ISV`, `Descripcion`, `Precio_Venta`, `imagen`, `datecreated`, `Tamano`, `ruta`, `status`, `Promo`) VALUES
(21, 18, 'Sopa Maggie', '34552', 1, 'sopa de crema de mariscos', 24, 'img_acfd03b78dc5ee09b47deff297635dc3.jpg', '2022-11-26 11:31:00', 1, 'sopa-maggie', 1, 0),
(22, 1, 'Avena', '23111', 1, 'bolsa de avena', 32, 'img_4862027c09388125fdd942cf6d30ee90.jpg', '2022-11-26 11:33:41', 3, 'avena', 1, 0),
(23, 18, 'Cafe', '345521', 1, 'Cafe', 30, 'img_e9463746e2261b1e4ebea10375fe03dc.jpg', '2022-11-26 12:08:21', 1, 'cafe', 1, 1),
(24, 18, 'Manteca Mazola', '55551', 1, 'manteca', 14, 'img_5e27ec10cad69202a163a18dd8f36346.jpg', '2022-11-26 12:08:53', 2, 'manteca-mazola', 0, 0),
(25, 12, 'cerveza corona', '41411', 2, 'Cerveza', 35, 'img_800f6c09e474cd19d84e2c4ee27c764d.jpg', '2022-11-26 12:10:10', 1, 'cerveza-corona', 1, 0),
(26, 1, 'sardina sirena', '441112', 1, 'lata de sardina', 13, 'img_528f38553b0699e02b7f51043a717669.jpg', '2022-11-26 12:10:32', 1, 'sardina-sirena', 1, 0),
(27, 18, 'Gelatina', '411122', 1, 'bolsa de gelatina en polv', 14, 'img_dcfa5de37474df52329bd501b7efc979.jpg', '2022-11-26 12:11:14', 4, 'gelatina', 1, 0),
(28, 18, 'Salsa Inglesa', '44522', 1, 'bote de salsa inglesa', 54, 'img_4b9aea1fa7c92508f6d0278e48e8c0bf.jpg', '2022-11-26 12:11:54', 23, 'salsa-inglesa', 1, 0),
(29, 1, 'Mayonesa', '421122', 1, 'Mayonesa', 23, 'img_990b543a3546b4c4c8536838b90258ff.jpg', '2022-11-26 12:12:18', 1, 'mayonesa', 1, 0),
(30, 18, 'Leche en polvo NAN 31.5', '22211', 1, 'Lata de leche NAN', 23, 'img_556c7577612fc8b78df3dcacab8ad074.jpg', '2022-11-26 12:13:05', 2, 'leche-en-polvo-nan-3', 1, 0),
(31, 18, 'Espagetis', '44156', 1, 'libra de espagetis', 23, 'img_bd78d25fe3a99152355b86ecee5de7de.jpg', '2022-11-26 12:13:31', 2, 'espagetis', 1, 0),
(32, 1, 'Jabon liquido', '414414', 1, 'boto de jabon', 56, 'img_a9ecc8b4cc1f51b50d3bab1d3d9b3c9b.jpg', '2022-11-26 12:13:58', 1, 'jabon-liquido', 1, 1),
(33, 2, 'proteina', '231114', 1, 'es proteina', 45, 'img_b06262d629cc945220df821acb1c76e2.jpg', '2022-11-30 10:07:46', 1, 'proteina', 1, 0),
(34, 3, 'zambos', '41455', 1, 'picante', 56, 'img_d1bced68371997e7678819553dea6545.jpg', '2022-11-30 10:13:42', 1, 'zambos', 1, 1),
(35, 3, 'DORITOS', '465971', 1, 'DORITOS PICANTES', 26, 'img_3de8359e89170898018fb8380a52ab8e.jpg', '2022-12-01 17:41:14', 1, 'doritos', 1, 1),
(36, 3, 'CONR FLAKES', '9481228', 1, 'DESCRIPCION', 50, 'img_c6c17351ec749a9a19b48bb3362b1eb5.jpg', '2022-12-09 19:40:44', 1, 'conr-flakes', 1, 0),
(37, 18, 'MANTECA CLOVER', '3333112', 1, 'GRANDE', 18, 'img_19456a6ee518f23662167f73ad9a6b68.jpg', '2022-12-10 21:13:45', 1, 'manteca-clover', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_promociones`
--

DROP TABLE IF EXISTS `tbl_promociones`;
CREATE TABLE IF NOT EXISTS `tbl_promociones` (
  `Id_Promociones` bigint NOT NULL AUTO_INCREMENT,
  `Id_Producto` bigint NOT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Precio` decimal(10,0) NOT NULL,
  `Descripcion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Final` date NOT NULL,
  PRIMARY KEY (`Id_Promociones`),
  KEY `Id_Producto` (`Id_Producto`),
  KEY `Precio` (`Precio`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_promociones`
--

INSERT INTO `tbl_promociones` (`Id_Promociones`, `Id_Producto`, `Nombre`, `Precio`, `Descripcion`, `Estado`, `Fecha_Inicio`, `Fecha_Final`) VALUES
(2, 32, 'Coca Cola 2 x 1', '60', 'Al comprar una coca cola lleva la segunda gratis', '1', '2022-12-15', '2022-12-05'),
(6, 34, 'Sopa Maggie 2 x 1', '24', 'al comprar una sopa Maggie lleve la segunda gratis', '1', '2022-12-13', '2022-12-13'),
(7, 23, 'BLACK FRIDAY', '41', 'Promocion black friday, al comprar un churro zambo lleve gratis regresco 3 litros', '1', '2022-12-14', '2022-12-14'),
(9, 35, 'Envio gratis', '70', 'Por la compra de 500 lps mas en productos de cerveza su envio sera gratis.', '1', '2022-12-05', '2022-12-14'),
(18, 21, 'SOPA 3 X 1', '40', 'SOPAS', '1', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_promociones_pedidos`
--

DROP TABLE IF EXISTS `tbl_promociones_pedidos`;
CREATE TABLE IF NOT EXISTS `tbl_promociones_pedidos` (
  `Id_Promociones_Pedidos` bigint NOT NULL AUTO_INCREMENT,
  `Id_Promociones` bigint NOT NULL,
  `Id_Pedido` bigint NOT NULL,
  `Cantidad` int NOT NULL,
  `Precio_Venta` decimal(10,0) NOT NULL,
  PRIMARY KEY (`Id_Promociones_Pedidos`),
  KEY `Id_Promociones` (`Id_Promociones`),
  KEY `Id_Pedido` (`Id_Pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_promociones_productos`
--

DROP TABLE IF EXISTS `tbl_promociones_productos`;
CREATE TABLE IF NOT EXISTS `tbl_promociones_productos` (
  `Id_Promociones_Productos` bigint NOT NULL AUTO_INCREMENT,
  `Id_Promociones` bigint NOT NULL,
  `Id_Producto` bigint NOT NULL,
  `Cantidad_Producto` int NOT NULL,
  PRIMARY KEY (`Id_Promociones_Productos`),
  KEY `Id_Promociones` (`Id_Promociones`),
  KEY `Id_Producto` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_promociones_productos`
--

INSERT INTO `tbl_promociones_productos` (`Id_Promociones_Productos`, `Id_Promociones`, `Id_Producto`, `Cantidad_Producto`) VALUES
(1, 2, 27, 2),
(2, 2, 29, 2),
(3, 2, 27, 2),
(4, 2, 30, 2),
(5, 2, 33, 2),
(6, 2, 26, 1),
(7, 2, 26, 1),
(8, 2, 27, 1),
(9, 2, 30, 1),
(10, 2, 26, 2),
(11, 2, 26, 2),
(12, 2, 29, 2),
(13, 2, 26, 3),
(14, 2, 25, 1),
(15, 7, 26, 3),
(16, 7, 29, 3),
(19, 18, 35, 1),
(20, 18, 21, 2),
(21, 18, 21, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reinicio_contrasena`
--

DROP TABLE IF EXISTS `tbl_reinicio_contrasena`;
CREATE TABLE IF NOT EXISTS `tbl_reinicio_contrasena` (
  `Id_Reinicio_Contrasena` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Correo` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Token` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Vencimiento` date NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Reinicio_Contrasena`),
  KEY `Id_Usuario` (`Id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_reinicio_contrasena`
--

INSERT INTO `tbl_reinicio_contrasena` (`Id_Reinicio_Contrasena`, `Id_Usuario`, `Correo`, `Token`, `Fecha_Vencimiento`, `Creado_Por`, `Fecha_Creacion`, `Modificado_Por`, `Fecha_Modificado`) VALUES
(23, 3, 'josemanuel2duronllanes25@gmail.com', '49e642c0208509c9382a-793170d7a21bfea19e8e-70521e2989417ce190d5-cd5064bd99fd31b37d7c', '2022-11-05', '', '0000-00-00', '', '0000-00-00'),
(24, 2, 'ana2024@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(25, 1, 'root@gmail.com', '88437fcaef29cab99c19-a9ace71a6688313886db-f3592fd9ed99cf34c3a8-085ecda2aec36226857b', '2023-03-18', '', '0000-00-00', '', '0000-00-00'),
(26, 4, 'camilavillalta25@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(27, 5, 'estherva2000@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(28, 6, 'luis1234@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(29, 7, 'luis12342@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(30, 8, 'gorge14@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(31, 9, 'marlon4@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(32, 10, 'lopez12@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(33, 11, 'cheyla444@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(34, 12, 'jose20a23.@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(35, 13, 'luisa2022.@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(36, 14, 'prueba2@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(37, 15, 'elena@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(38, 16, 'heybel1lemus@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(39, 17, 'josemanuelduronllanes@gmail.com', '', '2022-11-05', '', '0000-00-00', '', '0000-00-00'),
(42, 20, 'prueba1234@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(44, 22, 'delidulcespr@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(45, 23, 'josemanuelduronllanes233@gmail.com', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `pFK` FOREIGN KEY (`productoid`) REFERENCES `tbl_productos` (`Id_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_config_cai`
--
ALTER TABLE `tbl_config_cai`
  ADD CONSTRAINT `tbl_config_cai_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_descuentos_pedidos`
--
ALTER TABLE `tbl_descuentos_pedidos`
  ADD CONSTRAINT `tbl_descuentos_pedidos_ibfk_1` FOREIGN KEY (`Id_Descuento`) REFERENCES `tbl_descuentos` (`Id_Descuento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_descuentos_pedidos_ibfk_2` FOREIGN KEY (`Id_Pedido`) REFERENCES `tbl_pedidos` (`Id_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_descuentos_pedidos_ibfk_3` FOREIGN KEY (`Id_Detalle_Pedido`) REFERENCES `tbl_detalle_pedido` (`Id_Detalle_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_detalle_pedido`
--
ALTER TABLE `tbl_detalle_pedido`
  ADD CONSTRAINT `tbl_detalle_pedido_ibfk_1` FOREIGN KEY (`Id_Pedido`) REFERENCES `tbl_pedidos` (`Id_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detalle_pedido_ibfk_2` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detalle_pedido_ibfk_3` FOREIGN KEY (`Id_ISV`) REFERENCES `tbl_impuestos` (`Id_ISV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_estados_promociones`
--
ALTER TABLE `tbl_estados_promociones`
  ADD CONSTRAINT `tbl_estados_promociones_ibfk_1` FOREIGN KEY (`Id_Promociones`) REFERENCES `tbl_promociones` (`Id_Promociones`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_ms_bitacora`
--
ALTER TABLE `tbl_ms_bitacora`
  ADD CONSTRAINT `tbl_ms_bitacora_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ms_bitacora_ibfk_2` FOREIGN KEY (`Id_Objeto`) REFERENCES `tbl_ms_objetos` (`Id_Objeto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_ms_historico_contrasena`
--
ALTER TABLE `tbl_ms_historico_contrasena`
  ADD CONSTRAINT `tbl_ms_historico_contrasena_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_ms_objetos`
--
ALTER TABLE `tbl_ms_objetos`
  ADD CONSTRAINT `tbl_ms_objetos_ibfk_1` FOREIGN KEY (`Id_Rol`) REFERENCES `tbl_ms_rol` (`Id_Rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_ms_permisos`
--
ALTER TABLE `tbl_ms_permisos`
  ADD CONSTRAINT `tbl_ms_permisos_ibfk_1` FOREIGN KEY (`Id_Rol`) REFERENCES `tbl_ms_rol` (`Id_Rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ms_permisos_ibfk_2` FOREIGN KEY (`Id_Objeto`) REFERENCES `tbl_ms_objetos` (`Id_Objeto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_ms_preguntas_usuario`
--
ALTER TABLE `tbl_ms_preguntas_usuario`
  ADD CONSTRAINT `tbl_ms_preguntas_usuario_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ms_preguntas_usuario_ibfk_2` FOREIGN KEY (`id_pregunta`) REFERENCES `tbl_ms_preguntas` (`Id_Pregunta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_ms_sesiones`
--
ALTER TABLE `tbl_ms_sesiones`
  ADD CONSTRAINT `tbl_ms_sesiones_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_ms_usuarios`
--
ALTER TABLE `tbl_ms_usuarios`
  ADD CONSTRAINT `tbl_ms_usuarios_ibfk_1` FOREIGN KEY (`Id_Rol`) REFERENCES `tbl_ms_rol` (`Id_Rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ms_usuarios_ibfk_2` FOREIGN KEY (`id_estado_usuario`) REFERENCES `tbl_estados_usuarios` (`id_estado_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_pedidos`
--
ALTER TABLE `tbl_pedidos`
  ADD CONSTRAINT `tbl_forma_pago_fk_6` FOREIGN KEY (`TipoPago`) REFERENCES `tbl_forma_pago` (`Id_Forma_Pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pedidos_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pedidos_ibfk_2` FOREIGN KEY (`Id_Cliente`) REFERENCES `tbl_clientes` (`Id_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pedidos_ibfk_3` FOREIGN KEY (`Id_CAI`) REFERENCES `tbl_config_cai` (`Id_CAI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pedidos_ibfk_4` FOREIGN KEY (`Id_Estado_Pedido`) REFERENCES `tbl_estados_pedidos` (`Id_Estado_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `tbl_productos_ibfk_1` FOREIGN KEY (`Id_ISV`) REFERENCES `tbl_impuestos` (`Id_ISV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_productos_ibfk_2` FOREIGN KEY (`Id_Categoria`) REFERENCES `tbl_categoria_productos` (`Id_Categoria_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_promociones`
--
ALTER TABLE `tbl_promociones`
  ADD CONSTRAINT `tbl_promociones_ibfk_1` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_promociones_pedidos`
--
ALTER TABLE `tbl_promociones_pedidos`
  ADD CONSTRAINT `tbl_promociones_pedidos_ibfk_1` FOREIGN KEY (`Id_Promociones`) REFERENCES `tbl_promociones` (`Id_Promociones`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_promociones_pedidos_ibfk_2` FOREIGN KEY (`Id_Pedido`) REFERENCES `tbl_pedidos` (`Id_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_promociones_productos`
--
ALTER TABLE `tbl_promociones_productos`
  ADD CONSTRAINT `tbl_promociones_productos_ibfk_1` FOREIGN KEY (`Id_Promociones`) REFERENCES `tbl_promociones` (`Id_Promociones`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_promociones_productos_ibfk_2` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_reinicio_contrasena`
--
ALTER TABLE `tbl_reinicio_contrasena`
  ADD CONSTRAINT `tbl_reinicio_contrasena_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
