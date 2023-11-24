<?php
    class MovimientosModel extends Mysql
    {
        public $intIdtipomovimiento;
        public $strNombremovimiento;

        public function __construct()
		{
			parent::__construct();
		}

        public function selectMovimientos()
        {
            $sql = "SELECT * FROM tbl_tipo_inventario";
			$request = $this->select_all($sql);
			return $request;
        }

        public function selectMovimiento(int $idmovimiento){
			$this->intIdtipomovimiento = $idmovimiento;
			$sql = "SELECT * FROM tbl_tipo_inventario
					WHERE Id_tipo_movimiento = $this->intIdtipomovimiento";
			$request = $this->select($sql);
			return $request;
		}

        public function selectMovimientoR($contenido) 
		{

		$sql = "SELECT * FROM tbl_tipo_inventario 
		WHERE Id_tipo_movimiento like '%$contenido%' or 
		Nombre_movimiento like '%$contenido%'";
        
		$request = $this->select_all($sql);

		return $request;

		}


        public function createMovimiento(string $nombre){

            $this->strNombremovimiento = $nombre;
            $return = 0;

            if (empty($request)) {
                $query_insert = "INSERT INTO tbl_tipo_inventario
                                    ( Nombre_movimiento)
                                    VALUES(?)";

                $arrData = array(
                    $this->strNombremovimiento
                );
                $request_insert = $this->insert($query_insert, $arrData);
                $return = $request_insert;
            } else {
                $return = "exist";
            }
            return $return;
        }


        public function updateMovimiento(int $idDescuento, string $nombre)
    {
        $this->intIdtipomovimiento = $idDescuento;
        $this->strNombremovimiento = $nombre;

        $return = 0;
 
        $sql = "SELECT * FROM tbl_tipo_inventario WHERE Nombre_movimiento = '$this->strNombremovimiento' and Id_tipo_movimiento != $this->intIdtipomovimiento";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE tbl_tipo_inventario 
                    SET Nombre_movimiento=?
                    WHERE Id_tipo_movimiento = $this->intIdtipomovimiento";

            $arrData = array(
                $this->strNombremovimiento
            );

            $request = $this->update($sql, $arrData);
            $return = $request;
        } else {
            $return = "exist";
        }
       
                return $return;
    }
        public function deleteMovimiento(int $idmovimiento)
        {
            $this->intIdtipomovimiento = $idmovimiento;
            if($this->intIdtipomovimiento > 8){
                $sql = "SELECT * FROM tbl_movimiento_inventario WHERE Id_tipo_movimiento = $this->intIdtipomovimiento  and Id_tipo_movimiento < 8";
                $request = $this->select_all($sql);
                if(empty($request))
                {
                $sql = "DELETE  FROM tbl_tipo_inventario WHERE Id_tipo_movimiento = $this->intIdtipomovimiento ";
                $arrData = array(0);
                $request = $this->delete($sql,$arrData);
                    if($request)
                    {
                        $request = 'ok';	
                    }else{
                        $request = 'error';
                    }
                }else{
                    $request = 'exist';
                }
            }else{
                $request = 'exist';
            }
            return $request;
        }	

        public function bitacora(int $intIdUsuario,int $objeto,string $evento, string $descripcion, string $fecha){
			$this->intIdusuario = $intIdUsuario;
			$this->strEvento = $evento;
			$this->strObjeto = $objeto;
			$this->strDescripcion = $descripcion;
			$this->strFecha = $fecha;
	
			$sql = "INSERT INTO tbl_ms_bitacora (Id_Usuario, Id_Objeto, Accion, Descripcion, Fecha)
			 VALUES (?,?,?,?,?)";
				$arrData = array($this->intIdusuario,
				$this->strObjeto,
				$this->strEvento,
				$this->strDescripcion,
				$this->strFecha);
				$request = $this->insert($sql,$arrData);
				return $request;
		}

    }



?>