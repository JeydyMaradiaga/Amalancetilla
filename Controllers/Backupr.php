<?php 

	class Backupr extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login'])){//validamos si existe la variable de session que seria login y lo que va hacer es redireccionar al login 
				header('Location: '.base_url().'/login');//muestra la vista 
			}
			getPermisos(MBACKUP);
		}
 
		public function backupr()
		{
			if(empty($_SESSION['permisosMod']['Permiso_Get'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 2;
			$data['page_tag'] = "Backupr - Amalancetilla";
			$data['page_title'] = "Backupr - Amalancetilla";
			$data['page_name'] = "Backupr";
			
			$this->views->getView($this,"backupr",$data);
		}



	}
 ?>