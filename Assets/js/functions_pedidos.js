var tableRoles;
var tableprod;

document.addEventListener('DOMContentLoaded', function () {
    fntClientes();
    fntPedidosForma();
    fntDescuentos() ;
    fntSelectProductos();
    fntSelectPromociones();
    tableRoles = $('#tablePedidos').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Pedidos/getPedidos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "Id_Pedido","visible": false },
            { "data": "Id_Cliente" },
            { "data": "Fecha_Hora" }, 
            { "data": "Total" },
            { "data": "Estado" },
            { "data": "Id_Usuario" },
            { "data": "options" }
        ],
 

        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

});


function fntClientes() {//para mostrar en un select los clientes
    if (document.querySelector('#seleccionarCliente')) {
        let ajaxUrl = base_url + '/Pedidos/getSelectClientes';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); //creacion del objeto dependiendo el navegador
        request.open("GET", ajaxUrl, true);//abrimos la petecion por medio del Metodo GET
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#seleccionarCliente').innerHTML = request.responseText;

                $('#seleccionarCliente').selectpicker('render');

            }
        }
    }
}
function fntPDF() {
 
    let  buscador = $('.dataTables_filter input').val();
     var win = window.open( base_url + '/Pedidos/getPedidosR/'+buscador, '_blank');
     win.focus();
}

function agregarPromociones() {//para mostrar en un select los clientes
    forProductos = document.querySelector('#formPedidos');
    forProductos.onsubmit = function (e) {
        e.preventDefault();
    }
    let idpromocion = document.querySelector("#selectProductos").value;
    let idproducto = document.querySelector("#selectProductos2").value;
    let cantidad = document.querySelector("#txtCantidad2").value;
    let precio = document.querySelector("#txtprecio2").value;
    let idcliente = document.querySelector("#seleccionarCliente").value;
    let idformapago = document.querySelector("#SelectForma").value;
    let descuento = document.querySelector("#selectDescuento").value;


    if (idproducto == '') {
        swal("", "Debe seleccionar la promocion", "error");
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
    let ajaxUrl = base_url + '/Pedidos/addCarrito2/' + opc;
    let formData = new FormData();
    formData.append('cantidad', cantidad);
    formData.append('precio', precio);
    formData.append('idproducto', idproducto);
    formData.append('idcliente', idcliente);
    formData.append('descuento', descuento);
    formData.append('idformapago', idformapago);
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
    
    document.querySelector("#txtCantidad2").value = '';
}
function agregarProductos() {//para mostrar en un select los clientes
    forProductos = document.querySelector('#formPedidos');
    forProductos.onsubmit = function (e) {
        e.preventDefault();
    }

    let idproducto = document.querySelector("#selectProductos").value;
    let cantidad = document.querySelector("#txtCantidad").value;
    let precio = document.querySelector("#txtprecio").value;
    let idcliente = document.querySelector("#seleccionarCliente").value;
    let idformapago = document.querySelector("#SelectForma").value;
    let descuento = document.querySelector("#selectDescuento").value;
    let idpromocion = document.querySelector("#selectProductos2").value;

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
    let ajaxUrl = base_url + '/Pedidos/addCarrito/' + opc;
    let formData = new FormData();
    formData.append('cantidad', cantidad);
    formData.append('precio', precio);
    formData.append('idproducto', idproducto);
    formData.append('idcliente', idcliente);
    formData.append('descuento', descuento);
    formData.append('idformapago', idformapago);
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
 
    document.querySelector("#txtCantidad").value = '';

}

//ELIMINAR EL USUARIO
function fntDelParametro(idparametro) {
    swal({
        title: "Anular Pedido",
        text: "¿Realmente quiere anular este pedido?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, anular!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {

        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Pedidos/delParametro';
            let strData = "idParametro=" + idparametro;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("ANULAR!", objData.msg, "success");
                        tableRoles.api().ajax.reload();
                        //  tableParametros.api().ajax.reload();


  

                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }

    });

}

