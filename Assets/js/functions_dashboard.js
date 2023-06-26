var tableUltimospedidos;

document.addEventListener('DOMContentLoaded', function () {
    tableUltimospedidos = $('#tableUP').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Dashboard/getUltimosP",//llamado del get
            "dataSrc": ""
        },
        "columns": [
            { "data": "Id_Pedido" },
            { "data": "Nombre" },
            { "data": "Estado" },
            { "data": "Total" },
            { "data": "Fecha_Hora" }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });
    tableUltimospedidos = $('#tablePP').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Dashboard/getPedidosP",//llamado del get
            "dataSrc": ""
        },
        "columns": [
            { "data": "Id_Pedido" },
            { "data": "Nombre" },
            { "data": "Estado" },
            { "data": "Total" },
            { "data": "Fecha_Hora" }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

});
// Codigo de validacion de Modal NUEVO parametro

