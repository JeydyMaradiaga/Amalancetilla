<?php 

	class Restorer extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login'])){//validamos si existe la variable de session que seria login y lo que va hacer es redireccionar al login 
				header('Location: '.base_url().'/login');//muestra la vista 
			}
			getPermisos(MRESTORE);
		}

		public function restorer()
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get']||  $_SESSION['userData']['id_usuario'] == 1)){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 2;
			$data['page_tag'] = "Restore - Amalancetilla";
			$data['page_title'] = "Restore - Amalancetilla";
			$data['page_name'] = "Restore";
			
			$this->views->getView($this,"restorer",$data);
		}



	}
 ?>