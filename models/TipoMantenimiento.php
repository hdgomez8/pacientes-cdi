<?php
    class TipoMantenimiento extends Conectar{

        /* TODO: Obtener todos los registros */
        public function get_tipo_mantenimiento(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_tipo_mantenimiento WHERE est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert Registro*/
        public function insert_tipo_mantenimiento($tip_man_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_tipo_mantenimiento (tip_man_id, tip_man_nom, est) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tip_man_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update Registro*/
        public function update_tipo_mantenimiento($tip_man_id,$tip_man_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_tipo_mantenimiento set
                tip_man_nom = ?
                WHERE
                tip_man_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tip_man_nom);
            $sql->bindValue(2, $tip_man_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete Registro*/
        public function delete_tipo_mantenimiento($tip_man_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_tipo_mantenimiento SET
                est = 0
                WHERE 
                tip_man_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tip_man_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_tipo_mantenimiento_x_id($tip_man_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_tipo_mantenimiento WHERE tip_man_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tip_man_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>