var tableParametros;

document.addEventListener('DOMContentLoaded', function () {

    tableParametros = $('#tableParametros').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Parametros/getParametros",//llamado del get
            "dataSrc": ""
        },
        "columns": [
            { "data": "Id_Parametro" },
            { "data": "Nombre_Parametro" },
       
            { "data": "Valor_Parametro" },
            { "data": "Descripcion" },
            { "data": "Creado_Por" },
            { "data": "Fecha_Creacion" },
            { "data": "Modificado_Por" },
            { "data": "Fecha_Modificado" },
            { "data": "options" }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

});
// Codigo de validacion de Modal NUEVO parametro

var formParametros = document.querySelector('#formParametros');
formParametros.onsubmit = function (e) {
    e.preventDefault();

   
    var strNombre = document.querySelector('#txtNombreParametro').value; //capturar el valor de Nombre
   
   
    var strValor = document.querySelector('#txtValorParametro').value;  //capturar el valor de telefono
    var strFechaCreacion = document.querySelector('#txtCreacionParametro').value; //capturar el valor de direccion
    
    //validacion que los datos esten llenos
    if (strNombre == '' || strValor == '' || strFechaCreacion == '' ) {
        swal("Atencion", "Todos los campos son obligatorio.", "error");
        return false;
    }


    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Parametros/setParametro'; //URL para acceder al metodo
    var formData = new FormData(formParametros);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                $('#ModalParametros').modal("hide");
                formParametros.reset();
                swal("Parametros", objData.msg, "success");
                tableParametros.api().ajax.reload();
                
            } else {
                swal("Error", objData.msg, "error");
            }
        } else {
            console.log("Error");
        }

    }

}

var formActualizarParametro = document.querySelector('#FormActualizarParametro');
formActualizarParametro.onsubmit = function (e) {
    e.preventDefault();
    var strNombre = document.querySelector('#txtNombreM').value; //capturar el valor de Nombre
   
   
    var strValor = document.querySelector('#txtValorM').value;  //capturar el valor de telefono
    var strFechaCreacion = document.querySelector('#txtModParametro').value; //capturar el valor de direccion
    
    
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Parametros/UpdateParametros'; //URL para acceder al metodo
    var formData = new FormData(formActualizarParametro);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                $('#modalFormActualizarParametro').modal("hide");
                formActualizarParametro.reset();
                swal("Parametros", objData.msg, "success");
                tableParametros.api().ajax.reload();
            } else {
                swal("Error", objData.msg, "error");
            }
        } else {
            console.log("Error");
        }

    }

}
//


// Final del codigo de validacion de Modal NUEVO USUARIO

//codigo para el  combobox del rol
//window.addEventListener('load', function () {
//    fntFecha();
//}, false);

//creacion de una funcion(peticion al ajax)


//actualizar 
function fntEditParametro(idparametro) {
    
    var idparametro = idparametro;
    document.querySelector('#titleModal2').innerHTML = "Actualizar Parametro";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnTextM').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Parametros/getParametrosM/' + idparametro;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
               
               document.querySelector('#idParametro').value = objData.data.Id_Parametro; //trae el nombre del usuario
                document.querySelector('#txtNombreParametro').value = objData.data.Nombre_Parametro; //trae el nombre del usuario
                document.querySelector('#txtValorParametro').value = objData.data.Valor_Parametro; //trae el telefono del usuario
                document.querySelector('#txtCreacionParametro').value = objData.data.Fecha_Creacion; //trae el telefono del usuario
                document.querySelector('#txtDescripcion').value = objData.data.Descripcion; //trae el telefono del usuario
                //document.querySelector("#txtTelefono").value = objData.data.telefono;

                $('#ModalParametros').modal('show');
            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
}
function fntFecha() {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/getUsuarioF/';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
               
                document.querySelector('#txtFechavencimiento').value = objData.data; //trae la fecha de vencimient

            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
}


//ELIMINAR EL USUARIO
function fntDelParametro(idparametro){
    swal({
        title: "Eliminar Parametro",
        text: "¿Realmente quiere eliminar el Parametro?",
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
            let ajaxUrl = base_url+'/Parametros/delParametro';
            let strData = "idParametro="+idparametro;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableParametros.api().ajax.reload(function(){
                          //  tableParametros.api().ajax.reload();
                
                          
                         
                        });
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

function openModal() {
    rowTable = "";
    //document.querySelector('#txtCreacionParametro').value = '<?php echo(date("Y-m-d")); ?>';
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Parametro";//titulo del modal
    document.querySelector("#formParametros").reset();
    $('#ModalParametros').modal('show'); //mostrar el  modal
}



