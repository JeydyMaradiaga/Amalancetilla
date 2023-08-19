let tableProducciones;
var tableprod;
var tableRoles;
let rowTable = "";
document.addEventListener('DOMContentLoaded', function () {
    fntUsuarios();
    fntSelectProductos();
    fntSelectProductos2();
   
    tableProducciones = $('#tableProducciones').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Producciones/getProducciones",
            "dataSrc": ""
        },
        "columns": [
            { "data": "Id_Produccion" },
            { "data": "Fecha" },
            { "data": "Estado_Produccion" },
            { "data": "Id_Usuario" },
            { "data": "options" }
        ],


        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

});

function openModal() {

    document.querySelector('#idProduccion').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Produccion";
    parametro = 2;
    document.querySelector('#selectProductos').value = "";
    document.querySelector('#seleccionarUsuario').value = "";
    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Producciones/addCarrito/' + parametro;
    let formData = new FormData();
    request.open("POST", ajaxUrl, true);
    request.send(parametro);
    $('#seleccionarUsuario').selectpicker('render');
    $('#selectProductos').selectpicker('render');
    $("#tbldiv").load(window.location.href + " #tbldiv");
    
    document.querySelector("#formProducciones").reset();

    $('#modalFormProduccion').modal('show');
}

function fntUsuarios() {//para mostrar en un select los usuarios
    if (document.querySelector('#seleccionarUsuario')) {
        let ajaxUrl = base_url + '/Producciones/getSelectUsuarios';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); //creacion del objeto dependiendo el navegador
        request.open("GET", ajaxUrl, true);//abrimos la petecion por medio del Metodo GET
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#seleccionarUsuario').innerHTML = request.responseText;

                $('#seleccionarUsuario').selectpicker('render');

            }
        }
    }
}

function fntSelectProductos() {//para mostrar en un select los clientes
    if (document.querySelector('#selectProductos')) {
        let ajaxUrl = base_url + '/Producciones/getSelectProductos';
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

function fntSelectProductos2() {//para mostrar en un select los clientes
    if (document.querySelector('#selectProductos2')) {
        let ajaxUrl = base_url + '/Producciones/getselectProductos2';
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

function agregarProductos() {//para mostrar en un select los clientes
    forProductos = document.querySelector('#formProducciones');
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
    let ajaxUrl = base_url + '/Producciones/addCarrito/' + opc;
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
                document.querySelector("#idproduccion1").innerHTML = objData.data;

                $("#tbldiv").load(window.location.href + " #tbldiv");
                // $( "#tableProductos" ).load(window.location.href + " #tableProductos" );


            } else {
                swal("Error", objData.msg, "error");
            }

            return false;
        }
    }

}

function agregarInsumos() {//para mostrar en un select los clientes
    forProductos = document.querySelector('#formProducciones');
    forProductos.onsubmit = function (e) {
        e.preventDefault();
    }

    let idproducto = document.querySelector("#selectProductos2").value;
    let cantidad = document.querySelector("#txtCantidad2").value;

    if (idproducto == '') {
        swal("", "Debe seleccionar los innsumos", "error");
        return false;
    }
    if (cantidad == '') {
        swal("", "Debe seleccionar la insumos ", "error");
        return false;
    }

    let opc = 1;

    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Producciones/addCarrito1/' + opc;
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
                document.querySelector("#idproduccion1").innerHTML = objData.data;

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
    formProductos = document.querySelector('#formProducciones');
    formProductos.onsubmit = function (e) {
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
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Producciones/setProduccion/';
    var formData = new FormData(formProductos);
    request.open("POST", ajaxUrl, true); //enviar datos por el metodo post
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                var idpedidof = objData.idcompra;
                tableProducciones.api().ajax.reload();
                swal({
                    title: "Producciones",
                    text: "Produccion agregada correctamente",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonText: "Salir",
                    closeOnConfirm: true
                }, function () {
                    $('#modalFormProduccion').modal('hide');
                });

            } else {

                $('#modalFormProduccion').modal('hide');
                tableProducciones.api().ajax.reload();
                swal("Error", objData.msg, "error");



            }

            return false;
        }


    }

}


function fntDelParametro(idparametro){
    swal({
        title: "Cancelar Producción",
        text: "¿Realmente quiere Cancelar la producción?",
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
            let ajaxUrl = base_url+'/Producciones/delProduccion';
            let strData = "idProduccion="+idparametro;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Cancelar!", objData.msg , "success");
                        tableProducciones.api().ajax.reload(function(){
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

function fntPDF() {


    let  buscador = $('.dataTables_filter input').val();

     var win = window.open( base_url + '/Producciones/getProduccionesR/'+buscador, '_blank');

     win.focus();

}

