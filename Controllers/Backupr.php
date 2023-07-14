<?php 

	class Backupr extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login'])){//validamos si existe la variable de session que seria login y lo que va hacer es redireccionar al login 
				header('Location: '.base_url().'/login');//muestra la vista 
			}
		}

		public function backupr()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Backupr - Amalancetilla";
			$data['page_title'] = "Backupr - Amalancetilla";
			$data['page_name'] = "Backupr";
			
			$this->views->getView($this,"backupr",$data);
		}



	}
 ?>