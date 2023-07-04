<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister bg-primary text-white">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUsuario" name="formUsuario" class="form-horizontal">
                    <input type="hidden" id="idUsuario" name="idUsuario" value="">
                    <p class="text-primary" id="letra">Todos los campos son obligatorios.</p> <br>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listRolid" id="letra">Rol Usuario</label>
                            <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtNombre" id="letra">Nombre</label>
                            <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" onkeyup="mayus(this)" onkeypress="return SoloLetras(event);" required="" oninput="validarNombre(this)">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtcontrasena" id="letra">Contraseña</label>
                            <input type="password" class="form-control valid validText" id="txtcontrasena" name="txtcontrasena" oninput="validatePasswordLength(this)">
                            <div class="invalid-feedback">
                                La contraseña debe tener un mínimo de 8 caracteres y contener al menos una mayúscula, un número y un carácter especial (@$!%*?&).
                            </div>
                            <br>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="show_password" oninput="validatePasswordLength(this)">
                                <label class="form-check-label" for="show_password">Mostrar contraseña</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtcontrasena" id="letra">Confirmar Contraseña</label>
                            <input type="password" class="form-control valid validText" id="txtcontrasenaC" name="txtcontrasenaC">
                            <div class="invalid-feedback">
                                Las contraseñas no coinciden
                            </div>
                            <br>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="txtTelefono" id="letra">Teléfono</label>
                            <!--onkeypress="return controlTag(event);"-->
                            <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" onkeypress="return solonumero(event);" maxlength="8" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtDireccion" id="letra">Dirección</label>
                            <input type="text" class="form-control valid validText" id="txtDireccion" name="txtDireccion" maxlength="100" required="" oninput="validarDireccion(this)">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="txtEmail" id="letra">Email</label>
                            <input id="txtEmail" class="form-control" type="email" name="txtEmail" placeholder="" autofocus="" oninput="validateEmail(this)">
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="txtEstado" id="letra">Estado</label>
                            <input type="text" class="form-control valid validNumber" id="txtEstado" name="txtEstado" value="NUEVO" readonly>

                            <br><br>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtFechavencimiento" id="letra">Fecha de vencimiento</label>
                            <input type="date" class="form-control valid validFechavencimiento" id="txtFechavencimiento" name="txtFechavencimiento" readonly required="">
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



<!--MOSTRAR CONTRASEÑA-->
<script>
    const showPasswordCheckbox = document.getElementById('show_password');
    const passwordInput = document.getElementById('txtcontrasena');
    const passwordInputs = document.getElementById('txtcontrasenaC');

    showPasswordCheckbox.addEventListener('change', function() {
        if (showPasswordCheckbox.checked) {
            passwordInput.type = 'text';
            passwordInputs.type = 'text';
        } else {
            passwordInput.type = 'password';
            passwordInputs.type = 'password';
        }
    });

    passwordInput.addEventListener('input', function() {
        const password = passwordInput.value;
        const regex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (regex.test(password)) {
            passwordInput.classList.remove('is-invalid');
            passwordInputs.disabled = false;
        } else {
            passwordInput.classList.add('is-invalid');
            passwordInputs.disabled = true;
        }
    });

    passwordInputs.addEventListener('input', function() {
        const password = passwordInput.value;
        const confirmPassword = passwordInputs.value;
        const regex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (password === confirmPassword && regex.test(password)) {
            passwordInput.classList.add('is-valid');
            passwordInputs.classList.add('is-valid');
        } else {
            passwordInput.classList.remove('is-valid');
            passwordInputs.classList.remove('is-valid');
        }
    });
</script>

<script type="text/javascript">
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>

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
</script>

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

function validatePasswordLength(input) {
  var value = input.value;

  if (value.length > 50) {
    input.value = value.slice(0, 50);
  }
}

function validarDireccion(input) {
  const regex = /^[a-zA-Z0-9.,\s]+$/;
  const valor = input.value;
  
  if (!regex.test(valor)) {
    input.setCustomValidity("La dirección solo puede contener letras, números, punto y coma.");
  } else if (valor.length > 100) {
    input.setCustomValidity("La dirección no puede tener más de 100 caracteres.");
  } else {
    input.setCustomValidity("");
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
</script>