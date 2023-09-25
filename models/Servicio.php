<?php
    class Servicio
     extends Conectar{

        /* TODO: Obtener todos los registros */
        public function get_servicio(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_servicio WHERE est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert Registro*/
        public function insert_servicio($servicio_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_servicio (servicio_id, servicio_nom, est) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $servicio_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update Registro*/
        public function update_servicio($servicio_id,$servicio_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_servicio set
                servicio_nom = ?
                WHERE
                servicio_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $servicio_nom);
            $sql->bindValue(2, $servicio_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete Registro*/
        public function delete_servicio($servicio_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_servicio SET
                est = 0
                WHERE 
                servicio_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $servicio_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_servicio_x_id($servicio_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_servicio WHERE servicio_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $servicio_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>