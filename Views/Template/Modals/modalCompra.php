<div class="modal fade" id="modalFormCompra" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 800px">
    <div class="modal-content">
      <div class="modal-header headerRegister bg-primary text-white">
        <h5 class="modal-title" id="titleModal">Nueva Compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCompras" name="formCompras" class="form-horizontal">
          <input type="hidden" id="idCompra" name="idCompra" value="">
          <p class="text-primary" id="letra">Todos los campos son obligatorios.</p> <br>

          <div class="form-row">
              <input type="hidden" id="idcompra1" name="idcompra1" value="" required="">
            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="txtFechavencimiento" id="letra">Fecha </label>
              <input type="date" class="form-control valid validFechavencimiento" id="txtFechavencimiento" name="txtFechavencimiento" readonly required="" value="<?php echo (date("Y-m-d")); ?>">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="seleccionarProveedor">Proveedor</label>
              <select name="seleccionarProveedor" id="seleccionarProveedor" class="form-control selectpicker  clase2 classs2" data-live-search="true" required="" value="">
              </select>
            </div>
            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="txtNumero">N° Telefono</label>
              <input class="form-control class2" id="txtNumero" name="txtNumero" type="text" placeholder="" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="selectProductos" onclick="fntgetPrecio()">Productos</label>
              <select name="selectProductos" id="selectProductos" class="form-control selectpicker classs" data-live-search="true" required="" onclick="fntgetPrecio()" default="selecc" value="">
                <option>--seleccione--</option>
              </select>
            </div>
            <div class="form-group col-md-6" style="max-width: 150px">

              <label for="listStatus">Precio</label>

              <label class="sr-only" for="exampleInputAmount"></label>
              <div class="input-group" style="width: 100%;">
                <div class="input-group-prepend"><span class="input-group-text">L.</span></div>
                <input class="form-control class2" id="txtprecio" name="txtprecio" type="text" placeholder="" readonly>

              </div>

            </div>
            <div class="form-group col-md-6" style="max-width: 100px">
              <label for="listStatus">Cantidad</label>
              <input class="form-control class2" id="txtCantidad" name="txtCantidad" type="number" min="1" max="50" step="1" placeholder="" require>

              </select>
            </div>

            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="listStatus" class="notblock">Agregar</label>
              <br>
              <button onclick="agregarProductos()" id="btnAgregar" name="btnAgregar" class="btn btn-primary" style="padding-top: 1px;"><i class="fa fa-cart-plus" style="max-width: 2px; font-size: 40px; margin-right: 64px;" aria-hidden="true"></i>Agregar productos</button>&nbsp;&nbsp;&nbsp;
            </div>


          </div>
          <div class="form-group col-md-12" id="tbldiv">
            <?php
            if (empty($_SESSION['arrCarrito'])) {
            ?>

            <?php } else {
              // dep($data['arrPedido']['orden']['0']);
              //  die();

              $detalle = $_SESSION['arrCarrito'];
            ?>
              <!--PODER VER LA CLAVE NUEVO USUARIO-->
              <div class="row">
                <div class="col-md-12">
                  <div class="tile">
                    <div class="col-12 table-responsive">
                      <table class="table table-striped" id="tableCompras">
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
                            $totalisv=0;
                          $subtotal = 0;
                          $ISV11 = 0;
                          $descuento = 0;
                        
                          $contador =0;
                            if (count($detalle) > 0) {
                         
                            
                          
                            foreach ($detalle as $producto) {
                              
                              $subtotal += $producto['cantidad'] * $producto['precio'];
                              $ISV11 += 1 *  ($producto['cantidad'] * $producto['precio']) ;
               ?>
                              <tr>
                                <td><?= $producto['producto'] ?></td>
                                <td class="text-right"><?= SMONEY . ' ' . formatMoney($producto['precio']) ?></td>
                                <td class="text-center"><?= $producto['cantidad'] ?></td>
                                <td class="text-right"><?= SMONEY . ' ' . formatMoney($producto['cantidad'] * $producto['precio']) ?></td>
                              </tr>
                          <?php
                            }
                          }

                          ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="3" class="text-right">Sub-Total:</th>
                            <td class="text-right"><?= SMONEY . ' ' . formatMoney($subtotal) ?></td>
                          </tr>
                          

                          
                          <tr>
                            <th colspan="3" class="text-right">ISV:</th>
                            <td class="text-right"><?php
                          
                        
                        //  $ISV11 +=  $subtotal * ($_SESSION['arrCarrito'][$_SESSION['contador']]['Porcentaje_ISV'] );
                          $_SESSION['contador'] += 1 ;
                              echo   SMONEY . ' ' . formatMoney( 0 ) ?></td>
                          
                          </tr>
                          <tr >
                            <th colspan="3" class="text-right">Total:</th>
                            <td class="text-right form-group" id="idtotal" name="idtotal"  ><?php echo SMONEY . ' ' . formatMoney((0 + $subtotal) - 0);
                              $_SESSION['totalcompra1'] = (0+ $subtotal - 0); 

                            ?></td>
                            
                          </tr>
                        </tfoot>

                      </table>
                    </div>
                  </div>


                <?php } ?>
                <div class="row">
         
              <div class="form-group col-md-6" style="max-width: 300px">
                <button id="btnActionForm" class="btn btn-primary" type="" onclick="EnviarPedido()"><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" id="boton" type="button" data-dismiss="modal">Cerrar</button>

             
              </div>
                </div>
              

              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
