<!-- Modal de nuevo producto -->
<div class="modal fade" id="modalFormPromocionesP" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header headerRegister  bg-primary text-white">
        <h5 class="modal-title" id="titleModal">Agregar productos a las promociones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formPromocionesP" name="formPromocionesP" class="form-horizontal">
        <input type="hidden" id="idpedido1" name="idpedido1" value="" required="">
          <input type="hidden" id="idProducto" name="idProducto" value="">
          <input type="hidden" id="foto_actual" name="foto_actual" value="">
          <input type="hidden" id="foto_remove" name="foto_remove" value="0">
          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

          <div class="col-md-8">

          </div>

          <div class="col-md-4">
            <!--codigo de barra--->

          </div>

          <div class="form-row">

            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="listCategoria">Promocion <span class="required">*</span></label>
              <select class="form-control selectpicker" data-live-search="true" id="listCategoria" name="listCategoria" required=""></select>
            </div>
       
          </div>
          <div class="form-row">
            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="selectProductos" onclick="fntgetPrecio()">Productos</label>
              <select name="selectProductos" id="selectProductos" class="form-control selectpicker classs" data-live-search="true" required="" onclick="fntgetPrecio()" default="selecc" value="">
                <option>--seleccione--</option>
              </select>
            </div>

            <div class="form-group col-md-6" style="max-width: 100px">
              <label for="listStatus">Cantidad</label>
              <input class="form-control" id="txtCantidad" name="txtCantidad" type="text" placeholder="Cantidad" onkeypress="return solonumero(event);" maxlength="8" required="">

              </select>
            </div>

            <div class="form-group col-md-6" style="max-width: 300px">
              <label for="listStatus" class="notblock">Agregar</label>
              <br>
              <button onclick="agregarProductos()" id="btnAgregar" name="btnAgregar" class="btn btn-primary" style="padding-top: 1px;"><i class="fa fa-cart-plus" style="max-width: 2px; font-size: 40px; margin-right: 64px;" aria-hidden="true"></i>Agregar productos</button>&nbsp;&nbsp;&nbsp;
            </div>

          </div>
          <!--PODER VER LA CLAVE NUEVO USUARIO-->

          
            <div class="form-group col-md-6" id="tbldiv">
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
                      <table class="table table-striped" id="tableProductos">
                        <thead>
                          <tr>
                            <th>Productos</th>
                            <th class="text-right">Descripcion</th>
                            <th class="text-center">Cantidad</th>
                    
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
                              $ISV11 += $producto['Porcentaje_ISV'] *  ($producto['cantidad'] * $producto['precio']) ;
                       
                             
                             
                          ?>
                              <tr>
                                <td><?= $producto['producto'] ?></td>
                                <td class="text-right"><?= 
                                ($producto['desc']) ?></td>
                                <td class="text-center"><?= $producto['cantidad'] ?></td>
                              
                              </tr>
                          <?php
                            }
                          }

                          ?>
                        </tbody>


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
<!--Validaciones de solo letras-->
<script>
  function SoloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toString();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    especiales = ["8,13,37,39,46"]; //CARACTERES DE LA TABLA ASCII

    tecla_especial = false
    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      //alert("Ingresar solo letras")
      return false;
    }
  }
</script>

<!--Validaciones de solo letras mayusculas-->
<script type="text/javascript">
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>

<!--Solo numeros-->
<script type="text/javascript">
  function solonumero(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) return true;
    else if (tecla == 0 || tecla == 9) return true;
    // patron =/[0-9\s]/;// -> solo letras
    patron = /[0-9\s]/; // -> solo numeros
    te = String.fromCharCode(tecla);
    return patron.test(te);
  }
</script>