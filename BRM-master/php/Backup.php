<?php
include './Connet.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copia de Seguridad</title>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    <style>
        /* Estilos personalizados para la alerta flotante */
        .floating-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
    </style>
</head>

<body>

<?php
$day = date("d");
$mont = date("m");
$year = date("Y");
$hora = date("H-i-s");
$fecha = $day . '_' . $mont . '_' . $year;
$DataBASE = $fecha . "_(" . $hora . "_hrs).sql";
$tables = array();
$result = SGBD::sql('SHOW TABLES');

if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }
    $sql = 'SET FOREIGN_KEY_CHECKS=0;' . "\n\n";
    $sql .= 'CREATE DATABASE IF NOT EXISTS ' . BD . ";\n\n";
    $sql .= 'USE ' . BD . ";\n\n";;
    foreach ($tables as $table) {
        $result = SGBD::sql('SELECT * FROM ' . $table);
        if ($result) {
            $numFields = mysqli_num_fields($result);
            $sql .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $row2 = mysqli_fetch_row(SGBD::sql('SHOW CREATE TABLE ' . $table));
            $sql .= "\n\n" . $row2[1] . ";\n\n";
            for ($i = 0; $i < $numFields; $i++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sql .= 'INSERT INTO ' . $table . ' VALUES(';
                    for ($j = 0; $j < $numFields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            $sql .= '"' . $row[$j] . '"';
                        } else {
                            $sql .= '""';
                        }
                        if ($j < ($numFields - 1)) {
                            $sql .= ',';
                        }
                    }
                    $sql .= ");\n";
                }
            }
            $sql .= "\n\n\n";
            $error = 0;
        } else {
            $error = 1;
        }
    }

    if ($error == 1) {
        echo 'Error';
    } else {
        chmod("C:/wamp64/www/Amalancetilla/BRM-master/backups/", 0777);
        $sql .= 'SET FOREIGN_KEY_CHECKS=1;';
        $handle = fopen("C:/wamp64/www/Amalancetilla/BRM-master/backups/" . $DataBASE, 'w+');
        if (fwrite($handle, $sql)) {
            fclose($handle);
?>

            <!-- Llama a la función JavaScript mostrarAlerta() al cargar la página -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    mostrarAlerta();
                });

                function mostrarAlerta() {
                    // Muestra una alerta de SweetAlert2 con un botón de cerrar
                    Swal.fire({
                        icon: 'success',
                        title: 'Copia de seguridad creada exitosamente.',
                        showConfirmButton: false,
                        timer: 2000,
                        footer: '<button type="button" class="btn btn-outline-success btn-sm" onclick="cerrarAlerta()">Cerrar</button>'
                    }).then((result) => {
                        // Redirige a la nueva página después de cerrar la alerta
                        window.location.href = 'http://localhost/amalancetilla/backupr';
                    });
                }

                function cerrarAlerta() {
                    // Cierra la alerta manualmente
                    Swal.close();
                }
            </script>

<?php
        } else {
            echo 'Ocurrió un error inesperado al crear la copia de seguridad';
        }
    }
} else {
    echo 'Ocurrió un error inesperado';
}
mysqli_free_result($result);
?>

</body>

</html>
