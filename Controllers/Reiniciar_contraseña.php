<?php 

	class Reiniciar_contraseña extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Reiniciar_contraseña()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Reiniciar contraseña";
			$data['page_title'] = "";
			$data['page_name'] = "";
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this,"reiniciar_contraseña",$data);
		}

	}
 ?>