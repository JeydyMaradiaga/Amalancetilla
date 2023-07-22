let tableMovimientos;
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
            {"data":"Id_tipo_movimiento"},
            {"data":"Nombre_movimiento"},
            {"data":"options"}
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });


});

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
    var ajaxUrl = base_url + '/Movimientos/setMovimiento'; //URL para acceder al metodo
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




function fntEditInfo(element,idmovimiento) {
    
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Movimiento";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Movimientos/getMovimiento/'+idmovimiento;
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
    