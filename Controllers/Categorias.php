<?php
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
	class Categorias extends Controllers{
		
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
			getPermisos(MCATEGORIAS);
		}

		public function Categorias()
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Categorias";
			$data['page_title'] = "CATEGORIAS";
			$data['page_name'] = "categorias";
			$data['page_functions_js'] = "functions_categorias.js";
			$this->views->getView($this,"categorias",$data);
		}
		
		//codigo para mostrar en la tabla
		//codigo para mostrar en la tabla
		public function getCategoriaR(string $params){
			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
			$data = $this->model->selectCategoriaR ($contenido);
			ob_end_clean();
			$html = getFile("Template/Modals/reporteCategoriasPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
		
		
		die();
		}

		public function setCategoria(){
			if($_POST){
				if(empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					
					$intIdcategoria = intval($_POST['idCategoria']);
					$strCategoria =  strClean($_POST['txtNombre']);
					$strDescipcion = strClean($_POST['txtDescripcion']);
					$intStatus = intval($_POST['listStatus']);

					//$ruta = strtolower(clear_cadena($strCategoria));
					//$ruta = str_replace(" ","-",$ruta);

					$foto   	 	= $_FILES['foto'];
					$nombre_foto 	= $foto['name'];
					$type 		 	= $foto['type'];
					$url_temp    	= $foto['tmp_name'];
					$imgPortada 	= 'portada_categoria.png';
					$request_cateria = "";
					if($nombre_foto != ''){
						$imgPortada = 'img_'.md5(date('d-m-Y H:i:s')).'.jpg';
					}

					
					if($intIdcategoria == 0)
					
					{
						//Crear
						if($_SESSION['permisosMod']['Permiso_Insert']){
							$request_cateria = $this->model->inserCategoria($strCategoria, $strDescipcion,$intStatus,$imgPortada);
							$option = 1;
					
						}
					}else{
						//Actualizar
						if($_SESSION['permisosMod']['Permiso_Update']){
							if($nombre_foto == ''){
								if($_POST['foto_actual'] != 'portada_categoria.png' && $_POST['foto_remove'] == 0 ){
									$imgPortada = $_POST['foto_actual'];
								}
							}
							$request_cateria = $this->model->updateCategoria($intIdcategoria,$strCategoria, $strDescipcion,$intStatus,$imgPortada);
							$option = 2;
						}
					}
				//	dep($request_cateria);
			//		die();
					if($request_cateria >= 1 )
					{
						if($option == 1)
						{
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
							//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
							$fecha_actual = (date("Y-m-d"));
							$UsuarioBt = $_SESSION['userData']['id_usuario'];//aqui es el usuario que hizo el cambio
							$eventoBT = "Registro Categoria de productos"; // evento de si se ingreso, actualizo o elimino 
							$descripcionBT = 'El usuario ' . $_SESSION['userData']['Nombre'] . ' agrego una nueva categoria '. $strCategoria .''; //descripcion de lo que se hizo
				
				
							$objetoBT = 5; //segun la tabla objetos se agrega el dato es decir se pondra el numero indicado de los datos de la dicha tabla
							$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
							//fin bitacora
							if($nombre_foto != ''){ uploadImage($foto,$imgPortada); }
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
							//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
							$fecha_actual = (date("Y-m-d"));
							$UsuarioBt = $_SESSION['userData']['id_usuario'];//aqui es el usuario que hizo el cambio
							$eventoBT = "Actualizo Categoria de productos"; // evento de si se ingreso, actualizo o elimino 
							$descripcionBT = 'El usuario ' . $_SESSION['userData']['Nombre'] . ' Actualizo una categoria de productos '. $strCategoria .''; //descripcion de lo que se hizo
				
				
							$objetoBT = 5; //segun la tabla objetos se agrega el dato es decir se pondra el numero indicado de los datos de la dicha tabla
							$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
							//fin bitacora
							if($nombre_foto != ''){ uploadImage($foto,$imgPortada); }

							if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.png')
								|| ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.png')){
								deleteFile($_POST['foto_actual']);
							}
						}
					}else if($request_cateria == false){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! La categoría ya existe .');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCategorias()
		{
			if($_SESSION['permisosMod']['Permiso_Get']){
				$arrData = $this->model->selectCategorias();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['Estado'] == 1)
					{
						$arrData[$i]['Estado'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['Estado'] = '<span class="badge badge-danger">Inactivo</span>';
					}

		
				//	}
					if($_SESSION['permisosMod']['Permiso_Update']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['Id_Categoria_Producto'].')" title="Editar categoría">Actualizar</button>';
					}
					if($_SESSION['permisosMod']['Permiso_Delete']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['Id_Categoria_Producto'].')" title="Eliminar categoría">Eliminar</button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCategoria($idcategoria)
		{
			if($_SESSION['permisosMod']['Permiso_Get']){
				$intIdcategoria = intval($idcategoria);
				if($intIdcategoria > 0)
				{
					$arrData = $this->model->selectCategoria($intIdcategoria);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrData['url_portada'] = media().'/images/uploads/'.$arrData['Foto_Categoria'];//ruta donde se almacena la imagen
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function delCategoria()
		{
			if($_POST){
				if($_SESSION['permisosMod']['Permiso_Delete']){
					$intIdcategoria = intval($_POST['idCategoria']);
					$requestDelete = $this->model->deleteCategoria($intIdcategoria);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la categoría');
						//bitacora este codigo se pondra en cada uno de las acciones si se agrego o si actualizo o si se elimmino
						$fecha_actual = (date("Y-m-d"));
						$UsuarioBt = $_SESSION['userData']['id_usuario'];  //aqui es el usuario que hizo el cambio
						$eventoBT = "Elimino Categoria de productos"; // evento de si se ingreso, actualizo o elimino 
						$descripcionBT = 'El usuario ' . $_SESSION['userData']['Nombre'] . ' Elimino Categoria de productos '. $intIdcategoria .'';//descripcion de lo que se hizo
			
						$objetoBT = 5; //le manda el valor de 1 que significa que esta en el objeto de login, eso varia depende donde se encuentre el usuario
						$insertBitacora = $this->model->bitacora($UsuarioBt, $objetoBT, $eventoBT, $descripcionBT, $fecha_actual); //hace el insert en bitacora
						//fin bitacora
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una categoría con productos asociados.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		//funcion que se manda para el producto muestre las diversas categoriasque existe
		public function getSelectCategorias(){
			$htmlOptions = "";
			$arrData = $this->model->selectCategorias();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['Estado'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['Id_Categoria_Producto'].'">'.$arrData[$i]['Nombre_Categoria'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();	
		}

	}


 ?>