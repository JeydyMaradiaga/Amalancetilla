<?php 
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
	class Parametros extends Controllers{
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
			getPermisos(MPARAMETROS);
		}

		public function Parametros()
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get'] ||  $_SESSION['userData']['id_usuario'] == 1)){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 3;
			$data['page_tag'] = "Parametros";
			$data['page_name'] = "Parametros";
			$data['page_title'] = "Parametros";
			$data['page_functions_js'] = "functions_parametros.js";
			$this->views->getView($this,"parametros",$data);
		}

		public function getParametros()
		{
			//if($_SESSION['permisosMod']['Permiso_Get'] ||  $_SESSION['userData']['id_usuario'] == 1){
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData = $this->model->selectParametros();

				for ($i=0; $i < count($arrData); $i++) {
					//if($_SESSION['permisosMod']['Permiso_Update'] ||  $_SESSION['userData']['id_usuario'] == 1){
						$btnEdit = '<button class="btn btn-info  btn-sm btnEditRol"onClick="fntEditParametro('.$arrData[$i]['Id_Parametro'].')"  title="Editar">Actualizar</button>';
					//}
					//if($_SESSION['permisosMod']['Permiso_Delete'] ||  $_SESSION['userData']['id_usuario'] == 1){
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol"  onClick="fntDelParametro('.$arrData[$i]['Id_Parametro'].')" title="Eliminar">Eliminar</button>
					</div>';
					//}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			//}
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
			//if($_SESSION['permisosMod']['Permiso_Get'] || $_SESSION['userData']['id_usuario'] == 1 ){
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
			//}
			die();
		}

		public function setParametro(){
				$intParametro = intval($_POST['idParametro']);
				$strParametro =  strClean($_POST['txtNombreParametro']);
				$strDescipcion = strClean($_POST['txtDescripcion']);
				$valor = intval($_POST['txtValorParametro']);
				$fecha = strClean($_POST['txtCreacionParametro']);
				$request_rol = "";
				if($intParametro == 0)
				{
					//Crear
					//if($_SESSION['permisosMod']['Permiso_Insert'] ||  $_SESSION['userData']['id_usuario'] == 1){


						if($strParametro == "" || $strDescipcion == "" || $valor =="" || $fecha =""){

							$arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

						}else{
							$fecha = date("Y-m-d");
							$UsuarioBt = $_SESSION['userData']['Nombre'];
							$request_rol = $this->model->InsertParametro($strParametro, $strDescipcion,$UsuarioBt,$valor,$fecha);
							$option = 1;

						}
					
					//}
				}else{
					//Actualizar
					//if($_SESSION['permisosMod']['Permiso_Update'] ||  $_SESSION['userData']['id_usuario'] == 1){
						$fecha = date("Y-m-d");
						$UsuarioBt = $_SESSION['userData']['Nombre'];
						$request_rol = $this->model->updateParametro($intParametro, $strParametro, $strDescipcion, $valor,$UsuarioBt,$fecha);
						$option = 2;
					//}
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
				//if($_SESSION['permisosMod']['Permiso_Delete'] ||  $_SESSION['userData']['id_usuario'] == 1){
					$intParametro = intval($_POST['idParametro']);
					$requestDelete = $this->model->deleteParametro($intParametro);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Parametro');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Parametro asociado a otros modulos.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el parametro.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
				//}
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