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
			$sql = "SELECT p.Id_Compra as Id_Compra,
			i.Nombre_Proveedor as Id_Proveedor,
			o.Nombre as Id_Usuario,
			p.Fecha_Compra as Fecha_Compra,
			l.Total,
			p.Estado_Compra 
			FROM tbl_compra p 
			INNER JOIN tbl_proveedor i 
			ON i.Id_Proveedor = p.Id_Proveedor 
			INNER JOIN tbl_ms_usuarios o ON o.id_usuario = p.Id_Usuario 
			INNER JOIN tbl_detalle_compra l ON p.Id_Compra = l.Id_Compra";

			$request = $this->select_all($sql);
			return $request;

		}	
		public function selectCompra(int $idcompra){
			
			$request = array();
			$sql = "SELECT p.Id_Compra,
			i.Nombre_Proveedor as Id_Proveedor,
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
					$idproveedor = 1;
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

		

		
	
		

	}