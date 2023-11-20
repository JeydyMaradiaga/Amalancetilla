<?php  
require 'Libraries/html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
	class Descuentos extends Controllers{
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
			getPermisos(MDESCUENTOS);
		}

		public function Descuentos()
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 3;
			$data['page_tag'] = "Descuentos";
			$data['page_name'] = "Descuentos";
			$data['page_title'] = "Descuentos";
			$data['page_functions_js'] = "functions_descuento.js";
			$this->views->getView($this,"descuentos",$data);
		}

		public function getDescuentos()
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData = $this->model->selectDescuentos();

				for ($i=0; $i < count($arrData); $i++) {
					if($arrData[$i]['Estado'] == 1)
					{
						$arrData[$i]['Estado'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['Estado'] = '<span class="badge badge-danger">Inactivo</span>';
					}




					//if($_SESSION['permisosMod']['Permiso_Update']){
						$btnEdit = '<button class="btn btn-info  btn-sm btnEditRol"onClick="fntEditParametro('.$arrData[$i]['Id_Descuento'].')"  title="Editar">Actualizar</button>';
				//	}
				//	if($_SESSION['permisosMod']['Permiso_Delete']){
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol"  onClick="fntDelParametro('.$arrData[$i]['Id_Descuento'].')" title="Eliminar">Eliminar</button>
					</div>';
				//	}
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
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$intidparametro = intval(strClean($idparametro));
				if($idparametro > 0)
				{
					$arrData = $this->model->selectDescuento($idparametro);
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

		public function setDescuento(){
				$intParametro = intval($_POST['idDescuento']);
				$strParametro =  strClean($_POST['txtNombreParametro']);
				$strDescipcion = strClean($_POST['txtDescripcion']);
				$valor = intval($_POST['txtValorParametro']);
				$estado = intval($_POST['listStatus']);
				$request_rol = "";
				if($intParametro == 0)
				{
					//Crear
					if($_SESSION['permisosMod']['Permiso_Insert']){


						if($strParametro == "" || $strDescipcion == "" || $valor ==""  || $estado== ""){

							$arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

						}else{

							$request_rol = $this->model->createDescuento($strParametro,$valor,$estado, $strDescipcion);
							$option = 1;

						}
					
					}
				}else{
					//Actualizar
					//if($_SESSION['permisosMod']['Permiso_Update']){
						$request_rol = $this->model->updateDescuento($intParametro, $strParametro,  $valor, $estado,$strDescipcion,);
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
						$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
						$eventoBT = "Agregó descuento"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se agregó un nuevo descuento ';//descripcion de lo que se hizo
			
						$objetoBT = 29; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora

					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
						$eventoBT = "Actualizó descuento"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se actualizó el descuento ';//descripcion de lo que se hizo
		
						$objetoBT = 29; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
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
		

//codigo para mostrar en la tabla
	public function getDescuentosR()
	{
		//if($_SESSION['permisosMod']['Permiso_Get']){
			$data = $this->model->selectDescuentos();
			//dep($arrData );
			//die();
	
			ob_end_clean();
			$html = getFile("Template/Modals/reporteDescuentosPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
		
		//}
		die();
	} //fin 

		public function delParametro()
		{
			if($_POST){
			
					$intParametro = intval($_POST['idParametro']);
					$requestDelete = $this->model->deleteParametro($intParametro);
				
					
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Descuento');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
						$eventoBT = "Elimino descuento"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se elimino el descuento ';//descripcion de lo que se hizo
			
						$objetoBT = 29; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora

					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			}
			die();
		}

	}
 ?>