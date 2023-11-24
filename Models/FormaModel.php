<?php
    class FormaModel extends Mysql {   // se edito aqui
        
        public $intIdtipoforma;  // see dito linea 4,5 y se borro un public
        public $strNombreforma;

        public function __construct()
		{
			parent::__construct();
		}

        public function selectForma()   // se edito la linea 12 y 14
        {
            $sql = "SELECT * FROM tbl_forma_pago";
			$request = $this->select_all($sql);
			return $request;
        }

        public function selectForm(int $idforma){      // se editaron las lineas de la 19 a la 22
			$this->intIdtipoforma = $idforma;
			$sql = "SELECT * FROM tbl_forma_pago
					WHERE Id_Forma_Pago = $this->intIdtipoforma";
			$request = $this->select($sql);
			return $request;
		}

        public function selectFormaR($contenido)     // linea 27, 30, 31 y 32 de editaron
		{
           
		$sql = "SELECT * FROM tbl_forma_pago
		WHERE Id_Forma_Pago like '%$contenido%' or 
		Nombre like '%$contenido%' or 
        Descripcion like '%$contenido%'";
        
		$request = $this->select_all($sql);

		return $request;

		}


        public function deleteForm(int $idForma)    // Verificar y corregir.
        {
            $this->Idtipoforma = $idForma;
            $sql = "SELECT * FROM  tbl_pedidos WHERE TipoPago = $this->Idtipoforma";
            $request = $this->select_all($sql);
            if(empty($request))
            {
            $sql = "DELETE  FROM  tbl_forma_pago WHERE  Id_Forma_Pago = $this->Idtipoforma";
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


        public function createForm(string $nombre,string $descripcion){

            $this->strNombre = $nombre;
            $this->descripcion = $descripcion;                // se editaron lineas 65,68,72,73 y 78
            $return = 0;
 
            if (empty($request)) {
                $query_insert = "INSERT INTO  tbl_forma_pago 
                                    (Nombre, Descripcion)
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



        public function updateForm(int $idforma, string $nombre, string $descripcion)
    {
        $this->Idtipoforma = $idforma;
        $this->strNombre = $nombre;
        $this->descripcion = $descripcion;
        $return = 0;
                                                                                        // revisar esta parte
        $sql = "SELECT * FROM tbl_forma_pago WHERE Nombre = '$this->strNombre'  and Id_Forma_Pago  = $this->Idtipoforma";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE tbl_forma_pago
                    SET Nombre =?,
                        Descripcion =?
                                                           
                    WHERE Id_Forma_Pago  = $this->Idtipoforma";   //revisar esta parte
                        
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