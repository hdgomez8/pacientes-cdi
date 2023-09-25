<?php
    class Sistemas extends Conectar{

        /* TODO: Obtener todos los registros */
        public function get_sistemas(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_sistemas WHERE est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert Registro*/
        public function insert_sistemas($sis_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_sistemas (sis_id, sis_nom, est) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sis_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update Registro*/
        public function update_sistemas($sis_id,$sis_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_sistemas set
                sis_nom = ?
                WHERE
                sis_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sis_nom);
            $sql->bindValue(2, $sis_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete Registro*/
        public function delete_sistemas($sis_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_sistemas SET
                est = 0
                WHERE 
                sis_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sis_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_sistemas_x_id($sis_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_sistemas WHERE sis_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sis_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>