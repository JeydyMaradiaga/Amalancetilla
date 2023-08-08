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
            p.Id_Producto,
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
		p.Id_Producto like '%$contenido%' or
        d.Nombre like '%$contenido%' or 
		d.Descripcion like '%$contenido%' or
        d.Precio_Venta like '%$contenido%' or 
		p.Cantidad_Existente like '%$contenido%' or
        d.Cantidad_Minima like '%$contenido%' or
		d.Cantidad_Maxima like '%$contenido%'";
        
		$request = $this->select_all($sql);

		return $request;

		}

		

     }
?>