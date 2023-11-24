<?php 
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
    class Inventarios extends Controllers{
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
			getPermisos(MINVENTARIO);
		}
        
        public function Inventarios()
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get']||  $_SESSION['userData']['id_usuario'] == 1)){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Inventarios";
			$data['page_title'] = "INVENTARIOS";
			$data['page_name'] = "inventarios";
			$data['page_functions_js'] = "functions_inventario.js";
			$this->views->getView($this,"inventarios",$data);
		}


        public function getInventarios()
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$arrData = $this->model->selectInventarios();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';
					$alerta = '';
					$alertaverde = '';
					$alertaroja = '';
                    $min = $arrData[$i]['Cantidad_Minima'];
                    $max = $arrData[$i]['Cantidad_Maxima'];
                    $cant = $arrData[$i]['Cantidad_Existente'];
                    if ($cant <= $min) {
                        $alerta = '<button type="button" class="btn btn-outline-danger">El inventario es escaso.</button>';
                    } elseif ($cant > $min && $cant <= $max) {
                        $alerta = '<button type="button" class="btn btn-outline-success">El inventario es adecuado.</button>';
                    } else {
                        $alerta = '<button type="button" class="btn btn-outline-info">El inventario es alto.</button>';
                    }
					$btnEdit= ' <a title="Ver Detalle" href="' . base_url() . '/inventarios/kardexs/' . $arrData[$i]['Nombre'] . '" target="_blanck" class="btn btn-info btn-sm"> Ver kardex </a>';
					//if($_SESSION['permisosMod']['Permiso_Update']){
						//$btnEdit = '<input type="color" value="#ff0000" />';
					//}
					//if($_SESSION['permisosMod']['Permiso_Delete']){	
						
					//}
					$arrData[$i]['alertas'] = '<div class="text-center">'.$alerta.'</div>';
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			//}
			die();
		}

		public function getInventarioR(string $params){ 
			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
			$data = $this->model->selectInventarioR ($contenido);//aqui
			ob_end_clean();
			$html = getFile("Template/Modals/reporteInventariosPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
		
		
		die();
		}

		public function kardexs()
	{
		//if(empty($_SESSION['permisosMod']['r'])){
		//header("Location:".base_url().'/dashboard');
		//	}
		$data['page_tag'] = "kardexs";
		$data['page_title'] = "kardexs";
		$data['page_name'] = "kardex";

		$data['page_functions_js'] = "functions_kardex.js";
		$this->views->getView($this, "kardexs", $data);
	}

	

        
    }

?>