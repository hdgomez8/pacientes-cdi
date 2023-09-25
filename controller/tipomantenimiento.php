<?php
    /* TODO:Cadena de Conexion */
    require_once("../config/conexion.php");
    /* TODO:Modelo Tipo Mantenimiento */
    require_once("../models/TipoMantenimiento.php");
    $tipoMantenimiento = new TipoMantenimiento();

    /*TODO: opciones del controlador tipo_mantenimiento*/
    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar si el campo tip_man_id esta vacio */
        case "guardaryeditar":
            /* TODO:Actualizar si el campo tip_man_id tiene informacion */
            if(empty($_POST["tip_man_id"])){       
                $tipoMantenimiento->insert_tipo_mantenimiento($_POST["tip_man_nom"]);     
            }
            else {
                $tipoMantenimiento->update_tipo_mantenimiento($_POST["tip_man_id"],$_POST["tip_man_nom"]);
            }
            break;

        /* TODO: Listado de tipo_mantenimiento segun formato json para el datatable */
        case "listar":
            $datos=$tipoMantenimiento->get_tipo_mantenimiento();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tip_man_nom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["tip_man_id"].');"  id="'.$row["tip_man_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["tip_man_id"].');"  id="'.$row["tip_man_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        /* TODO: Actualizar estado a 0 segun id de tipo_mantenimiento */
        case "eliminar":
            $tipoMantenimiento->delete_tipo_mantenimiento($_POST["tip_man_id"]);
            break;

        /* TODO: Mostrar en formato JSON segun tip_man_id */
        case "mostrar";
            $datos=$tipoMantenimiento->get_tipo_mantenimiento_x_id($_POST["tip_man_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["tip_man_id"] = $row["tip_man_id"];
                    $output["tip_man_nom"] = $row["tip_man_nom"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Formato para llenar combo en formato HTML */
        case "combo":
            $datos = $tipoMantenimiento->get_tipo_mantenimiento();
            $html="";
            $html.="<option label='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['tip_man_id']."'>".$row['tip_man_nom']."</option>";
                }
                echo $html;
            }
            break;
    }
?>