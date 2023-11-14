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
        $sql = "SELECT B.Id_Bitacora,
        U.Nombre AS Id_Usuario,
        O.Nombre_Objeto AS Id_Objeto,
        B.Accion,
        B.Descripcion,
        B.Fecha
        FROM tbl_ms_bitacora B 
        INNER JOIN tbl_ms_usuarios U ON U.id_usuario = B.Id_Usuario
        INNER JOIN tbl_ms_objetos O ON O.Id_Objeto = B.Id_Objeto;";
        $request = $this->select_all($sql);
        return $request;
    }
}
