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
       
        <div class="login-box">
            <form class="login-form" id="formCambiarPass" name="formCambiarPass" action="">
                <input type="hidden" id="id_Usuario" name="id_Usuario" value="<?= $data['id_usuario']; ?>" action="" required></input>
                <input type="hidden" id="txt_email" name="txt_email" value="<?= $data['Email']; ?>" action="" required></input>
                <input type="hidden" id="txt_token" name="txt_token" value="<?= $data['Token']; ?>" action="" required></input>
                <input type="hidden" id="txt_nombre" name="txt_nombre" value="<?= $data['nombre']; ?>" action="" required></input>

                <h5 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Hola <?= $data['nombre']; ?>, Ingrese su nueva contraseña</h5>
                <div class="form-group">
                    <label class="control-label ">Nueva Contraseña</label>
                    <input class="form-control" type="password" id="txtPassword" name="txtPassword" maxlength="15" require>
                
                    
                    <div class="valid-feedback">
                        Es correcto
                    </div>
                    <div class="invalid-feedback">
                        La contraseña debe contener 1 carácter especial, 1 minúscula y al menos 8 caractés
                    </div>
                 
                </div>

                <div class="form-group">
                    <label class="control-label">Confirmar Contraseña</label>
                    <input id="txtPasswordConfirm" name="txtPasswordConfirm" class="form-control" type="password" maxlength="15" require>
                    <label>
                        <input type="checkbox" id="viewPasswordee" class="label-text mover"><span class="label-text">Mostrar contraseña</span>
                    </label>
                </div>

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
        const base_url = "<?= base_url(); ?>"; // nos ayuda a usar la funcion base url donde nos devuelve la ruta raiz del proyecto y por lo tanto se puede usar en archivo js de login
    </script>

  <script>
    </script>
    <script>
        let password = document.getElementById("txtPassword");
        let password2 = document.getElementById("txtPasswordConfirm");
        let viewPassword = document.getElementById('viewPasswordee');

        let click = false;

        viewPassword.addEventListener('click', (e) => {
            if (!click) {
                password.type = 'text'
                password2.type = 'text'

                click = true
            } else if (click) {
                password.type = 'password'
                password2.type = 'password'
                click = false
            }
        })
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