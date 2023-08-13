var tableParametros;

document.addEventListener('DOMContentLoaded', function () {
    fntProductoslist();
    fntPromocionesget();
    fntSelectProductos();
    tableParametros = $('#tablepromociones').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Promociones/getPromociones",//llamado del get
            "dataSrc": ""
        },
        "columns": [
            { "data": "Id_Promociones" },
            { "data": "Id_Producto" },
            { "data": "Precio" },
            { "data": "Nombre" },
            { "data": "Descripcion" },
            { "data": "Estado" },
            { "data": "Fecha_Inicio" },
            { "data": "Fecha_Final" },
            { "data": "Cantidad_Promocion" },
            { "data": "options" }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

});
// Codigo de validacion de Modal NUEVO parametro

var formParametros = document.querySelector('#formParametros');
formParametros.onsubmit = function (e) {
    e.preventDefault();

   
    var strNombre = document.querySelector('#txtNombrePromocion').value; //capturar el valor de Nombre
   
   
    var strProducto = document.querySelector('#listRolid').value;  //capturar el valor de telefono
    var strDescripcion = document.querySelector('#txtDescripcion').value; //capturar el valor de direccion
    var strvalor = document.querySelector('#txtValor').value; //capturar el valor de direccion
    var strcant = document.querySelector('#txtCant').value; //capturar el valor de direccion
    var dateFecha1 = document.querySelector('#txtFecha1').value; //capturar el valor de direccion
    var dateFecha2 = document.querySelector('#txtFecha2').value; //capturar el valor de direccion
    
    //validacion que los datos esten llenos
    if (strNombre == '' || strProducto == '' || dateFecha1 == ''|| dateFecha2 == '' || strDescripcion == '' || strvalor == '' || strcant == '' ) {
        swal("Atencion", "Todos los campos son obligatorio.", "error");
        return false;
    }
    
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Promociones/setPromocion'; //URL para acceder al metodo 
    var formData = new FormData(formParametros);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                $('#ModalPromociones').modal("hide");
                formParametros.reset();
                swal("Promociones", objData.msg, "success");
                tableParametros.api().ajax.reload();
                
            } else {
                swal("Error", objData.msg, "error");
            }
        } else {
            console.log("Error");
        }

    }

}
function fntProductoslist() {
    if (document.querySelector('#listRolid') ||  document.querySelector('#listRolid2')) {
        let ajaxUrl = base_url + '/Promociones/getSelectProductos';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); //creacion del objeto dependiendo el navegador
        request.open("GET", ajaxUrl, true);//abrimos la petecion por medio del Metodo GET
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listRolid').innerHTML = request.responseText;
                $('#listRolid').selectpicker('render');;
              
            }
        }
    }
}
function EnviarPedido(){//para mostrar en un select los clientes
    formProductos = document.querySelector('#formPromocionesP');
    formProductos.onsubmit = function (e) {
        e.preventDefault();
    }

    let idproducto = document.querySelector("#selectProductos").value;
    let cantidad = document.querySelector("#txtCantidad").value;

    


    let opc = 1;

    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Promociones/setPromocionesProductos';
    var formData = new FormData(formProductos);


    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                var idpedidof = objData.idpedido;
                
                swal("Promociones", objData.msg ,"success");
                $('#modalFormPromocionesP').modal('hide');
            } else {

                $('#modalFormPromocionesP').modal('hide');
          
                swal("Error", objData.msg, "error");



            }

            return false;
        }


    }

}
function fntnew()
{
    rowTable = "";
    document.querySelector('#idProducto').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Agregar productos a promociones";
    document.querySelector("#formPromocionesP").reset();
    parametro = 2;
    document.querySelector('#selectProductos').value = "";

    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Promociones/addCarrito/' + parametro;
    let formData = new FormData();
    request.open("POST", ajaxUrl, true);
    request.send(parametro);
    $("#tbldiv").load(window.location.href + " #tbldiv");
    $('#modalFormPromocionesP').modal('show');
    removePhoto();
    
}
function fntPromocionesget(){
    if(document.querySelector('#listCategoria')){
        let ajaxUrl = base_url+'/Promociones/getSelectPromociones';//extraer todas las categorias 
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);//por metodo get
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listCategoria').innerHTML = request.responseText;
                $('#listCategoria');
            }
        }
    }
}
function agregarProductos() {//para mostrar en un select los clientes
    forProductos = document.querySelector('#formPromocionesP');
    forProductos.onsubmit = function (e) {
        e.preventDefault();
    }

    let idproducto = document.querySelector("#selectProductos").value;
    let cantidad = document.querySelector("#txtCantidad").value;


    if (idproducto == '') {
        swal("", "Debe seleccionar los productos", "error");
        return false;
    }
    if (cantidad == '') {
        swal("", "Debe seleccionar la cantidad ", "error");
        return false;
    }

    let opc = 1;

    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Promociones/addCarrito/' + opc;
    let formData = new FormData();
    formData.append('cantidad', cantidad);
 
    formData.append('idproducto', idproducto);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                //  swal("", objData.msg ,"success");    
                document.querySelector("#idpedido1").innerHTML = objData.data;
       
                $("#tbldiv").load(window.location.href + " #tbldiv");
                // $( "#tableProductos" ).load(window.location.href + " #tableProductos" );


            } else {
                swal("Error", objData.msg, "error");
            }

            return false;
        }
    }

}
function fntSelectProductos() {//para mostrar en un select los clientes
    if (document.querySelector('#selectProductos')) {
        let ajaxUrl = base_url + '/Pedidos/getSelectProductos';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); //creacion del objeto dependiendo el navegador
        request.open("GET", ajaxUrl, true);//abrimos la petecion por medio del Metodo GET
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#selectProductos').innerHTML = request.responseText;
                // document.querySelector('#txtprecio').innerHTML = request.responseText;
                $('#selectProductos').selectpicker('render');

            }
        }
    }
}
if(document.querySelector("#foto")){
    let foto = document.querySelector("#foto");
    foto.onchange = function(e) {
        let uploadFoto = document.querySelector("#foto").value;
        let fileimg = document.querySelector("#foto").files;
        let nav = window.URL || window.webkitURL;
        let contactAlert = document.querySelector('#form_alert');
        if(uploadFoto !=''){
            let type = fileimg[0].type;//capturar  el tipo de archivo       
            let name = fileimg[0].name;
            if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                if(document.querySelector('#img')){
                    document.querySelector('#img').remove();
                }
                document.querySelector('.delPhoto').classList.add("notBlock");
                foto.value="";
                return false;
            }else{  
                    contactAlert.innerHTML='';
                    
                    if(document.querySelector('#img')){
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">";
                }
        }else{
            alert("No selecciono foto");
            if(document.querySelector('#img')){
                document.querySelector('#img').remove();
            }
        }
    }
}
let formCategoria = document.querySelector("#formProductos");
formCategoria.onsubmit = function(e) {
    e.preventDefault();
    let strNombre = document.querySelector('#txtNombre').value;
    let strDescripcion = document.querySelector('#txtDescripcion').value;
    let precio = document.querySelector('#txtPrecio').value;     
    let tamaño = document.querySelector('#txtTamano').value;   
    let categoria = document.querySelector('#listCategoria').value;   
    let isv = document.querySelector('#listISV').value;   
    let intStatus = document.querySelector('#listStatus2').value;      
    if(strNombre == '' || strDescripcion == '' || intStatus == ''|| isv == ''|| categoria == ''|| tamaño == ''|| precio == '')
    {
        swal("Atención", "Todos los campos son obligatorios." , "error");
        return false;
    }
    
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/setProducto'; 
    let formData = new FormData(formCategoria);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
       if(request.readyState == 4 && request.status == 200){
            
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
             

                $('#modalFormProductos').modal("hide");
                formCategoria.reset();
                swal("Productos", objData.msg ,"success");
                removePhoto();
            }else{
                swal("Error", objData.msg , "error");
            }              
        } 
        tableCategorias.api().ajax.reload();
       
        return false;
    }
}





