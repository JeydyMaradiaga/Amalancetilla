<!-- Modal -->
<div class="modal fade" id="ModalPromociones" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Actualizar Promocion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formParametros" name="formParametros" class="form-horizontal">
              <input type="hidden" id="idpromocion" name="idpromocion" value="">

              <p class="text-primary" id="letra">Todos los campos son obligatorios.</p> <br>

              <div class="form-row">

                <div class="form-group col-md-6">
                  <label for="txtNombrePromocion" id="letra">Nombre</label>
                  <input type="text" class="form-control valid validText" id="txtNombrePromocion" name="txtNombrePromocion" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="listRolid" id="letra">Producto</label>
                  <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="txtNombreParametro" id="letra">Descripcion</label>
                  <input type="text" class="form-control valid validText" id="txtDescripcion" name="txtDescripcion" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtValor" id="letra">Valor de la promocion</label>
                  <input type="text" class="form-control valid validText" id="txtValor" name="txtValor" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="listStatus2">Estado <span class="required">*</span></label>
                  <select class="form-control " id="listStatus2" name="listStatus2" required="">
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                  </select>
                </div>
              </div>

              <div class="form-row">

                <div class="form-group col-md-6">
                  <label for="txtFecha1" id="letra">Fecha de inicio</label>
                  <!--onkeypress="return controlTag(event);"-->
                  <input type="date" class="form-control valid validNumber" id="txtFecha1" name="txtFecha1" required="">
                </div>

                <div class="form-group col-md-6">
                  <label for="txtFecha2" id="letra">Fecha final</label>
                  <input type="date" class="form-control" id="txtFecha2" name="txtFecha2" required="" value="">
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