<?php 
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
    class Clientes extends Controllers{
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
			getPermisos(MCLIENTES);
		}

        public function Clientes()
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Clientess";
			$data['page_title'] = "CLIENTES";
			$data['page_name'] = "clientes";
			$data['page_functions_js'] = "functions_cliente.js";
			$this->views->getView($this,"clientes",$data);
		}

        public function getClientes()
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$arrData = $this->model->selectClientes();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					//if($_SESSION['permisosMod']['Permiso_Update']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['Id_Cliente'].')" title="Editar movimiento">Actualizar</button>';
					//}
					//if($_SESSION['permisosMod']['Permiso_Delete']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['Id_Cliente'].')" title="Eliminar movimiento">Eliminar</button>';
					//}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			//}
			die();
		}

		public function setCliente(){
            $idCliente = intval($_POST['idCliente']);
            $strNombre = ucwords(strClean($_POST['txtNombre']));
            $strApellido = ucwords(strClean($_POST['txtApellido']));
			$strEmail = strtolower(strClean($_POST['txtEmail']));
            $intTelefono = intval(strClean($_POST['txtTelefono']));
            $strDireccion = ucwords(strClean($_POST['txtDireccion']));
            $strnumeroid = intval($_POST['txtIdentidad']);
            $request_rol = "";
            if($idCliente  == 0)
            {
                //Crear
                //if($_SESSION['permisosMod']['Permiso_Insert']){

                    if($strNombre == "" || $strApellido == "" || $strnumeroid == "" || $intTelefono == "" || $strDireccion == "" || $strEmail == ""){

                        $arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

                    }else{

                        $request_rol = $this->model->createCliente($strNombre, $strApellido, $strEmail, $intTelefono, $strDireccion, $strnumeroid);
                        $option = 1;

                    }
                
                //}
            }else{
                //Actualizar
                //if($_SESSION['permisosMod']['Permiso_Update']){
                    $request_rol = $this->model->updateCliente($idCliente, $strNombre, $strApellido, $strEmail, $intTelefono, $strDireccion, $strnumeroid);
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
					$eventoBT = "Agregó nuevo cliente"; // evento de si se ingreso, actualizo o elimino 
					$descripcionBT = 'Se agregó un nuevo cliente ';//descripcion de lo que se hizo
		
					$objetoBT = 3; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
					$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
					//fin bitacora

                }else{
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
					$fecha_actual = (date("Y-m-d"));
					$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
					$eventoBT = "Actualizó un cliente"; // evento de si se ingreso, actualizo o elimino 
					$descripcionBT = 'Se actualizó un cliente ';//descripcion de lo que se hizo
		
					$objetoBT = 3; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
					$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
					//fin bitacora
                }
            }else if($request_rol == 'exist'){
                
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El usuario ya existe.');
            }else{
                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
        }

	
        public function getCliente($idcliente)
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$intIdcliente = intval($idcliente);
				if($intIdcliente > 0)
				{
					$arrData = $this->model->selectCliente($intIdcliente);
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

		public function delCliente()
		{
			if($_POST){
				//if($_SESSION['permisosMod']['Permiso_Delete']){
					$intIdcliente = intval($_POST['idCliente']);
					$requestDelete = $this->model->deleteCliente($intIdcliente);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Cliente');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
						$eventoBT = "Elimino cliente"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se elimino el cliente ';//descripcion de lo que se hizo
			
						$objetoBT = 3; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el cliente porque esta asociado a otra tabla.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el cliente.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				//}
			}
			die();
		}
		
		public function getClienteR(string $params){
			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
			$data = $this->model->selectClienteR ($contenido);//aqui
			ob_end_clean();
			$html = getFile("Template/Modals/reporteClientesPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
		
		
		die();
		}




    

    }

?>