var formActualizarParametro = document.querySelector('#FormActualizarParametro');
formActualizarParametro.onsubmit = function (e) {
    e.preventDefault();
    var strNombre = document.querySelector('#txtNombreM').value; //capturar el valor de Nombre
   
   
    var strValor = document.querySelector('#txtValorM').value;  //capturar el valor de telefono
    var strFechaCreacion = document.querySelector('#txtModParametro').value; //capturar el valor de direccion
    
    
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Parametros/UpdateParametros'; //URL para acceder al metodo
    var formData = new FormData(formActualizarParametro);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                $('#modalFormActualizarParametro').modal("hide");
                formActualizarParametro.reset();
                swal("Parametros", objData.msg, "success");
                tableParametros.api().ajax.reload();
            } else {
                swal("Error", objData.msg, "error");
            }
        } else {
            console.log("Error");
        }

    }

}
//


// Final del codigo de validacion de Modal NUEVO USUARIO

//codigo para el  combobox del rol
//window.addEventListener('load', function () {
//    fntFecha();
//}, false);

//creacion de una funcion(peticion al ajax)


//actualizar 
function fntEditParametro(idparametro) {
    
    var idparametro = idparametro;
    document.querySelector('#titleModal2').innerHTML = "Actualizar Promocion";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnTextM').innerHTML = "Actualizar";
   
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Promociones/getParametrosM/' + idparametro;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
               
               document.querySelector('#idpromocion').value = objData.data.Id_Promociones; //trae el nombre del usuario
                document.querySelector('#txtNombrePromocion').value = objData.data.Nombre; //trae el nombre del usuario
                document.querySelector('#txtValor').value = objData.data.Precio; //trae el telefono del usuario
                document.querySelector('#txtFecha1').value = objData.data.Fecha_Final; //trae el telefono del usuario
                document.querySelector('#txtFecha2').value = objData.data.Fecha_Inicio; //trae el telefono del usuario
                document.querySelector('#txtDescripcion').value = objData.data.Descripcion; //trae el telefono del usuario
                document.querySelector('#listStatus2').value = objData.data.Estado; //trae el telefono del usuario
                document.querySelector('#txtCant').value = objData.data.Cantidad_Promocion; //trae el telefono del usuario
                //document.querySelector("#txtTelefono").value = objData.data.telefono;
                if(objData.data.Estado == 1){
                    document.querySelector("#listStatus2").value = 1;
                }else{
                    document.querySelector("#listStatus2").value = 2;
                }

                $('#ModalPromociones').modal('show');
            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
}
function fntFecha() {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/getUsuarioF/';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
               
                document.querySelector('#txtFechavencimiento').value = objData.data; //trae la fecha de vencimient

            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
}


//ELIMINAR EL USUARIO
function fntDelParametro(idparametro){
    swal({
        title: "Eliminar Promocion",
        text: "¿Realmente quiere eliminar la Promocion?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Promociones/delParametro';
            let strData = "idParametro="+idparametro;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableParametros.api().ajax.reload(function(){
                          //  tableParametros.api().ajax.reload();
                
                          
                         
                        });
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

function openModal() {
    rowTable = "";
  
    //document.querySelector('#txtCreacionParametro').value = '<?php echo(date("Y-m-d")); ?>';
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Promocion";//titulo del modal
    document.querySelector("#formParametros").reset();
    $('#ModalPromociones').modal('show'); //mostrar el  modal
}



