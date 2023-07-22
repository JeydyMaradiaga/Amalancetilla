<?php 
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
    class Movimientos extends Controllers{
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
			//getPermisos(MCATEGORIAS);
		}

        public function Movimientos()
		{
			//if(empty($_SESSION['permisosMod']['Permiso_Get'])){
				//header("Location:".base_url().'/dashboard');
			//}
			$data['page_tag'] = "Movimientos";
			$data['page_title'] = "MOVIMIENTOS";
			$data['page_name'] = "movimientos";
			$data['page_functions_js'] = "functions_movimiento.js";
			$this->views->getView($this,"movimientos",$data);
		}

        public function getMovimientos()
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$arrData = $this->model->selectMovimientos();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					//if($_SESSION['permisosMod']['Permiso_Update']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['Id_tipo_movimiento'].')" title="Editar movimiento">Actualizar</button>';
					//}
					//if($_SESSION['permisosMod']['Permiso_Delete']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['Id_tipo_movimiento'].')" title="Eliminar movimiento">Eliminar</button>';
					//}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			//}
			die();
		}


        public function setMovimiento(){
            $intParametro = intval($_POST['idMovimiento']);
            $strParametro =  strClean($_POST['txtNombreMovimiento']);
            $request_rol = "";
            if($intParametro == 0)
            {
                //Crear
                //if($_SESSION['permisosMod']['Permiso_Insert']){

                    if($strParametro == ""){

                        $arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

                    }else{

                        $request_rol = $this->model->createMovimiento($strParametro);
                        $option = 1;

                    }
                
                //}
            }else{
                //Actualizar
                //if($_SESSION['permisosMod']['Permiso_Update']){
                    $request_rol = $this->model->updateMovimiento($intParametro, $strParametro);
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

        public function getMovimiento($idmovimiento)
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$intIdmovimiento = intval($idmovimiento);
				if($intIdmovimiento > 0)
				{
					$arrData = $this->model->selectMovimiento($intIdmovimiento);
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
    }

?>