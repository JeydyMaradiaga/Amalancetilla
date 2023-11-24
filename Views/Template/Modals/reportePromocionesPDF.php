<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <style>
        table {
            width: 100%;
        }

        table td,
        table th {
            font-size: 11px;
        }

        h4 {
            margin-bottom: 0px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .wd33 {
            width: 33.33%;
        }

        .tbl-cliente {
            border: 1px solid #CCC;
            border-radius: 10px;
            padding: 5px;
        }

        .wd10 {
            width: 10%;
        }

        .wd15 {
            width: 15%;
        }

        .wd40 {
            width: 40%;
        }

        .wd55 {
            width: 55%;
        }

        .tbl-detalle {
            border-collapse: collapse;
        }

        .tbl-detalle thead th {
            padding: 5px;
            background-color: #009688;
            color: #FFF;
        }

        .tbl-detalle tbody td {
            border-bottom: 1px solid #CCC;
            padding: 5px;
        }

        .tbl-detalle tfoot td {
            padding: 5px;
        }
    </style>
</head>

<body>

    <table class="tbl-hader">
        <tbody>
            <tr>
                <td class="wd33">
                    <div class="col-6">
                        <h2 class="page-header"><img class="logo_login" style="max-width: 100px;" src="<?= base_url(); ?>/Assets/images/logo.jpeg"></h2>

                  
                    </div>
               

                </td>
                <td class="text-center wd33">
                    <h4><strong><?= NOMBRE_EMPESA ?></strong></h4>

                    <p><?= DIRECCION ?> <br>
                        Teléfono: <?= TELEMPRESA ?> <br>
                        Email: <?= EMAIL_EMPRESA  ?></p>

                       <strong><h3>  Promociones </h3></strong> 
                </td>
                <td class="wd33">
                <div class="col-6 text-right" >
                	<p >Fecha: <?= date('d/m/Y | g:i:a') ?> <br></p>
                    </div>
                    </td>
           

            </tr>
        </tbody>
    </table>
    <br>
    <table class="tbl-detalle">
        <thead>
            <tr>
                <th class=" text-center" style="width: 20px;">#</th>
                <th class=" text-center" style="width: 70px;">Producto</th>
                <th class=" text-center" style="width: 60px;">Valor</th>
                <th class=" text-center" style="width: 60px;">Nombre</th>
                <th class=" text-center" style="width: 90px;">Descripción</th>
                <th class=" text-center" style="width: 40px;">Estado</th>
                <th class=" text-center" style="width: 60px;">Fecha Inicio</th>
                <th class=" text-center" style="width: 60px;">Fecha Final</th>
                <th class=" text-center" style="width: 60px;">Cantidad en promoción</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $contador = 0;
            foreach ($data as $datos) {
                $contador += 1;

            ?>
                <tr>
                    <td class=" text-center"><?= $contador ?></td>
                    <td class=" text-center"><?= $datos['nombrep'] ?></td>
                    <td class=" text-center"><?= $datos['Precio'] ?></td>
                    <td class=" text-center"><?= $datos['Nombre'] ?></td>
                    <td class=" text-center"><?= $datos['Descripcion'] ?></td>
                    <td class=" text-center"><?= $datos['Estado'] ?></td>
                    <td class=" text-center"><?= $datos['Fecha_Inicio'] ?></td>
                    <td class=" text-center"><?= $datos['Fecha_Final'] ?></td>
                    <td class=" text-center"><?= $datos['Cantidad_Promocion'] ?></td>
                </tr>
            <?php } ?>
        </tbody>


    </table>

    <style>

    
     #footer {padding-top:5px 0; border-top: 1px solid; width:100%;}
     #footer .fila td {text-align:center; width:100%;}
     #footer .fila td span {font-size: 10px; color: black;}
 
</style>
    
     
    <page_footer>
        <table id="footer">
            <tr class="fila">
                <td>
                    <span>Amalancetilla - Pagina [[page_cu]] de [[page_nb]]</span>
                </td>
            </tr>
        </table>
    </page_footer>
 




</body>



</html>