function fntPDF() {
        
           let  buscador = $('.dataTables_filter input').val();
         //   window.location = base_url + '/Pedidos/getPedidosR/'+buscador;
            var win = window.open( base_url + '/Pedidos/getPedidosR/'+buscador, '_blank');
            win.focus();
}

function EnviarPedido() {//para mostrar en un select los clientes
    formProductos = document.querySelector('#formPedidos');
    formProductos.onsubmit = function (e) {
        e.preventDefault();
    }

    let idproducto = document.querySelector("#selectProductos").value;
    let cantidad = document.querySelector("#txtCantidad").value;
    let idpromocion = document.querySelector("#selectProductos2").value;
    let cantidadp = document.querySelector("#txtCantidad2").value;
    let precio = document.querySelector("#txtprecio").value;
    let idcliente = document.querySelector("#seleccionarCliente").value;
    let idformapago = document.querySelector("#SelectForma").value;
    let rb_cai = document.querySelector('#op_factura').value;
    let rb_normal = document.querySelector('#op_normal').value;
    //let iddescuento = document.querySelector("#selectDescuento").value;

    //if (iddescuento == '') {
       // swal("", "Debe seleccionar un descuento", "error");
       // return false;
   // }
    if (idformapago == '') {
        swal("", "Debe seleccionar la forma de pago", "error");
        return false;
    }
    if (rb_cai == "true" || $('#op_factura').is(':checked') || rb_normal == "true" || $('#op_normal').is(':checked')) {

    } else {

        swal("", "Debe seleccionar el tipo de factura", "error");
        return false;
    }

    if (idcliente == '') {
        swal("", "Debe seleccionar el cliente ", "error");
        return false;
    }
    if (rb_cai == '' && rb_normal == '') {
        swal("", "Debe seleccionar el tipo de factura ", "error");
        return false;
    }
    
    

    let opc = 1;

    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Pedidos/setPedido/';
    var formData = new FormData(formProductos);
    formData.append('op_factura', rb_cai);
    formData.append('op_normal', rb_normal);
    formData.append('formapago', idformapago);

    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                var idpedidof = objData.idpedido;
                tableRoles.api().ajax.reload();
                swal({
                    title: "Pedido generado correctamente",
                    text: "¿Desea generar factura ahora?",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonText: "Si, generar!",
                    cancelButtonText: "No, generar!",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location = base_url + '/Factura/generarFactura/' + idpedidof;
                    }
                    $('#modalFormPedido').modal('hide');


                });

            } else {

                $('#modalFormPedido').modal('hide');
                tableRoles.api().ajax.reload();
                swal("Error", objData.msg, "error");



            }

            return false;
        }


    }

}
function fntPedidosForma() {//para mostrar en un select los clientes
    if (document.querySelector('#SelectForma')) {
        let ajaxUrl = base_url + '/Pedidos/getSelectForma';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); //creacion del objeto dependiendo el navegador
        request.open("GET", ajaxUrl, true);//abrimos la petecion por medio del Metodo GET
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#SelectForma').innerHTML = request.responseText;

                $('#SelectForma');

            }
        }
    }
}
function fntDescuentos() {//para mostrar en un select los clientes
    if (document.querySelector('#selectDescuento')) {
        let ajaxUrl = base_url + '/Pedidos/getSelectDescuentos';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); //creacion del objeto dependiendo el navegador
        request.open("GET", ajaxUrl, true);//abrimos la petecion por medio del Metodo GET
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#selectDescuento').innerHTML = request.responseText;
             
                $('#selectDescuento');

            }
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
function fntSelectPromociones() {//para mostrar en un select los clientes
    if (document.querySelector('#selectProductos2')) {
        let ajaxUrl = base_url + '/Promociones/getSelectPromociones'; 
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); //creacion del objeto dependiendo el navegador
        request.open("GET", ajaxUrl, true);//abrimos la petecion por medio del Metodo GET
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#selectProductos2').innerHTML = request.responseText;
                // document.querySelector('#txtprecio').innerHTML = request.responseText;
                $('#selectProductos2').selectpicker('render');

            }
        }
    }
}
function fntEditInfo(element, idpedido) {

    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Pedidos/getPedidou/' + idpedido;

    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#divModal").innerHTML = objData.html;
                $('#modalFormPedido2').modal('show');
                $('select').selectpicker();
                //  fntUpdateInfo();
            } else {
                swal("Error", objData.msg, "error");
            }

            return false;

        }
    }
}
function fntnew() {


    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Pedido";
    parametro = 2;
    document.querySelector('#selectProductos').value = "";
    document.querySelector('#seleccionarCliente').value = "";
    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Pedidos/addCarrito/' + parametro;
    let formData = new FormData();
    request.open("POST", ajaxUrl, true);
    request.send(parametro);
    $('#seleccionarCliente').selectpicker('render');
    $('#selectProductos').selectpicker('render');
    $('#selectDescuento').selectpicker('render');
    $("#tbldiv").load(window.location.href + " #tbldiv");
    document.querySelector("#formPedidos").reset();

    $('#modalFormPedido').modal('show');


}
function verproductos() {

    $('#ModalProduc').modal('show');
}
function openModal() {

    document.querySelector('#idRol').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector("#formRol").reset();

    $('#modalRoles').modal('show');
}
function fntUpdateInfo() {
    let formUpdatePedido = document.querySelector("#formUpdatePedido");
    formUpdatePedido.onsubmit = function (e) {
        e.preventDefault();
        let transaccion;


        let request = (window.XMLHttpRequest) ?
            new XMLHttpRequest() :
            new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Pedidos/setPedidoUpdate';

        let formData = new FormData(formUpdatePedido);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    swal("", objData.msg, "success");
                    $('#modalFormPedido2').modal('hide');
                    tableRoles.api().ajax.reload();

                    return false;
                }
            }

        }
    }
}
const selectElement22 = document.querySelector('.classsPromociones');

