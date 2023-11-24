<?php 
	require 'Libraries/html2pdf/vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;
	class Productos extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MPRODUCTOS);
		}
 
		public function Productos()
		{
			//permiso para ver
			if(empty($_SESSION['permisosMod']['Permiso_Get'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "productos";
			$data['page_title'] = "PRODUCTOS ";
			$data['page_name'] = "productos";
			$data['page_functions_js'] = "functions_productos.js";
			$this->views->getView($this,"productos",$data);
		}

		//codigo para mostrar en la tabla
		public function getProductos()
		{
			if($_SESSION['permisosMod']['Permiso_Get']){
				$arrData = $this->model->selectProductos();
				for ($i=0; $i < count($arrData); $i++) {// recorer todos los elementos del array
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					$arrData[$i]['Precio_Venta'] = SMONEY.' '.formatMoney($arrData[$i]['Precio_Venta']);
					//permiso de update
					if($_SESSION['permisosMod']['Permiso_Update']||  $_SESSION['userData']['id_usuario'] == 1){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['Id_Producto'].')" title="Editar producto">Actualizar</button>';
					}
					//permiso de delete
					if($_SESSION['permisosMod']['Permiso_Delete']||  $_SESSION['userData']['id_usuario'] == 1){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['Id_Producto'].')" title="Eliminar producto">Eliminar</button>';
					}
					$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		} 

			
		public function getProductosR(string $params){
			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
			$data = $this->model->selectProductoR($contenido);
			ob_end_clean();
			$html = getFile("Template/Modals/reportePDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
		
		
		die();

		}
		

		//insertar o actualizar producto


		public function setProducto(){
			if($_POST){//valdar que los campos no esten vacios
				
				
				if(empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) ||  empty($_POST['txtCodigo']) || empty($_POST['txtPrecio']) || empty($_POST['txtMinima'])|| empty($_POST['txtMaxima']) || empty($_POST['listCategoria']) || empty($_POST['listStatus2']) || empty($_POST['listISV']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{

					$idProducto = intval($_POST['idProducto']);
					$strNombre = strClean($_POST['txtNombre']);
					$strDescripcion = strClean($_POST['txtDescripcion']);
					$strCodigo = strClean($_POST['txtCodigo']);
					$strPrecio = strClean($_POST['txtPrecio']);
					$strMinima = strClean($_POST['txtMinima']);
					$strMaxima = strClean($_POST['txtMaxima']);
					$strISV =  intval($_POST['listISV']);
					$intCategoriaId = intval($_POST['listCategoria']);
				
					$intStatus = intval($_POST['listStatus2']);
					$request_producto = "";

					$ruta = strtolower(clear_cadena($strNombre));
					$ruta = str_replace(" ","-",$ruta);


					
					$foto   	 	= $_FILES['foto'];
					$nombre_foto 	= $foto['name'];
					$type 		 	= $foto['type'];
					$url_temp    	= $foto['tmp_name'];
					$imgPortada 	= 'portada_categoria.png';
					$request_cateria = "";
					if($nombre_foto != ''){
						$imgPortada = 'img_'.md5(date('d-m-Y H:i:s')).'.jpg';
					}

					if($idProducto == 0)
					{
						$option = 1;
						if($_SESSION['permisosMod']['Permiso_Insert']){
							$request_producto = $this->model->insertProducto($strNombre, 
																		$strDescripcion,
																		$strCodigo,
																		$strPrecio, 
																		$strMinima,
																		$strMaxima,
																		$strISV,
																		$intCategoriaId,
																		$ruta,
																		$intStatus,$imgPortada );
						}
					}else{
						if($nombre_foto == ''){
							if($_POST['foto_actual'] != 'portada_categoria.png' && $_POST['foto_remove'] == 0 ){
								$imgPortada = $_POST['foto_actual'];
							}
						}
						$option = 2;
						if($_SESSION['permisosMod']['Permiso_Update']){
							$request_producto = $this->model->updateProducto($idProducto,
																		$strNombre,
																		$strDescripcion, 
																		$strCodigo, 
																		$strPrecio, 
																		$strMinima,
																		$strMaxima,
																		$strISV,
																		$intCategoriaId,
																		$ruta,
																		$intStatus,$imgPortada);
						}
					}

					if($request_producto > 0 )
					{
						if($option == 1)
						{
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
							$dataProducto = array(
								
								'codigo' => $strCodigo
							);
							//insert en inventario cuando se agrega un producto nuevo
							$consulta = $this->model->selectproductoN($strCodigo);
							//$producto=$consulta;
							$cantidad= 0;
							$insertInventario = $this->model->InsertInventario($consulta['Id_Producto'], $cantidad);
							
							
							//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
							$fecha_actual = (date("Y-m-d"));
							$UsuarioBt = $_SESSION['userData']['id_usuario'];//aqui es el usuario que hizo el cambio
							$eventoBT = "Registro un nuevo producto"; // evento de si se ingreso, actualizo o elimino 
							$descripcionBT = 'Registro un nuevo producto '; //descripcion de lo que se hizo
				
				
							$objetoBT = 4; //segun la tabla objetos se agrega el dato es decir se pondra el numero indicado de los datos de la dicha tabla
							$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
							//fin bitacora
							
							if($nombre_foto != ''){ uploadImage($foto,$imgPortada); }
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
							//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
							$fecha_actual = (date("Y-m-d"));
							$UsuarioBt = $_SESSION['userData']['id_usuario'];//aqui es el usuario que hizo el cambio
							$eventoBT = "Actualizo un producto"; // evento de si se ingreso, actualizo o elimino 
							$descripcionBT = 'Actualizo un producto '; //descripcion de lo que se hizo
				
				
							$objetoBT = 4; //segun la tabla objetos se agrega el dato es decir se pondra el numero indicado de los datos de la dicha tabla
							$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
							//fin bitacora
							if($nombre_foto != ''){ uploadImage($foto,$imgPortada); }

							if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.png')
								|| ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.png')){
							//	deleteFile($imgPortada);
							}
						}
					}else if($request_cateria == false){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el producto ya existe .');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		

		public function getProductoID(){
					$arrData = $this->model->selectProductoid();
					
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Error.');
						
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			die();
		}
		public function getProducto($idproducto){
			if($_SESSION['permisosMod']['Permiso_Get']){
				$idproducto = intval($idproducto);
				
				if($idproducto > 0){
					$arrData = $this->model->selectProducto($idproducto);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrData['url_portada'] = media().'/images/uploads/'.$arrData['imagen'];//ruta donde se almacena la imagen
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		public function getSelectISV(){
			$htmlOptions = "";
			$arrData = $this->model->selectISV();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					
					$htmlOptions .= '<option value="'.$arrData[$i]['Id_ISV'].'">'.$arrData[$i]['Nombre_ISV'].' - '.$arrData[$i]['Porcentaje_ISV'].'</option>';
					
				}
			}
			echo $htmlOptions;
			die();	
		}



		public function delFile(){
			if($_POST){
				//if(empty($_POST['idproducto']) || empty($_POST['file'])){
				//	$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				//}else{
					//Eliminar de la DB
					$idProducto = intval($_POST['idproducto']);
					$imgNombre  = strClean($_POST['file']);
					$request_image = $this->model->deleteImage($idProducto,$imgNombre);

					if($request_image){
						$deleteFile =  deleteFile($imgNombre);
						$arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
					}
				//}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function delProducto(){
			if($_POST){
				//if($_SESSION['permisosMod']['Permiso_Delete']){
					$intIdproducto = intval($_POST['idProducto']);
					$requestDelete = $this->model->deleteProducto($intIdproducto);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
						$eventoBT = "Elimino un producto"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'Elimino un producto ' ;//descripcion de lo que se hizo
			
						$objetoBT = 4; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el producto porque esta asociado a otras tablas.');
						
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				//}
			}
			die();
		}
	}

 ?>