<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="UNAH">
  <meta name="theme-color" content="#009688">
  <link rel="shortcut icon" href="<?= media(); ?>/images/favicon.ico">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">

  <title><?= $data['page_tag']; ?></title>
</head>


<body>
  <section class="material-half-bg">
    <div class="cover"></div>
  </section>
  <section id="formregistroUsuariox" name="formregistroUsuariox" class="login-content contact-box">
    <div class="logo">

    </div>
    <div class="login-box ru" style="min-height: 570px;" >
      <div id="divLoading">
        <div>
          <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
        </div>
      </div>
      <form class="login-form" id="formregistroUsuario" name="formregistroUsuario" action="">
    
      
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>CREAR CUENTA</h3>
        <div class="form-group">

          <p class="text"></p>

          

            <div class="form-row mb-2">

              <div class="form-group col-md-6">
                <label for="txtNombre" id="letra">Nombre</label>
                <input type="text" placeholder="Ingresa tu nombre " class="form-control valid validText" id="txtNombre" name="txtNombre" onkeyup="mayus(this)" onkeypress="return SoloLetras(event);" required="" oninput="validarNombre(this)">
              </div>
              <div class="form-group col-md-6">
                <label for="txtEmail" id="letra">Correo Electrónico</label>
                <input type="email" placeholder="Ingresa tu correo electrónico " class="form-control valid validEmail" id="txtEmail" name="txtEmail" onkeyUp="this.value=this.value.toLowerCase();" required="" oninput="validateEmail(this)">
              </div>
            </div>

            <div class="form-group mb-3">
              <div class="form-row">


                <div class="form-group col-md-6">
                  <label for="txtcontrasena" id="letra">Contraseña</label>
                  <input type="password" placeholder="Ingresa tu contraseña" class="form-control valid validText" id="txtcontrasena" name="txtcontrasena" oninput="validatePasswordLength(this)">
                  <div class="valid-feedback">
                    Es correcto
                  </div>
                  <div class="invalid-feedback">
                    La contraseña debe contener 1 carácter especial, 1 minúscula y al menos 8 caracteres
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <label for="txtcontrasenaM" id="letra">Confirmar Contraseña</label>
                  <input type="password" placeholder="Ingresa tu contraseña" class="form-control valid validText" id="txtcontrasenaM" name="txtcontrasenaM" oninput="validatePasswordLength(this)">
                </div>

                <!-- Checkbox para mostrar ambas contraseñas -->
                <div class="form-group col-md-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="showPassword">
                    <label class="form-check-label" for="showPassword">
                      Mostrar contraseñas
                    </label>
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <label for="txtTelefono" id="letra">Teléfono</label>
                  <!--onkeypress="return controlTag(event);"-->
                  <input type="text"  class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" onkeypress="return soloNumero(event);" maxlength="8" required="">
                </div>
 
                <div class="form-group col-md-6">
                  <label for="txtDireccion" id="letra">Dirección</label>
                  <input type="text" class="form-control valid validText" id="txtDireccion" name="txtDireccion" maxlength="100"  oninput="mayus(this)" required="">
                </div>


              </div><br>
              
              <div class="form-group mb-5">
                <button type="submit" class="btn btn-primary btn-block">REGÍSTRASE</button>
                <a class="btn btn-primary btn-block" href="<?= base_url(); ?>/login"><i></i> REGRESAR </a>
              </div>


            </div>
          </form>
        </div>

    </div>
  </section>

</body>

<script>
  const base_url = "<?= base_url(); ?>"; // nos ayuda a usar la funcion base url donde nos devuelve la ruta raiz del proyecto y por lo tanto se puede usar en archivo js de login
</script>

<!-- Essential javascripts for application to work-->
<script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?= media(); ?>/js/popper.min.js"></script>
<script src="<?= media(); ?>/js/bootstrap.min.js"></script>
<script src="<?= media(); ?>/js/fontawesome.js"></script>
<script src="<?= media(); ?>/js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
<script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
<script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>

<!--Script de validacion-->

<script>
  // Obtener el elemento de entrada de contraseña y el checkbox
  const passwordInputs = document.querySelectorAll('input[type="password"]');
  const showPasswordCheckbox = document.querySelector('#showPassword');

  // Agregar un evento de cambio al checkbox
  showPasswordCheckbox.addEventListener('change', () => {
    // Cambiar el tipo de entrada de contraseña según el estado del checkbox
    if (showPasswordCheckbox.checked) {
      passwordInputs.forEach((input) => {
        input.type = 'text';
      });
    } else {
      passwordInputs.forEach((input) => {
        input.type = 'password';
      });
    }
  });
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
<script type="text/javascript">
function eliminarEspacios(input) {
  const contrasena = input.value;
  const contrasenaSinEspacios = contrasena.replace(/\s/g, ''); // Eliminar espacios

  if (contrasena !== contrasenaSinEspacios) {
    input.value = contrasenaSinEspacios;
  }
}
</script>

