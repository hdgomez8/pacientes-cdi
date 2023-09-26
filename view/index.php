<?php
/* TODO: Cadena de Conexion */
require_once("../config/conexion.php");
/* TODO: Ruta Login */

// Obtener el valor de $rol desde el campo oculto
if (isset($_POST['rol_id'])) {
    $rol = $_POST['rol_id'];
} else {
    // Valor por defecto si no se proporciona
    $rol = 0; // Puedes elegir un valor por defecto diferente si es necesario
}

if ($rol == 1) {
    /* Si el rol es igual a 4, redirige a una ruta diferente */
    header("Location:" . Conectar::ruta() . "index.php");
    // Envía el valor de $rol a la consola de JavaScript
    echo '<script>';
    echo 'console.log("Valor de $rol: ' . $rol . '");';
    echo '</script>';
} else if ($rol == 2) {
    /* En caso contrario, redirige a la ruta por defecto */
    header("Location:" . Conectar::ruta() . "index.php");
    echo '<script>';
    echo 'console.log("Valor de $rol: ' . $rol . '");';
    echo '</script>';
} else if ($rol == 3) {
    /* En caso contrario, redirige a la ruta por defecto */
    header("Location:" . Conectar::ruta() . "index.php");
    echo '<script>';
    echo 'console.log("Valor de $rol: ' . $rol . '");';
    echo '</script>';
} else {
    header("Location:" . Conectar::ruta() . "view/ConsultarPacientes/");
    echo '<script>';
    echo 'console.log("Valor de $rol: ' . $rol . '");';
    echo '</script>';
}
