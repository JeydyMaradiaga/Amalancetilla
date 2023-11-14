<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/Assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/Assets/css/estilos_login.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Iniciar Sesion</title>
</head>

<body class="  pace-done">
  <div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
      <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
  </div>
  <section class="material-half-bg">
    <div class="cover"></div>
  </section>
  <section class="login-content">
    
    <div class="login-box" style="min-height: 500px;">
      <form class="login-form" action="" id="formPrimer_Ingreso" name="formPrimer_Ingreso">
        <center>
          <h5>!Hola <?= $data['Nombre']; ?> </h5>
        </center>


        <h5 class="login-head"><i class=""></i>Ingresa tus preguntas de seguridad. Esto nos ayudara a verificar tu identidad, si olvidas tu contraseña.
      Número de preguntas a configurar <?= $data['valor_parametro']; ?>. </h5>
        <div class="form-group">

          <div class="form-group">
            <label>Ingrese su pregunta</label>

            <input type="hidden" id="email" name="email" value="<?= $data['email']; ?>" action="" required></input>
            <select class="form-control" aria-label="Default select example" id="form_list_preguntasP" name="form_list_preguntasP"></select>


          </div>
        </div>

        <label class="control-label">Respuesta:</label>

        <input class="form-control" id="txt_Respuesta" name="txt_Respuesta" onkeyup="mayus(this)" type="text" oninput="validateRespuesta(this)">
        <div class="form-group">
          <div class="utility">

          </div>
          <div class="form-group btn-container">
            <br>

            <button class="btn btn-primary btn-block" id="seleccionar" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>ACEPTAR</button>
            <div class="form-group mt-3">

            <a class="btn btn-primary btn-block" href="<?= base_url(); ?>/login"><i></i> REGRESAR </a>
            </div>

          </div>
          <br> <br>
      </form>

    </div>
  </section>

  <!-- Essential javascripts for application to work-->
  <script src="<?= base_url(); ?>/Assets/js/jquery-3.3.1.min.js"></script>
  <script src="<?= base_url(); ?>/Assets/js/popper.min.js"></script>
  <script src="<?= base_url(); ?>/Assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>/Assets/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="<?= base_url(); ?>/Assets/js/plugins/pace.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>/Assets/js/plugins/sweetalert.min.js"></script>
  <script src="<?= base_url(); ?>/Assets/js/<?= $data['page_functions_js']; ?>"></script>

  <script>
    const base_url = "<?= base_url(); ?>"; // nos ayuda a usar la funcion base url donde nos devuelve la ruta raiz del proyecto y por lo tanto se puede usar en archivo js de login

    function validateRespuesta(input) {
    var value = input.value;
    
    var validChars = /^[a-zA-Z0-9. ]+$/; // Agregamos espacio a la expresión regular
    if (!validChars.test(value)) {
    input.value = value.slice(0, -1);
    }

    if (value.length > 30) {
    input.value = value.slice(0, 30);
    }
   }

   function mayus(e) {
    e.value = e.value.toUpperCase();
    }


    var respuesta = ""; //variablre global 
    $(document).ready(function() { 

      function gestion_select(){  //esta funcion oculta la opcion seleccionada por primera vez 
        var opcionSeleccionadaText = $("#form_list_preguntasP option:selected").text();
        // declaracion de variable, igualamos y llamamos al select por id y accedemos a la propiedad texto
          if (opcionSeleccionadaText !== '') { //validacion distinto de nulo
              $("#form_list_preguntasP option").filter(function() { 
                  return $(this).text() == opcionSeleccionadaText; //si es igual el texto del select con la variable que oculte la opcion seleccionada
              }).hide();
          }
          $("#form_list_preguntasP option:selected").text("Seleccione pregunta No. 2"); //accedemos a la opcion seleccionada y sustituimos por un texto
      }

      $("#seleccionar").click(function(event) { //funcion que se ejecuta cuando se hace click en el boton con id seleccionar
          if(respuesta == ""){ //variale global = a nulo
              respuesta = $("#txt_Respuesta").val(); //guardo en variable respuesta el valor del input por id 
              gestion_select()
          }else{
              if(respuesta == $("#txt_Respuesta").val()){ //comparacion entre variable global cuando no es nula con el input llamado por id
                  alert('respuesta es igual a la anterior') //mensaje de error 
                  $("#txt_Respuesta").val(""); //poner el valor del input por id en blanco
                  return false; //no deja seguir ejecutando los procesos de la pagina
              }
          }s
      });


    });


  </script>

</body>

</html>