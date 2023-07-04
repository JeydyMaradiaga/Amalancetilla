<?php
headerAdmin($data);
getModal('modalUsuarios',$data);
?>
                               <style>
                                        #divBarCode {
                                          display: none;
                                        }
                                        #txtcontrasenaM {
                                          display: none;
                                        }
                                        #viewPasswordee2 {
                                          display: none;
                                        }
                                      </style>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>

                <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo</button>

            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableUsuarios">
                        <button class="btn btn-danger" type="button"  target="_blanck" ><a style="color:white;" href="<?= base_url(); ?>/Usuarios/getUsuarioR" target="_blanck"> PDF</a></button>
                            <thead>
                                <tr>
                                <th class="sorting_asc" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5px;">Id Usuario</th>
                                      <th class="sorting_asc" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5px;">Rol</th>
                                      <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 50px;">Nombre</th>
                                      <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Telefono</th>
                                      <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Direccion</th>
                                      <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Correo Electronico</th>
                                      <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Estado</th>
                                      <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Fecha Ult. conexion</th>
                                      <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Fecha vencimiento</th>
                                      <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 118.234px;">Acciones</th>
                                      
                                      
                                      <div class="modal fade" id="modalFormUsuarioActualizar" name="modalFormUsuarioActualizar" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                            <div class="modal-header headerRegister bg-primary text-white">
                                              <h5 class="modal-title" id="titleModal2">Actualizar Usuarios</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form id="formActualizarUsuario" name="formActualizarUsuario" class="form-horizontal">
                                                <input type="hidden" id="idUsuarioM" name="idUsuarioM" value="">
                                                <div class="form-row">
                                                  <div class="form-group col-md-6">
                                                    <label for="listRolid2" id="letra">Rol usuario</label>
                                                    <select class="form-control" data-live-search="true" id="listRolid2" name="listRolid2" required>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="form-row">
                                                  <div class="form-group col-md-6">
                                                    <label for="txtNombre" id="letra">Nombre</label>
                                                    <input type="text" class="form-control valid validText" id="txtNombreM" name="txtNombreM" onkeyup="mayus(this)" onkeypress="return SoloLetras(event);" required="">


                                                  </div>

                                                  <div class="form-group col-md-6">
                                                   <!--  <label for="txtcontrasenaM" id="letra">Contraseña</label>  -->
                                                    <input type="password" class="form-control valid validText" id="txtcontrasenaM" name="txtcontrasenaM">
                                                    <!--Creacion de aviso de clave segura-->
                                                    <label>
                                                   <!--    <input type="checkbox" id="viewPasswordee2"><span class="label-text">Mostrar contraseña</span> -->
                                                    </label> <br>
                                                   <!--  <FONT color="red" SIZE=2>*Debe tener minimo caracteres, numeros, mayusculas minusculas.</FONT>-->
                                                  </div>
                                                  <!--PODER VER LA CLAVE NUEVO USUARIO-->
                                                  <!--PODER VER LA CLAVE NUEVO USUARIO-->
                                                </div>
                                                <div class="form-row">

                                                  <div class="form-group col-md-6">
                                                    <label for="txtTelefono" id="letra">Teléfono</label>
                                                    <!--onkeypress="return controlTag(event);"-->
                                                    <input type="text" class="form-control valid validNumber" id="txtTelefonoM" name="txtTelefonoM" onkeypress="return solonumero(event);" maxlength="8" required="">
                                                  </div>
                                                  <div class="form-group col-md-6">
                                                    <label for="txtDireccion" id="letra">Dirección</label>
                                                    <input type="text" class="form-control valid validText" id="txtDireccionM" name="txtDireccionM" onkeyup="mayus(this)" required="">
                                                  </div>

                                                  <div class="form-group col-md-6">
                                                    <label for="txtEmail" id="letra">Email</label>
                                                    <input type="email" class="form-control valid validEmail" id="txtEmailM" name="txtEmailM" onkeyUp="this.value=this.value.toLowerCase();" required="">
                                                  </div>
                                                </div>
                                                <div class="form-row">
                                          
                                                  <div class="form-group col-md-6">
                                                    <label for="listStatus2" id="letra">Estado</label>
                                                   
                                                    <select class="form-control" data-live-search="true" id="listStatus2" name="listStatus2" required>
                                                    </select>
                                                  </div>
                                                  <div class="form-group col-md-6">
                                                    <label for="txtFechavencimiento" id="letra">Fecha de vencimiento</label>
                                                    <input type="date" class="form-control valid validFechavencimiento" id="txtFechavencimientoM" name="txtFechavencimientoM" readonly required="">
                                                  </div>

                                                </div>

                                                <div class="tile-footer">
                                                  <button id="btnActionForm" class="btn btn-primary" type="submit"><span id="btnTextM">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                                                  <button class="btn btn-danger" id="boton" type="button" data-dismiss="modal">Cerrar</button>
                                                </div>
                                              </form>
                                            </div>

                                   
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