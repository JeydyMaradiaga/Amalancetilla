<?php 
	class PedidosModel extends Mysql
	{
		private $objCategoria;
		public function __construct()
		{
			parent::__construct();
		}

		public function selectPedidos(){
			
		 
			$request = array();
			$sql = "SELECT p.Id_Pedido,
			c.Nombre AS Id_Cliente,
			p.Id_Usuario,
			p.Id_Estado_Pedido,
			e.Estado as Estado, 
			p.Fecha_Hora, 
			p.Total, 
			p.TipoPago,
			p.Direccion_envio,
			p.Costo_envio
			FROM tbl_pedidos p
			INNER JOIN tbl_estados_pedidos e
			ON e.Id_Estado_Pedido = p.Id_Estado_Pedido and p.Id_Estado_Pedido <> 3
			INNER JOIN tbl_clientes c
            ON  c.Id_Cliente = p.Id_Cliente";

			$request = $this->select_all($sql);
			return $request;

		}	

		public function selectPedido(int $idpedido){
			
			$request = array();
			$sql = "SELECT p.Id_Pedido,
			c.Nombre,
            c.Telefono,
            c.Correo_Cliente,
			p.Id_Usuario,
			p.Id_Estado_Pedido,
			e.Estado as Estado, 
			p.Fecha_Hora, 
			p.Total, 
			p.TipoPago,
			p.Numero_Factura,
			p.Direccion_envio,
			p.Costo_envio
			FROM tbl_pedidos p
			INNER JOIN tbl_estados_pedidos e
			ON e.Id_Estado_Pedido = p.Id_Estado_Pedido
            INNER JOIN tbl_clientes c 
            ON c.Id_Cliente = p.Id_Cliente
			 WHERE Id_Pedido = $idpedido ";
			$requestPedido = $this->select_all($sql);
			//dep($requestPedido);
		//	die(); 
			if(!empty($requestPedido)){
				$idpersona = 1;
				$sql_cliente = "SELECT * FROM tbl_clientes WHERE Id_Cliente = $idpersona ";
				$requestcliente = $this->select_all($sql_cliente);
				$sql_detalle = "SELECT p.Id_Producto,
											p.Nombre as Nombre,
											d.Precio_Venta,
											d.Cantidad
									FROM tbl_detalle_pedido d
									INNER JOIN tbl_productos p
									ON d.Id_Producto = p.Id_Producto
									WHERE d.Id_Pedido = $idpedido";
				$requestProductos = $this->select_all($sql_detalle);
				$request = array('cliente' => $requestcliente,'orden' => $requestPedido,'detalle' => $requestProductos);
			
			}
		
			return $request;
			
		}
		public function selectPedidotemp(int $idcliente){
			
			$request = array();
			$sql = "SELECT p.Id_detalle_temp,
			p.Id_Cliente,
			p.Id_Producto,
			p.cantidad,
			e.Nombre,
			e.Precio_Venta
			FROM tbl_detalle_temp p
			INNER JOIN tbl_productos e
			ON e.Id_Producto = p.Id_Producto
			 WHERE Id_Cliente =  $idcliente ";
			$request = $this->select_all($sql);
			

			return $request;
			
		}
		
		public function selectRangoA()
		{
		

		$sql = "SELECT max(Rango_Actual) as A, MAX(Rango_Final) AS F, Fecha_Vencimiento as Fecha
		FROM tbl_config_cai  ";
	
		$request = $this->select($sql);
		if ($request['A'] < $request['F'])   {
			if(strtotime((date("Y-m-d")))  >=   strtotime($request['Fecha'])) {

				$retornar = 2;
			}else{
				$retornar = 1;

			}

		
		}else{
			$retornar = 2;

		}
		
		return $retornar;

		}
		public function selectISV($idproducto)
		{
		 

			$sql = "SELECT p.Precio_Venta,
			i.Porcentaje_ISV, 
			p.Id_ISV
			FROM tbl_productos P
			INNER JOIN tbl_impuestos i
			ON p.Id_ISV = i.Id_ISV
					
			WHERE Id_Producto = $idproducto ";
		
			$request = $this->select($sql);
			

		return $request;

		}
		public function selectProductop($idproducto)
		{
		

		$sql = "SELECT  Id_Producto
		 FROM tbl_promociones 
		 
		
		  WHERE Id_Promociones = $idproducto ";
	
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
		
		public function insertPedido(int $idCliente,int $idUsuario, int $estado,string $nombreuser,string $Fecha,  $total,float $envio,int $numFactura, int $forma)
		{
			$this->idcliente1 = $idCliente;
            $this->idUsuario1 = $idUsuario;
			$this->estado1= $estado;
			$this->nombreuser1 = $nombreuser;
			$this->Fecha1 = $Fecha;
			$this->total1 = $total;
			$this->envio1 = $envio;
			$this->numFactura1 = $numFactura;
			$this->CAI1 = 1;
			if($numFactura !=0){
				$this->tipoF = 1;
			}else{
				$this->tipoF = 0;

			}
			
			$this->forma1 = $forma;
			
			$query_insert  = "INSERT INTO tbl_pedidos(Id_Cliente,Id_Usuario ,Id_Estado_Pedido,Nombre_Empleado ,Fecha_Hora ,Total,Costo_envio ,Numero_Factura ,Id_CAI ,TipoPago,tipoFactura) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
			$arrData = array($this->idcliente1,
            $this->idUsuario1 ,
			$this->estado1,
			$this->nombreuser1 ,
			$this->Fecha1,
			$this->total1 ,
			$this->envio1,
			$this->numFactura1,
			$this->CAI1,
			$this->forma1,
			$this->tipoF);
		
			$request_insert = $this->insert($query_insert,$arrData);
			$request = $request_insert;
			
		

		return $request;

		}
		
		public function selectIDPorcentaje($ISV)
		{
		$this->ISV = $ISV;
		$sql = "SELECT Id_ISV FROM tbl_impuestos where Porcentaje_ISV = $this->ISV ";
	
		$request = $this->select($sql);
		
		
		return $request;
	

		}
		

		public function insertDetalle(int $idpedido, int $productoid,int $idisv,float $isv, float $precio, int $cantidad){
			$this->con = new Mysql();
			$query_insert  = "INSERT INTO tbl_detalle_pedido(Id_Pedido,Id_Producto,Id_ISV,Porcentaje_ISV,Precio_Venta,Cantidad) 
								  VALUES(?,?,?,?,?,?)";
			$arrData = array($idpedido,
							$productoid,
							$idisv,
							$isv,
							$precio,
							$cantidad
						);
			$request_insert = $this->con->insert($query_insert,$arrData);
			$return = $request_insert;
			return $return;
		}
		public function selectNumero($idproducto)
		{
		

		$sql = "SELECT Telefono FROM tbl_clientes WHERE Id_Cliente = $idproducto ";
	
		$request = $this->select($sql);
		

		return $request;

		}
		
		public function selectPromociontotal($idproducto,$idpromocion)
		{
		

		$sql = "SELECT * FROM tbl_promociones WHERE Id_Producto = $idproducto AND Id_Promociones = $idpromocion ";
	
		$request = $this->select_all($sql);
	

		return $request;

		}
		public function selectpromocion($idproducto)
		{
		

		$sql = "SELECT Precio FROM tbl_promociones WHERE Id_Promociones = $idproducto ";
	
		$request = $this->select($sql);
		

		return $request;

		}
		public function selectPrecio($idproducto)
		{
		

		$sql = "SELECT Precio_Venta FROM tbl_productos WHERE Id_Producto = $idproducto ";
	
		$request = $this->select($sql);
		

		return $request;

		}
		public function selectProductos1()
		{

		$sql = "SELECT * FROM tbl_productos WHERE status =1 and Id_Categoria=1";
	
		$request = $this->select_all($sql);

		return $request;

		}
		public function selectPedidosR($contenido)
		{

		$sql = "SELECT * FROM tbl_pedidos p 
		INNER JOIN tbl_estados_pedidos e
		ON e.Id_Estado_Pedido = p.Id_Estado_Pedido 
		WHERE p.Id_Cliente like '%$contenido%' or 
		p.Id_Pedido like '%$contenido%' or 
		e.Estado like'%$contenido%'or 
		p.Fecha_Hora  like'%$contenido%' or 
		p.Total  like'%$contenido%'";
	
		$request = $this->select_all($sql);

		return $request;

		}
        public function selectClientes()
		{

		$sql = "SELECT * FROM tbl_clientes ";
	
		$request = $this->select_all($sql);

		return $request;

		}
		public function selectForma()
		{

		$sql = "SELECT * FROM tbl_forma_pago ";
	
		$request = $this->select_all($sql);
		return $request;
		}
		public function selectDescuentos()
		{

		$sql = "SELECT * FROM tbl_descuentos where Estado = 1";
	
		$request = $this->select_all($sql);
		return $request;
		}
		
		public function UpdateRangoA(int $idCai){

			$suma = 1;
				$query_insert  = "UPDATE tbl_config_cai SET Rango_Actual = Rango_Actual + ?  WHERE Id_CAI =$idCai";
	        	$arrData = array($suma);
			
			$request_insert = $this->update($query_insert,$arrData);
			if($request_insert =1){
				
					$sql = "SELECT * FROM tbl_config_cai ";
				
					$request = $this->select_all($sql);
					
					return $request;

			}else{
				return 2;

			}
			
        	
		}
		
		

		public function deletePedido(int $idparametro){
			$this->intIdParametro = $idparametro;
			$this->estado = 3;
				$sql = "UPDATE tbl_pedidos SET Id_Estado_Pedido = ? WHERE Id_Pedido = $this->intIdParametro ";
				$arrData = array($this->estado);
				$request = $this->update($sql,$arrData);
		
		    return $request;			
		}
		public function updatePedido(int $idpedido, int $idtipopago , string $estado){

					$sql = "SELECT Id_Estado_Pedido FROM tbl_estados_pedidos WHERE Estado =  '$estado'";
						
					$request = $this->select($sql);
	
				$query_insert  = "UPDATE tbl_pedidos SET Id_Estado_Pedido = ?, TipoPago = ? WHERE Id_Pedido = $idpedido ";
	        	$arrData = array($request['Id_Estado_Pedido'],$idtipopago);
		
	
			$request_insert = $this->update($query_insert,$arrData);
        	return $request_insert;
		}


		public function selectcantidadN(string $intidproducto){
			$this->idproducto = $intidproducto;
            $sql = "SELECT Cantidad_Existente FROM tbl_inventario WHERE 
			Id_Producto = '$this->idproducto' ";
			$request = $this->select($sql);//fijarse bien
			return $request;
        }

		public function selectcantidadPromocion(string $intidproducto){
			$this->idproducto = $intidproducto;
            $sql = "SELECT Cantidad_Promocion FROM tbl_promociones WHERE Id_Promociones = '$this->idproducto'; ";
			$request = $this->select($sql);//fijarse bien
			return $request;
        }

		public function selectdescuento(string $intdescuento){
			$this->idproducto = $intdescuento;
            $sql = "SELECT Porcentaje_Deduccion,Descripcion FROM tbl_descuentos WHERE 
			Id_Descuento = '$this->idproducto' ";
			$request = $this->select($sql);//fijarse bien
			return $request;
        }


		public function insertDescuento(int $idpedido, int $descuentoid){
			$this->con = new Mysql();
			$query_insert  = "INSERT INTO tbl_descuentos_pedidos(Id_Pedido,Id_Descuento) 
								  VALUES(?,?)";
			$arrData = array($idpedido,
							$descuentoid
						);
			$request_insert = $this->con->insert($query_insert,$arrData);
			$return = $request_insert;
			return $return;
		}

	}
