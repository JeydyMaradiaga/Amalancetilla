<?php 

	class LoginModel extends Mysql
	{
        //variables a usar
        private $intIdUsuario;
        private $strUsuario;
        private $strPassword;
        private $strToken;
        private $strEmail;
        private $respuesta;
        private $pregunta;
        private $strPregunta;
        private $intprimer;   
        private $strEvento ;
       private $strObjeto ;
        private $strDescripcion ;
       private $strFecha ;

		public function __construct()
		{
			parent::__construct();
			
		}

        public function loginUser(string $usuario, string $password){

            $this->strUsuario = $usuario; // asigamos a la variable usuario el valor que la funcion trae como parametro de usuario y lo mismo para la contrasena
            $this->strPassword = $password;
            $sql = "SELECT id_usuario ,Nombre,id_estado_usuario,Primer_ingreso FROM tbl_ms_usuarios WHERE 
                    Correo_Electronico = '$this->strUsuario' and
                    Contrasena = '$this->strPassword'";
                    
                    $request = $this->select($sql);
                    return $request;
        }	
        public function getEstado(string $usuario){

            $this->strUsuario = $usuario; // asigamos a la variable usuario el valor que la funcion trae como parametro de usuario y lo mismo para la contrasena
            $sql = "SELECT id_usuario,id_estado_usuario FROM tbl_ms_usuarios WHERE 
                    Correo_Electronico = '$this->strUsuario' ";        
                    $request = $this->select($sql);
                    return $request;
        }	

        public function sessionLogin(int $id_Usuario){
            $this->intIdUsuario = $id_Usuario;
			//BUSCAR ROLE 
			$sql = "SELECT p.id_usuario,
							p.Nombre ,
							p.Telefono,
							p.Correo_Electronico ,
							p.Direccion ,
							r.Id_Rol,r.Nombre_Rol,
							p.id_estado_usuario 
					FROM tbl_ms_usuarios p
					INNER JOIN tbl_ms_rol r
					ON p.Id_Rol = r.Id_Rol
					WHERE p.id_usuario = $this->intIdUsuario";
			$request = $this->select($sql);
			$_SESSION['userData'] = $request;
          

        }

        public function getUserEmail(string $strEmail){
            $this->strUsuario = $strEmail;
            $sql = "SELECT id_usuario ,Nombre,id_estado_usuario,id_estado_usuario FROM tbl_ms_usuarios WHERE 
            Correo_Electronico = '$this->strUsuario'";
            $request = $this->select($sql);
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
        public function setTokenUser(int $id_Usuario, string $token, string $fechaVencimiento){
            $this->intIdUsuario = $id_Usuario;
            $this->strToken = $token;
            $this->dateFechaVencimiento = $fechaVencimiento;
            $sql = "UPDATE tbl_reinicio_contrasena SET Token = ?,Fecha_Vencimiento = ?  WHERE id_Usuario = $this->intIdUsuario";
            $arrData = array($this->strToken,
                            $this->dateFechaVencimiento);
            $request = $this->update($sql,$arrData);
            return $request;
        }
        public function getFechaVencimiento(string $correo){//obtenemos la fecha de vencimiento del token
            $this->strcorreo = $correo;
            $sql = "SELECT fecha_vencimiento FROM tbl_reinicio_contrasena WHERE Correo = '$this->strcorreo' ";
            $request = $this->select($sql);
            return $request;
           
        }
            public function getUsuario(string $email, string $token){//obtiene el id de la persona y valida si el token es igual al que esta en la BD
                $this->strUsuario = $email;
                $this->strToken = $token;
                $sql = "SELECT u.id_usuario,u.nombre FROM tbl_ms_usuarios u INNER JOIN tbl_reinicio_contrasena r 
                ON r.Token = '$this->strToken' WHERE u.Correo_Electronico = '$this->strUsuario'
                 
                and r.Token = '$this->strToken'";
                
                $request = $this->select($sql);
                return $request;

            }

            public function getUsuario1(string $email){//obtenemos un solo usuario
                $this->strUsuario = $email;
                $sql = "SELECT id_usuario,nombre,intentos_acceso,fecha_vencimiento FROM tbl_ms_usuarios WHERE correo_electronico = '$this->strUsuario' and id_estado_usuario != 5";
                $request = $this->select($sql);
                return $request;
            }
            public function getParametroIntentos(){//obtenemos el valor del parametro de intentos de acceso al sistema
                $sql = "SELECT valor_parametro FROM tbl_ms_parametros WHERE  Id_Parametro= 1 ";
                $request = $this->select($sql);
                return $request;
            }
            public function getParametroPreguntas(){//obtenemos el valor del parametro de intentos de acceso al sistema
           
                $sql = "SELECT valor_parametro FROM tbl_ms_parametros WHERE Id_Parametro = 2 ";
                $request = $this->select($sql);
                return $request;
            }
            public function getUsuarioP(string $id_Usuario){//obtenemos un solo usuario para las preguntas de seguridad------> 
                $this->strUsuario = $id_Usuario;
            
                $sql = "SELECT id_usuario,nombre,correo_electronico,contrasena FROM tbl_ms_usuarios WHERE id_usuario = '$this->strUsuario' ";
                $request = $this->select($sql);
                return $request;

            }
            public function GetCountPreguntas(string $id_Usuario){//obtenemos un solo usuario para las preguntas de seguridad------> 
                $this->strUsuario = $id_Usuario;
            
                $sql = "SELECT count(*) FROM tbl_ms_preguntas_usuario WHERE id_usuario = '$this->strUsuario' ";
                $request = $this->select($sql);
                return $request;

            }

            public function insertPassword(int $id_Usuario, string $contraseña){
                $this->intIdusuario = $id_Usuario;
                $this->strPassword = $contraseña;
                $sql = "UPDATE tbl_ms_usuarios u, tbl_reinicio_contrasena r SET contrasena = ?, Token = ?  WHERE u.id_usuario = $this->intIdusuario and r.Id_Usuario = $this->intIdusuario ";
               
                $arrData = array($this->strPassword, "");
                $request = $this->update($sql,$arrData);
                return $request;
            }
            
            public function SetHistContrasena( string $contraseña,int $id_Usuario){
             
                $this->strcontrasena = $contraseña;
                $this->intIdusuario = $id_Usuario;
                $sql = "INSERT INTO tbl_ms_historico_contrasena (Id_Usuario, Contrasena) VALUES 
                (?,?)";
               //por aqui nos quedamos
                $arrData = array($this->intIdusuario,
                                $this->strcontrasena);
                $request = $this->insert($sql,$arrData);
                return $request;
            }
            
            public function selectRespuestaPreguntas(int $id_Usuario, int $pregunta, string $respuesta){//obtenemos la respuesta
                // $this->strUsuario = $strEmail;
               $this->intIdusuario = $id_Usuario;
               $this->pregunta = $pregunta;
               $this->respuesta = $respuesta;
                  $sql = "SELECT id_pregunta,Respuesta FROM tbl_ms_preguntas_usuario 
                  WHERE id_pregunta =  '$this->pregunta' and 
                  Respuesta = '$this->respuesta' and Id_Usuario = $this->intIdusuario";   
                 $request = $this->select($sql);
                 
                 return $request;
 
             }
             public function EstadoUser(string $iduser, int $estado){//bloquea el usuario dando el valor de 3 en el estado que corresponde a bloqueado por intentos de contrasena
                $this->strUsuario = $iduser;
                $this->intEstado = $estado;
                $sql = "UPDATE tbl_ms_usuarios SET id_estado_usuario = ? WHERE correo_electronico = '$this->strUsuario'";
                $arrData = array(  $this->intEstado);
                $request = $this->update($sql,$arrData);
                return $request;
    
            }
            public function updateIntentos1(string $iduser, int $intento){//Actualiza la cantidad de intentos erroneos al sistema
                $this->strUsuario = $iduser;
                $this->intIntento = $intento;
                $sql = "UPDATE tbl_ms_usuarios SET intentos_acceso = intentos_acceso + ? WHERE correo_electronico = '$this->strUsuario'";
                $arrData = array($this->intIntento);
                $request = $this->update($sql,$arrData);
                return $request;
    
            }
            public function updateIntentos(string $iduser, int $intento){//Actualiza la cantidad de intentos al valor de 0 cuando ya accedio correctamente al sistema
                $this->strUsuario = $iduser;
                $this->intIntento = $intento;
                $sql = "UPDATE tbl_ms_usuarios SET intentos_acceso =  ? WHERE correo_electronico = '$this->strUsuario'";
                $arrData = array($this->intIntento);
                $request = $this->update($sql,$arrData);
                return $request;
            }
            public function selectPreguntas(){
               // $this->strUsuario = $strEmail;
             

                 $sql = "SELECT  id_pregunta, pregunta FROM tbl_ms_preguntas";   
             
                $request = $this->select_all($sql);
                return $request;

            }
            public function ObtenerUsuario(string $id_Usuario){// obtengo un solo usuario
                // $this->strUsuario = $strEmail;
                    $this->intIdusuario = $id_Usuario;
 
                  $sql = "SELECT Nombre,Correo_Electronico,id_estado_usuario FROM tbl_ms_usuarios
             
                   WHERE id_usuario = $this->intIdusuario ";   
              
                 $request = $this->select($sql);
                 return $request;
             }
             public function getParametroFechaVencimientoToken(){//obtenemos el valor del parametro de token
           
                $sql = "SELECT valor_parametro FROM tbl_ms_parametros WHERE Id_Parametro = 4 ";//OBTENEMOS EL VALOR DEL PARAMETRO DE LA FECHA DE VENCIMIENTO
                $request = $this->select($sql);
                return $request;
            }
            public function getParametroFechaVencimiento(){//obtenemos el valor del parametro de vencimiento usuario
           
                $sql = "SELECT valor_parametro FROM tbl_ms_parametros WHERE Id_Parametro = 3 ";//OBTENEMOS EL VALOR DEL PARAMETRO DE LA FECHA DE VENCIMIENTO
                $request = $this->select($sql);
                return $request;
            }
          
             ///////////////////////////////////////---->Comienzo parte hecha por Cheyla
             public function insertPreguntasP(int $id,INT $id_Pregunta, string $Respuesta ){
                $this->strPregunta = $id_Pregunta;
                $this->strRespuesta = $Respuesta;
                $this->intIdusuario = $id;
                $sql = "INSERT INTO tbl_ms_preguntas_usuario (Id_Usuario, id_pregunta, Respuesta) VALUES 
                (?,?,?)";
               //por aqui nos quedamos
                $arrData = array($this->intIdusuario,
                                $this->strPregunta,
                                $this->strRespuesta);
                $request = $this->insert($sql,$arrData);
                return $request;
            }
            public function updateprimeravez(int $PrimerI,int $ID){
                $this->intprimer = $PrimerI;
                $this->intIdusuario = $ID;
                $sql = "UPDATE tbl_ms_usuarios set id_estado_usuario = ? where id_usuario = $this->intIdusuario";
                $arrData = array($this->intprimer);
                $request = $this->update($sql,$arrData);
                return $request;
            }
            /////////////////////////////////////////----->Fin parte hecha por Cheyla
            public function updateFechaVencimiento(string $fecha,int $ID){
                $this->strfecha = $fecha;
                $this->intIdusuario = $ID;
                $sql = "UPDATE tbl_ms_usuarios set fecha_vencimiento = ? where id_usuario = $this->intIdusuario";
                $arrData = array($this->strfecha);
                $request = $this->update($sql,$arrData);
                return $request;
            }
	}

