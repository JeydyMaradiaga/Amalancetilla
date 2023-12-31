<?php
require 'Libraries/html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
class Roles extends Controllers
{ 
	public function __construct()
	{

		parent::__construct();
		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
			die();
		}
		getPermisos(MROLES);
	}

	public function Roles()
	{

		if (empty($_SESSION['permisosMod']['Permiso_Get'] ||  $_SESSION['userData']['id_usuario'] == 1)) {
			header("Location:" . base_url() . '/dashboard');
		}
		$data['page_id'] = 3;
		$data['page_tag'] = "Roles Usuario";
		$data['page_name'] = "rol_usuario";
		$data['page_title'] = "Roles Usuario</small>";
		$data['page_functions_js'] = "functions_roles.js";
		$this->views->getView($this, "roles", $data);
	}

	public function getRoles()
	{	
		if($_SESSION['permisosMod']['Permiso_Get'] ||  $_SESSION['userData']['id_usuario'] == 1){
		$btnView = '';
		$btnEdit = '';
		$btnDelete = '';
		$arrData = $this->model->selectRoles();

		for ($i = 0; $i < count($arrData); $i++) {

			if ($arrData[$i]['estado_rol'] == 1) {
				$arrData[$i]['estado_rol'] = '<span class="badge badge-success">Activo</span>';
			} else {
				$arrData[$i]['estado_rol'] = '<span class="badge badge-danger">Inactivo</span>';
			}

			if ($_SESSION['permisosMod']['Permiso_Update'] ||  $_SESSION['userData']['id_usuario'] == 1) {
				$btnView = '<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos(' . $arrData[$i]['Id_Rol'] . ')" title="Permisos">Permisos</button>';
				$btnEdit = '<button class="btn btn-primary btn-sm btnEditRol" onClick="fntEditRol(' . $arrData[$i]['Id_Rol'] . ')" title="Editar">Actualizar</button>';
			}
			if ($_SESSION['permisosMod']['Permiso_Delete'] ||  $_SESSION['userData']['id_usuario'] == 1) {
				$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol(' . $arrData[$i]['Id_Rol'] . ')" title="Eliminar">Eliminar</button>
				</div>';
			}
			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
	}
		die();
	}
	public function getRolesR()
	{
		//if($_SESSION['permisosMod']['Permiso_Get']){
			$data = $this->model->selectRoles();
			//dep($arrData );
			//die();
	
			ob_end_clean();
			$html = getFile("Template/Modals/reporteRolesPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
		
		//}
		die();
	} //fin 
	public function getSelectRoles()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectRoles();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['estado_rol'] == 1) {
					$htmlOptions .= '<option value="' . $arrData[$i]['Id_Rol'] . '">' . $arrData[$i]['Nombre_Rol'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	public function getRol(int $idrol)
	{
		$intIdrol = intval(strClean($idrol));
		if ($intIdrol > 0) {
			$arrData = $this->model->selectRol($intIdrol);
			if (empty($arrData)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function setRol()
	{

		$intIdrol = intval($_POST['idRol']);
		$strRol =  strClean($_POST['txtNombre']);
		$strDescipcion = strClean($_POST['txtDescripcion']);
		$intStatus = intval($_POST['listStatus']);

		if ($intIdrol == 0) {
			$idRol = 1;
			$contador = 0;
			$rol = 0;
			//Crear
			$request_rol = $this->model->insertRol($strRol, $strDescipcion, $intStatus);
			$option = 1;

			$request_roles = $this->model->selectObjetos(); //seccionar todos los objetos
		
			if ($request_rol != "exist" ){
				foreach ($request_roles as $roles) {


					$rol = $request_roles[$contador]['Id_Objeto'];

					$r = 0;
					$w = 0;
					$u = 0;
					$d = 0;
					$requestPermiso = $this->model->insertPermisos($request_rol, $rol, $r, $w, $u, $d);
					$contador += 1;
				}

			}
				
		} else {
			//Actualizar
			$request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescipcion, $intStatus);
			$option = 2;
		}
 
		if ($request_rol > 0) {
			if ($option == 1) {
				$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
				$fecha_actual = (date("Y-m-d"));
				$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
				$eventoBT = "Agregó rol"; // evento de si se ingreso, actualizo o elimino 
				$descripcionBT = 'Se agregó un nuevo rol ';//descripcion de lo que se hizo
	
				$objetoBT = 24; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
				$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
				//fin bitacora

			} else {
				$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
				$fecha_actual = (date("Y-m-d"));
				$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
				$eventoBT = "Actualizó rol"; // evento de si se ingreso, actualizo o elimino 
				$descripcionBT = 'Se actualizó el rol ';//descripcion de lo que se hizo
	
				$objetoBT = 24; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
				$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
				//fin bitacora

			}
		} else if ($request_rol == 'exist') {

			$arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
		} else {
			$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function delRol()
	{
		if ($_POST) {
			if($_SESSION['permisosMod']['Permiso_Delete'] ||  $_SESSION['userData']['id_usuario'] == 1){
			$intIdrol = intval($_POST['idrol']);
			$requestDelete = $this->model->deleteRol($intIdrol);
			if ($requestDelete == 'ok') {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
				//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
				$fecha_actual = (date("Y-m-d"));
				$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
				$eventoBT = "Elimino rol"; // evento de si se ingreso, actualizo o elimino 
				$descripcionBT = 'Se elimino el rol ';//descripcion de lo que se hizo
	
				$objetoBT = 24; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
				$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
				//fin bitacora

			} else if ($requestDelete == 'exist') {
				$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a permisos.');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	}
}
