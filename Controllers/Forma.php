<?php
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
    class Forma extends Controllers{     // se edito esta parte
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

        public function Forma()      //aqui tambien se edito
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Forma";                   // linea 24, 25, 26, 27 y 28 de edito
			$data['page_title'] = "FORMA DE PAGO";
			$data['page_name'] = "forma";
			$data['page_functions_js'] = "functions_Forma.js";
			$this->views->getView($this,"forma",$data);
		}

        public function getForma()                     // se edito aqui
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$arrData = $this->model->selectForma();     // se edito aqui
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';                                   // linea 41 y 44 se edito 

					//if($_SESSION['permisosMod']['Permiso_Update']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['Id_Forma_Pago'].')" title="Editar Forma de pago">Actualizar</button>';
					//}
					//if($_SESSION['permisosMod']['Permiso_Delete']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['Id_Forma_Pago'].')" title="Eliminar Forma de pago">Eliminar</button>';
					//}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			//}
			die();
		}


		public function delForm()      // se edito aqui
		{
			if($_POST){
				//if($_SESSION['permisosMod']['Permiso_Delete']){
					$intIdforma = intval($_POST['idForma']);     // se edito aqui
					$requestDelete = $this->model->deleteForm($intIdforma);   // se edito aqui
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la forma de pago');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
						$eventoBT = "Elimino forma pago"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se elimino la forma de pago ';//descripcion de lo que se hizo
			
						$objetoBT = 38; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar la forma de pago porque esta asociado a otra tabla.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar  forma de pago.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				//}
			}
			die();
		}


 
		public function setForm(){                      // se edito linea 85,86,94,100,109 y 124.
            $intParametro = intval($_POST['idForma']);
            $strParametro =  strClean($_POST['txtNombre']);
			$strDescipcion = strClean($_POST['txtDescripcion']);
            $request_rol = "";
            if($intParametro == 0)
            {
                //Crear
                //if($_SESSION['permisosMod']['Permiso_Insert']){

                    if($strParametro == "" || $strDescipcion == ""){

                        $arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

                    }else{
						
                        $request_rol = $this->model->createForm($strParametro, $strDescipcion);
                        $option = 1;

                    }
                
                //}
            }else{
                //Actualizar
                //if($_SESSION['permisosMod']['Permiso_Update']){
                    $request_rol = $this->model->updateForm($intParametro, $strParametro,$strDescipcion);
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
						$eventoBT = "Agregó forma de pago"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se agregó una nueva forma de pago ';//descripcion de lo que se hizo
			
						$objetoBT = 38; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora

                }else{
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
					$fecha_actual = (date("Y-m-d"));
					$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
					$eventoBT = "Actualizó forma pago"; // evento de si se ingreso, actualizo o elimino 
					$descripcionBT = 'Se actualizó la forma de pago ';//descripcion de lo que se hizo
		
					$objetoBT = 38; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
					$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
					//fin bitacora

                }
            }else if($request_rol == 'exist'){
                
                $arrResponse = array('status' => false, 'msg' => '¡Atención! La Forma de pago ya existe.');
            }else{
                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
        }


		public function getForm($idforma)  // se editaron las lineas 133,136,137 y 139
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$intIdforma = intval($idforma);
				if($intIdforma > 0)
				{
					$arrData = $this->model->selectForm($intIdforma);
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
		public function getFormaR(string $params){
			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
			$data = $this->model->selectFormaR ($contenido);//aqui
			ob_end_clean();
			$html = getFile("Template/Modals/reporteFormaPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
			
		die();
		}
		

    }
?>