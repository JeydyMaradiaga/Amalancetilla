window.addEventListener('load', function () {
    initEvents();//aquiii

}, false);
var variableG;

function validarRequisitosContrasena(contrasena) {
    const tieneCaracterEspecial = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(contrasena);
    const tieneMinuscula = /[a-z]/.test(contrasena);
    const tieneLongitudSuficiente = contrasena.length >= 8;

    return tieneCaracterEspecial && tieneMinuscula && tieneLongitudSuficiente;
}

var formregistroUsuario = document.querySelector('#formregistroUsuario');
formregistroUsuario.onsubmit = function (e) {
    e.preventDefault();

    var strNombre = document.querySelector('#txtNombre').value; //capturar el valor de Nombre
    var strEmail = document.querySelector('#txtEmail').value; //capturar el valor de email
    var strContrasena = document.querySelector('#txtcontrasena').value; //capturar el valor de contraseña
    var strContrasenaM = document.querySelector('#txtcontrasenaM').value; //capturar el valor de contraseña
    var strTelefono = document.querySelector('#txtTelefono').value;  //capturar el valor de telefono
    var strDireccion = document.querySelector('#txtDireccion').value; //capturar el valor de direccion
  

    //validacion que los datos esten llenos
    if ( strNombre == '' ||  strEmail == '' ||  strContrasena == '' ||  strContrasenaM == '' || strTelefono == '' || strDireccion == '' ) {
        swal("Atencion", "Todos los campos son obligatorio.", "error");
        return false;
    }

    if(strContrasena !=  strContrasenaM){
        swal("Atencion", "Las contraseñas no son iguales", "error");
        return false;
    }

    if (!validarRequisitosContrasena(strContrasena)) {
        swal("Atencion", "La contraseña debe contener al menos 1 carácter especial, 1 minúscula y tener una longitud mínima de 8 caracteres.", "error");
        return false;
    }

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Registro_usuario/setRegistroUsuario'; //URL para acceder al metodo
    var formData = new FormData(formregistroUsuario);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
               
                formregistroUsuario.reset();
                swal("Usuarios", objData.msg, "success");
               
            } else {
                swal("Error", objData.msg, "error");
            }
        } else {
            console.log("Error");
        }

    }

}

//clave
function initEvents(){
    if(document.getElementById("txtcontrasena")){
        document.getElementById("txtcontrasena").addEventListener("keyup",function () {
            checkPassword();
          })
          
    }
    if(document.getElementById("txtcontrasenaM")){
        document.getElementById("txtcontrasenaM").addEventListener("keyup",function () {
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