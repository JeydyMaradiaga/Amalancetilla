<?php 

require_once("Models/TTipoPago.php");
	class Carrito extends Controllers{
		use TTipoPago;
		public function __construct()
		{	
			
			parent::__construct();
			session_start();
		}

		public function Carrito()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "";
			$data['page_title'] = "";
			$data['page_name'] = "";
			$this->views->getView($this,"carrito",$data);
		}
		public function procesarpago()
		{
			if(empty($_SESSION['arrCarritoT'])){ 
				header("Location: ".base_url());
				die();
			}

			$data['page_tag'] = NOMBRE_EMPESA.' - Procesar Pago';
			$data['page_title'] = 'Procesar Pago';
			$data['page_name'] = "procesarpago";
			$data['tiposPago'] = $this->getTiposPagoT();
			$this->views->getView($this,"procesarpago",$data); 
		}

	}
 ?>