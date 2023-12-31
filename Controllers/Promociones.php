
<?php 
    require 'Libraries/html2pdf/vendor/autoload.php';
    use Spipu\Html2Pdf\Html2Pdf;
    class Promociones extends Controllers{
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
            getPermisos(MPROMOCIONES);
        }
 
        public function Promociones()
        {
            if(empty($_SESSION['permisosMod']['Permiso_Get']||  $_SESSION['userData']['id_usuario'] == 1)){
				header("Location:".base_url().'/dashboard');
			}
            $data['page_id'] = 3;
            $data['page_tag'] = "Promociones";
            $data['page_name'] = "Promociones";
            $data['page_title'] = "Promociones";
            $data['page_functions_js'] = "functions_promociones.js";
            $this->views->getView($this,"promociones",$data);
        }

        public function getPromociones()
        {
            ///if($_SESSION['permisosMod']['Permiso_Get']){
                $btnView = '';
                $btnEdit = '';
                unset($_SESSION['arrCarrito']);
                $btnDelete = '';
                $arrData = $this->model->selectPromociones();

                for ($i=0; $i < count($arrData); $i++) {

                    if($arrData[$i]['Estado'] == 1)
                    {
                        $arrData[$i]['Estado'] = '<span class="badge badge-success">Activo</span>';
                    }else{
                        $arrData[$i]['Estado'] = '<span class="badge badge-danger">Inactivo</span>';
                    }
                    if($_SESSION['permisosMod']['Permiso_Update']||  $_SESSION['userData']['id_usuario'] == 1){
                        $btnEdit = '<button class="btn btn-info  btn-sm btnEditRol"onClick="fntEditInfo('.$arrData[$i]['Id_Promociones'].')"  title="Editar">Actualizar</button>';
                    }
                     if($_SESSION['permisosMod']['Permiso_Delete']||  $_SESSION['userData']['id_usuario'] == 1){
                        $btnDelete = '<button class="btn btn-danger btn-sm btnDelRol"  onClick="fntDelParametro('.$arrData[$i]['Id_Promociones'].')" title="Eliminar">Eliminar</button>
                    </div>';
                    }
                    $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                }
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        //  }
            die();
        }
        
        public function getSelectPromociones()
        {
            $htmlOptions = "";
            $htmlOptions .= '<option value="" disable >--Seleccione--</option>'; //llamar los datos de la tabla
            $arrData = $this->model->selectPromociones(); 
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                    if($arrData[$i]['Estado'] == 1 ){
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id_Promociones'].'">'.$arrData[$i]['Nombre'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();      
        }
        public function getSelectProductos()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectProductos();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                    if($arrData[$i]['status'] == 1 ){
                    $htmlOptions .= '<option value="'.$arrData[$i]['Id_Producto'].'">'.$arrData[$i]['Nombre'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();      
        }


        public function getPromocion($idparametro)
        {
            
                $intidparametro = intval(strClean($idparametro));
                if($idparametro > 0)
                {
                    $arrData = $this->model->selecPromocion($idparametro);
                    if(empty($arrData))
                    {
                        $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                    }else{
                        $arrResponse = array('status' => true, 'data' => $arrData);
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                
            }
            die();
        }
        public function setPromocionesProductos()
        {
            
            $contador = 0;
            $idpromocion = intval($_POST['listCategoria']);

            foreach ($_SESSION['arrCarrito'] as $producto) {
                $productoid = $producto['idproducto'];
                $cantidad = $producto['cantidad'];
                $request = $this->model->insertPromociones($idpromocion, $productoid, $cantidad);
                $contador += 1;
            }
            if($request){

                $arrResponse = array('status' => true, 'msg' => 'Datos de productos guardados correctamente.');

            }else{
                $arrResponse = array('status' => true, 'msg' => 'Error al insertar productos a la promocion');

            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();

        
        }
        

            public function setPromocion(){

                $intPromocion = intval($_POST['idpromocion']);
                $strNPromocion = strClean($_POST['txtNombrePromocion']);
                $strDescipcion = strClean($_POST['txtDescripcion']);
                $Producto = intval($_POST['listRolid']);
                $estado = intval($_POST['listStatus2']);
                $valor = strClean($_POST['txtValor']);
                $cantp = strClean($_POST['txtCant']);
                $fecha1 = strClean($_POST['txtFecha1']);
                $fecha2 = strClean($_POST['txtFecha2']);
                $request_rol = "";
                
                if($intPromocion == 0) 
                {

                    if($strNPromocion == "" || $strDescipcion == "" || $Producto =="" || $fecha1 ="" || $fecha2 ="" || $cantp ="" || $valor =""){

                        $arrResponse = array("status" => false, "msg" => 'Debe ingresar todos los campos');

                    }else{

                        $request_rol = $this->model->createPromocion($strNPromocion, $strDescipcion,$Producto,$fecha1,$fecha2,$valor,$estado,$cantp);
                        $option = 1;

                    }
                    
                }else{
                    //Actualizar
                    $request_rol = $this->model->updateParametro($intPromocion,$strNPromocion, $strDescipcion,$Producto,$fecha1,$fecha2,$valor,$estado,$cantp);
                    $option = 2;            
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
                    
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! la promocion ya existe.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            
            die();   
            }

        public function delParametro()
        {
            if($_POST){
        
                    $intParametro = intval($_POST['idParametro']);
                    $requestDelete = $this->model->deleteParametro($intParametro);
                    if($requestDelete == 'ok')
                    {
                        $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la promocion');
                
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la promocion.');
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                
            }
            die();
        }
        
    public function addCarrito(int $idproducto)
    {
        unset($_SESSION['descuento']);
        if ($idproducto != 1) {
            dep('2222');
            unset($_SESSION['arrCarrito']);
            unset($_SESSION['totalpedido1']);
            unset($_SESSION['contador'] );
            unset($_SESSION['descuento']);
            die();
        } else {

            if ($_POST) {
                

                $arrCarrito = array();
                $cantCarrito = 0;
                $idproducto = strClean($_POST['idproducto']);
                $cantidad = strClean($_POST['cantidad']);
                $_SESSION['descuento'] = 0;
                if (is_numeric($idproducto) and is_numeric($cantidad)) {
                    $arrInfoProducto = $this->model->selectProducto($idproducto);
                    if (!empty($arrInfoProducto)) {
                        $arrProducto = array(
                            'idproducto' => $idproducto,
                            'producto' => $arrInfoProducto['Nombre'],
                            'cantidad' => $cantidad,
                            'desc' => $arrInfoProducto['Descripcion'],
                            'precio' => $arrInfoProducto['Precio_Venta'],
                            'Porcentaje_ISV' => $arrInfoProducto['Porcentaje_ISV']

                        );

                        if (isset($_SESSION['arrCarrito'])) {

                            $on = true;
                            $arrCarrito = $_SESSION['arrCarrito'];
                            for ($pr = 0; $pr < count($arrCarrito); $pr++) {
                                if ($arrCarrito[$pr]['idproducto'] == $idproducto) {
                                    $arrCarrito[$pr]['cantidad'] += $cantidad;
                                    $on = false;
                                }
                            }
                            if ($on) {
                                array_push($arrCarrito, $arrProducto);
                            }
                            $_SESSION['arrCarrito'] = $arrCarrito;
                        } else {
                            array_push($arrCarrito, $arrProducto);
                            $_SESSION['arrCarrito'] = $arrCarrito;
                            $_SESSION['contador'] = 0;
                        }

                        foreach ($_SESSION['arrCarrito'] as $pro) {
                            $cantCarrito += $pro['cantidad'];
                        }

                        $htmlCarrito = "";

                        //$htmlCarrito = getFile('Plantilla/Modals/modalCarrito',$_SESSION['arrCarrito']);
                        $arrResponse = array(
                            "status" => true,
                            "msg" => '¡Se agrego el producto!',
                            "cantCarrito" => $cantCarrito

                        );
                    } else {
                        $arrResponse = array("status" => false, "msg" => 'Producto no existente.');
                    }
                } else {
                    $arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
                }
                //dep($_SESSION['arrCarrito'][1]['Porcentaje_ISV'] );
                //die();
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }


    public function getPromocionesR(string $params){ 
        $arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
        $contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
        $data = $this->model->selectPromocionesR ($contenido);//aqui
        ob_end_clean();
        $html = getFile("Template/Modals/reportePromocionesPDF",$data);
        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($html);
        $html2pdf->output();
    
    
    die();
    }

    }
 ?>
