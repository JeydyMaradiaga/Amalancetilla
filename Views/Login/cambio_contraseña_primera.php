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
       
        <div class="login-box" style="min-height: 535px;">
            <form class="login-form" id="formCambiarPass2" name="formCambiarPass2"  action="">
                    <input type="hidden" id="id_Usuario" name="id_Usuario" value="<?=$data['id_usuario']; ?>" action="" required ></input>
             
                    <input type="hidden" id="txt_nombre" name="txt_nombre" value="<?=$data['nombre']; ?>" action="" required ></input>

                <h5 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Hola <?= $data['nombre']; ?>, Ingrese su contraseña anterior e ingreso su nueva contraseña</h5>
                <div class="form-group">
                    <label class="control-label">Contraseña Anterior</label>
                 
                    <input class="form-control" type="password" id="txtPasswordAnterior" name="txtPasswordAnterior" require>
                </div>
                <label>
                        <input type="checkbox" id="viewPasswordee" class="label-text mover"><span class="label-text">Mostrar contraseña</span>
                    </label>
              
                <div class="form-group">
                    <label class="control-label">Nueva Contraseña</label>
                 
                    <input class="form-control" type="password" id="txtPassword" name="txtPassword" require>
                    <div class="valid-feedback">
                        Es correcto
                    </div>
                    <div class="invalid-feedback">
                        La contraseña debe contener 1 carácter especial, 1 minúscula y al menos 8 caractés
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Confirmar Contraseña</label>
                    <input id="txtPasswordConfirm" name="txtPasswordConfirm" class="form-control" type="password" require>
                </div>
                <label>
                        <input type="checkbox" id="viewPassworde" class="label-text mover"><span class="label-text">Mostrar contraseña</span>
                    </label>
              
                <div class="form-group">
                    <div class="utility">


                    </div>
                    <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>ACEPTAR</button>
                    </div>
               
            </form>

        </div>
    </section>
    <script>
    let password1 = document.getElementById("txtPasswordAnterior");

    let viewPassword1 = document.getElementById('viewPasswordee');


    let click1 = false;

    viewPassword1.addEventListener('click', (e) => {
      if (!click1) {
        password1.type = 'text'


        click1 = true
      } else if (click1) {
        password1.type = 'password'

        click1 = false
      }
    })
  </script>
   <script>
    let password = document.getElementById("txtPassword");

    let viewPassword = document.getElementById('viewPassworde');


    let click = false;

    viewPassword.addEventListener('click', (e) => {
      if (!click) {
        password.type = 'text'


        click = true
      } else if (click) {
        password.type = 'password'

        click = false
      }
    })
  </script>
    <script>
    const base_url = "<?= base_url(); ?>"; // nos ayuda a usar la funcion base url donde nos devuelve la ruta raiz del proyecto y por lo tanto se puede usar en archivo js de login
  </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= base_url(); ?>/Assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>/Assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>/Assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/Assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= base_url(); ?>/Assets/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/Assets/js/plugins/sweetalert.min.js"></script>
  <script src="<?= base_url(); ?>/Assets/js/<?= $data['page_functions_js']; ?>"></script>

</body>

</html>