<?php
     class InventariosModel extends Mysql{
        public $intIdInventario;
        public $intidProducto;
        public $cantidadE;

        public function __construct()
		{
			parent::__construct();
		}

        public function selectInventarios()
        {
            $sql = "SELECT p.Id_Inventario,
			e.Nombre,
			e.Descripcion,
			e.Precio_Venta, 
			p.Cantidad_Existente,
			e.Cantidad_Minima, 
			e.Cantidad_Maxima
			FROM tbl_inventario p
			INNER JOIN tbl_productos e
			ON e.Id_Producto = p.Id_Producto";
			$request = $this->select_all($sql);
			return $request;
        }

		public function selectInventarioR($contenido) 
		{

		$sql = "SELECT * FROM tbl_inventario p
        INNER JOIN tbl_productos d
        ON d.Id_Producto = p.Id_Producto
		WHERE p.Id_Inventario like '%$contenido%' or 
        d.Nombre like '%$contenido%' or 
		d.Descripcion like '%$contenido%' or
        d.Precio_Venta like '%$contenido%' or 
		p.Cantidad_Existente like '%$contenido%'";
        
		$request = $this->select_all($sql);

		return $request;

		}

		public function selectKardexs()
        {
            $sql = "SELECT p.Id_Movimiento,
            d.Nombre AS Nombres,
			p.Fecha_movimiento,
			p.Hora_movimiento,
			p.Cantidad_movimiento, 
			i.Nombre_movimiento,
			e.Nombre
			FROM tbl_movimiento_inventario p
			INNER JOIN tbl_ms_usuarios e
			ON e.id_usuario = p.id_usuario
            INNER JOIN tbl_tipo_inventario i
            ON i.Id_tipo_movimiento = p.Id_tipo_movimiento
            INNER JOIN tbl_productos d
            ON d.Id_Producto = p.Id_Producto";
			$request = $this->select_all($sql);
			return $request;
        }

		

     }
?>