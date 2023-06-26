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
			//getPermisos(MPARAMETROS);
		}

		public function Preguntas_seguridad()
		{
		
			$data['page_id'] = 3;
			$data['page_tag'] = "Preguntas_seguridad";
			$data['page_name'] = "Preguntas_seguridad";
			$data['page_title'] = "Preguntas_seguridad";
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
					//if($_SESSION['permisosMod']['Permiso_Update'] ||  $_SESSION['userData']['id_usuario'] == 1){
						$btnEdit = '<button class="btn btn-info  btn-sm btnEditRol"onClick="fntEditParametro('.$arrData[$i]['Id_Pregunta'].')"  title="Editar">Actualizar</button>';
					//}
					//if($_SESSION['permisosMod']['Permiso_Delete'] ||  $_SESSION['userData']['id_usuario'] == 1){
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol"  onClick="fntDelParametro('.$arrData[$i]['Id_Pregunta'].')" title="Eliminar">Eliminar</button>
					</div>';
					//}
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
							$fecha = (date("Y-m-d"));
							$request_rol = $this->model->InsertParametro($strParametro,$fecha);
							$option = 1;

						}
					
					
				}else{
					//Actualizar
				
						$request_rol = $this->model->updateParametro($intParametro, $strParametro);
						$option = 2;
					
				}

				if($request_rol > 0 )
				{
					if($option == 1)
					{
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
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
				
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la pregunta.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			}
			die();
		}
		public function getParametrosR()
{
	//if($_SESSION['permisosMod']['Permiso_Get']){
		$data = $this->model->selectParametros();
		//dep($arrData );
		//die();

		ob_end_clean();
		$html = getFile("Template/Modals/reporteParametroPDF",$data);
		$html2pdf = new Html2Pdf();
		$html2pdf->writeHTML($html);
		$html2pdf->output();
	
	//}
	die();
} //fin 
		

	}
 ?>