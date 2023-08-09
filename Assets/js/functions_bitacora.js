var tableBitacora;

document.addEventListener("DOMContentLoaded", function () {
  tableBitacora = $("#tableBitacora").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "/Bitacora/getBitacora",
      dataSrc: "",
    },
    columns: [
      { data: "Id_Bitacora" },
      { data: "Id_Usuario" },
      { data: "Id_Objeto" },
      { data: "Accion" },
      { data: "Descripcion" },
      { data: "Fecha" },
    ],
    
    
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
  });
});
