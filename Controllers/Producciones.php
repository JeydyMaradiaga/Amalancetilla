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

		getPermisos(MCOMPRAS);
	}

	public function Producciones()
	{
		if(empty($_SESSION['permisosMod']['Permiso_Get'])){
			header("Location:".base_url().'/dashboard');
		}
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
				if (is_numeric($idproducto) and is_numeric($cantidad)) {
					$arrInfoProducto = $this->model->selectProducto($idproducto);
					if (!empty($arrInfoProducto)) {
						$arrProducto = array(
							'idproducto' => $idproducto,
							'producto' => $arrInfoProducto['Nombre'],
							'cantidad' => $cantidad,

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

	public function setProduccion()
	{

		if ($_POST) {


			//if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES){
			$Fecha = strClean($_POST['txtFechavencimiento']);
			$idUsuario = $_SESSION['userData']['id_usuario']; //
			$estado = 1;
			$nombreuser = $_SESSION['userData']['Nombre']; //
			$Movimiento =  1 ;


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

}