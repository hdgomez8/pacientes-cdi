<?php
    class Empresa extends Conectar{

        /* TODO: Obtener todos los registros */
        public function get_empresa(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_empresa WHERE est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert Registro*/
        public function insert_empresa($empresa_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_empresa (empresa_id, empresa_nom, est) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $empresa_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update Registro*/
        public function update_empresa($empresa_id,$empresa_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_empresa set
                empresa_nom = ?
                WHERE
                empresa_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $empresa_nom);
            $sql->bindValue(2, $empresa_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete Registro*/
        public function delete_empresa($empresa_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_empresa SET
                est = 0
                WHERE 
                empresa_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $empresa_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_empresa_x_id($empresa_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_empresa WHERE empresa_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $empresa_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>