<!--Validaciones de solo letras mayusculas-->
<script type="text/javascript">
   function mayus(e) {
            // Lista de palabras prohibidas
            var forbiddenWords = ['delete', 'drop', 'insert', 'id', 'update', 'where', 'from'];

            e.value = e.value.toUpperCase();

            // Verificar si el valor convertido a mayúsculas contiene palabras prohibidas
            var lowercaseValue = e.value.toLowerCase();
            for (var i = 0; i < forbiddenWords.length; i++) {
                if (lowercaseValue.includes(forbiddenWords[i])) {
                    // Si se encuentra una palabra prohibida, borra el contenido del input y muestra un mensaje de advertencia
                    e.value = '';
                   
                    return;
                }
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


function validarNombre(input) {
            // Lista de palabras prohibidas
            var forbiddenWords = ['delete', 'drop', 'insert', 'id', 'update', 'where', 'from'];

            // Obtener el valor actual del campo de texto
            var nombre = input.value;

            // Eliminar caracteres no permitidos (todo lo que no sea una letra)
            nombre = nombre.replace(/[^a-zA-Z]/g, '');

            // Limitar la longitud del nombre a un máximo de 40 caracteres
            nombre = nombre.slice(0, 40);

            // Verificar si el nombre contiene palabras prohibidas
            var lowercaseNombre = nombre.toLowerCase();
            for (var i = 0; i < forbiddenWords.length; i++) {
                if (lowercaseNombre.includes(forbiddenWords[i])) {
                    // Si se encuentra una palabra prohibida, limpia el input y muestra un mensaje de advertencia
                    input.value = '';
                    
                    return;
                }
            }

            // Actualizar el valor del campo de texto con el nombre válido
            input.value = nombre;
        }


function validateEmail(input) {
            // Lista de palabras prohibidas
            var forbiddenWords = ['delete', 'drop', 'insert', 'id', 'update', 'where', 'from', '*'];

            // Obtener el valor actual del campo de texto
            var value = input.value;

            // Verificar si el valor del correo electrónico contiene palabras prohibidas
            var lowercaseValue = value.toLowerCase();
            for (var i = 0; i < forbiddenWords.length; i++) {
                if (lowercaseValue.includes(forbiddenWords[i])) {
                    // Si se encuentra una palabra prohibida, limpia el input y muestra un mensaje de advertencia
                    input.value = '';
                    return;
                }
            }

            // Verificar caracteres válidos
            var validChars = /^[a-zA-Z0-9@._-]+$/;
            if (!validChars.test(value)) {
                input.value = value.slice(0, -1);
            }

            // Limitar la longitud del correo electrónico a 30 caracteres
            if (value.length > 30) {
                input.value = value.slice(0, 30);
            }
        }

function validatePasswordLength(input) {
            // Lista de palabras prohibidas
            var forbiddenWords = ['delete', 'drop', 'insert', 'id', 'update', 'where', 'from','*'];

            var value = input.value;

            // Verificar si la contraseña contiene palabras prohibidas
            var lowercaseValue = value.toLowerCase();
            for (var i = 0; i < forbiddenWords.length; i++) {
                if (lowercaseValue.includes(forbiddenWords[i])) {
                    // Si se encuentra una palabra prohibida, limpia el input y muestra un mensaje de advertencia
                    input.value = '';
                 
                    return;
                }
            }

            // Eliminar espacios en blanco
            value = value.replace(/\s/g, '');

            // Limitar la longitud de la contraseña a 50 caracteres
            if (value.length > 50) {
                value = value.slice(0, 50);
            }

            input.value = value;
        }

// Obtén el elemento del input
const inputDireccion = document.getElementById('txtDireccion');

// Agrega un event listener para el evento de entrada de texto
inputDireccion.addEventListener('input', function() {
  // Obtén el valor actual del input
  let direccion = inputDireccion.value;

  // Remueve los caracteres no permitidos y convierte el texto a mayúsculas
  direccion = direccion.replace(/[^0-9A-Z,.\s]/g, '').toUpperCase();

  // Actualiza el valor del input con el texto modificado
  inputDireccion.value = direccion;
});

function soloNumero(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla == 8) return true;
  else if (tecla == 0 || tecla == 9) return true;
  else if (tecla == 32) return false; // Bloquea la tecla de espacio

  patron = /[0-9]/;
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



</script>


<script src="<?= base_url(); ?>/Assets/js/functions_registro_usuario.js"></script>

</html>