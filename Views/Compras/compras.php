<?php 
    headerAdmin($data); 
    getModal('modalCompra',$data);

?>
    <div id="divModal"></div>
    <main class="app-content">
      <div class="app-title">
        <div>
    
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
            <?php if($_SESSION['permisosMod']['Permiso_Insert']||  $_SESSION['userData']['id_usuario'] == 1){ ?>
                <button class="btn btn-primary" type="button" onclick="fntnew();" >Nuevo</button>
                <?php } ?> 
              </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/compras"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableCompras">
                       <button class="btn btn-danger" type="button"  target="_blanck" onclick="fntPDF()"  ><a style="color:white;"    > PDF</a></button>
                   
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre del proveedor</th>
                          <th>Realizó la compra</th>
                          <th>Fecha</th>
                          <th>Total</th>
                          <th>Estado</th>
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
    