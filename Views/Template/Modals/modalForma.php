<!-- Modal -->  
<div class="modal fade" id="ModalForma" tabindex="-1" role="dialog" aria-hidden="true"> 
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Forma de Pago</h5>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
            <form id="formForma" name="formForma" class="form-horizontal">  
            <input type="hidden" id="idForma" name="idForma" value="">

                  <p class="text-primary" id="letra">Todos los campos son obligatorios.</p> <br>

                  <div class="form-row">

                    <div class="form-group col-md-6">
                      <label for="txtNombreParametro" id="letra">Nombre</label>
                      <input type="text" oninput="convertirMayusculasYPermitirLetrasYEspacios(this)" class="form-control valid validText" id="txtNombre" name="txtNombre"  required="">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="txtNombreParametro" id="letra">Descripción</label>
                      <input type="text" oninput="convertirMayusculasYPermitirLetrasYEspacios(this)" class="form-control valid validText" id="txtDescripcion" name="txtDescripcion"  required="">
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

<script>
    function convertirMayusculasYPermitirLetrasYEspacios(input) {
        // Convertir a mayúsculas
        input.value = input.value.toUpperCase();
        // Permitir solo letras y espacios
        input.value = input.value.replace(/[^A-Z\s]/g, '');
    }
</script>




