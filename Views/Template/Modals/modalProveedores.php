<!-- Modal --> 
<div class="modal fade" id="ModalProveedores" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
            <form id="formProveedores" name="formProveedores" class="form-horizontal">
            <input type="hidden" id="idProveedor" name="idProveedor" value="">

                  <p class="text-primary" id="letra">Todos los campos son obligatorios.</p> <br>

                  <div class="form-row">

                    <div class="form-group col-md-6">
                      <label for="txtNombreParametro" id="letra">Nombre</label>
                      <input type="text" onkeyup="mayus(this)" class="form-control valid validText" id="txtNombreProveedor" name="txtNombreProveedor"  oninput="validateNombreProveedores(this)">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="txtRTNProveedor" id="letra">RTN Proveedor</label>
                      <input type="text" onkeyup="mayus(this)" class="form-control valid validText" id="txtRTNProveedor" name="txtRTNProveedor"  required="">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="txtTelefonoProveedor" id="letra">Telefono</label>
                      <input type="text" class="form-control valid validNumber" id="txtTelefonoProveedor" name="txtTelefonoProveedor" onkeypress="return solonumero(event);" maxlength="8" required="">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="txtCorreoProveedor" id="letra">Correo Proveedor</label>
                      <input type="text" maxlength="30"  class="form-control valid validText" id="txtCorreoProveedor" name="txtCorreoProveedor"  required="" oninput="validateEmail(this)">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="txtDireccionProveedor" id="letra">Direccion Proveedor</label>
                      <input type="text" oninput="mayusYValidar(this)" class="form-control valid validText" id="txtDireccionProveedor" name="txtDireccionProveedor" maxlength="100" required="">
                      
                    </div>
                  </div>

                  <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-primary" type="submit"><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" id="boton" type="button" data-dismiss="modal">Cerrar</button>
                  </div>
                </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<!--Validaciones de solo letras mayusculas-->
<script type="text/javascript">
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }

  function validateNombreProveedores(input) {
    var value = input.value;
    var validChars = /^[a-zA-Z.]+$/;

    if (!validChars.test(value)) {
    input.value = value.slice(0, -1);
    }

    if (value.length > 30) {
    input.value = value.slice(0, 30);
    }
   }

  function validateEmail(input) {
  var value = input.value;
  var validChars = /^[a-zA-Z0-9@._-]+$/;

  if (!validChars.test(value)) {
    input.value = value.slice(0, -1);
  }

  if (value.length > 30) {
    input.value = value.slice(0, 30);
  }
 }

 // Obtén el elemento del input
const inputDireccion = document.getElementById('txtDireccionProveedor');

// Agrega un event listener para el evento de entrada de texto
inputDireccion.addEventListener('input', function() {
  // Obtén el valor actual del input
  let direccion = inputDireccion.value;

  // Remueve los caracteres no permitidos y convierte el texto a mayúsculas
  direccion = direccion.replace(/[^0-9A-Z,.\s]/g, '').toUpperCase();

  // Actualiza el valor del input con el texto modificado
  inputDireccion.value = direccion;
});

function solonumero(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla == 8) return true;
  else if (tecla == 0 || tecla == 9) return true;

  patron = /[0-9\s]/;
  te = String.fromCharCode(tecla);
  let inputValue = e.target.value;

  if (patron.test(te)) {
    // Si el carácter ingresado es válido, verifica si hay 8 ceros seguidos
    if (inputValue.includes('00000000')) {
      e.target.value = ''; // Borra el contenido del input
      return false; // Evita que se ingrese el último cero
    }
    return true;
  } else {
    return false;
  }
}

function mayusYValidar(elemento) {
    mayus(elemento);
    validarEntrada(elemento);
}


function validarEntrada(e) {
    var entrada = e.key;
    var esLetra = (entrada >= 'a' && entrada <= 'z') || (entrada >= 'A' && entrada <= 'Z');
    var esNumero = entrada >= '0' && entrada <= '9';
    var esEspacio = entrada === ' ';

    if (!(esLetra || esNumero || esEspacio)) {
        e.preventDefault();
    }
}

function mayus(elemento) {
    elemento.value = elemento.value.toUpperCase();
}

// Obtener el elemento de entrada
var txtDireccionProveedor = document.getElementById("txtDireccionProveedor");

// Asignar la función al evento oninput
txtDireccionProveedor.addEventListener("input", function (event) {
    mayus(this);
    validarEntrada(event);
});

  
</script>


