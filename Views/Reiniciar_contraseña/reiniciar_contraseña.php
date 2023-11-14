<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="Assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="Assets/css/estilos_login.css">
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
    
    <div class="login-box" style="min-height: 400px;">
      <form class="login-form"  id="form_reiniciar_contraseñas" name="form_reiniciar_contraseñas" action="">
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>¿Olvidaste tu Contraseña?</h3>
        <div class="form-group">
          <label class="control-label">CORREO</label>
          <input  id="txt_correo_reiniciar" name="txt_correo_reiniciar"  class="form-control"  type="email" placeholder="" autofocus="" oninput="validateEmail(this)">
        </div>
     
        <div class="form-group">
          <div class="utility">
    
            <fieldset>
                <label>Elige el metodo de recuperacion : </label> <br>
                <label>
                    <input  id="op_correo" name="opcion" type="radio"  > Correo electrónico
                     
                </label><br>
                <label>
                    <input  id="op_preguntas" type="radio" name="opcion" > Preguntas secretas
                </label>
              
            </fieldset>
     
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>ACEPTAR</button>
            <a class="btn btn-primary btn-block" href="<?= base_url(); ?>/login"><i></i> REGRESAR </a>
          </div>
          <div class="form-group mt-3">
         
          </div>
      </form>

    </div>
  </section>
  <script>
    const base_url = "<?= base_url(); ?>"; // nos ayuda a usar la funcion base url donde nos devuelve la ruta raiz del proyecto y por lo tanto se puede usar en archivo js de login
    function validateEmail(input) {
  var value = input.value;
  var validChars = /^[a-zA-Z0-9@._-]+$/;

  if (!validChars.test(value)) {
    input.value = value.slice(0, -1);
  }

  if (value.length > 50) {
    input.value = value.slice(0, 50);
  }
}
  </script>
  <!-- Essential javascripts for application to work-->
  <script src="Assets/js/jquery-3.3.1.min.js"></script>
  <script src="Assets/js/popper.min.js"></script>
  <script src="Assets/js/bootstrap.min.js"></script>
  <script src="Assets/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="Assets/js/plugins/pace.min.js"></script>
  <script type="text/javascript" src="Assets/js/plugins/sweetalert.min.js"></script>
  <script type="text/javascript" src="Assets/js/<?= $data['page_functions_js']; ?>"></script>

</body>

</html>