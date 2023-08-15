<?php 
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
    class Cardexs extends Controllers{
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
        
        public function Cardexs()
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Cardexs";
			$data['page_title'] = "KARDEX";
			$data['page_name'] = "cardexs";
			$data['page_functions_js'] = "functions_cardex.js";
			$this->views->getView($this,"cardexs",$data);
		}

        public function getCardexs()
		{
			//if($_SESSION['permisosMod']['Permiso_Get']){
				$arrData = $this->model->selectCardexs();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					//if($_SESSION['permisosMod']['Permiso_Update']){
						
					//}
					//if($_SESSION['permisosMod']['Permiso_Delete']){	
						
					//}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			//}
			die();
		}

        public function getCardexR(string $params){ 
			$arrParams = explode(',', $params); // por medio de explode convierte a un arreglo toda la cadena
			$contenido = strClean($arrParams[0]); //valor del arreglo en la posicion 0
			$data = $this->model->selectCardexR ($contenido);//aqui
			ob_end_clean();
			$html = getFile("Template/Modals/reporteCardexsPDF",$data);
			$html2pdf = new Html2Pdf();
			$html2pdf->writeHTML($html);
			$html2pdf->output();
		
		
		die();
		}



    }

?>