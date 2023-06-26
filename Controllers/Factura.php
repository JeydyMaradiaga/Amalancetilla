<?php 
	require 'Libraries/html2pdf/vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;

	class Factura extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			//getPermisos(MPEDIDOS);
		}

		public function generarFactura($idpedido)
		{
			//if($_SESSION['permisosMod']['r']){
				if(is_numeric($idpedido)){
					$idpersona = "";
					//if($_SESSION['permisosMod']['r'] and $_SESSION['userData']['idrol'] == RCLIENTES){
						///$idpersona = $_SESSION['userData']['idpersona'];
					//}
					$data = $this->model->selectPedido($idpedido,$idpersona);

					for ($i=0; $i <count($data['detalle']) ; $i++) { 
					if($data['detalle'][$i]['Promo'] == 1){
						
						$idpromo = $data['detalle'][$i]['Id_Producto'];
						$request = $this->model->selectNombrePromo($idpromo);
						$data['detalle'][$i]['Nombre'] = $request["Nombre"];
						
					}
					}
						

					if(empty($data)){
						echo "Datos no encontrados";
					}else{
						$_SESSION['contador'] = 0;
						$idpedido = $data['orden']['idpedido'];
						ob_end_clean();
						$html = getFile("Template/Modals/factura",$data);
						$html2pdf = new Html2Pdf('p','A4','es','true','UTF-8');
						$html2pdf->writeHTML($html);
						$html2pdf->output('factura-'.$idpedido.'.pdf');
					}
				}else{
					echo "Dato no válido";
				}
			///}else{
//header('Location: '.base_url().'/login');
			//	die();
//}
		}

	}
