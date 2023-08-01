<?php 
    headerAdmin($data); 
    //getModal('modalMovimientos',$data);//cambiar nombre a modalMovimientos
?>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-box-tissue"></i> <?= $data['page_title'] ?>
            
              
              <a class="btn btn-primary" href="<?= base_url(); ?>/cardexs">Cardex</a>
             
              </button>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/inventarios"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableInventarios">
                    <button class="btn btn-danger" type="button"   onclick="fntPDF()"  ><a style="color:white;" > PDF</a></button>
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Id P</th>
                          <th>Nombre Producto</th>
                          <th>Descripcion</th>
                          <th>Precio</th>
                          <th>Cant. Existente</th>
                          <th>Cant. Minima</th>
                          <th>Cant. Maxima</th>
                          <th>Alerta</th>
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