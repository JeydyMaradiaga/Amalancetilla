<!-- Modal -->
<div class="modal fade" id="ModalPromociones" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Promocion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formPromociones" name="formPromociones" class="form-horizontal">
              <input type="hidden" id="idpromocion" name="idpromocion" value="">

              <p class="text-primary" id="letra">Todos los campos son obligatorios.</p> <br>

              <div class="form-row">

                <div class="form-group col-md-6">
                  <label for="txtNombreParametro" id="letra">Nombre</label>
                  <input type="text" class="form-control valid validText" id="txtNombrePromocion" name="txtNombrePromocion" required="" oninput="validateInput(this)">
                </div>
                <div class="form-group col-md-6">
                  <label for="listRolid" id="letra">Producto</label>
                  <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="txtDescripcion" id="letra">Descripción</label>
                  <input type="text" class="form-control valid validText" id="txtDescripcion" name="txtDescripcion" required="" oninput="validateInput(this)">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtValor" id="letra">Valor de la promoción</label>
                  <input type="text" class="form-control valid validText" id="txtValor" name="txtValor" required="" oninput="validateNumbers(this)">
                </div>
                <div class="form-group col-md-6">
                  <label for="listStatus2">Estado <span class="required">*</span></label>
                  <select class="form-control " id="listStatus2" name="listStatus2" required="">
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="txtCant" id="letra">Cant de la promoción</label>
                  <input type="text" class="form-control valid validText" id="txtCant" name="txtCant" required="" oninput="validateNumbers(this)">
                </div>
              </div>

              <div class="form-row">

                <div class="form-group col-md-6">
                  <label for="txtFecha1" id="letra">Fecha de inicio</label>
                  <!--onkeypress="return controlTag(event);"-->
                  <input type="date" class="form-control valid validNumber" id="txtFecha1" name="txtFecha1" required="" oninput="validateDate(this)">
                  <div class="invalid-feedback" id="dateError">La fecha no puede ser anterior a la actual.</div>
                </div>

                <div class="form-group col-md-6">
                  <label for="txtFecha2" id="letra">Fecha final</label>
                  <input type="date" class="form-control" id="txtFecha2" name="txtFecha2" required="" oninput="validateDateRange(this)">
                  <div class="invalid-feedback" id="dateRangeError">La fecha final no puede ser anterior o igual a la fecha de inicio.</div>
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





<script>
function validateDate(input) {
    var selectedDate = new Date(input.value);
    var currentDate = new Date();

    // Configuramos la hora a las 00:00:00 para comparar solo las fechas.
    currentDate.setHours(0, 0, 0, 0);

    if (selectedDate < currentDate) {
        document.getElementById('dateError').style.display = 'block';
        input.setCustomValidity('La fecha no puede ser anterior a la actual.');
    } else {
        document.getElementById('dateError').style.display = 'none';
        input.setCustomValidity('');
    }
}

function validateDateRange(input) {
    var startDate = new Date(document.getElementById('txtFecha1').value);
    var endDate = new Date(input.value);

    // Agregamos un día a la fecha de inicio
    startDate.setDate(startDate.getDate() + 1);

    if (endDate < startDate) {
        document.getElementById('dateRangeError').style.display = 'block';
        input.setCustomValidity('La fecha final no puede ser anterior a la fecha de inicio.');
    } else {
        document.getElementById('dateRangeError').style.display = 'none';
        input.setCustomValidity('');
    }
}
</script>


<script>
function validateInput(input) {
    var value = input.value;
    var validChars = /^[A-Za-z0-9\s]*$/; // Incluye espacio en blanco

    // Convertir todas las letras a mayúsculas
    input.value = value.toUpperCase();

    if (!validChars.test(input.value)) {
        // Eliminar caracteres no permitidos
        input.value = input.value.replace(/[^A-Z0-9\s]/g, '');
    }
}
</script>

<script>
function validateNumbers(input) {
    var value = input.value;

    // Eliminar caracteres no numéricos
    input.value = value.replace(/\D/g, '');
}
</script>
