<?php
class Pacientes extends Conectar
{

    /* TODO: Obtener todos los registros */
    public function get_pacientes()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_pacientes WHERE est=1;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* TODO: Obtener todos los registros */
    public function get_pacientes_todos()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT
        paciente_id, 
        paciente_fech_crea,
        paciente_tipo_id,
        paciente_num_doc,
        paciente_nom,
        paciente_estudio,
        tm_servicio.servicio_nom,
        tm_empresa.empresa_nom,
        paciente_hiruko_id,
        paciente_obs,
        CONCAT(usu_nom, ' ', usu_ape) as usuario_nombre
        FROM tm_pacientes
        INNER join tm_servicio on tm_servicio.servicio_id = paciente_servicio_id
        INNER join tm_empresa on tm_empresa.empresa_id = paciente_empresa_id
        INNER join tm_usuario on tm_usuario.usu_id = paciente_usuario_id ";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* TODO: Obtener todos los registros */
    public function get_pacientes_sql($tip_abr, $num_identificacion)
    {
        $conectarsql = parent::ConexionSql();
        $tip_abr = trim($tip_abr);
        $num_identificacion = trim($num_identificacion);
        $sql191 = "SELECT MPNOMC FROM CAPBAS WHERE mptdoc = '$tip_abr' AND MPCedu = '$num_identificacion'";

        // // // Imprimir la sentencia SQL por consola
        // echo "Sentencia SQL: " . $sql191 . PHP_EOL;

        $sql191 = $conectarsql->prepare($sql191);
        $sql191->execute();

        $resultado = $sql191->fetchAll();

        // Eliminar espacios en blanco al inicio y al final del resultado
        if (!empty($resultado)) {
            $resultado[0]['MPNOMC'] = trim($resultado[0]['MPNOMC']);
        }

        return $resultado;
        // return $resultado = $sql191->fetchAll();
    }

    /* TODO: Obtener todos los registros */
    public function get_estudios_sql($modalidad)
    {
        $conectarsql = parent::ConexionSql();
        $sql191 = "SELECT prcodi,prnomb FROM maepro where prmodexa in (?);";
        $sql191 = $conectarsql->prepare($sql191);
        $sql191->bindValue(1, $modalidad);
        // Obtener la consulta SQL como cadena
        // $consultaSQL = $sql191->queryString;

        // // Imprimir la consulta SQL en la consola del navegador
        // echo '<script>console.log("Consulta SQL: ' . $consultaSQL . '");</script>';

        $sql191->execute();
        return $resultado = $sql191->fetchAll();
    }

    /* TODO:Insert Registro*/
    public function insert_pacientes(
        $tip_id,
        $num_identificacion,
        $nombre_paciente,
        $modalidad,
        $estudio,
        $servicio,
        $entidad,
        $hiruko,
        $observacion,
        $usu_id
    ) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_pacientes (paciente_tipo_id, 
        paciente_num_doc, 
        paciente_nom,
        paciente_modalidad,
        paciente_estudio,
        paciente_servicio_id,
        paciente_empresa_id,
        paciente_hiruko_id,
        paciente_obs,
        paciente_usuario_id,
        paciente_fech_crea) VALUES (?,?,?,?,?,?,?,?,?,?,now());";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tip_id);
        $sql->bindValue(2, $num_identificacion);
        $sql->bindValue(3, $nombre_paciente);
        $sql->bindValue(4, $modalidad);
        $sql->bindValue(5, $estudio);
        $sql->bindValue(6, $servicio);
        $sql->bindValue(7, $entidad);
        $sql->bindValue(8, $hiruko);
        $sql->bindValue(9, $observacion);
        $sql->bindValue(10, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* TODO:Update Registro*/
    public function update_pacientes($cat_id, $cat_nom)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_pacientes set
                cat_nom = ?
                WHERE
                cat_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_nom);
        $sql->bindValue(2, $cat_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* TODO:Update Registro*/
    public function update_paciente($paciente_id, $modalidad, $estudio, $entidad)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_pacientes set
                    paciente_modalidad = ?,
                    paciente_estudio = ?,
                    paciente_empresa_id = ?
                    WHERE
                    paciente_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $modalidad);
        $sql->bindValue(2, $estudio);
        $sql->bindValue(3, $entidad);
        $sql->bindValue(4, $paciente_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* TODO:Delete Registro*/
    public function delete_pacientes($cat_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_pacientes SET
                est = 0
                WHERE 
                cat_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* TODO:Registro x id */
    public function get_pacientes_x_id($cat_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_pacientes WHERE cat_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* TODO:Registro x id */
    public function get_paciente_x_id($paciente_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT *,tm_servicio.servicio_nom FROM tm_pacientes 
        INNER join tm_servicio on tm_servicio.servicio_id = tm_pacientes.paciente_servicio_id 
        WHERE paciente_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $paciente_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function filtrar_paciente($modalidad_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT
        paciente_fech_crea,
        paciente_tipo_id,
        paciente_num_doc,
        paciente_nom,
        paciente_estudio,
        tm_servicio.servicio_nom,
        tm_empresa.empresa_nom,
        paciente_hiruko_id,
        paciente_obs,
        CONCAT(usu_nom, ' ', usu_ape) as usuario_nombre
        FROM tm_pacientes
        INNER join tm_servicio on tm_servicio.servicio_id = paciente_servicio_id
        INNER join tm_empresa on tm_empresa.empresa_id = paciente_empresa_id
        INNER join tm_usuario on tm_usuario.usu_id = paciente_usuario_id 
        where tm_pacientes.paciente_modalidad = :modalidad_id";
        $sql = $conectar->prepare($sql);

        // Vincular el valor de $modalidad_id al marcador de posición :modalidad_id
        $sql->bindParam(':modalidad_id', $modalidad_id, PDO::PARAM_STR);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
