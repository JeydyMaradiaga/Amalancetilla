<?php
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class Producciones extends Controllers
{

	public function __construct()
	{
		parent::__construct();
		session_start();

		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
			die();
		}

		//getPermisos(MPRODUCCION);
	}

	public function Producciones()
	{
		//if(empty($_SESSION['permisosMod']['Permiso_Get'])){
			//header("Location:".base_url().'/dashboard');
		//}
		$data['page_tag'] = "Produccioness";
		$data['page_title'] = "PRODUCCIONES";
		$data['page_name'] = "producciones";
		$data['page_functions_js'] = "functions_producciones.js";
		$this->views->getView($this,"producciones",$data);
	}
	
    public function getProducciones()
	{
		//if($_SESSION['permisosMod']['r']){
		//	$idpersona = "";
		//if( $_SESSION['userData']['idrol'] == RCLIENTES ){
		//	$idpersona = $_SESSION['userData']['idpersona'];
		//	}
		$arrData = $this->model->selectProducciones();

		for ($i = 0; $i < count($arrData); $i++) {
			$btnView = '';
			$btnEdit = '';
			$btnDelete = '';

			

			//	if($_SESSION['permisosMod']['r']){

			$btnView .= ' <a title="Ver Detalle" href="' . base_url() . '/producciones/orden/' . $arrData[$i]['Id_Produccion'] . '" target="_blanck" class="btn btn-info btn-sm"> Ver detalle </a>';

			//	}
			
			//if($_SESSION['permisosMod']['Permiso_Delete']){
			$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol"  onClick="fntDelParametro(' . $arrData[$i]['Id_Produccion'] . ')" title="cancelar">Anular</button>
					</div>';
			//}
			//}
			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		//}
		die();
	}

	public function getSelectUsuarios()
	{

		$htmlOptions = "";
		$htmlOptions2 = "";
		$arrData = $this->model->selectUsuarios(); // lo que nos devolvera el metodo roles
		$htmlOptions .= '<option value="" disable >--Seleccione--</option>'; //llamar los datos de la tabla
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) { //validacion de los roles
				$htmlOptions .= '<option value="' . $arrData[$i]['id_usuario'] . '">' . $arrData[$i]['id_usuario '] . '  ' . $arrData[$i]['Nombre'] . '</option>'; //llamar los datos de la tabla

			}
		}
		$htmlOptions2 .= '<option disable> Seleccione un Usuario</option>';
		//echo $htmlOptions2;
		echo $htmlOptions;
		die();
	}

	public function getSelectProductos()
	{ 

		$htmlOptions = "";
		$htmlOptions .= '<option value="" disable >--Seleccione--</option>'; //llamar los datos de la tabla

		$arrData = $this->model->selectProductos1(); // lo que nos devolvera el metodo roles
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) { //validacion de los roles
				$htmlOptions .= '<option onClick="fntgetPrecio(this,' . $arrData[$i]['Id_Producto'] . ')" value="' . $arrData[$i]['Id_Producto'] . '">' . $arrData[$i]['Nombre'] . '</option>'; //llamar los datos de la tabla

			}
		}
		echo $htmlOptions;
		die();
	}

	public function getSelectProductos2()
	{ 

		$htmlOptions = "";
		$htmlOptions .= '<option value="" disable >--Seleccione--</option>'; //llamar los datos de la tabla

		$arrData = $this->model->selectProductos2(); // lo que nos devolvera el metodo roles
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) { //validacion de los roles
				$htmlOptions .= '<option onClick="fntgetPrecio(this,' . $arrData[$i]['Id_Producto'] . ')" value="' . $arrData[$i]['Id_Producto'] . '">' . $arrData[$i]['Nombre'] . '</option>'; //llamar los datos de la tabla

			}
		}
		echo $htmlOptions;
		die();
	}

	public function addCarrito(int $idproducto)
	{
		
		if ($idproducto != 1) {
			dep('2222');
			unset($_SESSION['arrCarrito']);
			unset($_SESSION['contador']);
			
			die();
		} else {

			if ($_POST) {

				$arrCarrito = array();
				$cantCarrito = 0;
				$idproducto = strClean($_POST['idproducto']);
				$cantidad = strClean($_POST['cantidad']);
				$consultatipo = $this->model->selecttipo($idproducto);
				if (is_numeric($idproducto) and is_numeric($cantidad)) {
					$arrInfoProducto = $this->model->selectProducto($idproducto);
					if (!empty($arrInfoProducto)) {
						$arrProducto = array(
							'idproducto' => $idproducto,
							'producto' => $arrInfoProducto['Nombre'],
							'cantidad' => $cantidad,
							'tipo' => $consultatipo['Id_Categoria']
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
	public function addCarrito1(int $idproducto)
	{
		
		if ($idproducto != 1) {
			dep('2222');
			unset($_SESSION['arrCarrito']);
			unset($_SESSION['contador']);
			
			die();
		} else {

			if ($_POST) {

				$arrCarrito = array();
				$cantCarrito = 0;
				$idproducto = strClean($_POST['idproducto']);
				$cantidad = strClean($_POST['cantidad']);
				$consulta = $this->model->selectcantidadp($idproducto);
				$consultatipo = $this->model->selecttipo($idproducto);

				if ($consulta['Cantidad_Existente'] >= $cantidad){
					if (is_numeric($idproducto) and is_numeric($cantidad)) {
						$arrInfoProducto = $this->model->selectProducto($idproducto);
						if (!empty($arrInfoProducto)) {
							$arrProducto = array(
								'idproducto' => $idproducto,
								'producto' => $arrInfoProducto['Nombre'],
								'cantidad' => $cantidad,
								'tipo' => $consultatipo['Id_Categoria']
							);

							if (isset($_SESSION['arrCarrito'])) {

								$on = true;
								$arrCarrito = $_SESSION['arrCarrito'];
								for ($pr = 0; $pr < count($arrCarrito); $pr++) {
									if ($arrCarrito[$pr]['idproducto'] == $idproducto) {
										$arrCarrito[$pr]['cantidad'] += $cantidad;
										$consulta = $this->model->selectcantidadp($arrCarrito[$pr]['idproducto']); //trae la cantidad en inventario del producto
										if($arrCarrito[$pr]['cantidad'] > $consulta['Cantidad_Existente']){
											$cont=1;
											$arrResponse = array("status" => false, "msg" => 'Insumo Insuficiente para agregar al carrito de nuevo.');
                							// Aquí podrías mostrar $mensajeError en la interfaz al usuario, por ejemplo, con un mensaje de error en rojo.
               								// También puedes decidir no agregar el producto al carrito si hay cantidad insuficiente.
											//die();
										}
										$on = false;
									}
								}
								if(empty($arrResponse)){
									if ($on) {
										array_push($arrCarrito, $arrProducto);
									}
									$_SESSION['arrCarrito'] = $arrCarrito;
								}
							} else {
								array_push($arrCarrito, $arrProducto);
								$_SESSION['arrCarrito'] = $arrCarrito;
								$_SESSION['contador'] = 0;
							}

							if(empty($arrResponse)){
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
							}
						} else {
							$arrResponse = array("status" => false, "msg" => 'Producto no existente.');
						}
					} else {
						$arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
					}
				}else{
					$arrResponse = array("status" => false, "msg" => 'Insumo Insuficiente.');
				}
				//dep($_SESSION['arrCarrito'][1]['Porcentaje_ISV'] );
				//die();
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}

	public function delProduccion()

    {
        if ($_POST) {

            $intParametro = intval($_POST['idProduccion']);
            $requestDelete = $this->model->deleteProduccion($intParametro);
            if ($requestDelete == 'ok') {
                $arrResponse = array('status' => true, 'msg' => 'Se ha Cancelado la producción');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al Cancelar la producción.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

	public function orden($idproduccion)

    {
        if (!is_numeric($idproduccion)) {
            header("Location:" . base_url() . '/producciones');
        }
        /*if(empty($_SESSION['permisosMod']['r'])){
            header("Location:".base_url().'/dashboard');
        }
        $idpersona = "";
        if( $_SESSION['userData']['idrol'] == RCLIENTES ){
            $idpersona = $_SESSION['userData']['idpersona'];
        }*/
        $data['page_tag'] = "Produccion";
        $data['page_title'] = "PRODUCCION ";
        $data['page_name'] = "producciones";
        $data['arrProduccion'] = $this->model->selectProduccion($idproduccion);
        $this->views->getView($this, "orden", $data);
    }

	public function setProduccion()
	{

		if ($_POST) {


			//if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES){
			$Fecha = strClean($_POST['txtFechavencimiento']);
			$idUsuario = $_SESSION['userData']['id_usuario']; //
			$estado = 1;
			$nombreuser = $_SESSION['userData']['Nombre']; //
			$Movimiento =  0 ;


			$requestRango = '1';//$this->model->selectRangoA(); 
			if ($requestRango == 1) {


				if ($Fecha == "" || $idUsuario == "" || $nombreuser == "") {

					$arrResponse = array("status" => false, "msg" => "Error de datos");
				} else {
								$request_Produccion =  $this->model->insertProduccion($idUsuario, $Fecha, $estado);
								//	dep($_SESSION['arrCarrito']);
								//	die();
								if ($request_Produccion > 0) {
									//Insertamos detalle
									$contador = 1;
									foreach ($_SESSION['arrCarrito'] as $producto) {
										$productoid = $producto['idproducto'];
										$NombreProduc = $producto['producto'];
										$cantidad = $producto['cantidad'];
										$Movimiento = $producto['tipo'];
										if($producto['tipo'] == 1){
											$Movimiento = 1;
										}else{
											$Movimiento = 2;
										}
					
										$request = $this->model->insertDetalle($request_Produccion, $productoid, $cantidad,$Movimiento);
										$contador += 1;
									}

									$orden = ($request_Produccion);

									$arrResponse = array(
										"status" => true,
										"orden" => $orden,
										"msg" => 'Produccion realizada',
										"idProduccion" => $request_Produccion
										//bitacora
									);
								}
							
						
					
				}
			} else {

				$arrResponse = array("status" => false, "msg" => "Error");
			}

			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			//}
		}
		die();
	}

	public function getProduccionesR(string $params){

        $arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena

        $contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0

        $data = $this->model->selectProduccionesR($contenido);

        ob_end_clean();

        $html = getFile("Template/Modals/reporteProduccionesPDF",$data);

        $html2pdf = new Html2Pdf();

        $html2pdf->writeHTML($html);

        $html2pdf->output();

 

 

        die();

    }

}