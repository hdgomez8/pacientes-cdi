<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
?>
  <!DOCTYPE html>
  <html>
  <?php require_once("../MainHead/head.php"); ?>
  <title>Pacientes CID</>::Detalle Ticket</title>
  </head>

  <body class="with-side-menu">

    <?php require_once("../MainHeader/header.php"); ?>

    <div class="mobile-menu-left-overlay"></div>

    <?php require_once("../MainNav/nav.php"); ?>

    <!-- Contenido -->
    <div class="page-content">
      <div class="container-fluid">

        <header class="section-header">
          <div class="tbl">
            <div class="tbl-row">
              <div class="tbl-cell">
                <h3 id="lblnomidticket">Detalle Ticket - 1</h3>
                <div id="lblestado"></div>
                <span class="label label-pill label-primary" id="lblnomusuario"></span>
                <span class="label label-pill label-default" id="lblfechcrea"></span>
                <ol class="breadcrumb breadcrumb-simple">
                  <li><a href="../Home/index.php">Inicio</a></li>
                  <li class="active">Detalle Ticket</li>
                </ol>
              </div>
            </div>
          </div>
        </header>

        <div class="box-typical box-typical-padding">
          <div class="row">

            <div class="col-lg-12">
              <fieldset class="form-group">
                <label class="form-label semibold" for="tick_titulo">Asunto</label>
                <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
              </fieldset>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label class="form-label" for="tip_man_id">Tipo De Mantenimniento</label>
                <select class="select2" id="tip_man_id" name="tip_man_id" data-placeholder="Seleccionar" required>
                </select>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label class="form-label" for="sis_id">Sistemas</label>
                <select class="select2" id="sis_id" name="sis_id" data-placeholder="Seleccionar" required>
                </select>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label class="form-label" for="pri_id">Prioridad</label>
                <select class="select2" id="pri_id" name="pri_id" data-placeholder="Seleccionar" required>
                </select>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label class="form-label" for="usu_id_tecnico">Tecnico</label>
                <select class="select2" id="usu_id_tecnico" name="usu_id_tecnico" data-placeholder="Seleccionar" required>
                </select>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label class="form-label">¿Requiere Solicitud de compras?</label>
                <div class="radio-group">
                  <label>
                    <input type="radio" name="opcionCompra" id="opcionCompra" value="si" onclick="mostrarCampoSolicitudCompra()"> Sí
                  </label>
                  <label>
                    <input type="radio" name="opcionCompra" id="opcionCompra" value="no" onclick="ocultarCampoSolicitudCompra()"> No
                  </label>
                </div>
              </div>
            </div>

            <div class="col-lg-3" id="campoNumeroSolicitudCompra" style="display: none;">
              <div class="form-group">
                <label class="form-label" for="numeroSolicitudCompra">Número Solicitud De Compra:</label>
                <input type="text" class="form-control" id="numeroSolicitudCompra" name="numeroSolicitudCompra" placeholder="Ingrese un número">
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label class="form-label">¿Requiere Requisición?</label>
                <div class="radio-group">
                  <label>
                    <input type="radio" name="opcionRequisicion" id="opcionRequisicion" value="si" onclick="mostrarCampoRequisicion()"> Sí
                  </label>
                  <label>
                    <input type="radio" name="opcionRequisicion" id="opcionRequisicion" value="no" onclick="ocultarCampoRequisicion()"> No
                  </label>
                </div>
              </div>
            </div>

            <div class="col-lg-3" id="campoNumeroRequisicion" style="display: none;">
              <div class="form-group">
                <label class="form-label" for="NumeroRequisicion">Número Requisición:</label>
                <input type="text" class="form-control" id="numeroRequisicion" name="numeroRequisicion" placeholder="Ingrese un número">
              </div>
            </div>

            <div class="col-lg-12">
              <fieldset class="form-group">
                <label class="form-label semibold" for="tick_titulo">Adjuntos</label>
                <table id="documentos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                  <thead>
                    <tr>
                      <th style="width: 90%;">Nombre</th>
                      <th class="text-center" style="width: 10%;"></th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </fieldset>
            </div>


            <div class="col-lg-12">
              <fieldset class="form-group">
                <label class="form-label semibold" for="tickd_descripusu">Descripción</label>
                <div class="summernote-theme-1">
                  <textarea id="tickd_descripusu" name="tickd_descripusu" class="summernote" name="name"></textarea>
                </div>

              </fieldset>
            </div>

            <div class="col-lg-12">
              <button type="button" id="btnasignar" class="btn btn-rounded btn-inline btn-primary">Asignar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Contenido -->

    <?php require_once("../MainJs/js.php"); ?>

    <script type="text/javascript" src="detalleticket-gestionar.js"></script>

    <script type="text/javascript" src="../notificacion.js"></script>

  </body>

  </html>
<?php
} else {
  header("Location:" . Conectar::ruta() . "index.php");
}
?>