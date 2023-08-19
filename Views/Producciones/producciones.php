<?php 
    headerAdmin($data); 
    getModal('modalProduccion',$data);

?>
    <div id="divModal"></div>
    <main class="app-content">
      <div class="app-title">
        <div>
    
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
                <button class="btn btn-primary" type="button" onclick="openModal();" >Nuevo</button>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/producciones"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableProducciones">
                       <button class="btn btn-danger" type="button"  target="_blanck" onclick="fntPDF()"  ><a style="color:white;"    > PDF</a></button>
                   
                      <thead>
                        <tr>
                          <th>N.Produccion</th>
                          <th>Fecha</th>
                          <th>Estado de produccion</th>
                          <th>Usuario</th>
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
    