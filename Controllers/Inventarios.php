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
			getPermisos(MPRODUCTOS);
		}
        
        public function Inventarios()
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get'])){
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
                    $min = $arrData[$i]['Cantidad_Minima'];
                    $max = $arrData[$i]['Cantidad_Maxima'];
                    $cant = $arrData[$i]['Cantidad_Existente'];
                    if ($cant <= $min) {
                        $btnEdit = '<input type="color" value="#ff0000" placeholder="Poco" style="color: blue;"/>';
                    } elseif ($cant > $min && $cant <= $max) {
                        $btnEdit = '<input type="color" value="#008000" />';
                    } else {
                        $btnEdit = '<input type="color" value="#000080" />';
                    }
					//if($_SESSION['permisosMod']['Permiso_Update']){
						//$btnEdit = '<input type="color" value="#ff0000" />';
					//}
					//if($_SESSION['permisosMod']['Permiso_Delete']){	
						
					//}
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
        
    }

?>