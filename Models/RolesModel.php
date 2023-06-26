<?php

class RolesModel extends Mysql
{
    public $intIdrol;
    public $strRol;
    public $strDescripcion;
    public $intStatus;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectRoles()
    {
        //MOSTRAR ROLES
        $sql = "SELECT * FROM tbl_ms_rol WHERE estado_rol != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectRol(int $idrol)
    {
        //BUSCAR ROLES
        $this->intIdrol = $idrol;
        $sql = "SELECT * FROM tbl_ms_rol WHERE Id_Rol = $this->intIdrol";
        $request = $this->select($sql);
        return $request;
    }

    public function insertRol(string $rol, string $descripcion, int $status)
    {

        $return = "";
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $status;

        $sql = "SELECT * FROM tbl_ms_rol WHERE Nombre_Rol = '{$this->strRol}' ";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query_insert  = "INSERT INTO tbl_ms_rol(Nombre_Rol,Descripcion_Rol,estado_rol) VALUES(?,?,?)";
            $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
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

    public function updateRol(int $idrol, string $rol, string $descripcion, int $status)
    {
        $this->intIdrol = $idrol;
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $status;

        $sql = "SELECT * FROM tbl_ms_rol WHERE Nombre_Rol = '$this->strRol' AND Id_Rol != $this->intIdrol";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE tbl_ms_rol SET Nombre_Rol = ?, Descripcion_Rol = ?, estado_rol = ? WHERE Id_Rol = $this->intIdrol ";
            $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteRol(int $idrol)
    {
        $this->intIdrol = $idrol;
        $sql = "SELECT * FROM tbl_ms_usuarios WHERE Id_Rol = $this->intIdrol";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE tbl_ms_rol SET estado_rol = ? WHERE Id_Rol = $this->intIdrol ";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);
            if ($request) {
                $request = 'ok';
            } else {
                $request = 'error';
            }
        } else {
            $request = 'exist';
        }
        return $request;
    }
}
