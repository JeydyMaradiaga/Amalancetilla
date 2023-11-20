<?php 

	class ParametrosModel extends Mysql
	{
		public $intIdrol;
		public $strRol;
		public $strDescripcion;
		public $intStatus;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectParametros()
		{
		
			$sql = "SELECT * FROM tbl_ms_parametros ";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selecParametro(int $idparametro)
		{
			//BUSCAR ROLE
			$this->intIdparametro = $idparametro;
			$sql = "SELECT * FROM tbl_ms_parametros WHERE Id_Parametro = $this->intIdparametro";
			$request = $this->select($sql);
			return $request;
		}

		public function InsertParametro(string $Nombre, string $descripcion, string $UsuarioBt, int $valor, string $fecha){

			$return = "";
			$this->strNombre = $Nombre;
            $this->strfecha = $fecha;
			$this->strDescripcion = $descripcion;
			$this->strUsuarioBt = $UsuarioBt;
			$this->intValor = $valor;

			$sql = "SELECT * FROM tbl_ms_parametros WHERE Nombre_Parametro = '{$this->strNombre}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tbl_ms_parametros(Nombre_Parametro,Descripcion,Creado_Por,Valor_Parametro,Fecha_Creacion) VALUES(?,?,?,?,?)";
	        	$arrData = array($this->strNombre, $this->strDescripcion, $this->strUsuarioBt, $this->intValor, $this->strfecha);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateParametro(int $idparametro, string $nombre, string $descripcion, int $valor, string $UsuarioBt, string $fecha){
			$this->intIdParametro = $idparametro;
			$this->strParametro = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intValor = $valor;
			$this->strUsuarioBt = $UsuarioBt;
			$this->strfecha = $fecha;
			$sql = "SELECT * FROM tbl_ms_parametros WHERE Nombre_Parametro = '$this->strParametro' AND Id_Parametro != $this->intIdParametro";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE tbl_ms_parametros SET Nombre_Parametro = ?, Descripcion = ?, Valor_Parametro = ?,Modificado_Por = ?, Fecha_Modificado = ? WHERE Id_Parametro = $this->intIdParametro ";
				$arrData = array($this->strParametro, $this->strDescripcion, $this->intValor, $this->strUsuarioBt, $this->strfecha);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteParametro(int $idparametro)
		{
			$this->IntParametro = $idparametro;
			$sql = "SELECT * FROM tbl_ms_parametros WHERE Id_Parametro = $this->IntParametro and Id_Parametro < 5";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "DELETE  FROM  tbl_ms_parametros WHERE Id_Parametro = $this->IntParametro ";
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