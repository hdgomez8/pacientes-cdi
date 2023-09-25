function init() {}

$(document).ready(function () {});

/* TODO: Script para poder modificar segun el valor de acceso soporte o usuario */

$("#btnsoporte").change(function (event) {
  var seleccion = $(this).val();

  if (seleccion === "usuario") {
    $("#lbltitulo").html("Acceso Usuario");
    $("#btnsoporte").val("usuario");
    console.log("cambio a 4");
    $("#rol_id").prop("value", "4");
    $("#imgtipo").attr("src", "public/usuario1.jpg");
  } else if (seleccion === "tecnico") {
    $("#lbltitulo").html("Acceso Tecnólogo");
    $("#btnsoporte").val("tecnico");
    $("#rol_id").prop("value", "3");
    $("#imgtipo").attr("src", "public/tecnico.jpg");
  } else if (seleccion === "admin") {
    $("#lbltitulo").html("Acceso Admin");
    $("#btnsoporte").val("admin");
    $("#rol_id").prop("value", "2");
    $("#imgtipo").attr("src", "public/Admin.jpg");
  } else if (seleccion === "superAdmin") {
    $("#lbltitulo").html("Acceso Super Admin");
    $("#btnsoporte").val("superAdmin");
    $("#rol_id").prop("value", "1");
    $("#imgtipo").attr("src", "public/TI.jpg");
  }
});

init();
