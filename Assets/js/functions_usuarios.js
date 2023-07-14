var tableUsuarios;

document.addEventListener('DOMContentLoaded', function () {

    tableUsuarios = $('#tableUsuarios').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/usuarios/getUsuario",//llamado del get
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_usuario" },
          
            { "data": "Nombre_Rol" },
            //verificar si falta el nombre del rol
            { "data": "Nombre" },
            { "data": "Telefono" },
            { "data": "Direccion" },
        
            { "data": "Correo_Electronico" },
            { "data": "id_estado_usuario" },
            { "data": "Fecha_Ult_Conexion" },
            { "data": "Fecha_Vencimiento" },
            { "data": "opciones" }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

});
// Codigo de validacion de Modal NUEVO USUARIO

var formUsuario = document.querySelector('#formUsuario');
formUsuario.onsubmit = function (e) {
    e.preventDefault();

    var strRol = document.querySelector('#listRolid').value; //capturar el valor de Rol
    var strNombre = document.querySelector('#txtNombre').value; //capturar el valor de Nombre
    var strContrasena = document.querySelector('#txtcontrasena').value; //capturar el valor de contraseña
    var strContrasenac = document.querySelector('#txtcontrasenaC').value; //capturar el valor de contraseña
    var strTelefono = document.querySelector('#txtTelefono').value;  //capturar el valor de telefono
    var strDireccion = document.querySelector('#txtDireccion').value; //capturar el valor de direccion
    
    var strEmail = document.querySelector('#txtEmail').value; //capturar el valor de email
    var strEstado = document.querySelector('#txtestado').value; //capturar el valor de estado usuario
  

    //validacion que los datos esten llenos
    if (strRol == '' || strNombre == '' || strTelefono == '' || strDireccion == '' ||  strEmail == '' || strEstado == '' || strContrasena == '' || strContrasenac == '') {
        swal("Atencion", "Todos los campos son obligatorio.", "error");
        return false;
    }

    if(strContrasena !=  strContrasenac){
        swal("Atencion", "Las contraseñas no son iguales", "error");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/setUsuario'; //URL para acceder al metodo
    var formData = new FormData(formUsuario);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                $('#modalFormUsuario').modal("hide");
                formUsuario.reset();
                swal("Usuarios", objData.msg, "success");
                tableUsuarios.api().ajax.reload();
                
            } else {
                swal("Error", objData.msg, "error");
            }
        } else {
            console.log("Error");
        }

    }

}

var formActualizarUsuario = document.querySelector('#formActualizarUsuario');
formActualizarUsuario.onsubmit = function (e) {
    e.preventDefault();
    fntRolesUsuario();

    var strRol = document.querySelector('#listRolid2').value; //capturar el valor de Rol
    var strNombre = document.querySelector('#txtNombreM').value; //capturar el valor de Nombre
    var strContrasena = document.querySelector('#txtcontrasenaM').value; //capturar el valor de contraseña
    var strTelefono = document.querySelector('#txtTelefonoM').value;  //capturar el valor de telefono
    var strDireccion = document.querySelector('#txtDireccionM').value; //capturar el valor de direccion

    var strEmail = document.querySelector('#txtEmailM').value; //capturar el valor de email
    var strEstado = document.querySelector('#listStatus2').value; //capturar el valor de estado usuario
    //var strFechavencimiento = document.querySelector('#txtFechavencimiento').value; //capturar la fecha de vencimiento

    
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/UpdateUsuario'; //URL para acceder al metodo
    var formData = new FormData(formActualizarUsuario);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                $('#modalFormUsuarioActualizar').modal("hide");
                formActualizarUsuario.reset();
                swal("Usuarios", objData.msg, "success");
                tableUsuarios.api().ajax.reload();
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
window.addEventListener('load', function () {
    fntRolesUsuario(); //ejecutar la funcion creada
    fntEstadosUsuario();
    initEvents();//aquiii
    fntFecha();
    //fntEditUsuario();
    //fntEditUsuario12();

}, false);

//creacion de una funcion(peticion al ajax)
function fntRolesUsuario() {
    if (document.querySelector('#listRolid') ||  document.querySelector('#listRolid2')) {
        let ajaxUrl = base_url + '/Usuarios/getSelectRoles';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); //creacion del objeto dependiendo el navegador
        request.open("GET", ajaxUrl, true);//abrimos la petecion por medio del Metodo GET
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listRolid').innerHTML = request.responseText;
                $('#listRolid');
                document.querySelector('#listRolid2').innerHTML = request.responseText;
                $('#listRolid2');
            }
        }
    }
}
function fntPDF() {
 
    let  buscador = $('.dataTables_filter input').val();
     var win = window.open( base_url + '/Usuarios/getUsuarioR/'+buscador, '_blank');
     win.focus();
}

