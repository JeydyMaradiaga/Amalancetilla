<?php
    class ClientesModel extends Mysql
    {
        public $intidCliente;
		public $strNombre;
        public $strApellido;
        public $strEmail;
		public $intTelefono;
        public $strDireccion;
        public $intnumeroid;

        public function __construct()
		{
			parent::__construct();
		}

        public function selectClientes()
        {
            $sql = "SELECT * FROM tbl_clientes";
			$request = $this->select_all($sql);
			return $request;
        }

        public function createCliente( string $nombre, string $apellidos, string $email, int $telefono, string $direccion, int $numeroid)
        {
            $this->strNombre = $nombre;
            $this->strApellido = $apellidos;
            $this->strEmail = $email;
            $this->intTelefono = $telefono;
            $this->strDireccion = $direccion;
            $this->intnumeroid = $numeroid;
            $return = 0;

            if(empty($request)){
                $query_insert = "INSERT INTO tbl_clientes (
                    Nombre,Apellidos,Correo_Cliente,Telefono,Direccion,Numero_ID)
                    VALUES(?,?,?,?,?,?)";
                $arrData = array( $this->strNombre,
                                 $this->strApellido,
                                 $this->strEmail,
                                 $this->intTelefono,
                                 $this->strDireccion,
                                 $this->intnumeroid
                                );
                $request_insert = $this->insert($query_insert, $arrData);
                $return = $request_insert;
            } else {
                $return = "exist";
            }
            return $return;
        }

        public function selectCliente(int $idcliente){
			$this->intIdcliente = $idcliente;
			$sql = "SELECT * FROM tbl_clientes
					WHERE Id_Cliente = $this->intIdcliente";
			$request = $this->select($sql);
			return $request;
		}

        public function updateCliente(int $idCliente, string $nombre, string $apellidos,string $email,
        int $telefono,string $direccion,int $numeroid){
           
            $this->intidCliente = $idCliente;
            $this->strNombre = $nombre;
            $this->strApellido = $apellidos;
            $this->strEmail = $email; 
            $this->intTelefono = $telefono;
            $this->strDireccion = $direccion;
            $this->intnumeroid = $numeroid;
    
            $return = 0;
    
            //validacion que si el email y la identidad existe
            $sql = "SELECT * FROM tbl_clientes WHERE Nombre = '$this->strNombre' and Id_Cliente != $this->intidCliente";
            $request = $this->select_all($sql);
    
            if (empty($request)) {
               $sql = "UPDATE tbl_clientes SET Nombre=?,Apellidos=?,Correo_Cliente=?,Telefono=?,Direccion=?,Numero_ID=?
                                           WHERE Id_Cliente = $this->intidCliente";
                                                        $arrData = array(
                                                            $this->strNombre,
                                                            $this->strApellido,
                                                            $this->strEmail,
                                                            $this->intTelefono,
                                                            $this->strDireccion,
                                                            $this->intnumeroid
                                                        );
            
                        $request = $this->update($sql, $arrData);
                        $return = $request;
                    } else {
                        $return = "exist";
                    }
                
                            return $return;
        }

        public function deleteCliente(int $idcliente)
        {
            $this->intIdcliente = $idcliente;
            $sql = "SELECT * FROM tbl_pedidos WHERE Id_Cliente = $this->intIdcliente";
            $request = $this->select_all($sql);
            if(empty($request))
            {
            $sql = "DELETE  FROM tbl_clientes WHERE Id_Cliente = $this->intIdcliente";
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
	

        public function selectClienteR($contenido) 
		{

            $sql = "SELECT * FROM tbl_clientes 
            WHERE Id_Cliente like '%$contenido%' or 
            Nombre like '%$contenido%' or 
            Apellidos like '%$contenido%' or 
            Correo_Cliente like '%$contenido%' or
            Telefono like '%$contenido%' or 
            Direccion like '%$contenido%' or 
            Numero_ID like'%$contenido%'";
        
            $request = $this->select_all($sql);

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