<!-- Modal -->
<div class="modal fade" id="modalFormPedido2" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="titleModal">Actualizar Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formUpdatePedido" name="formUpdatePedido" class="form-horizontal">
         
              <input type="hidden" id="idpedido" name="idpedido" value="<?= $data['orden'][0]['Id_Pedido'] ?>" required="">
              <table class="table table-bordered">
                  <tbody>
                      <tr>
                          <td width="210">No. Pedido</td>
                          <td><?= $data['orden'][0]['Id_Pedido'] ?></td>
                      </tr>
                      <tr>
                          <td>Cliente:</td>
                          <td><?= $data['cliente'][0]['Nombre'].' '.$data['cliente'][0]['Apellidos'] ?></td>
                      </tr>
                      <tr>
                          <td>Importe total:</td>
                          <td><?= SMONEY.' '.$data['orden'][0]['Total'] ?></td>
                      </tr>
                  
                      <tr>
                          <td>Tipo pago:</td>
                          <td>
                        
                              <select name="listTipopago" id="listTipopago" class="form-control " data-live-search="true" required="">
                                  <?php 
                                    for ($i=0; $i < count($data['TipoPago']) ; $i++) {
                                        $selected = "";
                                        if( $data['TipoPago'][$i]['Id_Forma_Pago'] == $data['orden'][0]['TipoPago']){
                                            $selected = " selected ";
                                        }
                                   ?>
                                    <option value="<?= $data['TipoPago'][$i]['Id_Forma_Pago'] ?>" <?= $selected ?> ><?= $data['TipoPago'][$i]['Nombre'] ?></option>
                                <?php } ?>
                              </select>
                         
                          </td>
                      </tr>
                      <tr>
                          <td>Estado:</td>
                          <td>
                              <select name="listEstado" id="listEstado" class="form-control selectpicker" data-live-search="true" required="">
                                  <?php 
                                    for ($i=0; $i < count(STATUS) ; $i++) {
                                        $selected = "";
                                        if( STATUS[$i] == $data['orden'][0]['Estado']){
                                            $selected = " selected ";
                                        }
                                   ?>
                                   <option value="<?= STATUS[$i] ?>" <?= $selected ?> ><?= STATUS[$i] ?></option>
                               <?php } ?>
                              </select>
                          </td>
                      </tr>
                  </tbody>
              </table>
              <div class="tile-footer">
                <button id="" class="btn btn-info" type="" onclick="fntUpdateInfo()" ><span>Actualizar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
            </div>
              
            </form>
      </div>
    </div>
  </div>
</div>