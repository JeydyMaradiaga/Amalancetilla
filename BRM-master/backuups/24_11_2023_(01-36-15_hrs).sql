SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS amalancetilla_bd;

USE amalancetilla_bd;

DROP TABLE IF EXISTS imagen;

CREATE TABLE `imagen` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `productoid` bigint NOT NULL,
  `img` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productoid` (`productoid`),
  CONSTRAINT `pFK` FOREIGN KEY (`productoid`) REFERENCES `tbl_productos` (`Id_Producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




DROP TABLE IF EXISTS log_table;

CREATE TABLE `log_table` (
  `Id_Log` int NOT NULL AUTO_INCREMENT,
  `Id_Bitacora` int DEFAULT NULL,
  `Id_Usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `Id_Objeto` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `Accion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `Descripcion` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Fecha_Eliminacion_En_Bitacora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Usuario_Ejecutador` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  PRIMARY KEY (`Id_Log`),
  KEY `fk_log_usuario` (`Id_Usuario`),
  KEY `fk_log_objeto` (`Id_Objeto`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO log_table VALUES("1","81","LUISA","USUARIOS","Actualizar usuario","Se actualizo el  usuario luisa2022.@gmail.com","2023-07-04","2023-11-23 01:37:40","root@localhost");
INSERT INTO log_table VALUES("2","82","PRUEBA","USUARIOS","Actualizar usuario","Se actualizo el  usuario prueba2@gmail.com","2023-07-04","2023-11-23 15:45:40","root@localhost");



DROP TABLE IF EXISTS tbl_categoria_productos;

CREATE TABLE `tbl_categoria_productos` (
  `Id_Categoria_Producto` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_Categoria` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Foto_Categoria` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Categoria_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_categoria_productos VALUES("1","PRODUCTOS","PRODUCTOS DE VENTAS","1","img_7008141108be3de851b2ca587f924db9.jpg");
INSERT INTO tbl_categoria_productos VALUES("2","INSUMOS","CATEGORIA PARA INSUMOS","1","img_2b2d1b1c4ef2ffee589d3f0ae872c277.jpg");
INSERT INTO tbl_categoria_productos VALUES("20","PRUEBA","PRUEBA CATEGORIA","0","portada_categoria.png");



DROP TABLE IF EXISTS tbl_clientes;

CREATE TABLE `tbl_clientes` (
  `Id_Cliente` bigint NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Apellidos` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Correo_Cliente` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Telefono` int NOT NULL,
  `Direccion` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Categoria` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Numero_ID` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Registro` date NOT NULL,
  PRIMARY KEY (`Id_Cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_clientes VALUES("1","mauricio","vargas","mauriciovargas@gmail.com","94659981","Aldea de suyapa","1","0109-1996-94533","2022-10-13");
INSERT INTO tbl_clientes VALUES("2","kevin","chaver","kevinchaver@gmail.com","949981","","2","0501-1999-15322","2022-10-12");
INSERT INTO tbl_clientes VALUES("3","estefany","","estefany2022@gmail.com","9494","SUYAPA","1","0801-2000-15324","0000-00-00");
INSERT INTO tbl_clientes VALUES("4","samantha","lagos","sam202332@gmail.com","9494","SUYAPA","2","703","0000-00-00");
INSERT INTO tbl_clientes VALUES("5","jeydi","","jeyd@gmail.com","959981","ALDEA DE SUYAPA","1","0801-1999-47896","0000-00-00");
INSERT INTO tbl_clientes VALUES("6","consumidor final","","consumidor2022@gmail.com","94659981","SUYAPA","1","0801-2000-32544","0000-00-00");
INSERT INTO tbl_clientes VALUES("10","INFORMATICA","INFORMATICA","correo@gmail.com","0","INFORMATICA67267236732","","0","0000-00-00");



DROP TABLE IF EXISTS tbl_compra;

CREATE TABLE `tbl_compra` (
  `Id_Compra` int NOT NULL AUTO_INCREMENT,
  `Id_Proveedor` int DEFAULT NULL,
  `Id_Usuario` bigint DEFAULT NULL,
  `Fecha_Compra` datetime DEFAULT NULL,
  `Estado_Compra` int DEFAULT NULL,
  PRIMARY KEY (`Id_Compra`),
  KEY `tbl_compra_tbl_proveedor_idx` (`Id_Proveedor`),
  KEY `tbl_compra_tbl_usuario_idx` (`Id_Usuario`),
  CONSTRAINT `tbl_compra_tbl_Proveedor` FOREIGN KEY (`Id_Proveedor`) REFERENCES `tbl_proveedor` (`Id_Proveedor`),
  CONSTRAINT `tbl_compra_tbl_usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO tbl_compra VALUES("1","1","1","2023-07-31 19:54:05","1");
INSERT INTO tbl_compra VALUES("2","2","3","2023-08-07 19:03:50","1");



DROP TABLE IF EXISTS tbl_config_cai;

CREATE TABLE `tbl_config_cai` (
  `Id_CAI` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Descripcion` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Rango_Inicial` int NOT NULL,
  `Rango_Final` int NOT NULL,
  `Rango_Actual` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Vencimiento` date NOT NULL,
  `Numero_CAI` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_CAI`),
  KEY `Id_Usuario` (`Id_Usuario`),
  CONSTRAINT `tbl_config_cai_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_config_cai VALUES("1","2","","1","999","164","2023-12-27","2A2B6C-49C9A-69D4GD-09F319-1F4D5C-2G");



DROP TABLE IF EXISTS tbl_descuentos;

CREATE TABLE `tbl_descuentos` (
  `Id_Descuento` bigint NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Porcentaje_Deduccion` decimal(10,0) NOT NULL,
  `Descripcion` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Descuento`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_descuentos VALUES("6","3era edad","54","PARA TERERA EDAD","2");
INSERT INTO tbl_descuentos VALUES("7","Compra mayor a 500 lps","10","COMPRA MAYOR A","1");
INSERT INTO tbl_descuentos VALUES("14","SIN DESCUENTOS","0","SIN DESCUENTOS","1");
INSERT INTO tbl_descuentos VALUES("15","informatica 10","10","INFORMATICA","1");



DROP TABLE IF EXISTS tbl_descuentos_pedidos;

CREATE TABLE `tbl_descuentos_pedidos` (
  `Id_Desc_Pedidos` bigint NOT NULL AUTO_INCREMENT,
  `Id_Pedido` bigint NOT NULL,
  `Id_Descuento` bigint NOT NULL,
  `Descripcion` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Total_Descontado` decimal(10,0) NOT NULL,
  `Id_Detalle_Pedido` bigint NOT NULL,
  PRIMARY KEY (`Id_Desc_Pedidos`),
  KEY `Id_Pedido` (`Id_Pedido`),
  KEY `Id_Descuento` (`Id_Descuento`),
  KEY `Id_Detalle_Pedido` (`Id_Detalle_Pedido`),
  CONSTRAINT `tbl_descuentos_pedidos_ibfk_1` FOREIGN KEY (`Id_Descuento`) REFERENCES `tbl_descuentos` (`Id_Descuento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_descuentos_pedidos_ibfk_2` FOREIGN KEY (`Id_Pedido`) REFERENCES `tbl_pedidos` (`Id_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_descuentos_pedidos_ibfk_3` FOREIGN KEY (`Id_Detalle_Pedido`) REFERENCES `tbl_detalle_pedido` (`Id_Detalle_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




DROP TABLE IF EXISTS tbl_detalle_compra;

CREATE TABLE `tbl_detalle_compra` (
  `Id_Detalle_Compra` int NOT NULL AUTO_INCREMENT,
  `Id_Compra` int NOT NULL,
  `Id_Producto` bigint NOT NULL,
  `Cantidad_Comprada` int DEFAULT NULL,
  `Precio_Costo` decimal(10,0) DEFAULT NULL,
  `Nombre_Producto_Comprado` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `Total` decimal(10,0) NOT NULL,
  PRIMARY KEY (`Id_Detalle_Compra`),
  KEY `tbl_detallecompra_tbl_compra_idx` (`Id_Compra`),
  KEY `tbl_detallecompra_tbl_producto_idx` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO tbl_detalle_compra VALUES("1","1","2","12","12","Uvas","0");
INSERT INTO tbl_detalle_compra VALUES("2","2","21","15","250","Vino de un Litro","0");
INSERT INTO tbl_detalle_compra VALUES("3","2","21","30","250","Vino de un litro","0");



DROP TABLE IF EXISTS tbl_detalle_pedido;

CREATE TABLE `tbl_detalle_pedido` (
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
  KEY `Id_ISV` (`Id_ISV`),
  CONSTRAINT `tbl_detalle_pedido_ibfk_1` FOREIGN KEY (`Id_Pedido`) REFERENCES `tbl_pedidos` (`Id_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_detalle_pedido_ibfk_2` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_detalle_pedido_ibfk_3` FOREIGN KEY (`Id_ISV`) REFERENCES `tbl_impuestos` (`Id_ISV`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_detalle_pedido VALUES("230","35","42","3","0.00","1","1000");



DROP TABLE IF EXISTS tbl_detalle_produccion;

CREATE TABLE `tbl_detalle_produccion` (
  `Id_Detalle_Produccion` int NOT NULL AUTO_INCREMENT,
  `Id_Produccion` int DEFAULT NULL,
  `Id_Producto` bigint DEFAULT NULL,
  `Cantidad_Produccion` int DEFAULT NULL,
  `Movimiento` int DEFAULT NULL,
  PRIMARY KEY (`Id_Detalle_Produccion`),
  KEY `tbl_detalle_Produccion_tbl_Produccion_idx` (`Id_Produccion`),
  KEY `tbl_detalle_Produccion_tbl_Producto_idx` (`Id_Producto`),
  CONSTRAINT `tbl_detalle_Produccion_tbl_Produccion` FOREIGN KEY (`Id_Produccion`) REFERENCES `tbl_produccion` (`Id_Produccion`),
  CONSTRAINT `tbl_detalle_Produccion_tbl_Producto` FOREIGN KEY (`Id_Producto`) REFERENCES `tbl_productos` (`Id_Producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;




DROP TABLE IF EXISTS tbl_detalle_temp;

CREATE TABLE `tbl_detalle_temp` (
  `id_detalle_temp` bigint NOT NULL AUTO_INCREMENT,
  `Id_Cliente` bigint NOT NULL,
  `Id_Producto` bigint NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id_detalle_temp`),
  KEY `Id_Cliente` (`Id_Cliente`),
  KEY `Id_Producto` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_detalle_temp VALUES("1","1","3","7");
INSERT INTO tbl_detalle_temp VALUES("2","1","2","3");
INSERT INTO tbl_detalle_temp VALUES("3","1","2","3");
INSERT INTO tbl_detalle_temp VALUES("4","0","2","2");
INSERT INTO tbl_detalle_temp VALUES("5","2","2","2");
INSERT INTO tbl_detalle_temp VALUES("6","2","3","2");
INSERT INTO tbl_detalle_temp VALUES("7","2","4","4");
INSERT INTO tbl_detalle_temp VALUES("8","2","4","4");
INSERT INTO tbl_detalle_temp VALUES("9","4","3","2");
INSERT INTO tbl_detalle_temp VALUES("10","0","2","4");
INSERT INTO tbl_detalle_temp VALUES("11","2","2","4");
INSERT INTO tbl_detalle_temp VALUES("12","0","3","8");
INSERT INTO tbl_detalle_temp VALUES("13","4","3","8");
INSERT INTO tbl_detalle_temp VALUES("14","2","3","4");
INSERT INTO tbl_detalle_temp VALUES("15","0","2","2");
INSERT INTO tbl_detalle_temp VALUES("16","3","2","2");
INSERT INTO tbl_detalle_temp VALUES("17","3","2","3");
INSERT INTO tbl_detalle_temp VALUES("18","3","2","3");
INSERT INTO tbl_detalle_temp VALUES("19","3","3","3");
INSERT INTO tbl_detalle_temp VALUES("20","3","3","3");
INSERT INTO tbl_detalle_temp VALUES("21","3","4","3");
INSERT INTO tbl_detalle_temp VALUES("22","3","2","4");
INSERT INTO tbl_detalle_temp VALUES("23","3","5","4");
INSERT INTO tbl_detalle_temp VALUES("24","3","5","3");
INSERT INTO tbl_detalle_temp VALUES("25","3","2","3");
INSERT INTO tbl_detalle_temp VALUES("26","1","2","3");
INSERT INTO tbl_detalle_temp VALUES("27","3","3","5");
INSERT INTO tbl_detalle_temp VALUES("28","3","2","18");
INSERT INTO tbl_detalle_temp VALUES("29","0","4","14");
INSERT INTO tbl_detalle_temp VALUES("30","3","4","14");
INSERT INTO tbl_detalle_temp VALUES("31","3","5","15");
INSERT INTO tbl_detalle_temp VALUES("32","3","3","1");
INSERT INTO tbl_detalle_temp VALUES("33","3","4","5");
INSERT INTO tbl_detalle_temp VALUES("34","3","5","25");
INSERT INTO tbl_detalle_temp VALUES("35","1","3","1");
INSERT INTO tbl_detalle_temp VALUES("36","1","3","5");
INSERT INTO tbl_detalle_temp VALUES("37","3","3","4");
INSERT INTO tbl_detalle_temp VALUES("38","3","3","9");
INSERT INTO tbl_detalle_temp VALUES("39","3","3","1");
INSERT INTO tbl_detalle_temp VALUES("40","3","3","1");
INSERT INTO tbl_detalle_temp VALUES("41","3","2","3");
INSERT INTO tbl_detalle_temp VALUES("42","3","2","11");
INSERT INTO tbl_detalle_temp VALUES("43","3","2","11");
INSERT INTO tbl_detalle_temp VALUES("44","3","3","1");
INSERT INTO tbl_detalle_temp VALUES("45","3","2","12");
INSERT INTO tbl_detalle_temp VALUES("46","3","2","13");
INSERT INTO tbl_detalle_temp VALUES("47","3","3","4");
INSERT INTO tbl_detalle_temp VALUES("48","3","3","12");
INSERT INTO tbl_detalle_temp VALUES("49","3","2","1");
INSERT INTO tbl_detalle_temp VALUES("50","3","3","3");
INSERT INTO tbl_detalle_temp VALUES("51","3","3","7");
INSERT INTO tbl_detalle_temp VALUES("52","3","2","5");
INSERT INTO tbl_detalle_temp VALUES("53","3","3","4");
INSERT INTO tbl_detalle_temp VALUES("54","2","2","3");
INSERT INTO tbl_detalle_temp VALUES("55","2","2","25");
INSERT INTO tbl_detalle_temp VALUES("56","2","2","4");
INSERT INTO tbl_detalle_temp VALUES("57","0","0","3");
INSERT INTO tbl_detalle_temp VALUES("58","0","0","3");
INSERT INTO tbl_detalle_temp VALUES("59","0","0","3");
INSERT INTO tbl_detalle_temp VALUES("60","0","0","3");



DROP TABLE IF EXISTS tbl_estados_pedidos;

CREATE TABLE `tbl_estados_pedidos` (
  `Id_Estado_Pedido` bigint NOT NULL AUTO_INCREMENT,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Estado_Pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_estados_pedidos VALUES("1","Completado","");
INSERT INTO tbl_estados_pedidos VALUES("2","Pendiente","");
INSERT INTO tbl_estados_pedidos VALUES("3","Cancelado","$%$%**(**&&&&");
INSERT INTO tbl_estados_pedidos VALUES("4","PENDIENTE","INFORMATICA");



DROP TABLE IF EXISTS tbl_estados_promociones;

CREATE TABLE `tbl_estados_promociones` (
  `Id_Estado|_Promocion` bigint NOT NULL AUTO_INCREMENT,
  `Id_Promociones` bigint NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Estado|_Promocion`),
  KEY `Id_Promociones` (`Id_Promociones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




DROP TABLE IF EXISTS tbl_estados_usuarios;

CREATE TABLE `tbl_estados_usuarios` (
  `id_estado_usuario` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_estado` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  PRIMARY KEY (`id_estado_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_estados_usuarios VALUES("1","ACTIVO","2022-10-06");
INSERT INTO tbl_estados_usuarios VALUES("2","INACTIVO","2022-10-13");
INSERT INTO tbl_estados_usuarios VALUES("3","NUEVO","0000-00-00");
INSERT INTO tbl_estados_usuarios VALUES("4","BLOQUEADO","2022-10-23");
INSERT INTO tbl_estados_usuarios VALUES("5","ELIMINADO","2022-10-24");
INSERT INTO tbl_estados_usuarios VALUES("6","Default","2022-11-02");



DROP TABLE IF EXISTS tbl_forma_pago;

CREATE TABLE `tbl_forma_pago` (
  `Id_Forma_Pago` bigint NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Forma_Pago`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_forma_pago VALUES("1","Tarjeta de credito","Pago con tarjeta al recibir productos");
INSERT INTO tbl_forma_pago VALUES("2","Efectivo","Pago en efectivo al momento de recibir productos");
INSERT INTO tbl_forma_pago VALUES("3","Transferencia bancaria","Pago a cuenta bancaria");



DROP TABLE IF EXISTS tbl_impuestos;

CREATE TABLE `tbl_impuestos` (
  `Id_ISV` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_ISV` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Porcentaje_ISV` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_ISV`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_impuestos VALUES("1","ISV normal","0.15");
INSERT INTO tbl_impuestos VALUES("2","ISV Bebidas","0.18");
INSERT INTO tbl_impuestos VALUES("3","ISV Excento","0.00");



DROP TABLE IF EXISTS tbl_inventario;

CREATE TABLE `tbl_inventario` (
  `Id_Inventario` int NOT NULL AUTO_INCREMENT,
  `Id_Producto` bigint DEFAULT NULL,
  `Cantidad_Existente` int DEFAULT NULL,
  PRIMARY KEY (`Id_Inventario`),
  KEY `tbl_inventario_tbl_producto_idx` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

INSERT INTO tbl_inventario VALUES("1","21","100");
INSERT INTO tbl_inventario VALUES("2","22","28");
INSERT INTO tbl_inventario VALUES("3","41","4");
INSERT INTO tbl_inventario VALUES("4","42","-1");



DROP TABLE IF EXISTS tbl_movimiento_inventario;

CREATE TABLE `tbl_movimiento_inventario` (
  `Id_Movimiento` int NOT NULL AUTO_INCREMENT,
  `Id_Producto` bigint NOT NULL,
  `Fecha_movimiento` date NOT NULL,
  `Hora_movimiento` time NOT NULL,
  `Cantidad_movimiento` int NOT NULL,
  `Id_tipo_movimiento` int NOT NULL,
  `id_usuario` bigint NOT NULL,
  PRIMARY KEY (`Id_Movimiento`),
  KEY `tbl_movimiento_tbl_producto_idx` (`Id_Producto`),
  KEY `tbla_movimiento_tbl_tipo_idx` (`Id_tipo_movimiento`),
  KEY `tbl_movimiento_tbl_usuario_idx` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO tbl_movimiento_inventario VALUES("1","21","2023-08-05","04:00:07","5","1","3");
INSERT INTO tbl_movimiento_inventario VALUES("2","21","2023-08-06","19:19:53","2","2","3");
INSERT INTO tbl_movimiento_inventario VALUES("3","21","2023-08-06","19:43:10","5","2","3");
INSERT INTO tbl_movimiento_inventario VALUES("4","21","2023-08-06","19:45:30","10","2","3");
INSERT INTO tbl_movimiento_inventario VALUES("5","21","2023-08-06","19:46:41","5","2","3");
INSERT INTO tbl_movimiento_inventario VALUES("6","21","2023-08-06","20:04:54","2","2","3");
INSERT INTO tbl_movimiento_inventario VALUES("7","21","2023-08-06","20:06:29","1","2","3");
INSERT INTO tbl_movimiento_inventario VALUES("8","21","2023-08-06","20:29:14","5","2","3");
INSERT INTO tbl_movimiento_inventario VALUES("9","21","2023-08-06","20:31:24","3","2","3");
INSERT INTO tbl_movimiento_inventario VALUES("10","22","2023-08-06","20:31:24","5","2","3");
INSERT INTO tbl_movimiento_inventario VALUES("11","21","2023-08-06","21:05:58","2","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("12","21","2023-08-06","21:25:32","5","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("13","22","2023-08-06","21:25:32","5","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("14","21","2023-08-07","19:05:05","15","1","3");
INSERT INTO tbl_movimiento_inventario VALUES("15","21","2023-08-07","19:06:07","30","1","3");
INSERT INTO tbl_movimiento_inventario VALUES("16","21","2023-08-07","20:00:03","1","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("17","21","2023-08-07","22:32:47","3","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("18","21","2023-08-07","22:34:37","4","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("19","21","2023-08-07","22:37:14","2","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("20","21","2023-08-07","22:38:20","2","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("21","22","2023-08-07","22:39:43","1","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("22","21","2023-08-07","22:39:43","1","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("23","22","2023-08-07","22:49:33","1","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("24","21","2023-08-07","22:49:33","1","2","1");
INSERT INTO tbl_movimiento_inventario VALUES("25","42","2023-08-08","17:35:52","1","2","1");



DROP TABLE IF EXISTS tbl_ms_bitacora;

CREATE TABLE `tbl_ms_bitacora` (
  `Id_Bitacora` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Id_Objeto` bigint NOT NULL,
  `Accion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`Id_Bitacora`),
  KEY `Id_Usuario` (`Id_Usuario`),
  KEY `Id_Objeto` (`Id_Objeto`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_bitacora VALUES("1","1","1","Inicio de sesion","El usuario ROOT inicio sesion","2023-04-10");
INSERT INTO tbl_ms_bitacora VALUES("19","26","2","Autoregistro usuario","Se autoregistro el  usuario kevin12@gmail.com al sistema","2023-06-29");
INSERT INTO tbl_ms_bitacora VALUES("24","26","1","Cambio de contraseña","Se cambio la contraseña de primer acceso al sistema","2023-06-29");
INSERT INTO tbl_ms_bitacora VALUES("81","13","2","Actualizar usuario","Se actualizo el  usuario luisa2022.@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("82","14","2","Actualizar usuario","Se actualizo el  usuario prueba2@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("83","14","2","Actualizar usuario","Se actualizo el  usuario prueba2@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("102","1","1","Se envio correo","Se envío correo a empresa.amalancetilla23@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("103","1","1","Se envio correo","Se envío correo a empresa.amalancetilla23@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("106","1","1","Se envio correo","Se envío correo a empresa.amalancetilla23@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("107","1","1","Se envio correo","Se envío correo a empresa.amalancetilla23@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("108","1","1","Se envio correo","Se envío correo a kevinchaver14@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("109","1","1","Se envio correo","Se envío correo a kevinchaver14@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("110","1","1","Cambio de contraseña","Se cambio la contraseña kevinchaver14@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("111","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("112","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("113","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("114","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("116","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("120","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("121","38","2","Agregar usuario","Se agrego el nuevo usuario kevinchaver14@gmail.com al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("122","14","2","Actualizar usuario","Se actualizo el  usuario prueba2@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("123","14","2","Actualizar usuario","Se actualizo el  usuario prueba2@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("124","38","1","Cambio de contraseña","Se cambio la contraseña de primer acceso al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("125","38","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("126","38","1","Bloqueo usuario","Se bloqueo al usuario kevinchaver14@gmail.com Por intentos erroneos","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("127","38","1","Se envio correo","Se envío correo a kevinchaver14@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("128","38","1","Cambio de contraseña","Se cambio la contraseña kevinchaver14@gmail.com","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("129","38","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("130","38","1","Cambio de contraseña","Se cambio la contraseña ","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("131","38","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("132","39","2","Autoregistro usuario","Se autoregistro el  usuario informatica@gmail.com al sistema","2023-07-04");
INSERT INTO tbl_ms_bitacora VALUES("133","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-06");
INSERT INTO tbl_ms_bitacora VALUES("134","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-06");
INSERT INTO tbl_ms_bitacora VALUES("135","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-07");
INSERT INTO tbl_ms_bitacora VALUES("136","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-20");
INSERT INTO tbl_ms_bitacora VALUES("137","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-20");
INSERT INTO tbl_ms_bitacora VALUES("138","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-20");
INSERT INTO tbl_ms_bitacora VALUES("139","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-20");
INSERT INTO tbl_ms_bitacora VALUES("140","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-22");
INSERT INTO tbl_ms_bitacora VALUES("141","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-22");
INSERT INTO tbl_ms_bitacora VALUES("142","1","4","Elimino Tipo de inventario","El usuario AMALANCETILLA Elimino Tipo de inventario 8","2023-07-22");
INSERT INTO tbl_ms_bitacora VALUES("143","1","4","Elimino Tipo de inventario","El usuario AMALANCETILLA Elimino Tipo de inventario 9","2023-07-22");
INSERT INTO tbl_ms_bitacora VALUES("144","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-22");
INSERT INTO tbl_ms_bitacora VALUES("145","1","1","Se actualizo un Objeto del sistema","El usuario AMALANCETILLA actualizo un objeto PRODUCTOS TIPO DE INVENTARIO","2023-07-22");
INSERT INTO tbl_ms_bitacora VALUES("146","1","1","Se actualizo un Objeto del sistema","El usuario AMALANCETILLA actualizo un objeto PRODUCTOS","2023-07-22");
INSERT INTO tbl_ms_bitacora VALUES("147","1","4","Elimino Tipo de inventario","El usuario AMALANCETILLA Elimino Tipo de inventario 10","2023-07-22");
INSERT INTO tbl_ms_bitacora VALUES("148","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-23");
INSERT INTO tbl_ms_bitacora VALUES("149","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-24");
INSERT INTO tbl_ms_bitacora VALUES("150","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-26");
INSERT INTO tbl_ms_bitacora VALUES("151","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-27");
INSERT INTO tbl_ms_bitacora VALUES("152","1","4","Elimino Tipo de inventario","El usuario AMALANCETILLA Elimino Tipo de inventario 13","2023-07-27");
INSERT INTO tbl_ms_bitacora VALUES("153","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-07-27");
INSERT INTO tbl_ms_bitacora VALUES("154","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-08-03");
INSERT INTO tbl_ms_bitacora VALUES("155","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-08-03");
INSERT INTO tbl_ms_bitacora VALUES("156","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-08-04");
INSERT INTO tbl_ms_bitacora VALUES("157","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-08-04");
INSERT INTO tbl_ms_bitacora VALUES("158","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-08-06");
INSERT INTO tbl_ms_bitacora VALUES("159","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-08-06");
INSERT INTO tbl_ms_bitacora VALUES("160","1","4","Actualizo un producto","El usuario AMALANCETILLA Actualizo un producto JALEA DE 12 ONZAS","2023-08-06");
INSERT INTO tbl_ms_bitacora VALUES("161","1","4","Actualizo un producto","El usuario AMALANCETILLA Actualizo un producto VINO DE UN LITRO","2023-08-06");
INSERT INTO tbl_ms_bitacora VALUES("162","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-08-07");
INSERT INTO tbl_ms_bitacora VALUES("163","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-08-08");
INSERT INTO tbl_ms_bitacora VALUES("164","1","4","Registro un nuevo producto","El usuario AMALANCETILLA agrego un nuevo producto AZUCAR DE 1 LIBRA","2023-08-08");
INSERT INTO tbl_ms_bitacora VALUES("165","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-08-08");
INSERT INTO tbl_ms_bitacora VALUES("166","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-08-08");
INSERT INTO tbl_ms_bitacora VALUES("167","1","4","Registro un nuevo producto","El usuario AMALANCETILLA agrego un nuevo producto INFORMATICA%%$$%","2023-08-08");
INSERT INTO tbl_ms_bitacora VALUES("168","1","4","Actualizo un producto","El usuario AMALANCETILLA Actualizo un producto INFORMATICA","2023-08-08");
INSERT INTO tbl_ms_bitacora VALUES("169","1","4","Elimino un producto","El usuario AMALANCETILLA Elimino un producto 21","2023-08-08");
INSERT INTO tbl_ms_bitacora VALUES("170","1","4","Elimino un producto","El usuario AMALANCETILLA Elimino un producto 22","2023-08-08");
INSERT INTO tbl_ms_bitacora VALUES("171","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-23");
INSERT INTO tbl_ms_bitacora VALUES("172","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-23");
INSERT INTO tbl_ms_bitacora VALUES("173","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-23");
INSERT INTO tbl_ms_bitacora VALUES("174","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-23");
INSERT INTO tbl_ms_bitacora VALUES("175","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-23");
INSERT INTO tbl_ms_bitacora VALUES("176","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-23");



DROP TABLE IF EXISTS tbl_ms_historico_contrasena;

CREATE TABLE `tbl_ms_historico_contrasena` (
  `Id_Historico` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Contrasena` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Historico`),
  KEY `Id_Usuario` (`Id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_historico_contrasena VALUES("14","3","2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("15","1","e74b7ad5a996d7b83a77beff2d34d29a1d195190e295d5ddea600069492a8fa7","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("16","3","405271d3c779fff92b20873b39d49a96da9577954dd56da78253c99c58e65c1d","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("17","3","e528c2128d9c09d05633fc7cccc2302961ff9307b0d7c170d2c9d0a01ecfa546","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("18","3","2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("19","5","bde2727537bd634d5a41259a21d5c6b045880b83183246cfec7a26a7b13e081c","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("20","14","2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("21","17","46c7eb77663ed290e3bd24fddbfc3f437865e3b4528e216a8577954cbe50acab","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("22","17","6317b7b0c781721e3ed9245d385879bf2e525539c136c458633b633ae4453390","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("23","17","782f5cfe1cc7109d7b9b0280a364deff8ac734d275768444e91d16c0f19a6f5c","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("26","22","46c7eb77663ed290e3bd24fddbfc3f437865e3b4528e216a8577954cbe50acab","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("27","23","e74b7ad5a996d7b83a77beff2d34d29a1d195190e295d5ddea600069492a8fa7","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("28","23","770d6ecc395cae0da1024fe5e0ab57584fb54335ba23835ef078b84659befb2c","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("29","22","c3f953e9b8e7e2ed8aa613103d162223e75fcfe69459899490f6368d90b55b1e","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("32","26","fae07d67a9e382e779383fb1121a8ad3b1613395ca5560db835ee2f9ef5e9a9d","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("36","1","d85fb61a933e0b8a45f88c89888502573a3d318657a576ef5529bf948b98882c","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("37","38","d85fb61a933e0b8a45f88c89888502573a3d318657a576ef5529bf948b98882c","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("38","38","fae07d67a9e382e779383fb1121a8ad3b1613395ca5560db835ee2f9ef5e9a9d","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_historico_contrasena VALUES("39","38","daf33b256c1786dff5c70ef5f77fa893676e299da1f320a0330f974f1f22d6ef","","0000-00-00","","0000-00-00");



DROP TABLE IF EXISTS tbl_ms_objetos;

CREATE TABLE `tbl_ms_objetos` (
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

INSERT INTO tbl_ms_objetos VALUES("1","2","PARAMETROS","Modulo de parametros","Modulo","administrador","2022-10-20","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("2","2","USUARIOS","Modulo de mantenimiento usuarios","Modulo","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("3","2","CLIENTES","Modulo de mantenimiento clientes","modulo","Administrador","2022-11-17","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("4","2","PRODUCTOS","Modulo de mantenimiento productos","modulo","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("5","2","CATEGORIA PRODUCTOS","Modulo de mantenimiento productos","Modulo","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("20","1","BACKUP","Modulo backup","","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("21","1","RESTORE","restaurar bd","","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("22","1","BITACORA","bitacora M","","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("23","1","PREGUNTAS SEGURIDAD","Modulo de preguntas","","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("24","1","ROLES","modulo de roles","","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("25","1","PEDIDOS","Modulo pedidos","","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("26","1","PROMOCIONES","Mpromociones","","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("29","1","DESCUENTOS","Modulo de mantenimiento descuentos","","","0000-00-00","","0000-00-00");



DROP TABLE IF EXISTS tbl_ms_parametros;

CREATE TABLE `tbl_ms_parametros` (
  `Id_Parametro` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_Parametro` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Valor_Parametro` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Parametro`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_parametros VALUES("1","PRUEBA","2","Numero de intentos de acceso al sistema","Administrador","2022-10-15","","0000-00-00");
INSERT INTO tbl_ms_parametros VALUES("2","NUM_PREGUNTAS_SECRETAS","2","Cantidad de preguntas secretas","Kevin","2022-10-16","","0000-00-00");
INSERT INTO tbl_ms_parametros VALUES("3","NUM_DIAS_VENCIMIENTO","365","Cantidad de dias de vencimiento de usuarios","","2022-10-20","","0000-00-00");
INSERT INTO tbl_ms_parametros VALUES("4","DIAS_VENCIMIENTO_TOKEN","5","Numero de dias vencimiento de token de correo electronico","","2022-10-20","","0000-00-00");
INSERT INTO tbl_ms_parametros VALUES("14","PARAMETROS","23","aaa","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_parametros VALUES("15","INFORMATICA","10","INFORMATICA","AMALANCETILLA","2023-08-08","","0000-00-00");



DROP TABLE IF EXISTS tbl_ms_permisos;

CREATE TABLE `tbl_ms_permisos` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1134 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_permisos VALUES("179","3","1","0","0","0","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("180","3","2","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("181","3","3","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("182","3","4","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("183","3","5","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("191","5","1","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("192","5","2","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("193","5","3","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("194","5","4","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("195","5","5","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("275","2","1","1","0","1","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("276","2","2","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("277","2","3","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("278","2","4","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("279","2","5","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("345","2","20","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("346","3","20","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("348","5","20","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("350","2","21","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("351","3","21","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("353","5","21","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("356","2","22","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("357","3","22","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("359","5","22","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("362","2","23","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("363","3","23","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("365","5","23","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("404","2","24","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("405","3","24","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("407","5","24","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("603","2","25","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("604","3","25","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("606","5","25","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("629","2","26","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("630","3","26","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("632","5","26","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1108","1","1","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1109","1","2","1","1","1","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1110","1","3","1","1","1","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1111","1","4","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1112","1","5","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1113","1","20","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1114","1","21","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1115","1","22","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1116","1","23","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1117","1","24","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1118","1","25","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1119","1","26","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1120","1","29","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1121","4","1","0","1","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1122","4","2","0","1","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1123","4","3","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1124","4","4","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1125","4","5","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1126","4","20","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1127","4","21","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1128","4","22","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1129","4","23","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1130","4","24","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1131","4","25","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1132","4","26","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1133","4","29","0","0","0","0","","0000-00-00","","0000-00-00");



DROP TABLE IF EXISTS tbl_ms_preguntas;

CREATE TABLE `tbl_ms_preguntas` (
  `Id_Pregunta` bigint NOT NULL AUTO_INCREMENT,
  `Pregunta` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`Id_Pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_preguntas VALUES("1","¿Jugador de Futbol favorito?","Mauricio","2022-10-13","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("2","¿Canción Favorita?","Mauricio","2022-10-08","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("4","¿Nombre de la pelicula favorita?","Mauricio","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("5","¿Libro favorito?","Mauricio","2022-10-31","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("6","¿Amigo favorito?","Mauricio","2022-10-01","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("7","¿Cumpleaños de mi mama?","Mauricio","2022-10-31","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("8","¿Primer trabajo?","Mauricio","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("10","¿Cumpleaños de mi mascota?","Mauricio","2022-10-31","","0000-00-00");



DROP TABLE IF EXISTS tbl_ms_preguntas_usuario;

CREATE TABLE `tbl_ms_preguntas_usuario` (
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_preguntas_usuario VALUES("1","1","3","CR7","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("2","2","3","La cancion","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("3","6","3","mi perro","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("4","5","1","startlink","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("5","5","1","startlink","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("6","5","1","startlink","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("8","6","5","dog","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("9","10","5","26 de junio","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("10","5","14","Harry potter","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("11","6","14","scot","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("13","7","17","27 de junio","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("19","1","26","CR7","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("30","2","38","cancion","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("31","2","38","otra","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("32","1","39","CR7","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas_usuario VALUES("33","1","39","CR7","","0000-00-00","","0000-00-00");



DROP TABLE IF EXISTS tbl_ms_rol;

CREATE TABLE `tbl_ms_rol` (
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

INSERT INTO tbl_ms_rol VALUES("1","Programadores","Programadores","1","","2022-10-06","","0000-00-00");
INSERT INTO tbl_ms_rol VALUES("4","Default","Rol para usuarios default","1","","2022-11-01","","0000-00-00");
INSERT INTO tbl_ms_rol VALUES("5","Supervisores","Rol para los supervisores","2","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_rol VALUES("6","RRHH","Rol de recursos humanos","1","","0000-00-00","","0000-00-00");



DROP TABLE IF EXISTS tbl_ms_sesiones;

CREATE TABLE `tbl_ms_sesiones` (
  `Id_Sesion` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Ip_address` decimal(10,0) NOT NULL,
  `Ultima_Sesion` date NOT NULL,
  PRIMARY KEY (`Id_Sesion`),
  KEY `Id_Usuario` (`Id_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




DROP TABLE IF EXISTS tbl_ms_usuarios;

CREATE TABLE `tbl_ms_usuarios` (
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
  `Procedencia` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `Id_Rol` (`Id_Rol`),
  KEY `id_estado_usuario` (`id_estado_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_usuarios VALUES("1","1","1","AMALANCETILLA","d85fb61a933e0b8a45f88c89888502573a3d318657a576ef5529bf948b98882c","0","995481","tela","0","empresa.amalancetilla23@gmail.com","0000-00-00","2024-07-03","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("2","1","6","MARTA","75c54a72945e00a69b13367df132e86f950df2cbe152807fcedf63c0a4a01730","0","9465981","ALDEA ","0","ES2024@gmail.com","0000-00-00","2025-01-31","0","8","0");
INSERT INTO tbl_ms_usuarios VALUES("3","1","2","PEDRO","2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69","0","94999","UNAHAAAAAA","0","jos25@gmail.com","0000-00-00","2023-01-31","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("4","0","3","CAMILA","9d168b61f0d8191eea0182482316e430a85f50782d959c440af6334a6c59d9d1","0","94591","ALDEA","0","alta25@gmail.com","0000-00-00","2023-01-31","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("5","1","5","ANGIE","bde2727537bd634d5a41259a21d5c6b045880b83183246cfec7a26a7b13e081c","0","94659841","LA ","0","estherva2000@gmail.com","0000-00-00","2023-01-31","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("6","1","4","LUIS PEREZ","44da6d3819c4d2cfbdac32fa3586bcb2fd5407719e09eca1af199a071ec21213","0","94659981","LA TRAVESIA","0","luis1234@gmail.com","0000-00-00","2023-02-01","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("8","1","1","GORGE","44da6d3819c4d2cfbdac32fa3586bcb2fd5407719e09eca1af199a071ec21213","0","94659981","LA TRAVESIA","0","gorge14@gmail.com","0000-00-00","2023-02-01","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("9","1","5","MARLON","44da6d3819c4d2cfbdac32fa3586bcb2fd5407719e09eca1af199a071ec21213","0","94659981","LA TRAVESIA","0","marlon4@gmail.com","0000-00-00","2023-02-01","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("10","4","1","LOPEZ","2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69","0","94659981","CERRO GRANDE","0","lopez12@gmail.com","0000-00-00","2023-02-01","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("11","0","1","CHEYLA","1807251845b54d1475ecf1ad9490c399b763c94df333ba834d4056cbfe57da89","0","94659","LA TRAVESIA","0","cheyla444@gmail.com","0000-00-00","2023-02-01","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("13","1","3","LUISA","3554058b9216052dc1597c2e00e448d35592a0a3a8c6f60ba37aa8de44a39510","0","23232","UNAH","0","luisa2022.@gmail.com","0000-00-00","2023-02-01","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("14","0","1","PRUEBA","2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69","0","94659","CERRO GRANDE","0","prueba2@gmail.com","0000-00-00","2023-02-01","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("15","1","3","ELENA","2c2112a5c75522b977e3d8911872eda24907db1f6224999b66cbd54917776f69","0","9459","LA ESPERANZA","0","elena@gmail.com","0000-00-00","2023-02-01","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("16","1","5","PEREZ","770d6ecc395cae0da1024fe5e0ab57584fb54335ba23835ef078b84659befb2c","0","9469581","SUYAPA","0","heys@gmail.com","0000-00-00","2023-02-01","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("17","1","5","LOPEZ","782f5cfe1cc7109d7b9b0280a364deff8ac734d275768444e91d16c0f19a6f5c","0","9465981","SUYAPA","0","jes@gmail.com","0000-00-00","2023-02-01","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("20","4","3","SAFASF","770d6ecc395cae0da1024fe5e0ab57584fb54335ba23835ef078b84659befb2c","0","94659981","SUYAPA","0","prueba1234@gmail.com","0000-00-00","2023-12-07","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("22","4","1","MER","c3f953e9b8e7e2ed8aa613103d162223e75fcfe69459899490f6368d90b55b1e","1","888888","PRADOS UNIVERSITARIOS","0","delr@gmail.com","0000-00-00","2024-02-19","0","0","0");
INSERT INTO tbl_ms_usuarios VALUES("23","4","3","PRUEBA","770d6ecc395cae0da1024fe5e0ab57584fb54335ba23835ef078b84659befb2c","1","9999999","PRADOS UNIVERSITARIOS","0","jos233@gmail.com","0000-00-00","2024-02-19","0","1","0");
INSERT INTO tbl_ms_usuarios VALUES("26","4","1","KEVIN","fae07d67a9e382e779383fb1121a8ad3b1613395ca5560db835ee2f9ef5e9a9d","0","88888888","Colonia","0","kevin12@gmail.com","0000-00-00","2024-06-28","0","1","0");
INSERT INTO tbl_ms_usuarios VALUES("38","1","1","INFORMATICA","daf33b256c1786dff5c70ef5f77fa893676e299da1f320a0330f974f1f22d6ef","0","0","Colonia","0","kevinchaver14@gmail.com","0000-00-00","2024-07-03","0","0","1");
INSERT INTO tbl_ms_usuarios VALUES("39","4","1","INFORMATICA","d85fb61a933e0b8a45f88c89888502573a3d318657a576ef5529bf948b98882c","0","88888888","Colonia","0","informatica@gmail.com","0000-00-00","2024-07-03","0","0","0");



DROP TABLE IF EXISTS tbl_pedidos;

CREATE TABLE `tbl_pedidos` (
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_pedidos VALUES("1","1","1","1","ROOT","2023-04-10","750.00","","0","133","1","2","1");
INSERT INTO tbl_pedidos VALUES("2","2","1","1","ROOT","2023-04-10","200.00","","0","134","1","1","1");
INSERT INTO tbl_pedidos VALUES("3","6","1","1","ROOT","2023-04-10","200.00","","0","0","1","1","0");
INSERT INTO tbl_pedidos VALUES("4","2","1","1","ROOT","2023-04-10","250.00","","0","0","1","1","0");
INSERT INTO tbl_pedidos VALUES("5","1","1","1","ROOT","2023-04-10","100.00","","0","135","1","1","1");
INSERT INTO tbl_pedidos VALUES("6","1","1","1","AMALANCETILLA","2023-08-06","600.00","","0","136","1","2","1");
INSERT INTO tbl_pedidos VALUES("7","1","1","1","AMALANCETILLA","2023-08-06","500.00","","0","137","1","1","1");
INSERT INTO tbl_pedidos VALUES("8","1","1","1","AMALANCETILLA","2023-08-06","500.00","","0","138","1","1","1");
INSERT INTO tbl_pedidos VALUES("9","1","1","1","AMALANCETILLA","2023-08-06","500.00","","0","139","1","1","1");
INSERT INTO tbl_pedidos VALUES("10","1","1","1","AMALANCETILLA","2023-08-06","500.00","","0","140","1","2","1");
INSERT INTO tbl_pedidos VALUES("11","1","1","1","AMALANCETILLA","2023-08-06","500.00","","0","141","1","2","1");
INSERT INTO tbl_pedidos VALUES("12","1","1","1","AMALANCETILLA","2023-08-06","500.00","","0","142","1","2","1");
INSERT INTO tbl_pedidos VALUES("13","1","1","1","AMALANCETILLA","2023-08-06","750.00","","0","143","1","1","1");
INSERT INTO tbl_pedidos VALUES("14","1","1","1","AMALANCETILLA","2023-08-06","750.00","","0","144","1","1","1");
INSERT INTO tbl_pedidos VALUES("15","2","1","1","AMALANCETILLA","2023-08-06","1250.00","","0","145","1","2","1");
INSERT INTO tbl_pedidos VALUES("16","2","1","1","AMALANCETILLA","2023-08-06","500.00","","0","146","1","1","1");
INSERT INTO tbl_pedidos VALUES("17","1","1","1","AMALANCETILLA","2023-08-06","500.00","","0","147","1","2","1");
INSERT INTO tbl_pedidos VALUES("18","1","1","1","AMALANCETILLA","2023-08-06","500.00","","0","148","1","2","1");
INSERT INTO tbl_pedidos VALUES("19","1","1","1","AMALANCETILLA","2023-08-06","1250.00","","0","149","1","2","1");
INSERT INTO tbl_pedidos VALUES("20","1","1","3","AMALANCETILLA","2023-08-06","2500.00","","0","150","1","2","1");
INSERT INTO tbl_pedidos VALUES("21","1","1","1","AMALANCETILLA","2023-08-06","1250.00","","0","151","1","2","1");
INSERT INTO tbl_pedidos VALUES("22","1","1","3","AMALANCETILLA","2023-08-06","500.00","","0","152","1","2","1");
INSERT INTO tbl_pedidos VALUES("23","1","1","3","AMALANCETILLA","2023-08-06","250.00","","0","153","1","1","1");
INSERT INTO tbl_pedidos VALUES("24","1","1","3","AMALANCETILLA","2023-08-06","1250.00","","0","154","1","1","1");
INSERT INTO tbl_pedidos VALUES("25","6","1","1","AMALANCETILLA","2023-08-06","1250.00","","0","155","1","2","1");
INSERT INTO tbl_pedidos VALUES("26","2","1","3","AMALANCETILLA","2023-08-06","500.00","","0","156","1","2","1");
INSERT INTO tbl_pedidos VALUES("27","3","1","1","AMALANCETILLA","2023-08-06","1750.00","","0","157","1","1","1");
INSERT INTO tbl_pedidos VALUES("28","4","1","3","AMALANCETILLA","2023-08-07","250.00","","0","158","1","1","1");
INSERT INTO tbl_pedidos VALUES("29","4","1","1","AMALANCETILLA","2023-08-07","3600.00","","0","159","1","1","1");
INSERT INTO tbl_pedidos VALUES("30","2","1","1","AMALANCETILLA","2023-08-07","1000.00","","0","160","1","1","1");
INSERT INTO tbl_pedidos VALUES("31","2","1","1","AMALANCETILLA","2023-08-07","2400.00","","0","161","1","1","1");
INSERT INTO tbl_pedidos VALUES("32","4","1","1","AMALANCETILLA","2023-08-07","2400.00","","0","162","1","1","1");
INSERT INTO tbl_pedidos VALUES("33","5","1","1","AMALANCETILLA","2023-08-07","1300.00","","0","163","1","1","1");
INSERT INTO tbl_pedidos VALUES("34","2","1","1","AMALANCETILLA","2023-08-07","650.00","","0","164","1","1","1");
INSERT INTO tbl_pedidos VALUES("35","1","1","1","AMALANCETILLA","2023-08-08","900.00","","0","0","1","2","0");



DROP TABLE IF EXISTS tbl_produccion;

CREATE TABLE `tbl_produccion` (
  `Id_Produccion` int NOT NULL AUTO_INCREMENT,
  `Fecha` date DEFAULT NULL,
  `Estado_Produccion` int DEFAULT NULL,
  `Id_Usuario` bigint DEFAULT NULL,
  PRIMARY KEY (`Id_Produccion`),
  KEY `tbl_Produccion_tbl_ms_Usuarios_idx` (`Id_Usuario`),
  CONSTRAINT `tbl_Produccion_tbl_ms_Usuarios` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO tbl_produccion VALUES("1","2023-11-20","1","1");



DROP TABLE IF EXISTS tbl_productos;

CREATE TABLE `tbl_productos` (
  `Id_Producto` bigint NOT NULL AUTO_INCREMENT,
  `Id_Categoria` bigint NOT NULL,
  `Nombre` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codigo` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Id_ISV` bigint NOT NULL,
  `Descripcion` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Precio_Venta` double NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ruta` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `status` int NOT NULL,
  `Promo` int NOT NULL DEFAULT '0',
  `Cantidad_Minima` int NOT NULL,
  `Cantidad_Maxima` int NOT NULL,
  PRIMARY KEY (`Id_Producto`),
  KEY `Id_Categoria` (`Id_Categoria`),
  KEY `Id_ISV` (`Id_ISV`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_productos VALUES("41","2","AZUCAR DE 1 LIBRA","8282821","3","AZUCAR DE UNA LIBRA","12","portada_categoria.png","2023-08-08 09:42:22","azucar-de-1-libra","1","0","5","30");
INSERT INTO tbl_productos VALUES("42","1","INFORMATICA","213213","3","INFORMATICA","1000","portada_categoria.png","2023-08-08 17:28:35","informatica","1","0","10","100");



DROP TABLE IF EXISTS tbl_promociones;

CREATE TABLE `tbl_promociones` (
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_promociones VALUES("18","21","VINO 1 3 X 2","1200","vinos un litro","1","2023-08-07","2023-08-16");
INSERT INTO tbl_promociones VALUES("20","21","VINO 2X1","1000","VInos de 2 litros","1","0000-00-00","0000-00-00");
INSERT INTO tbl_promociones VALUES("21","22","JALEA 2X1","400","JAlea","1","0000-00-00","0000-00-00");



DROP TABLE IF EXISTS tbl_promociones_pedidos;

CREATE TABLE `tbl_promociones_pedidos` (
  `Id_Promociones_Pedidos` bigint NOT NULL AUTO_INCREMENT,
  `Id_Promociones` bigint NOT NULL,
  `Id_Pedido` bigint NOT NULL,
  `Cantidad` int NOT NULL,
  `Precio_Venta` decimal(10,0) NOT NULL,
  PRIMARY KEY (`Id_Promociones_Pedidos`),
  KEY `Id_Promociones` (`Id_Promociones`),
  KEY `Id_Pedido` (`Id_Pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




DROP TABLE IF EXISTS tbl_promociones_productos;

CREATE TABLE `tbl_promociones_productos` (
  `Id_Promociones_Productos` bigint NOT NULL AUTO_INCREMENT,
  `Id_Promociones` bigint NOT NULL,
  `Id_Producto` bigint NOT NULL,
  `Cantidad_Producto` int NOT NULL,
  PRIMARY KEY (`Id_Promociones_Productos`),
  KEY `Id_Promociones` (`Id_Promociones`),
  KEY `Id_Producto` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_promociones_productos VALUES("20","18","21","2");
INSERT INTO tbl_promociones_productos VALUES("21","18","21","3");
INSERT INTO tbl_promociones_productos VALUES("22","18","21","6");
INSERT INTO tbl_promociones_productos VALUES("23","20","21","2");
INSERT INTO tbl_promociones_productos VALUES("24","21","22","2");
INSERT INTO tbl_promociones_productos VALUES("25","18","42","5001");
INSERT INTO tbl_promociones_productos VALUES("26","18","42","2");



DROP TABLE IF EXISTS tbl_proveedor;

CREATE TABLE `tbl_proveedor` (
  `Id_Proveedor` int NOT NULL AUTO_INCREMENT,
  `Nombre_Proveedor` varchar(60) DEFAULT NULL,
  `RTN_Proveedor` varchar(45) DEFAULT NULL,
  `Telefono_Proveedor` varchar(20) DEFAULT NULL,
  `Correo_Proveedor` varchar(80) DEFAULT NULL,
  `Direccion_Proveedor` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`Id_Proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO tbl_proveedor VALUES("1","Juan","909020","99900009","juan@gmail.com","juaan");
INSERT INTO tbl_proveedor VALUES("2","Perez","2343343434","87438783","Proveedor@123.com","Colonia");



DROP TABLE IF EXISTS tbl_reinicio_contrasena;

CREATE TABLE `tbl_reinicio_contrasena` (
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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_reinicio_contrasena VALUES("23","3","joaquin25@gmail.com","49e642c0208509c9382a-793170d7a21bfea19e8e-70521e2989417ce190d5-cd5064bd99fd31b37d7c","2022-11-05","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("24","2","ana2024@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("25","1","empresa.amalancetilla23@gmail.com","","2023-07-09","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("26","4","camilavillalta25@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("27","5","angie.mesa2002@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("28","6","luis1234@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("30","8","gorge14@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("31","9","marlon4@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("32","10","lopez12@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("33","11","cheyla444@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("35","13","luisa2022.@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("36","14","prueba2@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("37","15","elena@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("38","16","hellomaria@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("39","17","josePeraltas@gmail.com","","2022-11-05","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("42","20","prueba1234@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("44","22","delidulcespr@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("45","23","julianJuan12@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("48","26","kevin12@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("60","38","kevinchaver14@gmail.com","","2023-07-09","","0000-00-00","","0000-00-00");
INSERT INTO tbl_reinicio_contrasena VALUES("61","39","informatica@gmail.com","","0000-00-00","","0000-00-00","","0000-00-00");



DROP TABLE IF EXISTS tbl_tipo_inventario;

CREATE TABLE `tbl_tipo_inventario` (
  `Id_tipo_movimiento` int NOT NULL AUTO_INCREMENT,
  `Nombre_movimiento` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`Id_tipo_movimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO tbl_tipo_inventario VALUES("1","ENTRADA");
INSERT INTO tbl_tipo_inventario VALUES("2","SALIDA");
INSERT INTO tbl_tipo_inventario VALUES("14","DEVOLUCIONES**&&&&&");



SET FOREIGN_KEY_CHECKS=1;