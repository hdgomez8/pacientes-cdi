<?php
require_once("../../config/conexion.php");
$dir_proyecto = $settings['DIRECCION_PROYECTO'];
if (isset($_SESSION["usu_id"])) {
?>
	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	<title>Pacientes CID::Ingreso de Paciente.</title>
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
								<h3>Ingreso de Paciente</h3>
								<input type="hidden" id="dir_proyecto" value="<?php echo $dir_proyecto; ?>">
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="../Home/index.php">Inicio</a></li>
									<li class="active">Ingreso de Paciente</li>
								</ol>
							</div>
						</div>
					</div>
				</header>

				<div class="box-typical box-typical-padding">

					<h5 class="m-t-lg with-border">Ingresar Información del Paciente</h5>

					<div class="row">
						<form method="post" id="ticket_form">

							<input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">

							<div class="col-lg-12">
								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-label" for="tip_id">Tipo De Identificación</label>
										<select class="select2" id="tip_id" name="tip_id" data-placeholder="Seleccionar Tipo ID" required>
										</select>
									</div>
								</div>

								<div class="col-lg-3">
									<fieldset class="form-group">
										<label class="form-label semibold" for="num_identificacion">Numero De Identificación</label>
										<input type="text" class="form-control" id="num_identificacion" name="num_identificacion" placeholder="Ingrese Nombre Paciente">
									</fieldset>
								</div>

								<div class="col-lg-6">
									<fieldset class="form-group">
										<label class="form-label semibold" for="nombre_paciente">Nombre Del Paciente</label>
										<input type="text" class="form-control" id="nombre_paciente" name="nombre_paciente" placeholder="Ingrese Numero Identificación" readonly>
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
										<select class="select2" id="servicio" name="servicio" data-placeholder="Seleccionar Servicio" required>
										</select>
									</div>
								</div>

								<div class="col-lg-3">
									<div class="form-group">
										<label class="form-label" for="entidad">Entidad</label>
										<select class="select2" id="entidad" name="entidad" data-placeholder="Seleccionar Entidad" required>
										</select>
									</div>
								</div>

								<div class="col-lg-6">
									<fieldset class="form-group">
										<label class="form-label semibold" for="hiruko">Estado En Hiruko</label>
										<input type="text" class="form-control" id="hiruko" name="hiruko" placeholder="Ingrese Estado En Hiruko">
									</fieldset>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="col-lg-12">
									<fieldset class="form-group">
										<label class="form-label semibold" for="observacion">Observación</label>
										<input type="text" class="form-control" id="observacion" name="observacion" placeholder="Ingrese observación">
									</fieldset>
								</div>
							</div>


							<div class="col-lg-12">
								<button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		<!-- Contenido -->

		<?php require_once("../MainJs/js.php"); ?>

		<script type="text/javascript" src="nuevopaciente.js"></script>

		<script type="text/javascript" src="../notificacion.js"></script>

	</body>

	</html>
<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>