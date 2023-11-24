let tableForma;
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){
    tableForma = $('#tableForma').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Forma/getForma", 
            "dataSrc":""
        },
        "columns":[
            {"data":"Id_Forma_Pago","visible": false},
            {"data":"Nombre"},
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
 
    var formParametros = document.querySelector('#formForma');// aqui form resytadp pedido
    formParametros.onsubmit = function (e) {
        e.preventDefault();
    
        
        var strNombre = document.querySelector('#txtNombre').value; //capturar el valor de Nombre
        var Descripcion = document.querySelector('#txtDescripcion').value; //capturar el valor de la descripcion
        //validacion que los datos esten llenos
        if (strNombre == '' || Descripcion == '') {
            swal("Atencion", "Todos los campos son obligatorio.", "error");
            return false;
        }


    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Forma/setForm'; //URL para acceder al metodo, se edito esta parte
    var formData = new FormData(formParametros);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {                                  // lineas 55, 57 y 58 se editaron.
                $('#ModalForma').modal("hide");
                formParametros.reset();
                swal("forma", objData.msg, "success");
                tableForma.api().ajax.reload();
                
            } else {
                swal("Error", objData.msg, "error");
            }
        } else {
            console.log("Error");
        }

    }

}


function fntEditInfo(element,idforma) {             // se edito las lineas 72, 75 y 81
    
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Forma";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Forma/getForm/'+idforma;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                
                document.querySelector('#idForma').value = objData.data.Id_Forma_Pago //trae el id del estado usuario
                document.querySelector('#txtNombre').value = objData.data.Nombre; //trae el nombre del estado usuario
                document.querySelector('#txtDescripcion').value = objData.data.Descripcion; //trae la fecha del estado usuario
               
                
                $('#ModalForma').modal('show');
            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
}


//ELIMINAR EL Estado Usuario
function fntDelInfo(idforma){
    swal({
        title: "Eliminar Forma de pago",
        text: "¿Realmente quiere eliminar la Forma de pago",
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
            let ajaxUrl = base_url+'/Forma/delForm';
            let strData = "idForma="+idforma;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableForma.api().ajax.reload();
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
     var win = window.open( base_url + '/Forma/getFormaR/'+buscador, '_blank');
     win.focus();
}

function openModal() 
{
    rowTable = "";
    document.querySelector('#idForma').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Forma de pago";//titulo del modal
    document.querySelector("#formForma").reset();
    $('#ModalForma').modal('show'); //mostrar el  modal
}