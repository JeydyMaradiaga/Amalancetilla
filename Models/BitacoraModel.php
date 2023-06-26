<?php
class BitacoraModel extends Mysql{
    private $intId_Bitacora; 
    private $intId_Usuario;
	private $intId_Objeto;
    private $strAccion;
    private $strDescripcion;
    private $strFecha;
 
    public function __construct()
	{
		parent::__construct();
	}	
    public function selectBitacora()
    {
        $sql = "SELECT * FROM tbl_ms_bitacora";
        $request = $this->select_all($sql);
        return $request;
    }
}
