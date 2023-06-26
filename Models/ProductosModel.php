<?php 

	class ProductosModel extends Mysql
	{
		private $intIdProducto;
		private $strNombre;
		private $strDescripcion;

		private $intCodigo;
		private $intCategoriaId;
		private $intPrecio;
		//private $intStock;
		private $intStatus;
		private $strRuta;
		private $strImagen;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectProductos(){
			$sql = "SELECT p.Id_Producto,
							p.codigo,
							p.Nombre,
							p.Descripcion,
							p.Id_Categoria,
							c.Nombre_Categoria as tbl_categoria_productos,
							p.Precio_Venta,
							p.status 
					FROM tbl_productos p 
					INNER JOIN tbl_categoria_productos c
					ON p.Id_Categoria = c.Id_Categoria_Producto
					

					WHERE p.status != 0 ";// va a atraer los  productos que no esten marcados como eliminados
					$request = $this->select_all($sql);
					
			return $request;
		}	

		public function insertProducto(string $Nombre, string $Descripcion, int $codigo, string $Precio_Venta, int $strISV, int $Id_Categoria, string $ruta, int $status,string $imagen){
			
			$this->intCategoriaId = $Id_Categoria;
			$this->intCodigo = $codigo;
			$this->strNombre = $Nombre;
			$this->strDescripcion = $Descripcion;
			$this->strPrecio = $Precio_Venta;
			
			$this->strISV = $strISV;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$this->imagen = $imagen;
			
			
			$return = 0;
			$sql = "SELECT * FROM tbl_productos WHERE codigo = '{$this->intCodigo}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO tbl_productos(Id_Categoria,
														codigo,
														Nombre,
														Descripcion,
														Precio_Venta,
														
														Id_ISV,
														ruta,
														status,
														imagen) 
								  VALUES(?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->intCategoriaId,
        						$this->intCodigo,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
								
								$this->strISV,
        						$this->strRuta,
        						$this->intStatus,
								$this->imagen);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		
		
		public function selectISV(){
			
			$sql = "SELECT * FROM tbl_impuestos";
			$request = $this->select_all($sql);
			return $request;
		}

		public function updateProducto(int $idproducto, string $nombre, string $descripcion, int $codigo,string $precio, string $isv, int $categoriaid,  string $ruta, int $status, string $imagen){
			
			$this->intIdProducto = $idproducto;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			
			$this->strISV = $isv;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$this->imagen = $imagen;
			$return = 0;
			$sql = "SELECT * FROM tbl_productos WHERE codigo = '{$this->intCodigo}' AND Id_Producto != $this->intIdProducto ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE tbl_productos 
						SET Id_Categoria=?,
							codigo=?,
							Nombre=?,
							Descripcion=?,
							Precio_Venta=?,
							
							Id_ISV =?,
							ruta=?,
							status=?,
							imagen =?
						WHERE Id_Producto = $this->intIdProducto ";
				$arrData = array($this->intCategoriaId,
								$this->intCodigo,
				                $this->strNombre,
						
								$this->strDescripcion,
        						
        						$this->strPrecio,
								
								$this->strISV, 
        						$this->strRuta,
        						$this->intStatus,
								$this->imagen);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
			}else{
				$return = "exist";
			}
	        return $return;
		}


	
		public function selectProductoR($contenido)
		{

		$sql = "SELECT * FROM tbl_productos 
		WHERE Id_producto like '%$contenido%' or 
		Nombre like '%$contenido%' or 
        Descripcion like '%$contenido%' or 
        Precio_Venta like '%$contenido%' or
         
        status like '%$contenido%'"; 
        
		$request = $this->select_all($sql);

		return $request;

		}
		public function selectProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT p.Id_Producto,
							p.codigo,
							p.Nombre,
							
							p.imagen,
							P.Id_ISV,
							p.Descripcion,
							p.Precio_Venta,
							p.Id_Categoria,
							c.Nombre_categoria as tbl_Categoria_Productos,
							p.status
					FROM tbl_productos p
					INNER JOIN tbl_Categoria_Productos c
					ON p.Id_Categoria = c.Id_Categoria_producto
					WHERE Id_producto = $this->intIdProducto";
			$request = $this->select($sql);
			
			return $request;

		}

		
		public function insertImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(productoid,img) VALUES(?,?)";
	        $arrData = array($this->intIdProducto,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
			
	        return $request_insert;
		}
		
		public function selectProductoid(){
			
			$sql = "SELECT MAX(Id_Producto) as Id_Producto FROM `tbl_productos` ";
			$request = $this->select($sql);
			return $request;
		}

		public function selectImages(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT productoid,img
					FROM imagen
					WHERE productoid = $this->intIdProducto";
			$request = $this->select_all($sql);
			return $request;
		}

		
		public function deleteImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE productoid = $this->intIdProducto 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "DELETE  FROM tbl_productos WHERE Id_producto = $this->intIdProducto  ";
			$arrData = array(0);
			$request = $this->delete($sql,$arrData);
			return $request;
		}
	}
 ?>