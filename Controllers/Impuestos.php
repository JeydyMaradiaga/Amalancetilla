<?php 
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
    class Impuestos extends Controllers{
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
            getPermisos(MIMPUESTO);
        }

        public function Impuestos()
        {
            if(empty($_SESSION['permisosMod']['Permiso_Get']||  $_SESSION['userData']['id_usuario'] == 1)){
                header("Location:".base_url().'/dashboard');
            }
            $data['page_tag'] = "Impuestos";
            $data['page_title'] = "IMPUESTOS";
            $data['page_name'] = "impuestos";
            $data['page_functions_js'] = "functions_impuesto.js";
            $this->views->getView($this,"impuestos",$data);
        }

        public function getImpuestos()
        {
            //if($_SESSION['permisosMod']['Permiso_Get']){
                $arrData = $this->model->selectImpuestos();
                for ($i=0; $i < count($arrData); $i++) {
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    if($_SESSION['permisosMod']['Permiso_Update']||  $_SESSION['userData']['id_usuario'] == 1){
                        $btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['Id_ISV'].')" title="Editar impuesto">Actualizar</button>';
                    }
                    if($_SESSION['permisosMod']['Permiso_Delete']||  $_SESSION['userData']['id_usuario'] == 1){   
                        $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['Id_ISV'].')" title="Eliminar impuesto">Eliminar</button>';
                    }
                    $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                }
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            //}
            die();
        }

        public function delImpuesto()
        {
            if($_POST){
                //if($_SESSION['permisosMod']['Permiso_Delete']){
                    $intId_ISV = intval($_POST['Id_ISV']);
                    $requestDelete = $this->model->deleteImpuesto($intId_ISV);
                    if($requestDelete == 'ok')
                    {
                        $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Impuesto');
                        //bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
                        $fecha_actual = (date("Y-m-d"));
                        $UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
                        $eventoBT = "Elimino Impuesto"; // evento de si se ingreso, actualizo o elimino 
                        $descripcionBT = 'Se elimino el impuesto ';//descripcion de lo que se hizo
            
                        $objetoBT = 31; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
                        $insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
                        //fin bitacora
                    }else if($requestDelete == 'exist'){
                        $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el impuesto porque esta asociado a un Inventario.');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Error al eliminar Impuesto.');
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                //}
            }
            die();
        }

        public function setImpuesto(){
            $intParametro = intval($_POST['Id_ISV']);
            $strParametro =  strClean($_POST['txtNombreISV']);
            $strPorcentajeISV = strClean($_POST['txtPorcentajeISV']);
            $request_rol = "";
            if($intParametro == 0)
            {
                //Crear
                //if($_SESSION['permisosMod']['Permiso_Insert']){

                    if($strParametro == "" || $strPorcentajeISV == ""){

                        $arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

                    }else{

                        $request_rol = $this->model->createImpuesto($strParametro, $strPorcentajeISV);
                        $option = 1;

                    }
                
                //}
            }else{
                //Actualizar
                //if($_SESSION['permisosMod']['Permiso_Update']){
                    $request_rol = $this->model->updateImpuesto($intParametro, $strParametro, $strPorcentajeISV);
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
						$eventoBT = "Agregó impuesto"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Se agregó un nuevo impuesto ';//descripcion de lo que se hizo
			
						$objetoBT = 31; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora
                }else{
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                    //bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
					$fecha_actual = (date("Y-m-d"));
					$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
					$eventoBT = "Actualizó impuesto"; // evento de si se ingreso, actualizo o elimino 
					$descripcionBT = 'Se actualizó el impuesto ';//descripcion de lo que se hizo
		
					$objetoBT = 31; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
					$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
					//fin bitacora
                }
            }else if($request_rol == 'exist'){
                
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El impuesto ya existe.');
            }else{
                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
        }

        public function getImpuesto($Id_ISV)
        {
            //if($_SESSION['permisosMod']['Permiso_Get']){
                $intId_ISV = intval($Id_ISV);
                if($intId_ISV > 0)
                {
                    $arrData = $this->model->selectImpuesto($intId_ISV);
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

        public function getImpuestoR(string $params){
            $arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
            $contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
            $data = $this->model->selectImpuestoR ($contenido);//aqui
            ob_end_clean();
            $html = getFile("Template/Modals/reporteImpuestosPDF",$data);
            $html2pdf = new Html2Pdf();
            $html2pdf->writeHTML($html);
            $html2pdf->output();
        
        
        die();
        }

    }

?>
