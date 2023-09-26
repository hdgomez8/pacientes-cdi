<?php
require_once("../../config/conexion.php");
$dir_proyecto = $settings['DIRECCION_PROYECTO'];
if (isset($_SESSION["usu_id"])) {
?>
	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	<title>Pacientes CID</>::Consultar Pacientes</title>
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
								<h3>Consultar Pacientes</h3>
								<input type="hidden" id="dir_proyecto" value="<?php echo $dir_proyecto; ?>">
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="../Home/index.php">Inicio</a></li>
									<li class="active">Consultar Pacientes</li>
								</ol>
							</div>
						</div>
					</div>
				</header>

				<div class="box-typical box-typical-padding">
					<div class="row">
						<div class="col-md-4">
							<select class="select2" id="filtro_modalidad">
								<option value="">Filtrar por Modalidad</option>
								<option value="RX">RAYOS X</option>
								<option value="MR">RESONANCIA</option>
								<option value="CT">TOMOGRAFIA</option>
								<option value="MG">MAMOGRAFIA</option>
								<option value="NM">MEDICINA NUCLEAR</option>
							</select>
						</div>
						<button class="btn" id="btn_aplicar_filtro">Aplicar Filtro</button>
					</div>


					<div class="box-typical box-typical-padding" id="table">

						<table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
							<thead>
								<tr>
									<th style="width: 10%;">Fecha</th>
									<th class="d-none d-sm-table-cell" style="width: 5%;">Tipo Doc</th>
									<th class="d-none d-sm-table-cell" style="width: 10%;">Numero Doc</th>
									<th class="d-none d-sm-table-cell" style="width: 20%;">Nombre</th>
									<th class="d-none d-sm-table-cell" style="width: 10%;">Estudio</th>
									<th class="d-none d-sm-table-cell" style="width: 10%;">Servicio</th>
									<th class="d-none d-sm-table-cell" style="width: 10%;">Entidad</th>
									<th class="d-none d-sm-table-cell" style="width: 10%;">Hiruko</th>
									<th class="d-none d-sm-table-cell" style="width: 10%;">Observacion</th>
									<th class="d-none d-sm-table-cell" style="width: 10%;">Tecnico</th>

								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>

				</div>

			</div>
		</div>
		<!-- Contenido -->
		<?php require_once("modalasignar.php"); ?>

		<?php require_once("../MainJs/js.php"); ?>

		<script type="text/javascript" src="consultarpacientes.js"></script>

		<script type="text/javascript" src="../notificacion.js"></script>

	</body>

	</html>
<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>