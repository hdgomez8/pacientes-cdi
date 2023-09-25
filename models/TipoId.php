<?php
    class TipoId extends Conectar{

        /* TODO:Todos los registros */
        public function get_tipo_id(){
            $conectar= parent::ConexionSql();
            $sql="SELECT * FROM TIPDOCASI;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert */
        public function insert_tipo_id($tipo_id_nom,$tipo_id_abr){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_tipo_id (tipo_id_id,tipo_id_abr,tipo_id_nom, est) VALUES (NULL,?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tipo_id_abr);
            $sql->bindValue(2, $tipo_id_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update */
        public function update_tipo_id($tipo_id_id,$tipo_id_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_tipo_id set
                tipo_id_nom = ?
                WHERE
                tipo_id_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tipo_id_nom);
            $sql->bindValue(2, $tipo_id_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete */
        public function delete_tipo_id($tipo_id_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_tipo_id SET
                est = 0
                WHERE 
                tipo_id_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tipo_id_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_tipo_id_x_id($tipo_id_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_tipo_id WHERE tipo_id_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tipo_id_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>