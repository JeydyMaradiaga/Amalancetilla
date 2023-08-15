<?php
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
    class Bitacora extends Controllers{
        public function __construct()
        {

            parent::__construct();

            session_start();
            if (empty($_SESSION['login'])) {
                header('Location: ' . base_url() . '/login');
                die();
            }     
            getPermisos(MBITACORA);   
        }

        public function Bitacora()
        {

            if (empty($_SESSION['permisosMod']['Permiso_Get'] ||  $_SESSION['userData']['id_usuario'] == 1)) {
                header("Location:" . base_url() . '/dashboard');
            }
            $data['page_id'] = 5;
            $data['page_tag'] = "Bitacora";
            $data['page_name'] = "bitacora";
            $data['page_title'] = "Bitacora";
            $data['page_functions_js'] = "functions_bitacora.js";
            $this->views->getView($this, "bitacora", $data);
        }

        public function getBitacora()
        {
            $arrData = $this->model->selectBitacora();
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getBitacoraR()
        {
        //if($_SESSION['permisosMod']['Permiso_Get']){
            $data = $this->model->selectBitacora();
            //dep($arrData );
            //die();

            ob_end_clean();
            //  $html2pdf = new HTML2PDF();
            $html = getFile("Template/Modals/reporteBitacoraPDF",$data);
            $html2pdf = new Html2Pdf();
            $html2pdf->writeHTML($html);
            $html2pdf->output();
        //}
        die();
        } //fin 


    }