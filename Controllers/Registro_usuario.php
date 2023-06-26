<?php 

	class Registro_usuario extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Registro_usuario()
		{
			$data['page_id'] = 4;
			$data['page_tag'] = "registro_Usuario";
			$data['page_title'] = "registro_Usuario";
			$data['page_name'] = "registro_Usuario";
			$this->views->getView($this,"registro_usuario",$data);
		}


		public function setRegistroUsuario(){
			if ($_POST) {

				//validacion de todos los datos fueron enviados	
				if (empty($_POST['txtNombre']) ||empty($_POST['txtEmail'])|| empty($_POST['txtcontrasena'])  ||  empty($_POST['txtcontrasenaM']) || empty($_POST['txtTelefono']) || empty($_POST['txtDireccion'])) {
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				} else { //limpiar los datos 
					//crear variables donde estamos almacenando

			
					$strNombre = (strClean($_POST['txtNombre']));
					$strEmail = (strClean($_POST['txtEmail']));
					$strContrasena = (strClean($_POST['txtcontrasena']));
					$strConfirmContrasena = (strClean($_POST['txtcontrasenaM']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strDireccion = ucwords(strClean($_POST['txtDireccion']));
				
					
					$parametro= ($this->model->getParametroFechaVencimiento()); //obtenemos el valor del parametro de intentos de acceso
					
			
					
					$fecha = strval($parametro['valor_parametro']);
					$date2=date("Y-m-d", strtotime ($fecha.'days')); //
					
					$strFechavencimiento= $date2; 
					$request_user = "";
		;
					if($strContrasena != $strConfirmContrasena){
	
						$arrResponse = array("status" => false, "msg" => 'Las contraseñas deben ser iguales');
	
					}else{
	
						
							$strPassword =  empty($_POST['txtcontrasena']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtcontrasena']);
		
							$strStatus = 3;
							$rol =4; 
							$request_user = $this->model->insertUsuario($rol,$strNombre, $intTelefono,  $strDireccion,$strEmail,$strStatus, $strPassword,$strFechavencimiento );
																		 
							
					
						if ($request_user > 0) {

							$strPasswordC = (strClean($_POST['txtcontrasena']));
							$strEmail = strtolower(strClean($_POST['txtEmail'])); //la funcion strlower convierte todos los valores de txt en minusculas y strClean limpia los campos que intentan hacer una consulta sql
						//envia como parametro el email al metodo getUserEmail del modelo	
					
		
							//$id_Usuario = $arrData['id_usuario'];
							$nombreUsuario = $strNombre;
	
						$url_recovery = base_url() . '/Login';
	
				
						$dataUsuario = array('nombreUsuario' => $nombreUsuario,'email' => $strEmail,'password' => $strPasswordC,'asunto' => 'Bienvenido (a) - ' . NOMBRE_REMITENTE,'url_recovery' => $url_recovery);
							
							$sendEmail = sendMailLocal($dataUsuario, 'correo_bienvenida');
							//var_dump($sendEmail);
							//	exit;
		
							if($request_user !='exist'){
								
								$consultaId = $this->model->getUserEmail($strEmail);
								$insertReinicio = $this->model->insertReinicio($consultaId['id_usuario'],$strEmail);//usado para agregar la final a cada usuario del reinicio de contrasena
								 $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
							 	/////////////bitacora
								 $fecha_actual = (date("Y-m-d"));
								 $eventoBT = "Autoregistro usuario";
								 $descripcionBT = 'Se autoregistro el  usuario ' . $strEmail . ' al sistema';
								 $objetoBT = 2; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
								 $insertBitacora = $this->model->bitacora($consultaId['id_usuario'], $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //actualiza la cantidad de intentos del usuario
								 //fin bitacora
		
							}else if ($request_user =='exist') {
								$arrResponse = array('status' => false, 'msg' => '¡Atención! el email  ya existe, ingrese otro.');
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

        

	}
 ?>