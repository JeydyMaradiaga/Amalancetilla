<?php 

	class ObjetosModel extends Mysql
	{
		public $intIdrol;
		public $strRol;
		public $strDescripcion;
		public $intStatus;

		public function __construct()
		{
			parent::__construct();
		}
		
		public function selectObjetos()
		{
		
			$sql = "SELECT * FROM tbl_ms_objetos";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectObjeto(int $idparametro)
		{
			//BUSCAR ROLE
			$this->intIdparametro = $idparametro;
			$sql = "SELECT * FROM tbl_ms_objetos WHERE Id_Objeto = $this->intIdparametro";
			$request = $this->select($sql);
			return $request;
		}

		public function InsertObjeto(string $Nombre, string $descripcion, string $UsuarioBt, string $fecha, int $idrol){

			$return = "";
			$this->strNombre = $Nombre;
			$this->intIdrol = $idrol;
			$this->strUsuarioBt = $UsuarioBt;
            $this->strfecha = $fecha;
			$this->strDescripcion = $descripcion;
			

			$sql = "SELECT * FROM tbl_ms_objetos WHERE Nombre_Objeto = '{$this->strNombre}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tbl_ms_objetos(Nombre_Objeto,Descripcion,Creado_Por,Fecha_Creacion,Id_Rol) VALUES(?,?,?,?,?)";
	        	$arrData = array($this->strNombre, $this->strDescripcion, $this->strUsuarioBt, $this->strfecha,$this->intIdrol);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	
		public function selectroles()
		{
		
			$sql = "SELECT Id_Rol FROM tbl_ms_rol ";
			$request = $this->select_all($sql);
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

		public function updateObjeto(int $idparametro, string $nombre, string $descripcion){
			$this->intIdParametro = $idparametro;
			$this->strParametro = $nombre;
			$this->strDescripcion = $descripcion;
		

			$sql = "SELECT * FROM tbl_ms_objetos WHERE Nombre_Objeto = '$this->strParametro' AND Id_Objeto != $this->intIdParametro";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE tbl_ms_objetos SET Nombre_Objeto = ?, Descripcion = ? WHERE Id_Objeto = $this->intIdParametro ";
				$arrData = array($this->strParametro, $this->strDescripcion);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteParametro(int $idparametro)
		{
			$this->IntParametro = $idparametro;
			$sql = "SELECT * FROM tbl_ms_objetos WHERE Id_Objeto = $this->IntParametro and Id_Objeto < 6";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "DELETE  FROM  tbl_ms_objetos WHERE Id_Objeto = $this->IntParametro ";
				$arrData = array(0);
				$request = $this->delete($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}

		public function bitacora(int $intIdUsuario,int $objeto,string $evento, string $descripcion, string $fecha){
			$this->intIdusuario = $intIdUsuario;
			$this->strEvento = $evento;
			$this->strObjeto = $objeto;
			$this->strDescripcion = $descripcion;
			$this->strFecha = $fecha;
	
			$sql = "INSERT INTO tbl_ms_bitacora (Id_Usuario, Id_Objeto, Accion, Descripcion, Fecha)
			 VALUES (?,?,?,?,?)";
				$arrData = array($this->intIdusuario,
				$this->strObjeto,
				$this->strEvento,
				$this->strDescripcion,
				$this->strFecha);
				$request = $this->insert($sql,$arrData);
				return $request;
		}
	}
 ?>