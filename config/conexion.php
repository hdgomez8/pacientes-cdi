<?php
/* TODO: Inicio de Sesion en la WebApp */
session_start();
$settings = require 'settings.php';

class Conectar
{
    protected $dbh;

    protected function Conexion()
    {
        $settings = require 'settings.php';

        $db_host = $settings['DB_HOST'];
        $db_name = $settings['DB_DATABASE'];
        $db_user = $settings['DB_USERNAME'];
        $db_password = $settings['DB_PASSWORD'];

        try {
            //TODO: Cadena de Conexion Local
            $this->dbh = new PDO("mysql:local=$db_host;dbname=$db_name", $db_user, $db_password);
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

        $settings = require 'settings.php';

        $hostSQLServer = $settings['DB_HOST_SQL'];
        $dbnameSQLServer = $settings['DB_DATABASE_SQL'];
        $usernameSQLServer = $settings['DB_USERNAME_SQL'];
        $passwordSQLServer = $settings['DB_PASSWORD_SQL'];

        try {
            $dsn = "sqlsrv:Server=$hostSQLServer;Database=$dbnameSQLServer;";
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
        $settings = require 'settings.php';
        $dir_proyecto = $settings['DIRECCION_PROYECTO'];
        //TODO: Ruta Proyecto Local
        return "$dir_proyecto";
        //TODO: Ruta Proyecto Produccion
        //return "http://helpdesk.anderson-bastidas.com/";
    }
}
