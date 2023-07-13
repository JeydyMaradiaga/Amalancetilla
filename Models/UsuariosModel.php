<?php 

	class UsuariosModel extends Mysql
	{
        private $intIdUsuario;
        private $strRol;
		private $strNombre;
		private $strPassword;
        private $intprimeringreso;
		private $intTelefono;
        private $strDireccion;
        private $intIdentidad;
		private $strEmail;
        private $strstatus;
        private $strfechaultimaconexion;
        private $strfechavencimiento;
        private $intpreguntascontestadas;

	

		public function __construct()
		{
			parent::__construct();
		}	

        //Codigo insertar en la tabla
        public function getUserEmail(string $strEmail){
            $this->strUsuario = $strEmail;
            $sql = "SELECT id_usuario ,Nombre,id_estado_usuario FROM tbl_ms_usuarios WHERE 
            Correo_Electronico = '$this->strUsuario' ";

            $request = $this->select($sql);
            return $request;

        }

        public function selectUsuarioR($contenido)
		{

		$sql = "SELECT * FROM tbl_ms_usuarios u
		INNER JOIN tbl_estados_usuarios e
		ON e.id_estado_usuario = u.id_estado_usuario 
        INNER JOIN tbl_ms_rol r
        ON r.Id_Rol = u.Id_Rol
		WHERE u.Id_Rol like '%$contenido%' or 
		u.id_usuario like '%$contenido%' or 
        r.Nombre_Rol like '%$contenido%' or 
        u.Nombre like '%$contenido%' or
        u.Telefono like '%$contenido%' or 
        u.Direccion like '%$contenido%' or 
        u.Correo_Electronico like '%$contenido%' or 
		e.Nombre_estado like'%$contenido%' or
		u.Fecha_Vencimiento  like'%$contenido%'";
		$request = $this->select_all($sql);

		return $request;

		}

        public function insertUsuario(string $rolusuario, string $nombre, string $password, int $telefono,
         string $direccion, string $email, int $status, string $fechavencimiento, int $Procedencia ){

            $this->strrolusuario = $rolusuario;
            $this->strNombre = $nombre;
            $this->strPassword = $password;
            $this->intTelefono = $telefono;
            $this->strDireccion = $direccion;
      
            $this->strEmail = $email;
            $this->strstatus = $status;
            $this->strFechavencimiento = $fechavencimiento;
            $this->strProcedencia = $Procedencia;
            //$return = 0;

            $sql = "SELECT * FROM tbl_ms_usuarios where
                    Correo_Electronico = '$this->strEmail'"; 
            $request = $this->select_all($sql); 
            //validacion de que no existe un identidad y email  igual

            //SELECT * FROM tbl_ms_usuarios where Correo_Electronico = 'ana@gmail.com' or Num_Identidad = 08012;
            
            if(empty($request)){
                $query_insert = "INSERT INTO tbl_ms_usuarios (
                    id_Rol,nombre,contrasena,Telefono,Direccion,Correo_electronico,id_estado_usuario,fecha_vencimiento,Procedencia)
                    VALUES(?,?,?,?,?,?,?,?,?)";
                $arrData = array($this->strrolusuario,
                                 $this->strNombre,
                                 $this->strPassword,
                                 $this->intTelefono,
                                 $this->strDireccion,
                              
                                 $this->strEmail,
                                 $this->strstatus,
                                 $this->strFechavencimiento,
                                 $this->strProcedencia);

                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;                 
            }else{
                $return = "exist";
            }
            return $return;
        }  //FinalCodigo insertar en la tabla
		

        //seleccionar usuario
        public function getParametroFechaVencimiento(){//obtenemos el valor del parametro de intentos de acceso al sistema
           
            $sql = "SELECT valor_parametro FROM tbl_ms_parametros WHERE Id_Parametro = 3 ";//OBTENEMOS EL VALOR DEL PARAMETRO DE LA FECHA DE VENCIMIENTO
            $request = $this->select($sql);
            return $request;
        }
        public function selectUsuario()
		{
			$whereAdmin = "";
		
			$sql = "SELECT u.id_usuario,r.Id_Rol,r.Nombre_Rol,u.Nombre,u.Telefono,u.Direccion,u.Correo_Electronico,u.id_estado_usuario,u.Fecha_Vencimiento
					FROM tbl_ms_usuarios u
					INNER JOIN tbl_ms_rol r
					ON u.Id_Rol = r.Id_Rol WHERE u.id_estado_usuario <> 5";
					$request = $this->select_all($sql); 
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


        public function selectUsuarioM(int $idUsuario)
		{
            $this->intIdUsuario = $idUsuario;
			$whereAdmin = "";
		
			$sql = "SELECT u.id_usuario,r.Id_Rol,r.Nombre_Rol,u.Nombre,u.Telefono,u.Direccion,u.Correo_Electronico,u.id_estado_usuario,u.Fecha_Ult_Conexion,u.Fecha_Vencimiento
					FROM tbl_ms_usuarios u
					INNER JOIN tbl_ms_rol r
					ON u.Id_Rol = r.Id_Rol 
                    WHERE u.id_usuario = $this->intIdUsuario  ";
                    
					$request = $this->select($sql);
					return $request;
		}
        //CODIGO PARA ESTADO USUARIO
        public function selectEstados()
		{

		$sql = "SELECT * FROM tbl_estados_usuarios WHERE id_estado_usuario <> 5 ";//solo mostrar los primeros 4 estados
	
		$request = $this->select_all($sql);

		return $request;

		}

        public function selectRoles()
		{

		$sql = "SELECT * FROM tbl_ms_rol where estado_rol =1";
	
		$request = $this->select_all($sql);

		return $request;

		}
        //actualizar los datos del usuario

        public function updateUsuario(int $idUsuario, string $strrolusuario, string $strNombre, string $strPassword, 
         int $intTelefono, string  $strDireccion,  string  $strEmail, string  $strstatus){

        $this->intIdUsuario = $idUsuario;
        $this->strRol = $strrolusuario;
        $this->strNombre =  $strNombre;
        $this->strPassword =  $strPassword;
        $this->intTelefono  = $intTelefono;
        $this->strDireccion =  $strDireccion;

        $this->strEmail =  $strEmail;
        $this->strstatus = $strstatus;
      // $this->strfechavencimiento =  $strFechavencimiento;

        //validacion que si el email y la identidad existe
        $sql = "SELECT * FROM tbl_ms_usuarios WHERE (Correo_Electronico = '{$this->strEmail}' AND id_usuario != $this->intIdUsuario)
                                             AND id_usuario != $this->intIdUsuario "; // validacion que el usuario no coloque un correo de otro usuario
        
        $request = $this->select_all($sql); //buscar o extraer todos los registros de la tabla

        if(empty($request)){ //traer registros

            if($this->strPassword != "")//si la clave esta vacia
            {
                $sql = "UPDATE tbl_ms_usuarios SET Id_Rol=?, Nombre=?, Contrasena=?,
                        Telefono=?, Direccion=?,  Correo_Electronico=?, id_estado_usuario=?
                        WHERE id_usuario = $this->intIdUsuario";
                $arrData = array(
                                 $this->strRol,
                                 $this->strNombre,
                                 $this->strPassword,
                                 $this->intTelefono,
                                 $this->strDireccion,
                              
                                 $this->strEmail,
                                 $this->strstatus);
                 return true;
            }else{
                $sql = "UPDATE tbl_ms_usuarios SET Id_Rol=?, Nombre=?, 
                        Telefono=?, Direccion=?, Correo_Electronico=?, id_estado_usuario=?
                        WHERE id_usuario = $this->intIdUsuario";
                $arrData = array(
                                 $this->strRol,
                                 $this->strNombre,
                                 $this->intTelefono,
                                 $this->strDireccion,
                            
                                 $this->strEmail,
                                 $this->strstatus);
            }
            $request = $this->update($sql,$arrData);
            return true;

        }else{
            $request = "exist"; // si ya existe el email o la identidad sale
        }

        //return $request;

    }
    
    

    public function updateIntentos(int $id_Usuario, string $intento){
        $this->intIdusuario = $id_Usuario;
        $this->stridestado = $intento;
        $sql = "UPDATE tbl_ms_usuarios  SET intentos_acceso = ? WHERE id_usuario = $this->intIdusuario";
       
        $arrData = array($this->stridestado);
        $request = $this->update($sql,$arrData);
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
    public function UpdateReinicio(int $id_Usuario, string $correo){
        $this->intIdusuario = $id_Usuario;
        $this->strcorreo = $correo;
        $sql = "UPDATE tbl_reinicio_contrasena  SET correo = ? WHERE id_usuario = $this->intIdusuario";
       
        $arrData = array($this->strcorreo);
        $request = $this->update($sql,$arrData);
        return $request;
    }
    public function deleteUsuario(int $intIdpersona)
    {
        if($intIdpersona == 1)
        {
        $this->intIdUsuario = $intIdpersona;
         } else {
        $this->intIdUsuario = $intIdpersona;
        $sql = "DELETE  FROM  tbl_ms_usuarios WHERE id_usuario  = $this->intIdUsuario ";
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

    public function deleteUsuario2(int $intIdpersona)
    {
        $this->intIdUsuario = $intIdpersona;//validacion que nos sirve para historial
        //$sql = "UPDATE tbl_ms_usuarios SET id_estado_usuario = ? WHERE id_usuario = $this->intIdUsuario ";
        //$arrData = array(0);
        //$request = $this->update($arrData);
        //return $request;
    }
    // si los datos estan relacionados
   // public function updatestadodel(int $id_Usuario, string $idestado){
      //   $this->intIdusuario = $id_Usuario;
         //$this->stridestado = $idestado;
         //$sql = "UPDATE tbl_ms_usuarios  SET id_estado_usuario = ? WHERE id_usuario = $this->intIdusuario";
       
         //$arrData = array($this->stridestado);
         //$request = $this->update($sql,$arrData);
         //return $request;
     //}

	}
    
 ?>