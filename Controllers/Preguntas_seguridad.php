<?php 
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
	class Preguntas_seguridad extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			//session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(BPREGUNTAS);
		}

		public function Preguntas_seguridad()
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get']||  $_SESSION['userData']['id_usuario'] == 1)){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 3;
			$data['page_tag'] = "Preguntas_seguridad";
			$data['page_name'] = "Preguntas_seguridad";
			$data['page_title'] = "Preguntas seguridad";
			$data['page_functions_js'] = "functions_preguntas.js";
			$this->views->getView($this,"preguntas_seguridad",$data);
		}

		public function getPreguntas()
		{
			
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData = $this->model->selectPreguntas();

				for ($i=0; $i < count($arrData); $i++) {
					if($_SESSION['permisosMod']['Permiso_Update'] ||  $_SESSION['userData']['id_usuario'] == 1){
						$btnEdit = '<button class="btn btn-info  btn-sm btnEditRol"onClick="fntEditParametro('.$arrData[$i]['Id_Pregunta'].')"  title="Editar">Actualizar</button>';
					}
					if($_SESSION['permisosMod']['Permiso_Delete'] ||  $_SESSION['userData']['id_usuario'] == 1){
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol"  onClick="fntDelParametro('.$arrData[$i]['Id_Pregunta'].')" title="Eliminar">Eliminar</button>
					</div>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			
			die();
		}

		public function getSelectRoles()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

		public function getParametrosM(int $idparametro)
		{
		
				$intidparametro = intval(strClean($idparametro));
				if($idparametro > 0)
				{
					$arrData = $this->model->selecParametro($idparametro);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			
			die();
		}
 
		public function setPregunta(){
				$intParametro = intval($_POST['idPregunta']);
				$strParametro =  strClean($_POST['txtNombreParametro']);
			
				$fecha = strClean($_POST['txtCreacionParametro']);
				$request_rol = "";
				if($intParametro == 0)
				{
					//Crear
				

						if($strParametro == "" || $fecha =""){

							$arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

						}else{
							$user = $_SESSION['userData']['Nombre'];
							$fecha = (date("Y-m-d"));
							$request_rol = $this->model->InsertParametro($strParametro,$fecha,$user);
							$option = 1;

						}
					
					
				}else{
					//Actualizar
						$user = $_SESSION['userData']['Nombre'];
						$fecha = (date("Y-m-d"));
						$request_rol = $this->model->updateParametro($intParametro, $strParametro,$user,$fecha);
						$option = 2;
					
				}

				if($request_rol > 0 )
				{
					if($option == 1)
					{
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];//aqui es el usuario que hizo el cambio
						$eventoBT = "Agregó pregunta de seguridad"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se agrego una nueva pregunta de seguridad'; //descripcion de lo que se hizo
			
			
						$objetoBT = 23; //segun la tabla objetos se agrega el dato es decir se pondra el numero indicado de los datos de la dicha tabla
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora

					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];//aqui es el usuario que hizo el cambio
						$eventoBT = "Actualizó pregunta de seguridad"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se hicieron cambios a una pregunta de seguridad'; //descripcion de lo que se hizo
			
			
						$objetoBT = 23; //segun la tabla objetos se agrega el dato es decir se pondra el numero indicado de los datos de la dicha tabla
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora
					}
				}else if($request_rol == 'exist'){
					
					$arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function delParametro()
		{
			if($_POST){
			
					$intParametro = intval($_POST['idPregunta']);
					$requestDelete = $this->model->deleteParametro($intParametro);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la pregunta');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
						$eventoBT = "Elimino pregunta de seguridad"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se elimino la pregunta de seguridad';//descripcion de lo que se hizo
			
						$objetoBT = 23; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora

					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la pregunta.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			}
			die();
		}
	

		public function getPreguntas_seguridadR(string $params){ 
			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
			$data = $this->model->selectPreguntas_seguridadR ($contenido);//aqui
			ob_end_clean();
			$html = getFile("Template/Modals/reportePreguntas_seguridadPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
		
		
		die();
		}
		

	}
 ?>