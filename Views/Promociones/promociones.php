<?php headerAdmin($data); 
 getModal('modalPromociones',$data);
 //getModal('modalPromocionesP',$data);?>
<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-box"></i> <?= $data['page_title'] ?>
            <?php //if($_SESSION['permisosMod']['Permiso_Insert']){ ?>
              
              <button class="btn btn-primary" type="button" onclick="openModal();" > Nuevo</button>
             
                    <?php //} ?> 
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/promociones"><?= $data['page_title'] ?></a></li>
        </ul>
      </div> 
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablepromociones">
                    <button class="btn btn-danger" type="button" onclick="fntPDF()"  ><a style="color:white;" > PDF</a></button>
                    <br>  
                      <thead>
                      <br>  
                        <tr>
                          <th>#</th>
                          <th>Producto</th>
                          <th>Valor</th>
                          <th>Nombre</th>
                          <th>Descripcion</th>
                          <th>Estado</th>
                          <th>Fecha inicio</th>
                          <th>Fecha final</th>
                          <th>Cantidad en promocion</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main> 

  




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


<!--Creacion de clave segura por medio de Jrquey-->






<?php footerAdmin($data); ?>