selectElement22.addEventListener('change', (event) => {

    document.querySelector('#txtprecio2').value = `${event.target.value}`;

    var idproducto = document.querySelector("#txtprecio2").value;

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Pedidos/getPrecioPromocion/' + idproducto;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                // document.querySelector('#idParametro').value = objData.data.Id_Parametro; //trae el nombre del usuario
                document.querySelector('#txtprecio2').value = objData.data.Precio; //trae el nombre del usuario


            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }

});
const selectElement = document.querySelector('.classs');

selectElement.addEventListener('change', (event) => {

    document.querySelector('#txtprecio').value = `${event.target.value}`;

    var idproducto = document.querySelector("#txtprecio").value;

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Pedidos/getPrecio/' + idproducto;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                // document.querySelector('#idParametro').value = objData.data.Id_Parametro; //trae el nombre del usuario
                document.querySelector('#txtprecio').value = objData.data.Precio_Venta; //trae el nombre del usuario


            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }

});
const selectElement3 = document.querySelector('.clase2');

selectElement3.addEventListener('change', (event) => {

    document.querySelector('#txtNumero').value = `${event.target.value}`;

    var idproducto = document.querySelector("#txtNumero").value;

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Pedidos/getNumero/' + idproducto;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                // document.querySelector('#idParametro').value = objData.data.Id_Parametro; //trae el nombre del usuario
                document.querySelector('#txtNumero').value = objData.data.Telefono; //trae el nombre del usuario


            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }
});
const selectElement2 = document.querySelector('.classs2');

selectElement2.addEventListener('change', (event) => {

    //  $( "#tableProductos" ).load(window.location.href + " #tableProductos" );
    $("#tbldiv").load(window.location.href + " #tbldiv");

});

