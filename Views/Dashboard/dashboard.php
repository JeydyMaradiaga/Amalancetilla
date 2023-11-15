<?php headerAdmin($data); ?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $data['page_title'] ?></h1>
      <?php //dep($_SESSION['userData']); 
      ?>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">PAGINA PRINCIPAL</a></li>

    </ul>
  </div>
  <div class="row">
    <div class="btn btn-success coloured-icon" style="width: 340px; max-width: 100%;"><i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <h4>
          <a id="demoNotify" style="color: #fff;" href="clientes">CLIENTES</a>
        </h4>
        <p><b>
            <h4></h4>
          </b></p>
      </div>
    </div>
    <div class="btn btn-success coloured-icon"><i class="icon fa fa-shopping-bag" style="width: 340px;"></i>
      <div class="info">
        <h4>
          <a id="demoNotify" style="color: #fff;" href="productos">PRODUCTOS</a>
        </h4>
        <p><b></b></p>
        <h4><b></b></h4>
        <p></p>
      </div>
    </div>
    <div class="btn btn-success coloured-icon"><i class="icon fa fa-truck" style="width: 340px;"></i>
      <div class="info">
        <h4>
          <a id="demoNotify" style="color: #fff;" href="pedidos">PEDIDOS</a>
        </h4>
        <p><b></b></p>
        <h4><b></b></h4>
        <p></p>
      </div>
    </div>
    <!-- <div class="btn btn-success coloured-icon"><i class="icon fa fa-shopping-basket" style="width: 150px;"></i>
      <div class="info">
        <h4>
          <a id="demoNotify" style="color: #fff;" href="home">Sitio Web</a>
        </h4>
        <p><b></b></p>
        <h4><b></b></h4>
        <p></p>
      </div>
    </div> -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <div id="sampleTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
              <div class="row">
                <div class="col-sm-12">
                  <H4>ULTIMOS PEDIDOS</H4>
                  <table class="table table-hover table-bordered dataTable no-footer" role="grid" aria-describedby="sampleTable_info" id="tableUP" name="tableUP">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">N.Pedido</th>
                        <th class="sorting_asc" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nombre Cliente</th>
                        <th class="sorting_asc" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Estado</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 50px;">Total</th>

                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Fecha</th>
                        <div class="modal fade" id="modalFormUsuarioActualizar" name="modalFormUsuarioActualizar" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header headerRegister bg-primary text-white">
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
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <div id="sampleTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                  <div class="row">
                    <div class="col-sm-12">
                    <H4>PEDIDOS PENDIENTES</H4>
                      <table class="table table-hover table-bordered dataTable no-footer" role="grid" aria-describedby="sampleTable_info" id="tablePP" name="tablePP">
                        <thead>
                          <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Id Pedido</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nombre Cliente</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Estado</th>
                            <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 50px;">Total</th>

                            <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Fecha</th>
                            <div class="modal fade" id="modalFormUsuarioActualizar" name="modalFormUsuarioActualizar" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header headerRegister bg-primary text-white">
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
            </div>
          </div>

          <!--Final del codigo de la tabla mostrar--->
</main>
<?php footerAdmin($data); ?>
  