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

        $dsnConBBDD = "$this->dbMotor:host=$this->host;dbname=$this->database;charset=utf8mb4";
        $dsnSinBBDD = "$this->dbMotor:host=$this->host;charset=utf8mb4";

        try {
            $this->conexionPDO = new PDO($dsnConBBDD, $this->username, $this->password);
            // echo ("<p>Exito en la conexionPDO a la BBDD '$this->database' con PDO</p>");
            $this->conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // echo "<p>Error: No puede conectarse con la base de datos {$e->getMessage()}</p>";
        }
    }

    public static function getInstance()
    {
        if (!self::$instancia) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function getConection()
    {
        return $this->conexionPDO;
    }

    //Prohibe la duplicación de la conexión
    private function __clone() {}
}
