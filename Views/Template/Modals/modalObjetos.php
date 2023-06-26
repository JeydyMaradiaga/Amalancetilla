<!-- Modal -->
<div class="modal fade" id="ModalObjetos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Objetos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
            <form id="formObjetos" name="formObjetos" class="form-horizontal">
            <input type="hidden" id="idObjeto" name="idObjeto" value="">

                  <p class="text-primary" id="letra">Todos los campos son obligatorios.</p> <br>

                  <div class="form-row">

                    <div class="form-group col-md-6">
                      <label for="txtNombreParametro" id="letra">Nombre Objeto</label>
                      <input type="text" class="form-control valid validText" id="txtNombreParametro" name="txtNombreParametro" onkeyup="mayus(this)" onkeypress="return SoloLetras(event);" required="">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="txtNombreParametro" id="letra">Descripcion</label>
                      <input type="text" class="form-control valid validText" id="txtDescripcion" name="txtDescripcion"  required="" onkeyup="mayus(this)" onkeypress="return SoloLetras(event);" required="">
                    </div>
                  </div>

                  <div class="form-row">

         

                    <div class="form-group col-md-6">
                      <label for="txtCreacionParametro" id="letra">Fecha de creacion</label>
                      <input type="text" class="form-control" id="txtCreacionParametro" name="txtCreacionParametro" readonly required="" value="<?php echo(date("Y-m-d"));?>">
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


