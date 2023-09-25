<?php
    /* TODO:Cadena de Conexion */
    require_once("../config/conexion.php");
    /* TODO:Modelo Tipo Mantenimiento */
    require_once("../models/Sistemas.php");
    $sistemas = new Sistemas();

    /*TODO: opciones del controlador sistemas*/
    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar si el campo sis_id esta vacio */
        case "guardaryeditar":
            /* TODO:Actualizar si el campo sis_id tiene informacion */
            if(empty($_POST["sis_id"])){       
                $sistemas->insert_sistemas($_POST["sis_nom"]);     
            }
            else {
                $sistemas->update_sistemas($_POST["sis_id"],$_POST["sis_nom"]);
            }
            break;

        /* TODO: Listado de sistemas segun formato json para el datatable */
        case "listar":
            $datos=$sistemas->get_sistemas();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["sis_nom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["sis_id"].');"  id="'.$row["sis_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["sis_id"].');"  id="'.$row["sis_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        /* TODO: Actualizar estado a 0 segun id de sistemas */
        case "eliminar":
            $sistemas->delete_sistemas($_POST["sis_id"]);
            break;

        /* TODO: Mostrar en formato JSON segun sis_id */
        case "mostrar";
            $datos=$sistemas->get_sistemas_x_id($_POST["sis_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["sis_id"] = $row["sis_id"];
                    $output["sis_nom"] = $row["sis_nom"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Formato para llenar combo en formato HTML */
        case "combo":
            $datos = $sistemas->get_sistemas();
            $html="";
            $html.="<option label='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['sis_id']."'>".$row['sis_nom']."</option>";
                }
                echo $html;
            }
            break;
    }
?>