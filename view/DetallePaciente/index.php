<?php
require_once("../../config/conexion.php");
$dir_proyecto = $settings['DIRECCION_PROYECTO'];
if (isset($_SESSION["usu_id"])) {
?>
	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	<title>Pacientes CID</>::Detalle Paciente</title>
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
								<h3 id="lblnomidticket">Detalle Paciente</h3>
								<input type="hidden" id="dir_proyecto" value="<?php echo $dir_proyecto; ?>">
								<div id="lblestado"></div>
								<span class="label label-pill label-primary" id="lblnomusuario"></span>
								<span class="label label-pill label-default" id="lblfechcrea"></span>
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="../Home/index.php">Inicio</a></li>
									<li class="active">Detalle Paciente</li>
								</ol>
							</div>
						</div>
					</div>
				</header>

				<div class="box-typical box-typical-padding">
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-3">
								<div class="form-group">
									<label class="form-label" for="tip_id">Tipo De Identificación</label>
									<input type="text" class="form-control" id="tip_id" name="tip_id" readonly>
								</div>
							</div>

							<div class="col-lg-3">
								<fieldset class="form-group">
									<label class="form-label semibold" for="num_identificacion">Numero De Identificación</label>
									<input type="text" class="form-control" id="num_identificacion" name="num_identificacion" readonly>
								</fieldset>
							</div>

							<div class="col-lg-6">
								<fieldset class="form-group">
									<label class="form-label semibold" for="nombre_paciente">Nombre Del Paciente</label>
									<input type="text" class="form-control" id="nombre_paciente" name="nombre_paciente" readonly>
								</fieldset>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="col-lg-3">
								<div class="form-group">
									<label class="form-label semibold" for="modalidad">Modalidad</label>
									<select class="form-control" id="modalidad" name="modalidad">
										<option value="">Seleccionar</option>
										<option value="RX">RAYOS X</option>
										<option value="MR">RESONANCIA</option>
										<option value="CT">TOMOGRAFIA</option>
										<option value="MG">MAMOGRAFIA</option>
										<option value="NM">MEDICINA NUCLEAR</option>
										<option value="US">ECOGRAFIA</option>
										<!-- Agrega más opciones según tus necesidades -->
									</select>
								</div>
							</div>

							<div class="col-lg-9">
								<fieldset class="form-group">
									<label class="form-label semibold" for="estudio">Nombre Del Estudio</label>
									<select class="select2" id="estudio" name="estudio" data-placeholder="Seleccionar">
										<option label="Seleccionar"></option>
									</select>
								</fieldset>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="col-lg-3">
								<div class="form-group">
									<label class="form-label" for="servicio">Servicio</label>
									<input type="text" class="form-control" id="servicio" name="servicio" readonly>
								</div>
							</div>

							<div class="col-lg-3">
								<div class="form-group">
									<label class="form-label" for="entidad">Entidad</label>
									<select class="select2" id="entidad" name="entidad">
									</select>
								</div>
							</div>

							<div class="col-lg-6">
								<fieldset class="form-group">
									<label class="form-label semibold" for="hiruko">Estado En Hiruko</label>
									<input type="text" class="form-control" id="hiruko" name="hiruko" readonly>
								</fieldset>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label semibold" for="observacion">Observación</label>
									<input type="text" class="form-control" id="observacion" name="observacion" readonly>
								</fieldset>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="col-lg-12">
								<button type="button" id="btnmodificarpaciente" class="btn btn-rounded btn-inline btn-warning">Modificar Paciente</button>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		</div>
		<!-- Contenido -->

		<?php require_once("../MainJs/js.php"); ?>

		<script type="text/javascript" src="detallepaciente.js"></script>

		<script type="text/javascript" src="../notificacion.js"></script>

	</body>

	</html>
<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>