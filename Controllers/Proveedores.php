<?php 
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
    class Proveedores extends Controllers{
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
            getPermisos(MPROVEEDORES);
        }

        public function Proveedores()
        {
            if(empty($_SESSION['permisosMod']['Permiso_Get'])){
                header("Location:".base_url().'/dashboard');
            }
            $data['page_tag'] = "Proveedores";
            $data['page_title'] = "PROVEEDORES";
            $data['page_name'] = "proveedores";
            $data['page_functions_js'] = "functions_proveedor.js";
            $this->views->getView($this,"proveedores",$data);
        }

        public function getProveedores()
        {
            //if($_SESSION['permisosMod']['Permiso_Get']){
                $arrData = $this->model->selectProveedores();
                for ($i=0; $i < count($arrData); $i++) {
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    //if($_SESSION['permisosMod']['Permiso_Update']){
                        $btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['Id_Proveedor'].')" title="Editar proveedor">Actualizar</button>';
                    //}
                    //if($_SESSION['permisosMod']['Permiso_Delete']){   
                        $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['Id_Proveedor'].')" title="Eliminar proveedor">Eliminar</button>';
                    //}
                    $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                }
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            //}
            die();
        }

        public function delProveedor()
        {
            if($_POST){
                //if($_SESSION['permisosMod']['Permiso_Delete']){
                    $intId_Proveedor = intval($_POST['idProveedor']);
                    $requestDelete = $this->model->deleteProveedor($intId_Proveedor);
                    if($requestDelete == 'ok')
                    {
                        $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Proveedor');
                        //bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
                        $fecha_actual = (date("Y-m-d"));
                        $UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
                        $eventoBT = "Elimino Proveedor"; // evento de si se ingreso, actualizo o elimino 
                        $descripcionBT = 'El usuario ' . $_SESSION['userData']['Nombre'] . ' Elimino Proveedor '. $intId_Proveedor .'';//descripcion de lo que se hizo
            
                        $objetoBT = 4; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
                        $insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
                        //fin bitacora
                    }else if($requestDelete == 'exist'){
                        $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el Proveedor porque esta asociado a otra tabla.');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Error al eliminar Proveedor.');
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                //}
            }
            die();
        }

        public function setProveedor(){
            $intParametro = intval($_POST['idProveedor']);
            $strParametro =  strClean($_POST['txtNombreProveedor']);
            $strRTNProveedor = strClean($_POST['txtRTNProveedor']);
            $strTelefonoProveedor = strClean($_POST['txtTelefonoProveedor']);
            $strCorreoProveedor = strClean($_POST['txtCorreoProveedor']);
            $strDireccionProveedor = strClean($_POST['txtDireccionProveedor']);
            $request_rol = "";
            if($intParametro == 0)
            {
                //Crear
                //if($_SESSION['permisosMod']['Permiso_Insert']){

                    if($strParametro == "" || $strRTNProveedor == "" || $strTelefonoProveedor == "" || $strCorreoProveedor == "" || $strDireccionProveedor == ""){

                        $arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

                    }else{

                        $request_rol = $this->model->createProveedor($strParametro, $strRTNProveedor, $strTelefonoProveedor, $strCorreoProveedor, $strDireccionProveedor);
                        $option = 1;

                    }
                
                //}
            }else{
                //Actualizar
                //if($_SESSION['permisosMod']['Permiso_Update']){
                    $request_rol = $this->model->updateProveedor($intParametro, $strParametro, $strRTNProveedor, $strTelefonoProveedor, $strCorreoProveedor, $strDireccionProveedor);
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
                
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El Prooveedor ya existe.');
            }else{
                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
        }

        public function getProveedor($Id_Proveedor)
        {
            //if($_SESSION['permisosMod']['Permiso_Get']){
                $intId_Proveedor = intval($Id_Proveedor);
                if($intId_Proveedor > 0)
                {
                    $arrData = $this->model->selectProveedor($intId_Proveedor);
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

        public function getProveedorR(string $params){
            $arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
            $contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
            $data = $this->model->selectProveedorR ($contenido);//aqui
            ob_end_clean();
            $html = getFile("Template/Modals/reporteProveedoresPDF",$data);
            $html2pdf = new Html2Pdf();
            $html2pdf->writeHTML($html);
            $html2pdf->output();
        
        
        die();
        }

    }

?>
