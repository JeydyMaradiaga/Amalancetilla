<?php headerAdmin($data); ?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/compras"> Compras</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <?php
          if(empty($data['arrCompra'])){
        ?>
        <p>Datos no encontrados</p>
        <?php }else{
     
            $proveedor = $data['arrCompra']['proveedor'];
            $orden = $data['arrCompra']['orden'];
            $detalle = $data['arrCompra']['detalle'];
            $descuento =  $data['arrCompra']['orden']['0']['Total'];
           
           
         ?>
        <section id="sCompra" class="invoice">
          <div class="row mb-4">
            <div class="col-6">
              <h2 class="page-header" ><img class="logo_login" style="max-width: 100px;" src="<?= base_url(); ?>/Assets/images/logo.jpeg" ></h2>
            </div>
            <div class="col-6">
              <h5 class="text-right">Fecha: <?= $orden['0']['Fecha_Compra'] ?></h5>
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
              <address><strong>Nombre: <?= $proveedor['0']['Nombre_Proveedor']?></strong><br>
                Envío: <?= $orden['0']['Direccion_Proveedor'] ?><br>
                Tel: <?= $proveedor['0']['Telefono_Proveedor'] ?><br>
                Email: <?= $proveedor['0']['Correo_Proveedor'] ?>
               </address>
            </div>
            <div class="col-4"><b>Orden #<?= $orden['0']['Id_Compra'] ?></b><br>                
                <b>Estado:</b> <?= $orden['0']['Estado_Compra'] ?> <br>
                <b>Monto:</b> <?= SMONEY.' '. formatMoney($orden['0']['Total']) ?>
            </div>
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th class="text-right">Precio</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-right">Importe</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        $subtotal = 0;
                        if(count($detalle) > 0){
                            foreach ($detalle as $producto) {
                                $subtotal += $producto['Cantidad_Comprada'] * $producto['Precio_Costo'];
                              
                                
                     ?>
                  <tr>
                    <td><?= $producto['Nombre'] ?></td>
                    <td class="text-right"><?= SMONEY.' '. formatMoney($producto['Precio_Costo']) ?></td>
                    <td class="text-center"><?= $producto['Cantidad_Comprada'] ?></td>
                    <td class="text-right"><?= SMONEY.' '. formatMoney($producto['Cantidad_Comprada'] * $producto['Precio_Costo']) ?></td>
                  </tr>
                  <?php 
                            }
                        }
                      
                   ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Sub-Total:</th>
                        <td class="text-right"><?= SMONEY.' '. formatMoney($subtotal) ?></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Descuento:</th>
                        <td class="text-right"><?= SMONEY.' '. formatMoney( $subtotal - $descuento) ?></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Total:</th>
                        <td class="text-right"><?= SMONEY.' '. formatMoney($orden['0']['Total']) ?></td>
                    </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="row d-print-none mt-2">
            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sCompra');" > Imprimir</a></div>
          </div>
        </section>
        <?php } ?>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>