let tableEstado_pedidos;
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){
    tableEstado_pedidos = $('#tableEstado_pedidos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Estado_pedidos/getEstado_pedidos", 
            "dataSrc":""
        },
        "columns":[
            {"data":"Id_Estado_Pedido"},
            {"data":"Estado"},
            {"data":"Descripcion"},
            {"data":"options"}
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });


});

// Codigo de validacion de Modal NUEVO parametro 

var formParametros = document.querySelector('#formEstado_pedidos');// aqui form resytadp pedido
formParametros.onsubmit = function (e) {
    e.preventDefault();

   
    var strNombre = document.querySelector('#txtNombreEstado').value; //capturar el valor de Nombre
    var Descripcion = document.querySelector('#txtNombreDescripcion').value; //capturar el valor de la descripcion
    //validacion que los datos esten llenos
    if (strNombre == '' || Descripcion == '') {
        swal("Atencion", "Todos los campos son obligatorio.", "error");
        return false;
    }


    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Estado_pedidos/setEstado_pedido'; //URL para acceder al metodo
    var formData = new FormData(formParametros);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                $('#ModalEstado_pedidos').modal("hide");
                formParametros.reset();
                swal("Estado_pedidos", objData.msg, "success");
                tableEstado_pedidos.api().ajax.reload();
                
            } else {
                swal("Error", objData.msg, "error");
            }
        } else {
            console.log("Error");
        }

    }

}




function fntEditInfo(element,idestado_pedido) {
    
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar estado pedidos";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Estado_pedidos/getEstado_pedido/'+idestado_pedido;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                
                document.querySelector('#idEstado_pedido').value = objData.data.Id_Estado_Pedido //trae el id del estado pedido
                document.querySelector('#txtNombreEstado').value = objData.data.Estado; //trae el nombre del estado pedido
                document.querySelector('#txtNombreDescripcion').value = objData.data.Descripcion; //trae las descripcion del estado pedido
               
                
                $('#ModalEstado_pedidos').modal('show');
            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
}

//ELIMINAR EL Estado pedido
function fntDelInfo(idestado_pedido){
    swal({
        title: "Eliminar estado de pedido",
        text: "¿Realmente quiere eliminar el Estado de pedido?",
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
            let ajaxUrl = base_url+'/Estado_pedidos/delEstado_pedido';
            let strData = "idEstado_pedido="+idestado_pedido;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableEstado_pedidos.api().ajax.reload();
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
     var win = window.open( base_url + '/Estado_pedidos/getEstado_pedidoR/'+buscador, '_blank');
     win.focus();
}

function openModal() 
{
    rowTable = "";
    document.querySelector('#idEstado_pedido').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Estado pedidos";//titulo del modal
    document.querySelector("#formEstado_pedidos").reset();
    $('#ModalEstado_pedidos').modal('show'); //mostrar el  modal
}
    