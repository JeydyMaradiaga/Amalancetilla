<?php 
 
	class Permisos extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function getPermisosRol(int $idrol)
		{
			$rolid = intval($idrol);
			if($rolid > 0)
			{
				$arrModulos = $this->model->selectModulos();
				$arrPermisosRol = $this->model->selectPermisosRol($rolid);
				$arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
				$arrPermisoRol = array('idrol' => $rolid );
						//	while (count($arrPermisosRol) < count($arrModulos)){
			//insertar en tabla permisos, mandar el id del rol,mandar el objeto
			//seleccionar id_objeto de la tabla permisos donde idrol = idrol

						//	}

				
				if(empty($arrPermisosRol))
				{
				
					for ($i=0; $i < count($arrModulos) ; $i++) { 

						$arrModulos[$i]['permisos'] = $arrPermisos;
					

					}
				}else{
					for ($i=0; $i < count($arrModulos); $i++) {
						

						$arrPermisos = array('r' => $arrPermisosRol[$i]['Permiso_Get'], 
						'w' => $arrPermisosRol[$i]['Permiso_Insert'], 
						'u' => $arrPermisosRol[$i]['Permiso_Update'], 
						'd' => $arrPermisosRol[$i]['Permiso_Delete'] 
					   );
						if($arrModulos[$i]['Id_Objeto'] == $arrPermisosRol[$i]['Id_Objeto'])
						{
							$arrModulos[$i]['permisos'] = $arrPermisos;
						}
					
					}
				}
				$arrPermisoRol['modulos'] = $arrModulos;
				$html = getModal("modalPermisos",$arrPermisoRol);
	

			}
			die();
		}

		public function setPermisos()
		{
			if($_POST)
			{
				$intIdrol = intval($_POST['idrol']);
				$modulos = $_POST['modulos'];

				$this->model->deletePermisos($intIdrol);
				foreach ($modulos as $modulo) {
					$idModulo = $modulo['idmodulo'];
					$r = empty($modulo['r']) ? 0 : 1;
					$w = empty($modulo['w']) ? 0 : 1;
					$u = empty($modulo['u']) ? 0 : 1;
					$d = empty($modulo['d']) ? 0 : 1;
					$requestPermiso = $this->model->insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d);
				}
				if($requestPermiso > 0)
				{
					$arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible asignar los permisos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
 ?>