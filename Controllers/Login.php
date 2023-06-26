<?php

class Login extends Controllers
{
	public function __construct()
	{
		session_start();

		if (isset($_SESSION['login'])) { //validamos si existe la variable de session que seria login y lo que va hacer es redireccionar al login 
			header('Location: ' . base_url() . '/dashboard'); //muestra la vista 
		}

		parent::__construct();
	}
	public function login()
	{

		$_SESSION['id_usuario'] = "";
		$data['page_id'] = 2;
		$data['page_tag'] = "Login";
		$data['page_title'] = "";
		$data['page_name'] = "";
		$data['page_functions_js'] = "functions_login.js";
		$this->views->getView($this, "login", $data);
	}
	public function loginUser()
	{
		//dep($_POST);
		if ($_POST) { // SI SE REALIZA UNA PETICION POST
			if (empty($_POST['txtEmail']) || empty($_POST['txtPasswordl'])) { //valida que los textbox esten vacios y manda msj de error
				$arrResponse = array('status' => false, 'msg' => 'Error de datos');
			} else { //si no estan vacios
				$strUsuario = strtolower(strClean($_POST['txtEmail'])); //obtiene el correo electronico en minisculas en caso de que este en mayusculas 
				$strPassword = hash("SHA256", $_POST['txtPasswordl']); //encripta la contrasena
				$requestUser = $this->model->loginUser($strUsuario, $strPassword);
				$requestEstado = $this->model->getEstado($strUsuario);
				//dep($requestUser);
				if (!empty($requestUser) and $requestEstado['id_estado_usuario'] == 4 ) {
					$arrResponse = array('status' => false, 'msg' => 'Usuario bloqueado, por favor contactar con el administrador');
				} else {

					$requestUser = $this->model->loginUser($strUsuario, $strPassword); //en la variable requestUser va almacenar lo que este en la funcion loginUser del modelo y se envia como parametro el usuario y la contrasena
					if (empty($requestUser)) {
						$strGetIntentos = $this->model->getUsuario1($strUsuario); //consulta la cantidad de intentos del usuario
						$strGetParametro =  $this->model->getParametroIntentos(); //obtenemos el valor del parametro de intentos de acceso
						$strGetUser = $this->model->getUsuario1($strUsuario);
						if (empty($strGetUser)) {

							$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecta');
						} else {

							if ($strGetIntentos['intentos_acceso'] >= $strGetParametro['valor_parametro'] && $requestEstado['id_usuario'] != 1) {
								$arrResponse = array('status' => false, 'msg' => 'Usuario bloqueado, por favor contactar con el administrador o cambie de contraseña');
								$estado = 4;
								$insertBloqueo = $this->model->EstadoUser($strUsuario, $estado); //le actualiza el estado al usuario, le coloca 2 que significa que esta bloqueado por intentos fallidos
								/////////////bitacora
								$fecha_actual = (date("Y-m-d"));
								$eventoBT = "Bloqueo usuario";
								$descripcionBT = 'Se bloqueo al usuario ' . $strUsuario . ' Por intentos erroneos';

								$strUsuario = $strGetIntentos['id_usuario'];
								$objetoBT = 1; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
								$insertBitacora = $this->model->bitacora($strUsuario, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //actualiza la cantidad de intentos del usuario
								/////////////////////fin bitacora
							} else {
								$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecta');

								$intento = 1;
								$strActualizarIntentos = $this->model->updateIntentos1($strUsuario, $intento); //actualiza la cantidad de intentos del usuario
							}
						}
					} else {
						$arrData = $requestUser;
						$consulta = ($this->model->getUsuario1($strUsuario)); //obtenemos la fecha de vencimiento del usuario

						//$strFechavencimiento = strClean($_POST['txtFechavencimiento']);

						$fecha = ($consulta['fecha_vencimiento']);
						$date2 = strtotime($fecha); //
						$fecha_actual = strtotime(date("Y-m-d"));
						$strFechavencimiento = $date2;
						$request_user = "";
						$user = "Josee";

						if ($fecha_actual >= $strFechavencimiento) {

							$estado = 2;
							$insertBloqueo = $this->model->EstadoUser($strUsuario, $estado); //le actualiza el estado como inactivo 
							$arrResponse = array('status' => false, 'msg' => 'Usuario inactivo');
						} else {
							if ($arrData['id_estado_usuario'] != 2) { //si es 1 entonces es primera vez que accede al sistema
								if ($arrData['id_estado_usuario'] == 3) {

									$_SESSION['id_usuario'] = $arrData['id_usuario'];
									$strID = $arrData['id_usuario'];
									$consultaParametro = $this->model->getParametroPreguntas(); //obtenemos el valor del parametro
									$consultaCantidadPreguntas = $this->model->GetCountPreguntas($strID); //obtenemos la cantidad de preguntas contestadas
									$preguntas = $consultaCantidadPreguntas;
									if ($preguntas['count(*)'] == $consultaParametro['valor_parametro']) {
										$arrResponse = array('status' => true, 'msg' => 'mostrar cambio');
										$_SESSION['acceso_cambio'] = '1';
										$_SESSION['id_usuario'] = $strID;
									} else {
										$arrResponse = array('status' => true, 'msg' => 'mostrar preguntas');
									}
								} else { //acceso correcto al sistema


									if ($arrData['id_estado_usuario'] == 6) {
										$_SESSION['id_usuario'] = $arrData['id_usuario'];
										$arrResponse = array('status' => true, 'msg' => 'mostrar default');
									} else {
										$intento = 0;
										$strActualizarIntentos = $this->model->updateIntentos($strUsuario, $intento); //actualiza la cantidad de intentos del usuario
										$_SESSION['id_usuario'] = $arrData['id_usuario'];
										/////////////bitacora
										$fecha_actual = (date("Y-m-d"));
										$eventoBT = "Acceso al sistema";
										$descripcionBT = "Accedio correctamente al sistema";
										$strUsuario = $_SESSION['id_usuario'];
										$arrData = $this->model->sessionLogin($strUsuario);
									
										
										$objetoBT = 1; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
										$insertBitacora = $this->model->bitacora($strUsuario, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //actualiza la cantidad de intentos del usuario
										/////////////////////fin bitacora
										$_SESSION['login'] = true;
										$_SESSION['id_usuario'] = $strUsuario;
										$arrResponse = array('status' => true, 'msg' => 'ok');
									}
								}
							} else {
								if ($arrData['id_estado_usuario'] == 2  && $requestEstado['id_usuario'] != 1) {

									$arrResponse = array('status' => false, 'msg' => 'Usuario Inactivo');
								} else {
									$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecta');
								}
							}
						}
					}
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

		die();
	}

	public function resetPass()
	{
		$_SESSION['ResetPassPreguntas'] = 0;
		if ($_POST) {

			if (empty($_POST['txt_correo_reiniciar'])) { //validar que el campo del correo no este vacio
				$arrResponse = array('status' => false, 'msg' => 'Error de datos');
			} else {
				$token = token(); //almacena el valor del token que se genera en la funcion token
				$strEmail = strtolower(strClean($_POST['txt_correo_reiniciar'])); //la funcion strlower convierte todos los valores de txt en minusculas y strClean limpia los campos que intentan hacer una consulta sql
				$arrData = $this->model->getUserEmail($strEmail); //envia como parametro el email al metodo getUserEmail del modelo	
				if (empty($arrData)) {

					$arrResponse = array('status' => false, 'msg' => 'No existe un usuario asociado con este correo');
				} else {
					if ($arrData['id_estado_usuario'] == 0) {
						$arrResponse = array('status' => false, 'msg' => 'Usuario bloqueado, por favor contactar con el administrador');
					} else {

						$id_Usuario = $arrData['id_usuario'];
						$nombreUsuario = $arrData['Nombre'];

						$url_recovery = base_url() . '/login/confirmUser/' . $strEmail . '/' . $token;
						$fechaVencimiento =

							$parametro = ($this->model->getParametroFechaVencimientoToken()); //obtenemos el valor del parametro de intentos de acceso

						//$strFechavencimiento = strClean($_POST['txtFechavencimiento']);

						$fecha = strval($parametro['valor_parametro']);
						$date2 = (date("Y-m-d", strtotime($fecha . 'days'))); //
						$fecha_actual = strtotime(date("d-m-Y H:i:00", time()));
						$strFechavencimiento = $date2;

						$requestUpdate = $this->model->setTokenUser($id_Usuario, $token, $strFechavencimiento);

						$dataUsuario = array(
							'nombreUsuario' => $nombreUsuario,
							'email' => $strEmail,
							'asunto' => 'Recuperar cuenta - ' . NOMBRE_REMITENTE,
							'url_recovery' => $url_recovery
						);

						if ($requestUpdate) {


							$sendEmail = sendMailLocal($dataUsuario, 'email_cambioPassword');

							//var_dump($sendEmail);
							//	exit;
							if ($sendEmail) {
								$arrResponse = array('status' => true, 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar la contraseña');


								/////////////bitacora
								$fecha_actual = (date("Y-m-d"));
								$eventoBT = "Se envio correo";
								$descripcionBT = 'Se envío correo a ' . $strEmail;

								$objetoBT = 1; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
								$insertBitacora = $this->model->bitacora($id_Usuario, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //actualiza la cantidad de intentos del usuario
								/////////////////////fin bitacora

							} else {
								$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta mas tarde');
							}
						} else {
							$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta mas tarde');
						}
					}
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function resetPassPreguntas()
	{
		if ($_POST) {
			if (empty($_POST['txt_correo_reiniciar'])) { //validar que el campo del correo no este vacio
				$arrResponse = array('status' => false, 'msg' => 'Error de datos');
			} else {

				$strEmail = strtolower(strClean($_POST['txt_correo_reiniciar'])); //la funcion strlower convierte todos los valores de txt en minusculas y strClean limpia los campos que intentan hacer una consulta sql
				$arrData = $this->model->getUserEmail($strEmail); //envia como parametro el email al metodo getUserEmail del modelo	


				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'No existe un usuario asociado con este correo');
				} else {


					if ($arrData['id_estado_usuario'] == 0) {
						$arrResponse = array('status' => false, 'msg' => 'Usuario bloqueado, por favor contactar con el administrador o reinicie contrasena');
					} else {
						$id_Usuario = $arrData['id_usuario'];
						$nombreUsuario = $arrData['Nombre'];
						$url_recovery = base_url() . '/login/ConfirmPassPreguntas/' . $strEmail;

						$arrResponse = array('status' => true, 'msg' => 'existe un usuario asociado con este correo');
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
				die();
			}
		}
	}
	public function ConfirmarPregunta() // con esta funcion vamos a validar que la respuesta a la pregunta sea la misma que esta en la base de datos
	{
		if ($_POST) {


			if (empty($_POST['txtRespuestaPregunta'])) { //validar que el campo de la respuesta no este vacio
				$arrResponse = array('status' => false, 'msg' => 'Debe ingresar la respuesta de su pregunta');
			} else {


				$strUsuario = $_POST['id_Usuario'];
				$strPregunta = (strClean($_REQUEST['form_list_preguntas'])); //obtenemos el valor de la pregunta
				$strRespuesta = (strClean($_POST['txtRespuestaPregunta'])); //la funcion strlower convierte todos los valores de txt en minusculas y strClean limpia los campos que intentan hacer una consulta sql

				$arrData = $this->model->selectRespuestaPreguntas($strUsuario, $strPregunta, $strRespuesta); //envia como parametro el email al metodo getUserEmail del modelo	


				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Respuesta incorrecta');
				} else {
					if ($arrData['Respuesta'] == $strRespuesta) {


						$_SESSION['acceso'] = '1';
						$_SESSION['id_usuario'] = $strUsuario;

						$arrResponse = array('status' => true, 'msg' => 'Respuesta correcta');
					} else {

						$arrResponse = array('status' => false, 'msg' => 'Error de datos');
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}

	public function ConfirmPassPreguntas(string $params)
	{
		if (empty($params)) {
			header('Location: ' . base_url()); //regresa a la ruta raiz del proyecto si no hay parametro
		} else {

			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$strEmail = strClean($arrParams[0]); //valor del arreglo en la posicion 0

			$arrData = $this->model->getUserEmail($strEmail); //envia como parametro el email al metodo getUserEmail del modelo	

		}
		if (empty($arrData)) {

			$arrResponse = array('status' => false, 'msg' => 'No existe un usuario asociado con este correo');
		} else {

			$arrResponse = $this->model->getUsuario1($strEmail);
			$data['nombre'] = $arrResponse['nombre'];
			$data['id_usuario'] = $arrResponse['id_usuario'];
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this, "preguntas_cambio_contraseña", $data);
		}

		die();
	}
	//////////////////////////////////////////////---------------> PARTE HECHA POR CHEYLA
	public function ConfirmPrimera()
	{
		if (empty($_SESSION['id_usuario'])) {
			header('Location: ' . base_url() . '/login'); //muestra la vista 
		} else {
			$id_user = $_SESSION['id_usuario'];
			$arrData = $this->model->getUsuarioP($id_user); //envia como parametro el email al metodo getUserEmail del modelo	

			$data['Nombre'] = $arrData['nombre'];
			$data['page_name'] = "";
			$data['email'] = $arrData['correo_electronico'];
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this, "preguntas_primeringreso", $data);
		}
	}
	public function Default() //para usuarios default
	{
		if (empty($_SESSION['id_usuario'])) {
			header('Location: ' . base_url() . '/login'); //muestra la vista 
		} else {
			$id_user = $_SESSION['id_usuario'];
			$arrData = $this->model->getUsuarioP($id_user); //envia como parametro el email al metodo getUserEmail del modelo	

			$data['Nombre'] = $arrData['nombre'];
			$data['page_name'] = "";
			$data['email'] = $arrData['correo_electronico'];
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this, "default", $data);
		}
	}
	public function setPreguntasP()
	{ //con este metodo guardamos las preguntas y respuestas del usuarion en la BD

		$consultaParametro = $this->model->getParametroPreguntas(); //obtenemos el valor del parametr 

		if (empty($_POST['email'])) { //valida que todos los campos esten llenos
			$arrResponse = array(
				'status' => false,
				'msg' => 'Error de datos'
			);
		} else {

			$strRespuesta = strClean($_POST['txt_Respuesta']);
			if ($strRespuesta == "") {
				$arrResponse = array('status' => false, 'msg' => 'Por favor ingrese la  Respuesta');
			} else {
				$id_pregunta = (strClean($_REQUEST['form_list_preguntasP']));
				$strEmail = $_POST['email'];
				$strConsultaID = $this->model->getUsuario1($strEmail);
				$strID = $strConsultaID['id_usuario'];
				//dep($id_pregunta);
				//	die();
				$consultaCantidadPreguntas = $this->model->GetCountPreguntas($strID);
				$preguntas = $consultaCantidadPreguntas;
				//dep($preguntas['count(*)']);
				//	die();

				if ($preguntas['count(*)'] < $consultaParametro['valor_parametro']) {

					$requestPass = $this->model->insertPreguntasP($strID, $id_pregunta, $strRespuesta);

					if ($requestPass) {
						$consultaCantidadPreguntas = $this->model->GetCountPreguntas($strID);
						$preguntas = $consultaCantidadPreguntas;

						if ($preguntas['count(*)'] == $consultaParametro['valor_parametro']) {

							$arrResponse = array('status' => true, 'msg' => 'Preguntas guardadas correctamente');
							$_SESSION['acceso_cambio'] = '1';
							$_SESSION['id_usuario'] = $strID;
							$PrimerI = 1;
							//$requestPass = $this->model->updateprimeravez($PrimerI, $strID);
							//$_SESSION['login'] = true;

						} else {

							$arrResponse = array('status' => true, 'msg' => 'Pregunta Guardada :D');
						}
					} else {
						$arrResponse = array('status' => false,'msg' => 'No es posible realizar el proceso, intente mas tarde');
					}
				} elseif ($preguntas['count(*)'] = $consultaParametro['valor_parametro']) {
					/////////////bitacora
					$fecha_actual = (date("Y-m-d"));
					$eventoBT = "Registro preguntas secretas primer ingreso";
					$descripcionBT = 'Se registraron las preguntas de  ' . $strEmail;

					$objetoBT = 1; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
					$insertBitacora = $this->model->bitacora($strID, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //actualiza la cantidad de intentos del usuario
					/////////////////////fin bitacora

					$arrResponse = array('status' => true, 'msg' => 'Preguntas guardadas correctamente');
					$_SESSION['acceso_cambio'] = '1';
					$_SESSION['id_usuario'] = $strID;
				}
			}
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}
	/////////////////////////////////////////////////////------------->FIN DE PARTE HECHA POR CHEYLA
	public function confirmUser(string $params)
	{ //confirma que el usuario ingresado exista en la base de datos, si es verdadero entonces le muestra la vista del cambio de contraseña
		if (empty($params)) {
			header('Location: ' . base_url()); //regresa a la ruta raiz del proyecto si no hay parametro
		} else {
			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$strEmail = strClean($arrParams[0]); //valor del arreglo en la posicion 0
			$strToken = strClean($arrParams[1]); //valor del arreglo en la posicion 1

			$arrResponse = $this->model->getUsuario($strEmail, $strToken);
			$arrData = $this->model->getUserEmail($strEmail); //envia como parametro el email al metodo getUserEmail del modelo	
			$nombreUsuario = $arrData['Nombre'];

			if (empty($arrResponse)) {
				header("Location: " . base_url());
			} else {
				$parametro = ($this->model->getFechaVencimiento($strEmail)); //obtenemos el valor del parametro de intentos de acceso

				//$strFechavencimiento = strClean($_POST['txtFechavencimiento']);

				$fecha = ($parametro['fecha_vencimiento']);
				$date2 = strtotime($fecha); //
				$fecha_actual = strtotime(date("Y-m-d"));
				$strFechavencimiento = $date2;
				$request_user = "";
				$user = "Josee";
				if ($fecha_actual >= $strFechavencimiento) {
					//header('Location: ' . base_url().'/TokenVencido'); //regresa a la ruta raiz del proyecto si no hay parametro
					echo "Su token de reestablecimiento de contraseña a caducado.";
				} else {
					$_SESSION['ResetPassPreguntas'] = 1;
					$data['page_name'] = "cambiar_contraseña";
					$data['page_tag'] = "cambiar contrasña";
					$data['page_title'] = "Cambiar contraseña";
					$data['id_usuario'] = $arrResponse['id_usuario'];
					$data['Email'] = $strEmail;
					$data['Token'] = $strToken;
					$data['nombre'] = $nombreUsuario;
					$data['page_functions_js'] = "functions_login.js";
					$this->views->getView($this, "cambio_contraseña", $data);
				}
			}
		}
		die();
	}

	public function confirmCambioContrasena2() //esta funcion muestra la pantalla para realizar el cambio de contraseñan por medio de preguntas de seguridad
	{
		$acceso = $_SESSION['acceso']; //a la variable acceso le asignamos el valor de la variable session[accesso] que viene de la varidacion de la otra funcion confirmPregunta
		// donde validamos si la respuesta de la pregunta es correta y le asigamos el valor de 1 si es correcto
		if ($acceso == '1') { //si obtiene 1 muestra la vista
			$_SESSION['ResetPassPreguntas'] = 1;
			$user = $_SESSION['id_usuario'];
			$consulta = $this->model->ObtenerUsuario($user);
			$data['id_usuario'] = $_SESSION['id_usuario'];
			$data['Email'] = "";
			$data['Token'] = "";
			$data['nombre'] = $consulta['Nombre'];
			$data['page_functions_js'] = "functions_login.js";
			$data['page_name'] = "cambiar_contraseña";
			$data['page_tag'] = "cambiar contrasña";
			$data['page_title'] = "Cambiar contraseña";
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this, "cambio_contraseña", $data);
			$_SESSION['acceso'] = '0'; //al cerrar la vista le damos el valor de 0  a esta variable para que no redireccione la vista
		} else {

			header('Location: ' . base_url()); //regresa a la ruta raiz del proyecto si no hay parametro
		}
		die();
	}
	public function CambioPassword() //esta funcion muestra la pantalla para realizar el cambio de contraseñan para usuarios que sea primer acceso
	{
		$acceso = $_SESSION['acceso_cambio']; //a la variable acceso le asignamos el valor de la variable session[accesso] que viene de la validacion de la otra funcion confirmPregunta
		// donde validamos si la respuesta de la pregunta es correta y le asigamos el valor de 1 si es correcto
		if ($acceso == '1') { //si obtiene 1 muestra la vista

			$user = $_SESSION['id_usuario'];
			$consulta = $this->model->ObtenerUsuario($user);
			$data['id_usuario'] = $_SESSION['id_usuario'];
			$data['nombre'] = $consulta['Nombre'];
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this, "cambio_contraseña_primera", $data);

			$_SESSION['acceso_cambio'] = '0'; //al cerrar la vista le damos el valor de 0  a esta variable para que no redireccione la vista
		} else {
			header('Location: ' . base_url()); //regresa a la ruta raiz del proyecto si no hay parametro
		}
		die();
	}

	public function setPasswordPrimera() // funcion para enviar la contraseña a la la bd de la primera session
	{
		if (empty($_POST['id_Usuario']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'] || empty($_POST['txtPasswordAnterior']))) { //valida que todos los campos esten llenos
			$arrResponse = array(
				'status' => false,
				'msg' => 'Error de sdatos'
			);
		} else {
			$intIdusuario = intval($_POST['id_Usuario']); //intval convierte a entero la variable
			$strPassword =  strClean(hash("SHA256", $_POST['txtPassword']));
			$strPasswordConfirm =  strClean(hash("SHA256", $_POST['txtPasswordConfirm']));
			$strPasswordAnterior = strClean(hash("SHA256", $_POST['txtPasswordAnterior']));

			if ($strPassword != $strPasswordConfirm) { //valida que las contraseñas sean iguales
				$arrResponse = array('status' => false, 'msg' => 'Las contraseñas no son iguales');
			} else {

				$arrResponseUser = $this->model->getUsuarioP($intIdusuario); //consultamos que el correo y el token esten dentro de la base de datos
				if ($arrResponseUser['contrasena'] != $strPasswordAnterior) {
					$arrResponse = array('status' => false, 'msg' => 'contraseña anterior es incorrecta ');
				} else {

					if ($arrResponseUser['contrasena'] == $strPassword) {
						$arrResponse = array('status' => false, 'msg' => 'La contraseña debe ser distinta a la anterior.');
					} else {
						$strPassword = ($strPassword); // para encriptar contraseña
						$requestPass = $this->model->insertPassword($intIdusuario, $strPassword);

						if ($requestPass) {
							$requestEstado = $this->model->ObtenerUsuario($intIdusuario); //obtener el estado del usuario y correo

							if ($requestEstado['id_estado_usuario'] != 3) { //validamos que el usuario no sea nuevo, si es nuevo no le debe actualizar el estado hasta que haya completado las preguntas y nueva contra
								$estado = 1;
								$insertBloqueo = $this->model->EstadoUser($requestEstado['Correo_Electronico'], $estado); //le actualiza el estado como activo
							} else {
								$ID = 1;
								$requestPass = $this->model->updateprimeravez($ID, $intIdusuario);
							}

							// actualizar la fecha de vencimiento

							$parametro = ($this->model->getParametroFechaVencimiento()); //obtenemos el valor del parametro de intentos de acceso

							//$strFechavencimiento = strClean($_POST['txtFechavencimiento']);

							$fecha = strval($parametro['valor_parametro']);
							$date2 = date("Y-m-d", strtotime($fecha . 'days')); //

							$strFechavencimiento = $date2;

							$updateFechaVencimiento = $this->model->updateFechaVencimiento($strFechavencimiento, $intIdusuario);
							$insertHistorial = $this->model->SetHistContrasena($strPassword, $intIdusuario);

							/////////////bitacora
							$fecha_actual = (date("Y-m-d"));
							$eventoBT = "Cambio de contraseña";
							$descripcionBT = 'Se cambio la contraseña de primer acceso al sistema';

							$objetoBT = 1; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
							$insertBitacora = $this->model->bitacora($intIdusuario, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //actualiza la cantidad de intentos del usuario
							/////////////////////fin bitacora

							$arrResponse = array('status' => true, 'msg' => 'Contraseña actualizada con exito');
						} else {
							$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intente mas tarde');
						}
					}
				}
			}
		}

		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}
	public function setPassword() // funcion para enviar la contraseña a la la bd
	{
		if (empty($_POST['id_Usuario']) || empty($_POST['txt_email']) || empty($_POST['txt_token']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm']) and $_SESSION['ResetPassPreguntas'] != 1) { //valida que todos los campos esten llenos
			$arrResponse = array('status' => false, 'msg' => 'Error de datos');
		} else {
			$intIdusuario = intval($_POST['id_Usuario']); //intval convierte a entero la variable
			$strPassword =  hash("SHA256", $_POST['txtPassword']);
			$strPasswordConfirm = hash("SHA256", $_POST['txtPassword']);
			$strEmail = strClean($_POST['txt_email']);
			$strToken = strClean($_POST['txt_token']);
			if ($strPassword != $strPasswordConfirm) { //valida que las contraseñas sean iguales
				$arrResponse = array('status' => false, 'msg' => 'Las contraseñas no son iguales');
			} else {
				$arrResponseUser = $this->model->getUsuario($strEmail, $strToken); //consultamos que el correo y el token esten dentro de la base de datos
				if (empty($arrResponseUser) and $_SESSION['ResetPassPreguntas'] != 1) {
					$arrResponse = array(
						'status' => false,
						'msg' => 'Error de datos '
					);
				} else {

					$arrResponseUser = $this->model->getUsuarioP($intIdusuario); //consultamos que el correo y el token esten dentro de la base de datos
					if ($arrResponseUser['contrasena'] == $strPassword) {
						$arrResponse = array('status' => false, 'msg' => 'La contraseña debe ser distinta a la anterior.');
					} else {

						$strPassword = ($strPassword); // para encriptar contraseña
						$requestPass = $this->model->insertPassword($intIdusuario, $strPassword);
						$requestEstado = $this->model->ObtenerUsuario($intIdusuario); //obtener el estado del usuario y correo
						if ($requestPass) {
							if ($requestEstado['id_estado_usuario'] != 3) { //validamos que el usuario no sea nuevo, si es nuevo no le debe actualizar el estado hasta que haya completado las preguntas y nueva contra
								$estado = 1;
								$insertBloqueo = $this->model->EstadoUser($requestEstado['Correo_Electronico'], $estado); //le actualiza el estado como activo
							} else {
								$ID = 1;
								$requestPass = $this->model->updateprimeravez($ID, $intIdusuario);
							}

							// actualizar la fecha de vencimiento
							$parametro = ($this->model->getParametroFechaVencimiento()); //obtenemos el valor del parametro de intentos de acceso
							//$strFechavencimiento = strClean($_POST['txtFechavencimiento']);
							$fecha = strval($parametro['valor_parametro']);
							$date2 = date("Y-m-d", strtotime($fecha . 'days')); //

							$strFechavencimiento = $date2;
							$updateFechaVencimiento = $this->model->updateFechaVencimiento($strFechavencimiento, $intIdusuario);
							$insertHistorial = $this->model->SetHistContrasena($strPassword, $intIdusuario);
							/////////////bitacora
							$fecha_actual = (date("Y-m-d"));
							$eventoBT = "Cambio de contraseña";
							$descripcionBT = 'Se cambio la contraseña ' . $strEmail;

							$objetoBT = 1; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
							$insertBitacora = $this->model->bitacora($intIdusuario, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //actualiza la cantidad de intentos del usuario
							/////////////////////fin bitacora
							$arrResponse = array('status' => true, 'msg' => 'Contraseña actualizada con exito');
							$estado = 1;
								$insertBloqueo = $this->model->EstadoUser($intIdusuario, $estado); //le actualiza el estado al usuario, le coloca 2 que significa que esta bloqueado por intentos fallidos
						} else {
							$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intente mas tarde');
						}
					}
				}
			}
		}
		$_SESSION['ResetPassPreguntas'] != 0;
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}
	public function getSelectPreguntas() //con esta funcion listamos las preguntas del usuario
	{
		$htmlOptions = "";
		$arrData = $this->model->selectPreguntas();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				$htmlOptions .= '<option value="' . $arrData[$i]['id_pregunta'] . '">' . $arrData[$i]['pregunta'] . '</option>';
			}
		}
		echo $htmlOptions; //muestra en un select las preguntas
		die();
	}
}