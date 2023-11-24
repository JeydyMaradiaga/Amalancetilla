
<?php
headerAdmin($data);
?>


<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        background: linear-gradient(to right, #2ecc71, #000);
    }

    .main-container {
        text-align: center;
        background-color: #fff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-left: 200px; /* Ajusta el margen izquierdo para moverlo más a la derecha */
        max-width: 700px;
        width: 200%;
    }

    .main-heading {
        margin-bottom: 1.5rem;
        color: green;
    }

    .sub-heading {
        margin-bottom: 20px;
        color: #6c757d;
    }

    .backup-button {
        background-color: #28a745;
        color: #fff;
        padding: 15px 30px;
        border-radius: 5px;
        display: inline-block;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .backup-button:hover {
        background-color: #218838;
    }

    .backup-button a {
        color: #fff;
        text-decoration: none;
    }
</style>
<main>
    <div class="main-container">
        <h2 class="main-heading">Generación de Copias de Seguridad</h2>
        <p class="sub-heading">Realice fácilmente copias de seguridad de su base de datos, podrá acceder a ella cuando desee.</p>
        <div class="tile">
            <h5>Respalde su base de datos, en un solo clic.</h5>
            <div class="backup-button" id="backupButton">
                <i class="fa fa-database"></i>
                <div class="info">
                    <h4>
                        <a href="javascript:void(0);" onclick="generarBackup()">Generar Backup</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</main>

<?php footerAdmin($data); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<script>
    function generarBackup() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                mostrarAlerta();
            }
        };
        xhttp.open("GET", "http://localhost/Amalancetilla/BRM-master/php/Backup.php", true);
        xhttp.send();
    }

    function mostrarAlerta() {
    Swal.fire({
        icon: 'success',
        title: 'Copia de seguridad creada exitosamente.',
        showConfirmButton: false,
        footer: '<button type="button" class="btn btn-outline-success btn-sm" onclick="cerrarAlerta()">Cerrar</button>'
    });
}

    function cerrarAlerta() {
        Swal.close();
    }
</script>
