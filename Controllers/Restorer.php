<?php 

	class Restorer extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login'])){//validamos si existe la variable de session que seria login y lo que va hacer es redireccionar al login 
				header('Location: '.base_url().'/login');//muestra la vista 
			}
		}

		public function restorer()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Restore - Amalancetilla";
			$data['page_title'] = "Restore - Amalancetilla";
			$data['page_name'] = "Restore";
			
			$this->views->getView($this,"restorer",$data);
		}



	}
 ?>