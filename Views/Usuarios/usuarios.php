<?php headerAdmin($data); ?>
<main class="app-content">
  <div class="app-title">
    <div>
      <!-- Button trigger modal -->

      <h1><i class="fa fa-dashboard"></i> <?= $data['page_title'] ?>
      <?php if($_SESSION['permisosMod']['Permiso_Insert'] ||  $_SESSION['userData']['id_usuario'] == 1){ ?>
        <button type="button" class="btn btn-primary" onClick="" data-toggle="modal" data-target="#modalFormUsuario">
           Nuevo 
          
        </button>
        <?php } ?> 
        
        <style>
          #letra {
            font-size: 16px;
          }

          #letra2 {
            font-size: 14px;
          }
        </style>

          
        <style>
            .small-font {
                font-size: 14px;
            }
        </style>
        <!-- Modal de nuevo usuario -->
        <div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header headerRegister bg-primary text-white">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="formUsuario" name="formUsuario" class="form-horizontal">
                  <input type="hidden" id="idUsuario" name="idUsuario" value="">
                  <p class="text-primary" id="letra">Todos los campos son obligatorios.</p> <br>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="listRolid" id="letra">Rol usuario</label>
                      <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                     <label for="txtNombre" id="letra">Nombre</label>
                     <input type="text" placeholder="Ingresa tu nombre " class="form-control valid validText" id="txtNombre" name="txtNombre" onkeyup="mayus(this)" onkeypress="return SoloLetras(event);" required="" oninput="validarNombre(this)">
                    </div>
                  </div>
                  <div class="form-row">


                    <div class="form-group col-md-6">
                      <label for="txtcontrasena" id="letra">Contraseña</label>
                      <!---- required pattern="[A-Z,1-9,a-z,@$!%*?&];"  maxlength="8"    onKeyDown="sinespacio(this);" onkeyup="noespacio(this, event);"--->
                      <input type="password" class="form-control valid validText" id="txtcontrasena" name="txtcontrasena" oninput="validatePasswordLength(this)">

                      <div class="valid-feedback">
                        Es correcto
                      </div>
                      <div class="invalid-feedback">
                      <p class="small-font">La contraseña debe contener 1 carácter especial, 1 minúscula y al menos 8 caractéres</p>
                      </div>
                      <!--Creacion de aviso de clave segura-->
                      <label>
                        <input type="checkbox" id="viewPasswordee" class="label-text mover"><span id="letra2" class="label-text">Mostrar contraseña</span>



                    </div>

                    <div class="form-group col-md-6">
                      <label for="txtcontrasena" id="letra">Confirmar Contraseña</label>
                      <!---- required pattern="[A-Z,1-9,a-z,@$!%*?&];"  maxlength="8"    onKeyDown="sinespacio(this);" onkeyup="noespacio(this, event);"--->
                      <input type="password" class="form-control valid validText" id="txtcontrasenaC" name="txtcontrasenaC" oninput="validatePasswordLength(this)">
                      <!--Creacion de aviso de clave segura-->

                    </div>

                    <!--PODER VER LA CLAVE NUEVO USUARIO-->

                  </div>
                  <div class="form-row">

                    <div class="form-group col-md-6">
                      <label for="txtTelefono" id="letra">Teléfono</label>
                      <!--onkeypress="return controlTag(event);"-->
                      <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" onkeypress="return soloNumero(event);" maxlength="8" required="">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="txtDireccion" id="letra">Dirección</label>
                      <input type="text" class="form-control valid validText" id="txtDireccion" name="txtDireccion" maxlength="100" onkeyup="mayus(this)" required="">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="txtEmail" id="letra">Email</label>
                      <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" onkeyUp="this.value=this.value.toLowerCase();" required="" oninput="validateEmail(this)">
                    </div>
                  </div>
                  <div class="form-row">

                    <div class="form-group col-md-6">
                      <label for="txtidentidad" id="letra">Estado</label>
                      <input type="text" class="form-control valid validNumber" id="txtestado" name="txtestado" value="NUEVO" readonly>

                      <br><br>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="txtFechavencimiento" id="letra">Fecha de vencimiento</label>
                      <input type="date" class="form-control valid validFechavencimiento" id="txtFechavencimiento" name="txtFechavencimiento" readonly required="">
                    </div>

                  </div>

                  <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-primary" type="submit"><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" id="boton" type="button" data-dismiss="modal">Cerrar</button>
                  </div>
                </form>
              </div>
              <!-- Modal de nuevo usuario -->
      </h1>
    </div>
    <!--final del modal de usuario-->

    <!--Codigo de la tabla mostrar--->
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/usuarios"><?= $data['page_title'] ?></a></li>
    </ul>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <div id="sampleTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
              <div class="row">
                <div class="col-sm-12">
                  <table class="table table-hover table-bordered dataTable no-footer" role="grid" aria-describedby="sampleTable_info" id="tableUsuarios">
                  <button class="btn btn-danger" type="button"  onclick="fntPDF()"  ><a style="color:white;"> PDF</a></button>

                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5px;">#</th>

                        <th class="sorting_asc" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5px;">Rol</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 50px;">Nombre</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Teléfono</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Dirección</th>

                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Correo Electrónico</th>
                        <th class="sorting" tabindex="0" aria-controls="sampleTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 149.375px;">Estado</th>
                        
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
                                      <input type="text" class="form-control valid validText" id="txtNombreM" name="txtNombreM" onkeyup="mayus(this)" onkeypress="return SoloLetras(event);" required="" oninput="validarNombre(this)">


                                    </div>

                                    <div class="form-group col-md-6">
                                      <label for="txtcontrasenaM" id="letra">Contraseña</label>
                                      <input type="password" class="form-control valid validText" id="txtcontrasenaM" name="txtcontrasenaM">
                                      <!--Creacion de aviso de clave segura-->
                                      <label>
                                        <input type="checkbox" id="viewPasswordee2"><span class="label-text">Mostrar contraseña</span>
                                      </label> <br>
                                      <FONT color="red" SIZE=2>*Debe tener minimo caracteres, numeros, mayusculas minusculas.</FONT>
                                    </div>
                                    <!--PODER VER LA CLAVE NUEVO USUARIO-->
                                    <!--PODER VER LA CLAVE NUEVO USUARIO-->
                                  </div>
                                  <div class="form-row">

                                    <div class="form-group col-md-6">
                                      <label for="txtTelefono" id="letra">Teléfono</label>
                                      <!--onkeypress="return controlTag(event);"-->
                                      <input type="text" class="form-control valid validNumber" id="txtTelefonoM" name="txtTelefonoM" onkeypress="return soloNumero(event);" maxlength="8" required="">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="txtDireccion" id="letra">Dirección</label>
                                      <input type="text" placeholder="Ingresa tu dirección" class="form-control valid validText" id="txtDireccionM" name="txtDireccionM" onkeyup="mayus(this)" maxlength="100" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label for="txtEmail" id="letra">Email</label>
                                      <input type="email" class="form-control valid validEmail" id="txtEmailM" name="txtEmailM" onkeyUp="this.value=this.value.toLowerCase();" required="" oninput="validateEmail(this)">
                                    </div>
                                  </div>
                                  <div class="form-row">

                                    <div class="form-group col-md-6">
                                      <label for="listStatus2" id="letra">Estado</label>
                                      <select class="form-control " id="listStatus2" name="listStatus2" required>
                                        <option value="0">Nuevo</option>
                                      </select><br><br>
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
              <div class="row">
                <div class="col-sm-12 col-md-5">
                  <div class="dataTables_info" id="sampleTable_info" role="status" aria-live="polite"></div>
                </div>


              </div>
            </div>
          </div>
          <!--Final del codigo de la tabla mostrar--->

