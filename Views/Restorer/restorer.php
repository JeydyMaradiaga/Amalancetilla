<?php
    headerAdmin($data);
    include("BRM-master\php\Connet.php");
?>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

<style>
    body {
        background: linear-gradient(to right, #2ecc71, #000);
        color: #fff;
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
    }

    .container {
    text-align: center;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 700px;
    margin: 150px auto;
    margin-left: 480px; /* Ajusta este valor para mover el contenedor más a la derecha */
    background-color: #fff;
    border-radius: 10px;
}
    h1 {
        color: green;
        margin-bottom: 20px;
    }

    select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
    }

    .sub-heading {
        margin-bottom: 20px;
        color: #6c757d;
    }

    .restaurar-button {
        background-color: #28a745;
        color: #fff;
        font-weight: bold;
        font-size: 18px;
        padding: 15px 30px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .restaurar-button:hover {
        background-color: #218838;
    }
</style>

<body data-ng-app="validationApp">
    <div class="container" data-ng-controller="RegistrationController">
        <data-uib-tabset data-active="activeJustified" data-justified="true">
            <data-uib-tab data-heading="BACKUP" data-index="0">
                <br />
                <div class="main">
                    <header class="page-header">
                        <div class="branding">
                            <br>
                            <form id="restoreForm" action="BRM-master\php\Restore.php" method="POST">
                                <h1>Restauración base de datos</h1>
                                <p class="sub-heading">Seleccione la base de datos que desea recuperar.</p>
                                <p class="sub-heading">Al restaurar la base de datos, se reiniciará el sistema.</p>
                                <select name="restorePoint">
                                    <option value="" disabled="" selected="">Selecciona un punto de restauración</option>
                                    <?php
                                        $ruta = "C:/wamp64/www/Amalancetilla/BRM-master/backups/";
                                        if (is_dir($ruta)) {
                                            if ($aux = opendir($ruta)) {
                                                while (($archivo = readdir($aux)) !== false) {
                                                    if ($archivo != "." && $archivo != "..") {
                                                        $nombrearchivo = str_replace(".sql", "", $archivo);
                                                        $nombrearchivo = str_replace("-", ":", $nombrearchivo);
                                                        $ruta_completa = "C:/wamp64/www/Amalancetilla/BRM-master/backups/" . $archivo;
                                                        if (is_dir($ruta_completa)) {
                                                            // Si es un directorio, puedes hacer algo aquí si es necesario.
                                                        } else {
                                                            echo '<option value="' . $ruta_completa . '">' . $nombrearchivo . '</option>';
                                                        }
                                                    }
                                                }
                                                closedir($aux);
                                            }
                                        } else {
                                            echo $ruta . " No es ruta válida";
                                        }
                                    ?>
                                </select>
                                <center><button type="button" class="restaurar-button" onclick="mostrarAlerta()">Restaurar</button></center>
                            </form>
                        </div>
                    </header>
                </div>
            </data-uib-tab>
        </data-uib-tabset>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    <script>
        function mostrarAlerta() {
            var restorePoint = document.getElementsByName('restorePoint')[0];

            if (restorePoint.value === '') {
                // Si no se ha seleccionado un punto de restauración, muestra una alerta de SweetAlert2
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'Debe seleccionar un punto de restauración.',
                    confirmButtonColor: '#28a745',
                    confirmButtonText: 'Cerrar'
                });
            } else {
                // Si se ha seleccionado un punto de restauración, puedes realizar alguna acción adicional aquí
                // Por ejemplo, enviar el formulario
                document.getElementById('restoreForm').submit();
            }
        }
    </script>
</body>

<?php footerAdmin($data); ?>
