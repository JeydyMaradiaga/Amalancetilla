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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




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

INSERT INTO log_table VALUES("1","16","AMALANCETILLA","PARAMETROS","Acceso al sistema","Accedio correctamente al sistema","2023-11-22","2023-11-24 01:56:04","root@localhost");
INSERT INTO log_table VALUES("2","15","AMALANCETILLA","CATEGORIA PRODUCTOS","Elimino Categoria de productos","El usuario AMALANCETILLA Elimino Categoria de prod","2023-11-22","2023-11-24 01:56:59","ADMINISTRADOR@localhost");



DROP TABLE IF EXISTS tbl_categoria_productos;

CREATE TABLE `tbl_categoria_productos` (
  `Id_Categoria_Producto` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_Categoria` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Foto_Categoria` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Categoria_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_categoria_productos VALUES("1","PRODUCTOS","PRODUCTOS DE VENTAS","1","img_7008141108be3de851b2ca587f924db9.jpg");
INSERT INTO tbl_categoria_productos VALUES("2","INSUMOS","CATEGORIA PARA INSUMOS","1","img_2b2d1b1c4ef2ffee589d3f0ae872c277.jpg");



DROP TABLE IF EXISTS tbl_clientes;

CREATE TABLE `tbl_clientes` (
  `Id_Cliente` bigint NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Apellidos` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Correo_Cliente` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Telefono` int NOT NULL,
  `Direccion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Categoria` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Numero_ID` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Registro` date NOT NULL,
  PRIMARY KEY (`Id_Cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_clientes VALUES("1","consumidor final","","consumidor2022@gmail.com","99999999","Tela","1","0109-1996-94533","2023-08-17");



DROP TABLE IF EXISTS tbl_compra;

CREATE TABLE `tbl_compra` (
  `Id_Compra` int NOT NULL AUTO_INCREMENT,
  `Id_Proveedor` int DEFAULT NULL,
  `Id_Usuario` bigint DEFAULT NULL,
  `Fecha_Compra` date NOT NULL,
  `Estado_Compra` int NOT NULL,
  PRIMARY KEY (`Id_Compra`),
  KEY `tbl_compra_tbl_proveedor_idx` (`Id_Proveedor`),
  KEY `tbl_compra_tbl_usuario_idx` (`Id_Usuario`),
  CONSTRAINT `tbl_compra_tbl_Proveedor` FOREIGN KEY (`Id_Proveedor`) REFERENCES `tbl_proveedor` (`Id_Proveedor`),
  CONSTRAINT `tbl_compra_tbl_usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




DROP TABLE IF EXISTS tbl_config_cai;

CREATE TABLE `tbl_config_cai` (
  `Id_CAI` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Descripcion` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Rango_Inicial` int NOT NULL,
  `Rango_Final` int NOT NULL,
  `Rango_Actual` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Vencimiento` date NOT NULL,
  `Numero_CAI` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_CAI`),
  KEY `Id_Usuario` (`Id_Usuario`),
  CONSTRAINT `tbl_config_cai_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_config_cai VALUES("1","1","","1","999","001","2023-12-27","2A2B6C-49C9A-69D4GD-09F319-1F4D5C-2G");



DROP TABLE IF EXISTS tbl_descuentos;

CREATE TABLE `tbl_descuentos` (
  `Id_Descuento` bigint NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Porcentaje_Deduccion` decimal(10,0) NOT NULL,
  `Descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Estado` int NOT NULL,
  PRIMARY KEY (`Id_Descuento`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_descuentos VALUES("1","3era edad","54","PARA TERERA EDAD","1");
INSERT INTO tbl_descuentos VALUES("2","Compra mayor a 500 lps","10","COMPRA MAYOR A","1");
INSERT INTO tbl_descuentos VALUES("3","Sin descuento","0","Sin descuentos","1");



DROP TABLE IF EXISTS tbl_descuentos_pedidos;

CREATE TABLE `tbl_descuentos_pedidos` (
  `Id_Desc_Pedidos` bigint NOT NULL AUTO_INCREMENT,
  `Id_Pedido` bigint NOT NULL,
  `Id_Descuento` bigint NOT NULL,
  `Descripcion` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `Total_Descontado` decimal(10,0) DEFAULT NULL,
  `Id_Detalle_Pedido` bigint DEFAULT NULL,
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
  `Nombre_Producto_Comprado` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  PRIMARY KEY (`Id_Detalle_Compra`),
  KEY `tbl_detallecompra_tbl_compra_idx` (`Id_Compra`),
  KEY `tbl_detallecompra_tbl_producto_idx` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;




DROP TABLE IF EXISTS tbl_detalle_temp;

CREATE TABLE `tbl_detalle_temp` (
  `id_detalle_temp` bigint NOT NULL AUTO_INCREMENT,
  `Id_Cliente` bigint NOT NULL,
  `Id_Producto` bigint NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id_detalle_temp`),
  KEY `Id_Cliente` (`Id_Cliente`),
  KEY `Id_Producto` (`Id_Producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




DROP TABLE IF EXISTS tbl_estados_pedidos;

CREATE TABLE `tbl_estados_pedidos` (
  `Id_Estado_Pedido` bigint NOT NULL AUTO_INCREMENT,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Estado_Pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_estados_pedidos VALUES("1","Completado","Pedidos completados");
INSERT INTO tbl_estados_pedidos VALUES("2","Pendiente","Pedidos pendiente");
INSERT INTO tbl_estados_pedidos VALUES("3","Cancelado","Pedidos Cancelados");



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
  `Nombre` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Forma_Pago`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_forma_pago VALUES("1","Tarjeta de credito","Pago con tarjeta al recibir productos");
INSERT INTO tbl_forma_pago VALUES("2","Efectivo","Pago en efectivo al momento de recibir productos");
INSERT INTO tbl_forma_pago VALUES("3","Transferencia bancaria","Pago a cuenta bancaria");
INSERT INTO tbl_forma_pago VALUES("4","NUEVO","NUEVO");
INSERT INTO tbl_forma_pago VALUES("5","OTRO1","OTRO");



DROP TABLE IF EXISTS tbl_impuestos;

CREATE TABLE `tbl_impuestos` (
  `Id_ISV` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_ISV` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Porcentaje_ISV` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Id_ISV`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_impuestos VALUES("1","ISV normal","0.15");
INSERT INTO tbl_impuestos VALUES("2","ISV Bebidas","0.18");
INSERT INTO tbl_impuestos VALUES("3","ISV Excento","0.00");



DROP TABLE IF EXISTS tbl_inventario;

CREATE TABLE `tbl_inventario` (
  `Id_Inventario` int NOT NULL AUTO_INCREMENT,
  `Id_Producto` bigint NOT NULL,
  `Cantidad_Existente` int NOT NULL,
  PRIMARY KEY (`Id_Inventario`),
  KEY `tbl_inventario_tbl_producto_idx` (`Id_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;




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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;




DROP TABLE IF EXISTS tbl_ms_bitacora;

CREATE TABLE `tbl_ms_bitacora` (
  `Id_Bitacora` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Id_Objeto` bigint NOT NULL,
  `Accion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`Id_Bitacora`),
  KEY `Id_Usuario` (`Id_Usuario`),
  KEY `Id_Objeto` (`Id_Objeto`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_bitacora VALUES("11","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-22");
INSERT INTO tbl_ms_bitacora VALUES("12","1","1","Registro un Objeto al sistema","El usuario AMALANCETILLA agrego un nuevo objeto ES","2023-11-22");
INSERT INTO tbl_ms_bitacora VALUES("13","1","1","Registro un Objeto al sistema","El usuario AMALANCETILLA agrego un nuevo objeto FO","2023-11-22");
INSERT INTO tbl_ms_bitacora VALUES("14","1","5","Registro Categoria de productos","El usuario AMALANCETILLA agrego una nueva categori","2023-11-22");
INSERT INTO tbl_ms_bitacora VALUES("17","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("18","1","34","Agregó tipo de movimientos","Se agregó un nuevo tipo de movimiento ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("19","1","34","Elimino tipo de movimiento","Se elimino el tipo de movimiento ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("20","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("21","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("22","1","38","Agregó forma de pago","Se agregó una nueva forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("23","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("24","1","38","Agregó forma de pago","Se agregó una nueva forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("25","1","38","Agregó forma de pago","Se agregó una nueva forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("26","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("27","1","38","Agregó forma de pago","Se agregó una nueva forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("28","1","38","Agregó forma de pago","Se agregó una nueva forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("29","1","38","Agregó forma de pago","Se agregó una nueva forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("30","1","38","Agregó forma de pago","Se agregó una nueva forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("31","1","38","Elimino forma pago","Se elimino la forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("32","1","38","Elimino forma pago","Se elimino la forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("33","1","38","Elimino forma pago","Se elimino la forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("34","1","38","Elimino forma pago","Se elimino la forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("35","1","38","Agregó forma de pago","Se agregó una nueva forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("36","1","38","Agregó forma de pago","Se agregó una nueva forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("37","1","38","Elimino forma pago","Se elimino la forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("38","1","38","Elimino forma pago","Se elimino la forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("39","1","38","Agregó forma de pago","Se agregó una nueva forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("40","1","38","Agregó forma de pago","Se agregó una nueva forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("41","1","38","Elimino forma pago","Se elimino la forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("42","1","38","Elimino forma pago","Se elimino la forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("43","1","38","Elimino forma pago","Se elimino la forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("44","1","38","Actualizó forma pago","Se actualizó la forma de pago ","2023-11-24");
INSERT INTO tbl_ms_bitacora VALUES("45","1","1","Acceso al sistema","Accedio correctamente al sistema","2023-11-24");



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_objetos VALUES("1","2","PARAMETROS","Modulo de parametros","Modulo","AMALANCETILLA","2022-10-20","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("2","2","USUARIOS","Modulo de mantenimiento usuarios","Modulo","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("3","2","CLIENTES","Modulo de mantenimiento clientes","modulo","AMALANCETILLA","2022-11-17","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("4","2","PRODUCTOS","Modulo de mantenimiento productos","modulo","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("5","2","CATEGORIA PRODUCTOS","Modulo de mantenimiento productos","Modulo","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("20","1","BACKUP","Modulo backup","","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("21","1","RESTORE","restaurar bd","","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("22","1","BITACORA","bitacora M","","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("23","1","PREGUNTAS SEGURIDAD","Modulo de preguntas","","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("24","1","ROLES","modulo de roles","","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("25","1","PEDIDOS","Modulo pedidos","","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("26","1","PROMOCIONES","Mpromociones","","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("29","1","DESCUENTOS","Modulo de mantenimiento descuentos","","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("30","1","INVENTARIO KARDEX","INVENTARIO Y KARDEX","","AMALANCETILLA","2023-08-10","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("31","1","IMPUESTOS","IMPUESTOS DE LOS PRODUCTOS","","AMALANCETILLA","2023-08-10","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("32","1","COMPRAS","MODULO DE COMPRAS","","AMALANCETILLA","2023-08-14","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("33","1","ESTADOS PEDIDOS","MODULO DE ESTADO DE LOS PEDIDOS","","AMALANCETILLA","2023-08-19","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("34","1","TIPO MOVIMIENTOS","MODULO PARA LOS MOVIMIENTOS DEL PRODUCTO","","AMALANCETILLA","2023-08-19","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("35","1","PRODUCCION","MODULO DE PRODUCCION","","AMALANCETILLA","2023-08-19","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("36","1","PROVEEDORES","MODULO DE PROVEEDORES","","AMALANCETILLA","2023-08-19","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("37","1","ESTADO USUARIOS","MODULO DE ESTADOS DE USUARIO","","AMALANCETILLA","2023-11-22","","0000-00-00");
INSERT INTO tbl_ms_objetos VALUES("38","1","FORMA DE PAGO","MODULO DE FORMA DE PAGO","","AMALANCETILLA","2023-11-22","","0000-00-00");



DROP TABLE IF EXISTS tbl_ms_parametros;

CREATE TABLE `tbl_ms_parametros` (
  `Id_Parametro` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_Parametro` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Valor_Parametro` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Parametro`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_parametros VALUES("1","NUM_INTENTOS","2","Numero de intentos de acceso al sistema","AMALANCETILLA","2022-10-15","","0000-00-00");
INSERT INTO tbl_ms_parametros VALUES("2","NUM_PREGUNTAS_SECRETAS","2","Cantidad de preguntas secretas","AMALANCETILLA","2022-10-16","","0000-00-00");
INSERT INTO tbl_ms_parametros VALUES("3","NUM_DIAS_VENCIMIENTO","365","Cantidad de dias de vencimiento de usuarios","AMALANCETILLA","2022-10-20","","0000-00-00");
INSERT INTO tbl_ms_parametros VALUES("4","DIAS_VENCIMIENTO_TOKEN","5","Numero de dias vencimiento de token de correo electronico","AMALANCETILLA","2022-10-20","","0000-00-00");



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
) ENGINE=InnoDB AUTO_INCREMENT=2420 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_permisos VALUES("1147","4","1","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1148","4","2","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1149","4","3","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1150","4","4","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1151","4","5","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1152","4","20","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1153","4","21","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1154","4","22","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1155","4","23","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1156","4","24","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1157","4","25","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1158","4","26","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1159","4","29","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1332","4","30","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1464","4","31","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1542","7","1","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1543","7","2","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1544","7","3","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1545","7","4","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1546","7","5","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1547","7","20","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1548","7","21","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1549","7","22","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1550","7","23","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1551","7","24","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1552","7","25","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1553","7","26","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1554","7","29","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1555","7","30","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1556","7","31","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1785","4","32","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("1788","7","32","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2080","4","33","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2083","7","33","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2138","4","34","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2141","7","34","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2199","4","35","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2202","7","35","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2244","4","36","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2247","7","36","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2308","1","1","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2309","1","2","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2310","1","3","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2311","1","4","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2312","1","5","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2313","1","20","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2314","1","21","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2315","1","22","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2316","1","23","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2317","1","24","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2318","1","25","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2319","1","26","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2320","1","29","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2321","1","30","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2322","1","31","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2323","1","32","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2324","1","33","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2325","1","34","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2326","1","35","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2327","1","36","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2328","2","1","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2329","2","2","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2330","2","3","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2331","2","4","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2332","2","5","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2333","2","20","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2334","2","21","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2335","2","22","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2336","2","23","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2337","2","24","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2338","2","25","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2339","2","26","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2340","2","29","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2341","2","30","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2342","2","31","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2343","2","32","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2344","2","33","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2345","2","34","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2346","2","35","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2347","2","36","1","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2348","3","1","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2349","3","2","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2350","3","3","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2351","3","4","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2352","3","5","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2353","3","20","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2354","3","21","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2355","3","22","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2356","3","23","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2357","3","24","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2358","3","25","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2359","3","26","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2360","3","29","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2361","3","30","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2362","3","31","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2363","3","32","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2364","3","33","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2365","3","34","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2366","3","35","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2367","3","36","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2368","5","1","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2369","5","2","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2370","5","3","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2371","5","4","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2372","5","5","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2373","5","20","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2374","5","21","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2375","5","22","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2376","5","23","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2377","5","24","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2378","5","25","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2379","5","26","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2380","5","29","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2381","5","30","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2382","5","31","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2383","5","32","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2384","5","33","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2385","5","34","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2386","5","35","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2387","5","36","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2388","6","1","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2389","6","2","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2390","6","3","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2391","6","4","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2392","6","5","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2393","6","20","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2394","6","21","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2395","6","22","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2396","6","23","1","1","1","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2397","6","24","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2398","6","25","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2399","6","26","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2400","6","29","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2401","6","30","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2402","6","31","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2403","6","32","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2404","6","33","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2405","6","34","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2406","6","35","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2407","6","36","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2408","1","37","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2409","2","37","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2410","3","37","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2411","4","37","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2412","5","37","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2413","6","37","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2414","1","38","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2415","2","38","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2416","3","38","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2417","4","38","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2418","5","38","0","0","0","0","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_permisos VALUES("2419","6","38","0","0","0","0","","0000-00-00","","0000-00-00");



DROP TABLE IF EXISTS tbl_ms_preguntas;

CREATE TABLE `tbl_ms_preguntas` (
  `Id_Pregunta` bigint NOT NULL AUTO_INCREMENT,
  `Pregunta` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificacion` date NOT NULL,
  PRIMARY KEY (`Id_Pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_preguntas VALUES("1","¿Jugador de Futbol favorito?","AMALANCETILLA","2022-10-13","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("2","¿Canción Favorita?","AMALANCETILLA","2022-10-08","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("4","¿Nombre de la pelicula favorita?","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("5","¿Libro favorito?","AMALANCETILLA","2022-10-31","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("6","¿Amigo favorito?","AMALANCETILLA","2022-10-01","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("7","¿Cumpleaños de mi mama?","AMALANCETILLA","2022-10-31","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("8","¿Primer trabajo?","AMALANCETILLA","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_preguntas VALUES("9","¿Cumpleaños de mi mascota?","AMALANCETILLA","2022-10-31","","0000-00-00");



DROP TABLE IF EXISTS tbl_ms_preguntas_usuario;

CREATE TABLE `tbl_ms_preguntas_usuario` (
  `Id_Pregunta_Usuario` bigint NOT NULL AUTO_INCREMENT,
  `id_pregunta` bigint NOT NULL,
  `Id_Usuario` bigint NOT NULL,
  `Respuesta` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Pregunta_Usuario`),
  KEY `Id_Usuario` (`Id_Usuario`),
  KEY `id_pregunta` (`id_pregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




DROP TABLE IF EXISTS tbl_ms_rol;

CREATE TABLE `tbl_ms_rol` (
  `Id_Rol` bigint NOT NULL AUTO_INCREMENT,
  `Nombre_Rol` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Descripcion_Rol` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `estado_rol` int NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_rol VALUES("1","Programadores","Programadores","1","","2022-10-06","","0000-00-00");
INSERT INTO tbl_ms_rol VALUES("2","Administradores","Rol para los administradores","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_rol VALUES("3","Vendedor","Rol para los vendedores","1","","0000-00-00","","0000-00-00");
INSERT INTO tbl_ms_rol VALUES("4","Default","Rol para usuarios default","1","","2022-11-01","","0000-00-00");
INSERT INTO tbl_ms_rol VALUES("5","Supervisores","Rol para los supervisores","1","","0000-00-00","","0000-00-00");
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
  `Correo_Electronico` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Ult_Conexion` date NOT NULL,
  `Fecha_Vencimiento` date NOT NULL,
  `Preguntas_Contestadas` int NOT NULL,
  `intentos_acceso` int NOT NULL,
  `Procedencia` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `Id_Rol` (`Id_Rol`),
  KEY `id_estado_usuario` (`id_estado_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_ms_usuarios VALUES("1","1","1","AMALANCETILLA","d85fb61a933e0b8a45f88c89888502573a3d318657a576ef5529bf948b98882c","0","995481","tela","empresa.amalancetilla23@gmail.com","0000-00-00","2024-07-03","0","0","0");



DROP TABLE IF EXISTS tbl_pedidos;

CREATE TABLE `tbl_pedidos` (
  `Id_Pedido` bigint NOT NULL AUTO_INCREMENT,
  `Id_Cliente` bigint NOT NULL,
  `Id_Usuario` bigint NOT NULL,
  `Id_Estado_Pedido` bigint NOT NULL,
  `Nombre_Empleado` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Hora` date NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Direccion_envio` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Costo_envio` decimal(10,2) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




DROP TABLE IF EXISTS tbl_produccion;

CREATE TABLE `tbl_produccion` (
  `Id_Produccion` int NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `Estado_Produccion` int NOT NULL,
  `Id_Usuario` bigint DEFAULT NULL,
  PRIMARY KEY (`Id_Produccion`),
  KEY `tbl_Produccion_tbl_ms_Usuarios_idx` (`Id_Usuario`),
  CONSTRAINT `tbl_Produccion_tbl_ms_Usuarios` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;




DROP TABLE IF EXISTS tbl_productos;

CREATE TABLE `tbl_productos` (
  `Id_Producto` bigint NOT NULL AUTO_INCREMENT,
  `Id_Categoria` bigint NOT NULL,
  `Nombre` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codigo` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Id_ISV` bigint NOT NULL,
  `Descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




DROP TABLE IF EXISTS tbl_promociones;

CREATE TABLE `tbl_promociones` (
  `Id_Promociones` bigint NOT NULL AUTO_INCREMENT,
  `Id_Producto` bigint NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Final` date NOT NULL,
  `Cantidad_Promocion` int NOT NULL,
  PRIMARY KEY (`Id_Promociones`),
  KEY `Id_Producto` (`Id_Producto`),
  KEY `Precio` (`Precio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




DROP TABLE IF EXISTS tbl_promociones_pedidos;

CREATE TABLE `tbl_promociones_pedidos` (
  `Id_Promociones_Pedidos` bigint NOT NULL AUTO_INCREMENT,
  `Id_Promociones` bigint NOT NULL,
  `Id_Pedido` bigint NOT NULL,
  `Cantidad` int NOT NULL,
  `Precio_Venta` decimal(10,2) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;




DROP TABLE IF EXISTS tbl_proveedor;

CREATE TABLE `tbl_proveedor` (
  `Id_Proveedor` int NOT NULL AUTO_INCREMENT,
  `Nombre_Proveedor` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `RTN_Proveedor` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Telefono_Proveedor` int NOT NULL,
  `Correo_Proveedor` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Direccion_Proveedor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Id_Proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




DROP TABLE IF EXISTS tbl_reinicio_contrasena;

CREATE TABLE `tbl_reinicio_contrasena` (
  `Id_Reinicio_Contrasena` bigint NOT NULL AUTO_INCREMENT,
  `Id_Usuario` bigint NOT NULL,
  `Correo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Token` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Vencimiento` date NOT NULL,
  `Creado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Modificado_Por` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha_Modificado` date NOT NULL,
  PRIMARY KEY (`Id_Reinicio_Contrasena`),
  KEY `Id_Usuario` (`Id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO tbl_reinicio_contrasena VALUES("1","1","empresa.amalancetilla23@gmail.com","","2023-07-09","","0000-00-00","","0000-00-00");



DROP TABLE IF EXISTS tbl_tipo_inventario;

CREATE TABLE `tbl_tipo_inventario` (
  `Id_tipo_movimiento` int NOT NULL AUTO_INCREMENT,
  `Nombre_movimiento` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`Id_tipo_movimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO tbl_tipo_inventario VALUES("1","ENTRADA");
INSERT INTO tbl_tipo_inventario VALUES("2","SALIDA");
INSERT INTO tbl_tipo_inventario VALUES("3","DEV. VENTA");
INSERT INTO tbl_tipo_inventario VALUES("4","DEV. COMPRA");
INSERT INTO tbl_tipo_inventario VALUES("5","ELABORACION PRODUCTO");
INSERT INTO tbl_tipo_inventario VALUES("6","CONSUMO PRODUCTO");
INSERT INTO tbl_tipo_inventario VALUES("7","CANCEL ELABORACION");
INSERT INTO tbl_tipo_inventario VALUES("8","CANCEL CONSUMO");



SET FOREIGN_KEY_CHECKS=1;