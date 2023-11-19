<?php
    class Estado_usuariosModel extends Mysql {   // se edito aqui
        
        public $intIdtipoestado_usuario;  // see dito linea 4,5 y se borro un public
        public $strNombreestado_usuario;

        public function __construct()
		{
			parent::__construct();
		}

        public function selectEstado_usuarios()   // se edito la linea 12 y 14
        {
            $sql = "SELECT * FROM tbl_estados_usuarios";
			$request = $this->select_all($sql);
			return $request;
        }

        public function selectEstado_usuario(int $idestado_usuario){      // se editaron las lineas de la 19 a la 22
			$this->intIdtipoestado_usuario = $idestado_usuario;
			$sql = "SELECT * FROM tbl_estados_usuarios
					WHERE id_estado_usuario = $this->intIdtipoestado_usuario";
			$request = $this->select($sql);
			return $request;
		}

        public function selectEstado_usuarioR($contenido)     // linea 27, 30, 31 y 32 de editaron
		{
           
		$sql = "SELECT * FROM tbl_estados_usuarios
		WHERE id_estado_usuario like '%$contenido%' or 
		Nombre_estado like '%$contenido%' or 
        Fecha_Creacion like '%$contenido%'";
        
		$request = $this->select_all($sql);

		return $request;

		}


        public function deleteEstado_usuario(int $idEstado_usuario)    // se editaron las lineas 42, 44, 45, y 49.
        {
            $this->Idtipoestado_usuario = $idEstado_usuario;
            $sql = "SELECT * FROM  tbl_ms_usuarios WHERE id_estado_usuario = $this->Idtipoestado_usuario";
            $request = $this->select_all($sql);
            if(empty($request))
            {
            $sql = "DELETE  FROM tbl_estados_usuarios WHERE id_estado_usuario = $this->Idtipoestado_usuario";
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


        public function createEstado_usuario(string $nombre,string $fechacreacion){

            $this->strNombre = $nombre;
            $this->fecha = $fechacreacion;                // se editaron lineas 65,68,72,73 y 78
            $return = 0;

            if (empty($request)) {
                $query_insert = "INSERT INTO tbl_estados_usuarios
                                    (Nombre_estado, Fecha_Creacion)
                                    VALUES(?,?)";

                $arrData = array(
                    $this->strNombre,
                    $this->fecha
                );
                $request_insert = $this->insert($query_insert, $arrData);
                $return = $request_insert;
            } else {
                $return = "exist";
            }
            return $return;
        }



        public function updateEstado_usuario(int $idEstado_usuario, string $nombre)
    {
        $this->Idtipoestado_usuario = $idEstado_usuario;
        $this->strNombre = $nombre;
        $return = 0;

        $sql = "SELECT * FROM tbl_estados_usuarios WHERE Nombre_estado = '$this->strNombre' and id_estado_usuario = $this->Idtipoestado_usuario";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE tbl_estados_usuarios
                    SET Nombre_estado =?
                        
                    WHERE id_estado_usuario = $this->Idtipoestado_usuario";

            $arrData = array(
                $this->strNombre
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