let tableProveedores;
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){
    tableProveedores = $('#tableProveedores').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Proveedores/getProveedores", 
            "dataSrc":""
        },
        "columns":[
            {"data":"Id_Proveedor","visible": false},
            {"data":"Nombre_Proveedor"},
            {"data":"RTN_Proveedor"},
            {"data":"Telefono_Proveedor"},
            {"data":"Correo_Proveedor"},
            {"data":"Direccion_Proveedor"},
            {"data":"options"}
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    // Codigo de validacion de Modal NUEVO parametro

    var formParametros = document.querySelector('#formProveedores');// aqui form Proveedores
    formParametros.onsubmit = function (e) {
        e.preventDefault();

    
        var strNombreProveedor = document.querySelector('#txtNombreProveedor').value; //capturar el valor de Nombre
        var strRTNProveedor = document.querySelector('#txtRTNProveedor').value; //capturar el valor de Nombre
        var strTelefonoProveedor = document.querySelector('#txtTelefonoProveedor').value;
        var strCorreoProveedor = document.querySelector('#txtCorreoProveedor').value;
        var strDireccionProveedor = document.querySelector('#txtDireccionProveedor').value;

    
        //validacion que los datos esten llenos
        if (strNombreProveedor == '' || strRTNProveedor == '' || strTelefonoProveedor == '' || strCorreoProveedor == '' || strDireccionProveedor == '') {
            swal("Atencion", "Todos los campos son obligatorio.", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Proveedores/setProveedor'; //URL para acceder al metodo
        var formData = new FormData(formParametros);
        request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#ModalProveedores').modal("hide");
                    formParametros.reset();
                    swal("Proveedores", objData.msg, "success");
                    tableProveedores.api().ajax.reload();
                    
                } else {
                    swal("Error", objData.msg, "error");
                }
            } else {
                console.log("Error");
            }

        }

    }

}, false);

function fntEditInfo(element,Id_Proveedor) {
    
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Proveedor";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Proveedores/getProveedor/'+Id_Proveedor;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
               
                document.querySelector('#idProveedor').value = objData.data.Id_Proveedor; //trae el ID de Proveedor
                document.querySelector('#txtNombreProveedor').value = objData.data.Nombre_Proveedor; //trae el nombre del Proveedor
                document.querySelector('#txtRTNProveedor').value = objData.data.RTN_Proveedor; //trae el porcentaje del Proveedor
                document.querySelector('#txtTelefonoProveedor').value = objData.data.Telefono_Proveedor;
                document.querySelector('#txtCorreoProveedor').value = objData.data.Correo_Proveedor;
                document.querySelector('#txtDireccionProveedor').value = objData.data.Direccion_Proveedor;
                
               
                
                $('#ModalProveedores').modal('show');
            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
}

//ELIMINAR EL Estado Proveedor
function fntDelInfo(Id_Proveedor){
    swal({
        title: "Eliminar proveedor",
        text: "¿Realmente quiere eliminar el proveedor?",
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
            let ajaxUrl = base_url+'/Proveedores/delProveedor';
            let strData = "idProveedor="+Id_Proveedor;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableProveedores.api().ajax.reload();
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
     var win = window.open( base_url + '/Proveedores/getProveedorR/'+buscador, '_blank');
     win.focus();
}

function openModal() 
{
    rowTable = "";
    document.querySelector('#idProveedor').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Proveedor";//titulo del modal
    document.querySelector("#formProveedores").reset();
    $('#ModalProveedores').modal('show'); //mostrar el  modal
}
