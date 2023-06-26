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
        
        <div class="login-box" style="padding-top: 5m;">
            <form class="login-form" action="" id="formPreguntas" name="formPreguntas">
                <center>
                    <h5>!Hola <?= $data['nombre']; ?> </h5>
                </center>

                <h5 class="login-head"><i class=""></i>Responde a una de tus preguntas de seguridad para restablecer tu contraseña</h5>
                <div class="form-group">

                    <div class="form-group">
                        <label for="exampleSelect1">Seleccione</label>
                        <input type="hidden" id="id_Usuario" name="id_Usuario" value="<?= $data['id_usuario']; ?>" action="" required></input>

                        <select class="form-control" aria-label="Default select example" id="form_list_preguntas" name="form_list_preguntas" action="" data-live-search="true">

                        </select>
                    </div>
                </div>
                <label class="control-label">Respuesta:</label>
                <input class="form-control" id="txtRespuestaPregunta" name="txtRespuestaPregunta" type="text">
                <div class="form-group">
                    <div class="utility">

                    </div>
                    <div class="form-group btn-container">
                        <br>

                        <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>ACEPTAR</button>
                        <div class="form-group mt-3">

                            <p class="semibold-text mb-0"><a href="<?= base_url(); ?>/reiniciar_contraseña" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Regresar </a></p> <br>
                        </div>

                    </div>
                    <br> <br>
            </form>

        </div>
    </section>

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