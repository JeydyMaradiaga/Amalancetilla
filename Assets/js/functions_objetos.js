var tableObjetos;


document.addEventListener('DOMContentLoaded', function () {

    tableObjetos = $('#tableObjetos').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Objetos/getObjetos",//llamado del get
            "dataSrc": ""
        },
        "columns": [
            { "data": "Id_Objeto" },
            { "data": "Nombre_Objeto" },
            { "data": "Descripcion" },
            { "data": "Creado_Por" },
            { "data": "Fecha_Creacion" },

            { "data": "options" }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

});
// Codigo de validacion de Modal NUEVO objeto

var formParametros = document.querySelector('#formObjetos');
formParametros.onsubmit = function (e) {
    e.preventDefault();

   
    var strNombre = document.querySelector('#txtNombreParametro').value; //capturar el valor de Nombre
   
   
    var strValor = document.querySelector('#txtDescripcion').value;  //capturar el valor de telefono
    var strFechaCreacion = document.querySelector('#txtCreacionParametro').value; //capturar el valor de direccion
    
    //validacion que los datos esten llenos
    if (strNombre == '' || strValor == '' || strFechaCreacion == '' ) {
        swal("Atencion", "Todos los campos son obligatorio.", "error");
        return false;
    }


    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Objetos/setObjeto'; //URL para acceder al metodo
    var formData = new FormData(formParametros);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                $('#ModalObjetos').modal("hide");
                formParametros.reset();
                swal("Objetos", objData.msg, "success");
                tableObjetos.api().ajax.reload();
                
            } else {
                swal("Error", objData.msg, "error");
            }
        } else {
            console.log("Error");
        }
    }

}//aqui 


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
function fntEditParametro(idparametro) { //objetos
    
    var idparametro = idparametro;
    document.querySelector('#titleModal2').innerHTML = "Actualizar Objeto";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnTextM').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Objetos/getObjetosM/' + idparametro;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
               
               document.querySelector('#idObjeto').value = objData.data.Id_Objeto; //trae el nombre del usuario
                document.querySelector('#txtNombreParametro').value = objData.data.Nombre_Objeto; //trae el nombre del usuario
              
                document.querySelector('#txtCreacionParametro').value = objData.data.Fecha_Creacion; //trae el telefono del usuario
                document.querySelector('#txtDescripcion').value = objData.data.Descripcion; //trae el telefono del usuario
                //document.querySelector("#txtTelefono").value = objData.data.telefono;

                $('#ModalObjetos').modal('show');
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


//ELIMINAR EL objeto
function fntDelParametro(idparametro){
    swal({
        title: "Eliminar Objeto",
        text: "¿Realmente quiere eliminar el Objeto?",
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
            let ajaxUrl = base_url+'/Objetos/delObjeto';
            let strData = "idObjeto="+idparametro;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableObjetos.api().ajax.reload(function(){
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
    document.querySelector('#titleModal').innerHTML = "Nuevo Objeto";//titulo del modal
    document.querySelector("#formObjetos").reset();
    $('#ModalObjetos').modal('show'); //mostrar el  modal
}



