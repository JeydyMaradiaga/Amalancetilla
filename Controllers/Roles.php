<?php

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
    }

    public function Roles()
    {

        /*if (empty($_SESSION['permisosMod']['Permiso_Get'] ||  $_SESSION['userData']['id_usuario'] == 1)) {
            header("Location:" . base_url() . '/dashboard');
        }*/
        $data['page_id'] = 3;
        $data['page_tag'] = "Roles Usuario";
        $data['page_name'] = "Roles Usuario";
        $data['page_title'] = " Roles Usuario <small> Amalancetilla</small>";
        $data['page_functions_js'] = "functions_roles.js";
        $this->views->getView($this, "roles", $data);
    }

    public function getRoles()
    {
        $arrData = $this->model->selectRoles();

        for ($i = 0; $i < count($arrData); $i++) {

            if ($arrData[$i]['estado_rol'] == 1) {
                $arrData[$i]['estado_rol'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['estado_rol'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            $arrData[$i]['options'] = '<div class="text-center"> 
            <button class="btn btn-secondary btn-sm btnPermisosRol" rl="' . $arrData[$i]['Id_Rol'] . '" title="Permisos">Permisos</button>
            <button class="btn btn-primary btn-sm btnEditRol" rl="' . $arrData[$i]['Id_Rol'] . '" title="Editar">Editar</button>
            <button class="btn btn-danger btn-sm btnDelRol" rl="' . $arrData[$i]['Id_Rol'] . '" title="Elimar">Eliminar</button>
            </div>';
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

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
            //CREAR
            $request_rol = $this->model->insertRol($strRol, $strDescipcion, $intStatus);
            $option = 1;
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
				$UsuarioBt = $_SESSION['userData']['id_usuario'];//aqui es el usuario que hizo el cambio
				$eventoBT = "registro Rol"; // evento de si se ingreso, actualizo o elimino 
				$descripcionBT = 'El usuario ' . $_SESSION['userData']['Nombre'] . ' agrego un nuevo rol '. $strRol .''; //descripcion de lo que se hizo
	
	
				$objetoBT = 24; //segun la tabla objetos se agrega el dato es decir se pondra el numero indicado de los datos de la dicha tabla
				$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
		        //fin bitacora
            } else {
                $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                //bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
				$fecha_actual = (date("Y-m-d"));
				$UsuarioBt = $_SESSION['userData']['id_usuario'];//aqui es el usuario que hizo el cambio
				$eventoBT = "Actualizo Rol"; // evento de si se ingreso, actualizo o elimino 
				$descripcionBT = 'El usuario ' . $_SESSION['userData']['Nombre'] . ' actualizo el rol '.$strRol.'';//descripcion de lo que se hizo
	
	
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
            $intIdrol = intval($_POST['idrol']);
            $requestDelete = $this->model->deleteRol($intIdrol);
            if ($requestDelete == 'ok') {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
                //bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
				$fecha_actual = (date("Y-m-d"));
				$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
				$eventoBT = "Elimino el Rol"; // evento de si se ingreso, actualizo o elimino 
				$descripcionBT = 'El usuario ' . $_SESSION['userData']['Nombre'] . ' Elimino el rol '. $intIdrol .'';//descripcion de lo que se hizo
	
				$objetoBT = 24; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
				$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
		        //fin bitacora
            } else if ($requestDelete == 'exist') {
                $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
