<?php
    /* TODO:Cadena de Conexion */
    require_once("../config/conexion.php");
    /* TODO:Modelo Tipo ID */
    require_once("../models/TipoId.php");
    $tipoId = new TipoId();

    /*TODO: opciones del controlador Tipo ID*/
    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar si el campo tipo_id_id esta vacio */
        case "guardaryeditar":
            if(empty($_POST["tipo_id_id"])){       
                $tipoId->insert_tipo_id($_POST["tipo_id_nom"],$_POST["tipo_id_abr"]);     
            }
            else {
                $tipoId->update_tipo_id($_POST["tipo_id_id"],$_POST["tipo_id_nom"]);
            }
            break;

        /* TODO: Listado de Tipo ID segun formato json para el datatable */
        case "listar":
            $datos=$tipoId->get_tipo_id();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tipo_id_nom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["tipo_id_id"].');"  id="'.$row["tipo_id_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["tipo_id_id"].');"  id="'.$row["tipo_id_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        /* TODO: Actualizar estado a 0 segun id de Tipo ID */
        case "eliminar":
            $tipoId->delete_tipo_id($_POST["tipo_id_id"]);
            break;
        
        /* TODO: Mostrar en formato JSON segun tipo_id_id */
        case "mostrar";
            $datos=$tipoId->get_tipo_id_x_id($_POST["tipo_id_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["tipo_id_id"] = $row["tipo_id_id"];
                    $output["tipo_id_nom"] = $row["tipo_id_nom"];
                }
                echo json_encode($output);
            }
            break;
            
        /* TODO: Formato para llenar combo en formato HTML */
        case "combo":
            $datos = $tipoId->get_tipo_id();
            $html="";
            $html.="<option label='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['MPTDoc']."'>".$row['MPTDesc']."</option>";
                }
                echo $html;
            }
            break;
    }
?>