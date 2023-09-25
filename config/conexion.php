<?php
/* TODO: Inicio de Sesion en la WebApp */
session_start();

class Conectar
{
    protected $dbh;

    protected function Conexion()
    {
        try {
            //TODO: Cadena de Conexion Local
            $this->dbh = new PDO("mysql:local=localhost;dbname=pacientes_cdi", "root", "Orion1225");
            //TODO: Cadenad e Conexion Produccion
            //$conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=andercode_helpdesk1","andercode","contraseña");
            return $this->dbh;
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    protected function ConexionSql()
    {
        // Establecer la conexión a SQL Server
        $hostSQLServer = "192.168.1.191";
        $dbnameSQLServer = "Asistencial";
        $usernameSQLServer = "sa";
        $passwordSQLServer = "Hosvital2011";

        try {
            $dsn = "sqlsrv:Server=192.168.1.191;Database=Asistencial;";
            $connSQLServer = new PDO($dsn, $usernameSQLServer, $passwordSQLServer);
            $connSQLServer->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conexión exitosa a la base de datos SQL Server";
            return $connSQLServer;
        } catch (PDOException $e) {
            echo "Error al conectar a la base de datos SQL Server: " . $e->getMessage();
            die();
        }
    }

    /* TODO: Set Name para utf 8 español - evitar tener problemas con las tildes */
    public function set_names()
    {
        $this->dbh->exec("SET NAMES 'utf8'");
    }

    /* TODO: Ruta o Link del proyecto */
    public static function ruta()
    {
        //TODO: Ruta Proyecto Local
        return "http://192.168.1.194:8080/pacientes-cdi/";
        //TODO: Ruta Proyecto Produccion
        //return "http://helpdesk.anderson-bastidas.com/";
    }
}
