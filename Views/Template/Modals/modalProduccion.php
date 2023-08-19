<!-- Modal -->

<div class="modal fade" id="modalFormProduccion" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 800px">
    <div class="modal-content">
      <div class="modal-header headerRegister bg-primary text-white">
        <h5 class="modal-title" id="titleModal">Nueva Produccion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Agrega el mensaje de error aquí -->
      <div class="modal-body">
      <?php if (isset($mensajeError)) { ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $mensajeError; ?>
          </div>
        <?php } ?>
        <!-- Resto del contenido del modal -->
        <form id="formProducciones" name="formProducciones" class="form-horizontal">
          <input type="hidden" id="idProduccion" name="idProduccion" value="">
          <p class="text-primary" id="letra">Todos los campos son obligatorios.</p> <br>

          <div class="form-row">

              <input type="hidden" id="idproduccion1" name="idproduccion1" value="" required="">
       
            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="txtFechavencimiento" id="letra">Fecha </label>
              <input type="date" class="form-control valid validFechavencimiento" id="txtFechavencimiento" name="txtFechavencimiento" readonly required="" value="<?php echo (date("Y-m-d")); ?>">
            </div>
          </div>

          <div class="form-row1">
            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="seleccionarUsuario">Usuario</label>
              <select name="seleccionarUsuario" id="seleccionarUsuario" class="form-control selectpicker  clase2 classs2" data-live-search="true" required="" value="">
              </select>
              <style>

                  .form-row1 {

                    display: none;

                  }

              </style>
            </div>
            
            
          </div>
          <div class="form-row">
            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="selectProductos" onclick="fntgetPrecio()">Producto a crear</label>
              <select name="selectProductos" id="selectProductos" class="form-control selectpicker classs" data-live-search="true" required="" onclick="fntgetPrecio()" default="selecc" value="">
                <option>--seleccione--</option> 
              </select>
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
          <div class="form-row">
            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="selectProductos2" onclick="fntgetPrecio()">Agregar total de insumos utilizados</label>
              <select name="selectProductos2" id="selectProductos2" class="form-control selectpicker classsPromociones" data-live-search="true" required="" onclick="fntgetPrecio()" default="selecc" value="">
                <option>--seleccione--</option>
              </select>
            </div>
            
            <div class="form-group col-md-6" style="max-width: 100px">
              <label for="listStatus2">Cantidad</label>
              <input class="form-control class2" id="txtCantidad2" name="txtCantidad2" type="number" min="1" max="50" step="1" placeholder="" require>

              </select>
            </div>

            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="listStatus" class="notblock">Agregar</label>
              <br>
              <button onclick="agregarInsumos()" id="btnAgregar" name="btnAgregar" class="btn btn-success" style="padding-top: 1px;"><i class="fa fa-cart-plus" style="max-width: 2px; font-size: 40px; margin-right: 64px;" aria-hidden="true"></i>Agregar Insumo</button>&nbsp;&nbsp;&nbsp;
            </div>

          </div>
          <div class="form-group col-md-12" id="tbldiv">
    <?php
    if (empty($_SESSION['arrCarrito'])) {
    ?>

    <?php } else {
      $detalle = $_SESSION['arrCarrito'];
    ?>
      <!--PODER VER LA CLAVE NUEVO USUARIO-->
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="col-12 table-responsive">
              <table class="table table-striped" id="tableProductos" style="width: 100%;">
                <thead>
                  <tr>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Cantidad Elaborada</th>
                    <th class="text-center">Cantidad Consumida</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $contador = 0;
                  if (count($detalle) > 0) {
                    foreach ($detalle as $producto) {
                  ?>
                      <tr>
                        <td><?= $producto['producto'] ?></td>
                        <?php
                        if ($producto['tipo'] == 1) {
                        ?>
                          <td class="text-center"><?= $producto['cantidad'] ?></td>
                          <td class="text-center"></td>
                        <?php
                        } else {
                        ?>
                          <td class="text-center"></td>
                          <td class="text-center"><?= $producto['cantidad'] ?></td>
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

      </form>
    </div>
  </div>
</div>
</div
