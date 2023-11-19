let tableEstado_usuarios;
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){
    tableEstado_usuarios = $('#tableEstado_usuarios').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Estado_usuarios/getEstado_usuarios", 
            "dataSrc":""
        },
        "columns":[
            {"data":"id_estado_usuario","visible": false},
            {"data":"Nombre_estado"},
            {"data":"Fecha_Creacion"},
            {"data":"options"}
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

});

    // Codigo de validacion de Modal NUEVO parametro 

var formParametros = document.querySelector('#formEstado_usuarios');// aqui form resytadp pedido
formParametros.onsubmit = function (e) {
    e.preventDefault();

   
    var strNombre = document.querySelector('#txtNombreEstado').value; //capturar el valor de Nombre
    //validacion que los datos esten llenos
    if (strNombre == '') {                                                 // se edito esta parte
        swal("Atencion", "Todos los campos son obligatorio.", "error");
        return false;
    }


    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Estado_usuarios/setEstado_usuario'; //URL para acceder al metodo, se edito esta parte
    var formData = new FormData(formParametros);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {                                  // lineas 55, 57 y 58 se editaron.
                $('#ModalEstado_usuarios').modal("hide");
                formParametros.reset();
                swal("Estado_usuarios", objData.msg, "success");
                tableEstado_usuarios.api().ajax.reload();
                
            } else {
                swal("Error", objData.msg, "error");
            }
        } else {
            console.log("Error");
        }

    }

}


function fntEditInfo(element,idestado_usuario) {             // se edito las lineas 72, 75 y 81
    
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar estado usuarios";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Estado_usuarios/getEstado_usuario/'+idestado_usuario;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                
                document.querySelector('#idEstado_usuario').value = objData.data.id_estado_usuario //trae el id del estado usuario
                document.querySelector('#txtNombreEstado').value = objData.data.Nombre_estado; //trae el nombre del estado usuario
                document.querySelector('#txtFechaCreacion').value = objData.data.Fecha_Creacion; //trae la fecha del estado usuario
               
                
                $('#ModalEstado_usuarios').modal('show');
            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
}


//ELIMINAR EL Estado Usuario
function fntDelInfo(idestado_usuario){
    swal({
        title: "Eliminar estado del usuario",
        text: "¿Realmente quiere eliminar el Estado del usuario?",
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
            let ajaxUrl = base_url+'/Estado_usuarios/delEstado_usuario';
            let strData = "idEstado_usuario="+idestado_usuario;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableEstado_usuarios.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}


function fntPDF() {                // se edito las lineas 150,157,161,162 y 163
 
    let  buscador = $('.dataTables_filter input').val();
     var win = window.open( base_url + '/Estado_usuarios/getEstado_usuarioR/'+buscador, '_blank');
     win.focus();
}

function openModal() 
{
    rowTable = "";
    document.querySelector('#idEstado_usuario').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Estado usuarios";//titulo del modal
    document.querySelector("#formEstado_usuarios").reset();
    $('#ModalEstado_usuarios').modal('show'); //mostrar el  modal
}