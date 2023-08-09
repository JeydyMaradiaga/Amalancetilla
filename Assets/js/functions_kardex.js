let tableKardexs;//get
let rowTable = "";

function functionName(e) {
    var nombre = e.target.text;
}

document.addEventListener('DOMContentLoaded', function() {
    tableKardexs = $('#tableKardexs').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/11.11.3/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Kardexs/getKardexs/" + nombre,
            "dataSrc":""
        },
        "columns":[
            {"data":"Id_Movimiento"},
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

    tableKardexs.on('click', 'a', functionName);
});


function fntPDF() {
 
    let  buscador = $('.dataTables_filter input').val();
     var win = window.open( base_url + '/Cardexs/getCardexR/'+buscador, '_blank');
     win.focus();
}