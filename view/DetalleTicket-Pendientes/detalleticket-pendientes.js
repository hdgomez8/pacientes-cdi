function init() {}

$(document).ready(function () {
  var tick_id = getUrlParameter("ID");

  listardetalle(tick_id);

  /* TODO: Inicializamos summernotejs */
  $("#tickd_descrip").summernote({
    height: 400,
    lang: "es-ES",
    callbacks: {
      onImageUpload: function (image) {
        console.log("Image detect...");
        myimagetreat(image[0]);
      },
      onPaste: function (e) {
        console.log("Text detect...");
      },
    },
    toolbar: [
      ["style", ["bold", "italic", "underline", "clear"]],
      ["font", ["strikethrough", "superscript", "subscript"]],
      ["fontsize", ["fontsize"]],
      ["color", ["color"]],
      ["para", ["ul", "ol", "paragraph"]],
      ["height", ["height"]],
    ],
  });

  /* TODO: Inicializamos summernotejs */
  $("#tickd_descripusu").summernote({
    height: 400,
    lang: "es-ES",
    toolbar: [
      ["style", ["bold", "italic", "underline", "clear"]],
      ["font", ["strikethrough", "superscript", "subscript"]],
      ["fontsize", ["fontsize"]],
      ["color", ["color"]],
      ["para", ["ul", "ol", "paragraph"]],
      ["height", ["height"]],
    ],
  });

  /* TODO: Inicializamos summernotejs */
  $("#tickd_descrip_diag_mant").summernote({
    height: 400,
    lang: "es-ES",
    toolbar: [
      ["style", ["bold", "italic", "underline", "clear"]],
      ["font", ["strikethrough", "superscript", "subscript"]],
      ["fontsize", ["fontsize"]],
      ["color", ["color"]],
      ["para", ["ul", "ol", "paragraph"]],
      ["height", ["height"]],
    ],
  });

  /* TODO: Inicializamos summernotejs */
  $("#tickd_descrip_act_rep_efec").summernote({
    height: 400,
    lang: "es-ES",
    toolbar: [
      ["style", ["bold", "italic", "underline", "clear"]],
      ["font", ["strikethrough", "superscript", "subscript"]],
      ["fontsize", ["fontsize"]],
      ["color", ["color"]],
      ["para", ["ul", "ol", "paragraph"]],
      ["height", ["height"]],
    ],
  });

  $("#tickd_descripusu").summernote("disable");

  /* TODO: Listamos documentos en caso hubieran */
  tabla = $("#documentos_data")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/documento.php?op=listar",
        type: "post",
        data: { tick_id: tick_id },
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      bDestroy: true,
      responsive: true,
      bInfo: true,
      iDisplayLength: 10,
      autoWidth: false,
      language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando un total de 0 registros",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
        },
      },
    })
    .DataTable();

  $("#table1").DataTable({
    paging: false, // Desactivar paginación
    searching: false, // Desactivar búsqueda
    info: false, // Desactivar información de registros
    ordering: false,
  });

  $("#table2").DataTable({
    paging: false, // Desactivar paginación
    searching: false, // Desactivar búsqueda
    info: false, // Desactivar información de registros
    ordering: false,
  });
});

var currentTable = "table1"; // Indica la tabla actual en la que se deben agregar las filas

function agregarFila() {
  var table = $("#" + currentTable).DataTable();
  var descripcion = prompt("Ingrese la descripción:");
  var cantidad = parseInt(prompt("Ingrese la cantidad:"));

  table.row.add([descripcion, cantidad]).draw();

  // Verificar el número de filas en la tabla actual
  var numRows = table.rows().count();
  if (numRows >= 4) {
    // Cambiar a la siguiente tabla
    currentTable = currentTable === "table1" ? "table2" : "table1";
  }

  // Aplicar estilos a las filas de la tabla actual
  $("#" + currentTable + " tbody tr").css({
    border: "1px solid black",
    padding: "8px",
  });
}

var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split("&"),
    sParameterName,
    i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split("=");

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined ? true : sParameterName[1];
    }
  }
};

$(document).on("click", "#btnasignar", function () {
  var tick_id = getUrlParameter("ID");
  var tip_mant_id = $("#tip_man_id").val();
  var sis_id = $("#sis_id").val();
  var pri_id = $("#pri_id").val();
  var usu_id_tecnico = $("#usu_id_tecnico").val();
  var opcionCompra = $("input[name='opcionCompra']:checked").val();
  var campoNumeroSolicitudCompra = $("#numeroSolicitudCompra").val();
  var opcionRequisicion = $("input[name='opcionRequisicion']:checked").val();
  var campoNumeroRequisicion = $("#numeroRequisicion").val();

  var camposFaltantes = verificarCampos(
    tip_mant_id,
    sis_id,
    pri_id,
    usu_id_tecnico,
    opcionCompra,
    campoNumeroSolicitudCompra,
    opcionRequisicion,
    campoNumeroRequisicion
  );

  // Verificar si hay campos faltantes y mostrar mensaje correspondiente
  if (camposFaltantes.length > 0) {
    var mensaje = "Falta completar los siguientes campos:\n\n";
    mensaje += camposFaltantes.join("\n");

    swal("Advertencia!", mensaje, "warning");
  } else {
    var formData = new FormData();
    formData.append("tick_id", tick_id);
    formData.append("tip_mant_id", tip_mant_id);
    formData.append("sis_id", sis_id);
    formData.append("pri_id", pri_id);
    formData.append("usu_id_tecnico", usu_id_tecnico);
    formData.append("opcionCompra", opcionCompra);
    formData.append("campoNumeroSolicitudCompra", campoNumeroSolicitudCompra);
    formData.append("opcionRequisicion", opcionRequisicion);
    formData.append("campoNumeroRequisicion", campoNumeroRequisicion);

    // echo "<script>console.log('$resultado');</script>";
    /* TODO:Insertar detalle */
    $.ajax({
      url: "../../controller/ticket.php?op=asignar",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data);
        listardetalle(tick_id);
        /* TODO: Limpiar inputfile */
        $("#fileElem").val("");
        swal("Correcto!", "Asignado Exitosamente", "success");
        window.location.href =
          "http://192.168.1.194:8080/pacientes-cdi/view/GestionarTicket/"; // Redireccionar a la nueva página
      },
    });
  }
});

