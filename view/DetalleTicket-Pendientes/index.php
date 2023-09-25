<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
?>
  <!DOCTYPE html>
  <html>
  <?php require_once("../MainHead/head.php"); ?>
  <title>Pacientes CID</>::Detalle Ticket</title>
  </head>
  <style>
    td {
      border: 1px solid black;
      padding: 8px;
    }
  </style>

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
              <fieldset class="form-group">
                <label class="form-label semibold" for="tick_tipo_mantenimiento">Tipo De Mantenimniento</label>
                <input type="text" class="form-control" id="tick_tipo_mantenimiento" name="tick_tipo_mantenimiento" readonly>
              </fieldset>
            </div>

            <div class="col-lg-3">
              <fieldset class="form-group">
                <label class="form-label semibold" for="tick_sistemas">Sistemas</label>
                <input type="text" class="form-control" id="tick_sistemas" name="tick_sistemas" readonly>
              </fieldset>
            </div>

            <div class="col-lg-3">
              <fieldset class="form-group">
                <label class="form-label semibold" for="tick_prioridad">Prioridad</label>
                <input type="text" class="form-control" id="tick_prioridad" name="tick_prioridad" readonly>
              </fieldset>
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
                  <textarea id="tickd_descripusu" name="tickd_descripusu" class="summernote"></textarea>
                </div>

              </fieldset>
            </div>

            <div class="col-lg-12">
              <fieldset class="form-group">
                <label class="form-label semibold" for="tickd_descrip_diag_mant">Diagnostico de mantenimiento</label>
                <div class="summernote-theme-1">
                  <textarea id="tickd_descrip_diag_mant" class="summernote" name="tickd_descrip_diag_mant"></textarea>
                </div>

              </fieldset>
            </div>

            <div class="col-lg-12">
              <label class="form-label semibold">Repuestos y/o Accesorios Instalados</label>
              <div class="col-lg-6">
                <table id="table1" class="display" style="width: 100%;border-collapse: collapse;">
                  <thead>
                    <tr>
                      <th style="border: 1px solid black; padding: 8px;">Descripción</th>
                      <th style="border: 1px solid black; padding: 8px;">Cantidad</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Filas -->
                  </tbody>
                </table>
              </div>
              <div class="col-lg-6">
                <table id="table2" class="display" style="width: 100%;border-collapse: collapse;">
                  <thead>
                    <tr>
                      <th style="border: 1px solid black; padding: 8px;">Descripción</th>
                      <th style="border: 1px solid black; padding: 8px;">Cantidad</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Filas -->
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-lg-12">
              <button class="btn btn-rounded btn-inline btn-primary" onclick="agregarFila()">Agregar Repuesto o Accesorio</button>
            </div>

            <div class="col-lg-12">
              <fieldset class="form-group">
                <label class="form-label semibold" for="tickd_descrip_act_rep_efec">Descripcion de Actividades o Reparaciones Efectuadas</label>
                <div class="summernote-theme-1">
                  <textarea id="tickd_descrip_act_rep_efec" name="tickd_descrip_act_rep_efec" class="summernote"></textarea>
                </div>

              </fieldset>
            </div>

            <div class="col-lg-12">
              <button type="button" id="btncerrarticket" class="btn btn-rounded btn-inline btn-primary">Cerrar Ticket</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Contenido -->

    <?php require_once("../MainJs/js.php"); ?>

    <script type="text/javascript" src="detalleticket-pendientes.js"></script>

    <script type="text/javascript" src="../notificacion.js"></script>

  </body>

  </html>
<?php
} else {
  header("Location:" . Conectar::ruta() . "index.php");
}
?>