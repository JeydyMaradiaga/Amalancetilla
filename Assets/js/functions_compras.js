let tableCompras;
var tableprod;
var tableRoles;
let rowTable = "";
document.addEventListener('DOMContentLoaded', function () {

    fntProveedores();
    fntSelectProductos();
    tableCompras = $('#tableCompras').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Compras/getCompras",
            "dataSrc": ""
        },
        "columns": [
            { "data": "Id_Compra" },
            { "data": "Id_Proveedor" },
            { "data": "Id_Usuario" },
            { "data": "Fecha_Compra" },
            { "data": "Total" },
            { "data": "Estado_Compra" },
            { "data": "options" }
        ],


        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

});

function fntProveedores() {//para mostrar en un select los proveedores
    if (document.querySelector('#seleccionarProveedor')) {
        let ajaxUrl = base_url + '/Compras/getSelectProveedores';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); //creacion del objeto dependiendo el navegador
        request.open("GET", ajaxUrl, true);//abrimos la petecion por medio del Metodo GET
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#seleccionarProveedor').innerHTML = request.responseText;

                $('#seleccionarProveedor').selectpicker('render');

            }
        }
    }
}

//numero de celular
const selectElement3 = document.querySelector('.clase2');

selectElement3.addEventListener('change', (event) => {

            document.querySelector('#txtNumero').value = `${event.target.value}`;

            var idproducto = document.querySelector("#txtNumero").value;

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Compras/getNumero/' + idproducto;
            request.open("GET", ajaxUrl, true);
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);

                    if (objData.status) {
                        // document.querySelector('#idParametro').value = objData.data.Id_Parametro; //trae el nombre del usuario
                        document.querySelector('#txtNumero').value = objData.data.Telefono_Proveedor; //trae el nombre del usuario


                    } else {

                        swal("Error", objData.msg, "error");
                    }

                }

            }
});

function fntDelParametro(idparametro) { 
    swal({
        title: "Anular Compra",
        text: "¿Realmente quiere anular esta Compra?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, anular!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {

        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Compras/delCompra';
            let strData = "idCompra=" + idparametro;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("ANULAR!", objData.msg, "success");
                        tableCompras.api().ajax.reload();
                        //  tableParametros.api().ajax.reload();




                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }

    });

}


function fntnew() {


    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Compra";
    parametro = 2;
    document.querySelector('#selectProductos').value = "";
    document.querySelector('#seleccionarProveedor').value = "";
    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Compras/addCarrito/' + parametro;
    let formData = new FormData();
    request.open("POST", ajaxUrl, true);
    request.send(parametro);
    $('#seleccionarProveedor').selectpicker('render');
    $('#selectProductos').selectpicker('render');
    $("#tbldiv").load(window.location.href + " #tbldiv");
    document.querySelector("#formCompras").reset();

    $('#modalFormCompra').modal('show');


}

function openModal() {

    document.querySelector('#idCompra').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Compra";
    document.querySelector("#formCompras").reset();

    $('#modalFormCompra').modal('show');
}







//ver los productos disponibles
function fntSelectProductos() {//para mostrar en un select los clientes
    if (document.querySelector('#selectProductos')) {
        let ajaxUrl = base_url + '/Compras/getSelectProductos';
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
// ver precios de los productos
const selectElement = document.querySelector('.classs');

selectElement.addEventListener('change', (event) => {

    document.querySelector('#txtprecio').value = `${event.target.value}`;

    var idproducto = document.querySelector("#txtprecio").value;

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Compras/getPrecio/' + idproducto;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                // document.querySelector('#idParametro').value = objData.data.Id_Parametro; //trae el nombre del usuario
                document.querySelector('#txtprecio').value = objData.data.Precio_Venta; //trae el precio del producto


            } else {

                swal("Error", objData.msg, "error");
            }

        }

    }

});


function agregarProductos() {//para mostrar en un select los clientes
    forProductos = document.querySelector('#formCompras');
    forProductos.onsubmit = function (e) {
        e.preventDefault();
    }

    let idproducto = document.querySelector("#selectProductos").value;
    let cantidad = document.querySelector("#txtCantidad").value;
    let precio = document.querySelector("#txtprecio").value;
    let idproveedor = document.querySelector("#seleccionarProveedor").value;

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
    let ajaxUrl = base_url + '/Compras/addCarrito/' + opc;
    let formData = new FormData();
    formData.append('cantidad', cantidad);
    formData.append('precio', precio);
    formData.append('idproducto', idproducto);
    formData.append('idproveedor', idproveedor );
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                //  swal("", objData.msg ,"success");    
                document.querySelector("#idcompra1").innerHTML = objData.data;

                $("#tbldiv").load(window.location.href + " #tbldiv");
                // $( "#tableProductos" ).load(window.location.href + " #tableProductos" );


            } else {
                swal("Error", objData.msg, "error");
            }

            return false;
        }
    }

}



function EnviarPedido() {//para mostrar en un select los clientes
    formProductos = document.querySelector('#formCompras');
    formProductos.onsubmit = function (e) {
        e.preventDefault();
    }

    let idproducto = document.querySelector("#selectProductos").value;
    let cantidad = document.querySelector("#txtCantidad").value;
    let precio = document.querySelector("#txtprecio").value;
    let idProveedor= document.querySelector("#seleccionarProveedor").value;

    if (idProveedor == '') {
        swal("", "Debe seleccionar el Proveedor ", "error");
        return false;
    }
  
    if (idproducto == '') {
        swal("", "Debe seleccionar los productos", "error");
        return false;
    }
    if (cantidad == '') {
        swal("", "Debe seleccionar la cantidad ", "error");
        return false;
    }

    let opc = 1;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Compras/setCompra/';
    var formData = new FormData(formProductos);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                var idpedidof = objData.idcompra;
                tableCompras.api().ajax.reload();
                swal({
                    title: "Compra",
                    text: "Compra agregada correctamente",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonText: "Salir",
                    closeOnConfirm: true
                }, function () {
                    $('#modalFormCompra').modal('hide');
                });

            } else {

                $('#modalFormCompra').modal('hide');
                tableCompras.api().ajax.reload();
                swal("Error", objData.msg, "error");



            }

            return false;
        }


    }

}

function fntPDF() {
 
    let  buscador = $('.dataTables_filter input').val();
     var win = window.open( base_url + '/Compras/getPedidosR/'+buscador, '_blank');
     win.focus();
}




