<?php 

	class Registro_UsuarioModel extends Mysql
	{
       // private $intIdUsuario;
        //private $strRol;
		private $strNombre;
		private $strPassword;
       // private $intprimeringreso;
		private $intTelefono;
        private $strDireccion;
		private $strEmail;
        private $strstatus;
        //private $strfechaultimaconexion;
        //private $strfechavencimiento;
        //private $intpreguntascontestadas;

		public function __construct()
		{ 
			parent::__construct();
		}	
		

        //Codigo para obtener el email del usuario
        public function getUserEmail(string $strEmail){
            $this->strUsuario = $strEmail;
            $sql = "SELECT id_usuario ,Nombre,id_estado_usuario FROM tbl_ms_usuarios WHERE 
            Correo_Electronico = '$this->strUsuario' ";

            $request = $this->select($sql);
            return $request;

        }
        public function insertReinicio($idUsuario, $correo){

            $this->strCorreo = $correo;
            $this->intIdusuario = $idUsuario;
            $sql = "INSERT INTO tbl_reinicio_contrasena (Id_Usuario, Correo) VALUES 
            (?,?)";
           //por aqui nos quedamos
            $arrData = array($this->intIdusuario,
                            $this->strCorreo);
            $request = $this->insert($sql,$arrData);
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

        public function insertUsuario(int $rol,string $nombre,  int $telefono,string $direccion,string $email, int $strStatus, string $password, string $fechavencimiento ){

           $this->strrolusuario = $rol;
            $this->strNombre = $nombre;
            $this->strEmail = $email;
            $this->strstatus = $strStatus;
            $this->strPassword = $password;
            $this->intTelefono = $telefono;
            $this->strDireccion = $direccion;
            $this->strFechavencimiento = $fechavencimiento;
            //$return = 0;

            $sql = "SELECT * FROM tbl_ms_usuarios where
                    Correo_Electronico = '$this->strEmail'"; 
            $request = $this->select_all($sql); 
            //validacion de que no existe un identidad y email  igual

            //SELECT * FROM tbl_ms_usuarios where Correo_Electronico = 'ana@gmail.com' or Num_Identidad = 08012;
            
            if(empty($request)){
                $query_insert = "INSERT INTO tbl_ms_usuarios (id_rol,nombre,Telefono,Direccion,Correo_electronico,contrasena,id_estado_usuario,fecha_vencimiento)
                    VALUES(?,?,?,?,?,?,?,?)";
                $arrData = array($this->strrolusuario,
                                 $this->strNombre,
                                 $this->intTelefono,
                                 $this->strDireccion,
                                 $this->strEmail,
                                 $this->strPassword,
                                 $this->strstatus,
                                 $this->strFechavencimiento);

                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;                 
            }else{
                $return = "exist";
            }
            return $return;
        }  //FinalCodigo insertar en la tabla
		

        //seleccionar usuario
        public function getParametroFechaVencimiento(){//obtenemos el valor del parametro de intentos de acceso al sistema
           
            $sql = "SELECT valor_parametro FROM tbl_ms_parametros WHERE nombre_parametro = 'NUM_DIAS_VENCIMIENTO' ";//OBTENEMOS EL VALOR DEL PARAMETRO DE LA FECHA DE VENCIMIENTO
            $request = $this->select($sql);
            return $request;
        }
	}
 ?>