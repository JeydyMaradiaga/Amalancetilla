<?php 
require 'Libraries/html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
	class Objetos extends Controllers{
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
		
		public function Objetos()//muestra la vista
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get'] ||  $_SESSION['userData']['id_usuario'] == 1)){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 3;
			$data['page_tag'] = "Objetos";
			$data['page_name'] = "Objetos";
			$data['page_title'] = "Objetos";
			$data['page_functions_js'] = "functions_objetos.js";
			$this->views->getView($this,"objetos",$data);
		}

		public function getObjetos()//muestra los datos
		{
			//if($_SESSION['permisosMod']['Permiso_Get'] ||  $_SESSION['userData']['id_usuario'] == 1){
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData = $this->model->selectObjetos();

				for ($i=0; $i < count($arrData); $i++) {
					//if($_SESSION['Permiso_Update'] ||  $_SESSION['userData']['id_usuario'] == 1){
						$btnEdit = '<button class="btn btn-info  btn-sm btnEditRol"onClick="fntEditParametro('.$arrData[$i]['Id_Objeto'].')"  title="Editar">Actualizar</button>';
					//}
					//if($_SESSION['Permiso_Delete'] ||  $_SESSION['userData']['id_usuario'] == 1){
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol"  onClick="fntDelParametro('.$arrData[$i]['Id_Objeto'].')" title="Eliminar">Eliminar</button>
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

		public function getObjetosM(int $idparametro)
		{
			//if($_SESSION['permisosMod']['Permiso_Get'] || $_SESSION['userData']['id_usuario'] == 1 ){
				$intidparametro = intval(strClean($idparametro));
				if($idparametro > 0)
				{
					$arrData = $this->model->selectObjeto($idparametro);
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
		

//codigo para mostrar en la tabla
	public function getObjetosR()
	{
		//if($_SESSION['permisosMod']['Permiso_Get']){
			$data = $this->model->selectObjetos();
			//dep($arrData );
			//die();
	
			ob_end_clean();
			$html = getFile("Template/Modals/reporteObjetosPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
		
		//}
		die();
	} //fin 

	public function setObjeto(){
				$intParametro = intval($_POST['idObjeto']);
				$strParametro =  strClean($_POST['txtNombreParametro']);
				$strDescipcion = strClean($_POST['txtDescripcion']);
				
				$fecha = strClean($_POST['txtCreacionParametro']);
				$request_rol = "";
				if($intParametro == 0)
				{
					//Crear
					//if($_SESSION['permisosMod']['Permiso_Insert'] ||  $_SESSION['userData']['id_usuario'] == 1){


						if($strParametro == "" || $strDescipcion == ""  || $fecha =""){

							$arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

						}else{
							$idRol = 1;
							$fecha = date("Y-m-d");
							$UsuarioBt = $_SESSION['userData']['Nombre'];
							$contador = 0;
							$rol = 0;
							$request_inserobjeto = $this->model->InsertObjeto($strParametro, $strDescipcion, $UsuarioBt, $fecha,  $idRol);
							$request_roles = $this->model->selectroles();
							
							
						

							foreach ($request_roles as $roles) {
							
								$rol =$request_roles[$contador]['Id_Rol'];
							
								$r = 0;
								$w = 0;
								$u = 0;
								$d = 0;
								$requestPermiso = $this->model->insertPermisos($rol,$request_inserobjeto, $r, $w, $u, $d);
								$contador += 1;
								$request_rol =1;
							}

							$option = 1;

						}
					
					//}
				}else{
					//Actualizar
					//if($_SESSION['permisosMod']['Permiso_Update'] ||  $_SESSION['userData']['id_usuario'] == 1){

						$request_rol = $this->model->updateObjeto($intParametro, $strParametro, $strDescipcion);
						$option = 2;
					//}
				}

				if($request_rol > 0 )
				{
					if($option == 1)
					{
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];//aqui es el usuario que hizo el cambio
						$eventoBT = "Registro un Objeto al sistema"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'El usuario ' . $_SESSION['userData']['Nombre'] . ' agrego un nuevo objeto '. $strParametro .''; //descripcion de lo que se hizo
			
			
						$objetoBT = 1; //segun la tabla objetos se agrega el dato es decir se pondra el numero indicado de los datos de la dicha tabla
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];//aqui es el usuario que hizo el cambio
						$eventoBT = "Se actualizo un Objeto del sistema"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'El usuario ' . $_SESSION['userData']['Nombre'] . ' actualizo un objeto '. $strParametro .''; //descripcion de lo que se hizo
			
			
						$objetoBT = 1; //segun la tabla objetos se agrega el dato es decir se pondra el numero indicado de los datos de la dicha tabla
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora
					}
				}else if($request_rol == 'exist'){
					
					$arrResponse = array('status' => false, 'msg' => '¡Atención! El Objeto ya existe.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function delObjeto()
		{
			if($_POST){
				//if($_SESSION['permisosMod']['Permiso_Delete'] ||  $_SESSION['userData']['id_usuario'] == 1){
					$intParametro = intval($_POST['idObjeto']);
					$requestDelete = $this->model->deleteParametro($intParametro);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Objeto');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
						$eventoBT = "Elimino un objeto del sistema"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'El usuario ' . $_SESSION['userData']['Nombre'] . ' Elimino un objeto '. $intParametro .'';//descripcion de lo que se hizo
			
						$objetoBT = 5; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Objeto asociado a otros modulos.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Objeto.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				//}
			}
			die();
		}

	}
 ?>