<?php 
    headerAdmin($data); 
    getModal('modalEstado_pedidos',$data);//cambiar datos en modalEstado_pedidos
?>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-box-tissue"></i> <?= $data['page_title'] ?>
            
              <button class="btn btn-primary" type="button" onclick="openModal();" > Nuevo</button>
             
              </button>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/estado_pedidos"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableEstado_pedidos">
                    <button class="btn btn-danger" type="button"   onclick="fntPDF()"  ><a style="color:white;" > PDF</a></button>
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Estado</th>
                          <th>Descripcion</th>
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