let tableInventarios;//get
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){
    tableInventarios = $('#tableInventarios').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Inventarios/getInventarios",
            "dataSrc":""
        },
        "columns":[
            {"data":"Id_Inventario"},
            {"data":"Nombre"},
            {"data":"Descripcion"},
            {"data":"Precio_Venta"},
            {"data":"Cantidad_Existente"},
            {"data":"Cantidad_Minima","visible": false},
            {"data":"Cantidad_Maxima","visible": false},
            {"data":"alertas"},
            {"data":"options"}
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    }); //get

}, false);


function fntPDF() {
 
    let  buscador = $('.dataTables_filter input').val();
    var win = window.open( base_url + '/Inventarios/getInventarioR/'+buscador, '_blank');
    win.focus();
    
}


