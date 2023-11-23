<!-- Modal -->
<div class="modal fade" id="modalFormRol" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formRol" name="formRol">
                <input type="hidden" id="idRol" name="idRol" value="">
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del rol" required="" onkeyup="mayus(this)" onkeypress="return SoloLetras(event);">
                </div>
                <div class="form-group">
                  <label class="control-label">Descripción</label>
                  <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción del rol" required="" onkeyup="mayus(this)" onkeypress="return SoloLetras(event);">></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Estado</label>
                    <select class="form-control" id="listStatus" name="listStatus" required="">
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    </select>
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

