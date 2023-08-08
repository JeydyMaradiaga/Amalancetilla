<?php 

	class PromocionesModel extends Mysql
	{
		public $intIdrol;
		public $strRol;
		public $strDescripcion;
		public $intStatus;

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
				
		

		public function insertPromociones(int $idpromocion,int $idproducto, int  $cantidad ){

			$return = "";
			$this->idpromocion = $idpromocion;
            $this->idproducto = $idproducto;
            $this->cantidad = $cantidad;
	
				$query_insert  = "INSERT INTO tbl_promociones_productos(Id_Promociones,Id_Producto,Cantidad_Producto) VALUES(?,?,?)";
	        	$arrData = array($this->idpromocion, $this->idproducto,$this->cantidad);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
		
			return $return;
		}	
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

		public function selecParametro(int $idparametro)
		{
			//BUSCAR ROLE
			$this->intIdparametro = $idparametro;
			$sql = "SELECT * FROM tbl_promociones WHERE Id_Promociones = $this->intIdparametro";
			$request = $this->select($sql);
			return $request;
		}

		public function InsertPromocion(string $Nombre, string $descripcion, int $producto, string $fecha1,string $fecha2, int $valor, int 	$estado ){

			$return = "";
			$this->strNombre = $Nombre;
            $this->strfecha1 = $fecha1;
            $this->strfecha2 = $fecha2;
			$this->strDescripcion = $descripcion;
			$this->intProducto = $producto;
			$this->intValor = $valor;
			$this->estado = $estado;

			$sql = "SELECT * FROM tbl_promociones WHERE Nombre = '{$this->strNombre}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tbl_promociones(Nombre,Descripcion,Id_Producto,Fecha_Inicio,Fecha_Final,Precio,Estado) VALUES(?,?,?,?,?,?,?)";
	        	$arrData = array($this->strNombre, $this->strDescripcion,$this->intProducto, $this->strfecha1, $this->strfecha2,$this->intValor,$this->estado);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateParametro(int $idparametro, string $Nombre, string $descripcion, int $producto, string $fecha1,string $fecha2, int $valor, int $estado){
			$this->intIdParametro = $idparametro;
			$this->strParametro = $Nombre;
			$this->producto = $producto;
			$this->strDescripcion = $descripcion;
			$this->Fecha1 = $fecha1;
			$this->Fecha2 = $fecha2;
			$this->intValor = $valor;
			$this->estado = $estado;

			$sql = "SELECT * FROM tbl_promociones WHERE Nombre = '$this->strParametro' AND Id_Promociones != $this->intIdParametro";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE tbl_promociones SET Nombre = ?, Descripcion = ?, Id_Producto = ? , Fecha_Inicio = ?, Fecha_Final = ? , Precio = ?, Estado = ? WHERE Id_Promociones = $this->intIdParametro ";
				$arrData = array($this->strParametro, $this->strDescripcion,$this->producto,$this->Fecha1,$this->Fecha2, $this->intValor,$this->estado );
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
	}
 ?>