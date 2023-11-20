let tablePermisos;//get
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){
    tablePermisos = $('#tablePermisos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Permisos1/getPermisos1",
            "dataSrc":""
        },
        "columns":[
            {"data":"Nombre_Rol"},
            {"data":"Nombre_Objeto"},
            {"data":"Permiso_Get"},
            {"data":"Permiso_Insert"},
            {"data":"Permiso_Update"},
            {"data":"Permiso_Delete"},
            
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    }); //get

}, false);


function fntPDF() {
 
    let  buscador = $('.dataTables_filter input').val();
     var win = window.open( base_url + '/Permisos1/getPermiso1R/'+buscador, '_blank');
     win.focus();
}