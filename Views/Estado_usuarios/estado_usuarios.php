<?php 
    headerAdmin($data); 
    getModal('modalEstado_usuarios',$data);//Se cambio el nombre segun la tabla
?>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-box-tissue"></i> <?= $data['page_title'] ?>
            <?php if($_SESSION['permisosMod']['Permiso_Insert']||  $_SESSION['userData']['id_usuario'] == 1){ ?>
              <button class="btn btn-primary" type="button" onclick="openModal();" > Nuevo</button>  
              </button>
              <?php } ?> 
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/estado_usuarios"><?= $data['page_title'] ?></a></li> 
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableEstado_usuarios">
                    <button class="btn btn-danger" type="button"   onclick="fntPDF()"  ><a style="color:white;" > PDF</a></button>
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre de estado</th>
                          <th>Fecha de creación</th>
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
 
<?php footerAdmin($data); ?>