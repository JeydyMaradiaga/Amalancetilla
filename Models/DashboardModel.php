<?php 

	class DashboardModel extends Mysql
	{
		public $intIdrol;
		public $strRol;
		public $strDescripcion;
		public $intStatus;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectUltimosP()
		{
            $sql = "SELECT p.Id_Pedido,
            p.Id_Cliente,
            p.Id_Usuario,
            p.Nombre_Empleado,
            p.Fecha_Hora,
            p.Total,
            c.Nombre,
         
            p.Numero_Factura,
            p.Id_CAI, 
            e.Id_Estado_Pedido,
            e.Estado
            FROM tbl_pedidos p
            INNER JOIN tbl_estados_pedidos e
            ON p.Id_Estado_Pedido = e.Id_Estado_Pedido
            INNER JOIN tbl_clientes c
            ON  c.Id_Cliente = p.Id_Cliente";
            $request = $this->select_all($sql);
            return $request;
         
		}
        public function selectPedidosP()
		{
            $sql = "SELECT p.Id_Pedido,
            p.Id_Cliente,
            p.Id_Usuario,
            p.Nombre_Empleado,
            p.Fecha_Hora,
            p.Total,
            c.Nombre,
       
            p.Numero_Factura,
            p.Id_CAI, 
            e.Id_Estado_Pedido,
            e.Estado
            FROM tbl_pedidos p
            INNER JOIN tbl_estados_pedidos e
            ON p.Id_Estado_Pedido = e.Id_Estado_Pedido
            INNER JOIN tbl_clientes c
            ON  c.Id_Cliente = p.Id_Cliente 
            WHERE p.Id_Estado_Pedido = 2 ";
            $request = $this->select_all($sql);
            return $request;
           
		}

	}
 ?>