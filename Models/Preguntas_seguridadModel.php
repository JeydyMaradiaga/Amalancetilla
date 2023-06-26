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

		public function InsertParametro(string $Nombre, string $fecha){

			$return = "";
			$this->strNombre = $Nombre;
            $this->strfecha = $fecha;
	
				$query_insert  = "INSERT INTO tbl_ms_preguntas(Pregunta,Fecha_Creacion) VALUES(?,?)";
	        	$arrData = array($this->strNombre, $this->strfecha);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
		
			return $return;
		}	

		public function updateParametro(int $idparametro, string $nombre){
			$this->intIdParametro = $idparametro;
			$this->strParametro = $nombre;
			

			
				$sql = "UPDATE tbl_ms_preguntas SET Pregunta = ? WHERE Id_Pregunta = $this->intIdParametro ";
				$arrData = array($this->strParametro);
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
	}
 ?>