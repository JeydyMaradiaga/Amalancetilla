<?php
     class Permisos1Model extends Mysql{
        

        public function __construct()
		{
			parent::__construct();
		}

        public function selectPermisos1()
        {
            $sql = "SELECT  r.Nombre_Rol,
    		o.Nombre_Objeto,
            p.Permiso_Get,
            p.Permiso_Insert,
            p.Permiso_Update,
            p.Permiso_Delete
			FROM tbl_ms_permisos p
			INNER JOIN tbl_ms_rol r
			ON r.Id_Rol = p.Id_Rol
            INNER JOIN tbl_ms_objetos o
            ON o.Id_Objeto = p.Id_Objeto";
			$request = $this->select_all($sql);
			return $request;
        }

        public function selectCardexsp($idProducto)
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
        
        public function selectPermiso1R($contenido) 
		{

		$sql = "SELECT  r.Nombre_Rol,
        o.Nombre_Objeto,
        p.Permiso_Get,
        p.Permiso_Insert,
        p.Permiso_Update,
        p.Permiso_Delete
        FROM tbl_ms_permisos p
        INNER JOIN tbl_ms_rol r
        ON r.Id_Rol = p.Id_Rol
        INNER JOIN tbl_ms_objetos o
        ON o.Id_Objeto = p.Id_Objeto
		WHERE r.Nombre_Rol like '%$contenido%' or 
		o.Nombre_Objeto like '%$contenido%' or
        p.Permiso_Get like '%$contenido%' or 
        p.Permiso_Insert like '%$contenido%' or
        p.Permiso_Update like '%$contenido%' or 
		p.Permiso_Delete like '%$contenido%'";
        
		$request = $this->select_all($sql);

		return $request;

		}

     }
?>