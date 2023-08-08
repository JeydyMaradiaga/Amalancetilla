let tableImpuestos;
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){
    tableImpuestos = $('#tableImpuestos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Impuestos/getImpuestos", 
            "dataSrc":""
        },
        "columns":[
            {"data":"Id_ISV"},
            {"data":"Nombre_ISV"},
            {"data":"Porcentaje_ISV"},
            {"data":"options"}
        ],

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });



    // Codigo de validacion de Modal NUEVO parametro

    var formParametros = document.querySelector('#formImpuestos');// aqui form Impuestos
    formParametros.onsubmit = function (e) {
        e.preventDefault();

    
        var strNombre = document.querySelector('#txtNombreISV').value; //capturar el valor de Nombre
        var strPorcentajeISV = document.querySelector('#txtPorcentajeISV').value; //capturar el valor de Nombre
    
        //validacion que los datos esten llenos
        if (strNombre == '' || strPorcentajeISV == '') {
            swal("Atencion", "Todos los campos son obligatorio.", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Impuestos/setImpuesto'; //URL para acceder al metodo
        var formData = new FormData(formParametros);
        request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#ModalImpuestos').modal("hide");
                    formParametros.reset();
                    swal("Impuestos", objData.msg, "success");
                    tableImpuestos.api().ajax.reload();
                    
                } else {
                    swal("Error", objData.msg, "error");
                }
            } else {
                console.log("Error");
            }

        }

    }

}, false);

function fntEditInfo(element,Id_ISV) {
    
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Impuesto";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Impuestos/getImpuesto/'+Id_ISV;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
               
                document.querySelector('#Id_ISV').value = objData.data.Id_ISV; //trae el ID de impuesto
                document.querySelector('#txtNombreISV').value = objData.data.Nombre_ISV; //trae el nombre del impuesto
                document.querySelector('#txtPorcentajeISV').value = objData.data.Porcentaje_ISV; //trae el porcentaje del impuesto
                
               
                
                $('#ModalImpuestos').modal('show');
            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
}

//ELIMINAR EL Estado impuesto
function fntDelInfo(Id_ISV){
    swal({
        title: "Eliminar impuesto",
        text: "¿Realmente quiere eliminar el impuesto?",
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
            let ajaxUrl = base_url+'/Impuestos/delImpuesto';
            let strData = "Id_ISV="+Id_ISV;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableImpuestos.api().ajax.reload();
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
     var win = window.open( base_url + '/Impuestos/getImpuestoR/'+buscador, '_blank');
     win.focus();
}

function openModal() 
{
    rowTable = "";
    document.querySelector('#Id_ISV').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Impuesto";//titulo del modal
    document.querySelector("#formImpuestos").reset();
    $('#ModalImpuestos').modal('show'); //mostrar el  modal
}
