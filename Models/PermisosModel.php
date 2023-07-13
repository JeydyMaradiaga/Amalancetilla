<?php 

	 class PermisosModel extends Mysql
	{
		public $intIdpermiso;
		public $intRolid;
		public $intModuloid;
		public $r;
		public $w;
		public $u;
		public $d;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectModulos()
		{
			$sql = "SELECT * FROM tbl_ms_objetos";
			$request = $this->select_all($sql);
			return $request;
		}	
		public function selectPermisosRol(int $idrol)
		{
			$this->intRolid = $idrol;
			$sql = "SELECT * FROM tbl_ms_permisos WHERE Id_Rol = $this->intRolid";
			$request = $this->select_all($sql);
			
			
			return $request;
			
		}

		public function deletePermisos(int $idrol)
		{
			$this->intRolid = $idrol;
			$sql = "DELETE FROM tbl_ms_permisos WHERE Id_Rol = $this->intRolid";
			$request = $this->delete($sql);
			return $request;
		}

		public function insertPermisos(int $idrol, int $idmodulo, int $r, int $w, int $u, int $d){
			$this->intRolid = $idrol;
			$this->intModuloid = $idmodulo;
			$this->r = $r;
			$this->w = $w;
			$this->u = $u;
			$this->d = $d;
			$query_insert  = "INSERT INTO tbl_ms_permisos(Id_Rol,Id_Objeto,Permiso_Get,Permiso_Insert,Permiso_Update,Permiso_Delete) VALUES(?,?,?,?,?,?)";
        	$arrData = array($this->intRolid, $this->intModuloid, $this->r, $this->w, $this->u, $this->d);
        	$request_insert = $this->insert($query_insert,$arrData);		
	        return $request_insert;
		}
		public function permisosModulo(int $idrol){
			$this->intRolid = $idrol;
			$sql = "SELECT p.Id_Rol,
						   p.Id_Objeto,
						   m.Nombre_Objeto as tbl_ms_objetos,
						   p.Permiso_Get,
						   p.Permiso_Insert,
						   p.Permiso_Update,
						   p.Permiso_Delete 
					FROM tbl_ms_permisos p 
					INNER JOIN tbl_ms_objetos m
					ON p.Id_Objeto = m.Id_Objeto
					WHERE p.Id_Rol = $this->intRolid";
			$request = $this->select_all($sql);
			$arrPermisos = array();
			for ($i=0; $i < count($request); $i++) { 
				$arrPermisos[$request[$i]['Id_Objeto']] = $request[$i];
			}
			return $arrPermisos;
		}

		public function getRol(int $idrol){
			$this->intRolid = $idrol;
			$sql = "SELECT * FROM tbl_ms_rol WHERE Id_Rol = $this->intRolid";
			$request = $this->select($sql);
			return $request;
		}
	}
 ?>