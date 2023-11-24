<?php
require_once("Models/TTipoPago.php");
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class Pedidos extends Controllers
{
	use TTipoPago;
	public function __construct()
	{
		parent::__construct();
		session_start();

		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
			die();
		}

		getPermisos(MPEDIDOS);
	}

	public function Pedidos()
	{
		if(empty($_SESSION['permisosMod']['Permiso_Get']||  $_SESSION['userData']['id_usuario'] == 1)){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Pedidos";
		$data['page_title'] = "PEDIDOS";
		$data['page_name'] = "pedidos";

		$data['page_functions_js'] = "functions_pedidos.js";
		$this->views->getView($this, "pedidos", $data);
	}

	public function getPedidos()
	{
		//if($_SESSION['permisosMod']['r']){
		//	$idpersona = "";
		//if( $_SESSION['userData']['idrol'] == RCLIENTES ){
		//	$idpersona = $_SESSION['userData']['idpersona'];
		//	}
		$arrData = $this->model->selectPedidos();

		for ($i = 0; $i < count($arrData); $i++) {
			$btnView = '';
			$btnEdit = '';
			$btnDelete = '';


			$arrData[$i]['Total'] = SMONEY . formatMoney($arrData[$i]['Total']);


			if($_SESSION['permisosMod']['Permiso_Update']||  $_SESSION['userData']['id_usuario'] == 1){

			$btnView .= ' <a title="Ver Detalle" href="' . base_url() . '/pedidos/orden/' . $arrData[$i]['Id_Pedido'] . '" target="_blanck" class="btn btn-info btn-sm"> Ver detalle </a>

						<a title="Generar PDF" href="' . base_url() . '/factura/generarFactura/' . $arrData[$i]['Id_Pedido'] . '" target="_blanck" class="btn btn-warning btn-sm">Generar factura </a> ';

			}
			if($_SESSION['permisosMod']['Permiso_Update']||  $_SESSION['userData']['id_usuario'] == 1){
			$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['Id_Pedido'] . ')" title="Editar pedido">Editar</button>';
			}
			if($_SESSION['permisosMod']['Permiso_Delete']||  $_SESSION['userData']['id_usuario'] == 1){
			$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol"  onClick="fntDelParametro(' . $arrData[$i]['Id_Pedido'] . ')" title="Eliminar">Anular</button>
					</div>';
			}
			//}
			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		//}
		die();
	}

	public function orden($idpedido)
	{
		if (!is_numeric($idpedido)) {
			header("Location:" . base_url() . '/pedidos');
		}
		/*if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$idpersona = "";
		if( $_SESSION['userData']['idrol'] == RCLIENTES ){
			$idpersona = $_SESSION['userData']['idpersona'];
		}*/

		$data['page_tag'] = "Pedido";
		$data['page_title'] = "PEDIDO ";
		$data['page_name'] = "pedido";
		$data['arrPedido'] = $this->model->selectPedido($idpedido);
		$this->views->getView($this, "orden", $data);
	}

	public function transaccion($transaccion)
	{
		//if (empty($_SESSION['permisosMod']['r'])) {
			//header("Location:" . base_url() . '/dashboard');
		//}
		$idpersona = "";
		if ($_SESSION['userData']['idrol'] == RCLIENTES) {
			$idpersona = $_SESSION['userData']['idpersona'];
		}
		$requestTransaccion = $this->model->selectTransPaypal($transaccion, $idpersona);
		$data['page_tag'] = "Detalles de la transacción - Tienda Virtual";
		$data['page_title'] = "Detalles de la transacción";
		$data['page_name'] = "detalle_transaccion";
		$data['page_functions_js'] = "functions_pedidos.js";
		$data['objTransaccion'] = $requestTransaccion;
		$this->views->getView($this, "transaccion", $data);
	}

	public function getTransaccion(string $transaccion)
	{
		//if ($_SESSION['permisosMod']['r'] and $_SESSION['userData']['idrol'] != RCLIENTES) {
			if ($transaccion == "") {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$transaccion = strClean($transaccion);
				$requestTransaccion = $this->model->selectTransPaypal($transaccion);
				if (empty($requestTransaccion)) {
					$arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
				} else {
					//	$htmlModal = getFile("Template/Modals/modalReembolso",$requestTransaccion);
					///	$arrResponse = array("status" => true, "html" => $htmlModal);
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		//}
		die();
	}

	public function setDetalle()
	{

		if ($_POST) {
			//	if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES){

			$cantidad = strClean($_POST['cantidad']);
			$idCliente = strClean($_POST['idcliente']);
			$precio = strClean($_POST['precio']);
			$idproducto = strClean($_POST['idproducto']);
			$total = $cantidad * $precio;
			$idUsuario = $_SESSION['userData']['id_usuario'];
			$nombreuser = $_SESSION['userData']['Nombre'];
			$formapago = strClean($_POST['idformapago']);
			$estado = 3;
			$fecha = (date("Y-m-d"));

			//dep($_POST);
			//die();
			$requestInsertPedidotemporal = $this->model->insertPedidoTemp($idCliente, $idproducto, $cantidad);
			$idpedido2 = $requestInsertPedidotemporal;
			$_SESSION['arrPedido'] = $this->model->selectPedidotemp($idCliente);


			if ($requestInsertPedidotemporal) {
				$arrResponse = array('status' => true, 'data' => $idpedido2, "msg" => "Producto agregado con exito");
			} else {
				$arrResponse = array("status" => false, "msg" => "No es posible insertar el producto.");
			}

			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	public function delParametro()
	{
		if ($_POST) {

			$intParametro = intval($_POST['idParametro']);
			$requestDelete = $this->model->deletePedido($intParametro);
			if ($requestDelete == 'ok') {
				$arrResponse = array('status' => true, 'msg' => 'Se ha Cancelado el pedido');
				//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
				$fecha_actual = (date("Y-m-d"));
				$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
				$eventoBT = "Elimino pedido"; // evento de si se ingreso, actualizo o elimino 
				$descripcionBT = 'Se elimino el pedido ';//descripcion de lo que se hizo
	
				$objetoBT = 25; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
				$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
				//fin bitacora
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el pedido.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function addCarrito2(int $idproducto)
	{
	
		unset($_SESSION['descuento']);
		if ($idproducto != 1) {
			dep('2222');
			unset($_SESSION['arrCarrito']);
			unset($_SESSION['totalpedido1']);
			unset($_SESSION['contador']);
			unset($_SESSION['descuento']);
			die();
		} else {

			if ($_POST) {

				$arrCarrito = array();
				$cantCarrito = 0;
				
				$idproducto = strClean($_POST['idproducto']);
				$idpromocion = $idproducto;
				$cantPromociones = $this->model->selectcantidadPromocion($idproducto);//trae la cantidad de la tabla promociones
				$requestProducto = $this->model->selectProductop($idproducto);//trae el id del producto de la tabla promocion
				$idproducto = $requestProducto['Id_Producto'];
				$consulta = $this->model->selectcantidadN($idproducto); //trae la cantidad en inventario del producto

				$requestisv = $this->model->selectISV($requestProducto['Id_Producto']);
				$isvReal =$requestisv['Porcentaje_ISV'];
				$precio_normal=0;
				//$precio_normal = $requestisv['Precio_Venta']; 
				//$descuentodepromocion = $this->model->selectcantidadPromocion($idproducto);
				$cantidad = strClean($_POST['cantidad']);
				//$invetarioReal = strClean($_POST['inventario']);
				$cantidadtotal= ($cantidad * $cantPromociones['Cantidad_Promocion']);
				$_SESSION['descuento'] = strClean($_POST['descuento']);
				if ($consulta['Cantidad_Existente'] >= $cantidadtotal){
					if (is_numeric($idproducto) and is_numeric($cantidad)) {
						$arrInfoProducto = $this->model->selectPromociontotal($idproducto,$idpromocion);
						//dep($arrInfoProducto[0]['Nombre']);
						//die();
						
						if (!empty($arrInfoProducto)) {
							$arrProducto = array(
								'idproducto' => $idproducto,
								'producto' => $arrInfoProducto[0]['Nombre'],
								'cantidad' => $cantidad,
								'Cantidad_Promocion' => $cantidadtotal,
								'precio' => $precio_normal,
								'precio_Promocion'  => $arrInfoProducto[0]['Precio'],
								'Porcentaje_ISV' => $isvReal,
								'inventario' => $consulta['Cantidad_Existente']
							);

							if (isset($_SESSION['arrCarrito'])) {

								$on = true;
								$arrCarrito = $_SESSION['arrCarrito'];
								for ($pr = 0; $pr < count($arrCarrito); $pr++) {
									if ($arrCarrito[$pr]['idproducto'] == $idproducto && $arrCarrito[$pr]['Cantidad_Promocion'] > 0) {
										$arrCarrito[$pr]['cantidad'] += $cantidad;
										$arrCarrito[$pr]['Cantidad_Promocion'] += $cantPromociones['Cantidad_Promocion'];
										$consulta = $this->model->selectcantidadN($arrCarrito[$pr]['idproducto']); //trae la cantidad en inventario del producto
										if($arrCarrito[$pr]['Cantidad_Promocion'] > $consulta['Cantidad_Existente']){
											$cont=1;
											$arrResponse = array("status" => false, "msg" => 'Producto Insuficiente para agregar al carrito de nuevo.');
											//$mensajeError = "No se puede agregar el producto. Cantidad insuficiente en inventario.";
                							// Aquí podrías mostrar $mensajeError en la interfaz al usuario, por ejemplo, con un mensaje de error en rojo.
               								// También puedes decidir no agregar el producto al carrito si hay cantidad insuficiente.
											// die();
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
					$arrResponse = array("status" => false, "msg" => 'Producto Insuficiente para agregar la promocion.');
				}
				//dep($_SESSION['arrCarrito'][1]['Porcentaje_ISV'] );
				//die();
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}
	public function addCarrito(int $idproducto)
	{
		unset($_SESSION['descuento']);
		if ($idproducto != 1) {
			dep('2222');
			unset($_SESSION['arrCarrito']);
			unset($_SESSION['totalpedido1']);
			unset($_SESSION['contador']);
			unset($_SESSION['descuento']);
			//unset($_SESSION['arrInventarioT']);
			//unset($_SESSION['contadorI']);
			die();
		} else {

			if ($_POST) {

				$arrCarrito = array();
				$cantCarrito = 0;
				$idproducto = strClean($_POST['idproducto']);
				$cantidad = strClean($_POST['cantidad']);
				// $arrInventarioT = array();
				// $cantInventario = 0;
				
				
				
				// //inventario carrito
				// if (is_numeric($idproducto) and is_numeric($cantidad)){
				// 	$arrInfoInventario = $this->model->selectInventario($idproducto);
				// 	if (!empty($arrInfoInventario)) {
						
				// 		$arrInventario = array(
				// 			'idinventario' => $arrInfoInventario['Id_Inventario'], //1
				// 			'idproductoI' => $arrInfoInventario['Id_Producto'], //21
				// 			'cant_existenteI' => $arrInfoInventario['Cantidad_Existente'] //2
				// 		);

				// 		if (isset($_SESSION['arrInventarioT'])) {
				// 			$on = true;
				// 			$arrInventarioT = $_SESSION['arrInventarioT'];//
				// 			for ($pr = 0; $pr < count($arrInventarioT); $pr++) {
				// 				if ($arrInventarioT[$pr]['Id_Producto'] == $arrInfoInventario['Id_Producto']) {
									
				// 					if($arrInfoInventario['Cantidad_Existente'] > $cantidad){ //cambio aqui tambien de > a >=
				// 						$arrInventarioT[$pr]['Cantidad_Existente'] -= $cantidad;
				// 					} else{
				// 						$arrResponse = array("status" => false, "msg" => 'Producto Insuficiente en inventario.');
				// 					}
			
				// 					$on = false;
				// 				}

				// 			}
				// 			if(empty($arrResponse)){
				// 				if ($on) {
				// 					array_push($arrInventarioT, $arrInventario);
				// 				}
				// 				$_SESSION['arrInventarioT'] = $arrInventarioT;
				// 			}

				// 		} else {

				// 			if($arrInfoInventario['Cantidad_Existente'] >= $cantidad){ //cambio de > a >= 
				// 				$totalinventario = ($arrInfoInventario['Cantidad_Existente'] - $cantidad);
				// 				$arrInventario = array(
				// 					'idinventario' => $arrInfoInventario['Id_Inventario'], //1
				// 					'idproductoI' => $arrInfoInventario['Id_Producto'], //21
				// 					'cant_existenteI' =>  $totalinventario//2
				// 				);
				// 				//$arrInventarioT['Cantidad_Existente'] -= $cantidad;
				// 				array_push($arrInventarioT, $arrInventario);
				// 				$_SESSION['arrInventarioT'] = $arrInventarioT;
				// 				$_SESSION['contadorI'] = 0;
				// 			} else {
				// 				$arrResponse = array("status" => false, "msg" => 'Producto Insuficiente en inventario.');
				// 			}
							
								
				// 		}

				// 	} else {
				// 		$arrResponse = array("status" => false, "msg" => 'Inventario no existente.');
				// 	}
				// }

				//inventario carrito
				$cantidaproducto=0;
				$preciopromocion=0;
				$_SESSION['descuento'] = strClean($_POST['descuento']);
				$consulta = $this->model->selectcantidadN($idproducto);
				if ($consulta['Cantidad_Existente'] >= $cantidad){

					if (is_numeric($idproducto) and is_numeric($cantidad)) {
						$arrInfoProducto = $this->model->selectProducto($idproducto);
						if (!empty($arrInfoProducto)) {
							$arrProducto = array(
								'idproducto' => $idproducto,
								'producto' => $arrInfoProducto['Nombre'],
								'cantidad' => $cantidad,
								'Cantidad_Promocion' => $cantidaproducto,
								'precio' => $arrInfoProducto['Precio_Venta'],
								'precio_Promocion'  => $preciopromocion,
								'Porcentaje_ISV' => $arrInfoProducto['Porcentaje_ISV'],
								'inventario' => $consulta['Cantidad_Existente']
							);

							if (isset($_SESSION['arrCarrito'])) {

								$on = true;
								$arrCarrito = $_SESSION['arrCarrito'];
								for ($pr = 0; $pr < count($arrCarrito); $pr++) {
									if ($arrCarrito[$pr]['producto'] == $arrInfoProducto['Nombre']) {
										$arrCarrito[$pr]['cantidad'] += $cantidad;
										$consulta = $this->model->selectcantidadN($arrCarrito[$pr]['idproducto']); //trae la cantidad en inventario del producto
										if($arrCarrito[$pr]['cantidad'] > $consulta['Cantidad_Existente']){
											$cont=1;
											$arrResponse = array("status" => false, "msg" => 'Producto Insuficiente para agregar al carrito de nuevo.');
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
					$arrResponse = array("status" => false, "msg" => 'Producto Insuficiente.');
				}
				//dep($_SESSION['arrCarrito'][1]['Porcentaje_ISV'] );
				//die();
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}
	public function getPedidosR(string $params){
		$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
		$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
		$data = $this->model->selectPedidosR($contenido);
		ob_end_clean();
		$html = getFile("Template/Modals/reportePedidosPDF",$data);
		$html2pdf = new Html2Pdf();
		$html2pdf->writeHTML($html);
		$html2pdf->output();
	
	
	die();
} 




	public function getPedidou(string $pedido)
	{

		if ($pedido == "") {
			$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
		} else {
			$requestPedido = $this->model->selectPedido($pedido);
			if (empty($requestPedido)) {
				$arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
			} else {
				$requestPedido['TipoPago'] = $this->getTiposPagoT();
				$htmlModal = getFile("Template/Modals/modalUpedidos", $requestPedido);
				$arrResponse = array("status" => true, "html" => $htmlModal);
			}
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

		die();
	}

	public function getSelectClientes()
	{

		$htmlOptions = "";
		$htmlOptions2 = "";
		$arrData = $this->model->selectClientes(); // lo que nos devolvera el metodo roles
		$htmlOptions .= '<option value="" disable >--Seleccione--</option>'; //llamar los datos de la tabla
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) { //validacion de los roles
				$htmlOptions .= '<option value="' . $arrData[$i]['Id_Cliente'] . '">' . $arrData[$i]['Id_Cliente'] . ' - ' . $arrData[$i]['Numero_ID'] . ' - ' . $arrData[$i]['Nombre'] . '</option>'; //llamar los datos de la tabla

			}
		}
		$htmlOptions2 .= '<option disable> Seleccione un producto</option>';
		//echo $htmlOptions2;
		echo $htmlOptions;
		die();
	}
	public function getPrecioPromocion($idpromocion)
	{


		$arrParams = explode(',', $idpromocion); // por medio de explode convierte a un arreglo toda la cadena
		$intIdproducto = strClean($arrParams[0]); //valor del arreglo en la posicion 0

		$htmlOptions = "";
		$arrData = $this->model->selectpromocion($intIdproducto); // lo que nos devolvera el metodo roles


		if (empty($arrData)) {
			$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
		} else {
			$arrResponse = array('status' => true, 'data' => $arrData);
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}
	public function getPrecio($idproducto)
	{


		$arrParams = explode(',', $idproducto); // por medio de explode convierte a un arreglo toda la cadena
		$intIdproducto = strClean($arrParams[0]); //valor del arreglo en la posicion 0

		$htmlOptions = "";
		$arrData = $this->model->selectPrecio($intIdproducto); // lo que nos devolvera el metodo roles


		if (empty($arrData)) {
			$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
		} else {
			$arrResponse = array('status' => true, 'data' => $arrData);
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}

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

	public function getSelectForma()
	{

		$htmlOptions = "";
		$arrData = $this->model->selectForma(); // lo que nos devolvera el metodo roles
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) { //validacion de los roles
				$htmlOptions .= '<option value="' . $arrData[$i]['Id_Forma_Pago'] . '">' . $arrData[$i]['Nombre'] . '</option>'; //llamar los datos de la tabla

			}
		}
		echo $htmlOptions;
		die();
	}

	public function getSelectDescuentos()
	{

		$htmlOptions = "";
		$htmlOptions .= '<option value=""> Sin Descuento </option>'; //llamar los datos de la tabla
		$arrData = $this->model->selectDescuentos(); // lo que nos devolvera el metodo roles
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) { //validacion de los roles
				$htmlOptions .= '<option value="' . $arrData[$i]['Porcentaje_Deduccion'] . '">' . $arrData[$i]['Nombre'] . ' -> ' . $arrData[$i]['Porcentaje_Deduccion'] . ' % </option>'; //llamar los datos de la tabla

			}
		}
		echo $htmlOptions;
		die();
	}
	public function getTempo()
	{

		die();
	}

	public function getPedido(string $pedido)
	{
		//if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES){
		if ($pedido == "") {
			$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
		} else {
			$requestPedido = $this->model->selectPedido($pedido);
			//	dep($requestPedido );
			//	die();
			if (empty($requestPedido)) {
				$arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
			} else {
				//$requestPedido['tipospago'] = $this->getTiposPagoT();

				$htmlModal = getFile("Template/Modals/modalPedido", $requestPedido);

				$arrResponse = array("status" => true, "html" => $htmlModal);
			}
			//}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	public function getFactura()
	{
		//if($_SESSION['permisosMod']['Permiso_Get']){
		$data = $this->model->selectProductos();
		//dep($arrData );
		//die();

		ob_end_clean();
		$html = getFile("Template/Modals/reportePedidosPDF", $data);
		$html2pdf = new Html2Pdf();
		$html2pdf->writeHTML($html);
		$html2pdf->output();

		//}
		die();
	}

	public function setPedido()
	{

		if ($_POST) {


			//if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES){
			$Fecha = strClean($_POST['txtFechavencimiento']);
			$formapago = intval($_POST['SelectForma']); //
			$idUsuario = $_SESSION['userData']['id_usuario']; //
			$idCliente = intval($_POST['seleccionarCliente']); //
			$envio = 0;
			$factura = ($_POST['opcion']);
			$estado = 1;
			$nombreuser = $_SESSION['userData']['Nombre']; //
			//$descuento =intval($_POST['selectDescuento']);

			$requestRango = '1';//$this->model->selectRangoA(); 
			if ($requestRango == 1) {


				if ($Fecha == "" || $formapago == "" || $idUsuario == "" || $idCliente == "" || $factura == "" || $nombreuser == "") {

					$arrResponse = array("status" => false, "msg" => "Error de datos");
				} else {
					if (!isset($_SESSION['totalpedido1'])) {

						$arrResponse = array("status" => false, "msg" => "Debe agregar los productos o promociones");
					} else {

						$total =  $_SESSION['totalpedido1'];

 
						if ($factura == 1) {

							$idCai = 1;

							$requestUpdateCAI = $this->model->UpdateRangoA($idCai);
							if ($requestUpdateCAI != 2) {
								$numFactura = $requestUpdateCAI[0]['Rango_Actual'];
								$request_pedido =  $this->model->insertPedido($idCliente, $idUsuario, $estado, $nombreuser, $Fecha, $total, $envio, $numFactura, $formapago);
								//$consultadescuento = $this->model->selectdescuento($descuento);
								//$descuentototal = $consultadescuento['Porcentaje_Deduccion'];
								//$TotalDeducion= $total * $descuentototal;
								//$request_Descuentos = $this->model->insertDescuento($request_pedido, $descuento);
								//	dep($_SESSION['arrCarrito']);
								//	die(); 
								if ($request_pedido > 0) {
									//Insertamos detalle
									$contador = 1;
									foreach ($_SESSION['arrCarrito'] as $producto) {
										$productoid = $producto['idproducto'];
										
										$precio = $producto['precio'];
										if($producto['precio_Promocion'] == 0){
											$precio = $producto['precio'];
										}else{
											$precio = $producto['precio_Promocion'];
										}

										if($producto['Cantidad_Promocion'] == 0){
											$cantidad = $producto['cantidad'];
										}else{
											$cantidad = $producto['Cantidad_Promocion'];
										}
										// //esto hace que el inventario nunca este negativo
										// $consulta = $this->model->selectcantidadN($productoid); //trae la cantidad en inventario del producto
										// if($cantidad > $consulta['Cantidad_Existente']){
										// 	$cantidad=0;
										// }
										// //fin
										$porcentajeisv = $producto['Porcentaje_ISV'];

										$isv = $this->model->selectIDPorcentaje($producto['Porcentaje_ISV']);
										$request = $this->model->insertDetalle($request_pedido, $productoid, $isv['Id_ISV'], $porcentajeisv, $precio, $cantidad);
										$contador += 1;
									}

									$orden = ($request_pedido);

									$arrResponse = array(
										"status" => true,
										"orden" => $orden,
										"msg" => 'Pedido realizado',
										"idpedido" => $request_pedido
										//bitacora
									);
								}
							}
						} else {
							if ($factura == 2) {
								$numFactura = 0;
								$request_pedido =  $this->model->insertPedido($idCliente, $idUsuario, $estado, $nombreuser, $Fecha, $total, $envio, $numFactura, $formapago);
								//	dep($_SESSION['arrCarrito']);
								//	die();
								if ($request_pedido > 0) {
									//Insertamos detalle
									$contador = 1;
									foreach ($_SESSION['arrCarrito'] as $producto) {
										$productoid = $producto['idproducto'];
										
										$precio = $producto['precio'];
										if($producto['precio_Promocion'] == 0){
											$precio = $producto['precio'];
										}else{
											$precio = $producto['precio_Promocion'];
										}

										if($producto['Cantidad_Promocion'] ==0){
											$cantidad = $producto['cantidad'];
										}else{
											$cantidad = $producto['Cantidad_Promocion'];
										}

										// //esto hace que el inventario nunca este negativo
										// $consulta = $this->model->selectcantidadN($productoid); //trae la cantidad en inventario del producto
										// if($cantidad > $consulta['Cantidad_Existente']){
										// 	$cantidad=0;
										// }
										// //fin
										$porcentajeisv = $producto['Porcentaje_ISV'];

										$isv = $this->model->selectIDPorcentaje($producto['Porcentaje_ISV']);
										$request = $this->model->insertDetalle($request_pedido, $productoid, $isv['Id_ISV'], $porcentajeisv, $precio, $cantidad);
										$contador += 1;
									}

									$orden = ($request_pedido);

									$arrResponse = array(
										"status" => true,
										"orden" => $orden,
										"msg" => 'Pedido realizado',
										"idpedido" => $request_pedido
										//bitacora
									);
									//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
									$fecha_actual = (date("Y-m-d"));
									$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
									$eventoBT = "Agregó pedido"; // evento de si se ingreso, actualizo o elimino 
									$descripcionBT = 'Se agregó un nuevo pedido ';//descripcion de lo que se hizo
						
									$objetoBT = 25; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
									$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
									//fin bitacora
								}
							} else {
								$numFactura = 1;
								$arrResponse = array("status" => false, "msg" => "Error al generar factura, la fecha de vencimiento de CAI a expirado");
							}
						}
					}
				}
			} else {

				$arrResponse = array("status" => false, "msg" => "Error, no se puede generar la factura,Favor revisar configuracion de talonario CAI.");
			}

			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			//}
		}
		die();
	}
	public function setPedidoUpdate()
	{
		if ($_POST) {


			$idpedido = !empty($_POST['idpedido']) ? intval($_POST['idpedido']) : "";
			$estado = !empty($_POST['listEstado']) ? strClean($_POST['listEstado']) : "";
			$idtipopago =  !empty($_POST['listTipopago']) ? intval($_POST['listTipopago']) : "";
			$transaccion = !empty($_POST['txtTransaccion']) ? strClean($_POST['txtTransaccion']) : "";

			if ($idpedido == "") {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {


				$requestPedido = $this->model->updatePedido($idpedido, $idtipopago, $estado);
				if ($requestPedido) {
					$arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente");
					//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
					$fecha_actual = (date("Y-m-d"));
					$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
					$eventoBT = "Actualizó pedido"; // evento de si se ingreso, actualizo o elimino 
					$descripcionBT = 'Se actualizó el pedido ';//descripcion de lo que se hizo
		
					$objetoBT = 25; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
					$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
					//fin bitacora
				} else {
					$arrResponse = array("status" => false, "msg" => "No es posible actualizar la información.");
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}
