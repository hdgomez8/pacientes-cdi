<?php
/* TODO: Rol 1 es de Usuario */
if ($_SESSION["rol_id"] == 1) {
?>
    <nav class="side-menu">
        <ul class="side-menu-list">
            <li class="blue-dirty">
                <a href="..\NuevoPaciente\">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <span class="lbl">Ingreso de Paciente</span>
                </a>
            </li>

            <li class="blue-dirty">
                <a href="..\MntUsuario\">
                    <span class="glyphicon glyphicon-user"></span>
                    <span class="lbl">Mant. Usuario</span>
                </a>
            </li>

            <li class="blue-dirty">
                <a href="..\MntTipoId\">
                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                    <span class="lbl">Mant. Tipo ID</span>
                </a>
            </li>

            <li class="blue-dirty">
                <a href="..\MntEmpresa\">
                    <span class="glyphicon glyphicon-copyright-mark"></span>
                    <span class="lbl">Mant. Empresa</span>
                </a>
            </li>

            <li class="blue-dirty">
                <a href="..\MntServicio\">
                    <span class="glyphicon glyphicon-subtitles"></span>
                    <span class="lbl">Mant. Servicio</span>
                </a>
            </li>

            <li class="blue-dirty">
                <a href="..\ConsultarPacientes\">
                    <span class="glyphicon glyphicon-search"></span>
                    <span class="lbl">Consultar Pacientes</span>
                </a>
            </li>
        </ul>
    </nav>
<?php
} elseif ($_SESSION["rol_id"] == 2) {
?>
    <nav class="side-menu">
        <ul class="side-menu-list">
            <li class="blue-dirty">
                <a href="..\Home\">
                    <span class="glyphicon glyphicon-home"></span>
                    <span class="lbl">Inicio</span>
                </a>
            </li>

            <li class="blue-dirty">
                <a href="..\NuevoTicket\">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <span class="lbl">Ingreso de Paciente</span>
                </a>
            </li>

            <li class="blue-dirty">
                <a href="..\MntUsuario\">
                    <span class="glyphicon glyphicon-user"></span>
                    <span class="lbl">Mant. Usuario</span>
                </a>
            </li>

            <li class="blue-dirty">
                <a href="..\GestionarTicket\">
                    <span class="glyphicon glyphicon-fullscreen"></span>
                    <span class="lbl">Gestionar Solicitud</span>
                </a>
            </li>

            <li class="blue-dirty">
                <a href="..\ConsultarTicket\">
                    <span class="glyphicon glyphicon-search"></span>
                    <span class="lbl">Consultar Solicitud</span>
                </a>
            </li>
        </ul>
    </nav>
<?php
} elseif ($_SESSION["rol_id"] == 3) {
?>
    <nav class="side-menu">
        <ul class="side-menu-list">
            <li class="blue-dirty">
                <a href="..\NuevoPaciente\">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <span class="lbl">Ingreso de Paciente</span>
                </a>
            </li>

            <li class="blue-dirty">
                <a href="..\ConsultarPacientes\">
                    <span class="glyphicon glyphicon-search"></span>
                    <span class="lbl">Consultar Pacientes</span>
                </a>
            </li>
        </ul>
    </nav>
<?php
} else {
?>
    <nav class="side-menu">
        <ul class="side-menu-list">
            <li class="blue-dirty">
                <a href="..\ConsultarPacientes\">
                    <span class="glyphicon glyphicon-search"></span>
                    <span class="lbl">Consultar Pacientes</span>
                </a>
            </li>
        </ul>
    </nav>
<?php
}
?>