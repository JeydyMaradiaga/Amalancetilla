var tableRoles;

document.addEventListener("DOMContentLoaded", function () {
  tableRoles = $("#tableRoles").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "/Roles/getRoles",
      dataSrc: "",
    },
    columns: [
      { data: "Id_Rol" },
      { data: "Nombre_Rol" },
      { data: "Descripcion_Rol" },
      { data: "estado_rol" },
      { data: "options" },
    ],
    dom: "lBfrtip",
    buttons: [
      {
        extend: "copyHtml5",
        text: "<i class='far fa-copy'></i> Copiar",
        titleAttr: "Copiar",
        className: "btn btn-secondary",
      },
      {
        extend: "excelHtml5",
        text: "<i class='fas fa-file-excel'></i> Excel",
        titleAttr: "Esportar a Excel",
        className: "btn btn-success",
      },
      {
        extend: "pdfHtml5",
        text: "<i class='fas fa-file-pdf'></i> PDF",
        titleAttr: "Esportar a PDF",
        className: "btn btn-danger",
      },
      {
        extend: "csvHtml5",
        text: "<i class='fas fa-file-csv'></i> CSV",
        titleAttr: "Esportar a CSV",
        className: "btn btn-info",
      },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
  });

  //NUEVO ROL
  var formRol = document.querySelector("#formRol");
  formRol.onsubmit = function (e) {
    e.preventDefault();

    var intIdRol = document.querySelector("#idRol").value;
    var strNombre = document.querySelector("#txtNombre").value;
    var strDescripcion = document.querySelector("#txtDescripcion").value;
    var intStatus = document.querySelector("#listStatus").value;
    if (strNombre == "" || strDescripcion == "" || intStatus == "") {
      swal("Atención", "Todos los campos son obligatorios.", "error");
      return false;
    }

    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url + "/Roles/setRol";
    var formData = new FormData(formRol);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        var objData = JSON.parse(request.responseText);
        if (objData.status) {
          $("#modalFormRol").modal("hide");
          formRol.reset();
          swal("Roles de usuario", objData.msg, "success");
          tableRoles.api().ajax.reload(function () {
            fntEditRol();
            fntDelRol();
          });
        } else {
          swal("Error", objData.msg, "error");
        }
      }
    };
  };
});

$("#tableRoles").DataTable();

function openModal() {
  document.querySelector("#idRol").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nuevo Rol";
  document.querySelector("#formRol").reset();
  $("#modalFormRol").modal("show");
}

window.addEventListener(
  "load",
  function () {
    fntEditRol();
    fntDelRol();
  },
  false
);

function fntEditRol(idrol) {
  var btnEditRol = document.querySelectorAll(".btnEditRol");
  btnEditRol.forEach(function (btnEditRol) {
    btnEditRol.addEventListener("click", function () {
      document.querySelector("#titleModal").innerHTML = "Actualizar Rol";
      document
        .querySelector(".modal-header")
        .classList.replace("headerRegister", "headerUpdate");
      document
        .querySelector("#btnActionForm")
        .classList.replace("btn-primary", "btn-info");
      document.querySelector("#btnText").innerHTML = "Actualizar";

      var idrol = this.getAttribute("rl");
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "/Roles/getRol/" + idrol;
      request.open("GET", ajaxUrl, true);
      request.send();

      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            document.querySelector("#idRol").value = objData.data.Id_Rol;
            document.querySelector("#txtNombre").value =
              objData.data.Nombre_Rol;
            document.querySelector("#txtDescripcion").value =
              objData.data.Descripcion_Rol;

            if (objData.data.estado_rol == 1) {
              var optionSelect =
                '<option value="1" selected class="notBlock">Activo</option>';
            } else {
              var optionSelect =
                '<option value="2" selected class="notBlock">Inactivo</option>';
            }
            var htmlSelect = `${optionSelect}
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                `;
            document.querySelector("#listStatus").innerHTML = htmlSelect;
            $("#modalFormRol").modal("show");
          } else {
            swal("Error", objData.msg, "error");
          }
        }
      };

      $("#modalFormRol").modal("show");
    });
  });
}

function fntDelRol(idrol) {
  var btnDelRol = document.querySelectorAll(".btnDelRol");
  btnDelRol.forEach(function (btnDelRol) {
    btnDelRol.addEventListener("click", function () {
      var idrol = this.getAttribute("rl");

      swal(
        {
          title: "Eliminar Rol",
          text: "¿Realmente quiere eliminar el Rol?",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, eliminar!",
          cancelButtonText: "No, cancelar!",
          closeOnConfirm: false,
          closeOnCancel: true,
        },
        function (isConfirm) {
          if (isConfirm) {
            var request = window.XMLHttpRequest
              ? new XMLHttpRequest()
              : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = base_url + "/Roles/delRol/";
            var strData = "idrol=" + idrol;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader(
              "Content-type",
              "application/x-www-form-urlencoded"
            );
            request.send(strData);
            request.onreadystatechange = function () {
              if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                  swal("Eliminar!", objData.msg, "success");
                  fntEditRol();
                  fntDelRol();
                  tableRoles.api().ajax.reload();
                } else {
                  swal("Atención!", objData.msg, "error");
                }
              }
            };
          }
        }
      );
    });
  });
}
