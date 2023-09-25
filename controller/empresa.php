<?php
    /* TODO:Cadena de Conexion */
    require_once("../config/conexion.php");
    /* TODO:Modelo empresa */
    require_once("../models/Empresa.php");
    $empresa = new Empresa();

    /*TODO: opciones del controlador empresa*/
    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar si el campo empresa_id esta vacio */
        case "guardaryeditar":
            /* TODO:Actualizar si el campo empresa_id tiene informacion */
            if(empty($_POST["empresa_id"])){       
                $empresa->insert_empresa($_POST["empresa_nom"]);     
            }
            else {
                $empresa->update_empresa($_POST["empresa_id"],$_POST["empresa_nom"]);
            }
            break;

        /* TODO: Listado de empresa segun formato json para el datatable */
        case "listar":
            $datos=$empresa->get_empresa();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["empresa_nom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["empresa_id"].');"  id="'.$row["empresa_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["empresa_id"].');"  id="'.$row["empresa_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        /* TODO: Actualizar estado a 0 segun id de empresa */
        case "eliminar":
            $empresa->delete_empresa($_POST["empresa_id"]);
            break;

        /* TODO: Mostrar en formato JSON segun empresa_id */
        case "mostrar";
            $datos=$empresa->get_empresa_x_id($_POST["empresa_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["empresa_id"] = $row["empresa_id"];
                    $output["empresa_nom"] = $row["empresa_nom"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Formato para llenar combo en formato HTML */
        case "combo":
            $datos = $empresa->get_empresa();
            $html="";
            $html.="<option label='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['empresa_id']."'>".$row['empresa_nom']."</option>";
                }
                echo $html;
            }
            break;
    }
?>