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
	const RCLIENTES = 3;
	const DIRECCION ="Tela";
	const TELEMPRESA = "+504 9999-9999";
	const NOMBRE_EMPESA = "AMALANCETILLA";
	const EMAIL_EMPRESA = "empresa.amalancetilla23@gmail.com";
	const STATUS = array('Completado','Pendiente','Cancelado',);
	//Simbolo de moneda
	const SMONEY = "L";

	//Datos envio de correo electronico

	const NOMBRE_REMITENTE = "Amalancetilla";
	const EMAIL_REMITENTE = "no-replay@amalancetilla.com";

	const NOMBRE_EMPRESA = "Amalancetilla";
	const WEB_EMPRESA = "www.amalancetilla.com";