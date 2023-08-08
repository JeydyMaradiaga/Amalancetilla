<?php
class ProveedoresModel extends Mysql
{
    public $intId_Proveedor;
    public $strNombreProveedor;
    public $strRTNProveedor;
    public $strTelefonoProveedor;
    public $strCorreoProveedor;
    public $strDireccionProveedor;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectProveedores()
    {
        $sql = "SELECT * FROM tbl_proveedor";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectProveedor(int $Id_Proveedor){
        $this->intId_Proveedor = $Id_Proveedor;
        $sql = "SELECT * FROM tbl_proveedor
                WHERE Id_Proveedor = $this->intId_Proveedor";
        $request = $this->select($sql);
        return $request;
    }

    public function selectProveedorR($contenido) 
    {

    $sql = "SELECT * FROM tbl_proveedor
    WHERE Id_Proveedor like '%$contenido%' or 
    Nombre_Proveedor like '%$contenido%' or 
    RTN_Proveedor like '%$contenido%' or 
    Telefono_Proveedor like '%$contenido%' or
    Correo_Proveedor like '%$contenido%' or
    Direccion_Proveedor like '%$contenido%'" ;
    
    $request = $this->select_all($sql);

    return $request;

    }

    public function deleteProveedor(int $Id_Proveedor) 
    {
        $this->intId_Proveedor = $Id_Proveedor;
        $sql = "SELECT * FROM tbl_compra WHERE Id_Proveedor = $this->intId_Proveedor";
        $request = $this->select_all($sql);
        if(empty($request))
        {
        $sql = "DELETE  FROM tbl_proveedor WHERE Id_Proveedor = $this->intId_Proveedor";
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

    public function createProveedor(string $NombreProveedor, string $RTNProveedor, string $TelefonoProveedor, string $CorreoProveedor, string $DireccionProveedor){

        $this->strNombreProveedor = $NombreProveedor;
        $this->strRTNProveedor = $RTNProveedor;
        $this->strTelefonoProveedor = $TelefonoProveedor;
        $this->strCorreoProveedor = $CorreoProveedor;
        $this->strDireccionProveedor = $DireccionProveedor;
        $return = 0;

        if (empty($request)) {
            $query_insert = "INSERT INTO tbl_proveedor
                                (Nombre_Proveedor, RTN_Proveedor, Telefono_Proveedor, Correo_Proveedor, Direccion_Proveedor)
                                VALUES(?,?,?,?,?)";

            $arrData = array(
                $this->strNombreProveedor,
                $this->strRTNProveedor,
                $this->strTelefonoProveedor,
                $this->strCorreoProveedor,
                $this->strDireccionProveedor   
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }

    public function updateProveedor(int $Id_Proveedor, string $NombreProveedor, string $RTNProveedor, string $TelefonoProveedor, string $CorreoProveedor, string $DireccionProveedor)
    {
        $this->intId_Proveedor = $Id_Proveedor;
        $this->strNombreProveedor = $NombreProveedor;
        $this->strRTNProveedor = $RTNProveedor;
        $this->strTelefonoProveedor= $TelefonoProveedor;
        $this->strCorreoProveedor = $CorreoProveedor;
        $this->strDireccionProveedor = $DireccionProveedor;

        $return = 0;

        $sql = "SELECT * FROM tbl_proveedor WHERE Nombre_Proveedor = '$this->strNombreProveedor' and RTN_Proveedor != $this->intId_Proveedor";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE tbl_proveedor 
                    SET Nombre_Proveedor=?,
                        RTN_Proveedor=?,
                        Telefono_Proveedor=?,
                        Correo_Proveedor=?,
                        Direccion_Proveedor=?
                    WHERE Id_Proveedor = $this->intId_Proveedor";

            $arrData = array(
                $this->strNombreProveedor,
                $this->strRTNProveedor,
                $this->strTelefonoProveedor,
                $this->strCorreoProveedor,
                $this->strDireccionProveedor
                
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
