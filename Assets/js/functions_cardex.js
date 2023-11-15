let tableCardexs;//get
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){
    tableCardexs = $('#tableCardexs').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Cardexs/getCardexs",
            "dataSrc":""
        },
        "columns":[
            {"data":"Id_Movimiento","visible": false},
            {"data":"Nombres"},
            {"data":"Fecha_movimiento"},
            {"data":"Hora_movimiento"},
            {"data":"Cantidad_movimiento"},
            {"data":"Nombre_movimiento"},
            {"data":"Nombre"},
            
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    }); //get

}, false);


function fntPDF() {
 
    let  buscador = $('.dataTables_filter input').val();
     var win = window.open( base_url + '/Cardexs/getCardexR/'+buscador, '_blank');
     win.focus();
}