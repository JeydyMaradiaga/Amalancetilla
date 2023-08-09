<?php
     class KardexsModel extends Mysql{
        public $intIdMovimiento;
        public $intidProductoC;
        public $Fecha;
        public $Hora;
        public $cantidadM;
        Public $IdMovimientoTipo;
        public $Idusuario;

        public function __construct()
		{
			parent::__construct();
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

        public function selectKardexsp($idProducto)
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
        
        public function selectKardexR($contenido) 
		{

		$sql = "SELECT d.Nombre AS Nombres,
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
        ON d.Id_Producto = p.Id_Producto
		WHERE p.Id_Movimiento like '%$contenido%' or 
		d.Nombre like '%$contenido%' or
        p.Fecha_movimiento like '%$contenido%' or 
		p.Hora_movimiento like '%$contenido%' or
        p.Cantidad_movimiento like '%$contenido%' or 
		i.Nombre_movimiento like '%$contenido%' or
        e.Nombre like '%$contenido%'";
        
		$request = $this->select_all($sql);

		return $request;

		}

     }
?>