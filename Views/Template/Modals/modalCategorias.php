<!-- Modal -->
<head>
    <title>Título de la página</title>
    <style>
      #divBarCode {
        display: none;
      }
      #containerGallery {
        display: none;
      }
    </style>
    
  </head>
<div class="modal fade" id="modalFormCategorias" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister  bg-primary text-white">
        <h5 class="modal-title" id="titleModal">Nueva Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formCategoria" name="formCategoria" class="form-horizontal">
              <input type="hidden" id="idCategoria" name="idCategoria" value="">
              <input type="hidden" id="foto_actual" name="foto_actual" value="">
              <input type="hidden" id="foto_remove" name="foto_remove" value="0">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Nombre <span class="required">*</span></label>
                      <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre Categoría"onkeyup="mayus(this)" onkeypress="return SoloLetras(event);" required="">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Descripción <span class="required">*</span></label>
                      <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción Categoría"onkeyup="mayus(this)" onkeypress="return SoloLetras(event);" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">Estado <span class="required">*</span></label>
                        <select class="form-control " id="listStatus" name="listStatus" required="">
                          <option value="1">Activo</option>
                          <option value="2">Inactivo</option>
                        </select>
                    </div>  
                </div>
                <div class="col-md-6" id="containerGallery">
                    <div class="photo">
                        <label for="foto">Foto (570x380)</label>
                        <div class="prevPhoto">
                          <span class="delPhoto notBlock">X</span>
                          <label for="foto"></label>
                          <div>
                            <img id="img" src="<?= media(); ?>/images/uploads/portada_categoria.png">
                          </div>
                        </div>
                        <div class="upimg">
                          <input type="file" name="foto" id="foto">
                        </div>
                        <div id="form_alert"></div>
                    </div>
                </div>
              </div>
              
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
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


