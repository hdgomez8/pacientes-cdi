var tabla;
var usu_id = $('#user_idx').val();
var rol_id = $('#rol_idx').val();

function init() {
    $("#ticket_form").on("submit", function (e) {
        guardar(e);
    });
}

function inicializarDataTable() {
    tabla = $('#ticket_data').dataTable({
        // Configuración inicial de DataTables aquí
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                orientation: 'landscape', // Configura la orientación como 'landscape'
                customize: function(doc) {
                    // Personaliza el documento PDF si es necesario
                }
            },
        ],
        "ajax": {
            url: '../../controller/pacientes.php?op=listar_todos',
            type: "post",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "ordering": false,
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            // Configuración de idioma aquí
        }
    }).DataTable();
}

$(document).ready(function () {

    /* TODO: Llenar Combo Categoria */
    $.post("../../controller/categoria.php?op=combo", function (data, status) {
        $('#cat_id').html(data);
    });

    /* TODO: llenar Combo Prioridad */
    $.post("../../controller/prioridad.php?op=combo", function (data, status) {
        $('#prio_id').html(data);
    });

    /* TODO:LLenar Combo usuario asignar */
    $.post("../../controller/usuario.php?op=combo", function (data) {
        $('#usu_asig').html(data);
    });

    $('#viewuser').hide();

    // Inicializa la tabla para mostrar todos los datos
    inicializarDataTable();

});

/* TODO: Link para poder ver el detalle de ticket en otra ventana */
function ver(tick_id) {
    var dir_proyecto = document.getElementById("dir_proyecto").value;
    window.open(dir_proyecto + "view/DetalleTicket/?ID=" + tick_id + '');
}

/* TODO: Mostrar datos antes de asignar */
function asignar(tick_id) {
    $.post("../../controller/pacientes.php?op=mostrar", { tick_id: tick_id }, function (data) {
        data = JSON.parse(data);
        $('#tick_id').val(data.tick_id);

        $('#mdltitulo').html('Asignar Responsable');
        $("#modalasignar").modal('show');
    });
}

/* TODO: Guardar asignacion de usuario de soporte */
function guardar(e) {
    e.preventDefault();
    var formData = new FormData($("#ticket_form")[0]);
    $.ajax({
        url: "../../controller/pacientes.php?op=asignar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            var tick_id = $('#tick_id').val();
            /* TODO: enviar Email de alerta de asignacion */
            $.post("../../controller/email.php?op=ticket_asignado", { tick_id: tick_id }, function (data) {

            });

            /* TODO: enviar Whaspp de alerta de asignacion */
            $.post("../../controller/whatsapp.php?op=w_ticket_asignado", { tick_id: tick_id }, function (data) {

            });

            /* TODO: Alerta de confirmacion */
            swal("Asignado Exitosamente", "", "success");

            /* TODO: Ocultar Modal */
            $("#modalasignar").modal('hide');

        }
    });
}

/* TODO:Reabrir ticket */
function CambiarEstado(tick_id) {
    swal({
        title: "HelpDesk",
        text: "Esta seguro de Reabrir el Ticket?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
        function (isConfirm) {
            if (isConfirm) {
                /* TODO: Enviar actualizacion de estado */
                $.post("../../controller/pacientes.php?op=reabrir", { tick_id: tick_id, usu_id: usu_id }, function (data) {

                });


                /* TODO: Mensaje de Confirmacion */
                swal({
                    title: "HelpDesk!",
                    text: "Ticket Abierto.",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }
        });
}

$(document).on("click", "#btn_aplicar_filtro", function () {
    listardatatable();
});

/* TODO: Listar datatable con filtro avanzado */
function listardatatable() {
    var modalidad_id = $('#filtro_modalidad').val();

    fetch('../../controller/pacientes.php?op=listar_filtro', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'modalidad_id=' + modalidad_id,
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {

        // Limpia los datos actuales de la tabla
        tabla.clear().draw();

        // Agrega los nuevos datos filtrados
        tabla.rows.add(data.aaData).draw();

    })
    .catch(function (error) {
        console.error('Error:', error);
    });
}

init();
