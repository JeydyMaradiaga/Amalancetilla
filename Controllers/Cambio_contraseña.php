<?php 

	class Cambio_contraseña extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Cambio_contraseña()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Cambio_contraseña";
			$data['page_title'] = "";
			$data['page_name'] = "Cambiar contraseña ";
			$this->views->getView($this,"cambio_contraseña",$data);
		}

	}
 ?>