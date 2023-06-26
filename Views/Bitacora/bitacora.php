<?php 
    headerAdmin($data); 
?>
    <div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-book"></i> <?= $data['page_title'] ?>
              
                
            
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/bitacora"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
      <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableBitacora">
                    <button class="btn btn-danger" type="button"  target="_blanck" ><a style="color:white;" href="<?= base_url(); ?>/Bitacora/getBitacoraR" target="_blanck"> PDF</a></button>
                      <thead>
                        <tr>
                          <th>Id Bitacora</th>
                          <th>Id Usuario</th>
                          <th>Id Objeto</th>
                          <th>Accion</th>
                          <th>Descripcion</th>
                          <th>Fecha</th>
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