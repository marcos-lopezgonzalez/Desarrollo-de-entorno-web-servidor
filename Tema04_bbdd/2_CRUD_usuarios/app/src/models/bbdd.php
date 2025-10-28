<?php

require_once __DIR__ . "/../config.php";

class BBDD
{

    private $conexionPDO;
    private static $instancia;
    private $dbMotor;
    private $host;
    private $database;
    private $username;
    private $password;

    private function __construct()
    {
        global $conexionPDO;
        global $instancia;
        global $dbMotor;
        global $mysqlHost;
        global $mysqlDatabase;
        global $mysqlUser;
        global $mysqlPassword;

        $this->dbMotor = $dbMotor;
        $this->host = $mysqlHost;
        $this->database = $mysqlDatabase;
        $this->username = $mysqlUser;
        $this->password = $mysqlPassword;

        $dsnConBBDD = "mysql:host=$mysqlHost;dbname=$mysqlDatabase;charset=utf8mb4";
        $dsnSinBBDD = "msql:host=$mysqlHost;charset=utf8mb4";

        try {
            $this->conexionPDO = new PDO($dsnConBBDD, $this->username, $this->password);
            echo ("<p>Exuti</p>");
        } catch (PDOException $e) {
            echo "<p>Error: No puede conectarse con la base de datos {$e->getMessage()}</p>";
        }

        $this->conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (!self::$instancia) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }
}