</main>
<script>
  let password2 = document.getElementById("txtcontrasenaM");

  let viewPassword2 = document.getElementById('viewPasswordee2');


  let click2 = false;

  viewPassword2.addEventListener('click', (e) => {
    if (!click) {
      password2.type = 'text'
      click2 = true
    } else if (click2) {
      password2.type = 'password'
      click2 = false
    }
  })
</script>

<script>
  let password = document.getElementById("txtcontrasena");

  let viewPassword = document.getElementById('viewPasswordee');
  let click = false;

  viewPassword.addEventListener('click', (e) => {
    if (!click) {
      password.type = 'text'


      click = true
    } else if (click) {
      password.type = 'password'

      click = false
    }
  })
</script>
<!--Validaciones de solo letras-->
<script>
  function SoloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toString();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    especiales = ["8,13,37,39,46"]; //CARACTERES DE LA TABLA ASCII

    tecla_especial = false
    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      //alert("Ingresar solo letras")
      return false;
    }
  }
</script>

<!--Validaciones de solo letras mayusculas-->
<script type="text/javascript">
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>

<!--Solo numeros-->
<script type="text/javascript">
  function solonumero(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) return true;
    else if (tecla == 0 || tecla == 9) return true;
    // patron =/[0-9\s]/;// -> solo letras
    patron = /[0-9\s]/; // -> solo numeros
    te = String.fromCharCode(tecla);
    return patron.test(te);
  }

  // Obtén el elemento del input
