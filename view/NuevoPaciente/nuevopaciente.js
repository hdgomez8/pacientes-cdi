function init() {
  $("#ticket_form").on("submit", function (e) {
    guardaryeditar(e);
  });
}

$(document).ready(function () {
  /* TODO: Inicializar SummerNote */
  $("#tick_descrip").summernote({
    height: 150,
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

  /* TODO: Llenar Combo Tipo ID */
  $.post("../../controller/tipoid.php?op=combo", function (data, status) {
    $("#tip_id").html(data);
  });

  /* TODO: Llenar Combo servicio */
  $.post("../../controller/servicio.php?op=combo", function (data, status) {
    $("#servicio").html(data);
  });

  /* TODO: Llenar Combo Entidad */
  $.post("../../controller/empresa.php?op=combo", function (data, status) {
    $("#entidad").html(data);
  });

  $("#cat_id").change(function () {
    cat_id = $(this).val();
    /* TODO: llenar Combo subcategoria segun cat_id */
    $.post(
      "../../controller/subcategoria.php?op=combo",
      { cat_id: cat_id },
      function (data, status) {
        console.log(data);
        $("#cats_id").html(data);
      }
    );
  });

  /* TODO: Llenar combo Prioridad  */
  $.post("../../controller/prioridad.php?op=combo", function (data, status) {
    $("#prio_id").html(data);
  });
});

function guardaryeditar(e) {
  e.preventDefault();
  /* TODO: Array del form ticket */
  var formData = new FormData($("#ticket_form")[0]);
  /* TODO: validamos si los campos tienen informacion antes de guardar */

  /* TODO: Validar si los campos tienen información antes de guardar */
  var num_identificacion = $("#num_identificacion").val();
  var nombre_paciente = $("#nombre_paciente").val();
  var tip_id = $("#tip_id").val();
  var modalidad = $("#modalidad").val();
  var estudio = $("#estudio").val();
  var servicio = $("#servicio").val();
  var entidad = $("#entidad").val();

  var missingFields = [];

  if (num_identificacion === "") {
    missingFields.push("Número de Identificación");
  }
  if (nombre_paciente === "") {
    missingFields.push("Nombre del Paciente");
  }
  if (modalidad === "") {
    missingFields.push("Modalidad");
  }
  if (estudio === "") {
    missingFields.push("Estudio");
  }
  if (servicio === "") {
    missingFields.push("Servicio");
  }
  if (entidad === "") {
    missingFields.push("Entidad");
  }
  if (tip_id === "") {
    missingFields.push("Tipo de Identificación");
  }

  if (missingFields.length > 0) {
    // If any of the required fields are empty, show an error message with the missing field names
    swal({
      title: "Error",
      text: "Por favor, complete todos los campos obligatorios: " + missingFields.join(", "),
      icon: "error"
    });
    return; // Exit the function, don't proceed with saving
  }

    /* TODO: Guardar Pacientes*/
    $.ajax({
      url: "../../controller/pacientes.php?op=insert",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        data = JSON.parse(data);

        /* TODO: Limpiar campos */
        $("#tick_titulo").val("");
        $("#tick_descrip").summernote("reset");
        $("#num_identificacion").val("");
        $("#nombre_paciente").val("");
        $("#modalidad").val("");
        $("#estudio").val("");
        $("#servicio").val("");
        $("#entidad").val("");
        $("#hiruko").val("");
        $("#observacion").val("");

        /* TODO: Alerta de Confirmacion */
        swal({
          title: "Paciente Guardado Exitosamente",
          text: " ",
          icon: "success"
        }).then(function (result) {
          console.log(result); // Print the result in the console
          if (result) {
            window.location.href = "http://192.168.1.194:8080/pacientes-cdi/view/NuevoPaciente/";
          }
        });
      },
    });
  }

// Obtener los elementos del formulario
const tipIdElement = document.getElementById("tip_id");
const numIdentificacionElement = document.getElementById("num_identificacion");

// Función para realizar la búsqueda
function realizarBusqueda() {
  // Crear un nuevo objeto FormData
  var formData = new FormData();

  // Obtener los valores de los campos
  const tipIdValue = tipIdElement.value;
  const numIdentificacionValue = numIdentificacionElement.value;

  // Verificar si ambos campos están llenos
  if (tipIdValue !== "" && numIdentificacionValue !== "") {
    formData.append("tip_id", tipIdValue);
    formData.append("num_identificacion", numIdentificacionValue);

    /* TODO: Guardar Ticket */
    $.ajax({
      url: "../../controller/pacientes.php?op=pacientesql",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data);
        data = JSON.parse(data);

        $("#nombre_paciente").val(data.MPNOMC);
      },
    });
    // Realizar la búsqueda (aquí puedes llamar a una función de búsqueda o enviar el formulario)
    // Por ejemplo:
    // document.getElementById('busquedaForm').submit();

    // O simplemente mostrar un mensaje de que la búsqueda se realizará
    // alert("Realizando búsqueda...");
  }
}

const modalidadElement = document.getElementById("modalidad");
// Función para realizar la búsqueda
function realizarBusquedaEstudio() {
  // Crear un nuevo objeto FormData
  var formDataEstudio = new FormData();

  // Obtener los valores de los campos
  const modalidad = modalidadElement.value;
  console.log(modalidad);
  // Verificar si ambos campos están llenos
  if (modalidad !== "") {
    formDataEstudio.append("modalidad", modalidad);
console.log(formDataEstudio);

    /* TODO: Guardar Ticket */
    $.ajax({
      url: "../../controller/pacientes.php?op=combo_estudios",
      type: "POST",
      data: formDataEstudio,
      contentType: false,
      processData: false,
      success: function (data) {
        $("#estudio").html(data);
      },
    });

  }
}

modalidadElement.addEventListener("change", realizarBusquedaEstudio);

// Agregar un evento para detectar los cambios en los campos
tipIdElement.addEventListener("change", realizarBusqueda);
numIdentificacionElement.addEventListener("input", realizarBusqueda);

// Agregar un evento para detectar el clic en el botón de búsqueda (opcional)
// document
//   .getElementById("btnBuscar");
//   .addEventListener("click", realizarBusqueda);

init();
