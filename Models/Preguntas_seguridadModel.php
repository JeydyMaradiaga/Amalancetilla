<?php 

	class Preguntas_seguridadModel extends Mysql
	{
		public $intIdrol;
		public $strRol;
		public $strDescripcion;
		public $intStatus;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectPreguntas()
		{
		
			$sql = "SELECT * FROM tbl_ms_preguntas ";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selecParametro(int $idparametro)
		{
			//BUSCAR ROLE
			$this->intIdparametro = $idparametro;
			$sql = "SELECT * FROM tbl_ms_preguntas WHERE Id_Pregunta = $this->intIdparametro";
			$request = $this->select($sql);
			return $request;
		}

		public function selectPreguntas_seguridadR($contenido)     // linea 27, 30, 31 y 32 de editaron
		{
           
		$sql = "SELECT * FROM tbl_ms_preguntas
		WHERE Id_Pregunta like '%$contenido%' or 
		Pregunta like '%$contenido%' or 
		Creado_por like '%$contenido%' or
		Fecha_Creacion like '%$contenido%'";
        
		$request = $this->select_all($sql);

		return $request;

		}



		public function InsertParametro(string $Nombre, string $fecha,string $User){

			$return = "";
			$this->strNombre = $Nombre;
            $this->strfecha = $fecha;
			$this->strUser = $User;
	
				$query_insert  = "INSERT INTO tbl_ms_preguntas(Pregunta,Creado_por,Fecha_Creacion) VALUES(?,?,?)";
	        	$arrData = array($this->strNombre,$this->strUser,$this->strfecha);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
		
			return $return;
		}	

		public function updateParametro(int $idparametro, string $nombre,string $User,string $Fecha){
			$this->intIdParametro = $idparametro;
			$this->strParametro = $nombre;
			$this->strUser = $User;
			$this->strFecha = $Fecha;

			
				$sql = "UPDATE tbl_ms_preguntas SET Pregunta = ?,Modificado_Por = ?,Fecha_Modificacion = ? WHERE Id_Pregunta = $this->intIdParametro ";
				$arrData = array($this->strParametro,$this->strUser,$this->strFecha);
				$request = $this->update($sql,$arrData);
		
		    return $request;			
		}

		public function deleteParametro(int $idparametro)
		{
			$this->IntParametro = $idparametro;
	
				$sql = "DELETE  FROM  tbl_ms_preguntas WHERE Id_Pregunta = $this->IntParametro ";
				$arrData = array(0);
				$request = $this->delete($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
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