function fntEstadosUsuario() {
    if (document.querySelector('#listStatus') ||  document.querySelector('#listStatus2')) {
        let ajaxUrl = base_url + '/Usuarios/getSelectEstados';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); //creacion del objeto dependiendo el navegador
        request.open("GET", ajaxUrl, true);//abrimos la petecion por medio del Metodo GET
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                //document.querySelector('#listStatus').innerHTML = request.responseText;
             //   $('#listStatus');
                document.querySelector('#listStatus2').innerHTML = request.responseText;
                $('#listStatus2');
            }
        }
    }
}

//actualizar 
function fntEditUsuario12(idpersona) {
    
    var idpersona = idpersona;
    document.querySelector('#titleModal2').innerHTML = "Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnTextM').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/getUsuarioM/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
               
                document.querySelector('#idUsuarioM').value = objData.data.id_usuario; //trae el nombre del usuario
                document.querySelector('#txtNombreM').value = objData.data.Nombre; //trae el nombre del usuario
                document.querySelector('#txtTelefonoM').value = objData.data.Telefono; //trae el telefono del usuario
                document.querySelector('#txtDireccionM').value = objData.data.Direccion; //trae el telefono del usuario
                //document.querySelector('#txtidentidadM').value = objData.data.Num_Identidad; //trae el telefono del usuario
                document.querySelector('#txtEmailM').value = objData.data.Correo_Electronico; //trae el telefono del usuario
                document.querySelector('#txtFechavencimientoM').value = objData.data.Fecha_Vencimiento; //trae la fecha de vencimient
                document.querySelector('#listStatus2').value =  objData.data.id_estado_usuario;
                $('#listStatus2');
                document.querySelector('#listRolid2').value =  objData.data.Id_Rol;
                $('#listRolid2');
             
                //document.querySelector("#txtTelefono").value = objData.data.telefono;

                $('#modalFormUsuarioActualizar').modal('show');
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
function fntDelUsuario(idpersona){
    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
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
            let ajaxUrl = base_url+'/Usuarios/delUsuario';
            let strData = "idUsuario="+idpersona;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableUsuarios.api().ajax.reload(function(){
                           // tableUsuarios.api().ajax.reload(); para actualizar la pagina cuando se elimine
                
                            fntRolesUsuario();
                            fntViewUusuario();
                            fntEditUsuario12();
                            fntDelUsuario();
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
    document.querySelector('#idUsuario').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";//titulo del modal
    document.querySelector("#formUsuario").reset();
    $('#modalFormUsuario').modal('show'); //mostrar el  modal
}

function openModalPerfil() {
    $('#modalFormPerfil').modal('show');
}
function initEvents(){
    if(document.getElementById("txtcontrasena")){
        document.getElementById("txtcontrasena").addEventListener("keyup",function () {
            checkPassword();
          })
          
    }
    if(document.getElementById("txtcontrasenaC")){
        document.getElementById("txtcontrasenaC").addEventListener("keyup",function () {
            checkPassword();
          })
          
    }

}



function checkPassword(){

    let value = document.getElementById("txtcontrasena").value;
   
    let regex = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,15}$/);



    if(regex.test(value)){
        document.getElementById("txtcontrasena").setAttribute("class","form-control is-valid");
        variableG = true;
    }else{
        document.getElementById("txtcontrasena").setAttribute("class","form-control is-invalid");
        variableG = false;
       
    
    }
       

   }




// final del codigo del combobox del rol

