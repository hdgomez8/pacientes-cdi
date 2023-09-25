<?php
/* TODO: Inicio de Sesion en la WebApp */
session_start();

class ConectarSql
{
    protected $dbh;

    protected function ConexionSql()
    {
        // Establecer la conexión a SQL Server
        $hostSQLServer = "localhost";
        $dbnameSQLServer = "Asistencial";
        $usernameSQLServer = "sa";
        $passwordSQLServer = "Hosvital2011";
        try {
            $connSQLServer = new PDO("odbc:Driver={SQL Server};Server=$hostSQLServer;Database=$dbnameSQLServer", $usernameSQLServer, $passwordSQLServer);
            $connSQLServer->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa a la base de datos SQL Server";
        } catch (PDOException $e) {
            echo "Error al conectar a la base de datos SQL Server: " . $e->getMessage();
            die();
        }
    }

    /* TODO: Set Name para utf 8 español - evitar tener problemas con las tildes */
    public function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");
    }

}
