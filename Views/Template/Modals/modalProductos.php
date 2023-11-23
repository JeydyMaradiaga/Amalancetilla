<head>
    <title>Título de la página</title>
    <style>

      #containerGallery {
        display: none;
      }
    </style>
    
  </head>
<!-- Modal de nuevo producto --> 
<div class="modal fade" id="modalFormProductos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" >
    <div class="modal-content">
      <div class="modal-header headerRegister  bg-primary text-white">
        <h5 class="modal-title" id="titleModal">Nuevo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formProductos" name="formProductos" class="form-horizontal">
              <input type="hidden" id="idProducto" name="idProducto" value="">
              <input type="hidden" id="foto_actual" name="foto_actual" value="">
              <input type="hidden" id="foto_remove" name="foto_remove" value="0">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
              <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                      <label class="control-label">Nombre Producto <span class="required">*</span></label>
                      <input class="form-control" id="txtNombre" name="txtNombre" type="text"  onkeyup="mayus(this)"  required="">
                    </div>
                   
                    <div class="form-group">
                      <label class="control-label">Descripción Producto</label>
                      <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" onkeyup="mayus(this)" onkeypress="return SoloLetras(event);" required=""></textarea>
                    </div>
                    
                </div>

                <div class="col-md-4">
                    <!--codigo de barra--->
                    <div class="form-group">
                        <label class="control-label">Código <span class="required">*</span></label>
                        <input class="form-control" id="txtCodigo" name="txtCodigo" type="text" placeholder="Código" onkeypress="return solonumero(event);" maxlength="8" required="">
                        <br>
                        <div id="divBarCode" class="notblock textcenter">
                            <div id="printCode">
                                <svg id="barcode"></svg> 
                            </div>
                            <button class="btn btn-success btn-sm" type="button" onClick="fntPrintBarcode('#printCode')"> Imprimir</button>
                        </div>
                        </div>   
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Precio <span class="required">*</span></label>
                            <input class="form-control" onkeypress="return solonumero(event);" id="txtPrecio" name="txtPrecio" type="text" required="">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="listCategoria">Categoría <span class="required">*</span></label>
                            <select class="form-control" data-live-search="true" id="listCategoria" name="listCategoria" required=""></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Cantidad Minima <span class="required">*</span></label>
                            <input class="form-control" id="txtMinima" onkeypress="return solonumero(event);" name="txtMinima" type="text" required="">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="listCategoria">Cantidad Maxima <span class="required">*</span></label>
                            <input class="form-control"  onkeypress="return solonumero(event);" id="txtMaxima" name="txtMaxima" type="text" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="listISV">ISV <span class="required">*</span></label>
                            <select class="form-control" data-live-search="true" id="listISV" name="listISV" required=""></select>
                        </div>
                            <div class="form-group col-md-6">
                        <label for="listStatus2">Estado <span class="required">*</span></label>
                        <select class="form-control " id="listStatus2" name="listStatus2" required="">
                          <option value="1">Activo</option>
                          <option value="2">Inactivo</option>
                        </select>
                    </div>  
                        
                
                      
                        <div class="form-group col-md-6">
                           <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><span id="btnText">Guardar</span></button>
                       </div> 
                       <div class="form-group col-md-6">
                           <button class="btn btn-danger btn-lg btn-block" type="button" data-dismiss="modal">Cerrar</button>
                       </div> 
                    </div> 
                   </div>
              
              
              <div class="tile-footer">
                 <div class=" col-md-8">
                     <div id="containerGallery">
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
                     <hr>
                     <div id="containerImages">
                       <!--  <div id="div24">
                             <div class="prevImage">
                                 <img src="<?= media(); ?>/images/uploads/producto1.jpg">
                             </div>
                             <input type="file" name="foto" id="img1" class="inputUploadfile">
                             <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                             <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')">Eliminar</button>
                         </div>
                         <div id="div24">
                             <div class="prevImage">
                                 <img class="loading" src="<?= media(); ?>/images/loading.svg">
                             </div>
                             <input type="file" name="foto" id="img1" class="inputUploadfile">
                             <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                             <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')">Actualizar</button>
                         </div>  -->
                        
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


