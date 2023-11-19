<?php
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
    class Estado_usuarios extends Controllers{     // se edito esta parte
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
			getPermisos(MESTADOPEDIDOS);       // aqui tambien se edito
		}

        public function Estado_usuarios()      //aqui tambien se edito
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Estado usuarios";                   // linea 24, 25, 26, 27 y 28 de edito
			$data['page_title'] = "ESTADO USUARIOS";
			$data['page_name'] = "estado_usuarios";
			$data['page_functions_js'] = "functions_estado_usuario.js";
			$this->views->getView($this,"estado_usuarios",$data);
		}

        public function getEstado_usuarios()                     // se edito aqui
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$arrData = $this->model->selectEstado_usuarios();     // se edito aqui
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';                                   // linea 41 y 44 se edito 

					//if($_SESSION['permisosMod']['Permiso_Update']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['id_estado_usuario'].')" title="Editar Estado usuario">Actualizar</button>';
					//}
					//if($_SESSION['permisosMod']['Permiso_Delete']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['id_estado_usuario'].')" title="Eliminar Estado usuario">Eliminar</button>';
					//}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			//}
			die();
		}


		public function delEstado_usuario()      // se edito aqui
		{
			if($_POST){
				//if($_SESSION['permisosMod']['Permiso_Delete']){
					$intIdestado_usuario = intval($_POST['idEstado_usuario']);     // se edito aqui
					$requestDelete = $this->model->deleteEstado_usuario($intIdestado_usuario);   // se edito aqui
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Estado del usuario');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
						$eventoBT = "Elimino Tipo de Estado de usuario"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se elimino el Estado del usuario '. $intIdestado_usuario .'';//descripcion de lo que se hizo
			
						$objetoBT = 4; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el Estado del usuario porque esta asociado a otra tabla.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar  el Estado del usuario.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				//}
			}
			die();
		}



		public function setEstado_usuario(){                      // se edito linea 85,86,94,100,109 y 124.
            $intParametro = intval($_POST['idEstado_usuario']);
            $strParametro =  strClean($_POST['txtNombreEstado']);
            $request_rol = "";
            if($intParametro == 0)
            {
                //Crear
                //if($_SESSION['permisosMod']['Permiso_Insert']){

                    if($strParametro == ""){

                        $arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

                    }else{
						$fecha = date("Y-m-d");
                        $request_rol = $this->model->createEstado_usuario($strParametro, $fecha);
                        $option = 1;

                    }
                
                //}
            }else{
                //Actualizar
                //if($_SESSION['permisosMod']['Permiso_Update']){
                    $request_rol = $this->model->updateEstado_usuario($intParametro, $strParametro);
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
						$eventoBT = "Se agrego un nuevo estado de usuario"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se agrego el estado del usuario '. $intIdestado_usuario .'';//descripcion de lo que se hizo
			
						$objetoBT = 4; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora

                }else{
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
					$fecha_actual = (date("Y-m-d"));
					$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
					$eventoBT = "Se actualizo un estado del usuario"; // evento de si se ingreso, actualizo o elimino 
					$descripcionBT = 'Se actualizo el Estado del usuario '. $intIdestado_usuario .'';//descripcion de lo que se hizo
		
					$objetoBT = 4; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
					$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
					//fin bitacora

                }
            }else if($request_rol == 'exist'){
                
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El Estado usuario ya existe.');
            }else{
                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
        }


		public function getEstado_usuario($idestado_usuario)  // se editaron las lineas 133,136,137 y 139
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$intIdestado_usuario = intval($idestado_usuario);
				if($intIdestado_usuario > 0)
				{
					$arrData = $this->model->selectEstado_usuario($intIdestado_usuario);
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
		
                                                                 // se edito la linea 153,156 y 158.
		public function getEstado_usuarioR(string $params){
			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
			$data = $this->model->selectEstado_usuarioR ($contenido);//aqui
			ob_end_clean();
			$html = getFile("Template/Modals/reporteEstado_usuariosPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
			
		die();
		}
		

    }
?>