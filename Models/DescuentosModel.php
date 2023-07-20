<?php
 
class DescuentosModel extends Mysql
{
    private $IdDescuento;
    private $strNombre;
    private $descripcion;
    private $porcentaje_deduccion;
    private $estado;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectDescuentos()
    {
        $sql = "SELECT * FROM tbl_descuentos WHERE Estado > 0 ";
        $request = $this->select_all($sql);
        
        return $request;
    }

    public function selectDescuento(int $idDescuento){
        $this->IdDescuento = $idDescuento;
        $sql = "SELECT * FROM tbl_descuentos WHERE Id_Descuento=$this->IdDescuento";
        $request = $this->select($sql);
       
        return $request;

    }

    public function createDescuento(string $nombre, float $porcentajeDeduccion,  string $estado, string $descripcion)
    {

        $this->strNombre = $nombre;
        $this->descripcion = $descripcion;
        $this->porcentaje_deduccion = $porcentajeDeduccion;
        $this->estado = $estado;

        $return = 0;

        if (empty($request)) {
            $query_insert = "INSERT INTO tbl_descuentos(
                        Nombre,Porcentaje_Deduccion,Descripcion,Estado)
                                VALUES(?,?,?,?)";

            $arrData = array(
                $this->strNombre,
                $this->porcentaje_deduccion,
                $this->descripcion,
                $this->estado
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }

    public function updateDescuento(int $idDescuento, string $nombre, float $porcentajeDeduccion, string $estado, string $descripcion)
    {
        $this->IdDescuento = $idDescuento;
        $this->strNombre = $nombre;
        $this->porcentaje_deduccion = $porcentajeDeduccion;
        $this->estado = $estado;
        $this->descripcion = $descripcion;

        $return = 0;

        $sql = "SELECT * FROM tbl_descuentos WHERE Nombre = '$this->strNombre' and Id_Descuento != $this->IdDescuento";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE tbl_descuentos 
                    SET Nombre=?,
                        Porcentaje_Deduccion=?,
                        Descripcion=?,
                        Estado=?
                    WHERE Id_Descuento = $this->IdDescuento";

            $arrData = array(
                $this->strNombre,
                $this->porcentaje_deduccion,
                $this->descripcion,
                $this->estado
             
            );

            $request = $this->update($sql, $arrData);
            $return = $request;
        } else {
            $return = "exist";
        }
       
                return $return;
    }

    public function deleteParametro(int $idDescuento)
    {
        $this->IdDescuento = $idDescuento;
        $sql = "UPDATE tbl_descuentos SET Estado = ? WHERE Id_Descuento = $this->IdDescuento ";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
