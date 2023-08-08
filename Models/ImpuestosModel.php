<?php
class ImpuestosModel extends Mysql
{
    public $intId_ISV;
    public $strNombreISV;
    public $strPorcentajeISV;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectImpuestos()
    {
        $sql = "SELECT * FROM tbl_impuestos";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectImpuesto(int $Id_ISV){
        $this->intId_ISV = $Id_ISV;
        $sql = "SELECT * FROM tbl_impuestos
                WHERE Id_ISV = $this->intId_ISV";
        $request = $this->select($sql);
        return $request;
    }

    public function selectImpuestoR($contenido) 
    {

    $sql = "SELECT * FROM tbl_impuestos 
    WHERE Id_ISV like '%$contenido%' or 
    Nombre_ISV like '%$contenido%' or 
    Porcentaje_ISV like '%$contenido%'" ;
    
    $request = $this->select_all($sql);

    return $request;

    }

    public function deleteImpuesto(int $Id_ISV) 
    {
        $this->intId_ISV = $Id_ISV;
        $sql = "SELECT * FROM tbl_productos WHERE Id_ISV = $this->intId_ISV";
        $request = $this->select_all($sql);
        if(empty($request))
        {
        $sql = "DELETE  FROM tbl_impuestos WHERE Id_ISV = $this->intId_ISV";
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

    public function createImpuesto(string $NombreISV, string $PorcentajeISV){

        $this->strNombreISV = $NombreISV;
        $this->strPorcentajeISV = $PorcentajeISV;
        $return = 0;

        if (empty($request)) {
            $query_insert = "INSERT INTO tbl_impuestos
                                (Nombre_ISV, Porcentaje_ISV)
                                VALUES(?, ?)";

            $arrData = array(
                $this->strNombreISV,
                $this->strPorcentajeISV
                
                
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }

    public function updateImpuesto(int $Id_ISV, string $NombreISV, string $PorcentajeISV)
    {
        $this->intId_ISV = $Id_ISV;
        $this->strNombreISV = $NombreISV;
        $this->strPorcentajeISV = $PorcentajeISV;

        $return = 0;

        $sql = "SELECT * FROM tbl_impuestos WHERE Nombre_ISV = '$this->strNombreISV' and Id_ISV != $this->intId_ISV";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE tbl_impuestos 
                    SET Nombre_ISV=?,
                        Porcentaje_ISV=?
                    WHERE Id_ISV = $this->intId_ISV";

            $arrData = array(
                $this->strNombreISV,
                $this->strPorcentajeISV
                
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
