<?php headerAdmin($data); ?>

<main class="app-content">

  <div class="app-title">

    <div>

      <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>

    </div>

    <ul class="app-breadcrumb breadcrumb">

      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>

      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/producciones">Producciones</a></li>

    </ul>

  </div>

  <div class="row">

    <div class="col-md-12">

      <div class="tile">

        <?php

          if(empty($data['arrProduccion'])){

        ?>

        <p>Datos no encontrados</p>

        <?php }else{

     

            $usuario = $data['arrProduccion']['usuario'];

            $orden = $data['arrProduccion']['orden'];

            $detalle = $data['arrProduccion']['detalle'];          

           

         ?>

        <section id="sProduccion" class="invoice">

          <div class="row mb-4">

            <div class="col-6">

              <h2 class="page-header" ><img class="logo_login" style="max-width: 100px;" src="<?= base_url(); ?>/Assets/images/logo.jpeg" ></h2>

            </div>

            <div class="col-6">

              <h5 class="text-right">Fecha: <?= $orden['0']['Fecha'] ?></h5>

            </div>

          </div>

          <div class="row invoice-info">

            <div class="col-4">

              <address><strong>Amalancetilla</strong><br>

                <?= DIRECCION ?><br>

                <?= TELEMPRESA ?><br>

                <?= EMAIL_EMPRESA ?><br>

                <?= WEB_EMPRESA ?>

              </address>

            </div>

            <div class="col-4">

              <address><strong>Producción realizada por: <?= $usuario['0']['Nombre']?></strong>

               </address>

            </div>

            <div class="col-4"><b>Producción #<?= $orden['0']['Id_Produccion'] ?></b><br>                

                <b>Estado:</b> <?= $orden['0']['Estado_Produccion'] ?>

            </div>

          </div>

          <div class="row">

            <div class="col-12 table-responsive">

              <table class="table table-striped">

                <thead>

                  <tr>

                    <th class="text-center">DESCRIPCIÓN</th>

                    <th  class="text-center">CATEGORÍA</th>

                    <th class="text-center">CANTIDAD  ELABORADA</th>
                    <th class="text-center">CANTIDAD CONSUMIDA</th>

                  </tr>

                </thead>

                <tbody>

                    <?php
                        if(count($detalle) > 0){

                            foreach ($detalle as $producto) {

                     ?>

                  <tr>

                    <td class="text-center"><?= $producto['Nombre'] ?></td>

                    <td class="text-center"><?= $producto['Id_Categoria'] ?></td>
                    <?php
                        if($producto['Id_Categoria'] == 'Producto'){


                     ?>
                    
                    <td class="text-center"><?= $producto['Cantidad_Produccion'] ?></td>

                    <td class="text-center"></td>

                    <?php

                            }else{

                   ?>
                    <td class="text-center"></td>

                    <td class="text-center"><?= $producto['Cantidad_Produccion'] ?></td>
                        <?php

                        }

                        ?>

                  </tr>

                  <?php

                            }

                        }
                   ?>

                </tbody>

              </table>

            </div>

          </div>

          <div class="row d-print-none mt-2">

            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sProduccion');" > Imprimir</a></div>

          </div>

        </section>

        <?php } ?>

      </div>

    </div>

  </div>

</main>

<?php footerAdmin($data); ?>