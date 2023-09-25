<?php
    /* TODO:Cadena de Conexion */
    require_once("../config/conexion.php");
    /* TODO:Modelo servicio */
    require_once("../models/Servicio.php");
    $servicio = new Servicio();

    /*TODO: opciones del controlador servicio*/
    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar si el campo servicio_id esta vacio */
        case "guardaryeditar":
            /* TODO:Actualizar si el campo servicio_id tiene informacion */
            if(empty($_POST["servicio_id"])){       
                $servicio->insert_servicio($_POST["servicio_nom"]);     
            }
            else {
                $servicio->update_servicio($_POST["servicio_id"],$_POST["servicio_nom"]);
            }
            break;

        /* TODO: Listado de servicio segun formato json para el datatable */
        case "listar":
            $datos=$servicio->get_servicio();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["servicio_nom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["servicio_id"].');"  id="'.$row["servicio_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["servicio_id"].');"  id="'.$row["servicio_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        /* TODO: Actualizar estado a 0 segun id de servicio */
        case "eliminar":
            $servicio->delete_servicio($_POST["servicio_id"]);
            break;

        /* TODO: Mostrar en formato JSON segun servicio_id */
        case "mostrar";
            $datos=$servicio->get_servicio_x_id($_POST["servicio_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["servicio_id"] = $row["servicio_id"];
                    $output["servicio_nom"] = $row["servicio_nom"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Formato para llenar combo en formato HTML */
        case "combo":
            $datos = $servicio->get_servicio();
            $html="";
            $html.="<option label='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['servicio_id']."'>".$row['servicio_nom']."</option>";
                }
                echo $html;
            }
            break;
    }
?>