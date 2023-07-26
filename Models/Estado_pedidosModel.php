<?php
    class Estado_pedidosModel extends Mysql
    {
        public $intIdtipoestado_pedido; 
        public $strNombreestado_pedido;
        public $descripcion;

        public function __construct()
		{
			parent::__construct();
		}

        public function selectEstado_pedidos()
        {
            $sql = "SELECT * FROM tbl_estados_pedidos";
			$request = $this->select_all($sql);
			return $request;
        }

        public function selectEstado_pedido(int $idestado_pedido){
			$this->intIdtipoestado_pedido = $idestado_pedido;
			$sql = "SELECT * FROM tbl_estados_pedidos
					WHERE Id_Estado_Pedido = $this->intIdtipoestado_pedido";
			$request = $this->select($sql);
			return $request;
		}

        public function selectEstado_pedidoR($contenido) 
		{
           
		$sql = "SELECT * FROM tbl_estados_pedidos
		WHERE Id_Estado_Pedido like '%$contenido%' or 
		Estado like '%$contenido%' or 
        Descripcion like '%$contenido%'";
        
		$request = $this->select_all($sql);

		return $request;

		}

        public function deleteEstado_pedido(int $idEstado_pedido) 
        {
            $this->Idtipoestado_pedido = $idEstado_pedido;
            $sql = "SELECT * FROM tbl_pedidos WHERE Id_Estado_Pedido = $this->Idtipoestado_pedido";
            $request = $this->select_all($sql);
            if(empty($request))
            {
            $sql = "DELETE  FROM tbl_estados_pedidos WHERE Id_Estado_Pedido = $this->Idtipoestado_pedido";
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
            return $request;
        }	

        public function createEstado_pedido(string $nombre,string $descripcion){

            $this->strNombre = $nombre;
            $this->descripcion = $descripcion;
            $return = 0;

            if (empty($request)) {
                $query_insert = "INSERT INTO tbl_estados_pedidos
                                    (Estado, Descripcion)
                                    VALUES(?,?)";

                $arrData = array(
                    $this->strNombre,
                    $this->descripcion
                );
                $request_insert = $this->insert($query_insert, $arrData);
                $return = $request_insert;
            } else {
                $return = "exist";
            }
            return $return;
        }


        public function updateEstado_pedido(int $idEstado_pedido, string $nombre,string $descripcion)
    {
        $this->Idtipoestado_pedido = $idEstado_pedido;
        $this->strNombre = $nombre;
        $this->descripcion = $descripcion;
        $return = 0;

        $sql = "SELECT * FROM tbl_estados_pedidos WHERE Estado = '$this->strNombre' and Id_Estado_Pedido != $this->Idtipoestado_pedido";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE tbl_estados_pedidos
                    SET Estado=?,
                        Descripcion=?
                    WHERE Id_Estado_Pedido = $this->Idtipoestado_pedido";

            $arrData = array(
                $this->strNombre,
                $this->descripcion
            );

            $request = $this->update($sql, $arrData);
            $return = $request;
        } else {
            $return = "exist";
        }
       
                return $return;
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