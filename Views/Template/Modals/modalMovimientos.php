<!-- Modal --> 
<div class="modal fade" id="ModalMovimientos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Movimiento de inventario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
            <form id="formMovimientos" name="formMovimientos" class="form-horizontal">
            <input type="hidden" id="idMovimiento" name="idMovimiento" value="">

                  <p class="text-primary" id="letra">Todos los campos son obligatorios.</p> <br>

                  <div class="form-row">

                    <div class="form-group col-md-6">
                      <label for="txtNombreParametro" id="letra">Nombre</label>
                      <input type="text" onkeyup="mayus(this)" class="form-control valid validText" id="txtNombreMovimiento" name="txtNombreMovimiento"  required="">
                    </div>
                  </div>

                  <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-primary" type="submit"><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" id="boton" type="button" data-dismiss="modal">Cerrar</button>
                  </div>
                </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<!--Validaciones de solo letras mayusculas-->
<script type="text/javascript">
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>

