<?php headerAdmin($data); ?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/pedidos"> Pedidos</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <?php
          if(empty($data['arrPedido'])){
        ?>
        <p>Datos no encontrados</p>
        <?php }else{
     
            $cliente = $data['arrPedido']['cliente'];
            $orden = $data['arrPedido']['orden'];
            $detalle = $data['arrPedido']['detalle'];
            $ISV =  $data['arrPedido']['orden']['0']['Total'];
            $descuento =  $data['arrPedido']['orden']['0']['Total'];
            $descuento2 =0;
           
         ?>
        <section id="sPedido" class="invoice">
          <div class="row mb-4">
            <div class="col-6">
              <h2 class="page-header" ><img class="logo_login" style="max-width: 100px;" src="<?= base_url(); ?>/Assets/images/logo.jpeg" ></h2>
            </div>
            <div class="col-6">
              <h5 class="text-right">Fecha: <?= $orden['0']['Fecha_Hora'] ?></h5>
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
              <address><strong>Nombre: <?= $orden['0']['Nombre']?></strong><br>
                Tel: <?= $orden['0']['Telefono'] ?><br>
                Email: <?= $orden['0']['Correo_Cliente'] ?>
               </address>
            </div>
            <div class="col-4"><b>Orden #<?= $orden['0']['Id_Pedido'] ?></b><br> 
                <b>Pago: </b><?= $orden['0']['nombrep'] ?><br>
               
                <b>Estado:</b> <?= $orden['0']['Estado'] ?> <br>
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
                        $ISV11 = 0;
                        if(count($detalle) > 0){
                            foreach ($detalle as $producto) {
                              $importe = $producto['Precio_Venta'] * $producto['Cantidad'];
                              $subtotal = $subtotal + $importe;
                              $ISV11 += $producto['Porcentaje_ISV'] *  ($importe) ;

                                
                     ?>
                  <tr>
                    <td><?= $producto['Nombre'] ?></td>
                    <td class="text-right"><?= SMONEY.' '. formatMoney($producto['Precio_Venta']) ?></td>
                    <td class="text-center"><?= $producto['Cantidad'] ?></td>
                    <td class="text-right"><?= SMONEY.' '. formatMoney($producto['Cantidad'] * $producto['Precio_Venta']) ?></td>
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
                      <td colspan="3" class="text-right">Descuento:</td>
                      <td class="text-right"><?php 

                      $descuento2 = ($subtotal - $descuento ) + $ISV11  ;
                      if ($descuento2 > 0){

                        echo SMONEY.' '.formatMoney( ($subtotal - $descuento ) + $ISV11  ) ;
                      }else{
                        echo SMONEY.' '.formatMoney( 0) ;
                        $descuento2  = 0;
                      }
                      ?></td>
                    </tr>
                    

                    <tr>
                        <td colspan="3" class="text-right">ISV:</td>
                        <td class="text-right"><?= SMONEY.' '. formatMoney(  $ISV11  ) ?></td>
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
            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sPedido');" > Imprimir</a></div>
          </div>
        </section>
        <?php } ?>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>