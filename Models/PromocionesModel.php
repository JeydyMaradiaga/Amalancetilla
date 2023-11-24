<?php 

	class PromocionesModel extends Mysql
	{
		public $intIdrol;
		public $strRol;
		//public $strDescripcion;
		public $intStatus;

		private	$strParametro;
		private	$producto;
		private	$strDescripcion;
		private	$Fecha1;
		private	$Fecha2;
		private	$intValor;
		private	$estado;
		private	$intCant;

		public function __construct()
		{
			parent::__construct();
		}
		
		public function selectPromociones()
		{
		
			$sql = "SELECT * FROM tbl_promociones ";
			$request = $this->select_all($sql);
			return $request;
		}
				
		

		// public function insertPromociones(int $idpromocion,int $idproducto, int  $cantidad ){

		// 	$return = "";
		// 	$this->idpromocion = $idpromocion;
        //     $this->idproducto = $idproducto;
        //     $this->cantidad = $cantidad;
	
		// 		$query_insert  = "INSERT INTO tbl_promociones_productos(Id_Promociones,Id_Producto,Cantidad_Producto) VALUES(?,?,?)";
	    //     	$arrData = array($this->idpromocion, $this->idproducto,$this->cantidad);
	    //     	$request_insert = $this->insert($query_insert,$arrData);
	    //     	$return = $request_insert;
		
		// 	return $return;
		// }	
        public function selectProductos()
		{
		
			$sql = "SELECT * FROM tbl_productos ";
			$request = $this->select_all($sql);
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
		public function selecPromocion(int $idparametro)
		{
			//BUSCAR ROLE
			$this->intIdparametro = $idparametro;
			$sql = "SELECT * FROM tbl_promociones WHERE Id_Promociones = $this->intIdparametro";
			$request = $this->select($sql);
			return $request;
		}
 

		public function createPromocion(string $Nombre, string $descripcion, int $producto, string $fecha1,string $fecha2, int $valor, int $estado, int $cant){

			$this->strParametro = $Nombre;
			$this->producto = $producto;
			$this->strDescripcion = $descripcion;
			$this->Fecha1 = $fecha1;
			$this->Fecha2 = $fecha2;
			$this->intValor = $valor;
			$this->estado = $estado;
			$this->intCant = $cant;
            $return = "";
			$sql = "SELECT * FROM tbl_promociones WHERE Nombre = '{$this->strParametro}'";
			$request = $this->select_all($sql);

            if (empty($request)) {
                $query_insert = "INSERT INTO tbl_promociones
                                    (Id_Producto,
									Nombre,
									Precio,
									Descripcion,
									Estado,
									Fecha_Inicio,
									Fecha_Final,
									Cantidad_Promocion)
                                    VALUES(?,?,?,?,?,?,?,?)";

                $arrData = array(
                    $this->producto,$this->strParametro,$this->intValor,$this->strDescripcion,$this->estado,$this->Fecha1,$this->Fecha2, $this->intCant 
                );
                $request_insert = $this->insert($query_insert, $arrData);
                $return = $request_insert;
            } else {
                $return = "exist";
            }
            return $return;
        }


		public function insertpromo(string $Nombre, string $descripcion, int $producto, string $fecha1,string $fecha2, int $valor, int 	$estado, int $cant){

			
			$this->strNombre = $Nombre;
            $this->strfecha1 = $fecha1;
            $this->strfecha2 = $fecha2;
			$this->strDescripcion = $descripcion;
			$this->intProducto = $producto;
			$this->intValor = $valor;
			$this->estado = $estado;
			$this->intCant = $cant;
			$return = 0;
			$sql = "SELECT * FROM tbl_promociones WHERE Nombre = '$this->strNombre' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tbl_promociones(Id_Producto,
																 Nombre, 
																 Precio, 
																 Descripcion, 
																 Estado, 
																 Fecha_Inicio, 
																 Fecha_Final, 
																 Cantidad_Promocion) 
										VALUES(?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->intProducto,$this->strNombre, $this->intValor, $this->strDescripcion,$this->estado, $this->strfecha1, $this->strfecha2,$this->intCant);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	
 
		public function updateParametro(int $idparametro, string $Nombre, string $descripcion, int $producto, string $fecha1,string $fecha2, int $valor, int $estado, int $cant){
			$this->intIdParametro = $idparametro;
			$this->strParametro = $Nombre;
			$this->producto = $producto;
			$this->strDescripcion = $descripcion;
			$this->Fecha1 = $fecha1;
			$this->Fecha2 = $fecha2;
			$this->intValor = $valor;
			$this->estado = $estado;
			$this->intCant = $cant;
			$sql = "SELECT * FROM tbl_promociones WHERE Nombre = '$this->strParametro' AND Id_Promociones != $this->intIdParametro";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE tbl_promociones SET Nombre = ?, Descripcion = ?, Id_Producto = ? , Fecha_Inicio = ?, Fecha_Final = ? , Precio = ?, Estado = ? , Cantidad_Promocion = ? WHERE Id_Promociones = $this->intIdParametro ";
				$arrData = array($this->strParametro, $this->strDescripcion,$this->producto,$this->Fecha1,$this->Fecha2, $this->intValor,$this->estado,$this->intCant );
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteParametro(int $idparametro)
		{
			$this->IntParametro = $idparametro;
		
			
				$sql = "DELETE  FROM  tbl_promociones WHERE Id_Promociones = $this->IntParametro ";
				$arrData = array(0);
				$request = $this->delete($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
		
			return $request;
		}


		public function selectPromocionesR($contenido) 
		{

		$sql = "SELECT  u.Nombre as nombrep,
        p.Precio,
        p.Nombre,
        p.Descripcion,
        p.Estado,
        p.Fecha_Inicio,
        p.Fecha_Final,
        p.Cantidad_Promocion
        FROM tbl_promociones p
        INNER JOIN  tbl_productos u
        ON u.Id_Producto = p.Id_Producto
		WHERE u.Nombre like '%$contenido%' or 
		p.Precio like '%$contenido%' or
        p.Nombre like '%$contenido%' or 
        p.Descripcion like '%$contenido%' or
        p.Estado like '%$contenido%' or 
		p.Fecha_Inicio like '%$contenido%' or 
		p.Fecha_Final like '%$contenido%' or 
		p.Cantidad_Promocion like '%$contenido%'";
        
		$request = $this->select_all($sql);

		return $request;

		}


	}
 ?>