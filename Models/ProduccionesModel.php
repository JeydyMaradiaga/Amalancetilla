<?php 
	class ProduccionesModel extends Mysql
	{
		private $objCategoria;
		public function __construct()
		{
			parent::__construct();
		}

		public function selectProducciones(){

			$request = array();
			$sql = "SELECT
			p.Id_Produccion as Id_Produccion,
			p.Fecha as Fecha,
			p.Estado_Produccion as Estado_Produccion,
			i.Nombre as Id_Usuario
			FROM tbl_produccion p
			INNER JOIN tbl_ms_usuarios i ON i.Id_Usuario = p.Id_Usuario";
           
			$request = $this->select_all($sql);
			return $request;

		}	
		public function selectProduccion(int $idProduccion){
			
			$request = array();
			$sql = "SELECT p.Id_Produccion,
			i.Nombre_Proveedor as Id_Proveedor,
			o.Nombre as Id_Usuario,
			p.Fecha_Produccion as Fecha_Produccion,
			l.Total as Total,
			p.Estado_Produccion as Estado_Produccion,
			i.Direccion_Proveedor
			FROM tbl_Produccion p 
			INNER JOIN tbl_proveedor i ON i.Id_Proveedor = p.Id_Proveedor 
			INNER JOIN tbl_ms_usuarios o ON o.id_usuario = p.Id_Usuario 
			INNER JOIN tbl_detalle_Produccion l ON p.Id_Produccion = l.Id_Produccion
			 WHERE p.Id_Produccion =  $idProduccion ";
			$requestProduccion= $this->select_all($sql);
			//dep($requestProduccion);
				//	die();
					if(!empty($requestProduccion))
				{
					$idproveedor = 1;
					$sql_proveedor = "SELECT * FROM tbl_proveedor WHERE Id_Proveedor  = $idproveedor";
					$requestproveedor = $this->select_all($sql_proveedor);
					$sql_detalle = "SELECT d.Id_Detalle_Produccion,
												d.Nombre_Producto_Producciondo as Nombre,
												d.Precio_Costo,
												d.Cantidad_Produccionda
										FROM tbl_detalle_Produccion d
										WHERE d.Id_Produccion = $idProduccion";
					$requestProductos = $this->select_all($sql_detalle);
					$request = array('proveedor' => $requestproveedor,'orden' => $requestProduccion,'detalle' => $requestProductos);
				
				}
		
			 return $request;
			
		}

		public function selectUsuarios()
		{

			$sql = "SELECT * FROM tbl_ms_usuarios ";
		
			$request = $this->select_all($sql);

			return $request;

		}

		//trae los prouctos 
		public function selectProductos1()
		{

			$sql = "SELECT * FROM tbl_productos WHERE status = 1 and Id_Categoria=1";
		
			$request = $this->select_all($sql);

			return $request;

		}

		//trae los insumos
		public function selectProductos2()
		{

			$sql = "SELECT * FROM tbl_productos WHERE status = 1 and Id_Categoria=2";
		
			$request = $this->select_all($sql);

			return $request;

		}


		public function insertProduccion(int $idUsuario, string $Fecha,int $estado){

					$this->idUsuario1 = $idUsuario;
					$this->Fecha1 = $Fecha;
					$this->estado1= $estado;

					$query_insert  = "INSERT INTO tbl_produccion(Fecha,Estado_Produccion,Id_Usuario) VALUES(?,?,?)";
					$arrData = array(
					$this->Fecha1,
					$this->estado1,
					$this->idUsuario1
					);
				
					$request_insert = $this->insert($query_insert,$arrData);
					$request = $request_insert;
					
				

					return $request;

		}

		public function insertDetalle(int $idproduccion, int $productoid,int $cantidad,int $movimiento){
			$this->con = new Mysql();
			$query_insert  = "INSERT INTO tbl_detalle_produccion(Id_Produccion,Id_Producto,Cantidad_Produccion,Movimiento) 
								  VALUES(?,?,?,?)";
			$arrData = array($idproduccion,
							$productoid,
							$cantidad,
							$movimiento
						);
			$request_insert = $this->con->insert($query_insert,$arrData);
			$return = $request_insert;
			return $return;
		}

		public function selectProducto($idproducto)
		{

			$sql = "SELECT p.Id_Producto,p.Id_Categoria,p.codigo,p.Nombre, i.Porcentaje_ISV,p.Descripcion,p.Precio_Venta,p.status 
			FROM tbl_productos p 
			INNER JOIN tbl_impuestos i
				ON p.Id_ISV = i.Id_ISV
			WHERE Id_Producto = $idproducto ";
		
			$request = $this->select($sql);
			

			return $request;

		}

	

	
		public function selectcantidadN(string $intidproducto){
			$this->idproducto = $intidproducto;
            $sql = "SELECT Cantidad_Existente FROM tbl_inventario WHERE 
			Id_Producto = '$this->idproducto' ";
			$request = $this->select($sql);//fijarse bien
			return $request;
        }

		


		public function selectProduccionsR($contenido)
		{

				$sql = "SELECT * FROM tbl_Produccion p 
				
				INNER JOIN tbl_proveedor i ON i.Id_Proveedor = p.Id_Proveedor 
				INNER JOIN tbl_ms_usuarios o ON o.id_usuario = p.Id_Usuario 
			    INNER JOIN tbl_detalle_Produccion l ON p.Id_Produccion = l.Id_Produccion
				WHERE p.Id_Produccion like '%$contenido%' or 
				i.Nombre_Proveedor like '%$contenido%' or 
				o.Nombre like'%$contenido%'or 
				p.Fecha_Produccion like'%$contenido%' or 
				l.Total  like'%$contenido%' or
				p.Estado_Produccion like'%$contenido%'";
			
				$request = $this->select_all($sql);

				return $request;

		}

		public function deleteProduccion(int $idparametro){
			$this->intIdParametro = $idparametro;
			$this->estado = 2;
				$sql = "UPDATE tbl_Produccion SET Estado_Produccion = ? WHERE Id_Produccion  = $this->intIdParametro ";
				$arrData = array($this->estado);
				$request = $this->update($sql,$arrData);
		
		    return $request;			
		}

		

		
	
		

	}