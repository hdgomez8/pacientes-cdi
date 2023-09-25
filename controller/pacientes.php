<?php
/* TODO:Cadena de Conexion */
require_once("../config/conexion.php");
/* TODO:Modelo pacientes */
require_once("../models/Pacientes.php");
$pacientes = new Pacientes();

/*TODO: opciones del controlador pacientes*/
switch ($_GET["op"]) {
        /* TODO: Guardar y editar, guardar si el campo pacientes_id esta vacio */
    case "guardaryeditar":
        /* TODO:Actualizar si el campo pacientes_id tiene informacion */
        if (empty($_POST["pacientes_id"])) {
            // $pacientes->insert_pacientes($_POST["pacientes_nom"]);
        } else {
            $pacientes->update_pacientes($_POST["pacientes_id"], $_POST["pacientes_nom"]);
        }
        break;

        /* TODO: Listado de pacientes segun formato json para el datatable */

    case "listar_todos":
        $datos = $pacientes->get_pacientes_todos();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["paciente_fech_crea"];
            $sub_array[] = $row["paciente_tipo_id"];
            $sub_array[] = $row["paciente_num_doc"];
            $sub_array[] = $row["paciente_nom"];
            $sub_array[] = $row["paciente_estudio"];
            $sub_array[] = $row["servicio_nom"];
            $sub_array[] = $row["empresa_nom"];
            $sub_array[] = $row["paciente_hiruko_id"];
            $sub_array[] = $row["paciente_obs"];
            $sub_array[] = $row["usuario_nombre"];
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

    case "listar":
        $datos = $pacientes->get_pacientes();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["pacientes_nom"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["pacientes_id"] . ');"  id="' . $row["pacientes_id"] . '" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["pacientes_id"] . ');"  id="' . $row["pacientes_id"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
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

        /* TODO: Listado de pacientes segun formato json para el datatable */
    case "pacientesql":
        $datos = $pacientes->get_pacientes_sql($_POST["tip_id"], $_POST["num_identificacion"]);

        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["MPNOMC"] = $row["MPNOMC"];
            }
            echo json_encode($output);
        } else {

            $output["MPNOMC"] = "NO EXISTE PACIENTE";

            echo json_encode($output);
        }

        break;

        /* TODO: Actualizar estado a 0 segun id de pacientes */
    case "eliminar":
        $pacientes->delete_pacientes($_POST["pacientes_id"]);
        break;

        /* TODO: Mostrar en formato JSON segun pacientes_id */
    case "mostrar";
        $datos = $pacientes->get_pacientes_x_id($_POST["pacientes_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["pacientes_id"] = $row["pacientes_id"];
                $output["pacientes_nom"] = $row["pacientes_nom"];
            }
            echo json_encode($output);
        }
        break;


        /* TODO: Insertar nuevo Ticket */
    case "insert":
        $datos = $pacientes->insert_pacientes(
            $_POST["tip_id"],
            $_POST["num_identificacion"],
            $_POST["nombre_paciente"],
            $_POST["estudio"],
            $_POST["servicio"],
            $_POST["entidad"],
            $_POST["hiruko"],
            $_POST["observacion"],
            $_POST["usu_id"],

        );
        /* TODO: Obtener el ID del ultimo registro insertado */

        echo json_encode($datos);
        break;

        /* TODO: Formato para llenar combo en formato HTML */
    case "combo":
        $datos = $pacientes->get_pacientes();
        $html = "";
        $html .= "<option label='Seleccionar'></option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['pacientes_id'] . "'>" . $row['pacientes_nom'] . "</option>";
            }
            echo $html;
        }
        break;
    case "combo_estudios":
        $datos = $pacientes->get_estudios_sql($_POST["modalidad"]);
        $html = "";
        $html .= "<option label='Seleccionar'></option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['prnomb'] . "'>" . $row['prnomb'] . "</option>";
            }
            echo $html;
        }
        break;
}
