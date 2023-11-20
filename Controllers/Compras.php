<?php
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class Compras extends Controllers
{

	public function __construct()
	{
		parent::__construct();
		session_start();

		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
			die();
		}

		getPermisos(MCOMPRAS);
	}

	public function Compras()
	{
		if(empty($_SESSION['permisosMod']['Permiso_Get'])){
		header("Location:".base_url().'/dashboard');
			}
		$data['page_tag'] = "Compras";
		$data['page_title'] = "COMPRAS";
		$data['page_name'] = "compras";

		$data['page_functions_js'] = "functions_compras.js";
		$this->views->getView($this, "compras", $data);
	}
    public function getCompras()
	{
		//if($_SESSION['permisosMod']['r']){
		//	$idpersona = "";
		//if( $_SESSION['userData']['idrol'] == RCLIENTES ){
		//	$idpersona = $_SESSION['userData']['idpersona'];
		//	}
		$arrData = $this->model->selectCompras();

		for ($i = 0; $i < count($arrData); $i++) {
			$btnView = '';
			$btnEdit = '';
			$btnDelete = '';

			

			//	if($_SESSION['permisosMod']['r']){

			$btnView .= ' <a title="Ver Detalle" href="' . base_url() . '/compras/orden/' . $arrData[$i]['Id_Compra'] . '" target="_blanck" class="btn btn-info btn-sm"> Ver detalle </a>';

			//	}
			
			//if($_SESSION['permisosMod']['Permiso_Delete']){
			$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol"  onClick="fntDelParametro(' . $arrData[$i]['Id_Compra'] . ')" title="cancelar">Anular</button>
					</div>';
			//}
			//}
			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		//}
		die();
	}

    // para el detalle de compra
	public function orden($idcompra)
	{
		if (!is_numeric($idcompra)) {
			header("Location:" . base_url() . '/compras');
		}
		/*if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$idpersona = "";
		if( $_SESSION['userData']['idrol'] == RCLIENTES ){
			$idpersona = $_SESSION['userData']['idpersona'];
		}*/

		$data['page_tag'] = "Compra";
		$data['page_title'] = "COMPRA";
		$data['page_name'] = "compra";
		$data['arrCompra'] = $this->model->selectCompra($idcompra);
		$this->views->getView($this, "orden", $data);
	}

	public function getSelectProveedores()
	{

		$htmlOptions = "";
		$htmlOptions2 = "";
		$arrData = $this->model->selectProveedores(); 
		$htmlOptions .= '<option value="" disable >--Seleccione--</option>'; //llamar los datos de la tabla
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) { //validacion de los roles
				$htmlOptions .= '<option value="' . $arrData[$i]['Id_Proveedor'] . '">' . $arrData[$i]['Id_Proveedor'] . ' - ' . $arrData[$i]['Nombre_Proveedor'] . ' - ' . $arrData[$i]['RTN_Proveedor'] . '</option>'; //llamar los datos de la tabla

			}
		}
		$htmlOptions2 .= '<option disable> Seleccione un producto</option>';
		//echo $htmlOptions2;
		echo $htmlOptions;
		die();
	}

    // numero de celular
	public function getNumero($idproducto)
	{


		$arrParams = explode(',', $idproducto); // por medio de explode convierte a un arreglo toda la cadena
		$intIdproducto = strClean($arrParams[0]); //valor del arreglo en la posicion 0

		$htmlOptions = "";
		$arrData = $this->model->selectNumero($intIdproducto); // lo que nos devolvera el metodo roles


		if (empty($arrData)) {
			$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
		} else {
			$arrResponse = array('status' => true, 'data' => $arrData);
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}

    //traer productos
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

	//traer precio de productos
	public function getPrecio($idproducto)
	{


		$arrParams = explode(',', $idproducto); // por medio de explode convierte a un arreglo toda la cadena
		$intIdproducto = strClean($arrParams[0]); //valor del arreglo en la posicion 0

		$htmlOptions = "";
		$arrData = $this->model->selectPrecio($intIdproducto); // lo que nos devolvera el metodo precio


		if (empty($arrData)) {
			$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
		} else {
			$arrResponse = array('status' => true, 'data' => $arrData);
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function addCarrito(int $idproducto)
	{
		
		if ($idproducto != 1) {
			dep('2222');
			unset($_SESSION['arrCarrito']);
			unset($_SESSION['totalcompra1']);
			unset($_SESSION['contador']);
			
			die();
		} else {

			if ($_POST) {
 
				$arrCarrito = array();
				$cantCarrito = 0;
				$idproducto = strClean($_POST['idproducto']);
				$cantidad = strClean($_POST['cantidad']);

				if (is_numeric($idproducto) and is_numeric($cantidad)) {
					$arrInfoProducto = $this->model->selectProducto($idproducto);
					if (!empty($arrInfoProducto)) {
						$arrProducto = array(
							'idproducto' => $idproducto,
							'producto' => $arrInfoProducto['Nombre'],
							'cantidad' => $cantidad,
							'Porcentaje_ISV' => $arrInfoProducto['Porcentaje_ISV'],
							'precio' => $arrInfoProducto['Precio_Venta'],
							

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

	public function delCompra()
	{
		if ($_POST) {

			$intParametro = intval($_POST['idCompra']);
			$requestDelete = $this->model->deleteCompra($intParametro);
			if ($requestDelete == 'ok') {
				$arrResponse = array('status' => true, 'msg' => 'Se ha Cancelado el Compra');
				//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
				$fecha_actual = (date("Y-m-d"));
				$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
				$eventoBT = "Elimino compra"; // evento de si se ingreso, actualizo o elimino 
				$descripcionBT = 'Se elimino la compra ';//descripcion de lo que se hizo
	
				$objetoBT = 32; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
				$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
				//fin bitacora

			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al Cancelar el Compra.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getPedidosR(string $params){
			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
			$data = $this->model->selectComprasR($contenido);
			ob_end_clean();
			$html = getFile("Template/Modals/reporteComprasPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
	
	
			die();
		} 

		public function setCompra()
	{

		if ($_POST) {


			//if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES){
			$Fecha = strClean($_POST['txtFechavencimiento']);
			$idUsuario = $_SESSION['userData']['id_usuario']; //
			$idProveedor = intval($_POST['seleccionarProveedor']); //
			$envio = 0;
			$estado = 1;
			$nombreuser = $_SESSION['userData']['Nombre']; //


			$requestRango = '1';//$this->model->selectRangoA(); 
			if ($requestRango == 1) {


				if ($Fecha == "" || $idUsuario == "" || $idProveedor == "" || $nombreuser == "") {

					$arrResponse = array("status" => false, "msg" => "Error de datos");
				} else {
					if (!isset($_SESSION['totalcompra1'])) {

						$arrResponse = array("status" => false, "msg" => "Debe agregar los productos");
					} else {

						$total =  $_SESSION['totalcompra1'];
								$request_compra =  $this->model->insertCompra($idProveedor, $idUsuario, $Fecha, $estado);
								//	dep($_SESSION['arrCarrito']);
								//	die();
								if ($request_compra > 0) {
									//Insertamos detalle
									$contador = 1;
									foreach ($_SESSION['arrCarrito'] as $producto) {
										$productoid = $producto['idproducto'];
										$precio = $producto['precio'];
										$NombreProduc = $producto['producto'];
										$cantidad = $producto['cantidad'];
					
										$request = $this->model->insertDetalle($request_compra, $productoid, $cantidad, $precio,$NombreProduc,$total);
										$contador += 1;
									}

									$orden = ($request_compra);

									$arrResponse = array(
										"status" => true,
										"orden" => $orden,
										"msg" => 'Pedido realizado',
										"idpedido" => $request_compra
										
									);
									//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
									$fecha_actual = (date("Y-m-d"));
									$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
									$eventoBT = "Agregó pedido"; // evento de si se ingreso, actualizo o elimino 
									$descripcionBT = 'Se agregó un nuevo pedido ';//descripcion de lo que se hizo
						
									$objetoBT = 32; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
									$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
									//fin bitacora
								}
							
						
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

			
	


	
}
