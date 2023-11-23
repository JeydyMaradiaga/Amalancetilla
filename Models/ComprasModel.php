<?php 
	class ComprasModel extends Mysql
	{
		private $objCategoria;
		public function __construct()
		{
			parent::__construct();
		}

		public function selectCompras(){

			$request = array();
			$sql = "SELECT
			p.Id_Compra as Id_Compra,
			i.Nombre_Proveedor as Id_Proveedor,
			o.Nombre as Id_Usuario,
			p.Fecha_Compra as Fecha_Compra,
			l.Total,
			CASE
				WHEN p.Estado_Compra = 1 THEN 'activa'
				ELSE 'Cancelada'
			END as Estado_Compra
			FROM tbl_compra p
			INNER JOIN tbl_proveedor i ON i.Id_Proveedor = p.Id_Proveedor
			INNER JOIN tbl_ms_usuarios o ON o.id_usuario = p.Id_Usuario
			INNER JOIN tbl_detalle_compra l ON p.Id_Compra = l.Id_Compra";
           
			$request = $this->select_all($sql);
			return $request;

		}	
		public function selectCompra(int $idcompra){
			
			$request = array();
			$sql = "SELECT p.Id_Compra,
			i.Id_Proveedor,
			i.Nombre_Proveedor,
			o.Nombre as Id_Usuario,
			p.Fecha_Compra as Fecha_Compra,
			l.Total as Total,
			p.Estado_Compra as Estado_Compra,
			i.Direccion_Proveedor
			FROM tbl_compra p 
			INNER JOIN tbl_proveedor i ON i.Id_Proveedor = p.Id_Proveedor 
			INNER JOIN tbl_ms_usuarios o ON o.id_usuario = p.Id_Usuario 
			INNER JOIN tbl_detalle_compra l ON p.Id_Compra = l.Id_Compra
			 WHERE p.Id_Compra =  $idcompra ";
			$requestCompra= $this->select_all($sql);
			//dep($requestCompra);
				//	die();
					if(!empty($requestCompra))
				{
					$idproveedor = !empty($requestCompra[0]['Id_Proveedor']) ? $requestCompra[0]['Id_Proveedor'] : 1;
					$sql_proveedor = "SELECT * FROM tbl_proveedor WHERE Id_Proveedor  = $idproveedor";
					$requestproveedor = $this->select_all($sql_proveedor);
					$sql_detalle = "SELECT d.Id_Detalle_Compra,
												d.Nombre_Producto_Comprado as Nombre,
												d.Precio_Costo,
												d.Cantidad_Comprada
										FROM tbl_detalle_compra d
										WHERE d.Id_Compra = $idcompra";
					$requestProductos = $this->select_all($sql_detalle);
					$request = array('proveedor' => $requestproveedor,'orden' => $requestCompra,'detalle' => $requestProductos);
				
				}
		
			 return $request;
			
		}

		public function selectProveedores()
		{

			$sql = "SELECT * FROM tbl_proveedor ";
		
			$request = $this->select_all($sql);

			return $request;

		}

		//numero celular
		public function selectNumero($idproducto)
		{

			$sql = "SELECT Telefono_Proveedor FROM tbl_proveedor WHERE Id_Proveedor = $idproducto ";
		
			$request = $this->select($sql);

			return $request;

		}

		//trae los prouctos de insumos
		public function selectProductos1()
		{

			$sql = "SELECT * FROM tbl_productos WHERE status = 1 and Id_Categoria=2";
		
			$request = $this->select_all($sql);

			return $request;

		}
		//traer precio de los insumos
		public function selectPrecio($idproducto)
		{
			$sql = "SELECT Precio_Venta FROM tbl_productos WHERE Id_Producto = $idproducto ";
			$request = $this->select($sql);
			return $request;

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

		public function insertCompra(int $idProveedor,int $idUsuario, string $Fecha,int $estado)
		{
			$this->idproveedor1 = $idProveedor;
            $this->idUsuario1 = $idUsuario;
			$this->Fecha1 = $Fecha;
			$this->estado1= $estado;

			$query_insert  = "INSERT INTO tbl_compra(Id_Proveedor,Id_Usuario,Fecha_Compra,Estado_Compra) VALUES(?,?,?,?)";
			$arrData = array($this->idproveedor1,
            $this->idUsuario1 ,
			$this->Fecha1,
			$this->estado1
			);
		
			$request_insert = $this->insert($query_insert,$arrData);
			$request = $request_insert;
			
		

			return $request;

		}

		public function insertDetalle(int $idcompra, int $productoid,int $cantidad,float $precio,string $NombreProduc,float $total){
			$this->con = new Mysql();
			$query_insert  = "INSERT INTO tbl_detalle_compra(Id_Compra,Id_Producto,Cantidad_Comprada,Precio_Costo,Nombre_Producto_Comprado,Total) 
								  VALUES(?,?,?,?,?,?)";
			$arrData = array($idcompra,
							$productoid,
							$cantidad,
							$precio,
							$NombreProduc,
							$total
						);
			$request_insert = $this->con->insert($query_insert,$arrData);
			$return = $request_insert;
			return $return;
		}
		




		public function selectComprasR($contenido)
		{

				$sql = "SELECT * FROM tbl_compra p 
				
				INNER JOIN tbl_proveedor i ON i.Id_Proveedor = p.Id_Proveedor 
				INNER JOIN tbl_ms_usuarios o ON o.id_usuario = p.Id_Usuario 
			    INNER JOIN tbl_detalle_compra l ON p.Id_Compra = l.Id_Compra
				WHERE p.Id_Compra like '%$contenido%' or 
				i.Nombre_Proveedor like '%$contenido%' or 
				o.Nombre like'%$contenido%'or 
				p.Fecha_Compra like'%$contenido%' or 
				l.Total  like'%$contenido%' or
				p.Estado_Compra like'%$contenido%'";
			
				$request = $this->select_all($sql);

				return $request;

		}

		public function deleteCompra(int $idparametro){
			$this->intIdParametro = $idparametro;
			$this->estado = 2;
				$sql = "UPDATE tbl_compra SET Estado_Compra = ? WHERE Id_Compra  = $this->intIdParametro ";
				$arrData = array($this->estado);
				$request = $this->update($sql,$arrData);
		
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