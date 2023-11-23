<?php 
	
	define("BASE_URL", "http://localhost/amalancetilla/");
	//const BASE_URL = "https:///";

	//Zona horaria
	date_default_timezone_set('America/Tegucigalpa');

	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "amalancetilla_bd";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "charset=utf8";

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";
	
	const DIRECCION ="Tela";
	const TELEMPRESA = "+504 9999-9999";
	const NOMBRE_EMPESA = "AMALANCETILLA";
	const EMAIL_EMPRESA = "empresa.amalancetilla23@gmail.com";
	const STATUS = array('Completado','Pendiente','Cancelado',);
	//Simbolo de moneda
	const SMONEY = "L";

	//modulos
	const MPARAMETROS = 1;//terminado
	CONST MBACKUP = 20;
	CONST MCLIENTES = 3;//terminado
	CONST MRESTORE = 21;
	CONST MBITACORA = 22;
	CONST MROLES = 24;
	CONST MUSUARIOS =2 ;
	CONST BPREGUNTAS = 23;
	CONST MCATEGORIAS = 5;
	CONST MPRODUCTOS = 4;
	const CAT_BANNER = "1,2,3,11,12,14,13,15,16,18,19,20,21,22";
	const COSTOENVIO = 70;
	const CAT_FOOTER = "1,2,3,4,5";
	CONST MINVENTARIO = 30;
	CONST MIMPUESTO = 31;
	CONST MPEDIDOS = 25;
	CONST MCOMPRAS = 32;
	CONST MDESCUENTOS = 29;
	CONST MESTADOPEDIDOS =33;
	CONST MMOVIMIENTO = 34;
	CONST MPRODUCCION = 35;
	CONST MPROMOCIONES = 26;
	CONST MPROVEEDORES = 36;
	CONST MESTADOSUSUARIO = 37;
	CONST MFORMADEPAGO = 38;
	//Datos envio de correo electronico

	const NOMBRE_REMITENTE = "Amalancetilla";
	const EMAIL_REMITENTE = "no-replay@amalancetilla.com";

	const NOMBRE_EMPRESA = "Amalancetilla";
	const WEB_EMPRESA = "www.amalancetilla.com";