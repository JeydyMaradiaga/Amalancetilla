<!-- Modal -->
<div class="modal fade" id="ModalClientes" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formClientes" name="formClientes" class="form-horizontal">

              <input type="hidden" id="idCliente" name="idCliente" value="">

              <p class="text-primary" id="letra">Todos los campos son obligatorios.</p>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtNombre" id="letra">Nombre</label>
                  <input type="text" onkeyup="mayus(this)" class="form-control valid validText" id="txtNombre" name="txtNombre" onkeypress="return SoloLetras(event);" required="" oninput="validarNombre(this)">
                </div>

                <div class="form-group col-md-6">
                  <label for="txtApellido" id="letra">Apellido</label>
                  <input type="text" onkeyup="mayus(this)" class="form-control valid validText" id="txtApellido" name="txtApellido" onkeypress="return SoloLetras(event);" required="">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtEmail" id="letra">Email</label>
                  <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" onkeyUp="this.value=this.value.toLowerCase();" required="" oninput="validateEmail(this)">
                </div>

                <div class="form-group col-md-6">
                  <label for="txtTelefono" id="letra">Teléfono</label>
                  <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono"  onkeypress="return solonumero(event);" maxlength="8" required="">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtDireccion" id="letra">Dirección</label>
                  <input type="text" onkeyup="mayus(this)" class="form-control valid validText" id="txtDireccion" name="txtDireccion" required="">
                </div>

                <div class="form-group col-md-6">
                  <label for="txtIdentidad" id="letra">Número Id</label>
                  <input type="text" onkeyup="mayus(this)" class="form-control valid validText" id="txtIdentidad" name="txtIdentidad" required="">
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
</script>

<!--Validaciones de solo letras-->
<script>
  function SoloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toString();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    especiales = ["8,13,37,39,46"]; //CARACTERES DE LA TABLA ASCII

    tecla_especial = false
    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      //alert("Ingresar solo letras")
      return false;
    }
  }
</script>


<!--Solo numeros-->
<script type="text/javascript">
    function solonumero(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) return true;
    else if (tecla == 0 || tecla == 9) return true;
    // patron =/[0-9\s]/;// -> solo letras
    patron = /[0-9\s]/; // -> solo numeros
    te = String.fromCharCode(tecla);
    return patron.test(te);
    } 



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

function validarNombre(input) {
  // Obtener el valor actual del campo de texto
  var nombre = input.value;

  // Eliminar caracteres no permitidos (todo lo que no sea una letra)
  nombre = nombre.replace(/[^a-zA-Z]/g, '');

  // Limitar la longitud del nombre a un máximo de 40 caracteres
  nombre = nombre.slice(0, 40);

  // Actualizar el valor del campo de texto con el nombre válido
  input.value = nombre;
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

</script>




<?php footerAdmin($data); ?>
