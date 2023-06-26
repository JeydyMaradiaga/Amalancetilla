<?php 
	class FacturaModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		public function selectPedido(int $idpedido){
			
			$request = array();
			$sql = "SELECT p.Id_Pedido,
			p.Id_Cliente,
			p.Id_Usuario,
			p.Id_CAI,
			p.Id_Estado_Pedido,
			e.Estado as Estado, 
			p.Fecha_Hora, 
			p.Total, 
			p.TipoPago,
			f.Nombre,
			i.Rango_Inicial,
			i.Rango_Final,
			i.Rango_Actual,
			i.Fecha_Vencimiento,
			i.Numero_CAI,
			p.Direccion_envio,
			p.Numero_Factura,
			p.Costo_envio,
			p.tipoFactura
			FROM tbl_pedidos p
			INNER JOIN tbl_estados_pedidos e
			ON e.Id_Estado_Pedido = p.Id_Estado_Pedido
			INNER JOIN tbl_config_cai i
			ON i.Id_CAI = p.Id_CAI
			INNER JOIN tbl_forma_pago f
			ON f.Id_Forma_Pago = p.TipoPago
			 WHERE Id_Pedido =  $idpedido ";
			$requestPedido = $this->select_all($sql);
			//dep($requestPedido);
		//	die();
			if(!empty($requestPedido)){
				$idpersona = 2;
				$sql_cliente = "SELECT * FROM tbl_clientes WHERE Id_Cliente = $idpersona ";
				$requestcliente = $this->select_all($sql_cliente);
				$sql_detalle = "SELECT p.Id_Producto,
											p.Nombre as Nombre,
											d.Precio_Venta,
											d.Cantidad,
											d.Porcentaje_ISV,
											p.Promo
											
									FROM tbl_detalle_pedido d
									INNER JOIN tbl_productos p
									ON d.Id_Producto = p.Id_Producto
									WHERE d.Id_Pedido = $idpedido";
				$requestProductos = $this->select_all($sql_detalle);

				$request = array('cliente' => $requestcliente,'orden' => $requestPedido,'detalle' => $requestProductos);
			
			
			}
		
			return $request;
			
		}
		
		public function selectNombrePromo(int $idpedido){
			$sql = "SELECT Nombre FROM tbl_promociones where Id_Producto = $idpedido ";
	
		$request = $this->select($sql);
	
		return $request;

		}
	}
 ?>