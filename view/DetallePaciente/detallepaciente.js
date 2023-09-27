function init() {

}

$(document).ready(function () {
    var paciente_id = getUrlParameter('ID');

    listardetalle(paciente_id);

    /* TODO: Llenar Combo Entidad */
    $.post("../../controller/empresa.php?op=combo", function (data, status) {
        $("#entidad").html(data);
    });

});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

$(document).on("click", "#btnenviar", function () {
    var tick_id = getUrlParameter('ID');
    var usu_id = $('#user_idx').val();
    var tickd_descrip = $('#tickd_descrip').val();

    /* TODO:Validamos si el summernote esta vacio antes de guardar */
    if ($('#tickd_descrip').summernote('isEmpty')) {
        swal("Advertencia!", "Falta Descripción", "warning");
    } else {
        var formData = new FormData();
        formData.append('tick_id', tick_id);
        formData.append('usu_id', usu_id);
        formData.append('tickd_descrip', tickd_descrip);
        var totalfiles = $('#fileElem').val().length;
        /* TODO:Agregamos los documentos adjuntos en caso hubiera */
        for (var i = 0; i < totalfiles; i++) {
            formData.append("files[]", $('#fileElem')[0].files[i]);
        }

        /* TODO:Insertar detalle */
        $.ajax({
            url: "../../controller/ticket.php?op=insertdetalle",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                listardetalle(tick_id);
                /* TODO: Limpiar inputfile */
                $('#fileElem').val('');
                $('#tickd_descrip').summernote('reset');
                swal("Correcto!", "Registrado Correctamente", "success");
            }
        });
    }
});

$(document).on("click", "#btnmodificarpaciente", function () {

    var modalidad = $('#modalidad').val();
    var estudio = $('#estudio').val();
    var entidad = $('#entidad').val();

    /* TODO: Preguntamos antes de cerrar el ticket */
    swal({
        title: "HelpDesk",
        text: "Esta seguro de modificar el paciente?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
        function (isConfirm) {
            if (isConfirm) {
                var paciente_id = getUrlParameter('ID');
                /* TODO: Actualizamos el ticket  */
                $.post("../../controller/pacientes.php?op=updatePaciente", {
                    paciente_id: paciente_id,
                    modalidad: modalidad,
                    estudio: estudio,
                    entidad: entidad
                }, function (data) {
                    swal(
                        {
                            title: "Paciente Modificado",
                            text: "Paciente Modificado Exitosamente.!",
                            type: "success",
                            confirmButtonClass: "btn-success",
                        },
                        function (result) {
                            // Imprimir el resultado en la consola
                            if (result) {
                                var dir_proyecto = document.getElementById("dir_proyecto").value;
                                window.location.href =
                                    dir_proyecto + "view/ConsultarPacientes/";
                            }
                        }
                    );
                });
            }
        });
});

function listardetalle(paciente_id) {

    /* TODO: Mostramos informacion del ticket en inputs */
    $.post("../../controller/pacientes.php?op=mostrarPaciente", { paciente_id: paciente_id }, function (data) {
        data = JSON.parse(data);
        $('#tip_id').val(data.paciente_tipo_id);
        $('#num_identificacion').val(data.paciente_num_doc);
        $('#nombre_paciente').val(data.paciente_nom);

        $('#servicio').val(data.servicio_nom);
        $('#hiruko').val(data.paciente_hiruko_id);
        $('#observacion').val(data.paciente_obs);

    });
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

init();
