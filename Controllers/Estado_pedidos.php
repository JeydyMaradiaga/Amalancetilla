<?php 
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
    class Estado_pedidos extends Controllers{
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
			getPermisos(MESTADOPEDIDOS);
		}

        public function Estado_pedidos()
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get']||  $_SESSION['userData']['id_usuario'] == 1)){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Estado pedidos";
			$data['page_title'] = "ESTADO PEDIDOS";
			$data['page_name'] = "estado_pedidos";
			$data['page_functions_js'] = "functions_estado_pedido.js";
			$this->views->getView($this,"estado_pedidos",$data);
		}

        public function getEstado_pedidos()
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$arrData = $this->model->selectEstado_pedidos();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($_SESSION['permisosMod']['Permiso_Update']||  $_SESSION['userData']['id_usuario'] == 1){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['Id_Estado_Pedido'].')" title="Editar Estado pedido">Actualizar</button>';
					}
					if($_SESSION['permisosMod']['Permiso_Delete']||  $_SESSION['userData']['id_usuario'] == 1){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['Id_Estado_Pedido'].')" title="Eliminar Estado pedido">Eliminar</button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			//}
			die();
		}

		public function delEstado_pedido()
		{
			if($_POST){
				//if($_SESSION['permisosMod']['Permiso_Delete']){
					$intIdestado_pedido = intval($_POST['idEstado_pedido']);
					$requestDelete = $this->model->deleteEstado_pedido($intIdestado_pedido);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Estado pedido');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
						$eventoBT = "Elimino Tipo de Estado de pedido"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se elimino el tipo de estado del pedido ';//descripcion de lo que se hizo
			
						$objetoBT = 25; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el Estado de pedido porque esta asociado a otra tabla.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar  el Estado de pedido.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				//}
			}
			die();
		}



        public function setEstado_pedido(){
            $intParametro = intval($_POST['idEstado_pedido']);
            $strParametro =  strClean($_POST['txtNombreEstado']);
            $strDescipcion = strClean($_POST['txtNombreDescripcion']);
            $request_rol = "";
            if($intParametro == 0)
            {
                //Crear
                //if($_SESSION['permisosMod']['Permiso_Insert']){

                    if($strParametro == "" || $strDescipcion == ""){

                        $arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

                    }else{

                        $request_rol = $this->model->createEstado_pedido($strParametro, $strDescipcion);
                        $option = 1;

                    }
                
                //}
            }else{
                //Actualizar
                //if($_SESSION['permisosMod']['Permiso_Update']){
                    $request_rol = $this->model->updateEstado_pedido($intParametro, $strParametro, $strDescipcion);
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
					$eventoBT = "Agregó estado del pedido"; // evento de si se ingreso, actualizo o elimino 
					$descripcionBT = 'Se agregó el estado del pedido ';//descripcion de lo que se hizo
		
					$objetoBT = 25; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
					$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
					//fin bitacora
                }else{
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
					$fecha_actual = (date("Y-m-d"));
					$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
					$eventoBT = "Actualizó estado del pedido"; // evento de si se ingreso, actualizo o elimino 
					$descripcionBT = 'Se actualizó el Estado del pedido ';//descripcion de lo que se hizo
		
					$objetoBT = 25; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
					$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
					//fin bitacora
                }
            }else if($request_rol == 'exist'){
                
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El Estado pedido ya existe.');
            }else{
                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
        }

        public function getEstado_pedido($idestado_pedido)
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$intIdestado_pedido = intval($idestado_pedido);
				if($intIdestado_pedido > 0)
				{
					$arrData = $this->model->selectEstado_pedido($idestado_pedido);
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

		public function getEstado_pedidoR(string $params){
			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
			$data = $this->model->selectEstado_pedidoR ($contenido);//aqui
			ob_end_clean();
			$html = getFile("Template/Modals/reporteEstado_pedidosPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
		
			
		die();
		}
    }

?>