const inputDireccion = document.getElementById('txtDireccion');
const inputDireccionM = document.getElementById('txtDireccionM');

// Agrega un event listener para el evento de entrada de texto
inputDireccion.addEventListener('input', function() {
  // Obtén el valor actual del input
  let direccion = inputDireccion.value;

  // Remueve los caracteres no permitidos y convierte el texto a mayúsculas
  direccion = direccion.replace(/[^0-9A-Za-z\s]/g, '');
  // Actualiza el valor del input con el texto modificado
  inputDireccion.value = direccion;
});
// Agrega un event listener para el evento de entrada de texto
inputDireccionM.addEventListener('input', function() {
  // Obtén el valor actual del input
  let direccion = inputDireccionM.value;

  // Remueve los caracteres no permitidos y convierte el texto a mayúsculas
  direccion = direccion.replace(/[^0-9A-Za-z\s]/g, '');
  // Actualiza el valor del input con el texto modificado
  inputDireccionM.value = direccion;
});

  function solonumero(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla == 8) return true;
  else if (tecla == 0 || tecla == 9) return true;

  patron = /[0-9\s]/;
  te = String.fromCharCode(tecla);
  let inputValue = e.target.value;

  if (patron.test(te)) {
    // Si el carácter ingresado es válido, verifica si hay 8 ceros seguidos
    if (inputValue.includes('00000000')) {
      e.target.value = ''; // Borra el contenido del input
      return false; // Evita que se ingrese el último cero
    }
    return true;
  } else {
    return false;
  }
}
function soloNumero(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla == 8) return true;
  else if (tecla == 0 || tecla == 9) return true;
  else if (tecla == 32) return false; // Bloquea la tecla de espacio

  patron = /[0-9]/;
  te = String.fromCharCode(tecla);
  let inputValue = e.target.value;

  if (patron.test(te)) {
    // Si el carácter ingresado es válido, verifica si hay 8 ceros seguidos
    if (inputValue.includes('00000000')) {
      e.target.value = ''; // Borra el contenido del input
      return false; // Evita que se ingrese el último cero
    }
    return true;
  } else {
    return false;
  }
}

function validarNombre(input) {
  // Obtener el valor actual del campo de texto
  var nombre = input.value;

  // Eliminar caracteres no permitidos (todo lo que no sea una letra)
 
  nombre = nombre.replace(/[^a-zA-Z\s]/g, '');

  // Limitar la longitud del nombre a un máximo de 40 caracteres
  nombre = nombre.slice(0, 40);

  // Actualizar el valor del campo de texto con el nombre válido
  input.value = nombre;
}

function validateEmail(input) {
  var value = input.value;
  var validChars = /^[a-zA-Z0-9@._-]+$/;

  if (!validChars.test(value)) {
    input.value = value.slice(0, -1);
  }

  if (value.length > 30) {
    input.value = value.slice(0, 30);
  }
}

</script>

<script type="text/javascript">
function validatePasswordLength(input) {
  var value = input.value;

  // Eliminar espacios en blanco
  value = value.replace(/\s/g, '');

  if (value.length > 50) {
    value = value.slice(0, 50);
  }

  input.value = value;
}
</script>
<!--Creacion de clave segura por medio de Jrquey-->






<?php footerAdmin($data); ?>