$(document).on("click", "#btncerrarticket", function () {
  /* TODO: Preguntamos antes de cerrar el ticket */
  swal(
    {
      title: "HelpDesk",
      text: "Esta seguro de Cerrar el Ticket?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-warning",
      confirmButtonText: "Si",
      cancelButtonText: "No",
      closeOnConfirm: false,
    },
    function (isConfirm) {
      if (isConfirm) {
        var tick_id = getUrlParameter("ID");
        var usu_id = $("#user_idx").val();
        var tickd_descrip_diag_mant = $("#tickd_descrip_diag_mant").val();
        var tickd_descrip_act_rep_efec = $("#tickd_descrip_act_rep_efec").val();

        /* TODO: Actualizamos el ticket  */
        $.post(
          "../../controller/ticket.php?op=update_x_tecnico",
          {
            tick_id: tick_id,
            tickd_descrip_diag_mant: tickd_descrip_diag_mant,
            tickd_descrip_act_rep_efec: tickd_descrip_act_rep_efec,
          },
          function (data) {}
        );

        // /* TODO:Alerta de ticket cerrado via email */
        // $.post("../../controller/email.php?op=ticket_cerrado", {tick_id : tick_id}, function (data) {

        // });

        // /* TODO:Alerta de ticket cerrado via Whaspp */
        // $.post("../../controller/whatsapp.php?op=w_ticket_cerrado", {tick_id : tick_id}, function (data) {

        // });

        /* TODO:Llamamos a funcion listardetalle */
        listardetalle(tick_id);

        /* TODO: Alerta de confirmacion */
        swal({
          title: "HelpDesk!",
          text: "Ticket Cerrado correctamente.",
          type: "success",
          confirmButtonClass: "btn-success",
        });
      }
    }
  );
});

function listardetalle(tick_id) {
  /* TODO: Mostramos informacion del ticket en inputs */
  $.post(
    "../../controller/ticket.php?op=mostrarpendientes",
    { tick_id: tick_id },
    function (data) {
      data = JSON.parse(data);
      $("#lblnomidticket").html("Detalle Ticket - " + data.tick_id);
      $("#lblestado").html(data.tick_estado);
      $("#tick_titulo").val(data.tick_titulo);
      $("#tick_tipo_mantenimiento").val(data.tip_man_nom);
      $("#tick_sistemas").val(data.sis_nom);
      $("#tick_prioridad").val(data.prio_nom);
      $("#tickd_descripusu").summernote("code", data.tick_descrip);
    }
  );
}

function verificarCampos(
  tip_mant_id,
  sis_id,
  pri_id,
  usu_id_tecnico,
  opcionCompra,
  campoNumeroSolicitudCompra,
  opcionRequisicion,
  campoNumeroRequisicion
) {
  var camposFaltantes = [];

  if (tip_mant_id === "") {
    camposFaltantes.push("Tipo de Mantenimiento");
  }

  if (sis_id === "") {
    camposFaltantes.push("Sistema");
  }

  if (pri_id === "") {
    camposFaltantes.push("Prioridad");
  }

  if (usu_id_tecnico === "") {
    camposFaltantes.push("Usuario Técnico");
  }

  if (opcionCompra === undefined) {
    camposFaltantes.push("Opción de Compra");
  }

  if (campoNumeroSolicitudCompra === "" && opcionCompra === "si") {
    camposFaltantes.push("Número de Solicitud de Compra");
  }

  if (opcionRequisicion === undefined) {
    camposFaltantes.push("Opción de Requisición");
  }

  if (campoNumeroRequisicion === "" && opcionRequisicion === "si") {
    camposFaltantes.push("Número de Requisición");
  }

  return camposFaltantes;
}

function mostrarCampoSolicitudCompra() {
  document.getElementById("campoNumeroSolicitudCompra").style.display = "block";
}

function ocultarCampoSolicitudCompra() {
  document.getElementById("campoNumeroSolicitudCompra").style.display = "none";
  document.getElementById("numeroSolicitudCompra").value = "";
}

function mostrarCampoRequisicion() {
  document.getElementById("campoNumeroRequisicion").style.display = "block";
}

function ocultarCampoRequisicion() {
  document.getElementById("campoNumeroRequisicion").style.display = "none";
  document.getElementById("numeroRequisicion").value = "";
}

init();
