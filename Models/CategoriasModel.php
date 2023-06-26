<?php 

	class CategoriasModel extends Mysql
	{
		public $intIdcategoria;
		public $strCategoria;
		public $strDescripcion;
		public $intStatus;
		public $strPortada;


		public function __construct()
		{
			parent::__construct();
		}

		public function inserCategoria(string $nombre, string $descripcion, int $status, string $portada){

			$return = 0;
			$this->strCategoria = $nombre;
			$this->strDescripcion = $descripcion;
			$this->strPortada = $portada;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tbl_categoria_productos WHERE Nombre_Categoria = '{$this->strCategoria}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tbl_categoria_productos(Nombre_Categoria,Descripcion,Estado,Foto_Categoria) VALUES(?,?,?,?)";
	        	$arrData = array($this->strCategoria, 
								 $this->strDescripcion, 
								 $this->intStatus,
								 $this->strPortada);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = false;
			}
			return $return;
		}

		public function selectCategorias()
		{
			$sql = "SELECT * FROM tbl_categoria_productos 
					WHERE Estado != 0 ";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectCategoria(int $idcategoria){
			$this->intIdcategoria = $idcategoria;
			$sql = "SELECT * FROM tbl_categoria_productos
					WHERE Id_Categoria_Producto = $this->intIdcategoria";
			$request = $this->select($sql);
			return $request;
		}

		public function updateCategoria(int $idcategoria, string $categoria, string $descripcion, int $status, string $portada){
			$this->intIdcategoria = $idcategoria;
			$this->strCategoria = $categoria;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;
			$this->strPortada = $portada;

			$sql = "SELECT * FROM tbl_categoria_productos WHERE Nombre_Categoria = '{$this->strCategoria}'AND Id_categoria_Producto <> $this->intIdcategoria";
			$request = $this->select_all($sql);
			

			if(empty($request))
			{
				$sql = "UPDATE tbl_categoria_productos SET Nombre_Categoria = ?, Descripcion = ?, Estado = ?, Foto_Categoria = ?  WHERE Id_Categoria_Producto = $this->intIdcategoria ";
				$arrData = array($this->strCategoria, 
								 $this->strDescripcion, 
								 $this->intStatus,
								 $this->strPortada);
				$request = $this->update($sql,$arrData);
			}else{
				$request = false;
			}
			
			
		    return $request;	
			
		}

		public function deleteCategoria(int $idcategoria)
		{
			$this->intIdcategoria = $idcategoria;
			$sql = "SELECT * FROM tbl_productos WHERE Id_Categoria = $this->intIdcategoria";
			$request = $this->select_all($sql);
			if(empty($request))
			{
			$sql = "DELETE  FROM tbl_categoria_productos WHERE Id_Categoria_Producto = $this->intIdcategoria ";
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
		public function selectCategoriaR($contenido)
		{

		$sql = "SELECT * FROM tbl_categoria_productos 
		WHERE Id_Categoria_Producto like '%$contenido%' or 
		Nombre_Categoria like '%$contenido%' or 
        Descripcion like '%$contenido%' or 
        Estado like '%$contenido%'";
        
		$request = $this->select_all($sql);

		return $request;

		}

		public function getCategoriasFooter(){
			$sql = "SELECT Id_Categoria_Producto, Nombre_Categoria, Descripcion, Foto_Categoria
					FROM tbl_categoria_productos WHERE  Estado = 1 AND Id_Categoria_Producto IN (".CAT_FOOTER.")";
			$request = $this->select_all($sql);
			if(count($request) > 0){
				for ($c=0; $c < count($request) ; $c++) { 
					$request[$c]['portada'] = BASE_URL.'/Assets/images/uploads/'.$request[$c]['portada'];		
				}
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