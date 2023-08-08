<?php 
    headerAdmin($data); 
    getModal('modalProveedores',$data);//cambiar datos en modalProveedores
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
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/proveedores"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableProveedores">
                    <button class="btn btn-danger" type="button"   onclick="fntPDF()"  ><a style="color:white;" > PDF</a></button>
                      <thead>
                        <tr>
                          <th>Id_Proveedor</th>
                          <th>Nombre_Proveedor</th>
                          <th>RTN_Proveedor</th>
                          <th>Telefono_Proveedor</th>
                          <th>Correo_Proveedor</th>
                          <th>Direccion_Proveedor</th>
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
