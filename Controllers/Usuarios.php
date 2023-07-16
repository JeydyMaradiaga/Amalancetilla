<?php
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class Usuarios extends Controllers
{
	public function __construct()
	{

		parent::__construct();
		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
			die();
		}
		getPermisos(MUSUARIOS);
	}

	public function Usuarios()
	{


		if (empty($_SESSION['permisosMod']['Permiso_Get'] ||  $_SESSION['userData']['id_usuario'] == 1)) {
			header("Location:" . base_url() . '/dashboard');
		}
		$data['page_id'] = 2;
		$data['page_tag'] = "usuarios - Amalancetilla";
		$data['page_title'] = "usuarios-  Amalancetilla";
		$data['page_name'] = "usuarios";
		$this->views->getView($this, "usuarios", $data);
	}

	//creacion del metodo setUsuario que llamamos en functions_usuarios
	public function setUsuario()
	{
		if ($_POST) {

			//validacion de todos los datos fueron enviados	
			if (empty($_POST['listRolid']) || empty($_POST['txtNombre']) || empty($_POST['txtcontrasena']) || empty($_POST['txtcontrasenaC']) || empty($_POST['txtestado']) || empty($_POST['txtTelefono']) || empty($_POST['txtDireccion']) ||  empty($_POST['txtEmail'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else { //limpiar los datos 
				$idUsuario = intval($_POST['idUsuario']);
				$strrolusuario = intval(strClean($_POST['listRolid']));
				$strNombre = ucwords(strClean($_POST['txtNombre']));
				// falta contrasena
				$intTelefono = intval(strClean($_POST['txtTelefono']));
				$strDireccion = ucwords(strClean($_POST['txtDireccion']));

				$strEmail = strtolower(strClean($_POST['txtEmail']));
				$strstatus = 3;
				$strContrasena = (strClean($_POST['txtcontrasena']));
				$strConfirmContrasena = (strClean($_POST['txtcontrasenaC']));
				//$strstatus = 1;



				$parametro = ($this->model->getParametroFechaVencimiento()); //obtenemos el valor del parametro de intentos de acceso

				//$strFechavencimiento = strClean($_POST['txtFechavencimiento']);

				$fecha = strval($parametro['valor_parametro']);
				$date2 = date("Y-m-d", strtotime($fecha . 'days')); //

				$strFechavencimiento = $date2;
				$request_user = "";
				//	var_dump(date("Y-m-d", strtotime ($fecha.'days')));
				//		exit;
				if ($strContrasena != $strConfirmContrasena) {

					$arrResponse = array("status" => false, "msg" => 'Las contraseñas deben ser iguales');
				} else {

					if ($idUsuario == 0) {
						//validacion para el password
						$option = 1;
						// se encripta el password generado
						$strPassword =  empty($_POST['txtcontrasena']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtcontrasena']);

						//if($_SESSION['permisosMod']['w']){ //validacion para los permisos del usurio
						$request_user = $this->model->insertUsuario(
							$strrolusuario,
							$strNombre,
							$strPassword,
							$intTelefono,
							$strDireccion,

							$strEmail,
							$strstatus,
							$strFechavencimiento
						);
					} else { //codigo nuevo
						$option = 2;
						// se encripta el password generado
						$strPassword =  empty($_POST['txtcontrasena']) ? "" :  hash("SHA256", $_POST['txtcontrasena']); //verificar ya que trae la clave vacia y yo la mando a llamar

						//if($_SESSION['permisosMod']['w']){ //validacion para los permisos del usurio
						$request_user = $this->model->updateUsuario(
							$idUsuario,
							$strrolusuario,
							$strNombre,
							$strPassword,
							$intTelefono,
							$strDireccion,

							$strEmail,
							$strstatus,
							$strFechavencimiento
						);
					}

					if ($request_user > 0) {



						$strPasswordC = (strClean($_POST['txtcontrasena']));
						$strEmail = strtolower(strClean($_POST['txtEmail'])); //la funcion strlower convierte todos los valores de txt en minusculas y strClean limpia los campos que intentan hacer una consulta sql
						//envia como parametro el email al metodo getUserEmail del modelo	


						//$id_Usuario = $arrData['id_usuario'];
						$nombreUsuario = $strNombre;

						$url_recovery = base_url() . '/Login';


						$dataUsuario = array(
							'nombreUsuario' => $nombreUsuario,
							'email' => $strEmail,
							'password' => $strPasswordC,
							'asunto' => 'Bienvenido (a) - ' . NOMBRE_REMITENTE,
							'url_recovery' => $url_recovery
						);

						$sendEmail = sendMailLocal($dataUsuario, 'correo_bienvenida');
						//var_dump($sendEmail);
						//	exit;
						if ($request_user != 'exist') {

							$consultaId = $this->model->getUserEmail($strEmail);
							$insertReinicio = $this->model->insertReinicio($consultaId['id_usuario'], $strEmail); //usado para agregar la final a cada usuario del reinicio de contrasena
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
							/////////////bitacora
							$fecha_actual = (date("Y-m-d"));
							$eventoBT = "Agregar usuario";
							$descripcionBT = 'Se agrego el nuevo usuario ' . $strEmail . ' al sistema';


							$objetoBT = 2; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
							$insertBitacora = $this->model->bitacora($consultaId['id_usuario'], $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //actualiza la cantidad de intentos del usuario
							/////////////////////fin bitacora
						} else if ($request_user == 'exist') {
							$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');
						} else {
							$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
						}
					}
				}
			}

			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}



	//creacion del metodo setUsuario que llamamos en functions_usuarios
	public function UpdateUsuario()
	{
		if ($_POST) {
			$idUsuario = intval($_POST['idUsuarioM']);
			$strrolusuario = intval(strClean($_POST['listRolid2']));
			$strNombre = ucwords(strClean($_POST['txtNombreM']));
			$strPassword = (strClean($_POST['txtcontrasenaM']));
			$intTelefono = intval(strClean($_POST['txtTelefonoM']));
			$strDireccion = ucwords(strClean($_POST['txtDireccionM']));

			$strEmail = strtolower(strClean($_POST['txtEmailM']));
			$strstatus = 1;
			//$strstatus = 1;

			//CALCULO DE LA FECHA DE VENCIMIENTO
			$parametro = ($this->model->getParametroFechaVencimiento()); //obtenemos el valor del parametro de intentos de acceso

			//$strFechavencimiento = strClean($_POST['txtFechavencimiento']);

			$fecha = strval($parametro['valor_parametro']);
			$date2 = date("Y-m-d", strtotime($fecha . 'days')); //

			$strFechavencimiento = $date2;
			$request_user = "";

			if ($idUsuario == 1 && $strstatus != 1) {


				$arrResponse = array('status' => false, 'msg' => 'No se puede cambiar el estado a este usuario.');
			} else {

				$request_user = $this->model->updateUsuario($idUsuario, $strrolusuario, $strNombre, $strPassword, $intTelefono, $strDireccion, $strEmail, $strstatus);


				if ($request_user == true) {

					$updateReinicio = $this->model->UpdateReinicio($idUsuario, $strEmail); //usado para actualizar tambien la tabla de reinicio de contrasena
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					$intento = 0;
					$updateReinicio = $this->model->updateIntentos($idUsuario, $intento); //usado para actualizar tambien la tabla de reinicio de contrasena
					/////////////bitacora
					$fecha_actual = (date("Y-m-d"));
					$eventoBT = "Actualizar usuario";
					$descripcionBT = 'Se actualizo el  usuario ' . $strEmail . '';


					$objetoBT = 2; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
					$insertBitacora = $this->model->bitacora($idUsuario, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //actualiza la cantidad de intentos del usuario
					/////////////////////fin bitacora

				} else if ($request_user == false) { //
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el email ya existe, ingrese otro.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}

			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	//codigo para mostrar en la tabla

	public function getUsuarioR(string $params)
	{
		$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
		$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
		$data = $this->model->selectUsuarioR($contenido);
		ob_end_clean();
		$html = getFile("Template/Modals/reporteUsuarios", $data);
		$html2pdf = new Html2Pdf();
		$html2pdf->writeHTML($html);
		$html2pdf->output();


		die();
	}
	public function RegisUser() //funcion para enviar correo bienvenida
	{
		$_SESSION['ResetPassPreguntas'] = 0;
		if ($_POST) {

			if (empty($_POST['txtEmail'])) { //validar que el campo del correo no este vacio
				$arrResponse = array('status' => false, 'msg' => 'Error de datos');
			} else {

				$strEmail = strtolower(strClean($_POST['txtEmail'])); //la funcion strlower convierte todos los valores de txt en minusculas y strClean limpia los campos que intentan hacer una consulta sql
				//envia como parametro el email al metodo getUserEmail del modelo	
				$strPassword = (strClean($_POST['txtcontrasena']));

				//$id_Usuario = $arrData['id_usuario'];
				$nombreUsuario = $strEmail;

				$url_recovery = base_url() . '/Login';


				$dataUsuario = array('nombreUsuario' => $nombreUsuario, 'email' => $strEmail, 'password' => $strPassword, 'asunto' => 'Confirmar Cuenta - ' . NOMBRE_REMITENTE, 'url_recovery' => $url_recovery);
				$sendEmail = sendEmail($dataUsuario, 'correo_bienvenida');
				//var_dump($sendEmail);
				//	exit;
				if ($sendEmail) {
					$arrResponse = array('status' => true, 'msg' => 'Se envio correo correctamente');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'No se envio correo');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}


	//Invocar el metodo  

	public function getUsuario()
	{
		$arrData = $this->model->selectUsuario();


		for ($i = 0; $i < count($arrData); $i++) {
			$btnView = '';
			$btnEdit = '';
			$btnDelete = '';
			if ($arrData[$i]['id_estado_usuario'] == '1') {
				$arrData[$i]['id_estado_usuario'] = '<span class="badge badge-success">Activo</span>';
			} elseif ($arrData[$i]['id_estado_usuario'] == '3') {
				$arrData[$i]['id_estado_usuario'] = '<span class="badge badge-info">Nuevo</span>';
			} elseif ($arrData[$i]['id_estado_usuario'] == '4') {
				$arrData[$i]['id_estado_usuario'] = '<span class="badge badge-primary">Bloqueado</span>';
			} else {

				if ($arrData[$i]['id_estado_usuario'] == '2') {
					$arrData[$i]['id_estado_usuario'] = '<span class="badge badge-danger">Inactivo</span>';
				}
			}
			if ($arrData[$i]['id_estado_usuario'] == '6') {

				$arrData[$i]['id_estado_usuario'] = '<span class="badge badge-primary">Default</span>';
			}
			if ($_SESSION['permisosMod']['Permiso_Update'] ||  $_SESSION['userData']['id_usuario'] == 1) {

				$btnEdit = '<button class="btn btn-primary  btn-sm btnEditUsuario" onClick="fntEditUsuario12(' . $arrData[$i]['id_usuario'] . ')" title="Editar usuario">Editar</button>';
			}
			if ($_SESSION['permisosMod']['Permiso_Delete'] ||  $_SESSION['userData']['id_usuario'] == 1) {

				$btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario(' . $arrData[$i]['id_usuario'] . ')" title="Eliminar usuario">Eliminar</button>';
			}
			$arrData[$i]['opciones'] = '<div class="text-center">' . $btnEdit . ' ' . $btnDelete . '</div>';
		}

		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function getUsuarioM(int $idUsuario)
	{
		$user = intval($idUsuario);
		if ($user > 0) {

			$arrData = $this->model->selectUsuarioM($user);
			if (empty($arrData)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	public function getUsuarioF()
	{
		$parametro = ($this->model->getParametroFechaVencimiento()); //obtenemos el valor del parametro de intentos de acceso
		//$strFechavencimiento = strClean($_POST['txtFechavencimiento']);
		$fecha = strval($parametro['valor_parametro']);
		$date2 = date("Y-m-d", strtotime($fecha . 'days')); //
		$strFechavencimiento = $date2;
		$arrData =	$strFechavencimiento;


		$arrResponse = array('status' => true, 'data' => $arrData);

		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

		die();
	}
	//Creacion del funcion para eliminar usuario
	public function delUsuario()
	{
		if ($_POST) {

			$intIdpersona = intval($_POST['idUsuario']);
			$requestDelete = $this->model->deleteUsuario($intIdpersona);
			if ($requestDelete) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
			} else {

				if ($intIdpersona == 1) { //para que no elimine el super usuario
					$arrResponse = array('status' => false, 'msg' => 'Error no se puede eliminar este usuario ya que es el administrador');
				} else {

					$arrResponse = array('status' => false, 'msg' => 'Error no se puede eliminar el usuario, esta relacionado con otras tablas.');
					$estado = 5;
					$requestDelete = $this->model->updatestadodel($intIdpersona, $estado);
					/////////////bitacora
					$fecha_actual = (date("Y-m-d"));
					$eventoBT = "Eliminar usuario";
					$descripcionBT = 'Se elimino el  usuario con id ' . $intIdpersona . '';


					$objetoBT = 2; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
					$insertBitacora = $this->model->bitacora($intIdpersona, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //actualiza la cantidad de intentos del usuario
					/////////////////////fin bitacora
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	//creacion del metodo get roles
	public function getSelectRoles()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectRoles(); // lo que nos devolvera el metodo roles
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) { //validacion de los roles
				if ($arrData[$i]['estado_rol'] == 1) {
					$htmlOptions .= '<option value="' . $arrData[$i]['Id_Rol'] . '">' . $arrData[$i]['Nombre_Rol'] . '</option>'; //llamar los datos de la tabla
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	

	public function getSelectEstados()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectEstados(); // lo que nos devolvera el metodo roles
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) { //validacion de los roles

				$htmlOptions .= '<option value="' . $arrData[$i]['id_estado_usuario'] . '">' . $arrData[$i]['Nombre_estado'] . '</option>'; //llamar los datos de la tabla
			}
		}
		echo $htmlOptions;
		die();
	}
	
	
}

//
