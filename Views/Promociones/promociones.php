<?php headerAdmin($data); 
 getModal('modalPromociones',$data);
 getModal('modalPromocionesP',$data);?>
 
<main class="app-content">
  <div class="app-title">
    <div>
      <!-- Button trigger modal -->

      <h1><i class="fa fa-dashboard"></i> <?= $data['page_title'];  ?>
     
              
        <button class="btn btn-primary" type="button" onclick="openModal();" > Nuevo</button>
       
        </button>

        <style>
          #letra {
            font-size: 18px;
          }

          #letra2 {
            font-size: 16px;
          }
        </style>


    </div>
    <!--final del modal de usuario-->

    <!--Codigo de la tabla mostrar--->
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">Promociones registradas </div> <br>
        <button  class="btn btn-primary" type="button" onclick="fntnew();" >Agregar Productos a la promocion </button>
       
       </button>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <div id="sampleTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
              <div class="row">
                <div class="col-sm-12">
                  <table class="table table-hover table-bordered dataTable no-footer" role="grid" aria-describedby="sampleTable_info" id="tablepromociones">

                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5px;">Id Promocion</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 40px;">Producto</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Valor</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 100.375px;">Nombre</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 100.375px;">Descripcion</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Estado</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Fecha inicio</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Fecha final</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Cant promocion</th>

                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 118.234px;">Acciones</th>
                        
                        

                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-5">
                  <div class="dataTables_info" id="sampleTable_info" role="status" aria-live="polite"></div>
                </div>


              </div>
            </div>
          </div>
          <!--Final del codigo de la tabla mostrar--->

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