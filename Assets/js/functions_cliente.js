let tableClientes;
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){
    tableClientes = $('#tableClientes').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Clientes/getClientes", 
            "dataSrc":""
        },
        "columns":[
            { "data": "Id_Cliente","visible": false },
            { "data": "Nombre" },
            { "data": "Apellidos" },
            { "data": "Correo_Cliente" },
            { "data": "Telefono" },
            { "data": "Direccion" },
            { "data": "Numero_ID" },
            { "data":"options"}
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

 // Codigo de validacion de Modal NUEVO parametro

    var formParametros = document.querySelector('#formClientes');// aqui form Movimientos
    formParametros.onsubmit = function (e) {
        e.preventDefault();

        var strNombre = document.querySelector('#txtNombre').value; //capturar el valor de Nombre
        var strApellido = document.querySelector('#txtApellido').value;
        var strEmail = document.querySelector('#txtEmail').value; //capturar el valor de email
        var strTelefono = document.querySelector('#txtTelefono').value;  //capturar el valor de telefono
        var strDireccion = document.querySelector('#txtDireccion').value; //capturar el valor de direccion
        var strIdentidad = document.querySelector('#txtIdentidad').value;
       
        //validacion que los datos esten llenos
        if (strNombre == '' || strApellido== ''||  strIdentidad  ==  ''|| strTelefono == ''||strDireccion == '' ||  strEmail == '' ) {
            swal("Atencion", "Todos los campos son obligatorio.", "error");
            return false;
        }


        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Clientes/setCliente'; //URL para acceder al metodo
        var formData = new FormData(formParametros);
        request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#ModalClientes').modal("hide");
                    formParametros.reset();
                    swal("Clientes", objData.msg, "success");
                    tableClientes.api().ajax.reload();
                    
                } else {
                    swal("Error", objData.msg, "error");
                }
            } else {
                console.log("Error");
            }

        }

    }


}, false);

function fntEditInfo(element,idcliente) {
    
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Cliente";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Clientes/getCliente/'+idcliente;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {

                document.querySelector('#idCliente').value = objData.data.Id_Cliente; //trae el nombre del usuario
                document.querySelector('#txtNombre').value = objData.data.Nombre; //trae el nombre del usuario
                document.querySelector('#txtApellido').value = objData.data.Apellidos;
                document.querySelector('#txtEmail').value = objData.data.Correo_Cliente; //trae el telefono del usuario
                document.querySelector('#txtTelefono').value = objData.data.Telefono; //trae el telefono del usuario
                document.querySelector('#txtDireccion').value = objData.data.Direccion; //trae el telefono del usuario
                document.querySelector('#txtIdentidad').value = objData.data.Numero_ID;

                $('#ModalClientes').modal('show');
            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
}

function fntPDF() {
 
    let  buscador = $('.dataTables_filter input').val();
     var win = window.open( base_url + '/Clientes/getClienteR/'+buscador, '_blank');
     win.focus();
}
function fntDelInfo(idcliente){
    swal({
        title: "Eliminar cliente",
        text: "¿Realmente quiere el cliente?",
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
            let ajaxUrl = base_url+'/Clientes/delCliente';
            let strData = "idCliente="+idcliente;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableClientes.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}


function openModal() 
{
    rowTable = "";
    document.querySelector('#idCliente').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";//titulo del modal
    document.querySelector("#formClientes").reset();
    $('#ModalClientes').modal('show'); //mostrar el  modal
}