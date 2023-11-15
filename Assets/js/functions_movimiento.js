let tableMovimientos;//get
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){
    tableMovimientos = $('#tableMovimientos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Movimientos/getMovimientos", 
            "dataSrc":""
        },
        "columns":[
            {"data":"Id_tipo_movimiento","visible": false},
            {"data":"Nombre_movimiento"},
            {"data":"options"}
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    }); //get




    // Codigo de validacion de Modal NUEVO parametro

    var formParametros = document.querySelector('#formMovimientos');// aqui form Movimientos
    formParametros.onsubmit = function (e) {
        e.preventDefault();

    
        var strNombre = document.querySelector('#txtNombreMovimiento').value; //capturar el valor de Nombre
        
        //validacion que los datos esten llenos
        if (strNombre == '' ) {
            swal("Atencion", "Todos los campos son obligatorio.", "error");
            return false;
        }


        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Movimientos/setMovimiento'; //URL para acceder al metodo de controlers
        var formData = new FormData(formParametros);
        request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#ModalMovimientos').modal("hide");
                    formParametros.reset();
                    swal("Movimientos", objData.msg, "success");
                    tableMovimientos.api().ajax.reload();
                    
                } else {
                    swal("Error", objData.msg, "error");
                }
            } else {
                console.log("Error");
            }

        }

    }

}, false);

  
function fntEditInfo(element,idmovimiento) {
    
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Movimiento";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Movimientos/getMovimiento/'+idmovimiento; //lleva a controllers
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
               
                document.querySelector('#idMovimiento').value = objData.data.Id_tipo_movimiento; //trae el nombre del usuario
                document.querySelector('#txtNombreMovimiento').value = objData.data.Nombre_movimiento; //trae el nombre del usuario
                
               
                
                $('#ModalMovimientos').modal('show');
            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
}

function fntDelInfo(idmovimiento){
    swal({
        title: "Eliminar movimiento de inventario",
        text: "¿Realmente quiere eliminar al movimiento?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Movimientos/delMovimiento'; // me lleba a contros
            let strData = "idMovimiento="+idmovimiento;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableMovimientos.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

function fntPDF() {
 
    let  buscador = $('.dataTables_filter input').val();
     var win = window.open( base_url + '/Movimientos/getMovimientoR/'+buscador, '_blank');
     win.focus();
}

function openModal() 
{
    rowTable = "";
    document.querySelector('#idMovimiento').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Movimiento";//titulo del modal
    document.querySelector("#formMovimientos").reset();
    $('#ModalMovimientos').modal('show'); //mostrar el  modal
}
    