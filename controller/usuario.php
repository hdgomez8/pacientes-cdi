<?php
/* TODO:Cadena de Conexion */
require_once("../config/conexion.php");
/* TODO:Modelo Categoria */
require_once("../models/Usuario.php");
$usuario = new Usuario();

/*TODO: opciones del controlador Categoria*/
switch ($_GET["op"]) {
        /* TODO: Guardar y editar, guardar si el campo usu_id esta vacio */
    case "guardaryeditar":
        if (empty($_POST["usu_id"])) {
            $usuario->insert_usuario($_POST["usu_nom"], $_POST["usu_ape"], $_POST["usu_correo"], $_POST["usu_pass"], $_POST["rol_id"], $_POST["usu_telf"]);
        } else {
            $usuario->update_usuario($_POST["usu_id"], $_POST["usu_nom"], $_POST["usu_ape"], $_POST["usu_correo"], $_POST["usu_pass"], $_POST["rol_id"], $_POST["usu_telf"]);
        }
        break;

        /* TODO: Listado de usuario segun formato json para el datatable */
    case "listar":
        $datos = $usuario->get_usuario();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["usu_nom"];
            $sub_array[] = $row["usu_ape"];
            $sub_array[] = $row["usu_correo"];
            $sub_array[] = $row["usu_pass"];

            if ($row["rol_id"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">Super Admin</span>';
            } elseif ($row["rol_id"] == "2") {
                $sub_array[] = '<span class="label label-pill label-info">Admin</span>';
            } elseif ($row["rol_id"] == "3") {
                $sub_array[] = '<span class="label label-pill label-warning">Tecnico</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-primary">Usuario</span>';
            }

            $sub_array[] = '<button type="button" onClick="editar(' . $row["usu_id"] . ');"  id="' . $row["usu_id"] . '" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["usu_id"] . ');"  id="' . $row["usu_id"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

        /* TODO: Actualizar estado a 0 segun id de usuario */
    case "eliminar":
        $usuario->delete_usuario($_POST["usu_id"]);
        break;

        /* TODO: Mostrar en formato JSON segun usu_id */
    case "mostrar";
        $datos = $usuario->get_usuario_x_id($_POST["usu_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["usu_id"] = $row["usu_id"];
                $output["usu_nom"] = $row["usu_nom"];
                $output["usu_ape"] = $row["usu_ape"];
                // $output["usu_correo"] = $row["usu_correo"];
                $output["usu_pass"] = $row["usu_pass"];
                $output["rol_id"] = $row["rol_id"];
                $output["usu_telf"] = $row["usu_telf"];
            }
            echo json_encode($output);
        }
        break;

        /* TODO: Cantidad de Ticket por Usuario en formato JSON */
    case "total";
        $datos = $usuario->get_usuario_total_x_id($_POST["usu_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["TOTAL"] = $row["TOTAL"];
            }
            echo json_encode($output);
        }
        break;
    case "total_x_responsable";
        $datos = $usuario->get_usuario_total_x_id_responsable($_POST["usu_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["TOTAL"] = $row["TOTAL"];
            }
            echo json_encode($output);
        }
        break;
        /* TODO: Cantidad de Ticket Abiertos por Usuario en formato JSON */
    case "totalabierto";
        $datos = $usuario->get_usuario_totalabierto_x_id($_POST["usu_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["TOTAL"] = $row["TOTAL"];
            }
            echo json_encode($output);
        }
        break;

        /* TODO: Cantidad de Ticket Cerrados por Usuario en formato JSON */
    case "totalcerrado";
        $datos = $usuario->get_usuario_totalcerrado_x_id($_POST["usu_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["TOTAL"] = $row["TOTAL"];
            }
            echo json_encode($output);
        }
        break;

        /* TODO: Formato Json segun cantidad de ticket por categoria por usuario */
    case "grafico";
        $datos = $usuario->get_usuario_grafico($_POST["usu_id"]);
        echo json_encode($datos);
        break;

        /* TODO: Formato para llenar combo en formato HTML */
    case "combo";
        $datos = $usuario->get_usuario_x_rol();
        if (is_array($datos) == true and count($datos) > 0) {
            $html .= "<option label='Seleccionar'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['usu_id'] . "'>" . $row['usu_nom'] . "</option>";
            }
            echo $html;
        }
        break;
        /* TODO: Formato para llenar combo en formato HTML */
    case "comboTecnicos";
        $datos = $usuario->get_usuario_x_rol_tecnico();
        if (is_array($datos) == true and count($datos) > 0) {
            $html .= "<option label='Seleccionar'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['usu_id'] . "'>" . $row['usu_nom'] . "</option>";
            }
            echo $html;
        }
        break;
        /*TODO: Controller para actualizar contraseña */
    case "password":
        $usuario->update_usuario_pass($_POST["usu_id"], $_POST["usu_pass"]);
        break;
}
