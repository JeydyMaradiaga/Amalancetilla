<?php 

	class Dashboard extends Controllers{
		public function __construct()
		{
			parent::__construct();
			
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			
		}

		public function dashboard()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard - Amalancetilla";
			$data['page_title'] = "Dashboard - Amalancetilla";
			$data['page_name'] = "dashboard";
			$data['page_functions_js'] = "functions_dashboard.js";
			$this->views->getView($this,"dashboard",$data);
		}

		public function getUltimosP(){

			//if($_SESSION['permisosMod']['Permiso_Get']){
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData = $this->model->selectUltimosP();

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		//	}
			die();


		}
		public function getPedidosP(){

			//if($_SESSION['permisosMod']['Permiso_Get']){
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData = $this->model->selectPedidosP();

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		//	}
			die();


		}

	}
