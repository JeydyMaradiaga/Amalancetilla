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
    <div class="login-box ru">
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
                <input type="text" placeholder="Ingresa tu nombre " class="form-control valid validText" id="txtNombre" name="txtNombre" onkeyup="mayus(this)" onkeypress="return SoloLetras(event);" required="">
              </div>
              <div class="form-group col-md-6">
                <label for="txtEmail" id="letra">Correo Electronico</label>
                <input type="email" placeholder="Ingresa tu correo electronico " class="form-control valid validEmail" id="txtEmail" name="txtEmail" onkeyUp="this.value=this.value.toLowerCase();" required="">
              </div>
            </div>

            <div class="form-group mb-3">
              <div class="form-row">


                <div class="form-group col-md-6">
                  <label for="txtcontrasena" id="letra">Contraseña</label>
                  <input type="password" placeholder="Ingresa tu contraseña" class="form-control valid validText" id="txtcontrasena" name="txtcontrasena">
                  <div class="valid-feedback">
                    Es correcto
                  </div>
                  <div class="invalid-feedback">
                    La contraseña debe contener 1 carácter especial, 1 minúscula y al menos 8 caracteres
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <label for="txtcontrasenaM" id="letra">Confirmar Contraseña</label>
                  <input type="password" placeholder="Ingresa tu contraseña" class="form-control valid validText" id="txtcontrasenaM" name="txtcontrasenaM">
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
                  <input type="text" placeholder="Ingresa tu telefono " class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" onkeypress="return solonumero(event);" maxlength="8" required="">
                </div>

                <div class="form-group col-md-6">
                  <label for="txtDireccion" id="letra">Dirección</label>
                  <input type="text" placeholder="Ingresa tu dirección " class="form-control valid validText" id="txtDireccion" name="txtDireccion" onkeyup="mayus(this)" required="">
                </div>


              </div><br>

              <div class="form-group mb-5">
                <button type="submit" class="btn btn-info width-100">Regístrate</button>
                <a class="btn btn-info width-100" href="<?= base_url(); ?>/login"><i></i> Regresar </a>
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

<!--Validaciones de solo letras mayusculas-->
<script type="text/javascript">
  function mayus(e) {
    e.value = e.value.toUpperCase();
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
</script>

<script src="<?= base_url(); ?>/Assets/js/functions_registro_usuario.js"></script>

</html>